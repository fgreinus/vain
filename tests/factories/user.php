<?php

$factory('Modules\User\Entities\User', [
    'name' => $faker->userName,
    'email' => $faker->email,
    'password' => bcrypt('password'),
    'locale' => 'de',
]);
