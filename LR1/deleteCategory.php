<?php
    require_once('Components/Database.php');
    require_once('Components/TableModuleClasses.php');
    require_once('Views/Common/nav.php');

    $categories = CategoryTable::GetCategories();
    CategoryActions::DeleteCategory();

    $id = 0;
    foreach ($categories as $key => $item) {
        if ($item['id'] == $_GET['id']) {
            $header = "Удаление категории " . $item['name'];
            $id = $item['id'];
        }
    }

    for ($i = 0; $i < count($categories); $i++)
        if ($categories[$i]['id'] == $id)
            unset($categories[$i]);



    require_once('Views/Other/categories/deleteCategory.php');

    require_once('Views/Common/footer.html');
