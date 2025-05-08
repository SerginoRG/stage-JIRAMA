-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 22 mars 2025 à 13:59
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `server`
--

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE `agent` (
  `matricule_agent` int(11) NOT NULL,
  `id_societe` int(11) NOT NULL,
  `nom_agent` varchar(200) NOT NULL,
  `prenom_agent` varchar(200) NOT NULL,
  `adresse_agent` varchar(200) NOT NULL,
  `sexe_agent` varchar(200) NOT NULL,
  `statut_agent` varchar(200) NOT NULL,
  `telephone` varchar(200) NOT NULL,
  `compte_bancaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`matricule_agent`, `id_societe`, `nom_agent`, `prenom_agent`, `adresse_agent`, `sexe_agent`, `statut_agent`, `telephone`, `compte_bancaire`) VALUES
(5, 174, 'SOFILIRA', 'Rova', 'Champ de foire', 'Femme', 'Actif', '0345678924', 2147483647),
(6, 121, 'FENO', 'Aina', 'Ivato', 'Homme', 'Actif', '0328799457', 900678189),
(7, 174, 'SITRAKA', 'Beta', 'Betania', 'Homme', 'Retraite', '032567889', 2147483647),
(8, 120, 'AINA', 'Rova', 'Champ ', 'Homme', 'Actif', '42543633465', 2147483647);

-- --------------------------------------------------------

--
-- Structure de la table `analytique`
--

CREATE TABLE `analytique` (
  `id_analytique` varchar(20) NOT NULL,
  `nom_analytique` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `analytique`
--

INSERT INTO `analytique` (`id_analytique`, `nom_analytique`) VALUES
('1O', 'OPTIQUE'),
('1P', 'Pharmaceutique'),
('G76T', 'Pharmaceutique');

-- --------------------------------------------------------

--
-- Structure de la table `cms`
--

CREATE TABLE `cms` (
  `id_cms` int(11) NOT NULL,
  `matricule_agent` int(11) NOT NULL,
  `nom_cms` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cms`
--

INSERT INTO `cms` (`id_cms`, `matricule_agent`, `nom_cms`, `role`) VALUES
(4, 5, 'CMS TOLIARA', 'Administratif'),
(6, 6, 'CMS IHOSY', 'Administratif');

-- --------------------------------------------------------

--
-- Structure de la table `consultation`
--

CREATE TABLE `consultation` (
  `id_consultation` int(11) NOT NULL,
  `id_type_consultation` varchar(20) NOT NULL,
  `numero_piece` int(11) NOT NULL,
  `date_consultation` date NOT NULL,
  `motif_consultation` varchar(200) NOT NULL,
  `frais_consultation` float NOT NULL,
  `lieu_consultation` varchar(200) NOT NULL,
  `remarque` varchar(200) NOT NULL,
  `id_demande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `id_demande` int(11) NOT NULL,
  `matricule_agent` int(11) NOT NULL,
  `id_cms` int(11) NOT NULL,
  `date_demande` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`id_demande`, `matricule_agent`, `id_cms`, `date_demande`) VALUES
(6, 7, 4, '2024-11-20');

-- --------------------------------------------------------

--
-- Structure de la table `hospitalisation`
--

CREATE TABLE `hospitalisation` (
  `id_hospitalisation` int(11) NOT NULL,
  `id_demande` int(11) NOT NULL,
  `id_type_hospitalisation` varchar(20) NOT NULL,
  `numero_piece` int(11) NOT NULL,
  `date_entree` date NOT NULL,
  `date_sortie` date NOT NULL,
  `frais_hospitalisation` float NOT NULL,
  `remarque` varchar(200) NOT NULL,
  `lieu_hospitalisation` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `matricule_agent` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL,
  `statut` varchar(200) NOT NULL,
  `date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`id_login`, `matricule_agent`, `username`, `password`, `role`, `statut`, `date_creation`) VALUES
(8, 5, 'SOFILIRA', '$2y$10$qfQuRfAv0YE9XXH5c4HNEerkQtH6HJWt6LNay9Ikf5o0vzeGoot.G', 'Admin', 'Actif', '2024-11-18'),
(9, 6, 'FENO', '$2y$10$hAZ.GUeJvsH.jXR1h0fSBu8ZF384rVXjbnAkUrpcXUlsOsR3ownVa', 'Utilisateur', 'Actif', '2024-11-19'),
(10, 7, 'SAROBIDY', '$2y$10$Q4xvkWjsXV7b2rGez7XpTO6xacUH0IGL7Kf5OFwsaqum5/Zc4f1ge', 'Utilisateur', 'Actif', '2024-12-02');

-- --------------------------------------------------------

--
-- Structure de la table `medical`
--

CREATE TABLE `medical` (
  `id_medicale` int(11) NOT NULL,
  `id_demande` int(11) NOT NULL,
  `id_analytique` varchar(20) NOT NULL,
  `id_medicament` varchar(20) NOT NULL,
  `numero_piece` int(11) NOT NULL,
  `date_piece` date NOT NULL,
  `remarque` varchar(200) NOT NULL,
  `quantite` int(11) NOT NULL,
  `categorie` varchar(20) NOT NULL,
  `prix_unitaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `medical`
--

INSERT INTO `medical` (`id_medicale`, `id_demande`, `id_analytique`, `id_medicament`, `numero_piece`, `date_piece`, `remarque`, `quantite`, `categorie`, `prix_unitaire`) VALUES
(11, 6, '1P', '10C', 235, '2024-11-21', 'Agent', 3, 'Boite', 45000),
(12, 6, '1P', '14C', 235, '2024-11-21', 'Agent', 7, 'Plaquette', 600),
(13, 6, '1P', 'd', 235, '2024-11-21', 'Agent', 6, 'Plaquette', 800),
(14, 6, '1P', '20H', 235, '2024-11-21', 'Agent', 1, 'Autre', 800),
(15, 6, '1P', 'FF 10', 235, '2024-11-21', 'Agent', 1, 'Plaquette', 900),
(16, 6, '1P', '10C', 56, '2024-12-03', 'Agent', 2, 'Boite', 45000);

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

CREATE TABLE `medicament` (
  `id_medicament` varchar(20) NOT NULL,
  `nom_medicament` varchar(200) NOT NULL,
  `type_rembourse` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `medicament`
--

INSERT INTO `medicament` (`id_medicament`, `nom_medicament`, `type_rembourse`) VALUES
('10C', 'Ca-C1000', 'OUI'),
('14C', 'Cotrimoxazole', 'OUI'),
('15V', 'Vitamine ', 'NON'),
('20H', 'APDYL-H', 'OUI'),
('24P', 'Paracétamol', 'NON'),
('4R', 'Ciprofloxacine', 'NON'),
('d', 'DOLIPRANE', 'OUI'),
('FF 10', 'EFFERALGAN', 'OUI'),
('FV8', 'AP', 'NON'),
('LE 29', 'LEVOTHYROX', 'NON');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id_paiement` int(11) NOT NULL,
  `id_demande` int(11) NOT NULL,
  `mode_paiement` varchar(200) NOT NULL,
  `date_paiement` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id_paiement`, `id_demande`, `mode_paiement`, `date_paiement`) VALUES
(3, 6, 'Money Mobile', '2024-11-26');

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

CREATE TABLE `societe` (
  `id_societe` int(11) NOT NULL,
  `nom_societe` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `societe`
--

INSERT INTO `societe` (`id_societe`, `nom_societe`) VALUES
(120, 'SECTEUR MOROMBE'),
(121, 'SECTEUR AMPANIHY'),
(126, 'JIRAMA TOLAGANRO'),
(174, 'JIRAMA TOLIARA');

-- --------------------------------------------------------

--
-- Structure de la table `type_consultation`
--

CREATE TABLE `type_consultation` (
  `id_type_consultation` varchar(20) NOT NULL,
  `nom_consultation` varchar(200) NOT NULL,
  `plafond` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_consultation`
--

INSERT INTO `type_consultation` (`id_type_consultation`, `nom_consultation`, `plafond`) VALUES
('1U', 'URGENCE', 10000),
('2S', 'SPECIALISTE', 20000);

-- --------------------------------------------------------

--
-- Structure de la table `type_hospitalisation`
--

CREATE TABLE `type_hospitalisation` (
  `id_type_hospitalisation` varchar(20) NOT NULL,
  `nom_hospitalisation` varchar(200) NOT NULL,
  `plafond` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_hospitalisation`
--

INSERT INTO `type_hospitalisation` (`id_type_hospitalisation`, `nom_hospitalisation`, `plafond`) VALUES
('OP 34', 'OPERATION', 500000),
('SC 11', 'SCANNER', 250000);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`matricule_agent`),
  ADD KEY `societe_id` (`id_societe`);

--
-- Index pour la table `analytique`
--
ALTER TABLE `analytique`
  ADD PRIMARY KEY (`id_analytique`);

--
-- Index pour la table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id_cms`),
  ADD KEY `MATRI` (`matricule_agent`);

--
-- Index pour la table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`id_consultation`),
  ADD KEY `reb` (`id_demande`),
  ADD KEY `type` (`id_type_consultation`);

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`id_demande`),
  ADD KEY `cm` (`id_cms`),
  ADD KEY `matricule` (`matricule_agent`);

--
-- Index pour la table `hospitalisation`
--
ALTER TABLE `hospitalisation`
  ADD PRIMARY KEY (`id_hospitalisation`),
  ADD KEY `dema` (`id_demande`),
  ADD KEY `hospital` (`id_type_hospitalisation`);

--
-- Index pour la table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `user` (`matricule_agent`);

--
-- Index pour la table `medical`
--
ALTER TABLE `medical`
  ADD PRIMARY KEY (`id_medicale`),
  ADD KEY `axe` (`id_analytique`),
  ADD KEY `dem` (`id_demande`),
  ADD KEY `medi` (`id_medicament`);

--
-- Index pour la table `medicament`
--
ALTER TABLE `medicament`
  ADD PRIMARY KEY (`id_medicament`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id_paiement`),
  ADD KEY `H` (`id_demande`);

--
-- Index pour la table `societe`
--
ALTER TABLE `societe`
  ADD PRIMARY KEY (`id_societe`);

--
-- Index pour la table `type_consultation`
--
ALTER TABLE `type_consultation`
  ADD PRIMARY KEY (`id_type_consultation`);

--
-- Index pour la table `type_hospitalisation`
--
ALTER TABLE `type_hospitalisation`
  ADD PRIMARY KEY (`id_type_hospitalisation`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `agent`
--
ALTER TABLE `agent`
  MODIFY `matricule_agent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `cms`
--
ALTER TABLE `cms`
  MODIFY `id_cms` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `id_consultation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `id_demande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `hospitalisation`
--
ALTER TABLE `hospitalisation`
  MODIFY `id_hospitalisation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `medical`
--
ALTER TABLE `medical`
  MODIFY `id_medicale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id_paiement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `societe_id` FOREIGN KEY (`id_societe`) REFERENCES `societe` (`id_societe`);

--
-- Contraintes pour la table `cms`
--
ALTER TABLE `cms`
  ADD CONSTRAINT `MATRI` FOREIGN KEY (`matricule_agent`) REFERENCES `agent` (`matricule_agent`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `consultation`
--
ALTER TABLE `consultation`
  ADD CONSTRAINT `reb` FOREIGN KEY (`id_demande`) REFERENCES `demande` (`id_demande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `type` FOREIGN KEY (`id_type_consultation`) REFERENCES `type_consultation` (`id_type_consultation`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `cm` FOREIGN KEY (`id_cms`) REFERENCES `cms` (`id_cms`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matricule` FOREIGN KEY (`matricule_agent`) REFERENCES `agent` (`matricule_agent`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `hospitalisation`
--
ALTER TABLE `hospitalisation`
  ADD CONSTRAINT `dema` FOREIGN KEY (`id_demande`) REFERENCES `demande` (`id_demande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hospital` FOREIGN KEY (`id_type_hospitalisation`) REFERENCES `type_hospitalisation` (`id_type_hospitalisation`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `user` FOREIGN KEY (`matricule_agent`) REFERENCES `agent` (`matricule_agent`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `medical`
--
ALTER TABLE `medical`
  ADD CONSTRAINT `axe` FOREIGN KEY (`id_analytique`) REFERENCES `analytique` (`id_analytique`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dem` FOREIGN KEY (`id_demande`) REFERENCES `demande` (`id_demande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medi` FOREIGN KEY (`id_medicament`) REFERENCES `medicament` (`id_medicament`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `H` FOREIGN KEY (`id_demande`) REFERENCES `demande` (`id_demande`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
