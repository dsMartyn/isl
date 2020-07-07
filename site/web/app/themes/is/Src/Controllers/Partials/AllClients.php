<?php

namespace Src\Controllers\Partials;

trait AllClients
{

    public function all_clients()
    {
        $args = [
            'post_type' => 'client',
            'orderby'   => 'title',
            'order'     => 'ASC',
        ];

        $query = new \WP_Query($args);
        return $query->posts;
    }

}
