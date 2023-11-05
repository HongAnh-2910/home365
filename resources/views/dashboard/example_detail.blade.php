@extends('parent')
@section('content')
    <div class="section-dashboard section-example-details position-relative">
        @if(session('_error_message'))
            @include('modal.modal_error', ['header_error' => 'CÓ LỖI XẢY RA', 'error_message' => session('_error_message')])
        @endif
        <img class="dashboard-bg" src="{{asset('images/example_detail.png')}}" />
        <div class="example-details-header">
            <a class="back-to-dashboard" href="{{route('dashboard')}}">
                <img src="{{asset('images/backtop.png')}}" />
            </a>
            <div class="detail-header-text">{{$exampleName ?? 'Luyện Thi'}}</div>
            <a class="d-sm-block d-none" style="opacity: 0">
                <img src="{{asset('images/backtop.png')}}" />
            </a>
        </div>
        <div class="section-details">
            @foreach($details as $item)
                <a href="#" class="detail-card btn-start-exercise position-relative" data-exercise-details="{{json_encode($item)}}">
                    <input type="hidden" class="input-duration--start" value="{{$item['DURATION']}}" />
                    @if($item['POINT'])
                        <img src="{{asset('images/detail1.png')}}" class="detail-image" />
                    @else
                        <img src="{{asset('images/detail2.png')}}" class="detail-image" />
                    @endif

                    <div class="detail-name">{{$item['EXCERCISE_NAME']}}</div>
                    <input type="hidden" class="detail-exe-requirement" value="{{$item['REQUIREMENT']}}" />
                    <input type="hidden" class="session-user-class" value="Lớp {{session('USER_INFO')['LEVEL_ID']}}" />
                    <input type="hidden" class="detail-exe-duration" value="{{$item['DURATION']/60}}" />
                    @if(! $item['POINT'])
                        <div class="btn-miss">
                            <span class="btn--success d-inline-block">Chưa làm</span>
                        </div>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
    @include('modal.prepare_exercise')
    @include('modal.modal_continue_task')
@endsection
