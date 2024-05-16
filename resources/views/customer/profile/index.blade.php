@extends('customer.master')
@section('title','Profile')
@section('content')
        
<div class="row d-flex flex-wrap">
    <div class="col-xl-12 d-flex flex-column">
       <div class="inner_left">
          <div class="cover_img d-flex align-items-end align-items-md-end " style="height:100px">
             <div class="profile_lg_wrapper d-flex align-items-center align-items-md-end">
                <div class="profile_content d-flex align-items-center justify-content-center">
                   <a href="#" class="deactivate-link">
                   <img src="{{asset('images/'.$customer->image)}}" alt="Profile Picture">
                   </a>
                </div>
                <div class="profile_info">
                   <p>{{$customer->name}}</p>
                </div>
             </div>
          </div>
          <div class="profile_info_wrapper">
             <div class="row tag_icon_wrapper d-flex align-items-center justify-content-between">
             </div>
          </div>
          <div class="tab_wrapper">
             <div id="about" class="profile_tab active">
                <h3>About</h3>
                {!!Form::open()->fill($customer)->put()->multipart()->route('customer.customer.update',[$customer->id])!!}
                {!!Form::hidden('is_verified')!!}

                {!!Form::hidden('status')!!}
            
                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                    {!!Form::text('name', 'Name')->required()!!}
                </div>

                

                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                    {!!Form::text('email', 'Email')->required()->type('email')!!}
                </div>
                
                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                    {!!Form::text('password', 'Password')->type('password')->value('')!!}
                </div>

                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                    {!!Form::text('phone', 'Phone')->required()->type('number')!!}
                </div>

                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                    {!!Form::text('mobile', 'Mobile')->required()->type('number')!!}
                </div>

                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                    {!!Form::date('birth_date', 'Birthday')->required()!!}
                </div>

                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                    {!!Form::text('passport_number', 'Passport Number')->required()->type('number')!!}
                </div>

                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                    {!!Form::select('occupation_id', 'Choose Occupation')->options(\App\Models\Occupation::all()->prepend('None',null))->required()!!}
                </div>

                

                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                    {!!Form::file('image', 'Photo')!!}
                </div>

                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                    {!!Form::file('passport_photo', 'Passport Photo')!!}
                </div>

                @if(isset($customer) && !empty($customer->passport_photo))
                <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                    <img src="{{asset('images/'.$customer->passport_photo)}}" class="img-thumbnail w-50"/>
                </div>
                
                
                @endif
                @if(isset($customer))
                    @include('admin.form_components.address',['address' => $customer->address])
                @else
                    @include('admin.form_components.address',['address' => new \App\Models\Address])
                @endif

                @if(!isset($show))
                    <div class="card-footer text-left">
                        {!!Form::submit("Save")!!}
                    </div>
                @endif
            </div>
             
          </div>
       </div>
    </div>
</div>

@endsection



@push('script')

@endpush
