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