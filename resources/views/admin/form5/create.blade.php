@extends('admin.master')
@section('title','Kiosk coordinator trancim')
@section('content')
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Kiosk coordinator
                        Trancim   </h4>

                </div>

            </div>
        </div>

        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

                <div class="card">

                    <div class="card-body">


                        @if(isset($KioskCoordinatorTrancim))

                        {!!Form::open()->fill($KioskCoordinatorTrancim)->put()->multipart()->route('admin.form5.update',[$KioskCoordinatorTrancim->id])!!}
                    @else
                        {!!Form::open()->multipart()->route('admin.form5.store')!!}
                    @endif

                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">

                            {!!Form::select('coupon', 'Coupon / رقم  البون',[1 => '1' , 0 => '0'])->required()!!}

                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">

                            {!!Form::text('sales_order', 'Sales Order / رقم أمر البيع','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('customer_phone', 'Customer Phone / رقم الزبون','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('customer_name', 'Customer Name /اسم الزبون' ,'test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('material_num', 'Material Num / رقم المواد','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('material_name', 'Material Name / اسم المواد','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('destination', 'Destination / وجهة التسليم  ')!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('Qty_loaded', 'Qty Loaded / الكمية','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('driver_name', 'Driver Name /اسم السائق','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('driver_phone', 'Driver Phone /رقم السائق ','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('truck_plate', 'Truck Plate /رقم لوحة الشاحنه','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('truck_license', ' Truck License  / رقم دفتر الشاحنة')!!}
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
