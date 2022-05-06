<?php

    // 1. Общие настройки

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // 2. Подключение файлов системы

    define('ROOT', dirname(__FILE__));
    define('HOST', 'Vechkasov/LR1.1');

    require_once(ROOT . '/Components/Router.php');
    require_once(ROOT . '/Components/Database.php');
    require_once(ROOT . '/Components/ORM.php');
    require_once(ROOT . '/Components/IController.php');

    // 3. Вызов Router

    $router = new Router();
    $router->run();