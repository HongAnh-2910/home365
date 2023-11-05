@extends('index')
@section('sub_content')
    <div class="section-introduce">
        <div class="section-intro-wrapper d-flex">
            <div class="section-video">
                <iframe class="home-youtube-video w-100" src="https://www.youtube.com/embed/uvUp-PHL8oc?enablejsapi=1&version=3&playerapiid=ytplayer"
                        title="Home365 Youtube Video" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                </iframe>
{{--                <div class="button-action-video">--}}
{{--                    <img src="{{asset('images/vector_play.png')}}" />--}}
{{--                </div>--}}
            </div>
            <div class="section-intro-text">
                <div class="clone-hr"></div>
                <div class="intro-title">Giới thiệu về Home365</div>
                <div class="intro-description">Với sứ mệnh trở thành công cụ hỗ trợ cho học sinh ôn tập và củng cố kiến thức đã học trên lớp, Home365 là ứng dụng học trực tuyến trên nền tảng công nghệ hiện đại với nhiều tính năng vượt trội</div>
                <div class="intro-more-wrapper">
                    <a href="#" class="text-decoration-none btn-intro-more">Xem thêm <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="section-instruction">
        <div class="section-intro-wrapper">
            <div class="instruction-subtitle">
                <img class="d-md-block d-none" src="{{asset('images/home_instruction_img.png')}}" alt="Home Instruction" />
                <img class="d-block d-md-none" src="{{asset('images/home_instruction_mobi.png')}}" alt="Home Intruction Mobile" />
            </div>
            <div class="instruction-title">Vui học mỗi ngày</div>
            <div class="instruction-boxes on-desktop flex-wrap">
                <div class="instruction-card">
                    <div class="instruction-icon">
                        <img src="{{asset('images/icon_book.png')}}" alt="Book Icon" />
                    </div>
                    <div class="instruction-card-title">Chuẩn chương trình SGK</div>
                    <div class="instruction-hr"></div>
                    <div class="instruction-description">
                        Các bài giảng, bài tập của Home365 được biên soạn theo chuẩn chương trình sách giao khoa của Bộ Giáo dục và Đào tạo<span class="more-less">...</span>
                        <span class="more-text">. Nội dung kiến thức được cân đối từ cơ bản đến nâng cao, giúp học sinh củng cố kiến thức một cách vững chắc trong suốt năm học.</span>
                        <br/><a class="text-decoration-none instruction-btn-more" href="#">Xem thêm</a>
                    </div>
                </div>
                <div class="instruction-card">
                    <div class="instruction-icon">
                        <img src="{{asset('images/icon_tv_oclock.png')}}" alt="O'clock Icon" />
                    </div>
                    <div class="instruction-card-title">Ôn tập hằng ngày và luyện thi</div>
                    <div class="instruction-hr"></div>
                    <div class="instruction-description">Kho bài tập được cấu trúc thành 35 tuần học bám sát theo chương trình học ở trường. Học sinh học trên lớp đến đâu, Home365 sẽ giao bài tập đuổi theo đến đó<span class="more-less">...</span>
                        <span class="more-text">. Gần đến kỳ thi, Home365 sẽ giao thêm các đề thi thử, giúp học sinh ôn luyện sẵn sàng cho các kỳ thi.</span>
                        <a class="instruction-btn-more text-decoration-none" href="#">Xem thêm</a></div>
                </div>
                <div class="instruction-card">
                    <div class="instruction-icon">
                        <img src="{{asset('images/icon_head_book.png')}}" alt="Read Book Icon" />
                    </div>
                    <div class="instruction-card-title">Học mà chơi - <br/>chơi mà học</div>
                    <div class="instruction-hr"></div>
                    <div class="instruction-description">Các bài tập được thiết kế sinh động như các trò chơi như Chém hoa quả, Bắt sâu, Giải cứu công chúa, Nối, Sắp xếp, Điền vào chỗ trống<span class="more-less">...</span>
                        <span class="more-text">. Việc tương tác nhiều trong lúc làm bài tập sẽ tạo ra sự hứng khởi, học sinh sẽ không bị nhàm chán như khi làm bài tập trên giấy.</span>
                        <a class="instruction-btn-more text-decoration-none" href="#">Xem thêm</a></div>
                </div>
                <div class="instruction-card">
                    <div class="instruction-icon">
                        <img src="{{asset('images/icon_note.png')}}" alt="Note Icon" />
                    </div>
                    <div class="instruction-card-title">Đánh giá năng lực</div>
                    <div class="instruction-hr"></div>
                    <div class="instruction-description">Khi làm bài tập trên Home365, học sinh sẽ được đánh giá năng lực qua mỗi bài tập được làm. Kết quả thống kê sẽ chỉ ra trình độ của học sinh so<span class="more-less">...</span>
                        <span class="more-text">với các bạn trong lớp, trong trường và trung bình chung của tất cả các học sinh cùng cấp học trên toàn quốc.</span>
                        <br/><a class="instruction-btn-more text-decoration-none" href="#">Xem thêm</a></div>
                </div>
            </div>
        </div>
        <div class="instruction-boxes on-mobile flex-wrap">
                <div class="instruction-card">
                    <div class="instruction-icon">
                        <img src="{{asset('images/icon_book.png')}}" alt="Book Icon" />
                    </div>
                    <div class="instruction-card-title">Chuẩn chương trình SGK</div>
                    <div class="instruction-hr"></div>
                    <div class="instruction-description">
                        Các bài giảng, bài tập của Home365 được biên soạn theo chuẩn chương trình sách giao khoa của Bộ Giáo dục và Đào tạo<span class="more-less">...</span>
                        <span class="more-text">. Nội dung kiến thức được cân đối từ cơ bản đến nâng cao, giúp học sinh củng cố kiến thức một cách vững chắc trong suốt năm học.</span>
                        <br/><a class="text-decoration-none instruction-btn-more" href="#">Xem thêm</a>
                    </div>
                </div>
                <div class="instruction-card">
                    <div class="instruction-icon">
                        <img src="{{asset('images/icon_tv_oclock.png')}}" alt="O'clock Icon" />
                    </div>
                    <div class="instruction-card-title">Ôn tập hằng ngày và luyện thi</div>
                    <div class="instruction-hr"></div>
                    <div class="instruction-description">Kho bài tập được cấu trúc thành 35 tuần học bám sát theo chương trình học ở trường. Học sinh học trên lớp đến đâu, Home365 sẽ giao bài tập đuổi theo đến đó<span class="more-less">...</span>
                        <span class="more-text">. Gần đến kỳ thi, Home365 sẽ giao thêm các đề thi thử, giúp học sinh ôn luyện sẵn sàng cho các kỳ thi.</span>
                        <a class="instruction-btn-more text-decoration-none" href="#">Xem thêm</a></div>
                </div>
                <div class="instruction-card">
                    <div class="instruction-icon">
                        <img src="{{asset('images/icon_head_book.png')}}" alt="Read Book Icon" />
                    </div>
                    <div class="instruction-card-title">Học mà chơi - <br/>chơi mà học</div>
                    <div class="instruction-hr"></div>
                    <div class="instruction-description">Các bài tập được thiết kế sinh động như các trò chơi như Chém hoa quả, Bắt sâu, Giải cứu công chúa, Nối, Sắp xếp, Điền vào chỗ trống<span class="more-less">...</span>
                        <span class="more-text">. Việc tương tác nhiều trong lúc làm bài tập sẽ tạo ra sự hứng khởi, học sinh sẽ không bị nhàm chán như khi làm bài tập trên giấy.</span>
                        <a class="instruction-btn-more text-decoration-none" href="#">Xem thêm</a></div>
                </div>
                <div class="instruction-card">
                    <div class="instruction-icon">
                        <img src="{{asset('images/icon_note.png')}}" alt="Note Icon" />
                    </div>
                    <div class="instruction-card-title">Đánh giá năng lực</div>
                    <div class="instruction-hr"></div>
                    <div class="instruction-description">Khi làm bài tập trên Home365, học sinh sẽ được đánh giá năng lực qua mỗi bài tập được làm. Kết quả thống kê sẽ chỉ ra trình độ của học sinh so<span class="more-less">...</span>
                        <span class="more-text">với các bạn trong lớp, trong trường và trung bình chung của tất cả các học sinh cùng cấp học trên toàn quốc.</span>
                        <br/><a class="instruction-btn-more text-decoration-none" href="#">Xem thêm</a></div>
                </div>
            </div>
    </div>
    <div class="section-featured position-relative">
        <div class="section-intro-wrapper">
            <div class="section-featured-content">
                <div class="clone-hr"></div>
                <div class="featured-title">Các tính năng của Home365</div>
                <div class="featured-sub-title">
                    Với sứ mệnh trở thành công cụ hỗ trợ cho học sinh ôn tập và củng cố kiến thức đã học trên lớp, Home365 là ứng dụng học trực tuyến trên nền tảng công nghệ hiện đại với nhiều tính năng vượt trội:
                </div>
                <div class="featured-boxes">
                    <div class="featured-card first">
                        <div class="featured-icon d-sm-block d-flex justify-content-center">
                            <img src="{{asset('images/giao_bai_quickly.png')}}" alt="Quick Task" />
                        </div>
                        <div class="featured-card-title justify-content-center justify-content-sm-start">Giao bài thông minh</div>
                        <div class="featured-card-text">
                            Bài tập được giao lần lượt theo chương trình trên lớp, học sinh không bị “ngợp” với bài tập quá nhiều.
                        </div>
                    </div>
                    <div class="featured-card second">
                        <div class="featured-icon d-sm-block d-flex justify-content-center">
                            <img src="{{asset('images/auto_score.png')}}" alt="Score Icon" />
                        </div>
                        <div class="featured-card-title justify-content-center justify-content-sm-start">Chấm bài tự động</div>
                        <div class="featured-card-text">
                            Bài được chấm tự động theo từng câu, học sinh biết kết quả ngay khi hoàn thành bài tập.
                        </div>
                    </div>
                    <div class="featured-card third">
                        <div class="featured-icon d-sm-block d-flex justify-content-center">
                            <img src="{{asset('images/note_task.png')}}" alt="Note Task" />
                        </div>
                        <div class="featured-card-title justify-content-center justify-content-sm-start">Nhắc nhở làm bài</div>
                        <div class="featured-card-text">
                            Home365 tự động gửi thông báo xuống điện thoại mỗi khi có bài tập cần làm, giúp học sinh không bị “quên” làm bài.
                        </div>
                    </div>
                    <div class="featured-card fourth">
                        <div class="featured-icon d-sm-block d-flex justify-content-center">
                            <img src="{{asset('images/count_down.png')}}" alt="Count Down" />
                        </div>
                        <div class="featured-card-title justify-content-center justify-content-sm-start">Đồng hồ đếm ngược</div>
                        <div class="featured-card-text">
                            Các bài tập đều có đồng hồ đếm ngược giúp học sinh kiểm soát thời gian và tập trung làm bài.
                        </div>
                    </div>
                    <div class="featured-card fifth">
                        <div class="featured-icon d-sm-block d-flex justify-content-center">
                            <img src="{{asset('images/play_games.png')}}" alt="Play Games" />
                        </div>
                        <div class="featured-card-title justify-content-center justify-content-sm-start">Nhiều trò chơi trí tuệ bổ ích</div>
                        <div class="featured-card-text">
                            Ngoài các môn học, Home365 còn có nhiều trò chơi bổ ích, giúp học sinh tích luỹ thêm các kiến thức thường thức đời sống, IQ, EQ.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="featured-image-after d-sm-block d-none" style="background-image: url({{asset('images/featured-extra.png')}})">
            <img src="{{asset('images/featured-extra.png')}}" alt="Featured Icon" />
        </div>
        <div class="featured-image-after d-block d-sm-none" style="background-image: url({{asset('images/featured-extra-mobi.png')}})">
            <img class="" src="{{asset('images/featured-extra-mobi.png')}}" alt="Featured Mobile Icon" />
        </div>
    </div>

    <div class="section-marquee">
        <div class="section-intro-wrapper">
            <div id="mod_as_scroller" class="d-sm-block d-none">
                <div class="as_marquee" id="as_scroller_191">
                    <a href="#" ><img src="{{asset('images/marquee_1.png')}}" alt="Marquee Slide" style="margin-right:15px;" /></a>
                    <a href="#" ><img src="{{asset('images/marquee_2.png')}}" alt="Marquee Slide" style="margin-right:15px;" /></a>
                    <a href="#" ><img src="{{asset('images/marquee_3.png')}}" alt="Marquee Slide" style="margin-right:15px;" /></a>
                    <a href="#" ><img src="{{asset('images/marquee_4.png')}}" alt="Marquee Slide" style="margin-right:15px;" /></a>
                    <a href="#" ><img src="{{asset('images/marquee_5.png')}}" alt="Marquee Slide" style="margin-right:15px;" /></a>
                    <a href="#" ><img src="{{asset('images/marquee_6.png')}}" alt="Marquee Slide" style="margin-right:15px;" /></a>
                </div>
            </div>
            <div class="marquee-mobile d-flex d-sm-none flex-wrap justify-content-center">
                <a class="image-icon d-flex justify-content-center" href="#" ><img src="{{asset('images/marquee_1.png')}}" alt="Marquee Slide" /></a>
                <a class="image-icon d-flex justify-content-center" href="#" ><img src="{{asset('images/marquee_2.png')}}" alt="Marquee Slide" /></a>
                <a class="image-icon d-flex justify-content-center" href="#" ><img src="{{asset('images/marquee_3.png')}}" alt="Marquee Slide" /></a>
                <a class="image-icon d-flex justify-content-center" href="#" ><img src="{{asset('images/marquee_4.png')}}" alt="Marquee Slide" /></a>
                <a class="image-icon d-flex justify-content-center" href="#" ><img src="{{asset('images/marquee_5.png')}}" alt="Marquee Slide" /></a>
                <a class="image-icon d-flex justify-content-center" href="#" ><img src="{{asset('images/marquee_6.png')}}" alt="Marquee Slide" /></a>
            </div>
        </div>
    </div>
    <div class="section-benefits">
        <div class="section-intro-wrapper">
            <div class="clone-hr"></div>
            <div class="benefit-title">Những lợi ích bạn có khi sử dụng hệ thống của chúng tôi</div>
            <div class="benefit-boxes">
                <div class="benefit-card first">
                    <div class="benefit-card-number"><span class="number-text">1</span></div>
                    <div class="benefit-card-title">HIỆU QUẢ</div>
                    <ul class="benefit-card-text">
                        <li class="text-item mb-3">Củng cố kiến thức vững chắc: bài được giao ngay khi học sinh xong bài giảng trên lớp, học sinh có thể xem lại bài giảng để hiểu rõ hơn trước khi làm bài.</li>
                        <li class="text-item">Đơn giản, dễ tiếp thu: kiến thức bài học được chia nhỏ thành nhiều bài tập, nhiều hình ảnh minh hoạ trực quan, sinh động.</li>
                    </ul>
                </div>

                <div class="benefit-card second">
                    <div class="benefit-card-number"><span class="number-text">2</span></div>
                    <div class="benefit-card-title">THỰC TẾ</div>
                    <ul class="benefit-card-text">
                        <li class="text-item mb-3">Học theo sách giáo khoa: bài tập dựa trên phân phối chương trình của Bộ GĐ&ĐT.</li>
                        <li class="text-item">Đầy đủ ba môn Toán, Tiếng Việt, Tiếng Anh.</li>
                    </ul>
                </div>

                <div class="benefit-card third">
                    <div class="benefit-card-number"><span class="number-text">3</span></div>
                    <div class="benefit-card-title">TIẾT KIỆM</div>
                    <ul class="benefit-card-text">
                        <li class="text-item mb-3">Tiết kiệm thời gian: bài tập được thiết kế dạng “chạm, vuốt” giúp học sinh làm bài nhanh.</li>
                        <li class="text-item">Tiết kiệm chi phí: hầu hết các bài tập của Home365 là miễn phí, phụ huynh không cần tốt nhiều chi phí để mua các sách tham khảo hay các thẻ học online khác.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('home.modal')
@endsection
