@extends('app')
@section('content')

    <div class="section-exercise-type23 position-relative">
        <img class="section-image-bg section-img-pc d-sm-block d-none" src="{{asset('images/type23_pc.png')}}" />
        <img class="section-image-bg section-img-mb d-sm-none d-block" src="{{asset('images/type23_mb.png')}}" />
        @include('exercise-type.header_type', ['data' => $list_exercise_type_7, 'status_url' => $status_url])
        @php
            $dataArray = $list_exercise_type_7['INFO'][$status_url-1];
        @endphp
        <div class="board-question-content custom-media-query position-relative">
                <div class="question-boxes" onDragOver="dragOver( event )">
                    @php
                        $key       = rand(0,3);
                        $value     = $arrBackgrounds[$key];
                        $keyActive = $arrKeys[$key];
                        $answerdArr = [ strip_tags(str_replace(["\n\r", "\n", "\r"], ["","",""], trim(explode('::', $dataArray['HTML_A'])[0]))) => $value];
                    @endphp
                    <div data-bg-color="{{$value}}" class="first question-card {{$dataArray['RESULT_CHILD'] ? 'activated' : ''}}" data-bg-active="{{$keyActive}}" style="background-color: {{$value}}">
{{--                        <div data-bg-color="{{$value}}" class="first question-card {{$dataArray['RESULT_CHILD'] ? 'activated' : ''}}" data-bg-active="{{$keyActive}}" style="background-color: {{$dataArray['RESULT_CHILD'] ? $keyActive : $value}}">--}}
                        <div class="card-content">{!! explode('::', $dataArray['HTML_A'])[0] !!}</div>
                    </div>

                    @php
                        unset($arrBackgrounds[$key]);
                        unset($arrKeys[$key]);
                        $arrBackgrounds = array_values($arrBackgrounds);
                        $arrKeys        = array_values($arrKeys);

                        $key       = rand(0,2);
                        $value     = $arrBackgrounds[$key];
                        $keyActive = $arrKeys[$key];
                        $answerdArr[ strip_tags(str_replace(["\n\r", "\n", "\r"], ["","",""], trim(explode('::', $dataArray['HTML_B'])[0])))] = $value;
                    @endphp
                    <div data-bg-color="{{$value}}" data-bg-active="{{$keyActive}}" class="second question-card {{$dataArray['RESULT_CHILD'] ? 'activated' : ''}}" style="background-color: {{$value}}" >
{{--                    <div data-bg-color="{{$value}}" data-bg-active="{{$keyActive}}" class="second question-card {{$dataArray['RESULT_CHILD'] ? 'activated' : ''}}" style="background-color: {{$dataArray['RESULT_CHILD'] ? $keyActive : $value}}" >--}}
                        <div class="card-content">{!! explode('::', $dataArray['HTML_B'])[0] !!}</div>
                    </div>

                    @php
                        unset($arrBackgrounds[$key]);
                        unset($arrKeys[$key]);
                        $arrBackgrounds = array_values($arrBackgrounds);
                        $arrKeys        = array_values($arrKeys);

                        $key       = rand(0,1);
                        $value     = $arrBackgrounds[$key];
                        $keyActive = $arrKeys[$key];
                        $answerdArr[ strip_tags(str_replace(["\n\r", "\n", "\r"], ["","",""], trim(explode('::', $dataArray['HTML_C'])[0])))] = $value;
                    @endphp
                    <div data-bg-color="{{$value}}" data-bg-active="{{$keyActive}}" class="third question-card {{$dataArray['RESULT_CHILD'] ? 'activated' : ''}}" style="background-color: {{$value}}">
{{--                    <div data-bg-color="{{$value}}" data-bg-active="{{$keyActive}}" class="third question-card {{$dataArray['RESULT_CHILD'] ? 'activated' : ''}}" style="background-color: {{$dataArray['RESULT_CHILD'] ? $keyActive : $value}}">--}}
                        <div class="card-content">{!! explode('::', $dataArray['HTML_C'])[0] !!}</div>
                    </div>

                    @php
                        unset($arrBackgrounds[$key]);
                        unset($arrKeys[$key]);

                        $arrBackgrounds = array_values($arrBackgrounds);
                        $arrKeys        = array_values($arrKeys);

                        $key       = rand(0,0);
                        $value     = $arrBackgrounds[$key];
                        $keyActive = $arrKeys[$key];
                        $answerdArr[ strip_tags(str_replace(["\n\r", "\n", "\r"], ["","",""], trim(explode('::', $dataArray['HTML_D'])[0])))] = $value;
                    @endphp
                    <div data-bg-color="{{$value}}" data-bg-active="{{$keyActive}}" class="forth question-card {{$dataArray['RESULT_CHILD'] ? 'activated' : ''}}" style="background-color: {{$value}}">
{{--                    <div data-bg-color="{{$value}}" data-bg-active="{{$keyActive}}" class="forth question-card {{$dataArray['RESULT_CHILD'] ? 'activated' : ''}}" style="background-color: {{$dataArray['RESULT_CHILD'] ? $keyActive : $value}}">--}}
                        <div class="card-content">{!! explode('::', $dataArray['HTML_D'])[0] !!}</div>
                    </div>

                    <div class="first answer-card {{$dataArray['RESULT_CHILD'] ? 'activated' : ''}}" style="{{($dataArray['RESULT_CHILD'] && $dataArray['EGG_4_RESULT']) ? 'background-color: '.$answerdArr[ strip_tags(str_replace(["\n\r", "\n", "\r"], ["","",""], trim(explode('::', $dataArray['EGG_4_RESULT'])[0])))] : ''}}">
                        <div class="answer-content">{!! last(explode('::', $dataArray['HTML_D'])) !!}</div>
                        <input type="hidden" class="hidden-data-text1" data-key="HTML_D" value="{{$dataArray['RESULT_CHILD'] ? $dataArray['EGG_4_RESULT'] : ''}}" />
                    </div>
                    <div class="second answer-card {{$dataArray['RESULT_CHILD'] ? 'activated' : ''}}" style="{{($dataArray['RESULT_CHILD'] && $dataArray['EGG_1_RESULT']) ? 'background-color: '.$answerdArr[ strip_tags(str_replace(["\n\r", "\n", "\r"], ["","",""], trim(explode('::', $dataArray['EGG_1_RESULT'])[0])))] : ''}}">
                        <div class="answer-content">{!! last(explode('::', $dataArray['HTML_A'])) !!}</div>
                        <input type="hidden" class="hidden-data-text1" data-key="HTML_A" value="{{$dataArray['RESULT_CHILD'] ? $dataArray['EGG_1_RESULT'] : ''}}" />
                    </div>
                    <div class="third answer-card {{$dataArray['RESULT_CHILD'] ? 'activated' : ''}}" style="{{($dataArray['RESULT_CHILD'] && $dataArray['EGG_2_RESULT']) ? 'background-color: '.$answerdArr[ strip_tags(str_replace(["\n\r", "\n", "\r"], ["","",""], trim(explode('::', $dataArray['EGG_2_RESULT'])[0])))] : ''}}">
                        <div class="answer-content">{!! last(explode('::', $dataArray['HTML_B'])) !!}</div>
                        <input type="hidden" class="hidden-data-text1" data-key="HTML_B" value="{{$dataArray['RESULT_CHILD'] ? $dataArray['EGG_2_RESULT'] : ''}}" />
                    </div>
                    <div class="forth answer-card {{$dataArray['RESULT_CHILD'] ? 'activated' : ''}}" style="{{($dataArray['RESULT_CHILD'] && $dataArray['EGG_3_RESULT']) ? 'background-color: '.$answerdArr[ strip_tags(str_replace(["\n\r", "\n", "\r"], ["","",""], trim(explode('::', $dataArray['EGG_3_RESULT'])[0])))] : ''}}">
                        <div class="answer-content">{!! last(explode('::', $dataArray['HTML_C'])) !!}</div>
                        <input type="hidden" class="hidden-data-text1" data-key="HTML_C" value="{{$dataArray['RESULT_CHILD'] ? $dataArray['EGG_3_RESULT'] : ''}}" />
                    </div>
                </div>
            <div class="w-100 result-order">
                <div id="result-wrapper" class="text-center result-wrapper w-100 mb-3 p-0 {{$dataArray['RESULT_CHILD'] ? '' : 'd-none'}}">
{{--                    <div class="result-text d-flex align-items-center justify-content-center">--}}
                    <div class="result-text result-text-success {{(isset($dataArray['is_correct']) && $dataArray['is_correct']) ? '' : 'd-none'}} align-items-center justify-content-center">
                        <div>
                            <img class="check-icon" style="margin-right: 5px; width: 20px;" src="{{asset('/images/check_correct.png')}}" />
                            <b style="color: #36B566; font-size: 18px;">Trả lời đúng</b>
                        </div>
                    </div>
{{--                    <div class="result-text d-flex align-items-center justify-content-center">--}}
                    <div class="result-text result-text-failed {{(!isset($dataArray['is_correct']) || $dataArray['is_correct']) ? 'd-none' : ''}} align-items-center justify-content-center">
                        <div class="mb-2">
                            <img class="check-icon" style="margin-right: 5px; width: 20px;" src="{{asset('/images/check_error.png')}}" />
                            <b style="color: #FF1D00; font-size: 18px;">Trả lời sai</b>
                        </div>
                        <a class="btn-show--answer" href="#">Xem đáp án đúng</a>
                    </div>
                </div>

                <div class="btns-wrapper">
                    @if(! $dataArray['RESULT_CHILD'])
                        <a class="btn-redo--answer d-none" href="#"><i class="fas fa-undo-alt"></i>&nbsp;Làm lại</a>
                    @endif
{{--                    <div class="instruction-text mb-3">Hướng dẫn: Bấm chọn ô phép tính trước, sau đó bấm chọn ô đáp án phù hợp</div>--}}
                </div>

            </div>

        </div>
        @include('exercise-type.footer_type')
        @include('modal.type23_result', ['data' => $list_exercise_type_7])
    </div>

    <audio id="audio2" src="{{ asset('audio/false.mp3') }}"></audio>
    <audio id="audio" src="{{ asset('audio/true.mp3') }}"></audio>

    <script>
        $(document).ready(function () {
            $('.btn--capture').on('click', function (e) {
                e.preventDefault();
                var answered = {};
                var parentBoxes = $('.question-boxes');
                var answerCard = parentBoxes.find('.answer-card');
                var acActivated = parentBoxes.find('.answer-card.activated');
                if(answerCard.length > acActivated.length) {
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

                answerCard.find('.hidden-data-text1').each(function () {
                    answered[$(this).data('key')] = $(this).val();
                });

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
