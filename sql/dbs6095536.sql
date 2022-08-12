-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Hôte : db5007396538.hosting-data.io
-- Généré le : ven. 12 août 2022 à 08:06
-- Version du serveur : 5.7.38-log
-- Version de PHP : 7.0.33-0+deb9u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `PHPBlog`
--
CREATE DATABASE IF NOT EXISTS `PHPBlog` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `PHPBlog`;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `postId` int(11) NOT NULL,
  `contenu` text,
  `addedOn` date DEFAULT NULL,
  `statut` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `usersId`, `postId`, `contenu`, `addedOn`, `statut`) VALUES
(2, 4, 1, 'Commentaire', '2022-08-12', 0);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `titre` text,
  `chapo` text,
  `image` text,
  `contenu` text,
  `usersId` int(11) NOT NULL,
  `addedOn` date DEFAULT NULL,
  `updateOn` date DEFAULT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `titre`, `chapo`, `image`, `contenu`, `usersId`, `addedOn`, `updateOn`, `type`) VALUES
(1, "Forum PHP 2022 les 13 et 14 octobre à Paris ', 'Le cycle de conférences de l'AFUP prépare la 21e édition de Forum PHP 2022. Cette année l'évènement fera sont grand retour en présentiel et présente une affiche toujours aussi ambitieuse. Voici les dernière actualité.", "https://www.toolinux.com/IMG/jpg/capture_d_ecran_2022-06-03_a_09.02.52.jpg?1654240371", "L'association française des utilisateurs de PHP organise chaque année le Forum PHP. Et cette année est déjà la 21e édition. Elle entend promouvoir le langage PHP et participer à son développement.\r\nDeux jours d'apprentissages et d'échanges dans un lieu peu ordinaire : l'Hôtel New York du parc DisneyLand Paris. r\n\r\nLe programme n'est pas encore défini à ce stade mais l'appel à conférences (https://afup.org/event/forumphp2022)  est lancé. L'occasion de vous manifester si vous avez envie de parler de serverless, de qualité et de travail en équipe. Ou encore de raconter ce que l 'open-source a apporté à votre dernier projet ou comment cet outil a révolutionné votre façon d 'appréhender votre développement.\r\n\r\nAutres nouveauté de cette année : l'accueil des personnes sourdes ou malentendantes  grâce à un prestataire 'Le Messager', les organisateurs nous expliquent : 'toutes les conférences sont sous-titrées en temps réel, à la vitesse de la parole, dans un langage de qualité, avec une ponctuation adaptée. Les sous-titres sont diffusées sur l'écran géant de chaque amphithéâtre pour être lisibles de toutes et de tous et depuis n'importe quel siège de la salle'.\r\n\r\nLa billetterie est ouverte.\r\nLe tarif 'Early Bird' est épuisé, mais vous pouvez, si vous êtes membres de l'AFUP, acheter des entrées a 190 € pour les 2 jours.\r\nL\'adhésion revient à 30€ par an.\r\n\r\nBilletterie :  https://afup.org/event/forumphp2022/tickets\r\nAdhésion : https://afup.org/association/devenir-membre\r\n\r\nSources : \r\n- https://www.toolinux.com/?forum-php-2022-paris\r\n- Le site du Forum PHP 2022 : https://event.afup.org/\r\n- L'appel à conférences : https://afup.org/event/forumphp2022\r\n- Réseaux sociaux : \r\nTwitter : @afup\r\nMastodon : @afup@mastodon.online\r\n", 4, '2022-06-03', NULL, 4);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE `reponse` (
  `id` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `commentaireId` int(11) NOT NULL,
  `contenu` text,
  `addedOn` date DEFAULT NULL,
  `statut` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstCnx` date NOT NULL,
  `lastCnx` date DEFAULT NULL,
  `statut` tinyint(1) NOT NULL,
  `password_recovery_asked_date` date DEFAULT NULL,
  `password_recovery_token` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `prenom`, `email`, `password`, `firstCnx`, `lastCnx`, `statut`, `password_recovery_asked_date`, `password_recovery_token`) VALUES
(4, 'Emma', 'Marie', 'mcemma.974@gmail.com', '5a43097d3abf7d9ba6e5b57d7ef4720375dd1121fa720064f618bb7ba125770c', '2022-06-10', '2022-08-12', 0, '2022-08-12', ''),
(5, 'Emma', 'Fabienne', 'marie.emma24@orange.fr', 'e654666eee6bc346b7a26f5ebdfb3c019d5c471760d6477a2af427cab364e42d', '2022-06-19', '0000-00-00', 1, '2022-06-19', '8iJn4dKcAlSIPBNEzumF'),
(6, 'TESTEUR', 'TESTEUR', 'qroussel@defi-informatique.net', 'b8978664c62cafb97d1717f0e61696b6ac7a202a3f0273ddcea79273527889ef', '2022-07-26', '2022-07-26', 1, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
