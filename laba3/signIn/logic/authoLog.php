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
            $error = $error . "Вы сможете попробовать войти ещё раз в " . date("H:i:s",$timeLock + 7200);
        }
        // час прошел
        else
        {
            $_SESSION['guest']['lock'] = false;
            $_SESSION['guest']['try'] = 0;
        }
    }


    // Усли запрос есть и пользователь не заблокирован
    if ($_POST and !$_SESSION['guest']['lock'])
    {
        // читабельность
        $login = $_POST["login"];
        $password = $_POST["password"];

        // Усли поля не пустые
        if ($login != '' and $password != '')
        {
            // Хэшируем пароль
            $password = md5($password);

            // Создаем запрос для запроса поиска подходящих записей в БД
            $zapros = array(
                'login' => $login,
                'password' => $password
            );

            // Ищем логин подходящий под логин или почту или сравниваем хэши паролей
            $sql = 'SELECT COUNT(*) FROM `user` WHERE ((`login` = :login) OR (`email` = :login)) AND (`password` = :password)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute($zapros);
            $count = $stmt -> fetchColumn();

            // В теории больше 1 записи не должно быть найдено
            // т.к. логин и почта при регистрации проверяются на уникальность
            if ($count == 1)
            {
                unset($_SESSION['guest']);
                // вход выполнен
                $_SESSION['user'] = $login;
                header("Location:../filter.php");
            }
            else
            {
                $_SESSION['guest']['try']++;
                // Если попытки есть не блокировать пользователя
                if ($_SESSION['guest']['try'] < 3)
                    $error = "Неверный логин или пароль, осталось " . (3 - $_SESSION['guest']['try']) . " попыток";
                // Заблокировать если они закончились
                else
                {
                    $error = "У вас не осталось попыток";
                    $_SESSION['guest']['lock'] = true;
                    // Зафиксировать время блокировки
                    $_SESSION['guest']['time'] = time();
                    $error = $error . "Вы сможете попробовать войти ещё раз в " . date("H:i:s",$timeLock + 7200);
                }
            }

        }
        // Обработка отправки пустой формы
        else
        {
            // Не ввели логин
            if ($login === '')
            {
                $isEmptyLogin = true;
                $classLog = "error";
            }
            // Не ввели пароль
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


