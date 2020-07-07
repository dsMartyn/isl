<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 08/11/2018
 * Time: 12:00
 */

namespace Services\Helpers;

use Services\Contracts\BootableInterface;

/**
 * Class ImageSizes
 * @package Services\Helpers
 */
class ImageSizes implements BootableInterface
{

    /**
     * @var mixed|string
     */
    protected $theme_file_path = '';

    /**
     *
     */
    public function boot()
    {

        $this->theme_file_path = $this->getThemePath();

        $this->setupImageSizes( $this->theme_file_path . '/Src/Helpers/ImageSizes.php' );

    }

    /**
     * @param $path
     */
    public function setupImageSizes($path)
    {

        // get the image sizes
        $sizes = require $path;

        foreach ($sizes as $size) {

            add_image_size($size['name'], $size['width'], $size['height'], $size['crop']);

        }

    }

    /**
     * @return mixed
     */
    private function getThemePath()
    {

        return \App\sage('config')['theme.dir'];

    }

}
