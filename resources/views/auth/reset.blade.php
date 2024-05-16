<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>@yield('title','botaKey - Reset')</title>

        @include('portal.include.header_asset')

    </head>
    <body class="cs dark">
        <!--===preloader start===-->
        <div class="loader_wrapper" id="preloader" >
            <div class="loader">
                <div class="face">
                    <div class="circle"></div>
                </div>
                <div class="face">
                    <div class="circle sd"></div>
                </div>
                <div class="percent">
                    <span class="counterr">100</span><span class="per">%</span>
                </div>
            </div>
        </div>
        <!--===preloader end===-->

        <!--page wrapper start-->
        <!--====header navbar start====-->
        @include('portal.include.header')
        <!--====header navbar end====-->

        <!--====login section start====-->
        <section class="form_bg">
            <div class="container">
                <div class="form_container">
                    <div class="form_header">
                        <a href="index.html" class="registration_logo">
                            <img src="{{asset('images/'.$system_info->logo_login)}}" alt="{{$system_info->name}} Logo">
                        </a>
                    </div>
                    <form action="{{ route($guard.'.reset.sendMail') }}" method="POST" class="mt-60">
                        @csrf
                        <h1 class="form_title">RESET PASSWORD</h1>
                        <h4 class="form_desc">Provide that email you used in sign up.</h4>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('status') }}
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" placeholder="Enter Your Email" class="form-control para" id="email" required="required">
                            @if ($errors->has('email'))
                                <span class="text-danger"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit & check your  email inbox</button>
                        <div class="form_footer">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="para"><a href="{{ route($guard.'.login') }}">Login</a></p>
                                </div>
                                @if ($guard == 'customer')
                                <div class="col-md-6">
                                    <p class="para"><a href="{{ route($guard.'.register') }}">Register</a></p>
                                </div>
                                @endif
                            </div>
                            
                        </div>
                        @if(session()->has('error'))
                        <h4 class="text-danger text-center">{!! session()->get('error') !!}</h4>
                        @endif
                    </form>
                </div>
            </div>
        </section>
        <!--====login section end====-->

        <!--====footer navbar start-->
        @include('portal.include.footer')
        <!--====footer navbar end====-->

        <!--===scroll bottom to top===-->
        <a href="#" class="scrollToTop"><i class="flaticon-up-chevron"></i></a>
        <!--===scroll bottom to top===-->
        <!--page wrapper end-->

        <!-- look the file what it include  -->

        @include('portal.include.footer_asset')

        <!-- look the file what it include  -->
    </body>
</html>