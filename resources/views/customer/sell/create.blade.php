@extends('customer.master')
@section('title','Sell')
@section('content')

        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Offer My Shares for selling</h4>

                </div>

            </div>
        </div>
        
        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

                <div class="card">

                    <div class="card-body">
                        @if(isset($sell))
                              {!!Form::open()->fill($sell)->put()->multipart()->route('customer.sell.update',[$sell->id])!!}
                              @php
                                    $max_shares = number_format($sell->property->sharesCustomers->where('customer_id',\Auth::guard('customer')->user()->id)->first()->sum_percentage,3);
                              @endphp
                        @else
                              {!!Form::open()->multipart()->route('customer.sell.store')!!}
                              {!!Form::hidden('property_id', $property->id)!!}
                              @php
                                    $max_shares = number_format($property->sharesCustomers->where('customer_id',\Auth::guard('customer')->user()->id)->first()->sum_percentage,3);
                              @endphp
                        @endif
                        
                        

                        {!!Form::hidden('max_shares', $max_shares)!!}
                        
                        <div class="asset-bid">
                              <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                    {!!Form::text('percentage', 'Number of Shares I want to offer for (max of '.$max_shares.')' )!!}
                              </div>
                              <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                    {!!Form::text('amount', 'Amount i want to sell it for')!!}
                              </div>
                        </div>
                        
                        @if(!isset($show))
                              <br>
                              <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                    {!!Form::submit("Submit")!!}
                              </div>
                        @endif
                          
                        
                    </div>

                </div>

            </div><!-- COL END -->

        </div>
@endsection



@push('script')
<script>
</script>
@endpush
