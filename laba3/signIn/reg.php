<?php
    session_start();
    require_once "../source/logic/db.php";
    require_once "logic/regLog.php";
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="../source/css/enter.css">
    <script src="js/regis.js"></script>
</head>
<body class="kr">

    <form class="autho" action="reg.php" method="post">
        <h4>Форма регистрации (* - обязательные поля)</h4>
        <label>ФИО*</label>
        <input required type="text" class="<?= $msq['full_name']? "error": '';?>" name="full_name" placeholder="Введите свое полное имя" id="full_name">
        <?php
        if ($msq['full_name'])
            echo "<p class='msg'>" . $msq['full_name'] . "</p>";
        ?>
        <label>Логин*</label>
        <input required type="text" name="login" placeholder="Введите свой логин" id="login">
        <?php
        if ($msq['login'])
            echo "<p class='msg'>" . $msq['login'] . "</p>";
        ?>
        <label>Почта*</label>
        <input required type="email" name="email" placeholder="Введите адрес своей почты" id="email">
        <?php
        if ($msq['email'])
            echo "<p class='msg'>" . $msq['email'] . "</p>";
        ?>
        <label>Пароль*</label>
        <input required type="password" name="password" placeholder="Введите пароль" id="password">
        <?php
        if ($msq['password'])
            echo "<p class='msg'>" . $msq['password'] . "</p>";
        ?>
        <label>Подтверждение пароля*</label>
        <input required type="password" name="password_confirm" placeholder="Подтвердите пароль" id="password_confirm">
        <?php
        if ($msq['check_password'])
            echo "<p class='msg'>" . $msq['check_password'] . "</p>";
        ?>

        <label>Дата рождения</label>
        <input type="date" name="date" placeholder="Введите свою дату рождения" id="date">
        <label>Адрес</label>
        <input type="text" name="address" placeholder="Введите свой адрес" id="address">
        <label>Расскажите о ваших интересах</label>
        <textarea name="interest" cols="30" rows="4" placeholder=" Ваши интересы" id="interest"></textarea>
        <label>Оставьте ссылку на профиль ВК</label>
        <input type="text" name="linkToVK" placeholder="Вставьте ссылку" id="linkToVK">
        <label>Ваша группа крови</label>
        <input type="text" name="blood_type" placeholder="Группа крови" id="blood_type">
        <label>Ваш резус-фактор</label>
        <input type="text" name="rhesus_factor" placeholder="Резус фактор" id="rhesus_factor">

        <?php
        if ($msg_err)
            echo "<p class='msg'>" . $msg_err . "</p>"
        ?>

        <button type="submit" class="register-btn" onclick="save()">Зарегистрироваться</button>

        <p>У вас уже есть аккаунт? - <a href="autho.php">авторизируйтесь</a>!</p>
        <p>Назад, на <a href="../first.php">главную</a>!</p>
    </form>

</body>
</html>