@extends('app2')
@section('content')

    <audio id="audio2" src="{{ asset('audio/false.mp3') }}"></audio>
    <audio id="audio" src="{{ asset('audio/true.mp3') }}"></audio>

    <div class="wp__form_exam--one">
        <div class="bg__form--exam" style="background: url({{ asset("images/bg_exam.png") }}) center no-repeat">
            <div class="wp__content--form-exam">
                <div class="header__exam--one header__exam--pc">
                    <div class="point__exam--one">
                        {{number_format(session('CURRENT_POINT'), 1)}}
                    </div>
                    <div class="title__exam--one text-uppercase">
                        {{ $list_exercise_type_7["HUONGDAN"] ?? '' }}
                    </div>
                    <div class="time__exam--one">
                        <img src="{{ asset('images/watchclock.png') }}">
                        <div class="hours__time--down_one hours__time--down"></div>
                    </div>
                </div>

                <div class="header__exam--one header__exam--mobile d-none">
                    <div class="title__exam--one text-uppercase">
                        {{ $list_exercise_type_7["HUONGDAN"] ?? '' }}
                    </div>
                    <div class="wp__close--exam">
                        <div class="time__exam--one">
                            <img src="{{ asset('images/watchclock.png') }}">
                            <div class="hours__time--down_one hours__time--down"></div>
                        </div>
                        <div class="point__exam--one">
                            {{number_format(session('CURRENT_POINT'), 1)}}
                        </div>
                    </div>
                </div>
                <div class="question__exam--one text-center">
                    Câu {{ request()->status ? request()->status : 1 }} <span class="text-warning">({{number_format($list_exercise_type_7["INFO"][$status_url - 1]['POINT'], 1)}} điểm)</span>
                </div>
                @php
                    $dataArr = $list_exercise_type_7['INFO'][$status_url-1];
                @endphp
                <div class="wp__content--item--exam">
                                    <div class="wp__item--exam--one" style="padding: 30px 0px">
                                        <div class="question__exam--help">
                                            {!! $dataArr["HTML_CONTENT"]  !!}
                                            {{--                            <span class="d-block result__question--help">x=...?</span>--}}
                                        </div>
                                        <ul class="list_result--exam">
                                            <li>
                                                <div class="box__load item__list--result--exam {{ $dataArr["RESULT_CHILD"] && $dataArr['ANSWER_CHILD'] == 'A' ? 'active__result--exam' : '' }}" data-value="A">
                                                    <div class="img__block--result">
                                                        <img class="img__redirect--exam img__redirect--exam--1"
                                                             @if($dataArr["RESULT_CHILD"] && $dataArr['ANSWER_CHILD'] == 'A')
                                                             src="{{ $dataArr['ANSWER_CHILD'] == $dataArr['ANSWER'] ? asset("images/sau.png") : asset("images/sau_error.png")  }}">
                                                        @else
                                                            src="{{ asset("images/sau.png")  }}">
                                                             @endif
                                                    </div>
                                                    <div class="title__result--exam">
                                                        {!! $dataArr["HTML_A"] ?? '' !!}
                                                    </div>
                                                </div>
                                                @if($dataArr['ANSWER'] == 'A')
                                                    <div class="check__choose--checkbox text-center checkbox-fa--icon {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}}">
                                                        <i class="fas fa-check text-success"></i>
                                                    </div>
                                                @else
                                                    <div class="check__choose--checkbox--close text-center checkbox-fa--icon {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'A') ? '' : 'd-none'}}">
                                                        <i class="fas fa-times-circle text-danger"></i>
                                                    </div>
                                                @endif
                                            </li>
                                            <li>
                                                <div class="box__load item__list--result--exam {{ $dataArr["RESULT_CHILD"] && $dataArr['ANSWER_CHILD'] == 'B' ?  'active__result--exam' :''}}" data-value="B">
                                                    <div class="img__block--result">
                                                        <img class="img__redirect--exam img__redirect--exam--1"
                                                             @if($dataArr["RESULT_CHILD"] && $dataArr['ANSWER_CHILD'] == 'B')
                                                                src="{{ $dataArr['ANSWER_CHILD'] == $dataArr['ANSWER'] ? asset("images/sau.png") : asset("images/sau_error.png")  }}">
                                                             @else
                                                                 src="{{ asset("images/sau.png")  }}">
                                                            @endif

                                                    </div>
                                                    <div class="title__result--exam">
                                                        {!! $dataArr["HTML_B"] ?? '' !!}
                                                    </div>
                                                </div>
                                                @if($dataArr['ANSWER'] == 'B')
                                                    <div class="check__choose--checkbox text-center checkbox-fa--icon {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}}">
                                                        <i class="fas fa-check text-success"></i>
                                                    </div>
                                                @else
                                                    <div class="check__choose--checkbox--close text-center checkbox-fa--icon {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'B') ? '' : 'd-none'}}">
                                                        <i class="fas fa-times-circle text-danger"></i>
                                                    </div>
                                                @endif
                                            </li>
                                            @if($dataArr["HTML_C"])
                                            <li>
                                                <div class="box__load item__list--result--exam {{ $dataArr["RESULT_CHILD"] && $dataArr['ANSWER_CHILD'] == 'C' ? 'active__result--exam' : '' }}" data-value="C">
                                                    <div class="img__block--result">
                                                        <img class="img__redirect--exam img__redirect--exam--1"
                                                             @if($dataArr["RESULT_CHILD"] && $dataArr['ANSWER_CHILD'] == 'C')
                                                             src="{{ $dataArr['ANSWER_CHILD'] == $dataArr['ANSWER'] ? asset("images/sau.png") : asset("images/sau_error.png")  }}">
                                                                @else
                                                             src="{{ asset("images/sau.png")  }}">
                                                             @endif

                                                    </div>
                                                    <div class="title__result--exam">
                                                        {!! $dataArr["HTML_C"] !!}
                                                    </div>
                                                </div>

                                                @if($dataArr['ANSWER'] == 'C')
                                                    <div class="check__choose--checkbox text-center checkbox-fa--icon {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}}">
                                                        <i class="fas fa-check text-success"></i>
                                                    </div>
                                                @else
                                                    <div class="check__choose--checkbox--close text-center checkbox-fa--icon {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'C') ? '' : 'd-none'}}">
                                                        <i class="fas fa-times-circle text-danger"></i>
                                                    </div>
                                                @endif
                                            </li>
                                            @endif
                                            @if($dataArr["HTML_D"])
                                            <li>
                                                <div class="box__load item__list--result--exam {{ $dataArr["RESULT_CHILD"] && $dataArr['ANSWER_CHILD'] == 'D' ? 'active__result--exam' : '' }}" data-value="D">
                                                    <div class="img__block--result">
                                                        <img class="img__redirect--exam img__redirect--exam--1"
                                                             @if($dataArr["RESULT_CHILD"] && $dataArr['ANSWER_CHILD'] == 'D')
                                                             src="{{ $dataArr['ANSWER_CHILD'] == $dataArr['ANSWER'] ? asset("images/sau.png") : asset("images/sau_error.png")  }}">
                                                        @else
                                                            src="{{ asset("images/sau.png")  }}">
                                                        @endif
                                                    </div>
                                                    <div class="title__result--exam">
                                                        {!! $dataArr["HTML_D"] !!}
                                                    </div>
                                                </div>
                                                @if($dataArr['ANSWER'] == 'D')
                                                    <div class="check__choose--checkbox text-center checkbox-fa--icon {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}}">
                                                        <i class="fas fa-check text-success"></i>
                                                    </div>
                                                @else
                                                    <div class="check__choose--checkbox--close text-center checkbox-fa--icon {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'D') ? '' : 'd-none'}}">
                                                        <i class="fas fa-times-circle text-danger"></i>
                                                    </div>
                                                @endif
                                            </li>
                                            @endif

                                        </ul>
                                        <div class="wp__choose--answer wp__choose--math--fill wp__choose--math--fill1 {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}} pb-3" style="margin-top: 0 !important;">
                                            <div class="wp__item--math-fill text-center">
                                                {{--                        kq-dung--}}
                                                <div class="title__check__math {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == $dataArr['ANSWER']) ? '' : 'd-none'}} pt-0 title__check--success">
                                         <span class="check__math--fill">
                                             <i class="fas fa-check"></i>
                                         </span>
                                                    <span class="title__math--fill-kq">Trả lời đúng</span>
                                                </div>
                                                {{--                        kq-sai--}}
                                                <div class="title__check__math pt-0 {{(!$dataArr['RESULT_CHILD'] ||($dataArr['ANSWER_CHILD'] != $dataArr['ANSWER'])) ? '' : 'd-none'}} title__check--failed">
                                         <span class="check__math--fill text-danger">
                                             <i class="fas fa-times-circle"></i>
                                         </span>
                                                    <span class="title__math--fill-kq text-danger">Trả lời sai</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
        $(document).ready(function () {
            $('.list_result--exam .item__list--result--exam').click(function () {
                $('.item__list--result--exam').removeClass('active__result--exam');
                $('.img__redirect--exam').attr('src', '/images/sau.png')
                $(this).addClass('active__result--exam');
                const classParent = $(this).find('.img__block--result').find('.img__redirect--exam')
                classParent.attr('src', '/images/sau_error.png');
            })
        })
    </script>

    <script>
        $(document).ready(function (){
            $('.button__mark--checkbox').on('click', function () {
                var inputChecked = $('.box__load.item__list--result--exam.active__result--exam');
                if(inputChecked.length) {
                    inputChecked.each(function () {
                        $(this).closest('li').find('.checkbox-fa--icon').removeClass('d-none');
                        if($(this).data('value') === '{{$dataArr['ANSWER']}}') {
                            var audio = document.getElementById("audio");
                            let correctImage = inputChecked.find('.img__block--result').find('.img__redirect--exam');
                            audio.play();
                            correctImage.attr('src', '/images/sau_buom.png');
                            $('.wp__choose--math--fill1 .title__check--success').removeClass('d-none');
                            $('.wp__choose--math--fill1 .title__check--failed').addClass('d-none');
                        } else {
                            var audio = document.getElementById("audio2");
                            audio.play();
                            $('.wp__choose--math--fill1 .title__check--failed').removeClass('d-none');
                            $('.wp__choose--math--fill1 .title__check--success').addClass('d-none');
                        }
                    });

                    if($(this).hasClass('btn-submit--remake')) {
                        if($(this).parent().find('.btn-submit--exercise').length) {
                            $(this).addClass('d-none');
                            $(this).parent().find('.btn-submit--exercise').removeClass('d-none');
                        }
                    }
                } else {
                    var modalScored = $('#modal-scored');
                    modalScored.find('.modal-body--math').text('Bạn chưa chọn đáp án nên không thể chấm điểm');
                    modalScored.modal();
                    return false;
                }

                $('.list_result--exam .check__choose--checkbox.d-none').each(function () {
                    $(this).removeClass('d-none');
                });

                $('.wp__choose--math--fill1').removeClass('d-none');

                $.ajax({
                    url: "{{route('capture_type_one')}}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    data: {
                        'status_url': {{$status_url}},
                        'status_type': {{$status_type}},
                        'answered': inputChecked.length ? inputChecked.data('value') : null
                    },
                    success: function (data) {
                        if(data.message == 200) {
                            $(this).addClass('is-scored');
                            if($(this).hasClass('is-scored')) {
                                alert('Bài tập đã được chấm điểm rồi, không thể chấm điểm lần nữa.');
                                return false;
                            }
                            $('.point__exam--one').text(data.currentPoint);
                        } else if (data.message == 300) {
                            alert(data.result);
                        } else {
                            alert("sai")
                            $(this).removeClass('is-scored');
                            alert(data.result);
                        }
                    }
                });
            });
        })
    </script>
@endsection
