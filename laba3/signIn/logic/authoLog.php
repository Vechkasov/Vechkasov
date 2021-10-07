<?php

    // можно вводить email вместо логина
    // обрабатывает ошибки отправки формы на сервере

    // дополнительные данные
    $isEmptyLogin = false;
    $isEmptyPassword = false;
    $classLog = "";
    $classPas = "";
    $error = "";


    // если пользователь уже заблокирован
    if ($_SESSION['guest']['lock'])
    {
        $timeLock = $_SESSION['guest']['time'];
        $now = time();
        // час блокировки ещё не прошел
        if ($now - $timeLock < 3600)
        {
            //$error = "Вы сможете попробовать войти ещё раз через " . date("i:s",$timeLock - $now);
            $error = $error . "Вы сможете попробовать войти ещё раз в " . date("H:i:s",$timeLock + 7200);
        }
        // час прошел
        else
        {
            $_SESSION['guest']['lock'] = false;
            $_SESSION['guest']['try'] = 0;
        }
    }


    // если запрос есть и пользователь не заблокирован
    if ($_POST and !$_SESSION['guest']['lock'])
    {
        // читабельность
        $login = $_POST["login"];
        $password = $_POST["password"];

        // если поля не пустые
        if ($login != '' and $password!='')
        {
            // хэшируем пароль
            $password = md5($password);

            // создаем запрос для запроса поиска подходящих записей в БД
            $zapros = array(
                'login' => $login,
                'password' => $password
            );

            // ищем логин подходящий под логин или почту или сравниваем хэши паролей
            $sql = 'SELECT * FROM `user` WHERE ((`login` = :login) OR (`email` = :login)) AND (`password` = :password)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute($zapros);
            $count = $stmt -> fetchColumn();

            // В теории больше 1 записи не должно быть найдено
            // т.к. логин и почта при регистрации проверяются на уникальность
            if ($count > 1)
            {
                // вход выполнен
                $_SESSION['user'] = $login;
                header("Location:../second.php");
            }
            else
            {
                $_SESSION['guest']['try']++;
                if ($_SESSION['guest']['try'] < 3)
                    $error = "Неверный логин или пароль, осталось " . (3 - $_SESSION['guest']['try']) . " попыток";
                else
                    $error = "У вас не осталось попыток";
            }

        }
        // обработка отправки пустой формы
        else
        {
            // не ввели логин
            if ($login === '')
            {
                $isEmptyLogin = true;
                $classLog = "error";
            }
            // не ввели пароль
            if ($password === '')
            {
                $isEmptyPassword = true;
                $classPas = "error";
            }
        }
    }
    else
    {
        if ($_SESSION['guest']['try'] > 0 and $_SESSION['guest']['try'] < 3)
            $error = "У вас осталось " . (3 - $_SESSION['guest']['try']) . " попыток";
    }


    if ($_SESSION['guest']['try'] == 3 and !$_SESSION['guest']['lock'])
    {
        $_SESSION['guest']['lock'] = true;
        $_SESSION['guest']['time'] = time();
    }


