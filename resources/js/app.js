require('./bootstrap');
var $ = require('jquery');
require('slick-carousel/slick/slick.min');
require('slick-carousel/slick/slick');


$(document).ready(function () {
    function setHeightForWeb($selector) {
        $selector.each(function (e) {
            if ($(window).height() >= 1024) {
                $(this).css('height', '100vh');
            } else {
                $(this).css('height', 'auto');
            }
        });
    }


    function submitExercise() {
        var getExercise = $('.get_exercise_id');
        var modalResult = $('#modal-result');
        var modalSubmit = $('#modal-submit');
        $('.btn-exercise--submit').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: getExercise.data('url'),
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                data: {
                    'id': getExercise.val(),
                },
                success: function (data) {
                    if (data.message === 200) {
                        console.log(counter)
                        modalResult.addClass('show');
                        modalSubmit.removeClass('show');
                        $('#modal-expired-submit').removeClass('show');
                        $('.result_submit-modal').text(data.currentPoint)
                        $('.time__result--modal').text(data.timeEndExercise)
                        if (counter !== undefined) {
                            clearInterval(counter)
                        }
                        sessionStorage.removeItem('time');
                        sessionStorage.removeItem('duration');
                    } else {
                        alert('Có lỗi xảy ra khi nộp bài, vui lòng thử lại!');
                    }
                }
            })
        })

        $('.end-result-exercise').click(function (){
            var getExercise = $('.get_exercise_id');
            window.location.href = getExercise.attr('data-url2');
        })
    }

    submitExercise()

    function setHeightForDashboard($selector) {
        $selector.each(function (e) {
            if ($(window).height() > 1024) {
                $(this).css('min-height', '100vh');
            } else {
                $(this).css('min-height', '1024px');
            }
        });
    }

    $('.btn-none--active').on('click', function (e) {
        e.preventDefault();
        $('#kitid').val($(this).data('type-id'));
        $('#kitExe').val($(this).data('exe-list'));
        var modalExer = $('#modal-exercise-active');
        modalExer.find('.modal-header .modal-title').text($(this).find('.active-name').val());
        modalExer.find('.modal-body .active-description').text($(this).find('.active-description').val());
        modalExer.find('.modal-body .active-instruction').text($(this).find('.active-description').val());
        modalExer.addClass('show');
    });

    $('.btn-submit--exercise').on('click', function (e) {
        e.preventDefault();
        var modalSubmit = $('#modal-submit');
        modalSubmit.addClass('show');
    });

    //btn-exercise--submit

    // $('.btn-exercise--submit').on('click', function (e) {
    //     e.preventDefault();
    //     var modalSubmit = $('#modal-submit');
    //     var modalExpired = $('#modal-expired-submit');
    //     var modalResult = $('#modal-result');
    //     // modalSubmit.removeClass('show');
    //     // modalResult.addClass('show');
    //     // modalExpired.removeClass('show');
    // });
    //
    // // $('.btn-submit--remake').on('click', function () {
    // //     $(this).addClass('d-none');
    // //     $(this).closest('.mark__checkbox--choose').find('.btn-submit--exercise').removeClass('d-none').addClass('d-inline-block');
    // // });

    $('.btn-start-exercise').on('click', function (e) {
        e.preventDefault();
        if (!sessionStorage.getItem('time')) {
            var thisModal = $('#modal-exercise-active');
            thisModal.find('.modal-body .exercise-grade').text($(this).find('.session-user-class').val() + ' - ' + $(this).find('.detail-name').text());
            thisModal.find('.modal-body .exercise-duration').html('Thời gian làm bài: <span>' + $(this).find('.detail-exe-duration').val() + ' phút</span>');
            thisModal.find('.modal-body .exercise-requirement').text($(this).find('.detail-exe-requirement').val());
            thisModal.find('.input-start--taken').val(JSON.stringify($(this).data('exercise-details')));
            thisModal.find('.input-start--duration').val($(this).find('.input-duration--start').val());
            thisModal.addClass('show');
        } else {
            var thisModal = $('#modal-continue-task');
            thisModal.find('.input-start--taken').val(JSON.stringify($(this).data('exercise-details')));
            thisModal.find('.input-start--duration').val($(this).find('.input-duration--start').val());
            thisModal.addClass('show');
        }
    });

    $('.button__start--exercise').on('click', function (e) {
        e.preventDefault();
        var form = $(this).closest('form');
        sessionStorage.setItem('duration', form.find('.details-duration-week').val());
        count = form.find('.details-duration-week').val();
        let seconds = count % 60;
        let minutes = Math.floor(count / 60);
        let hours = Math.floor(minutes / 60);
        minutes %= 60;
        var times = [hours, minutes, seconds];
        sessionStorage.setItem('time', JSON.stringify(times));
        form.submit();
    });

    $('.btn-exercise--start').on('click', function (e) {
        e.preventDefault();
        var form = $(this).closest('form');

        if (!sessionStorage.getItem('time')) {
            sessionStorage.setItem('duration', $(this).closest('#modal-exercise-active').find('.input-start--duration').val());
            count = $(this).closest('#modal-exercise-active').find('.input-start--duration').val();
            let seconds = count % 60;
            let minutes = Math.floor(count / 60);
            let hours = Math.floor(minutes / 60);
            minutes %= 60;
            var times = [hours, minutes, seconds];

            sessionStorage.setItem('time', JSON.stringify(times));
            form.submit();
        }
    });

    var count = 0;

    $('.btn-exercise--newstart').on('click', function () {
        var form = $(this).closest('form');
        count = $(this).closest('#modal-continue-task').find('.input-start--duration').val();

        let seconds = count % 60;
        let minutes = Math.floor(count / 60);
        let hours = Math.floor(minutes / 60);
        minutes %= 60;
        var times = [hours, minutes, seconds];

        sessionStorage.setItem('time', JSON.stringify(times));
        form.submit();
    });

    function setHeightForListTest($selector) {
        $selector.each(function (e) {
            if ($(window).height() > 1550) {
                $(this).css('min-height', '100vh');
            } else {
                $(this).css('min-height', '1550px');
            }
        });
    }

    // setHeightForDashboard($('.section-dashboard'));
    // setHeightForDashboard($('.section-exercise-type'));
    // setHeightForDashboard($('.section-exercise-type22'));
    setHeightForWeb($('.section-join-now'));
    setHeightForDashboard($('.wp__bg--profile'));
    setHeightForDashboard($('.section-change-class'));
    setHeightForListTest($('.section-list-test'));

    $('#header-icon-bars .item-icon').on('click', function () {
        var parent = $(this).closest('#header-icon-bars');
        var child = parent.find('.mobile-navigation-wrapper');
        if (parent.hasClass('active')) {
            child.slideUp();
            parent.removeClass('active');
            $(this).find('.fas').removeClass('fa-times').addClass('fa-bars');
        } else {
            child.slideDown();
            parent.addClass('active');
            $(this).find('.fas').removeClass('fa-bars').addClass('fa-times');
        }
    });

    function addLoadEvent(func) {
        if (typeof window.addEvent == 'function') {
            window.addEvent('load', function () {
                func()
            });
        } else if (typeof window.onload != 'function') {
            window.onload = func;
        } else {
            var oldonload = window.onload;
            window.onload = function () {
                if (oldonload) {
                    oldonload();
                }

                func();
            }
        }
    }

    addLoadEvent(function () {
        marqueeInit({
            uniqueid: 'as_scroller_191',
            style: {'width': '100%', 'height': '100px'},
            inc: 1,
            mouse: 'pause',
            direction: 'left',
            valign: 'top',
            moveatleast: 1,
            neutral: 0,
            savedirection: true
        });
    });

    $('.instruction-btn-more').on('click', function (e) {
        e.preventDefault();
        if ($(this).parent().hasClass('active')) {
            $(this).parent().removeClass('active');
            $(this).parent().find('.more-text').removeClass('d-inline').addClass('d-none');
            $(this).text('Xem thêm');
            $(this).parent().find('.more-less').removeClass('d-none').addClass('d-inline');
        } else {
            $(this).parent().addClass('active');
            $(this).parent().find('.more-text').removeClass('d-none').addClass('d-inline');
            $(this).text('Ẩn bớt');
            $(this).parent().find('.more-less').removeClass('d-inline').addClass('d-none');
        }
    });

    function carousel(numberOfSlides, width) {
        var boxes = $('.instruction-boxes.on-mobile');
        if (numberOfSlides > 1) {
            boxes.slick({
                slidesToShow: numberOfSlides,
                autoplay: true,
                autoplaySpeed: 2000,
                dots: true,
            });

            boxes.find('.slick-list').removeClass('half-slide');
        } else {
            boxes.slick({
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                dots: true,
            });

            if (width >= 350) {
                boxes.find('.slick-list').addClass('half-slide');
            } else {
                boxes.find('.slick-list').removeClass('half-slide');
            }
        }
    }

    $('.your-class').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        arrows: true,
        prevArrow: ' <div class="button__prev--skill">\n' +
            '                                <i class="fas fa-arrow-left"></i>\n' +
            '                            </div>',

        nextArrow: ' <div class="button__next--skill">\n' +
            '                                <i class="fas fa-arrow-right"></i>\n' +
            '                            </div>',

        responsive: [
            {
                breakpoint: 760,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                }
            },
            {
                breakpoint: 482,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
        ]
    });

    function setNumber($width) {
        var carouselWidth = $width;
        var numberOfSlides = null;
        switch (true) {
            case (carouselWidth > 767):
                numberOfSlides = 3;
                break;
            case (carouselWidth > 575):
                numberOfSlides = 2;
                break;
            case (carouselWidth <= 575):
                numberOfSlides = 1;
                break;
        }

        return numberOfSlides;
    }

    $(window).on('resize', function () {
        var numberSlides = setNumber($(window).width());
        carousel(numberSlides, $(window).width());
        // setHeightForDashboard($('.section-dashboard'));
        // setHeightForDashboard($('.section-exercise-type'));
        // setHeightForDashboard($('.section-exercise-type22'));
        setHeightForWeb($('.section-join-now'));
        setHeightForDashboard($('.wp__bg--profile'));
        setHeightForDashboard($('.section-change-class'));
        setHeightForListTest($('.section-list-test'));

        fixHeightForText();
    });

    $('.section-exercise-type23 .question-boxes .question-card').on('click', function () {
        if (!$(this).hasClass('activated')) {
            $('.section-exercise-type23 .question-boxes .question-card').not(this).removeClass('active-rotate');
            sessionStorage.setItem('rotateText', $(this).find('.card-content').html());
            $(this).addClass('active-rotate');
        }
    });

    $('.section-exercise-type23 .question-boxes .answer-card').on('click', function () {
        var prevWrapper = $(this).parent().find('.question-card.active-rotate');
        if (prevWrapper.length && !$(this).hasClass('activated')) {
            $(this).addClass('activated');
            prevWrapper.addClass('activated');
            $(this).css('background-color', prevWrapper.data('bg-color'));
            // prevWrapper.css('background-color', prevWrapper.data('bg-active'));
            $(this).find('.hidden-data-text1').val(sessionStorage.getItem('rotateText') + '::' + $(this).find('.answer-content').html());
            $('.btn-redo--answer').removeClass('d-none');
        } else {
            // if ($(this).hasClass('activated') && !prevWrapper.hasClass('activated')) {
            //     prevWrapper.css('background-color', prevWrapper.data('bg-color'));
            // }
        }

        sessionStorage.removeItem('rotateText');
        prevWrapper.removeClass('active-rotate');
    });

    $('.btn-redo--answer').on('click', function (e) {
        e.preventDefault();
        location.reload();
    })

    function fixHeightForText() {
        if ($(window).width() < 768) {
            var firstBox = $('.first.answer-card .answer-text-box');
            var secondBox = $('.second.answer-card .answer-text-box');
            var thirdBox = $('.third.answer-card .answer-text-box');
            var forthBox = $('.forth.answer-card .answer-text-box');
            $('.question-answer-text').each(function () {
                var closest = $(this).closest('.question-card');
                if (closest.hasClass('first') && firstBox.length) {
                    firstBox.css('height', $(this).outerHeight());
                }

                if (closest.hasClass('second') && secondBox.length) {
                    secondBox.css('height', $(this).outerHeight());
                }

                if (closest.hasClass('third') && thirdBox.length) {
                    thirdBox.css('height', $(this).outerHeight());
                }

                if (closest.hasClass('forth') && forthBox.length) {
                    forthBox.css('height', $(this).outerHeight());
                }
            });
        } else {
            $('.answer-card .answer-text-box').css('height', 'auto');
        }
    }

    fixHeightForText();

    $('.class-card').on('click', function (e) {
        var child = $(this).find('.img-ticker');
        $('#child-class').val($(this).data('class'));
        $('.img-ticker').not(child).removeClass('d-block');
        child.addClass('d-block');
        $('#child-user').val($(this).find('.input-username').val());
        $('#child-bm').val($(this).find('.input-bm').val());

    });

    $('#btn-change--class').on('click', function () {
        $('#change-class').submit();
    });

    $('#checkbox1').on('change', function () {
        if ($(this).is(':checked')) {
            $('#check--class').val(1);
            $(this).parent().find('.checkbox1-text').addClass('text-success').removeClass('text-danger');
        } else {
            $('#check--class').val(null);
            $(this).parent().find('.checkbox1-text').removeClass('text-success').addClass('text-danger');
        }
    });

    $('.btn-close-section').on('click', function (e) {
        e.preventDefault();
        $(this).closest('.section-session-alert').addClass('d-none');
    })

    carousel(setNumber($(window).width()), $(window).width());

    $('#show-up-modal').on('click', function (e) {
        e.preventDefault();
        var term = $('#modal-term');
        if (term.length) {
            term.addClass('show');
        }
    });

    $('.btn-show--answer').on('click', function (e) {
        e.preventDefault();
        var modalResultText = $('#modal-type23-result');
        if (modalResultText.length) {
            modalResultText.addClass('show');
        }
    });

    var avatarWrapper = $('.avatar-wrapper');

    avatarWrapper.on('click', function (e) {
        // e.preventDefault();
        $(this).find('.avatar-popup').addClass('d-block');
    });

    $('.star-wrapper').on('click', function (e) {
        e.preventDefault();
        $('#dashboard-modal').addClass('show');
    });

    $('.btn-modal-lesson').on('click', function (e) {
        e.preventDefault();
        $('#modal-lesson').addClass('show');
    });

    $('.btn-exercise--active').on('click', function (e) {
        e.preventDefault();
        var btnThis = $(this);
        var child = $('#input-code-active');
        var parent = $(this).closest('.modal-content').find('.section-code-active');
        if (!child.val()) {
            if (!parent.find('.code-error-message').length) {
                parent.append('<div class="code-error-message text-danger mt-1">Vui lòng nhập đúng mã kích hoạt</div>');
            }

            child.focus();
        } else {
            parent.find('.code-error-message').remove();
        }

        $.ajax({
            url: "/kit-active",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: $('#kitid').val(),
                code: child.val(),
                name: btnThis.closest('.modal-content').find('.modal-header .modal-title').text(),
            },
            success: function (data) {
                if (data.ERROR === '0000') {
                    setTimeout(function () {
                            location.href = "/example-details?id=" + $('#kitid').val() + "&ex_lst=" + $('#kitExe').val();
                        },
                        2000);
                } else {
                    if (!parent.find('.code-error-message').length) {
                        parent.append('<div class="code-error-message text-danger mt-1">' + data.RESULT + '</div>');
                    } else {
                        parent.find('.code-error-message').text(data.RESULT);
                    }
                }
            }
        });
    });

    $('#input-code-active').on('keyup', function () {
        var parent = $(this).closest('.section-code-active');
        if ($(this).val()) {
            if (parent.find('.code-error-message').length) {
                parent.find('.code-error-message').remove();
            }
        }
    });

    $(document).on('click', function (e) {
        var modalTerms = '#modal-term .modal-dialog';
        var modalLogin = '#modal-login .modal-dialog';
        var modalDashboard = '#dashboard-modal .modal-dialog';
        var modalError = '#modal-error .modal-dialog';
        var modalLesson = '#modal-lesson .modal-dialog';
        var modalExe = '#modal-exercise-active .modal-dialog';
        var modalSubmit = '#modal-submit .modal-dialog';
        var modalResult = '#modal-result .modal-dialog';
        var modalContinue = '#modal-continue-task .modal-dialog';
        var modalRSText = '#modal-type23-result .modal-dialog';
        if (!$(e.target).closest(modalTerms).length && $(e.target).closest('#modal-term').length) {
            $('#modal-term').removeClass('show');
        }

        if (!$(e.target).closest(modalRSText).length && $(e.target).closest('#modal-type23-result').length) {
            $('#modal-type23-result').removeClass('show');
        }

        if (!$(e.target).closest(modalContinue).length && $(e.target).closest('#modal-continue-task').length) {
            $('#modal-continue-task').removeClass('show');
        }

        if (!$(e.target).closest(modalLogin).length && $(e.target).closest('#modal-login').length) {
            $('#modal-login').removeClass('show');
        }

        if (!$(e.target).closest(modalDashboard).length && $(e.target).closest('#dashboard-modal').length) {
            $('#dashboard-modal').removeClass('show');
        }

        if (!$(e.target).closest(modalError).length && $(e.target).closest('#modal-error').length) {
            $('#modal-error').removeClass('show');
        }

        if (!$(e.target).closest(modalLesson).length && $(e.target).closest('#modal-lesson').length) {
            $('#modal-lesson').removeClass('show');
        }

        if (!$(e.target).closest(modalExe).length && $(e.target).closest('#modal-exercise-active').length) {
            $('#modal-exercise-active').removeClass('show');
        }

        if (!$(e.target).closest(modalSubmit).length && $(e.target).closest('#modal-submit').length) {
            $('#modal-submit').removeClass('show');
        }

        // if (!$(e.target).closest(modalResult).length && $(e.target).closest('#modal-result').length) {
        //     $('#modal-result').removeClass('show');
        // }

        if (!$(e.target).closest(avatarWrapper).length) {
            avatarWrapper.find('.avatar-popup').removeClass('d-block');
        }
    });

    $('.btn-dashboard-close').on('click', function (e) {
        e.preventDefault();
        $(this).closest('#dashboard-modal').removeClass('show');
    });

    $('.btn-close-modal, .btn-modal-error-close').on('click', function (e) {
        e.preventDefault();
        $(this).closest('#modal-term').removeClass('show');
        $(this).closest('#modal-login').removeClass('show');
        $(this).closest('#modal-error').removeClass('show');
        $(this).closest('#modal-lesson').removeClass('show');
        $(this).closest('#modal-exercise-active').removeClass('show');
        $(this).closest('#modal-submit').removeClass('show');
        // $(this).closest('#modal-result').removeClass('show');
        $(this).closest('#modal-continue-task').removeClass('show');
        $(this).closest('#modal-type23-result').removeClass('show');
    });

    $('.btn-login-remove-session, .btn-logout').on('click', function () {
        if (counter !== undefined) {
            clearInterval(counter);
        }
        sessionStorage.removeItem('time');
        sessionStorage.removeItem('duration');
    });

    // $('.button-action-video').click(function(e) {
    //     e.preventDefault();
    //     $('.home-youtube-video')[0].contentWindow.postMessage('{"event":"command","func":"' + 'playVideo' + '","args":""}', '*');
    //     $(this).addClass('d-none');
    // });

    //time

    if (sessionStorage.getItem('time')) {
        var start = JSON.parse(sessionStorage.getItem('time'))
        count = start[0] * 3600 + start[1] * 60 + start[2];
        var counter = setInterval(timer, 1000);
    } else {
        var pathName = window.location.pathname;
        pathName = pathName.replaceAll('/', ' ').trim();
        if (pathName) {
            pathName = pathName.split(' ')[0];
        }

        if (pathName == 'exercise-test-task' || pathName == 'display_exercise') {
            window.location.href = '/dashboard';
        }
    }

    function timer() {
        count = count - 1;
        if (count <= -1) {
            clearInterval(counter);
            count = 0;
            if ($(".hours__time--down").length) {
                var modalExpired = $('#modal-expired-submit');
                modalExpired.addClass('show');
            }
        }
        let seconds = count % 60;
        let minutes = Math.floor(count / 60);
        let hours = Math.floor(minutes / 60);
        minutes %= 60;
        var times = [hours, minutes, seconds];

        sessionStorage.setItem('time', JSON.stringify(times));
        var durationTime = JSON.parse(sessionStorage.getItem('time'))[2];
        if ($(".hours__time--down").length) {
            if (durationTime < 10) {
                $(".hours__time--down").text(minutes + ":" + "0" + seconds ?? JSON.parse(sessionStorage.getItem('time')[1] + ":" + "0" + sessionStorage.getItem('time')[2]));
            } else {
                $(".hours__time--down").text(minutes + ":" + seconds ?? JSON.parse(sessionStorage.getItem('time')[1] + ":" + sessionStorage.getItem('time')[2]));
            }
        }
    }
});


function marqueeInit(config) {
    if (!document.createElement) {
        return;
    }
    marqueeInit.ar.push(config);
    marqueeInit.run(config.uniqueid);
}


(
    function () {
        if (!document.createElement) {
            return;
        }

        marqueeInit.ar = [];

        document.write('<style type="text/css">.as_marquee{white-space:nowrap;overflow:hidden;visibility:hidden;}' +
            '#marq_kill_marg_bord{border:none!important;margin:0!important;}<\/style>');

        var c = 0, tTRE = [new RegExp('^\\s*$'), new RegExp('^\\s*'), new RegExp('\\s*$')],
            req1 = {'position': 'relative', 'overflow': 'hidden'}, defaultconfig = {
                style: {'margin': '0 auto'}
            },
            dash, ie = false, oldie = 0, ie5 = false, iever = 0;

        if (!ie5) {
            dash = new RegExp('-(.)', 'g');

            function toHump(a, b) {
                return b.toUpperCase();
            };
            String.prototype.encamel = function () {
                return this.replace(dash, toHump);
            };
        }


        if (ie && iever < 8) {
            marqueeInit.table = [];
            window.attachEvent('onload', function () {
                marqueeInit.OK = true;
                for (var i = 0; i < marqueeInit.table.length; ++i)
                    marqueeInit.run(marqueeInit.table[i]);
            });
        }


        function intable(el) {
            while ((el = el.parentNode))
                if (el.tagName && el.tagName.toLowerCase() === 'table') {
                    return true;
                }
            return false;
        };


        marqueeInit.run = function (id) {
            if (ie && !marqueeInit.OK && iever < 8 && intable(document.getElementById(id))) {
                marqueeInit.table.push(id);
                return;
            }
            if (!document.getElementById(id)) {
                setTimeout(function () {
                    marqueeInit.run(id);
                }, 300);
            } else {
                new Marq(c++, document.getElementById(id));
            }
        }


        function trimTags(tag) {
            var r = [], i = 0, e;
            while ((e = tag.firstChild) && e.nodeType == 3 && tTRE[0].test(e.nodeValue))
                tag.removeChild(e);
            while ((e = tag.lastChild) && e.nodeType == 3 && tTRE[0].test(e.nodeValue))
                tag.removeChild(e);
            if ((e = tag.firstChild) && e.nodeType == 3) {
                e.nodeValue = e.nodeValue.replace(tTRE[1], '');
            }
            if ((e = tag.lastChild) && e.nodeType == 3) {
                e.nodeValue = e.nodeValue.replace(tTRE[2], '');
            }
            while ((e = tag.firstChild))
                r[i++] = tag.removeChild(e);

            return r;
        }


        function Marq(c, tag) {
            var p, u, s, a, ims, ic, i, marqContent, cObj = this;
            this.mq = marqueeInit.ar[c];

            for (p in defaultconfig)
                if ((this.mq.hasOwnProperty && !this.mq.hasOwnProperty(p)) || (!this.mq.hasOwnProperty && !this.mq[p])) {
                    this.mq[p] = defaultconfig[p];
                }

            this.mq.style.width = !this.mq.style.width || isNaN(parseInt(this.mq.style.width)) ? '100%' : this.mq.style.width;

            if (!tag.getElementsByTagName('img')[0]) {
                this.mq.style.height = !this.mq.style.height || isNaN(parseInt(this.mq.style.height)) ? tag.offsetHeight + 3 + 'px' : this.mq.style.height;
            } else {
                this.mq.style.height = !this.mq.style.height || isNaN(parseInt(this.mq.style.height)) ? 'auto' : this.mq.style.height;
            }

            u = this.mq.style.width.split(/\d/);
            this.cw = this.mq.style.width ? [parseInt(this.mq.style.width), u[u.length - 1]] : ['a'];
            marqContent = trimTags(tag);
            tag.className = tag.id = '';
            tag.removeAttribute('class', 0);
            tag.removeAttribute('id', 0);
            if (ie) {
                tag.removeAttribute('className', 0);
            }

            tag.appendChild(tag.cloneNode(false));
            tag.className = ['as_marquee', c].join('');
            tag.style.overflow = 'hidden';
            this.c = tag.firstChild;
            this.c.appendChild(this.c.cloneNode(false));
            this.c.style.visibility = 'hidden';
            a = [[req1, this.c.style], [this.mq.style, this.c.style]];

            for (i = a.length - 1; i > -1; --i)
                for (p in a[i][0])
                    if ((a[i][0].hasOwnProperty && a[i][0].hasOwnProperty(p)) || (!a[i][0].hasOwnProperty)) {
                        a[i][1][p.encamel()] = a[i][0][p];
                    }

            this.m = this.c.firstChild;
            if (this.mq.mouse == 'pause') {
                this.c.onmouseover = function () {
                    cObj.mq.stopped = true;
                };
                this.c.onmouseout = function () {
                    cObj.mq.stopped = false;
                };
            }

            this.m.style.position = 'absolute';
            this.m.style.left = '-10000000px';
            this.m.style.whiteSpace = 'nowrap';

            if (ie5) {
                this.c.firstChild.appendChild((this.m = document.createElement('nobr')));
            }

            if (!this.mq.noAddedSpace) {
                this.m.appendChild(document.createTextNode('\xa0'));
            }

            for (i = 0; marqContent[i]; ++i)
                this.m.appendChild(marqContent[i]);

            if (ie5) {
                this.m = this.c.firstChild;
            }
            ims = this.m.getElementsByTagName('img');

            if (ims.length) {
                for (ic = 0, i = 0; i < ims.length; ++i) {
                    ims[i].style.display = 'inline';
                    ims[i].style.verticalAlign = ims[i].style.verticalAlign || this.mq.valign;

                    if (typeof ims[i].complete == 'boolean' && ims[i].complete) {
                        ic++;
                    } else {
                        ims[i].onload = function () {
                            if (++ic == ims.length) {
                                cObj.setup();
                            }
                        };
                    }
                    if (ic == ims.length) {
                        this.setup();
                    }
                }
            } else {
                this.setup()
            }
        }

        Marq.prototype.setup = function () {
            if (this.mq.setup) {
                return;
            }
            this.mq.setup = this;
            var s, cObj = this;

            if (this.c.style.height === 'auto') {
                this.c.style.height = this.m.offsetHeight + 4 + 'px';
            }

            this.c.appendChild(this.m.cloneNode(true));
            this.m = [this.m, this.m.nextSibling];
            if (this.mq.mouse == 'cursor driven') {
                this.r = this.mq.neutral || 16;
                this.sinc = this.mq.inc;
                this.c.onmousemove = function (e) {
                    cObj.mq.stopped = false;
                    cObj.directspeed(e)
                };
                if (this.mq.moveatleast) {
                    this.mq.inc = this.mq.moveatleast;
                    if (this.mq.savedirection) {
                        if (this.mq.savedirection == 'reverse') {
                            this.c.onmouseout = function (e) {
                                if (cObj.contains(e)) {
                                    return;
                                }
                                cObj.mq.inc = cObj.mq.moveatleast;
                                cObj.mq.direction = cObj.mq.direction == 'right' ? 'left' : 'right';
                            };
                        } else {
                            this.mq.savedirection = this.mq.direction;
                            this.c.onmouseout = function (e) {
                                if (cObj.contains(e)) {
                                    return;
                                }
                                cObj.mq.inc = cObj.mq.moveatleast;
                                cObj.mq.direction = cObj.mq.savedirection;
                            };
                        }
                    } else {
                        this.c.onmouseout = function (e) {
                            if (!cObj.contains(e)) {
                                cObj.mq.inc = cObj.mq.moveatleast;
                            }
                        };
                    }
                } else {
                    this.c.onmouseout = function (e) {
                        if (!cObj.contains(e)) {
                            cObj.slowdeath();
                        }
                    };
                }
            }

            this.w = this.m[0].offsetWidth - 3;
            this.m[0].style.left = 0;
            this.c.id = 'marq_kill_marg_bord';
            this.m[0].style.top = this.m[1].style.top = Math.floor((this.c.offsetHeight - this.m[0].offsetHeight) / 2 - oldie) + 'px';
            this.c.id = '';
            this.c.removeAttribute('id', 0);
            this.m[1].style.left = this.w + 'px';
            s = this.mq.moveatleast ? Math.max(this.mq.moveatleast, this.sinc) : (this.sinc || this.mq.inc);
            while (this.c.offsetWidth > this.w - s)
                this.c.style.width = isNaN(this.cw[0]) ? this.w - s + 'px' : --this.cw[0] + this.cw[1];
            this.c.style.visibility = 'visible';
            this.runit();
        }


        Marq.prototype.slowdeath = function () {
            var cObj = this;
            if (this.mq.inc) {
                this.mq.inc -= 1;
                this.timer = setTimeout(function () {
                    cObj.slowdeath();
                }, 100);
            }
        }


        Marq.prototype.runit = function () {
            var cObj = this, d = this.mq.direction == 'right' ? 1 : -1;
            if (this.mq.stopped || this.mq.stopMarquee) {
                setTimeout(function () {
                    cObj.runit();
                }, 300);
                return;
            }
            if (this.mq.mouse != 'cursor driven') {
                this.mq.inc = Math.max(1, this.mq.inc);
            }
            if (d * parseInt(this.m[0].style.left) >= this.w) {
                this.m[0].style.left = parseInt(this.m[1].style.left) - d * this.w + 'px';
            }
            if (d * parseInt(this.m[1].style.left) >= this.w) {
                this.m[1].style.left = parseInt(this.m[0].style.left) - d * this.w + 'px';
            }

            this.m[0].style.left = parseInt(this.m[0].style.left) + d * this.mq.inc + 'px';
            this.m[1].style.left = parseInt(this.m[1].style.left) + d * this.mq.inc + 'px';
            setTimeout(function () {
                cObj.runit();
            }, 30 + (this.mq.addDelay || 0));
        }

        Marq.prototype.directspeed = function (e) {
            e = e || window.event;
            if (this.timer) {
                clearTimeout(this.timer);
            }

            var c = this.c, w = c.offsetWidth, l = c.offsetLeft, mp = (typeof e.pageX == 'number' ?
                e.pageX : e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft) - l,
                lb = (w - this.r) / 2, rb = (w + this.r) / 2;
            while ((c = c.offsetParent)) mp -= c.offsetLeft;
            this.mq.direction = mp > rb ? 'left' : 'right';

            this.mq.inc = Math.round((mp > rb ? (mp - rb) : mp < lb ? (lb - mp) : 0) / lb * this.sinc);
        }


        Marq.prototype.contains = function (e) {
            if (e && e.relatedTarget) {
                var c = e.relatedTarget;
                if (c == this.c) {
                    return true;
                }

                while ((c = c.parentNode))
                    if (c == this.c) {
                        return true;
                    }
            }
            return false;
        }

        function resize() {
            for (var s, m, i = 0; i < marqueeInit.ar.length; ++i) {
                if (marqueeInit.ar[i] && marqueeInit.ar[i].setup) {
                    m = marqueeInit.ar[i].setup;
                    s = m.mq.moveatleast ? Math.max(m.mq.moveatleast, m.sinc) : (m.sinc || m.mq.inc);
                    m.c.style.width = m.mq.style.width;
                    m.cw[0] = m.cw.length > 1 ? parseInt(m.mq.style.width) : 'a';
                    while (m.c.offsetWidth > m.w - s)
                        m.c.style.width = isNaN(m.cw[0]) ? m.w - s + 'px' : --m.cw[0] + m.cw[1];
                }
            }
        }

        if (window.addEventListener) {
            window.addEventListener('resize', resize, false);
        } else if (window.attachEvent) {
            window.attachEvent('onresize', resize);
        }

    })();



