@extends('app2')
@section('content')
    {{--    @dd($list_exercise_type_7)--}}
    <div class="wp__exercise-baby">
        <div class="bg__exercise--baby" style="background: url({{ asset('images/bg__new-babay.png') }}) center">
            <div class="wp__content-exercise--one">
                <div
                    class="header-exercise--one header-exercise--one--no d-flex justify-content-between align-items-center">
                    <div class="point__exercise--one" style="width: 100px">
                        {{number_format(session('CURRENT_POINT'), 1)}}
                    </div>
                    <div class="title__exercise--one text-dark">
                        Bài {{$list_exercise_type_7['QUESTION_NUMBER']}} : {{$list_exercise_type_7['HUONGDAN']}}
                    </div>
                    <div class="timeDown__exercise--one text-center">
                        <img src="{{ asset('images/watchclock.png') }}">
                        <div class="hours__time--down text-success"></div>
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
                @php
                    $list_form = [1,2,3,4,5,6,7,8,9,10,11,12];
                        $dataArr1 = $list_exercise_type_7['INFO'][$status_url-1];
                      if(request()->status == 1)
                          {
                              $dataArr = $list_exercise_type_7['INFO'][$status_url-1];
                          }elseif(request()->status > 1)
                              {
                                  $dataArr = $list_exercise_type_7['INFO'][($status_url-1)-1];
                              }
                     $url_error =  route(request()->route()->getName(),$id)."?type=".(request()->type + 1)."&status=1";
                @endphp
                <div class="content__exercise--one">
                    <div class="question__exercise--one">
                        <span class="text-dark">Câu {{ request()->status ? request()->status : 1 }}</span> <span
                            class="text-warning">(0{{$list_exercise_type_7["INFO"][$status_url - 1]['POINT']}} điểm)</span>
                    </div>
                    <div class="wp__full-baby">
                        <div class="wp__content--princess--baby text-center d-flex flex-wrap justify-content-center">
                            <ul class="content--princess--baby d-flex justify-content-between flex-wrap">
                                @foreach($list_form as $key => $value)
                                    @if(isset($dataArr["RESULT_CHILD"]) && $dataArr['ANSWER_CHILD'] == $dataArr['ANSWER'])
                                        @if(session('STATUS_BABY'))
                                            @if(session('STATUS_BABY') >= $value)
                                                <li class="item__princess--baby active__style item__princess--baby--{{ $value }}">
                                                    <div class="img__lock--princess">
                                                        <img width="57" class="img__windows--baby"
                                                             src="{{ asset('/images/windows.baby.png') }}">
                                                    </div>
                                                </li>
                                            @else
                                                <li class="item__princess--baby item__princess--baby--{{ $value }}">
                                                    <div class="img__lock--princess">
                                                        <img width="57" class="img__windows--baby"
                                                             src="{{ asset('images/look_1.png') }}">
                                                    </div>
                                                </li>
                                            @endif
                                        @endif
                                    @else
                                        <li class="item__princess--baby item__princess--baby--{{ $value }}">
                                            <div class="img__lock--princess">
                                                <img width="57" class="img__windows--baby"
                                                     src="{{ asset('images/look_1.png') }}">
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="wp__bad_message--baby wp__bad_message--baby--no text-center {{ $dataArr1["RESULT_CHILD"] && $dataArr1['ANSWER_CHILD'] != $dataArr1['ANSWER'] ?'' :'d-none' }}">
                            <div class="icon__bad--message-baby">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div class="text__bad--message-baby">
                                Rất tiếc bạn chưa cứu được công chúa
                            </div>
                        </div>
                        @if(($dataArr1["RESULT_CHILD"] && $dataArr1['ANSWER_CHILD'] == $dataArr1['ANSWER'] && request()->status == count(\GuzzleHttp\json_decode($json_array))) && (request()->type == $array_total_type_list || (request()->type < $array_total_type_list && session('DETAIL_EXERCISE')[$status_type+1]['KIEU'] != session('DETAIL_EXERCISE')[$status_type]['KIEU'])))
                            <div class="wp__bad_message--baby wp__bad_message--baby--success text-center">
                        @else
                            <div class="wp__bad_message--baby wp__bad_message--baby--success text-center d-none">
                        @endif
                            <div class="icon__bad--message-baby">
                                <i class="fas fa-check text-success"></i>
                            </div>
                            <div class="text__bad--message-baby text-success">
                                Bạn đã giải cứu công chúa thành công
                            </div>
                        </div>
                        <div class="mark__checkbox--choose d-flex justify-content-center align-items-center">
                            <a href="" class="a__checkbox--choose prev__checkbox">
                                <div class="perv__checkbox--choose">
                                    <i class="fas fa-arrow-left"></i>
                                </div>
                            </a>
                            @if(request()->type && request()->status == count(\GuzzleHttp\json_decode($json_array)) && request()->type == $array_total_type_list)
                                <button class="button__mark--checkbox button__mark--kq btn-submit--remake">Chấm điểm
                                </button>
                                <a class="d-none btn-submit--exercise" href="#">Nộp bài</a>
                            @else
                                <button class="button__mark--checkbox button__mark--kq btn-submit--remake">Chấm điểm</button>
                            @endif
                            @if(request()->type)
                                @if(!(request()->status == count(\GuzzleHttp\json_decode($json_array)) && request()->type == $array_total_type_list))
                                    @if($dataArr1["RESULT_CHILD"])
                                    <a href="{{ $dataArr1["RESULT_CHILD"] && $dataArr1['ANSWER_CHILD'] != $dataArr1['ANSWER'] ? route(request()->route()->getName(),$id)."?type=".((request()->type)+1)."&status=1":''}}" class="a__checkbox--choose next--form--baby">
                                        <div class="next__checkbox--choose {{ $dataArr1["RESULT_CHILD"] && $dataArr1['ANSWER_CHILD'] == $dataArr1['ANSWER'] ?'next__checkbox' :'next__checkbox--no'}}">
                                            <i class="fas fa-arrow-right"></i>
                                        </div>
                                    </a>
                                    @else
                                        <a href="{{ $dataArr1["RESULT_CHILD"] && $dataArr1['ANSWER_CHILD'] != $dataArr1['ANSWER'] ? route(request()->route()->getName(),$id)."?type=".((request()->type)+1)."&status=1":''}}" class="a__checkbox--choose d-none next--form--baby">
                                            <div class="next__checkbox--choose {{ $dataArr1["RESULT_CHILD"] && $dataArr1['ANSWER_CHILD'] == $dataArr1['ANSWER'] ?'next__checkbox' :'next__checkbox--no'}}">
                                                <i class="fas fa-arrow-right"></i>
                                            </div>
                                        </a>
                                    @endif
                                @endif
                            @else
                                @if($dataArr1["RESULT_CHILD"])
                                    <a href="{{ $dataArr1["RESULT_CHILD"] && $dataArr1['ANSWER_CHILD'] != $dataArr1['ANSWER'] ? route(request()->route()->getName(),$id)."?type=".((request()->type)+1)."&status=1":''}}" class="a__checkbox--choose next--form--baby">
                                        <div class="next__checkbox--choose {{ $dataArr1["RESULT_CHILD"] && $dataArr1['ANSWER_CHILD'] == $dataArr1['ANSWER'] ?'next__checkbox' :'next__checkbox--no'}}">
                                            <i class="fas fa-arrow-right"></i>
                                        </div>
                                    </a>
                                @else
                                    <a href="{{ $dataArr1["RESULT_CHILD"] && $dataArr1['ANSWER_CHILD'] != $dataArr1['ANSWER'] ? route(request()->route()->getName(),$id)."?type=".((request()->type)+1)."&status=1":''}}" class="a__checkbox--choose d-none next--form--baby">
                                        <div class="next__checkbox--choose {{ $dataArr1["RESULT_CHILD"] && $dataArr1['ANSWER_CHILD'] == $dataArr1['ANSWER'] ?'next__checkbox' :'next__checkbox--no'}}">
                                            <i class="fas fa-arrow-right"></i>
                                        </div>
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @foreach($list_exercise_type_7["INFO"] as $key => $value)
        @if(request()->status)
            @if($key == (request()->status) - 1)
                @include('formatExercise.modal_form_baby' ,compact('value'))
            @endif
        @endif

        @if(request()->status == '')
            @if(0 == $key)
                @include('formatExercise.modal_form_baby' ,compact('value'))
            @endif
        @endif
    @endforeach
    @if($dataArr1["RESULT_CHILD"] && $dataArr1['ANSWER_CHILD'] != $dataArr1['ANSWER'])
        <script>
            $(document).ready(function (){
                $('.next__checkbox--no').click(function (){
                    const get_href = $(this).attr('href')
                    window.location.href = get_href;
                })
            })
        </script>
    @endif
    @include('formatExercise.logic_next_prev')
    <script>
        $(document).ready(function () {
            function randomDoor() {
                let select__a = '.content--princess--baby .item__princess--baby';
                let number = $(select__a).length;
                let random = Math.floor((Math.random() * number));
                let resultRandom = random + 1;
                if ($(select__a + '.item__princess--baby--' + resultRandom).not('.active__style').length) {
                    $(select__a + '.item__princess--baby--' + resultRandom).not('.active__style').addClass('active__windows--baby');
                } else {
                    randomDoor();
                }
            }

            randomDoor();
        })
    </script>
    <script>
        $(document).ready(function () {
            $('.content--princess--baby').find('.active__windows--baby').click(function () {
                $('#exampleModalCenter').modal();
            })

        })
    </script>
    <script>
        $(document).ready(function () {
            $('.click__modal--footer--baby').click(function () {
                let select__a = $('.content--princess--baby').find('.item__princess--baby');
                let number = select__a.length;
                let random = Math.floor((Math.random() * number));
                let resultRandom = random + 1
                let letClassParent = $('.item__princess--baby--' + resultRandom).find('.img__lock--princess')
                if (!$('.item__princess--baby--' + resultRandom).hasClass('active__windows--baby')) {
                    // letClassParent.find('.img__windows--baby').attr('src', '/images/windows.baby.png')
                    // $('.item__princess--baby--' + resultRandom).css('background', '#252B42')
                }

            })
        })
    </script>

    <script>
        $(document).ready(function () {
            let dataArr = {!! json_encode($dataArr1) !!};
            let resultChild = dataArr['RESULT_CHILD'];
            let answer = dataArr['ANSWER'];
            let answerChild = dataArr['ANSWER_CHILD'];
            let status = {!! request()->status  !!};
            let totalArr = {!! count(json_decode($json_array)) !!};
            let type = {!! request()->type !!};
            let totalType = {!! $array_total_type_list !!};
            let session = {!! json_encode(session('DETAIL_EXERCISE')[$status_type]['KIEU']) !!};
            let successUrl = '{{ asset('images/bg__babySuccess.png') }}';
            if (type <= totalType) {
                if (typeof (resultChild) != "undefined" && answer == answerChild && status == totalArr) {
                    $('.bg__exercise--baby').css('background', 'url(' + successUrl + ')');
                }
            }
        })
    </script>




@endsection
