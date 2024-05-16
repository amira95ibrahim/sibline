<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\EmailTemplateDataTable;
use App\Http\Requests\EmailTemplateStoreRequest;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(EmailTemplateDataTable $dataTable)
    {
        return $dataTable->render('admin.email-template.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.email-template.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EmailTemplate $emailTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, EmailTemplate $emailTemplate)
    {
        return view('admin.email-template.create')->with('emailTemplate', $emailTemplate);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EmailTemplate $occupation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, EmailTemplate $emailTemplate)
    {
        return view('admin.email-template.create')->with(['emailTemplate' => $emailTemplate , 'show' => true]);
    }

    /**
     * @param \App\Http\Requests\EmailTemplateStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailTemplateStoreRequest $request)
    {
        $emailTemplate = EmailTemplate::create($request->validated());

        return redirect()->route('admin.email-template.index');
    }

    /**
     * @param \App\Http\Requests\EmailTemplateStoreRequest $request
     * @param \App\Models\EmailTemplate $occupation
     * @return \Illuminate\Http\Response
     */
    public function update(EmailTemplateStoreRequest $request, EmailTemplate $emailTemplate)
    {
        $emailTemplate->update($request->validated());

        return redirect()->route('admin.email-template.index');
    }
}