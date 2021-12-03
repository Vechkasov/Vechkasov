<?php
    $title = "Главная";
    require_once("html/nav.php");
    require_once("logic/edit_logic.php");
?>

        <div class="container">
            <h1 class="pt-2 mb-3">Изменение товара</h1>


            <div class="d-flex align-items-center flex-column pt-3 h5">

                <form class="" action="edit_product.php?id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">

                    <label class="pt-3">Название</label>
                    <input type="text" class="form-control mt-1 input-lg" name="name" placeholder="Название продукта" value="<?=isset($_POST['name'])?htmlspecialchars($_POST['name']):$text['name'];?>">

                    <?php
                        if (isset($message['name'])) :
                    ?>
                            <p class="pt-3"><?=$message['name']?></p>
                    <?php
                        endif;
                    ?>

                    <label class="pt-3">Описание</label>
                    <textarea name="description" class="form-control" cols="30" rows="3" placeholder="Описание продукта"><?=isset($_POST['description'])?htmlspecialchars($_POST['description']):$text['description'];?></textarea>

                    <?php
                        if (isset($message['description'])) :
                    ?>
                        <p class="pt-3"><?=$message['description']?></p>
                    <?php
                        endif;
                    ?>

                    <label class="pt-3">Стоимость</label>
                    <input type="text" class="form-control mt-1" name="cost" placeholder="Стоимость продукта" value="<?=isset($_POST['cost'])?htmlspecialchars($_POST['cost']):$text['cost'];?>">

                    <?php
                        if (isset($message['cost'])) :
                    ?>
                        <p class="pt-3"><?=$message['cost']?></p>
                    <?php
                        endif;
                    ?>

                    <label class="pt-3">Категория</label>
                    <select class="form-select mt-1" name="category" title="Группа">
                        <?php
                            /*  Вывод всех категорий из БД
                                    При первом запуске добавляет атрибут selected к прошлой установленной категории,
                                    при последующих изменениях сохраняет пользовательский выбор
                             */
                            for($i = 0; $i < count($category) ; $i++)
                            {
                                if (isset($_POST['category']) && $_POST['category'] == ($i + 1))
                                    echo "<option value=" . ($i + 1) . " selected>" . $category[$i]['name_category'] . "</option>";
                                else if (!isset($_POST['category']) && $text['id_product'] == ($i + 1))
                                    echo "<option value=" . ($i + 1) . " selected>" . $category[$i]['name_category'] . "</option>";
                                else
                                    echo "<option value=" . ($i + 1) . ">" . $category[$i]['name_category'] . "</option>";
                            }
                        ?>
                    </select>

                    <label class="pt-3">Загрузите фотографию продукта</label>
                    <input type="file" class="form-control mt-1" placeholder="Фото" name="image" title="Фото">

                    <?php
                        if (isset($message['image'])) :
                    ?>
                        <p class="pt-3"><?=$message['image']?></p>
                    <?php
                        endif;
                    ?>

                    <button type="submit" class="btn btn-primary mt-3 pt-1">Изменить</button>

                </form>
            </div>


        </div>

    </body>

</html>