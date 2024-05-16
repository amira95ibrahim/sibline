@extends('admin.master')
@section('title', 'Accounts')
@section('content')
    <div class="breadcrumb-header justify-content-between">

        <div class="my-auto">

            <div class="d-flex">

                <h4 class="content-title mb-0 my-auto">Accepted Accounts</h4>

            </div>

        </div>
    </div>
    </div>
    <!-- breadcrumb -->
    <!--Row-->

    <div class="row row-sm">

        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

            <div class="card">

                <div class="card-body">

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
        function approveAccount() {


            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save updates !'
            }).then((result) => {
                if (result.isConfirmed) {

                    var data_rows = $('.data-row');

                    var array_data = [];

                    $.each($('.data-row'), function() {
                        var obj = {

                            id: $(this).find('.ac_name').attr('account_id'),
                            ac_name: $(this).find('.ac_name').val(),
                            ac_email: $(this).find('.ac_email').val(),
                            ac_phone: $(this).find('.ac_phone').val(),
                            ac_address: $(this).find('.ac_address').val(),

                        }
                        if($(this).find('.ac_email').val() != ''){
                            array_data.push(obj);
                        }
                    });

                    console.log(array_data);
                    $.ajax({
                        type: 'POST',
                        url: '{{route("customer.updateAccounts")}}',
                        data: {
                            array_data: array_data,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {

                                console.log(data);
                                Swal.fire(
                                    'save updates successfully!',
                                    data.msg,
                                    'success'
                                );
                            window.location.href= '{{route("customer.dashboard.index")}}';
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire(
                                'Failed!',
                                'There is no data to submit',
                                'error'
                            );
                        }
                    });




                }
            })
        }
    </script>
@endpush
