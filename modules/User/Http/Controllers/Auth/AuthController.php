<?php

namespace Modules\User\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Validator;
use Modules\User\Entities\User;
use Vain\Http\Controllers\Controller;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getRegister()
    {
        return view('user::auth.register');
    }

    public function getLogin()
    {
        return view('user::auth.login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
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
    protected function create(array $data)
    {
        $user = User::create([
            'name'                  => $data['name'],
            'email'                 => $data['email'],
            'password'              => bcrypt($data['password']),
            'birthday_at'           => $data['birthday_at'],
            'locale'                => $data['locale'],
            'gender'                => $data['gender'],
            'city'                  => $data['city'],
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
