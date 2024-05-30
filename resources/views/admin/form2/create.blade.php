@extends('admin.master')
@section('title','Kiosk coordinator')
@section('content')
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Kiosk coordinator
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

                        @if(isset($KioskCoordinator))

                        {!!Form::open()->fill($KioskCoordinator)->put()->multipart()->route('admin.form2.update',[$KioskCoordinator->id])!!}
                    @else
                        {!!Form::open()->multipart()->route('admin.form2.store')!!}
                    @endif
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">

                            {!!Form::text('coupon', 'Coupon / رقم البون')!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('purcashe_number', 'Purcashe Number / رقم طلب الشراء','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('contractor_number', 'Contractor Number / رقم  المتعهد','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('contractor_name', 'Contractor Name / اسم المتعهد','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('material_num', 'Material Num / رقم المواد','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('material_name', 'Material Name / اسم المواد','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('RM_source', ' RM Source / مصدر المواد الأولية','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('driver_name', 'Driver Name / اسم السائق')!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('driver_phone', 'Driver Number / رقم  هاتف السائق ')!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('truck_plate', 'Truck Plate / رقم لوحة الشاحنة ')!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('registeration_date_time', 'Registeration Date / وقت وتاريخ التسجيل','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('torage_location', ' Storage Location / مكان التفريغ والتخزين ','test')->readonly()!!}
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
