@extends('admin.master')
@section('title','System')
@section('content')

        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Manage System</h4>

                </div>

            </div>
        </div>
        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7 grid-margin">

                <div class="card">

                    <div class="card-body">


                            {!!Form::open()->fill($systemSetting)->put()->multipart()->route('admin.system.update',[$systemSetting->id])!!}


                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('name', 'Name')->required()!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('short_name', 'Short Name')->required()!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('address', 'Address')->required()!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('phone', 'Phone')->type('number')->required()!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('email', 'Email')->type('email')->required()!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('facebook', 'Facebook')->required()!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('twitter', 'Twitter')->required()!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('youtube', 'Youtube')->required()!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('footer_text', 'Footer Text')->required()!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::select('status', 'Choose Status',[ 1 => 'Active' , 0 => 'Not Active'])->required()!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::file('favicon', 'Favicon')!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::file('logo_header', 'Logo Header')!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::file('logo_footer', 'Logo Footer')!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::file('logo_login', 'Logo Login')!!}
                            </div>
                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::file('background_login', 'Background Login ( 1042 x 894)
                                ')!!}
                            </div>
                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::submit("Save")!!}
                            </div>

                            {!!Form::close()!!}



                    </div>

                </div>

            </div>

            <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5 grid-margin">

                <div class="card">

                    <div class="card-body">
                        <h4>Logo Login Preview</h4>
                        <p class="text-center"><img src="{{asset('images/'.$systemSetting->logo_login)}}" class="img-responsive img-fluid"></p>
                        <h4>Logo Header Preview</h4>
                        <p class="text-center"><img src="{{asset('images/'.$systemSetting->logo_header)}}" class="img-responsive img-fluid"></p>
                        <h4>Logo Footer Preview</h4>
                        <p class="text-center"><img src="{{asset('images/'.$systemSetting->logo_footer)}}" class="img-responsive img-fluid"></p>
                        <h4>Favicon Preview</h4>
                        <p class="text-center"><img src="{{asset('images/'.$systemSetting->favicon)}}" class="img-responsive img-fluid"></p>
                        <h4>Background Image login</h4>
                        <p class="text-center"><img src="{{asset('images/'.$systemSetting->background_login)}}" class="img-responsive img-fluid"></p>
                    </div>
                </div>

            </div>

        </div>

@endsection

@push('script')

@endpush
