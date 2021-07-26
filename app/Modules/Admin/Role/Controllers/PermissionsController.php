<?php

namespace App\Modules\Admin\Role\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Admin\Dashboard\Classes\Base;
use App\Modules\Admin\Role\Models\Permission;
use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\Role\Services\PermissionsService;
use App\Modules\Admin\Role\Services\RoleService;
use Illuminate\Http\Request;

class PermissionsController extends Base
{
    public function __construct(PermissionsService $permissionsService)
    {
        parent::__construct();
        $this->service = $permissionsService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Role::class);
        $perms = Permission::all();
        $roles = Role::all();
        $this->title = "Permissions Management Panel";

        $this->content = view('Admin::Permission.index')->with([
            'perms' => $perms,
            'roles' => $roles,
            'title' => $this->title,
        ])->render();
        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('create', Role::class);
        $this->service->save($request);
        return back()->with([
            'message' => "Your\'ve assigned new set of permissions to existing roles!"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
