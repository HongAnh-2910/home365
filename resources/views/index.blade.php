@extends('parent')
@section('content')
<div class="section-hero d-none d-sm-block" style="background-image: url({{asset('images/home_hero.png')}})">
    <div class="hero-wrapper content-container-wrapper">
        <div class="hero-section-content">
            <div class="hero-section-text">
                <div class="text-white hero-title">Ứng dụng làm bài tập cho học sinh tiểu học</div>
                <div class="text-white hero-description">Các bài giảng, bài tập của Home365 được biên soạn theo chuẩn chương trình sách giao khoa của Bộ Giáo dục và Đào tạo.</div>
                <div class="text-white hero-link">
                    <a class="d-none d-md-inline-block text-decoration-none link-app-store" target="_blank" href="https://itunes.apple.com/vn/app/home365/id1457639505">
                        <img src="{{asset('images/image_astore.png')}}" alt="Appstore Icon" />
                    </a>
                    <a class="d-none text-decoration-none d-md-inline-block link-gg-play" target="_blank" href="https://play.google.com/store/apps/details?id=neo.vn.test365children">
                        <img src="{{asset('images/image_ggplay.png')}}" alt="Google Play Icon" />
                    </a>
                    <a class="d-inline-block d-md-none text-decoration-none link-app-store" target="_blank" href="https://itunes.apple.com/vn/app/home365/id1457639505">
                        <img src="{{asset('images/app_store_mobi.png')}}" alt="Appstore Icon Mobile" />
                    </a>
                    <a class="text-decoration-none d-md-none d-inline-block link-gg-play" target="_blank" href="https://play.google.com/store/apps/details?id=neo.vn.test365children">
                        <img src="{{asset('images/gg_play_mobi.png')}}" alt="Google Play Icon Mobile" />
                    </a>
                </div>
            </div>
            <div class="hero-section-image position-relative">
                <img class="hero-ellipse_img d-none d-md-block" src="{{asset('images/ellipse_hero.png')}}" alt="Hero Ellipse" />
                <img class="hero-ellipse-mobile d-md-none d-block" src="{{asset('images/ellipse_hero_mobi.png')}}" alt="Hero Ellipse Mobile" />
                <img class="hero-avatar w-100 d-none d-md-block" src="{{asset('images/img_kid.png')}}" alt="Hero Kid" />
                <img class="hero-avatar d-md-none d-block" src="{{asset('images/img_kid_mobi.png')}}" alt="Hero Kid Mobile" />
            </div>
        </div>
    </div>
</div>
<div class="section-hero d-block d-sm-none" style="background-image: url({{asset('images/hero_img_mobi.png')}})">
    <div class="hero-wrapper content-container-wrapper">
        <div class="hero-section-content">
            <div class="hero-section-text">
                <div class="text-white hero-title">Ứng dụng làm bài tập cho học sinh tiểu học</div>
                <div class="text-white hero-description">Các bài giảng, bài tập của Home365 được biên soạn theo chuẩn chương trình sách giao khoa của Bộ Giáo dục và Đào tạo.</div>
                <div class="text-white hero-link">
                    <a class="d-inline-block d-md-none text-decoration-none link-app-store" target="_blank" href="https://itunes.apple.com/vn/app/home365/id1457639505">
                        <img src="{{asset('images/app_store_mobi.png')}}" alt="Appstore Mobile" />
                    </a>
                    <a class="text-decoration-none d-md-none d-inline-block link-gg-play" target="_blank" href="https://play.google.com/store/apps/details?id=neo.vn.test365children">
                        <img src="{{asset('images/gg_play_mobi.png')}}" alt="Google Play Mobile" />
                    </a>
                </div>
            </div>
            <div class="hero-section-image position-relative">
                <img class="hero-ellipse-mobile d-md-none d-block" src="{{asset('images/ellipse_hero_mobi.png')}}" alt="Hero Ellipse" />
                <img class="hero-avatar d-md-none d-block" src="{{asset('images/img_kid_mobi.png')}}" alt="Hero Kid" />
            </div>
        </div>
    </div>
</div>
@yield('sub_content')
<script>
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/59537fb3e9c6d324a4737b7a/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
@endsection
