/* global wptroveJsVariables, jQuery */
export function wptroveAjaxRequest(data, onSuccess, onFailure){

    data.sendData['nonce'] = wptroveJsVariables.nonce;

    jQuery.ajax({

        type: 'POST',
        url: data.url,
        data: data.sendData,
        beforeSend: function (xhr) {
            xhr.setRequestHeader('X-WP-Nonce', wptroveJsVariables.wpRestNonce);
        },
        timeout: data.timeout,
        success: function(jsonData) {

            onSuccess(jsonData);

        },
        error: function(xhr, status, error) {

            onFailure(xhr, status, error);

        },

    });

}