/* global jQuery */
(function( $ ) {
	'use strict';

	$(function () {

        setInterval(
            function(){

                $(".wptrove-testimonials-display").owlCarousel({
                    'items':1,
                    'nav'  :false,
                    'autoplay' : true,
                    'autoplayHoverPause' : true,
                });
                
                $(".wptrove-testimonials-two-display").each(function(){

                    var wptroveTempWidth = $(this).width();
    
                    if( 600 > wptroveTempWidth ){
                        $(this).owlCarousel({
                            'items':1,
                            'nav'  :false,
                            'autoplay' : true,
                            'autoplayHoverPause' : true,
                        });
                    }else{
                        $(this).owlCarousel({
                            'items':2,
                            'nav'  :false,
                            'autoplay' : true,
                            'autoplayHoverPause' : true,
                        });
                    }



                });

            },
            1000,
        )

    });

})( jQuery );