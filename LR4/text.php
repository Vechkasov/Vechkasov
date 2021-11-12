<?php
    $title = "Текст";
    require_once("html/nav.php");
    require_once("logic/text_logic.php");
?>

    <div class="text_body d-flex align-items-center flex-column pt-3">

        <div class="container">

            <button type="submit" class="text-center btn btn-outline-primary question mt-3 pt-1">Показать варианты задания</button>

            <ul class="pt-3 list-group question_ul">
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
            <textarea name="text" class="form-control" cols="30" rows="4" placeholder="Ваш код"><?= !empty($_POST['text'])?htmlspecialchars($_POST['text']):$html; ?></textarea>

            <button type="submit" class="btn btn-outline-success register-btn mt-3 pt-1">Отправить</button>
        </form>
    </div>
    <div class="container">
        <?php
            if (isset($html)) :
        ?>
            <label>Получили : </label>

            <div class="form-control container mb-5"><?=!empty($html)?$html:""?></div>

            <?php
                if (!empty($images_array)) :
            ?>
                <ul class="pt-4 list-group mb-5">
                <?php
                    for($j = 0;$j < $i ; $j++) :
                ?>
                    <li class="list-group-item">
                        <a href="<?="#" . $j?>">Картина <?=($j+1)?>  <?=$images_array[$j]?></a>
                    </li>
                <?php
                    endfor;
                ?>
                </ul>
            <?php
                endif;
            ?>


        <?php else : ?>

            <p class="text-center fs-1 text-danger pt-3">Вы ничего не ввели</p>

        <?php endif; ?>
    </div>


