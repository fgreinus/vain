<?php

namespace Modules\User\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\One\User as OneUser;
use Laravel\Socialite\Two\User as TwoUser;
use Modules\User\Entities\User;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Vain\Http\Controllers\Controller;

class SocialController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Social Auth Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users via third party
    | services.
    |
    */

    /**
     * redirect to after successfull auth.
     *
     * @var string
     */
    protected $redirectPath = '/home';

    /**
     * @param Request $request
     *
     * @throws HttpException
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect(Request $request)
    {
        $provider = $request->get('provider');

        if ($provider === null) {
            throw new HttpException(500, 'provider necessary');
        }

        return \Socialize::with($provider)->redirect();
    }

    /**
     * @param Request $request
     *
     * @throws HttpException
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        $provider = $request->get('provider');

        if ($provider === null) {
            throw new HttpException(500, 'provider necessary');
        }

        /** @var OneUser|TwoUser $data */
        $data = \Socialize::with($provider)->user();

        // do we got the user already?
        $user = User::where('email', $data->getEmail())
            ->first();

        if ($user === null) {
            // we have to register him as a new user
            $user = User::create([
                'name'     => $data->getName(),
                'email'    => $data->getEmail(),
                'password' => '', ]);
        }

        // login as db user
        Auth::login($user);

        return redirect($this->redirectPath);
    }
}
