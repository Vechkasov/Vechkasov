<?php
    require_once "db.php";
    // id_product добавил для проверки ввода категории и вывода подходящего товара ($_POST["category"] передает id категории)
    $sql = "SELECT `name`, `name_category`, `id_product` , `img_path`, `description`, `cost` FROM `product` INNER JOIN `product_category` ON `id_product_category` = `id_product`";
    $result = $pdo->query($sql);

    // очистка фильтра
    // вывод начального списка товаров
    if( isset( $_POST['clearFilter'] ) )
    {
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $text = "<tr>" .
                        "<th scope='row'><img src=" .  'catalog_images/' .  $row['img_path'] . " width='200px'></th>" .
                        "<td>" .$row['name'] . "</td>" .
                        "<td>" .$row['name_category'] . "</td>" .
                        "<td>" .$row['description'] . "</td>" .
                        "<td>" .$row['cost'] . "</td>" .
                      "</tr>";
            echo $text;
        }

    }
    // начальное заполнение сайта товарами
    if (empty($_POST))
    {
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $text = "<tr>" .
                "<th scope='row'><img src=" .  'catalog_images/' .  $row['img_path'] . " width='200px'></th>" .
                "<td>" .$row['name'] . "</td>" .
                "<td>" .$row['name_category'] . "</td>" .
                "<td>" .$row['description'] . "</td>" .
                "<td>" .$row['cost'] . "</td>" .
                "</tr>";
            echo $text;
        }
    }


    if (isset($_POST))
    {
        $sqlFil = $sql;
        $zapros = array();
        $i = 0;
        if ($_POST['costFrom'] > $_POST['costTo'] and ($_POST['costTo'] != '' and $_POST['costFrom'] != ''))
        {
            echo "<h2>Ошибка ввода (цена от > цены до)</h2>";
        }
        else
        {
            if ($_POST['costFrom'] == '' and $_POST['costTo'] == '')
            {
                // ничего
            }
            else if ($_POST['costFrom'] == '' and $_POST['costTo'] != '')
            {
                $sqlFil = $sqlFil . " WHERE `cost` <= :costTo";
                $zapros['costTo'] = $_POST['costTo'];
                $i++;
            }
            else if ($_POST['costFrom'] != '' and $_POST['costTo'] == '')
            {
                $sqlFil = $sqlFil . " WHERE `cost` >= :costFrom";
                $zapros['costFrom'] = $_POST['costFrom'];
                $i++;
            }
            else if ($_POST['costFrom'] != '' and $_POST['costTo'] != '')
            {
                $sqlFil = $sqlFil . " WHERE `cost` >= :costFrom AND `cost` <= :costTo";
                $zapros['costFrom'] = $_POST['costFrom'];
                $zapros['costTo'] = $_POST['costTo'];
                $i++;
            }
            if ($_POST['category'])
            {
                if ($i == 0)
                    $sqlFil = $sqlFil . " WHERE `id_product` = :category";
                else
                    $sqlFil = $sqlFil . " AND `id_product` = :category";
                $i++;
                $zapros['category'] = $_POST['category'];
                settype($zapros['category'],"integer");
            }
            if (!empty($_POST['name']))
            {
                if ($i == 0)
                    $sqlFil = $sqlFil . " WHERE LOCATE(:name, `name`)";
                else
                    $sqlFil = $sqlFil . " AND LOCATE(:name, `name`)";
                $zapros['name'] = trim($_POST['name']);
                $i++;
            }
            if (!empty($_POST['description']))
            {
                if ($i == 0)
                    $sqlFil = $sqlFil . " WHERE LOCATE(:description, `description`);";
                else
                    $sqlFil = $sqlFil . " AND LOCATE(:description, `description`);";
                $zapros['description'] = trim($_POST['description']);
                $i++;
            }
            if ($i != 0)
            {
                $count = 0;
                $stmt = $pdo->prepare($sqlFil);
                $stmt->execute($zapros);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $text = "<tr>" .
                        "<th scope='row'><img src=" .  'catalog_images/' .  $row['img_path'] . " width='200px'></th>" .
                        "<td>" .$row['name'] . "</td>" .
                        "<td>" .$row['name_category'] . "</td>" .
                        "<td>" .$row['description'] . "</td>" .
                        "<td>" .$row['cost'] . "</td>" .
                        "</tr>";
                    echo $text;
                    $count++;
                }
                if ($count == 0)
                {
                    echo "<h2>Ничего не найдено</h2>";
                }
            }
            if ($i == 0)
            {
                while ($row = $result->fetch(PDO::FETCH_ASSOC))
                {
                    $text = "<tr>" .
                        "<th scope='row'><img src=" .  'catalog_images/' .  $row['img_path'] . " width='200px'></th>" .
                        "<td>" .$row['name'] . "</td>" .
                        "<td>" .$row['name_category'] . "</td>" .
                        "<td>" .$row['description'] . "</td>" .
                        "<td>" .$row['cost'] . "</td>" .
                        "</tr>";
                    echo $text;
                }
            }
        }
        //print_r($zapros);
        //echo $i . "<br>" . $sqlFil;
    }

    // обработка фильтра
    /*if(isset($_POST["costFrom"])){
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        if (($_POST["costFrom"]) == '' or $_POST["costFrom"] <= $row['cost'])
        {
            if (($_POST["costTo"]) == '' or $_POST["costTo"] >= $row['cost'])
            {
                if (($_POST["name"]) == '' or stripos($row["name"],$_POST['name']))
                {
                    if (($_POST["description"]) == '' or stripos($row["description"],$_POST['description']))
                    {
                        if (($_POST["category"]) == 0 or ($_POST["category"] == $row['id_product']))
                        {
                            $text = "<tr>" .
                                "<th scope='row'><img src=" .  'catalog_images/' .  $row['img_path'] . " width='200px'></th>" .
                                "<td>" .$row['name'] . "</td>" .
                                "<td>" .$row['name_category'] . "</td>" .
                                "<td>" .$row['description'] . "</td>" .
                                "<td>" .$row['cost'] . "</td>" .
                                "</tr>";
                            echo $text;
                        }
                    }
                }
            }
        }

    }}*/