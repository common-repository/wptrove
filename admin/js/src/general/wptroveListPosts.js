/* global jQuery, wptroveJsVariables */
import { wptroveAjaxRequest } from "./wptroveAjaxRequest";
import { wptroveOverlay } from "./wptroveOverlay";

var wptroveHtml = {};
wptroveHtml['wptrove-testimonial'] = '';

export function wptroveListPosts(data){

    var wptroveType = data['post_type'];
    if( 'wptrove-cf' === wptroveType ){
        wptroveType = 'wptrove-custom-field';
    }
    var wptroveOffset = data['offset'];
    var wptroveTypeSourceEl = '.' + wptroveType + '-source';
    var wptroveTypeSourcePaginationEl = '.' + wptroveType + 's-pagination-source';
    var wptroveTypeListEl = '.' + wptroveType + 's-list';
    var wptroveTypeEmptyEl = '.' + wptroveType + 's-empty';
    var wptroveTypepaginationEl = '.' + wptroveType + 's-pagination';

    if( ! Object.prototype.hasOwnProperty.call(data, "count") && Object.prototype.hasOwnProperty.call(data, "post_type") ){

        var getCount = jQuery('.' + wptroveType + 's-content').attr('data-count');
        if( getCount ){

            data['count'] = parseInt(getCount, 10);

        }else{

            data['count'] = 2;

        }
        
    }else{

        data['count'] = 2;

    }

    if( ! Object.prototype.hasOwnProperty.call(data, "status") && Object.prototype.hasOwnProperty.call(data, "post_type") ){

        var getStatus = jQuery('.' + wptroveType + 's-content').find('.wptrove-admin-select__heading').attr('data-status'); console.log('getStatus', getStatus);
        if( getStatus ){

            data['status'] = getStatus;

        }else{

            data['status'] = '';

        }
        
    }else{

        data['status'] = '';

    }

    jQuery(wptroveTypeListEl).removeAttr('style');
    jQuery(wptroveTypeEmptyEl).removeAttr('style');
    jQuery(wptroveTypepaginationEl).removeAttr('style');

    var wptroveData = {}, wptroveCount = data['count'];
    wptroveData['url'] = wptroveJsVariables.api.admin.fetch;
    wptroveData['sendData'] = data;

        wptroveAjaxRequest(
            wptroveData,
            function(jsonData){

                var wptroveTestimonials = '';

                if( Object.prototype.hasOwnProperty.call(jsonData, "data") && Object.prototype.hasOwnProperty.call(jsonData.data, "data") ){


                    if(!jQuery.isEmptyObject(jsonData.data.data)){

                        jQuery.each(jsonData.data.data, function( key, value ){

                            var wptroveTestimonialsItem = jQuery( wptroveTypeSourceEl ).html();

                            if( 'wptrove-testimonial' === wptroveType ){

                                if( Object.prototype.hasOwnProperty.call(value, "id") ){
                                    wptroveTestimonialsItem = wptroveTestimonialsItem.replace('REPLACEWITHKEY', value.id);
                                }

                                if( Object.prototype.hasOwnProperty.call(value, "title") && '' !== value.title ){
                                    wptroveTestimonialsItem = wptroveTestimonialsItem.replace('REPLACEWITHTITLE', value.title);
                                }

                                if ( Object.prototype.hasOwnProperty.call(value, "meta") ) {

                                    var wptroveMeta = '';

                                    if( 
                                        Object.prototype.hasOwnProperty.call(value.meta, "wptrove-heading")
                                    ){
                                        wptroveTestimonialsItem = wptroveTestimonialsItem.replace('REPLACEWITHHEADING', value.meta["wptrove-heading"]);
                                    }
    
                                    if( 
                                        Object.prototype.hasOwnProperty.call(value.meta, "wptrove-testimonial")
                                    ){
                                        wptroveTestimonialsItem = wptroveTestimonialsItem.replace('REPLACEWITHTESTIMONIAL', value.meta["wptrove-testimonial"]);
                                    }

                                    if( Object.prototype.hasOwnProperty.call(value.meta, "wptrove-name") && '' !== value.meta["wptrove-name"] ){
                                        wptroveMeta += '<p class="wptrove-testimonial-item-meta__item">' + wptroveJsVariables.labels.testimonials.name + ': <span>' + value.meta["wptrove-name"] + '</span></p>';
                                    }

                                    if( Object.prototype.hasOwnProperty.call(value.meta, "wptrove-company") && '' !== value.meta["wptrove-company"] ){
                                        wptroveMeta += '<p class="wptrove-testimonial-item-meta__item">' + wptroveJsVariables.labels.testimonials.company + ': <span>' + value.meta["wptrove-company"] + '</span></p>';
                                    }

                                    if( Object.prototype.hasOwnProperty.call(value.meta, "wptrove-designation") && '' !== value.meta["wptrove-designation"] ){
                                        wptroveMeta += '<p class="wptrove-testimonial-item-meta__item">' + wptroveJsVariables.labels.testimonials.designation + ': <span>' + value.meta["wptrove-designation"] + '</span></p>';
                                    }

                                    if( Object.prototype.hasOwnProperty.call(value.meta, "wptrove-email") && '' !== value.meta["wptrove-email"] ){
                                        wptroveMeta += '<p class="wptrove-testimonial-item-meta__item">' + wptroveJsVariables.labels.testimonials.email + ': <span>' + value.meta["wptrove-email"] + '</span></p>';
                                    }

                                    var wptroveMetaHtml = `<div class="wptrove-testimonial-item-meta">${wptroveMeta}</div>`;
                                    wptroveTestimonialsItem = wptroveTestimonialsItem.replace('REPLACEWITHMETA', wptroveMetaHtml);

                                    var wptroveApproveStyle = '';
                                    if( Object.prototype.hasOwnProperty.call(value.meta, "wptrove-status") && 'approved' === value.meta["wptrove-status"] ){
                                        wptroveApproveStyle = 'display:none;';
                                    }
                                    wptroveTestimonialsItem = wptroveTestimonialsItem.replace('REPLACEWITHAPPROVESTYLE', wptroveApproveStyle);

                                }

                                wptroveTestimonialsItem = wptroveTestimonialsItem.replace('REPLACEWITHKEY', wptroveApproveStyle);
                                
                                

                            }
                            
                            wptroveTestimonials += wptroveTestimonialsItem;

                        });

                        var wptrovePagination = '';

                        if(Object.prototype.hasOwnProperty.call(jsonData.data, "total") && jsonData.data.total > wptroveCount){

                            var wptrovePaginationItem = jQuery( wptroveTypeSourcePaginationEl ).html();
                            wptrovePaginationItem = wptrovePaginationItem.replace('REPLACEWITHOFFSET', 'prev');
                            wptrovePaginationItem = wptrovePaginationItem.replace('REPLACEWITHOFFSETTEXT', wptroveJsVariables.labels.prev);

                            wptrovePagination += wptrovePaginationItem;

                            var i;
							for(i = 1; i <= Math.ceil( jsonData.data.total / wptroveCount ); i++){

                                wptrovePaginationItem = jQuery( wptroveTypeSourcePaginationEl ).html();
                                wptrovePaginationItem = wptrovePaginationItem.replace('REPLACEWITHOFFSET', i);
                                wptrovePaginationItem = wptrovePaginationItem.replace('REPLACEWITHOFFSETTEXT', i);

                                wptrovePagination += wptrovePaginationItem;

                            }

                            wptrovePaginationItem = jQuery( wptroveTypeSourcePaginationEl ).html();
                            wptrovePaginationItem = wptrovePaginationItem.replace('REPLACEWITHOFFSET', 'next');
                            wptrovePaginationItem = wptrovePaginationItem.replace('REPLACEWITHOFFSETTEXT', wptroveJsVariables.labels.next); 
                            wptrovePagination += wptrovePaginationItem;                          
                          
                        }

                        if( wptrovePagination ){

                            jQuery( wptroveTypepaginationEl ).html( wptrovePagination ).css({'display':'block'});
                            jQuery(wptroveTypepaginationEl).find('.wptrove-pagination-item').eq((wptroveOffset/wptroveCount)+1).addClass('wptrove-pagination-item--active');
                            if( (wptroveOffset - wptroveCount) < 0 ){
                                jQuery( wptroveTypepaginationEl + ' .wptrove-pagination-item').first().addClass('wptrove-pagination-item--disabled');
                            }
                            if( wptroveOffset >= (jsonData.data.total - wptroveCount) ){
                                jQuery( wptroveTypepaginationEl + ' .wptrove-pagination-item').last().addClass('wptrove-pagination-item--disabled');
                            }

                        }

                        jQuery(wptroveTypeListEl).html(wptroveTestimonials).css({'display':'block'});
                        jQuery(wptroveTypeEmptyEl).css({'display':'none'});
                        wptroveOverlay( 'hide', 'wait', '', function(){} );

                    }else{

                        jQuery(wptroveTypeListEl).html('');
                        jQuery( wptroveTypepaginationEl ).html('');
                        wptroveOverlay( 'hide', 'wait', '', function(){} );

                    }

                }else{

                    wptroveOverlay('showPartial', 'error', wptroveJsVariables.labels.error, function(){});

                }

            },
            function(){

                wptroveOverlay('hidePartial', 'wait', '', function(){

                    wptroveOverlay('showPartial', 'error', wptroveJsVariables.labels.error, function(){});

                });

            }
        );

}