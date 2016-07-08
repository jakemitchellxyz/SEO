<?php

namespace Pyncil\SEO;

use Pyncil\SEO\Contracts\SEOGenerator as SEOContract;

class SEOGenerator implements SEOContract
{
    /**
     * The meta title.
     *
     * @var string
     */
    protected $title;

    /**
     * The title subline.
     *
     * @var string
     */
    protected $title_subline;

    /**
     * The title separator.
     *
     * @var array
     */
    protected $title_separator;

    /**
     * The meta description.
     *
     * @var string
     */
    protected $description;

    /**
     * The meta keywords.
     *
     * @var array
     */
    protected $keywords = [];

    /**
     * The canonical URL.
     *
     * @var string
     */
    protected $canonical;
    
    /**
     * Robots (in place of robots.txt).
     *
     * @var string
     */
    protected $robots;

    /**
     * The previous URL in pagination.
     *
     * @var string
     */
    protected $prev;

    /**
     * The next URL in pagination.
     *
     * @var string
     */
    protected $next;

    /**
     * Extra metatags.
     *
     * @var array
     */
    protected $metatags = [];

    /**
     * Generate from all seo providers.
     * 
     * @param bool $minify
     * 
     * @return string
     */
    public function generate($minify = true)
    {
        $html = $this->generateTags();

        return ($minify) ? str_replace(PHP_EOL, '', $html) : $html;
    }

    /**
     * Generates meta tags.
     *
     * @return string
     */
    public function generateTags()
    {
        $tags = [
            $this->getTitle(), // title
            $this->getDescription(), // description
            $this->getKeywords(), // keywords
            $this->getCanonical(), // canonical URL
            $this->getRobots(), // robots
            $this->getPrev(), // previous URL
            $this->getNext(), // next URL
            $this->getMetatags(), // additional meta tags
        ];

        return implode(PHP_EOL, $tags);
    }

    /**
     * Sets the title.
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = strip_tags($title);

        return $this;
    }

    /**
     * Sets the title subline.
     *
     * @param string $subline
     */
    public function setTitleSubline($subline)
    {
        $this->title_subline = strip_tags($subline);

        return $this;
    }

    /**
     * Sets the separator for the title tag.
     *
     * @param string $separator
     *
     * @return MetaTagsContract
     */
    public function setTitleSeparator($separator)
    {
        $this->title_separator = $separator;

        return $this;
    }

    /**
     * Sets the meta description.
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = strip_tags($description);

        return $this;
    }

    /**
     * Add a keyword.
     *
     * @param string $keyword
     */
    public function addKeyword($keyword)
    {
        $this->keywords[] = strip_tags($keyword);

        return $this;
    }
    
    /**
     * Add multiple keywords.
     *
     * @param string|array $keywords
     */
    public function addKeywords($keywords)
    {
        if (!is_array($keywords)) {
            $keywords = array_map('trim', explode(',', $keywords));
        }
        
        $this->keywords = array_merge($this->keywords, array_map('strip_tags', $keywords));

        return $this;
    }

    /**
     * Remove a keyword.
     *
     * @param string $key
     */
    public function removeKeyword($key)
    {
        array_forget($this->keywords, $key);

        return $this;
    }

    /**
     * Sets the list of keywords: overrides existing keywords.
     *
     * @param string|array $keywords
     */
    public function setKeywords($keywords)
    {
        if (!is_array($keywords)) {
            $keywords = array_map('trim', explode(',', $keywords));
        }

        $this->keywords = array_map('strip_tags', $keywords);

        return $this;
    }

    /**
     * Sets the canonical URL.
     *
     * @param string $url
     */
    public function setCanonical($url)
    {
        $this->canonical = $url;

        return $this;
    }
    
    /**
     * Sets robots.
     *
     * @param string $robots
     */
    public function setRobots($robots = 'index,follow')
    {
        $this->robots = $robots;

        return $this;
    }

    /**
     * Sets the previous URL (for pagination).
     *
     * @param string $url
     */
    public function setPrev($url)
    {
        $this->prev = $url;

        return $this;
    }

    /**
     * Sets the next URL (for pagination).
     *
     * @param string $url
     */
    public function setNext($url)
    {
        $this->next = $url;

        return $this;
    }

    /**
     * Add a custom meta tag(s).
     *
     * @param string|array $meta
     * @param string       $value
     * @param string       $name
     */
    public function addMeta($meta, $value = null, $name = 'name')
    {
        if (is_array($meta)) {
            foreach ($meta as $key => $value) {
                $this->metatags[$key] = [$name, $value];
            }
        } else {
            $this->metatags[$meta] = [$name, $value];
        }

        return $this;
    }

    /**
     * Remove a meta tag.
     *
     * @param string $key
     */
    public function removeMeta($key)
    {
        array_forget($this->metatags, $key);

        return $this;
    }

    /**
     * Gets the title and subline if necessary.
     *
     * @return string
     */
    public function getTitle()
    {
        return "<title>" . ($this->title ?: '') . $this->getTitleSubline() . "</title>";
    }

    /**
     * Gets the title subline.
     *
     * @return string
     */
    public function getTitleSubline()
    {
        return !empty($this->title_subline) ? $this->title_subline . $this->getTitleSeparator() : '';
    }
    
    /**
     * Gets the title separator.
     *
     * @return string
     */
    public function getTitleSeparator()
    {
        return $this->title_separator ?: ' &#8211; ';
    }
    
    /**
     * Gets the meta description.
     *
     * @return string
     */
    public function getDescription()
    {
        return "<meta name=\"description\" content=\"" . $this->description . "\">";
    }

    /**
     * Get the meta keywords.
     *
     * @return string
     */
    public function getKeywords()
    {
        return !empty($this->keywords) ? "<meta name=\"keywords\" content=\"" . implode(', ', $this->keywords) . "\">" : '';
    }

    /**
     * Gets the canonical URL.
     *
     * @return string
     */
    public function getCanonical()
    {
        return "<link rel=\"canonical\" href=\"" . ($this->canonical ?: app('url')->current()) . "\"/>";
    }
    
    /**
     * Gets the robots.
     *
     * @return string
     */
    public function getRobots()
    {
        return !empty($this->robots) ? "<meta name=\"robots\" content=\"" . $this->robots . "\">" : '';
    }

    /**
     * Gets the prev URL.
     *
     * @return string
     */
    public function getPrev()
    {
        return !empty($this->prev) ? "<link rel=\"prev\" href=\"" . $this->prev . "\"/>" : '';
    }

    /**
     * Gets the next URL.
     *
     * @return string
     */
    public function getNext()
    {
        return !empty($this->next) ? "<link rel=\"next\" href=\"" . $this->next . "\"/>" : '';
    }

    /**
     * Get extra meta tags.
     *
     * @return string
     */
    public function getMetatags()
    {
        $metatags = [];

        foreach ($this->metatags as $key => $value) {
            $name = $value[0];
            $content = $value[1];

            // if $content is empty, skip tag
            if (empty($content)) {
                continue;
            }

            $metatags[] = "<meta {$name}=\"{$key}\" content=\"{$content}\">";
        }

        return implode(PHP_EOL, $metatags);
    }
}
