function popupAnnouncement($this) { 
    let closedPopups = [];
    if (sessionStorage.getItem('closedPopups')) {
        closedPopups = JSON.parse(sessionStorage.getItem('closedPopups'));
    }
    
    // if the popup is not in closedPopups Array
    if (closedPopups.indexOf($this.data('popup_id')) == -1) {
        // console.log($this.data('popup_id'));
        $('#' + $this.attr('id')).show();
        let popupDelay = $this.data('popup_delay');

        setTimeout(function() {
            jQuery.magnificPopup.open({
                items: {src: '#' + $this.attr('id')},
                type: 'inline',
                callbacks: {
                    afterClose: function() {
                        // after the popup is closed, store it in the sessionStorage & show next popup
                        closedPopups.push($this.data('popup_id'));
                        sessionStorage.setItem('closedPopups', JSON.stringify(closedPopups));
    
                        // console.log('closed', $this.data('popup_id'));
                        if ($this.next('.popup-wrapper').length > 0) {
                            popupAnnouncement($this.next('.popup-wrapper'));
                        }
                    }
                }
            }, 0);
        }, popupDelay);
    } else {
        if ($this.next('.popup-wrapper').length > 0) {
            popupAnnouncement($this.next('.popup-wrapper'));
        }
    }
}

$(function() {

    "use strict";

    if($(".offer-timer").length > 0){
        $('.offer-timer').each(function() {
            let $this = $(this);
            let d = new Date($this.data('end_date'));
            let ye = parseInt(new Intl.DateTimeFormat('en', {year: 'numeric'}).format(d));
            let mo = parseInt(new Intl.DateTimeFormat('en', {month: 'numeric'}).format(d));
            let da = parseInt(new Intl.DateTimeFormat('en', {day: '2-digit'}).format(d));
            let t = $this.data('end_time');
            let time = t.split(":");
            let hr = parseInt(time[0]);
            let min = parseInt(time[1]);
            $this.syotimer({
                year: ye,
                month: mo,
                day: da,
                hour: hr,
                minute: min,
            });
        });
    }

    

    

    $(window).on('load', function(event) {
        if ($(".popup-wrapper").length > 0) {
            let $firstPopup = $(".popup-wrapper").eq(0);
            popupAnnouncement($firstPopup);
        }

        // isotope initialize
        $('.grid').isotope({
            // set itemSelector so .grid-sizer is not used in layout
            itemSelector: '.single-gallery',
            percentPosition: true,
            masonry: {
                // set to the element
                columnWidth: '.grid-sizer'
            }
        });
    });

    // select2
    $('.select2').select2();


    //===== Sticky

    $(window).on('scroll', function(event) {
        var scroll = $(window).scrollTop();
        if (scroll < 110) {
            $(".navigation").removeClass("sticky");
        } else {
            $(".navigation").addClass("sticky");
        }
    });

    //===== Mobile Menu 

    $(".navbar-toggler").on('click', function() {
        $(this).toggleClass('active');
    });

    $(".navbar-nav a").on('click', function() {
        $(".navbar-toggler").removeClass('active');
    });
    var subMenu = $(".sub-menu-bar .navbar-nav .sub-menu");

    if (subMenu.length) {
        subMenu.parent('li').children('a').append(function() {
            return '<button class="sub-nav-toggler"> <i class="fa fa-plus"></i> </button>';
        });
        subMenu.parent('li').children('a').addClass('hasChildren');

    }

    $("a.hasChildren").on('click', function(e) {
        e.preventDefault();

        if (!$(this).next("ul.sub-menu").hasClass("d-block")) {
            $(this).next("ul.sub-menu").removeClass("d-none");
            $(this).next("ul.sub-menu").addClass("d-block");
        } else if (!$(this).next("ul.sub-menu").hasClass("d-none")) {
            $(this).next("ul.sub-menu").removeClass("d-block");
            $(this).next("ul.sub-menu").addClass("d-none");
        }
    })



    // Single Features Active
    $('.instagram-area').on('mouseover', '.instagram-item', function() {
        $('.instagram-item.active').removeClass('active');
        $(this).addClass('active');
    });



    //===== Isotope Project 1

    $('.container').imagesLoaded(function() {
        var $grid = $('.grid').isotope({
            // options
            transitionDuration: '1s'
        });

        // filter items on button click
        $('.project-menu ul').on('click', 'li', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });

        //for menu active class
        $('.project-menu ul li').on('click', function(event) {
            $(this).siblings('.active').removeClass('active');
            $(this).addClass('active');
            event.preventDefault();
        });
    });

    // Go to Top
    // Scroll Event
    $(window).on('scroll', function() {
        var scrolled = $(window).scrollTop();
        if (scrolled > 300) $('.go-top').addClass('active');
        if (scrolled < 300) $('.go-top').removeClass('active');
    });

    // Click Event
    $('.go-top').on('click', function() {
        $("html, body").animate({
            scrollTop: "0"
        }, 500);
    });



    //===== banner animation slick slider
    function mainSlider() {
        var BasicSlider = $('.banner-slide');
        var BasicSlider2 = $('.banner-slide-2');
        var BasicSlider3 = $('.banner-slide-3');

        BasicSlider.on('init', function(e, slick) {
            var $firstAnimatingElements = $('.banner-area:first-child').find('[data-animation]');
            doAnimations($firstAnimatingElements);
        });
        BasicSlider2.on('init', function(e, slick) {
            var $firstAnimatingElements = $('.banner-area:first-child').find('[data-animation]');
            doAnimations($firstAnimatingElements);
        });
        BasicSlider3.on('init', function(e, slick) {
            var $firstAnimatingElements = $('.banner-area:first-child').find('[data-animation]');
            doAnimations($firstAnimatingElements);
        });
        BasicSlider.on('beforeChange', function(e, slick, currentSlide, nextSlide) {
            var $animatingElements = $('.banner-area[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
            doAnimations($animatingElements);
        });
        BasicSlider2.on('beforeChange', function(e, slick, currentSlide, nextSlide) {
            var $animatingElements = $('.banner-area[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
            doAnimations($animatingElements);
        });
        BasicSlider3.on('beforeChange', function(e, slick, currentSlide, nextSlide) {
            var $animatingElements = $('.banner-area[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
            doAnimations($animatingElements);
        });

        BasicSlider.slick({
            autoplay: true,
            autoplaySpeed: 6000,
            dots: false,
            fade: true,
            arrows: true,
            prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i> </span>',
            nextArrow: '<span class="next"> <i class="fa fa-angle-right"></i></span>',
            rtl: rtl == 1 ? true : false,
            responsive: [

                {
                    breakpoint: 1200,
                    settings: {
                        dots: false,
                        arrows: false
                    }
                }
            ]
        });

        BasicSlider2.slick({
            autoplay: false,
            autoplaySpeed: 10000,
            dots: false,
            fade: true,
            arrows: true,
            prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i> </span>',
            nextArrow: '<span class="next"> <i class="fa fa-angle-right"></i></span>',
            rtl: rtl == 1 ? true : false,
            responsive: [

                {
                    breakpoint: 1200,
                    settings: {
                        dots: false,
                        arrows: false
                    }
                }
            ]
        });
        BasicSlider3.slick({
            autoplay: false,
            autoplaySpeed: 10000,
            dots: false,
            fade: true,
            arrows: true,
            prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i> </span>',
            nextArrow: '<span class="next"> <i class="fa fa-angle-right"></i></span>',
            rtl: rtl == 1 ? true : false,
            responsive: [{
                breakpoint: 1200,
                settings: {
                    dots: false,
                    arrows: false
                }
            }]
        });

        function doAnimations(elements) {
            var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            elements.each(function() {
                var $this = $(this);
                var $animationDelay = $this.data('delay');
                var $animationType = 'animated ' + $this.data('animation');
                $this.css({
                    'animation-delay': $animationDelay,
                    '-webkit-animation-delay': $animationDelay
                });
                $this.addClass($animationType).one(animationEndEvents, function() {
                    $this.removeClass($animationType);
                });
            });
        }
    }
    mainSlider();


    //===== seller Active slick slider
    $('.fress-active').slick({
        dots: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2800,
        arrows: true,
        prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
        nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>',
        speed: 1000,
        slidesToShow: 4,
        slidesToScroll: 1,
        rtl: rtl == 1 ? true : false,
        responsive: [{
                breakpoint: 1201,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });


    $('.special-items').slick({
        dots: false,
        infinite: true,
        autoplay: false,
        autoplaySpeed: 6000,
        arrows: true,
        prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
        nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>',
        speed: 1000,
        slidesToShow: 2,
        slidesToScroll: 1,
        rtl: rtl == 1 ? true : false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
            }
        }]
    });


    //===== seller Active slick slider
    $('.client-active').slick({
        dots: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2800,
        arrows: false,
        speed: 1500,
        slidesToShow: 1,
        slidesToScroll: 1,
        rtl: rtl == 1 ? true : false
    });



    //===== seller Active slick slider
    $('.client-active-2').slick({
        dots: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2800,
        arrows: false,
        speed: 1500,
        slidesToShow: 2,
        slidesToScroll: 1,
        rtl: rtl == 1 ? true : false,
        responsive: [

            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    //===== seller Active slick slider
    $('.team-active').slick({
        dots: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2800,
        arrows: false,
        speed: 1500,
        slidesToShow: 2,
        slidesToScroll: 1,
        rtl: rtl == 1 ? true : false,
        responsive: [

            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });




    //===== seller Active slick slider
    $('.instagram-active').slick({
        dots: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2800,
        arrows: false,
        speed: 1500,
        slidesToShow: 8,
        slidesToScroll: 1,
        rtl: rtl == 1 ? true : false,
        responsive: [{
                breakpoint: 1201,
                settings: {
                    slidesToShow: 7,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 5,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 5,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 3,
                }
            }
        ]
    });



    //===== seller Active slick slider

    $('.shop-thumb').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
        nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>',
        fade: false,
        asNavFor: '.shop-thumb-active',
        rtl: rtl == 1 ? true : false
    });
    $('.shop-thumb-active').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.shop-thumb',
        dots: false,
        centerMode: true,
        arrows: true,
        prevArrow: '<span class="prev"><i class="fa fa-angle-left"></i></span>',
        nextArrow: '<span class="next"><i class="fa fa-angle-right"></i></span>',
        centerPadding: "0",
        focusOnSelect: true,
        rtl: rtl == 1 ? true : false
    });


    // language dropdown toggle on clicking button
    $('.language-btn').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).next('.language-dropdown').toggleClass('open');
    });
    $(document).on('click', function(event) {
        if ($('.language-dropdown').hasClass('open')) {
            $('.language-dropdown').removeClass('open');
        }
    });

    //====== Magnific Popup

    $('.video-popup').magnificPopup({
        type: 'iframe',
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
                console.log('Video popup opened successfully');
            },
            close: function() {
                // Clean up any resources
                console.log('Video popup closed');
            },
            elementParse: function(item) {
                console.log('Parsing video element:', item);
            }
        }
    });

    // Fallback video popup function
    window.openVideoPopup = function(embedUrl, originalUrl) {
        // Try to use Magnific Popup first
        if (typeof $.magnificPopup !== 'undefined') {
            try {
                $.magnificPopup.open({
                    items: {
                        src: embedUrl
                    },
                    type: 'iframe',
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
                    }
                });
                return false; // Prevent default link behavior
            } catch (e) {
                console.log('Magnific Popup failed, using fallback:', e);
            }
        }
        
        // Fallback to custom modal
        var videoId = '';
        if (originalUrl.includes('youtu.be/')) {
            videoId = originalUrl.split('youtu.be/')[1].split('?')[0];
        } else if (originalUrl.includes('youtube.com/watch?v=')) {
            videoId = originalUrl.split('v=')[1].split('&')[0];
        } else if (originalUrl.includes('youtube.com/embed/')) {
            videoId = originalUrl.split('embed/')[1].split('?')[0];
        }
        
        if (videoId) {
            var origin = window.location.origin;
            var fallbackEmbedUrl = 'https://www.youtube.com/embed/' + videoId + '?rel=0&modestbranding=1&origin=' + encodeURIComponent(origin);
            
            // Create custom modal
            var modal = document.createElement('div');
            modal.style.cssText = 'position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.9);z-index:9999;display:flex;align-items:center;justify-content:center;';
            
            var content = document.createElement('div');
            content.style.cssText = 'position:relative;max-width:90%;max-height:90%;';
            
            var iframe = document.createElement('iframe');
            iframe.src = fallbackEmbedUrl;
            iframe.width = '800';
            iframe.height = '450';
            iframe.style.border = 'none';
            iframe.allowFullscreen = true;
            
            var closeBtn = document.createElement('button');
            closeBtn.innerHTML = '×';
            closeBtn.style.cssText = 'position:absolute;top:-40px;right:0;background:none;border:none;color:white;font-size:30px;cursor:pointer;';
            closeBtn.onclick = function() {
                document.body.removeChild(modal);
            };
            
            content.appendChild(closeBtn);
            content.appendChild(iframe);
            modal.appendChild(content);
            document.body.appendChild(modal);
            
            // Close on outside click
            modal.onclick = function(e) {
                if (e.target === modal) {
                    document.body.removeChild(modal);
                }
            };
            
            // Close on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (document.body.contains(modal)) {
                        document.body.removeChild(modal);
                    }
                }
            });
        }
        
        return false; // Prevent default link behavior
    };


    //===== Magnific Popup

    $('.image-popup').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        },
        image: {
            titleSrc: 'title'
        }
    });


    // background video initialization for home 5
    if ($("#bgndVideo").length > 0) {
        $("#bgndVideo").YTPlayer();
    }

    // ripple effect initialization for home 4
    if ($("#waterHome").length > 0) {
        $('#waterHome').ripples({
            resolution: 500,
            dropRadius: 20,
            perturbance: 0.04
        });
    }

    // particles effect initialization for home 3
    if ($("#particles-js").length > 0) {
        particlesJS.load('particles-js', 'public/assets/front/js/particles.json');
    }


    // datepicker & timepicker
    $("#datepicker").datepicker();
    $("input.datepicker").datepicker({
        minDate: 0
    });
    $('input.timepicker').timepicker();


    // subscribe functionality
  
   
    if ($(".subscribeForm").length > 0) {
    
        $(".subscribeForm").each(function() {
            let $this = $(this);

            $this.on('submit', function(e) {
    
                e.preventDefault();
    
                let formId = $this.attr('id');
                let fd = new FormData(document.getElementById(formId));
    
                $.ajax({
                    url: $this.attr('action'),
                    type: $this.attr('method'),
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if ((data.errors)) {
                            $this.find(".err-email").html(data.errors.email[0]);
                        } else {
                            toastr["success"]("You are subscribed successfully!");
                            $this.trigger('reset');
                            $this.find(".err-email").html('');
                        }
                    }
                });
            });
        });
    }

    var $foodItems;


    function initSubcatIsotope() {
        setTimeout(function() {
            $foodItems = $('.food-menu-items').isotope({
                itemSelector: '.single-menu-item',
                layoutMode: 'vertical'
            });
        }, 100);
    }

    initSubcatIsotope();


    $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
        initSubcatIsotope();
        setTimeout(function() {
            let id = $(e.target).attr('href');
            $(id + " button.is-checked").trigger('click');
        }, 200);
        
        
    });

  
    // bind filter button click
    $('.filters-button-group').on( 'click', 'button', function() {
        var filterValue = $( this ).attr('data-filter');
        $foodItems.isotope({ filter: filterValue });
    });
    // change is-checked class on buttons
    $('.button-group').each( function( i, buttonGroup ) {
        var $buttonGroup = $( buttonGroup );
        $buttonGroup.on( 'click', 'button', function() {
        $buttonGroup.find('.is-checked').removeClass('is-checked');
        $( this ).addClass('is-checked');
        });
    });



    //===== WOW js
    new WOW().init();


    // lazy load init
    var lazyLoadInstance = new LazyLoad();



    //===== product quantity

    $(document).on('click', '.add', function() {
        if ($(this).prev().val()) {
            $(this).prev().val(+$(this).prev().val() + 1);
        }
    });
    $(document).on('click', '.sub', function() {
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        }
    });

    //===== 




    $(".dropdown-menu.country-codes a").on('click', function(e) {
        e.preventDefault();

        if ($("input[name='billing_country_code']").length > 0) {
            $("input[name='billing_country_code']").val($(this).data('billing_country_code'));
            $(this).parents('.input-group').find('button.dropdown-toggle').text($(this).data('billing_country_code'));
        }

        if ($("input[name='shpping_country_code']").length > 0) {
            $("input[name='shpping_country_code']").val($(this).data('shpping_country_code'));
            $(this).parents('.input-group').find('button.dropdown-toggle').text($(this).data('shpping_country_code'));
        }
    })

});


$(window).on('load', function(event) {

    //===== Prealoder
    $('#preloader').fadeOut(500);
});

