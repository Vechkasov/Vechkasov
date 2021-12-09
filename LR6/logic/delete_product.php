<?php
    require_once ("data_base.php");
    product_table::deleteProduct($_GET['id']);
    header("Location: ../");