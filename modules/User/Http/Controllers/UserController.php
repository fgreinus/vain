<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Session\Store;
use Modules\User\Entities\User;
use Modules\User\Services\Updater;

class UserController extends Controller
{
    protected $updater;

    public function __construct(Updater $updater)
    {
        $this->updater = $updater;
    }

    public function show($id)
    {
        /** @var User $user */
        $user = User::find($id);

        return view('user::profile.index')
            ->with('user', $user);
    }

    public function edit(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $genders = [
            null     => trans('user::profile.gender.none'),
            'male'   => trans('user::profile.gender.male'),
            'female' => trans('user::profile.gender.female'),
        ];

        $locales = config('app.locales');

        return view('user::profile.edit')
            ->with(['user' => $user, 'genders' => $genders, 'locales' => $locales]);
    }

    public function update(Request $request, Store $session)
    {
        $validator = $this->updater->validator($request->user(), $request->all());

        if ($validator->fails()) {
            if ($request->ajax()) {
                $session->flash('errors', $validator->getMessageBag());

                return response('', 500);
            }

            return redirect(route('user.profile.edit'))
                ->withErrors($validator);
        }

        $this->updater->update($request->user(), $request->all());

        if ($request->ajax()) {
            // very default response, we basicly just need the response code
            return response('', 200);
        }

        return redirect()->route('user.profile', ['id' => $request->user()->id]);
    }
}
