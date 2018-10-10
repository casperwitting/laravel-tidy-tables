# Laravel Tidy Tables

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This package provides a way to reorder the columns of all your existing database tables. The sorting algorithm will sort table columns in the following structure:

- Primary key  
- Universally unique identifier
- Foreign keys
- Native columns
- Timestamps

## Installation

Via Composer

``` bash
$ composer require casperw/laravel-tidy-tables
```
## Configuration
The defaults are set in config/laraveltidytables.php. Copy this file to your own config directory to modify the values. You can publish the config using this command:
``` bash
$ php artisan vendor:publish --tag=laraveltidytables.config
```
The configuration file contains an array of fields, and an array of data types. 

#### Available fields
```php
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
```

#### Available data types

> **Note:** By default, the configuration supports laravel's default datatypes. Check if your database corrosponds with the default values, and change them if needed!

```php
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
        'timestamps' => 'TIMESTAMP NULL'
    ]
```

## Usage
The following command will sort all of your database's tables. 

> **Note:** Always make sure to back-up your database first.

``` bash
$ php artisan migrate --tidy
```


## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.


## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/casperw/laravel-tidy-tables.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/casperw/laravel-tidy-tables.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/casperw/laravel-tidy-tables/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/casperw/laravel-tidy-tables
[link-downloads]: https://packagist.org/packages/casperw/laravel-tidy-tables
[link-travis]: https://travis-ci.org/casperw/laravel-tidy-tables
[link-styleci]: https://github.styleci.io/repos/152297096
[link-author]: https://github.com/casperw
