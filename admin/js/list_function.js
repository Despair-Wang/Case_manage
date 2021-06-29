importScripts("jquery-3.6.0.min.js");
onmessage = function (oEvent) {
    if(oEvent.data == "send"){
    // let data = "row_id" + "," + "user";
    // var fucking_var = "";
    // $.ajax({
    //     url: 'http://127.0.0.1/api.php?do=get_number',
    //     type: 'post',
    //     data: {
    //         data
    //     },
    //     async: true,
    //     success: function(result) {
    //         fucking_var = eval(result);
    //     }
    // })
    // self.postMessage(fucking_var);
postMessage("I GET");
    }
}

function get_number(target, table) {
    let data = target + "," + table;
    var fucking_var = "";
    $.ajax({
        url: 'http://127.0.0.1/api.php?do=get_number',
        type: 'post',
        data: {
            data
        },
        async: false,
        success: function(result) {
            fucking_var = eval(result);
        }
    })
    return fucking_var;
}

