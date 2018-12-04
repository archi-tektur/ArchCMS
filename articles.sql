-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Gru 2018, 23:08
-- Wersja serwera: 10.1.37-MariaDB
-- Wersja PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `_cms`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `articles`
--

CREATE TABLE `articles` (
  `ID` int(11) NOT NULL,
  `authorID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `contentShort` varchar(256) NOT NULL,
  `contentHTML` varchar(40000) NOT NULL,
  `relatedImagePath` varchar(256) DEFAULT NULL,
  `tags` varchar(256) DEFAULT NULL,
  `date` datetime NOT NULL,
  `lastEdit` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `articles`
--

INSERT INTO `articles` (`ID`, `authorID`, `categoryID`, `title`, `contentShort`, `contentHTML`, `relatedImagePath`, `tags`, `date`, `lastEdit`) VALUES
(2, 0, 0, ' efefhuefhuefhufe', 'fefeweawefw4fwewfewef', 'efeeferxgdtgt', 'efefeaafaeaeafaefaeafe', 'fseesefrsfsedfesefef', '2018-12-04 21:42:52', NULL),
(3, 0, 0, ' efefhuefhuefhufe', 'fefeweawefw4fwewfewef', 'efeeferxgdtgt', 'efefeaafaeaeafaefaeafe', 'fseesefrsfsedfesefef', '2018-12-04 21:44:08', NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `articles`
--
ALTER TABLE `articles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
