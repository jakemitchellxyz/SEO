<?php

namespace Pyncil\SEO\Contracts;

interface Favicons
{
    /**
     * Configure default settings.
     */
    public function __construct();
    
    /**
     * Sets the favicons directory.
     *
     * @param string $url
     */
    public function set($url = '/');
    
    /**
     * Set colors for certain favicons.
     *
     * @param array $colors
     */
    public function setColors($colors);
    
    /**
     * Set general favicon sizes.
     *
     * @param array $sizes
     */
    public function setSizes($sizes);
    
    /**
     * Set Apple Touch sizes.
     *
     * @param array $sizes
     */
    public function setAppleSizes($sizes);
    
    /**
     * Set Android sizes.
     *
     * @param array $sizes
     */
    public function setAndroidSizes($sizes);
    
    /**
     * Generate favicon HTML based on existing images.
     *
     * @param string $dir Directory the favicons exist in
     *
     * @return string
     */
    public function get();
    
    /**
     * Gets the favicon directory.
     *
     * @return array
     */
    public function getDir();
    
    /**
     * Gets the site colors.
     *
     * @return array
     */
    public function getColors();
    
    /**
     * Gets the general favicon sizes.
     *
     * @return array
     */
    public function getSizes();
    
    /**
     * Gets the Apple Touch sizes.
     *
     * @return array
     */
    public function getAppleSizes();
    
    /**
     * Gets the Android sizes.
     *
     * @return array
     */
    public function getAndroidSizes();
    
    /**
     * Insert item if it exists, optional template to insert it into before returning.
     * 
     * @param array|string $insert Item to query
     * @param callable|string $template Template to plug the item into and return
     * @param callable $match Conditions the item must meet to insert
     * 
     * @return string
     */
    public function insertWith($insert, $template = null, $match = null);
}
