@extends('app')
@section('content')
    <div class="wp__exercise">
        <div class="wp_bg--exercise" style="background: url({{ asset('images/bg__exercise_net.png') }}) no-repeat center">
            <div class="wp_content--exercise">
                <div class="title__header-match position-relative">
                    <div class="back_top__login back_top__register back_top--match">
                        @if(request()->server('HTTP_REFERER'))
                            <a href="{{request()->server('HTTP_REFERER')}}"><img src="{{ asset('/images/backtop.png') }}"></a>
                        @else
                            <a href="{{route('week.exercise')}}"><img src="{{ asset('/images/backtop.png') }}"></a>
                        @endif
                    </div>
                    <div class="dotnet__title--header">
                        <div class="child__dotnet--title">
                           {{ $detail_exercise["DETAILS"]["SUBJECT_NAME"] ?? '' }} ({{ $detail_exercise["DETAILS"]["WEEK_NAME"] ?? '' }})
                        </div>
                    </div>
                </div>
{{--                --}}
                <div class="content--exercise-collapse content--exercise-match">
                    <div id="accordion" class="position-relative">
                        <div class="content__dotnet--match">
                            <div class="dotnet__content--math">
                                <div class="child__dotnet--content--match">
                                    {{ $detail_exercise["DETAILS"]["LEVEL_NAME"] ?? '' }}
                                </div>
                            </div>
                        </div>
                        <div class="card card__exercise">
                            <div class="collapse show collapseOne" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body card-body-exercise card-body-exercise2 card-body-exercise3">
                                    <div class="wp__math--body-exercise d-flex justify-content-center">
                                        <div class="wp__math--body-exercise--1">
                                            <div class="link__network--math d-flex justify-content-center">
                                                @if(isset($detail_exercise["DETAILS"]["LINK"]))
                                                <div class="link__1 youtube__modal--button" style="cursor: pointer">
                                                    <img src="{{ asset('images/youtube.png') }}">
                                                </div>
                                                @endif
                                                <a href="{{ $detail_exercise["DETAILS"]["FILE_PDF"] ?? '' }}" class="link__1">
                                                    <img src="{{ asset('images/pdf.png') }}">
                                                </a>
                                            </div>
                                            <div class="wp__content--body">
                                                <p class="title__content--body--math">
                                                    {{ $detail_exercise["DETAILS"]["NAME"] ?? '' }}
                                                </p>
                                                <p class="time__content--body--math">
                                                    Thời gian làm bài: 60 phút
                                                </p>
                                                <p class="text__content--body--math">
                                                    {{ $detail_exercise["DETAILS"]["REQUIREMENT"] ?? '' }}
                                                </p>
                                            </div>
                                            <div class="wp__button-math text-center">
                                                <button class="button-math__detail button-math__bg1 bg-math--footer1" data-toggle="modal" data-target="#exampleModalCenter">
                                                    Bắt đầu làm bài
                                                </button>
                                                <a href="{{route('week.exercise')}}" class="text-decoration-none button-math__detail button-math__bg2 bg-math--footer3">
                                                    Xem các bài khác
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--        modal--}}
        <form method="POST" action="{{ route('exercise_start_week' , $id) }}">
            @csrf
            <input type="hidden" value="{{$detail_exercise["DETAILS"]["VIETNAMESE_TAKEN_DURATION"] ?? 3600}}" name="details_duration_week" class="details-duration-week" />
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header modal-header__math">
                            <div class="modal-title modal--title_math" id="exampleModalLongTitle">Cảnh báo</div>
                            <button type="button" class="close close__header--math" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="fas fa-times"></i>
                            </span>
                            </button>
                        </div>
                        <div class="modal-body modal-body--math">
                            Không tắt trình duyệt hoặc chuyển sang trang khác khi đang làm bài, bài đang làm có thể sẽ bị mất.
                        </div>
                        <div class="modal-footer modal-footer--math" style="border: none">
                            <button type="submit" class="button-math__bg1 button-math--footer button__start--exercise bg-math--footer1">Bắt đầu làm</button>
                            <button type="button" class="button-math--footer  bg-math--footer2" data-dismiss="modal">Làm sau</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
{{--        @php--}}
{{--        dd($detail_exercise["DETAILS"]["LINK"])--}}
{{--        @endphp--}}
        @include('exercise.modal_youtube' , ['links' => $detail_exercise["DETAILS"]["LINK"] ?? ''] )
        <script>
            $(document).ready(function (){
                $('.card__exercise-header').click(function (){
                    $(this).find('.origin__card__exercise').toggleClass('transform_rotate')
                    let content = $(this).parent().find('.collapseOne');
                    $('.collapseOne').not(content).slideUp();
                    content.slideToggle();
                });
            })
        </script>
        <script>
            $(document).ready(function (){
                $('.youtube__modal--button').click(()=>{
                    $('#modal-lesson-youtube').modal();
                })
            })
        </script>


{{--        <script>--}}
{{--            let count = 3600;--}}

{{--            if(localStorage.getItem('time')) {--}}
{{--                let start = JSON.parse(localStorage.getItem('time'))--}}
{{--                // timer()--}}
{{--                count = start[0]*3600+start[1]*60+start[2];--}}
{{--                console.log(start)--}}
{{--            }--}}

{{--            let counter = setInterval(timer, 1000); //1000 will  run it every 1 second--}}

{{--            function timer() {--}}
{{--                count = count - 1;--}}
{{--                if (count == -1) {--}}
{{--                    clearInterval(counter);--}}
{{--                    return;--}}
{{--                }--}}
{{--                let seconds = count % 60;--}}
{{--                let minutes = Math.floor(count / 60);--}}
{{--                let hours = Math.floor(minutes / 60);--}}
{{--                minutes %= 60;--}}
{{--                const times =[ hours , minutes ,seconds]--}}
{{--                localStorage.setItem('time', JSON.stringify(times));--}}
{{--                document.querySelector(".hours__time--down").innerHTML =  minutes + ":" + seconds--}}
{{--            }--}}
{{--        </script>--}}

{{--        <script>--}}
{{--            $(document).ready(function (){--}}
{{--                $('.button__start--exercise').click(function (){--}}
{{--                    let count = 3600;--}}
{{--                    // if(sessionStorage.getItem('time')) {--}}
{{--                    //     let start = JSON.parse(localStorage.getItem('time'))--}}
{{--                    //     // timer()--}}
{{--                    //     count = start[0]*3600+start[1]*60+start[2];--}}
{{--                    //     console.log(start)--}}
{{--                    // }--}}
{{--                    let counter = setInterval(timer, 1000); //1000 will  run it every 1 second--}}
{{--                    function timer() {--}}
{{--                        count = count - 1;--}}
{{--                        if (count == -1) {--}}
{{--                            clearInterval(counter);--}}
{{--                            return;--}}
{{--                        }--}}
{{--                        let seconds = count % 60;--}}
{{--                        let minutes = Math.floor(count / 60);--}}
{{--                        let hours = Math.floor(minutes / 60);--}}
{{--                        minutes %= 60;--}}
{{--                        const times =[ hours , minutes ,seconds]--}}
{{--                        localStorage.setItem('time', JSON.stringify(times));--}}
{{--                        // document.querySelector(".hours__time--down").innerHTML =  minutes + ":" + seconds--}}
{{--                    }--}}
{{--                    console.log(localStorage.getItem('time'))--}}
{{--                    if(localStorage.getItem('time'))--}}
{{--                    {--}}
{{--                        $.ajax({--}}
{{--                            url: "{{ route('display-exercise' , $id) }}",--}}
{{--                            data: {1:1},--}}
{{--                            method: 'GET',--}}
{{--                            dataType: 'html',--}}
{{--                            success: function (data) {--}}
{{--                                location.href ="{{ route('display-exercise' , $id) }}"--}}
{{--                            },--}}
{{--                        })--}}
{{--                    }--}}

{{--                    })--}}
{{--            })--}}
{{--        </script>--}}

@endsection
