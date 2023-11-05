@extends('app2')
@section('content')
    <div class="wp__form_exam--one">
        <div class="bg__form--exam" style="background: url({{ asset("images/bg__fuit.png") }}) center no-repeat">
            <div class="wp__content--form-exam">
                <div class="header__exam--one header__exam--pc">
                    <div class="point__exam--one">
                        9.5
                    </div>
                    <div class="title__exam--one">
                        Bài 1: CHỌN HÌNH(ĐÁP ÁN ĐÚNG)
                    </div>
                    <div class="time__exam--one">
                        <img src="{{ asset('images/watchclock.png') }}">
                        <div class="hours__time--down_one hours__time--down"></div>
                    </div>
                </div>

                <div class="header__exam--one header__exam--mobile d-none">
                    <div class="title__exam--one">
                        Bài 1: CHỌN HÌNH(ĐÁP ÁN ĐÚNG)
                    </div>
                    <div class="wp__close--exam">
                        <div class="time__exam--one">
                            <img src="{{ asset('images/watchclock.png') }}">
                            <div class="hours__time--down_one hours__time--down"></div>
                        </div>
                        <div class="point__exam--one">
                            9.5
                        </div>
                    </div>
                </div>
                <div class="question__exam--one text-center">
                    Câu {{ request()->status ? request()->status : 1 }} <span class="text-warning">(0.5 điểm)</span>
                </div>

                <div class="wp__content--item--exam">
                    @if($list_exercise_type_7["INFO"])
                        @foreach($list_exercise_type_7["INFO"] as $key => $value)
                            @if(request()->status)
                                @if((request()->status - 1) == $key)
                    <div class="wp__item--exam--one">
                        <div class="question__exam--help">
                            {!! $value["QUESTION"]  !!}
{{--                            <span class="d-block result__question--help">x=...?</span>--}}
                        </div>
                        <ul class="list_result--exam">
                            <li class="item__list--result--exam">
                                <div class="img__block--result">
                                    <img class="img__redirect--exam img__redirect--exam--1" src="{{ asset("images/fruit__1.png") }}">
                                </div>
                                <div class="title__result--exam">
                                    45677
                                </div>
                            </li>
                            <li class="item__list--result--exam">
                                <div class="img__block--result">
                                    <img class="img__redirect--exam img__redirect--exam--2" src="{{ asset("images/fruit__2.png") }}">
                                </div>
                                <div class="title__result--exam">
                                    45677
                                </div>
                            </li>
                            <li class="item__list--result--exam">
                                <div class="img__block--result">
                                    <img class="img__redirect--exam img__redirect--exam--3" src="{{ asset("images/fruit__3.png") }}">
                                </div>
                                <div class="title__result--exam">
                                    45677
                                </div>
                            </li>
                            <li class="item__list--result--exam">
                                <div class="img__block--result">
                                    <img class="img__redirect--exam img__redirect--exam--4" src="{{ asset("images/fruit__4.png") }}">
                                </div>
                                <div class="title__result--exam">
                                    45677
                                </div>
                            </li>
                        </ul>

                        <div class="title__check__math check__result--exam">
                         <span class="check__math--fill check__result--exam--icon">
                             <i class="fas fa-times-circle"></i>
                         </span>
                            <span class="title__math--fill-kq check__result--exam--title">
                             Đáp đúng là: <span class="text-dark">45677</span>
                         </span>
                        </div>
                    </div>
                        @endif
                            @endif
                                    @endforeach
                            @endif
                </div>
                <div class="wp__footer--exam">
                    <div class="mark__checkbox--choose d-flex justify-content-center align-items-center">
                        <a href="" class="a__checkbox--choose prev__checkbox">
                            <div class="perv__checkbox--choose">
                                <i class="fas fa-arrow-left"></i>
                            </div>
                        </a>
                        @if(request()->type && request()->status == count(\GuzzleHttp\json_decode($json_array)) && request()->type == $array_total_type_list)
                            @if($dataArr['RESULT_CHILD'])
                                @if(request()->route()->getName() == 'taken_detail')
                                    <button class="btn--scored button__mark--kq" data-toggle="modal" data-target="#modal-scored">Chấm điểm</button>
                                @else
                                    <a class="btn-submit--exercise" href="#">Nộp bài</a>
                                @endif
                            @else
                                <button class="button__mark--checkbox button__mark--kq btn-submit--remake">Chấm điểm</button>
                                <a class="d-none btn-submit--exercise" href="#">Nộp bài</a>
                            @endif
                        @else
                            @if($dataArr['RESULT_CHILD'])
                                <button class="btn--scored" data-toggle="modal" data-target="#modal-scored">Chấm điểm</button>
                            @else
                                <button class="button__mark--checkbox button__mark--kq">Chấm điểm</button>
                            @endif
                        @endif
                        @if(request()->type)
                            @if(!(request()->status == count(\GuzzleHttp\json_decode($json_array)) && request()->type == $array_total_type_list))
                                <a href="" class="a__checkbox--choose">
                                    <div class="next__checkbox--choose next__checkbox">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                </a>
                            @endif
                        @else
                            <a href="" class="a__checkbox--choose">
                                <div class="next__checkbox--choose next__checkbox">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('formatExercise.logic_next_prev')
    <script>
        $(document).ready(function (){
            $('.list_result--exam .item__list--result--exam').click(function (){
                $('.item__list--result--exam').removeClass('active__result--exam');
                // $('.img__redirect--exam').attr('src' , '/images/sau.png')
                $(this).addClass('active__result--exam');
                // const classParent =  $(this).find('.img__block--result').find('.img__redirect--exam')
                // classParent.attr('src' , '/images/sau_error.png');
            })
        })
    </script>

@endsection
