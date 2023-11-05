<!-- Modal -->
<div class="modal fade" id="modal-type23-result" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog position-relative">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ĐÁP ÁN</h5>
                <button type="button" class="btn-close-modal">
                    <img src="{{asset('images/close-button.svg')}}" />
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center result-content mb-3 align-items-center">{!! str_replace('::', ' -> ', $data["INFO"][$status_url - 1]['HTML_A']) !!}</div>
                <div class="d-flex justify-content-center result-content mb-3 align-items-center">{!! str_replace('::', ' -> ', $data["INFO"][$status_url - 1]['HTML_B']) !!}</div>
                <div class="d-flex justify-content-center result-content mb-3 align-items-center">{!! str_replace('::', ' -> ', $data["INFO"][$status_url - 1]['HTML_C']) !!}</div>
                <div class="d-flex justify-content-center result-content mb-3 align-items-center">{!! str_replace('::', ' -> ', $data["INFO"][$status_url - 1]['HTML_D']) !!}</div>
            </div>
        </div>
    </div>
</div>
