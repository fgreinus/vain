<?php

namespace Modules\User\Services;

use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Modules\User\Entities\User;
use Validator;

class Registrar implements RegistrarContract
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name'                  => 'required|max:255|unique:users',
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|confirmed|min:6',
            'birthday_at'           => 'date|before:now',
            'gender'                => 'in:male,female',
            'locale'                => 'required|size:2',
            'homepage'              => 'url|max:100',
            'skype'                 => 'min:6|max:32',
            'facebook'              => 'url|max:50',
            'twitter'               => 'url|max:50',
            'main_character'        => 'min:2|max:20',
            'main_guild'            => 'max:50',
            'favorite_race'         => 'max:20',
            'favorite_class'        => 'max:20',
            'favorite_spec'         => 'max:20',
            'favorite_instance'     => 'max:50',
            'favorite_battleground' => 'max:50',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    public function create(array $data)
    {
        $user = User::create([
            'name'                  => $data['name'],
            'email'                 => $data['email'],
            'password'              => bcrypt($data['password']),
            'birthday_at'           => $data['birthday_at'],
            'locale'                => $data['locale'],
            'gender'                => $data['gender'],
            'city'                  => $data['city'],
            'about'                 => $data['about'],
            'profession'            => $data['profession'],
            'hobbies'               => $data['hobbies'],
            'homepage'              => $data['homepage'],
            'skype'                 => $data['skype'],
            'facebook'              => $data['facebook'],
            'twitter'               => $data['twitter'],
            'main_character'        => $data['main_character'],
            'main_guild'            => $data['main_guild'],
            'favorite_race'         => $data['favorite_race'],
            'favorite_spec'         => $data['favorite_spec'],
            'favorite_instance'     => $data['favorite_instance'],
            'favorite_battleground' => $data['favorite_battleground'],
        ]);

        return $user;
    }
}
