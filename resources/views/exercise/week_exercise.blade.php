@extends('app')
@section('content')
    <div class="wp__exercise">
        <div class="wp_bg--exercise wp_bg--exercise--cover" style="background: url({{ asset('images/bg-bt.png') }}) no-repeat center">
            <div class="wp_content--exercise">
                <div class="button__header--exercise d-flex justify-content-between align-items-center flex-wrap">
                    <div class="back_top__login back_top__register">
                        <a href="{{route('dashboard')}}"><img src="{{ asset('/images/backtop.png') }}"></a>
                    </div>
                    <div class="wp_button__exercise">
                        <button class="button_redirect--exercise">
                            <a href="{{ route('list.exercise') }}" class="active__save d-inline-block"  style="text-decoration: none ; color: #8492A6 ;padding: 18px 8px;">Bài tập tuần trước</a>
                        </button>
                        <button class="button_redirect--exercise  active__button_redirect--exercise">
                            <a href="{{ route('week.exercise') }}" class="active__save d-inline-block" style="text-decoration: none ; color: white ;padding: 18px 8px;">Bài tập tuần này</a>
                        </button>
                        <button class="button_redirect--exercise">
                            <a href="{{ route('exercise-done') }}" class="active__save d-inline-block" style="text-decoration: none ; color: #8492A6 ;padding: 18px 8px;">Bài tập đã làm</a>
                        </button>
                    </div>
                    <div class="wp_button__exercise--right"></div>
                </div>
                <div class="content--exercise-collapse">
                    <div id="accordion">
                        @if($listArray)
                            @foreach($listArray as $key => $exercise_needed)
                        <div class="card card__exercise">
                            <div class="card-header card__exercise-header" id="headingOne" aria-expanded="true" aria-controls="collapseOne">
                                <div class="title__card__exercise-header d-flex align-items-center justify-content-between">
                                    <div class="text__card__exercise">
                                        Tuần {{ $key }}
                                    </div>
                                    <div class="origin__card__exercise transform_rotate">
                                    </div>
                                </div>
                            </div>

                            <div class="collapse show collapseOne" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body card-body-exercise card-body-exercise2">
                                    <ul class="list__body--exercise d-flex justify-content-center flex-wrap">
                                        @foreach($exercise_needed as $item_exercise)
                                            <li class="item_body--exercise">
                                                <div class="img__body--exercise item_body--exercise2">
                                                    <a href="{{ route('detail-week.exercise' , $item_exercise["ID"]) }}">
                                                    @if($item_exercise["SUBJECT_ID"] == 1)
                                                            <img src="{{ asset("images/bg_to_1.png") }}">
                                                    @endif
                                                    @if($item_exercise["SUBJECT_ID"] == 2)
                                                            <img src="{{ asset("images/bg_to_2.png") }}">
                                                    @endif
                                                    @if($item_exercise["SUBJECT_ID"] == 3)
                                                            <img src="{{ asset("images/bg_to_3.png") }}">
                                                    @endif
                                                    </a>
                                                </div>
                                                <a href="{{ route('detail-week.exercise' , $item_exercise["ID"]) }}" class="text-decoration-none">
                                                    <div class="title__body--exercise" style="color:#252B42">
                                                        {{ $item_exercise["SUBJECT_NAME"] }}
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                            @endforeach
                        @else
                            <h3 class="text-center" style="font-weight: bold">Bạn không có bài tập chưa làm tuần này.</h3>
                        @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function (){
            $('.card__exercise-header').click(function (){
                $(this).find('.origin__card__exercise').toggleClass('transform_rotate')
                let content = $(this).parent().find('.collapseOne');
                $('.collapseOne').not(content).slideUp();
                content.slideToggle();
            });
        })
    </script>

@endsection
