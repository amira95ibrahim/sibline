@extends('admin.master')
@section('title','Country')
@section('content')
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Manage Countries</h4>

                </div>

            </div>
        </div>
        
        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

                <div class="card">

                    <div class="card-body">
                        @if(isset($country))

                            {!!Form::open()->fill($country)->put()->multipart()->route('admin.country.update',[$country->id])!!}
                        @else
                            {!!Form::open()->multipart()->route('admin.country.store')!!}
                        @endif
                        
                            <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('name', 'Name')->required()!!}
                            </div>

                            <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('code', 'Code')->required()!!}
                            </div>

                            <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                @if(isset($country))
                                    {!!Form::select('parent_id', 'Choose Parent')->options(\App\Models\Country::where('id', '!=', $country->id)->get()->prepend('None',null))!!}
                                @else
                                    {!!Form::select('parent_id', 'Choose Parent')->options(\App\Models\Country::all()->prepend('None',null))!!}
                                @endif
                            </div>

                            <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::select('status', 'Choose Status',[1 => 'Active' , 0 => 'Not Active'])->required()!!}

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
