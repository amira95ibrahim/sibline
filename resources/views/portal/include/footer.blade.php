<footer>
    <div class="container">
        <div class="row footer_nav d-flex align-items-center">
            <div class="col-lg-7">
                <ul class="nav justify-content-center justify-content-sm-start">
                    <li class="nav-item">
                        <a class="nav-link ml-0" href="contact.html">CONTACT US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">TERMS OF USE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">PRIVACY POLICY</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-5">
                <ul class="nav justify-content-center justify-content-sm-start justify-content-lg-end">
                    <li class="nav-item">
                        <a class="nav-link ml-0" href="#">
                            <img src="{{ asset('portal-assets/images/footer/apple_store.png') }}" alt="Download from Apple Store">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-0" href="#">
                            <img src="{{ asset('portal-assets/images/footer/google_store.png') }}" alt="Download from Google Play Store">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row footer_copyright d-flex align-items-center">
            <div class="col-lg-7 text-center text-sm-start">
                <p class="para">{{$system_info->footer_text}}</p>
            </div>
            <div class="col-lg-5 text-center text-sm-start text-lg-end">
                <p class="para">All rights reserved</p>
            </div>
        </div>
    </div>
</footer>