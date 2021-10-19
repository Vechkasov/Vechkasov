<?php
// id_product добавил для проверки ввода категории и вывода подходящего товара ($_POST["category"] передает id категории)
$sql = "SELECT `name`, `name_category`, `id_product` , `img_path`, `description`, `cost` FROM `product` INNER JOIN `product_category` ON `id_product_category` = `id_product`";
$result = $pdo->query($sql);

// Категории из БД
$one = $pdo->query('SELECT * FROM `product_category`');
$val = 1;
$category = "";
while ($row = $one->fetch(PDO::FETCH_ASSOC))
{
    $category = $category  . "<option value=$val>$row[name_category]</option>";
    $val++;
}

// переменная для вывода на месте данных из БД
$text = '';

// Запись записей из БД в переменную в табличном виде
// Авторизованный пользователь
function ShowUser($result)
{
    $text = "";
    while ($param = $result->fetch(PDO::FETCH_ASSOC))
    {
        $text = $text . "<tr>" .
            "<th scope='row'><img src='source/catalog_images/$param[img_path]' width='200px'></th>" .
            "<td>$param[name]</td>" .
            "<td>$param[name_category]</td>" .
            "<td>$param[description]</td>" .
            "<td>$param[cost]</td>" .
            "</tr>";
    }
    if ($text != "")
        $text = "<thead>
                   <tr>
                        <th scope=col>Изображение</th>
                        <th scope=col>Наименование</th>
                        <th scope=col>Категория</th>
                        <th scope=col>Описание</th>
                        <th scope=col>Стоимость</th>
                   </tr>
             </thead>" . $text;
    return $text;
}
// Гость
function ShowGuest($result)
{
    $text = "";
    while ($param = $result->fetch(PDO::FETCH_ASSOC))
    {
        $text = $text . "<tr>" .
            "<td>$param[name]</td>" .
            "<td>$param[name_category]</td>" .
            "<td>$param[description]</td>" .
            "<td>$param[cost]</td>" .
            "</tr>";
    }
    if ($text != "")
        $text = "<thead>
                   <tr>
                        <th scope=col>Наименование</th>
                        <th scope=col>Категория</th>
                        <th scope=col>Описание</th>
                        <th scope=col>Стоимость</th>
                        </tr>
             </thead>" . $text;
    return $text;
}

// При очистке фильтра выводит все данные из БД
// Также выводит все данные из БД при первом открытии
// (запрос GET ещё не был отправлен)
if(isset($_GET["clearFilter"]) || !($_GET))
{
    // Если пользователь авторизован, то показать изображения
    if ($_SESSION['user'])
        $text = ShowUser($result);
    // Иначе не показывать изображения
    else
        $text = ShowGuest($result);
}
// Обработка отправленного запроса
else
{
    // В эту переменную будем добавлять запросы
    $sqlFil = $sql;

    // Массив для отправки данных в БД
    $zapros = array();

    // Счетчик заданных параметров
    // становится отрицательным при ошибке
    // (ввели цену от 50 до 1 - ошибка)
    $i = 0;

    // категория продукта
    if ($_GET['category'])
    {
        $sqlFil = "$sqlFil WHERE `id_product` = :category";
        $i++;
        $zapros['category'] = $_GET['category'];
        settype($zapros['category'], "integer");
    }

    // название продукта
    if ($_GET['name'])
    {
        if ($i == 0)
            $sqlFil = "$sqlFil WHERE LOCATE(:name, `name`)";
        else
            $sqlFil = "$sqlFil AND LOCATE(:name, `name`)";
        $zapros['name'] = trim($_GET['name']);
        $i++;
    }

    // описание продукта
    if ($_GET['description'])
    {
        if ($i == 0)
            $sqlFil = "$sqlFil WHERE LOCATE(:description, `description`);";
        else
            $sqlFil = "$sqlFil AND LOCATE(:description, `description`);";
        $zapros['description'] = trim($_GET['description']);
        $i++;
    }

    // от и до
    if ($_GET['costFrom'] && $_GET['costTo'])
    {
        if ($_GET['costFrom'] > $_GET['costTo']) {
            $text = "<h2>Ошибка ввода (цена от больше цены до)</h2>";
            $i = -5;
        }
        else
        {
            if ($i == 0)
                $sqlFil = "$sqlFil WHERE `cost` >= :costFrom AND `cost` <= :costTo";
            else
                $sqlFil = "$sqlFil AND `cost` >= :costFrom AND `cost` <= :costTo";
            $zapros['costFrom'] = $_GET['costFrom'];
            $zapros['costTo'] = $_GET['costTo'];
            $i++;
        }
    }
    // только от
    else if ($_GET['costFrom'] && !$_GET['costTo'])
    {
        if ($i == 0)
            $sqlFil = "$sqlFil WHERE `cost` >= :costFrom";
        else
            $sqlFil = "$sqlFil AND `cost` >= :costFrom";
        $zapros['costFrom'] = $_GET['costFrom'];
        $i++;
    }
    // только до
    else if (!$_GET['costFrom'] && $_GET['costTo'])
    {
        if ($i == 0)
            $sqlFil = "$sqlFil WHERE `cost` <= :costTo";
        else
            $sqlFil = "$sqlFil AND `cost` <= :costTo";
        $zapros['costTo'] = $_GET['costTo'];
        $i++;
    }
    // отправка запроса
    if ($i > 0)
    {
        $stmt = $pdo->prepare($sqlFil);
        $stmt->execute($zapros);
        if ($_SESSION['user'])
            $text = ShowUser($stmt);
        else
            $text = ShowGuest($stmt);
        if ($text == "")
            $text = "<h2>Ничего не найдено</h2>";
    }
    // В отправленном запросе не было параметров
    else if ($i == 0)
    {
        if ($_SESSION['user'])
            $text = ShowUser($result);
        else
            $text = ShowGuest($result);
    }
}