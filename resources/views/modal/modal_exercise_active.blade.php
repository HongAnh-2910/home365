<!-- Modal -->
<div class="modal fade" id="modal-exercise-active" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog position-relative">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">LUYỆN THI</h5>
                <button type="button" class="btn-close-modal">
                    <img src="{{asset('images/close-button.svg')}}" />
                </button>
            </div>
            <div class="modal-body">
                <div class="font-weight-bold mb-2 active-description"></div>
                <div class="font-weight-bold active-instruction"></div>
                <div class="section-code-active">
                    <input id="input-code-active" class="input-code" name="codeid" value="" placeholder="Nhập mã kích hoạt" />
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn-exercise--active d-inline-block mr-2">Kích hoạt</a>
                <a class="btn-modal-error-close d-inline-block m-0" href="#">Đóng</a>
            </div>
        </div>
    </div>
</div>
