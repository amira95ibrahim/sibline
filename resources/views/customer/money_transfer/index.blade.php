@extends('customer.master')
@section('title','Money Transfers')
@section('content')
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Money Transfers</h4>

                </div>

            </div>
        </div>
        

        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

                <div class="card">

                    <div class="card-body">
                        <div class="d-flex my-xl-auto right-content">
                            <div class="pr-1 mb-3 mb-xl-0">
                                  <a href="{{ url('customer/money-transfer/create') }}" title="Transfer Money">
                                      <button type="button" class="btn bk-color-spy"><i class="fa fa-forward"></i></button>
                                  </a>
                              </div>
                          </div>

                        <div class="table-responsive userlist-table">

                            {!! $dataTable->table() !!}

                        </div>

                    </div>

                </div>

            </div><!-- COL END -->

        </div>
@endsection

@push('script')
{!! $dataTable->scripts() !!}
<script>
@if(session()->has('message'))
    Swal.fire(
        'Success!',
        ' {{session()->get('message')}} ',
        'success'
    );
@elseif(session()->has('error'))
    Swal.fire(
                'Failed!',
                ' {{session()->get('error')}} ',
                'error'
            );
@endif
</script>
@endpush


