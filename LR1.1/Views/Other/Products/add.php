
    <div class="container">
        <h1 class="pt-2 mb-3">Добавление</h1>

        <div class="align-items-center w-50 pt-3 h5">
            <form class="form-control" method="post" enctype="multipart/form-data">

                <label class="pt-3">Название</label>
                <input type="text" class="form-control mt-1 input-lg" name="name" placeholder="Название продукта" value="<?=isset($_POST['name'])?htmlspecialchars($_POST['name']):($text['name'] ?? '');?>">

                <?php
                if (isset($errors['name'])) :
                    ?>
                    <div class="alert alert-warning" role="alert">
                        <?=$errors['name']?>
                    </div>
                <?php
                endif;
                ?>

                <label class="pt-3">Описание</label>
                <textarea name="description" class="form-control" cols="30" rows="3" placeholder="Описание продукта"><?=isset($_POST['description'])?htmlspecialchars($_POST['description']):($text['description'] ?? '');?></textarea>

                <?php
                if (isset($errors['description'])) :
                    ?>
                    <div class="alert alert-warning" role="alert">
                        <?=$errors['description']?>
                    </div>
                <?php
                endif;
                ?>

                <label class="pt-3">Стоимость</label>
                <input type="text" class="form-control mt-1" name="cost" placeholder="Стоимость продукта" value="<?=isset($_POST['cost'])?htmlspecialchars($_POST['cost']):($text['cost'] ?? '');?>">

                <?php
                if (isset($errors['cost'])) :
                    ?>
                    <div class="alert alert-warning" role="alert">
                        <?=$errors['cost']?>
                    </div>
                <?php
                endif;
                ?>

                <label class="pt-3">Категория</label>
                <select class="form-select mt-1" name="category" title="Группа">
                    <?php
                    for($i = 0; $i < count($categories) ; $i++)
                    {
                        if (isset($_POST['category']) && $_POST['category'] == ($i + 1))
                            echo "<option value=" . $categories[$i]['id'] . " selected>" . $categories[$i]['name'] . "</option>";
                        else
                            echo "<option value=" . $categories[$i]['id'] . ">" . $categories[$i]['name'] . "</option>";
                    }
                    ?>
                </select>

                <label class="pt-3">Загрузите фотографию продукта</label>
                <input type="file" class="form-control mt-1" placeholder="Фото" name="image" title="Фото">

                <?php
                if (isset($errors['image'])) :
                    ?>
                    <div class="alert alert-warning" role="alert">
                        <?=$errors['image']?>
                    </div>
                <?php
                endif;
                ?>

                <div class="container mt-3 pt-1">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <a href="/Vechkasov/LR1.1/products/show" class="btn btn-warning">
                        Назад
                    </a>
                </div>


            </form>
        </div>
    </div>