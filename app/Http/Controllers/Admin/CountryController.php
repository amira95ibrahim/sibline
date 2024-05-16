<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryStoreRequest;
use App\DataTables\CountryDataTable;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(CountryDataTable $dataTable)
    {

        return $dataTable->render('admin.country.index');

    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.country.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Country $country)
    {
        return view('admin.country.create')->with('country', $country);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Country $country)
    {
        return view('admin.country.create')->with(['country' => $country , 'show' => true]);
    }

    /**
     * @param \App\Http\Requests\CountryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryStoreRequest $request)
    {
        $country = Country::create($request->validated());

        return redirect()->route('admin.country.index');
    }

    /**
     * @param \App\Http\Requests\CountryUpdateRequest $request
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function update(CountryStoreRequest $request, Country $country)
    {
        $country->update($request->validated());

        return redirect()->route('admin.country.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();

        return response()->json(array('msg'=> 'Country Deleted Successfully'), 200);
    }

    /**
     * Get all childs for parent.
     * 
     * @param int $id
     * @return json
     */
    public function getChilds($id)
    {
        $country = Country::find($id);

        $childs = [];

        if($country)
          $childs = $country->childs;  

        return response()->json(array('values'=> $childs), 200);
    }

}
