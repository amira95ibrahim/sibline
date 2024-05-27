@extends('admin.master')
@section('title','RM Weighbridge IN')
@section('content')
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">RM Weighbridge IN
                        </h4>

                </div>

            </div>
        </div>

        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

                <div class="card">

                    <div class="card-body">

                        @if(isset($RMWeighbridgeIN))

                        {!!Form::open()->fill($RMWeighbridgeIN)->put()->multipart()->route('admin.form3.update',[$RMWeighbridgeIN->id])!!}
                    @else
                        {!!Form::open()->multipart()->route('admin.form3.store')!!}
                    @endif

                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">

                            {!!Form::text('coupon', 'coupon / رقم البون')!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('weigh_in', '  Weigh in','test')->readonly()!!}
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
