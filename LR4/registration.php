<?php
    $title = "Регистрация";
    require_once("html/nav.php");
    require_once("logic/registration_logic.php");
?>

    <div class="registration_body d-flex align-items-center flex-column pt-3">

        <form class="authorization_form" action="registration.php" method="post">

            <h4>Форма регистрации (* - обязательные поля)</h4>
            <label class="pt-3">ФИО*</label>
            <input type="text" class="authorization_input form-control <?= $msg['full_name']? "error": '';?>" name="full_name" placeholder="Введите свое полное имя" value="<?= !empty($_POST['full_name'])?htmlspecialchars($_POST['full_name']):"" ?>">
            <?php
            if ($msg['full_name'])
                echo "<p class='msg mt-3 p-2 text-center'>" . $msg['full_name'] . "</p>";
            ?>

            <label class="pt-3">Логин*</label>
            <input type="text" class="authorization_input form-control <?= $msg['login']? "error": '';?>" name="login" placeholder="Введите свой логин" value="<?= !empty($_POST['login'])?htmlspecialchars($_POST['login']):"" ?>">
            <?php
            if ($msg['login'])
                echo "<p class='msg mt-3 p-2 text-center'>" . $msg['login'] . "</p>";
            ?>

            <label class="pt-3">Почта*</label>
            <input type="email" class="authorization_input form-control <?= $msg['email']? "error": '';?>" name="email" placeholder="Введите адрес своей почты" value="<?= !empty($_POST['email'])?htmlspecialchars($_POST['email']):"" ?>">
            <?php
            if ($msg['email'])
                echo "<p class='msg mt-3 p-2 text-center'>" . $msg['email'] . "</p>";
            ?>

            <label class="pt-3">Пароль*</label>
            <input type="password" class="authorization_input form-control <?= $msg['password']? "error": '';?>" name="password" placeholder="Введите пароль">
            <?php
            if ($msg['password'])
                echo "<p class='msg mt-3 p-2 text-center'>" . $msg['password'] . "</p>";
            ?>

            <label class="pt-3">Подтверждение пароля*</label>
            <input type="password" class="authorization_input form-control <?= $msg['check_password']? 'error': '';?>" name="password_confirm" placeholder="Подтвердите пароль">
            <?php
            if ($msg['check_password'])
                echo "<p class='msg mt-3 p-2 text-center'>" . $msg['check_password'] . "</p>";
            ?>

            <label class="pt-3">Дата рождения</label>
            <input type="date" name="date" class="form-control" placeholder="Введите свою дату рождения" value="<?= !empty($_POST['date'])?htmlspecialchars($_POST['date']):"" ?>">

            <label class="pt-3">Адрес</label>
            <input type="text" name="address" class="authorization_input form-control" placeholder="Введите свой адрес" value="<?= !empty($_POST['address'])?htmlspecialchars($_POST['address']):"" ?>">

            <label class="pt-3">Расскажите о ваших интересах</label>
            <textarea name="interest" class="form-control" cols="30" rows="4" placeholder=" Ваши интересы"><?= !empty($_POST['interest'])?htmlspecialchars($_POST['interest']):"" ?></textarea>

            <label class="pt-3">Оставьте ссылку на профиль ВК</label>
            <input type="text" name="linkToVK" class="authorization_input form-control" placeholder="Вставьте ссылку" value="<?= !empty($_POST['linkToVK'])?htmlspecialchars($_POST['linkToVK']):"" ?>">

            <label class="pt-3">Ваша группа крови</label>
            <input type="text" name="blood_type" class="authorization_input form-control" placeholder="Группа крови" value="<?= !empty($_POST['blood_type'])?htmlspecialchars($_POST['blood_type']):"" ?>">

            <label class="pt-3">Ваш резус-фактор</label>
            <input type="text" name="rhesus_factor" class="authorization_input form-control" placeholder="Резус фактор" value="<?= !empty($_POST['rhesus_factor'])?htmlspecialchars($_POST['rhesus_factor']):"" ?>">

            <?php
            if ($msg_err)
                echo "<p class='msg mt-3 p-2 text-center'>" . $msg_err . "</p>"
            ?>

            <button type="submit" class="authorization_button register-btn mt-3 pt-1">Зарегистрироваться</button>

            <p class="mt-3">У вас уже есть аккаунт? - <a class="authorization_link" href="authorization.php">авторизируйтесь</a>!</p>
            <p>Назад, на <a href="index.php" class="authorization_link">главную</a>!</p>
        </form>
    </div>

<?php
    require_once("html/footer.php");
?>