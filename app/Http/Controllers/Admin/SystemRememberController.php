<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SystemRememberDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\RememeberSystemReqest;
use App\Models\ProjectAccounts;
use App\Models\SystemRemember;
use Illuminate\Http\Request;

class SystemRememberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SystemRememberDataTable $dataTable)
    {
        return $dataTable->render('admin.system_remember_setting.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        $system_remember = SystemRemember::findOrFail($id);
        return view('admin.system_remember_setting.create' ,compact('system_remember') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RememeberSystemReqest $request, $id)
    {
        $system_remember = SystemRemember::findOrFail($id);
        $system_remember->update($request->validated());
        return redirect()->route('admin.systemRemember.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
