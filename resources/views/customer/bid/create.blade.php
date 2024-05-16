@extends('customer.master')
@section('title','Bid')
@section('content')

        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Bid</h4>

                </div>

            </div>
        </div>
        
        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

                <div class="card">

                    <div class="card-body">
                        @if(isset($bid))
                              @php
                                  $max_shares = number_format($bid->property->sharesCustomers->where('customer_id',$bid->receiver_id)->first()->sum_percentage,3);
                              @endphp
                              {!!Form::open()->fill($bid)->put()->multipart()->route('customer.bid.update',[$bid->id])!!}
                              {!!Form::hidden('max_shares', $max_shares)!!}
                              <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                    {!! Form::text('wallet_code','Wallet Code', base64_encode($bid->receiver_id))->readonly() !!}
                              </div>
                            
                        @else
                              @php
                                  $max_shares = number_format($property->sharesCustomers->where('customer_id',$customer_id)->first()->sum_percentage,3);
                              @endphp
                              {!!Form::open()->multipart()->route('customer.bid.store')!!}
                              {!!Form::hidden('receiver_id', $customer_id)!!}
                              {!!Form::hidden('property_id', $property->id)!!}
                              {!!Form::hidden('max_shares', $max_shares)!!}
                              <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                    {!! Form::text('wallet_code','Wallet Code', base64_encode($customer_id))->readonly() !!}
                              </div>      
                              
                              
                        @endif
                        
                        
                        <div class="asset-bid">
                              <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                    {!!Form::text('percentage', 'Number of Shares you want to bid for (max of '.$max_shares.')')!!}
                              </div>
                              <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                                    {!!Form::text('amount', 'Amount you are ready to pay for')!!}
                              </div>
                        </div>
                        
                        
                        <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                              {!!Form::textarea('message_send', 'Message')!!}
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
