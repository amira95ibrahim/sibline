 <a href="{{route('customer.approve-missing-accounts',['project_id'=>$project->id])}}">
    <span style="color:orange;text-decoration: none;"> {{ $project->accounts()->where(['authorization_request'=> 1 , 'authorization_status' => 2])->count()  }} </span>
    <i style="color: orange" class="fa fa-info-circle" aria-hidden="true"></i>

</a>