<?php

namespace App\Modules\Admin\Role\Controllers;

use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\Role\Requests\RoleRequest;
use App\Modules\Admin\Role\Services\RoleService;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Base
{
    public function __construct(RoleService $roleService)
    {
        parent::__construct();
        $this->service = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', Role::class);
        $roles = Role::all();
        $this->title = "Role Management Panel";

        $this->content = view('Admin::Role.index')->with([
            'roles' => $roles,
            'title' => $this->title
        ])->render();
        return $this->renderOutput();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(): \Illuminate\Http\Response
    {
        $this->authorize('create', Role::class);

        $this->title = 'Create System User Role';

        $this->content = view('Admin::Role.create')->
            with([
                'title' => $this->title
        ])->render();
        return $this->renderOutput();
    }

    public function store(RoleRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->service->save($request, new Role());
        return Redirect::route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Role\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Role\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('edit', Role::class);

        $this->title = "Edit User Role";

        $this->content = view('Admin::Role.edit')->with(['title' => $this->title, 'item' => $role])->render();
        return $this->renderOutput();
    }


    public function update(RoleRequest $request, Role $role)
    {
        $this->service->save($request, $role);
        return Redirect::route('roles.index')->with([
            'message' => __('Success')
        ]);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return Redirect::route('roles.index')->with([
            'message' => "Successfully Deleted Role!"
        ]);
    }
}
