<?php

return [
    'domain' => env('APP_DOMAIN', 'parlamoreonline.com'),
    'brand' => 'Parlamore Online',
    'email_to' => env('CONTACT_TO_EMAIL', 'kontakt@parlamoreonline.com'),

    'social' => [
        'instagram' => env('SOCIAL_INSTAGRAM', null),
        'facebook'  => env('SOCIAL_FACEBOOK', null),
    ],

    'locales' => ['pl', 'en', 'it'],

    'default_images' => [
        'og' => '/assets/og-default.jpg', // dodasz później
    ],
];