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
            $side_menu = sideMenu(Auth::guard('admin')->user()->id);
            
    @endphp
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{ asset('images') .'/'. Auth::guard('admin')->user()->image }}"><span class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ Auth::guard('admin')->user()->first_name .' '. Auth::guard('admin')->user()->last_name }}</h4>
                    <span class="mb-0 text-muted">{{ Auth::guard('admin')->user()->role->name }}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            @foreach($side_menu as $value) 

            @if(count($value['sub_menu'])>0)
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#"><i class=" side-menu__icon fa {{ $value['icon'] }}"></i><span class="side-menu__label">{{ $value['name'] }}</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    @foreach($value['sub_menu'] as $sub)
                        <li @if(Route::currentRouteName() == $sub->menu_url) class="active active_url" @endif>
                            <a class="slide-item" href="{{ $sub->menu_url ? route($sub->menu_url) : '' }}">{{ $sub->name }}</a>
                        </li>      
                    @endforeach
                </ul>
            </li>

            @else 

            <li class=" @if(Route::currentRouteName() == $value['url']) active @endif ">
                <li class="slide">
                    <a class="side-menu__item" href="{{ $value['url'] ? route($value['url']) : '' }}">
                        <i class="side-menu__icon fa {{ $value['icon'] }}"></i>
                        <span class="side-menu__label">{{ $value['name'] }}</span>
                    </a>
                </li>
                
            </li> 


            @endif
            
            @endforeach


        </ul>
    </div>
</aside>
<!-- main-sidebar -->