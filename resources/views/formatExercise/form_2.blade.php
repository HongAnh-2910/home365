@extends('app')
@section('content')
{{--    @php--}}
{{--            dd($list_exercise_type_7["INFO"][$status_url - 1]["HTML_CONTENT"])--}}
{{--    @endphp--}}
<audio id="audio2" src="{{ asset('audio/false1.mp3') }}"></audio>
<audio id="audio" src="{{ asset('audio/true.mp3') }}"></audio>
    <div class="wp__exercise-one">
        @php
            $dataArr = $list_exercise_type_7['INFO'][$status_url-1];
        @endphp
        <div class="bg__exercise--one" style="background: url({{ asset('images/bg__dang2.png') }}) center">
            <div class="wp__content-exercise--one">
                <div
                    class="header-exercise--one header-exercise--one--no d-flex justify-content-between align-items-center">
                    <div class="point__exercise--one">
                        {{number_format(session('CURRENT_POINT'), 1)}}
                    </div>
                    <div class="title__exercise--one">
                        Bài {{$list_exercise_type_7['QUESTION_NUMBER']}} : {{$list_exercise_type_7['HUONGDAN']}}
                    </div>
                    <div class="timeDown__exercise--one text-center">
                        <img src="{{ asset('images/watchclock.png') }}">
                        <div class="hours__time--down"></div>
                    </div>
                </div>

                <div class="header-exercise--one header-exercise--one--responsive d-none">
                    <div class="wp__responsive--one d-flex align-items-center justify-content-between">
                        <div class="point__exercise--one">
                            {{number_format(session('CURRENT_POINT'), 1)}}
                        </div>
                        <div class="timeDown__exercise--one text-center">
                            <img src="{{ asset('images/watchclock.png') }}">
                            <div class="hours__time--down"></div>
                        </div>
                    </div>
                    <div class="title__exercise--one">
                        Bài {{$list_exercise_type_7['QUESTION_NUMBER']}} : {{$list_exercise_type_7['HUONGDAN']}}
                    </div>
                </div>

                <div class="content__exercise--one">
                    <div class="question__exercise--one">
                        Câu {{ request()->status ? request()->status : 1 }} <span class="text-warning">({{number_format($list_exercise_type_7["INFO"][$status_url - 1]['POINT'], 1)}} điểm)</span>
                    </div>
                    <div class="question__wp--exercise-1">
                        <div class="question__wp--exercise-one">
                            <div class="wp__math--fill">
                                <div class="wp__math--fill--content text-center">
                                    <div class="text__input--fill-math">
                                        @php
                                        if(! $list_exercise_type_7["INFO"][$status_url - 1]['RESULT_CHILD'] || ! $list_exercise_type_7["INFO"][$status_url - 1]["ANSWER_CHILD"]) {
                                            $originText = $list_exercise_type_7["INFO"][$status_url - 1]["HTML_CONTENT"];
                                            $patern6 = '/<<(.*?)>>/';
                                            $patern7 = '/<<(.*?)>>>/';
                                            $patern8 = '/<<<(.*?)>>/';
                                            $replacements = '<input style="margin-right: 5px; margin-left: 8px;" type="email"
                                                    class="form-control input__form--text-fill d-inline-block"
                                                    aria-describedby="emailHelp">';
                                            $originText = preg_replace($patern7, $replacements, $originText);
                                            $originText = preg_replace($patern8, $replacements, $originText);
                                            $originText = preg_replace($patern6, $replacements, $originText);
                                        } else {
                                            $originText = $list_exercise_type_7["INFO"][$status_url - 1]["ANSWER_CHILD"];
                                            $patern9 = '=>>>';
                                            $patern10 = '<>>>';
                                            $patern11 = '<<<=';
                                            $patern12 = '<<<<';
                                            $patern13 = '<<<>>>';
                                            $patern3 = '<<';
                                            $patern4 = '>>';
                                            $patern5 = '>>>';
                                            $replacement3 = '<input style="margin-right: 5px; margin-left: 8px;" type="email"
                                                    class="form-control input__form--text-fill d-inline-block"
                                                    aria-describedby="emailHelp" value="';
                                            $replacement4 = '" />';
                                            $replacement5 = '>" />';
                                            $replacement9 = '=" />';
                                            $replacement10 = '<" />';
                                            $replacement11 = '<input style="margin-right: 5px; margin-left: 8px;" type="email"
                                                    class="form-control input__form--text-fill d-inline-block"
                                                    aria-describedby="emailHelp" value="=';
                                            $replacement12 = '<input style="margin-right: 5px; margin-left: 8px;" type="email"
                                                    class="form-control input__form--text-fill d-inline-block"
                                                    aria-describedby="emailHelp" value="<';
                                            $replacement13 = '<input style="margin-right: 5px; margin-left: 8px;" type="email"
                                                    class="form-control input__form--text-fill d-inline-block"
                                                    aria-describedby="emailHelp" value=">>>>';
                                            $originText = str_replace($patern11, $replacement11, $originText);
                                            $originText = str_replace($patern12, $replacement12, $originText);
                                            $originText = str_replace($patern13, $replacement13, $originText);
                                            $originText = str_replace($patern3, $replacement3, $originText);
                                            $originText = str_replace($patern9, $replacement9, $originText);
                                            $originText = str_replace($patern10, $replacement10, $originText);
                                            $originText = str_replace($patern5, $replacement5, $originText);
                                            $originText = str_replace($patern4, $replacement4, $originText);
                                        }
                                        @endphp
                                        {!! $originText !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wp__choose--answer wp__choose--math--fill {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}}">
                        <div class="wp__item--math-fill text-center">
                            {{--                        kq-dung--}}
                            <div class="title__check__math title__check--success {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == $dataArr['HTML_CONTENT']) ? '' : 'd-none'}}">
                                 <span class="check__math--fill">
                                     <i class="fas fa-check"></i>
                                 </span>
                                 <span class="title__math--fill-kq">Trả lời đúng</span>
                            </div>
                            {{--                        kq-sai--}}
                            <div class="title__check__math title__check--failed {{(!$dataArr['RESULT_CHILD'] ||($dataArr['ANSWER_CHILD'] != $dataArr['HTML_CONTENT'])) ? '' : 'd-none'}}">
                                 <span class="check__math--fill text-danger">
                                     <i class="fas fa-times-circle"></i>
                                 </span>
                                <span class="title__math--fill-kq text-danger">Trả lời sai</span>
                            </div>
                            <div class="kq__wp__math--fill">
                                <div class="text__input--fill-kq">
                                    @php
                                        $resultText = $list_exercise_type_7["INFO"][$status_url - 1]["HTML_CONTENT"];
                                        $patern1 = '<<';
                                        $patern2 = '>>';
                                        $replacement1 = '';
                                        $replacement2 = '';
                                        $resultText = str_replace($patern1, $replacement1, $resultText);
                                        $resultText = str_replace($patern2, $replacement2, $resultText);
                                    @endphp

                                    <span class="text__input--fill-kq">{!! $resultText !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mark__checkbox--choose d-flex justify-content-center align-items-center">
                        <a href="" class="a__checkbox--choose prev__checkbox">
                            <div class="perv__checkbox--choose">
                                <i class="fas fa-arrow-left"></i>
                            </div>
                        </a>
                        @if(request()->type && request()->status == count(\GuzzleHttp\json_decode($json_array)) && request()->type == $array_total_type_list)
                            @if($list_exercise_type_7['INFO'][$status_url-1]['RESULT_CHILD'])
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
                            @if($list_exercise_type_7['INFO'][$status_url-1]['RESULT_CHILD'])
                                <button class="btn--scored button__mark--kq" data-toggle="modal" data-target="#modal-scored">Chấm điểm</button>
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
    </div>

@include('formatExercise.logic_next_prev')
    <script>
        $(document).ready(function () {
            $('.checkbox--choose').click(function () {
                $(".form__check--choose").prop('checked', false);
                $(this).find('.form__check--choose').prop('checked', true)
            });

            $('.button__mark--checkbox').on('click', function () {
                var arrayData = [];
                var isEmpty = true;
                $('.input__form--text-fill').each(function () {
                    if(! $(this).val()) {
                        isEmpty = false;
                    }
                    arrayData.push('<<'+$(this).val().trim()+'>>');
                });

                if(!isEmpty) {
                    var modalScored = $('#modal-scored');
                    modalScored.find('.modal-body--math').text('Bạn chưa hoàn thành câu trả lời nên không thể chấm điểm');
                    modalScored.modal();
                    return false;
                }

                if($(this).hasClass('btn-submit--remake') && isEmpty) {
                    if($(this).parent().find('.btn-submit--exercise').length) {
                        $(this).addClass('d-none');
                        $(this).parent().find('.btn-submit--exercise').removeClass('d-none');
                    }
                }

                $.ajax({
                    url: "{{route('capture_type_two')}}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    data: {
                        'status_url': {{$status_url}},
                        'status_type': {{$status_type}},
                        'answered': arrayData
                    },
                    success: function (data) {
                        if(data.message == 200) {
                            $('.point__exercise--one').text(data.currentPoint);
                            var mathFill = $('.wp__choose--math--fill');
                            mathFill.removeClass('d-none');
                            $(this).addClass('is-scored');
                            if($(this).hasClass('is-scored')) {
                                alert('Bài tập đã được chấm điểm rồi, không thể chấm điểm lần nữa.');
                                return false;
                            }
                            if(data.correct) {
                                var audio = document.getElementById("audio");
                                audio.play();
                                mathFill.find('.title__check--success').removeClass('d-none');
                                mathFill.find('.title__check--failed').addClass('d-none');
                            } else {
                                var audio = document.getElementById("audio2");
                                audio.play();
                                mathFill.find('.title__check--failed').removeClass('d-none');
                                mathFill.find('.title__check--success').addClass('d-none');
                            }

                        } else if (data.message == 300) {
                            alert(data.result);
                        } else {
                            alert(data.result);
                            $(this).removeClass('is-scored');
                        }
                    }
                });
            });
        })
    </script>
@endsection
