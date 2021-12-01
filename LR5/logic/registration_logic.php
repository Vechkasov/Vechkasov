<?php

    if (isset($_SESSION['user']))
    {
        header("Location:index.php");
        exit();
    }

    function check_email($email, $pdo)
    {
        $query = array('email' => $email);
        $sql = 'SELECT * FROM `user` WHERE (`email` = :email)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($query);

        $count = $stmt->rowCount();
        if ($count > 0)
            return 1;
        else
            return 0;
    }

    function check_login($login, $pdo)
    {
        // Отправляем запрос
        $query = array('login' => $login);
        $sql = 'SELECT * FROM `user` WHERE `login` = :login';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($query);

        $count = $stmt->rowCount();
        if ($count > 0)
            return 1;
        else
            return 0;
    }

    // Обрабатывает ошибки отправки формы на сервере (теперь)

    // сначала смотрит, все ли важные поля заполнены
    // только потом проверяет их на уникальность и соответствие
    // после отправки формы данные остаются на своих местах (кроме пароля)

    // Сообщения об ошибках
    $msg = array(
        'full_name'=>'',
        'login'=>'',
        'password' =>'',
        'check_password' => '',
        'email' =>''
    );

    // Количество ошибок
    $count_error = 0;

    // Сообщение об ошибке регистрации
    $msg_err = '';

    // Если все важные поля заполнены
    if ($_POST and $_POST['login'] and $_POST['full_name'] and $_POST['password'] and $_POST['password_confirm'] and $_POST['email'])
    {
        // Для читабельности
        $login = $_POST['login'];
        $full_name = $_POST['full_name'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $email = $_POST['email'];

        // Проверка валидности имени
        if(!preg_match("/^[а-яё\s]+$/iu", $full_name))
        {
            $msq['full_name'] = "Некорректное имя пользователя";
            $count_error++;
        }

        // Проверка валидности логина
        if(!preg_match("/^[a-z0-9_-]{2,20}$/i", $login))
        {
            $msg['login'] = "Логин может состоять только из английских символов, а также - и _";
            $count_error++;
        }
        // Проверка отсутствия такого логина в БД
        else
        {
            if (check_login($login, $pdo))
            {
                $msg['login'] = "Этот логин уже занят, выберите другой";
                $count_error++;
            }
        }

        // Проверка валидности адреса почты
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $msg['email'] = "Адрес почты указан неверно";
            $count_error++;
        }
        // Проверка отсутствия регистрации по указанной почте
        else
        {
            if (check_email($email, $pdo))
            {
                $msg['email'] = "Эта почта уже занята, выберите другую";
                $count_error++;
            }
        }

        // Проверка валидности пароля
        // Проверка отсутствия русских букв
        if (preg_match('/[а-яА-Я]/',$password))
        {
            $msg['password'] = "Пароль не может содержать русских букв";
            $count_error++;
        }
        // Проверка размерности пароля
        else if(strlen($password) < 7)
        {
            $msg['password'] = "Пароль должен быть длиннее 6 символов";
            $count_error++;
        }

        // Проверка совпадения паролей
        if( !($password == $password_confirm) )
        {
            $msg['check_password'] = "Пароли не совпадают";
            $count_error++;
        }


        // Добавляем запись в БД если ошибок при вводе не было
        if ($count_error == 0)
        {
            // Хэшируем пароль
            $password = md5($password);

            // Корректная запись даты в БД
            $date = $_POST['date'];
            $date = date('Y-m-d');

            // Массив для запроса
            $query = array(
                'login' => $login,
                'full_name' => $full_name,
                'password' => $password,
                'email' => $email
            );

            // Создание запроса
            $sql = "INSERT INTO `user` ";
            $list = " (`login`,`full_name`,`password`,`email`";
            $values = " VALUES (:login, :full_name, :password,  :email";

            // Отправляет дату в БД, иначе записывается NULL
            if (!empty($_POST['date']))
            {
                $date = date('Y-m-d', $_POST['date']);
                $query['date'] = $date;
                $list = $list . ", `date_of_birth`";
                $values = $values . ", :date";
            }
            // Отправляет адрес в БД, иначе записывается NULL
            if (!empty($_POST['address']))
            {
                $query['address'] = $_POST['address'];
                $list = $list . ", `address`";
                $values = $values . ", :address";
            }
            // Отправляет интересы в БД, иначе записывается NULL
            if (!empty($_POST['$interest']))
            {
                $query['interest'] = $_POST['interest'];
                $list = $list . ", `interests`";
                $values = $values . ", :interest";
            }
            // Отправляет ссылку на вк в БД, иначе записывается NULL
            if (!empty($_POST['link_to_VK']))
            {
                $query['linkToVk'] = $_POST['linkToVK'];
                $list = $list . ", `link_to_VK`";
                $values = $values . ", :linkToVk";
            }
            // Отправляет группу крови в БД, иначе записывается NULL
            if (!empty($_POST['blood_type']))
            {
                $query['blood_type'] = $_POST['blood_type'];
                $list = $list . ", `blood_type`";
                $values = $values . ", :blood_type";
            }
            // Отправляет резус-фактор в БД, иначе записывается NULL
            if (!empty($_POST['rhesus_factor']))
            {
                $query['rhesus_factor'] = $_POST['rhesus_factor'];
                $list = $list . ", `rhesus_factor`";
                $values = $values . ", :rhesus_factor";
            }

            $list = $list . ")";
            $values = $values . ")";

            $sql = $sql . $list . $values;
            echo $sql;
            $stmt = $pdo->prepare($sql);
            $stmt->execute($query);

            header("Location:index.php");
        }
        // Если была ошибка при вводе
        else
            $msg_err = "Ошибка регистрации";
    }
    // Выводы об ошибках если поле пусто
    else if ($_POST)
    {
        if (empty($_POST['login']))
            $msg['login'] = "Вы ничего не ввели";
        else
        {
            $bool = check_login($_POST['login'], $pdo);
            if ($bool == 1)
            {
                $msg['login'] = "Этот логин уже занят, выберите другой";
                $count_error++;
            }
        }

        if (empty($_POST['full_name']))
            $msg['full_name'] = "Вы ничего не ввели";

        if (empty($_POST['email']))
            $msg['email'] = "Вы ничего не ввели";
        else
        {
            $bool = check_email($_POST['email'], $pdo);
            if ($bool == 1)
            {
                $msg['email'] = "Эта почта уже занята, выберите другую";
                $count_error++;
            }
        }

        if (empty($_POST['password']))
            $msg['password'] = "Вы ничего не ввели";

        if (empty($_POST['check_password']))
            $msg['check_password'] = "Вы ничего не ввели";
    }