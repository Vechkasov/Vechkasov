
    <div class="container">
        <h1 class="pt-2 mb-3"><?=$title ?? ""?></h1>

        <div class="d-flex align-items-center flex-column pt-3 h5">
            <form class="" action="editProduct.php?id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">

                <label class="pt-3">Название</label>
                <input type="text" class="form-control mt-1 input-lg" name="name" placeholder="Название продукта" value="<?=isset($_POST['name'])?htmlspecialchars($_POST['name']):($product['name'] ?? "");?>">

                <?php
                    if (isset($errors['name'])) :
                ?>
                    <p class="pt-3"><?=$errors['name']?></p>
                <?php
                    endif;
                ?>

                <label class="pt-3">Описание</label>
                <textarea name="description" class="form-control" cols="30" rows="3" placeholder="Описание продукта"><?=isset($_POST['description'])?htmlspecialchars($_POST['description']):($product['description'] ?? "");?></textarea>

                <?php
                    if (isset($errors['description'])) :
                ?>
                    <p class="pt-3"><?=$errors['description']?></p>
                <?php
                    endif;
                ?>

                <label class="pt-3">Стоимость</label>
                <input type="text" class="form-control mt-1" name="cost" placeholder="Стоимость продукта" value="<?=isset($_POST['cost'])?htmlspecialchars($_POST['cost']):($product['cost'] ?? "");?>">

                <?php
                    if (isset($errors['cost'])) :
                ?>
                    <p class="pt-3"><?=$errors['cost']?></p>
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
                        else if (!isset($_POST['category']) && isset($product['id_product']) && $product['id_product'] == ($i + 1))
                            echo "<option value=" . $categories[$i]['id'] . " selected>" . $categories[$i]['name'] . "</option>";
                        else
                            echo "<option value=" . $categories[$i]['id']. ">" . $categories[$i]['name'] . "</option>";
                    }
                ?>
                </select>

                <label class="pt-3">Загрузите фотографию продукта</label>
                <input type="file" class="form-control mt-1" placeholder="Фото" name="image" title="Фото">

                <?php
                    if (isset($errors['image'])) :
                ?>
                    <p class="pt-3"><?=$errors['image']?></p>
                <?php
                    endif;
                ?>

                <button type="submit" class="btn btn-primary mt-3 pt-1">Изменить</button>

            </form>
        </div>
    </div>