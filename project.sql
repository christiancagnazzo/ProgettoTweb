-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Gen 23, 2021 alle 09:40
-- Versione del server: 10.4.14-MariaDB
-- Versione PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Attore`
--

CREATE TABLE `Attore` (
  `Codice` varchar(5) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `Cognome` varchar(20) NOT NULL,
  `DataNascita` date NOT NULL,
  `LuogoNascita` varchar(10) NOT NULL,
  `Eta` int(11) NOT NULL,
  `Foto` varchar(100) DEFAULT NULL,
  `Descrizione` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Attore`
--

INSERT INTO `Attore` (`Codice`, `Nome`, `Cognome`, `DataNascita`, `LuogoNascita`, `Eta`, `Foto`, `Descrizione`) VALUES
('CAMM', 'Camilla', 'Mendes', '1979-01-17', 'Roma', 41, '../img/actors/camilla.jpg', 'Camila Carraro Mendes is an American actress and singer, known for portraying Veronica Lodge on The CW teen drama television series Riverdale. She made her feature film debut portraying the character, Morgan in The New Romantic, which premiered at the SXSW Festival in March 2018. In the same month, Mendes joined the cast of the romantic comedy The Perfect Date alongside Laura Marano and Matt Walsh.'),
('CD51', 'Christian', 'De sica', '1951-01-05', 'Roma', 69, '../img/actors/christian.jpg', 'Christian De Sica is an Italian actor, director, screenwriter, voice actor, singer, presenter. Very well known as the face of Italian cinema as every year one of his films comes out to the cinema during the Christmas period.'),
('CLSP', 'Cole', 'Sprouse', '1974-07-22', 'Roma', 45, '../img/actors/cole.jpg', 'Cole Sprouse is an Italian-born American actor, collectively known as the Sprouse Bros with his twin brother Dylan Sprouse. By the end of the 2000s, MSN reported the twin brothers became the richest teenage twins in the world.'),
('CS74', 'Claudio', 'Santamaria', '1974-07-22', 'Roma', 45, '../img/actors/claudio.jpg', 'Claudio Santamaria is an italian actor, known for Romanzo criminale (2005) and Diaz - Don\'t clean up this blood (2012). In 2016 he won the David di Donatello for best leading actor for Lo chiamavano Jeeg Robot.\r\n\r\n'),
('DA55', 'Diego', 'Abatantuomo', '1955-05-20', 'Milano', 64, '../img/actors/diego.jpg', 'Diego Abatantuono is an Italian actor, comedian, screenwriter, and TV presenter.'),
('EEZZ', 'Eliza', 'Taylor', '1969-08-24', 'Roma', 50, '../img/actors/eliza.jpg', 'Eliza Jane Taylor (born on 24 October 1989 in Melbourne, Australia) is an Australian actress who is perhaps best known for her regular role as Janae Timmins on the Australian television series, Neighbours. Eliza has just finished feature film Patrick (2013), alongside Rachael Griffiths and nabbed the lead in CW pilot, The 100. The 100 is Taylor\'s first American production.'),
('GG28', 'Giancarlo', 'Esposito', '1987-01-07', 'Italy', 66, '../img/actors/gian.jpg', 'Born in Denmark, Giancarlo Esposito is an Italian American stage, film and television actor and director, best known for playing many supporting characters in television shows, such as Gustavo \"Gus\" Fring in \"Breaking Bad\" and \"Better Call Saul\".'),
('GGCA', 'Gina', 'Carano', '1979-12-01', 'Italy', 33, '../img/actors/gina.jpg', 'Gina Joy Carano (born April 16, 1982) is an American actress, television personality, fitness model and a former mixed martial artist. Carano appeared as Crush, a Gladiator on American Gladiators.'),
('HFHF', 'Hero', 'Fiennes', '1993-04-06', 'Italy', 27, '../img/actors/hero.jpg', 'Hero Fiennes Tiffin (born 6 November 1997) is an English actor and model born in London'),
('ISLL', 'Isla', 'Fisher', '1979-01-17', 'Roma', 41, '../img/actors/isla.jpg', 'Isla Lang Fisher (born February 3, 1976) is an actress and author. She began acting on Australian television, on the short-lived soap opera Paradise Beach before playing Shannon Reed on the soap opera Home and Away. She has since been known for her comedic roles in Wedding Crashers (2005), Hot Rod (2007), Definitely, Maybe (2008), and Confessions of a Shopaholic (2009).'),
('JJBB', 'Jilian', 'Bell', '1969-08-24', 'Roma', 50, '../img/actors/jili.jpg', 'Her first major role was as a lead cast member on TBS\'s The Bill Engvall Show (2007–2009) and she subsequently appeared in the independent films The Burning Plain (2008) and Winter\'s Bone (2010), for which she received nominations for the Academy Award, Golden Globe Award, Satellite Award, Independent Spirit Award, and Screen Actors Guild Award for Best Actress. '),
('JLJL', 'Josephin', 'Langford', '1995-01-06', 'Italy', 27, '../img/actors/jose.jpg', 'Josephine Langford (born 18 August 1997) is an Australian actress best known for her role as Tessa Young in After (2019)'),
('LILI', 'Lili', 'Reinhart', '1969-08-24', 'Roma', 50, '../img/actors/lili.jpg', 'Lili Reinhart is an actress born in Cleveland (Ohio) on September 13, 1996, under the sign of Virgo, with the name of Lili Pauline Reinhart. She grew up in Bay Village (Ohio) with dad Daniel, mom Amy, older sister Chloe (1993) and younger sister Tess (2003). During adolescence, Lili Reinhart suffers from problems of anxiety, insecurity and depression which she manages to overcome thanks to Riverdale. However, in February 2019 she returns to therapy, as she herself reveals in an Instagram post where she states that: “I don\'t feel embarrassed to ask for help. I am 22 years old, I have anxiety and depression and today I am starting therapy again. For me the journey towards love for myself begins\"'),
('LIMM', 'Lindsey', 'Morgan', '1979-01-17', 'Roma', 41, '../img/actors/lindse.jpg', 'Morgan began her career in college before heading to Los Angeles to pursue her dream. After a short time she was noticed in Hollywood, getting the main role in the film Disconnected and a secondary one in the film Detention. On April 17, 2012, TVLine reported that Morgan landed the role of Kristina Davis on the American soap opera General Hospital'),
('MR79', 'Micaela', 'Ramazzotti', '1979-01-17', 'Roma', 41, '../img/actors/mica.jpg', 'Micaela Ramazzotti (born 17 January 1979) is an Italian actress. Her film credits include Non prendere impegni stasera, The First Beautiful Thing and Il cuore grande delle ragazze. Ramazzotti was a regular cast member of the show Crimini bianchi.She won the David di Donatello for Best Actress for her role in The First Beautiful Thing in 2010.'),
('PF69', 'Pierfrancesco', 'Favino', '1969-08-24', 'Roma', 50, '../img/actors/pierfra.jpg', 'Favino was born in Rome, Italy. He has appeared in more than forty European films and television series\' since the early 1990s, including Gabriele Muccino\'s The Last Kiss, Gianni Amelio\'s The Keys to the House, Giuseppe Tornatore\'s The Unknown Woman and Ferzan Özpetek\'s Saturn in Opposition. '),
('PP19', 'Pedro', 'Pascal', '1985-02-02', 'Cile', 44, '../img/actors/pedro.jpg', 'A Chilean-born Amercian stage and screen director and actor, best known for his role in HBO s \"Game of Thrones\" and portraying the title character in the popular Disney series “Star Wars: The Mandalorian”. Pedro studied acting at the Orange County High School of the Arts and New York University s Tisch School of the Arts.'),
('SA89', 'Santiero', 'Cabrera', '1974-07-22', 'Roma', 45, '../img/actors/santiero.jpg', 'Santiero Cabrera was born on the shores of Lake Superior in Thunder Bay in Canada. She grew up with fishing, hunting and camping. After studying television journalism for 2 years in his hometown he decided to move to Europe. Several months later he returned to Canada and settled in Vancouver.');

-- --------------------------------------------------------

--
-- Struttura della tabella `AttoreFilm`
--

CREATE TABLE `AttoreFilm` (
  `Attore` varchar(5) NOT NULL,
  `Film` varchar(30) NOT NULL,
  `Personaggio` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `AttoreFilm`
--

INSERT INTO `AttoreFilm` (`Attore`, `Film`, `Personaggio`) VALUES
('CAMM', 'La regina degli scacchi', 'Elizabeth'),
('CAMM', 'Riverdale', 'Veronica'),
('CD51', 'Gli anni più belli', 'Vitttorio'),
('CD51', 'La mia banda suona il pop', 'Tony'),
('CLSP', 'After', 'Lincoln'),
('CLSP', 'Riverdale', 'Jughead'),
('CS74', 'Gli anni più belli', 'Riccardo'),
('DA55', 'La mia banda suona il pop', 'Franco'),
('DA55', 'The 100', 'Alberto'),
('EEZZ', 'La regina degli scacchi', 'Francisca'),
('EEZZ', 'The 100', 'Clark'),
('GG28', 'Fata Madrina Cercasi', 'Jeremy'),
('GG28', 'Lupin', 'Senigata'),
('GGCA', 'Lupin', 'Biden'),
('HFHF', 'After', 'Ardin'),
('ISLL', 'Fata Madrina Cercasi', 'Wals'),
('JJBB', 'Fata Madrina Cercasi', 'Elenore'),
('JLJL', 'After', 'Tessa'),
('LILI', 'Riverdale', 'Betty'),
('LIMM', 'The 100', 'Octavia'),
('MR79', 'Gli anni più belli', 'Gemma'),
('PF69', 'Gli anni più belli', 'Giulio'),
('PP19', 'Lupin', 'Lupin'),
('SA89', 'La regina degli scacchi', 'Josf'),
('SA89', 'The 100', 'Raven');

-- --------------------------------------------------------

--
-- Struttura della tabella `Film`
--

CREATE TABLE `Film` (
  `Titolo` varchar(30) NOT NULL,
  `Musiche` varchar(50) NOT NULL,
  `DataUscita` date NOT NULL,
  `Descrizione` varchar(2000) DEFAULT NULL,
  `Foto` varchar(100) DEFAULT NULL,
  `MediaVoti` decimal(3,2) DEFAULT NULL,
  `Genere` varchar(10) NOT NULL,
  `Paese` varchar(10) NOT NULL,
  `Distribuzione` varchar(30) NOT NULL,
  `Produzione` varchar(30) NOT NULL,
  `Durata` varchar(30) NOT NULL,
  `Sceneggiatura` varchar(30) NOT NULL,
  `Regista` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Film`
--

INSERT INTO `Film` (`Titolo`, `Musiche`, `DataUscita`, `Descrizione`, `Foto`, `MediaVoti`, `Genere`, `Paese`, `Distribuzione`, `Produzione`, `Durata`, `Sceneggiatura`, `Regista`) VALUES
('After', 'John Lennon', '2021-01-11', 'After their breakup, Hardin and Tessa try to go their own way. While Hardin returns to get lost in bad habits, Tessa, strengthened by her confidence, begins to attend the internship of her dreams at the Vance publishing house where she attracts the attention of her colleague Trevor, the perfect guy to start a relationship with. Tessa, despite this new encounter, can\'t get Hardin out of her mind.', '../img/movies/after.jpg', '4.00', 'Comedy', 'USA', 'Ua Relation', 'Low Corporation', '95', 'Marc Key', 'JJRR'),
('Fata Madrina Cercasi', 'Gianluigi Magro', '2020-12-10', 'Eleanor is a young and inexperienced fairy godmother in training. After hearing that her chosen profession is in danger of extinction, you decide to show the world that people still need fairy godmothers. After finding a lost letter from a troubled 10-year-old girl, Eleanor tracks her down and discovers that the little girl, Mackenzie, is now a 40-year-old single mom (Isla Fisher) who works for a Boston news bulletin. Having lost her husband many years ago, Mackenzie has almost given up on the idea of ​​\"happily ever after\", but Eleonora is adamant to dare Mackenzie a twist of happiness, whether she likes it or not.\r\n', '../img/movies/fata.jpg', '3.60', 'Fantasy', 'Italy', 'Cinemeta', 'Mylo Production', '129', 'Alfonso, Greco', 'SHSH'),
('Gli anni più belli', 'Nicola Piovani', '2020-02-13', 'The story of four friends Giulio (Pierfrancesco Favino), Gemma (Micaela Ramazzotti), Paolo, (Kim Rossi Stuart), Riccardo (Claudio Santamaria), told over forty years, from 1980 to today, from adolescence to adulthood. Their hopes, their disappointments, their successes and failures are the intertwining of a great story of friendship and love through which Italy and the Italians are also told. A large fresco that tells who we are, where we come from and also where they will go and who our children will be. It is the great circle of life that repeats itself with the same dynamics despite the passage of years and even different eras in the background.', '../img/movies/glianni.jpg', '2.00', 'Drama', 'Italia', '01 Distribution', 'Lotus Production', '129', 'Muccino, Costella', 'GM67'),
('La mia banda suona il pop', 'Luca Medici', '2021-01-21', 'The story of the stormy reunion of \"Popcorn\", a mythical (and imaginary) musical group of the 80s, in St. Petersburg, which is tinged with thrillers, turning into the greatest robbery of all time against a Russian oligarch, passionate about Italian music.', '../img/movies/lamiabanda.jpg', '3.25', 'Comedy', 'Italia', 'Medusa Film', 'Casanova Production', '95', 'Brizzi, Martani', 'FB68'),
('La regina degli scacchi', 'Alab Preay', '2021-01-28', 'In a Kentucky orphanage in the 1950s, a girl discovers she has an incredible talent for chess. Meanwhile, he struggles with an addiction problem.', '../img/movies/regina.jpg', '3.00', 'Drama', 'Italy', 'J.M. Losting', 'International', '102', 'Say Jonson', 'FB68'),
('Lupin', 'Court Bay', '2021-01-17', 'A contemporary reinterpretation of the classic French story of Arsenio Lupine, gentleman thief and master of disguises. With Omar Sy.', '../img/movies/lupin.jpg', '1.00', 'Comic', 'Ireland', 'Hk Industry', 'Eu distribution', '110', 'Aley Smat', 'SHSH'),
('Riverdale', 'Nicol King', '2021-01-01', 'In the seemingly quiet town of Riverdale, it\'s time for the kids to start a new school year after a grim summer in which one of them, Jason Blossom, was killed in an alleged boating accident. Archie Andrews, a troubled young student called to choose whether to follow his passion for music, which blossomed during the last summer, or to follow his father\'s, who one day would like to leave him the helm of his construction company, brings with him a secret about it: the day of Jason\'s disappearance, Archie had heard a gunshot, but he had not said anything to anyone to avoid making public his clandestine relationship with the music teacher with whom he was in company. However, Jason\'s body soon emerges with an obvious gunshot wound to his forehead. Meanwhile, Archie, still romantically involved with the teacher, is the object of the wishes of his best friend Betty, long in love with him, as well as a new one just arrived in town, Veronica Lodge. Between several scandals and important discoveries Betty will get engaged to Jughead, the mysterious and dark boy best friend of Archie, while the latter and Veronica will start dating, without however defining their relationship as a \"romantic relationship\". The discovery of Jason\'s killer will bring a surface of shocking secrets that the Blossom family were hiding and also the arrival of a mysterious serial killer who will begin to kill all those who live in sin and perdition.', '../img/movies/riverdale.jpg', '4.00', 'Drama', 'American', 'Totaly Distribution', 'HollyProduction', '129', 'Antony, San', 'RRSA'),
('The 100', 'Marco Tozzi', '2020-12-04', '97 years after a global nuclear war that devastated planet Earth, what remains of mankind is a space station, the Ark, made up of the 13 space stations that were in orbit at the time of the disaster. The Ark has very strict laws and those who transgress are punished with death by expulsion into the void. With population growth and the rapid deterioration of recycling plants, government representatives decide to send one hundred delinquents to Earth. These young guys will embark on a very dangerous journey to try to repopulate the planet and create a new community.', '../img/movies/the100.jpg', '3.90', 'Action', 'American', '01 Distribution', 'Lotus Production', '129', 'Muccino, Costella', 'JJRR');

-- --------------------------------------------------------

--
-- Struttura della tabella `FilmDaVedere`
--

CREATE TABLE `FilmDaVedere` (
  `Titolo` varchar(30) NOT NULL,
  `Utente` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `FilmDaVedere`
--

INSERT INTO `FilmDaVedere` (`Titolo`, `Utente`) VALUES
('After', 'pr'),
('After', 'root'),
('La mia banda suona il pop', 'root3'),
('Lupin', 'root'),
('Riverdale', 'pr'),
('The 100', 'root');

-- --------------------------------------------------------

--
-- Struttura della tabella `FilmFavorito`
--

CREATE TABLE `FilmFavorito` (
  `Film` varchar(30) NOT NULL,
  `Utente` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `FilmFavorito`
--

INSERT INTO `FilmFavorito` (`Film`, `Utente`) VALUES
('After', 'root2'),
('La regina degli scacchi', 'root'),
('Riverdale', 'pr'),
('Riverdale', 'root'),
('Riverdale', 'root1'),
('Riverdale', 'root3');

-- --------------------------------------------------------

--
-- Struttura della tabella `Recensioni`
--

CREATE TABLE `Recensioni` (
  `Film` varchar(30) NOT NULL,
  `Utente` varchar(10) NOT NULL,
  `Recensione` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Recensioni`
--

INSERT INTO `Recensioni` (`Film`, `Utente`, `Recensione`) VALUES
('After', 'root2', 'i love it'),
('La mia banda suona il pop', 'root', 'classic movie with de sica'),
('La mia banda suona il pop', 'root3', 'This is fantastic movie to watch with family'),
('Lupin', 'root', 'good interpretation'),
('Lupin', 'root3', 'blaaaa'),
('Riverdale', 'pr', 'yes'),
('Riverdale', 'root', 'Very good movie'),
('Riverdale', 'root2', 'nice'),
('Riverdale', 'root3', 'my best movie!'),
('The 100', 'root', 'wow');

-- --------------------------------------------------------

--
-- Struttura della tabella `Regista`
--

CREATE TABLE `Regista` (
  `Codice` varchar(5) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `Cognome` varchar(20) NOT NULL,
  `DataNascita` date NOT NULL,
  `LuogoNascita` varchar(10) NOT NULL,
  `Eta` int(11) NOT NULL,
  `Foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Regista`
--

INSERT INTO `Regista` (`Codice`, `Nome`, `Cognome`, `DataNascita`, `LuogoNascita`, `Eta`, `Foto`) VALUES
('FB68', 'Fausto', 'Brizzi', '1968-11-15', 'Roma', 51, ''),
('GM67', 'Gabriele', 'Muccino', '1968-05-20', 'Roma', 51, ''),
('JJRR', 'Jason', 'Rothenberg', '1968-05-20', 'Roma', 51, ''),
('RRSA', 'Roberto', 'Sacasa', '1968-05-20', 'Roma', 51, ''),
('SHSH', 'Sharin', 'Maguire', '1968-05-20', 'Roma', 51, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `Utente`
--

CREATE TABLE `Utente` (
  `Username` varchar(10) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Cognome` varchar(30) NOT NULL,
  `Email` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `Utente`
--

INSERT INTO `Utente` (`Username`, `Password`, `Nome`, `Cognome`, `Email`) VALUES
('aaaaaaaaaa', '9e1e331390bd04197690b66397180d6a', 'ciaoc', 'ciaoc', 'gggaa@mail.com'),
('alfa', '628dc4918e3cec658ad154fa1e5337ed', 'c', 'c', 'ce@mail.com'),
('c', '6865aeb3a9ed28f9a79ec454b259e5d0', 'd', 'd', 'd@mail.com'),
('cc', '8ae114df2641b681b4fc51ed989f97b2', 'c', 'c', 'c@mail.com'),
('ccdcdc', 'fd74805fb0832e138868bc8b3dc4b987', 'ccdcd', 'c', 'cccdsewed@mail.com'),
('cdcd', '7b16783a9d7ce44e12deb7c9a372a027', 'cd', 'cd', 'cd@mail.com'),
('cdcdcdcdcd', '6f9378b0a6880ce9faf7aa1688f84dfd', 'rfrfr', 'frfr', 'frfr@mail.com'),
('cdscs', '37064edc208c930af1173744a323574a', 'cjak', 'cdsc', 'gg@mail.com'),
('pr', 'afdd0b4ad2ec172c586e2150770fbf9e', 'pr', 'pr', 'pr@mail.co'),
('root', '63a9f0ea7bb98050796b649e85481845', 'root', 'root', 'root@mail.com'),
('root1', '81dc9bdb52d04dc20036dbd8313ed055', 'vfdbv', 'dschs', 'cbdsh@mail.com'),
('root2', '81dc9bdb52d04dc20036dbd8313ed055', 'cdsc', 'cds', 'csdsc@mail.com'),
('root3', '99472c386d5ac7c7d02202ce0a23908a', 'GG', 'GG', 'gdg@mail.com'),
('root7', '01a0ea38dad111d32103de468a87af8a', 'Ca', 'xsc', 'asasa@mail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `VotoFilm`
--

CREATE TABLE `VotoFilm` (
  `Id` int(11) NOT NULL,
  `Utente` varchar(10) DEFAULT NULL,
  `Film` varchar(30) DEFAULT NULL,
  `Punteggio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `VotoFilm`
--

INSERT INTO `VotoFilm` (`Id`, `Utente`, `Film`, `Punteggio`) VALUES
(20, NULL, 'The 100', 3),
(24, NULL, 'Fata Madrina Cercasi', 4),
(28, NULL, 'Riverdale', 4),
(30, NULL, 'La mia banda suona il pop', 2),
(33, NULL, 'Riverdale', 3),
(34, NULL, 'Fata Madrina Cercasi', 5),
(127, 'root', 'The 100', 3),
(134, 'root', 'Fata Madrina Cercasi', 3),
(142, 'root', 'After', 4),
(143, 'root', 'Gli anni più belli', 2),
(147, 'root3', 'La mia banda suona il pop', 5),
(148, 'root3', 'Riverdale', 5),
(149, 'root3', 'Lupin', 1),
(150, 'root2', 'After', 4),
(152, 'root2', 'La mia banda suona il pop', 3),
(153, 'root2', 'Lupin', 1),
(155, 'root2', 'Riverdale', 4),
(159, 'root', 'Lupin', 1),
(162, 'root', 'Riverdale', 5),
(163, 'pr', 'Riverdale', 3),
(166, 'root', 'La mia banda suona il pop', 3),
(167, 'root', 'La regina degli scacchi', 3);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Attore`
--
ALTER TABLE `Attore`
  ADD PRIMARY KEY (`Codice`);

--
-- Indici per le tabelle `AttoreFilm`
--
ALTER TABLE `AttoreFilm`
  ADD PRIMARY KEY (`Attore`,`Film`),
  ADD KEY `Film` (`Film`);

--
-- Indici per le tabelle `Film`
--
ALTER TABLE `Film`
  ADD PRIMARY KEY (`Titolo`),
  ADD KEY `Regista` (`Regista`);

--
-- Indici per le tabelle `FilmDaVedere`
--
ALTER TABLE `FilmDaVedere`
  ADD PRIMARY KEY (`Titolo`,`Utente`),
  ADD KEY `Titolo` (`Titolo`,`Utente`),
  ADD KEY `Utente` (`Utente`);

--
-- Indici per le tabelle `FilmFavorito`
--
ALTER TABLE `FilmFavorito`
  ADD PRIMARY KEY (`Film`,`Utente`),
  ADD KEY `Utente` (`Utente`);

--
-- Indici per le tabelle `Recensioni`
--
ALTER TABLE `Recensioni`
  ADD PRIMARY KEY (`Film`,`Utente`),
  ADD KEY `Username` (`Utente`);

--
-- Indici per le tabelle `Regista`
--
ALTER TABLE `Regista`
  ADD PRIMARY KEY (`Codice`);

--
-- Indici per le tabelle `Utente`
--
ALTER TABLE `Utente`
  ADD PRIMARY KEY (`Username`);

--
-- Indici per le tabelle `VotoFilm`
--
ALTER TABLE `VotoFilm`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Utente` (`Utente`,`Film`),
  ADD KEY `Film` (`Film`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `VotoFilm`
--
ALTER TABLE `VotoFilm`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `AttoreFilm`
--
ALTER TABLE `AttoreFilm`
  ADD CONSTRAINT `AttoreFilm_ibfk_1` FOREIGN KEY (`Attore`) REFERENCES `Attore` (`Codice`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AttoreFilm_ibfk_2` FOREIGN KEY (`Film`) REFERENCES `Film` (`Titolo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Film`
--
ALTER TABLE `Film`
  ADD CONSTRAINT `Film_ibfk_1` FOREIGN KEY (`Regista`) REFERENCES `Regista` (`Codice`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `FilmDaVedere`
--
ALTER TABLE `FilmDaVedere`
  ADD CONSTRAINT `FilmDaVedere_ibfk_1` FOREIGN KEY (`Titolo`) REFERENCES `Film` (`Titolo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FilmDaVedere_ibfk_2` FOREIGN KEY (`Utente`) REFERENCES `Utente` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `FilmFavorito`
--
ALTER TABLE `FilmFavorito`
  ADD CONSTRAINT `FilmFavorito_ibfk_1` FOREIGN KEY (`Utente`) REFERENCES `Utente` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FilmFavorito_ibfk_2` FOREIGN KEY (`Film`) REFERENCES `Film` (`Titolo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `Recensioni`
--
ALTER TABLE `Recensioni`
  ADD CONSTRAINT `Recensioni_ibfk_1` FOREIGN KEY (`Film`) REFERENCES `Film` (`Titolo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Recensioni_ibfk_2` FOREIGN KEY (`Utente`) REFERENCES `Utente` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `VotoFilm`
--
ALTER TABLE `VotoFilm`
  ADD CONSTRAINT `VotoFilm_ibfk_1` FOREIGN KEY (`Utente`) REFERENCES `Utente` (`Username`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `VotoFilm_ibfk_2` FOREIGN KEY (`Film`) REFERENCES `Film` (`Titolo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
