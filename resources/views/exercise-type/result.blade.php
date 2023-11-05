<div class="w-100">
    @php
        $dataArray = $list_exercise_type_7["INFO"][$status_url - 1];
    @endphp
    <div id="result-wrapper" class="{{$dataArray['RESULT_CHILD'] ? '' : 'd-none'}} result-wrapper w-100 mb-3">
        <div class="result-text">
            <img class="check-icon check-icon--correct {{($dataArray['RESULT_CHILD'] && $dataArray['ANSWER_CHILD'] == $dataArray['HTML_CONTENT']) ? '' : 'd-none'}}" src="{{asset('/images/check_correct.png')}}" />
            <img class="check-icon check-icon--error {{(!$dataArray['RESULT_CHILD'] ||($dataArray['ANSWER_CHILD'] != $dataArray['HTML_CONTENT'])) ? '' : 'd-none'}}" src="{{asset('/images/check_error.png')}}" />
            Đáp án đúng là: <span>{{str_replace('::',' ', $list_exercise_type_7["INFO"][$status_url - 1]['HTML_CONTENT'])}}</span>
        </div>
    </div>
    <div class="btns-wrapper">
        @if(! $list_exercise_type_7["INFO"][$status_url - 1]['RESULT_CHILD'])
            <a class="btn-redo--answer d-none" href="#"><i class="fas fa-undo-alt"></i>&nbsp;Làm lại</a>
        @endif
        <div class="instruction-text mb-3">Hướng dẫn: Bấm và giữ giữ ô chữ trước sau đó kéo vào ô số phù hợp</div>
    </div>
</div>
