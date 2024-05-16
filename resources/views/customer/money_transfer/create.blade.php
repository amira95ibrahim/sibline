@extends('customer.master')
@section('title','Transfer Money')
@section('content')

        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Transfer Money</h4>

                </div>

            </div>
        </div>
        
        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

                <div class="card">

                    <div class="card-body">
                        {!!Form::open()->multipart()->route('customer.money-transfer.store')!!}
                        
                        {!!Form::hidden('wallet', intval(\Auth::guard('customer')->user()->wallet))!!}

                        

                        <div class="asset-money-transfer">
                              <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                    {!!Form::text('amount', 'Amount I want to transfer for (max of '.intval(\Auth::guard('customer')->user()->wallet).')' )!!}
                              </div>
                              <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('wallet_address', 'Wallet Address' )!!}
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

    //$('#inp-receiver_id').select2({ width: 'resolve' });
</script>
@endpush
