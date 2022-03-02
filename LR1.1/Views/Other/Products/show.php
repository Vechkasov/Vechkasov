
    <div class="container mb-5 pb-3">
        <?php
        if (isset($products) && count($products) > 0) :
            ?>
            <h1 class="pt-2 mb-3">Список доступных товаров</h1>
            <table class="table table-hover table-responsive mt-3">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Наименование</th>
                    <th>Категория</th>
                    <th>Описание</th>
                    <th>Стоимость</th>
                    <th>Фото</th>
                    <th colspan="2"></th>
                </tr>
                </thead>
                <tbody>

                <?php
                foreach ($products as $key => $item) :
                    ?>
                    <tr>
                        <th><?=$item['id']?></th>
                        <td><?=$item['name']?></th>
                        <td><?=$item['name_category']?></td>
                        <td><?=$item['description']?></td>
                        <td><?=$item['cost']?></td>
                        <td><img alt="<?=$item['name']?>" width="100" src="/Vechkasov/LR1.1/Template/images/db/<?=$item['img_path']?>"></td>
                        <td><a class="btn btn-primary" type="button" href="/Vechkasov/LR1.1/products/edit/<?=$item['id']?>">Редактировать</a></td>
                        <td><a class="btn btn-danger deleteProduct" id="<?=$item['id']?>" data-entityname="student">Удалить</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php
        else:
            ?>
            <h1 class="pt-2 mb-3">Товары отсутствуют</h1>
        <?php
        endif;
        ?>
        <a class="btn btn-primary btn-lg mb-5" type="button" href="/Vechkasov/LR1.1/products/add">Добавить</a>
    </div>