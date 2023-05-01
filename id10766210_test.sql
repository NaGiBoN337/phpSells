-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Сен 10 2019 г., 18:19
-- Версия сервера: 10.3.16-MariaDB
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- База данных: `id10766210_test`
--

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`id10766210_root`@`%` PROCEDURE `getProduct` (IN `id` INT)  NO SQL
    SQL SECURITY INVOKER
SELECT * FROM products NATURAL JOIN categories NATURAL JOIN brands WHERE product_id=id$$

CREATE DEFINER=`id10766210_root`@`%` PROCEDURE `insertProduct` (IN `product_code` VARCHAR(30) CHARSET utf8, IN `product_name` VARCHAR(50) CHARSET utf8, IN `category_id` INT(11), IN `product_desc` VARCHAR(255) CHARSET utf8, IN `product_price` DECIMAL(9,2), IN `brand_id` INT(11), IN `product_image` VARCHAR(255) CHARSET utf8)  NO SQL
    SQL SECURITY INVOKER
INSERT INTO products (product_code, product_name, category_id, product_desc, product_price, brand_id, product_image) 
VALUES (product_code, product_name, category_id, product_desc, product_price, brand_id, product_image)$$

--
-- Функции
--
CREATE DEFINER=`id10766210_root`@`%` FUNCTION `getUser` (`login` VARCHAR(50) CHARSET utf8) RETURNS INT(10) NO SQL
    SQL SECURITY INVOKER
BEGIN
DECLARE id INT(10);
SELECT user_id INTO id
FROM users
WHERE user_login=login;
RETURN id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=24 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `country`) VALUES
(1, 'Yamaha', 'Japan'),
(2, 'Fender', 'USA'),
(3, 'Sonor', 'Austria'),
(4, 'Roy Benson', 'Germany'),
(5, 'John Packer', 'Britain'),
(6, 'Strunal', 'Czech');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=20 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `type_id`) VALUES
(1, 'guitar', 1),
(2, 'violin', 1),
(3, 'trumpet', 2),
(4, 'flute', 2),
(5, 'piano', 3),
(6, 'saxophone', 2),
(7, 'drum', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(50) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=32 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`) VALUES
(3, 'Екатеринбург'),
(2, 'Москва'),
(4, 'Новгород'),
(1, 'Санкт-Петербург');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_price` int(11) NOT NULL,
  `order_status` varchar(15) NOT NULL,
  `delivery_type` varchar(15) NOT NULL,
  `shop_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=48 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `order_price`, `order_status`, `delivery_type`, `shop_id`) VALUES
(2, 5, '2019-09-09 15:28:02', 36950, 'waiting', 'delivery', NULL),
(3, 5, '2019-09-09 15:30:23', 6990, 'waiting', 'delivery', NULL),
(4, 11, '2019-09-09 15:37:56', 6990, 'waiting', 'delivery', NULL),
(5, 3, '2019-09-09 19:54:37', 87020, 'waiting', 'delivery', NULL),
(6, 1, '2019-09-09 19:56:02', 44720, 'waiting', 'delivery', NULL),
(7, 11, '2019-09-09 20:06:50', 19350, 'waiting', 'delivery', NULL),
(8, 5, '2019-09-10 11:15:35', 35360, 'waiting', 'delivery', NULL),
(9, 12, '2019-09-10 11:25:18', 46600, 'waiting', 'delivery', NULL),
(10, 5, '2019-09-10 11:32:55', 18990, 'waiting', 'delivery', NULL),
(11, 5, '2019-09-10 11:35:10', 35360, 'waiting', 'delivery', NULL),
(12, 5, '2019-09-10 11:36:05', 35360, 'waiting', 'delivery', NULL),
(13, 5, '2019-09-10 11:44:46', 46320, 'waiting', 'delivery', NULL),
(14, 17, '2019-09-10 11:50:19', 18990, 'waiting', 'delivery', NULL),
(15, 17, '2019-09-10 11:54:04', 23160, 'waiting', 'delivery', NULL),
(16, 11, '2019-09-10 15:23:44', 110180, 'waiting', 'delivery', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `order_product`
--

CREATE TABLE `order_product` (
  `order_product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB AVG_ROW_LENGTH=17 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_product`
--

INSERT INTO `order_product` (`order_product_id`, `order_id`, `product_id`, `quantity`) VALUES
(10, 2, 30, 2),
(11, 2, 17, 3),
(12, 3, 17, 1),
(13, 4, 17, 1),
(14, 5, 52, 1),
(15, 5, 49, 1),
(16, 6, 42, 1),
(17, 6, 17, 1),
(18, 6, 47, 1),
(19, 7, 47, 1),
(20, 8, 51, 1),
(21, 9, 48, 1),
(22, 10, 49, 1),
(23, 11, 51, 1),
(24, 12, 51, 1),
(25, 13, 50, 2),
(26, 14, 49, 1),
(27, 15, 50, 1),
(28, 16, 52, 1),
(29, 16, 50, 1),
(30, 16, 49, 1);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `popular`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `popular` (
`count` bigint(21)
,`product_id` int(11)
,`product_name` varchar(50)
,`product_price` decimal(9,2)
,`product_image` varchar(255)
);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_code` varchar(30) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_desc` varchar(255) DEFAULT NULL,
  `product_price` decimal(9,2) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_discount` int(2) DEFAULT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=74 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`product_id`, `product_code`, `product_name`, `category_id`, `product_desc`, `product_price`, `brand_id`, `product_discount`, `product_image`) VALUES
(17, 'guiya1', 'Бас-гитара Yamaxa TRBX174', 1, '', 6990.00, 1, NULL, '../img/guiya1.jpg'),
(30, 'guiya2', 'Гитара классическая Yamaha C40 4/4', 1, '', 7990.00, 1, NULL, '../img/guiya2.jpg'),
(42, 'fluroy1', 'Флейта Roy Benson FL-402E', 4, '', 18380.00, 4, NULL, '../img/fluroy1.jpg'),
(47, 'flujo1', 'Флейта John Packer JP011CH', 4, '', 19350.00, 5, NULL, '../img/flujo1.jpg'),
(48, 'saxjo1', 'Саксофон Roy Benson AS-202 альт', 6, '', 46600.00, 4, NULL, '../img/saxjo1.jpg'),
(49, 'piaya1', 'Цифровое пианино Yamaha NP-32WH', 5, '', 18990.00, 1, NULL, '../img/piaya1.jpg'),
(50, 'guife1', 'Электрогитара Fender RW BK', 1, '', 23160.00, 2, NULL, '../img/guife1.jpg'),
(51, 'person1', 'Барабанная установка Sonor 1720010 SMF', 7, '', 35360.00, 3, NULL, '../img/person1.jpg'),
(52, 'viost11', 'Виолончель Strunal 40/4F-3/4', 2, 'Виолончель 3/4, студенческая\r\nВерхняя дека: ламинат ели\r\nЗадняя дека и обечайка: ламинат\r\nГриф: бук\r\nПринадлежности: черное дерево\r\n4 машинки\r\nСтруны: Saturn\r\nЦвет: красно-коричневый', 68030.00, 6, NULL, '../img/viost11.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `product_shop`
--

CREATE TABLE `product_shop` (
  `product_shop_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `product_shop_quantity` int(4) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=17 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `shops`
--

CREATE TABLE `shops` (
  `shop_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `shop_address` varchar(50) NOT NULL,
  `shop_phone` varchar(50) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=51 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shops`
--

INSERT INTO `shops` (`shop_id`, `city_id`, `shop_address`, `shop_phone`) VALUES
(1, 1, 'ул. Томатная 3', '344-33-33'),
(2, 1, 'Западный пр. 128', '589-46-38'),
(3, 2, 'ул. Солнечная 10', '333-44-55'),
(4, 3, 'ул. Музыкальная', '948-99-98');

-- --------------------------------------------------------

--
-- Структура таблицы `types`
--

CREATE TABLE `types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `type_desc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=66 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `types`
--

INSERT INTO `types` (`type_id`, `type_name`, `type_desc`) VALUES
(1, 'stringed', 'Гитары, виолончели '),
(2, 'wind', 'Флейты, саксофоны, тромбоны'),
(3, 'keyboards', 'Акустические и электронные фортепиано и рояли'),
(4, 'percussion', 'Барабаны, барабанные установки'),
(5, 'other', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_login` varchar(30) NOT NULL,
  `user_password` varchar(30) NOT NULL,
  `user_status` varchar(5) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_surname` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_sale` int(3) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=73 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_login`, `user_password`, `user_status`, `user_name`, `user_surname`, `user_email`, `user_sale`) VALUES
(1, 'gormax', '111111', 'user', 'Максим', 'Горький', 'gormax@mail.ru', NULL),
(2, 'dostoev', '12345678', 'admin', 'Федя', 'Достоевский', 'fedor@gmail.com', 10),
(3, 'mayreid', '1122mayne', 'user', 'Mayne', 'Reid', 'mreed@gmail.com', 10),
(5, 'darkap', '123', 'user', 'Daria', 'Kapustina', 'daskolcova@yandex.ru', NULL),
(11, 'admin', '123', 'admin', 'admin', 'admino', 'admin@gmail.com', NULL),
(12, 'elka', '123', 'user', 'Елена', 'Комарова', 'ekom@yandex.ru', NULL),
(13, 'cesar', 'brute', 'user', 'Гай ', 'Юлий', 'cesar@gmail.com', NULL),
(16, 'www', 'www', 'user', 'www', 'www', 'www@www.www', NULL),
(17, 'hellyresh', 'lena1234', 'user', 'Лена', 'Соколова', 'hellyresh@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Структура для представления `popular`
--
DROP TABLE IF EXISTS `popular`;

CREATE ALGORITHM=UNDEFINED DEFINER=`id10766210_root`@`%` SQL SECURITY DEFINER VIEW `popular`  AS  select count(`order_product`.`product_id`) AS `count`,`products`.`product_id` AS `product_id`,`products`.`product_name` AS `product_name`,`products`.`product_price` AS `product_price`,`products`.`product_image` AS `product_image` from (`order_product` join `products` on(`order_product`.`product_id` = `products`.`product_id`)) group by `order_product`.`product_id` order by count(`order_product`.`product_id`) desc limit 4 ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`),
  ADD UNIQUE KEY `brand_name` (`brand_name`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`),
  ADD KEY `categories_ibfk_1` (`type_id`);

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`),
  ADD UNIQUE KEY `city_name` (`city_name`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `UK_orders` (`user_id`,`order_date`,`order_id`),
  ADD KEY `orders_ibfk_2` (`shop_id`);

--
-- Индексы таблицы `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_product_id`),
  ADD UNIQUE KEY `UK_order_product` (`order_id`,`product_id`),
  ADD KEY `order_product_ibfk_2` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_code` (`product_code`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD KEY `products_ibfk_2` (`brand_id`),
  ADD KEY `products_ibfk_1` (`category_id`);

--
-- Индексы таблицы `product_shop`
--
ALTER TABLE `product_shop`
  ADD PRIMARY KEY (`product_shop_id`),
  ADD UNIQUE KEY `UK_product_shop` (`product_id`,`shop_id`),
  ADD KEY `product_shop_ibfk_2` (`shop_id`);

--
-- Индексы таблицы `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`shop_id`),
  ADD UNIQUE KEY `UK_shops` (`city_id`,`shop_address`);

--
-- Индексы таблицы `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`),
  ADD UNIQUE KEY `type_name` (`type_name`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_login` (`user_login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `order_product`
--
ALTER TABLE `order_product`
  MODIFY `order_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT для таблицы `product_shop`
--
ALTER TABLE `product_shop`
  MODIFY `product_shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `shops`
--
ALTER TABLE `shops`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `types` (`type_id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`shop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product_shop`
--
ALTER TABLE `product_shop`
  ADD CONSTRAINT `product_shop_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_shop_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`shop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;