<?php

namespace Pyncil\SEO\Providers;

use Pyncil\SEO\Contracts;
use Pyncil\SEO\SEOGenerator;
use Pyncil\SEO\Favicons;

use Illuminate\Support\ServiceProvider;

class SEOServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('seo', function () {
            return new SEOGenerator();
        });
        
        $this->app->singleton('seo.favicons', function () {
            return new Favicons();
        });

        $this->app->bind(Contracts\SEOGenerator::class, 'seo');
        $this->app->bind(Contracts\Favicons::class, 'seo.favicons');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            Contracts\SEOGenerator::class,
            Contracts\Favicons::class,
            'seo',
            'seo.favicons',
        ];
    }
}
