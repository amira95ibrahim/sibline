<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionStoreRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::all();
        return $permissions;
        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.permission.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Permission $permission)
    {
        return view('admin.permission.show', compact('show'));
    }

    /**
     * @param \App\Http\Requests\PermissionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionStoreRequest $request)
    {
        $permission = Permission::create($request->validated());

        return redirect()->route('admin.permission.index');
    }
}
