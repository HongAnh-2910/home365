<div class="exercise-type-header">
    <div class="header-score">{{number_format(session('CURRENT_POINT'), 1)}}</div>
    <div class="exercise-title d-sm-block d-none">Bài {{$data['QUESTION_NUMBER']}} : {{$data['HUONGDAN']}}</div>
    <div class="exercise-time">
        <img class="time-icon" src="{{asset('images/alarm_clock_cd.png')}}" />
        <div class="count-down-time hours__time--down"></div>
    </div>
</div>
<div class="custom-exercise-title d-block d-sm-none mb-3 pt-1">Bài 1: Giải cứu công chúa - chọn đáp án đúng</div>
<div class="question-score-wrapper">
    <div class="question-score">Câu {{ request()->status ? request()->status : 1 }} <span>({{number_format($data['INFO'][$status_url-1]['POINT'], 1) ?? ''}} điểm)</span></div>
</div>
