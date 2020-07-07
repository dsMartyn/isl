<?php
namespace Services\Helpers;

use Services\Contracts\BootableInterface;

class AddOptionsPageToAdmin implements BootableInterface
{

    public function boot()
    {

        if( function_exists('acf_add_options_page') ) {
            acf_add_options_page();
        }

    }


}
