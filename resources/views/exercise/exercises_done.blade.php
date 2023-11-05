@extends('app')
@section('content')
    <div class="wp__exercise">
        <div class="wp_bg--exercise" style="background: url({{ asset('images/bg-bt.png') }}) no-repeat center">
            @if(session('_error_message'))
                @include('modal.modal_error', ['header_error' => 'CÓ LỖI XẢY RA', 'error_message' => session('_error_message')])
            @endif
            <div class="wp_content--exercise">
                <div class="button__header--exercise d-flex justify-content-between align-items-center flex-wrap">
                    <div class="back_top__login back_top__register">
                        <a href="{{route('week.exercise')}}"><img src="{{ asset('/images/backtop.png') }}"></a>
                    </div>
                    <div class="wp_button__exercise">
                        <button class="button_redirect--exercise">
                            <a href="{{ route('list.exercise') }}" class="active__save d-inline-block"  style="text-decoration: none ; color: #8492A6 ;padding: 18px 8px;">Bài tập tuần trước</a>
                        </button>
                        <button class="button_redirect--exercise ">
                            <a href="{{ route('week.exercise') }}" class="active__save d-inline-block" style="text-decoration: none ; color: #8492A6 ;padding: 18px 8px;">Bài tập tuần này</a>
                        </button>
                        <button class="button_redirect--exercise active__button_redirect--exercise">
                            <a href="{{ route('exercise-done') }}" class="active__save d-inline-block" style="text-decoration: none ; color: white ;padding: 18px 8px;">Bài tập đã làm</a>
                        </button>
                    </div>
                    <div class="wp_button__exercise--right"></div>
                </div>
                <div class="content--exercise-collapse">
                    <div id="accordion">
                        @if($listArray)
                            @foreach($listArray as $key => $exercise)
                        <div class="card card__exercise">
                            <div class="card-header card__exercise-header card__exercise-done" id="headingOne"
                                 aria-expanded="true" aria-controls="collapseOne">
                                <div
                                    class="title__card__exercise-header d-flex align-items-center justify-content-between">
                                    <div class="text__card__exercise text-uppercase">
                                        {{ $key }}
                                    </div>
                                    <div class="origin__card__exercise transform_rotate">
                                        <i class="fas fa-chevron-up"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="collapse show collapseOne" style="{{ $key != "Môn Toán" ? 'display:none' :'' }}" aria-labelledby="headingOne"
                                 data-parent="#accordion">
                                <div class="card-body card-body-exercise">
                                    <ul class="list__body--exercise--none d-flex justify-content-center">
                                        @foreach($exercise as $key => $item)
                                        <li class="highest-core-done">
                                            <a class="text-dark" href="{{ route('exercise_taken_detail' , $item["EXERCISE_ID"] ?? 1) }}" style="text-decoration: none">
                                                <div class="item_highest-core-done bg__done--rotate_{{ rand(1, 5) }}">
                                                    <div class="score-item-done">
                                                        {{ $item["POINT"] ?? '' }}
                                                    </div>
                                                </div>
                                                <div class="title__score-item-done text-center">
                                                    {{ $item["WEEK_NAME"] ?? '' }}
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
                            <h3 class="text-center" style="font-weight: bold">Bạn không có bài tập đã làm.</h3>
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
