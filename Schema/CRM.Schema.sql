-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 89.46.111.61:3306
-- Creato il: Gen 28, 2025 alle 11:42
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
-- Struttura della tabella `ilt_album`
--

CREATE TABLE `ilt_album` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descrizione` varchar(350) DEFAULT NULL,
  `data_creazione` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ultima_modifica` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_album_commenti`
--

CREATE TABLE `ilt_album_commenti` (
  `album` bigint(20) NOT NULL,
  `commento` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_album_foto`
--

CREATE TABLE `ilt_album_foto` (
  `album` bigint(20) NOT NULL,
  `foto` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_allegati`
--

CREATE TABLE `ilt_allegati` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(350) NOT NULL,
  `allegato` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_articoli`
--

CREATE TABLE `ilt_articoli` (
  `id` bigint(20) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `contenuto` longtext NOT NULL,
  `data_pubblicazione` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inizio_pubblicazione` datetime DEFAULT NULL,
  `fine_pubblicazione` datetime DEFAULT NULL,
  `immagine_in_evidenza` varchar(300) DEFAULT NULL,
  `meta_description` varchar(100) DEFAULT NULL,
  `meta_keyword` varchar(100) DEFAULT NULL,
  `commenti` tinyint(4) NOT NULL DEFAULT '0',
  `categoria` bigint(20) DEFAULT NULL,
  `pubblicato` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0: Cestinato\r\n1: Bozza\r\n10: Pubblicato'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_articoli_commenti`
--

CREATE TABLE `ilt_articoli_commenti` (
  `articolo` bigint(20) NOT NULL,
  `commento` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_categorie`
--

CREATE TABLE `ilt_categorie` (
  `id` bigint(20) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `categorie_padre` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_commenti`
--

CREATE TABLE `ilt_commenti` (
  `id` bigint(20) NOT NULL,
  `commento` varchar(500) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approvato` tinyint(4) NOT NULL COMMENT '0: Non approvato\n1: Da approvare\n10: Approvato'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_commenti_foto`
--

CREATE TABLE `ilt_commenti_foto` (
  `commento` bigint(20) NOT NULL,
  `foto` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_festival`
--

CREATE TABLE `ilt_festival` (
  `id` bigint(20) NOT NULL,
  `anno` year(4) NOT NULL,
  `inizio` date NOT NULL,
  `fine` date NOT NULL,
  `edizione` varchar(15) NOT NULL,
  `inizio_pubblicazione` datetime DEFAULT NULL,
  `fine_pubblicazione` datetime DEFAULT NULL,
  `regolamenti` varchar(300) NOT NULL,
  `descrizione` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_festival_allegati`
--

CREATE TABLE `ilt_festival_allegati` (
  `festival` bigint(20) NOT NULL,
  `allegato` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_festival_sponsor`
--

CREATE TABLE `ilt_festival_sponsor` (
  `sponsor` bigint(20) NOT NULL,
  `festival` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_fila`
--

CREATE TABLE `ilt_fila` (
  `id` int(11) NOT NULL,
  `nome_fila` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_foto`
--

CREATE TABLE `ilt_foto` (
  `id` bigint(20) NOT NULL,
  `url` varchar(300) NOT NULL,
  `alt_text` varchar(80) DEFAULT NULL,
  `title_text` varchar(80) DEFAULT NULL,
  `posizione` int(11) NOT NULL,
  `descrizione` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_impostazioni`
--

CREATE TABLE `ilt_impostazioni` (
  `id` bigint(20) NOT NULL,
  `impostazione` varchar(50) NOT NULL,
  `valore` varchar(65000) NOT NULL,
  `struttura` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_iscrizioni`
--

CREATE TABLE `ilt_iscrizioni` (
  `id` bigint(20) NOT NULL,
  `compagnia` varchar(150) NOT NULL,
  `codice_fiscale_compagnia` char(11) DEFAULT NULL,
  `partita_iva` char(11) DEFAULT NULL,
  `nome_referente` varchar(50) NOT NULL,
  `cognome_referente` varchar(50) NOT NULL,
  `codice_fiscale_referente` char(16) NOT NULL,
  `festival` bigint(20) NOT NULL,
  `attivo` int(11) NOT NULL DEFAULT '1' COMMENT '1: Da approvare\r\n2: Iscrizione rifiutata\r\n9: Cancellato\r\n10: Iscritto',
  `email` varchar(150) NOT NULL,
  `pec` varchar(150) NOT NULL,
  `federazione` varchar(255) NOT NULL COMMENT 'UILT, FITA, TAI, ...',
  `numeroIscrizione` varchar(50) NOT NULL COMMENT 'Numero di iscrizione ad una federazione',
  `titolo_spettacolo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_iscrizioni_allegati`
--

CREATE TABLE `ilt_iscrizioni_allegati` (
  `iscrizione` bigint(20) NOT NULL,
  `allegato` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_ordine`
--

CREATE TABLE `ilt_ordine` (
  `id` int(11) NOT NULL,
  `ordine` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_partner`
--

CREATE TABLE `ilt_partner` (
  `id` bigint(20) NOT NULL,
  `partner` varchar(150) NOT NULL,
  `note` text,
  `tipo_di_sponsorizzazione` varchar(255) NOT NULL,
  `postazioni` varchar(255) NOT NULL,
  `ordinamento` int(11) NOT NULL DEFAULT '1',
  `logo` varchar(255) NOT NULL,
  `sito_internet` varchar(255) DEFAULT NULL,
  `festival` bigint(20) NOT NULL,
  `tipologia_di_partner` smallint(6) DEFAULT '0' COMMENT '0: sponsor\r\n1: partner pubbliche amministrazioni o associazioni'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_platea`
--

CREATE TABLE `ilt_platea` (
  `id` int(11) NOT NULL,
  `fila` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_premi`
--

CREATE TABLE `ilt_premi` (
  `id` bigint(20) NOT NULL,
  `premio` varchar(155) NOT NULL,
  `nome` varchar(155) NOT NULL,
  `icona` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_premi_festival`
--

CREATE TABLE `ilt_premi_festival` (
  `premio` bigint(20) NOT NULL,
  `festival` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_prenotazione`
--

CREATE TABLE `ilt_prenotazione` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cellulare` varchar(255) NOT NULL,
  `spettacolo` int(11) NOT NULL,
  `posto` int(11) DEFAULT NULL,
  `pagato` int(11) NOT NULL DEFAULT '0' COMMENT '10: Pagato\r\n0: Non pagato',
  `data_registrazione` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `prenotazione` longtext,
  `ultima_modifica` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `abbonamento` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_spettacolo`
--

CREATE TABLE `ilt_spettacolo` (
  `id` int(11) NOT NULL,
  `spettacolo` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `ora_porta` time NOT NULL,
  `ora_sipario` time NOT NULL,
  `banner` varchar(255) NOT NULL,
  `locandina` varchar(255) NOT NULL,
  `festival` bigint(20) NOT NULL,
  `sinossi` longtext,
  `piantina` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_sponsor`
--

CREATE TABLE `ilt_sponsor` (
  `id` bigint(20) NOT NULL,
  `sponsor` varchar(50) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `immagine` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_teatro_piantina`
--

CREATE TABLE `ilt_teatro_piantina` (
  `id` bigint(20) NOT NULL,
  `teatro` varchar(100) NOT NULL,
  `piantina` longtext NOT NULL,
  `background` varchar(255) DEFAULT NULL,
  `position` varchar(100) NOT NULL COMMENT 'Posizione dello sfondo della piantina'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `ilt_vincitori`
--

CREATE TABLE `ilt_vincitori` (
  `iscrizione` bigint(20) NOT NULL,
  `premio` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `ilt_album`
--
ALTER TABLE `ilt_album`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ilt_album_commenti`
--
ALTER TABLE `ilt_album_commenti`
  ADD PRIMARY KEY (`album`,`commento`),
  ADD KEY `fk_album_has_commenti_commenti1_idx` (`commento`),
  ADD KEY `fk_album_has_commenti_album1_idx` (`album`);

--
-- Indici per le tabelle `ilt_album_foto`
--
ALTER TABLE `ilt_album_foto`
  ADD PRIMARY KEY (`album`,`foto`),
  ADD KEY `fk_album_has_foto_foto1_idx` (`foto`),
  ADD KEY `fk_album_has_foto_album1_idx` (`album`);

--
-- Indici per le tabelle `ilt_allegati`
--
ALTER TABLE `ilt_allegati`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ilt_articoli`
--
ALTER TABLE `ilt_articoli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_articoli_categorie1_idx` (`categoria`);

--
-- Indici per le tabelle `ilt_articoli_commenti`
--
ALTER TABLE `ilt_articoli_commenti`
  ADD PRIMARY KEY (`articolo`,`commento`),
  ADD KEY `fk_articoli_has_commenti_commenti1_idx` (`commento`),
  ADD KEY `fk_articoli_has_commenti_articoli1_idx` (`articolo`);

--
-- Indici per le tabelle `ilt_categorie`
--
ALTER TABLE `ilt_categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categorie_categorie1_idx` (`categorie_padre`);

--
-- Indici per le tabelle `ilt_commenti`
--
ALTER TABLE `ilt_commenti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ilt_commenti_foto`
--
ALTER TABLE `ilt_commenti_foto`
  ADD PRIMARY KEY (`commento`,`foto`),
  ADD KEY `fk_commenti_has_foto_foto1_idx` (`foto`),
  ADD KEY `fk_commenti_has_foto_commenti1_idx` (`commento`);

--
-- Indici per le tabelle `ilt_festival`
--
ALTER TABLE `ilt_festival`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ilt_festival_allegati`
--
ALTER TABLE `ilt_festival_allegati`
  ADD PRIMARY KEY (`festival`,`allegato`),
  ADD KEY `allegato` (`allegato`);

--
-- Indici per le tabelle `ilt_festival_sponsor`
--
ALTER TABLE `ilt_festival_sponsor`
  ADD PRIMARY KEY (`sponsor`,`festival`),
  ADD KEY `festival` (`festival`);

--
-- Indici per le tabelle `ilt_fila`
--
ALTER TABLE `ilt_fila`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ilt_foto`
--
ALTER TABLE `ilt_foto`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ilt_impostazioni`
--
ALTER TABLE `ilt_impostazioni`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ilt_iscrizioni`
--
ALTER TABLE `ilt_iscrizioni`
  ADD PRIMARY KEY (`id`,`festival`),
  ADD KEY `fk_iscrizioni_festival1_idx` (`festival`);

--
-- Indici per le tabelle `ilt_iscrizioni_allegati`
--
ALTER TABLE `ilt_iscrizioni_allegati`
  ADD PRIMARY KEY (`iscrizione`,`allegato`),
  ADD KEY `fk_iscrizioni_has_allegati_allegati1_idx` (`allegato`),
  ADD KEY `fk_iscrizioni_has_allegati_iscrizioni_idx` (`iscrizione`);

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
-- Indici per le tabelle `ilt_partner`
--
ALTER TABLE `ilt_partner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `festival` (`festival`);

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
-- Indici per le tabelle `ilt_premi`
--
ALTER TABLE `ilt_premi`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ilt_premi_festival`
--
ALTER TABLE `ilt_premi_festival`
  ADD PRIMARY KEY (`premio`,`festival`),
  ADD KEY `festival` (`festival`);

--
-- Indici per le tabelle `ilt_prenotazione`
--
ALTER TABLE `ilt_prenotazione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spettacolo` (`spettacolo`),
  ADD KEY `posto` (`posto`);

--
-- Indici per le tabelle `ilt_spettacolo`
--
ALTER TABLE `ilt_spettacolo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `festival` (`festival`);

--
-- Indici per le tabelle `ilt_sponsor`
--
ALTER TABLE `ilt_sponsor`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ilt_teatro_piantina`
--
ALTER TABLE `ilt_teatro_piantina`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ilt_vincitori`
--
ALTER TABLE `ilt_vincitori`
  ADD PRIMARY KEY (`iscrizione`,`premio`),
  ADD KEY `premio` (`premio`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `ilt_album`
--
ALTER TABLE `ilt_album`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_allegati`
--
ALTER TABLE `ilt_allegati`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_articoli`
--
ALTER TABLE `ilt_articoli`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_categorie`
--
ALTER TABLE `ilt_categorie`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_commenti`
--
ALTER TABLE `ilt_commenti`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_festival`
--
ALTER TABLE `ilt_festival`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_fila`
--
ALTER TABLE `ilt_fila`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_foto`
--
ALTER TABLE `ilt_foto`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_impostazioni`
--
ALTER TABLE `ilt_impostazioni`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_iscrizioni`
--
ALTER TABLE `ilt_iscrizioni`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_ordine`
--
ALTER TABLE `ilt_ordine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_palco`
--
ALTER TABLE `ilt_palco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_partner`
--
ALTER TABLE `ilt_partner`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_platea`
--
ALTER TABLE `ilt_platea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_posto`
--
ALTER TABLE `ilt_posto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_premi`
--
ALTER TABLE `ilt_premi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_prenotazione`
--
ALTER TABLE `ilt_prenotazione`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_spettacolo`
--
ALTER TABLE `ilt_spettacolo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_sponsor`
--
ALTER TABLE `ilt_sponsor`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ilt_teatro_piantina`
--
ALTER TABLE `ilt_teatro_piantina`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `ilt_album_commenti`
--
ALTER TABLE `ilt_album_commenti`
  ADD CONSTRAINT `fk_album_has_commenti_album1` FOREIGN KEY (`album`) REFERENCES `ilt_album` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_album_has_commenti_commenti1` FOREIGN KEY (`commento`) REFERENCES `ilt_commenti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ilt_album_foto`
--
ALTER TABLE `ilt_album_foto`
  ADD CONSTRAINT `fk_album_has_foto_album1` FOREIGN KEY (`album`) REFERENCES `ilt_album` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_album_has_foto_foto1` FOREIGN KEY (`foto`) REFERENCES `ilt_foto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ilt_articoli`
--
ALTER TABLE `ilt_articoli`
  ADD CONSTRAINT `fk_articoli_categorie1` FOREIGN KEY (`categoria`) REFERENCES `ilt_categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ilt_articoli_commenti`
--
ALTER TABLE `ilt_articoli_commenti`
  ADD CONSTRAINT `fk_articoli_has_commenti_articoli1` FOREIGN KEY (`articolo`) REFERENCES `ilt_articoli` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_articoli_has_commenti_commenti1` FOREIGN KEY (`commento`) REFERENCES `ilt_commenti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ilt_categorie`
--
ALTER TABLE `ilt_categorie`
  ADD CONSTRAINT `fk_categorie_categorie1` FOREIGN KEY (`categorie_padre`) REFERENCES `ilt_categorie` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Limiti per la tabella `ilt_commenti_foto`
--
ALTER TABLE `ilt_commenti_foto`
  ADD CONSTRAINT `fk_commenti_has_foto_commenti1` FOREIGN KEY (`commento`) REFERENCES `ilt_commenti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_commenti_has_foto_foto1` FOREIGN KEY (`foto`) REFERENCES `ilt_foto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `ilt_festival_allegati`
--
ALTER TABLE `ilt_festival_allegati`
  ADD CONSTRAINT `ilt_festival_allegati_ibfk_1` FOREIGN KEY (`allegato`) REFERENCES `ilt_allegati` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ilt_festival_allegati_ibfk_2` FOREIGN KEY (`festival`) REFERENCES `ilt_festival` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ilt_festival_sponsor`
--
ALTER TABLE `ilt_festival_sponsor`
  ADD CONSTRAINT `ilt_festival_sponsor_ibfk_1` FOREIGN KEY (`festival`) REFERENCES `ilt_festival` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ilt_festival_sponsor_ibfk_2` FOREIGN KEY (`sponsor`) REFERENCES `ilt_sponsor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ilt_iscrizioni`
--
ALTER TABLE `ilt_iscrizioni`
  ADD CONSTRAINT `fk_iscrizioni_festival1` FOREIGN KEY (`festival`) REFERENCES `ilt_festival` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `ilt_iscrizioni_allegati`
--
ALTER TABLE `ilt_iscrizioni_allegati`
  ADD CONSTRAINT `fk_iscrizioni_has_allegati_allegati1` FOREIGN KEY (`allegato`) REFERENCES `ilt_allegati` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_iscrizioni_has_allegati_iscrizioni` FOREIGN KEY (`iscrizione`) REFERENCES `ilt_iscrizioni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ilt_palco`
--
ALTER TABLE `ilt_palco`
  ADD CONSTRAINT `ilt_palco_ibfk_1` FOREIGN KEY (`ordine`) REFERENCES `ilt_ordine` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ilt_palco_ibfk_2` FOREIGN KEY (`fila`) REFERENCES `ilt_fila` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ilt_partner`
--
ALTER TABLE `ilt_partner`
  ADD CONSTRAINT `ilt_partner_ibfk_1` FOREIGN KEY (`festival`) REFERENCES `ilt_festival` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ilt_platea`
--
ALTER TABLE `ilt_platea`
  ADD CONSTRAINT `ilt_platea_ibfk_1` FOREIGN KEY (`fila`) REFERENCES `ilt_fila` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ilt_posto`
--
ALTER TABLE `ilt_posto`
  ADD CONSTRAINT `ilt_posto_ibfk_1` FOREIGN KEY (`fila`) REFERENCES `ilt_fila` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ilt_premi_festival`
--
ALTER TABLE `ilt_premi_festival`
  ADD CONSTRAINT `ilt_premi_festival_ibfk_1` FOREIGN KEY (`festival`) REFERENCES `ilt_festival` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ilt_premi_festival_ibfk_2` FOREIGN KEY (`premio`) REFERENCES `ilt_premi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ilt_prenotazione`
--
ALTER TABLE `ilt_prenotazione`
  ADD CONSTRAINT `ilt_prenotazione_ibfk_1` FOREIGN KEY (`spettacolo`) REFERENCES `ilt_spettacolo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ilt_prenotazione_ibfk_2` FOREIGN KEY (`posto`) REFERENCES `ilt_posto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ilt_spettacolo`
--
ALTER TABLE `ilt_spettacolo`
  ADD CONSTRAINT `ilt_spettacolo_ibfk_1` FOREIGN KEY (`festival`) REFERENCES `ilt_festival` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `ilt_vincitori`
--
ALTER TABLE `ilt_vincitori`
  ADD CONSTRAINT `ilt_vincitori_ibfk_1` FOREIGN KEY (`iscrizione`) REFERENCES `ilt_iscrizioni` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ilt_vincitori_ibfk_2` FOREIGN KEY (`premio`) REFERENCES `ilt_premi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
