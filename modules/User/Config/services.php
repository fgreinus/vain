<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Social Authentification
    |--------------------------------------------------------------------------
    |
    | This file is to manage social authentification against third party
    | services. You can disable them alltogether if you want to.
    |
    */
    'socialite' => [
        'enable' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'facebook' => [
        'client_id'     => '',
        'client_secret' => '',
        'redirect'      => config('app.url').'/oauth/handle?provider=facebook',
    ],

    'twitter' => [
        'client_id'     => '',
        'client_secret' => '',
        'redirect'      => config('app.url').'/oauth/handle?provider=twitter',
    ],

    'google' => [
        'client_id'     => '537029912451-fke2uv0cg3751mhahlrq01bb0079j1pi.apps.googleusercontent.com',
        'client_secret' => 'FvLnrqPM7WzpawKBkt0EPFgV',
        'redirect'      => config('app.url').'/oauth/handle?provider=google',
    ],

];
