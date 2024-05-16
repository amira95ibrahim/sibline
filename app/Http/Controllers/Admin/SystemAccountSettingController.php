<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SystemAccountSettingDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SystemAccountSettingRequest;

use App\Models\SystemAccountSetting;
use Illuminate\Http\Request;

class SystemAccountSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SystemAccountSettingDataTable $dataTable)
    {
        return $dataTable->render('admin.system_account_setting.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.system_account_setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SystemAccountSettingRequest $request)
    {
        $system_account = $request->validated();
        $system_account =  SystemAccountSetting::create($system_account);
        return redirect()->route('admin.systemAccount.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SystemAccountSetting $system_account)
    {
        return view('admin.system_account_setting.create')->with([
            'system_account' => $system_account,  'show' => true
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $system_account = SystemAccountSetting::findOrFail($id);
        return view('admin.system_account_setting.create' ,compact('system_account') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SystemAccountSettingRequest $request,$id)
    {
        $system_account = SystemAccountSetting::findOrFail($id);
        $system_account->update($request->validated());
        return redirect()->route('admin.systemAccount.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $system_account = SystemAccountSetting::findOrFail($id);
        $system_account->delete();
        return response()->json(['msg' => 'System Account Settings Deleted Successfully'], 200);
    }
}
