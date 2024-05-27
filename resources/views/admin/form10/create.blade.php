@extends('admin.master')
@section('title','Quarry coordinator')
@section('content')
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Quarry coordinator
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
                        @if(isset($QuarryCoordinator))

                        {!!Form::open()->fill($QuarryCoordinator)->put()->multipart()->route('admin.form10.update',[$QuarryCoordinator->id])!!}
                    @else
                        {!!Form::open()->multipart()->route('admin.form10.store')!!}
                    @endif


                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">

                            {!!Form::select('coupon', 'coupon / رقم  البون',[1 => '1' , 0 => '0'])->required()!!}

                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">

                            {!!Form::text('material_type', ' material type / نوع  المواد','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('storage_location', 'storage location /  مكان التفريغ-التخزين','test')->readonly()!!}
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
