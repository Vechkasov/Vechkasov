<?php
    $title = "Изменение";
    require_once("html/nav.php");
    require_once("logic/input_product.php");

    $action ="edit_product.php?id=$_GET[id]";

    // Форма ввода данных
    require_once("html/input.php");

    require_once("html/footer.php");