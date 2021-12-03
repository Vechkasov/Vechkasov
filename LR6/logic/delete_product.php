<?php
    require_once ("data_base.php");
    Database::deleteProduct($_GET['id']);
    header("Location: ../");