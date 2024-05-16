@extends('admin.master')
@section('title','Customers')
@section('content')
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Manage Customers</h4>

                </div>

            </div>
        </div>
        
        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

                <div class="card">

                    <div class="card-body">
                        @if(isset($customer))

                                {!!Form::open()->fill($customer)->put()->multipart()->route('admin.customer.update',[$customer->id]) !!}
                              
                        @else
                            {!!Form::open()->multipart()->route('admin.customer.store')!!}
                        @endif

                        <div class="panel panel-primary tabs-style-2">
                            <div class=" tab-menu-heading">
                                <div class="tabs-menu1">
                                    <ul class="nav panel-tabs main-nav-line" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="main-tab" data-toggle="tab" href="#main" role="tab" aria-controls="main" aria-selected="true">Main Details</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Customer Contact</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="false">Address</a>
                                        </li>
                                        

                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body main-content-body-right border">
                                
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
                                       
                                        @include('admin.customer.main-details')

                                    </div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                                        @if(isset($customer) && !old('contact'))
                                            @include('admin.customer.contact-details',['contacts' => ($customer->castomerContacts->toArray()?$customer->castomerContacts->toArray() :  array(new \App\Models\CustomerContact))])
                                        @else
                                            @include('admin.customer.contact-details',['contacts' => (old('contact')? old('contact') :  array(new \App\Models\CustomerContact))])
                                        @endif
                                        
                                    </div>
                                     <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">

                                        @if(isset($customer))
                                            @include('admin.form_components.address',['address' => $customer->address, 'hideTitle' => true , 'hideRequired' => true])
                                        @else
                                            @include('admin.form_components.address',['address' => new \App\Models\Address, 'hideTitle' => true , 'hideRequired' => true])
                                        @endif

                                    </div>
                                     
                                    
                                    
                                

                                    

                                </div>
                            </div>
                        </div>
                        
                            
                        @if(!isset($show))
                        <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                              {!!Form::submit("Save")->attrs(['id'=>'submit_form'])!!}
                            <!--{!!Form::submit("Save")!!}-->
                             <!--<button  id="submit_form">Save</button>-->
                        </div>
                        @endif
                        
                        
                        {!!Form::close()!!}
                        
                    </div>

                </div>

            </div><!-- COL END -->

        </div>
@endsection

@push('script')
<script>
        @if(session()->has('success'))
         Swal.fire(
               'Success!',
               ' {{session()->get('success')}} ',
               'success'
            );
       
        @endif
</script>
@endpush
