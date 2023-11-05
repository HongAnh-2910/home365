@extends('app')
@section('content')


    <script src="https://rawgit.com/timruffles/ios-html5-drag-drop-shim/hold-to-drag-issue/release/index.js"></script>
      <script>
        MobileDragDrop.polyfill({
          forceApply: true,
          holdToDrag: 500,
          dragImageTranslateOverride: MobileDragDrop.scrollBehaviourDragImageTranslateOverride
        });
      </script>
    <script>
        function dragOver( event ) {
          event.preventDefault();
        }

        function dragEnter( event ) {
             event.preventDefault();
        }

        function dragStart(ev) {
            var disabled = document.getElementsByClassName('question-card disabled');
            if(disabled.length) {
                disabled[0].classList.remove('disabled');
            }

            ev.currentTarget.closest('.question-card').classList.add('disabled');

            sessionStorage.setItem('dragClone1', ev.currentTarget.closest('.question-card').querySelector('.card-content .type22-image').innerHTML);
            sessionStorage.setItem('dragDOM1', ev.currentTarget.closest('.question-card').className);
            sessionStorage.setItem('dragDataText', ev.currentTarget.closest('.question-card').querySelector('.card-content .question-answer-text').innerHTML);
        }

        function dragDrop(ev) {
            if(sessionStorage.getItem('dragDOM1').indexOf("question-card disabled-active disabled") !== -1) {
                return false;
            }
            ev.preventDefault();

            if(ev.currentTarget.querySelector('.answer-content .type22-img .type22-custom-icon')) {
                return false;
            }

            ev.currentTarget.closest('.answer-card').querySelector('.type22-img').innerHTML += (sessionStorage.getItem('dragClone1'));
            var dragClass = document.getElementsByClassName(sessionStorage.getItem('dragDOM1'));

            ev.currentTarget.closest('.answer-card').querySelector('.type22-img').querySelector('.icon-basket').classList.add('display-active-none');

            if(dragClass.length) {
                dragClass[0].classList.add('disabled-active');
            }

            var dragCl = document.getElementsByClassName(sessionStorage.getItem('dragDOM')+ ' disabled-active');
            if(dragCl.length) {
                dragCl[0].classList.remove('disabled');
            }

            var btnRedo = document.getElementsByClassName('btn-redo--answer d-none');
            if(btnRedo.length) {
                btnRedo[0].classList.remove('d-none');
            }

            ev.currentTarget.closest('.answer-card').querySelector('.hidden-data-text').value = sessionStorage.getItem('dragDataText')+'::'+ev.currentTarget.closest('.answer-card').querySelector('.answer-text-box').textContent;

            sessionStorage.removeItem('dragClone1');
            sessionStorage.removeItem('dragDataText');
            sessionStorage.removeItem('dragDOM1');
        }
    </script>

    <audio id="audio2" src="{{ asset('audio/false.mp3') }}"></audio>
    <audio id="audio" src="{{ asset('audio/true.mp3') }}"></audio>

    <div class="section-exercise-type22 position-relative">
        <img class="section-image-bg section-img-pc d-sm-block d-none" src="{{asset('images/type22_pc.png')}}" />
        <img class="section-image-bg section-img-mb d-sm-none d-block" src="{{asset('images/type22_mb.png')}}" />
        @include('exercise-type.header_type', ['data' => $list_exercise_type_7, 'status_url' => $status_url])
        @php
            $dataArr = $list_exercise_type_7['INFO'][$status_url-1];
        @endphp
        <div class="board-question-content custom-media-query position-relative">
                <div class="question-boxes custom">
                    @php
                        $key   = rand(0,3);
                        $value = $arrImages[$key];
                        $answerdArr[strip_tags(str_replace(["\n\r", "\n", "\r"], ["","",""], trim(explode('::', $dataArr['HTML_A'])[0])))] = $value;
                    @endphp
                    <div draggable="true" onDragStart="dragStart(event)" class="first question-card {{$dataArr['RESULT_CHILD'] ? 'disabled-active' : ''}}">
                        <div class="card-content">
                            <div class="type22-image" >
                                <img class="type22-custom-icon" src="{{$value}}" />
                            </div>
                            <div class="question-answer-text">{!! trim(explode('::', $list_exercise_type_7["INFO"][$status_url - 1]['HTML_A'])[0]) !!}</div>
                        </div>
                    </div>

                    @php
                        unset($arrImages[$key]);
                        $arrImages = array_values($arrImages);
                        $key   = rand(0,2);
                        $value = $arrImages[$key];
                        $answerdArr[strip_tags(str_replace(["\n\r", "\n", "\r"], ["","",""], trim(explode('::', $dataArr['HTML_B'])[0])))] = $value;
                    @endphp
                    <div draggable="true" onDragStart="dragStart(event)" class="second question-card {{$dataArr['RESULT_CHILD'] ? 'disabled-active' : ''}}">
                        <div class="card-content">
                            <div class="type22-image" >
                                <img class="type22-custom-icon" src="{{$value}}" />
                            </div>
                            <div class="question-answer-text">{!! trim(explode('::', $list_exercise_type_7["INFO"][$status_url - 1]['HTML_B'])[0]) !!}</div>
                        </div>
                    </div>

                    @php
                        unset($arrImages[$key]);
                        $arrImages = array_values($arrImages);
                        $key   = rand(0,1);
                        $value = $arrImages[$key];
                        $answerdArr[strip_tags(str_replace(["\n\r", "\n", "\r"], ["","",""], trim(explode('::', $dataArr['HTML_C'])[0])))] = $value;
                    @endphp
                    <div draggable="true" onDragStart="dragStart(event)" class="third question-card {{$dataArr['RESULT_CHILD'] ? 'disabled-active' : ''}}">
                        <div class="card-content">
                            <div class="type22-image" >
                                <img class="type22-custom-icon" src="{{$value}}" />
                            </div>
                            <div class="question-answer-text">{!! trim(explode('::', $list_exercise_type_7["INFO"][$status_url - 1]['HTML_C'])[0]) !!}</div>
                        </div>
                    </div>

                    @php
                        unset($arrImages[$key]);
                        $arrImages = array_values($arrImages);
                        $key   = rand(0,0);
                        $value = $arrImages[$key];
                        $answerdArr[strip_tags(str_replace(["\n\r", "\n", "\r"], ["","",""], trim(explode('::', $dataArr['HTML_D'])[0])))] = $value;
                    @endphp
                    <div draggable="true" onDragStart="dragStart(event)" class="forth question-card {{$dataArr['RESULT_CHILD'] ? 'disabled-active' : ''}}">
                        <div class="card-content">
                            <div class="type22-image" >
                                <img class="type22-custom-icon" src="{{$value}}" />
                            </div>
                            <div class="question-answer-text">{!! trim(explode('::', $list_exercise_type_7["INFO"][$status_url - 1]['HTML_D'])[0]) !!}</div>
                        </div>
                    </div>

                    <div class="first answer-card" onDragEnter="dragEnter(event)" onDragOver="dragOver( event )" onDrop="dragDrop(event)">
                        <div class="answer-content">
                            <div class="type22-img">
                                <img class="icon-basket" src="{{asset('images/basket22.png')}}" />

                                @if($dataArr['RESULT_CHILD'] && $dataArr['EGG_4_RESULT'])
                                    <img class="type22-custom-icon" src="{{$answerdArr[strip_tags(str_replace(["\n\r", "\n", "\r"], ["","",""], trim(explode('::', $dataArr['EGG_4_RESULT'])[0])))]}}">
                                @endif
                            </div>
                            <div class="answer-text-box">{!! trim(last(explode('::', $list_exercise_type_7["INFO"][$status_url - 1]['HTML_D']))) !!}</div>
                            <input type="hidden" class="hidden-data-text" data-key="HTML_D" value="{{$dataArr['RESULT_CHILD'] ? $dataArr['EGG_4_RESULT'] : ''}}" />
                        </div>
                    </div>
                    <div class="second answer-card" onDragEnter="dragEnter(event)" onDragOver="dragOver( event )" onDrop="dragDrop(event)">
                        <div class="answer-content">
                            <div class="type22-img">
                                <img class="icon-basket" src="{{asset('images/basket22.png')}}" />
                                @if($dataArr['RESULT_CHILD'] && $dataArr['EGG_1_RESULT'])
                                    <img class="type22-custom-icon" src="{{$answerdArr[strip_tags(str_replace(["\n\r", "\n", "\r"], ["","",""], trim(explode('::', $dataArr['EGG_1_RESULT'])[0])))]}}">
                                @endif
                            </div>
                            <div class="answer-text-box">{!! trim(last(explode('::', $list_exercise_type_7["INFO"][$status_url - 1]['HTML_A']))) !!}</div>
                            <input type="hidden" class="hidden-data-text" data-key="HTML_A" value="{{$dataArr['RESULT_CHILD'] ? $dataArr['EGG_1_RESULT'] : ''}}" />
                        </div>
                    </div>
                    <div class="third answer-card" onDragEnter="dragEnter(event)" onDragOver="dragOver( event )" onDrop="dragDrop(event)">
                        <div class="answer-content">
                            <div class="type22-img">
                                <img class="icon-basket" src="{{asset('images/basket22.png')}}" />
                                @if($dataArr['RESULT_CHILD'] && $dataArr['EGG_2_RESULT'])
                                    <img class="type22-custom-icon" src="{{$answerdArr[strip_tags(str_replace(["\n\r", "\n", "\r"], ["","",""], trim(explode('::', $dataArr['EGG_2_RESULT'])[0])))]}}">
                                @endif
                            </div>
                            <div class="answer-text-box">{!! trim(last(explode('::', $list_exercise_type_7["INFO"][$status_url - 1]['HTML_B']))) !!}</div>
                            <input type="hidden" class="hidden-data-text" data-key="HTML_B" value="{{$dataArr['RESULT_CHILD'] ? $dataArr['EGG_2_RESULT'] : ''}}" />
                        </div>
                    </div>
                    <div class="forth answer-card" onDragEnter="dragEnter(event)" onDragOver="dragOver( event )" onDrop="dragDrop(event)">
                        <div class="answer-content">
                            <div class="type22-img">
                                <img class="icon-basket" src="{{asset('images/basket22.png')}}" />
                                @if($dataArr['RESULT_CHILD'] && $dataArr['EGG_3_RESULT'])
                                    <img class="type22-custom-icon" src="{{$answerdArr[strip_tags(str_replace(["\n\r", "\n", "\r"], ["","",""], trim(explode('::', $dataArr['EGG_3_RESULT'])[0])))]}}">
                                @endif
                            </div>
                            <div class="answer-text-box">{!! trim(last(explode('::', $list_exercise_type_7["INFO"][$status_url - 1]['HTML_C']))) !!}</div>
                            <input type="hidden" class="hidden-data-text" data-key="HTML_C" value="{{$dataArr['RESULT_CHILD'] ? $dataArr['EGG_3_RESULT'] : ''}}" />
                        </div>
                    </div>
                </div>
            <div class="w-100 result-order">
                <div id="result-wrapper" class="text-center result-wrapper p-0 w-100">
{{--                    <div class="result-text d-flex align-items-center justify-content-center">--}}
                    <div class="result-text result-text-success {{(isset($dataArr['is_correct']) && $dataArr['is_correct']) ? '' : 'd-none'}} align-items-center justify-content-center mb-3">
                        <div>
                            <img class="check-icon" style="margin-right: 5px; width: 20px;" src="{{asset('/images/check_correct.png')}}" />
                            <b style="color: #36B566;">Trả lời đúng</b>
                        </div>
                    </div>
{{--                    <div class="result-text d-flex align-items-center justify-content-center">--}}
                    <div class="result-text result-text-failed {{(!isset($dataArr['is_correct']) || $dataArr['is_correct']) ? 'd-none' : ''}} align-items-center justify-content-center mb-4">
                        <div>
                            <img class="check-icon" style="margin-right: 15px;" src="{{asset('/images/check_error.png')}}" />
                            <b style="color: #FF1D00;">Trả lời sai</b>
                        </div>
                        <div>
                            <div>{!! str_replace('::', ' -> ', $list_exercise_type_7["INFO"][$status_url - 1]['HTML_A'])!!}</div>
                            <div>{!! str_replace('::', ' -> ', $list_exercise_type_7["INFO"][$status_url - 1]['HTML_B'])!!}</div>
                            <div>{!! str_replace('::', ' -> ', $list_exercise_type_7["INFO"][$status_url - 1]['HTML_C'])!!}</div>
                            <div>{!! str_replace('::', ' -> ', $list_exercise_type_7["INFO"][$status_url - 1]['HTML_D'])!!}</div>
                        </div>
                    </div>
                </div>

                <div class="btns-wrapper">
                    <a class="btn-redo--answer d-none" href="#"><i class="fas fa-undo-alt"></i>&nbsp;Làm lại</a>
                    <div class="instruction-text mb-3">Hướng dẫn: Bấm và giữ quả trứng sau đó kéo vào rổ phù hợp</div>
                </div>

            </div>

        </div>
        @include('exercise-type.footer_type')
    </div>
    <script>
        $(document).ready(function () {
            $('.btn--capture').on('click', function (e) {
                e.preventDefault();
                var answered = {};
                var parentBoxes = $('.question-boxes');
                var questionCard = parentBoxes.find('.question-card');
                var qsActivated = parentBoxes.find('.question-card.disabled-active');
                var answerCard = parentBoxes.find('.answer-card');
                if(questionCard.length > qsActivated.length) {
                    var modalScored = $('#modal-scored');
                    modalScored.find('.modal-body--math').text('Bạn chưa hoàn thành câu trả lời nên chưa thể chấm điểm');
                    modalScored.modal();
                    return false;
                } else {
                    if($(this).hasClass('btn-submit--remake')) {
                        if($(this).parent().find('.btn-submit--exercise').length) {
                            $(this).addClass('d-none');
                            $(this).parent().find('.btn-submit--exercise').removeClass('d-none');
                        }
                    }
                }

                answerCard.find('.hidden-data-text').each(function () {
                    answered[$(this).data('key')] = $(this).val();
                });

                console.log(answered);

                $('.btn-redo--answer').addClass('d-none');

                $.ajax({
                    url: "{{route('capture_twenty_third')}}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    data: {
                        'status_url': {{$status_url}},
                        'status_type': {{$status_type}},
                        'answered': answered
                    },
                    success: function (data) {
                        if(data.message == 200) {
                            $('.exercise-type-header .header-score').text(data.currentPoint);
                            var resultWrapper = $('#result-wrapper');
                            resultWrapper.removeClass('d-none');
                            if(data.correct) {
                                var audio = document.getElementById("audio");
                                audio.play();
                                resultWrapper.find('.result-text-success').removeClass('d-none');
                                resultWrapper.find('.result-text-failed').addClass('d-none');
                            } else {
                                var audio = document.getElementById("audio2");
                                audio.play();
                                resultWrapper.find('.result-text-success').addClass('d-none');
                                resultWrapper.find('.result-text-failed').removeClass('d-none');
                            }
                        } else if (data.message == 300) {
                            alert(data.result);
                        } else {
                            alert(data.result);
                        }
                    }
                });
            });
        });
    </script>
@endsection
