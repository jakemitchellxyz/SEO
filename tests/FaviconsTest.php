<?php

namespace Pyncil\SEO\Tests;

use Pyncil\SEO\SEOGenerator;
use Pyncil\SEO\Favicons;

/**
 * Class FaviconsTest.
 */
class FaviconsTest extends BaseTest
{
    /**
     * @var SEOGenerator
     */
    protected $seo;

    /**
     * @var Favicons
     */
    protected $favicons;
    
    public function setUp()
    {
        parent::setUp();

        $this->seo = $this->app->make('seo');
        $this->favicons = $this->seo->favicons();
    }
    
    public function test_getter()
    {
        $this->assertEquals($this->favicons->get(), "");
        
        $this->favicons->set();
        $this->assertEquals($this->favicons->get(), "<meta name=\"msapplication-TileColor\" content=\"#ffffff\"><meta name=\"theme-color\" content=\"#151e4f\">");
    }
}
