# Pyncil SEO for Laravel 5

[![Build Status][ico-build]][link-travis]
[![Quality Score][ico-scrutinizer]][link-scrutinizer]
[![Latest Stable Version][ico-stable]][link-packagist]
[![Total Downloads][ico-downloads]][link-packagist]
[![License][ico-license]][link-license]

Pyncil SEO is the ultimate SEO generator for Laravel 5

## Install

Via Composer

``` bash
$ composer require pyncil/seo
```

###Update the Laravel Framework

Add the following provider and alias to `config/app.php`

``` php
'providers' => [
    Pyncil\SEO\Providers\SEOServiceProvider::class
],

// you can add the following as you wish:
'aliases' => [
    'SEO' => Pyncil\SEO\Facades\SEOFacade::class,
]
```

## Usage

TODO

## Credits

- [Jake Mitchell][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File][link-license] for more information.

[ico-stable]: https://img.shields.io/github/release/pyncil/seo.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/pyncil/seo.svg?style=flat-square
[ico-license]: https://img.shields.io/github/license/pyncil/seo.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/g/Pyncil/SEO.svg?style=flat-square
[ico-build]: https://img.shields.io/travis/Pyncil/SEO.svg?style=flat-square

[link-travis]: https://travis-ci.org/Pyncil/SEO
[link-scrutinizer]: https://scrutinizer-ci.com/g/Pyncil/SEO
[link-packagist]: https://packagist.org/packages/pyncil/seo
[link-license]: ./LICENSE
[link-author]: https://github.com/Pyncil
[link-contributors]: ../../contributors
