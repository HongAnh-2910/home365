@extends('app')
@section('content')
    <div class="wp__exercise">
        <div class="wp_bg--exercise"
             style="background: url({{ asset('images/bg-bt.png') }})center;">
            <div class="wp_content--exercise">
                <div class="button__header--exercise d-flex justify-content-between align-items-center flex-wrap">
                    <div class="back_top__login back_top__register">
                        <a href="{{route('dashboard')}}"><img src="{{ asset('/images/backtop.png') }}"></a>
                    </div>
                    <div class="wp_button__exercise">
                        <button class="button_redirect--exercise active__button_redirect--exercise">
                            <a href="{{ route('list.exercise') }}" class="active__save d-inline-block"
                               style="text-decoration: none ; color: white ;padding: 18px 8px;">Bài tập tuần trước</a>
                        </button>
                        <button class="button_redirect--exercise">
                            <a href="{{ route('week.exercise') }}" class="active__save d-inline-block"
                               style="text-decoration: none ; color: #8492A6 ;padding: 18px 8px;">Bài tập tuần này</a>
                        </button>
                        <button class="button_redirect--exercise">
                            <a href="{{ route('exercise-done') }}" class="active__save d-inline-block"
                               style="text-decoration: none ; color: #8492A6 ;padding: 18px 8px;">Bài tập đã làm</a>
                        </button>
                    </div>
                    <div class="wp_button__exercise--right"></div>
                </div>
                <div class="content--exercise-collapse">
                    <div id="accordion" style="padding-bottom: 20px">
                        @if($listArray)
                            @foreach($listArray as $key => $exercise)
                                <div class="card card__exercise">
                                    <div class="card-header card__exercise-header" id="headingOne" aria-expanded="true"
                                         aria-controls="collapseOne">
                                        <div
                                            class="title__card__exercise-header d-flex align-items-center justify-content-between">
                                            <div class="text__card__exercise">
                                                Tuần {{ $key }}
                                            </div>
                                            <div class="origin__card__exercise transform_rotate">
                                                <i class="fas fa-chevron-up"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="collapse show collapseOne"
                                         {{ $key != 15 ? "style=display:none" : '' }} aria-labelledby="headingOne"
                                         data-parent="#accordion">
                                        <div class="card-body card-body-exercise">
                                            <ul class="list__body--exercise d-flex flex-wrap">
                                                @foreach($exercise as $item_exercise)
                                                    <li class="item_body--exercise">
                                                        <a href="{{ route('detail-week.exercise' , $item_exercise["ID"]) }}">
                                                            <div class="img__body--exercise">
                                                                @if($item_exercise["SUBJECT_ID"] == 1)
                                                                    <img src="{{ asset("images/1.ex.png") }}">
                                                                @endif
                                                                @if($item_exercise["SUBJECT_ID"] == 2)
                                                                    <img src="{{ asset("images/2.ex.png") }}">
                                                                @endif
                                                                @if($item_exercise["SUBJECT_ID"] == 3)
                                                                    <img src="{{ asset("images/3.ex.png") }}">
                                                                @endif
                                                            </div>
                                                        </a>
                                                        <div class="title__body--exercise">
                                                            {{ $item_exercise["SUBJECT_NAME"] }}
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.card__exercise-header').click(function () {
                $(this).find('.origin__card__exercise').toggleClass('transform_rotate')
                let content = $(this).parent().find('.collapseOne');
                $('.collapseOne').not(content).slideUp();
                content.slideToggle();
            });
        })
    </script>

@endsection
