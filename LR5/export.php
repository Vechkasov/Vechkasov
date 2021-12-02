<?php
    $title = "Экспорт данных";
    require_once("html/nav.php");
    require_once("logic/export_logic.php");
?>

<div class="container mt-5 mb-5 pt-5 pb-5">
    <form method="post" action="export.php">
        <div class="form-group">

            <form method="post" action="export.php">
                <div class="form-group">
                    <label for="path_to_save">Название вашего JSON-файла</label>
                    <input type="text" class="form-control" name="path" placeholder="/LR5/upload/export.json" value="<?=isset($_POST['path'])?htmlspecialchars($_POST['path']):"";?>">
                </div>
                <button type="submit" class="btn btn-primary mt-1">Скачать</button>

                <?php
                    if (isset($_POST['path']) && empty($message)) :
                ?>
                    <label class="form-control mt-2">Ваш файл доступен по ссылке</label>

                        <a href="<?=$path?>" download="<?=htmlspecialchars($_POST['path'])?>">
                            <button class="btn btn-primary">
                                Скачать экземпляр базы данных
                            </button>
                        </a>
                <?php
                    endif;
                ?>

                <?php
                    if (!empty($message)) :
                ?>
                    <label class="form-control mt-2"><?=$message?></label>
                <?php
                    endif;
                ?>

            </form>

        </div>
    </form>
</div>

<?php
    require_once("html/footer.php");
?>
