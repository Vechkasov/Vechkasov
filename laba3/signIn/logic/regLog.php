<?php
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

    if ($_POST)
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

            // переменные для дополнительных данных
            $date = $_POST['date'];
            $address = $_POST['address'];
            $interest = $_POST['interest'];
            $linkToVK = $_POST['linkToVK'];
            $blood_type = $_POST['blood_type'];
            $rhesus_factor = $_POST['rhesus_factor'];

            // создание запроса
            $sql = "INSERT INTO `user` ";
            $list = " (`login`,`full_name`,`password`,`email`";
            $values = " VALUES ('" . $login ."', ' " . $full_name . "', '" . $password . "', '" . $email . "'";

            // отправляет дату в БД, иначе записывается NULL
            if ($date)
            {
                $date = date('Y-m-d');
                $list = $list . ", `date_of_birth`";
                $values = $values . ", '" . $date . "'";
            }
            // отправляет адрес в БД, иначе записывается NULL
            if ($address)
            {
                $list = $list . ", `address`";
                $values = $values . ", '" . $address . "'";
            }
            // отправляет интересы в БД, иначе записывается NULL
            if ($interest)
            {
                $list = $list . ", `interests`";
                $values = $values . ", '" . $interest . "'";
            }
            // отправляет ссылку на вк в БД, иначе записывается NULL
            if ($linkToVK)
            {
                $list = $list . ", `link_to_VK`";
                $values = $values . ", '" . $linkToVK . "'";
            }
            // отправляет группу крови в БД, иначе записывается NULL
            if ($blood_type)
            {
                $list = $list . ", `blood_type`";
                $values = $values . ", '" . $blood_type . "'";
            }
            // отправляет резус-фактор в БД, иначе записывается NULL
            if ($rhesus_factor)
            {
                $list = $list . ", `rhesus_factor`";
                $values = $values . ", '" . $rhesus_factor . "'";
            }

            $list = $list . ")";
            $values = $values . ")";

            $sql = $sql . $list . $values;
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            header("Location:autho.php");
        }
        // если была ошибка при вводе
        else
            $msg_err = "Ошибка регистрации";
    }