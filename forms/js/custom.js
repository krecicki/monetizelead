
jQuery(function ($) {
    'use strict';
    /*============================================
     Page Preloader
     ==============================================*/
    $(window).on('load', function () {
        $('#page-loader').fadeOut(500);
    });
    /*============================================
	Accordion
     ==============================================*/
    function toggleIcon(e) {
        $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('ti-minus ti-plus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);
    
    /*============================================
	FAQ
     ==============================================*/
    
    $('.faq-categories a').on('click', function(event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 500);
        $('.faq-categories li').removeClass('active');
        $(this).parent().addClass('active');
    });
     /*============================================
	PARALLAX
     ==============================================*/
    if (!Modernizr.touch) {
        var myParaxify = paraxify('.paraxify');
    }
     /*============================================
	FILE UPLOAD MODIFICATION
     ==============================================*/
    $(function() {
        // We can attach the `fileselect` event to all file inputs on the page
        $(document).on('change', ':file', function () {
            var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        // We can watch for our custom `fileselect` event like this
        $(document).ready(function () {
            $(':file').on('fileselect', function (event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;

                if (input.length) {
                    input.val(log);
                } else {
                    if (log)
                        alert(log);
                }

            });
        });

    });
     /*============================================
	BACK TO TOP
     ==============================================*/
    
    $('#back-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
    /*============================================
	Counter
     ==============================================*/
    if ($('.count').length)
    {
        $('.count').counterUp({
            delay: 10,
            time: 1000
        });
    }
    /*============================================
     MAGNIFIC POPUP
     ==============================================*/
    $(document).ready(function () {
        if ($('.popup-link').length) {
            $('.popup-link').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });
        }

    });
    /*============================================
     OWL CAROUSAL
     ==============================================*/
    if ($('#about-slider').length)
    {
        $("#about-slider").owlCarousel({
            navigation: false, // Show next and prev buttons
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true
        });
    }
    /*============================================
     BACKGROUND SLIDER
     ==============================================*/
    if ($('.slider-bg').length){
        $(function() {
            $('body').vegas({
                slides: [
                    { src: 'images/blog-image.jpg' },
                    { src: 'images/blog-image.jpg' },
                    { src: 'images/blog-image.jpg' }
                ]
            });
        });
    }
    /*============================================
     TEXT ROTATOR
     ==============================================*/
    if($('#text-rotating').length){
        $("#text-rotating").Morphext({
            // The [in] animation type. Refer to Animate.css for a list of available animations.
            animation: "bounceIn",
            // An array of phrases to rotate are created based on this separator. Change it if you wish to separate the phrases differently (e.g. So Simple | Very Doge | Much Wow | Such Cool).
            separator: ",",
            // The delay between the changing of each phrase in milliseconds.
            speed: 4000
        });
    }
    /*============================================
     PARTICLE EFFECTS
     ==============================================*/
    if($('#particles').length) {
        $('#particles').particleground({
            dotColor: 'rgba(255,255,255,0.5)',
            lineColor: 'rgba(255,255,255,0.2)',
            density: 10000
        });
    }
});