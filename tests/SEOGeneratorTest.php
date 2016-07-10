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
    
    public function setUp()
    {
        parent::setUp();

        $this->seo = $this->app->make('seo');
    }
    
    public function test_getter()
    {
        $this->assertEquals($this->seo->get(), "<title></title><meta name=\"description\" content=\"\">");
        $this->assertEquals($this->seo->get(false), "<title></title>".PHP_EOL."<meta name=\"description\" content=\"\">".PHP_EOL);
        
        $this->seo->setTitle('Page Title');
        $this->seo->setSubtitle('Subtitle');
        $expectTitle = "<title>Page Title &#8211; Subtitle</title>";
        
        $this->seo->setDescription('Hello, World!');
        $expectDescription = "<meta name=\"description\" content=\"Hello, World!\">";
        
        $this->seo->setKeywords(['hello', 'world', 'pyncil', 'seo']);
        $expectKeywords = "<meta name=\"keywords\" content=\"hello, world, pyncil, seo\">";
        
        $this->seo->setCanonical();
        $expectCanonical = "<link rel=\"canonical\" href=\"http://localhost\"/>";
        
        $this->seo->setRobots();
        $expectRobots = "<meta name=\"robots\" content=\"index,follow\">";
        
        $this->assertEquals($this->seo->get(), $expectTitle.$expectDescription.$expectKeywords.$expectCanonical.$expectRobots);
    }
    
    public function test_title()
    {
        $this->assertEquals($this->seo->getTitle(), "<title></title>");
        
        $this->seo->setTitle('Page Title');
        $this->assertEquals($this->seo->getTitle(), "<title>Page Title</title>");
        
        $this->seo->setSubtitle('Subtitle');
        $this->assertEquals($this->seo->getTitle(), "<title>Page Title &#8211; Subtitle</title>");
        
        $this->seo->setTitleSeparator(' | ');
        $this->assertEquals($this->seo->getTitle(), "<title>Page Title | Subtitle</title>");
    }
    
    public function test_description()
    {
        $this->assertEquals($this->seo->getDescription(), "<meta name=\"description\" content=\"\">");
        
        $this->seo->setDescription('Hello, World!');
        $this->assertEquals($this->seo->getDescription(), "<meta name=\"description\" content=\"Hello, World!\">");
    }
    
    public function test_keywords()
    {
        $this->assertEquals($this->seo->getKeywords(), "");
        
        $this->seo->setKeywords(['hello', 'world', 'pyncil', 'seo']);
        $this->assertEquals($this->seo->getKeywords(), "<meta name=\"keywords\" content=\"hello, world, pyncil, seo\">");
        
        $this->seo->setKeywords('dog, cat, fish, pig');
        $this->assertEquals($this->seo->getKeywords(), "<meta name=\"keywords\" content=\"dog, cat, fish, pig\">");
        
        $this->seo->addKeyword('potato')
                    ->addKeyword('test')
                    ->addKeyword('new')
                    ->addKeyword('kid');
        $this->assertEquals($this->seo->getKeywords(), "<meta name=\"keywords\" content=\"dog, cat, fish, pig, potato, test, new, kid\">");
        
        $this->seo->setKeywords(['hello', 'world', 'pyncil', 'seo']);
        $this->assertEquals($this->seo->getKeywords(), "<meta name=\"keywords\" content=\"hello, world, pyncil, seo\">");
        
        $this->seo->addKeywords(['potato', 'test'])
                    ->addKeywords('new, kid');
        $this->assertEquals($this->seo->getKeywords(), "<meta name=\"keywords\" content=\"hello, world, pyncil, seo, potato, test, new, kid\">");
    }
    
    public function test_canonical()
    {
        $this->assertEquals($this->seo->getCanonical(), "");
        
        $this->seo->setCanonical();
        $this->assertEquals($this->seo->getCanonical(), "<link rel=\"canonical\" href=\"http://localhost\"/>");
        
        $this->seo->setCanonical('http://totallyfakelol.com/srsly');
        $this->assertEquals($this->seo->getCanonical(), "<link rel=\"canonical\" href=\"http://totallyfakelol.com/srsly\"/>");
    }
    
    public function test_robots()
    {
        $this->assertEquals($this->seo->getRobots(), "");
        
        $this->seo->setRobots();
        $this->assertEquals($this->seo->getRobots(), "<meta name=\"robots\" content=\"index,follow\">");
        
        $this->seo->setRobots('noindex,nofollow');
        $this->assertEquals($this->seo->getRobots(), "<meta name=\"robots\" content=\"noindex,nofollow\">");
    }
    
    public function test_viewport()
    {
        $this->assertEquals($this->seo->getViewport(), "");
        
        $this->seo->setViewport();
        $this->assertEquals($this->seo->getViewport(), "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">");
        
        $this->seo->setViewport('width=device-width, initial-scale=1, maximum-width=1');
        $this->assertEquals($this->seo->getViewport(), "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-width=1\">");
    }
    
    public function test_previous()
    {
        $this->assertEquals($this->seo->getPrev(), "");
        
        $this->seo->setPrev('http://somelistofarticals.com/article/1');
        $this->assertEquals($this->seo->getPrev(), "<link rel=\"prev\" href=\"http://somelistofarticals.com/article/1\"/>");
    }
    
    public function test_next()
    {
        $this->assertEquals($this->seo->getNext(), "");
        
        $this->seo->setNext('http://somelistofarticals.com/article/3');
        $this->assertEquals($this->seo->getNext(), "<link rel=\"next\" href=\"http://somelistofarticals.com/article/3\"/>");
    }
    
    public function test_custom_metatags()
    {
        $this->assertEquals($this->seo->getMeta(), "");
        
        $this->seo->addMeta('author', 'Jake Mitchell');
        $this->assertEquals($this->seo->getMeta(), "<meta name=\"author\" content=\"Jake Mitchell\">");
        
        $this->seo->addMeta('viewport', 'width=device-width, initial-scale=1');
        $this->assertEquals($this->seo->getMeta(), "<meta name=\"author\" content=\"Jake Mitchell\">" . PHP_EOL . "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">");
        
        $this->seo->removeMeta('author');
        $this->assertEquals($this->seo->getMeta(), "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">");
        
        $this->seo->removeMeta('viewport');
        $this->seo->addMeta('refresh', '300', 'http-equiv');
        $this->assertEquals($this->seo->getMeta(), "<meta http-equiv=\"refresh\" content=\"300\">");
    }
}
