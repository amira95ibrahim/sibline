<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>@yield('title','botaKey - Register')</title>

        @include('portal.include.header_asset')

        <style>
            .iti { width: 100%; }
        </style>

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
                    <form action="{{ route('customer.register.submit') }}" method="POST" class="mt-60">
                        @csrf
                        
                        <h1 class="form_title">Start investing today.</h1>

                        <h4 class="form_desc">In less than 5 minutes, 
                            you can start growing your wealth.</h4>

                        @if (session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {!! session()->get('error') !!}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-lg-6 col-xl-6-1 col-md-12 col-sm-12 d-inline-block">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input name="first_name" type="text" value="{{ old('first_name') }}" placeholder="Enter Your First Name" class="form-control para" id="first_name" required="required">
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger"><strong>{{ $errors->first('first_name') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-xl-6-1 col-md-12 col-sm-12 d-inline-block">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input name="last_name" type="text" value="{{ old('last_name') }}" placeholder="Enter Your Last Name" class="form-control para" id="last_name" required="required">
                                    @if ($errors->has('last_name'))
                                        <span class="text-danger"><strong>{{ $errors->first('last_name') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label for="year" class="form-label">Birth Date</label>
                            <div class="col-lg-4 col-xl-4-1 col-md-12 col-sm-12 d-inline-block">
                                <div class="mb-3">
                                    
                                    <select name="year" id="year" class="form-control para " required>
                                        @for($i = date("Y"); $i >= date("Y") - 100; $i --)
                                            <option value="{{ $i }}" @if(old('year') == $i) selected @endif>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @if ($errors->has('year'))
                                        <span class="text-danger"><strong>{{ $errors->first('year') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-xl-4-1 col-md-12 col-sm-12 d-inline-block">
                                <div class="mb-3">
                                    <select name="month" id="month" class="form-control" required>
                                        @for($i = 1; $i <= 12; $i ++)
                                            <option value="{{ $i }}" @if(old('month') == $i) selected @endif>{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                                        @endfor
                                    </select>
                                    @if ($errors->has('month'))
                                        <span class="text-danger"><strong>{{ $errors->first('month') }}</strong></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-xl-4-1 col-md-12 col-sm-12 d-inline-block">
                                <div class="mb-3">
                                    
                                    <select name="day" id="day" class="form-control" required>
                                        @for($i = 1; $i<=31; $i++)
                                            <option value="{{ $i }}" @if(old('day') == $i) selected @endif>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @if ($errors->has('day'))
                                        <span class="text-danger"><strong>{{ $errors->first('day') }}</strong></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="inp-country_id" class="form-label">Country</label>
                            <select name="country_id" id="inp-country_id" class="form-control" required>
                                <option value="">None</option>
                                @foreach (\App\Models\Country::whereNull('parent_id')->get() as $country)
                                    <option value="{{ $country->id }}" @if(old('country_id') == $country->id) selected @endif>{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('country_id'))
                                <span class="text-danger"><strong>{{ $errors->first('country_id') }}</strong></span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="inp-city_id" class="form-label">City</label>
                            <select name="city_id" id="inp-city_id" class="form-control" required>
                                <option value="">None</option>
                                @if (old('city_id') != "" && old('country_id') != "")
                                    @foreach (\App\Models\Country::where('parent_id',old('country_id'))->whereNotNull('parent_id')->get() as $city)
                                        <option value="{{ $city->id }}" @if(old('city_id') == $city->id) selected @endif>{{ $city->name }}</option>
                                    @endforeach                                    

                                @endif
                            </select>
                            @if ($errors->has('city_id'))
                                <span class="text-danger"><strong>{{ $errors->first('city_id') }}</strong></span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" placeholder="Enter Your Email" value="{{ old('email') }}" class="form-control para" id="email" required="required">
                            @if ($errors->has('email'))
                                <span class="text-danger"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <div class="col-xs-12">
                                <input name="phone" type="tel" placeholder="Enter Your Phone"  class="form-control para pl-5" id="phone" required="required">
                                <input type="hidden" name="country_code" id="country_code" value="971">
                            </div>
                            @if ($errors->has('phone'))
                                <span class="text-danger"><strong>{{ $errors->first('phone') }}</strong></span>
                            @endif
                        </div>
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
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" name="iAgree" class="form-check-input" id="gridCheck" value="" required>
                                <label class="form-check-label alt-link ml-10p text-left" for="gridCheck">I accept Botakey’s</label>
                                <a class="terms_n_c">terms of service.</a>
                                @if ($errors->has('iAgree'))
                                    <span class="text-danger"><strong>{{ $errors->first('iAgree') }}</strong></span>
                                @endif
                            </div>
                        <div>
                        <button type="submit" class="btn btn-primary"> Register! </button>
                        
                        
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

        <script>
            var input = document.querySelector("#phone");
            
            
            var iti = intlTelInput(input, {
                preferredCountries:["AE","GB","LB","SA","BH"],
                utilsScript: "{{ asset('portal-assets/js/utils.js') }}",
            });

            input.addEventListener("countrychange", function() {
                $('#country_code').val(iti.getSelectedCountryData().dialCode);
                
            });
            $('#inp-country_id').change(function (e) {
                requestData('admin/country/get-childs',$(this).val(),'inp-city_id');
            });
        </script>
    </body>
</html>