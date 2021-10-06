<?php
// id_product добавил для проверки ввода категории и вывода подходящего товара ($_POST["category"] передает id категории)
$sql = "SELECT `name`, `name_category`, `id_product` , `img_path`, `description`, `cost` FROM `product` INNER JOIN `product_category` ON `id_product_category` = `id_product`";
$result = $pdo->query($sql);

// переменная для вывода категория в выпадающий список
$category = '';
$one = $pdo->query('SELECT * FROM `product_category`');
$i = 1;
while ($row = $one->fetch(PDO::FETCH_ASSOC))
{
    $category = $category . '<option value="' . $i .'">' . $row['name_category'] . '</option>';
    $i++;
}

// переменная для вывода на месте данных из БД
$text = '';

// флаг - есть ли данные из БД для вывода
$fl = false;

// выводит все данные из БД если очищаем фильтр
// и если не вводим ничего в фильтр
if(isset($_GET["clearFilter"]) or !$_GET)
{
    if ($_SESSION['user'])
    {
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $text = $text . "<tr>" .
                "<th scope='row'><img src=" .  'source/catalog_images/' .  $row['img_path'] . " width='200px'></th>" .
                "<td>" .$row['name'] . "</td>" .
                "<td>" .$row['name_category'] . "</td>" .
                "<td>" .$row['description'] . "</td>" .
                "<td>" .$row['cost'] . "</td>" .
                "</tr>";
        }
    }
    else
    {
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $text = $text . "<tr>" .
                "<td>" .$row['name'] . "</td>" .
                "<td>" .$row['name_category'] . "</td>" .
                "<td>" .$row['description'] . "</td>" .
                "<td>" .$row['cost'] . "</td>" .
                "</tr>";
        }
    }
}
else if ($_GET)
{
    $sqlFil = $sql;
    $zapros = array();
    $i = 0;

    // категория продукта
    if ($_GET['category'])
    {
        $sqlFil = $sqlFil . " WHERE `id_product` = :category";
        $i++;
        $zapros['category'] = $_GET['category'];
        settype($zapros['category'], "integer");
    }

    // название продукта
    if ($_GET['name'])
    {
        if ($i == 0)
            $sqlFil = $sqlFil . " WHERE LOCATE(:name, `name`)";
        else
            $sqlFil = $sqlFil . " AND LOCATE(:name, `name`)";
        $zapros['name'] = trim($_GET['name']);
        $i++;
    }

    // описание продукта
    if ($_GET['description'])
    {
        if ($i == 0)
            $sqlFil = $sqlFil . " WHERE LOCATE(:description, `description`);";
        else
            $sqlFil = $sqlFil . " AND LOCATE(:description, `description`);";
        $zapros['description'] = trim($_GET['description']);
        $i++;
    }

    // от и до
    if ($_GET['costFrom'] and $_GET['costTo'])
    {
        if ($_GET['costFrom'] > $_GET['costTo']) {
            $text = "<h2>Ошибка ввода (цена от больше цены до)</h2>";
            $i = -1;
            $fl = true;
        }
        else
        {
            if ($i == 0)
                $sqlFil = $sqlFil . " WHERE `cost` >= :costFrom AND `cost` <= :costTo";
            else
                $sqlFil = $sqlFil . " AND `cost` >= :costFrom AND `cost` <= :costTo";
            $zapros['costFrom'] = $_GET['costFrom'];
            $zapros['costTo'] = $_GET['costTo'];
            $i++;
        }
    }
    // только от
    else if ($_GET['costFrom'] and !$_GET['costTo'])
    {
        if ($i == 0)
            $sqlFil = $sqlFil . " WHERE `cost` >= :costFrom";
        else
            $sqlFil = $sqlFil . " AND `cost` >= :costFrom";
        $zapros['costFrom'] = $_GET['costFrom'];
        $i++;
    }
    // только до
    else if (!$_GET['costFrom'] and $_GET['costTo'])
    {
        if ($i == 0)
            $sqlFil = $sqlFil . " WHERE `cost` <= :costTo";
        else
            $sqlFil = $sqlFil . " AND `cost` <= :costTo";
        $zapros['costTo'] = $_GET['costTo'];
        $i++;
    }

    // отправка запроса
    if ($i > 0)
    {
        $count = 0;
        $text = "";
        $stmt = $pdo->prepare($sqlFil);
        $stmt->execute($zapros);
        if ($_SESSION['user'])
        {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $text = $text . "<tr>" .
                    "<th scope='row'><img src=" . 'source/catalog_images/' . $row['img_path'] . " width='200px'></th>" .
                    "<td>" . $row['name'] . "</td>" .
                    "<td>" . $row['name_category'] . "</td>" .
                    "<td>" . $row['description'] . "</td>" .
                    "<td>" . $row['cost'] . "</td>" .
                    "</tr>";
                $count++;
            }
        }
        else
        {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $text = $text . "<tr>" .
                    "<td>" . $row['name'] . "</td>" .
                    "<td>" . $row['name_category'] . "</td>" .
                    "<td>" . $row['description'] . "</td>" .
                    "<td>" . $row['cost'] . "</td>" .
                    "</tr>";
                $count++;
            }
        }

        if ($count == 0)
        {
            $text = "<h2>Ничего не найдено</h2>";
            $fl = true;
        }

    }
    else if ($i == 0)
    {
        if ($_SESSION['user'])
        {
            while ($row = $result->fetch(PDO::FETCH_ASSOC))
            {
                $text = $text . "<tr>" .
                    "<th scope='row'><img src=" .  'source/catalog_images/' .  $row['img_path'] . " width='200px'></th>" .
                    "<td>" .$row['name'] . "</td>" .
                    "<td>" .$row['name_category'] . "</td>" .
                    "<td>" .$row['description'] . "</td>" .
                    "<td>" .$row['cost'] . "</td>" .
                    "</tr>";
            }
        }
        else
        {
            while ($row = $result->fetch(PDO::FETCH_ASSOC))
            {
                $text = $text . "<tr>" .
                    "<td>" .$row['name'] . "</td>" .
                    "<td>" .$row['name_category'] . "</td>" .
                    "<td>" .$row['description'] . "</td>" .
                    "<td>" .$row['cost'] . "</td>" .
                    "</tr>";
            }
        }
    }
}