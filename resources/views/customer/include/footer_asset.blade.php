    <!-- Mainly scripts -->
    <script>
    var base_url = "{{ url('/') }}"+'/';
    </script>
    <!-- JQuery min js -->
    <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap Bundle js -->
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Ionicons js -->
    <script src="{{ asset('admin-assets/plugins/ionicons/ionicons.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ asset('admin-assets/plugins/moment/moment.js') }}"></script>

    <!-- Rating js-->
    <script src="{{ asset('admin-assets/plugins/rating/jquery.rating-stars.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/rating/jquery.barrating.js') }}"></script>

    <!--Internal  Perfect-scrollbar js -->
    <script src="{{ asset('admin-assets/plugins/perfect-scrollbar/p-scroll.js') }}"></script>
    <!--Internal Sparkline js -->
    <script src="{{ asset('admin-assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- Eva-icons js -->
    <script src="{{ asset('admin-assets/js/eva-icons.min.js') }}"></script>
    <!--Internal  Chart.bundle js -->
    <script src="{{ asset('admin-assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ asset('admin-assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ asset('admin-assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('admin-assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ asset('admin-assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ asset('admin-assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ asset('admin-assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('admin-assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ asset('admin-assets/js/index.js') }}"></script>
    <script src="{{ asset('admin-assets/js/jquery.vmap.sampledata.js') }}"></script>	
    <!-- Sticky js -->
    <script src="{{ asset('admin-assets/js/sticky.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('admin-assets/js/custom.js') }}"></script><!-- Left-menu js-->
    <script src="{{ asset('admin-assets/plugins/side-menu/sidemenu.js') }}"></script>

    <script src="{{ asset('admin-assets/js/validator.min.js') }}"></script>

    <!-- font-awesome -->
    <script src="{{ asset('admin-assets/plugins/fontawesome-free/font.js') }}"></script>
    
    <!-- bootstrap -->
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}" ></script>


    <!-- Datatables -->
    <script src="{{ asset('admin-assets/plugins/dataTables/jquery.dataTables.min.js') }} " ></script>
    <script src="{{ asset('admin-assets/plugins/dataTables/dataTables.bootstrap4.min.js') }} " ></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }} " ></script>


    <script src="{{ asset('admin-assets/plugins/dataTables/dataTables.buttons.min.js') }} " ></script>
    
    <script src="{{ asset('admin-assets/plugins/dataTables/jszip.min.js') }} " ></script>
    <script src="{{ asset('admin-assets/plugins/dataTables/pdfmake.min.js') }} " ></script>
    <script src="{{ asset('admin-assets/plugins/dataTables/vfs_fonts.js') }} " ></script>
    <script src="{{ asset('admin-assets/plugins/dataTables/buttons.html5.min.js') }} " ></script>
    <script src="{{ asset('admin-assets/plugins/dataTables/buttons.print.min.js') }} " ></script>

    <!-- swal -->
    <script src="{{ asset('admin-assets/plugins/swal/sweetalert2@11.js') }} " ></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function delElement(link) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type:'DELETE',
                        url: link,
                        data:'_token = {{ csrf_token() }}',
                        success:function(data) {
                            Swal.fire(
                                'Deleted!',
                                data.msg,
                                'success'
                            );
                            window.location.reload();
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            Swal.fire(
                                'Failed!',
                                "You don't have permission to delete .",
                                'error'
                            );
                        }
                    });


                    
                    
                }
            })
        }

        function readNotification(id) {
            $.ajax({
                    type:'PUT',
                    url: 'notification/'+id,
                    data:'_token = {{ csrf_token() }}',
                    success:function(data) {
                        
                        console.log(data);
                    }
                });
        }

        function requestData(link,id,element_id) {
            $.ajax({
                type:'GET',
                url: base_url+link+'/'+ (id?id:'0'),
                success:function(data) {
                    $('#'+element_id).empty().append(new Option('None', ''));
                    data.values.forEach(value => {
                        $('#'+element_id).append(new Option(value.name, value.id));
                    });
                     window.location.reload();
                }
            });
        }

        $(document).ready(function(){
            $('input,textarea,select').filter('[required]:visible').each(function(el){

                $('label[for='+  this.id  +']').addClass('required')

            });
            $(".datatable").DataTable({
                /* Disable initial sort */
                "aaSorting": []
            });
            
            
        });

        $("textarea").addClass("ckeditor");
        CKEDITOR.replaceClass('ckeditor');
        
        
    </script>
    <script>
       function check_all(){
        $('input[class="item_checkbox"]:checkbox').each(function(){
            if($('input[class="check_all"]:checkbox:checked').length == 0){
                $(this).prop('checked',false);
            }else{
                $(this).prop('checked',true);
            }
        });
        }

        function approveItems() {
            Swal.fire({
                title: 'Are you sure?',
                text: "Send authorization requests to your client?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes,Send authorization requests'
            }).then((result) => {
               
                if (result.isConfirmed) {
                    
                    var item_checked = $('input[class="item_checkbox"]:checkbox').filter(':checked').length;
                    var item_value_checked =  $('input[class="item_checkbox"]:checkbox:checked').map(function(){return $(this).val();}).get();
                    info = [];
                    info[0] = '{{ csrf_token() }}';
                    info[1] = item_value_checked;
                    console.log(item_value_checked);
                    $.ajax({
                        type:'POST',
                        url:"/admin/sendRequestsCustomer",
                        data:{info:info},
                        success:function(data) {
                            if(item_checked > 0){
                                Swal.fire(
                                    'Send authorization successfully!',
                                    data.msg,
                                    'success'
                                );
                                window.location.reload();
                            }else{
                                Swal.fire(
                                'Failed!',
                                'select accounts please!',
                                'error'
                              ); 
                            }
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            Swal.fire(
                                'Failed!',
                                thrownError,
                                'error'
                            );
                        }
                    });


                    
                    
                }
            }
            )
        }
    </script>
    @stack('script')
