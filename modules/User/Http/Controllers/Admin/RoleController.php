<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\User\Entities\Permission;
use Modules\User\Entities\Role;
use Modules\User\Http\Requests\RoleFormRequest;
use Vain\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user.role.show', ['only' => ['index', 'show']]);
        $this->middleware('permission:user.role.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user.role.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user.role.destroy', ['only' => 'destroy']);
    }

    public function index()
    {
        $roles = Role::orderBy('order', 'ASC')->paginate();

        return view('user::admin.roles.index')
            ->with('roles', $roles);
    }

    public function create()
    {
        $permissions = Permission::lists('display_name', 'id')->all();

        $colors = config('roles.colors');

        return view('user::admin.roles.create')
            ->with(['permissions' => $permissions, 'colors' => $colors]);
    }

    public function store(RoleFormRequest $request)
    {
        $role = Role::create($request->all());

        $permissions = $request->get('permissions');
        $role->savePermissions($permissions);

        return $this->createDefaultResponse($request);
    }

    public function edit($id)
    {
        /* @var User $user */
        $role = Role::find($id);

        $permissions = Permission::lists('display_name', 'id')->all();

        $colors = config('roles.colors');

        return view('user::admin.roles.edit')
            ->with(['role' => $role, 'permissions' => $permissions, 'colors' => $colors]);
    }

    public function update(RoleFormRequest $request, $id)
    {
        /** @var Role $role */
        $role = Role::find($id);

        $role->fill($request->all());
        $role->save();

        $permissions = $request->get('permissions');
        $role->savePermissions($permissions);

        return $this->createDefaultResponse($request);
    }

    public function destroy(Request $request, $id)
    {
        // todo protect system roles?

        Role::find($id)->delete();

        return $this->createDefaultResponse($request);
    }

    /**
     * @param $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    protected function createDefaultResponse($request)
    {
        if ($request->ajax()) {
            // very default response, we basicly just need the response code
            return response('', 200);
        }

        return redirect()->route('user.admin.roles.index');
    }
}
