<?php

namespace Pyncil\SEO\Facades;

use Illuminate\Support\Facades\Facade;

class FaviconsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'seo.favicons';
    }
}
