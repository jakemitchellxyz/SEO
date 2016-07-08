<?php

namespace Pyncil\SEO\Facades;

use Illuminate\Support\Facades\Facade;

class SEOGenerator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'seo';
    }
}
