<?php
    require_once('Components/Database.php');
    require_once('Components/TableModuleClasses.php');

    ProductActions::DeleteProduct();

    header("Location: index.php");
    exit();