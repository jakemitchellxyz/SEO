<?php

namespace Pyncil\SEO;

use Pyncil\SEO\Contracts\Favicons as FaviconsContract;
use Illuminate\Support\Facades\File;

class Favicons implements FaviconsContract
{
    /**
     * Directory favicons are stored.
     *
     * @var string
     */
    protected $dir;

    /**
     * Colors for certain favicons.
     *
     * @var array
     */
    protected $colors = [];

    /**
     * Sizes of general favicons.
     *
     * @var array
     */
    protected $sizes = [];

    /**
     * Sizes of Apple Touch icons.
     *
     * @var array
     */
    protected $apple_sizes = [];

    /**
     * Sizes of Android icons.
     *
     * @var array
     */
    protected $android_sizes = [];

    /**
     * Configure default settings.
     */
    public function __construct()
    {
        $this->setColors(['safari_pinned' => '#151e4f', 'ms_tile' => '#ffffff', 'theme' => '#151e4f']);
        $this->setSizes(['16x16', '32x32', '96x96', '194x194']);
        $this->setAppleSizes(['60x60', '72x72', '114x114', '120x120', '152x152', '180x180']);
        $this->setAndroidSizes(['192x192']);
    }

    /**
     * Sets the favicons directory.
     *
     * @param string $url
     */
    public function set($url = '/')
    {
        if (ends_with($url, '/')) {
            $this->dir = $url;
        } else {
            $this->dir = $url . '/';
        }

        $this->dir = $url . (!ends_with($url, '/') ? '/' : '');

        return $this;
    }

    /**
     * Set colors for certain favicons.
     *
     * @param array $colors
     */
    public function setColors($colors)
    {
        foreach($colors as $name => $color) {
            $this->colors[$name] = $color;
        }

        return $this;
    }

    /**
     * Set general favicon sizes.
     *
     * @param array $sizes
     */
    public function setSizes($sizes)
    {
        $this->sizes = array_unique(array_merge($this->sizes, $sizes));

        return $this;
    }

    /**
     * Set Apple Touch sizes.
     *
     * @param array $sizes
     */
    public function setAppleSizes($sizes)
    {
        $this->apple_sizes = array_unique(array_merge($this->apple_sizes, $sizes));

        return $this;
    }

    /**
     * Set Android sizes.
     *
     * @param array $sizes
     */
    public function setAndroidSizes($sizes)
    {
        $this->android_sizes = array_unique(array_merge($this->android_sizes, $sizes));

        return $this;
    }

    /**
     * Generate favicon HTML based on existing images.
     *
     * @return string
     */
    public function get()
    {
        $dir = $this->getDir();
        $colors = $this->getColors();

        return !empty($dir) ?
            $this->insertWith($this->getAppleSizes(), function ($insert) use ($dir) {
                    return '<link rel="apple-touch-icon" sizes="' . $insert . '" href="' . asset($dir . 'apple-touch-icon-' . $insert . '.png').'">';
                }, function ($insert) use ($dir) {
                    return File::exists(public_path($dir.'apple-touch-icon-'.$insert.'.png'));
                }) . 
            $this->insertWith($this->getSizes(), function ($insert) use ($dir) {
                    return '<link rel="icon" type="image/png" href="' . asset($dir . 'favicon-' . $insert . '.png').'" sizes="'.$insert.'">';
                }, function ($insert) use ($dir) {
                    return File::exists(public_path($dir.'favicon-'.$insert.'.png'));
                }) . 
            $this->insertWith($this->getAndroidSizes(), function ($insert) use ($dir) {
                    return '<link rel="icon" type="image/png" href="' . asset($dir . 'android-chrome-' . $insert . '.png').'" sizes="'.$insert.'">';
                }, function ($insert) use ($dir) {
                    return File::exists(public_path($dir.'android-chrome-'.$insert.'.png'));
                }) . 
            $this->insertWith($dir.'/manifest.json', function ($insert) {
                    return '<link rel="manifest" href="' . asset($insert) . '">';
                }, function ($insert) {
                    return File::exists(public_path($insert));
                }) . 
            $this->insertWith($dir.'/safari-pinned-tab.svg', function ($insert) use ($colors) {
                    return '<link rel="mask-icon" href="'.asset($insert).'" color="' . $colors['safari_pinned'] . '">';
                }, function ($insert) {
                    return File::exists(public_path($insert));
                }) . 
            $this->insertWith($dir.'/favicon.ico', function ($insert) {
                    return '<link rel="shortcut icon" href="'.asset($insert).'">';
                }, function ($insert) {
                    return File::exists(public_path($insert));
                }) . 
            $this->insertWith($dir.'/mstile-144x144.png', function ($insert) {
                    return '<meta name="msapplication-TileImage" content="'.asset($insert).'">';
                }, function ($insert) {
                    return File::exists(public_path($insert));
                }) . 
            $this->insertWith($dir.'/browserconfig.xml', function ($insert) {
                    return '<meta name="msapplication-config" content="'.asset($insert).'">';
                }, function ($insert) {
                    return File::exists(public_path($insert));
                }) . 
            $this->insertWith($colors['ms_tile'], function ($insert) {
                    return '<meta name="msapplication-TileColor" content="'.$insert.'">';
                }) . 
            $this->insertWith($colors['theme'], function ($insert) {
                    return '<meta name="theme-color" content="'.$insert.'">';
                }) : '';
    }

    /**
     * Gets the favicon directory.
     *
     * @return array
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * Gets the site colors.
     *
     * @return array
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * Gets the general favicon sizes.
     *
     * @return array
     */
    public function getSizes()
    {
        return $this->sizes;
    }

    /**
     * Gets the Apple Touch sizes.
     *
     * @return array
     */
    public function getAppleSizes()
    {
        return $this->apple_sizes;
    }

    /**
     * Gets the Android sizes.
     *
     * @return array
     */
    public function getAndroidSizes()
    {
        return $this->android_sizes;
    }

    /**
     * Insert item if it exists, optional template to insert it into before returning.
     * 
     * @param array|string $insert Item to query
     * @param callable|string $template Template to plug the item into and return
     * @param callable $match Conditions the item must meet to insert
     * 
     * @return string
     */
    public function insertWith($insert, $template = null, $match = null)
    {
        if (!is_null($insert)) { // if item exists
            if (is_array($insert)) { // if more than one item is given
                $ret = ''; // total of all items to return
                foreach ($insert as $in) { // for each item
                    $ret .= $this->insertWith($in, $template, $match); // get the value if it exists
                }
                return $ret; // return total
            }
            if (!is_null($match) && !$match($insert)) { // if a match function is set and item doesn't match
                return ''; // return nothing
            }
            if (!is_null($template)) { // if a template is set
                if (is_callable($template)) { // if the template is a function
                    return $template($insert); // insert value into the function
                }
                return $template; // use the template as a replacement
            }
            return $insert; // else, return the value
        }
        return ''; // if item doesn't exist, return nothing
    }
}
