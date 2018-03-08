-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 08. Mrz 2018 um 23:18
-- Server-Version: 10.1.25-MariaDB
-- PHP-Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `database_jml`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `article`
--

CREATE TABLE `article` (
  `articleId` varchar(200) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subtitle` varchar(300) DEFAULT NULL,
  `text` text NOT NULL,
  `userId` varchar(200) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `article`
--

INSERT INTO `article` (`articleId`, `title`, `subtitle`, `text`, `userId`, `created`) VALUES
('b3d951c4-04d9-4761-9b8a-d1ccc76ef424', 'Wie Eltern die Sprachentwicklung ihrer Kinder fÃ¶rdern kÃ¶nnen', 'Je mehr WÃ¶rter Kinder von ihren Eltern hÃ¶ren, umso besser entwickelt sich ihr Gehirn. Vorlesen gilt als besonders nÃ¼tzlich - doch Ã¼ber eine gute Sprachentwicklung entscheidet noch etwas ganz anderes.', 'Kleinen Kindern Geschichten vorzulesen ist gut, doch mit ihnen darÃ¼ber zu sprechen noch viel besser. Mit groÃŸem technischen Aufwand haben der Hirnforscher John Gabrieli und sein Team jetzt diese einfache pÃ¤dagogische Grundregel untermauert.  Am MIT herrscht Gabrieli Ã¼ber das Martinos Imaging Center, eine Art Maschinenpark zur Hirndurchleuchtung. Dort schiebt er Probanden in die TomografenrÃ¶hren, um so ihre Gedanken, ihre Erinnerungen und GefÃ¼hle zu erforschen. Zugleich aber deckt er auch die Spuren auf, die Armut, VernachlÃ¤ssigung und soziale Ungerechtigkeit im Geflecht der grauen Zellen hinterlassen. Er fÃ¼hrt, so kÃ¶nnte man sagen, Klassenkampf im Hirn.  Ich kann mich noch an die Beklemmung erinnern, die mich befiel, als ich vor drei Jahren erstmals von Ergebnissen aus Gabrielis Labor erfuhr: Damals hatte er untersucht, ob sich das Einkommen der Eltern in der Anatomie des GroÃŸhirns von Kindern niederschlÃ¤gt. Er wies nach, dass die kortikale Rinde im SchlÃ¤fenlappen der Probanden aus wohlhabenden Familien deutlich dicker war. Das ist bedeutsam, denn es handelt sich dabei um Hirnareale, die maÃŸgeblich am Wissenserwerb beteiligt sind.', 'b9e4103d-6d29-43d4-8a18-df83188c03b8', '2018-03-08 21:19:00'),
('f68e5dfa-b577-4b40-804d-94b1f100f5e5', 'Traden mit Stars aus der Branche', 'Unsere StarPartner - groÃŸe Namen, die fÃ¼r besondere QualitÃ¤t und Kompetenz im Wertpapierbereich stehen.', 'FÃ¼r Orders auÃŸerhalb des Aktionszeitraums, in anderen Produkten, in anderen Ordervolumina, -arten, oder -wegen, oder Ã¼ber einen anderen BÃ¶rsenplatz, fallen GebÃ¼hren gemÃ¤ÃŸ unserem Preis- und Leistungsverzeichnis an. Der Emittent und die Consorsbank behalten sich vor, die Aktion vorzeitig zu beenden. Sollte dies der Fall sein, werden Sie auf dieser Seite rechtzeitig informiert.', 'b9e4103d-6d29-43d4-8a18-df83188c03b8', '2018-03-08 20:51:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `article_author`
--

CREATE TABLE `article_author` (
  `id` varchar(200) NOT NULL,
  `articleId` varchar(200) NOT NULL,
  `authorId` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `article_author`
--

INSERT INTO `article_author` (`id`, `articleId`, `authorId`) VALUES
('38339d7f-30d1-40c6-ae1c-e8328f6fbe1d', 'f68e5dfa-b577-4b40-804d-94b1f100f5e5', 'bdf8a53e-9fdc-4980-9298-07446ea1107a'),
('4ab04812-e8d7-44a7-ad22-945c83696c15', '4ab04812-e8d7-44a7-ad22-945c83696c16', 'bdf8a53e-9fdc-4980-9298-07446ea1107c'),
('7e4b22ca-3d4c-4d57-8755-eabb05c555b4', 'b3d951c4-04d9-4761-9b8a-d1ccc76ef424', 'bdf8a53e-9fdc-4980-9298-07446ea1107d'),
('87277130-57bc-4052-97f9-a2550c1917c1', 'b3d951c4-04d9-4761-9b8a-d1ccc76ef424', 'bdf8a53e-9fdc-4980-9298-07446ea1107a');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `article_picture`
--

CREATE TABLE `article_picture` (
  `id` varchar(200) NOT NULL,
  `articleId` varchar(200) NOT NULL,
  `pictureId` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `article_picture`
--

INSERT INTO `article_picture` (`id`, `articleId`, `pictureId`) VALUES
('8bb66080-fdaf-4999-ae4a-3fc681199a1e', '4ab04812-e8d7-44a7-ad22-945c83696c16', '6024bcfd-f5c2-4ea2-8cbb-a56d8f1c7321');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `author`
--

CREATE TABLE `author` (
  `authorId` varchar(200) NOT NULL,
  `userId` varchar(200) DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `author`
--

INSERT INTO `author` (`authorId`, `userId`, `firstname`, `name`) VALUES
('bdf8a53e-9fdc-4980-9298-07446ea1107a', '', 'Roger', 'Nelke'),
('bdf8a53e-9fdc-4980-9298-07446ea1107c', '', 'Peter', 'Petermann'),
('bdf8a53e-9fdc-4980-9298-07446ea1107d', '', 'Dave', 'McDonald');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `picture`
--

CREATE TABLE `picture` (
  `pictureId` varchar(200) NOT NULL,
  `title` varchar(100) NOT NULL,
  `pictureUrl` varchar(400) NOT NULL,
  `userId` varchar(200) NOT NULL,
  `authorId` varchar(100) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `picture`
--

INSERT INTO `picture` (`pictureId`, `title`, `pictureUrl`, `userId`, `authorId`, `created`) VALUES
('6024bcfd-f5c2-4ea2-8cbb-a56d8f1c7321', 'schoenesBild', 'image.png', 'b5629213-f783-4f32-a074-7e01cff58794', 'bdf8a53e-9fdc-4980-9298-07446ea1107c', '2017-11-13 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `userId` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatarUrl` varchar(400) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`userId`, `firstname`, `name`, `username`, `mail`, `password`, `avatarUrl`, `verified`) VALUES
('b5629213-f783-4f32-a074-7e01cff58794', 'Melanie', 'Melanie', 'Melaniesmutti', 'melanie@melanie.de', 'melanie123', NULL, 0),
('b9e4103d-6d29-43d4-8a18-df83188c03b8', 'Peter', 'Petra', 'peter123', 'peter@peter.de', 'peter', NULL, 0),
('b9e4103d-6d29-43d4-8a18-df83188c03b9', 'Ulf', 'Ulfowitsch', 'Ulf1234', 'ulf@ulf.de', 'ulf', NULL, 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`articleId`);

--
-- Indizes für die Tabelle `article_author`
--
ALTER TABLE `article_author`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `article_picture`
--
ALTER TABLE `article_picture`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`authorId`);

--
-- Indizes für die Tabelle `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`pictureId`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `username` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
