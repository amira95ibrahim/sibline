<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Form7StoreRequest;
use App\Http\Requests\Form7UpdateRequest;
use App\DataTables\Admin\SalesWeighbridgeOUTDataTable;
use App\Models\SalesWeighbridgeOUT;
use Illuminate\Http\Request;

class Form7Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SalesWeighbridgeOUTDataTable $dataTable)
    {
        return $dataTable->render('admin.form7.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.form7.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Form7StoreRequest $request)
    {
        $SalesWeighbridgeOUT = SalesWeighbridgeOUT::create($request->validated());

        return redirect()->route('admin.form7.index');
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
        $SalesWeighbridgeOUT= SalesWeighbridgeOUT::find($id);
        return view('admin.form7.create')->with('SalesWeighbridgeOUT',$SalesWeighbridgeOUT);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Form7UpdateRequest $request, $id)
    {
        $SalesWeighbridgeOUT= SalesWeighbridgeOUT::find($id);
        $SalesWeighbridgeOUT->update($request->validated());

        return redirect()->route('admin.form7.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $SalesWeighbridgeOUT= SalesWeighbridgeOUT::find($id);
        $SalesWeighbridgeOUT->delete();

        return response()->json(array('msg'=> 'SalesWeighbridgeOUT Deleted Successfully'), 200);
    }
}
