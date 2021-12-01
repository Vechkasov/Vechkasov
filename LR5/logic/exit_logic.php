<?php
    session_start();

    // Выход
    unset($_SESSION['user']);

    session_destroy();

    // Редирект на страницу с фильтром
    header('Location:../filter.php');
    exit();