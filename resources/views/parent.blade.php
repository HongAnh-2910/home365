<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
{{--        <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Bài tập về nhà, luyện thi">
        <meta property="og:title" content="Bài tập về nhà, luyện thi">
        <meta property="og:description" content="Ứng dụng học trực tuyến trên nền tảng công nghệ hiện đại với nhiều tính năng vượt trội">
        <meta property="og:site_name" content="Bài tập về nhà, luyện thi">
        <meta property="og:image" content="{{asset('images/logo_title.png')}}">
        <meta property="og:locale" content="vi_VN">
        <meta property="og:url" content="https://home365.vn/">
        <link rel="shortcut icon" type="image/png" href="{{asset('images/logo_title.png')}}">
        <title>Home365 - Bài tập về nhà, luyện thi</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
        <link rel="stylesheet" href="{{ asset('parent_css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
        <script src="{{ asset('js/app.js')}}"></script>
{{--        <link rel="preconnect" href="https://fonts.googleapis.com">--}}
{{--        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}
{{--        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">--}}
    </head>
    <body>
    @php
        $routeName = request()->route()->getName();
        $routeAllows = ['home_page', 'terms_page', 'security_page'];
    @endphp
    @if(in_array($routeName, $routeAllows))
        @include('header')
    @endif
    @yield('content')
    @if(in_array($routeName, $routeAllows))
        @include('footer')
    @endif
    </body>
</html>
