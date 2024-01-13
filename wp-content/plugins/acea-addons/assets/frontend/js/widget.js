(function($) {
    "use strict";
    //Creative Button
    var Acea_Creative_Button = function($scope) {
        var btn_wrap = $scope.find('.acea-creative-btn-wrap');
        var magnetic = btn_wrap.data('magnetic');
        var btn = btn_wrap.find('a.acea-creative-btn');
        if ('yes' == magnetic) {
            btn_wrap.on('mousemove', function(e) {
                var x = e.pageX - (btn_wrap.offset().left + (btn_wrap.outerWidth() / 2));
                var y = e.pageY - (btn_wrap.offset().top + (btn_wrap.outerHeight() / 2));
                btn.css("transform", "translate(" + x * 0.3 + "px, " + y * 0.5 + "px)");
            });
            btn_wrap.on('mouseout', function(e) {
                btn.css("transform", "translate(0px, 0px)");
            });
        }
        //For expandable button style only
        var expandable = $scope.find('.acea-eft--expandable');
        var text = expandable.find('.text');
        if (expandable.length > 0 && text.length > 0) {
            text[0].addEventListener("transitionend", function() {
                if (text[0].style.width) {
                    text[0].style.width = "auto";
                }
            });
            expandable[0].addEventListener("mouseenter", function(e) {
                e.currentTarget.classList.add('hover');
                text[0].style.width = "auto";
                var predicted_answer = text[0].offsetWidth;
                text[0].style.width = "0";
                window.getComputedStyle(text[0]).transform;
                text[0].style.width = "".concat(predicted_answer, "px");
            });
            expandable[0].addEventListener("mouseleave", function(e) {
                e.currentTarget.classList.remove('hover');
                text[0].style.width = "".concat(text[0].offsetWidth, "px");
                window.getComputedStyle(text[0]).transform;
                text[0].style.width = "";
            });
        }
    };
    var Acea_Testimonial_Js = function($scope, $) {
        var wrapper = $scope.find(".acea-testimonial-slider");
        if (wrapper.length === 0)
            return;
        var settings = wrapper.data('settings');
        wrapper.slick({
            infinite: true,
            speed: 900,
            slidesToShow: settings['per_coulmn'],
            slidesToScroll: 1,
            autoplay: settings['autoplay'],
            autoplaySpeed: settings['autoplaytimeout'],
            arrows: settings['nav'],
            draggable: settings['mousedrag'],
            dots: settings['dots'],
            lazyLoad: 'ondemand',
            dotsClass: "acea-testimonial-slider-dot-list",
            swipe: true,
            vertical: settings['show_vertical'],
            appendArrows: '.team-slider-arrow',
            prevArrow: $('.prev'),
            nextArrow: $('.next'),
            responsive: [{
                    breakpoint: 1600,
                    settings: {
                        slidesToShow: settings['per_coulmn'],
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: settings['per_coulmn_tablet'],
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: settings['per_coulmn_mobile'],
                        slidesToScroll: 1,
                        vertical: false,
                    },
                },
            ],
        });
    }

    /* Testimonial v2 */

    var Acea_Testimonial_v3_Js = function($scope, $) {
        var wrapper = $scope.find(".acea-testimonial-v3-slider");
        if (wrapper.length === 0)
            return;
        var settings = wrapper.data('settings');
        wrapper.slick({
            infinite: true,
            speed: 900,
            slidesToShow: settings['per_coulmn'],
            slidesToScroll: 1,
            autoplay: settings['autoplay'],
            autoplaySpeed: settings['autoplaytimeout'],
            arrows: settings['nav'],
            draggable: settings['mousedrag'],
            dots: settings['dots'],
            lazyLoad: 'ondemand',
            dotsClass: "acea-testimonial-slider-dot-list",
            swipe: true,
            vertical: settings['show_vertical'],
            appendArrows: '.team-slider-arrow',
            prevArrow: $('.prev'),
            nextArrow: $('.next'),
            responsive: [{
                    breakpoint: 1600,
                    settings: {
                        slidesToShow: settings['per_coulmn'],
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: settings['per_coulmn_tablet'],
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: settings['per_coulmn_mobile'],
                        slidesToScroll: 1,
                        vertical: false,
                    },
                },
            ],
        });
    }


    var aceaModalPopup = function($scope, $) {

        var modalWrapper = $scope.find('.acea-modal').eq(0),
            modalOverlayWrapper = $scope.find('.acea-modal-overlay'),
            modalItem = $scope.find('.acea-modal-item'),
            modalAction = modalWrapper.find('.acea-modal-image-action'),
            closeButton = modalWrapper.find('.acea-close-btn');

        modalAction.on('click', function(e) {
            e.preventDefault();
            var modalOverlay = $(this).parents().eq(1).next();
            var modal = $(this).data('acea-modal');

            var overlay = $(this).data('acea-overlay');
            modalItem.css('display', 'block');
            setTimeout(function() {
                $(modal).addClass('active');
            }, 100);
            if ('yes' === overlay) {
                modalOverlay.addClass('active');
            }

        });

        closeButton.click(function() {
            var modalOverlay = $(this).parents().eq(3).next();
            var modalItem = $(this).parents().eq(2);
            modalOverlay.removeClass('active');
            modalItem.removeClass('active');

            var modal_iframe = modalWrapper.find('iframe'),
                $modal_video_tag = modalWrapper.find('video');

            if (modal_iframe.length) {
                var modal_src = modal_iframe.attr('src').replace('&autoplay=1', '');
                modal_iframe.attr('src', '');
                modal_iframe.attr('src', modal_src);
            }
            if ($modal_video_tag.length) {
                $modal_video_tag[0].pause();
                $modal_video_tag[0].currentTime = 0;
            }

        });

        modalOverlayWrapper.click(function() {
            var overlay_click_close = $(this).data('acea_overlay_click_close');
            if ('yes' === overlay_click_close) {
                $(this).removeClass('active');
                $('.acea-modal-item').removeClass('active');

                var modal_iframe = modalWrapper.find('iframe'),
                    $modal_video_tag = modalWrapper.find('video');

                if (modal_iframe.length) {
                    var modal_src = modal_iframe.attr('src').replace('&autoplay=1', '');
                    modal_iframe.attr('src', '');
                    modal_iframe.attr('src', modal_src);
                }
                if ($modal_video_tag.length) {
                    $modal_video_tag[0].pause();
                    $modal_video_tag[0].currentTime = 0;
                }
            }
        });
    }

    // Blog masonry
    var Acea_addons_blog = function($scope) {
            var wrapper = $scope.find('.masonry')
            if ($.fn.isotope) {
                wrapper.isotope({
                    itemSelector: '.acea-blog-wraper>.masonry>div',
                    percentPosition: true,
                    layoutMode: 'packery',
                })
            }
        }
        // Blog Slider
    var Blog_slider_Js = function($scope) {
            var wrapper = $scope.find(".blog-slider");
            var id = $scope.data('id');
            // console.log(id);
            if (wrapper.length === 0)
                return;
            var settings = wrapper.data('settings');
            wrapper.slick({
                infinite: true,
                speed: 900,
                slidesToShow: settings['per_coulmn'],
                slidesToScroll: 1,
                autoplay: settings['autoplay'],
                autoplaySpeed: settings['autoplaytimeout'],
                arrows: true,
                draggable: settings['mousedrag'],
                dots: settings['dots'],
                centerPadding: '0',
                lazyLoad: 'ondemand',
                centerMode: settings['show_center_mode'],
                dotsClass: "blog-slider-dot-list",
                swipe: false,
                vertical: settings['show_vertical'],
                prevArrow: $('.prev-' + id),
                nextArrow: $('.next-' + id),
                responsive: [{
                        breakpoint: 1600,
                        settings: {
                            slidesToShow: settings['per_coulmn'],
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: settings['per_coulmn_tablet'],
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: settings['per_coulmn_mobile'],
                            slidesToScroll: 1,
                            arrows: false,
                            vertical: false,
                        },
                    },
                ],
            });
        }
        // Main Menu
    var navMenu = function($scope, $) {
            $('.acea-mega-menu').closest('.elementor-container').addClass('megamenu-full-container');
            var count = 0;
            $(".main-navigation ul.navbar-nav>li.acea-mega-menu>.sub-menu>li").each(function(index) {
                count++;
                if ($(this).is('li:last-child')) {
                    $(this).parent().addClass('mg-column-' + count);
                    count = 0;
                }
            });
            $('.main-navigation ul.navbar-nav>li').each(function(i, v) {
                $(v).find('a').contents().wrap('<span class="menu-item-text"/>')
            });
            $(".menu-item-has-children > a").append('<span class="dropdownToggle"><i class="fas fa-angle-down"></i></span>');

            function navMenu() {
                if (jQuery('.acea-main-menu-wrap').hasClass('menu-style-inline')) {
                    if (jQuery(window).width() < 1025) {
                        jQuery('.acea-main-menu-wrap').addClass('menu-style-flyout');
                        jQuery('.acea-main-menu-wrap').removeClass('menu-style-inline');
                    } else {
                        jQuery('.acea-main-menu-wrap').removeClass('menu-style-flyout');
                        jQuery('.acea-main-menu-wrap').addClass('menu-style-inline');
                    }
                    $(window).resize(function() {
                        if (jQuery(window).width() < 1025) {
                            jQuery('.acea-main-menu-wrap').addClass('menu-style-flyout');
                            jQuery('.acea-main-menu-wrap').removeClass('menu-style-inline');
                        } else {
                            jQuery('.acea-main-menu-wrap').removeClass('menu-style-flyout');
                            jQuery('.acea-main-menu-wrap').addClass('menu-style-inline');
                        }
                    })
                }
                // main menu toggleer icon (Mobile site only)
                $('[data-toggle="navbarToggler"]').on("click", function(e) {
                    $('.navbar').toggleClass('active');
                    $('.navbar-toggler-icon').toggleClass('active');
                    $('body').toggleClass('offcanvas--open');
                    e.stopPropagation();
                    e.preventDefault();
                });
                $('.navbar-inner').on("click", function(e) {
                    e.stopPropagation();
                });
                // Remove class when click on body
                $('body').on("click", function() {
                    $('.navbar').removeClass('active');
                    $('.navbar-toggler-icon').removeClass('active');
                    $('body').removeClass('offcanvas--open');
                });
                $('.main-navigation ul.navbar-nav li.menu-item-has-children>a').on("click", function(e) {
                    e.preventDefault();
                    $(this).siblings('.sub-menu').toggle();
                    $('.sub-menu').not($(this).siblings()).hide();
                    $(this).parent('li').addClass('dropdown-active');
                   
                })
            }
            navMenu();
        }
        /*
        *
        This code use Tab Widget
        *
        */
    var aceaTab = function($scope, $) {
        $scope.find('ul.tabs li').on('click', function() {
            var tab_id = $(this).attr('data-tab');
            $scope.find('ul.tabs li').removeClass('current');
            $scope.find('.acea-tab-content-single').removeClass('current');
            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        })
    };


    // animated text script starts
    var aceaAnimatedText = function($scope, $) {
            var animatedWrapper = $scope.find('.acea-typed-strings').eq(0),
                animateSelector = animatedWrapper.find('.acea-animated-text-animated-heading'),
                animationType = animatedWrapper.data('heading_animation'),
                animationStyle = animatedWrapper.data('animation_style'),
                animationSpeed = animatedWrapper.data('animation_speed'),
                typeSpeed = animatedWrapper.data('type_speed'),
                startDelay = animatedWrapper.data('start_delay'),
                backTypeSpeed = animatedWrapper.data('back_type_speed'),
                backDelay = animatedWrapper.data('back_delay'),
                loop = animatedWrapper.data('loop') ? true : false,
                showCursor = animatedWrapper.data('show_cursor') ? true : false,
                fadeOut = animatedWrapper.data('fade_out') ? true : false,
                smartBackspace = animatedWrapper.data('smart_backspace') ? true : false,
                id = animateSelector.attr('id');
            if ('function' === typeof Typed) {
                if ('acea-typed-animation' === animationType) {
                    var typed = new Typed('#' + id, {
                        strings: animatedWrapper.data('type_string'),
                        loop: loop,
                        typeSpeed: typeSpeed,
                        backSpeed: backTypeSpeed,
                        showCursor: showCursor,
                        fadeOut: fadeOut,
                        smartBackspace: smartBackspace,
                        startDelay: startDelay,
                        backDelay: backDelay
                    });
                }
            }
            if ($.isFunction($.fn.Morphext)) {
                if ('acea-morphed-animation' === animationType) {
                    $(animateSelector).Morphext({
                        animation: animationStyle,
                        speed: animationSpeed
                    });
                }
            }
        }
        // price table
    var acea_Addons_Pricing_Table = function($scope, $) {
        $("[data-pricing-trigger]").on("click", function(e) {
                $(e.target).toggleClass("active");
                var target = $(e.target).attr("data-target");
                if ($(target).attr("data-value-active") == "monthly") {
                    $(target).attr("data-value-active", "yearly");
                } else {
                    $(target).attr("data-value-active", "monthly");
                }
            })
            // Classic tab switcher
        $("[data-pricing-tab-trigger]").on("click", function(e) {
            $('[data-pricing-tab-trigger]').removeClass("active");
            $(this).addClass("active");
            var target = $(e.target).attr("data-target");
            if ($(target).attr("data-value-active") == "monthly") {
                $(target).attr("data-value-active", "yearly");
            } else {
                $(target).attr("data-value-active", "monthly");
            }
        })
    }
    var acea_Addons_Tab = function($scope, $) {
        $scope.find('ul.tabs li').on('click', function() {
            var tab_id = $(this).attr('data-tab');
            $scope.find('ul.tabs li').removeClass('current');
            $scope.find('.acea-addons-tab-content-single').removeClass('current');
            $(this).addClass('current');
            $scope.find("#" + tab_id).addClass('current');
        })
        if ($.fn.magnificPopup) {
            $('.acea-addons-elm-edit').magnificPopup({
                type: 'iframe',
                mainClass: 'mfp-fade acea-addons-elm-edit-popup',
                callbacks: {
                    open: function() {
                        // Will fire when this exact popup is opened
                        // this - is Magnific Popup object
                    },
                    close: function() {
                            location.reload();
                        }
                        // e.t.c.
                }
            });
        }
    };

    //  swiper slider

    var swiper = new Swiper(".card-image-slider", {
        effect: "cards",
        loop: true,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true
    });
    var swiperTwo = new Swiper(".card-content-slider", {
        loop: true,
        slidesPerView: 1,
        grabCursor: true,
        thumbs: {
            swiper: swiper
        }
    });

    $("#page").append("<div class='courser-animaion'></div>");
    // Input Show Password
    $(".toggle-password").on("click", function(e) {
        var input = $(this).parent().find("input");

        if (input.attr("type") == "password") {
            input.attr("type", "text");
            $(this).removeClass("fa-eye-slash").addClass("fa-eye");
        } else {
            input.attr("type", "password");
            $(this).removeClass("fa-eye").addClass("fa-eye-slash");
        }
    });

    function makeTimer() {

        var fd_addonsDate = $(".fd-addons-countdown#date").data("date");
        var endTime = new Date(fd_addonsDate);
        endTime = (Date.parse(endTime) / 1000);

        var now = new Date();
        now = (Date.parse(now) / 1000);

        var timeLeft = endTime - now;

        var days = Math.floor(timeLeft / 86400);
        var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
        var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
        var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

        if (hours < "10") {
            hours = "0" + hours;
        }
        if (minutes < "10") {
            minutes = "0" + minutes;
        }
        if (seconds < "10") {
            seconds = "0" + seconds;
        }

        $("#days").html(days);
        $("#hours").html(hours);
        $("#minutes").html(minutes);
        $("#seconds").html(seconds);

    }

    var FD_Addons_CountDown = function() {
        setInterval(function() {
            makeTimer();
        }, 1000);
    }

    var Acea_accordion = function() {
        $(".elementor-accordion-item:first-child").addClass('active');
        $('.elementor-accordion-item').click(function() {
            $('.elementor-accordion-item').removeClass('active');
            $(this).addClass('active');
            return false;
        });
    }

    //portfolio gallery js start
    var Acea_Portfolio_Gallery_Js = function($scope, $) {

        if ($.fn.isotope) {
            var gridMas = $('.acea-pf-gallery-wrap.layout-mode-masonry');

            gridMas.isotope({
                itemSelector: '.acea-pf-gallery-wrap .acea-portfolio-item-wrap',
                percentPosition: true,
                layoutMode: 'packery',
            }).resize();

            gridMas.imagesLoaded().progress(function() {
                gridMas.isotope()
            });
        }



        var wrapper = $scope.find(".acea-pf-gallery-slider");
        if (wrapper.length === 0)
            return;
        var settings = wrapper.data('settings');

        wrapper.slick({
            infinite: settings['loop'],
            speed: 900,
            centerMode: true,
            focusOnSelect: true,
            centerPadding: '260px',
            slidesToShow: settings['per_coulmn'],
            slidesToScroll: 1,
            autoplay: settings['autoplay'],
            autoplaySpeed: settings['autoplaytimeout'],
            arrows: settings['nav'],
            prevArrow: '<button type="button" class="acea-slick-prev">' + settings.prev_icon + '</button>',
            nextArrow: '<button type="button" class="acea-slick-next">' + settings.next_icon + '</button>',
            draggable: settings['mousedrag'],
            dots: settings['dots'],
            lazyLoad: 'ondemand',
            dotsClass: "acea-pf-gallery-slider-dots",
            responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: settings['per_coulmn_tablet'],
                        centerMode: false,
                    },
                },
                {
                    breakpoint: 450,
                    settings: {
                        slidesToShow: settings['per_coulmn_mobile'],
                        centerMode: false,
                    },
                },
            ],
        });




    }

    //portfolio js start
    var Acea_Portfolio_Js = function() {
        if ($.fn.isotope) {

            var $gridMas = $('.acea-portfolio-wrap.layout-mode-masonry');
            var $grid = $('.acea-portfolio-wrap.layout-mode-normal.enable-filter-yes');

            $grid.isotope({
                itemSelector: '.acea-portfolio-item-wrap',
                percentPosition: true,
                layoutMode: 'fitRows',
            }).resize()

            $grid.imagesLoaded().progress(function() {
                $grid.isotope('layout')
            }).resize();

            $gridMas.isotope({
                itemSelector: '.acea-portfolio-item-wrap',
                percentPosition: true,
                layoutMode: 'packery',
            })

            $gridMas.imagesLoaded().progress(function() {
                $gridMas.isotope('layout')
            });

            $grid.isotope().resize();
            $gridMas.isotope().resize();

            $(".pf-isotope-nav li").on('click', function() {
                $(".pf-isotope-nav li").removeClass("active");
                $(this).addClass("active");

                var selector = $(this).attr("data-filter");
                $gridMas.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 750,
                        easing: "linear",
                        queue: false,
                    }
                });

                var selector = $(this).attr("data-filter");
                $grid.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 750,
                        easing: "linear",
                        queue: false,
                    }
                });


            });

        }

        // comment load more button click event
        $('.acea-pf-loadmore-btn').on('click', function() {
            var button = $(this);

            // decrease the current comment page value
            var dpaged = button.data('paged'),
                total_pages = button.data('total-page'),
                nonce = button.data('referrar'),
                ajaxurl = button.data('url');

            dpaged++;
            // console.log(foio_portfolio_js_datas);
            $.ajax({
                url: ajaxurl, // AJAX handler, declared before
                dataType: 'html',
                data: {
                    'action': 'acea_loadmore_callback', // wp_ajax_cloadmore
                    // 'post_id': foio_portfolio_js_datas.parent_post_id, // the current post
                    'paged': dpaged, // current comment page
                    'folio_nonce': nonce,
                    'portfolio_settings': button.data('portfolio-settings'),
                },
                type: 'POST',
                beforeSend: function(xhr) {
                    button.text('Loading...'); // preloader here
                },
                success: function(data) {
                    if (data) {
                        $('.acea-portfolio-wrap').append(data);
                        $('.acea-portfolio-wrap').isotope('reloadItems').isotope()
                        button.text('More projects');
                        button.data('paged', dpaged);
                        // if the last page, remove the button
                        if (total_pages == dpaged)
                            button.remove();
                    } else {
                        button.remove();
                    }
                }
            });
            return false;
        });

    }


    // project

    var Acea_Project_JS = function($scope, $) {
        var wrapper = $scope.find(".projects-slider");
        if (wrapper.length === 0)
            return;
        var settings = wrapper.data('settings');
        wrapper.slick({
            infinite: settings['loop'],
            speed: 900,
            slidesToShow: settings['per_coulmn'],
            slidesToScroll: 1,
            autoplay: settings['autoplay'],
            autoplaySpeed: settings['autoplaytimeout'],
            arrows: settings['nav'],
            draggable: settings['mousedrag'],
            dots: settings['dots'],
            lazyLoad: 'ondemand',
            dotsClass: "project-slider-dot-list",
            swipe: true,
            vertical: settings['show_vertical'],
            appendArrows: '.project-slider-arrow',
            prevArrow: $('.prev'),
            nextArrow: $('.next'),
            responsive: [{
                    breakpoint: 1600,
                    settings: {
                        slidesToShow: settings['per_coulmn'],
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: settings['per_coulmn_tablet'],
                        slidesToScroll: 1,
                    },
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: settings['per_coulmn_mobile'],
                        slidesToScroll: 1,
                        vertical: false,
                    },
                },
            ],
        });
    }
// Services

    var Acea_Services_JS = function($scope, $) {
        var wrapper = $scope.find(".services-mode-slider");
        if (wrapper.length === 0)
            return;
        var settings = wrapper.data('settings');
        wrapper.slick({
            infinite: settings['loop'],
            speed: 900,
            slidesToShow: settings['per_coulmn'],
            slidesToScroll: 1,
            autoplay: settings['autoplay'],
            autoplaySpeed: settings['autoplaytimeout'],
            arrows: settings['nav'],
            draggable: settings['mousedrag'],
            dots: settings['dots'],
            lazyLoad: 'ondemand',
            dotsClass: "project-slider-dot-list",
            swipe: true,
            vertical: settings['show_vertical'],
            appendArrows: '.services-slider-arrow',
            prevArrow: $('.prev'),
            nextArrow: $('.next'),
            // responsive: [{
            //         breakpoint: 1600,
            //         settings: {
            //             slidesToShow: settings['per_coulmn'],
            //             slidesToScroll: 1,
            //         },
            //     },
            //     {
            //         breakpoint: 1025,
            //         settings: {
            //             slidesToShow: settings['per_coulmn_tablet'],
            //             slidesToScroll: 1,
            //         },
            //     },
            //     {
            //         breakpoint: 767,
            //         settings: {
            //             slidesToShow: settings['per_coulmn_mobile'],
            //             slidesToScroll: 1,
            //             vertical: false,
            //         },
            //     },
            // ],
        });
    }
    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/acea-creative-button.default', Acea_Creative_Button);
        elementorFrontend.hooks.addAction("frontend/element_ready/acea-testimonial-loop.default", Acea_Testimonial_Js);
        elementorFrontend.hooks.addAction("frontend/element_ready/acea-testimonial-v3-loop.default", Acea_Testimonial_v3_Js);
        elementorFrontend.hooks.addAction('frontend/element_ready/acea-modal-popup.default', aceaModalPopup);
        elementorFrontend.hooks.addAction("frontend/element_ready/acea-addons-blog.default", Acea_addons_blog);
        elementorFrontend.hooks.addAction("frontend/element_ready/acea-addons-blog.default", Blog_slider_Js);
        elementorFrontend.hooks.addAction("frontend/element_ready/acea-main-menu.default", navMenu);
        elementorFrontend.hooks.addAction("frontend/element_ready/acea-tab.default", aceaTab);
        elementorFrontend.hooks.addAction('frontend/element_ready/acea-animated.default', aceaAnimatedText);
        elementorFrontend.hooks.addAction('frontend/element_ready/acea-addons-price-table.default', acea_Addons_Pricing_Table);
        elementorFrontend.hooks.addAction("frontend/element_ready/acea-portfolio.default", Acea_Portfolio_Js);
        elementorFrontend.hooks.addAction("frontend/element_ready/acea-portfolio-gallery.default", Acea_Portfolio_Gallery_Js);
        elementorFrontend.hooks.addAction('frontend/element_ready/acea-advance-tab.default', acea_Addons_Tab);
        elementorFrontend.hooks.addAction("frontend/element_ready/fd-addons-countdown.default", FD_Addons_CountDown);
        elementorFrontend.hooks.addAction("frontend/element_ready/accordion.default", Acea_accordion);
        elementorFrontend.hooks.addAction("frontend/element_ready/acea-projects.default", Acea_Project_JS);
        elementorFrontend.hooks.addAction("frontend/element_ready/acea-service.default", Acea_Services_JS);
    });
})(jQuery);