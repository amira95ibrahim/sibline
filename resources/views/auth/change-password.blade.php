<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>@yield('title','botaKey - Reset Password')</title>

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
                    <form action="{{ route($guard.'.reset.submit') }}" method="POST" class="mt-60">
                        {!! Form::hidden('token', $token) !!}
                        @csrf
                        <h1 class="form_title">RESET PASSWORD</h1>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('status') }}
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {!! session()->get('error') !!}
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <label for="password-field" class="form-label">Password </label>
                            <div class="show_password">
                                <input type="password" name="password" value="{{ old('password') }}" placeholder="Enter Your Password" class="form-control para" id="password-field" required="required">
                                <i class="fas fa-eye toggle-password"></i>
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger"><strong>{{ $errors->first('password') }}</strong></span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Enter Your Confirm Password" class="form-control para" id="password_confirmation" required="required">
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                            @endif
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Confirm Password</button>
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