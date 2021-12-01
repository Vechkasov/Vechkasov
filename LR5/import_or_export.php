<?php
    $title = "Импорт/экспорт данных";
    require_once("html/nav.php");
    require_once("logic/logic_filter.php");
?>

<div class="container mt-5 mb-5 pt-5 pb-5">
    <div class="list-group">
        <a href="export.php" class="list-group-item list-group-item-action">Экспорт</a>
        <a href="import.php" class="list-group-item list-group-item-action">Импорт</a>
    </div>
</div>

<?php
    require_once("html/footer.php");
?>
