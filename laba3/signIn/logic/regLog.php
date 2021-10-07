<?php

    // обрабатывает ошибки отправки формы на сервере (теперь)

    // сначала смотрит, все ли важные поля заполнены
    // только потом проверяет их на уникальность и соответствие
    // после отправки формы данные остаются на своих местах (кроме пароля)

    // сообщения об ошибках
    $msq = array(
        'full_name'=>'',
        'login'=>'',
        'password' =>'',
        'check_password' => '',
        'email' =>''
    );

    // количество ошибок
    $countE = 0;

    // сообщение об ошибке регистрации
    $msg_err = '';

    if ($_POST and $_POST['login'] and $_POST['full_name'] and $_POST['password'] and $_POST['password_confirm'] and $_POST['email'])
    {
        // для читабельности
        $login = $_POST['login'];
        $full_name = $_POST['full_name'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $email = $_POST['email'];

        // проверка валидности имени
        if(!preg_match("/^[а-яё\s]+$/iu", $full_name))
        {
            $msq['full_name'] = "Некорректное имя пользователя";
            $countE++;
        }
        else
        {
            // отправляем запрос
            $zapros = array('full_name' => $full_name);
            $sql = 'SELECT * FROM `user` WHERE `full_name` = :full_name';
            $stmt = $pdo->prepare($sql);
            $stmt->execute($zapros);

            // смотрим, есть ли регистрация по этой же почте
            $count = $stmt->rowCount();
            if ($count > 0)
            {
                $msq['$full_name'] = "Пользователь с таким именем уже зарегистрирован";
                $countE++;
            }
        }

        // проверка валидности логина
        if(!preg_match("/^[a-z0-9_-]{2,20}$/i", $login))
        {
            $msq['login'] = "Логин может состоять только из английских символов, а также - и _";
            $countE++;
        }
        // проверка отсутствия такого логина в БД
        else
        {
            // отправляем запрос
            $zapros = array('login' => $login);
            $sql = 'SELECT * FROM `user` WHERE `login` = :login';
            $stmt = $pdo->prepare($sql);
            $stmt->execute($zapros);

            // смотрим, есть ли регистрация по этой же почте
            $count = $stmt->rowCount();
            if ($count > 0)
            {
                $msq['login'] = "Этот логин уже занят, выберите другой";
                $countE++;
            }
        }

        // проверка валидности адреса почты
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $msq['email'] = "Адрес почты указан неверно";
            $countE++;
        }
        // проверка отсутствия регистрации по указанной почте
        else
        {
            // отправляем запрос
            $zapros = array('email' => $email);
            $sql = 'SELECT * FROM `user` WHERE (`email` = :email)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute($zapros);

            // смотрим, есть ли регистрация по этой же почте
            $count = $stmt->rowCount();
            if ($count > 0)
            {
                $msq['email'] = "Эта почта уже занята, выберите другую";
                $countE++;
            }
        }

        // проверка валидности пароля
        // проверка отсутствия русских букв
        if (preg_match('/[а-яА-Я]/',$password))
        {
            $msq['password'] = "Пароль не может содержать русских букв";
            $countE++;
        }
        // проверка размерности пароля
        else if(strlen($password) < 7)
        {
            $msq['password'] = "Пароль должен быть длиннее 6 символов";
            $countE++;
        }

        // проверка совпадения паролей
        if( !($password == $password_confirm) )
        {
            $msq['check_password'] = "Пароли не совпадают";
            $countE++;
        }


        // добавляем запись в БД если ошибок при вводе не было
        if ($countE == 0)
        {
            // хэшируем пароль
            $password = md5($password);

            // корректная запись даты в БД
            $date = $_POST['date'];
            $date = date('Y-m-d');

            // массив для запроса
            $zapros = array(
                'login' => $login,
                'full_name' => $full_name,
                'password' => $password,
                'email' => $email
            );

            // создание запроса
            $sql = "INSERT INTO `user` ";
            $list = " (`login`,`full_name`,`password`,`email`";
            $values = " VALUES (:login, :full_name, :password,  :email";

            // отправляет дату в БД, иначе записывается NULL
            if (!empty($_POST['date']))
            {
                $date = $_POST['date'];
                $date = date('Y-m-d');
                $zapros['date'] = $date;
                $list = $list . ", `date_of_birth`";
                $values = $values . ", :date";
            }
            // отправляет адрес в БД, иначе записывается NULL
            if (!empty($_POST['address']))
            {
                $zapros['address'] = $_POST['address'];
                $list = $list . ", `address`";
                $values = $values . ", :address";
            }
            // отправляет интересы в БД, иначе записывается NULL
            if (!empty($_POST['$interest']))
            {
                $zapros['interest'] = $_POST['interest'];
                $list = $list . ", `interests`";
                $values = $values . ", :interest";
            }
            // отправляет ссылку на вк в БД, иначе записывается NULL
            if (!empty($_POST['link_to_VK']))
            {
                $zapros['linkToVk'] = $_POST['linkToVK'];
                $list = $list . ", `link_to_VK`";
                $values = $values . ", :linkToVk";
            }
            // отправляет группу крови в БД, иначе записывается NULL
            if (!empty($_POST['blood_type']))
            {
                $zapros['blood_type'] = $_POST['blood_type'];
                $list = $list . ", `blood_type`";
                $values = $values . ", :blood_type";
            }
            // отправляет резус-фактор в БД, иначе записывается NULL
            if (!empty($_POST['rhesus_factor']))
            {
                $zapros['rhesus_factor'] = $_POST['rhesus_factor'];
                $list = $list . ", `rhesus_factor`";
                $values = $values . ", :rhesus_factor";
            }

            $list = $list . ")";
            $values = $values . ")";

            $sql = $sql . $list . $values;
            echo $sql;
            $stmt = $pdo->prepare($sql);
            $stmt->execute($zapros);

            // сбросим блокировку и попытки после регистрации
            $_SESSION['guest']['lock'] = false;
            $_SESSION['guest']['try'] = 0;

            header("Location:autho.php");
        }
        // если была ошибка при вводе
        else
            $msg_err = "Ошибка регистрации";
    }
    // выводы о ошибках если поле пусто
    else if ($_POST)
    {
        if (!$_POST['login'])
            $msq['login'] = "Вы ничего не ввели";
        if (!$_POST['full_name'])
            $msq['full_name'] = "Вы ничего не ввели";
        if (!$_POST['email'])
            $msq['email'] = "Вы ничего не ввели";
        if (!$_POST['password_confirm'])
            $msq['password_confirm'] = "Вы ничего не ввели";
        if (!$_POST['password'])
            $msq['password'] = "Вы ничего не ввели";
    }