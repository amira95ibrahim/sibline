    <!-- Mainly scripts -->
    <script>
    var base_url = "{{ url('/') }}"+'/';
    </script>

    <!--jquery-3.6.0 minified source-->
    <script src="{{ asset('portal-assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <!--bootstrap 5 minified bundle js source-->
    <script src="{{ asset('portal-assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <!--owl carousel-2.3.4 minified js source-->
    <script src="{{ asset('portal-assets/js/vendor/owl.carousel.min.js') }}"></script>
    <!--jquery waypoints minified source-->
    <script src="{{ asset('portal-assets/js/vendor/jquery.waypoints.min.js') }}"></script>
    <!--magnific popup-1.1.0 minified source-->
    <script src="{{ asset('portal-assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <!--counter up-1.0.0 minified js source-->
    <script src="{{ asset('portal-assets/js/vendor/jquery.counterup.min.js') }}"></script>
    <!--jquery nice select minified source-->
    <script src="{{ asset('portal-assets/js/vendor/jquery.nice-select.min.js') }}"></script>
    <!--apexs chart minified js source-->
    <script src="{{ asset('portal-assets/js/vendor/apexcharts.min.js') }}"></script>
    
    <!--wow animation js source-->
    <script src="{{ asset('portal-assets/js/vendor/wow.min.js') }}"></script>
    <!--custom js source-->
    <script src="{{ asset('portal-assets/js/main.js') }}"></script>

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


    <!-- font-awesome -->
    <script src="{{ asset('admin-assets/plugins/fontawesome-free/font.js') }}"></script>

    
    
    <!-- bootstrap -->
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}" ></script>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
     
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

    <!--custom js source-->
    <script src="{{ asset('portal-assets/js/intlTelInput/js/intlTelInput.js') }}"></script>
    <script src="{{ asset('portal-assets/js/intlTelInput/js/utils.js') }}"></script>

    <script src="{{ asset('portal-assets/plugins/desoslide/dist/js/jquery.desoslide.min.js') }}"></script>


    <script src="{{ asset('portal-assets/plugins/rangeslider.js-2.3.0/rangeslider.js') }}"></script>



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
                            location.reload();
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

        var langURL = "{{ route('lang') }}";
        $("#language").change(function(){
            window.location.href = langURL + "?lang="+ $(this).val();
        });

        $("textarea").addClass("ckeditor");
        CKEDITOR.replaceClass('ckeditor');
    </script>

    @stack('script')

    <!--apex chart customization js source-->
    <script src="{{ asset('portal-assets/js/vendor/apex-customization.js') }}"></script>
