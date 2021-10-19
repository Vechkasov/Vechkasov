<?php
    session_start();
    // Подключение к БД
    require_once "../source/logic/db.php";

    // Логика авторизации
    require_once "logic/authoLog.php";
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="../source/css/enter.css">
    <script src="js/autho.js"></script>
</head>
<body>
    <form class="autho" action="autho.php" method="post">
        <label>Логин или email</label>
        <input type="text" class="<?=$classLog?>" id="login" name="login" placeholder="Введите свой логин">
        <?php
        if ($isEmptyLogin)
            echo "<p class='msg'>Вы ничего не ввели</p>";
        ?>
        <label>Пароль</label>
        <input type="password" class="<?=$classPas?>" name="password" placeholder="Введите пароль">
        <?php
        if ($isEmptyPassword)
            echo "<p class='msg'>Вы ничего не ввели</p>";
        else if ($error)
            echo "<p>" . $error . "</p>"
        ?>
        <button type="submit" onclick="save()" name="enter" class="login-btn">Войти</button>
        <p>У вас нет аккаунта? - <a href="reg.php">зарегистрируйтесь</a>!</p>
        <p>Назад, на <a href="../index.php">главную</a>!</p>
    </form>

</body>
</html>