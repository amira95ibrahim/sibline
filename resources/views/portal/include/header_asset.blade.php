

    <link rel="icon" href="{{asset('images/'.$system_info->favicon)}}" type="image/x-icon"/>

    <!--bootstrap 5 minified css source-->
    <link rel="stylesheet" href="{{ asset('portal-assets/css/vendor/bootstrap.min.css') }}">
    <!--font awesome 5 minified css source-->
    <link rel="stylesheet" href="{{ asset('portal-assets/icons/font_awesome/css/all.min.css') }}">
    <!--flaticon css source-->
    <link rel="stylesheet" href="{{ asset('portal-assets/icons/flat_icon/flaticon.css') }}">
    <!--admin icons-->
    <link rel="stylesheet" href="{{ asset('portal-assets/icons/cs/flaticon.css') }}">
    <!--owl carousel-2.3.4 minified css source-->
    <link rel="stylesheet" href="{{ asset('portal-assets/css/vendor/owl.carousel.min.css') }}">
    <!--owl carousel-2.3.4 theme default minified css source-->
    <link rel="stylesheet" href="{{ asset('portal-assets/css/vendor/owl.theme.default.min.css') }}">
    <!--magnific popup-1.1.0 css source-->
    <link rel="stylesheet" href="{{ asset('portal-assets/css/vendor/magnific-popup.css') }}">
    <!--jquery nice select css source-->
    <link rel="stylesheet" href="{{ asset('portal-assets/css/vendor/nice-select.css') }}">
    <!--animate css source-->
    <link rel="stylesheet" href="{{ asset('portal-assets/css/vendor/animate.css') }}">
    <!--custom css source-->
    <link rel="stylesheet" href="{{ asset('portal-assets/css/main.css') }}">
    <!--custom intlTelInput source-->
    <link rel="stylesheet" href="{{ asset('portal-assets/js/intlTelInput/css/intlTelInput.css') }}">
    <!-- Icons css -->
    <link href="{{ asset('admin-assets/css/icons.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet" >

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="{{ asset('portal-assets/css/main.ac6c4580.chunk.css') }}" rel="stylesheet" />
    <link href="{{ asset('portal-assets/css/main.db420fb7.chunk.css') }}" rel="stylesheet" />
    
    

    <link href="{{ asset('portal-assets/plugins/desoslide/dist/css/jquery.desoslide.css') }}" rel="stylesheet" />
    <link href="{{ asset('portal-assets/plugins/desoslide/assets/css/vendor/magic/magic.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('portal-assets/plugins/desoslide/assets/css/vendor/animate/animate.min.css') }}" rel="stylesheet" />
    
    <link href="{{ asset('portal-assets/plugins/rangeslider.js-2.3.0/rangeslider.css') }}" rel="stylesheet" />

    <style type="text/css">
        
        .custom__tag {
            display: inline-block;
            padding: 3px 12px;
            background: 
            #d2d7ff;
            margin-right: 8px;
            margin-bottom: 8px;
            border-radius: 10px;
            cursor: pointer;
        }
        .required:after{ 
            content:'*'; 
            color:red; 
            padding-left:5px;
        }
    </style>

    <script type="text/javascript">
        // Notice how this gets configured before we load Font Awesome
        window.FontAwesomeConfig = { autoReplaceSvg: false }
    </script>
    
    @stack('style')