(function(){

    var gaEvent = function (eventCategory, eventAction, eventLabel, eventValue){
        if (eventValue)
            ga('send', 'event', eventCategory, eventAction, eventLabel, eventValue);
        else
            ga('send', 'event', eventCategory, eventAction, eventLabel);
    };

    // Init global DOM elements, functions and arrays
    window.app 			                   = {el : {}, fn : {}};
    app.el['window']                   = $(window);
    app.el['document']                 = $(document);
    app.el['back-to-top']              = $('.back-to-top');
    app.el['html-body']                = $('html,body');
    app.el['loader']                   = $('#loader');
    app.el['mask']                     = $('#mask');

    app.fn.screenSize = function() {
        var size, width = app.el['window'].width();
        if(width < 320) size = "Not supported";
        else if(width < 480) size = "Mobile portrait";
        else if(width < 768) size = "Mobile landscape";
        else if(width < 960) size = "Tablet";
        else size = "Desktop";
        if (width < 768){$('.animated').removeClass('animated').removeClass('hiding');}
        // $('#screen').html( size + ' - ' + width );
        // console.log( size, width );
    };

    $(function() {
        //Preloader
        app.el['loader'].delay(700).fadeOut();
        app.el['mask'].delay(1200).fadeOut("slow");

        // Resized based on screen size
        app.el['window'].resize(function() {
            app.fn.screenSize();
        });

        // fade in .back-to-top
        $(window).scroll(function () {
            if ($(this).scrollTop() > 500) {
                app.el['back-to-top'].fadeIn();
            } else {
                app.el['back-to-top'].fadeOut();
            }
        });

        // scroll body to 0px on click
        app.el['back-to-top'].click(function () {
            app.el['html-body'].animate({
                scrollTop: 0
            }, 1500);
            return false;
        });

        $('#mobileheader').html($('#header').html());

        function heroInit() {
            var hero        = jQuery('#hero'),
                winHeight   = jQuery(window).height(),
                heroHeight  = winHeight;

            hero.css({height: heroHeight+"px"});
        };

        jQuery(window).on("resize", heroInit);
        jQuery(document).on("ready", heroInit);

        $('.navigation-bar').onePageNav({
            currentClass: 'active',
            changeHash: true,
            scrollSpeed: 750,
            scrollThreshold: 0.5,
            easing: 'swing'
        });

        $('.animated').appear(function(){
            var element = $(this);
            var animation = element.data('animation');
            var animationDelay = element.data('delay');
            if (animationDelay) {
                setTimeout(function(){
                    element.addClass( animation + " visible" );
                    element.removeClass('hiding');
                    if (element.hasClass('counter')) {
                        element.find('.value').countTo();
                    }
                }, animationDelay);
            }else {
                element.addClass( animation + " visible" );
                element.removeClass('hiding');
                if (element.hasClass('counter')) {
                    element.find('.value').countTo();
                }
            }
        },{accY: -150});

        $('#header').waypoint('sticky', {
            wrapper: '<div class="sticky-wrapper" />',
            stuckClass: 'sticky'
        });

        $('#price62').prop('disabled', true);

        $('#guest_type').change(function(){
            if ($(this).val() == 2) {
                $('.nominations-chooser').hide();
                $('#price62').hide();
            } else {
                $('.nominations-chooser').show();
                $('#price62').show();
            }
        });

        $('.fancybox').fancybox();

        $('.form-register').submit(function(e){
            e.preventDefault();

            var $form = $('.form-register'),
                $data = $form.serializeArray();

            $('.alert', $form).removeClass('alert-danger').empty();

            $.ajax({
                url: wp_settings.ajax_url,
                type: 'POST',
                data: $data,
                success: function(json){
                    if (json.error) {
                        alert(json.description);
                        return;
                    }

                    window.location = '/дякуємо-за-реєстрацію/?amount=' + json.amount;
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus);
                }
            });
        });

        $('.col-nomination a').click(function(){
            gaEvent('nomination', 'google_doc', $(this).text());
        });

    });

    // ****** GOOGLE MAP *******
    var map;
    var brooklyn = new google.maps.LatLng(Theme_Options.contact_latitude, Theme_Options.contact_longitude);

    var MY_MAPTYPE_ID = 'custom_style';

    function initialize() {

        var featureOpts = [
            {
                stylers: [
                    { saturation: -20 },
                    { lightness: 40 },
                    { visibility: 'simplified' },
                    { gamma: 0.8 },
                    { weight: 0.4 }
                ]
            },
            {
                elementType: 'labels',
                stylers: [
                    { visibility: 'on' }
                ]
            },
            {
                featureType: 'water',
                stylers: [
                    { color: '#dee8ff' }
                ]
            }
        ];

        var mapOptions = {
            zoom: 14,
            scrollwheel: false,
            panControl: false,
            mapTypeControl: false,
            streetViewControl: false,
            center: new google.maps.LatLng(Theme_Options.contact_latitude, Theme_Options.contact_longitude),
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
            },
            mapTypeId: MY_MAPTYPE_ID
        };

        map = new google.maps.Map(document.getElementById('canvas-map'),mapOptions);
        var image = '/wp-content/themes/s4j/img/pmarker.png';
        var myLatLng = new google.maps.LatLng(Theme_Options.contact_latitude, Theme_Options.contact_longitude);
        var beachMarker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            icon: image
        });
        var styledMapOptions = {
            name: 'Custom Style'
        };

        var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

        map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
    }

    if ($('#canvas-map').length)
        google.maps.event.addDomListener(window, 'load', initialize);

})();

new Vue({
    el: '#app',
});
