{{--    modal--}}
@php
    $dataArr = $list_exercise_type_7['INFO'][$status_url-1];
@endphp

<audio id="audio2" src="{{ asset('audio/false.mp3') }}"></audio>
<audio id="audio" src="{{ asset('audio/true.mp3') }}"></audio>

<div class="modal modal-baby--form fade {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD']) ? 'show' : '' }}" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content modal__content--baby">
            <div class="modal-header px-0 border-0">
                <h6 class="modal-title modal__title--baby" id="exampleModalLongTitle">Câu 1 <span class="text-warning">(0.5 điểm)</span>
                </h6>
                {{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                {{--                    <span aria-hidden="true">&times;</span>--}}
                {{--                </button>--}}
            </div>
            <div class="modal-body text-center">
                <div class="wp__modal--body--baby position-relative">
                    <div class="img__kq--body">
                        {{--                        <img  src="{{ asset('images/img_bt_baby.png') }}"/>--}}
                    </div>
                    <div class="question__modal--baby">
                        {!! $dataArr["HTML_CONTENT"] ?? '' !!}
                    </div>
                    <div class="checkbox__choose--answer d-flex justify-content-around flex-wrap">
                        <div class="form-group text-center checkbox--choose position-relative">
                            <input {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'A') ? 'checked' : ''}} class="form-check-input form__check--choose input__baby--1" type="checkbox" data-value="A"
                                   id="flexCheckDefault">
                            <label class="d-block babel__text--choose"
                                   for="exampleInputEmail1">{!! $dataArr["HTML_A"] ?? '' !!}</label>

                            @if($dataArr['ANSWER'] == 'A')
                                <div class="check__choose--checkbox checkbox-fa--icon {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}} title__check--success">
                                    <i class="fas fa-check"></i>
                                </div>
                            @else
                                <div class="check__choose--checkbox--close checkbox-fa--icon {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'A') ? '' : 'd-none'}} title__check--failed">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                            @endif
                        </div>
                        <div class="form-group text-center checkbox--choose">
                            <input {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'B') ? 'checked' : ''}}  class="form-check-input form__check--choose input__baby--2" type="checkbox" data-value="B"
                                   id="flexCheckDefault">
                            <label class="d-block babel__text--choose"
                                   for="exampleInputEmail1">{!! $dataArr["HTML_B"] ?? '' !!}</label>
                            @if($dataArr['ANSWER'] == 'B')
                                <div class="check__choose--checkbox checkbox-fa--icon {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}} title__check--success">
                                    <i class="fas fa-check"></i>
                                </div>
                            @else
                                <div class="check__choose--checkbox--close checkbox-fa--icon {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'B') ? '' : 'd-none'}} title__check--failed">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                            @endif
                        </div>
                        <div class="form-group text-center checkbox--choose">
                            <input {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'C') ? 'checked' : ''}} class="form-check-input form__check--choose input__baby--3" type="checkbox" data-value="C"
                                   id="flexCheckDefault">
                            <label class="d-block babel__text--choose"
                                   for="exampleInputEmail1">{!! $dataArr["HTML_C"] ?? '' !!}</label>
                            @if($dataArr['ANSWER'] == 'C')
                                <div class="check__choose--checkbox checkbox-fa--icon {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}} title__check--success">
                                    <i class="fas fa-check"></i>
                                </div>
                            @else
                                <div class="check__choose--checkbox--close checkbox-fa--icon {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'C') ? '' : 'd-none'}} title__check--failed">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                            @endif
                        </div>
                        <div class="form-group text-center checkbox--choose position-relative">
                            <input {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'D') ? 'checked' : ''}} class="form-check-input form__check--choose input__baby--4" type="checkbox" data-value="D"
                                   id="flexCheckDefault">
                            <label class="d-block babel__text--choose"
                                   for="exampleInputEmail1">{!! $dataArr["HTML_D"] ?? '' !!}</label>
                            @if($dataArr['ANSWER'] == 'D')
                                <div class="check__choose--checkbox checkbox-fa--icon {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}} title__check--success">
                                    <i class="fas fa-check"></i>
                                </div>
                            @else
                                <div class="check__choose--checkbox--close checkbox-fa--icon {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD'] == 'D') ? '' : 'd-none'}} title__check--failed">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="success__no {{$dataArr['RESULT_CHILD'] ? '' : 'd-none'}}">
                        {{--dap an dung--}}
                        <div class="check__success__no--baby  success_result-baby {{ $dataArr["RESULT_CHILD"] && $dataArr["ANSWER_CHILD"] == $dataArr["ANSWER"] ?'' :'d-none' }}">
                           <span class="icon__check--baby">
                                <i class="fas fa-check"></i>
                           </span>
                            <span class="success__text--baby">
                                Trả lời đúng
                            </span>
                        </div>


                        {{--                        dap an sai--}}
                        <div class="check__success__no--baby errors_result-baby  {{ $dataArr["RESULT_CHILD"] && $dataArr["ANSWER_CHILD"] != $dataArr["ANSWER"] ?'' :'d-none' }}" style="bottom: -9%">
                           <span class="icon__check--baby text-danger">
                                <i class="far fa-times-circle"></i>
                           </span>
                            <span class="success__text--baby text-danger">
                                Trả lời sai.
                            </span>
                            <div class="title__error--baby success__text--baby text-danger">
                                Rất tiếc bạn chưa cứu được công chúa
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal__footer--baby border-0 d-flex justify-content-center">
                <button data-url="12312" type="button"
                        class="button_modal--footer-baby bg-math--footer1 click__modal--footer--baby click__result--baby {{($dataArr['RESULT_CHILD'] && $dataArr['ANSWER_CHILD']) ? 'is-scored' : ''}}">
                    Trả lời
                </button>
                <button type="button" class=" bg-math--footer2 button_modal--footer-baby" data-dismiss="modal">Đóng
                </button>
                <input type="hidden" class="url__value">
            </div>
        </div>
    </div>
</div>

{{--|@dd($dataArr)--}}
<script>
    $(document).ready(function () {
        $('.checkbox--choose').click(function () {
            $(".form__check--choose").prop('checked', false);
            $(this).find('.form__check--choose').prop('checked', true)
        })
    })
</script>


<script>
    let array_key = [1, 2, 3, 4]
    $(document).ready(function () {
        $('.modal-baby--form.show').each(function () {
            $(this).modal();
        });
        var status_url_js =  {{ $status_url }};
        var total_status = {{ $json_array }}
        $('.click__result--baby').click(function () {
            var inputChecked = $('.form__check--choose:checked');
            if(inputChecked.length) {
                inputChecked.each(function () {
                    $(this).closest('.checkbox--choose').find('.checkbox-fa--icon').removeClass('d-none');
                    var successText = $('.success__no');
                    successText.removeClass('d-none');

                    if($(this).data('value') === '{{$dataArr['ANSWER']}}') {
                        successText.find('.success_result-baby').removeClass('d-none');
                        successText.find('.errors_result-baby').addClass('d-none');
                    } else {
                        successText.find('.errors_result-baby').removeClass('d-none');
                        successText.find('.success_result-baby').addClass('d-none');
                    }
                });
            } else {
                var modalScored = $('#modal-scored');
                modalScored.find('.modal-body--math').text('Bạn chưa chọn đáp án nên không thể chấm điểm');
                modalScored.modal();
                return false;
            }


            $('.checkbox--choose .check__choose--checkbox.d-none').each(function () {
                $(this).removeClass('d-none');
            });

            if($(this).hasClass('btn-submit--remake')) {
                if($(this).parent().find('.btn-submit--exercise').length) {
                    $(this).addClass('d-none');
                    $(this).parent().find('.btn-submit--exercise').removeClass('d-none');
                }
            }

            var data = {
                status_url: {{$status_url}},
                status_type: {{$status_type}},
                answered: inputChecked.data('value')
            }

            $.ajax({
                url: "{{ route('logic-form-baby') }}",
                data: data,
                method: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN':  $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $(this).addClass('is-scored');
                    if(data.message === 200) {
                        if($(this).hasClass('is-scored')) {
                            alert('Bài tập đã được chấm điểm rồi, không thể chấm điểm lần nữa.');
                            return false;
                        }
                        $('.point__exercise--one').text(data.currentPoint)
                        if(inputChecked.data('value') === '{{$dataArr['ANSWER']}}') {
                            var audio = document.getElementById("audio");
                            audio.play();
                            if (status_url_js < total_status.length) {
                                $('.url__value').val("{{ route(request()->route()->getName() ,$id) }}?type={{ request()->type }}&status={{ (request()->status + 1 ) }}")
                                const url = $('.url__value').val();
                                window.location.href = url;
                            }

                            if(status_url_js == total_status.length) {
                                $('.a__checkbox--choose').removeClass('d-none')
                                $('.url__value').val("{{ route(request()->route()->getName() ,$id) }}?type={{ request()->type }}&status={{ count(json_decode($json_array))  }}")
                                const url = $('.url__value').val()
                                var btnSubmitted = $('.btn-submit--exercise');
                                if(btnSubmitted.length) {
                                    btnSubmitted.removeClass('d-none');
                                    btnSubmitted.parent().find('.btn-submit--remake').addClass('d-none');
                                } else {
                                    window.location.href = url;
                                }

                            }

                            if(total_status == {{ $json_array }}.length) {
                                $('.wp__bad_message--baby--success').removeClass('d-none')
                            }

                        } else {
                            var audio = document.getElementById("audio2");
                            audio.play();
                            $('.a__checkbox--choose').removeClass('d-none')
                            $('.next__checkbox--no').attr('href' , "{{ route(request()->route()->getName() ,$id) }}?type={{ request()->type + 1 }}&status=1")
                            $('.wp__bad_message--baby--no').removeClass('d-none')
                            $('.next--form--baby').click(function (e){
                                e.preventDefault();
                                let url2 = $('.next__checkbox--no').attr('href');
                                window.location.href = url2;
                            })
                        }

                    } else if (data.message == 300) {
                        alert(data.result);
                    } else {
                        alert(data.result);
                        $(this).removeClass('is-scored');
                    }
                },
            })
        })

    })
</script>



