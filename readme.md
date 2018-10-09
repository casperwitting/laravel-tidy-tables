# Laravel Tidy Tables

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

Tidy up your database column order!

## Installation

Via Composer

``` bash
$ composer require casperw/laraveltidytables
```

``` bash
$ php artisan vendor:publish --tag=laraveltidytables.config
```

## Usage
The following command will sort all of your database's tables. 
``` bash
$ php artisan migrate --tidy
```


## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.


## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/casperw/laraveltidytables.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/casperw/laraveltidytables.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/casperw/laraveltidytables/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/casperw/laraveltidytables
[link-downloads]: https://packagist.org/packages/casperw/laraveltidytables
[link-travis]: https://travis-ci.org/casperw/laraveltidytables
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/casperw
