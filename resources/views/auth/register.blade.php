@extends('app')
@section('content')
{{--    @if($errors->any())--}}
{{--       @dd($errors->all());--}}
{{--    @endif--}}
    <div class="wp__bg-login position-relative">
        <div class="bg__login" style="background: url({{ asset('images/bg_login.png') }}) no-repeat center">
            <div class="back_top__login back_top__register position-absolute">
                <a href="{{route('home_page')}}"><img src="{{ asset('/images/backtop.png') }}"></a>
            </div>
            <div class="wp__login bg__login d-flex align-items-center justify-content-center">
                <div class="img__start img__start-register position-absolute">
                    <img src="{{ asset('/images/start_login.png') }}">
                </div>
                <div class="wp_form--login wp_form--register position-absolute">
                    <div class="form_login">
                            <div class="title_form title_form-register">Hoàn thành đăng ký để có hành trình
                                7 ngày học thử toàn bộ chương trình
                            </div>
{{--                            <div class="form-group" style="margin-bottom: 22px">--}}
{{--                                <label class="label__title" for="exampleInputEmail1">Họ và tên học sinh *</label>--}}
{{--                                <input type="email" class="form-control form__input--login" id="exampleInputEmail1"--}}
{{--                                       aria-describedby="emailHelp" placeholder="Họ và tên">--}}
{{--                            </div>--}}
                        <form method="POST" action="{{ route('auth.register.submit') }}">
                            @csrf
                            <div class="form-group">
                                <label class="label__title" for="exampleInputPassword1">Số điện thoại/tài khoản đăng
                                    nhập*
                                </label>
                                <input type="text" name="phone_number" value="{{old('phone_number')}}" class="form-control form__input--login" id="inputEmail" aria-describedby="emailHelp" placeholder="Số điện thoại">
                                @error('phone_number')
                                <div class="text text-danger text-error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group" style="margin-bottom: 22px">
                                <label class="label__title" for="exampleInputEmail1">Mật khẩu *
                                </label>
                                <input type="password" name="password" class="form-control form__input--login mb-0" id="inputPassword" placeholder="Mật khẩu">
                                @error('password')
                                <div class="text text-danger text-error text-error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="label__title" for="exampleInputEmail1">Nhập lại mật khẩu
                                </label>
                                <input type="password" name="password_confirmation" class="form-control form__input--login mb-0" id="inputPassword" placeholder="Mật khẩu">
                                @error('password_confirmation')
                                <div class="text text-danger text-error text-error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="button__login-app text-center">
                                <button type="submit" class="button__login">Đăng ký</button>
                            </div>
                        </form>
                            <div class="no__account">
                                Đã có tài khoản? <span><a href="{{route('auth.login')}}" class="no__account--register">Đăng nhập</a></span>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
