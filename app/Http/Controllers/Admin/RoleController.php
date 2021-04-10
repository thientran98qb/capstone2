<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Permission;
use App\Model\Role;

class RoleController extends Controller
{
    protected $role;
    protected $permission;

    public function __construct(Role $role,Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role->all();
        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permission->where('parent_id',0)->get();
        return view('admin.roles.add',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->name_role,
            'display_name' => $request->desc_role
        ];
        $role = $this->role->create($data);
        $role->permissions()->attach($request->permission_id);
        toast('Your role as been created!','success');
        return redirect()->route('admin.role.index');
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
        $role = $this->role->findOrFail($id);
        $permissions = $this->permission->where('parent_id',0)->get();
        $checkedPermission = $role->permissions;
        return view('admin.roles.edit',compact('permissions','role','checkedPermission'));
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
        $data = [
            'name' => $request->name_role,
            'display_name' => $request->desc_role
        ];
        $this->role->find($id)->update($data);
        $role = $this->role->find($id);
        $role->permissions()->sync($request->permission_id);
        toast('Your role as been updated!','success');
        return redirect()->route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->role->findOrFail($id)->delete();
        toast('Your role as been deleted!','success');
        return redirect()->route('admin.role.index');
    }
}