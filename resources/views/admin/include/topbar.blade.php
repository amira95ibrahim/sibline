<!-- main-header opened -->
<div class="main-header sticky side-header  ">
    <div class="container-fluid">
        <div class="main-header-left ">
            <div class="responsive-logo">
                <a href="{{ route('admin.dashboard.index') }}"><img src="{{ asset('admin-assets/img/brand/logo.png') }}" class="logo-1" alt="logo"></a>
                <a href="{{ route('admin.dashboard.index') }}"><img src="{{ asset('admin-assets/img/brand/logo-white.png') }}" class="dark-logo-1" alt="logo"></a>
                <a href="{{ route('admin.dashboard.index') }}"><img src="{{ asset('admin-assets/img/brand/favicon.png') }}" class="logo-2" alt="logo"></a>
                <a href="{{ route('admin.dashboard.index') }}"><img src="{{ asset('admin-assets/img/brand/favicon.png') }}" class="dark-logo-2" alt="logo"></a>
            </div>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
                <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
            </div>
            
        </div>
        <div class="main-header-right">
            <!--<ul class="nav">
                <li class="">
                    <div class="dropdown  nav-itemd-none d-md-flex">
                        <a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1" data-toggle="dropdown" aria-expanded="false">
                            <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img src="{{ asset('admin-assets/img/flags/us_flag.jpg') }}" alt="img"></span>
                            <div class="my-auto">
                                <strong class="mr-2 ml-2 my-auto">English</strong>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
                            <a href="#" class="dropdown-item d-flex ">
                                <span class="avatar  ml-3 align-self-center bg-transparent"><img src="{{ asset('admin-assets/img/flags/french_flag.jpg') }}" alt="img"></span>
                                <div class="d-flex">
                                    <span class="mt-2">French</span>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item d-flex">
                                <span class="avatar  ml-3 align-self-center bg-transparent"><img src="{{ asset('admin-assets/img/flags/germany_flag.jpg') }}" alt="img"></span>
                                <div class="d-flex">
                                    <span class="mt-2">Germany</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>-->
            
            <div class="nav-item main-header-notification">
                

                @if (\App\Models\Notification::where(['receiver_id' => Auth::guard('admin')->user()->id , 'receiver_model' => 'User' , 'is_read' => '0'])->get()->count() > 0)
                    <a class="" href="{{route('admin.notification.index')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class=" pulse"></span></a>
                    </a>
                @else
                    <a class="" href="{{route('admin.notification.index')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg></a>
                    </a>
                @endif
            </div>
           
            <div class="nav nav-item  navbar-nav-right ml-auto">
                
                <div class="dropdown main-profile-menu nav nav-item nav-link">
                    <a class="profile-user d-flex" href="#"><img alt="" src="{{ asset('images') .'/'. Auth::guard('admin')->user()->image }}"></a>
                    <div class="dropdown-menu">
                        <div class="main-header-profile bg-primary p-3">
                            <div class="d-flex wd-100p">
                                <div class="main-img-user"><img alt="" src="{{ asset('images') .'/'. Auth::guard('admin')->user()->image }}" class=""></div>
                                <div class="mr-3 my-auto">
                                    <h6>{{ Auth::guard('admin')->user()->first_name .' '. Auth::guard('admin')->user()->last_name }}</h6><span>{{ Auth::guard('admin')->user()->role->name }}</span>
                                </div>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{route('admin.profile')}}"> Edit Profile</a>
                        <a class="dropdown-item" href="{{route('admin.logout')}}">Sign Out</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- /main-header -->