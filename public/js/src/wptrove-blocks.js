/* global jQuery, wptroveBlockVariables */
(function( $ ) {
	'use strict';

	$(document).ready(function() {

		function wptroveTestinmonialOverlay( actionType, message, container, complete ){

			if( 'show' == actionType ){

				container.find('.wptrove-testimonials-form-overlay').css({'opacity':0, 'display':'block'}).animate(
					{
						'opacity':1,
					},
					500,
					function(){
						container.find('.wptrove-testimonials-form-overlay-content').css({'opacity':0, 'display':'block'}).animate(
							{
								'opacity':1,
							},
							500,
							function(){
								complete();
							}
						);
					}
			
				);

			}

			if( 'hide' == actionType ){

				container.find('.wptrove-testimonials-form-overlay-content').animate(
					{
						'opacity':0,
					},
					500,
					function(){
						$(this).css({'opacity':1, 'display':'none'});
						container.find('.wptrove-testimonials-form-overlay').animate(
							{
								'opacity':0,
							},
							500,
							function(){
								$(this).css({'opacity':1, 'display':'none'});
							}
						);
					}
				);

			}

		}

		$('.wptrove-testimonials-form-submit__button').on( 'click', function(){

			var wptroveEl = $(this);
			var wptroveElCont = $(this).closest('.wptrove-testimonials-form');
			var wptroveElMessage = wptroveElCont.find('.wptrove-testimonials-form-message');

			wptroveTestinmonialOverlay( 'show', '', wptroveElCont, function(){

				var formData = new FormData();
				formData.append('nonce', wptroveBlockVariables.nonce);

				wptroveEl.closest('.wptrove-testimonials-form-content').find('.wptrove-testimonials-form-item').each(function(){

					var wptroveKey = $(this).attr('data-wptrove-key');
					if( 'photo' === wptroveKey ){
						formData.append(wptroveKey, $(this).find('.wptrove-testimonials-form-item__input--upload')[0].files[0]);
					}else{
						formData.append(wptroveKey, $(this).find('.wptrove-testimonials-form-item__input').val());
					}

				});

				wptroveElMessage.removeAttr('style');
				wptroveElCont.find('.wptrove-testimonials-form-item__message').removeAttr('style');

				jQuery.ajax({

					type: 'POST',
					url: wptroveBlockVariables.api.addTestimonial,
					data: formData,
					enctype: 'multipart/form-data',
					contentType: false,
					processData: false,					
					beforeSend: function (xhr) {
		
						xhr.setRequestHeader('X-WP-Nonce', wptroveBlockVariables.wpRestNonce);
		
					},
					timeout: 10000,
					success: function(jsonData) {
		
						if( jsonData.result ){
							wptroveElMessage.text(wptroveBlockVariables.text.testimonials.success).css({'display':'block'});
						}else{
							//wptroveElMessage.text(wptroveBlockVariables.text.testimonials.failed).css({'display':'block', 'border-color':'red'});
							wptroveEl.closest('.wptrove-testimonials-form-content').find('.wptrove-testimonials-form-item').each(function(){

								var wptroveKey = $(this).attr('data-wptrove-key');
								if ( ( 'data' in jsonData ) && ( 'error' in jsonData.data ) ) {

									if( wptroveKey in jsonData.data.error ){
										$(this).find('.wptrove-testimonials-form-item__message').css({'color':'red'});
									}

								}
			
							});							
						}
						wptroveTestinmonialOverlay( 'hide', '', wptroveElCont, function(){});

					},
					error: function(xhr, status, error) {
						wptroveElMessage.text(wptroveBlockVariables.text.testimonials.failed).css({'display':'block', 'border-color':'red'});
						wptroveTestinmonialOverlay( 'hide', '', wptroveElCont, function(){});
					},
		
				});

			} );

		} );


			$(".wptrove-testimonials-display").owlCarousel({
				'items':1,
				'nav'  :false,
				'autoplay' : true,
				'autoplayHoverPause' : true,
			});

			$(".wptrove-testimonials-two-display").owlCarousel({
				'items':2,
				'nav'  :false,
				'autoplay' : true,
				'autoplayHoverPause' : true,
			});

	
	});

})( jQuery );