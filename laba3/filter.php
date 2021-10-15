<?php
    session_start();
    require_once 'source/logic/db.php';
    require_once 'source/logic/logic.php';
    include_once "source/html/nav.php"?>
<div class="container">
    <form action="filter.php" method="get" id="filter_form">
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

<?php include_once "source/html/footer.php"?>