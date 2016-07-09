<?php

namespace Pyncil\SEO\Contracts;

interface SEOGenerator
{
    /**
     * Generate from all seo providers.
     * 
     * @param bool $minify
     * 
     * @return string
     */
    public function generate($minify = true);

    /**
     * Generates meta tags.
     *
     * @return string
     */
    public function generateTags();

    /**
     * Sets the title.
     *
     * @param string $title
     */
    public function setTitle($title);

    /**
     * Sets the title subtitle.
     *
     * @param string $subtitle
     */
    public function setSubtitle($subtitle);

    /**
     * Sets the separator for the title tag.
     *
     * @param string $separator
     */
    public function setTitleSeparator($separator);

    /**
     * Sets the meta description.
     *
     * @param string $description
     */
    public function setDescription($description);

    /**
     * Add a keyword.
     *
     * @param string $keyword
     */
    public function addKeyword($keyword);

    /**
     * Add multiple keywords.
     *
     * @param string|array $keywords
     */
    public function addKeywords($keywords);

    /**
     * Remove a keyword.
     *
     * @param string $key
     */
    public function removeKeyword($key);

    /**
     * Sets the list of keywords: overrides existing keywords.
     *
     * @param string|array $keywords
     */
    public function setKeywords($keywords);

    /**
     * Sets the canonical URL.
     *
     * @param string $url
     */
    public function setCanonical($url);

    /**
     * Sets robots.
     *
     * @param string $robots
     */
    public function setRobots($robots = 'index,follow');

    /**
     * Sets the viewport for mobile.
     *
     * @param string $viewport
     */
    public function setViewport($viewport = 'width=device-width, initial-scale=1');

    /**
     * Sets the previous URL (for pagination).
     *
     * @param string $url
     */
    public function setPrev($url);

    /**
     * Sets the next URL (for pagination).
     *
     * @param string $url
     */
    public function setNext($url);

    /**
     * Add a custom meta tag(s).
     *
     * @param string|array $meta
     * @param string       $value
     * @param string       $name
     */
    public function addMeta($meta, $value = null, $name = 'name');

    /**
     * Remove a meta tag.
     *
     * @param string $key
     */
    public function removeMeta($key);

    /**
     * Gets the title and subtitle if necessary.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Gets the title subtitle.
     *
     * @return string
     */
    public function getSubtitle();

    /**
     * Gets the title separator.
     *
     * @return string
     */
    public function getTitleSeparator();

    /**
     * Gets the meta description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get the meta keywords.
     *
     * @return string
     */
    public function getKeywords();

    /**
     * Gets the canonical URL.
     *
     * @return string
     */
    public function getCanonical();

    /**
     * Gets the robots.
     *
     * @return string
     */
    public function getRobots();

    /**
     * Gets the viewport.
     *
     * @return string
     */
    public function getViewport();

    /**
     * Gets the prev URL.
     *
     * @return string
     */
    public function getPrev();

    /**
     * Gets the next URL.
     *
     * @return string
     */
    public function getNext();

    /**
     * Get extra meta tags.
     *
     * @return string
     */
    public function getMeta();

}
