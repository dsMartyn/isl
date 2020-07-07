<?php

namespace Src\Controllers\Partials;

trait AllTeamMembers
{

    public function all_team_members()
    {
        $args = [
            'post_type' => 'team',
            'orderby'   => 'order',
            'order'     => 'ASC',
        ];

        $query = new \WP_Query($args);
        return $query->posts;
    }

}
