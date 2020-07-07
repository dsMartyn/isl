<?php

use Services\Exceptions\InvalidContainerKeyException;

// BOOT THE SYSTEM
(new Services\Bootstrap\App())->boot();

// set the namespace for our custom controllers
add_filter('sober/controller/namespace', function () {
    return 'Src\Controllers';
});

// add the admin ajax url
add_action('wp_enqueue_scripts', function () {
    wp_localize_script('sage/main.js', 'is_ajax', array(
        'url' => admin_url('admin-ajax.php'),
        'site_url' => get_bloginfo('url'),
        'theme_url' => get_bloginfo('template_directory')
    ));
}, 110);

// add the generic functions file
include_once App\sage('config')['theme.dir'] . "/Src/GenericFunctions.php";

// add the Page Builder blocks
include_once App\sage('config')['theme.dir'] . "/Src/PageBuilder/PageBuilderMap.php";

// add the Geoquery clss
//include_once App\sage('config')['theme.dir'] . "/Src/Geoquery.php";



// HELPER GLOBAL FUNCTIONS

// Get something fron the Container
function getFromContainer($key) {

    $container = \App\sage()::getInstance();

    if (!$container->has($key)) {

        throw new InvalidContainerKeyException($key . ' does not exist in the container.');

    }

    return $container[$key];

}

// Session
function session($key = null, $default = null)
{

    $session = getFromContainer('session');

    if (is_null($key)) {
        return $session;
    }
    if (is_array($key)) {
        $session->put($key);
        $session->save();
        return $session;
    }

    return $session->get($key, $default);

}

function sessionForget($key = null)
{

    $session = getFromContainer('session');

    if (!is_array($key)) {
        $session->forget($key);
        $session->save();
    }

    return $session;

}


// Print R with Pre wrapper
function _p($data, $exit = false) {

    echo "<pre>";
    print_r($data);
    echo "</pre>";

    if ($exit) {
        exit();
    }

}


/*
echo "<pre>";
print_r(App\sage('config'));
echo "</pre>";
*/

/*
global $wp_filter;
echo '<pre>';
var_dump( $wp_filter );
echo '</pre>';*/
/*
add_action( 'wp_footer', 'list_comment_filters' );

function list_comment_filters()
{
    global $wp_filter;

    $comment_filters = array ();
    $h1  = '<h1>Current Comment Filters</h1>';
    $out = '';
    $toc = '<ul>';

    foreach ( $wp_filter as $key => $val )
    {
        if ( FALSE !== strpos( $key, 'sidebar' ) )
        {
            $comment_filters[$key][] = var_export( $val, TRUE );
        }
    }

    foreach ( $comment_filters as $name => $arr_vals )
    {
        $out .= "<h2 id=$name>$name</h2><pre>" . implode( "\n\n", $arr_vals ) . '</pre>';
        $toc .= "<li><a href='#$name'>$name</a></li>";
    }

    print "$h1$toc</ul>$out";
}

*/

/*
add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login

function my_front_end_login_fail( $username ) {
    $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
    // if there's a valid referrer, and it's not the default log-in screen
    if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
        wp_redirect( $referrer . '?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
        exit;
    }
}
*/

// Move Yoast to bottom
function yoasttobottom() {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

/**
 * Modify posts on Case Studies Archive page
 */
function case_studies_archive_get_posts( $query ) {

	// do not modify queries in the admin
	if( is_admin() ) {

		return $query;

	}

	// only modify queries for 'case studies' post type on Archive that are also the main query
	if( is_post_type_archive( 'case_studies' ) && $query->is_main_query() && isset($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'case_studies' ) {

        // Show only posts that are not set as featured
		$query->set('meta_query', [
            [
                'key' => 'set_as_featured',
                'value' => 0,
                'compare' => '=='
            ]
        ]);
	}

	// return
	return $query;

}
add_action('pre_get_posts', 'case_studies_archive_get_posts');

/**
 * Populate dropdown field on Careers gravity form with career post titles.
 */
add_filter( 'gform_pre_render_2', 'populate_careers' );
add_filter( 'gform_pre_validation_2', 'populate_careers' );
add_filter( 'gform_pre_submission_filter_2', 'populate_careers' );
add_filter( 'gform_admin_pre_render_2', 'populate_careers' );

function populate_careers( $form ) {

    foreach ( $form['fields'] as &$field ) {

        if ( $field->type != 'select' || strpos( $field->cssClass, 'populate-careers' ) === false ) {
            continue;
        }

        // you can add additional parameters here to alter the posts that are retrieved
        // more info: http://codex.wordpress.org/Template_Tags/get_posts
        $posts = get_posts( 'numberposts=-1&post_status=publish&post_type=career' );

        $choices = array();

        foreach ( $posts as $post ) {
            $choices[] = array( 'text' => $post->post_title, 'value' => $post->post_title );
        }

        // update 'Select a Post' to whatever you'd like the instructive option to be
        $field->placeholder = 'Select';
        $field->choices = $choices;

    }

    return $form;
}
