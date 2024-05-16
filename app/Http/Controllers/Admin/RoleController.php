<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\DataTables\RoleDataTable;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(RoleDataTable $dataTable)
    {

        return $dataTable->render('admin.role.index');

    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $menu = Permission::select('id','name','parent_id','menu_url')->orderBy('president','asc')->get()->toArray(); 
        $permission = [];

    
        $menus = [];


        foreach($menu as $key => $value) {
            
            $value['check'] = false; 
            array_push($menus,$value);
        }

         
        
        return view('admin.role.create')->with(['menus' => makeNested($menus)]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Role $role)
    {
        
        $menu = Permission::select('id','name','parent_id','menu_url')->orderBy('president','asc')->get()->toArray(); 
        $permission = $role->permissions->pluck('id')->toArray();

    
        $menus = [];


        foreach($menu as $key => $value) {
            
            if(in_array($value['id'], $permission)){
            
            $value['check'] = true;

            }
            else{

            $value['check'] = false; 
            }

            array_push($menus,$value);


        }

        return view('admin.role.create')->with(['role' => $role , 'show' => true,'menus' => makeNested($menus)]);
    }

    /**
     * @param \App\Http\Requests\RoleStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        

        $role = Role::create($request->validated());

        $role->permissions()->attach($request->permission);

        return redirect()->route('admin.role.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {        
        $menu = Permission::select('id','name','parent_id','menu_url')->orderBy('president','asc')->get()->toArray(); 
        $permission = $role->permissions->pluck('id')->toArray();

    
        $menus = [];


        foreach($menu as $key => $value) {
            
            if(in_array($value['id'], $permission)){
            
            $value['check'] = true;

            }
            else{

            $value['check'] = false; 
            }

            array_push($menus,$value);


        }

         
        
        return view('admin.role.create')->with(['role'=> $role,'menus' => makeNested($menus)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleStoreRequest $request, Role $role)
    {
        $role->update($request->validated());

        $role->permissions()->detach();

        $role->permissions()->attach($request->permission);

        return redirect()->route('admin.role.index');
       
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

        return response()->json(array('msg'=> 'Role Deleted Successfully'), 200);
    }

    /**
     * Get all permissions for role.
     * 
     * @param int $id
     * @return json
     */
    public function getPermissions($id)
    {
        $role = Role::find($id);
        $menus = [];
        if($role)
        {
            $menu = Permission::select('id','name','parent_id','menu_url')->orderBy('president','asc')->get()->toArray(); 
            $permission = $role->permissions->pluck('id')->toArray();
    
            foreach($menu as $key => $value) {
                
                if(in_array($value['id'], $permission)){
                
                $value['check'] = true;
    
                }
                else{
    
                $value['check'] = false; 
                }
    
                array_push($menus,$value);
    
    
            }
        }
        

        return response()->json(array('menus'=> $menus), 200);
    }
}
