<?php

    $driver = 'mysql';
    $host = 'localhost';
    $db_name = 'sport_product';
    $db_user = 'root';
    $db_pass = '';
    $charset = 'utf8';
    $options = ['PDO::ATTR_ERRMODE' => 'PDO::ERRMODE_EXCEPTION'];
    try {
        $pdo = new PDO("$driver:host=$host;dbname=$db_name;charset=$charset",$db_user,$db_pass,$options);
    }
    catch (PDOException $e)
    {
        die("Ошибка подключения к базе данных");
    }


