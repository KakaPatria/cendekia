<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    public function index(Request $request)
    { 
        $load['role'] = Role::paginate(10);
        $load['permissions'] =  Permission::get();

        return view('pages.panel.role.index', ($load))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $load['title'] = "Add Role";
        $load['sub_title'] = "";
        $load['permissions'] =  Permission::get();

        return view('pages.panel.role.create', ($load));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));

        return redirect()->route('panel.role.index')
            ->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $load['role'] = $role;
        $load['rolePermissions'] = $role->permissions;

        //dd($load);

        return view('pages.panel.role.show', ($load));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $load['role'] = $role;
        $load['rolePermissions'] = $role->permissions->pluck('name')->toArray();
        $load['permissions'] = Permission::orderBy('name')->get();

        return view('pages.panel.role.edit', $load);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role->update($request->only('name'));

        $role->syncPermissions($request->get('permission'));

        return redirect()->route('panel.role.index')
            ->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('panel.role.index')
            ->with('success', 'Role Delete successfully');
    }
}
