<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Form6StoreRequest;
use App\Http\Requests\Form6UpdateRequest;
use App\DataTables\Admin\SalesWeighbridgeINDataTable;
use App\Models\SalesWeighbridgeIN;
use Illuminate\Http\Request;

class Form6Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SalesWeighbridgeINDataTable $dataTable)
    {
        return $dataTable->render('admin.form6.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.form6.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Form6StoreRequest $request)
    {
        $SalesWeighbridgeIN = SalesWeighbridgeIN::create($request->validated());

        return redirect()->route('admin.form6.index');
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
    public function edit(Request $request, $id)
    {
        $SalesWeighbridgeIN= SalesWeighbridgeIN::find($id);
        return view('admin.form6.create')->with('SalesWeighbridgeIN',$SalesWeighbridgeIN);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Form6UpdateRequest $request, $id)
    {
        $SalesWeighbridgeIN= SalesWeighbridgeIN::find($id);
        $SalesWeighbridgeIN->update($request->validated());

        return redirect()->route('admin.form6.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $SalesWeighbridgeIN= SalesWeighbridgeIN::find($id);
        $SalesWeighbridgeIN->delete();

        return response()->json(array('msg'=> 'SalesWeighbridgeIN Deleted Successfully'), 200);
    }
}
