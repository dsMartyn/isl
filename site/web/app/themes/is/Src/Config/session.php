<?php



return [

    /*
    |--------------------------------------------------------------------------
    | Session Config
    |--------------------------------------------------------------------------
    |
    |
    |
    |
    */

    'lifetime' => 60, // minutes
    'expire_on_close' => true,
    'lottery' => [50, 100], // lottery--how often do they sweep storage location to clear old ones?
    'cookie' => 'is_session',
    'path' => '/',
    'domain' => env('DOMAIN_CURRENT_SITE'),
    'driver' => 'file',
    'files' => ROOT_DIR . '/sessions',
    'secure' => true,

];
