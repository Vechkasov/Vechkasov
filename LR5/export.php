<?php
    $title = "Экспорт данных";
    require_once("html/nav.php");
    require_once("logic/export_logic.php");
?>

<div class="container mt-5 mb-5 pt-5 pb-5">
    <form method="post" action="export.php">
        <div class="form-group">
            <label for="path_to_save">Ссылка на файл</label>
            <br>
                <a href="<?=$_SERVER['DOCUMENT_ROOT'] . '/LR4/uploads/export.json'?>" download="export.json">
                    <button class="btn btn-primary">
                        Скачать экземпляр базы данных
                    </button>
                </a>

        </div>
    </form>
</div>

<?php
    require_once("html/footer.php");
?>
