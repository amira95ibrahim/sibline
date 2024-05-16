@extends('admin.master')
@section('title','Users')
@section('content')
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Manage Roles</h4>

                </div>

            </div>
        </div>
        
        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

                <div class="card">

                    <div class="card-body">
                        @if(isset($role))

                            {!!Form::open()->fill($role)->put()->multipart()->route('admin.role.update',[$role->id])!!}
                        @else
                            {!!Form::open()->multipart()->route('admin.role.store')!!}
                        @endif
                        
                            {!!Form::text('name', 'Role Name')->required()!!}

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

@endpush
