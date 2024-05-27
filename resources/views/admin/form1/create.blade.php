@extends('admin.master')
@section('title','Warehouse coordinator')
@section('content')
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Warehouse coordinator
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

                        @if(isset($CouponsGenerating))

                        {!!Form::open()->fill($CouponsGenerating)->put()->multipart()->route('admin.form1.update',[$CouponsGenerating->id])!!}
                    @else
                        {!!Form::open()->multipart()->route('admin.form1.store')!!}
                    @endif
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">

                            {!!Form::select('purcashe_order', 'purcashe order / رقم طلب الشراء',[1 => '1' , 0 => '0'])->required()!!}

                        </div>

                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">

                            {!!Form::text('total_quantity', 'total quantity / الكمية')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('contractor_number', 'contractor number / رقم المتعهد')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('contractor_name', 'contractor name / اسم المتعهد')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('material_num', 'material num / رقم المواد')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('material_name', 'material name / اسم المواد')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('RM_source', 'RM_source / مصدر المواد الأولية')!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('storage_location', 'Storage Location / مكان التفريغ -التخزين')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('truck_Av_load_weight', 'Truck Av. Load Weight /   وزن صافى حمل الشاحنة')!!}
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
