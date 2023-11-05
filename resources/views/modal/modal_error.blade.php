<!-- Modal -->
<div class="modal fade {{$error_message ? 'show' : ''}}" id="modal-error" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog position-relative">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$header_error}}</h5>
                <button type="button" class="btn-close-modal">
                    <img src="{{asset('images/close-button.svg')}}" />
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">{!! $error_message !!}</p>
            </div>
            <div class="modal-footer">
                <a class="btn-modal-error-close d-inline-block m-0" href="#">Đóng</a>
            </div>
        </div>
    </div>
</div>
