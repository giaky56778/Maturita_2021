-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Set 02, 2023 alle 00:30
-- Versione del server: 8.0.26
-- Versione PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_alphablock`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `account`
--

CREATE TABLE `account` (
  `email` char(100) NOT NULL,
  `psw` varchar(32) NOT NULL,
  `nome` char(50) NOT NULL,
  `cognome` char(50) NOT NULL,
  `n_ut_reg` smallint NOT NULL DEFAULT '1',
  `dataisc` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `account`
--

INSERT INTO `account` (`email`, `psw`, `nome`, `cognome`, `n_ut_reg`, `dataisc`) VALUES
('luccagiacomo@outlook.it', '81dc9bdb52d04dc20036dbd8313ed055', 'Giacomo', 'Lucca', 5, '2021-04-27 07:43:57'),
('ivan.foschini.muffin@gmail.com', '08dbde9da7ba67a08f3929dd835642b7', 'Ivan', 'Foschini', 1, '2021-05-27 17:39:20'),
('giaky_buco_love_ilFratellò@gmail.com', 'fefabc3f2dff6c37765315cd64ba2c25', 'Lucia', 'Derosa', 1, '2021-05-25 16:23:12'),
('i.foschini@studenti.gobettivolta.edu.it', '52657bcd686becf6d182e70142580a2a', 'Ivan', 'Foschini', 2, '2021-05-30 19:27:05'),
('cerri67@gmail.com', 'db6a0b5dd735dcac21eb70d593b67e84', 'marta', 'cerri', 2, '2021-06-02 20:59:33'),
('gabrielegagga@gmail.com', '37c1f2bbbcbda5287811317e59382895', 'Gabriele', 'Nannucci', 1, '2021-06-12 09:41:10'),
('gabry56778@gmail.com', '44de92ac8cea320aad810b158462a05c', 'Andrea', 'Calligari', 1, '2021-06-16 00:38:45'),
('mauriziomasetta@gmail.com', '6f06dc0e69739c5c093e2e2d87d99689', 'Maurizio', 'Masetta', 1, '2021-06-18 07:31:13'),
('ciao', '6e6bc4e49dd477ebc98ef4046c067b5f', 'ci', 'ao', 5, '2021-11-11 15:58:56'),
('pipinig445@giftcv.com', 'be825b4f5d0a6d009b278f8512712f79', 'Pippo', 'Baudo', 5, '2022-06-16 13:22:31'),
('a', '81dc9bdb52d04dc20036dbd8313ed055', 'a', 'a', 1, '2023-08-31 19:52:23');

-- --------------------------------------------------------

--
-- Struttura della tabella `attore`
--

CREATE TABLE `attore` (
  `codat` int NOT NULL,
  `nomea` char(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `attore`
--

INSERT INTO `attore` (`codat`, `nomea`) VALUES
(1, 'Matthew McConaughey'),
(2, 'Anne Hathaway'),
(3, 'Jessica Chastain'),
(4, 'Michael Caine'),
(5, 'Russell Crowe'),
(6, 'Joaquin Phoenix'),
(7, 'Connie Nielsen'),
(8, 'Oliver Reed'),
(9, 'George MacKay'),
(10, 'Dean-Charles Chapman'),
(11, 'Mark Strong'),
(12, 'Andrew Scott'),
(13, 'Bradley Cooper'),
(14, 'Lady Gaga'),
(15, 'Andrew Dice Clay'),
(16, 'Dave Chappelle'),
(17, 'Rami Malek'),
(18, 'Lucy Boynton'),
(19, 'Gwilym Lee'),
(20, 'Ben Hardy'),
(21, 'Dakota Johnson'),
(22, 'Jamie Dornan'),
(23, 'Jennifer Ehle'),
(24, 'Eloise Mumford'),
(25, 'Kim Basinger'),
(26, 'Bella Heathcote'),
(27, 'Eric Johnson'),
(28, 'Fay Masterson'),
(29, 'Eva Green'),
(30, 'Asa Butterfield'),
(31, 'Ella Purnell'),
(32, 'Samuel L. Jackson'),
(33, 'Jim Carrey'),
(34, 'Taylor Momsen'),
(35, 'Bill Irwin'),
(36, 'Christine Baranski'),
(37, 'Johnny Depp'),
(38, 'Freddie Highmore'),
(39, 'David Kelly'),
(40, 'Noah Taylor'),
(41, 'Elijah Wood'),
(42, 'Ian McKellen'),
(43, 'Viggo Mortensen'),
(44, 'Liv Tyler'),
(45, 'Tom Hanks'),
(46, 'Josh Hutcherson'),
(47, 'Nona Gaye'),
(48, 'Chantel Valdivieso'),
(49, 'Aldo Baglio'),
(50, 'Giovanni Storti'),
(51, 'Giacomo Poretti'),
(52, 'Marina Massironi'),
(53, 'Angela Finocchiaro'),
(54, 'Tobin Bell'),
(55, 'Costas Mandylor'),
(56, 'Scott Patterson'),
(57, 'Betsy Russell');

-- --------------------------------------------------------

--
-- Struttura della tabella `creato`
--

CREATE TABLE `creato` (
  `codreg` int NOT NULL,
  `codfilm` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `creato`
--

INSERT INTO `creato` (`codreg`, `codfilm`) VALUES
(1, 1),
(2, 3),
(3, 2),
(4, 4),
(5, 5),
(6, 5),
(7, 6),
(8, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(12, 13),
(12, 14),
(13, 15),
(15, 16),
(16, 17),
(17, 17),
(18, 17),
(19, 18),
(20, 19),
(21, 19);

-- --------------------------------------------------------

--
-- Struttura della tabella `doppiato`
--

CREATE TABLE `doppiato` (
  `codfilm` int NOT NULL,
  `coddop` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `doppiato`
--

INSERT INTO `doppiato` (`codfilm`, `coddop`) VALUES
(0, 0),
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(3, 1),
(3, 9),
(3, 10),
(3, 12),
(4, 13),
(4, 14),
(4, 15),
(4, 16),
(5, 17),
(5, 18),
(5, 19),
(5, 20),
(6, 21),
(6, 22),
(6, 23),
(6, 24),
(7, 25),
(7, 26),
(7, 27),
(7, 28),
(8, 25),
(8, 30),
(8, 31),
(8, 32),
(9, 33),
(9, 34),
(9, 35),
(9, 36),
(10, 37),
(10, 38),
(10, 39),
(10, 40),
(11, 29),
(11, 41),
(11, 42),
(11, 43),
(12, 44),
(12, 45),
(12, 46),
(12, 47),
(13, 44),
(13, 45),
(13, 46),
(13, 47),
(14, 44),
(14, 45),
(14, 46),
(14, 47),
(15, 48),
(15, 49),
(15, 50),
(15, 51),
(18, 49),
(18, 52),
(18, 53),
(18, 55),
(19, 56),
(19, 57),
(19, 58),
(19, 59);

-- --------------------------------------------------------

--
-- Struttura della tabella `doppiatore`
--

CREATE TABLE `doppiatore` (
  `coddop` int NOT NULL,
  `nomed` char(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `doppiatore`
--

INSERT INTO `doppiatore` (`coddop`, `nomed`) VALUES
(1, 'Francesco Prando'),
(2, 'Domitilla D\'Amico'),
(3, 'Chiara Colizzi'),
(4, 'Dario Penne'),
(5, 'Luca Ward'),
(6, 'Francesco Bulckaen'),
(7, 'Chiara Salerno'),
(8, 'Glauco Onorato'),
(9, 'Manuel Meli'),
(10, 'Federico Campaiola'),
(12, 'Simone D\'Andrea'),
(13, 'Christian Iansante'),
(14, 'Benedetta Degli Innocenti'),
(15, 'Antonio Palumbo'),
(16, 'Andrea Lavagnino'),
(17, 'Stefano Sperduti'),
(18, 'Lucrezia Marricchi'),
(19, 'Edoardo Stoppacciaro'),
(20, 'Federico Viola'),
(21, 'Rossa Caputo'),
(22, 'Andrea Mete'),
(23, 'Emanuela D\'Amico'),
(24, 'Valentina Favazza'),
(25, 'Veronica Puccio'),
(26, 'Jacopo Venturiero'),
(27, 'Emanuela Rossi'),
(28, 'Roisin Nicosia'),
(29, 'Jacopo Bonanni'),
(30, 'Jacopo Venturiero'),
(31, 'Gianfranco Miranda'),
(32, 'Giulia Santilli'),
(33, 'Domitilla D\'Amico'),
(34, 'Manuel Meli'),
(35, 'Lucrezia Marricchi'),
(36, 'Luca Ward'),
(37, 'Stefano Benassi'),
(38, 'Gabriele Patriarca'),
(39, 'Lilian Caputo'),
(40, 'Massimo Rossi'),
(41, 'Fabio Boccanera'),
(42, 'Valerio Ruggeri'),
(43, 'Oreste Baldini'),
(44, 'Davide Perino'),
(45, 'Gianni Musy'),
(46, 'Stella Musy'),
(47, 'Pino Insegno'),
(48, 'Peter Scolari'),
(49, 'Francesco Pannofino'),
(50, 'Flavia Rosa'),
(51, 'Alex Polidori'),
(52, 'Alessandro Rossi'),
(53, 'Laura Boccanera'),
(55, 'Massimo De Ambrosis'),
(56, 'Massimiliano Manfredi'),
(57, 'Marco Messeri'),
(58, 'Sabrina Ferilli'),
(59, 'Cesare Barbetti');

-- --------------------------------------------------------

--
-- Struttura della tabella `film`
--

CREATE TABLE `film` (
  `codfilm` int NOT NULL,
  `titolo` char(100) NOT NULL,
  `copertina` char(100) NOT NULL,
  `banner` char(75) NOT NULL,
  `link` char(15) NOT NULL,
  `annoril` year DEFAULT NULL,
  `durata` time DEFAULT NULL,
  `ad_bimbo` tinyint(1) DEFAULT '0',
  `descrizione` varchar(520) NOT NULL,
  `codg` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `film`
--

INSERT INTO `film` (`codfilm`, `titolo`, `copertina`, `banner`, `link`, `annoril`, `durata`, `ad_bimbo`, `descrizione`, `codg`) VALUES
(1, 'Interstellar', 'img/copertina/Rf8530ba4ddb13ec22254cf30c1f1cd6d.jfif', 'img/banner/interstellar-movie-hd-wallpaper-and-poster.jpeg', 'EIVMVIr3q3Y', 2014, '02:49:00', 0, 'Il futuro della razza umana &egrave; in pericolo e la vita sulla Terra si avvia verso il tramonto. Alcuni esploratori si imbarcano nella missione pi&ugrave; importante della storia dell\'umanit&agrave;: dovranno scoprire se, al di l&agrave; delle stelle, esiste un\'alternativa per la vita umana... ', 5),
(2, 'Il gladiatore', 'img/copertina/ofDw0himYNpehWA69OkPWOzXOYK.jpg', 'img/banner/814IOMlXZYL._SL1500_.jpg', 'axcaKnZh9ZY', 2000, '02:35:00', 0, 'Designato futuro imperatore da un morente Marco Aurelio, il generale Massimo viene ridotto in schiavit&ugrave; e la sua famiglia uccisa ad opera di Commodo, figlio dell\'anziano sovrano. Inizier&agrave; a combattere come gladiatore nelle arene delle province romane fin quando la sua fama non lo ricondurr&agrave; nella capitale, dove sfider&agrave; l\'imperatore in persona per ottenere vendetta. ', 1),
(3, '1917', 'img/copertina/R24c9f40248e9f4425910ed401a73168e.jfif', 'img/banner/1917.jpg', 'StnIcUm-wLs', 2020, '01:59:00', 0, 'Al culmine della prima guerra mondiale, due giovani soldati britannici, Schofield e Blake ricevono una missione apparentemente impossibile. In una corsa contro il tempo, devono attraversare il territorio nemico e consegnare un messaggio che arrester&agrave; un attacco mortale contro centinaia di soldati, tra cui il fratello di Blake. ', 1),
(4, 'A Star Is Born', 'img/copertina/a-star-is-born-2018-poster.jpg', 'img/banner/unnamed.jpg', 'jvMaHOOY5VA', 2018, '02:14:00', 0, 'Jackson Maine, musicista in carriera, scopre e si innamora di Ally. La ragazza ha quasi rinunciato al proprio sogno di diventare una cantante fino a quando l\'uomo non la porta sotto la luce dei riflettori.', 1),
(5, 'Bohemian Rhapsody', 'img/copertina/81Lt5CLlUOL._SL1500_.jpg', 'img/banner/ecco-il-mashup-spot-hd-di-bohemian-rhapsody.jpg', 'wTjo3So7IOs', 2018, '02:13:00', 0, 'Freddie Mercury, Brian May, Roger Taylor e John Deacon formano i Queen nel 1970, e con lo stile unico che li contraddistingue scalano le vette delle classifiche mondiali e diventano una leggenda della musica rock.', 1),
(6, 'Cinquanta sfumature di grigio', 'img/copertina/unnamed.jpg', 'img/banner/Rff587da7668836b398bbffef108684d9.jfif', 'N_goN2NkDxA', 2015, '02:09:00', 1, 'Anastasia Steele &egrave; una studentessa di letteratura inglese prossima alla laurea. Per sostituire la migliore amica influenzata, va ad intervistare Christian Grey, giovane e ricco amministratore delegato della Grey Enterprises Holdings. Tra i due scatta subito un\'intesa fortissima ma hanno modi opposti di vivere le relazioni sentimentali.', 1),
(7, 'Cinquanta sfumature di nero', 'img/copertina/share.jpg', 'img/banner/maxresdefault.jpg', 'FeG0rk1Et-Q', 2017, '01:58:00', 1, 'Christian Gray cerca di persuadere Anastasia a tornare nella propria vita, ma alcune figure misteriose provenienti dal suo passato rischiano di annientare le loro speranze di un futuro insieme.', 1),
(8, 'Cinquanta sfumature di rosso', 'img/copertina/unnamed (1).jpg', 'img/banner/images.jfif', 'O8dyP-VyHUE', 2018, '02:00:00', 1, 'Convinti di essersi lasciati alle spalle i fantasmi del passato, Christian e Ana, finalmente sposi, sono pronti a godersi una vita intensa di amore e lussuria.', 1),
(9, 'Miss Peregrine - La casa dei ragazzi speciali', 'img/copertina/ofDw0himYNpdwdwwdehWA69OkPWOzXOYK.jpg', 'img/banner/recensione-miss-peregrine.jpg', 'Tvd6wo9BrTA', 2016, '02:07:00', 0, 'Quando l\'amato nonno lascia a Jake indizi su un mistero che attraversa mondi e tempi alternativi, il ragazzo si ritrover&agrave; in un luogo magico noto come La casa per bambini speciali di Miss Peregrine. Ma il mistero si infittisce quando Jake conoscer&agrave; gli abitanti della casa, i loro poteri speciali... e i loro potenti nemici.', 2),
(11, 'La fabbrica di cioccolato', 'img/copertina/A-FANTASTICA-FABRICA-DE-CHOCOLATES.jpg', 'img/banner/snapshot-1590665239.jpeg', 'eYqrTPu-FnA', 2005, '01:55:00', 0, 'Rimasto a lungo isolato dalla sua famiglia, Wonka lancia un concorso mondiale per selezionare l\'erede del suo impero di cioccolato. Cinque ragazzi fortunati, tra cui Charlie, trovano i Golden Ticket nelle barrette di cioccolato di Wonka: il premio &egrave; una visita guidata nella sua leggendaria fabbrica, in cui nessuno entra da ben quindici anni. Charlie, affascinato e sbalordito, viene cos&igrave; catapultato nel fantastico mondo di Wonka, dove molte sorprese sono pronte a stupirlo...', 2),
(10, 'Il Grinch', 'img/copertina/grinch_fb_cover.jpg', 'img/banner/R5236f65d34df656b880defdd677b983e.jfif', 'My2Wsabu3YY', 2000, '01:44:00', 0, 'Il Grinch (Jim Carrey) &egrave; un personaggio gretto e meschino che odia il Natale ed &egrave; pronto a rovinare la festa a tutti coloro che ci credono, in particolare agli abitanti di Kinons&ograve;, un piccolo villaggio vicino al monte Crumpit. Questo mostriciattolo verde ricoperto di peli, scorbutico e dispettoso, ha per&ograve; un\'anima da salvare, e se c\'&egrave; un giorno nel quale il Bene pu&ograve; pervadere i cuori di tutti, anche quelli che sembrano malvagi, questo giorno &egrave; sicuramente Natale...', 2),
(12, 'Il Signore degli Anelli - La Compagnia dell\'Anello', 'img/copertina/01.jpg', 'img/banner/thumb-1920-644699.png', 'ZfuGsaFAXos', 2001, '03:48:00', 0, 'Il viaggio verso il Monte Fato continua, anche se Frodo e Sam si sono ormai divisi da Aragorn, Gimli, Legolas e tutto il resto del gruppo. Per assaltare la torre di Orthanc, e per sfuggire all\'asfissiante inseguimento dei cavalieri neri i nostri eroi decidono di stringere un\'alleanza con gli alberi viventi e i cavalieri di Rohan e quelli di Gondor.', 2),
(13, 'Il Signore degli Anelli - Le due torri', 'img/copertina/100140920-p30793_d_v8_ac.jpg', 'img/banner/tb9ZtbjJH14hgOr0f2IVUUuDmsr.jpg', 'O8im5qfCepI', 2002, '02:59:00', 0, 'Il viaggio verso il Monte Fato continua, anche se Frodo e Sam si sono ormai divisi da Aragorn, Gimli, Legolas e tutto il resto del gruppo. Per assaltare la torre di Orthanc, e per sfuggire all\'asfissiante inseguimento dei cavalieri neri i nostri eroi decidono di stringere un\'alleanza con gli alberi viventi e i cavalieri di Rohan e quelli di Gondor.', 2),
(14, 'Il Signore degli Anelli - Il ritorno del re', 'img/copertina/1_org_zoom.jpg', 'img/banner/R9c66182d07f217486b4b56328cdf738f.jfif', 'dezthH3eGw0', 2003, '03:21:00', 0, 'Prosegue il pericoloso viaggio di Frodo e Sam verso il Monte Fato, dove i due piccoli hobbit devono concludere l\'arduo compito di distruggere l\'Anello. Fa loro da guida il deforme Gollum, di cui non sono certi di potersi davvero fidare. Intanto il resto del gruppo sta combattendo contro il potente esercito di Sauron nei Campi del Pellenor. Inoltre Minas Tirith, capitale del regno di Gondor, &egrave; sotto la morsa dell\'assedio di Sauron in persona...', 2),
(15, 'Polar Express', 'img/copertina/download.jfif\r\n', 'img/banner/R0a87ec95a5d566b26cec725db73c253a.jfif', 'Sqs8W4D88aU', 2004, '01:40:00', 0, 'Un bambino che pensa che l\'arrivo di Babbo Natale sia tutta una bugia esce di casa e vede un treno a vapore: &egrave; il Polar Express. Inizia un\'indimenticabile avventura.', 2),
(16, 'Tre uomini e una gamba', 'img/copertina/fotonerd-aldo-giovanni-giacomo-disney-plus-2.jpg', 'img/banner/tre-uomini-e-una-gamba.png', 'x8L6dcZCxnA', 1997, '01:40:00', 0, 'Durante un rocambolesco viaggio verso la Puglia, Aldo e Giovanni, cognati, accompagnano Giacomo, che deve sposarsi con la figlia del loro datore di lavoro... ma se durante il viaggio l\'incontro con la bella Chiara facesse nascere dei dubbi in Giacomo? E se un nuovo amore sbocciasse? Film che ha reso celebre il trio comico al grande pubblico.', 3),
(17, 'La banda dei Babbi Natale', 'img/copertina/71VdqyoB4BL._SL1024_.jpg', 'img/banner/la-banda-dei-babbi-natale-film.png', 'ZyI9EfRsn54', 2010, '01:40:00', 0, '&Egrave; la notte della vigilia di Natale e tre amici, uniti dalla passione delle bocce, finiti nei guai si ritrovano a trascorrerla in questura: quali storie racconteranno per scagionarsi dalla terribile accusa di essere una banda di ladri?', 3),
(18, 'Saw IV', 'img/copertina/saw4.png', 'img/banner/saw-iv-2007.jpg', 'PYQ75b89PPw', 2007, '01:32:00', 1, 'La morte dell\'Enigmista e della sua discepola Amanda non sono bastate a porre fine al loro diabolico piano criminale. A cadere nella rete sono stavolta i due detective che hanno seguito l\'indagine', 4),
(19, 'Cars - Motori ruggenti', 'img/copertina/cars.png', 'img/banner/cars-motori-ruggenti-recensione-cult-quattro.jpg', 'UGvKSQr-IpA', 2006, '01:57:00', 0, 'Saetta McQueen &egrave; un\'auto da corsa ancora inesperta, ma molto promettente. Mentre sta attraversando l\'America per partecipare a un\'importante corsa che si terr&agrave in California, ha un guasto ed &egrave; costretto a fermarsi in una piccola cittadina sulla Route 66, Radiator Springs. Imparer&agrave; che esistono cose ben pi&ugrave; importanti di premi e vittorie.', 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `genere`
--

CREATE TABLE `genere` (
  `codg` int NOT NULL,
  `nomeg` char(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `genere`
--

INSERT INTO `genere` (`codg`, `nomeg`) VALUES
(1, 'Drammatico'),
(2, 'Fantasy'),
(3, 'Commedia'),
(4, 'Horror'),
(5, 'Fantascienza'),
(6, 'Cartone animanto');

-- --------------------------------------------------------

--
-- Struttura della tabella `guarda`
--

CREATE TABLE `guarda` (
  `id` int NOT NULL,
  `codfilm` int NOT NULL,
  `data_ora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `guarda`
--

INSERT INTO `guarda` (`id`, `codfilm`, `data_ora`) VALUES
(2, 5, '2021-05-13 07:28:12'),
(3, 9, '2021-05-13 10:08:24'),
(6, 1, '2021-05-21 15:11:56'),
(6, 1, '2021-06-04 08:55:34'),
(6, 1, '2023-05-15 11:01:29'),
(6, 2, '2021-05-30 19:10:55'),
(6, 7, '2021-06-12 09:45:54'),
(6, 8, '2021-05-21 15:08:16'),
(6, 8, '2021-05-25 07:42:49'),
(6, 8, '2022-01-16 00:30:18'),
(6, 10, '2021-05-13 07:15:41'),
(6, 10, '2021-05-13 07:21:12'),
(6, 10, '2021-05-20 11:33:47'),
(6, 10, '2021-05-21 18:04:02'),
(6, 10, '2021-05-31 07:47:25'),
(6, 10, '2022-01-16 00:30:30'),
(6, 11, '2021-05-13 07:00:01'),
(6, 11, '2021-05-13 07:15:58'),
(6, 11, '2021-05-18 07:33:12'),
(6, 11, '2021-05-19 14:08:16'),
(6, 11, '2021-05-19 17:20:22'),
(6, 11, '2021-05-20 10:15:09'),
(6, 14, '2021-05-18 10:43:20'),
(6, 14, '2021-05-21 15:11:35'),
(6, 14, '2021-05-25 07:36:50'),
(6, 15, '2021-05-21 15:11:45'),
(6, 15, '2021-06-12 09:41:49'),
(6, 16, '2021-05-27 11:45:58'),
(6, 17, '2021-05-20 11:33:35'),
(6, 17, '2021-05-21 15:12:29'),
(6, 17, '2021-06-18 07:34:50'),
(6, 18, '2021-05-13 07:15:49'),
(6, 18, '2021-05-13 10:50:48'),
(6, 18, '2021-05-21 15:08:22'),
(6, 19, '2021-05-13 10:50:12'),
(6, 19, '2021-05-21 15:07:57'),
(6, 19, '2021-05-21 15:08:06'),
(6, 19, '2021-05-25 06:17:58'),
(6, 19, '2021-05-27 17:39:50'),
(6, 19, '2021-06-04 08:58:16'),
(6, 19, '2021-06-12 09:42:07'),
(44, 13, '2021-05-27 17:39:59'),
(44, 13, '2021-05-27 17:40:06'),
(45, 14, '2021-05-30 19:29:20'),
(45, 17, '2021-05-30 19:33:04'),
(48, 1, '2021-06-02 21:03:21'),
(50, 7, '2021-06-12 09:44:48'),
(50, 19, '2021-06-12 09:42:02'),
(51, 2, '2021-06-16 00:39:27'),
(51, 19, '2021-06-16 00:39:52'),
(52, 13, '2021-06-18 07:32:43'),
(55, 1, '2021-11-12 19:36:17'),
(55, 12, '2021-11-15 16:54:00'),
(62, 5, '2022-06-17 18:48:41'),
(62, 15, '2022-06-16 13:39:14');

-- --------------------------------------------------------

--
-- Struttura della tabella `partecipa`
--

CREATE TABLE `partecipa` (
  `codat` int NOT NULL,
  `codfilm` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `partecipa`
--

INSERT INTO `partecipa` (`codat`, `codfilm`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 4),
(14, 4),
(15, 4),
(16, 4),
(17, 5),
(18, 5),
(19, 5),
(20, 5),
(21, 6),
(21, 7),
(21, 8),
(22, 6),
(22, 7),
(22, 8),
(23, 6),
(24, 6),
(25, 7),
(26, 7),
(27, 8),
(28, 8),
(29, 9),
(30, 9),
(31, 9),
(32, 9),
(33, 10),
(34, 10),
(35, 10),
(36, 10),
(37, 11),
(38, 11),
(39, 11),
(40, 11),
(41, 12),
(41, 13),
(41, 14),
(42, 12),
(42, 13),
(42, 14),
(43, 12),
(43, 13),
(43, 14),
(44, 12),
(44, 13),
(44, 14),
(45, 15),
(46, 15),
(47, 15),
(48, 15),
(49, 16),
(49, 17),
(50, 16),
(50, 17),
(51, 16),
(51, 17),
(52, 16),
(53, 17),
(54, 18),
(55, 18),
(56, 18),
(57, 18);

-- --------------------------------------------------------

--
-- Struttura della tabella `regista`
--

CREATE TABLE `regista` (
  `codreg` int NOT NULL,
  `nomer` char(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `regista`
--

INSERT INTO `regista` (`codreg`, `nomer`) VALUES
(1, 'Christopher Nolan'),
(2, 'Sam Mendes'),
(3, 'Ridley Scott'),
(4, 'Bradley Cooper'),
(5, 'Bryan Singer'),
(6, 'Dexter Fletcher'),
(7, 'Sam Taylor-Johnson'),
(8, 'James Foley'),
(9, 'Tim Burton'),
(10, 'Ron Howard'),
(11, 'Roald Dahl'),
(12, 'Peter Jackson'),
(13, 'Robert Zemeckis'),
(14, 'Massimo Venier'),
(15, 'Paolo Genovese'),
(16, 'Giacomo Poretti'),
(17, 'Aldo Baglio'),
(18, 'Giovanni Storti'),
(19, 'Darren Lynn Bousman'),
(20, 'John Lasseter'),
(21, 'Joe Ranft');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `id` int NOT NULL,
  `email` char(50) NOT NULL,
  `nome` char(20) NOT NULL,
  `bimbo` tinyint(1) DEFAULT '0',
  `img` smallint DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`id`, `email`, `nome`, `bimbo`, `img`) VALUES
(6, 'luccagiacomo@outlook.it', 'Giacomo', 0, 1),
(2, 'luccagiacomo@outlook.it', 'Gabriele', 0, 3),
(3, 'luccagiacomo@outlook.it', 'Raffaella', 0, 2),
(4, 'luccagiacomo@outlook.it', 'Giuseppe', 0, 4),
(44, 'ivan.foschini.muffin@gmail.com', 'Ivan', 0, 1),
(43, 'giaky_buco_love_ilFratellò@gmail.com', 'Lucia', 0, 1),
(45, 'i.foschini@studenti.gobettivolta.edu.it', 'Ivan', 0, 1),
(46, 'i.foschini@studenti.gobettivolta.edu.it', 'Pertuttelepalle', 0, 2),
(48, 'cerri67@gmail.com', 'marta', 0, 1),
(49, 'cerri67@gmail.com', 'leonardo', 0, 2),
(50, 'gabrielegagga@gmail.com', 'Gabriele', 0, 1),
(51, 'gabry56778@gmail.com', 'Andrea', 0, 1),
(52, 'mauriziomasetta@gmail.com', 'Maurizio', 0, 1),
(62, 'pipinig445@giftcv.com', 'hotrepalle04', 0, 1),
(55, 'ciao', 'ci', 0, 1),
(56, 'ciao', '5', 0, 2),
(57, 'ciao', '5', 0, 3),
(58, 'ciao', '6', 0, 4),
(59, 'ciao', '8498', 0, 5),
(63, 'pipinig445@giftcv.com', 'Ho novantatre palle', 0, 2),
(64, 'pipinig445@giftcv.com', 'Mi prude', 0, 3),
(65, 'pipinig445@giftcv.com', 'Mi prude', 0, 3),
(66, 'pipinig445@giftcv.com', 'Pippococaina', 0, 4),
(67, 'luccagiacomo@outlook.it', 'l', 1, 5),
(68, 'a', 'a', 0, 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`email`);

--
-- Indici per le tabelle `attore`
--
ALTER TABLE `attore`
  ADD PRIMARY KEY (`codat`);

--
-- Indici per le tabelle `creato`
--
ALTER TABLE `creato`
  ADD PRIMARY KEY (`codreg`,`codfilm`),
  ADD KEY `codfilm` (`codfilm`);

--
-- Indici per le tabelle `doppiato`
--
ALTER TABLE `doppiato`
  ADD PRIMARY KEY (`codfilm`,`coddop`),
  ADD KEY `coddop` (`coddop`);

--
-- Indici per le tabelle `doppiatore`
--
ALTER TABLE `doppiatore`
  ADD PRIMARY KEY (`coddop`);

--
-- Indici per le tabelle `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`codfilm`),
  ADD KEY `cerca_film` (`codfilm`,`titolo`);

--
-- Indici per le tabelle `genere`
--
ALTER TABLE `genere`
  ADD PRIMARY KEY (`codg`);

--
-- Indici per le tabelle `guarda`
--
ALTER TABLE `guarda`
  ADD PRIMARY KEY (`id`,`codfilm`,`data_ora`),
  ADD KEY `codfilm` (`codfilm`);

--
-- Indici per le tabelle `partecipa`
--
ALTER TABLE `partecipa`
  ADD PRIMARY KEY (`codat`,`codfilm`),
  ADD KEY `codfilm` (`codfilm`);

--
-- Indici per le tabelle `regista`
--
ALTER TABLE `regista`
  ADD PRIMARY KEY (`codreg`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id`,`email`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `attore`
--
ALTER TABLE `attore`
  MODIFY `codat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT per la tabella `doppiatore`
--
ALTER TABLE `doppiatore`
  MODIFY `coddop` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT per la tabella `film`
--
ALTER TABLE `film`
  MODIFY `codfilm` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `genere`
--
ALTER TABLE `genere`
  MODIFY `codg` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `regista`
--
ALTER TABLE `regista`
  MODIFY `codreg` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
