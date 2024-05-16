<?php

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

function sideMenu($user_id){

    $parent =  DB::table('permissions')

        ->select(DB::raw('permissions.id, permissions.name, permissions.menu_url, permissions.parent_id, permissions.icon'))

        ->leftJoin('permission_user', 'permission_user.permission_id', '=', 'permissions.id')
        
        ->orderBy('permissions.president','ASC')

        ->where('permissions.show','1')

        ->where('permissions.parent_id',null)

        ->where(function ($query) use ($user_id){
            $query->where('permissions.menu_url',null)
                  ->orWhere('permission_user.user_id',$user_id);
        })

        ->get();

      $sidmenu = [];
      foreach ($parent as  $value) {  
      
      $menus = [];   

      $menus['id'] = $value->id;

      $menus['name'] = $value->name;

      $menus['url'] = $value->menu_url;

      $menus['icon'] = $value->icon;

      $menus['parent_id'] = $value->parent_id;




      if($value->menu_url != null){

        

       $menus['sub_menu'] = []; 

       array_push($sidmenu, $menus);

      }

      else{

        
      
      $menus['sub_menu'] = subMenu($user_id,$value->id);
      
      if(count($menus['sub_menu'])>0)
            array_push($sidmenu, $menus);

      }



      

      

      }



   return $sidmenu;   



}





function subMenu($user_id,$id){



	      return DB::table('permissions')

            ->select(DB::raw('permissions.id, permissions.name, permissions.menu_url, permissions.parent_id, permissions.icon'))

            ->join('permission_user', 'permission_user.permission_id', '=', 'permissions.id')

            ->where('permission_user.user_id',$user_id)

            ->where('permissions.show','1')

            ->where('permissions.parent_id','=',$id)

            ->orderBy('president','ASC')

            ->get()->toArray();

}



function makeNested($source) {

      $menu = array();



      $sub_menu = array();



      $new_menu = [];



      foreach ( $source as &$s ) {

            if ( $s['parent_id'] == 0 ) {

                  // no parent_id so we put it in the root of the array

                  $menu[] = &$s;

            }  

            if ( $s['parent_id'] != 0 ) {

                  // it have  parent id so making child id

                  $sub_menu[] = &$s;

            }

      }



     // in this loop we are puting child into there parent 

      foreach ($menu as $key => $value) {

             $value['sub_menu'] = [];

             foreach ($sub_menu as $sk => $sub) {

            

                if ($value['id']==$sub['parent_id']){   

                   

                   array_push($value['sub_menu'],$sub);

                   

                  }  

             }



             array_push($new_menu,$value);

      }



      return $new_menu;

}



function date_convert($data)

{

   $strDate = substr($data,4,11);

    $finaldt = date('Y-m-d H:i:s', strtotime($strDate));

    return $finaldt;

}
function checkPermission($type){

      $user_id = Auth::guard('admin')->user()->id;

      $namedRoute         = \Route::currentRouteName();

      $namedRoute         = str_replace("index", $type, $namedRoute);

      
      
      $current_url_check  = DB::table('permissions')->select('menu_url')->where('menu_url', $namedRoute)->get()->toArray();
      
      if ($namedRoute)
      {
            if ($current_url_check)
            {
                  $permissionCheck = DB::table('permissions')
                  ->join('permission_user', 'permission_user.permission_id', '=', 'permissions.id')
                  ->where('user_id', $user_id)
                  ->where('menu_url', $namedRoute)
                  ->get()->toArray();
                  
                  if (empty($permissionCheck) || count($permissionCheck) <= 0)
                  {
                        return false;
                  }
            }
      }
      return true;
            
}

