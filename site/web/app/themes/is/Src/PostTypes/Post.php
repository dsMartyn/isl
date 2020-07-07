<?php

namespace Src\PostTypes;

class Post
{

    /**
     * Post constructor.
     */
    public function __construct()
    {
        /*add_action( 'init', array($this, 'updatePostType'), 1 );
        add_action( 'admin_menu', array($this, 'removePostRemnants' ) );
        add_filter( 'manage_edit-post_columns', array($this, 'columns_filter'), 10, 1);
        add_action( 'load-edit.php',array($this, 'no_category_dropdown' ) );
        add_action( 'admin_head-edit.php', array($this, 'post_script_enqueuer' ) );
        add_filter( 'get_the_archive_title', function ( $title ) {
            $title = str_replace("Archives: ","",$title);
            $title = str_replace("Year: ","Articles from ",$title);
            $title = str_replace("Month: ","Articles from ",$title);
            return $title;
        });*/

        add_filter('manage_edit-post_columns', array($this, 'columns_filter'), 10, 1);
        add_action('admin_head-edit.php', array($this, 'post_script_enqueuer'));
        add_action('admin_menu', array($this, 'removePostRemnants' ));
        add_filter('getarchives_where', array($this, 'archive_where'), 10, 2);
        add_action('init', array($this, 'news_rewrite_rules' ) );
        add_filter('register_post_type_args', array($this, 'change_post_type_args'), 10, 2);
    }

    public function change_post_type_args( $args, $post_type ){

        $labels = array(
            'name'               => _x( 'News Articles', 'post type general name'),
            'singular_name'      => _x( 'News Article', 'post type singular name'),
            'menu_name'          => _x( 'News', 'admin menu'),
            'name_admin_bar'     => _x( 'News Article', 'add new on admin bar' ),
            'add_new'            => _x( 'Add New', 'book' ),
            'add_new_item'       => __( 'Add New Article' ),
            'new_item'           => __( 'New Article' ),
            'edit_item'          => __( 'Edit Article' ),
            'view_item'          => __( 'View Article' ),
            'all_items'          => __( 'All Articles' ),
            'search_items'       => __( 'Search Articles' ),
            'parent_item_colon'  => __( 'Parent Article:' ),
            'not_found'          => __( 'No articles found.' ),
            'not_found_in_trash' => __( 'No articles found in Trash.' )
        );

        if('post' == $post_type ) {
            $args['labels'] = $labels;
            //$args['public']  = true;
            //$args['publicly_queryable'] = true;
            //$args['_builtin'] = false;
            //$args['capability_type'] = 'post';
            //$args['map_meta_cap'] = true;
            //$args['hierarchical'] = true;
            //$args['rewrite'] = array( 'slug' => 'news', "with_front" => true ); // Amend made by CE
            //$args['query_var'] = true;
            $args['has_archive'] = "news";
            //$args['menu_position'] = 32;
            //$args['menu_icon'] = "dashicons-megaphone";
            //$args['supports'] = array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats', 'page-attributes' );
            //$args['taxonomies'] = array();
        }

        return $args;
    }

    /**
     *
     */
    public function updatePostType()
    {
        $labels = array(
            'name'               => _x( 'News Articles', 'post type general name'),
            'singular_name'      => _x( 'News Article', 'post type singular name'),
            'menu_name'          => _x( 'News', 'admin menu'),
            'name_admin_bar'     => _x( 'News Article', 'add new on admin bar' ),
            'add_new'            => _x( 'Add New', 'book' ),
            'add_new_item'       => __( 'Add New Article' ),
            'new_item'           => __( 'New Article' ),
            'edit_item'          => __( 'Edit Article' ),
            'view_item'          => __( 'View Article' ),
            'all_items'          => __( 'All Articles' ),
            'search_items'       => __( 'Search Articles' ),
            'parent_item_colon'  => __( 'Parent Article:' ),
            'not_found'          => __( 'No articles found.' ),
            'not_found_in_trash' => __( 'No articles found in Trash.' )
        );

        register_post_type( 'post', array(
            'labels' => $labels,
            'public'  => true,
            'publicly_queryable' => true,
            '_builtin' => true,
            'capability_type' => 'post',
            'map_meta_cap' => true,
            'hierarchical' => true,
            'rewrite' => array( 'slug' => 'news', "with_front" => true ), // Amend made by CE
            'query_var' => true,
            'has_archive' => "news",
            "menu_position" => 32,
            "menu_icon" => "dashicons-megaphone",
            'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats', 'page-attributes' ),
            "taxonomies" => array(),
        ) );
    }

    public function removePostRemnants()
    {

        //remove_menu_page( 'index.php' );                //Dashboard
        //remove_menu_page( 'edit.php' );         //Posts
        //remove_menu_page( 'upload.php' );               //Media
        //remove_menu_page( 'edit.php?post_type=page' );  //Pages
        remove_menu_page( 'edit-comments.php' );//Comments
        //remove_menu_page( 'themes.php' );               //Appearance
        //remove_menu_page( 'plugins.php' );              //Plugins
        //remove_menu_page( 'users.php' );                //Users
        //remove_menu_page( 'tools.php' );                //Tools
        //remove_menu_page( 'options-general.php' );      //Settings

        //remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
        //remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');

        //remove_meta_box( 'categorydiv','post','normal' ); // Categories Metabox
        //remove_meta_box( 'tagsdiv-post_tag','post','normal' ); // Tags Metabox
        remove_meta_box( 'formatdiv','post','normal' ); // Format Metabox

    }

    public function columns_filter( $columns )
    {
        unset($columns['comments']);
        return $columns;
    }

    public function no_category_dropdown()
    {
        add_filter( 'wp_dropdown_cats', '__return_false' );
    }

    public function post_script_enqueuer()
    {

        global $current_screen;
        if( 'edit-post' != $current_screen->id )
            return;
        ?>
        <script type="text/javascript">
            jQuery(document).ready( function() {
                jQuery('span:contains("Allow Comments")').each(function (i) {
                    jQuery(this).parent().html('<br />');
                });
                jQuery('span:contains("Allow Pings")').each(function (i) {
                    jQuery(this).parent().html('<br />');
                });
                jQuery('.inline-edit-categories').each(function (i) {
                    jQuery(this).remove();
                });
                jQuery('.inline-edit-tags').each(function (i) {
                    jQuery(this).remove();
                });
            });
        </script>
        <?php

    }

    public function archive_where($where,$args){

        $year = isset($args['year']) ? $args['year'] : "";
        $month = isset($args['month']) ? $args['month'] : "";
        $monthname = isset($args['monthname']) ? $args['monthname']: "";
        $day = isset($args['day']) ? $args['day'] : "";
        $dayname = isset($args['dayname']) ? $args['dayname'] : "";

        if($year){
            $where .= " AND YEAR(post_date) = '$year' ";
            $where .= $month ? " AND MONTH(post_date) = '$month' " : "";
            $where .= $day ? " AND DAY(post_date) = '$day' " : "";
        }

        if($month){
            $where .= " AND MONTH(post_date) = '$month' ";
            $where .= $day ? " AND DAY(post_date) = '$day' " : "";
        }

        if($monthname){
            $where .= " AND MONTHNAME(post_date) = '$monthname' ";
            $where .= $day ? " AND DAY(post_date) = '$day' " : "";
        }

        if($day){
            $where .= " AND DAY(post_date) = '$day' ";
        }

        if($dayname){
            $where .= " AND DAYNAME(post_date) = '$dayname' ";
        }

        return $where;
    }

    public function news_rewrite_rules(){

        add_rewrite_rule(
            'news/([0-9]{4})/([0-9]{1,2})/?$',
            'index.php?post_type=post&year=$matches[1]&monthnum=$matches[2]',
            'top'
        );

        add_rewrite_rule(
            'news/([0-9]{4})/?$',
            'index.php?post_type=post&year=$matches[1]',
            'top'
        );

        add_rewrite_rule(
            'news/([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$',
            'index.php?post_type=post&year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]',
            'top'
        );

    }

}

