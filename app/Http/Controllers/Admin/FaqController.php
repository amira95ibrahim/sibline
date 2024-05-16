<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqStoreRequest;
use App\Http\Requests\FaqUpdateRequest;
use App\DataTables\FaqDataTable;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(FaqDataTable $dataTable)
    {
        return $dataTable->render('admin.faq.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.faq.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Faq $faq)
    {
        return view('admin.faq.create')->with('faq', $faq);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Faq $occupation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Faq $faq)
    {
        return view('admin.faq.create')->with(['faq' => $faq , 'show' => true]);
    }

    /**
     * @param \App\Http\Requests\FaqStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqStoreRequest $request)
    {
        $faq = Faq::create($request->validated());

        return redirect()->route('admin.faq.index');
    }

    /**
     * @param \App\Http\Requests\FaqStoreRequest $request
     * @param \App\Models\Faq $occupation
     * @return \Illuminate\Http\Response
     */
    public function update(FaqStoreRequest $request, Faq $faq)
    {
        $faq->update($request->validated());

        return redirect()->route('admin.faq.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return response()->json(array('msg'=> 'Faq Deleted Successfully'), 200);
    }
}
