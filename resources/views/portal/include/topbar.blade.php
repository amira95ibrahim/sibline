<div class="container-fluid top_bar fixed-top">
    <div class="top_bar_wrapper d-flex align-items-center justify-content-between">
        <div class="search_bar d-flex align-items-center">
            <div class="show_hide d-flex align-items-center">
                <button type="button" id="click" title="Toggle Side Bar">
                    <span class="toggle_bar_one"></span>
                    <span class="toggle_bar_two"></span>
                    <span class="toggle_bar_three"></span>
                </button>
            </div>
            <div class="form">
                <form action="#" method="post" id="forSm">
                    <input type="search" name="searchBar" id="searchPlayers" placeholder="Search Players" required="required">
                    <button type="submit">
                        <i class="flaticon-loupe"></i>
                    </button>
                </form>
                <a href="javascript:void(0)" class="search_toggle d-block d-md-none">
                    <i class="flaticon-loupe"></i>
                </a>
            </div>
        </div>
        <div class="user_bar d-flex align-items-center justify-content-end">
            <div class="search_wrapper">
                <a href="javascript:void(0)" class="search_sm d-none">
                    <i class="flaticon-loupe d-flex align-items-center"></i>
                </a>
            </div>
            
            <div class="dollar_wrapper">
                <a href="#"></a>
            </div>
                
            <div class="notification_wrapper">
                @if (\App\Models\Notification::where(['receiver_id' => $user->id , 'receiver_model' => ucfirst($prefix) , 'is_read' => '0'])->get()->count() > 0)
                    <a href="{{route($prefix.'.notification.index')}}" class="not_read_notification">        
                        <i class="flaticon-bell"></i>
                    </a>
                @else
                    <a href="{{route($prefix.'.notification.index')}}">        
                        <i class="flaticon-bell"></i>
                    </a>
                @endif
                
                    
                
            </div>
            
            <div class="profile_wrapper d-flex align-items-center">
                <div class="img_wrapper">
                    <a href="{{route($prefix.'.profile')}}">
                        <img src="{{ asset('images/'.$user->image) }}" alt="Profile Picture">
                    </a>
                </div>
                <div class="drop">
                    <a href="javascript:void(0)" class="profile_link disable">{{$user->name}} <i class="fas fa-caret-down"></i></a>
                    <div class="drop_content">
                        <a href="{{route($prefix.'.profile')}}">Profile</a>
                        <a href="{{route($prefix.'.logout')}}">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
