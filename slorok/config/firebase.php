<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Firebase Project
    |--------------------------------------------------------------------------
    |
    | This option controls the default project that will be used when
    | no project is specified when using the factory.
    */
    'default' => env('FIREBASE_PROJECT', 'app'),

    /*
    |--------------------------------------------------------------------------
    | Firebase Projects
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many projects as you want.
    |
    */
    'projects' => [
        'app' => [
            // Pastikan baris ini menunjuk ke file Anda
            'credentials' => [
                'file' => storage_path('app/firebase/service-account.json'),
                'auto_discovery' => true,
            ],
        ],
    ],
];