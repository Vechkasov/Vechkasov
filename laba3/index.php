<?php
    session_start();
?>
<?php include_once "source/html/nav.php"?>
    <div class="container">
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
    </div>
<?php include_once "source/html/footer.php"?>
