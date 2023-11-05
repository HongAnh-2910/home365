




<div class="modal-header">
    <div class="modal-title modal_title--lesson" id="exampleModalLongTitle">Mở rộng vốn từ tiếng Anh</div>
    <button type="button" class="close close_lesson" data-dismiss="modal" aria-label="Close">
        <span class="icon__lesson" aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body p-0 modal-body--code">
    <div class="wp__modal-lesson">
        <div class="view__lesson d-flex align-items-center">
            <div class="img__view--lesson">
                <img src="{{ asset("images/eye.png") }}">
            </div>
            <span class="total_view-lesson">223 lượt xem</span>
        </div>
        <div class="info__different--lesson">
            <div class="info__different-1">
                Nhà cung cấp: <span class="info__different-no">Không</span>
            </div>
            <div class="info__different-1">
                Giảng viên: <span class="info__different-no">Thầy Vinh</span>
            </div>
        </div>
        <p class="content__lesson--text">Khoá học bao gồm rất nhiều bài học từ vựng và câu đơn giản theo chủ đề với hình ảnh minh hoạ
            sinh động và phát âm chuẩn bản ngữ giúp học sinh mở rộng vốn từ một cách nhanh chóng. Không
            cần vội vàng, phụ huynh cho các con học mỗi ngày một chủ đề, học đi học lại để nhớ được từ
            gắn với hình ảnh tương ứng.</p>
        <ul class="wp_youtube-lesson">
            <li class="item_youtube--lesson d-flex">
                <div class="img__item--video">
                    <img src="{{ asset("images/img_video_youtube.png") }}">
                </div>
                <div class="wp__link-lesson d-flex align-items-center">
                    <div class="img__item--right">
                        <div class="title__item--right">
                            Mở rộng vốn từ tiếng Anh
                        </div>
                        <div class="title__item--s">
                            5.1
                        </div>
                    </div>
                </div>
            </li>
            <li class="item_youtube--lesson d-flex">
                <div class="img__item--video">
                    <img src="{{ asset("images/img_video_youtube.png") }}">
                </div>
                <div class="wp__link-lesson d-flex align-items-center">
                    <div class="img__item--right">
                        <div class="title__item--right">
                            Mở rộng vốn từ tiếng Anh
                        </div>
                        <div class="title__item--s">
                            5.1
                        </div>
                    </div>
                </div>
            </li>
            <li class="item_youtube--lesson d-flex">
                <div class="img__item--video">
                    <img src="{{ asset("images/img_video_youtube.png") }}">
                </div>
                <div class="wp__link-lesson d-flex align-items-center">
                    <div class="img__item--right">
                        <div class="title__item--right">
                            Mở rộng vốn từ tiếng Anh
                        </div>
                        <div class="title__item--s">
                            5.1
                        </div>
                    </div>
                </div>
            </li>
            <li class="item_youtube--lesson d-flex">
                <div class="img__item--video">
                    <img src="{{ asset("images/img_video_youtube.png") }}">
                </div>
                <div class="wp__link-lesson d-flex align-items-center">
                    <div class="img__item--right">
                        <div class="title__item--right">
                            Mở rộng vốn từ tiếng Anh
                        </div>
                        <div class="title__item--s">
                            5.1
                        </div>
                    </div>
                </div>
            </li>
            <li class="item_youtube--lesson d-flex">
                <div class="img__item--video">
                    <img src="{{ asset("images/img_video_youtube.png") }}">
                </div>
                <div class="wp__link-lesson d-flex align-items-center">
                    <div class="img__item--right">
                        <div class="title__item--right">
                            Mở rộng vốn từ tiếng Anh
                        </div>
                        <div class="title__item--s">
                            5.1
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>

</div>
<div class="modal-footer mt-3">
</div>


<script>
    $(document).ready(function (){
        $('.item_youtube--lesson').click(function (){
            $.ajax({
                url: "{{ route('video.ajax') }}",
                method: 'GET',
                dataType: 'html',
                success: function (data) {
                    $('.wp_youtube-lesson').html(data)
                },
            })
            // $('#exampleModalCenter').modal();
        })
    })
</script>

