<?php

    $category = Database::getCategories();

    if ($_POST && $_POST['name'] && $_POST['description'] && $_POST['cost'] && $_POST['category'] && isset($_FILES['image']) && !empty($_FILES['image']['tmp_name']))
    {
        // Введенная цена товара не является числом
        if (!is_numeric($_POST['cost']))
            $message['cost'] = "Ошибка, вы ввели не число";
        else if ($_POST['cost'] < 0)
            $message['cost'] = "Ошибка, вы ввели отрицательное число";

        $pattern = '/[а-яёА-ЯЁa-zA-Z0-9&\s.,-]+$/u';

        // Проверка названия товара
        if (!preg_match($pattern, $_POST['name']))
            $message['name'] = "Название товара содержит неподходящие символы";

        // Проверка описания товара
        if (!preg_match($pattern, $_POST['description']))
            $message['description'] = "Описание содержит неподходящие символы";

        if (!preg_match('/[а-яёА-ЯЁa-zA-Z0-9&_.,-]+(img|png|gif)$/u', $_FILES['image']['name'])) {
            $message['image'] = "Ожидалось расширение типа img|png|gif";
        }

        if (!isset($message))
        {
            $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/LR6/source/images/";
            $new_name = $upload_dir . $_FILES['image']['name'];

            move_uploaded_file($_FILES['image']['tmp_name'], $new_name);

            $handle = fopen($new_name, 'r');
            $content = fread($handle, filesize($new_name));
            fclose($handle);

            Database::addProduct($_POST['name'], $_POST['description'], intval($_POST['category']), intval($_POST['cost']), $_FILES['image']['name']);
            header("Location: index.php");
        }
    }
    else if ($_POST)
    {
        if (empty($_POST['name']))
            $message['name'] = "Вы не ввели название товара";
        if (empty($_POST['cost']))
            $message['cost'] = "Вы не ввели цену товара";
        if (empty($_POST['description']))
            $message['description'] = "Вы не ввели описание товара";
        if (isset($_FILES['image']) && empty($_FILES['image']['tmp_name']))
            $message['image'] = "Вы не отправили файл";
    }