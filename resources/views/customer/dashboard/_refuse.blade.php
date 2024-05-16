<a href="{{route('customer.refuse-accounts',['project_id'=>$project->id])}}">
    <span style="color:red;text-decoration: none;"> {{ $project->accounts()->where(['authorization_request'=> 1 ,'authorization_status' => 4 ])->count()  }} </span>
    <i style="color:red" class="fa fa-times" aria-hidden="true"></i>
</a>