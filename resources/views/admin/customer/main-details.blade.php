<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::text('name', 'Name')->required()!!}
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::text('email', 'Email')->required()->type('email')!!}
</div>

{{-- <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::text('password', 'Password')->type('password')->value('')!!}
</div> --}}

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::text('phone', 'Phone')->required()->type('number')!!}
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::text('mobile', 'Mobile')->required()->type('number')!!}
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!! Form::text('website', 'Website')->type('url') !!}
</div>

{{-- <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!! Form::date('birth_date', 'Birthday')->required() !!}
</div> --}}

{{-- <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::select('is_verified', 'Choose Verification Status',[1 => 'Active' , 0 => 'Not Active'])->required()!!}
</div> --}}

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::select('status', 'Choose Status',[1 => 'Active' , 0 => 'Not Active'])!!}
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::file('image', 'Logo')!!}
</div>

@if(isset($customer))
<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    <img src="{{asset('images/'.$customer->image)}}" class="img-thumbnail w-50"/>
</div>
@endif
<div class="col-lg-12 col-xl-5-12 col-md-12 col-sm-12 d-inline-block">
    {!! Form::textarea('note', 'Notes')->type('url') !!}
</div>