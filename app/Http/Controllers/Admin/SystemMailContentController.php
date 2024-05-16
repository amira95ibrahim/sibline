<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SystemMailContentDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmailContent;
use App\Models\SystemMailContent;
use Illuminate\Http\Request;

class SystemMailContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SystemMailContentDataTable $dataTable)
    {
        return $dataTable->render('admin.system_mail_content.index');
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
        $email = SystemMailContent::findOrFail($id);
        return view('admin.system_mail_content.create' ,compact('email') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailContent $request, $id)
    {
        $email = SystemMailContent::findOrFail($id);
        $email->update($request->validated());
        return redirect()->route('admin.mails');
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
