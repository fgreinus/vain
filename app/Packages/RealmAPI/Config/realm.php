<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Emulator Software
    |--------------------------------------------------------------------------
    |
    | Since there are some differences in emulation software
    | you have to specify which one is used by each realm.
    |
    */

    'emulators' => [

        'wotlk' => \Vain\Packages\RealmAPI\AbstractEmulator::REALM_TRINITY,
        'tbc' => \Vain\Packages\RealmAPI\AbstractEmulator::REALM_MANGOS,

    ],

    /*
    |--------------------------------------------------------------------------
    | Database Connection references
    |--------------------------------------------------------------------------
    |
    | Please specify the database connection names from database.php to
    | use for specified database types of each realm.
    |
    | NOTE: The logon database is automatically resolved using the logon
    | connection from database.php
    |
    */

    'databases' => [

        'wotlk' => [
            'characters' => 'trinity_characters',
            'dynamics' => 'trinity_dynamics',
        ],

        'tbc' => [
            'characters' => 'mangos_characters',
            'dynamics' => 'mangos_dynamics',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Soap Configuration
    |--------------------------------------------------------------------------
    |
    | To actually interfere with the data on each realm you have to
    | supply soap connection details.
    |
    */

    'soap' => [

        'wotlk' => [
            'host' => env('TRINITY_SOAP_HOST'),
            'port' => env('TRINITY_SOAP_PORT'),
            'username' => env('TRINITY_SOAP_USERNAME'),
            'password' => env('TRINITY_SOAP_PASSWORD'),
            'urn' => 'TC',
        ],

        'tbc' => [
            'host' => env('MANGOS_SOAP_HOST'),
            'port' => env('MANGOS_SOAP_PORT'),
            'username' => env('MANGOS_SOAP_USERNAME'),
            'password' => env('MANGOS_SOAP_PASSWORD'),
            'urn' => 'MaNGOS',
        ],

    ],


];