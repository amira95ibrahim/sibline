<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Form2StoreRequest;
use App\Http\Requests\Form2UpdateRequest;
use App\DataTables\Admin\KioskCoordinatorDataTable;
use App\Models\KioskCoordinator;
use Illuminate\Http\Request;

class Form2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KioskCoordinatorDataTable $dataTable)
    {
        return $dataTable->render('admin.form2.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.form2.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Form2StoreRequest $request)
    {
         // Get the validated data
         $data = $request->validated();

         // Add the authenticated user's ID to the data
         $data['user_id'] = Auth::id();

         // Create the CouponsGenerating record with the modified data
         KioskCoordinator::create($data);

        return redirect()->route('admin.form2.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $KioskCoordinator= KioskCoordinator::find($id);
        return view('admin.form2.create')->with(['KioskCoordinator' => $KioskCoordinator , 'show' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
         $KioskCoordinator=KioskCoordinator::find($id);
        return view('admin.form2.create')->with('KioskCoordinator', $KioskCoordinator);;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Form2UpdateRequest $request, $id)
    {
        $KioskCoordinator= KioskCoordinator::find($id);
        $KioskCoordinator->update($request->validated());

        return redirect()->route('admin.form2.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $KioskCoordinator= KioskCoordinator::find($id);
        $KioskCoordinator->delete();

        return response()->json(array('msg'=> 'KioskCoordinator Deleted Successfully'), 200);
    }
}
