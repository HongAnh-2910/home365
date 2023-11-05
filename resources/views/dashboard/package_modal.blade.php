<div class="modal fade" id="dashboard-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog position-relative">
        <div class="modal-content">
            <div class="modal-body">
                <div class="title1">Bạn đã đăng ký</div>
                <div class="title2">{{$package['SERVICE_NAME'] ?? ''}}</div>
                <div class="title1">Quyền lợi gói dịch vụ</div>
                <ul class="list1">
                    @if(count($descriptions) == 1)
                        <li class="text1">Mở khóa toàn bộ các đề luyện thi, các môn Toán, Tiếng Việt, Tiếng Anh, trên hệ thống</li>
                    @else
                        @foreach($descriptions as $key => $item)
                            @if($key == count($descriptions) - 1)
                                <li class="text1">Mở khóa toàn bộ các đề luyện thi, các môn Toán, Tiếng Việt, Tiếng Anh, trên hệ thống</li>
                            @else
                                <li class="text1 mb-2">Được sử dụng tất cả nội dung bài tập vui chơi kỹ năng và ứng dụng Home 365</li>
                            @endif
                        @endforeach
                    @endif
                </ul>
                <div class="d-flex justify-content-between">
                    <div class="title1">Thời hạn sử dụng:</div>
                    <div class="text2">{{$package['USER_EXPIRE_TIME'] ?? ''}}</div>
                </div>

                @if(! $userInfo['IS_VIP'])
                    <div class="text3 m-0 mb-2 mb-md-0 wrapper1">Tài khoản của bạn đã hết thời hạn sử dụng gói {{$userInfo['VIP_NAME']}}. Mời bạn mua gói để sử dụng dịch vụ với nhiều ưu đãi</div>
                @endif
            </div>
            <div class="modal-footer justify-content-between">
                <div class="w-100 m-0 d-flex justify-content-end">
                    <a class="btn-buy-now d-inline-block my-0 mx-3" href="{{route('list_services')}}">Mua gói</a>
                    <a class="btn-dashboard-close d-inline-block m-0" href="#">Đóng</a>
                </div>
            </div>
        </div>
    </div>
</div>
