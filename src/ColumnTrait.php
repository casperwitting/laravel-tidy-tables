<?php

namespace Casperw\LaravelTidyTables;

use Illuminate\Support\Collection;

trait ColumnTrait
{
    public function containsKey(Collection $columns): bool
    {
        return $columns->contains(config('laraveltidytables.fields.primary_key')) || $columns->contains(config('laraveltidytables.fields.universally_unique_identifier'));
    }

    public function getBaseColumn(Collection $columns): string
    {
        return ($columns->contains(config('laraveltidytables.fields.universally_unique_identifier'))) ? config('laraveltidytables.fields.universally_unique_identifier') : config('laraveltidytables.fields.primary_key');
    }

    public function getLastNotTimestampColumn(Collection $columns): string
    {
        $columns_reversed = $columns->reverse();

        foreach ($columns_reversed as $column) {
            if (! in_array($column, config('laraveltidytables.fields.timestamps'))) {
                return $column;
            }
        }
    }
}
