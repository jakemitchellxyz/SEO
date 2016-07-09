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

'aliases' => [
    'SEO' => Pyncil\SEO\Facades\SEOFacade::class,
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
