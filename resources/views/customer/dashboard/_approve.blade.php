<a href="{{route('customer.approve-accounts',['project_id'=>$project->id])}}">
    <span style="color:green"> {{ $project->accounts()->where(['authorization_request'=> 1 ,'authorization_status' => 3])->count()  }} </span>
    <i style="color:green" class="fa fa-check" aria-hidden="true"></i>
</a>