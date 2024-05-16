<a href="{{route('customer.pending-accounts',['project_id'=>$project->id])}}">
    <span style="color:#9A9A9A;text-decoration: none;"> {{ $project->accounts()->where(['authorization_request'=> 1 ,'authorization_status' => 1 ])->count()  }} </span>
    <i style="color:#9A9A9A" class="fa fa-spinner" aria-hidden="true"></i>
</a>