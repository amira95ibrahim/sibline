@extends('admin.master')
@section('title','Coupons Generating')
@section('content')
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Coupons Generating
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

                            {!!Form::select('purcashe_order', 'Purcashe Order / رقم طلب الشراء',[1 => '1' , 0 => '0'])->required()!!}

                        </div>

                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">

                            {!!Form::text('total_quantity', 'Total Quantity / الكمية','120')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('contractor_number', 'Contractor Number / رقم المتعهد','123456')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('contractor_name', 'Contractor Name / اسم المتعهد','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('material_num', 'Material num / رقم المواد','55')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('material_name', 'Material Name / اسم المواد','test')->readonly()!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('RM_source', 'RM_source / مصدر المواد الأولية')!!}
                        </div>
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::text('storage_location', 'Storage Location / مكان التفريغ -التخزين','test')->readonly()!!}
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
