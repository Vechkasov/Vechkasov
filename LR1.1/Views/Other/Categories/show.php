
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
                            <a class="nav-link text-primary" href="/Vechkasov/LR1.1/products/show/<?=$item['id']?>">
                                <?=$item['name']?>
                            </a>
                        <td>
                            <a class="btn btn-primary" id="edit" href="/Vechkasov/LR1.1/categories/edit/<?=$item['id']?>">Редактировать</a>
                            <a class="btn btn-danger deleteCategory" href="/Vechkasov/LR1.1/categories/delete/<?=$item['id']?>">Удалить</a>
                        </td>
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
        <a class="btn btn-primary btn-lg mb-5" type="button" href="/Vechkasov/LR1.1/categories/add">Добавить</a>
    </div>