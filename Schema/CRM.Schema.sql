-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 89.46.111.61:3306
-- Creato il: Gen 15, 2022 alle 08:15
-- Versione del server: 5.6.51-91.0-log
-- Versione PHP: 8.0.7

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
-- Struttura della tabella `anno`
--

CREATE TABLE `anno` (
  `anno` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `anno_sociale`
--

CREATE TABLE `anno_sociale` (
  `anno` year(4) NOT NULL,
  `quotaSocioOrdinario` decimal(4,2) NOT NULL,
  `quotaSocioSostenitore` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `attivita`
--

CREATE TABLE `attivita` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(150) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `descrizione` text NOT NULL,
  `data_ultima_modifica` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_inserimento` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `luogo` varchar(100) NOT NULL,
  `data_attivita` datetime DEFAULT NULL COMMENT '\r\n',
  `costo` decimal(4,2) NOT NULL DEFAULT '0.00',
  `pagamento` enum('yes','no') NOT NULL DEFAULT 'no',
  `prenotazione` enum('yes','no') NOT NULL DEFAULT 'no',
  `posti_disponibili` int(11) DEFAULT NULL,
  `annullato` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie`
--

CREATE TABLE `categorie` (
  `categoria_id` bigint(20) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `descrizione` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `convocazioni`
--

CREATE TABLE `convocazioni` (
  `numero_protocollo` varchar(10) NOT NULL,
  `ordine_del_giorno` varchar(255) NOT NULL,
  `oggetto` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `data_inserimento` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ultima_modifica` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tipo` smallint(6) NOT NULL,
  `contenuto` mediumtext NOT NULL,
  `firma` varchar(255) NOT NULL,
  `delega` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `documentazione`
--

CREATE TABLE `documentazione` (
  `id` bigint(20) NOT NULL,
  `link` varchar(255) NOT NULL,
  `mime` varchar(25) NOT NULL,
  `visibile_socio` enum('yes','no') NOT NULL DEFAULT 'yes',
  `fileName` varchar(255) NOT NULL,
  `data_inserimento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultima_modifica` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `immagini`
--

CREATE TABLE `immagini` (
  `id` bigint(20) NOT NULL,
  `link` varchar(255) NOT NULL,
  `prodotto_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `intestazione`
--

CREATE TABLE `intestazione` (
  `id` bigint(20) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cap` char(5) NOT NULL,
  `citta` varchar(60) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `codice_fiscale` char(16) NOT NULL,
  `piva` char(11) NOT NULL,
  `sito` varchar(30) NOT NULL,
  `immagine` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `intestazione_social`
--

CREATE TABLE `intestazione_social` (
  `id_intestazione` bigint(20) NOT NULL,
  `id_social` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `media`
--

CREATE TABLE `media` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `mime` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `nominativo`
--

CREATE TABLE `nominativo` (
  `id` bigint(20) UNSIGNED ZEROFILL NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `data_inserimento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_ultima_modifica` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_di_nascita` date DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `partecipazione`
--

CREATE TABLE `partecipazione` (
  `attivita` bigint(20) UNSIGNED ZEROFILL NOT NULL,
  `nominativo` bigint(20) UNSIGNED ZEROFILL NOT NULL,
  `data_partecipazione` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazioni`
--

CREATE TABLE `prenotazioni` (
  `id` bigint(20) NOT NULL,
  `prenotazioni` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `attivita_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

CREATE TABLE `prodotto` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `categoria_id` bigint(20) NOT NULL,
  `descrizione` text NOT NULL,
  `quantita` bigint(20) NOT NULL,
  `data_inserimento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `proprietario_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `proprietario`
--

CREATE TABLE `proprietario` (
  `id` bigint(20) NOT NULL,
  `proprietario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `rendiconto`
--

CREATE TABLE `rendiconto` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data_inserimento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultima_modifica` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `anno` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `rendiconto_voci`
--

CREATE TABLE `rendiconto_voci` (
  `id_rendiconto` bigint(20) NOT NULL,
  `id_voce` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `soci`
--

CREATE TABLE `soci` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(40) NOT NULL,
  `cognome` varchar(40) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `data_registrazione` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_di_nascita` date NOT NULL,
  `indirizzo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `social`
--

CREATE TABLE `social` (
  `id` bigint(20) NOT NULL,
  `social` varchar(50) NOT NULL,
  `icona` varchar(50) NOT NULL COMMENT 'Icona fontawesome'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `socio_anno_sociale`
--

CREATE TABLE `socio_anno_sociale` (
  `socio` bigint(20) UNSIGNED NOT NULL,
  `anno` year(4) NOT NULL,
  `data_registrazione` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sostenitore` enum('si','no') NOT NULL,
  `validita` enum('si','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `tipo_verbali`
--

CREATE TABLE `tipo_verbali` (
  `id` smallint(6) NOT NULL,
  `tipologia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `data_di_registrazione` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_ultima_modifica` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `indirizzo` varchar(120) DEFAULT NULL,
  `status` smallint(6) NOT NULL COMMENT '0 = Deleted, 9 = Inactive, 10 = Active',
  `password_hash` varchar(255) NOT NULL,
  `auth_key` varchar(255) NOT NULL,
  `socio_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `verbali`
--

CREATE TABLE `verbali` (
  `numero_protocollo` varchar(10) NOT NULL,
  `oggetto` varchar(255) NOT NULL,
  `ordine_del_giorno` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `ora_inizio` time NOT NULL,
  `ora_fine` time NOT NULL,
  `data_inserimento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultima_modifica` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `firma` varchar(100) NOT NULL,
  `tipo` smallint(11) NOT NULL,
  `contenuto` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `voci`
--

CREATE TABLE `voci` (
  `id` bigint(20) NOT NULL,
  `voce` varchar(255) NOT NULL,
  `prezzo` decimal(7,2) NOT NULL DEFAULT '0.00',
  `data_contabile` date NOT NULL,
  `data_inserimento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultima_modifica` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tipologia` enum('entrata','uscita') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `anno`
--
ALTER TABLE `anno`
  ADD PRIMARY KEY (`anno`);

--
-- Indici per le tabelle `anno_sociale`
--
ALTER TABLE `anno_sociale`
  ADD PRIMARY KEY (`anno`);

--
-- Indici per le tabelle `attivita`
--
ALTER TABLE `attivita`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `type` (`type`);

--
-- Indici per le tabelle `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indici per le tabelle `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indici per le tabelle `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indici per le tabelle `convocazioni`
--
ALTER TABLE `convocazioni`
  ADD PRIMARY KEY (`numero_protocollo`),
  ADD KEY `tipo` (`tipo`);

--
-- Indici per le tabelle `immagini`
--
ALTER TABLE `immagini`
  ADD PRIMARY KEY (`id`),
  ADD KEY `immagini_ibfk_1` (`prodotto_id`);

--
-- Indici per le tabelle `intestazione`
--
ALTER TABLE `intestazione`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `intestazione_social`
--
ALTER TABLE `intestazione_social`
  ADD PRIMARY KEY (`id_intestazione`,`id_social`),
  ADD KEY `id_social` (`id_social`);

--
-- Indici per le tabelle `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `nominativo`
--
ALTER TABLE `nominativo`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `partecipazione`
--
ALTER TABLE `partecipazione`
  ADD PRIMARY KEY (`attivita`,`nominativo`),
  ADD KEY `nominativo` (`nominativo`);

--
-- Indici per le tabelle `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `proprietario_id` (`proprietario_id`);

--
-- Indici per le tabelle `proprietario`
--
ALTER TABLE `proprietario`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `rendiconto`
--
ALTER TABLE `rendiconto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anno` (`anno`);

--
-- Indici per le tabelle `rendiconto_voci`
--
ALTER TABLE `rendiconto_voci`
  ADD PRIMARY KEY (`id_rendiconto`,`id_voce`) USING BTREE,
  ADD KEY `id_voce` (`id_voce`);

--
-- Indici per le tabelle `soci`
--
ALTER TABLE `soci`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `socio_anno_sociale`
--
ALTER TABLE `socio_anno_sociale`
  ADD PRIMARY KEY (`socio`,`anno`),
  ADD KEY `anno` (`anno`);

--
-- Indici per le tabelle `tipo_verbali`
--
ALTER TABLE `tipo_verbali`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `verbali`
--
ALTER TABLE `verbali`
  ADD PRIMARY KEY (`numero_protocollo`),
  ADD KEY `tipo` (`tipo`);

--
-- Indici per le tabelle `voci`
--
ALTER TABLE `voci`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `attivita`
--
ALTER TABLE `attivita`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `categorie`
--
ALTER TABLE `categorie`
  MODIFY `categoria_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `immagini`
--
ALTER TABLE `immagini`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `intestazione`
--
ALTER TABLE `intestazione`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `nominativo`
--
ALTER TABLE `nominativo`
  MODIFY `id` bigint(20) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `proprietario`
--
ALTER TABLE `proprietario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `rendiconto`
--
ALTER TABLE `rendiconto`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `soci`
--
ALTER TABLE `soci`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `social`
--
ALTER TABLE `social`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `tipo_verbali`
--
ALTER TABLE `tipo_verbali`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `voci`
--
ALTER TABLE `voci`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utenti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `convocazioni`
--
ALTER TABLE `convocazioni`
  ADD CONSTRAINT `convocazioni_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo_verbali` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `immagini`
--
ALTER TABLE `immagini`
  ADD CONSTRAINT `immagini_ibfk_1` FOREIGN KEY (`prodotto_id`) REFERENCES `prodotto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `intestazione_social`
--
ALTER TABLE `intestazione_social`
  ADD CONSTRAINT `intestazione_social_ibfk_1` FOREIGN KEY (`id_intestazione`) REFERENCES `intestazione` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `intestazione_social_ibfk_2` FOREIGN KEY (`id_social`) REFERENCES `social` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `partecipazione`
--
ALTER TABLE `partecipazione`
  ADD CONSTRAINT `partecipazione_ibfk_1` FOREIGN KEY (`attivita`) REFERENCES `attivita` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partecipazione_ibfk_2` FOREIGN KEY (`nominativo`) REFERENCES `nominativo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  ADD CONSTRAINT `prodotto_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorie` (`categoria_id`),
  ADD CONSTRAINT `prodotto_ibfk_2` FOREIGN KEY (`proprietario_id`) REFERENCES `proprietario` (`id`);

--
-- Limiti per la tabella `rendiconto`
--
ALTER TABLE `rendiconto`
  ADD CONSTRAINT `rendiconto_ibfk_1` FOREIGN KEY (`anno`) REFERENCES `anno` (`anno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `rendiconto_voci`
--
ALTER TABLE `rendiconto_voci`
  ADD CONSTRAINT `rendiconto_voci_ibfk_1` FOREIGN KEY (`id_rendiconto`) REFERENCES `rendiconto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rendiconto_voci_ibfk_2` FOREIGN KEY (`id_voce`) REFERENCES `voci` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `socio_anno_sociale`
--
ALTER TABLE `socio_anno_sociale`
  ADD CONSTRAINT `socio_anno_sociale_ibfk_1` FOREIGN KEY (`anno`) REFERENCES `anno_sociale` (`anno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `socio_anno_sociale_ibfk_2` FOREIGN KEY (`socio`) REFERENCES `soci` (`id`);

--
-- Limiti per la tabella `verbali`
--
ALTER TABLE `verbali`
  ADD CONSTRAINT `verbali_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo_verbali` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
