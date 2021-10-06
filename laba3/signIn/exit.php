<?php
    session_start();

    // выход, удаление логина пользователя
    //unset($_SESSION['user']);
    $_SESSION['user'] = "";

    $_SESSION['guest'] = array(
        // количество попыток входа
        'try' => 0,
        // заблокирован ли
        'lock' => false,
        // с какого времени заблокирован
        'time' =>0
    );
    header('Location:../first.php');