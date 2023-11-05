@extends('parent')
@section('content')
    <div class="section-change-class position-relative">
        @if(count($errors->all()))
{{--            <div class="alert-danger section-session-alert container d-flex justify-content-between align-items-center" style="max-width: 1070px; margin-bottom: 30px; padding: 15px; font-weight: bold;">--}}
{{--                <div>{{$errors->all()[0]}}</div>--}}
{{--                <div><a class="text-danger btn-close-section" href="#"><i class="fas fa-times"></i></a></div>--}}
{{--            </div>--}}
            @include('modal.modal_error', ['header_error' => 'CÓ LỖI XẢY RA', 'error_message' => $errors->all()[0]])
        @elseif(session('_error_message'))
{{--            <div class="alert-danger section-session-alert container d-flex justify-content-between align-items-center" style="max-width: 1070px; margin-bottom: 30px; padding: 15px; font-weight: bold;">--}}
{{--                <div>{{session('_error_message')}}</div>--}}
{{--                <div><a class="text-danger btn-close-section" href="#"><i class="fas fa-times"></i></a></div>--}}
{{--            </div>--}}
            @include('modal.modal_error', ['header_error' => 'CÓ LỖI XẢY RA', 'error_message' => session('_error_message')])
        @endif
        <img class="dashboard-bg" src="{{asset('images/change_class_bg.png')}}" />
        <div class="change-class-wrapper">
            <a class="back-to-dashboard" href="{{route('dashboard')}}">
                <img src="{{asset('images/backtop.png')}}" />
            </a>
            <div class="section-classes">
                <div class="class-title">Mời bạn chọn lớp</div>
                <div class="class-boxes">
                    <div class="class-card position-relative" data-class="1">
                        <div class="img-ticker {{$currentLevel == 1 ? 'd-block' : '' }}">
                            <img src="{{asset('images/tick_icon.png')}}" />
                        </div>
                        <label for="option0" class="class-item">Lớp 1</label>
                        @foreach($classList as $key => $item)
                            @if($item['ID_LEVEL'] == 1)
                                <input type="hidden" class="input-username" value="{{$item['USERNAME']}}" />
                                <input type="hidden" class="input-bm" value="{{$item['PASS']}}" />
                                @php
                                    unset($classList[$key])
                                @endphp
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="class-card position-relative" data-class="2">
                        <div class="img-ticker {{$currentLevel == 2 ? 'd-block' : '' }}">
                            <img src="{{asset('images/tick_icon.png')}}" />
                        </div>
                        <label for="option1" class="class-item">Lớp 2</label>
                        @foreach($classList as $key => $item)
                            @if($item['ID_LEVEL'] == 2)
                                <input type="hidden" class="input-username" value="{{$item['USERNAME']}}" />
                                <input type="hidden" class="input-bm" value="{{$item['PASS']}}" />
                                @php
                                    unset($classList[$key])
                                @endphp
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="class-card position-relative" data-class="3">
                        <div class="img-ticker {{$currentLevel == 3 ? 'd-block' : '' }}">
                            <img src="{{asset('images/tick_icon.png')}}" />
                        </div>
                        <label for="option2" class="class-item">Lớp 3</label>
                       @foreach($classList as $key => $item)
                            @if($item['ID_LEVEL'] == 3)
                                <input type="hidden" class="input-username" value="{{$item['USERNAME']}}" />
                                <input type="hidden" class="input-bm" value="{{$item['PASS']}}" />
                                @php
                                    unset($classList[$key])
                                @endphp
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="class-card position-relative" data-class="4">
                        <div class="img-ticker {{$currentLevel == 4 ? 'd-block' : '' }}">
                            <img src="{{asset('images/tick_icon.png')}}" />
                        </div>
                        <label for="option3" class="class-item">Lớp 4</label>
                        @foreach($classList as $key => $item)
                            @if($item['ID_LEVEL'] == 4)
                                <input type="hidden" class="input-username" value="{{$classList[$key + 1]['USERNAME'] ?? $item['USERNAME'] }}" />
                                <input type="hidden" class="input-bm" value="{{$classList[$key + 1]['PASS'] ?? $item['PASS'] }}" />
                                @php
                                    unset($classList[$key])
                                @endphp
                                @break
                            @endif
                        @endforeach
                    </div>
                    <div class="class-card position-relative" data-class="5">
                        <div class="img-ticker {{$currentLevel == 5 ? 'd-block' : '' }}">
                            <img src="{{asset('images/tick_icon.png')}}" />
                        </div>
                        <label for="option4" class="class-item">Lớp 5</label>
                        @foreach($classList as $key => $item)
                            @if($item['ID_LEVEL'] == 5)
                                <input type="hidden" class="input-username" value="{{$item['USERNAME']}}" />
                                <input type="hidden" class="input-bm" value="{{$item['PASS']}}" />
                                @php
                                    unset($classList[$key])
                                @endphp
                                @break
                            @endif
                        @endforeach
                    </div>
                </div>
                <label for="checkbox1" class="class-checkbox">
                    <input id="checkbox1" name="checkbox_class" type="checkbox" />
                    <span class="checkbox1-text @error('check_class') text-danger @enderror">Tôi không phải người máy</span>
                </label>
                <div class="buttons-wrapper">
                    <button type="submit" id="btn-change--class" class="btn-selected">Chọn</button>
                    <a href="{{route('dashboard')}}" class="btn-cancel">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
    <form id="change-class" class="d-none" action="{{route('change_class_update')}}" method="post">
        @csrf
        <input type="hidden" id="child-class" name="child_class" value="{{$currentLevel}}"/>
        <input type="hidden" id="child-user" name="child_user" value="{{$currentUN}}" />
        <input type="hidden" id="child-bm" name="child_bm" value="{{$currentPW}}" />
        <input type="hidden" id="check--class" name="check_class" value="">
    </form>
@endsection
