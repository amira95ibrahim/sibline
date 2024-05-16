<header> 
    <nav class="navbar fixed-top navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.html" style="width: 20%;">
                <img src="{{asset('images/'.$system_info->logo_header)}}" alt="{{$system_info->name}} Logo" id="logo">
            </a>
            <div class="d-flex flex-row order-2 order-lg-3 user_info">
                <div class="group_btn d-none d-sm-block">
                    <a href="login.html" class="group_link log_in registration hover">LOG IN</a>
                    <a href="signup.html" class="group_link registration">SIGN UP</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navDefault" aria-controls="navDefault" aria-expanded="false" aria-label="Toggle navigation" id="toggleIcon">
                    <span class="bar_one"></span>
                    <span class="bar_two"></span>
                    <span class="bar_three"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end order-3 order-lg-2" id="navDefault">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            HOME
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="index.html">HOME</a></li>
                            <li><a class="dropdown-item" href="index-two.html">HOME TWO</a></li>
                            <li><a class="dropdown-item" href="user-portfolio.html">Admin Panel</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="play.html">HOW TO PLAY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.html">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pd_right" href="contact.html">CONTACT US</a>
                    </li>
                    <li class="nav-item d-block d-sm-none"> 
                        <a class="nav-link registration hover" href="login.html">LOG IN</a>
                    </li>
                    <li class="nav-item d-block d-sm-none">
                        <a class="nav-link registration" href="signup.html">SIGN UP</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>