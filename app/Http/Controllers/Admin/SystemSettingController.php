<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SystemSettingUpdateRequest;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class SystemSettingController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $systemSetting = SystemSetting::orderBy('id','desc')->first();

        return view('admin.system_setting.create', compact('systemSetting'));

    }

    /**
     * @param \App\Http\Requests\SystemSettingUpdateRequest $request
     * @param \App\Models\SystemSetting $systemSetting
     * @return \Illuminate\Http\Response
     */
    public function update(SystemSettingUpdateRequest $request,$id)
    {
        $new_systemSetting = $request->validated();

        if($request->file('favicon')){
            $faviconName = 'system_'.time().'.'.$request->favicon->extension();

            $request->favicon->move(public_path('images'), $faviconName);

            $new_systemSetting['favicon'] = $faviconName;
        }



        if($request->file('logo_header')){
            $logoHeaderName = 'system_header_'.time().'.'.$request->logo_header->extension();

            $request->logo_header->move(public_path('images'), $logoHeaderName);

            $new_systemSetting['logo_header'] = $logoHeaderName;
        }



        if($request->file('logo_footer')){
            $logoFooterName = 'system_footer_'.time().'.'.$request->logo_footer->extension();

            $request->logo_footer->move(public_path('images'), $logoFooterName);

            $new_systemSetting['logo_footer'] = $logoFooterName;
        }

        if($request->file('logo_login')){
            $logoLoginName = 'system_login_'.time().'.'.$request->logo_login->extension();

            $request->logo_login->move(public_path('images'), $logoLoginName);

            $new_systemSetting['logo_login'] = $logoLoginName;
        }

        if($request->file('background_login')){
            $logoBackgroundName = 'background_login_'.time().'.'.$request->background_login->extension();

            $request->background_login->move(public_path('images'), $logoBackgroundName);

            $new_systemSetting['background_login'] = $logoBackgroundName;
        }

        $systemSetting = SystemSetting::find($id);
        $systemSetting->update($new_systemSetting);

        return redirect()->route('admin.system.index');
    }
}
