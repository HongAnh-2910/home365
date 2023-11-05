@extends('app')
@section('content')
    <div class="wp__bg-login position-relative">
       <div class="bg__login" style="background: url({{ asset('images/bg_login.png') }}) no-repeat center">
           <div class="back_top__login back_top__register position-absolute">
                <a href="{{route('home_page')}}"><img src="{{ asset('/images/backtop.png') }}"></a>
            </div>
           <div class="wp__login bg__login d-flex align-items-center justify-content-center">
               <div class="img__start position-absolute">
                   <img src="{{ asset('/images/start_login.png') }}">
               </div>
               <div class="wp_form--login position-absolute">
{{--                   <div class="title__login">--}}
{{--                       Đăng nhập--}}
{{--                   </div>--}}
                   <div class="form_login">
                       <form action="{{route('auth.loginExecute')}}" method="post">
                           @csrf
                           <div class="title_form">Vui lòng nhập tài khoản của bạn ở đây</div>
                           <div class="form-group form-group-login first">
                               <label class="label__title" for="inputEmail">Số điện thoại</label>
                               <input type="text" name="phone_number" value="@if(old('phone_number')){{old('phone_number')}}@elseif($oldSDT){{$oldSDT}}@endif" class="form-control form__input--login" id="inputEmail" aria-describedby="emailHelp" placeholder="Số điện thoại">
                               @error('phone_number')
                                        <div class="text text-danger text-error-message">{{ $message }}</div>
                               @enderror
                           </div>
                           <div class="form-group form-group-login">
                               <label class="label__title" for="inputPassword">Mật khẩu</label>
                               <input type="password" name="password" class="form-control form__input--login mb-0" id="inputPassword" placeholder="Mật khẩu">
                               @error('password')
                                        <div class="text text-danger text-error text-error-message">{{ $message }}</div>
                               @enderror
                           </div>
                           <div class="forget__pass">
                               <a href="#" class="forget_pass--title">Quên mật khẩu</a>
                           </div>
                           <div class="button__login-app text-center">
                               <button type="submit" class="button__login btn-login-remove-session">Đăng nhập</button>
                           </div>
                           <div class="no__account">
                               Chưa có tài khoản? <span ><a href="{{route('auth.register')}}" class="no__account--register">Đăng ký</a></span>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
    </div>
    @if($errorMessage)
        @include('auth.modal_login', ['errorMessage' => $errorMessage])
    @endif
@endsection
