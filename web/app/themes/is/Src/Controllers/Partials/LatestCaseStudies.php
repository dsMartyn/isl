<?php

namespace Src\Controllers\Partials;

trait LatestCaseStudies
{

    public function latest_case_studies()
    {
        $args = [
            'post_type' => 'case_studies',
            'orderby'   => 'post_date',
            'order'     => 'DESC',
            'posts_per_page' => 4
        ];

        $query = new \WP_Query($args);
        return $query->posts;
    }

}

