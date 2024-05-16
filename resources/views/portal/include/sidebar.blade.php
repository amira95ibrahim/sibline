<ul class="side-menu">
    @php
    $side_menu = sideMenu(Auth::guard('customer')->user()->id);
    
@endphp
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