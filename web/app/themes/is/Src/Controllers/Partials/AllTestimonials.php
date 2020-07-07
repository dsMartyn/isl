<?php

namespace Src\Controllers\Partials;

trait AllTestimonials
{

    public function all_testimonials()
    {
        $args = [
            'post_type' => 'testimonials',
            'orderby'   => 'order',
            'order'     => 'ASC',
        ];

        $query = new \WP_Query($args);
        return $query->posts;
    }

}
