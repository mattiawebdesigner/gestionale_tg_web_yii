-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 89.46.111.61:3306
-- Creato il: Feb 28, 2022 alle 15:54
-- Versione del server: 5.6.51-91.0-log
-- Versione PHP: 8.0.7

-- USATO NELLA PRIMA VERSIONE DEL SISTEMA DI PRENOTAZIONI

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Sql1190742_1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_fila`
--

CREATE TABLE `ilt_fila` (
  `id` int(11) NOT NULL,
  `nome_fila` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ilt_fila`
--

INSERT INTO `ilt_fila` (`id`, `nome_fila`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'E'),
(6, 'F'),
(7, 'G'),
(8, 'H'),
(9, 'L'),
(10, 'M'),
(11, 'N'),
(12, 'O'),
(13, '1'),
(14, '2'),
(15, '1'),
(16, '2'),
(17, '1'),
(18, '2'),
(19, '1'),
(20, '2'),
(21, '1'),
(22, '2'),
(23, '1'),
(24, '2'),
(25, '1'),
(26, '2'),
(27, '1'),
(28, '2'),
(29, '1'),
(30, '2'),
(31, '1'),
(32, '2'),
(33, '1'),
(34, '2'),
(35, '1'),
(36, '1'),
(37, '1'),
(38, '1'),
(39, '2'),
(40, '1'),
(41, '2'),
(42, '1'),
(43, '2'),
(44, '3'),
(45, '1'),
(46, '2'),
(47, '1'),
(48, '2'),
(49, '1'),
(50, '1'),
(51, '1'),
(52, '1'),
(53, '1'),
(54, '1'),
(55, '1'),
(56, '2'),
(57, '1'),
(58, '2'),
(59, '1'),
(60, '1'),
(61, '1');

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_ordine`
--

CREATE TABLE `ilt_ordine` (
  `id` int(11) NOT NULL,
  `ordine` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ilt_ordine`
--

INSERT INTO `ilt_ordine` (`id`, `ordine`) VALUES
(1, 'Primo'),
(2, 'Secondo'),
(3, 'Terzo');

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_palco`
--

CREATE TABLE `ilt_palco` (
  `id` int(11) NOT NULL,
  `ordine` int(11) NOT NULL,
  `palco` int(11) NOT NULL,
  `visibilita_ridotta` int(11) NOT NULL DEFAULT '0' COMMENT '0: No\r\n10: Si',
  `fila` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ilt_palco`
--

INSERT INTO `ilt_palco` (`id`, `ordine`, `palco`, `visibilita_ridotta`, `fila`) VALUES
(1, 1, 1, 0, 13),
(2, 1, 1, 0, 14),
(4, 1, 2, 0, 15),
(5, 1, 2, 0, 16),
(6, 1, 3, 0, 17),
(7, 1, 3, 0, 18),
(8, 1, 4, 0, 19),
(10, 1, 4, 0, 20),
(12, 1, 5, 0, 21),
(14, 1, 5, 0, 22),
(16, 1, 7, 0, 23),
(18, 1, 7, 0, 24),
(24, 1, 8, 0, 25),
(26, 1, 8, 0, 26),
(28, 1, 9, 0, 27),
(30, 1, 9, 0, 28),
(32, 1, 10, 0, 29),
(33, 1, 10, 0, 30),
(38, 1, 11, 0, 31),
(39, 1, 11, 0, 32),
(40, 1, 12, 0, 33),
(41, 1, 12, 0, 34),
(42, 2, 1, 0, 35),
(43, 2, 2, 0, 36),
(44, 2, 3, 0, 37),
(45, 2, 4, 0, 38),
(46, 2, 4, 0, 39),
(48, 2, 5, 0, 40),
(50, 2, 5, 0, 41),
(51, 2, 6, 0, 42),
(52, 2, 6, 0, 43),
(53, 2, 6, 0, 44),
(54, 2, 7, 0, 45),
(55, 2, 7, 0, 46),
(56, 2, 8, 0, 47),
(57, 2, 8, 0, 48),
(58, 2, 9, 0, 49),
(59, 2, 10, 0, 50),
(60, 2, 11, 0, 51),
(61, 3, 2, 10, 52),
(62, 3, 3, 10, 53),
(63, 3, 4, 0, 54),
(64, 3, 5, 0, 55),
(65, 3, 5, 0, 56),
(66, 3, 7, 0, 57),
(67, 3, 7, 0, 58),
(68, 3, 8, 0, 59),
(69, 3, 9, 10, 60),
(70, 3, 10, 10, 61);

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_platea`
--

CREATE TABLE `ilt_platea` (
  `id` int(11) NOT NULL,
  `fila` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ilt_platea`
--

INSERT INTO `ilt_platea` (`id`, `fila`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12);

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_posto`
--

CREATE TABLE `ilt_posto` (
  `id` int(11) NOT NULL,
  `posto` int(11) NOT NULL,
  `fila` int(11) NOT NULL,
  `tipo_di_seduta` int(11) NOT NULL DEFAULT '1' COMMENT '1: Poltrona\r\n2: Sedia\r\n3: Sgabello'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ilt_posto`
--

INSERT INTO `ilt_posto` (`id`, `posto`, `fila`, `tipo_di_seduta`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 4, 1, 1),
(5, 5, 1, 1),
(6, 6, 1, 1),
(7, 7, 1, 1),
(8, 8, 1, 1),
(9, 9, 1, 1),
(10, 10, 1, 1),
(11, 11, 1, 1),
(12, 12, 1, 1),
(13, 1, 2, 1),
(14, 2, 2, 1),
(15, 3, 2, 1),
(16, 4, 2, 1),
(17, 5, 2, 1),
(18, 6, 2, 1),
(19, 7, 2, 1),
(20, 8, 2, 1),
(21, 9, 2, 1),
(22, 10, 2, 1),
(23, 11, 2, 1),
(24, 12, 2, 1),
(25, 0, 3, 1),
(26, 1, 3, 1),
(27, 2, 3, 1),
(28, 3, 3, 1),
(29, 4, 3, 1),
(30, 5, 3, 1),
(31, 6, 3, 1),
(32, 7, 3, 1),
(33, 8, 3, 1),
(34, 9, 3, 1),
(35, 10, 3, 1),
(36, 11, 3, 1),
(37, 12, 3, 1),
(38, 14, 3, 1),
(39, 1, 4, 1),
(40, 2, 4, 1),
(41, 3, 4, 1),
(42, 4, 4, 1),
(43, 5, 4, 1),
(44, 6, 4, 1),
(45, 7, 4, 1),
(46, 8, 4, 1),
(47, 9, 4, 1),
(48, 10, 4, 1),
(49, 11, 4, 1),
(50, 12, 4, 1),
(51, 14, 4, 1),
(52, 1, 5, 1),
(53, 2, 5, 1),
(54, 3, 5, 1),
(55, 4, 5, 1),
(56, 5, 5, 1),
(57, 6, 5, 1),
(58, 7, 5, 1),
(59, 8, 5, 1),
(60, 9, 5, 1),
(61, 10, 5, 1),
(62, 11, 5, 1),
(63, 12, 5, 1),
(64, 14, 5, 1),
(65, 1, 6, 1),
(66, 2, 6, 1),
(67, 3, 6, 1),
(68, 4, 6, 1),
(69, 5, 6, 1),
(70, 6, 6, 1),
(71, 7, 6, 1),
(72, 8, 6, 1),
(73, 9, 6, 1),
(74, 10, 6, 1),
(75, 11, 6, 1),
(76, 12, 6, 1),
(77, 14, 6, 1),
(78, 1, 7, 1),
(79, 2, 7, 1),
(80, 3, 7, 1),
(81, 4, 7, 1),
(82, 5, 7, 1),
(83, 6, 7, 1),
(84, 7, 7, 1),
(85, 8, 7, 1),
(86, 9, 7, 1),
(87, 10, 7, 1),
(88, 11, 7, 1),
(89, 12, 7, 1),
(90, 14, 7, 1),
(91, 1, 8, 1),
(92, 2, 8, 1),
(93, 3, 8, 1),
(94, 4, 8, 1),
(95, 5, 8, 1),
(96, 6, 8, 1),
(97, 7, 8, 1),
(98, 8, 8, 1),
(99, 9, 8, 1),
(100, 10, 8, 1),
(101, 11, 8, 1),
(102, 12, 8, 1),
(103, 14, 8, 1),
(104, 1, 9, 1),
(105, 2, 9, 1),
(106, 3, 9, 1),
(107, 4, 9, 1),
(108, 5, 9, 1),
(109, 6, 9, 1),
(110, 7, 9, 1),
(111, 8, 9, 1),
(112, 9, 9, 1),
(113, 10, 9, 1),
(114, 11, 9, 1),
(115, 12, 9, 1),
(116, 1, 10, 1),
(117, 2, 10, 1),
(118, 3, 10, 1),
(119, 4, 10, 1),
(120, 5, 10, 1),
(121, 6, 10, 1),
(122, 7, 10, 1),
(123, 8, 10, 1),
(124, 9, 10, 1),
(125, 10, 10, 1),
(126, 11, 10, 1),
(127, 1, 11, 1),
(128, 2, 11, 1),
(129, 3, 11, 1),
(130, 4, 11, 1),
(134, 6, 11, 1),
(135, 5, 11, 1),
(137, 7, 11, 1),
(144, 1, 13, 2),
(145, 2, 13, 2),
(146, 1, 14, 3),
(147, 1, 15, 2),
(148, 2, 15, 2),
(149, 1, 16, 3),
(150, 2, 16, 3),
(151, 1, 17, 2),
(152, 2, 17, 2),
(153, 1, 18, 3),
(154, 2, 18, 3),
(155, 1, 12, 2),
(156, 2, 12, 2),
(157, 3, 12, 2),
(158, 4, 12, 2),
(159, 1, 19, 2),
(160, 2, 19, 2),
(161, 1, 20, 2),
(162, 2, 20, 2),
(163, 1, 21, 2),
(164, 2, 21, 2),
(165, 1, 22, 2),
(166, 2, 22, 2),
(167, 3, 21, 2),
(168, 3, 22, 2),
(175, 1, 23, 2),
(176, 2, 23, 2),
(177, 3, 23, 2),
(178, 1, 24, 2),
(179, 2, 24, 2),
(180, 3, 24, 2),
(181, 1, 25, 2),
(182, 2, 29, 2),
(183, 1, 27, 2),
(184, 1, 26, 2),
(185, 2, 25, 2),
(186, 3, 25, 2),
(187, 2, 27, 2),
(188, 1, 29, 2),
(189, 1, 28, 2),
(190, 4, 26, 2),
(191, 2, 28, 2),
(192, 6, 26, 2),
(193, 1, 30, 2),
(194, 2, 30, 2),
(195, 1, 31, 2),
(196, 2, 31, 2),
(197, 1, 32, 2),
(198, 2, 32, 2),
(199, 1, 33, 2),
(200, 2, 33, 2),
(201, 1, 34, 2),
(202, 1, 35, 2),
(203, 2, 35, 2),
(204, 1, 36, 2),
(205, 2, 36, 2),
(206, 1, 37, 2),
(207, 2, 37, 2),
(208, 1, 38, 2),
(209, 2, 38, 2),
(210, 1, 39, 2),
(211, 1, 40, 2),
(212, 2, 40, 2),
(213, 1, 41, 2),
(214, 1, 42, 2),
(215, 2, 42, 2),
(216, 3, 42, 2),
(217, 4, 42, 2),
(218, 5, 42, 2),
(219, 6, 42, 2),
(220, 7, 42, 2),
(221, 8, 42, 2),
(222, 9, 42, 2),
(223, 10, 42, 2),
(224, 11, 42, 2),
(225, 12, 42, 2),
(226, 13, 42, 2),
(227, 1, 43, 2),
(228, 2, 43, 2),
(229, 3, 43, 2),
(230, 4, 43, 2),
(231, 5, 43, 2),
(232, 6, 43, 2),
(233, 7, 43, 2),
(234, 8, 43, 2),
(235, 9, 43, 2),
(236, 10, 43, 2),
(237, 11, 43, 2),
(238, 12, 43, 2),
(239, 13, 43, 2),
(240, 1, 44, 2),
(241, 2, 44, 2),
(242, 3, 44, 2),
(243, 4, 44, 2),
(244, 5, 44, 2),
(245, 6, 44, 2),
(246, 7, 44, 2),
(247, 8, 44, 2),
(248, 9, 44, 2),
(249, 10, 44, 2),
(250, 11, 44, 2),
(251, 12, 44, 2),
(252, 13, 44, 2),
(253, 1, 45, 2),
(254, 2, 45, 2),
(255, 1, 46, 2),
(256, 1, 47, 2),
(257, 2, 47, 2),
(258, 1, 48, 3),
(259, 1, 49, 2),
(260, 2, 49, 2),
(261, 1, 50, 1),
(262, 2, 50, 1),
(263, 1, 51, 2),
(264, 2, 51, 2),
(265, 1, 52, 3),
(266, 2, 52, 3),
(267, 1, 53, 3),
(268, 2, 53, 3),
(269, 1, 54, 3),
(270, 2, 54, 3),
(271, 1, 55, 3),
(272, 2, 55, 3),
(273, 1, 56, 3),
(274, 1, 57, 3),
(275, 2, 57, 3),
(276, 1, 58, 3),
(277, 1, 59, 3),
(278, 2, 59, 3),
(279, 1, 60, 3),
(280, 2, 60, 3),
(281, 1, 61, 3),
(282, 2, 61, 3);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `ilt_fila`
--
ALTER TABLE `ilt_fila`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ilt_ordine`
--
ALTER TABLE `ilt_ordine`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ilt_palco`
--
ALTER TABLE `ilt_palco`
  ADD PRIMARY KEY (`id`),
  ADD KEY `palco_ibfk_1` (`ordine`),
  ADD KEY `fila` (`fila`);

--
-- Indici per le tabelle `ilt_platea`
--
ALTER TABLE `ilt_platea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fila` (`fila`);

--
-- Indici per le tabelle `ilt_posto`
--
ALTER TABLE `ilt_posto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posto_ibfk_1` (`fila`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `ilt_fila`
--
ALTER TABLE `ilt_fila`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT per la tabella `ilt_ordine`
--
ALTER TABLE `ilt_ordine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `ilt_palco`
--
ALTER TABLE `ilt_palco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT per la tabella `ilt_platea`
--
ALTER TABLE `ilt_platea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `ilt_posto`
--
ALTER TABLE `ilt_posto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
