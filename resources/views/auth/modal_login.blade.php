<!-- Modal -->
<div class="modal fade {{$errorMessage ? 'show' : ''}}" id="modal-login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog position-relative">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ĐĂNG NHẬP KHÔNG THÀNH CÔNG</h5>
                <button type="button" class="btn-close-modal">
                    <img src="{{asset('images/close-button.svg')}}" />
                </button>
            </div>
            <div class="modal-body">
                <div>{{$errorMessage}}</div>
            </div>
            <div class="modal-footer">
                <a class="btn-close-modal" href="#">Đóng</a>
            </div>
        </div>
    </div>
</div>
