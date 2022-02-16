<?php
    require_once('Components/Database.php');
    require_once('Components/TableModuleClasses.php');
    require_once('Views/Common/nav.php');

    $header = "Добавление категории";
    $errors = CategoryActions::AddCategory();

    require_once('Views/Other/categories/addCategory.php');

    require_once('Views/Common/footer.html');