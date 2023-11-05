@extends('app')
@section('content')
    <div class="section-list-test position-relative">
        @if(session('_error_message'))
            @include('modal.modal_error', ['header_error' => 'CÓ LỖI XẢY RA', 'error_message' => session('_error_message')])
        @endif
        <img src="{{ asset('images/list_example_test.png') }}" class="bg-list-test" />
        <div class="wp__bg--skill">
            <div class="content__lesson-skill">
                <div class="wp__top-title d-flex align-items-center justify-content-between">
                    <div class="back_top__login back_top__register">
                        <a href="{{route('dashboard')}}"><img src="{{ asset('/images/backtop.png') }}"></a>
                    </div>
                    <div class="title__lesson-skill text-center">
                        LUYỆN THI
                    </div>
                    <div class="test"></div>
                </div>
                @foreach($listTest as $key => $test)
                    <div class="wp__slide--images-skill">
                        <div class="title__slide--skill">
                            @if($key == 'MATHS')
                                Môn Toán
                            @elseif($key == 'VIETNAMESE')
                                Môn Tiếng Việt
                            @else
                                Môn Tiếng Anh
                            @endif
                        </div>
                        <div class="your-test-class position-relative">
                            @foreach($test as $item)
                                       <a href="{{$item['ACTIVE_STATE'] ? route('example_details', ['id' => $item['ID'], 'ex_lst' => $item['EXCERCISE_LIST'], 'name' => $item['NAME'].' - ' .$item['SUBJECT_NAME']]) : '#'}}" class="btn-save-session item__images--skill position-relative {{$item['ACTIVE_STATE'] ? '' : 'btn-none--active'}}" data-exe-list="{{$item['EXCERCISE_LIST']}}" data-type-id="{{$item['ID']}}">
{{--                                <a href="{{route('example_details', ['id' => $item['ID'], 'ex_lst' => $item['EXCERCISE_LIST']])}}" class="item__images--skill position-relative btn-none--active" data-exe-list="{{$item['EXCERCISE_LIST']}}" data-type-id="{{$item['ID']}}">--}}
                                    <input type="hidden" class="active-name" value="{{$item['NAME']}} - {{$item['SUBJECT_NAME']}}" />
                                    <input type="hidden" class="active-description" value="{{$item['DESCRIPTION']}}" />
                                    <input type="hidden" class="active-instruction" value="{{$item['INSTRUCTION']}}" />
                                    @if($item['ACTIVE_STATE'])
                                        @if($key == 'MATHS')
                                            <img src="{{asset('images/list_test.png')}}">
                                        @elseif($key == 'VIETNAMESE')
                                            <img src="{{asset('images/list_test1.png')}}">
                                        @else
                                            <img src="{{asset('images/list_test2.png')}}">
                                        @endif
                                    @else
                                        @if($key == 'MATHS')
                                            <img src="{{asset('images/exercise_test_lock.png')}}" alt="">
                                        @elseif($key == 'VIETNAMESE')
                                            <img src="{{asset('images/exercise_test_lock1.png')}}" alt="">
                                        @else
                                            <img src="{{asset('images/exercise_test_lock2.png')}}" alt="">
                                        @endif
                                    @endif
                                    <div class="title__img--skill">
                                        {{ $item["NAME"] }}
                                    </div>
                                    @if(!$item['ACTIVE_STATE'])
                                        <div class="none-active-state">
                                            <img src="{{asset('images/lock_key.png')}}" />
                                        </div>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <form class="d-none" id="active-exercise-test">
        @csrf
        <input type="hidden" name="kitid" id="kitid" value="" />
        <input type="hidden" name="kitExe" id="kitExe" value="" />
    </form>
    @include('modal.modal_exercise_active')
@endsection
