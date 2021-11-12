<?php
    session_start();

    /*if (!isset($_SESSION['user']) && $title != "Авторизация" && $title != "Регистрация")
    {
        header("Location: authorization.php");
        exit();
    }*/

    require_once("logic/db.php");

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Название страницы (динамическое) -->
    <title><?=$title?></title>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <!-- Bootstrap 4 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- Основные стили -->
    <link rel="stylesheet" href="source/css/index.css">

    <!-- Основные скрипты -->
    <script src="source/js/index.js"></script>
</head>
<body>

<?php
    if ($title != "Авторизация" && $title != "Регистрация") :
?>
    <!-- Единая навигация сайта -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="row">
            <div class="col log">
                    <!-- Логотип -->
                    <img src="source/images/logo-short.svg" alt="Кекс">
                    <!-- Длинный svg-текст -->
                    <?php
                    require_once "logo.html"
                    ?>
            </div>
            <div class="col-lg-12">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Выпадающее меню с ссылками -->
                <!-- В зависимости от авторизации есть ссылка для входа и выхода -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <!-- Первая лабораторная работа -->
                            <b><a class="nav-link" href="index.php">СКИДКИ</a></b>
                        </li>
                        <li class="nav-item">
                            <!-- Вторая лабораторная работа -->
                            <b><a class="nav-link" href="filter.php">НОВИНКИ</a></b>
                        </li>
                        <li class="nav-item">
                            <b><a class="nav-link" href="text.php">КАТАЛОГ</a></b>
                        </li>
                        <li class="nav-item">
                            <b> <a class="nav-link" href="#">ОДЕЖДА</a></b>
                        </li>
                        <li class="nav-item">
                            <b><a class="nav-link" href="#">ОБУВЬ</a></b>
                        </li>
                        <li class="nav-item">
                            <b><a class="nav-link" href="#">ТУРИЗМ</a></b>
                        </li>
                        <li class="nav-item">
                            <b><a class="nav-link" href="#">БЕГ</a></b>
                        </li>
                        <li class="nav-item">
                            <b><a class="nav-link" href="#">АЛЬПИНИЗМ</a></b>
                        </li>
                        <li class="nav-item">
                            <b><a class="nav-link" href="#">ГОРНЫЕ ЛЫЖИ</a></b>
                        </li>
                        <li class="nav-item">
                            <b><a class="nav-link" href="#">СНОУБОРД</a></b>
                        </li>
                        <!-- Ссылка либо на авторизацию либо на выход из аккаунта -->
                        <?php
                            // Пользователь авторизован
                            if (isset($_SESSION['user']))
                                    echo "  <li  class='nav-item'>
                                                <span class='user'><b>$_SESSION[user]</b></span>
                                            </li>
                                            <li  class='nav-item'>
                                                <a class='nav-link btn btn-outline-secondary' href='logic/exit_logic.php'><b>ВЫЙТИ</b></a>
                                        </li>";
                            // Пользователь не авторизован
                            else
                                echo "<li  class='nav-item'>
                                            <a class='nav-link btn btn-outline-secondary' href='authorization.php'><b>ВОЙТИ</b></a>
                                      </li>";
                            ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

<?php
    endif;
    ?>