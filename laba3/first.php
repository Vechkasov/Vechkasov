<?php
    session_start();
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Беседка</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <link rel="stylesheet" href="source/css/main.css">
    <script src="source/js/index.js"></script>
</head>
<body>

    <div class="container">
        <!-- fixed-top -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="row">
                <div class="col log">
                    <a href="#">
                        <img src="source/images/logo-short.svg" alt="Кекс">
                    </a>
                    <svg class="header__logo-text" version="1.1" id="svg2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-1 0 398.2 83.9" style="enable-background:new 0 0 398.2 83.9;" width="381px" height="54px" fill="#000000" xml:space="preserve">
        <g id="g12" transform="translate(211.1484,32.7559)">
            <path class="header__logo-text-letter header__logo-text-letter_6 st0" id="path14" d="M-62.6,10.2l6.2,6.2l6.2-6.2L-56.5,4L-62.6,10.2z"></path>
        </g>
                    <g id="g16" transform="translate(127.0742,37.7695)">
            <path class="header__logo-text-letter header__logo-text-letter_2 st0" id="path18" d="M-83.7-1.1h8.8v18.8h7.1V-7.4h-23.1v25.1h7.1V-1.1z"></path>
        </g>
                    <g class="header__logo-text-letter" id="g20">
            <g>
                <defs>
                    <rect id="SVGID_1_" x="-115.4" y="0" width="513.7" height="83.9"></rect>
                </defs>
                <clippath id="SVGID_2_">
                    <use xlink:href="#SVGID_1_" style="overflow:visible;"></use>
               </clippath>
                <g id="g22" class="st1">
                   <g id="g28" transform="translate(153.9414,38.1953)">
                        <path class="header__logo-text-letter header__logo-text-letter_3 st0" id="path30" d="M-76.9-2c4.1,0,6.7,2.5,6.7,6.8c0,4.1-2.6,6.7-6.7,6.7c-4.1,0-6.6-2.5-6.6-6.7
                        C-83.6,0.5-81-2-76.9-2 M-76.9,17.9c8.4,0,13.7-5.2,13.7-13.1c0-8-5.3-13.2-13.7-13.2c-8.3,0-13.6,5.2-13.6,13.2
                        C-90.6,12.7-85.3,17.9-76.9,17.9"></path>
                    </g>
                    <g id="g32" transform="translate(195.9785,22.7617)">
                        <path class="header__logo-text-letter header__logo-text-letter_5 st0" id="path34" d="M-66.4,32.7h7.2V14h7.8V7.6h-22.8V14h7.8V32.7z"></path>
                    </g>
                    <g id="g36" transform="translate(107.7598,20.0898)">
                        <path class="header__logo-text-letter header__logo-text-letter_1 st0" id="path38" d="M-88.5,38.7c5.5,0,9.6-1.9,13.3-5.3l-4.4-5.9c-2.4,2.5-5.6,3.9-9,3.9
                            c-5.7,0-11.4-3.5-11.4-11.6c0-7.2,4.9-11.6,11.4-11.6c3.1,0,6.7,1.1,9,3.8l4.3-5.6c-3.6-3.6-8.2-5.3-13.3-5.3
                            c-11.7,0-19.4,7.5-19.4,18.8C-107.8,32.7-98.3,38.7-88.5,38.7"></path>
                    </g>
                    <g id="g40" transform="translate(177.3672,38.2266)">
                        <path class="header__logo-text-letter header__logo-text-letter_4 st0" id="path42" d="M-71.1-2.1c4.5,0,6.8,2.3,6.8,6.8c0,4.8-3.2,6.6-6.8,6.6c-1.4,0-2.9-0.3-4.3-0.9V-1.6
                            C-74.2-1.9-73.1-2.1-71.1-2.1 M-75.4,16.7c1.7,0.6,3.5,0.8,5.3,0.8c7.8,0,12.8-5.3,12.8-12.7c0-8.2-5-13.1-13.8-13.1
                            c-4.1,0-7.7,0.6-11.5,1.6v34h7.1C-75.4,27.4-75.4,16.7-75.4,16.7z"></path>
                    </g>
                    <g id="g44" transform="translate(280.1602,28.7266)">
                        <path class="header__logo-text-letter header__logo-text-letter_8 st0" id="path46" d="M-45.4,19.3c-1.6,1.5-4.1,2.3-6.5,2.3c-2.2,0-3.8-0.8-3.8-2.7c0-0.5,0-1.1,0.4-1.7
                            c2.4-0.5,6.8-1,9.9-1.3V19.3z M-38.8,19.7v-9.4c0-6.1-3.6-9.2-10.4-9.2c-3.7,0-8,0.8-11.7,2.6l1.6,5.7c3.3-1.7,6.7-2.3,9.3-2.3
                            c4.3,0,4.6,1.5,4.6,3.2v0.6c-4.7,0.5-10.3,1.1-14.3,1.9c-1.6,2.1-2.1,4.1-2.1,6c0,5.6,4,8.4,9.2,8.4c3.2,0,6.1-0.8,7.9-2.6
                            c1,1.8,2.4,2.5,5,2.5c1.4,0,2.8-0.3,4.1-0.7v-5.2c-1.8,0-2.7,0-2.9-0.1C-38.6,21.1-38.8,20.6-38.8,19.7"></path>
                    </g>
                    <g id="g48" transform="translate(353.8203,27.3691)">
                        <path class="header__logo-text-letter header__logo-text-letter_11 st0" id="path50" d="M-27,22.4V8.8c4.3,0.6,6.5,2.6,6.5,6.8C-20.5,19.7-22.7,21.7-27,22.4 M-40.6,15.6
                            c0-4.2,2.3-6.2,6.7-6.8v13.6C-38.4,21.8-40.6,19.8-40.6,15.6 M-27,2.8v-6.5h-7v6.5c-9.3,0.9-13.6,5.4-13.6,12.7
                            c0,7.3,4.3,11.8,13.6,12.7v6.9h7v-6.9c9.2-0.9,13.4-5.4,13.4-12.7C-13.5,8.2-17.8,3.7-27,2.8"></path>
                    </g>
                    <g id="g52" transform="translate(405.2246,42.8477)">
                        <path class="header__logo-text-letter header__logo-text-letter_13 st0" id="path54" d="M-14.1-12.5v9h-9.1v-9h-7.1v25.1h7.1V3h9.1v9.7H-7v-25.1H-14.1z"></path>
                    </g>
                    <g id="g56" transform="translate(378.0605,27.4805)">
                        <path class="header__logo-text-letter header__logo-text-letter_12 st0" id="path58" d="M-20.9,22.1c-4.1,0-6.7-2.5-6.7-6.7c0-4.1,2.6-6.7,6.7-6.7c4.1,0,6.6,2.5,6.6,6.7
                            C-14.3,19.6-16.9,22.1-20.9,22.1 M-20.9,2.4c-8.4,0-13.7,5.1-13.7,13c0,7.9,5.4,13,13.7,13c8.4,0,13.8-5.1,13.8-13
                            C-7.2,7.5-12.6,2.4-20.9,2.4"></path>
                    </g>
                    <g id="g60" transform="translate(300.1797,27.4473)">
                        <path class="header__logo-text-letter header__logo-text-letter_9 st0" id="path62" d="M-40.4,22.2c-1.4,0-2.9-0.3-4.3-0.9V9.1c1.2-0.3,2.3-0.4,4.4-0.4c4.4,0,6.6,2.3,6.6,6.8
                            C-33.6,20.3-36.8,22.2-40.4,22.2 M-40.3,2.5c-4.1,0-7.7,0.6-11.5,1.6v34h7.1V27.5c1.7,0.6,3.5,0.8,5.3,0.8
                            c7.8,0,12.8-5.3,12.8-12.7C-26.6,7.3-31.7,2.5-40.3,2.5"></path>
                    </g>
                    <g id="g64" transform="translate(327.6035,28.7266)">
                        <path class="header__logo-text-letter header__logo-text-letter_10 st0" id="path66" d="M-33.5,19.3c-1.6,1.5-4.1,2.3-6.6,2.3c-2.1,0-3.7-0.8-3.7-2.7c0-0.5,0.1-1.1,0.4-1.7
                            c2.4-0.5,6.7-1,9.9-1.3V19.3z M-27,19.7v-9.4c0-6.1-3.6-9.2-10.6-9.2c-3.4,0-7.7,0.8-11.5,2.6l1.6,5.7c3.3-1.7,6.7-2.3,9.3-2.3
                            c4.3,0,4.6,1.5,4.6,3.2v0.6c-4.7,0.5-10.3,1.1-14.3,1.9c-1.6,2.1-2.1,4.1-2.1,6c0,5.6,4,8.4,9.2,8.4c3.2,0,6.1-0.8,7.9-2.5
                            c1.1,1.8,2.5,2.5,5,2.5c1.4,0,2.8-0.3,4.1-0.7v-5.2c-1.8,0-2.7,0-2.9-0.1C-26.8,21.1-27,20.6-27,19.7"></path>
                    </g>
                    <g id="g68" transform="translate(242.6758,34.8926)">
                        <path class="header__logo-text-letter header__logo-text-letter_7 st0" id="path70" d="M-54.8,5.4l-10.1-15.9l-14.5,31.1h8.1l7.9-16.7l9,14.5l11-18.9l12,26.9h7.9l-18.9-42.9
                            L-54.8,5.4z"></path>
                    </g>
                </g>
            </g>
        </g>
    </svg>
                </div>
                <div class="col-lg-12">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav gdsfsd">
                            <li class="nav-item active">
                                <b><a class="nav-link" href="#">СКИДКИ</a></b>
                            </li>
                            <li class="nav-item">
                                <b><a class="nav-link" href="second.php">НОВИНКИ</a></b>
                            </li>
                            <li class="nav-item">
                                <b><a class="nav-link" href="#">КАТАЛОГ</a></b>
                            </li>
                            <li class="nav-item">
                                <b> <a class="nav-link" href="#">ОДЕЖДА</a></b>
                            </li>
                            <li class="nav-item">
                                <b><a class="nav-link" href="#">ОБУВЬ</a></b>
                            </li>
                            <li class="nav-item">
                                <b><a class="nav-link" href="#">ТУРИЗМ</a></b>
                            </li>
                            <li class="nav-item">
                                <b><a class="nav-link" href="#">БЕГ</a></b>
                            </li>
                            <li class="nav-item">
                                <b><a class="nav-link" href="#">АЛЬПИНИЗМ</a></b>
                            </li>
                            <li class="nav-item">
                                <b><a class="nav-link" href="#">ГОРНЫЕ ЛЫЖИ</a></b>
                            </li>
                            <li class="nav-item">
                                <b><a class="nav-link" href="#">СНОУБОРД</a></b>
                            </li>
                        </ul>
                        <?php
                        if ($_SESSION)
                        {
                            // если пользователь не зарегистрирован
                            if ($_SESSION['user'])
                                echo "<p>
                                        <span>Добро пожаловать, " . $_SESSION['user'] . "</span>
                                        <a href='signIn/exit.php'>Выйти</a>
                                    </p>";
                            else
                                echo "<a class='camp fghfd' href='signIn/autho.php'>ВХОД</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container main">
            <span>
                <a href="#">Главная</a>>
                <a href="#">Каталог</a>>
                <a href="#">Альпинистское снаряжение</a>>
                <a href="#">Страховочное снаряжение</a>>
                <a href="#">Страховочные системы</a>>
                <a href="#">Беседка Camp Impulse Orange</a>
            </span>
        </div>

        <a href="#top" name="top"></a>
        <div class="row jim">
            <div class="col-7">

                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <!-- Индикаторы -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel" data-slide-to="1"></li>
                        <li data-target="#carousel" data-slide-to="2"></li>
                        <li data-target="#carousel" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner carous">
                        <div class="carousel-item active">
                            <img height="450px" width="300px" class="img-fluid" src="https://sport-marafon.ru/upload/files/iblock/elements/9838da69-acd1-11e2-9e97-e83935202582/5188068a-d9ad-11eb-80cc-901b0e95a2a8/5188068ad9ad11eb80cc901b0e95a2a8_0f6598bce63d11eb80cf901b0e95a2a8.jpg" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img height="450px" width="300px" class="img-fluid" src="https://sport-marafon.ru/upload/files/iblock/elements/9838da69-acd1-11e2-9e97-e83935202582/5188068a-d9ad-11eb-80cc-901b0e95a2a8/5188068ad9ad11eb80cc901b0e95a2a8_0f6598bde63d11eb80cf901b0e95a2a8.jpg" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img height="450px" width="300px" class="img-fluid" src="https://sport-marafon.ru/upload/files/iblock/elements/9838da69-acd1-11e2-9e97-e83935202582/5188068a-d9ad-11eb-80cc-901b0e95a2a8/5188068ad9ad11eb80cc901b0e95a2a8_0f6598bee63d11eb80cf901b0e95a2a8.jpg" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img height="450px" width="300px" class="img-fluid" src="https://sport-marafon.ru/upload/files/iblock/elements/9838da69-acd1-11e2-9e97-e83935202582/5188068a-d9ad-11eb-80cc-901b0e95a2a8/5188068ad9ad11eb80cc901b0e95a2a8_0f6598bfe63d11eb80cf901b0e95a2a8.jpg" alt="...">
                        </div>
                    </div>
                    <!-- Элементы управления -->
                    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only"></span>
                    </a>
                    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only"></span>
                    </a>
                </div>

                <div class="row dvij">
                    <div class="col-md-3">
                        <a href="#top" onclick="one()" class="tip one">О товаре</a>
                    </div>
                    <div class="col-md-4">
                        <a href="#top" onclick="two()" class="tip two">Характеристики</a>
                    </div>
                    <div class="col-md-3">
                        <a href="#top" onclick="three()" class="tip three">О бренде</a>
                    </div>
                </div>

                <div class="container onetext jim">
                    <p>
                        Модель Impulse — лучшая страховочная система CAMP для скалолазания.
                    </p>
                    <p>
                        Отличительной особенностью стала совершенно новая конструкция пояса,
                        сочетающая в себе перфорированный материал EVA и 3D подкладку.
                        Как результат - система с отличным уровнем комфорта и вентиляции.
                    </p>
                    <p>
                        Отличительной особенностью стала совершенно новая конструкция пояса,
                        сочетающая в себе перфорированный материал EVA и 3D подкладку.
                        Как результат - система с отличным уровнем комфорта и вентиляции.
                    </p>
                    <p>
                        Четыре развесочных петли имеют жёсткий каркас для удобного расположения
                        снаряжения. Сзади расположена пятая петля, куда удобно подстегнуть запасное
                        снаряжение, вторую веревку или мешок с магнезией.
                    </p>
                    <div class="spic">
                        <ul>
                            <li><p>инновационная технология пояса для большего комфорта;</p></li>
                            <li><p>перфорированная EVA подкладка обеспечивает превосходную вентиляцию;</p></li>
                            <li><p>стальная пряжка обратного хода на поясе;</p></li>
                            <li><p>нерегулируемые ножные обхваты;</p></li>
                            <li><p>4 жёсткие разгрузочные петли;</p></li>
                            <li><p>силовая петля сзади для вспомогательного снаряжения;</p></li>
                            <li><p>вес 355 г для размера М;</p></li>
                            <li><p>обхват пояса, см: XS 62-72, S 69-79, M 76-86, L 83-93;</p></li>
                            <li><p>обхват бедра, см: XS 48-52, S 52-56, M 56-60, L 60-64.</p></li>
                        </ul>
                    </div>
                </div>

                <div class="container twotext jimv">

                    <ul>
                        <li>
                            <div>
                                <span>Вес(кг)</span>
                            </div>
                            <span class="char">0.355</span>
                        </li>

                        <li>
                            <div>
                                <span>Тип</span>
                            </div>
                            <span class="char">Страховочная система</span>
                        </li>

                        <li>
                            <div>
                                <span>Количество пряжек</span>
                            </div>
                            <span class="char">1</span>
                        </li>

                        <li>
                            <div>
                                <span>Слоты под кэритулы</span>
                            </div>
                            <span class="char">Нет</span>
                        </li>

                        <li>
                            <div>
                                <span>Тип страховочной системы</span>
                            </div>
                            <span class="char">Нижняя</span>
                        </li>

                        <li>
                            <div>
                                <span>Сезон</span>
                            </div>
                            <span class="char">21</span>
                        </li>

                        <li>
                            <div>
                                <span>Пол</span>
                            </div>
                            <span class="char">Унисекс</span>
                        </li>

                    </ul>
                </div>

                <div class="container threetext jimv">
                    <p><a href="#top" class="camp">Camp</a></p>
                    <p>
                        Компания C.A.M.P. основана в 1889 году в маленьком городке
                        Премана на севере Италии. Является одной из старейших компаний по производству
                        снаряжения для самых разных видов активностей, связанных с деятельностью на высоте:
                        альпинизм, туризм, скалолазание, промышленный альпинизм, трейл-раннинг и мультиспорт. Продукция CAMP, CAMP Safety и CASSIN производится на 9-ти фабриках в Европе, Азии и Африке. 80% производится на экспорт. 20% всех сотрудников работают в отделе исследования и разработок, чем обеспечивается большое количество собственных патентов и изобретений. Основная специализация – создание самых функциональных, легких и технологичных образцов снаряжения.
                    </p>
                </div>

            </div>
            <div class="col-4 float-md-right vi sidebar">
                <h2 class="name">
                    Беседка Camp Impulse Orange
                </h2>
                <h2 class="cost">
                    9 990₽
                </h2>

                <span class="poi">
                    <p>
                        <a href="#">Сообщить о снижении цены</a>
                    </p>
                    <p>
                        <a href="#">Нашли дешевле?</a>
                    </p>
                    <p>
                            <span >
                                Код товара <span class="black">2936</span>
                            </span>
                    </p>
                    <p>
                        Цвет <img src="https://sport-marafon.ru/upload/resize_cache/files/iblock/elements/9838da69-acd1-11e2-9e97-e83935202582/5188068a-d9ad-11eb-80cc-901b0e95a2a8/40_50_1/5188068ad9ad11eb80cc901b0e95a2a8_0f6598bce63d11eb80cf901b0e95a2a8.jpg" alt="">
                    </p>
                    <p>
                            <span>
                                Размер
                            </span>
                    </p>
                </span>

                <div class="container">
                    <div class="row">
                        <div class="col-6 buttons">
                            <button type="button" class="btn btn-outline-primary">S</button>
                        </div>
                        <div class="col-6 buttons">
                            <button type="button" class="btn btn-outline-primary">M</button>
                        </div>
                        <div class="col-6 buttons">
                            <button type="button" class="btn btn-outline-primary">L</button>
                        </div>
                        <div class="col-6 buttons">
                            <button type="button" class="btn btn-outline-primary">XL</button>
                        </div>
                    </div>
                </div>

                <div class="catalog-detail container">
                    <button onclick="minus()" type="button" class="catalog-detail__qt-btn catalog-detail__qt-btn_minus">-</button>
                    <input class="catalog-detail__qt-field" autocomplete="off" name="quantity" type="text" placeholder="1" value="1">
                    <button onclick="plus()" type="button" class="catalog-detail__qt-btn catalog-detail__qt-btn_plus">+
                    </button>
                </div>

                <button type="button" class="btn btn-primary btn-lg ezji"   >В корзину</button>
                <button type="button" class="btn btn-outline-secondary ezjitwo">К сравнению</button>

            </div>
        </div>

        <div class="row jim">
                <div class="col-md-4">
                    <div>
                        <img width="90px" height="90px" src="https://sport-marafon.ru/local/templates/main/img/advantage-1.svg" alt="">
                    </div>
                    <p class="cen">ПРОФЕССИОНАЛЬНАЯ КОНСУЛЬТАЦИЯ</p>
                    <p class="cemtf">Вся команда нашего магазина увлекается активными видами спорта:
                    туризмом, альпинизмом, горными лыжами и другими видами outdoor-активности.</p>
                </div>
                <div class="col-md-4">
                    <div>
                        <img width="90px" height="90px" src="https://sport-marafon.ru/local/templates/main/img/advantage-2.svg" alt="">
                    </div>
                    <p class="cen">ДОСТАВКА И ОПЛАТА</p>
                    <p class="cemtf">Оплата наличными курьеру или банковской картой без комиссии.</p>
                </div>
                <div class="col-md-4">
                    <div>
                        <img width="90px" height="90px" src="https://sport-marafon.ru/local/templates/main/img/advantage-3.svg" alt="">
                    </div>
                    <p class="cen">ПОДПИСКА НА НОВОСТИ</p>
                    <p class="cemtf">Коротко о самом важном: новых коллекциях и брендах, о снаряжении и как его выбрать,
                    ближайших акциях и распродажах.</p>
                    <form action="./mail.php" method="post">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" id="email1" placeholder="Ваш e-mail">
                        </div>
                        <button class="buta" type="submit" class="btn">Подписаться</button>
                    </form>
                </div>
            </div>

        <p class="cemtf">
                Заметили ошибку? Выделите текст ошибки, нажмите Ctrl+Enter, отправьте форму. Мы постараемся исправить ее.
            </p>

    </div>
    <div class="row ssl jumbotron bv">
            <div class="col-md-2">
                <p>Каталог</p>
                <p><a href="" class="camp">Акции</a></p>
                <p><a href="" class="camp">Новинки</a></p>
                <p><a href="" class="camp">Активности</a></p>
                <p><a href="" class="camp">Бренды</a></p>
                <p><a href="" class="camp">Идеи подарков</a></p>
                <p><a href="" class="camp">Подарки для ваших сотрудников</a></p>
                <p><a href="" class="camp">Библиотека Спорт-Марафон</a></p>
            </div>
            <div class="col-md-2">
                <p>Магазин</p>
                <p><a href="" class="camp">Контакты</a></p>
                <p><a href="" class="camp">О нас</a></p>
                <p><a href="" class="camp">Команда</a></p>
                <p><a href="" class="camp">Работа у нас</a></p>
            </div>
            <div class="col-md-2">
                <p>Сервис</p>
                <p><a href="" class="camp">Ски-сервис</a></p>
                <p><a href="" class="camp">Лаборатория бутфитинга</a></p>
                <p><a href="" class="camp">Мастерская бега</a></p>
                <p><a href="" class="camp">Дисконтная система</a></p>
            </div>
            <div class="col-md-2">
                <p>Сообщество</p>
                <p><a href="" class="camp">Блог</a></p>
                <p><a href="" class="camp">Youtube</a></p>
                <p><a href="" class="camp">Подкасты</a></p>
                <p><a href="" class="camp">Парк</a></p>
                <p><a href="" class="camp">Клуб</a></p>
                <p><a href="" class="camp">Outdoor Fest в Никола-Ленивце</a></p>
                <p><a href="" class="camp">Проекты в Красной Поляне</a></p>
                <p><a href="" class="camp">Поддержка соревнований</a></p>
            </div>
            <div class="col-md-2">
                <p>Информация</p>
                <p><a href="" class="camp">Доставка и оплата</a></p>
                <p><a href="" class="camp">Обмен и возврат</a></p>
                <p><a href="" class="camp">Осторожно, мошенники</a></p>
                <p><a href="" class="camp">Оферта</a></p>
            </div>
            <div class="col-md-2 qwer">
                <p><a href="" class="camp fir">Контакты</a></p>
                <p class="hpf">Москва, ул. Сайкина 4<br>
                    <span>ежедневно с 10:00 до 24:00</span></p>
                <p class="hpf"><a href="" class="camp">8(800)331-14-41</a><br>
                    <span>бесплатный звонок по России</span></p>
                <p class="hgjt">Мы в социальных сетях</p>
                <div class="bobe">
                    <a href=""><img src="https://sport-marafon.ru/local/templates/main/img/f-soc-fb.svg" alt=""></a>
                    <a href=""><img src="https://sport-marafon.ru/local/templates/main/img/f-soc-vk.svg" alt=""></a>
                    <a href=""><img src="https://sport-marafon.ru/local/templates/main/img/f-soc-inst-grad.svg" alt=""></a>
                    <a href=""><img src="https://sport-marafon.ru/local/templates/main/img/tiktok.svg" alt=""></a>
                </div>
                <p class="hgjt">Наши каналы</p>
                <div class="bobe">
                    <a href=""><img src="https://sport-marafon.ru/local/templates/main/img/f-soc-yt.svg" alt=""></a>
                    <a href=""><img src="https://sport-marafon.ru/local/templates/main/img/soundcloud.svg" alt=""></a>
                    <a href=""><img src="https://sport-marafon.ru/local/templates/main/img/f-soc-tg.svg" alt=""></a>
                </div>
                <div>

                </div>
            </div>
        </div>
    </div>

</body>
</html>