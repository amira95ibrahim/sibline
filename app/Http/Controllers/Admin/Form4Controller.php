<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Form4StoreRequest;
use App\Http\Requests\Form4UpdateRequest;
use App\DataTables\Admin\RMWeighbridgeOUTDataTable;
use App\Models\RMWeighbridgeOUT;
use Illuminate\Http\Request;

class Form4Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RMWeighbridgeOUTDataTable $dataTable)
    {
        return $dataTable->render('admin.form4.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.form4.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Form4StoreRequest $request)
    {
        // Get the validated data
        $data = $request->validated();

        // Add the authenticated user's ID to the data
        $data['user_id'] = Auth::id();

        // Create the CouponsGenerating record with the modified data
        RMWeighbridgeOUT::create($data);

        return redirect()->route('admin.form4.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $RMWeighbridgeOUT= RMWeighbridgeOUT::find($id);
        return view('admin.form4.create')->with(['RMWeighbridgeOUT' => $RMWeighbridgeOUT , 'show' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $RMWeighbridgeOUT= RMWeighbridgeOUT::find($id);
        return view('admin.form4.create')->with('RMWeighbridgeOUT',$RMWeighbridgeOUT);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Form4UpdateRequest $request, $id)
    {
        $RMWeighbridgeOUT= RMWeighbridgeOUT::find($id);
        $RMWeighbridgeOUT->update($request->validated());

        return redirect()->route('admin.form4.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $RMWeighbridgeOUT= RMWeighbridgeOUT::find($id);
        $RMWeighbridgeOUT->delete();

        return response()->json(array('msg'=> 'RMWeighbridgeOUT Deleted Successfully'), 200);
    }
}
