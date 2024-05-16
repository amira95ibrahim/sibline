@extends('customer.master')
@section('title','Property')
@section('content')

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

                <div class="card">

                    <div class="card-body">
                       
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <ul class="nav panel-tabs main-nav-line" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="property-details-tab" data-toggle="tab" href="#property-details" role="tab" aria-controls="property-details" aria-selected="true">Property Details</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="revenues-tab" data-toggle="tab" href="#revenues" role="tab" aria-controls="revenues" aria-selected="false">Revenues</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="expense-tab" data-toggle="tab" href="#expense" role="tab" aria-controls="expense" aria-selected="false">Expenses</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="update-tab" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="false">Updates</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="share-tab" data-toggle="tab" href="#share" role="tab" aria-controls="share" aria-selected="false">Shares</a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content" id="myTabContent">
                                        
                                        <div class="tab-pane fade show active" id="property-details" role="tabpanel" aria-labelledby="property-details-tab">
                                            
                                            @include('customer.market.elements.property-view',['hidden_buy'=>true])
                                                
                                        </div>

                                        <div class="tab-pane fade" id="revenues" role="tabpanel" aria-labelledby="revenues-tab">
                                            @include('admin.property.components.revenue',['revenues' => $property->revenues->toArray()])
                                        </div>

                                        <div class="tab-pane fade" id="expense" role="tabpanel" aria-labelledby="expense-tab">
                                            @include('admin.property.components.expense',['expenses' => $property->expenses->where('status','APPROVED') , 'share' => $property->sharesCustomers->where('customer_id',\Auth::guard('customer')->user()->id)->first()])

                                        </div>

                                        <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab">
                                            @include('admin.property.components.update',['updates' => $property->updates->toArray()])
                                        </div>

                                        <div class="tab-pane fade" id="share" role="tabpanel" aria-labelledby="share-tab">
                                            @include('admin.property.components.share',['shares' => $property->sharesCustomers ,'isCustomer' => true])
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
            
                            
                        
                    </div>

                </div>

            </div><!-- COL END -->

        </div>
@endsection

<script>    
    var amenities = {!! isset($property)?json_encode($property->amenities->toArray()): json_encode([]) !!};
    amenities = amenities.map(a => a.id);
</script>

@push('script')
<script>
    
    $('#inp-amenity_ids').val(amenities);
    $('#inp-amenity_ids').select2();
    
</script>
@endpush
