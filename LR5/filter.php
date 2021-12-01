<?php
    $title = "Фильтр";
    require_once("html/nav.php");
    require_once("logic/logic_filter.php");
?>

<div class="container">
    <form action="filter.php" method="get" id="filter_form">
        <label class="text-uppercase">Фильтрация результата поиска</label>

        <?php if (isset($_SESSION['user'])) : ?>
            <input class="none" type="number" name="id">
        <?php endif; ?>

        <div class="mb-3">
            <label>По цене:</label>
            <input type="number" name="costFrom" placeholder="Цена от" value="<?= isset($toDataBase['costFrom'])?$toDataBase['costFrom']:"" ?>" class="form-control">
            <input type="number" name="costTo" placeholder="Цена до " value="<?= isset($toDataBase['costTo'])?$toDataBase['costTo']:"" ?>" class="form-control mt-3">
        </div>
        <div class="mb-3">
            <label>Фильтрация по категории товара:</label>
            <select name="category" class="form-control">
                <option value="" <?php if (!isset($toDataBase['category'])) : ?>selected <?php endif; ?> >Выберите категорию</option>
                <?php
                    // Вывод всех категорий из БД
                    foreach ($category as $key => $item)
                    {
                        if (isset($toDataBase['category']) and  ( $toDataBase['category'] == ($key + 1) ))
                            echo "<option value=" . ($key + 1) . " selected>$item</option>";
                        else
                            echo "<option value=" . ($key + 1) . ">$item</option>";
                    }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Фильтрация по описанию:</label>
            <textarea class="form-control" placeholder="Введите описание товара" name="description"><?= isset($toDataBase['description'])?htmlspecialchars($toDataBase['description']):"" ?></textarea>
        </div>
        <div class="mb-3">
            <label>Фильтрация по наименованию:</label>
            <input class="form-control" type="text" name="name" placeholder="Введите наименование товара" value="<?= isset($toDataBase['name'])?htmlspecialchars($toDataBase['name']):"" ?>">
        </div>
        <input type="submit" value="Применить фильтр" class="btn btn-primary">
        <input type="submit" name="clearFilter" value="Очистить фильтр" class="btn btn-danger">
    </form>
</div>

<div class="container text-center mt-3">
    <?php
        if ($error) :
    ?>
            <!-- Вывод ошибки или отсутствия данных -->
            <h2><?=$error?></h2>
    <?php else: ?>
        <!-- Вывод данных из БД -->
        <table class="table">
            <thead>
                <tr>
                    <!-- Показывать картинки если пользователь авторизован -->
                    <?php
                    if (isset($_SESSION['user'])) :
                    ?>
                        <th scope=col>Изображения</th>
                    <?php endif; ?>
                        <th scope=col>Наименование</th>
                        <th scope=col>Категория</th>
                        <th scope=col>Описание</th>
                        <th scope=col>Стоимость</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($text as $key => $item) :
                ?>
                        <tr>
                            <?php
                                if (isset($_SESSION['user'])) :
                            ?>
                                <td><img width="200" src="<?=$item['img_path']?>"></td>
                            <?php endif; ?>
                                <td><?=$item['name']?></th>
                                <td><?=$item['name_category']?></td>
                                <td><?=$item['description']?></td>
                                <td><?=$item['cost']?></td>
                        </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
    require_once("html/footer.php");
?>