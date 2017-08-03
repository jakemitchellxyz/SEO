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

Add the following provider to `config/app.php`

``` php
'providers' => [
    Pyncil\SEO\Providers\SEOServiceProvider::class
]
```

## Usage

When creating a new view in your controller, you can set the SEO data:
``` php
public function showArticle(Request $request, $id)
{
    $article = Article::find($id);
    
    SEO::setTitle($article->title)
        ->setDescription($article->description)
        ->setCanonical()
        ->setNext(url('article/' . ($id + 1)))
        ->setPrev(url('article/' . ($id - 1)))
        ->setRobots();
    
    return view('article.show')->with('article', $article);
}
```
*Note*: Don't forget to add `use SEO;` to include the class.

Then, in your view, you can either get all of the tags:
``` html
<html>
    <head>
        <!-- Minified -->
        {!! SEO::get() !!}
        
        <!-- Unminified -->
        {!! SEO::get(false) !!}
    </head>
    <body>
        <!-- Page Content -->
    </body>
</html>
```

Or get each tag by hand:
``` html
<html>
    <head>
        {!! SEO::getTitle() !!}
        {!! SEO::getDescription() !!}
        {!! SEO::getCanonical() !!}
    </head>
    <body>
        <!-- Page Content -->
    </body>
</html>
```

See the [available functions](#functions) for a list of available getters and setters.

## Functions

#### Setters:

| Function | Description |
| --- | --- |
| `setTitle($title)` | **Required:** Sets the page title. |
| `setSubtitle($subtitle)` | Optional subtitle, separated by the separator. |
| `setTitleSeparator($separator)` | Separates title and subtitle - defaults to `' &#8211; '` |
| `setDescription($description)` | **Required:** Sets the page description. |
| `setKeywords($keywords)` | Sets the keywords - overrides existing keywords. |
| `addKeyword($keyword)` | Add a keyword to existing keyword list. |
| `addKeywords($keywords)` | Add list of keywords to existing list. (takes array or comma delimeted string) |
| `removeKeyword($keyword)` | Remove a keyword from the existing list. |
| `setCanonical($url = URL::current())` | Sets canonical URL. If no parameter is set, defaults to `URL::current()` |
| `setRobots($robots = 'index,follow')` | Sets the robots. If no parameter is set, defaults to `'index,follow'` |
| `setViewport($viewport = 'width=device-width, initial-scale=1')` | Sets the viewport for mobile sites. If no parameter is set, defaults to `'width=device-width, initial-scale=1'` |
| `setPrev($url)` | Sets the previous URL, used for pagination and sequential articles. |
| `setNext($url)` | Sets the next URL, used for pagination and sequential articles. |
| `addMeta($meta, $content = null, $name = 'name')` | Add custom meta tag. See [Custom Tags](#custom-tags) for details. |
| `removeMeta($meta)` | Remove custom tag by name. |

#### Getters:

All of the following functions return html.

| Function | Description |
| --- | --- |
| `get($minify = true)` | Gets all set SEO tags. Set $minify to false to recieve HTML on multiple lines. |
| `getTitle()` | Gets the page title. |
| `getDescription()` | Gets the page description. |
| `getKeywords()` | Gets the keywords. |
| `getCanonical()` | Gets the canonical URL. |
| `getRobots()` | Gets the robots. |
| `getViewport()` | Gets the viewport. If no parameter is set, defaults to `'width=device-width, initial-scale=1'` |
| `getPrev()` | Gets the previous URL, used for pagination and sequential articles. |
| `getNext()` | Gets the next URL, used for pagination and sequential articles. |
| `getMeta()` | Gets all of the custom tags. |

## Custom Tags

Adding custom tags is a cinch! Simply declare the name and content like so:

| Function | Output |
| --- | --- |
| `SEO::addMeta('author', 'Billy Bob')` | `<meta name="author" content="Billy Bob">` |
| `SEO::addMeta('refresh', 300, 'http-equiv')` | `<meta http-equiv="refresh" content="300">` |
| `SEO::addMeta('UTF-8', null, 'charset')` | `<meta charset="UTF-8">` |
| `SEO::addMeta(['author' => 'Billy', 'copyright' => 'PotatoFace'])` | `<meta name="author" content="Billy"> <meta name="copyright" content="PotatoFace">` |

## Favicons

Many different browsers, computers, and operating systems like to retrieve a page's favicon in their own, creative ways. Stupid, I know.
But, nevertheless, we must dance like the monkeys we are. So instead of creating 50 different favicons and link tags, just head on over to the [Real Favicon Generator](http://realfavicongenerator.net/) and download all of your new favicons.

Then, put them all in the folder of your choice.

*DO NOT RENAME FILES*

Once you do that, you can declare that you want favicons by calling:
``` php
SEO::favicons()->set('folder/containing/icons');
```
*Note*: the url you pass must be relative to the `public` directory.

then we can get your link tags dynamically like this:
``` html
<head>
    {!! SEO::favicons()->get() !!}
</head>
```
And that's it!

The generator will only generate tags corresponding with existing files. If you don't want the tag, don't include the file.
*Note*: other items CAN exist in the icons folder. It is reccommended to put the icons in the `/public` directory.

#### Advanced Setup

Let's say you want to customize the icon sizes on Android or iPhone. Or maybe the tile color in Windows 8 or 10. The following functions allow you to make those custom changes:

These sizes each take an array variable. Each string in the array must be in format "144x144" and corresponds with a file by that size.

| Funcion | Description |
| --- | --- |
| `setSizes($sizes)` | Sets general `'favicon-'` sizes |
| `setAppleSizes($sizes)` | Sizes for `'apple-touch-'` icons |
| `setAndroidSizes($sizes)` | Sizes for `'android-chrome-'` icons |

To set custom colors, use `setColors($colors)`. It takes an array of colors in this format:
``` php
$colors = [
    'safari_pinned' => '#000000',
    'ms_tile' => '#000000',
    'theme' => '#000000'
];
```
those three color names are the only colors you may set. Colors must be in hex and none of them are required.

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
