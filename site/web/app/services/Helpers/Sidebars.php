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
class Sidebars implements BootableInterface
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

        add_filter('sage/display_sidebar', function() {

            return $this->setupSidebars();

        }, 9999);

    }


    /**
     * @param $path
     * @return bool
     */
    public function setupSidebars()
    {

        $path = $this->theme_file_path . '/Src/Helpers/Sidebars.php';

        $sidebars = require $path;

        $display = false;

        foreach ($sidebars as $sidebar) {

            if ($sidebar) {

                $display = true;

            }

        }

        if ($display) {
            add_filter( 'body_class',function() {

                $classes[] = 'has-sidebar';

                return $classes;

            });
        }

        return $display;

    }

    /**
     * @return mixed
     */
    private function getThemePath()
    {

        return \App\sage('config')['theme.dir'];

    }

}
