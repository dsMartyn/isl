<?php

if ( class_exists( 'Vc_Manager' ) ) {

    $vc_includes = [
        'MapBlock.php',          // Map Block
        'ImageIconBlock.php',    // Image Icon Block
        'NoImageIconBlock.php',  // No Image Icon Block
        'GreenDividerBlock.php', // Green Divider
    ];

    foreach ($vc_includes as $file) {
        require_once $file;
    }

    new \App\VisualComposer\MapBlock();
    new \App\VisualComposer\ImageIconBlock();
    new \App\VisualComposer\NoImageIconBlock();
    new \App\VisualComposer\GreenDividerBlock();

    function vc_globals() {

        $vc_globals = array();

        $vc_globals['dev'] = "Epic";

        $vc_globals['layout_sub_controls'] = array(
            array( 'link', __( 'Link', 'js_composer' ) ),
            array( 'no_link', __( 'No link', 'js_composer' ) ),
        );

        $vc_globals['target_link'] = array(
            'type' => 'dropdown',
            'heading' => 'Target',
            'param_name' => 'target',
            'value' => array('Same Window' =>'_self', 'New Window' =>'_blank'),
            'description' => 'Choose to open in new window.'
        );

        $vc_globals['orientation'] = array(
            'type' => 'dropdown',
            'heading' => 'Orientation',
            'param_name' => 'orientation',
            'value' => array('Horizontal' =>'horizontal', 'Vertical' =>'vertical'),
            'description' => 'Choose the orientation.'
        );

        return $vc_globals;

    }

    function remove_vc_meta() {
        remove_action('wp_head', array(visual_composer(), 'addMetaData'));
    }
    add_action('init', 'remove_vc_meta', 100);
}
