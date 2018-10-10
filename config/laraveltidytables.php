<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Fields
    |--------------------------------------------------------------------------
    |
    | The following fields are configurable and are used during
    | sorting of the configured database. Change these existing fields to your liking.
    | Note, that it's possible to add timestamps and change order to your liking.
    |
    */
    'fields' => [
        'primary_key' => 'id',
        'universally_unique_identifier' => 'uuid',
        'foreign_key_affix' => '_id',
        'timestamps' => [
            'deleted_at',
            'updated_at',
            'created_at',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Data types
    |--------------------------------------------------------------------------
    |
    | Here are all the datatypes that are used by the sorting algoritm.
    | It's important to note that these values are based on laravel's default migration data types.
    | You might not use a CHAR(36) for uuid's in your configuration. Change these values if so.
    |
    */
    'data_types' => [
        'universally_unique_identifier' => 'CHAR(36)',
        'foreign_keys' => 'INTEGER UNSIGNED',
        'timestamps' => 'TIMESTAMP NULL',
    ],

];
