<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Session\Store;
use InvalidArgumentException;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Modules\User\Services\Registrar;
use Modules\User\Services\Updater;
use Vain\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->middleware('permission:user.user.show', ['only' => ['index', 'show']]);
        $this->middleware('permission:user.user.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user.user.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user.user.destroy', ['only' => 'destroy']);
    }

    public function index()
    {
        $users = User::paginate();

        return view('user::admin.users.index')
            ->with('users', $users);
    }

    public function create()
    {
        $roles = Role::lists('display_name', 'id')->all();

        $genders = [
            null     => trans('user::profile.gender.none'),
            'male'   => trans('user::profile.gender.male'),
            'female' => trans('user::profile.gender.female'),
        ];

        $locales = config('app.locales');

        return view('user::admin.users.create')
            ->with(['roles' => $roles, 'genders' => $genders, 'locales' => $locales]);
    }

    public function store(Store $session, Registrar $registrar)
    {
        $validator = $registrar->validator($this->request->all());

        if ($validator->fails()) {
            if ($this->request->ajax()) {
                $session->flash('errors', $validator->getMessageBag());

                return response('', 500);
            }

            return redirect()->route('user.admin.users.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = $registrar->create($this->request->all());
        $user->saveRoles($this->request->get('roles'));

        return $this->createDefaultResponse($this->request);
    }

    public function edit($id)
    {
        /** @var User $user */
        $user = User::find($id);

        $roles = Role::lists('display_name', 'id')->all();

        $genders = [
            null     => trans('user::profile.gender.none'),
            'male'   => trans('user::profile.gender.male'),
            'female' => trans('user::profile.gender.female'),
        ];

        $locales = config('app.locales');

        return view('user::admin.users.edit')
            ->with(['user' => $user, 'roles' => $roles, 'genders' => $genders, 'locales' => $locales]);
    }

    public function update(Store $session, Updater $updater, $id)
    {
        /** @var User $user */
        $user = User::find($id);

        $validator = $updater->validator($user, $this->request->all());

        if ($validator->fails()) {
            if ($this->request->ajax()) {
                $session->flash('errors', $validator->getMessageBag());

                return response('', 500);
            }

            return redirect()
                ->route('user.admin.users.edit')
                ->withErrors($validator)
                ->withInput();
        }

        $updater->update($user, $this->request->all());
        $user->saveRoles($this->request->get('roles'));

        return $this->createDefaultResponse();
    }

    public function destroy($id)
    {
        if ($id == $this->request->user()->id) {
            throw new InvalidArgumentException();
        }

        /* @var User $user */
        User::find($id)->delete();

        return $this->createDefaultResponse();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    protected function createDefaultResponse()
    {
        if ($this->request->ajax()) {
            // very default response, we basicly just need the response code
            return response('', 200);
        }

        return redirect()->route('user.admin.users.index');
    }
}
