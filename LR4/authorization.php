<?php
    $title = "Авторизация";
    require_once("html/nav.php");
    require_once("logic/authorization_logic.php");
?>
    <div class="authorization_body container-fluid">

        <form class="authorization_form" action="authorization.php" method="post">
            <label>Логин или email</label>
            <input type="text" class="authorization_input form-control mt-1" id="login" name="login" placeholder="Введите свой логин" value="<?= !empty($_POST['login'])?htmlspecialchars($_POST['login']):"" ?>">

            <?php
            if ($is_empty_login) {
                ?>
                <p class="msg mt-3 p-2 text-center">Вы не ввели логин</p>
            <?php } ?>

            <label class="pt-2">Пароль</label>
            <input type="password" class="authorization_input form-control mt-1" name="password" placeholder="Введите пароль">

            <?php
            if ($is_empty_password) {
                ?>
                <p class="msg mt-3 p-2 text-center">Вы не ввели пароль</p>
            <?php } ?>

            <button type="submit" name="enter" class="login-btn authorization_button mt-3 p-2">Войти</button>

            <?php
            if (!empty($error)) {
                ?>
                <p class="error mt-3 p-2 text-center">Вы ввели неверный логин или пароль</p>
            <?php } ?>

            <p class="mt-3">У вас нет аккаунта? - <a href="registration.php" class="authorization_link">зарегистрируйтесь</a>!</p>
            <p>Назад, на <a class="authorization_link" href="index.php">главную</a>!</p>
        </form>

    </div>

<?php
    require_once("html/footer.php");
?>