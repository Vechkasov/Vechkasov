<?php
    require_once('Components/Database.php');
    require_once('Components/TableModuleClasses.php');

    require_once('Views/Common/nav.php');

    $products = ProductActions::GetProducts();

    require_once('Views/Other/products/viewProducts.php');

    require_once('Views/Common/footer.html');
