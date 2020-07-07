<?php

namespace App;

use Illuminate\Config\Repository;

function sage()
{
    return new Repository([
        'view' => [
            'paths' => [
                "path1",
                "path2"
            ]
        ]
    ]);


}
