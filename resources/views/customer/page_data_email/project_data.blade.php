<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from laravel.spruko.com/valex/leftmenu-light-rtl/cards by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 12 Jun 2020 07:57:17 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords"
          content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>
    <!-- Title -->
    <title> AfS </title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset('admin-assets/assets/img/brand/favicon.png')}}"
          type="image/x-icon"/>
    <!-- Icons css -->
    <link href="{{asset('admin-assets/assets/css/icons.css')}}" rel="stylesheet">
    <!--  Custom Scroll bar-->
    <link href="{{asset('admin-assets/assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}"
          rel="stylesheet"/>
    <!--  Sidebar css -->
    <link href="{{asset('admin-assets/assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{asset('admin-assets/assets/css/closed-sidemenu.css')}}">
    <link href="{{asset('admin-assets/assets/plugins/morris.js/morris.css')}}" rel="stylesheet">
    <link href="{{asset('admin-assets/assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
    <!--- Style css -->
    <link href="{{asset('admin-assets/assets/css/style.css')}}" rel="stylesheet">
    <!--- Dark-mode css -->
    <link href="{{asset('admin-assets/assets/css/style-dark.css')}}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{asset('admin-assets/assets/css/skin-modes.css')}}" rel="stylesheet">

    <!---Switcher css-->
    <link href="{{asset('admin-assets/assets/switcher/css/switcher.css')}}" rel="stylesheet">
    <link href="{{asset('admin-assets/assets/switcher/demo.css')}}" rel="stylesheet">
</head>

<body class="main-body app sidebar-mini">


<!-- Loader -->
<div id="global-loader">
    <img src="{{asset('admin-assets/assets/img/loader.svg')}}" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->

<div class="container-fluid mt-5">
    <div class="row d-flex justify-content-center">
        <img src="{{ asset('images/' . $system_setting->logo_header) }}"
             class="logo-page w-25" alt="logo">
    </div>

    <!-- row opened -->
    <div class="row">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        @if (\Session::has('failure'))
            <div class="alert alert-danger">
                <p>{{ \Session::get('failure') }}</p>
            </div>
        @endif
        <div class="col-12 col-sm-12 col-lg-12 col-xl-12">
            <div class="card card-info">
                <div class="card-body">
                    <p class="card-text">Ut aut reiciendis voluptatibus maiores alias consequatur
                        aut perferendis doloribus asperiores repellat.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- /row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-4">
            <div class="card">

                <div class="card-header tx-medium bd-0 tx-white bg-gray-800">
                    Project And Account Data
                </div>
                <div class="card-body ">
                    <p class="mg-b-0">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="card-title">{{ $account->project->name ?? 'Project Name' }}
                            </h5>
                        </div>
                        <div class="col-6">
                            <p class="card-text">{{ $account->project->name ?? 'Project Name' }}
                            </p>
                        </div>
                        <div class="col-6">
                            <p class="card-text"> Fiscal Year :
                                {{ $account->project->fiscal_year ?? '' }}
                            </p>
                        </div>
                    </div>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mg-md-t-0">
            <div class="card">
                <div class="card-header tx-medium bd-0 tx-white bg-gray-800">
                    Your Company
                </div>
                <div class="card-body ">
                    <p class="mg-b-0">
                    <h5 class="card-title">
                        {{ $customer_contact->customer->name ?? '' }}
                    </h5>
                    <p class="card-text">
                        {{ $customer_contact->customer->email ?? ''}}</p>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mg-md-t-0">
            <div class="card">
                <div class="card-header tx-medium bd-0 tx-white bg-gray-800">
                    System Information
                </div>
                <div class="card-body ">
                    <p class="mg-b-0">
                    <div class="row">
                        <div class="col-6" style="color:black">
                            <h5 class="card-title" style="color:black">{{ $system_setting->name }}
                            </h5>
                            <h6 class="card-title" style="color:black">
                                {{ $system_setting->short_name }}
                            </h6>
                        </div>
                        <div class="col-6">
                            <img class="rounded" style="width:140px;heigth:140px"
                                 src="{{ asset('images/' . $system_setting->logo_header) }}"
                                 alt="{{ $system_setting->name }}">
                        </div>
                        <div class="col-6" style="color:black">
                            <p>{{ $system_setting->email }}</p>
                            <p>{{ $system_setting->phone }}</p>
                            <p>{{ $system_setting->address }}</p>
                        </div>
                    </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- /row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12  mg-md-t-0">
            <div class="card custom-card bg-dark card-body tx-white-8 bg-gray-800 card-draggable">
                Some quick example text to build on the card title and make up the bulk of the
                card's content. Lorem ipsum dolor sit amet consictetur.
            </div>
        </div>
    </div>
    <!-- /row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-4 col-lg-6 col-sm-6 col-md-6">
            <div
                class="card card custom-card bg-dark card-body tx-white-8 bg-gray-800 card-draggable text-center">
                <div class="card-body">
                    <h6 class="mb-1 text-muted">TRANSACTIONS TOTAL DEBIT AS AT
                        {{$account->project->fiscal_year}}</h6>
                    <h3 class="font-weight-semibold">{{ number_format($account->m_debit) ?? '' }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-sm-6 col-md-6">
            <div
                class="card card custom-card bg-dark card-body tx-white-8 bg-gray-800 card-draggable text-center">
                <div class="card-body">
                    <h6 class="mb-1 text-muted">TRANSACTIONS TOTAL CREDIT AS AT
                        {{$account->project->fiscal_year}}</h6>
                    <h3 class="font-weight-semibold">{{ number_format($account->m_credit) ?? ''
                    }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-sm-6 col-md-6">
            <div
                class="card custom-card bg-dark card-body tx-white-8 bg-gray-800 card-draggable text-center">
                <div class="card-body ">
                    <h6 class="mb-1 text-muted">TRANSACTIONS TOTAL BALANCE AS
                        AT {{$account->project->fiscal_year}}</h6>
                    <h3 class="font-weight-semibold">{{ number_format($account->balance) ?? ''
                    }}</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- /row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header tx-medium bd-0 tx-white bg-gray-800">
                    <i class="mdi mdi-chat"></i> Answer the request
                </div>
                <div class="card-body ">
                    @if($account->is_replay == null && $account->type_replay == null)
                        <form method="post" action="{{ route('project_data_store', $account->hash) }}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <label>Choose a Type of response</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="radio" class="btn-check" name="type_replay" value="1"
                                               id="success-outlined reply" autocomplete="off"
                                               checked onclick="show_reply_section()">
                                        <label
                                               for="success-outlined">Reply</label>

                                        <input type="radio" onclick="hidden_reply_section()" class="btn-check"
                                               name="type_replay"
                                               value="2"
                                               id="info-outlined"  autocomplete="off">
                                        <label
                                               for="info-outlined">Decline</label>

                                        <input type="radio" onclick="hidden_reply_section()" class="btn-check"
                                               name="type_replay"
                                               value="3"
                                               id="danger-outlined" autocomplete="off">
                                        <label  for="danger-outlined">More
                                            info
                                            need</label>

                                    </div>
                                    @error('type_replay')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-12" id="repy_section">

                                    <div class="col-md-6">
                                        <label> Reply </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="radio" class="btn-check" name="is_replay" value="1"
                                               id="success-reply" autocomplete="off" checked>
                                        <label
                                               for="success-reply">Agree</label>

                                        <input type="radio" class="btn-check" name="is_replay" value="2"
                                               id="info-reply" autocomplete="off">
                                        <label
                                               for="info-reply">Disagree</label>
                                    </div>
                                    @error('is_replay')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                    @enderror

                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="input-group">
                                        <span class="input-group-text">Comment</span>
                                        <textarea class="form-control" name="comment"
                                                  aria-label="Comment"></textarea>
                                        @error('comment')
                                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                </div>


                                <div class="col-md-12">
                                    <label>Attachements</label>
                                    <div class="input-group">

                                        <input class="form-control" name="attachements[]"
                                               type="file" multiple>
                                        @error('attachement')
                                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row col-md-12 mb-3 mt-3">

                                    <div class="col-md-6 mb-2 form-group">
                                        <div class="input-group">
                                            <span class="input-group-text">First name</span>
                                            <input type="text" class="form-control"
                                                   name="c_first_name"/>
                                            @error('c_first_name')
                                            <span
                                                class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6 mb-2 form-group">
                                        <div class="input-group">
                                            <span class="input-group-text"> Last name</span>
                                            <input type="text" class="form-control" name="c_last_name"/>
                                            @error('c_last_name')
                                            <span
                                                class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6 mb-2  form-group">
                                        <div class="input-group">
                                            <span class="input-group-text">Email</span>
                                            <input type="text" class="form-control" name="c_email"/>
                                            @error('c_email')
                                            <span
                                                class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6 mb-2 form-group">
                                        <div class="input-group">
                                            <span class="input-group-text">Position</span>
                                            <input type="text" class="form-control" name="c_position"/>
                                            @error('c_position')
                                            <span
                                                class="text-danger"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>

                            </div>

                        </form>
                    @else
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">This form has been submitted already , you are allowed to submit your reply once</h5>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /row closed -->

</div>

<script>
    hidden_reply_section();
    function show_reply_section(){
        $('#repy_section').show();
    }
    function hidden_reply_section(){
        $('#repy_section').hide();
    }
</script>
<!-- Back-to-top -->

<!-- JQuery min js -->
<script src="{{asset('admin-assets/assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Bundle js -->
<script
    src="{{asset('admin-assets/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{asset('admin-assets/assets/plugins/ionicons/ionicons.js')}}"></script>
<!-- Moment js -->
<script src="{{asset('admin-assets/assets/plugins/moment/moment.js')}}"></script>

<!-- Rating js-->
<script src="{{asset('admin-assets/assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{asset('admin-assets/assets/plugins/rating/jquery.barrating.js')}}"></script>

<!--Internal  Perfect-scrollbar js -->
<script
    src="{{asset('admin-assets/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('admin-assets/assets/plugins/perfect-scrollbar/p-scroll.js')}}"></script>
<!--Internal Sparkline js -->
<script
    src="{{asset('admin-assets/assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Custom Scroll bar Js-->
<script
    src="{{asset('admin-assets/assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- right-sidebar js -->
<script src="{{asset('admin-assets/assets/plugins/sidebar/sidebar-rtl.js')}}"></script>
<script src="{{asset('admin-assets/assets/plugins/sidebar/sidebar-custom.js')}}"></script>
<!-- Eva-icons js -->
<script src="{{asset('admin-assets/assets/js/eva-icons.min.js')}}"></script>
<!-- Sticky js -->
<script src="{{asset('admin-assets/assets/js/sticky.js')}}"></script>
<!-- custom js -->
<script src="{{asset('admin-assets/assets/js/custom.js')}}"></script><!-- Left-menu js-->
<script src="{{asset('admin-assets/assets/plugins/side-menu/sidemenu.js')}}"></script>
<!-- Switcher js -->
<script src="{{asset('admin-assets/assets/switcher/js/switcher-rtl.js')}}"></script>
</body>
<!-- Mirrored from laravel.spruko.com/valex/leftmenu-light-rtl/cards by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 12 Jun 2020 07:57:20 GMT -->
</html>
