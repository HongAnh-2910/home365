@extends('parent')
@section('content')
    <div class="section-exercise-taken position-relative">
        <img src="{{asset('images/exercise_taken_bg.png')}}" alt="" class="taken-bg">
        <div class="header-wrapper">
            <a class="back-to-dashboard" href="{{route('exercise-done')}}">
                <img src="{{asset('images/backtop.png')}}" />
            </a>
            <div class="header-text">
                <div class="item-text">{{$takenDetail['WEEK_NAME']}} ({{$takenDetail['SUBJECT_NAME']}})</div>
            </div>
        </div>
        <div class="detail-content">
            <div class="exercise-class">
                <div class="class-item">
                    {{$takenDetail['LEVEL_NAME']}}
                </div>
            </div>
            <div class="exercise-detail-title">{!! $takenDetail['REQUIREMENT'] !!}</div>
            <div class="exercise-detail-content">
                <div class="exercise-detail-time">
                    <div class="time-title">Thời gian làm:</div>
                    <div class="exercise-start-time">
                        <img src="{{asset('images/exercise_oclock.png')}}" />
                        <div class="time-text-start">Bắt đầu: <span class="time-item">{{$takenDetail['START_TAKE_TIME'] ?? 'Không có'}}</span></div>
                    </div>
                    <div class="exercise-start-time">
                        <img src="{{asset('images/exercise_oclock.png')}}" />
                        <div class="time-text-start">Kết thúc: <span class="time-item">{{$takenDetail['END_TAKE_TIME'] ?? 'Không có'}}</span></div>
                    </div>
                </div>
                <div class="exercise-detail-time pt-md-3 pt-0">
                    <div class="exercise-start-time second">
                        <img src="{{asset('images/exercise_people.png')}}" />
                        <div class="time-text-start">Số bạn cùng làm: <span class="time-item">{{$takenDetail['STATISTIC']['CUNGLAM'] ?? 0}}</span></div>
                    </div>
                    <div class="exercise-start-time second">
                        <img src="{{asset('images/exercise_people.png')}}" />
                        <div class="time-text-start">Số bạn cùng trường làm: <span class="time-item">{{$takenDetail['STATISTIC']['CUNGTRUONG'] ?? 0}}</span></div>
                    </div>
                    <div class="exercise-start-time second">
                        <img src="{{asset('images/exercise_people.png')}}" />
                        <div class="time-text-start">Số bạn cùng lớp làm: <span class="time-item">{{$takenDetail['STATISTIC']['CUNGLOP'] ?? 0}}</span></div>
                    </div>
                </div>
            </div>
            <div class="exercise-taken-summary">
                <div class="exercise-card">
                    <div class="card-item highest-core">
                        <div class="score-item">{{$takenDetail['STATISTIC']['CAONHAT'] ?? 0}}</div>
                    </div>

                    <div class="card-score-text">Điểm cao nhất</div>
                </div>
                <div class="exercise-card">
                    <div class="card-item average-score">
                        <div class="score-item">{{$takenDetail['STATISTIC']['TRUNGBINH'] ?? 0}}</div>
                    </div>

                    <div class="card-score-text">Điểm trung bình</div>
                </div>
                <div class="exercise-card">
                    <div class="card-item lowest-score">
                        <div class="score-item">{{$takenDetail['STATISTIC']['THAPNHAT'] ?? 0}}</div>
                    </div>

                    <div class="card-score-text">Điểm thấp nhất</div>
                </div>
                <div class="exercise-card">
                    <div class="card-item your-score">
                        <div class="score-item">{{$takenDetail['POINT'] ?? 0}}</div>
                    </div>

                    <div class="card-score-text">Điểm của bạn</div>
                </div>
            </div>
            @if(! isset($takenDetail['LINK']) && (isset($takenDetail['FILE_PDF'])))
                <div class="exercise-taken-link">
                    @if(isset($takenDetail['LINK']) && $takenDetail['LINK'])
                        <a class="btn--exercise-link first btn-modal-lesson" href="#">Xem bài giảng</a>
                    @endif
                    @if(isset($takenDetail['FILE_PDF']) && $takenDetail['FILE_PDF'])
                        <a class="btn--exercise-link" href="{{$takenDetail['FILE_PDF']}}" target="_blank">In bài tập</a>
                    @endif
                </div>
            @endif
            <div class="exercise-taken-button">
                <a class="button-exercise--detail" href="{{route('taken_detail', ['id' => request()->id])}}">Xem chi tiết</a>
            </div>
        </div>
        @if(isset($takenDetail['LINK']) && $takenDetail['LINK'])
            @include('modal.modal_lesson', ['linkVideo' => $takenDetail['LINK']])
        @endif
    </div>
@endsection
