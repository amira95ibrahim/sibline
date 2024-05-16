@extends('admin.master')
@section('title','Users')
@section('content')
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Manage Users</h4>

                </div>

            </div>
        </div>
        
        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

                <div class="card">

                    <div class="card-body">
                        @if(isset($user))

                            {!!Form::open()->fill($user)->put()->multipart()->route('admin.user.update',[$user->id])!!}
                        @else
                            {!!Form::open()->multipart()->route('admin.user.store')!!}
                        @endif
                        
                            <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('first_name', 'First Name')->required()!!}
                            </div>

                            <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('last_name', 'Last Name')->required()!!}
                            </div>

                            <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('email', 'Email')->required()->type('email')!!}
                            </div>
                            
                            <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('password', 'Password')->type('password')->value('')!!}
                            </div>
 
                            <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::select('role_id', 'Choose Role')->options(\App\Models\Role::all()->prepend('None',null))->required()!!}
                            </div>

                            <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::select('status', 'Choose Status',[1 => 'Active' , 0 => 'Not Active'])->required()!!}
                            </div>

                            <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::file('image', 'Photo')!!}
                            </div>
                            @if(isset($user))
                            <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                <img src="{{asset('images/'.$user->image)}}" class="img-thumbnail w-50"/>

                            </div>
                            @endif
                            
                            @include('admin.form_components.permission')

                            @if(!isset($show))
                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::submit("Save")!!}
                            </div>
                            @endif
                            
                            
                            {!!Form::close()!!}
                        
                    </div>

                </div>

            </div><!-- COL END -->

        </div>
@endsection

@push('script')
<script>
    $('#inp-role_id').change(function (e) {
        var id = $(this).val();
        $.ajax({
            type:'GET',
            url: base_url+'admin/role/get-permissions/'+ (id?id:'0'),
            success:function(data) {
                data.menus.forEach(menu => {
                    $('#permission_'+menu.id).prop('checked', menu.check);
                });
            }
        });
    });
</script>
@endpush
