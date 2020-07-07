<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Sizes
    |--------------------------------------------------------------------------
    |
    | Set the image sizes required by the system here.
    | name is how the size will be referenced by the system
    | width is the width in pixels
    | height is the height in pixels
    | crop is boolean, set to true for a crop and false for a contain
    |
    | if you need an image to be specified to just a width or just a height then set the other var to 9999.
    | ie 'name' => 'fixedheight', 'width' => 9999, 'height' => 150, 'crop' => false
    |
    */

    [ 'name' => 'shallow_desktop',              'width' => 1920,     'height' => 548,     'crop' => true ],
    [ 'name' => 'shallow_mobile',               'width' => 768,      'height' => 616,     'crop' => true ],
    [ 'name' => 'deep_desktop',                 'width' => 1920,     'height' => 884,     'crop' => true ],
    [ 'name' => 'deep_mobile',                  'width' => 768,      'height' => 1217,    'crop' => true ],
    [ 'name' => 'home_desktop',                 'width' => 1920,     'height' => 1104,    'crop' => true ],
    [ 'name' => 'home_mobile',                  'width' => 768,      'height' => 1219,    'crop' => true ],

    [ 'name' => 'service_desktop',              'width' => 1200,     'height' => 653,     'crop' => true ],
    [ 'name' => 'service_mobile',               'width' => 768,      'height' => 768,     'crop' => true ],
    [ 'name' => 'service_tile',                 'width' => 768,      'height' => 768,     'crop' => true ],
    [ 'name' => 'service_icon',                 'width' => 115,      'height' => 115,     'crop' => true ],

    [ 'name' => 'logo',                         'width' => 120,      'height' => 80,      'crop' => true ],
    [ 'name' => 'award',                        'width' => 120,      'height' => 80,      'crop' => true ],





    [ 'name' => 'news_instance',                'width' => 768,      'height' => 432,     'crop' => true ],
    [ 'name' => 'news',                         'width' => 985,      'height' => 500,     'crop' => true ],

    [ 'name' => 'full-width', 'width' => 1920,     'height' => 764,      'crop' => true ],
    [ 'name' => 'half-width', 'width' => 950,      'height' => 764,      'crop' => true ],
    [ 'name' => 'two-thirds', 'width' => 1270,     'height' => 764,      'crop' => true ],
    [ 'name' => 'one-third',  'width' => 630,      'height' => 373,      'crop' => true ],


];
