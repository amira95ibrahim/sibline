<?php

namespace App\Http\Controllers\Customer;

use App\DataTables\Customer\ProjectDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use App\Models\ProjectFiles;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProjectDataTable $dataTable)
    {
        $datatable = $dataTable->render('customer.dashboard._projects');
        if (request()->has('search')) {
            return $datatable;
        }

        return view('customer.dashboard.index', compact('datatable'));
    }

    public function edit(Request $request , $id)
    {
        $project = Project::find($id);
        return view('customer.projects.create', compact('project'));
    }

    public function update(Request $request , $id)
    {
        $project = Project::find($id);
        $documents_old = $project->documents;
        $project->documents()->delete();
        $documents = [];
        $i = 0;
        if (isset($request->document)) {
            foreach ($request->document as $document) {

                $documentName = isset($documents_old[$i]) ? $documents_old[$i]->path : "";
                // save image
                if (isset($document['path'])) {

                    $documentName = $document['name'].time().'.'.$document['path']->getClientOriginalExtension();

                    $document['path']->move(public_path('images'), $documentName);
                }

                $document['path'] = $documentName;
                $document['project_id'] = $id;
                $documents[] = ProjectFiles::create($document);

                $i++;
            }
        }

        return redirect()->back();
    }
}
