<?php
    $title = "Импорт данных";
    require_once("html/nav.php");
    require_once("logic/import_table.php");
?>

<div class="container mt-5 mb-5 pt-5 pb-5">
    <form action="import.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="">Ссылка на файл</label>
            <input class="form-control mt-2" type="file" name="import_file" size="5" />
            <button type="submit" name="download" class="btn btn-primary mt-2">Загрузить</button>
            <?php
                if (!empty($message)) :
            ?>
                    <label class="form-control mt-2"><?=$message?></label>
            <?php
                endif;
            ?>
        </div>
    </form>
</div>

<?php
    require_once("html/footer.php");
?>
