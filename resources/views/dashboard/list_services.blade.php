@extends('parent')
@section('content')
    <div class="section-dashboard position-relative">
        <img class="dashboard-bg" src="{{asset('images/services_bg.png')}}" />
        <div class="section-packages">
            <div class="section-package-title">Mời bạn mua gói để sử dụng nhiều ưu đãi</div>
            <div class="package-boxes">
                @foreach($listPackages as $item)
                    <div class="package-card">
                        <div class="card-service-image">
                            <img src="{{asset('images/service_img.png')}}" />
                        </div>
                        <div class="card-service-name">{{$item['SERVICE_NAME']}}</div>
                        <div class="card-service-description">
                            {!! str_replace("\n", "<p class='mb-1'></p>", $item['DESCRIPTION']) !!}
                        </div>
                        <div class="card-service-footer">
                            <div class="card-price">{{number_format($item['PRICE'])}} VNĐ</div>
                            <a href="#" class="btn-buy-now">Mua gói</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="buttons-back">
                <a href="{{route('dashboard')}}" class="btn--back-dashboard">Quay lại</a>
            </div>
        </div>
    </div>
@endsection
