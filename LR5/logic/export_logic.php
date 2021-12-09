<?php

    $message = "";

    if (isset($_POST['path']))
    {
        if (!empty($_POST['path']))
        {
            $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/LR5/uploads/";
            $path = $upload_dir . md5($_POST['path']);

            if (file_exists($path))
            {
                $sql = "SELECT name, id_product , img_path, description, cost FROM product_export";
                $result = $pdo->query($sql);

                $i = 0;

                // Массив для данных из БД
                $text = array(array());
                while ($param = $result->fetch(PDO::FETCH_ASSOC))
                {
                    $text[$i]['img_path'] = $param['img_path'];
                    $text[$i]['name'] = $param['name'];
                    $text[$i]['id_product'] = $param['id_product'];
                    $text[$i]['description'] = $param['description'];
                    $text[$i]['cost'] = $param['cost'];
                    $i++;
                }

                // Записываем массив в JSON
                $content = json_encode($text, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

                // Записываем JSON в файл
                $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/LR5/uploads/" . $_POST['path'], "w+");
                fwrite($fp, $content);
                fclose($fp);
            }
            else
                $message = "Файла с таким названием не найдено";
        }
        else
            $message = "Вы ничего не ввели";
    }
