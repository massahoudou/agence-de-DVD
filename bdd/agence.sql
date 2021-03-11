-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 07 août 2020 à 12:15
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `agence`
--

-- --------------------------------------------------------

--
-- Structure de la table `categori`
--

CREATE TABLE `categori` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categori`
--

INSERT INTO `categori` (`id`, `nom`) VALUES
(1, 'Action'),
(2, 'Aventure'),
(3, 'Drame'),
(4, 'Commédie'),
(5, 'Fiction');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_at` datetime NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `iduser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id`, `filename`, `nom`, `date_at`, `description`, `iduser`) VALUES
(1, '5ee0f6d59fe76987478597.jpg', 'face a face', '2015-07-30 19:30:00', 'retrouver nous à la date prévu ca promet d\'être chaud le défi tant à tendu est enfin arriver la final  du call of duty  black ops', NULL),
(3, '5ee1177fe055c521271237.jpg', 'les rois de la console', '2020-06-10 20:00:00', 'tu es douées tu talatueux alors vient rivaliser avec les bros au centre genius geek fait vite les ticket ce vide', NULL),
(5, '5ee4050630d6b302160691.jpg', 'Focus --la Ps5--', '2020-06-01 16:30:00', 'parlons sans sur cette nouvel console a l’occasion des jeux de test et une conférence se tiendra sur le monde des jeux vidéos suivit de vente d\'accessoire pour console de jeux de tout type', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `iduser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200529141353', '2020-06-08 07:04:58'),
('20200608083534', '2020-06-08 08:36:09'),
('20200610141609', '2020-06-10 14:25:15'),
('20200610150433', '2020-06-10 15:04:56'),
('20200714130036', '2020-07-14 13:02:03'),
('20200802091236', '2020-08-02 09:17:26'),
('20200802093312', '2020-08-02 09:33:27');

-- --------------------------------------------------------

--
-- Structure de la table `proprietes`
--

CREATE TABLE `proprietes` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acteurs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` int(11) NOT NULL,
  `origine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `realisateur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datesorti_at` date NOT NULL,
  `datecreation_at` datetime NOT NULL,
  `producteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `solde` tinyint(1) NOT NULL DEFAULT 0,
  `updated_at` datetime NOT NULL,
  `newfilm` tinyint(1) NOT NULL DEFAULT 0,
  `reserver` tinyint(1) NOT NULL DEFAULT 0,
  `top_film` tinyint(1) NOT NULL DEFAULT 0,
  `iduser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `proprietes`
--

INSERT INTO `proprietes` (`id`, `filename`, `titre`, `acteurs`, `description`, `prix`, `origine`, `realisateur`, `datesorti_at`, `datecreation_at`, `producteur`, `solde`, `updated_at`, `newfilm`, `reserver`, `top_film`, `iduser`) VALUES
(1, '5edde9c08d87c363475969.jpg', 'flash', 'john', 'un super hero', 10000, 'americaine', 'baki', '2016-11-11', '2020-06-08 09:33:19', 'odanou massahoudou', 0, '2020-06-08 09:33:20', 1, 0, 1, NULL),
(2, '5eddea32b25a0880772725.jpg', 'Venom', 'michael jackson', 'les extras terrestre envahi la terre', 16000, 'Sud-americaine', 'bill gate', '2015-04-04', '2020-06-08 09:35:13', 'ODA', 0, '2020-06-08 09:35:14', 1, 0, 1, NULL),
(3, '5eddeaf17f371082074370.jpg', 'Shazam', 'choupinpin', 'une jeune de ce fait octroillé les pouvoir d un grand magicien', 6000, 'Amerique latine', 'bic boc', '2018-01-01', '2020-06-08 09:38:24', 'atlas', 0, '2020-06-08 09:38:25', 1, 0, 0, NULL),
(4, '5eddebbfb7742384685586.jpg', 'ghost rider', 'odanou massahoudou', 'un mot réapparait pour sauver son fils des ténèbre', 10000, 'Americaine', 'bobi', '2017-09-01', '2020-06-08 09:41:50', 'jhonson', 0, '2020-06-08 09:41:51', 0, 0, 1, NULL),
(5, '5edded0997ec4284954350.jpg', 'black list', 'tobi brillan', 'la société est corrompu un nettoyeur a été élue', 8000, 'americaine', 'ankh Zippzer', '2016-02-08', '2020-06-08 09:47:20', 'baki', 0, '2020-06-08 09:47:21', 1, 0, 0, NULL),
(6, '5eddedbc44393191477766.jpg', 'Avengers endgame', 'robert-scarlet-', 'lego', 20000, 'americaine', 'fachi xuu', '2015-05-01', '2020-06-08 09:50:19', 'abram poli', 0, '2020-06-08 09:50:19', 1, 0, 0, NULL),
(7, '5eddee3f47975090079694.jpg', 'Lego Batman', 'lego', 'lego', 5000, 'amerique', 'fuu tang', '2015-01-01', '2020-06-08 09:52:30', 'francois du bois', 0, '2020-06-08 09:52:30', 1, 0, 0, NULL),
(8, '5eddeeea84ab5945772139.jpg', 'venom 2', 'odanou-papa-mass', 'venom2', 12000, 'americain', 'odanou massahoud', '2018-01-01', '2020-06-08 09:55:20', 'mass', 0, '2020-06-08 09:55:22', 1, 0, 1, NULL),
(9, '5ee3f97a3da44160041502.jpg', 'matrak', 'mixiu-eden-baris', 'un cahe sans foi est a tous pour atteindre les sommet', 2000, 'asiatique', 'ben ali', '2017-03-28', '2020-06-12 23:54:00', 'shurashe moctar', 0, '2020-06-12 23:54:01', 0, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `proprietes_categori`
--

CREATE TABLE `proprietes_categori` (
  `proprietes_id` int(11) NOT NULL,
  `categori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `proprietes_categori`
--

INSERT INTO `proprietes_categori` (`proprietes_id`, `categori_id`) VALUES
(1, 1),
(1, 5),
(2, 1),
(2, 2),
(2, 5),
(3, 1),
(3, 4),
(3, 5),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(6, 5),
(7, 2),
(8, 1),
(8, 2),
(8, 5),
(9, 1),
(9, 3);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `iddisque` int(11) NOT NULL,
  `titredisque` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'odanou', '123456');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categori`
--
ALTER TABLE `categori`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `proprietes`
--
ALTER TABLE `proprietes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `proprietes_categori`
--
ALTER TABLE `proprietes_categori`
  ADD PRIMARY KEY (`proprietes_id`,`categori_id`),
  ADD KEY `IDX_5375D448A1005530` (`proprietes_id`),
  ADD KEY `IDX_5375D448425FCA7D` (`categori_id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categori`
--
ALTER TABLE `categori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `proprietes`
--
ALTER TABLE `proprietes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `proprietes_categori`
--
ALTER TABLE `proprietes_categori`
  ADD CONSTRAINT `FK_5375D448425FCA7D` FOREIGN KEY (`categori_id`) REFERENCES `categori` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5375D448A1005530` FOREIGN KEY (`proprietes_id`) REFERENCES `proprietes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
