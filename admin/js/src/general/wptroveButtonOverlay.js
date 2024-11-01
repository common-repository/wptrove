/* global jQuery */
export function wptroveButtonOverlay( actionType, el, afterComplete ){

    if( 'show' === actionType ){

        jQuery(el).find('.wptrove-button-overlay').css({'opacity':0, 'display':'block'}).animate(
            {
                'opacity':1,
            },1000,
            function(){
                jQuery(el).find('.wptrove-button-spinner').css({'opacity':0, 'display':'block'}).animate(
                    {
                        'opacity':1,
                    },1000,
                    function(){
                        afterComplete();
                    }
                );
            }
        );

    }

    if( 'hide' === actionType ){

        jQuery(el).find('.wptrove-button-spinner').animate(
            {
                'opacity':0,
            },1000,
            function(){
                jQuery(this).css({'display':'none'});
                jQuery(el).find('.wptrove-button-overlay').animate(
                    {
                        'opacity':0,
                    },1000,
                    function(){
                        jQuery(this).css({'display':'none'});
                        afterComplete();
                    }
                );
            }
        );

    }

}