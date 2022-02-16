<?php
    require_once('Components/Database.php');
    require_once('Components/TableModuleClasses.php');
    require_once('Views/Common/nav.php');

    $header = "Изменение категории";
    $category = CategoryActions::GetCategory();

    require_once('Views/Other/categories/editCategory.php');

    require_once('Views/Common/footer.html');