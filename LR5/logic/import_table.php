<?php
    $message = "";

    /*
        Проверка файла на формат JSON
     */
    function check_json_format($path)
    {
        if (json_decode($path) == null)
            return false;
        else
            return  true;
    }

    /*
        Проверка JSON-файла на корректность имен ключей массива
        и на их количество
     */
    function check_keys($content)
    {
        if (count($content) > 1 && isset($content[0]))
        {
            for ($i = 0 ; $i < count($content) ; $i++)
                if (array_key_exists('name', $content[$i]) && array_key_exists('description', $content[$i]) && array_key_exists('id_product', $content[$i]) && array_key_exists('img_path', $content[$i]) && array_key_exists('cost', $content[$i]) && count(array_keys($content[$i])) == 5)
                    continue;
                else
                    return false;
            return true;
        }
        else
            if (array_key_exists('name', $content) && array_key_exists('description', $content) && array_key_exists('id_product', $content) && array_key_exists('img_path', $content) && array_key_exists('cost', $content) && count(array_keys($content)) == 5)
                return true;
            else
                return false;
    }

    /*
        Обновляет таблицу, заполняя новыми данными
    */
    function update_table($content, $pdo)
    {
        $count = 0;
        $sql = "DELETE FROM product_export;ALTER TABLE product_export AUTO_INCREMENT=0;";
        $pdo->query($sql);
        if (count($content) > 1 && isset($content[0]))
        {
            for($i = 0; $i < count($content) ; $i++)
            {
                $sql = "INSERT INTO product_export(name,description,cost,img_path,id_product) VALUES (:name,:description,:cost,:img_path,:id_product)";
                $to_database = array(
                    'name' => $content[$i]['name'],
                    'description' => $content[$i]['description'],
                    'cost' => $content[$i]['cost'],
                    'img_path' => $content[$i]['img_path'],
                    'id_product' => $content[$i]['id_product']
                );
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute($to_database))
                    $count++;
            }
        }
        else
        {
            $sql = "INSERT INTO product_export(name,description,cost,img_path,id_product) VALUES (:name,:description,:cost,:img_path,:id_product)";
            $to_database = array(
                'name' => $content['name'],
                'description' => $content['description'],
                'cost' => $content['cost'],
                'img_path' => $content['img_path'],
                'id_product' => $content['id_product']
            );
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute($to_database))
                $count++;
        }
        return $count;
    }

    /*
        Срабатывает при отправке файла
     */
    if ('POST' == $_SERVER['REQUEST_METHOD'] && isset($_FILES['import_file']) && !empty($_FILES['import_file']['tmp_name']))
    {

        /*
            Скачивание файла в папку
            локального сервера
        */
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/LR4/uploads/";
        $new_name = $upload_dir . md5($_FILES['import_file']['tmp_name']);

        move_uploaded_file($_FILES['import_file']['tmp_name'], $new_name);

        $handle = fopen($new_name, 'r');
        $content = fread($handle, filesize($new_name));
        fclose($handle);


        /*
            Вывести сообщение об ошибке
            если файл не в формате JSON
         */
        if (!check_json_format($content))
            $message = "Вы ввели неподходящий формат";
        else
        {
            $content = json_decode($content, true);
            $count = 0;

            if (!check_keys($content))
                $message = "Ключи не совпадают";
            else
            {
                $count = update_table($content, $pdo);
                if ($count > 0)
                    $message = "Ваш файл был принят<br>Добавлено $count записи";
                else
                    $message = "Ошибка добавления записей";
            }

        }
        unlink($new_name);
    }
    /*
        Выводит сообщение об отсутствии запрашиваемого файла
     */
    else if ('POST' == $_SERVER['REQUEST_METHOD'] && isset($_FILES['import_file']) && empty($_FILES['import_file']['tmp_name']))
        $message = "Вы не отправили файл";