@extends('admin.master')
@section('title','Dashboard')
@section('content')
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Dashboard</h4>

                </div>

            </div>

            

        </div>
        

        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

                <div class="card">

                    <div class="card-body">

                        <div class="container-fluid">
                            
                          

                            <!-- row opened -->
                            <div class="row row-sm row-deck">
                             
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="card card-table-two">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="card-title mb-1">Your Active Projects</h4>
                                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                                        </div>
                                      
                                        <div class="table-responsive country-table">
                                            {!! $datatable ?? ''!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                        </div>
                    </div>

                </div>

            </div><!-- COL END -->

        </div>
@endsection

@push('script')
@endpush


