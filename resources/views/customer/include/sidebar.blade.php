<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ route('admin.dashboard.index') }}"><img src="{{asset('images/'.$system_info->logo_login)}}" style="width: 150px" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ route('admin.dashboard.index') }}"><img src="{{asset('images/'.$system_info->logo_login)}}" style="width: 150px" class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ route('admin.dashboard.index') }}"><img src="{{asset('images/'.$system_info->logo_login)}}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ route('admin.dashboard.index') }}"><img src="{{asset('images/'.$system_info->logo_login)}}" class="logo-icon dark-theme" alt="logo"></a>
    </div>
    @php
            $side_menu = sideMenu(Auth::guard('customer')->user()->id);
            // print_r($menus);
    @endphp
    
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{ asset('admin-assets/img/default.jpg') }}"><span class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold">{{ Auth::guard('customer')->user()->name  }}</h4>
                    
                </div>
            </div>
        </div>
        <ul class="side-menu">
            @php
            $side_menu = sideMenu(Auth::guard('customer')->user()->id);
            
        @endphp
            @foreach($menus as $menu) 
            <li class="@if(strpos(Route::currentRouteName(), $menu['main_route']) !== false ) active @endif ">
                <li class="slide">
                    <a class="side-menu__item" href="{{route($prefix.'.'.$menu['page'])}}">
                        <i class=" side-menu__icon {{$menu['icon_class']}}"></i>
                        <span class="side-menu__label">{{$menu['name']}}</span>
                    </a>
                </li>
                
            </li>     
            @endforeach
        
        
        </ul>
    </div>
</aside>
<!-- main-sidebar -->