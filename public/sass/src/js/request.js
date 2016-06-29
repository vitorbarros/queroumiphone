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

function updateCategory(){
    var formData = new FormData($("#updateCategory")[0]);
    $.ajax({
        type: "POST",
        url: "/category/update",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            if(data.redirect){
                window.location.href = data.redirect;
            }
        },
        error: function (data) {
            alertRequests('error', data, 'alert-category', false);
        }
    });
}

function storeCategory(){
    var formData = new FormData($("#createCategory")[0]);

    $.ajax({
        type: "POST",
        url: "/category/store",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            alertRequests('success', data, 'alert-category', true);
        },
        error: function (data) {
            alertRequests('error', data, 'alert-category', false);
        }
    });
}

function storeProduct(){
    var formData = new FormData($("#createProduct")[0]);

    $.ajax({
        type: "POST",
        url: "/product/store",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            alertRequests('success', data, 'alert-product', true);
        },
        error: function (data) {
            alertRequests('error', data, 'alert-product', false);
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

function getCategory(id, fild) {
    if(id){
        $.ajax({
            type: "GET",
            url: "/category/get/" + id,
            cache: false,
            success: function (data) {
                var html = "<option value='' selected>Selecione a categoria</option>";
                $.each(data.categories, function (i,v){
                   html += "<option value=\'"+i+"\'>"+v+"</option>";
                });
                $("#" + fild).empty();
                $("#" + fild).append(html);
                $("#" + fild).removeAttr('disabled');
            }
        });
    }
}