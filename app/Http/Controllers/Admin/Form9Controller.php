<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Form9StoreRequest;
use App\Http\Requests\Form9UpdateRequest;
use App\DataTables\Admin\SecurityLeavingDataTable;
use App\Models\SecurityLeaving;
use Illuminate\Http\Request;

class Form9Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SecurityLeavingDataTable $dataTable)
    {
        return $dataTable->render('admin.form9.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.form9.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Form9StoreRequest $request)
    {
        // Get the validated data
        $data = $request->validated();

        // Add the authenticated user's ID to the data
        $data['user_id'] = Auth::id();

        // Create the CouponsGenerating record with the modified data
        SecurityLeaving::create($data);

        return redirect()->route('admin.form9.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $SecurityLeaving= SecurityLeaving::find($id);
        return view('admin.form9.create')->with(['SecurityLeaving' => $SecurityLeaving , 'show' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id )
    {
        $SecurityLeaving= SecurityLeaving::find($id);
        return view('admin.form9.create')->with('SecurityLeaving',$SecurityLeaving);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Form9UpdateRequest $request, $id)
    {
        $SecurityLeaving= SecurityLeaving::find($id);
        $SecurityLeaving->update($request->validated());

        return redirect()->route('admin.form9.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $SecurityLeaving= SecurityLeaving::find($id);
        $SecurityLeaving->delete();

        return response()->json(array('msg'=> 'SecurityLeaving Deleted Successfully'), 200);
    }
}
