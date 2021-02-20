(function(jQuery) {
    "use strict";
    jQuery(document).on('ready', function() {

        /*==============================
        	Mobile Nav
        ================================*/
        jQuery('.menu').slicknav({
            prependTo: ".mobile-nav",
            label: '',
            duration: 500,
            easingOpen: "easeOutBounce",
        });

        /*====================================
        	Slider & Carousel
        ======================================*/
        if (jQuery.fn.slick) {
            jQuery(".home-slider").slick({
                autoplay: false,
                speed: 600,
                autoplaySpeed: 5000,
                slidesToShow: 1,
                pauseOnHover: true,
                dots: false,
                arrows: true,
                cssEase: 'linear',
                animateIn: 'fadeIn',
                animateOut: 'fadeOutLeft',
                draggable: true,
                prevArrow: '<button class="PrevArrow fa fa-angle-left"></button>',
                nextArrow: '<button class="NextArrow fa fa-angle-right"></button>',
                responsive: [{
                    breakpoint: 700,
                    settings: {
                        arrows: false
                    }
                }, ]
            });
        };

        /*====================================
        	Testimonial Slider
        ======================================*/
        jQuery('.testimonial-active').slick({
            autoplay: true,
            autoplaySpeed: 2000,
            speed: 600,
            arrows: false,
            dots: true,
            slidesToScroll: 3,
            centerMode: true,
            centerPadding: '0px',
            slidesToShow: jQuery("#value_jquery_testimoney").val(),
            pauseOnHover: true,
            draggable: true,
            cssEase: 'linear',
            responsive: [
                {
                breakpoint: 780,
                settings: {
                    slidesToShow: 2,
                }
            }, {
                breakpoint: 450,
                settings: {
                    slidesToShow: 1,
                }
            }, ]
        });

        /*====================================
        	News Slider
        ======================================*/
        jQuery('.newsblog-slider').slick({
            autoplay: true,
            autoplaySpeed: 2000,
            speed: 600,
            arrows: false,
            dots: true,
            slidesToScroll: 1,
            slidesToShow: jQuery("#value_jquery_latest-blog").val(),
            pauseOnHover: true,
            draggable: true,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });

        /*====================================
        	News Slider
        ======================================*/
        jQuery('.why-slider').slick({
            autoplay: false,
            autoplaySpeed: 2000,
            speed: 600,
            arrows: false,
            dots: true,
            slidesToScroll: 1,
            slidesToShow: 1,
            pauseOnHover:  true,
            draggable: true,
        });

        /*====================================
            related post
        ======================================*/ 
        jQuery('.related-post-scroll').slick({
            autoplay: true,
            autoplaySpeed: 2000,
            speed: 600,
            arrows: false,
            dots: true,
            slidesToScroll: 2,
            slidesToShow: 3,
            pauseOnHover: true,
            draggable: true,
            responsive: [{
                    breakpoint: 780,
                    settings: {
                        slidesToShow: 3,
                    }
                }, {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 2,
                    }
                }
            ]
        });
        /*====================================
        	Brand Carousel
        ======================================*/
        jQuery('body.home .gallery').slick({
            autoplay: true,
            autoplaySpeed: 2000,
            speed: 600,
            arrows: false,
            slidesToShow: 6,
            slidesToScroll: 1,
            pauseOnHover:  true,
            dots: false,
            draggable: true,
            cssEase: 'linear',
            responsive: [{
                breakpoint: 780,
                settings: {
                    slidesToShow: 4,
                }
            }, {
                breakpoint: 500,
                settings: {
                    slidesToShow: 3,
                }
            }, {
                breakpoint: 340,
                settings: {
                    slidesToShow: 1,
                }
            }, ]
        });

        /*====================================
            Isotop And Masonry Active
        ======================================*/
        jQuery('.isotop-active').masonry({
            // options
            itemSelector: '.grid-item',
        });

        if (jQuery.fn.isotope) {
            var post_no = jQuery('.isotop-active').attr('id');
            console.log(parseInt(post_no));
            jQuery(".isotop-active").isotope({
                filter: function() {
                  return jQuery(this).index() < parseInt(post_no);
                }
            });

            jQuery('.project-nav li').on('click', function() {
                jQuery(".project-nav li").removeClass("active");
                jQuery(this).addClass("active");

                var selector = jQuery(this).attr('data-filter');
                if(selector == '*'){
                   // console.log('test');
                    jQuery(".isotop-active").isotope({
                        filter: function() {
                          return jQuery(this).index() < parseInt(post_no);
                        }
                    });
                }
                else{
                    //console.log('test111');
                    jQuery(".isotop-active").isotope({
                        filter: selector,
                        animationOptions: {
                            duration: 750,
                            easing: 'easeOutCirc',
                            queue: false,
                        }
                    });
                }


                return false;
            });
        }

        /*====================================
        	Counter Js
        ======================================*/
        jQuery('.count').counterUp({
            time: 1000
        });


        /*======================================
        	Wow JS
        ======================================*/
        var window_width = jQuery(window).width();
        if (window_width > 767) {
            new WOW().init();
        }

        /*======================================
        	Parallax JS
        ======================================*/
        jQuery(window).stellar({
            responsive: true,
            positionProperty: 'position',
            horizontalOffset: 0,
            verticalOffset: 0,
            horizontalScrolling: false
        });

        /*=====================================
        	Video Popup
        ======================================*/
        jQuery('.video-popup').magnificPopup({
            type: 'iframe',
            removalDelay: 300,
            mainClass: 'mfp-fade'
        });

        /*====================================
        	Scrool Up
        ======================================*/
        jQuery.scrollUp({
            scrollName: 'scrollUp', // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: 'top', // 'top' or 'bottom'
            scrollSpeed: 1000, // Speed back to top (ms)
            animationSpeed: 200, // Animation speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            scrollTarget: false, // Set a custom target element for scrolling to. Can be element or number
            scrollText: ["<i class='fa fa-long-arrow-up'></i>"], // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
        jQuery('.section-title h2').html(function(i, html) {
            
                var word_length = html.split(' ').length;
                
                if (word_length == 3) {
                    return html.replace(/(\s\w+\s\w+)/, '<span>$1</span>')
                }

                if (word_length == 4) {
                    return html.replace(/(\s\w+\s\w+\s\w+)/, '<span>$1</span>')
                }

                if (word_length == 5) {
                    return html.replace(/(\s\w+\s\w+\s\w+\s\w+)/, '<span>$1</span>')
                }
                if (word_length == 6) {
                    return html.replace(/(\s\w+\s\w+\s\w+\s\w+\s\w+)/, '<span>$1</span>')
                }             
        
        });

        jQuery('.section-title h2 a').html(function(ii, html2) {
            var word_length2 = html2.split(' ').length;
            if (word_length2 == 2) {
                return html2.replace(/(\s\w+)/, '<span>$1</span>')
            }
            if (word_length2 == 3) {
                return html2.replace(/(\s\w+\s\w+)/, '<span>$1</span>')
            }
            if (word_length2 == 4) {
                return html2.replace(/(\s\w+\s\w+\s\w+)/, '<span>$1</span>')
            }
            if (word_length2 == 5) {
                return html2.replace(/(\s\w+\s\w+\s\w+\s\w+)/, '<span>$1</span>')
            }
            if (word_length2 == 6) {
                return html2.replace(/(\s\w+\s\w+\s\w+\s\w+\s\w+)/, '<span>$1</span>')
            }
            if (word_length2 == 7) {
                return html2.replace(/(\s\w+\s\w+\s\w+\s\w+\s\w+\s\w+)/, '<span>$1</span>')
            } 
            if (word_length2 == 8) {
                return html2.replace(/(\s\w+\s\w+\s\w+\s\w+\s\w+\s\w+\s\w+)/, '<span>$1</span>')
            } 
        });
    });
    // Keyboard Navigation
    jQuery(".nav li a").focus(function () {
        jQuery(this).parent('li').children('ul.dropdown').css({"opacity": "1", "visibility": "visible", "transform": "translateY(0px)"});
        jQuery(this).parent('li.menu-item-has-children').children('ul.dropdown').children('li.menu-item-has-children').children('ul').children('li:last-child').focusout(function(){
            jQuery(this).parent('ul').css('visibility', 'hidden');
            jQuery(this).parent('ul').css('opacity', '0');
        });
        jQuery(this).parent('li').children('ul.dropdown').children('li:last-child').not('.menu-item-has-children').focusout(function(){
           jQuery(this).parent('ul').css('visibility', 'hidden');
            jQuery(this).parent('ul').css('opacity', '0');
        });
        jQuery(this).parent('li.menu-item-has-children').children('ul.dropdown').children('li.menu-item-has-children:last-child').children('ul.dropdown').children('li:last-child').focusout(function(){
           jQuery(".dropdown").css('visibility', 'hidden');
            jQuery(".dropdown").css('opacity', '0');
        });
    }); 
    
    // Match Fixing in table
    jQuery('.e-table2:eq(1)').addClass('active');
    var e_table2_length = jQuery('.easy-section .e-table2').length; 
    var e_table2_height_array = [];
    for(var i=0;i< e_table2_length;i++){
        e_table2_height_array.push(jQuery('.easy-section .e-table2 .e-table-list:eq('+i+')').outerHeight()); 
    }

    var e_table2_max_height = Math.max.apply(Math,e_table2_height_array);   
    jQuery('ul.e-table-list').css('height',e_table2_max_height+'px');

    // Match Fixing in double column half image blog
    
    if(jQuery('.newsblog .col-12').hasClass('none'))   {
        jQuery('.alignfull').css('margin-left','-165px');
        jQuery('.alignfull').css('margin-right','-165px');
        jQuery('.alignfull').css('margin-top','15px');
        jQuery('.alignfull').css('margin-bottom','15px');

    }
    

    //Apply matchHeight to each Blog item
   
    jQuery(document).ready(function($) {
        $(function() {
            $('.card').matchHeight();
        });
        
    });
    
})(jQuery);


