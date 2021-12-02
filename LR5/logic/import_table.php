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

function update_table($content,$pdo)
{
    $add = 0;
    $update = 0;
    // Если записей много
    if (count($content) > 1 && isset($content[0]['name']))
    {
        // Записываем новые данные в продукты со схожими именами
        for($i = 0; $i < count($content) ; $i++)
        {
            $sql =  "UPDATE product_export " .
                "SET img_path = :img_path, id_product = :id_product, cost = :cost, description = :description " .
                "WHERE name = :name ";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute($content[$i]))
            {
                unset($content[$i]);
                $update++;
            }
        }
        // Добавляем новые записи оставшихся продуктов
        for($i = 0; $i < count($content) ; $i++)
        {
            if (isset($content[$i]))
            {
                $sql =  "INSERT INTO product_export(img_path, name, id_product, cost, description)" .
                    "VALUES(:img_path, :name, :id_product, :cost, :description)";
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute($content))
                    $add++;
            }
        }
        return "Изменено $update записей, добавлено $add записей";
    }
    else
    {
        $sql =  "UPDATE product_export " .
            "SET img_path = :img_path, id_product = :id_product, cost = :cost, description = :description " .
            "WHERE name = :name ";
        $stmt = $pdo->prepare($sql);
        if (!$stmt->execute($content)) {
            $sql = "INSERT INTO product_export(img_path, name, id_product, cost, description)" .
                "VALUES(:img_path, :name, :id_product, :cost, :description)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($content);
        }
        return 1;
    }
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
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/LR5/uploads/";
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
    {
        $message = "Вы ввели неподходящий формат";
        unlink($new_name);
    }
    else
    {
        $content = json_decode($content, true);
        $count = 0;

        if (!check_keys($content))
        {
            $message = "Ключи не совпадают";
            unlink($new_name);
        }
        else
        {
            $count = update_table($content, $pdo);
            $message = "Ваш файл был принят<br>$count";
        }
    }
}
/*
    Выводит сообщение об отсутствии запрашиваемого файла
 */
else if ('POST' == $_SERVER['REQUEST_METHOD'] && isset($_FILES['import_file']) && empty($_FILES['import_file']['tmp_name']))
    $message = "Вы не отправили файл";