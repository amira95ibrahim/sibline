@extends('admin.master')
@section('title','EmailTemplates')
@section('content')
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Manage EmailTemplates</h4>

                </div>

            </div>
        </div>
        
        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

                <div class="card">

                    <div class="card-body">
                        @if(isset($emailTemplate))

                            {!!Form::open()->fill($emailTemplate)->put()->multipart()->route('admin.email-template.update',[$emailTemplate->id])!!}
                        @else
                            {!!Form::open()->multipart()->route('admin.email-template.store')!!}
                        @endif
                            <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('title', 'Title')->required()!!}
                            </div>
                        
                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::textarea('header', 'Header')!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::textarea('body', 'Body')!!}
                            </div>


                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::textarea('footer', 'Footer')!!}
                            </div>

            
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
