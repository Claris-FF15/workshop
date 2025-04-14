-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : dim. 13 avr. 2025 à 13:34
-- Version du serveur : 8.0.35
-- Version de PHP : 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_app`
--

-- --------------------------------------------------------

--
-- Structure de la table `tbl_task`
--

CREATE TABLE `tbl_task` (
  `id_task` int NOT NULL,
  `id_user` int NOT NULL,
  `name_task` varchar(200) NOT NULL,
  `details_task` varchar(200) NOT NULL,
  `important_task` int NOT NULL DEFAULT '0',
  `repeat_task` int NOT NULL DEFAULT '0',
  `add_time_task` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time_task` date NOT NULL,
  `statut_task` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tbl_task`
--

INSERT INTO `tbl_task` (`id_task`, `id_user`, `name_task`, `details_task`, `important_task`, `repeat_task`, `add_time_task`, `end_time_task`, `statut_task`) VALUES
(1, 2, '#313', 'cbbckzjbckzbcj', 1, 0, '2025-02-28 11:35:10', '2025-03-28', 0),
(2, 5, 'laver ses dents', 'brossage + bain de bouche ', 0, 1, '2025-03-22 11:27:09', '2025-03-26', 0),
(4, 2, 'cab', 'czefnkenfkeznfklfkleb', 0, 1, '2025-03-26 11:43:25', '2025-03-22', 0),
(5, 2, 'workshop', 'reglage probleme de base + avance sur le project.', 0, 0, '2025-03-26 16:28:18', '2025-03-26', 1),
(6, 5, 'task normal', 'atrdt', 0, 0, '2025-03-27 14:48:49', '2025-03-28', 1),
(8, 5, 'nourrir le chat', '', 0, 1, '2025-03-29 12:27:57', '2025-03-29', 0),
(9, 5, 'test php', '8h30 test a E6K', 1, 0, '2025-03-31 09:41:22', '2025-04-01', 0),
(10, 5, 'test workshop', 'présentation workshop ', 1, 0, '2025-03-31 09:42:18', '2025-04-04', 1),
(11, 5, 'reparer erreur', 'php workshop', 0, 1, '2025-03-31 09:44:39', '2025-04-01', 0),
(12, 5, 'boire de l\'eau', 'boire 2 litres d\'eau ', 1, 0, '2025-04-02 17:18:05', '2025-04-03', 1),
(14, 5, 'test', 'vdj', 0, 0, '2025-04-04 11:27:01', '2025-04-04', 0),
(15, 5, 'fzahbr', 'geste', 1, 0, '2025-04-11 17:40:00', '2025-04-11', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int NOT NULL DEFAULT '0',
  `remember_token` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `mail`, `password`, `role`, `remember_token`) VALUES
(5, 'test-2', 'test23@gmail.com', '$2y$10$dvHyByU31gpWay.9IH5li.0ufX9CgCOfAHY7zKJQ6jCEtcuBfsVxa', 1, NULL),
(6, 'claris', 'claris.bnd@gamil.com', '$2y$10$dRaOIrah.J3BWGUvqE8QzOtSF3ZJXAh1cLKH1rB/g0ZSkctPTo9MK', 0, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`id_task`);

--
-- Index pour la table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `id_task` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
