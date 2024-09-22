-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 14 2024 г., 23:48
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testgal`
--

-- --------------------------------------------------------

--
-- Структура таблицы `artists`
--

CREATE TABLE `artists` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `IdArtist` int(11) NOT NULL,
  `Data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `artists`
--

INSERT INTO `artists` (`Id`, `Name`, `IdArtist`, `Data`) VALUES
(1, 'Давинчии', 1, '2024-09-13');

-- --------------------------------------------------------

--
-- Структура таблицы `galleries`
--

CREATE TABLE `galleries` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `galleries`
--

INSERT INTO `galleries` (`Id`, `Name`) VALUES
(1, 'sadd'),
(2, 'sadd'),
(3, 'sadsad');

-- --------------------------------------------------------

--
-- Структура таблицы `gallerypersonal`
--

CREATE TABLE `gallerypersonal` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Role` varchar(100) NOT NULL,
  `StaffId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `gallerypersonal`
--

INSERT INTO `gallerypersonal` (`Id`, `Name`, `Role`, `StaffId`) VALUES
(2, 'Геннадий', 'вор', 2),
(3, 'asd', 'sadasd', 4),
(4, 'asds', 'dassdad', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `paintings`
--

CREATE TABLE `paintings` (
  `Id` int(11) NOT NULL,
  `Title` varchar(250) NOT NULL,
  `FileName` varchar(250) NOT NULL,
  `IdArtist` int(11) NOT NULL,
  `Data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `paintings`
--

INSERT INTO `paintings` (`Id`, `Title`, `FileName`, `IdArtist`, `Data`) VALUES
(4, 'ыфввфыв', 'photo_2023-02-12_01-15-26.jpg', 4, '2024-08-28'),
(6, 'Абобус', 'photo_2023-02-12_01-15-32.jpg', 3, '2024-09-04'),
(7, 'adsa', 'photo_2023-02-12_01-15-33.jpg', 3, '2024-09-05');

-- --------------------------------------------------------

--
-- Структура таблицы `reviewsgallery`
--

CREATE TABLE `reviewsgallery` (
  `Id` int(11) NOT NULL,
  `VisitorId` int(11) NOT NULL,
  `PaintingId` int(11) NOT NULL,
  `Rating` tinyint(4) NOT NULL,
  `Commentary` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `reviewsgallery`
--

INSERT INTO `reviewsgallery` (`Id`, `VisitorId`, `PaintingId`, `Rating`, `Commentary`) VALUES
(1, 3, 2, 2, 'sadd'),
(2, 3, 4, 5, 'adsfqwrqew'),
(3, 2, 2, 2, '23'),
(4, 2, 3, 4, 'dsa'),
(6, 2, 2, 2, '2');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `gallerypersonal`
--
ALTER TABLE `gallerypersonal`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `paintings`
--
ALTER TABLE `paintings`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `reviewsgallery`
--
ALTER TABLE `reviewsgallery`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `artists`
--
ALTER TABLE `artists`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `galleries`
--
ALTER TABLE `galleries`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `gallerypersonal`
--
ALTER TABLE `gallerypersonal`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `paintings`
--
ALTER TABLE `paintings`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `reviewsgallery`
--
ALTER TABLE `reviewsgallery`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
