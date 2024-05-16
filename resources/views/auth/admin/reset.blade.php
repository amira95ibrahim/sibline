<!DOCTYPE html>

<html>



<head>



    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','AFS - Reset Password')</title>

    

    @include('admin.include.header_asset')



    

</head>



<body class="" >

    <!-- Loader -->
    <div id="global-loader">
        <img src="{{ asset('admin-assets/img/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->

    <div id="wrapper">


        <div id="page-wrapper" class="gray-bg">
            <div class="container-fluid">
                <div class="row no-gutter">
                    <!-- The image half -->
                    <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent m-0 p-0">
                        <div class="row wd-100p mx-auto text-center m-0 p-0">
                            <div class="col-md-12 col-lg-12 col-xl-12 m-0 p-0">
                                <img src="{{ asset('admin-assets/img/media/lockscreen.png') }}" class="my-auto ht-xl-80p wd-md-100p h-100" alt="logo">
                            </div>
                        </div>
                    </div>
                    <!-- The content half -->
                    <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                        <div class="login d-flex align-items-center py-2">
                            <!-- Demo content-->
                            <div class="container p-0">
                                <div class="row">
                                    <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                        <div class="mb-5 d-flex mx-auto"> <a href="" class="mx-auto d-flex"><img src="{{asset('images/'.$system_info->logo_header)}}" class="sign-favicon img-fluid ht-40 mx-auto" alt="logo"></a></div>
                                        <div class="main-card-signin d-md-flex bg-white">
                                            <div class="p-4 wd-100p">
                                                <div class="main-signin-header">
                                                    @if (session()->has('error'))
                                                        <div class="alert alert-danger" role="alert">
                                                            {!! session()->get('error') !!}
                                                        </div>
                                                    @endif
                                                    @if (session('status'))
                                                        <div class="alert alert-success" role="alert">
                                                            {{ session()->get('status') }}
                                                        </div>
                                                    @endif
                                                    <form method="POST" action="{{ route('admin.reset.sendMail') }}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <input class="form-control" name="email" placeholder="Enter your Email" type="email" value="">
                                                            @if ($errors->has('email'))
                                                            <span class="text-danger"><strong>{{ $errors->first('email') }}</strong></span>
                                                            @endif
                                                        </div>
                                                        
                                                        
                                                        <button class="btn btn-main-primary btn-block">Submit & check your  email inbox</button>
                                                    </form>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End -->
                        </div>
                    </div><!-- End -->
                </div>
            </div>
            
        </div>

    </div>



    <!-- look the file what it include  -->

    @include('admin.include.footer_asset')

    <!-- look the file what it include  -->



</body>



</html>

