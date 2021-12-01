<?php

// дополнительные данные
$is_empty_login = false;
$is_empty_password = false;
$error = "";


// Если запрос есть
// (имеет смысл при первичном просмотре страницы, когда запроса ещё нет)
if ($_POST)
{
    // читабельность
    $login = $_POST["login"];
    $password = $_POST["password"];

    // Если поля не пустые
    if (!empty($login) and !empty($password))
    {
        // Хэшируем пароль
        $password = md5($password);

        // Создаем запрос для поиска подходящих записей в БД
        $query = array(
            'login' => $login,
            'password' => $password
        );

        // Ищем логин подходящий под введенные логин или почту и сравниваем хеши паролей
        $sql = 'SELECT COUNT(*) FROM `user` WHERE ((`login` = :login) OR (`email` = :login)) AND (`password` = :password)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($query);
        $count = $stmt -> fetchColumn();

        // В теории больше 1 записи не должно быть найдено
        // т.к. логин и почта при регистрации проверяются на уникальность
        if ($count == 1)
        {
            $_SESSION['user'] = $login;
            header("Location:index.php");
            exit();
        }
        else
            $error = "Неверный логин или пароль";
    }
    // Обработка отправки пустой формы
    else
    {
        // Не ввели логин
        if (empty($login))
            $is_empty_login = true;
        // Не ввели пароль
        if ($password === '')
            $is_empty_password = true;
    }
}
