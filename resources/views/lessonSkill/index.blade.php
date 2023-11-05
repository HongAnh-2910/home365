@extends('app')
@section('content')
            <div class="wp_skill">
                <div class="loading__skill">
                    <img  class="loading__modal d-none position-absolute" style="z-index: 9999 ; top: 50% ; left: 48% ; width: 4%" src="{{ asset("images/loading.gif") }}">
                </div>
                <div class="wp__bg--skill" style="background: url({{ asset('images/bg_lession2.png') }}) no-repeat center">
                    <div class="content__lesson-skill">
                        <div class="wp__top-title d-flex align-items-center justify-content-between">
                            <div class="back_top__login back_top__register">
                                <a href="{{route('dashboard')}}"><img src="{{ asset('/images/backtop.png') }}"></a>
                            </div>
                            <div class="title__lesson-skill text-center">
                                Bài giảng kỹ năng
                            </div>
                            <div class="test"></div>
                        </div>
                        @if($list_title_skill)
                            @foreach($list_title_skill as $key => $skill)
                        <div class="wp__slide--images-skill">
                            <div class="title__slide--skill">
                                {{ $skill['NAME'] ?? '' }}
                            </div>
                            {{--    modal--}}
                            @include("lessonSkill.modal_detail" , compact('skill'))
                            @include("lessonSkill.modalAll_video" , compact('skill'))

                            <div class="your-class position-relative">
                                @if(isset($response_total))
                                    @foreach($response_total[$key] as $list_lesson)
                                        <div class="item__images--skill item__images--active_{{ $list_lesson["ID_COURSE"] }}" data-title="{{ $list_lesson["NAME_COURSE"] }}"  data-url="{{ $list_lesson["URL1"] }}">
                                            <img width="390" height="220" src="https://admin.home365.online/{{ $list_lesson["IMAGES"] }}">
                                            <div class="title__img--skill">
                                                    {{ $list_lesson["NAME_COURSE"] }}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                            @endforeach
{{--                        info2--}}
                        @endif
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function (){
                    $('.item__images--skill').click(function (){
                        //cho cái anh gif hien thi len
                        $('.loading__modal').addClass('d-block').removeClass('d-none')
                        $('.wp_skill').css('opacity' ,'0.8')
                        let url = $(this).attr("data-url")
                        let title_url = $(this).attr("data-title")
                        $.ajax({
                            url: url,
                            method: 'GET',
                            dataType: 'html',
                            success: function (data) {
                                if(data)
                                {
                                     $('.loading__modal').addClass('d-none').removeClass('d-block')
                                      $('.wp_skill').css('opacity' ,'1')
                                        $('.modal-content-lesson1').html(data)
                                        $('#exampleModalCenter').modal();
                                        showVideo(title_url);
                                }
                                //anh none di và modal hien thi
                            },
                        })
                    });

                    function showVideo(title)
                    {
                        $(document).ready(function () {
                            $('table#datatable tr>td, table#database tr>td>a').click(function (e) {
                                $('#exampleModalCenter').modal('hide')
                                $('#exampleModalCenter_1').modal('show')
                                e.preventDefault();
                                const get_attr =  $(this).find('a');
                                const url = get_attr.attr('href');
                                let data = {url : url , title:title}
                                $.ajax({
                                    url: "{{ route('video.ajax') }}",
                                    method: 'get',
                                    data: data,
                                    dataType: 'html',
                                    success: function (data) {
                                        $('.modal-content-lesson2').html(data)
                                    },
                                })
                            })
                        })
                    }

                })
            </script>



            <script>
                $(document).ready(function (){
                    $('.click__back').click(function (e){
                        e.preventDefault();
                        $('#exampleModalCenter').modal('show')
                        $('#exampleModalCenter_1').modal('hide')
                        $('#exampleModalCenter_1 .modal-content-lesson2').empty()
                    })

                    $('.close_lesson').click(function (){
                        $('#exampleModalCenter_1 .modal-content-lesson2').empty()
                    })

                    $(document).on('click', function (e) {
                        var modalTerms = '#exampleModalCenter_1 .modal-dialog';
                        if (!$(e.target).closest(modalTerms).length && $(e.target).closest('#exampleModalCenter_1').length) {
                            $('#exampleModalCenter_1 .modal-content-lesson2').empty()
                        }
                    })
                })
            </script>


@endsection
