<?php

namespace Modules\User\Services;

use Modules\User\Entities\User;
use Validator;

class Updater
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param User  $user
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(User $user, array $data)
    {
        return Validator::make($data, [
            'name'                  => 'required|max:255|unique:users,name,'.$user->id,
            'email'                 => 'required|email|max:255|unique:users,email,'.$user->id,
            'password'              => 'confirmed|min:6',
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
     * @param User  $user
     * @param array $data
     *
     * @return bool
     */
    public function update(User $user, array $data)
    {
        $user->fill([
            'name'                  => $data['name'],
            'email'                 => $data['email'],
            'birthday_at'           => $data['birthday_at'],
            'gender'                => $data['gender'],
            'locale'                => $data['locale'],
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
            'favorite_class'        => $data['favorite_class'],
            'favorite_spec'         => $data['favorite_spec'],
            'favorite_instance'     => $data['favorite_instance'],
            'favorite_battleground' => $data['favorite_battleground'],
        ]);

        // only fill password if specified
        if (array_key_exists('password', $data)
            && !empty($data['password'])) {
            $user->fill([
                'password' => bcrypt($data['password']),
            ]);
        }

        return $user->save();
    }
}
