<?php

namespace Src\Controllers\Partials;

trait RelatedPosts
{
    /**
     * Get related posts by category
     *
     * @param string $taxonomy
     * @return array
     */
    public function related_category_posts($taxonomy = null)
    {
        // Check if we are on a single page, if not, return false
        if ( !is_single() )
            return false;

        // Get the current post id
        $post_id = get_queried_object_id();

        if (!empty($taxonomy)) {
            // Get the post categories relating to the name in the taxonomy variable.
            $categories = wp_get_post_terms($post_id, $taxonomy);
        } else {
            // Get the post categories
            $categories = get_the_category( $post_id );
        }

        // Lets build our array
        // If we don't have categories, bail
        if ( !$categories )
            return false;

        foreach ( $categories as $category ) {
            if ( $category->parent == 0 ) {
                $term_ids[] = $category->term_id;
            } else {
                $term_ids[] = $category->parent;
                $term_ids[] = $category->term_id;
            }
        }

        // Remove duplicate values from the array
        $unique_array = array_unique( $term_ids );

        // Lets build our query
        $args = [
            'post__not_in' => [$post_id],
            'posts_per_page' => 3, // Note: showposts is depreciated in favor of posts_per_page
            'ignore_sticky_posts' => 1, // Note: caller_get_posts is depreciated
            'orderby' => 'post_date',
            'order' => 'DESC',
            'no_found_rows' => true, // Skip pagination, makes the query faster
            'tax_query' => [
                [
                    'taxonomy' => $taxonomy ? $taxonomy : 'category',
                    'terms' => $unique_array,
                    'include_children' => false,
                ],
            ],
        ];
        $q = new \WP_Query( $args );
        return $q->posts;
    }

    /**
     * Get related case studies by category in Services custom taxonomy
     *
     * @return array
     */
    public function related_category_case_studies()
    {
       return $this->related_category_posts('services');
    }

    /**
     * Get related posts where the category name is equal to the title for the currently viewed page of any Post Type content.
     *
     * @return array
     */
    public function related_posts_from_current_title()
    {
        // Get the current post id
        $post_id = get_queried_object_id();

        $args = [
            'posts_per_page' => 3, // Note: showposts is depreciated in favor of posts_per_page
            'ignore_sticky_posts' => 1, // Note: caller_get_posts is depreciated
            'orderby' => 'post_date',
            'order' => 'DESC',
            'no_found_rows' => true, // Skip pagination, makes the query faster
            'category__not_in' => [1], // Ignore Uncategorized category
            'tax_query' => [
                [
                    'taxonomy' => 'category',
                    'terms' => [get_the_title($post_id)],
                ],
            ],
        ];
        $q = new \WP_Query( $args );
        return $q->posts;
    }

}
