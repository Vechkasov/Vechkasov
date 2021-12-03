$(document).ready(function() {
    $(".delete").click(function(){
        if (window.confirm("Вы точно хотите удалить таблицу?")) {
            window.location.replace('/LR6/logic/delete_product.php?id='+$(this).attr("id"));
        }
    });
});
