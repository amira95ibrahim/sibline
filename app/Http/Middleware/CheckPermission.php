<?php

namespace App\Http\Middleware;
use Auth;
use DB;

use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard('admin')->check()){
         $user_id = Auth::guard('admin')->user()->id;

            $namedRoute         = \Route::currentRouteName();
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
                        return response()->view('admin.errors.permission_deneid', [], 404);
                    }
                }
            }

         }


        return $next($request);
    }
}
