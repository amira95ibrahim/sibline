<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Form10StoreRequest;
use App\Http\Requests\Form10UpdateRequest;
use App\DataTables\Admin\QuarryCoordinatorDataTable;
use App\Models\QuarryCoordinator;
use Illuminate\Http\Request;

class Form10Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QuarryCoordinatorDataTable $dataTable)
    {
        return $dataTable->render('admin.form10.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.form10.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Form10StoreRequest $request)
    {
        $QuarryCoordinator = QuarryCoordinator::create($request->validated());

        return redirect()->route('admin.form10.index');
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
        $QuarryCoordinator= QuarryCoordinator::find($id);
        return view('admin.form10.create')->with('QuarryCoordinator',$QuarryCoordinator);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Form10UpdateRequest $request, $id)
    {
        $QuarryCoordinator= QuarryCoordinator::find($id);
        $QuarryCoordinator->update($request->validated());

        return redirect()->route('admin.form10.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $QuarryCoordinator= QuarryCoordinator::find($id);
        $QuarryCoordinator->delete();

        return response()->json(array('msg'=> 'QuarryCoordinator Deleted Successfully'), 200);
    }
}
