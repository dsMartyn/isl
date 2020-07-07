<?php

namespace App\VisualComposer;

class GreenDividerBlock extends \WPBakeryShortCode {

    public function __construct(  ) {

        add_action( 'init', array( $this, 'green_divider_block' ) );
        add_shortcode( 'green_divider_block', array( $this, 'green_divider_block_html' ) );

    }

    public function green_divider_block() {

        $vc_globals = vc_globals();

        vc_map( array(
            "base" => "green_divider_block",
            "name" => __( "Green Divider", "js_composer" ),
            "class" => "",
            'icon' => 'icon-wpb-atm',
            "category" => $vc_globals['dev'],
            "params" => array()
        ) );

    }

    public function green_divider_block_html( $atts, $content = NULL ) {

        return '<div class="green-separator"></div>';

    }

}


