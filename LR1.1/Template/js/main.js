$(document).ready(function() {
    $(".deleteProduct").click(function(){
        if (window.confirm("Вы точно хотите удалить таблицу?")) {
            window.location.replace('/Vechkasov/LR1.1/products/delete/'+$(this).attr("id"));
        }
    });

    $("#flexRadioDefault2").click(function (){
        if ($(this).is(':checked')) {
            $('#categories').removeAttr('disabled');
        }
    });

    $("#flexRadioDefault1").click(function (){
        if (!$('#flexRadioDefault2').is(':checked')) {
            $('#categories').prop('disabled', true);
        }
    });
});
