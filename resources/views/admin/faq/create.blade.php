@extends('admin.master')
@section('title','Faq')
@section('content')
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Manage Faqs</h4>

                </div>

            </div>
        </div>
        
        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

                <div class="card">

                    <div class="card-body">
                        @if(isset($faq))

                            {!!Form::open()->fill($faq)->put()->multipart()->route('admin.faq.update',[$faq->id])!!}
                        @else
                            {!!Form::open()->multipart()->route('admin.faq.store')!!}
                        @endif
                        
                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::textarea('question', 'Question')!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::textarea('answer', 'Answer')!!}
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