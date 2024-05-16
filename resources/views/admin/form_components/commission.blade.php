@if(!isset($hideTitle))
    <h5 class="content-title mb-0 my-auto">Commission Details </h5>
    <hr>
@endif

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::text('wallet_in', 'Wallet In', $commission->wallet_in)->required()!!}
    
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::text('wallet_out', 'Wallet Out', $commission->wallet_out)->required()!!}
    
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::text('shares_buying', 'Shares Buying', $commission->shares_buying)->required()!!}
    
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::text('shares_selling', 'Shares Selling', $commission->shares_selling)->required()!!}
    
</div>