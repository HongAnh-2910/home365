@extends('app')
@section('content')
{{--    <audio controls id="audio_test">--}}
{{--        <source src="https://home365.vn/web/upload/sound/sai_laughing.mp3" type="audio/mpeg">--}}
{{--    </audio>--}}
    <audio id="audio2" src="{{ asset('audio/sai_laughing.mp3') }}"></audio>
    <audio id="audio" src="{{ asset('audio/true.mp3') }}"></audio>
    <div class="wp__exercise-one">
        <div class="bg__exercise--one" style="background-image: url({{ asset('images/bg-section1.png') }}) ; background-size: cover ; background-repeat: no-repeat">
                <div class="wp__content-exercise--one">
                        <div class="header-exercise--one header-exercise--one--no d-flex justify-content-between align-items-center">
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
                                <p class="question__text-exercise mb-0">
                                    {!! $list_exercise_type_7["TEXT"] ?? '' !!}
                                </p>
                            </div>
                        </div>
                        @php
                         $dataArr = $list_exercise_type_7['INFO'][$status_url-1];
                        @endphp
                        @if(request()->status == '')
                        <div class="wp__choose--answer">
                            <div class="title_choose--answer">
                                {!! $list_exercise_type_7["INFO"][$status_url - 1]["QUESTION"] ?? '' !!}
                            </div>
                            <div class="checkbox__choose--answer d-flex justify-content-around flex-wrap">
                                <div class="form-group text-center checkbox--choose position-relative">
                                    <input class="form-check-input form__check--choose" type="checkbox" data-value="A" value="1" id="flexCheckDefault">
                                    <label class="d-block babel__text--choose" for="exampleInputEmail1">{!!  $list_exercise_type_7["INFO"][$status_url - 1]["A"] ?? ''  !!}</label>
                                    @if($list_exercise_type_7["INFO"][$status_url - 1]['ANSWER'] == 'A')
                                        <div class="check__choose--checkbox checkbox-fa--icon {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}}">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    @else
                                        <div class="check__choose--checkbox--close checkbox-fa--icon {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'A') ? '' : 'd-none'}}">
                                            <i class="fas fa-times-circle"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group text-center checkbox--choose">
                                    <input class="form-check-input form__check--choose" type="checkbox" data-value="B" value="2" id="flexCheckDefault">
                                    <label class="d-block babel__text--choose" for="exampleInputEmail1">{!! $list_exercise_type_7["INFO"][$status_url - 1]["B"] ?? '' !!}</label>
                                    @if($list_exercise_type_7["INFO"][$status_url - 1]['ANSWER'] == 'B')
                                        <div class="check__choose--checkbox checkbox-fa--icon {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}}">
                                            <i class="fas fa-check"></i>
                                        </div>
                                    @else
                                        <div class="check__choose--checkbox--close checkbox-fa--icon {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'B') ? '' : 'd-none'}}">
                                            <i class="fas fa-times-circle"></i>
                                        </div>
                                    @endif
                                </div>
                                @if($list_exercise_type_7["INFO"][$status_url - 1]["C"])
                                    <div class="form-group text-center checkbox--choose">
                                        <input class="form-check-input form__check--choose" type="checkbox" data-value="C" value="3" id="flexCheckDefault">
                                        <label class="d-block babel__text--choose" for="exampleInputEmail1"> {!! $list_exercise_type_7["INFO"][$status_url - 1]["C"] ?? '' !!}</label>
                                        @if($list_exercise_type_7["INFO"][$status_url - 1]['ANSWER'] == 'C')
                                            <div class="check__choose--checkbox checkbox-fa--icon {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}}">
                                                <i class="fas fa-check"></i>
                                            </div>
                                        @else
                                            <div class="check__choose--checkbox--close checkbox-fa--icon {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'C') ? '' : 'd-none'}}">
                                                <i class="fas fa-times-circle"></i>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                @if($list_exercise_type_7["INFO"][$status_url - 1]["D"])
                                    <div class="form-group text-center checkbox--choose position-relative">
                                        <input class="form-check-input form__check--choose" type="checkbox" data-value="D" value="4" id="flexCheckDefault">
                                        <label class="d-block babel__text--choose" for="exampleInputEmail1">{!! $list_exercise_type_7["INFO"][$status_url - 1]["D"] ?? '' !!}</label>
                                        @if($list_exercise_type_7["INFO"][$status_url - 1]['ANSWER'] == 'D')
                                            <div class="check__choose--checkbox checkbox-fa--icon {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}}">
                                                <i class="fas fa-check"></i>
                                            </div>
                                        @else
                                            <div class="check__choose--checkbox--close checkbox-fa--icon {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'D') ? '' : 'd-none'}}">
                                                <i class="fas fa-times-circle"></i>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
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
                        @else
                            @foreach($list_exercise_type_7["INFO"] as $key => $info_7)
                               @if(request()->status == $key+1)
                                    <div class="wp__choose--answer">
                                        <div class="title_choose--answer">
                                            {!! $info_7["QUESTION"] ?? '' !!}
                                        </div>
                                        <div class="checkbox__choose--answer d-flex justify-content-around flex-wrap">
                                            <div class="form-group text-center checkbox--choose position-relative">
                                                <input class="form-check-input form__check--choose" type="checkbox" data-value="A" value="1" id="flexCheckDefault">
                                                <label class="d-block babel__text--choose" for="exampleInputEmail1">{!! $info_7["A"] ?? '' !!}</label>
                                                @if($info_7['ANSWER'] == 'A')
                                                    <div class="check__choose--checkbox checkbox-fa--icon {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}}">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                @else
                                                    <div class="check__choose--checkbox--close checkbox-fa--icon {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'A') ? '' : 'd-none'}}">
                                                        <i class="fas fa-times-circle"></i>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group text-center checkbox--choose">
                                                <input class="form-check-input form__check--choose" type="checkbox" data-value="B" value="2" id="flexCheckDefault">
                                                <label class="d-block babel__text--choose" for="exampleInputEmail1">{!! $info_7["B"] ?? '' !!}</label>
                                                @if($info_7['ANSWER'] == 'B')
                                                    <div class="check__choose--checkbox checkbox-fa--icon {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}}">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                @else
                                                    <div class="check__choose--checkbox--close checkbox-fa--icon {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'B') ? '' : 'd-none'}}">
                                                        <i class="fas fa-times-circle"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            @if(($info_7["C"]))
                                            <div class="form-group text-center checkbox--choose">
                                                <input class="form-check-input form__check--choose" type="checkbox" data-value="C" value="3" id="flexCheckDefault">
                                                <label class="d-block babel__text--choose" for="exampleInputEmail1"> {!! $info_7["C"] ?? '' !!}</label>
                                                @if($info_7['ANSWER'] == 'C')
                                                    <div class="check__choose--checkbox checkbox-fa--icon {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}}">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                @else
                                                    <div class="check__choose--checkbox--close checkbox-fa--icon {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'C') ? '' : 'd-none'}}">
                                                        <i class="fas fa-times-circle"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            @endif
                                            @if(($info_7["D"]))
                                                <div class="form-group text-center checkbox--choose position-relative">
                                                    <input class="form-check-input form__check--choose" type="checkbox" data-value="D" value="4" id="flexCheckDefault">
                                                    <label class="d-block babel__text--choose" for="exampleInputEmail1">{!! $info_7["D"] ?? '' !!}</label>
                                                    @if($info_7['ANSWER'] == 'D')
                                                        <div class="check__choose--checkbox checkbox-fa--icon {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}}">
                                                            <i class="fas fa-check"></i>
                                                        </div>
                                                    @else
                                                        <div class="check__choose--checkbox--close checkbox-fa--icon {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'D') ? '' : 'd-none'}}">
                                                            <i class="fas fa-times-circle"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif

                                        </div>

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
                                   @endif
                            @endforeach
                            @endif


                        <div class="mark__checkbox--choose d-flex justify-content-center align-items-center">
                            @if(request()->status)
                                <a href="" class="a__checkbox--choose prev__checkbox">
                                    <div class="perv__checkbox--choose">
                                    <i class="fas fa-arrow-left"></i>
                                    </div>
                                </a>
                            @endif
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
                                    <button class="btn--scored" data-toggle="modal" data-target="#modal-scored">Chấm điểm</button>
                                @else
                                    <button class="button__mark--checkbox button__mark--kq">Chấm điểm</button>
                                @endif
                            @endif
                                @if(request()->type)
                                    @if(!(request()->status == count(\GuzzleHttp\json_decode($json_array)) && request()->type == $array_total_type_list))
                                        <a href="" class="a__checkbox--choose next__checkbox">
                                            <div class="next__checkbox--choose">
                                                <i class="fas fa-arrow-right"></i>
                                            </div>
                                        </a>
                                    @endif
                                @else
                                    <a href="" class="a__checkbox--choose next__checkbox">
                                        <div class="next__checkbox--choose">
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
        $(document).ready(function (){
            $('.checkbox--choose').click(function (){
                $(".form__check--choose").prop('checked', false);
                $(this).find('.form__check--choose').prop('checked' , true)
            });

            $('.button__mark--checkbox').on('click', function () {
                var inputChecked = $('.form__check--choose:checked');
                if(inputChecked.length) {
                    inputChecked.each(function () {
                        $(this).closest('.checkbox--choose').find('.checkbox-fa--icon').removeClass('d-none');
                        if($(this).data('value') === '{{$dataArr['ANSWER']}}') {
                            var audio = document.getElementById("audio");
                            audio.play();
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

                $('.checkbox--choose .check__choose--checkbox.d-none').each(function () {
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
                            $('.point__exercise--one').text(data.currentPoint);
                        } else if (data.message == 300) {
                            alert(data.result);
                        } else {
                            $(this).removeClass('is-scored');
                            alert(data.result);
                        }
                    }
                });
            });
        })
    </script>
@endsection
