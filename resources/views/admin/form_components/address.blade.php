@if(!isset($hideTitle))
    <h5 class="content-title mb-0 my-auto">Address Details </h5>
    <hr>
@endif
<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    @if(isset($hideRequired))
        {!!Form::select('country_id', 'Choose Country')->options(\App\Models\Country::whereNull('parent_id')->get()->prepend('None',null))->value($address->country_id ?? '')!!}
    @else
        {!!Form::select('country_id', 'Choose Country')->options(\App\Models\Country::whereNull('parent_id')->get()->prepend('None',null))->value($address->country_id ?? '')->required()!!}
    @endif
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    @if(isset($hideRequired))
        {!!Form::select('city_id', 'Choose City')->options(\App\Models\Country::where('parent_id',$address->country_id)->whereNotNull('parent_id')->get()->prepend('None',null))->value($address->city_id ?? '')!!}
    @else
        {!!Form::select('city_id', 'Choose City')->options(\App\Models\Country::where('parent_id',$address->country_id)->whereNotNull('parent_id')->get()->prepend('None',null))->value($address->city_id ?? ' ')->required()!!}
    @endif
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::text('area', 'Area')->value($address->area ?? '')!!}
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    @if(isset($hideRequired))
        {!!Form::text('address', 'Address')->value($address->address ?? ' ')!!}
    @else
        {!!Form::text('address', 'Address')->required()->value($address->address ?? ' ')!!}
    @endif
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::text('street', 'Street')->value($address->street ?? ' ')!!}
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::text('zip_code', 'Zip Code')->value($address->zip_code ?? '')!!}
</div>

{{-- <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::text('gps', 'GPS')->value($address->gps)!!}
</div> --}}

{{-- <div id="map" class="form-control" style="height: 300px !important;display: none;"></div>
<div class="clear"></div>
<div id="mapscript"></div> --}}
@push('script')
<script>
    $('#inp-country_id').change(function (e) {
        requestData('admin/country/get-childs',$(this).val(),'inp-city_id');
    });
</script>
{{-- <script src="{{ asset('admin-assets/js/gmaps.init.js') }}"></script> --}}

@endpush
