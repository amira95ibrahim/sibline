<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>@yield('title','Getakey')</title>

        @include('portal.include.header_asset')

    </head>
    <body class="cs dark">
       

        <!--page wrapper start-->
        <div class="page_wrapper">
            
            <!--left sidebar-->
            @include('portal.include.sidebar', [
                'user' => \Auth::guard('customer')->user(),
                'prefix' => 'customer',
                'menus' => [
                    [
                        'page' => 'dashboard.index',
                        'icon_class' => 'fa fa-area-chart',
                        'name' => 'Dashboard',
                        'main_route' => 'dashboard',
                    ],
                    [
                         'page' => 'dashboard.index',
                        'icon_class' => 'fa fa-area-chart',
                        'name' => 'Dashboard',
                        'main_route' => 'dashboard',
                    ]
                  ]]
           
            )
            <!--left sidebar-->

            <!--body content-->
            <div class="body_content">

                <!--top bar-->
                @include('portal.include.topbar', [
                    'user' => \Auth::guard('customer')->user(),
                    'prefix' => 'customer'
                ])
                <!--top bar-->

                <!--main content-->
                <div class="container-fluid main_content">
                    @yield('content')
                </div>
                <!--main content-->
            </div>
            <!--body content-->
        </div>
        <!--page wrapper end-->

        <!-- look the file what it include  -->

        @include('portal.include.footer_asset')

        <!-- look the file what it include  -->
    </body>
</html>