<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Vista Domain
    |--------------------------------------------------------------------------
    |
    | This is the subdomain where Vista will be accessible from. If this
    | setting is null, Vista will reside under the same domain as the
    | application. Otherwise, this value will serve as the subdomain.
    |
    */

    'domain' => env('VISTA_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | Vista Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Vista will be accessible from. Feel free
    | to change this path to anything you like. Note that the URI will not
    | affect the paths of its internal API that aren't exposed to users.
    |
    */

    'path' => env('VISTA_PATH', 'vista'),

    /*
    |--------------------------------------------------------------------------
    | Redis Connection
    |--------------------------------------------------------------------------
    |
    | This is the name of the Redis connection where Vista will store the
    | meta information required for it to function. It includes the list
    | of tasks, status logs, metrics, and other information.
    |
    */

    'use' => 'default',

    /*
    |--------------------------------------------------------------------------
    | Redis Prefix
    |--------------------------------------------------------------------------
    |
    | This prefix will be used when storing all Vista data in Redis. You
    | may modify the prefix when you are running multiple installations
    | of Vista on the same server so that they don't conflict.
    |
    */

    'prefix' => env(
        'VISTA_PREFIX',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_vista:'
    ),

    /*
    |--------------------------------------------------------------------------
    | Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will get attached onto each Vista route, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Scheduler Run Interval
    |--------------------------------------------------------------------------
    |
    | This option allows you to configure how often the Vista supervisor
    | checks for due tasks. The default is 60 seconds (every minute).
    | You may increase this to reduce load, or decrease for finer granularity.
    |
    */

    'interval' => env('VISTA_INTERVAL', 60),

    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    |
    | Configure whether Vista's dashboard requires authentication. By default,
    | it uses the 'web' guard for session-based access.
    |
    */

    'auth' => [
        'enabled' => true,
        'guards' => ['web'],
    ],
];
