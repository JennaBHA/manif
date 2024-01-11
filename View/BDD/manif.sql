-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 11 jan. 2024 à 08:13
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `manif`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

CREATE TABLE `activite` (
  `id` int(11) NOT NULL,
  `titre` text NOT NULL,
  `description` text NOT NULL,
  `heure` time NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `responsable` int(11) DEFAULT NULL,
  `max_participants` int(11) DEFAULT NULL,
  `participants` int(11) DEFAULT 0,
  `horaire` varchar(255) DEFAULT NULL,
  `id_responsable` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `activite`
--

INSERT INTO `activite` (`id`, `titre`, `description`, `heure`, `date`, `responsable`, `max_participants`, `participants`, `horaire`, `id_responsable`) VALUES
(9, 'karaoké héhé', 'Chant pour tous le monde', '13:00:00', '2023-11-05', 0, NULL, 3, NULL, 5),
(43, 'choux', 'modification 15122023', '11:01:00', '3333-03-31', 0, NULL, 0, NULL, NULL),
(45, 'Foot', 'Terrain de sport ', '14:00:00', '2023-01-18', 0, NULL, 0, NULL, NULL),
(46, 'foot de rue', 'foot de rue ', '12:23:00', '1111-11-11', 0, NULL, 0, NULL, NULL),
(47, 'activité test', 'test', '12:00:00', '3234-02-12', 0, NULL, 0, NULL, NULL),
(48, 'bonjour', 'bonjour', '12:00:00', '1212-12-12', 0, NULL, 0, NULL, NULL),
(49, 'aaaaaaa', 'aaaaaaaa', '11:11:00', '0111-11-11', 0, NULL, 0, NULL, NULL),
(50, '1111111111111111111', '111111111111111111111111111111', '11:11:00', '2024-01-10', 0, NULL, 0, NULL, NULL),
(51, 'AZE', 'AZE', '12:00:00', '2004-12-12', 0, NULL, 0, NULL, NULL),
(52, 'aaaa', 'aaaaa', '11:11:00', '2001-11-11', 34, NULL, 0, NULL, NULL),
(53, 'bonnnn', 'bonnnn', '12:12:00', '2002-12-12', 34, NULL, 0, NULL, NULL),
(54, 'jour', 'jour', '12:12:00', '1222-12-12', 34, NULL, 0, NULL, NULL),
(55, 'jour', 'jour', '12:12:00', '1222-12-12', 34, NULL, 0, NULL, NULL),
(56, 'jour', 'jour', '12:12:00', '1222-12-12', 34, NULL, 0, NULL, NULL),
(57, 'jour', 'jour', '12:12:00', '1222-12-12', 34, NULL, 0, NULL, NULL),
(58, 'AAAA', 'AAAA', '11:11:00', '0111-11-11', 34, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
  `id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `activite_id` int(11) NOT NULL,
  `etat` varchar(255) DEFAULT 'en attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`id`, `participant_id`, `activite_id`, `etat`) VALUES
(3, 32, 9, 'en attente');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id` int(11) NOT NULL,
  `pseudo` text NOT NULL,
  `mdp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id`, `pseudo`, `mdp`) VALUES
(1, 'admin', 'admin123'),
(2, 'responsable', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE `participant` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `role` text NOT NULL,
  `mail` text NOT NULL,
  `mdp` text NOT NULL,
  `telephone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `participant`
--

INSERT INTO `participant` (`id`, `nom`, `prenom`, `role`, `mail`, `mdp`, `telephone`) VALUES
(32, 'BENHADJ', 'jenna', '', 'jenna@gmail.com', 'dff47fbb88ecd8e72ae626dbf47d919b55dff935', 101010101);

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE `participation` (
  `id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `activite_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `responsable`
--

CREATE TABLE `responsable` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `role` text NOT NULL,
  `mdp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `responsable`
--

INSERT INTO `responsable` (`id`, `nom`, `prenom`, `role`, `mdp`) VALUES
(5, 'jenna', 'jenna', 'responsable', '$2y$10$0krpxbFE1fqmYNAIGF68KOt9bKSDGGQG1q5R1sJhYvqi6E2sKL0K6'),
(6, 'jenna', 'jenna', 'responsable', '$2y$10$Wr1wox5GbbpI6vFJnUJxfuqf0bGqfPmpaZfBm4S89/7waipd4ZpK.'),
(8, 'jenna', 'jenna', 'responsable', '$2y$10$sXPxk21an9E9zKUcSgpfJe5L7JZNqh1OxNeei5jIbnM//26YQdwBC'),
(9, 'jenna', 'jenna', 'responsable', '$2y$10$6jlGgAvySSlzQo3FZMuPqOjUF0ecifREPJS46qVijMtk/UlZusC8q'),
(10, 'jenna', 'jenna', 'responsable', '$2y$10$Z.XHRXEr2m/Rqw/lN6nsUetpC9FztIvRHeiJU.KkESPsWlrq9.dza'),
(11, 'jenna', 'jenna', 'responsable', '$2y$10$odVERtA3vtp7PljWjdx/buzm16zQnivK74.hGfDm1JFZOMt1sHl2a'),
(12, 'jenna', 'jenna', 'responsable', '$2y$10$otdXT/AjwQ7d9CczI8IMyeDL.F3cAa5ughO4UJff99a1/t.9KFZwK'),
(13, 'jenna', 'jenna', 'responsable', '$2y$10$2K6hE.lsBbw3Mmogq7VmBu4d0.133yz6u7g7/OgKnKAamYg2nsSMW'),
(14, 'jenna', 'jenna', 'responsable', '$2y$10$sUteA.yKr5wWmVHO8QOsIuj/fc0F6F88dwkm0UW/spiSJ81jUDjza'),
(15, 'jenna', 'jenna', 'responsable', '$2y$10$H8BsjhjTQzV7uuk2Snxw1uk0TVNGsbAwLsqk0.CQQAk.LjMkE0nc2'),
(16, 'jenna', 'jenna', 'responsable', '$2y$10$46YYqFJIB/7JCFwxtP4euuLLdRkngWTztwVINQ3jhax0TllXuAitq'),
(17, 'jenna', 'jenna', 'responsable', '$2y$10$HcnEWUkUAqpdRU1H1QvhRe.Nu4Z8w9Cby9oLBJXEZj9HsrkZN4C4y'),
(18, 'jenna', 'jenna', 'responsable', '$2y$10$lW4eXMMJYYVmMAS8UJ0BvOO/eP0wwPxut0Z6dMECRD3SpDcMbwoxO'),
(19, 'jenna', 'jenna', 'responsable', '$2y$10$itvW3BWB7xa5pTucHA0Kzur5YSIySQwEXcv0T17ODIt5sQ8bU4hRC'),
(20, 'jenna', 'jenna', 'responsable', '$2y$10$H6GhP0868uiWQtrN5UEC5ehsWKC1FNuFWHsPQuXj8mRo24gLvUUiC'),
(21, 'jenna', 'jenna', 'responsable', '$2y$10$5p9xbDZ67gBciI4CPr/kqO1NVecZynGTiK9e4o/.83hNS.psK./J2'),
(22, 'jenna', 'jenna', 'responsable', '$2y$10$A9CJKXcsn7OTrS84krsIpeRV3o14b/mOifPUEXdDBRCouxINUOW16'),
(23, 'jenna', 'jenna', 'responsable', '$2y$10$rXb.IYXsTYJYbRdRSJZFY./1UYLmcMYY6B4jdd2jgEEuDHMvnoxtm'),
(24, 'jenna', 'jenna', 'responsable', '$2y$10$JREtpJNnWvj2Ehaymqa8pOkpdL.JxlyWDQqJ5nOWaRllyHx9zFktG'),
(25, 'jenna', 'jenna', 'responsable', '$2y$10$/nHMeDXeYgWKuYFfx92mru2OjEHqCP/zbaSmzyqaORcKHCkScZqvm'),
(26, 'jenna', 'jenna', 'responsable', '$2y$10$ysa.c/u19BJ7.yWTyKt0mOktx6gPU91RoZzBuFyKl6DTBA.sjhqIG'),
(27, 'jenna', 'jenna', 'responsable', '$2y$10$gZM9CSsysHC8XhYWkpgpruV/FS5uzMS.WQ1RzyREqgaDSKzsLkKWO'),
(28, 'jenna', 'jenna', 'responsable', '$2y$10$HkOuOZBAWyFRruXnJCK5AuZ7zXnCV9k8wdRU8T8vSyydeIjw9AcbG'),
(32, 'bonjour', 'bonjour', '', '$2y$10$8gNuZ9kzYkogf.Uk3Juk9.uN.jH4qJHQmlmgX4Fd12/f5yu8Kf01y'),
(33, 'BEN HADJ AMOR', 'Jenna', '', '$2y$10$GAmcPp6Wjbgj5GrbdmTtWe43DIMZKI0JrmyTmzQPSEteqytkJZvnO'),
(34, 'BEIRADE', 'BEIRADE', '', '$2y$10$wxDB1DKgnsTvToWG/qyuFeFq81g0tgu3Y33GaQQIz0WfR4mHVddXO');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activite`
--
ALTER TABLE `activite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participant_id` (`participant_id`),
  ADD KEY `activite_id` (`activite_id`);

--
-- Index pour la table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participant_id` (`participant_id`),
  ADD KEY `activite_id` (`activite_id`);

--
-- Index pour la table `responsable`
--
ALTER TABLE `responsable`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activite`
--
ALTER TABLE `activite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `participation`
--
ALTER TABLE `participation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `responsable`
--
ALTER TABLE `responsable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `inscription_ibfk_1` FOREIGN KEY (`participant_id`) REFERENCES `participant` (`id`),
  ADD CONSTRAINT `inscription_ibfk_2` FOREIGN KEY (`activite_id`) REFERENCES `activite` (`id`);

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `participation_ibfk_1` FOREIGN KEY (`participant_id`) REFERENCES `participant` (`id`),
  ADD CONSTRAINT `participation_ibfk_2` FOREIGN KEY (`activite_id`) REFERENCES `activite` (`id`);

--
-- Contraintes pour la table `role`
--
ALTER TABLE `role`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `participant` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
