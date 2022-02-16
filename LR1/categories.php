<?php
    require_once('Components/Database.php');
    require_once('Components/TableModuleClasses.php');

    require_once('Views/Common/nav.php');

    $categories = CategoryTable::Getcategories();

    require_once('Views/Other/categories/viewCategories.php');

    require_once('Views/Common/footer.html');