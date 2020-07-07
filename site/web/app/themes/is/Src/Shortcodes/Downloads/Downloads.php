<?php


// set of functions to add a downloads button to the MCE Editor in the admin panel

function ls_downloads_function($atts, $content = null) {

    extract(shortcode_atts(array(
        'file' => '',
    ), $atts));

    if ($file) {

        $title = get_the_title($file);
        $download = get_field('download', $file);

        $output = "<a href='".$download."' target='_blank' title='".$title."'>".$content."</a>";

    }

    return $output;

}
add_shortcode('ls-downloads', 'ls_downloads_function');


function add_downloads_css() {

    wp_enqueue_style('shortcodes_downloads_css', get_template_directory_uri() . "/../Src/Shortcodes/Downloads/Downloads.css");

}

function add_downloads_js( $plugin_array ) {

    $plugin_array['downloads'] = get_template_directory_uri() . "/../Src/Shortcodes/Downloads/Downloads.js";

    return $plugin_array;

}

function register_downloads_button( $buttons ) {

    array_push( $buttons, "|", "downloads" );

    return $buttons;

}

function mce_downloads_button() {

    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
        return;
    }

    if ( get_user_option('rich_editing') == 'true' ) {
        add_action( 'admin_enqueue_scripts', 'add_downloads_css' );
        add_filter( 'mce_external_plugins', 'add_downloads_js' );
        add_filter( 'mce_buttons', 'register_downloads_button' );
    }

}

add_action('admin_init', 'mce_downloads_button');

function get_downloads() {

    $args = array(
        'post_type' => array('download'),
        'post_status' => array('publish'),
        'posts_per_page' => -1,
        'nopaging' => true,
        'order' => 'ASC',
        'orderby' => 'title',
    );

    $posts = get_posts( $args );

    $downloads = [];

    $downloads[] = [
        'text' => "Choose Download",
        'value' => "",
    ];

    foreach ($posts as $post) {

        $downloads[] = [
            'text' => $post->post_title,
            'value' => $post->ID,
        ];

    }


    echo json_encode( $downloads );

    exit;
}

// Fire AJAX action for both logged in and non-logged in users
add_action('wp_ajax_get_downloads', 'get_downloads');
add_action('wp_ajax_nopriv_get_downloads', 'get_downloads');