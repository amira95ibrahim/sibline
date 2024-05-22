    <!-- Favicon -->
    <link rel="icon" href="{{asset('images/'.$system_info->favico)}}" type="image/x-icon"/>
    <!-- Icons css -->
    <link href="{{ asset('admin-assets/css/icons.css') }}" rel="stylesheet">
    <!--  Sidebar css -->
    <link href="{{ asset('admin-assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/closed-sidemenu.css') }}">
    <!--  Owl-carousel css-->
    <link href="{{ asset('admin-assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ asset('admin-assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
    <!--- Style css -->
    <link href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('admin-assets/switcher/demo.css') }}" rel="stylesheet">

    <!---font-awesome css-->
    <link href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">


  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet" >

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



    <!-- select 2  -->

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

        .main-logo{
            height: 4em;
            padding: 0px 20px;

        }
    </style>

    @stack('style')
