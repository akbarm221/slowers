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
    'apiKey' => env('FIREBASE_API_KEY'),
    'authDomain' => env('FIREBASE_AUTH_DOMAIN'),
    'projectId' => env('FIREBASE_PROJECT_ID'),
    'storageBucket' => env('FIREBASE_STORAGE_BUCKET'),
    'messagingSenderId' => env('FIREBASE_MESSAGING_SENDER_ID'),
    'appId' => env('FIREBASE_APP_ID'),

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