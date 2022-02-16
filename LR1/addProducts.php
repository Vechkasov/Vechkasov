<?php
    require_once('Components/Database.php');
    require_once('Components/TableModuleClasses.php');
    require_once('Views/Common/nav.php');

    $header = "Добавление товара";
    $categories = CategoryTable::GetCategories();
    $errors = ProductActions::AddProduct();

    require_once('Views/Other/products/addProducts.php');

    require_once('Views/Common/footer.html');