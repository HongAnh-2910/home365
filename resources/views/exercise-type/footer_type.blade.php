<div class="question-footer">
    @if(request()->status)
        <a class="d-inline-block btn-prev-left prev__checkbox" href=""><img src="{{asset('images/footer_arrow_left.png')}}" /></a>
    @endif

    @if(request()->type && request()->status == count(\GuzzleHttp\json_decode($json_array)) && request()->type == $array_total_type_list)
        @if($list_exercise_type_7['INFO'][$status_url-1]['RESULT_CHILD'])
            @if(request()->route()->getName() == 'taken_detail')
                <button class="btn--scored button__mark--kq" data-toggle="modal" data-target="#modal-scored">Chấm điểm</button>
            @else
                <a class="btn-submit--exercise" href="#">Nộp bài</a>
            @endif
        @else
            <a class="btn--capture btn-submit--remake" href="#">Chấm điểm</a>
            <a class="btn-submit--exercise d-none" href="#">Nộp bài</a>
        @endif

    @else
        @if($list_exercise_type_7['INFO'][$status_url-1]['RESULT_CHILD'])
            <a href="#" class="btn--scored" data-toggle="modal" data-target="#modal-scored">Chấm điểm</a>
        @else
            <a class="d-inline-block btn--capture" href="#">Chấm điểm</a>
        @endif
    @endif

{{--    <a class="d-inline-block btn-submit--exercise" href="#">Nộp bài</a>--}}
    @if(request()->type)
        @if(!(request()->status == count(\GuzzleHttp\json_decode($json_array)) && request()->type == $array_total_type_list))
            <a class="d-inline-block btn-next-right next__checkbox" href="#"><img src="{{asset('images/footer_arrow_right.png')}}" /></a>
        @endif
    @else
        <a class="d-inline-block btn-next-right next__checkbox" href="#"><img src="{{asset('images/footer_arrow_right.png')}}" /></a>
    @endif
</div>

@include('modal.modal_expired_submit')

{{--prev--}}
    @include('formatExercise.logic_next_prev')
{{--<script>--}}
{{--    $(document).ready(function () {--}}
{{--        $('.prev__checkbox').click(function (e) {--}}
{{--            e.preventDefault();--}}
{{--            let status_url = {{ $status_url }};--}}
{{--            let status_type = {{ $status_type }}--}}
{{--            if(status_url && !status_type)--}}
{{--            {--}}
{{--                if(status_url <= {{ $json_array }}.length)--}}
{{--                {--}}
{{--                    if({{ ($status_url - 1 ) }} === 1)--}}
{{--                    {--}}
{{--                        var link = $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}");--}}
{{--                    }else if({{ ($status_url - 1 ) }} > 1)--}}
{{--                    {--}}
{{--                        var link = $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?status={{ ($status_url - 1 ) }}");--}}
{{--                    }--}}
{{--                    if(link) {--}}
{{--                        let link2 = $(this).attr('href');--}}
{{--                        window.location.href = link2;--}}
{{--                    }--}}
{{--                } else {--}}
{{--                    if(status_type <= {{ $array_type_json }}.length + 1 ) $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?type={{ $status_type + 1 }}&status=1");--}}
{{--                    let link4 = $(this).attr('href');--}}
{{--                    window.location.href = link4;--}}
{{--                }--}}
{{--            }--}}
{{--            if(status_type) {--}}
{{--                if(status_url <= {{$json_array}}.length) {--}}
{{--                    if(status_url === 1)--}}
{{--                    {--}}
{{--                        if(status_type == 1)--}}
{{--                        {--}}
{{--                            $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?status="+{{ $list_exercise_type_prev }} ?? '');--}}
{{--                        }--}}
{{--                    }--}}
{{--                    if(status_url > 1 && status_type) {--}}
{{--                        $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?type={{ $status_type }}&status={{ $status_url - 1 }}");--}}
{{--                        let link = $(this).attr('href');--}}
{{--                        window.location.href = link;--}}
{{--                    }--}}
{{--                    if((status_url === 1) && status_type != 1)--}}
{{--                    {--}}
{{--                        $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?type={{ $status_type - 1 }}&status="+{{ $list_exercise_type_prev }} ?? '');--}}
{{--                    }--}}
{{--                    let link = $(this).attr('href');--}}
{{--                    window.location.href = link;--}}
{{--                }--}}
{{--            }--}}
{{--        })--}}
{{--    })--}}
{{--</script>--}}
{{--next--}}
{{--<script>--}}
{{--        $(document).ready(function (){--}}
{{--            $('.next__checkbox').click(function (e){--}}
{{--                e.preventDefault();--}}
{{--                let status_url = {{ $status_url }};--}}
{{--                let status_type = {{ $status_type }};--}}
{{--                if(status_url < {{ $json_array }}.length)--}}
{{--                {--}}
{{--                    let link = $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?status={{ ($status_url + 1) }}");--}}
{{--                    if(link) {--}}
{{--                        let link2 = $(this).attr('href');--}}
{{--                        window.location.href = link2;--}}
{{--                    }--}}
{{--                } else {--}}
{{--                        if(status_type <= {{ $array_type_json }}.length + 1 ) $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?type={{ $status_type + 1 }}&status=1");--}}
{{--                    let link4 = $(this).attr('href');--}}
{{--                        window.location.href = link4;--}}
{{--                }--}}

{{--                if(status_type) {--}}
{{--                    if(status_url < {{$json_array}}.length) {--}}
{{--                        $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?type={{ $status_type }}&status={{$status_url + 1}}");--}}
{{--                        let link = $(this).attr('href');--}}
{{--                        window.location.href = link;--}}
{{--                    } else {--}}
{{--                        $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?type={{ $status_type + 1 }}&status=1");--}}
{{--                        let link = $(this).attr('href');--}}
{{--                        window.location.href = link;--}}
{{--                    }--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
@include('modal.modal_submit')
@include('modal.modal_result')
@include('modal.modal_scored')
