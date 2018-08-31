-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le :  ven. 31 août 2018 à 20:15
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Readersdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `chapter`
--

CREATE TABLE `chapter` (
  `id` int(11) NOT NULL,
  `chapter_number` int(11) DEFAULT NULL,
  `chapter_title` varchar(255) DEFAULT NULL,
  `chapter_body` text,
  `novels_id` int(11) NOT NULL,
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chapter`
--

INSERT INTO `chapter` (`id`, `chapter_number`, `chapter_title`, `chapter_body`, `novels_id`, `create_date`, `modified_date`) VALUES
(1, 0, 'Intro', 'ta mere', 1, '2018-08-31 19:04:39', '2018-08-31 19:04:39'),
(2, 0, 'Intro', 'yolo', 2, '2018-08-31 19:05:02', '2018-08-31 19:05:02'),
(3, 0, 'intro', 'try', 3, '2018-08-31 19:05:24', '2018-08-31 19:05:24'),
(4, 1, 'the first chapter', 'Early morning. It’s so bright that I had to open my lazy eyelids. Why does my house have to face the sun. Waking up everyday to the sun’s glare makes me want to cry.\r\n\r\n“You lazy bum! Are you up yet?”\r\n\r\nHearing this pleasant voice, I immediately jumped down from bed.', 3, '2018-08-31 19:06:11', '2018-08-31 19:06:11'),
(5, 1, 'genius no more', '‘Dou Zhi Li(1), 3rd stage!’\r\n\r\nFacing the Magical Testing Monument as it displayed the 5 big hurtful words, the youth stood expressionless, lips curled in a small self-ridiculing smile. He tightly clenched his fist and because of the strength used, his slightly sharp fingernails dug deep into the palm of his hand, bringing brief moments of pain.', 2, '2018-08-31 19:07:31', '2018-08-31 19:07:31'),
(6, 1, 'Lin Dong', 'WDQK Chapter 1: Lin Dong\r\n\r\n“Wuu.”\r\n\r\nWhen Lin Dong gathered every ounce of strength to open his heavy eyelids, a simple, crude yet tidy room appeared before his eyes. This familiar scene caused him to blink distractedly, unable to make sense of why he was here, though soon after, he promptly turned his head in a flash of understanding. Sure enough he saw the two figures of a man and a woman seated at a table in the room.\r\n\r\n“Father, mother……”', 1, '2018-08-31 19:07:31', '2018-08-31 19:07:31'),
(7, 2, 'Choosing The Light Element', 'Cong cong\r\n\r\nI quickly ate two mouthfuls of breakfast then left the house for school in a hurry.\r\n\r\n“Walk faster, you don’t want to be late otherwise the teacher will have a bad impression of you. Properly learn magic! Pay attention to the road and come home quickly after school!\r\n\r\nMother sure is amazing, saying these words every day, it’s impossible for me to not know them by heart by now. However, her concern for me makes my heart warm.', 3, '2018-08-31 19:09:36', '2018-08-31 19:09:36'),
(8, 2, 'Dou Qi Continent', 'The moon was like a silver plate and the stars filled the sky.\r\n\r\nAt the summit of the cliff, Xiao Yan lay on the grass and in his mouth was a strand of green grass. He chewed it slightly and let the bitterness spread into his mouth slowly.\r\n\r\nHe raised his white palm and put it in front of him, blocking the moon and only letting some moonlight pass through the gaps between his fingers. He looked at the giant circular silver moon in the sky.', 2, '2018-08-31 19:09:36', '2018-08-31 19:09:36'),
(9, 2, 'Penetrating Fist', 'In the wee hours of the morning, stood a lonely mountain peak surrounded by a thick white fog that caused one\'s vision to become fuzzy.\r\n\r\n“Huff~huff~”\r\n\r\nWithin a dense forest behind the mountain peak, a sudden and intense gasp sounded out. Upon taking a closer look, in an open space within the woods, a tiny figure could be seen hanging from a thick and sturdy branch using both of his hands. This tiny body borrowed the pulling force from his arms to move up and down repeatedly. As he made these movements, his body formed some strange poses; the kind of poses that utilized all the muscles in the body, exercising all of them together.', 1, '2018-08-31 19:10:05', '2018-08-31 19:10:05');

-- --------------------------------------------------------

--
-- Structure de la table `novels`
--

CREATE TABLE `novels` (
  `id` int(11) NOT NULL,
  `title` char(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `language` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `synopsis` longtext,
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `novels`
--

INSERT INTO `novels` (`id`, `title`, `picture`, `language`, `status`, `synopsis`, `create_date`, `modified_date`) VALUES
(1, 'Wu Dong Qian Kun', NULL, 'Chines', 'on going', 'LEREM IPSUM SYNOPSIS', '2018-08-31 19:01:27', '2018-08-31 19:01:27'),
(2, 'Battle Through the Heavens\r\n', NULL, 'Chinese', 'on going', 'LEREM IPSUM BTTH', '2018-08-31 19:02:17', '2018-08-31 19:02:17'),
(3, 'Child of Light', NULL, 'chinese', 'on going', 'LEREM IPSUM COL', '2018-08-31 19:04:12', '2018-08-31 19:04:12');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_chapter_novels_idx` (`novels_id`);

--
-- Index pour la table `novels`
--
ALTER TABLE `novels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `novels`
--
ALTER TABLE `novels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chapter`
--
ALTER TABLE `chapter`
  ADD CONSTRAINT `fk_chapter_novels` FOREIGN KEY (`novels_id`) REFERENCES `novels` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
