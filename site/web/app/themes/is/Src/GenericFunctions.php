<?php

// include any Tiny MCE shortcodes that are built
$shortcodes = [
    'Downloads',
];

foreach ($shortcodes as $shortcode) {
    include_once "Shortcodes/" . $shortcode . "/" . $shortcode . ".php";
}

// remove the active class from the home link
function remove_active_from_home($classes, $item) {
    static $current_class_already_added = false;

    if (in_array('active', $classes)) {

        if (in_array('menu-about-us', $classes)) {
            unset($classes[array_search('active', $classes)]);
        }

    }
    return $classes;
}
add_filter('nav_menu_css_class' , 'remove_active_from_home' , 99 , 2);


// remove the continue reading link from news excerpts
function new_excerpt_more($more) {
    global $post;
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


// shorten the standard excerpt
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );
