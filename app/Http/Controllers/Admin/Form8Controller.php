<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Form8StoreRequest;
use App\Http\Requests\Form8UpdateRequest;
use App\DataTables\Admin\SecurityArrivalDataTable;
use App\Models\SecurityArrival;
use Illuminate\Http\Request;

class Form8Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SecurityArrivalDataTable $dataTable)
    {
        return $dataTable->render('admin.form8.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.form8.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Form8StoreRequest $request)
    {
        // Get the validated data
        $data = $request->validated();

        // Add the authenticated user's ID to the data
        $data['user_id'] = Auth::id();

        // Create the CouponsGenerating record with the modified data
        SecurityArrival::create($data);

        return redirect()->route('admin.form8.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $SecurityArrival= SecurityArrival::find($id);
        return view('admin.form8.create')->with(['SecurityArrival' => $SecurityArrival , 'show' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,  $id)
    {
        $SecurityArrival= SecurityArrival::find($id);
        return view('admin.form8.create')->with('SecurityArrival',$SecurityArrival);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Form8UpdateRequest $request, $id)
    {
        $SecurityArrival= SecurityArrival::find($id);
        $SecurityArrival->update($request->validated());

        return redirect()->route('admin.form8.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $SecurityArrival= SecurityArrival::find($id);
        $SecurityArrival->delete();

        return response()->json(array('msg'=> 'SecurityArrival Deleted Successfully'), 200);
    }
}
