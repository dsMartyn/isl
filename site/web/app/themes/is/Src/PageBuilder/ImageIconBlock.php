<?php

namespace App\VisualComposer;

class ImageIconBlock extends \WPBakeryShortCode {

    public function __construct(  ) {

        add_action( 'init', array( $this, 'image_icon_block' ) );
        add_shortcode( 'image_icon_block', array( $this, 'image_icon_block_html' ) );

    }

    public function image_icon_block() {

        $vc_globals = vc_globals();

        vc_map( array(
            "base" => "image_icon_block",
            "name" => __( "Icon Block - Image", "js_composer" ),
            "class" => "",
            'icon' => 'icon-wpb-atm',
            "category" => $vc_globals['dev'],
            "params" => array(
                array(
                    'type' => 'attach_image',
                    'heading' => "Image",
                    'param_name' => 'image',
                    'value' => '',
                    'description' => "Chose an image.",
                    'admin_label' => false,
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => "Icon",
                    'param_name' => 'icon',
                    'value' => '',
                    'description' => "Chose an image for the icon.",
                    'admin_label' => false,
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => 'Title',
                    "param_name" => "title",
                    "value" => '',
                    'admin_label' => true,
                    "description" => ''
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => 'Link',
                    "param_name" => "link",
                    "value" => '',
                    'admin_label' => true,
                    "description" => ''
                ),
                $vc_globals['target_link'],
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => 'Match Height?',
                    "param_name" => "match",
                    "value" => '',
                    'admin_label' => true,
                    "description" => 'Puts the element into a group with all other similarly named elements. They all take the same height as the largest one.'
                ),


            )
        ) );

    }

    public function image_icon_block_html( $atts, $content = NULL ) {

        extract(shortcode_atts(array(
            'image' => '',
            'icon' => '',
            'title' => '',
            'link' => '',
            'target' => '',
            'match' => '',
        ), $atts));

        ob_start();

        $img = wp_get_attachment_image_src($image, 'icon_box_bg');
        $icon = wp_get_attachment_image_src($icon, 'icon');

        $mh = ""; $datamh = "";

        if ($match != "") {
            $mh = " match-height-group";
            $datamh = ' data-mh-group="'.$match.'"';
        }

        ?>
        <div class="icon-block-image<?php echo $mh;?>"<?php echo $datamh;?>>

            <?php if ($link != "") { ?>
                <a href="<?php echo $link;?>" title="<?php echo str_replace("<br>", " ", $title);?>">
            <?php } ?>

            <img src="<?php echo $img[0];?>" alt="<?php echo $title;?>" class="img-fluid">

            <span class="icon">
                <img src="<?php echo $icon[0];?>" alt="<?php echo $title;?>" class="img-fluid">
            </span>

            <h4><?php echo $title;?></h4>

            <?php if ($link != "") { ?>
                </a>
            <?php } ?>

        </div>
        <?php

        $html = ob_get_contents();
        ob_end_clean();

        return $html;

    }

}


