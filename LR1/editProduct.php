<?php
    require_once('Components/Database.php');
    require_once('Components/TableModuleClasses.php');
    require_once('Views/Common/nav.php');

    $header = "Изменение товара";
    $categories = CategoryTable::GetCategories();

    $product = ProductActions::GetProduct();

    $errors = ProductActions::EditProduct();

    require_once('Views/Other/products/editProduct.php');

    require_once('Views/Common/footer.html');