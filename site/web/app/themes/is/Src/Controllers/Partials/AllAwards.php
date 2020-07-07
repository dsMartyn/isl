<?php

namespace Src\Controllers\Partials;

trait AllAwards
{

    public function all_awards()
    {
        $args = [
            'post_type' => 'award',
            'orderby'   => 'title',
            'order'     => 'ASC',
        ];

        $query = new \WP_Query($args);
        return $query->posts;
    }

}
