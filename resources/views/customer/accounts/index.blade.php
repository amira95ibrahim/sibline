@extends('admin.master')
@section('title', 'Accounts')
@section('content')
    <div class="breadcrumb-header justify-content-between">

        <div class="my-auto">

            <div class="d-flex">

                <h4 class="content-title mb-0 my-auto">Accounts</h4>

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
                <div class="pr-1 mb-3 mb-xl-0" style="text-align:center">

                    <button type="button" onclick="approveAccount()" class="btn btn-primary">send values</button>


                </div>
            </div>

        </div><!-- COL END -->

    </div>
@endsection

@push('script')
    {!! $dataTable->scripts() !!}
    <script>
        function selectAllApprove() {
            $("#approveAll").click(function() {
                $(".approve").prop("checked", true);
                $('.radioButton').removeClass("btn-success").addClass("btn-danger").attr('id', 'notapproveAll')
                    .attr('onclick', 'unselectAllApprove()').html("Not Approve");
            });
        }

        function unselectAllApprove() {

            $("#notapproveAll").click(function() {
                $(".notApprove").prop("checked", true);
                $('.radioButton').removeClass("btn-danger").addClass("btn-success").attr('id', 'approveAll').attr(
                    'onclick', 'selectAllApprove()').html('Approve');
            });

        }

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

                            id: $(this).find('input[name="ac_name"]').attr('id'),
                            ac_name: $(this).find('input[name="ac_name"]').val(),
                            ac_email: $(this).find('input[name="ac_email"]').val(),
                            ac_phone: $(this).find('input[name="ac_phone"]').val(),
                            ac_address: $(this).find('input[name="ac_address"]').val(),
                            authorization_status: $(this).find('input[type="radio"]:checked').val(),

                        }
                        array_data.push(obj);
                    });

                    console.log(array_data);
                    $.ajax({
                        type: 'POST',
                        url: "/public/customer/update_accounts",
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
                                message-form
                                
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            Swal.fire(
                                'Failed!',
                                "You don't have permission to delete.",
                                'error'
                            );
                        }
                    });




                }
            })
        }
    </script>
@endpush
