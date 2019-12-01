<?php

return [


    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],




    
    'guards' => [
            'web' => [
                'driver' => 'session',
                'provider' => 'users',
            ],
            'api' => [
                'driver' => 'passport',
                'provider' => 'users',
            ], 
            'web' => [
                'driver' => 'session',
                'provider' => 'client_users',
            ],
            'api' => [
                'driver' => 'passport',
                'provider' => 'client_users',
            ],
        ],


    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\User::class,
        ],  
         'client_users' => [
            'driver' => 'eloquent',
            'model' => App\user_model\Client_user::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],


    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
