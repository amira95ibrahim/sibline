


<!DOCTYPE html>

<html>



<head>



    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <title>@yield('title','Getakey')</title>



    @include('admin.include.header_asset')





</head>



<body class="main-body app sidebar-mini" >

    <!-- Loader -->
    <div id="global-loader">
        <img src="{{ asset('admin-assets/img/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->
    @if(Auth::guard('admin')->check())
       @include('admin.include.sidebar')
    @elseif(Auth::guard('customer')->check())
        @include('customer.include.sidebar',[
            'user' => \Auth::guard('customer')->user(),
            'prefix' => 'customer',
            'menus' => [
                [
                    'page' => 'dashboard.index',
                    'icon_class' => 'fa fa-area-chart',
                    'name' => 'Dashboard',
                    'main_route' => 'dashboard',
                ],  


            ],
            'reports' => []
        ])
    @endif


    <div class="main-content app-content">



            @if(Auth::guard('admin')->check())
                @include('admin.include.topbar')
            @elseif(Auth::guard('customer')->check())
                @include('customer.include.topbar')
            @endif

            <div class="container-fluid">


                <!-- all dynamic content will go there  -->
                @yield('content')
            </div>




            <!-- Footer opened -->
            <div class="main-footer ht-40">
                <div class="container-fluid pd-t-0-f ht-100p">
                    <span>Copyright © 2022 <a href="#">AFS</a>. Designed by <a
                            href="https://optimalsolutionscorp.com/">Optimal Solutions</a> All rights reserved.</span>
                </div>
            </div>
            <!-- Footer closed -->



    </div>



    <!-- look the file what it include  -->

    @include('admin.include.footer_asset')

    <!-- look the file what it include  -->



</body>



</html>

