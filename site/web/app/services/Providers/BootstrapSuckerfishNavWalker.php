<?php

namespace Services\Providers;
use Services\Contracts\BootableInterface;

/**
 * Class Name: Bootstrap4NavWalker
 * Description: A custom WordPress nav walker class for Bootstrap 4 nav menus in a custom theme using the WordPress built in menu manager.
 */

class BootstrapSuckerfishNavWalker extends \Walker_Nav_Menu implements BootableInterface
{

    public function boot()
    {

        // this class does not need to boot

    }

    /**
     * @var bool
     */
    private $cpt; // Boolean, is current post a custom post type
    /**
     * @var false|string
     */
    private $archive; // Stores the archive page for current URL

    /*
     * BootstrapNavWalker constructor.
     */
    public function __construct() {
        add_filter('nav_menu_css_class', array($this, 'cssClasses'), 10, 2);
        add_filter('nav_menu_item_id', '__return_null');
        $cpt           = get_post_type();
        $this->cpt     = in_array($cpt, get_post_types(array('_builtin' => false)));
        $this->archive = get_post_type_archive_link($cpt);
    }

    /**
     * @param $classes
     * @return int
     */
    public function checkCurrent($classes) {
        return preg_match('/(current[-_])|active/', $classes);
    }

    /**
     * @param $input
     * @return string
     */
    public function root_relative_url($input) {
        if (is_feed()) {
            return $input;
        }

        $url = parse_url($input);
        if (!isset($url['host']) || !isset($url['path'])) {
            return $input;
        }
        $site_url = parse_url(\network_home_url());  // falls back to home_url

        if (!isset($url['scheme'])) {
            $url['scheme'] = $site_url['scheme'];
        }
        $hosts_match = $site_url['host'] === $url['host'];
        $schemes_match = $site_url['scheme'] === $url['scheme'];
        $ports_exist = isset($site_url['port']) && isset($url['port']);
        $ports_match = ($ports_exist) ? $site_url['port'] === $url['port'] : true;

        if ($hosts_match && $schemes_match && $ports_match) {
            return \wp_make_link_relative($input);
        }
        return $input;
    }

    /**
     * Compare URL against relative URL
     */
    public function url_compare($url, $rel) {
        $url = trailingslashit($url);
        $rel = trailingslashit($rel);
        return ((strcasecmp($url, $rel) === 0) || BootstrapSuckerfishNavWalker::root_relative_url($url) == $rel);
    }

    /**
     * @param $classes
     * @param $item
     * @return array
     */
    public function cssClasses($classes, $item) {
        $slug = sanitize_title($item->title);

        // Fix core `active` behavior for custom post types
        if ($this->cpt) {
            $classes = str_replace('current_page_parent', '', $classes);

            if ($this->archive) {
                if (BootstrapSuckerfishNavWalker::url_compare($this->archive, $item->url)) {
                    $classes[] = 'active ula-start';
                }
            }
        }

        // Remove most core classes
        $classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes);
        $classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);

        // Re-add core `menu-item` class
        $classes[] = 'menu-item';

        // Re-add core `menu-item-has-children` class on parent elements
        if ($item->is_subitem) {
            $classes[] = 'menu-item-has-children';
        }

        // Add `menu-<slug>` class
        $classes[] = 'menu-' . $slug;

        $classes = array_unique($classes);
        $classes = array_map('trim', $classes);

        return array_filter($classes);
    }

    /**
     * Starts the list before the elements are added.
     *
     * @see Walker::start_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=\"dropdown-menu\">\n";
        $output .= "\n$indent<div class=\"dropdown-links\">\n";
    }

    /**
     * Ends the list of after the elements are added.
     *
     * @see Walker::end_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</div>\n";
        $output .= "$indent</div>\n";
    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param array|object $args
     * @param int $id
     * @internal param int $current_page Menu item ID.
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        /**
         * Dividers, Headers or Disabled
         * =============================
         * Determine whether the item is a Divider, Header, Disabled or regular
         * menu item. To prevent errors we use the strcasecmp() function to so a
         * comparison that is not case sensitive. The strcasecmp() function returns
         * a 0 if the strings are equal.
         */
        if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
            $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
        } else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
            $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
        } else {

            $value = '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            if ($depth == 0) {
                $classes[] = 'top-level';
            }

            // MEGAMENU ADD
            $megamenu = ($item->object == "mega_menu") ? $item->object_id : false;

            if ( ( $args->walker->has_children ) || ($megamenu) ) {
                $classes[] = 'dropdown';
                if ($megamenu) {
                    $classes[] = 'megamenu';
                }
            }

            if ( in_array( 'current-menu-item', $classes ) ) {
                $classes[] = 'active';
            }

            if ( in_array( 'current-menu-parent', $classes ) )
                $classes[] = 'active';

            if ( in_array( 'active', $classes ) )
                $classes[] = 'ula-start';

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $data_as = "";
            if (substr_count($class_names, "ula-start") > 0) {
                $data_as = " data-as='true' data-as-animation='ula-end' ";
            }

            if ($depth === 0) {
                $output .= $indent . '<li' . $id . $class_names . $data_as . '>';
            }

            $atts = array();
            $atts['title']  = ! empty( $item->attr_title )	? $item->attr_title	: $item->title;
            if (substr_count($atts['title'], "fa-") > 0) {
                $atts['title'] = $iten->title;
            }
            $atts['target'] = ! empty( $item->target )	? $item->target	: '';
            $atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

            // If item has_children add atts to a.
            if ( ($megamenu) || ( $args->walker->has_children && $depth === 0 ) ) {
                $atts['href']   		= ! empty( $item->url ) ? $item->url : 'javascript:void(0);';
                $atts['data-toggle']	= 'dropdown';
                $atts['data-hover']	    = 'dropdown';
                $atts['data-delay']	    = '100';
                $atts['class']			= 'dropdown-toggle';
                $atts['aria-haspopup']	= 'true';
                $atts['aria-expanded']	= 'false';
                $atts['role']	        = 'button';
                if (!$megamenu) {
                    $atts['data-hover']	= 'dropdown';
                    $atts['data-animations'] = 'fadeIn fadeIn fadeIn fadeIn';
                } else {
                    $atts['class'] .= ' dropdown-megamenu';
                }
            } else {
                $atts['href'] = ! empty( $item->url ) ? $item->url : 'javascript:void(0);';
            }

            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

            $attributes = '';

            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;

            /*
			 * Font Awesome
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */
            if ( ( ! empty( $item->attr_title ) ) && (substr_count( $item->attr_title, "fa-") > 0) ) {
                $item_output .= '<a' . $attributes . '><i class="fa ' . esc_attr($item->attr_title) . '"></i>&nbsp;';
            } else {
                $item_output .= '<a' . $attributes . '>';
            }

            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

            //$item_output .= ( ($megamenu) || ( $args->walker->has_children && 0 === $depth ) ) ? ' <span class="caret"></span></a>' : '</a>';

            $item_output .= '</a>';

            // MEGAMENU ADD
            if ($megamenu) {

                $megamenu_post = get_post($megamenu);

                if ($megamenu_post) {

                    // add the megamenu widget
                    $item_output .= "
                    <div class='dropdown-menu'>
                        <div class='row'>
                            <div class='col-sm-12'>
                ";

                    $item_output .= apply_filters( 'the_content', $megamenu_post->post_content );

                    $item_output .= "
                            </div>
                        </div>
                    </div>
                    ";

                }

            }

            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }

    /**
     * Ends the element output, if needed.
     *
     * @see Walker::end_el()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Page data object. Not used.
     * @param int    $depth  Depth of page. Not Used.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        if ($depth === 0) {
            $output .= "</li>\n";
        }
    }

    /**
     * Traverse elements to create list from elements.
     *
     * Display one element if the element doesn't have any children otherwise,
     * display the element and its children. Will only traverse up to the max
     * depth and no ignore elements under that depth.
     *
     * This method shouldn't be called directly, use the walk() method instead.
     *
     * @see Walker::start_el()
     * @since 2.5.0
     *
     * @param object $element Data object
     * @param array $children_elements List of elements to continue traversing.
     * @param int $max_depth Max depth to traverse.
     * @param int $depth Depth of current element.
     * @param array $args
     * @param string $output Passed by reference. Used to append additional content.
     * @return null Null on failure with no changes to parameters.
     */
    /*public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
            $args[0]->walker->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }*/

    /**
     * Traverse elements to create list from elements.
     *
     * Display one element if the element doesn't have any children otherwise,
     * display the element and its children. Will only traverse up to the max
     * depth and no ignore elements under that depth.
     *
     * This method shouldn't be called directly, use the walk() method instead.
     *
     * @see Walker::start_el()
     * @since 2.5.0
     *
     * @param object $element Data object
     * @param array $children_elements List of elements to continue traversing.
     * @param int $max_depth Max depth to traverse.
     * @param int $depth Depth of current element.
     * @param array $args
     * @param string $output Passed by reference. Used to append additional content.
     * @return null Null on failure with no changes to parameters.
     */
    public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        $element->is_subitem = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));

        if ($element->is_subitem) {
            foreach ($children_elements[$element->ID] as $child) {
                if ($child->current_item_parent || BootstrapSuckerfishNavWalker::url_compare($this->archive, $child->url)) {
                    $element->classes[] = 'active';
                    $element->classes[] = 'ula-start';
                }
            }
        }

        $element->is_active = (!empty($element->url) && strpos($this->archive, $element->url));

        if ($element->is_active) {
            $element->classes[] = 'active';
            $element->classes[] = 'ula-start';
        }

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    /**
     * Menu Fallback
     * =============
     * If this function is assigned to the wp_nav_menu's fallback_cb variable
     * and a manu has not been assigned to the theme location in the WordPress
     * menu manager the function with display nothing to a non-logged in user,
     * and will add a link to the WordPress menu manager if logged in as an admin.
     *
     * @param array $args passed from the wp_nav_menu function.
     *
     */
    public static function fallback( $args ) {
        if ( current_user_can( 'manage_options' ) ) {

            extract( $args );

            $fb_output = null;

            if ( $container ) {
                $fb_output = '<' . $container;

                if ( $container_id )
                    $fb_output .= ' id="' . $container_id . '"';

                if ( $container_class )
                    $fb_output .= ' class="' . $container_class . '"';

                $fb_output .= '>';
            }

            $fb_output .= '<ul';

            if ( $menu_id )
                $fb_output .= ' id="' . $menu_id . '"';

            if ( $menu_class )
                $fb_output .= ' class="' . $menu_class . '"';

            $fb_output .= '>';
            $fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
            $fb_output .= '</ul>';

            if ( $container )
                $fb_output .= '</' . $container . '>';

            echo $fb_output;
        }
    }

}


/**
 * Clean up wp_nav_menu_args
 *
 * Remove the container
 * Remove the id="" on nav menu items
 */
function suckerfish_nav_menu_args($args = '') {
    $nav_menu_args = [];
    $nav_menu_args['container'] = false;

    if (!$args['items_wrap']) {
        $nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
    }

    if (!$args['walker']) {
        $nav_menu_args['walker'] = new BootstrapSuckerfishNavWalker();
    }

    return array_merge($args, $nav_menu_args);
}
add_filter('wp_nav_menu_args', __NAMESPACE__ . '\\suckerfish_nav_menu_args');
add_filter('nav_menu_item_id', '__return_null');
