<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ProjectAccountDataTable;
use App\Models\ProjectAccounts;
class ProjectAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectAccountDataTable $dataTable , $id)
    {   
     //dd('kk');
          return $dataTable->with( 'id' , $id)->render('admin.projects.components.accounts',
          [
           
          'approve_missing' => ProjectAccounts::where(['id'=>$id ,'authorization_status' => 1 ,  ['ac_name', null ] , ['ac_phone', null ], ['ac_email' , null ] , ['ac_address', null ] ])->count(),
          'approve_accounts' => ProjectAccounts::where(['id'=>$id , 'authorization_status' => 1 ,  ['ac_name' , '!=', null ] , ['ac_phone' , '!=', null ], ['ac_email' , '!=', null ] , ['ac_address' , '!=', null ]])->count(),
          'refuse_account' =>ProjectAccounts::where(['id'=>$id ,'authorization_status' => 0  ])->count(),
          'pending_accounts' => ProjectAccounts::where(['id'=> $id , 'authorization_status' => null ])->count(),
         ]
        );
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
