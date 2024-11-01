/* global jQuery, wptroveJsVariables */
//import { wptroveAjaxRequest } from "./general/wptroveAjaxRequest";
import { wptroveOverlay } from "./general/wptroveOverlay";
import { wptroveListPosts } from "./general/wptroveListPosts";
import "./testimonials/index";

(function( $ ) {
	'use strict';

	$(function () {

		wptroveListPosts({'post_type':'wptrove-testimonial','offset':0});

		$('#wptrove-testimonials-settings').on('click', function(){

			var wptroveSectionId = $(this).attr('data-key');
			var wptroveSection = '.wptrove-' + wptroveSectionId + '-container';
			var wptroveSectionName = $(this).text();
			$('.wptrove-admin-main-select__heading').text(wptroveSectionName).attr('data-key', wptroveSectionId);
			$('.wptrove-admin-main-select-options').slideToggle();
			wptroveOverlay('show', 'wait', wptroveJsVariables.labels.wait, function(){

				$('.wptrove-admin-content-inner>div').css({'display':'none'});
				$(wptroveSection).css({'display':'block'});

				wptroveListPosts({'post_type':'wptrove-testimonial','offset':0});
				
			});

		});

		$('.wptrove-admin-content-error__icon').on('click', function(){

			wptroveOverlay( 'hide', 'error', '', function(){} );

		});

		$('.wptrove-admin-content-inner').on('click', '.wptrove-pagination-item', function(){

			if(
				!$(this).hasClass( "wptrove-pagination-item--disabled" ) &&
				!$(this).hasClass( "wptrove-pagination-item--active" )
			){

				var wptroveOffset = 0;
				var wptroveNewOffset = $(this).attr('data-offset');
				var wptrovePagiOffset = parseInt( $(this).closest('.wptrove-pagination').find('.wptrove-pagination-item--active').attr('data-offset'), 10 );
				var wptroveCount = parseInt( $(this).closest('.wptrove-container').attr('data-count'), 10 );
				var wptroveType = $(this).closest('.wptrove-container').attr('data-type');

				if( 'prev' == wptroveNewOffset ){
					wptrovePagiOffset = wptrovePagiOffset - 1;
				}else if( 'next' == wptroveNewOffset ){ 
					wptrovePagiOffset = wptrovePagiOffset + 1;
				}else{
					wptrovePagiOffset = wptroveNewOffset;
				}

				if( (wptrovePagiOffset - 1) < 0 ){
					wptroveOffset = 0;
				}else{
					wptroveOffset = ( (wptrovePagiOffset - 1) * wptroveCount );
				}
				
				wptroveOverlay('show', 'wait', wptroveJsVariables.labels.wait, function(){
					wptroveListPosts({'post_type':wptroveType,'offset':wptroveOffset});
				});

			}

		});

		$('.wptrove-admin-select__icon').on('click', function(){

			$(this).siblings('.wptrove-admin-select-options').slideToggle();

		});

		$('.wptrove-admin-content').on('click', '.wptrove-button', function(){

			$(this).find('.wptrove-button-overlay').css({'opacity':0, 'display':'block'}).animate(
				{
					'opacity':1,
				},1000,
				function(){

				}
			);

		});
		
	});

})( jQuery );