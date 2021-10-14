<?php
    session_start();
    require_once 'source/logic/db.php';
    require_once 'source/logic/logic.php';
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Беседка</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="/images/logo-short.svg" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <link href="source/css/main.css" rel="stylesheet">
    <script src="source/js/jes.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <?php include_once "source/html/nav.php"?>
</nav>

<div class="container">
    <form action="second.php" method="get" id="filter_form">
        <label>Фильтрация результата поиска</label>
        <div class="mb-3">
            <label>По цене:</label>
            <input type="number" id="costFrom" name="costFrom" placeholder="Цена от" value="" class="form-control">
            <input type="number" id="costTo" name="costTo" placeholder="Цена до " value="" class="form-control mt-3">
        </div>
        <div class="mb-3">
            <label>Фильтрация по категории товара:</label>
            <select id="category" name="category" class="form-control">
                <option value="" selected="">Выберите категорию</option>
                <?php
                    // вывод категорий в выпадающий список
                    echo $category;
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Фильтрация по описанию:</label>
            <textarea class="form-control" placeholder="Введите описание товара" id="description" name="description" value=""></textarea>
        </div>
        <div class="mb-3">
            <label>Фильтрация по наименованию:</label>
            <input class="form-control" type="text" name="name" id="name" placeholder="Введите наименование товара" value="" >
        </div>
        <div class="container">
            <input type="submit" onclick="save()" style="width: 220px" value="Применить фильтр" class="btn btn-primary">
            <input type="submit" onclick="remove()" name="clearFilter" value="Очистить фильтр" class="btn btn-danger">
        </div>

    </form>

<div class="container text-center mt-3">
    <table class="table">
        <?php
        $enter = '';
            if (!$fl)
            {
                if ($_SESSION['user'])
                {
                    $enter = '<thead>
                                <tr>
                                    <th scope="col">Изображение</th>
                                    <th scope="col">Наименование</th>
                                    <th scope="col">Категория</th>
                                    <th scope="col">Описание</th>
                                    <th scope="col">Стоимость</th>
                                </tr>
                            </thead>';
                }
                else
                {
                    $enter = '<h4>Авторизуйтесь для просмотра изображений</h4>
                            <thead>
                                <tr>
                                    <th scope="col">Наименование</th>
                                    <th scope="col">Категория</th>
                                    <th scope="col">Описание</th>
                                    <th scope="col">Стоимость</th>
                                </tr>
                            </thead>';
                }
            }
            echo $enter;
            echo "<tbody>" . $text . "</tbody>";
        ?>
    </table>

</div>


<div class="row jim">
    <div class="col-md-4">
        <div>
            <img width="90px" height="90px" src="https://sport-marafon.ru/local/templates/main/img/advantage-1.svg" alt="">
        </div>
        <p class="cen">ПРОФЕССИОНАЛЬНАЯ КОНСУЛЬТАЦИЯ</p>
        <p class="cemtf">Вся команда нашего магазина увлекается активными видами спорта:
            туризмом, альпинизмом, горными лыжами и другими видами outdoor-активности.</p>
    </div>
    <div class="col-md-4">
        <div>
            <img width="90px" height="90px" src="https://sport-marafon.ru/local/templates/main/img/advantage-2.svg" alt="">
        </div>
        <p class="cen">ДОСТАВКА И ОПЛАТА</p>
        <p class="cemtf">Оплата наличными курьеру или банковской картой без комиссии.</p>
    </div>
    <div class="col-md-4">
        <div>
            <img width="90px" height="90px" src="https://sport-marafon.ru/local/templates/main/img/advantage-3.svg" alt="">
        </div>
        <p class="cen">ПОДПИСКА НА НОВОСТИ</p>
        <p class="cemtf">Коротко о самом важном: новых коллекциях и брендах, о снаряжении и как его выбрать,
            ближайших акциях и распродажах.</p>
        <form action="./mail.php" method="post">
            <div class="form-group">
                <input type="email" name="email" class="form-control" id="email1" placeholder="Ваш e-mail">
            </div>
            <button class="buta" type="submit" class="btn">Подписаться</button>
        </form>
    </div>
</div>
</div>

<?php include_once "source/html/footer.php"?>

</body>

</html>