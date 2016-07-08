# Pyncil SEO for Laravel 5

[![Build Status][ico-build]][link-travis]
[![Quality Score][ico-scrutinizer]][link-scrutinizer]
[![Latest Stable Version][ico-stable]][link-packagist]
[![Total Downloads][ico-downloads]][link-packagist]
[![License][ico-license]][link-license]
[![Latest Unstable Version][ico-unstable]][link-packagist]

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

[ico-stable]: https://poser.pugx.org/pyncil/seo/v/stable
[ico-unstable]: https://poser.pugx.org/pyncil/seo/v/unstable
[ico-downloads]: https://poser.pugx.org/pyncil/seo/downloads
[ico-license]: https://poser.pugx.org/pyncil/seo/license
[ico-scrutinizer]: https://scrutinizer-ci.com/g/Pyncil/SEO/badges/quality-score.png?b=master
[ico-build]: https://travis-ci.org/Pyncil/SEO.svg?branch=master

[link-travis]: https://travis-ci.org/Pyncil/SEO
[link-packagist]: https://packagist.org/packages/pyncil/seo
[link-scrutinizer]: https://scrutinizer-ci.com/g/Pyncil/SEO
[link-license]: ./LICENSE
[link-author]: https://github.com/Pyncil
[link-contributors]: ../../contributors
