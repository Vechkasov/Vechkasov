
    <div class="container mb-5 pb-3">
        <?php
        if (isset($categories) and count($categories) > 0) :
            ?>
            <h1 class="pt-2 mb-3">Список категорий</h1>
            <table class="table table-hover table-responsive mt-3 text-center">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Название</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                <?php
                foreach ($categories as $key => $item) :
                    ?>
                    <tr>
                        <th><?=$item['id']?></th>
                        <td>
                            <a class="nav-link text-primary" href="products.php?id_category=<?=$item['id']?>">
                                <?=$item['name']?>
                            </a>
                        <td><a class="btn btn-primary" type="button" id="edit" href="editCategory.php?id=<?=$item['id']?>">Редактировать</a>
                            <a class="btn btn-danger deleteCategory" id="<?=$item['id']?>" data-entityname="student">Удалить</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php
            else:
        ?>
            <h1 class="pt-2 mb-3">Категории отсутствуют</h1>
        <?php
            endif;
        ?>
        <a class="btn btn-primary btn-lg mb-5" type="button" href="addCategory.php">Добавить</a>
    </div>