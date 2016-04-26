$(document).ready(function () {

    $("#client_cpf").mask("000.000.000-00");

    var year = new Date().getFullYear();

    $( "#client_birthday" ).datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        changeYear: true,
        yearRange: "1900:" + year
    });

});
function storeClient(){
    var formData = new FormData($("#storeClient")[0]);

    $.ajax({
        type: "POST",
        url: "/client/store",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            alertRequests('success', data, 'alert-client', true);
        },
        error: function (data) {
            alertRequests('error', data, 'alert-client', false);
        }
    });
}

function authenticate() {

    var formData = new FormData($("#login")[0]);

    $.ajax({
        type:"POST",
        url:"/auth/verifyCredentials",
        data:formData,
        contentType: false,
        cache: false,
        processData: false,
        success:function(data){
            window.location.href = data.redirect;
        },
        error:function(data){
            alertRequests('error', data, 'alert-login', true);
        }
    });
}

function alertRequests(type, data, id, clear) {
    if (type == 'success') {
        $("#" + id).empty();
        $("#" + id).append('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + data.messages + '</div>');
        if (clear) {
            clearFields();
        }
    } else {
        $("#" + id).empty();
        $("#" + id).append('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + data.responseJSON.messages + '</div>');
    }
}

function clearFields() {
    $("input[type='text']").val("");
    $("input[type='email']").val("");
    $("input[type='number']").val("");
    $("textarea").val("");

}