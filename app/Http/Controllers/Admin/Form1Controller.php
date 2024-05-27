<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CouponsGenerating;
use App\Http\Requests\Form1StoreRequest;
use App\Http\Requests\Form1UpdateRequest;
use App\DataTables\Admin\CouponsGeneratingDataTable;
use Illuminate\Http\Request;

class Form1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CouponsGeneratingDataTable $dataTable)
    {
        return $dataTable->render('admin.form1.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.form1.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Form1StoreRequest $request)
    {
        $CouponsGenerating = CouponsGenerating::create($request->validated());

        return redirect()->route('admin.form1.index');
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


     public function edit(Request $request,$id)
     {
        $CouponsGenerating= CouponsGenerating::find($id);
         return view('admin.form1.create')->with('CouponsGenerating', $CouponsGenerating);
     }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Form1UpdateRequest $request,  $id)
    {
        $CouponsGenerating= CouponsGenerating::find($id);
        $CouponsGenerating->update($request->validated());

        return redirect()->route('admin.form1.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $CouponsGenerating= CouponsGenerating::find($id);
        $CouponsGenerating->delete();

        return response()->json(array('msg'=> 'CouponsGenerating Deleted Successfully'), 200);
    }
}
