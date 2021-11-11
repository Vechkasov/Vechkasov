<?php
    $title = "Текст";
    require_once("html/nav.php");
    require_once("logic/text_logic.php");
?>

<div class="text_body d-flex align-items-center flex-column pt-3">

    <div class="container">
        <ul class="pt-3 list-group">
            <li class="list-group-item active">
                Варианты заданий : 5, 6, 13, 17
            </li>
            <li class="list-group-item">
                5 : Тире, вставленное минусом между двумя пробелами заменять на среднее тире (&ndash),
                двойной минуc между пробелами заменять на &mdash
                и привязывать его к предыдущему слову неразрывным пробелом.
            </li>
            <li class="list-group-item">
                6 : Автоматически расставить запятые перед “а” и “но”. Заменить три точки на спецзнак многоточия.
            </li>
            <li class="list-group-item">
                13 : Автоматически сформировать “Указатель изображений”.
                Работает как оглавление, но ссылки делаются на картинки в документе.
                Текст ссылки такой:
                Картинка <номер> "содержимое атрибута alt".
            </li>
            <li class="list-group-item">
                17 : Подсветить в тексте технические повторы. Если дважды подряд вставлено одно и то же слово, второе вхождение должно быть подсвечено желтым фоном.
                Если слово вставлено 3, 4, более раз подряд, все вхождения после первого подсвечиваются.
            </li>
        </ul>
    </div>
    <form class="authorization_form" action="text.php" method="post">

        <label class="pt-3">Введите ваш HTML-код</label>
        <textarea name="text" class="form-control" cols="30" rows="4" placeholder="Ваш код"><?= !empty($html)?htmlspecialchars($html):"" ?></textarea>

        <button type="submit" class="btn btn-outline-success register-btn mt-3 pt-1">Отправить</button>
    </form>
</div>
<div class="container">
        <?php

        if ($_POST || !empty($html)) :
            ?>
            <label>Получили : </label>
            <!-- <textarea disabled cols="30" rows="4" class="form-control">$html</textarea> -->
            <div class="form-control container"><?=!empty($html)?$html:""?></div>
        <ul class="pt-3 list-group">
                <?php
                    for($j = 0;$j < $i ; $j++) :
                ?>
            <li class="list-group-item">
                <a href="<?=$images_array[$j]['src']?>">Картина <?=($j+1)?>  <?=$images_array[$j]['alt']?></a>
            </li>
                <?php
                    endfor;
                ?>
        </ul>


        <?php elseif ($_POST && empty($_POST['text'])) : ?>

            <label class="text-center text-danger pt-3">Вы ничего не ввели</label>

        <?php endif; ?>
</div>



