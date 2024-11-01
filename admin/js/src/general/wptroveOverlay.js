/* global jQuery */
export function wptroveOverlay( actionType, subActionType, actionMessage, afterComplete ){

    var wptroveOverlayEl = jQuery('.wptrove-admin-content-overlay');
    var wptroveOverlaySubEl;
    if( 'wait' == subActionType ){
        wptroveOverlaySubEl = wptroveOverlayEl.find('.wptrove-admin-content-wait');
    }
    if( 'error' == subActionType ){
        wptroveOverlaySubEl = wptroveOverlayEl.find('.wptrove-admin-content-error');
    }

    if( 'show' == actionType ){

        wptroveOverlayEl.find('.wptrove-admin-content-wait').css({'display':'none', 'opacity':0});
        wptroveOverlayEl.find('.wptrove-admin-content-error').css({'display':'none', 'opacity':0});

        wptroveOverlayEl.css({'opacity':0, 'display':'block'}).animate(
            {
                'opacity':1,
            },
            1000,
            function(){

                if( 'wait' == subActionType ){

                    wptroveOverlayEl.find('.wptrove-admin-content-wait__message').text(actionMessage);
                    wptroveOverlaySubEl.css({'opacity':0, 'display':'block'}).animate(
                        {
                            'opacity':1,
                        }, 
                        1000,
                        function(){
                            afterComplete();
                        }
                    );

                }

                if( 'error' == subActionType ){

                    wptroveOverlayEl.find('.wptrove-admin-content-error__message').text(actionMessage);
                    wptroveOverlaySubEl.css({'opacity':0, 'display':'block'}).animate(
                        {
                            'opacity':1,
                        }, 
                        1000,
                        function(){
                            afterComplete();
                        }
                    );

                }						

            }
        );

    }

    if( 'showPartial' == actionType ){

        if( 'wait' == subActionType ){

            wptroveOverlayEl.find('.wptrove-admin-content-wait__message').text(actionMessage);
            wptroveOverlaySubEl.css({'opacity':0, 'display':'block'}).animate(
                {
                    'opacity':1,
                }, 
                1000,
                function(){
                    afterComplete();
                }
            );

        }

        if( 'error' == subActionType ){

            wptroveOverlayEl.find('.wptrove-admin-content-error__message').text(actionMessage);
            wptroveOverlaySubEl.css({'opacity':0, 'display':'block'}).animate(
                {
                    'opacity':1,
                }, 
                1000,
                function(){
                    afterComplete();
                }
            );

        }
    }

    if( 'hide' == actionType ){
        
        wptroveOverlaySubEl.animate(
            {
                'opacity':0,
            },
            1000,
            function(){
                wptroveOverlaySubEl.css({'display':'none', 'opacity':0});
                wptroveOverlayEl.animate(
                    {
                        'opacity':0,
                    },
                    1000,
                    function(){
                        wptroveOverlayEl.css({'display':'none', 'opacity':0});
                    }
                );
                afterComplete();
            }
        );

    }

    if( 'hidePartial' == actionType ){
        
        wptroveOverlaySubEl.animate(
            {
                'opacity':0,
            },
            1000,
            function(){
                wptroveOverlaySubEl.css({'display':'none', 'opacity':0});
                afterComplete();
            }
        );

    }

}