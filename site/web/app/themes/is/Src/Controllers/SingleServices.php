<?php

namespace Src\Controllers;

use Sober\Controller\Controller;

class SingleServices extends Controller
{

    public function __construct()
    {


    }

    public function __before()
    {

        parent::__before(); // TODO: Change the autogenerated stub

    }

    public function header()
    {

        return self::format_header(self::get_fields());

    }

    public function tabs()
    {

        return self::format_tabs(self::get_fields());

    }

    private function get_fields()
    {

        return get_fields(get_the_ID());

    }

    private function format_header($fields)
    {

        $post_id = get_the_ID();

        $term = wp_get_post_terms( $post_id, 'service_type', array( 'fields' => 'names' ) );

        $formatted_fields = [
            'title' => get_the_title($post_id),
            'type' => $term[0],
            'intro' => $fields['service_introduction_content'],
            'desktop_image' => ($fields['service_desktop_image'] == "") ? 'https://placehold.it/1200x653' : $fields['service_desktop_image']['sizes']['service_desktop'],
            'mobile_image' => ($fields['service_mobile_image'] == "") ? 'https://placehold.it/768x768' : $fields['service_mobile_image']['sizes']['service_mobile'],
        ];

        return $formatted_fields;

    }

    private function format_tabs($fields)
    {

        $tabs = [];

        if (is_array($fields['service_tabs'])) {

            foreach ($fields['service_tabs'] as $service_tab) {

                $icons = [];

                if (is_array($service_tab['service_tab_icons'])) {

                    foreach ($service_tab['service_tab_icons'] as $tab_icon) {

                        $icon_image = $tab_icon['service_tab_icons_image']['sizes']['service_icon'];

                        $icons[] = [
                            'image' => /*($icon_image == "") ? 'https://placehold.it/115x115' : */$icon_image,
                            'title' => $tab_icon['service_tab_icons_title'],
                            'content' => $tab_icon['service_tab_icons_content'],
                        ];

                    }

                }

                $tabs[] = [
                    'title' => $service_tab['service_tab_title'],
                    'content_heading' => $service_tab['service_tab_content_heading'],
                    'content_top' => $service_tab['service_tab_content_top'],
                    'icons' => $icons,
                    'content_bottom' => $service_tab['service_tab_content_bottom'],
                ];

            }

        }

        return $tabs;

    }

}
