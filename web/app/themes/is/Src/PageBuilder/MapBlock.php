<?php

namespace App\VisualComposer;

class MapBlock extends \WPBakeryShortCode {

    public function __construct(  ) {

        add_action( 'init', array( $this, 'map_block' ) );
        add_shortcode( 'map_block', array( $this, 'map_block_html' ) );

    }

    public function map_block() {

        $vc_globals = vc_globals();

        vc_map( array(
            "base" => "map_block",
            "name" => __( "Map Block", "js_composer" ),
            "class" => "",
            'icon' => 'icon-wpb-atm',
            "category" => $vc_globals['dev'],
            "params" => array(
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => 'Title',
                    "param_name" => "title",
                    "value" => '',
                    'admin_label' => true,
                    "description" => ''
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => 'Address',
                    "param_name" => "address",
                    "value" => '',
                    'admin_label' => true,
                    "description" => ''
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => 'Map iFrame',
                    "param_name" => "iframe",
                    "value" => '',
                    'admin_label' => true,
                    "description" => 'Enter the url that google provides for embedding, for example: https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6304.829986131271!2d-122.4746968033092!'
                ),
            )
        ) );

    }

    public function map_block_html( $atts, $content = NULL ) {

        extract(shortcode_atts(array(
            'title' => 'Address',
            'address' => '',
            'iframe' => '',
        ), $atts));


        ob_start();

        ?>
        <div class="contact-block">
            <div class="row">
                <div class="col-sm-6">
                    <div class="wpb_gmaps_widget wpb_content_element vc_map_responsive">
                        <div class="wpb_wrapper">
                            <div class="wpb_map_wraper map-block">
                                <iframe src="<?php echo $iframe;?>" style="display: block; border: 0px none; pointer-events: none;" allowfullscreen="" frameborder="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <h4><?php echo $title; ?></h4>
                    <span class="red-line"></span>
                    <?php echo $address;?>
                </div>
            </div>
        </div>
        <?php


        $html = ob_get_contents();
        ob_end_clean();

        return $html;

    }

}


