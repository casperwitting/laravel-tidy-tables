<?php

namespace Casperw\LaravelTidyTables\Commands;

use Illuminate\Support\Collection;
use Casperw\LaravelTidyTables\ColumnTrait;
use Casperw\LaravelTidyTables\DatabaseTrait;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Database\Console\Migrations\MigrateCommand as BaseMigrateCommand;

class TidyTableCommand extends BaseMigrateCommand
{
    use DatabaseTrait, ColumnTrait;

    /**
     * Create a new command instance.
     *
     * @param Migrator $migrator
     */
    public function __construct(Migrator $migrator)
    {
        $this->signature .= '
                {--tidy : Move timestamps columns to the end of all tables.}
        ';

        parent::__construct($migrator);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $tables = $this->getTables();

        $this->prepareDatabase();

        foreach ($tables as $key => $table) {
            $table_name = head($table);

            $this->reorderUuid($table_name, $this->getTableColumns($table_name));

            $this->reorderTimestamps($table_name, $this->getTableColumns($table_name));

            $this->reorderForeignKeys($table_name, $this->getTableColumns($table_name));
        }

        $this->repairDatabase();
    }

    private function reorderUuid($table, Collection $columns): bool
    {
        if ($columns->contains(config('laraveltidytables.fields.primary_key')) && $columns->contains(config('laraveltidytables.fields.universally_unique_identifier'))) {
            return $this->moveColumn($table, config('laraveltidytables.fields.universally_unique_identifier'), config('laraveltidytables.data_types.universally_unique_identifier'), config('laraveltidytables.fields.primary_key'));
        }
    }

    private function reorderTimestamps(string $table, Collection $columns): void
    {
        $last_item = $this->getLastNotTimestampColumn($columns);

        foreach (config('laraveltidytables.fields.timestamps') as $timestamp) {
            if ($columns->contains($timestamp)) {
                $this->moveColumn($table, $timestamp, config('laraveltidytables.data_types.timestamps'), $last_item);
            }
        }
    }

    private function reorderForeignKeys(string $table, Collection $columns): bool
    {
        $foreign_keys = collect();

        foreach ($columns as $column) {
            if (str_contains($column, config('laraveltidytables.fields.foreign_key_suffix'))) {
                $foreign_keys->push($column);
            }
        }

        if (! $foreign_keys->count() || ! $this->containsKey($columns)) {
            return false;
        }

        foreach ($foreign_keys as $foreign_key) {
            $this->moveKey($table, $foreign_key, config('laraveltidytables.data_types.foreign_keys'), $this->getBaseColumn($columns));
        }

        return true;
    }
}
