

 function pushNotification(heading,text,icon){
    $.toast({
        heading: heading,
        text: text,
        showHideTransition: 'slide',
        icon: icon,
        loaderBg: '#f96868',
        position: 'top-right'
    }); 
}


function getData(method, route, dataType, data, callback = null, event = null,toast = 1)
{
    NProgress.start();
    $.ajax({
        type: method,
        url: route,
        dataType : dataType,
        data: data,
        success: function(data, textStatus, jqXHR) {
            if(callback != null){
                response_data = data;
                eval(callback+"(data)");
            }else{
                if(toast == 1) {
                    response_data = data;
                    pushNotification(data.message,data.title,'success');
                }
            }
        },

        //If there was no response from the server
        error: function( data, textStatus, jqXHR){
            let err = eval("(" + data.responseText + ")");
            if(data.status == 500 || data.status == 400)
            pushNotification("Oops",err.error,"error");
            else
            $.each(err.errors, function(index, value) {
                pushNotification("Oops",value,"error");
            }); 
        },

        //capture the request before it was sent to server
        beforeSend: function(jqXHR, settings){

        },

        //this is called after the response or error functions are finished
        //so that we can take some action
        complete: function(jqXHR, textStatus){
            NProgress.done();
        }
    });
}
function postData( method, route, dataType, data ,callback = null, event = null, toast = 1)
{
    let response_data;
    NProgress.start();
    $.ajax({
        contentType: false,
        processData: false,
        type: method,
        url: route,
        dataType : dataType,
        async: false,
        data: data != null ? data : {},
        headers: {
            "Accept": "application/json"
        },
        //if received a response from the server
        success: function(data, textStatus, jqXHR) {
            console.log(data);
            if(callback != null){
                response_data = data;
                eval(callback+"(data)");
            }
            if(toast == 1) {
                response_data = data;
                pushNotification(data.message,data.title,data.status);
            }
        },

        //If there was no response from the server
        error: function( data, textStatus, jqXHR){
            console.log(data);
            console.log('error');
            let err = eval("(" + data.responseText + ")");
            if(data.status == 500 || data.status == 400)
            pushNotification("Oops",err.error,"error");
            else
            $.each(err.errors, function(index, value) {
                pushNotification("Oops",value,"error");
            }); 
        },

        //capture the request before it was sent to server
        beforeSend: function(jqXHR, settings){

        },

        //this is called after the response or error functions are finished
        //so that we can take some action
        complete: function(jqXHR, textStatus){
            NProgress.done();
        }
    });
    return response_data;
}
