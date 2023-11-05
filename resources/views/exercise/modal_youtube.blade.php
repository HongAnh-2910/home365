<!-- Modal -->
<div class="modal fade" id="modal-lesson-youtube" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog position-relative">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bài giảng trực tuyến</h5>
                {{--                <button type="button" class="btn-close-modal">--}}
                {{--                    <img src="{{asset('images/close-button.svg')}}" />--}}
                {{--                </button>--}}
            </div>
            <div class="modal-body">
                <iframe style="width: 100%; min-height: 490px;" src="{{str_replace('https://www.youtube.com/watch?v=','https://www.youtube.com/embed/', $links)}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="modal-footer justify-content-center">
                <button data-dismiss="modal" class="btn-modal-error-close d-inline-block m-0 border-0 text-white btn-warning px-5 py-2" href="#">Đóng</button>
            </div>
        </div>
    </div>
</div>
