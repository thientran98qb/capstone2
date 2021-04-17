<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Permission;

class PermissionController extends Controller
{
    protected $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }
    public function create()
    {
        return view('admin.permissions.add');
    }

    public function store(Request $request)
    {
        $permission =$this->permission->create([
            'name' => $request->permission_parent,
            'display_name' => $request->permission_parent,
            'parent_id' => 0,
            'key_code' => ''
        ]);

        foreach ($request->permission_child as $value) {
            $this->permission->create([
                'name' => $value,
                'display_name' => $value,
                'parent_id' => $permission->id,
                'key_code' => $request->permission_parent.'_'.$value,
            ]);
        }
    }
}