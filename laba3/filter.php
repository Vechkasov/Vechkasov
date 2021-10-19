<?php
    session_start();
    // Подключение к базе данных
    require_once 'source/logic/db.php';
    // Обработка фильтра
    require_once 'source/logic/logic.php';
    // Кусок HTML-кода (шапка)
    require_once "source/html/nav.php"
?>

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
                    // Вывод всех категорий из БД
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
            // Вывод данных из БД
            echo "<tbody>" . $text . "</tbody>";
        ?>
    </table>

</div>

<?php
    // Кусок HTML-кода (подвал)
    require_once "source/html/footer.php"
?>