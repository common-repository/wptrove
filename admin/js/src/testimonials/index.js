/* global jQuery, wptroveJsVariables */
import { wptroveOverlay } from "../general/wptroveOverlay"
import { wptroveListPosts } from "../general/wptroveListPosts";
import { wptroveButtonOverlay } from "../general/wptroveButtonOverlay";
import { wptroveAjaxRequest } from "../general/wptroveAjaxRequest";

jQuery(function(){

    jQuery('.wptrove-testimonials-selector .wptrove-admin-select-options__item').on('click', function(){

        var newStatusKey = jQuery(this).attr('data-key');
        var newStatusText = jQuery(this).text();
    
        jQuery(this).closest('.wptrove-admin-select').find('.wptrove-admin-select__heading').attr('data-status', newStatusKey).text(newStatusText);
        jQuery(this).closest('.wptrove-admin-select-options').slideToggle();
        wptroveOverlay('show', 'wait', wptroveJsVariables.labels.wait, function(){
    
            wptroveListPosts({'post_type':'wptrove-testimonial','offset':0});
            
        });
    
    });

    jQuery('.wptrove-testimonials-list').on('click', '.wptrove-testimonial-item__title', function(){

        jQuery(this).siblings('.wptrove-testimonial-item-content').slideToggle();

    });

    jQuery('.wptrove-admin-content').on('click', '.wptrove-testimonial-item-approve', function(){

        var wptroveEl = jQuery(this);
        var wptroveId = jQuery(this).closest('.wptrove-testimonial-item').attr('data-key');
        var wptroveError = jQuery(this).closest('.wptrove-testimonial-item-actions').find('.wptrove-testimonial-item-error');

        wptroveError.text('');

        wptroveButtonOverlay('show', wptroveEl, function(){

            wptroveAjaxRequest(
                {
                    'sendData': {'action': 'approve', 'id': wptroveId},
                    'url': wptroveJsVariables.api.admin.moderate,
                }, 
                function(jsonData){

                    if( 
                        Object.prototype.hasOwnProperty.call(jsonData, "result") &&
                        jsonData.result
                    ){
                        wptroveEl.animate(
                            {
                                'opacity':0,
                            },1000,
                            function(){
                                jQuery(this).animate(
                                    {
                                        'width':0,
                                    },1000,
                                    function(){
                                        jQuery(this).remove();
                                    }
                                );
                            }
                        );
                    }else{
                        wptroveError.text(wptroveJsVariables.labels.errory);
                        wptroveButtonOverlay('hide', wptroveEl, function(){});
                    }
                }, 
                function(){
                    wptroveError.text(wptroveJsVariables.labels.errory);
                    wptroveButtonOverlay('hide', wptroveEl, function(){});
                }
            );

        });

    });

    jQuery('.wptrove-admin-content').on('click', '.wptrove-testimonial-item-delete', function(){

        var wptroveEl = jQuery(this);
        var wptroveitem = jQuery(this).closest('.wptrove-testimonial-item');
        var wptroveId = wptroveitem.attr('data-key');
        var wptroveError = jQuery(this).closest('.wptrove-testimonial-item-actions').find('.wptrove-testimonial-item-error');

        wptroveError.text('');

        wptroveButtonOverlay('show', wptroveEl, function(){

            wptroveAjaxRequest(
                {
                    'sendData': {'action': 'delete', 'id': wptroveId},
                    'url': wptroveJsVariables.api.admin.moderate,
                }, 
                function(jsonData){

                    if( 
                        Object.prototype.hasOwnProperty.call(jsonData, "result") &&
                        jsonData.result
                    ){
                        wptroveitem.css({'overflow':'hidden'}).animate(
                            {
                                'height':0,
                            },1000,
                            function(){
                                jQuery(this).remove();
                            }
                        );
                    }else{
                        wptroveError.text(wptroveJsVariables.labels.errory);
                        wptroveButtonOverlay('hide', wptroveEl, function(){});
                    }
                }, 
                function(){
                    wptroveError.text(wptroveJsVariables.labels.errory);
                    wptroveButtonOverlay('hide', wptroveEl, function(){});
                }
            );

        });

    }); 

});