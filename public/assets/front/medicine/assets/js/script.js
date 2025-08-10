!(function ($) {
    "use strict";

    /*============================================
        Image to background image
    ============================================*/
    var bgImage = $(".bg-img")
    bgImage.each(function () {
        var el = $(this),
            src = el.attr("data-bg-image");

        el.css({
            "background-image": "url(" + src + ")",
            "display": "block",
            "background-repeat": "no-repeat"
        });
    });


    /*============================================
        Tabs mouse hover animation
    ============================================*/
    if ($("[data-hover='fancyHover']").length) {
        $("[data-hover='fancyHover']").mouseHover();
    }


    /*============================================
        Sliders
    ============================================*/
    // Category Slider all
    if($(".category-slider").length) {
        $(".category-slider").each(function () {
            var id = $(this).attr("id");
            var slidePerView = $(this).data("slides-per-view");
            var loops = $(this).data("swiper-loop");
            var sliderId = "#" + id;
    
            // console.log(slidePerView);
    
            var swiper = new Swiper(sliderId, {
                loop: loops,
                spaceBetween: 24,
                speed: 1000,
                autoplay: {
                    delay: 3000,
                },
                slidesPerView: slidePerView,
                pagination: true,
    
                pagination: {
                    el: sliderId + "-pagination",
                    clickable: true,
                },
    
                // Navigation arrows
                navigation: {
                    nextEl: sliderId + "-next",
                    prevEl: sliderId + "-prev",
                },
    
                breakpoints: {
                    320: {
                        slidesPerView: 1
                    },
                    576: {
                        slidesPerView: 2
                    },
                    992: {
                        slidesPerView: 3
                    },
                    1440: {
                        slidesPerView: slidePerView
                    },
                }
            })
        })
    }

    if($("#testimonial-slider-1").length) {
        // Testimonial Slider
        var testimonialSlider1 = new Swiper("#testimonial-slider-1", {
            speed: 1000,
            slidesPerView: 1,
            loop: true,
            grabCursor: true,
            effect: "creative",
            autoplay: {
                delay: 3000,
            },
    
            creativeEffect: {
                prev: {
                    shadow: true,
                    translate: [0, 0, -100],
                },
                next: {
                    translate: ["-100%", 0, 0],
                },
            },
    
            // Pagination bullets
            pagination: {
                el: "#testimonial-slider-1-pagination",
                clickable: true,
            },
        });
    }

    if($("#testimonial-slider-2").length) {
        var testimonialSlider2 = new Swiper("#testimonial-slider-2", {
            speed: 1000,
            slidesPerView: 3,
            spaceBetween: 30,
            loop: true,
            grabCursor: true,
            autoplay: {
                delay: 3000,
            },
    
            // Pagination bullets
            pagination: {
                el: "#testimonial-slider-2-pagination",
                clickable: true,
            },
    
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 1
                },
                // when window width is >= 576px
                768: {
                    slidesPerView: 2
                },
                // when window width is >= 768px
                992: {
                    slidesPerView: 3
                },
            }
        });
    }
    if($("#testimonial-slider-3").length) {
        var testimonialSlider3 = new Swiper("#testimonial-slider-3", {
            speed: 1000,
            loop: true,
            slidesPerView: 'auto',
            autoplay: {
                delay: 3000,
            },
        });
    }
    if($(".testimonial-thumb").length) {
        // Testimonial Slider 3 Thumb
        var testimonialThumb = new Swiper(".testimonial-thumb", {
            speed: 1000,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 3000,
            },
            effect: 'coverflow',
            slidesPerView: 5,
            coverflowEffect: {
                rotate: 0,
                depth: 400,
                slideShadows: false
            },
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 2,
                },
                // when window width is >= 576px
                768: {
                    slidesPerView: 4
                },
                // when window width is >= 768px
                992: {
                    slidesPerView: 5
                },
            }
        });
        // Sync testimonial slider 1
        testimonialSlider3.controller.control = testimonialThumb;
        testimonialThumb.controller.control = testimonialSlider3;
    }
    if($("#testimonial-slider-4").length) {
        var testimonialSlider4 = new Swiper("#testimonial-slider-4", {
            speed: 1000,
            slidesPerView: 2,
            spaceBetween: 30,
            loop: true,
            grabCursor: true,
            autoplay: {
                delay: 3000,
            },
    
            // Pagination bullets
            pagination: {
                el: "#testimonial-slider-4-pagination",
                clickable: true,
            },
    
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 1
                },
                // when window width is >= 576px
                768: {
                    slidesPerView: 2
                }
            }
        });
    }
    if($("#testimonial-slider-5").length) {
        var testimonialSlider5 = new Swiper("#testimonial-slider-5", {
            speed: 1000,
            slidesPerView: 2,
            spaceBetween: 15,
            loop: true,
            grabCursor: true,
            autoplay: {
                delay: 3000,
            },
    
            // Pagination bullets
            pagination: {
                el: "#testimonial-slider-5-pagination",
                clickable: true,
            },
    
            breakpoints: {
                320: {
                    slidesPerView: 1
                },
                576: {
                    slidesPerView: 2
                }
            }
        });
    }
    if($(".gallery-slider").length) {
        // Gallery Slider
        var gallerySlider = new Swiper(".gallery-slider", {
            speed: 1200,
            loop: true,
            centerSlide: true,
            spaceBetween: 2,
            slidesPerView: 3,
            autoplay: {
                delay: 3000,
            },
    
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 1
                },
                // when window width is >= 576px
                576: {
                    slidesPerView: 2
                },
                // when window width is >= 768px
                992: {
                    slidesPerView: 3
                },
            }
    
        });
    }

    // Stop slider autoplay
    $(document).ready(function () {

        if ($(".swiper").length) {
            var mySwiper = document.querySelector(".swiper").swiper

            $(".swiper").mouseenter(function () {
                mySwiper.autoplay.stop();
            });

            $(".swiper").mouseleave(function () {
                mySwiper.autoplay.start();
            });
        }
    });


    /*============================================
        Parallax image
    ============================================*/
    var parallax = $('.parallax');

    parallax.each(function () {
        $(this).mousemove(function (e) {
            var wx = $(window).width();
            var wy = $(window).height();
            var x = e.pageX - this.offsetLeft;
            var y = e.pageY - this.offsetTop;
            var newx = x - wx / 2;
            var newy = y - wy / 2;

            var parallaxChild = $(this).find('.parallax-img');
            parallaxChild.each(function () {
                var speed = $(this).attr('data-speed');
                if ($(this).attr('data-revert')) speed *= -.2;
                TweenMax.to($(this), 1, {
                    x: (1 - newx * speed),
                    y: (1 - newy * speed)
                });
            });
        });
    })


    /*============================================
        Odometer
    ============================================*/
    if($(".counter").length) {
        $(".counter").counterUp({
            delay: 10,
            time: 1000
        });
    }


    /*============================================
        Youtube popup
    ============================================*/
    if ($(".youtube-popup").length) {
        $(".youtube-popup").magnificPopup({
            disableOn: 300,
            type: "iframe",
            mainClass: "mfp-fade",
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
            iframe: {
                patterns: {
                    youtube: {
                        index: 'youtube.com/',
                        id: function(url) {
                            var m = url.match(/[\\?&]v=([^&#]+)/);
                            if (!m) {
                                var m = url.match(/youtu\.be\/([^\/]+)/);
                            }
                            return m ? m[1] : null;
                        },
                        src: function(url) {
                            var videoId = this.id(url);
                            var origin = window.location.origin;
                            return 'https://www.youtube.com/embed/' + videoId + '?rel=0&modestbranding=1&origin=' + encodeURIComponent(origin);
                        }
                    }
                }
            },
            callbacks: {
                beforeOpen: function() {
                    // Add loading indicator
                    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-loading');
                },
                open: function() {
                    // Handle any post-open logic
                },
                close: function() {
                    // Clean up any resources
                }
            }
        })
    }

    /*============================================
        Smart video popup (handles both local and production)
    ============================================*/
    if ($(".smart-video-popup").length) {
        $(".smart-video-popup").on("click", function(e) {
            e.preventDefault();
            var embedUrl = $(this).data('video-url');
            var originalUrl = $(this).data('original-url');
            
            // Try to open with Magnific Popup first
            try {
                $.magnificPopup.open({
                    items: {
                        src: embedUrl
                    },
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
                    fixedContentPos: false,
                    callbacks: {
                        open: function() {
                            // Successfully opened with Magnific Popup
                        },
                        close: function() {
                            // Clean up
                        }
                    }
                });
            } catch (error) {
                // Fallback to custom modal if Magnific Popup fails
                createCustomVideoModal(embedUrl, originalUrl);
            }
        });
    }
    
    function createCustomVideoModal(embedUrl, originalUrl) {
        // Create modal HTML
        var modalHtml = '<div class="custom-video-modal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 9999; display: flex; align-items: center; justify-content: center;">' +
            '<div class="modal-content" style="position: relative; max-width: 90%; max-height: 90%; text-align: center;">' +
            '<button class="close-btn" style="position: absolute; top: -40px; right: 0; background: #fff; border: none; border-radius: 50%; width: 30px; height: 30px; font-size: 18px; cursor: pointer; z-index: 10000;">&times;</button>' +
            '<div class="video-wrapper" style="position: relative;">' +
            '<iframe src="' + embedUrl + '" width="800" height="450" frameborder="0" allowfullscreen style="max-width: 100%; height: auto;"></iframe>' +
            '</div>' +
            '<div class="fallback-links" style="margin-top: 20px; color: white;">' +
            '<p>If the video doesn\'t load, you can:</p>' +
            '<a href="' + originalUrl + '" target="_blank" style="color: #007bff; text-decoration: none; margin: 0 10px;">Open on YouTube</a>' +
            '</div>' +
            '</div></div>';
        
        // Add modal to body
        $('body').append(modalHtml);
        
        // Close button functionality
        $('.close-btn').on('click', function() {
            $('.custom-video-modal').remove();
        });
        
        // Close on background click
        $('.custom-video-modal').on('click', function(e) {
            if (e.target === this) {
                $(this).remove();
            }
        });
        
        // Close on ESC key
        $(document).on('keydown.customVideoModal', function(e) {
            if (e.keyCode === 27) { // ESC key
                $('.custom-video-modal').remove();
                $(document).off('keydown.customVideoModal');
            }
        });
        
        // Handle iframe load errors
        $('.custom-video-modal iframe').on('load', function() {
            // Iframe loaded successfully
        }).on('error', function() {
            // Iframe failed to load, show fallback
            $(this).hide();
            $('.fallback-links').show();
        });
    }


    /*============================================
        Go to top
    ============================================*/
    $(window).on("scroll", function () {
        // If window scroll down .active class will added to go-top
        var goTop = $(".go-top");

        if ($(window).scrollTop() >= 200) {
            goTop.addClass("active");
        } else {
            goTop.removeClass("active")
        }
    })
    $(".go-top").on("click", function (e) {
        $("html, body").animate({
            scrollTop: 0,
        }, 0);
    });


    /*============================================
        Lazyload image
    ============================================*/
    var lazyLoad = function () {
        window.lazySizesConfig = window.lazySizesConfig || {};
        window.lazySizesConfig.loadMode = 2;
        lazySizesConfig.preloadAfterLoad = true;
    }


    /*============================================
        Footer date
    ============================================*/
    var date = new Date().getFullYear();
    $("#footerDate").text(date);


    /*============================================
        Document on ready
    ============================================*/
    $(document).ready(function () {
        lazyLoad()
    })

})(jQuery);

$(window).on("load", function () {
    const delay = 1000;
    /*============================================
        Preloader
    ============================================*/
    $("#preLoader").delay(delay).fadeOut();

    /*============================================
        Aos animation
    ============================================*/
    var aosAnimation = function () {
        AOS.init({
            easing: "ease",
            duration: 1200,
            once: true,
            offset: 60,
            disable: 'mobile'
        });
    }
    if ($("#preLoader")) {
        setTimeout(() => {
            aosAnimation()
        }, delay);
    } else {
        aosAnimation();
    }
})