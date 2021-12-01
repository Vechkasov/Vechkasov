<?php

// Запрос для категорий из БД
$one = $pdo->query("SELECT * FROM `product_category`");

// Массив для хранения категорий из БД
$category = array();
while ($row = $one->fetch(PDO::FETCH_ASSOC))
    $category[] = $row["name_category"];

// Сохранение записей из БД в переменную
function Show($result)
{
    $i = 0;
    // Массив для данных из БД
    $text = array(array());
    while ($param = $result->fetch(PDO::FETCH_ASSOC))
    {
        $text[$i]['img_path'] = "source/catalog_images/" . $param['img_path'];
        $text[$i]['name'] = $param['name'];
        $text[$i]['name_category'] = $param['name_category'];
        $text[$i]['description'] = $param['description'];
        $text[$i]['cost'] = $param['cost'];
        $i++;
    }

    // Возвращает массив с данными из БД если они есть
    if ($i != 0)
        return $text;
    // Возвращает false если ничего не найдено
    else
        return 0;
}

// Запрос к БД для общей проверки
$sql = "SELECT `name`, `name_category`, `id_product` , `img_path`, `description`, `cost` FROM `product` INNER JOIN `product_category` ON `id_product_category` = `id_product`";
$result = $pdo->query($sql);

// Переменная для вывода данных из БД
$text = "";
// Переменная для ошибок
$error = "";

// Срабатывает при первом открытии страницы
// при нажатии на кнопку "Очистить фильтр"
// и при отправке пустого запроса
if(isset($_GET["clearFilter"]) || (!$_GET) || ((!$_GET['category']) and (!$_GET['name']) and (!$_GET['description']) and (!$_GET['costFrom']) and (!$_GET['costTo'])))
    $text = Show($result);
// Иначе обрабатывает запрос;
else {
    // В эту переменную будем добавлять запросы
    $sqlFil = $sql;

    // Массив для отправки данных в БД
    $toDataBase = array();

    // Счетчик заданных параметров
    $i = 0;

    // Категория продукта
    if ($_GET['category']) {
        $sqlFil = "$sqlFil WHERE `id_product` = :category";
        $toDataBase['category'] = $_GET['category'];
        $i++;
    }

    // Название продукта
    if ($_GET['name']) {
        $i == 0 ? ($sqlFil .= " WHERE ") : ($sqlFil .= " AND ");
        $sqlFil .= "LOCATE(:name, `name`)";
        $toDataBase['name'] = trim($_GET['name']);
        $i++;
    }

    // Описание продукта
    if ($_GET['description']) {
        $i == 0 ? ($sqlFil .= " WHERE ") : ($sqlFil .= " AND ");
        $sqlFil .= "LOCATE(:description, `description`)";
        $toDataBase['description'] = trim($_GET['description']);
        $i++;
    } // Только от
    else if ($_GET['costFrom'] && !$_GET['costTo']) {
        $i == 0 ? ($sqlFil .= " WHERE ") : ($sqlFil .= " AND ");
        $sqlFil .= "`cost` >= :costFrom";
        $toDataBase['costFrom'] = $_GET['costFrom'];
        $i++;
    } // Только до
    else if (!$_GET['costFrom'] && $_GET['costTo']) {
        $i == 0 ? ($sqlFil .= " WHERE ") : ($sqlFil .= " AND ");
        $sqlFil .= "`cost` <= :costTo";
        $toDataBase['costTo'] = $_GET['costTo'];
        $i++;
    }

    // От и до
    if ($_GET['costFrom'] && $_GET['costTo']) {
        if ($_GET['costFrom'] > $_GET['costTo']) {
            $error = "<h2>Ошибка ввода (цена от больше цены до)</h2>";
            $i = -1;
        } else {
            $i == 0 ? ($sqlFil .= " WHERE ") : ($sqlFil .= " AND ");
            $sqlFil .= "`cost` BETWEEN :costFrom AND :costTo";
            $toDataBase['costFrom'] = $_GET['costFrom'];
            $toDataBase['costTo'] = $_GET['costTo'];
            $i++;
        }
    }

    // Отправка запроса
    if ($i > 0) {
        // Подготовить запрос
        $stmt = $pdo->prepare($sqlFil);
        // Выполняет запрос
        $stmt->execute($toDataBase);
        $text = Show($stmt);
        // Сообщить об отсутствии данных
        if ($text == 0)
            $error = "Ничего не найдено";
    } // В отправленном запросе не было параметров
    else if ($i == 0)
        $text = Show($result);
}