<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Project\ProjectAccountsExport;

use App\Http\Controllers\Controller;
 use App\Console\ChromePhp;
use App\DataTables\ProjectDataTable;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use App\Models\ProjectFiles;
use App\Models\SystemAccountSetting;
use App\Models\SystemMailContent;
use App\Models\User;
use App\Models\CustomerContact;
use App\Models\Customer;
use App\Models\ProjectAccounts;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\DataTables\ProjectAccountDataTable;
use App\DataTables\ProjectAccountApproveMissingDataTable;
use App\DataTables\ProjectAccountApproveDataTable;
use App\DataTables\ProjectAccountRefuseDataTable;
use App\DataTables\ProjectAccountPendingDataTable;
use \Mail;
use Illuminate\Support\Arr;
use App\Models\SystemSetting;
use Auth, Hash, Session, Route;
use Barryvdh\DomPDF\Facade\Pdf;
use TCPDF;

use App\DataTables\EmailTemplateDataTable;
use App\Http\Requests\EmailTemplateStoreRequest;
use App\Models\EmailTemplate;
use App\Models\Address;

class ProjectController extends Controller
{
    
    
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->guard = explode('.', Route::currentRouteName())[0];
    }

    public function index(ProjectDataTable $dataTable)
    {
        return $dataTable->render('admin.projects.index');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(ProjectAccountDataTable $dataTable, Request $request)
    {
        $datatable = $dataTable->render('admin.projects.components.accounts');

        $users = User::all();

        return view('admin.projects.create', compact('users', 'datatable'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Project $project)
    {

        $datatable = app(ProjectAccountDataTable::class)
            ->with(['project_id' => $project->id])
            ->render('admin.projects.components.accounts');

        if (request()->has('search') && $request->table_name === 'accounts_table') {
            return $datatable;
        }
        $datatable_pending = app(ProjectAccountPendingDataTable::class)
            ->with(['project_id' => $project->id])
            ->render('admin.projects.components.pending-accounts');
        if (request()->has('search') && $request->table_name === 'pending_table') {
            return $datatable_pending;
        }
        $datatable_approve_missing = app(ProjectAccountApproveMissingDataTable::class)
            ->with(['project_id' => $project->id])
            ->render('admin.projects.components.approve-missing-accounts');
        if (request()->has('search') && $request->table_name === 'approve_missing_table') {
            return $datatable_approve_missing;
        }
        $datatable_approve = app(ProjectAccountApproveDataTable::class)
            ->with(['project_id' => $project->id])
            ->render('admin.projects.components.approve-accounts');
        if (request()->has('search') && $request->table_name === 'approve_table') {
            return $datatable_approve;
        }
        $datatable_refuse = app(ProjectAccountRefuseDataTable::class)
            ->with(['project_id' => $project->id])
            ->render('admin.projects.components.refuse-accounts');
        if (request()->has('search') && $request->table_name === 'refuse_table') {
            return $datatable_refuse;
        }
        $accounts = ProjectAccounts::where('project_id', $project->id)->get();

        return view('admin.projects.create',
            compact('accounts', 'project', 'datatable', 'datatable_approve_missing'
                , 'datatable_approve', 'datatable_refuse', 'datatable_pending'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Project $project, ProjectAccountDataTable $dataTable)
    {
        $datatable = $dataTable->with('project_id', $project->id)
                               ->render('admin.projects.components.accounts');
        if (request()->has('search') && $request->table_name === 'pending_table') {
            return $datatable;
        }
        
        $datatable_approve_missing = app(ProjectAccountApproveMissingDataTable::class)
            ->with(['project_id' => $project->id])
            ->render('admin.projects.components.approve-missing-accounts');
        if (request()->has('search') && $request->table_name === 'approve_missing_table') {
            return $datatable_approve_missing;
        }
        $datatable_approve = app(ProjectAccountApproveDataTable::class)
            ->with(['project_id' => $project->id])
            ->render('admin.projects.components.approve-accounts');
        if (request()->has('search') && $request->table_name === 'approve_table') {
            return $datatable_approve;
        }
        $datatable_refuse = app(ProjectAccountRefuseDataTable::class)
            ->with(['project_id' => $project->id])
            ->render('admin.projects.components.refuse-accounts');
        if (request()->has('search') && $request->table_name === 'refuse_table') {
            return $datatable_refuse;
        }

        return view('admin.projects.create')->with([
            'project'                     => $project, 'datatable' => $datatable, 'show' => true
            , 'datatable_approve_missing' => $datatable_approve_missing
            , 'datatable_approve'         => $datatable_approve
            , 'datatable_refuse'          => $datatable_refuse,
        ]);
    }

    /**
     * @param  \App\Http\Requests\ProjectStoreRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(ProjectStoreRequest $request)
     {   
       $start_account_no_type = SystemAccountSetting::all();
       $project = Project::create($request->validated());
        $project->users()->attach($request->user_ids);
        $documents = [];
        if (isset($request->document) && $request->document != null) {
            foreach ($request->document as $document) {
                // save document
                if (isset($document['path'])) {
                    $documentName = $document['name'].time().'.'.$document['path']->getClientOriginalExtension();

                    $document['path']->move(public_path('images'), $documentName);
                    $document['path'] = $documentName;
                    $document['project_id'] = $project->id;
                    $documents[] = ProjectFiles::create($document);
                }
            }
        }
        $data = [];
      
      // return $request;
        if ($request->has('account_name') && $request->account_name) {
            if (isset($request->data[0])) { //return $request->data[0];
        
                foreach ($request->data[0] as $key => $account_name_data) {
              $start_account_no_request=$request->data[0][$key];
                      $type=null;
                      $f=0;
                     foreach($start_account_no_type as $num)
                  {
                       // if(strcmp($num->start_account_no,substr($start_account_no_request,0,3))==0)
                       if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      {
                         
                              $type=$num->type;  
                            $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ]; $f=1;
                      }
                  }
                  
                            //  ChromePhp::log($start_account_no_request." ".$type." ".preg_match("/^{$num->start_account_no}/",$start_account_no_request));
                   if(!$f) {
                       $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ];}
                }
                

            }
          
        } elseif ($request->has('account_number') && $request->account_number) {
            foreach ($request->data[$request->account_number] as $key => $account_name_data) {
                

                  $start_account_no_request=$request->data[$request->account_number][$key];
                     $type=null;
                      $f=0;
                     foreach($start_account_no_type as $num)
                  {
                       // if(strcmp($num->start_account_no,substr($start_account_no_request,0,3))==0)
                       if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      {
                         
                              $type=$num->type;  
                            $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ]; $f=1;
                      }
                  }
                   
                  
                            //  ChromePhp::log($start_account_no_request." ".$type." ".preg_match("/^{$num->start_account_no}/",$start_account_no_request));
                   if(!$f) {
                       $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ];
                }
            }

            
          
        } elseif ($request->has('currency') && $request->currency) {
            foreach ($request->data[$request->currency] as $key => $account_name_data) {
        
              $start_account_no_request=$request->data[$request->account_number][$key];
                   $start_account_no_request=$request->data[$request->account_number][$key];
                        $type=null;
                      $f=0;
                     foreach($start_account_no_type as $num)
                  {
                       // if(strcmp($num->start_account_no,substr($start_account_no_request,0,3))==0)
                       if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      {
                         
                              $type=$num->type;  
                            $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ]; $f=1;
                      }
                  }
                  }
                            //  ChromePhp::log($start_account_no_request." ".$type." ".preg_match("/^{$num->start_account_no}/",$start_account_no_request));
                   if(!$f) {
                       $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ];}
                
            
        } elseif ($request->has('debit') && $request->debit) {
            foreach ($request->data[$request->debit] as $key => $account_name_data) {
      $start_account_no_request=$request->data[$request->account_number][$key];
                              $type=null;
                      $f=0;
                     foreach($start_account_no_type as $num)
                  {
                       // if(strcmp($num->start_account_no,substr($start_account_no_request,0,3))==0)
                       if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      {
                         
                              $type=$num->type;  
                            $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ]; $f=1;
                      }
                  }
                  }
                            //  ChromePhp::log($start_account_no_request." ".$type." ".preg_match("/^{$num->start_account_no}/",$start_account_no_request));
                   if(!$f) {
                       $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ];}
                
            
        } elseif ($request->has('credit') && $request->credit) {
            foreach ($request->data[$request->credit] as $key => $account_name_data) {
        $start_account_no_request=$request->data[$request->account_number][$key];
        
                      $type=null;
                      $f=0;
                     foreach($start_account_no_type as $num)
                  {
                       // if(strcmp($num->start_account_no,substr($start_account_no_request,0,3))==0)
                       if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      {
                         
                              $type=$num->type;  
                            $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ]; $f=1;
                      }
                  }
                  }
                            //  ChromePhp::log($start_account_no_request." ".$type." ".preg_match("/^{$num->start_account_no}/",$start_account_no_request));
                   if(!$f) {
                       $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ];}
                
            
        } elseif ($request->has('balance') && $request->balance) {
            foreach ($request->data[$request->balance] as $key => $account_name_data) {
    
                 $start_account_no_request=$request->data[$request->account_number][$key];
                     
                      $type=NULL;
                      $f=0;
                     foreach($start_account_no_type as $num)
                  {
                       // if(strcmp($num->start_account_no,substr($start_account_no_request,0,3))==0)
                       if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      {
                         
                      $type=$num->type;  
                      $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                        'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                        ];
                     $f=1;
                      }
                      
                  }
                    //  ChromePhp::log($start_account_no_request." ".$type." ".preg_match("/^{$num->start_account_no}/",$start_account_no_request));
                  if(!$f) {
                
                       $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ];}
                
            }
        }
        
        $project_account = ProjectAccounts::insert($data);
        if($request->has('cfo_email')&&$request->cfo_email){
              $system_info = SystemSetting::orderBy('id', 'desc')->first();
            // $content_mail = SystemMailContent::where('name_mail','Send Authorization Request')->first();
             $emailTemplate = EmailTemplate::where('id','1')->first();
                       $title =$emailTemplate->title;
                       $body  =$emailTemplate->body; 
            $subject = 'Athorization Request';
           // $contact_email = '$account->project';
            
            $email = $system_info->email;
             $name = $system_info->short_name;
            $cfo_email=$project->cfo_email;
             $customer = CustomerContact::where('email',$cfo_email)->get();
             $customer_password= $customer[0]->password;
            $customer_email= $customer[0]->email;
                Mail::send('emails.new_project', [
                     'title' => $title,  'body' => $body, 'customer_email'=>$customer_email , 'customer_password'=>$customer_password,
                     'token' => route('customer.login'), 
                    'customer_name' => $project->cfo_name,
                   // 'account_no' => $project->customer->cfo_email, 
                    'guard' => $this->guard,
                ],
                    function ($message) use ( $email, $name, $subject ,$title,$cfo_email) {
                        $message->from($email, $name);
                        $message->to($cfo_email)->subject($title ?? $subject );
                    });
         }
        return redirect()->route('admin.project.index', $project->id)->with('success','Project stored sucessfully & Email sent to CFO');
    }

    /**
     * @param  \App\Http\Requests\ProjectUpdateRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectUpdateRequest $request, Project $project)
    {
      //  $x=80;$str=8003;
     // return preg_match("/^{$x}/","{$str}");
       $start_account_no_type = SystemAccountSetting::all();
        $project->update($request->validated());
        $project->users()->detach();
        $project->users()->attach($request->user_ids);
       $start_account_no_type = SystemAccountSetting::select('*')->get(); 
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
                $document['project_id'] = $project->id;
                $documents[] = ProjectFiles::create($document);

                $i++;
            }
        }
        $type='';
        $data = [];
    //   return $request;
        if ($request->has('account_name') && $request->account_name) {
          //  $arr=array();
             $typ=array();
            if (isset($request->data[0])) {
                foreach ($request->data[0] as $key => $account_name_data) {
                      $start_account_no_request=$request->data[0][$key];
                 $type=null;
                      $f=0;
                     foreach($start_account_no_type as $num)
                  {
                       // if(strcmp($num->start_account_no,substr($start_account_no_request,0,3))==0)
                       if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      {
                         
                              $type=$num->type;  
                            $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ]; $f=1;
                      }
                  }
                  
                   if(!$f) {
                       $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ];}
                }}
        } elseif ($request->has('account_number') && $request->account_number) {
            foreach ($request->data[$request->account_number] as $key => $account_name_data) {
               $start_account_no_request=$request->data[0][$key];
                    $type=null;
                      $f=0;
                     foreach($start_account_no_type as $num)
                  {
                       // if(strcmp($num->start_account_no,substr($start_account_no_request,0,3))==0)
                       if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      {
                         
                              $type=$num->type;  
                            $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ]; $f=1;
                      }
                  }
                  
                   if(!$f) {
                       $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ];}
            }
        } elseif ($request->has('currency') && $request->currency) {
          foreach ($request->data[$request->currency] as $key => $account_name_data) {
                $start_account_no_request=$request->data[0][$key];
                  $type=null;
                      $f=0;
                     foreach($start_account_no_type as $num)
                  {
                       // if(strcmp($num->start_account_no,substr($start_account_no_request,0,3))==0)
                       if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      {
                         
                              $type=$num->type;  
                            $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ]; $f=1;
                      }
                  }
                  
                   if(!$f) {
                       $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ];}
            }
            
        } elseif ($request->has('debit') && $request->debit) {
            foreach ($request->data[$request->debit] as $key => $account_name_data) {
            
                $start_account_no_request=$request->data[0][$key];
                 $type=null;
                      $f=0;
                     foreach($start_account_no_type as $num)
                  {
                       // if(strcmp($num->start_account_no,substr($start_account_no_request,0,3))==0)
                       if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      {
                         
                              $type=$num->type;  
                            $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ]; $f=1;
                      }
                  }
                  
                   if(!$f) {
                       $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ];}
            }
        } elseif ($request->has('credit') && $request->credit) {
            foreach ($request->data[$request->credit] as $key => $account_name_data) {
            
                $start_account_no_request=$request->data[0][$key];
              $type=null;
                      $f=0;
                     foreach($start_account_no_type as $num)
                  {
                       // if(strcmp($num->start_account_no,substr($start_account_no_request,0,3))==0)
                       if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      {
                         
                              $type=$num->type;  
                            $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ]; $f=1;
                      }
                  }
                  
                   if(!$f) {
                       $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ];}
                }
        } elseif ($request->has('balance') && $request->balance) {
            foreach ($request->data[$request->balance] as $key => $account_name_data) {
                  $start_account_no_request=$request->data[0][$key];
              $type=null;
                      $f=0;
                     foreach($start_account_no_type as $num)
                  {
                       // if(strcmp($num->start_account_no,substr($start_account_no_request,0,3))==0)
                       if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      {
                         
                              $type=$num->type;  
                            $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ]; $f=1;
                      }
                  }
                  
                   if(!$f) {
                       $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ??null,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ];}
                }
        }
        $project_account = ProjectAccounts::insert($data);
   
        return redirect()->route('admin.project.edit', $project->id)->with('success','Project updated sucessfully');;
    }

    public function destroy(Project $project)
    {
        // return $project->users;
        $project->accounts()->delete();
        $project->documents()->delete();
        // $project->users()->delete();
        $project->delete();

        return response()->json(['msg' => 'Project Deleted Successfully'], 200);
    }

    public function get_data_accounts_ajax($id){
        $account = ProjectAccounts::where('id' , $id)->with(['project'])->first();
        return view('admin.projects.components.approve-accounts-data', compact('account'));
    }
    public function sendRequestsCustomer(Request $request)
    {

        if ($request->info[1]) {
            foreach ($request->info[1] as $ac_id) {
                $account = ProjectAccounts::where('id', $ac_id)->first();
                $account->authorization_request = 1;
                $account->authorization_status = 1;  // pending
                $account->save();
                //return $system_info;

            }
            $system_info = SystemSetting::orderBy('id', 'desc')->first();
            // $content_mail = SystemMailContent::where('name_mail','Send Authorization Request')->first();
             $emailTemplate = EmailTemplate::where('id','8')->first();
                       $title = $emailTemplate->title;
                       $body =$emailTemplate->body; 
            $subject = 'Athorization Request';
            $contact_email = $account->project;
            
            $email = $system_info->email;
            $name = $system_info->short_name;
            // foreach ($contact_emails as $to) {
            
                Mail::send('emails.authorization_request_email', [
                     'title' => $title,  'body' => $body,
                    'token'      => route('customer.login'), 
                    'customer_name' => $account->project->customer->name,
                    'account_no' => $account->account_number, 
                    'guard' => $this->guard,
                ],
                    function ($message) use ($contact_email, $email, $name, $subject ,$title) {
                        $message->from($email, $name);
                        $message->to($contact_email->cfo_email)->subject($title ?? $subject );
                    });
            // }

            return 'success';
        }
            
        

        return 'failed';
    }

    public function sendConfirmationCustomer(Request $request)
    {

        if ($request->info[1]) {
        //   return $request->info[1];
            foreach ($request->info[1] as $ac_id) {

                $account = ProjectAccounts::where('id', $ac_id)->first(); 
                // return $account;
                if ($account->confirmation_email == 0) {
                    $account->confirmation_email = 1;
                    $account->save(); 
                    $system_info = SystemSetting::orderBy('id', 'desc')->first();
                  
                    $castomerContacts = $account->project->customer->castomerContacts;
                    $email = $system_info->email;
                    $name = $system_info->short_name;
                    // $content_mail = SystemMailContent::where('name_mail','Confirmation Letter')->first();
                    $account_type= $account->account_type;
                    $id=$account->project_id;
                    $file='';
                    // return $castomerContacts;
                    foreach ($castomerContacts as $castomer) {
                        // return $castomer;
                        if($account_type=='bank')  $file='banks';
                        else if ($account_type=='supplier')  $file='suppliers';
                        else if ($account_type=='client')  $file='clients';
                       $emailTemplate = EmailTemplate::where('id','6')->first();
                       $title = $emailTemplate->title;
                       $body =$emailTemplate->body;  
                      
                        Mail::send('emails.confirmation_letter_email', [
                            'title' => $title,  'body' => $body,
                            'customer_hash'    => $castomer->hash, 'account_hash' => $account->hash,
                            'system_info_hash' => $system_info->hash,
                            'customer_name'    => $account->ac_name,
                            // 'content_mail' => $content_mail,
                            'account_no'       => $account->account_number, 'guard' => $this->guard,
                            'file'=>$file ,
                            'id'=>$id
                        ],
                            function ($message) use ($account, $email, $name ,$title) {
                                $message->from($email, $name);
                                $message->to($account->ac_email)->subject($title ??'Confirmation Letter');
                            });
                    }
                }
            }

            return 'success';
        }

        return 'faild';
    }
      public function sendEmailLetter(Request $request)
    {
              $escapers = array("\'");
              $replacements = array("\\/"); 
              $result = str_replace($escapers, $replacements, $request->project);
              $data=  json_decode($result);
              $system_info = SystemSetting::orderBy('id', 'desc')->first();
              $email = $system_info->email;
              $name = $system_info->short_name;
              $letterType = str_replace($escapers, $replacements, $request->letterType);
            //   $content_mail = SystemMailContent::where('name_mail',$letterType)->first();
              $id=$data->id;
              
                        if($letterType=='Engagement Letter'){
                              $letterType='engagmentLetter';
                          $emailTemplate = EmailTemplate::where('id','2')->first(); 
                
                            
                        }
                          else if($letterType=='Representation Letter'){
                               $letterType='representationLetter';
                                $emailTemplate = EmailTemplate::where('id','3')->first();}
                         else if($letterType=='Authorization Letter'){
                               $letterType='authorizationLetter';
                                $emailTemplate = EmailTemplate::where('id','5')->first();}
                        else if($letterType=='Approval Request Letter'){
                               $letterType='approvalRequest';
                                $emailTemplate = EmailTemplate::where('id','4')->first();}
       

        
        $title = $emailTemplate->title;
        $header = $emailTemplate->header;
        //  $body = strtr($emailTemplate->body, $vars);
        $body =$emailTemplate->body;
        $footer = $emailTemplate->footer;
            //   return $letterType;
                Mail::send('emails.master-template',[   'customer_name'    => $data->cfo_name, 'letterType'=>$letterType,
                             'id'=>$id,'title' => $title, 'header' => $header, 'body' => $body, 'footer' => $footer], 
                  function ($message) use ($data,$email,$name,$title){
                      $message->from($email,$name);
                      $message->to($data->cfo_email)->subject($title);
             });
        
        
    }
    
    public function multi_delete(Request $request)
    {
        
        if ($request->info[1]) {
            foreach ($request->info[1] as $ac_id) {
                $account = ProjectAccounts::where('id', $ac_id)->first();

                $account->delete();
            }

            return 'success';
        }

        return 'faild';
    }

    public function project_data($customer_hash, $account_hash, $system_info_hash)
    {

        $customer_contact = CustomerContact::byHash($customer_hash);
        $account = ProjectAccounts::byHash($account_hash);
        $system_setting = SystemSetting::byHash($system_info_hash);

        // dd($account);
        return view('customer.page_data_email.project_data',
            compact('customer_contact', 'account', 'system_setting'));
    }

    public function project_data_store(Request $request, $account_hash)
    {
       // dd($request->all());
        $validate = $request->validate([
            'type_replay'  => 'string',
            'is_replay'    => 'string',
            'comment'      => 'string',
            'attachements'  => 'array',
            'attachements.*'  => 'file',
            'c_first_name' => 'string',
            'c_last_name'  => 'string',
            'c_email'      => 'email',
            'c_position'   => 'string',
        ]);

        if (Arr::pull($validate, 'attachements')) {
            foreach($request->attachements as $attachement){
                $imageName = 'account_project_'.time().'.'.$attachement->extension();
                $attachement->move(public_path('images'), $imageName);
                $validate['attachement'][] = $imageName;
            }
        }

        $account = ProjectAccounts::byHashOrFail($account_hash);
        //dd($account);
        $account->update($validate);
       // dd($account);
            $subject = 'Confirm receipt of a reply';
            $email = $account->ac_email;
            $name = $account->ac_name;
            $system_info = SystemSetting::orderBy('id', 'desc')->first();
        //   $content_mail = SystemMailContent::where('name_mail','Confirmation Reply Received')->first();
            $emailTemplate = EmailTemplate::where('id','7')->first();
             $title = $emailTemplate->title;
        $header = $emailTemplate->header;
        //  $body = strtr($emailTemplate->body, $vars);
        $body =$emailTemplate->body;
        $footer = $emailTemplate->footer;
            $admins = $account->project->users;
            foreach ($admins as $admin) {
                Mail::send('emails.email_reply_to_customer',
                    ['account' => $account,
                        'token'   => route('admin.login'),
                        'admin_name' => $admin->name,
                         'title' => $title , 'header' => $header, 'body' => $body, 'footer' => $footer,
                        'system_info' => $system_info,
                         'guard' => $this->guard,],
                    function ($message) use ($email, $name, $subject, $admin , $title) {
                        $message->from($email, $name);
                        $message->to($admin->email)->subject($title ?? $subject);
                    });
            }
        return redirect()->back()->with('success', 'Thank you for your confirmation');
    }


    public function export($id)
    {
        return (new ProjectAccountsExport($id))->download('project_accouts.xlsx');

    }
    
  
       public function engagmentLetter(Project $project)
    {
            $date=$project->project_date;
            $cfo_email=$project->cfo_email;
            $cfo_name=$project->cfo_name;
          $date=  date('j F Y', strtotime($date));
           $name =$project->customer->name;
           $fiscalYear=$project->fiscal_year;
            $data = ['date'=>$date,'email'=>$cfo_email,'companyName'=>$name,'fiscalYear'=>$fiscalYear]; 
            $pdf= Pdf::loadView('admin.projects.letters.engagment-letter',$data)->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->stream();

    }
    
    public function representationLetter(Project $project)
    {
            $date=$project->project_date;
            $cfo_email=$project->cfo_email;
            $cfo_name=$project->cfo_name;
           $date=  date('j F Y', strtotime($date));
           $name =$project->customer->name;
              $logo='images/'.$project->customer->image;
              $fiscalYear=$project->fiscal_year;
        $customerEmail= $project->customer->email; 
           $customerPhone=$project->customer->phone;
           $customerAddress=Address::where('id',$project->customer->address_id)->select('address')->get()[0]->address;
            $data = ['date'=>$date,'email'=>$cfo_email,'companyName'=>$name,'fiscalYear'=>$fiscalYear,'logo'=>$logo,'customerEmail'=>$customerEmail,'customerPhone'=>$customerPhone,'customerAddress'=>$customerAddress];
            $pdf= Pdf::loadView('admin.projects.letters.representation-letter',$data)->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->stream();
    
    }
    
    
     public function authorizationLetter(Project $project)
    {
           $date=$project->project_date;
            $cfo_email=$project->cfo_email;
            $cfo_name=$project->cfo_name;
           $date=  date('j F Y', strtotime($date));
           $name =$project->customer->name; 
           $logo='images/'.$project->customer->image;
            $fiscalYear=$project->fiscal_year;
           $customerEmail= $project->customer->email;
           $customerPhone=$project->customer->phone;
           $customerAddress=Address::where('id',$project->customer->address_id)->select('address')->get()[0]->address;
            $data = ['date'=>$date,'email'=>$cfo_email,'companyName'=>$name,'fiscalYear'=>$fiscalYear,'logo'=>$logo,'customerEmail'=>$customerEmail,'customerPhone'=>$customerPhone,'customerAddress'=>$customerAddress];
            $pdf= Pdf::loadView('admin.projects.letters.authorization-letter',$data)->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->stream();
    }
       
 /*   public function approvalRequest(Project $project)
{
    $accounts = ProjectAccounts::where('authorization_status', 1)
        ->where('project_id', $project->id)
        ->select('account_name', 'account_number')
        ->get();

    $date = $project->project_date;
    $cfo_email = $project->cfo_email;
    $cfo_name = $project->cfo_name;
    $date = date('j F Y', strtotime($date));
    $name = $project->customer->name;
    $fiscalYear = $project->fiscal_year;
    $data = [
        'date' => $date,
        'email' => $cfo_email,
        'companyName' => $name,
        'fiscalYear' => $fiscalYear,
        'accounts' => $accounts
    ];
    
    $pdf = Pdf::loadView('admin.projects.letters.approval-request', $data)
        ->setOptions([
           'defaultFont' => 'freeserif',
        'enable_font_subsetting' => true
            
        ]);
     
    
    return $pdf->stream();
}*/

/*
public function approvalRequest(Project $project)
{
    $accounts = ProjectAccounts::where('authorization_status', 1)
        ->where('project_id', $project->id)
        ->select('account_name', 'account_number')
        ->get();

    $date = $project->project_date;
    $cfo_email = $project->cfo_email;
    $cfo_name = $project->cfo_name;
    $date = date('j F Y', strtotime($date));
    $name = $project->customer->name;
    $fiscalYear = $project->fiscal_year;
    
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Author');
    $pdf->SetTitle('Title');
    $pdf->SetSubject('Subject');
    $pdf->setFontSubsetting(true);
    $pdf->SetFont('dejavusans', '', 14, '', true);
    
   $pdf->AddPage();

// Define the column widths
$colWidths = array(50, 50, 50);

// Set the column widths
$pdf->setColumnWidths($colWidths);

// Define the table header
$header = array('Column 1', 'Column 2', 'Column 3');

// Define the table data
$data = array(
    array('Row 1, Column 1', 'Row 1, Column 2', 'Row 1, Column 3'),
    array('Row 2, Column 1', 'Row 2, Column 2', 'Row 2, Column 3'),
    array('Row 3, Column 1', 'Row 3, Column 2', 'Row 3, Column 3')
);

// Set the table header and data
$pdf->WriteTable($header, $data);

$pdf->lastPage();

return $pdf->Output('approval_request.pdf', 'I');

}
*/

public function approvalRequest(Project $project)
{
    $accounts = ProjectAccounts::where('authorization_status', 1)
        ->where('project_id', $project->id)
        ->select('account_name', 'account_number')
        ->get();

    $date = $project->project_date;
    $cfo_email = $project->cfo_email;
    $cfo_name = $project->cfo_name;
    $date = date('j F Y', strtotime($date));
    $name = $project->customer->name;
    $fiscalYear = $project->fiscal_year;
    $data = [
        'date' => $date,
        'email' => $cfo_email,
        'companyName' => $name,
        'fiscalYear' => $fiscalYear,
        'accounts' => $accounts
    ];

    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Author Name');
    $pdf->SetTitle('Approval Request');
    $pdf->SetSubject('Approval Request');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 010', PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    $pdf->SetFont('freeserif', '', 11);
    
    // remove default header/footer
     $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // add a page
    $pdf->AddPage();

    // set some text to print
    $html = view('admin.projects.letters.approval-request', $data)->render();

    // print html content
    $pdf->writeHTML($html, true, false, true, false, '');

    // ---------------------------------------------------------

    //Close and output PDF document
    $pdf->Output('approval_request.pdf', 'I');
}

    

   ######################### <!-- Download Letters only--!>########################
    public function download_banks(Project $project){
            $date=$project->project_date;
            $cfo_email=$project->cfo_email;
            $cfo_name=$project->cfo_name;
           $date=  date('j F Y', strtotime($date));
           $name =$project->customer->name;
              $fiscalYear=$project->fiscal_year;
            $data = ['date'=>$date,'email'=>$cfo_email,'companyName'=>$name,'fiscalYear'=>$fiscalYear];
            $pdf= Pdf::loadView('admin.projects.letters.bankconfirmation',$data)->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->download('banks.pdf');
    
    }
         public function download_suppliers(Project $project)
         {
            $date=$project->project_date;
            $cfo_email=$project->cfo_email;
            $cfo_name=$project->cfo_name;
           $date=  date('j F Y', strtotime($date));
           $name =$project->customer->name;
      $fiscalYear=$project->fiscal_year;
            $data = ['date'=>$date,'email'=>$cfo_email,'companyName'=>$name,'fiscalYear'=>$fiscalYear]; 
            $pdf= Pdf::loadView('admin.projects.letters.suppliers',$data)->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->download('suppliers.pdf');
    
    }
         public function download_clients(Project $project){
            $date=$project->project_date;
            $cfo_email=$project->cfo_email;
            $cfo_name=$project->cfo_name;
           $date=  date('j F Y', strtotime($date));
           $name =$project->customer->name;
              $fiscalYear=$project->fiscal_year;
            $data = ['date'=>$date,'email'=>$cfo_email,'companyName'=>$name,'fiscalYear'=>$fiscalYear];
            $pdf= Pdf::loadView('admin.projects.letters.clients',$data)->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->download('clients.pdf');
    
    }
    
    ####################################################
           public function download_engagmentLetter(Project $project)
    {
            $date=$project->project_date;
            $cfo_email=$project->cfo_email;
            $cfo_name=$project->cfo_name;
           $date=  date('j F Y', strtotime($date));
           $name =$project->customer->name;
              $fiscalYear=$project->fiscal_year;
            $data = ['date'=>$date,'email'=>$cfo_email,'companyName'=>$name,'fiscalYear'=>$fiscalYear]; 
            $pdf= Pdf::loadView('admin.projects.letters.engagment-letter',$data)->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->download('engagment_Letter.pdf');

    }
    
    public function download_representationLetter(Project $project)
    {
            $date=$project->project_date;
            $cfo_email=$project->cfo_email;
            $cfo_name=$project->cfo_name;
           $date=  date('j F Y', strtotime($date));
           $name =$project->customer->name;
              $fiscalYear=$project->fiscal_year;
            $data = ['date'=>$date,'email'=>$cfo_email,'companyName'=>$name,'fiscalYear'=>$fiscalYear];
            $pdf= Pdf::loadView('admin.projects.letters.representation-letter',$data)->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->download('representation_Letter.pdf');
    
    }
    
    
     public function download_authorizationLetter(Project $project)
    {
           $date=$project->project_date;
            $cfo_email=$project->cfo_email;
            $cfo_name=$project->cfo_name;
           $date=  date('j F Y', strtotime($date));
           $name =$project->customer->name;
            $logo ='images/'.$project->customer->image;
            $fiscalYear=$project->fiscal_year;
            $data = ['date'=>$date,'email'=>$cfo_email,'companyName'=>$name,'fiscalYear'=>$fiscalYear,'logo'=>$logo];
            $pdf= Pdf::loadView('admin.projects.letters.authorization-letter',$data)->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->download('authorization_Letter.pdf');
    }
       
     public function download_approvalRequest(Project $project)
    {
            $date=$project->project_date;
            $cfo_email=$project->cfo_email;
            $cfo_name=$project->cfo_name;
          $date=  date('j F Y', strtotime($date));
           $name =$project->customer->name;
          $fiscalYear=$project->fiscal_year;
            $data = ['date'=>$date,'email'=>$cfo_email,'companyName'=>$name,'fiscalYear'=>$fiscalYear];
            $pdf= Pdf::loadView('admin.projects.letters.approval-request',$data)->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->download('approval_Request.pdf');
    }
    /*
      public function store(ProjectStoreRequest $request)
     {   
       $start_account_no_type = SystemAccountSetting::all();
       $project = Project::create($request->validated());
        $project->users()->attach($request->user_ids);
        $documents = [];
        if (isset($request->document) && $request->document != null) {
            foreach ($request->document as $document) {
                // save document
                if (isset($document['path'])) {
                    $documentName = $document['name'].time().'.'.$document['path']->getClientOriginalExtension();

                    $document['path']->move(public_path('images'), $documentName);
                    $document['path'] = $documentName;
                    $document['project_id'] = $project->id;
                    $documents[] = ProjectFiles::create($document);
                }
            }
        }
        $type='';
        $data = [];
        $typ=[];
      // return $request;
        if ($request->has('account_name') && $request->account_name) {
            //if (isset($request->data[0])) { return $request->data[0];
        
                foreach ($request->data[$request->account_name] as $key => $account_name_data) {
         
              $start_account_no_request=$request->data[$request->account_number][$key];
                  foreach($start_account_no_type as $k=>$num)
               // for($i=0;$i<count($start_account_no_type);$i++)
                  {      
                        if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      // if(preg_match("/^{$start_account_no_type[$i]->start_account_no}/",$start_account_no_request))
                      {
                         
                            //  $type=$start_account_no_type[$i]->type;  
                            $type=$num->type;
                          
                      }else{
                          $type=null;
                      }
                  }
                             // array_push($typ,$type.$start_account_no_request);
                 // array_push($typ,"#############################################");
                    $data[] = [ 
                       'project_id'     => $project->id,
                        'account_type' => $type ,
                        'account_name'   => $request->data[$request->account_name][$key] ?? null,
                        'account_number' => $request->data[$request->account_number][$key] ?? null,
                        'currency'       => $request->data[$request->currency][$key] ?? null,
                        'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                        'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                        'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                       'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                        'balance'        => $request->data[$request->balance][$key] ?? null,
                    ];
                }return $data;
          //  }
          
        } elseif ($request->has('account_number') && $request->account_number) {
            foreach ($request->data[$request->account_number] as $key => $account_name_data) {
                

                  $start_account_no_request=$request->data[$request->account_number][$key];
                    foreach($start_account_no_type as $num)
                  {
                        if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      {
                         
                              $type=$num->type;  
                          
                      }else{
                          $type=null;
                      }
                  }
                
                $data[] = [
                    'project_id'     => $project->id,
                    'account_type'   => $type ,
                    'account_name'   => $request->data[$request->account_name][$key] ?? null,
                    'account_number' => $request->data[$request->account_number][$key] ?? null,
                    'currency'       => $request->data[$request->currency][$key] ?? null,
                   'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                    'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                     'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                    'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                    'balance'        => $request->data[$request->balance][$key] ?? null,
                ];
            }
        } elseif ($request->has('currency') && $request->currency) {
            foreach ($request->data[$request->currency] as $key => $account_name_data) {
        
              $start_account_no_request=$request->data[$request->account_number][$key];
                    foreach($start_account_no_type as $num)
                  {
                        if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      {
                         
                              $type=$num->type;  
                          
                      }else{
                          $type=null;
                      }
                  }
                $data[] = [
                    'project_id'     => $project->id,
                    'account_type'   => $type ,
                    'account_name'   => $request->data[$request->account_name][$key] ?? null,
                    'account_number' => $request->data[$request->account_number][$key] ?? null,
                    'currency'       => $request->data[$request->currency][$key] ?? null,
                    'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                    'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                     'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                    'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                    'balance'        => $request->data[$request->balance][$key] ?? null,
                ];
            }
        } elseif ($request->has('debit') && $request->debit) {
            foreach ($request->data[$request->debit] as $key => $account_name_data) {
    
          $start_account_no_request=$request->data[$request->account_number][$key];
                     foreach($start_account_no_type as $num)
                  {
                        if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      {
                         
                              $type=$num->type;  
                          
                      }else{
                          $type=null;
                      }
                  }
                $data[] = [
                    'project_id'     => $project->id,
                    'account_type'   => $type ,
                    'account_name'   => $request->data[$request->account_name][$key] ?? null,
                    'account_number' => $request->data[$request->account_number][$key] ?? null,
                    'currency'       => $request->data[$request->currency][$key] ?? null,
                    'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                    'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                     'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                    'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                    'balance'        => $request->data[$request->balance][$key] ?? null,
                ];
            }
        } elseif ($request->has('credit') && $request->credit) {
            foreach ($request->data[$request->credit] as $key => $account_name_data) {
        $start_account_no_request=$request->data[$request->account_number][$key];
                    foreach($start_account_no_type as $num)
                  {
                        if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      {
                         
                              $type=$num->type;  
                          
                      }else{
                          $type=null;
                      }
                  }
                $data[] = [
                    'project_id'     => $project->id,
                    'account_type'   => $type ,
                    'account_name'   => $request->data[$request->account_name][$key] ?? null,
                    'account_number' => $request->data[$request->account_number][$key] ?? null,
                    'currency'       => $request->data[$request->currency][$key] ?? null,
                   'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                    'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                     'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                    'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                    'balance'        => $request->data[$request->balance][$key] ?? null,
                ];
            }
        } elseif ($request->has('balance') && $request->balance) {
            foreach ($request->data[$request->balance] as $key => $account_name_data) {
    
            $start_account_no_request=$request->data[$request->account_number][$key];
                     foreach($start_account_no_type as $num)
                  {
                        if(preg_match("/^{$num->start_account_no}/",$start_account_no_request))
                      {
                         
                              $type=$num->type;  
                          
                      }else{
                          $type=null;
                      }
                  }
                $data[] = [
                    'project_id'     => $project->id,
                    'account_type'   => $type ,
                    'account_name'   => $request->data[$request->account_name][$key] ?? null,
                    'account_number' => $request->data[$request->account_number][$key] ?? null,
                    'currency'       => $request->data[$request->currency][$key] ?? null,
                    'ob_debit'       => $request->data[$request->ob_debit][$key] ?? null,
                    'ob_credit'     => $request->data[$request->ob_credit][$key] ?? null,
                     'm_debit'      => $request->data[$request->m_debit][$key] ?? null,
                    'm_credit'       => $request->data[$request->m_credit][$key] ?? null,
                    'balance'        => $request->data[$request->balance][$key] ?? null,
                ];
            }
        }
        
        $project_account = ProjectAccounts::insert($data);
        if($request->has('cfo_email')&&$request->cfo_email){
              $system_info = SystemSetting::orderBy('id', 'desc')->first();
            // $content_mail = SystemMailContent::where('name_mail','Send Authorization Request')->first();
             $emailTemplate = EmailTemplate::where('title','NEW Project')->first();
                       $title = $emailTemplate->title;
                       $body =$emailTemplate->body; 
            $subject = 'Athorization Request';
           // $contact_email = '$account->project';
            
            $email = $system_info->email;
             $name = $system_info->short_name;
            $cfo_email=$project->cfo_email;
            
                Mail::send('emails.new_project', [
                     'title' => $title,  'body' => $body,
                    'token'      => route('customer.login'), 
                    'customer_name' => $project->cfo_name,
                   // 'account_no' => $project->customer->cfo_email, 
                    'guard' => $this->guard,
                ],
                    function ($message) use ( $email, $name, $subject ,$title,$cfo_email) {
                        $message->from($email, $name);
                        $message->to($cfo_email)->subject($title ?? $subject );
                    });
         }
        return redirect()->route('admin.project.index', $project->id)->with('success','Project stored sucessfully & Email sent to CFO');
    }
    */
}
