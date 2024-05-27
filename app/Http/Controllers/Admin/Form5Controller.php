<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\Admin\KioskCoordinatorTrancimDataTable;
use App\Models\KioskCoordinatorTrancim;
use Illuminate\Http\Request;

class Form5Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KioskCoordinatorTrancimDataTable $dataTable)
    {
        return $dataTable->render('admin.form5.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.form5.create');
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
    public function edit(Request $request,KioskCoordinatorTrancim $KioskCoordinatorTrancim)
    {
        return view('admin.form5.create')->with('KioskCoordinatorTrancim',$KioskCoordinatorTrancim);
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
        $KioskCoordinatorTrancim= KioskCoordinatorTrancim::find($id);
        $KioskCoordinatorTrancim->delete();

        return response()->json(array('msg'=> 'KioskCoordinatorTrancim Deleted Successfully'), 200);
    }
}
