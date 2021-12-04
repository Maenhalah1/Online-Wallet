import * as Master from './master.js'

function apiCall(url, data, callType = "GET", beforeSendFunction = null){
    return new Promise(resolve => {
        $.ajaxSetup({
            headers: {
                'Authorization': Master.user.token
            }
        });
        $.ajax({
            type: callType,
            url: url,
            data: data,
            beforeSend: typeof beforeSendFunction == "function" ? beforeSendFunction : null,
            success: function( response ) {
                resolve (response);
            },
            error : function (response) {
                resolve(response);
            }
        });
    });
}
function formRequest(url, data, callType = "POST", beforeSendFunction = null){
    return new Promise(resolve => {
        $.ajaxSetup({
            headers: {
                'Authorization': Master.user.token
            }
        });
        $.ajax({
            processData:false,
            contentType: false,
            type: callType,
            url: url,
            data: data,
            beforeSend: typeof beforeSendFunction == "function" ? beforeSendFunction : null,
            complete: function( response ) {
                resolve (response);
            }
        });
    });
}
export {apiCall, formRequest};
