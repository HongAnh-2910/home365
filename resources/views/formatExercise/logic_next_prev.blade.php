{{--prev--}}

<input type="hidden" class="get_exercise_id" data-url2 = "{{ route('dashboard') }}" data-url = {{ route('submit-homework') }} value="{{ $id }}">

@include('modal.modal_submit')
@include('modal.modal_expired_submit')
@include('modal.modal_result')
@include('modal.modal_scored')
<script>
    $(document).ready(function () {
        $('.prev__checkbox').click(function (e) {
            e.preventDefault();
            let status_url = {{ $status_url }};
            let status_type = {{ $status_type }};
            var isKieu10 = '{{$kieu10 ?? ''}}';
            var sessionBaby = '{{session('STATUS_BABY')}}';
            if(status_url && !status_type)
            {
                if(isKieu10 == '10' && sessionBaby) {
                    var link = $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?status="+sessionBaby);
                    window.location.href = link.attr('href');
                } else if(status_url <= {{ $json_array }}.length) {
                    if({{ ($status_url - 1 ) }} === 1)
                    {
                        var link = $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}");
                    }else if({{ ($status_url - 1 ) }} > 1)
                    {
                        var link = $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?status={{ ($status_url - 1 ) }}");
                    }
                    if(link) {
                        let link2 = $(this).attr('href');
                        window.location.href = link2;
                    }
                } else {
                    if(status_type <= {{ $array_type_json }}.length + 1 ) $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?type={{ $status_type + 1 }}&status=1");
                    let link4 = $(this).attr('href');
                    window.location.href = link4;
                }
            }
            if(status_type) {
                if(isKieu10 == '10' && sessionBaby) {
                    var previewType = status_type-1;
                    var link = $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?type="+previewType+"&status="+sessionBaby);
                    window.location.href = link.attr('href');
                } else if(status_url <= {{$json_array}}.length) {
                    if(status_url === 1)
                    {
                        if(status_type == 1)
                        {
                            $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?status="+{{ $list_exercise_type_prev }} ?? '');
                        }
                    }
                    if(status_url > 1 && status_type) {
                        $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?type={{ $status_type }}&status={{ $status_url - 1 }}");
                        let link = $(this).attr('href');
                        window.location.href = link;
                    }
                    if((status_url === 1) && status_type != 1)
                    {
                        $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?type={{ $status_type - 1 }}&status="+{{ $list_exercise_type_prev }} ?? '');
                    }
                    let link = $(this).attr('href');
                    window.location.href = link;
                }
            }
        })
    })
</script>

{{--next--}}
<script>
    $(document).ready(function (){
        $('.next__checkbox').click(function (e){
            e.preventDefault();
            let status_url = {{ $status_url }};
            let status_type = {{ $status_type }};
            if(status_url < {{ $json_array }}.length)
            {
                let link = $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?status={{ ($status_url + 1) }}");
                if(link) {
                    let link2 = $(this).attr('href');
                    window.location.href = link2;
                }
            } else {
                localStorage.setItem('count_prev' ,{{ $json_array }}.length)
                if(status_type <= {{ $array_type_json }}.length + 1 ) $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?type={{ $status_type + 1 }}&status=1");
                let link4 = $(this).attr('href');
                window.location.href = link4;
            }

            if(status_type) {
                if(status_url < {{$json_array}}.length) {
                    $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?type={{ $status_type }}&status={{$status_url + 1}}");
                    let link = $(this).attr('href');
                    window.location.href = link;
                } else {
                    $(this).attr('href' ,"{{ route(request()->route()->getName() ,$id) }}?type={{ $status_type + 1 }}&status=1");
                    let link = $(this).attr('href');
                    window.location.href = link;
                }
            }
        })
    })
</script>


