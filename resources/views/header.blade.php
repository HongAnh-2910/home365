<header>
    <div class="header-wrapper">
        <div class="logo-wrapper">
            <a class="logo-page" href="{{route('home_page')}}">
               <img class="logo-item d-md-inline-block d-none" src="{{asset('images/home365_logo.png')}}" />
                <img class="logo-item d-inline-block d-md-none" src="{{asset('images/home365_logo_mobi.png')}}" />
                <span class="logo-text d-lg-inline d-none">HOME365 VUI HỌC MỖI NGÀY</span>
            </a>
        </div>

        <ul class="header-navigation-wrapper">
            <li class="item"><a class="btn-navigation {{request()->route()->getName() == 'home_page' ? 'active' : ''}}" href="{{route('home_page')}}">Trang chủ</a></li>
            <li class="item"><a class="btn-navigation {{request()->route()->getName() == 'terms_page' ? 'active' : ''}}" id="show-up-modal" href="#">Điều khoản</a></li>
            <li class="item"><a class="btn-navigation {{request()->route()->getName() == 'security_page' ? 'active' : ''}}" href="{{route('security_page')}}">Chính sách</a></li>
            <li class="item"><a class="btn-navigation btn--warning" href="{{route('join_now')}}">Vào học ngay</a></li>
        </ul>
        <div class="icon-bars" id="header-icon-bars">
            <div class="join-now-course"><a class="btn-navigation btn--warning" href="{{route('join_now')}}">Vào học ngay</a></div>
            <div class="item-icon">
               <i class="fas fa-bars"></i>
            </div>
            <ul class="mobile-navigation-wrapper">
                <li class="mobile-item"><a class="btn-mobile-navigation {{request()->route()->getName() == 'home_page' ? 'active' : ''}}" href="{{route('home_page')}}">Trang chủ</a></li>
                <li class="mobile-item"><a class="btn-mobile-navigation {{request()->route()->getName() == 'terms_page' ? 'active' : ''}}" href="{{route('terms_page')}}">Điều khoản</a></li>
                <li class="mobile-item"><a class="btn-mobile-navigation {{request()->route()->getName() == 'security_page' ? 'active' : ''}}" href="{{route('security_page')}}">Chính sách</a></li>
            </ul>
        </div>
    </div>
</header>
