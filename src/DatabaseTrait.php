<?php

namespace Casperw\LaravelTidyTables;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait DatabaseTrait
{
    public function getTables()
    {
        return DB::select('SHOW TABLES');
    }

    public function getTableColumns($table)
    {
        return collect(DB::getSchemaBuilder()->getColumnListing($table));
    }

    public function moveKey(string $table, string $column, string $data_type, string $after_column)
    {
        return DB::statement("ALTER TABLE `{$table}` MODIFY COLUMN `{$column}` {$data_type} UNSIGNED AFTER `{$after_column}`");
    }

    public function moveColumn(string $table, string $column, string $data_type, string $after_column)
    {
        return DB::statement("ALTER TABLE `{$table}` MODIFY COLUMN `{$column}` {$data_type} AFTER `{$after_column}`");
    }

    public function prepareDatabase()
    {
        Schema::disableForeignKeyConstraints();
        config('database.connections.mysql.strict', false);
    }

    public function repairDatabase()
    {
        Schema::enableForeignKeyConstraints();
        config('database.connections.mysql.strict', true);
    }

}