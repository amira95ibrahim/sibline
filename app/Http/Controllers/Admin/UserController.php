<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\DataTables\UserDataTable;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Auth,URL;

class UserController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {

        return $dataTable->render('admin.user.index');

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

        return view('admin.user.create')->with(['menus' => makeNested($menus)]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        $menu = Permission::select('id','name','parent_id','menu_url')->orderBy('president','asc')->get()->toArray(); 
        $permission = $user->permissions->pluck('id')->toArray();

    
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
        return view('admin.user.create')->with(['user' => $user , 'show' => true,'menus' => makeNested($menus)]);
    }

    public function profile(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $menu = Permission::select('id','name','parent_id','menu_url')->orderBy('president','asc')->get()->toArray(); 
        $permission = $user->permissions->pluck('id')->toArray();

    
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
        return view('admin.user.create')->with(['user' => $user ,'menus' => makeNested($menus)]);
    }

    /**
     * @param \App\Http\Requests\UserStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $user = $request->validated();
        $imageName = "avater.jpg";
        $user['image'] = $imageName;
        if($request->file('image')){

            $imageName = time().'.'.$request->image->extension();  
     
            $request->image->move(public_path('images'), $imageName);

            $user['image'] = $imageName;
        }

        

        $user['password'] = \Hash::make($request->password);
        
        $user = User::create($user);
        
        $user->permissions()->attach($request->permission);

        return redirect()->route('admin.user.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {  
        
        $menu = Permission::select('id','name','parent_id','menu_url')->orderBy('president','asc')->get()->toArray(); 
        $permission = $user->permissions->pluck('id')->toArray();

    
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
        return view('admin.user.create')->with(['user'=> $user,'menus' => makeNested($menus)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $previousUrl =URL::previous();
        

        $new_user = $request->validated();

        $imageName = $user->image;

        if($request->file('image')){

            $imageName = time().'.'.$request->image->extension();  
     
            $request->image->move(public_path('images'), $imageName);
    
            $new_user['image'] = $imageName;
        }
        
        $new_user['password'] = !empty($request->password) ? \Hash::make($request->password) : $user->password;
        
        $user->update($new_user);

        $user->permissions()->detach();

        $user->permissions()->attach($request->permission);
        
        return redirect()->route(strpos($previousUrl, 'profile' ) !== false? 'admin.profile' : 'admin.user.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(array('msg'=> 'User Deleted Successfully'), 200);
    }


    
}
