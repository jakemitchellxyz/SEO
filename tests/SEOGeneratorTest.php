<?php

namespace Pyncil\SEO\Tests;

use Pyncil\SEO\SEOGenerator;

/**
 * Class SEOGeneratorTest.
 */
class SEOGeneratorTest extends BaseTest
{
    /**
     * @var SEOGenerator
     */
    protected $seo;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->seo = $this->app->make('seo');
    }

    public function test_it_returns_true()
    {
        $this->assertTrue(true);
    }
}
