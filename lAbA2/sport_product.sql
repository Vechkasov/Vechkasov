-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 22 2021 г., 22:49
-- Версия сервера: 10.4.21-MariaDB
-- Версия PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sport_product`
--

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) UNSIGNED NOT NULL,
  `img_path` varchar(45) NOT NULL DEFAULT 'no_img.png',
  `name` varchar(45) NOT NULL,
  `id_product_category` int(11) UNSIGNED NOT NULL,
  `decription` varchar(255) DEFAULT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `img_path`, `name`, `id_product_category`, `decription`, `cost`) VALUES
(1, 'alp1_img.png', 'Горнолыжные ботинки Head Vector 110 RS Black', 3, 'Ботинки для обладателей ступней средней ширины с низким и средним подъемом.', 15954),
(2, 'alp2_img.png', 'Горнолыжная маска Oakley Line Miner L', 3, 'Line Miner создана для того, чтобы подарить максимально возможный периферийный обзор в цилиндрической маске.', 16400),
(3, 'alp3_img.png', 'Горнолыжный шлем Atomic Savor Gt Amid Visor H', 3, 'Легкий и надежный шлем с конструкцией Hybrid и двузонной регулируемой вентиляцией.', 35990),
(4, 'alp4_img.png', 'Защитный жилет мужской Dainese Flexagon Waist', 3, 'Flexagon воссоздал заново представление о комфорте при использовании защиты тела.', 9180),
(5, 'tr1_img.png', 'Очки Oakley Flight Jacket Matte Steel', 2, 'Аэродинамические исследования при разработке Flight Jacket делают очки идеальными для велосипеда, бега и других скоростных активностей.', 21100),
(6, 'tr2_img.png', 'Сумка на колесах Eagle Creek ORV', 2, 'Сумка для больших приключений, созданная по самым высоким стандартам. ', 23450),
(7, 'tr3_img.png', 'Палатка Robens Voyager Versa 3 Green', 2, 'Voyager Versa 3 – вместительная кемпинговая палатка-туннель.', 36995),
(8, 'tr4_img.png', 'Часы Casio Pro Trek PRG-240T-7E', 2, 'Представители 240-й серии в корпусе из полимерного пластика на титановом браслете. Отличный выбор для путешествий, хайкинга и активного образа жизни.', 22340),
(9, 'run1_img.png', 'Стельки Sidas 3Feet Run Protect Low', 4, 'Линейка стелек Sidas Run специально разработана для занятий бегом и подходит как любителям, так и профессиональным бегунам.', 4490),
(10, 'run2_img.png', 'Фонарь Petzl Swift RL Black', 4, 'Многоцелевой, перезаряжаемый, лёгкий и очень мощный фонарь.\r\nМаксимальная яркость 900 люмен.', 9990),
(11, 'run3_img.png', 'Кинезиотейп Rocktape Design, 5см х 5м, Череп', 4, 'Это эластичная лента на клеевой основе, призванная помочь в восстановлении и предотвращении травм.', 990),
(12, 'run4_img.png', 'Рюкзак Salomon S/Lab Sense Ultra 8 Set Transc', 4, 'Разработанный при участии действующих спортсменов-профессионалов S/Lab Sense Ultra 8 Set получился практически идеальным решением для скоростного преодоления дистанции, требующей дополнительной экипировки и запаса воды.', 8953),
(13, 'gr1_img.png', 'Каска Kong Kosmos Full Black', 1, 'Мультиспортивный шлем, сертифицированный для скалолазания, альпинизма и скитура, ски-альпинизма.', 7140),
(14, 'gr2_img.png', 'Ледовый инструмент EliteClimb Raptor', 1, 'Ледоруб из гибридного материала, основное отличие от других карбоновых изделий в кевларе.', 20993),
(15, 'gr3_img.png', 'Скальные туфли женские La Sportiva Katana', 1, 'Отличительные особенности: чувствительность, точность, структурированность. Идеальный баланс.', 7750),
(16, 'gr4_img.png', 'Страховочная система Black Diamond Zone Curry', 1, '• Контурный поясной обхват по технологии Fusion Comfort\r\n• 4 разгрузочных петли\r\n• 2 места для вспомогательных карабинов Ice Clipper\r\n• Нерегулируемые ножные обхваты', 6783),
(17, 'tyr1_img.png', 'Ботинки мужские Hanwag Tatra II GTX', 5, 'Кожаный мужской треккинговый ботинок для суровых условий и тяжелого треккинга.', 23520),
(18, 'tyr2_img.png', 'Рюкзак Osprey Exos 38 Tunnel Green', 5, 'Серия Exos — это идеальное сочетание высокоэффективных характеристик и надёжных материалов.Удобный, многофункциональный рюкзак с трамплинной спиной AirSpeed, отвечающей за отвод тепла и циркуляцию воздуха между рюкзаком и спиной, позволит почувствовать ма', 17290),
(19, 'tyr3_img.png', 'Спальник Mountain Equipment Glacier 700 Regul', 5, 'Glacier 700 - тёплый пуховый спальник для горнотуристических маршрутов летом и в межсезонье, зимних походов без сильных ночных морозов и летних восхождений на пятитысячники.', 39600),
(20, 'tyr4_img.png', 'Горелка MSR Pocket Rocket 2', 5, 'Ветрозащита WindClip™ защитит пламя от несильных порывов ветра. Новая система лапок обеспечивает лучшую устойчивость котелка и складывается еще в меньшей размер, чем прошлая версия.', 4300);

-- --------------------------------------------------------

--
-- Структура таблицы `product_category`
--

CREATE TABLE `product_category` (
  `id_product_category` int(11) UNSIGNED NOT NULL,
  `name_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_category`
--

INSERT INTO `product_category` (`id_product_category`, `name_category`) VALUES
(1, 'Горные лыжи'),
(2, 'Путешествия'),
(3, 'Альпинизм'),
(4, 'Бег'),
(5, 'Туризм');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_1` (`id_product_category`);

--
-- Индексы таблицы `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id_product_category`),
  ADD KEY `id_product_category` (`id_product_category`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id_product_category` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `foreign_key_1` FOREIGN KEY (`id_product_category`) REFERENCES `product_category` (`id_product_category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
