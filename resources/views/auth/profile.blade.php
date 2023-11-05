@extends('app')
@section('content')
    <div class="wp__profile">
        @if (session('success'))
            <div class="alert alert-success text-center mb-0">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        <div class="wp__bg--profile d-flex justify-content-center align-items-center"
             style="background: url({{ asset('images/change_class_bg.png') }}) no-repeat center;">
            <form id="profile-account" method="POST" action="{{ route("profile_update") }}" enctype="multipart/form-data">
                @csrf
            <div class="wp__form--profile text-center">
                <div class="border__profile d-inline-block"></div>
                <div class="title__profile">
                    Cập nhật thông tin
                </div>
                <label for="select_img" class="avatar__profile position-relative">
                    @if(str_contains($profile_update["THUMBNAIL"] ?? '' , 'images'))
                        <img style="width: 100% ; height: 100% ; border-radius: 75px" id="thumb"
                             src="{{ isset($profile_update["THUMBNAIL"]) ? asset($profile_update["THUMBNAIL"]) : asset('images/dashboard_avatar1.png') }}">
                    @else
                        <img style="width: 100% ; height: 100% ; border-radius: 75px" id="thumb"
                             src="{{ isset($profile_update["THUMBNAIL"]) ? asset('uploads/'.$profile_update["THUMBNAIL"]) : asset('images/dashboard_avatar1.png') }}">
                    @endif
                    <label for="select_img" class="select__but position-absolute">
                        <img src="{{ asset('images/but.png') }}">
                    </label>
                    <input type="text" name="test" value="{{ $profile_update["THUMBNAIL"] ?? 'images/dashboard_avatar1.png' }}" hidden>
                    <input onchange="preview()" type="file" name="file" id="select_img" hidden>
                </label>
                <div class="telephone__profile">
                    + {{ session('SDT') ?session('SDT') : '' }}
                </div>
                <div class="wp__form-item">
                    <div class="wp__form-item-left">
                        <div class="form-group position-relative">
                            <label for="form_tp" class="label__form-profile">Tỉnh/ Thành phố</label>
                            @error('province')
                            <div style="text-align: left" class="text text-danger text-error text-error-message">{{ $message }}</div>
                            @enderror
                            <select   class="form-control item__form-profile" name="province" id="form_tp">
                                <option selected="selected" hidden="hidden">Chọn tỉnh/thành phố</option>
                                @if(isset($list_province["INFO"]))
                                    @foreach($list_province["INFO"] as $province)
                                        @if(!isset($profile_update["PROVINCE_ID"]))
                                        <option
                                            @if(old('province') == $province["ID"])
                                                selected
                                            @endif
                                            value="{{ $province["ID"] ?? '' }}">{{ $province["PROVINCE_NAME"] ?? '' }}</option>
                                        @else
                                            <option
                                                @if($profile_update["PROVINCE_ID"] == $province["ID"])
                                                    selected
                                                    @endif
                                                value="{{ $province["ID"] ?? '' }}">{{ $province["PROVINCE_NAME"] ?? '' }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            <i class="fas fa-caret-down select__caret--profile position-absolute"></i>
                        </div>
                        <div class="form-group position-relative">
                            <label for="form__school" class="label__form-profile">Trường tiểu học <span
                                    class="text-danger" style="padding-left: 4px">*</span></label>
                            @error('school')
                            <div style="text-align: left" class="text text-danger text-error text-error-message">{{ $message }}</div>
                            @enderror
                            @if(old('district'))
                                @if(session('LIST_SCHOOL'))
                                    <select class="form-control item__form-profile" name="school" id="form__school">
                                        <option selected="selected" hidden="hidden">Chọn trường</option>
                                            @if(isset(session('LIST_SCHOOL')["INFO"]))
                                                <option selected="selected" hidden="hidden">Chọn trường</option>
                                                @foreach(session('LIST_SCHOOL')["INFO"] as $list_school)
                                                    <option
                                                        @if(old('school') ==($list_school["ID"] ?? ''))
                                                        selected
                                                        @endif
                                                        value="{{ $list_school["ID"] ?? '' }}">{{ $list_school["SCHOOL_NAME"] ?? '' }}</option>
                                                @endforeach
                                            @endif
                                    </select>
                                @endif
                            @else
                                <select class="form-control item__form-profile" name="school" id="form__school">
                                    <option selected="selected" hidden="hidden">Chọn trường</option>
                                    @if(isset($profile_update["SCHOOL_ID"]))
                                        @if(isset($list_school["INFO"]))
                                            <option selected="selected" hidden="hidden">Chọn trường</option>
                                            @foreach($list_school["INFO"] as $list_school)
                                                <option
                                                    @if($profile_update["SCHOOL_ID"] == $list_school["ID"])
                                                    selected
                                                    @endif
                                                    value="{{ $list_school["ID"] }}">{{ $list_school["SCHOOL_NAME"] }}</option>
                                            @endforeach
                                        @endif
                                    @endif
                                </select>
                            @endif
                            <i class="fas fa-caret-down select__caret--profile position-absolute"></i>
                        </div>
                        <div class="form-group">
                            <label for="form__name--profile" class="label__form-profile">Họ và tên<span
                                    class="text-danger" style="padding-left: 4px">*</span></label>
                            @error('fullName')
                            <div style="text-align: left" class="text text-danger text-error text-error-message">{{ $message }}</div>
                            @enderror
                            <input type="text" class="form-control item__form-profile" name="fullName" id="form__name--profile"
                                  value="{{ $profile_update["FULL_NAME"] ?? old('fullName') }}"  placeholder="Họ tên học sinh">
                        </div>
                        <div class="form-group">
                            <label for="form__phone--profile" class="label__form-profile">SĐT<span class="text-danger"
                                                                                                   style="padding-left: 4px">*</span></label>
                            <input type="text" name="phone" disabled class="form-control item__form-profile" id="form__phone--profile"
                                   value="{{ session('SDT') ?? '' }}" placeholder="Số điện thoại">
                        </div>
                    </div>
                    <div class="wp__form-item-right">
                        @if(old('province'))
                            @if(session('LIST_DISTRICT'))
                                <div class="form-group position-relative">
                                    <label for="form__qh" class="label__form-profile">Quận/ Huyện</label>
                                    @error('district')
                                    <div style="text-align: left" class="text text-danger text-error text-error-message">{{ $message }}</div>
                                    @enderror
                                    <select class="form-control item__form-profile" name="district" id="form__qh">
                                        <option selected="selected" hidden="hidden">Chọn quận/ huyện</option>
                                            @if(isset(session('LIST_DISTRICT')["INFO"]))
                                                @foreach(session('LIST_DISTRICT')["INFO"] as $district)
                                                    <option
                                                        @if(old('district') == ($district["ID"] ?? ''))
                                                            selected
                                                        @endif
                                                        value="{{ $district["ID"] }}">{{ $district["DISTRICT_NAME"] }}</option>
                                                @endforeach
                                            @endif
                                    </select>
                                    <input type="hidden"  name="get_id" id="form__name--profile"
                                           value="{{ request()->input('province') }}">
                                    <i class="fas fa-caret-down select__caret--profile position-absolute"></i>
                                </div>
                            @endif
                        @else
                            <div class="form-group position-relative">
                                <label for="form__qh" class="label__form-profile">Quận/ Huyện</label>
                                @error('district')
                                <div style="text-align: left" class="text text-danger text-error text-error-message">{{ $message }}</div>
                                @enderror
                                <select class="form-control item__form-profile" name="district" id="form__qh">
                                    <option selected="selected" hidden="hidden">Chọn quận/ huyện</option>
                                    @if(isset($profile_update["DISTRICT_ID"]))
                                        @if(isset($list_district["INFO"]))
                                            @foreach($list_district["INFO"] as $district)
                                                <option
                                                    @if($profile_update["DISTRICT_ID"] == $district["ID"] || old('district') == $district["DISTRICT_NAME"])
                                                    selected
                                                    @endif
                                                    value="{{ $district["ID"] }}">{{ $district["DISTRICT_NAME"] }}</option>
                                            @endforeach
                                        @endif
                                    @endif
                                </select>
                                <input type="hidden"  name="get_id" id="form__name--profile"
                                       value="{{ request()->input('province') }}">
                                <i class="fas fa-caret-down select__caret--profile position-absolute"></i>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="form__lop--profile" class="label__form-profile">Tên lớp</label>
                            <input value="{{ $profile_update["NAME_SCHOOL"] ?? old('level') }}" name="level" type="text" class="form-control item__form-profile" id="form__lop--profile"
                                   placeholder="Tên lớp">
                        </div>
                        <div class="form-group">
                            <label for="form__students--profile" class="label__form-profile">Mã học sinh<span
                                    class="text-danger" style="padding-left: 4px">*</span></label>
                            @error('code')
                            <div style="text-align: left" class="text text-danger text-error text-error-message">{{ $message }}</div>
                            @enderror
                            <input disabled type="text" class="form-control item__form-profile" id="form__students--profile"
                                   placeholder="Mã học sinh" name="code" value="{{ $info_profile["USERNAME"] ?? "" }}">
                        </div>
                        <div class="form-group">
                            <label for="form__email--profile" class="label__form-profile">Email <span
                                    class="text-danger" style="padding-left: 4px"></span></label>
                            <input  name="email" type="email" class="form-control item__form-profile" id="form__email--profile"
                                    value="{{ $profile_update["EMAIL"] ?? old('email') }}"
                                   placeholder="Email ">
                        </div>
                    </div>
                </div>
                <div class="wp__button--profile">
                    <div class="d-flex">
                        <div class=" col-5 col-change-password">
                            <div class="button__change-left d-md-flex mb-3 md-0 justify-content-start">
{{--                                <button class="button__change-item desktop">Đổi mật khẩu</button>--}}
                            </div>
                        </div>
                        <div class="col-7 col-update-profile">
                            <div class="button__active--right d-flex justify-content-end">
{{--                                <button class="button__change-item mobile">Đổi mật khẩu</button>--}}
                                <button type="submit" class="button__change-item bg__profile--update">Cập nhật</button>
                                <a href="{{ route('dashboard') }}" class="button__change-item bg__profile--close text-decoration-none">Đóng</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    <script>
        function preview() {
            thumb.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

    <script>
        $(document).ready(function () {
            $("#form_tp").change(function () {
                let value = $(this).val();
                let data = {value: value}
                $.ajax({
                    url: "{{ route('profile_ajax') }}",
                    data: data,
                    method: 'GET',
                    dataType: 'html',
                    success: function (data) {
                        $("#form__qh").html(data)
                    },
                })
            })
        })
    </script>

    <script>
        $(document).ready(function () {
            $("#form__qh").change(function () {
                let value_qh = $(this).val();
                let data = {value_qh: value_qh}
                $.ajax({
                    url: "{{ route('profile_school') }}",
                    data: data,
                    method: 'GET',
                    dataType: 'html',
                    success: function (data) {
                        $("#form__school").html(data)
                    },
                })
            })
        })
    </script>

@endsection
