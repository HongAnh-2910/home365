@extends('parent')
@section('content')
    <div class="section-dashboard section-media-query position-relative">
        @if(session('_error_message'))
{{--            <div class="alert-danger section-session-alert container d-flex justify-content-between align-items-center" style="max-width: 1258px; margin-bottom: 30px; padding: 15px; font-weight: bold;">--}}
{{--                <div>{{session('_error_message')}}</div>--}}
{{--                <div><a class="text-danger btn-close-section" href="#"><i class="fas fa-times"></i></a></div>--}}
{{--            </div>--}}
            @include('modal.modal_error', ['header_error' => 'CÓ LỖI XẢY RA', 'error_message' => session('_error_message')])
        @endif
        <img class="dashboard-bg" src="{{asset('images/dashboard_home.png')}}" />
        <div class="dashboard-content">
            <div class="dashboard-info">
                <div class="dashboard-student-code">MHS:&nbsp;<b>{{$userInfo['USERNAME']}}</b></div>
                <div class="dashboard-student-grade">
                    <div class="item-grade">LỚP: <b>{{$userInfo['LEVEL_ID']}}</b></div>
                    <div class="item-switch-grade">
                        <a class="d-inline-block item-tag" href="{{route('change_class')}}"> <img src="{{asset('images/arrow_switch.png')}}" alt="Switch Grade" /></a>
                    </div>
                </div>
            </div>
            <div class="dashboard-avatar">
                <div class="star-wrapper">
                    <a href="#" class="d-inline-block btn-star-package"><img class="dashboard-content-star" src="{{asset('images/star_icon3.png')}}" alt="Star Star" /></a>
                </div>
                <div class="avatar-wrapper">
                    <a href="#" class="d-inline-block"><img class="dashboard-content-avatar" src="{{asset('images/dashboard_avatar1.png')}}" alt="Dashboard Avatar" /></a>
                    <div class="avatar-popup">
                        <div class="user-info">
                            <div class="popup-wrapper-icon">
                                <img src="{{asset('images/dashboard_avatar1.png')}}" alt="Dashboard Avatar" />
                                <div class="popup-info">
                                    <div class="popup-mhs">MHS: <b>{{$userInfo['USERNAME']}}</b></div>
                                    <div class="btn-wrapper">
                                        <a class="btn--warning" href="{{route('profile')}}">Cập nhật thông tin</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="logout-info">
                            <a href="{{route('auth.logout')}}" class="btn-logout"><img src="{{asset('images/arrow_up_left.png')}}" />&nbsp; Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-boxes justify-content-center">
            <a href="{{ route('week.exercise') }}" class="dashboard-card text-decoration-none">
                <div class="card-icon"><img src="{{asset('images/task_week.png')}}" /></div>
                <div class="card-name">Bài tập tuần</div>
                <div class="card-text">Bài tập được giao lần lượt theo chương trình trên lớp</div>
                <div class="card-after"></div>
            </a>
            <a href="{{route('example_test')}}" class="dashboard-card text-decoration-none">
                <div class="card-icon"><img src="{{asset('images/task_test.png')}}" /></div>
                <div class="card-name">Luyện thi</div>
                <div class="card-text">Bài tập được giao lần lượt theo chương trình trên lớp</div>
                <div class="card-after"></div>
            </a>
            <a href="{{route('lesson.skill')}}" class="dashboard-card text-decoration-none">
                <div class="card-icon"><img src="{{asset('images/task_skills.png')}}" /></div>
                <div class="card-name">Kỹ năng</div>
                <div class="card-text">Bài tập được giao lần lượt theo chương trình trên lớp</div>
                <div class="card-after"></div>
            </a>
        </div>
        <div class="dashboard-download position-relative">
{{--            <div></div>--}}
            <div class="download-buttons">
                <div class="download-title">TẢI APP NGAY</div>
                <div class="download-card">
                    <a class="download-item d-inline-block first" target="_blank" href="https://itunes.apple.com/vn/app/home365/id1457639505">
                        <img src="{{asset('images/dashboard_appst.png')}}" />
                    </a>
                    <a class="download-item d-inline-block" target="_blank" href="https://play.google.com/store/apps/details?id=neo.vn.test365children">
                        <img src="{{asset('images/dashboard_ggplay.png')}}" />
                    </a>
                </div>
            </div>
            <div class="social-card">
                <div class="social-contact">
                    HỖ TRỢ: <a class="contact-number" href="tel: +084 560 0365">084 560 0365</a>
                </div>
                <div class="social-network">
                    <a class="d-inline-block social-item first" style="margin-right: 22px; margin-top: 11px;" target="_blank" href="https://www.facebook.com/home365online/">
                        <img src="{{asset('images/zalo_icon1.png')}}" />
                    </a>
                    <a class="d-inline-block social-item first" style="margin-right: 11px; margin-top: 11px;" target="_blank" href="https://www.facebook.com/home365online/">
                        <img src="{{asset('images/youtube_icon1.png')}}" />
                    </a>
                    <a class="d-inline-block social-item" target="_blank" href="https://www.facebook.com/home365online/">
                        <img src="{{asset('images/facebook_icon.png')}}" />
                    </a>
                    <a class="d-inline-block social-item" target="_blank" href="https://www.facebook.com/groups/2053079854714200/">
                        <img src="{{asset('images/three_person.png')}}" />
                    </a>
                </div>
            </div>
        </div>
        @include('dashboard.package_modal', ['package' => $package, 'descriptions' => $descriptions, 'userInfo' => $userInfo])
    </div>
@endsection
