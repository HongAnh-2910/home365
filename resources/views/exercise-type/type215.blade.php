@extends('app')
@section('content')
    <audio id="audio2" src="{{ asset('audio/false.mp3') }}"></audio>
    <audio id="audio" src="{{ asset('audio/true.mp3') }}"></audio>
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

            ev.target.classList.add('disabled');
            sessionStorage.setItem('dragClone', ev.target.innerHTML);
            sessionStorage.setItem('parentBG', ev.target.dataset.bgColor);
            sessionStorage.setItem('dragDOM', ev.target.className);
        }

        function dragDrop(ev) {
            if(sessionStorage.getItem('dragDOM').indexOf("question-card disabled-active disabled") !== -1) {
                return false;
            }
            ev.preventDefault();
            if(ev.target.className === 'card-content') {
                return false;
            }
            ev.target.parentElement.classList.add('border-none');
            ev.target.parentElement.style.backgroundColor = sessionStorage.getItem('parentBG');
            ev.target.parentElement.innerHTML = sessionStorage.getItem('dragClone');
            var dragClass = document.getElementsByClassName(sessionStorage.getItem('dragDOM'));

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

            sessionStorage.removeItem('dragClone');
            sessionStorage.removeItem('parentBG');
            sessionStorage.removeItem('dragDOM');
        }
    </script>
    <div class="section-exercise-type section-exercise-type215 position-relative">
        <img class="section-image-bg section-img-pc d-sm-block d-none" src="{{asset('images/type21.png')}}" />
        <img class="section-image-bg section-img-mb d-sm-none d-block" src="{{asset('images/type21_mobi.png')}}" />
        @include('exercise-type.header_type', ['data' => $list_exercise_type_7, 'status_url' => $status_url])
        @php
            $dataArr1 = $list_exercise_type_7["INFO"][$status_url - 1];
            $arrayX = explode('::', $dataArr1['HTML_CONTENT']);
            $arrayY = explode('::', $dataArr1['ANSWER_CHILD']);
            shuffle($arrayX);
        @endphp
        <div class="board-question-content custom-media-query position-relative">
                <div class="question-boxes" onDragOver="dragOver( event )">
                    @php
                        $key   = rand(0,5);
                        $value = $arrBackgrounds1[$key];
                        $arrBGOrigin = [$arrBackgrounds1[$key]];
                    @endphp
                    <div draggable="true" onDragStart="dragStart(event)" data-bg-color="{{$value}}" class="first question-card {{$dataArr1['RESULT_CHILD'] ? 'disabled-active': ''}}" style="background-color: {{$value}}">
                        <div class="card-content">{{$arrayX[0]}}</div>
                    </div>

                    @php
                        unset($arrBackgrounds1[$key]);
                        $arrBackgrounds1 = array_values($arrBackgrounds1);
                        $key   = rand(0,4);
                        $value = $arrBackgrounds1[$key];
                        $arrBGOrigin[] = $arrBackgrounds1[$key];
                    @endphp
                    <div draggable="true" onDragStart="dragStart(event)" data-bg-color="{{$value}}" class="second question-card {{$dataArr1['RESULT_CHILD'] ? 'disabled-active': ''}}" style="background-color: {{$value}}" >
                        <div class="card-content">{{$arrayX[1]}}</div>
                    </div>

                    @php
                        unset($arrBackgrounds1[$key]);
                        $arrBackgrounds1 = array_values($arrBackgrounds1);
                        $key   = rand(0,3);
                        $value = $arrBackgrounds1[$key];
                        $arrBGOrigin[] = $arrBackgrounds1[$key];
                    @endphp
                    <div draggable="true" onDragStart="dragStart(event)" data-bg-color="{{$value}}" class="third question-card {{$dataArr1['RESULT_CHILD'] ? 'disabled-active': ''}}" style="background-color: {{$value}}">
                        <div class="card-content">{{$arrayX[2]}}</div>
                    </div>

                    @php
                        unset($arrBackgrounds1[$key]);
                        $arrBackgrounds1 = array_values($arrBackgrounds1);
                        $key   = rand(0,2);
                        $value = $arrBackgrounds1[$key];
                        $arrBGOrigin[] = $arrBackgrounds1[$key];
                    @endphp
                    <div draggable="true" onDragStart="dragStart(event)" data-bg-color="{{$value}}" class="forth question-card {{$dataArr1['RESULT_CHILD'] ? 'disabled-active': ''}}" style="background-color: {{$value}}">
                        <div class="card-content">{{$arrayX[3]}}</div>
                    </div>

                    @php
                        unset($arrBackgrounds1[$key]);
                        $arrBackgrounds1 = array_values($arrBackgrounds1);
                        $key   = rand(0,1);
                        $value = $arrBackgrounds1[$key];
                        $arrBGOrigin[] = $arrBackgrounds1[$key];
                    @endphp
                    <div draggable="true" onDragStart="dragStart(event)" data-bg-color="{{$value}}" class="fifth question-card {{$dataArr1['RESULT_CHILD'] ? 'disabled-active': ''}}" style="background-color: {{$value}}">
                        <div class="card-content">{{$arrayX[4]}}</div>
                    </div>

                    <div class="first answer-card {{$dataArr1['RESULT_CHILD'] ? 'border-none': ''}}" onDragEnter="dragEnter(event)" onDragOver="dragOver( event )" onDrop="dragDrop(event)"  style='{{$dataArr1['RESULT_CHILD'] ? 'background-color: '.$arrBGOrigin[0].';' : ''}}'>
                        @if($dataArr1['RESULT_CHILD'])
                            <div class="card-content">{{$arrayY[0]}}</div>
                        @else
                            <div class="answer-content">1</div>
                        @endif
                    </div>
                    <div class="second answer-card {{$dataArr1['RESULT_CHILD'] ? 'border-none': ''}}" onDragEnter="dragEnter(event)" onDragOver="dragOver( event )" onDrop="dragDrop(event)"  style='{{$dataArr1['RESULT_CHILD'] ? 'background-color: '.$arrBGOrigin[1].';' : ''}}'>
                        @if($dataArr1['RESULT_CHILD'])
                            <div class="card-content">{{$arrayY[1]}}</div>
                        @else
                            <div class="answer-content">2</div>
                        @endif
                    </div>
                    <div class="third answer-card {{$dataArr1['RESULT_CHILD'] ? 'border-none': ''}}" onDragEnter="dragEnter(event)" onDragOver="dragOver( event )" onDrop="dragDrop(event)"  style='{{$dataArr1['RESULT_CHILD'] ? 'background-color: '.$arrBGOrigin[2].';' : ''}}'>
                        @if($dataArr1['RESULT_CHILD'])
                            <div class="card-content">{{$arrayY[2]}}</div>
                        @else
                            <div class="answer-content">3</div>
                        @endif
                    </div>

                    <div class="forth answer-card {{$dataArr1['RESULT_CHILD'] ? 'border-none': ''}}" onDragEnter="dragEnter(event)" onDragOver="dragOver( event )" onDrop="dragDrop(event)"  style='{{$dataArr1['RESULT_CHILD'] ? 'background-color: '.$arrBGOrigin[3].';' : ''}}'>
                        @if($dataArr1['RESULT_CHILD'])
                            <div class="card-content">{{$arrayY[3]}}</div>
                        @else
                            <div class="answer-content">4</div>
                        @endif
                    </div>

                    <div class="fifth answer-card {{$dataArr1['RESULT_CHILD'] ? 'border-none': ''}}" onDragEnter="dragEnter(event)" onDragOver="dragOver( event )" onDrop="dragDrop(event)"  style='{{$dataArr1['RESULT_CHILD'] ? 'background-color: '.$arrBGOrigin[4].';' : ''}}'>
                        @if($dataArr1['RESULT_CHILD'])
                            <div class="card-content">{{$arrayY[4]}}</div>
                        @else
                            <div class="answer-content">5</div>
                        @endif
                    </div>
                </div>
            @include('exercise-type.result')

        </div>
        @include('exercise-type.footer_type')
    </div>
    <script>
        $(document).ready(function () {
            $('.btn--capture').on('click', function (e) {
                e.preventDefault();
                var textResult = '';
                var answerCard = $('.question-boxes').find('.answer-card');
                if(answerCard.find('.card-content').length < answerCard.length) {
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

                answerCard.find('.card-content').each(function () {
                    if(!textResult) {
                        textResult = $(this).text();
                    } else {
                        textResult += '::'+$(this).text();
                    }
                });

                $('.btn-redo--answer').addClass('d-none');

                $.ajax({
                    url: "{{route('capture_type_twenty')}}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    data: {
                        'status_url': {{$status_url}},
                        'status_type': {{$status_type}},
                        'answered': textResult
                    },
                    success: function (data) {
                        if(data.message == 200) {
                            $('.exercise-type-header .header-score').text(data.currentPoint);
                            var resultWrapper = $('#result-wrapper');
                            resultWrapper.removeClass('d-none');
                            if(data.correct) {
                                var audio = document.getElementById("audio");
                                audio.play();
                                resultWrapper.find('.check-icon--correct').removeClass('d-none');
                                resultWrapper.find('.check-icon--error').addClass('d-none');
                            } else {
                                var audio = document.getElementById("audio2");
                                audio.play();
                                resultWrapper.find('.check-icon--correct').addClass('d-none');
                                resultWrapper.find('.check-icon--error').removeClass('d-none');
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
