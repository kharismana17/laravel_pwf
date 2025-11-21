<?php

return [

    'default' => env('CACHE_STORE', 'file'),

    'stores' => [

        'apc' => [
            'driver' => 'apc',
        ],

        'array' => [
            'driver' => 'array',
            'serialize' => false,
        ],

        'database' => [
            'driver' => 'database',
            'table'  => env('DB_CACHE_TABLE', 'cache'),
            'connection' => env('DB_CACHE_CONNECTION'),
            'lock_connection' => env('DB_CACHE_LOCK_CONNECTION'),
        ],

        'file' => [
            'driver' => 'file',
            'path'   => env('FILE_CACHE_PATH', storage_path('framework/cache/data')),
        ],

        'memcached' => [
            'driver'  => 'memcached',
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port' => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],

        'redis' => [
            'driver'     => 'redis',
            'connection' => env('REDIS_CACHE_CONNECTION', 'cache'),
        ],

        'octane' => [
            'driver' => 'octane',
        ],
    ],

   'prefix' => env('CACHE_PREFIX', strtolower(str_replace(' ', '_', env('APP_NAME', 'laravel'))) . '_cache'),

];
