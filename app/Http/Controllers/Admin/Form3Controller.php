<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Form3StoreRequest;
use App\Http\Requests\Form3UpdateRequest;
use App\DataTables\Admin\RMWeighbridgeINDataTable;
use App\Models\RMWeighbridgeIN;
use Illuminate\Http\Request;

class Form3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RMWeighbridgeINDataTable $dataTable)
    {
        return $dataTable->render('admin.form3.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.form3.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Form3StoreRequest $request)
    {
        // Get the validated data
        $data = $request->validated();

        // Add the authenticated user's ID to the data
        $data['user_id'] = Auth::id();

        // Create the CouponsGenerating record with the modified data
        RMWeighbridgeIN::create($data);

        return redirect()->route('admin.form3.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $RMWeighbridgeIN= RMWeighbridgeIN::find($id);
        return view('admin.form3.create')->with(['RMWeighbridgeIN' => $RMWeighbridgeIN , 'show' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $RMWeighbridgeIN= RMWeighbridgeIN::find($id);
        return view('admin.form3.create')->with('RMWeighbridgeIN',$RMWeighbridgeIN);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Form3UpdateRequest $request, $id)
    {
        $RMWeighbridgeIN= RMWeighbridgeIN::find($id);
        $RMWeighbridgeIN->update($request->validated());

        return redirect()->route('admin.form3.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $RMWeighbridgeIN= RMWeighbridgeIN::find($id);
        $RMWeighbridgeIN->delete();

        return response()->json(array('msg'=> 'RMWeighbridgeIN Deleted Successfully'), 200);
    }
}
