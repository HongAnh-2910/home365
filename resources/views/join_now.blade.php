@extends('parent')
@section('content')
    <div class="section-join-now position-relative">
        <img class="join-now-image d-none d-sm-block" alt="Join Now Image" src="{{asset('images/join_nows.png')}}" />
        <img class="join-now-image d-block d-sm-none" alt="Join Now Image" src="{{asset('images/join_nows_mobi.png')}}" />
        <div class="form-join-now">
            <div class="join-now-content">
                <img class="join-now-logo" src="{{asset('images/join_logo.png')}}" />
                <img class="join-image-title d-none d-md-block" alt="Join Now Title" src="{{asset('images/register-now.png')}}" />
                <img class="join-image-title d-none d-sm-block d-md-none" alt="Join Now Title" src="{{asset('images/register-now-tl.png')}}" />
                <img class="join-image-title d-block d-sm-none"  alt="Join Now Title" src="{{asset('images/register-now-mobi.png')}}" />
                <div class="join-content-subtitle">Thích thú - Say mê - Tự giác học mỗi ngày<br/>Báo cáo quá trình học tập</div>
                <div class="join-content-buttons">
                    <a href="{{route('auth.login')}}" class="button-login">Đăng nhập</a>
                    <a href="{{route('auth.register')}}" class="button-register">Đăng ký</a>
                </div>
            </div>
        </div>
    </div>
@endsection
