-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 21 mars 2025 à 18:50
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
-- Base de données : `schl_hub`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `Uti_idUtilisateur` int(11) DEFAULT NULL,
  `Enc_idEncadrant` int(11) DEFAULT NULL,
  `idClasse` int(11) NOT NULL,
  `nbrStag` int(11) DEFAULT NULL,
  `nbrCours` int(11) DEFAULT NULL,
  `dateCreation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `Cla_Uti_idUtilisateur` int(11) NOT NULL,
  `Enc_idEncadrant` int(11) NOT NULL,
  `Cla_idClasse` int(11) NOT NULL,
  `idCours` int(11) NOT NULL,
  `nom` varchar(254) DEFAULT NULL,
  `format` varchar(50) DEFAULT NULL,
  `datePub` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `encadrant`
--

CREATE TABLE `encadrant` (
  `idEncadrant` int(11) NOT NULL,
  `Uti_idUtilisateur` int(11) NOT NULL,
  `emailOrg` varchar(254) DEFAULT NULL,
  `bio` varchar(254) DEFAULT NULL,
  `profession` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `encadrant`
--

INSERT INTO `encadrant` (`idEncadrant`, `Uti_idUtilisateur`, `emailOrg`, `bio`, `profession`) VALUES
(3, 6, 'jean.dupont@example.com', 'Développeur web passionné, expert en HTML, CSS, et JavaScript, créant des sites modernes et réactifs', 'Web designer'),
(14, 17, NULL, 'Créateur de sites web innovants, alliant esthétique et fonctionnalité pour une expérience utilisateur optimale.', 'Infographie et Web design'),
(15, 31, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `idMessage` int(11) NOT NULL,
  `Uti_idUtilisateur` int(11) NOT NULL,
  `idUemetteur` varchar(254) DEFAULT NULL,
  `idUrecepteur` varchar(254) DEFAULT NULL,
  `contenu` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `idNotification` int(11) NOT NULL,
  `Uti_idUtilisateur` int(11) NOT NULL,
  `titre` varchar(254) DEFAULT NULL,
  `description` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `profilsocial`
--

CREATE TABLE `profilsocial` (
  `idPsocial` int(11) NOT NULL,
  `Enc_idEncadrant` int(11) NOT NULL,
  `gitlab` varchar(254) DEFAULT NULL,
  `github` varchar(254) DEFAULT NULL,
  `facebook` varchar(254) DEFAULT NULL,
  `instagram` varchar(254) DEFAULT NULL,
  `google` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `profilsocial`
--

INSERT INTO `profilsocial` (`idPsocial`, `Enc_idEncadrant`, `gitlab`, `github`, `facebook`, `instagram`, `google`) VALUES
(2, 3, 'https://gitlab.com/jeandupont', 'https://github.com/jeandupont', 'https://facebook.com/jean.dupont', 'https://instagram.com/jeandupont', 'https://plus.google.com/jean.dupont'),
(3, 14, NULL, NULL, NULL, NULL, NULL),
(4, 15, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

CREATE TABLE `stagiaire` (
  `Cla_Uti_idUtilisateur` int(11) DEFAULT NULL,
  `Enc_idEncadrant` int(11) DEFAULT NULL,
  `Cla_idClasse` int(11) DEFAULT NULL,
  `Uti_idUtilisateur` int(11) NOT NULL,
  `idStagiaire` int(11) NOT NULL,
  `emailUni` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stagiaire`
--

INSERT INTO `stagiaire` (`Cla_Uti_idUtilisateur`, `Enc_idEncadrant`, `Cla_idClasse`, `Uti_idUtilisateur`, `idStagiaire`, `emailUni`) VALUES
(NULL, NULL, NULL, 30, 15, '');

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `idTache` int(11) NOT NULL,
  `Uti_idUtilisateur` int(11) NOT NULL,
  `Enc_idEncadrant` int(11) NOT NULL,
  `dateAtt` datetime DEFAULT NULL,
  `contenu` varchar(254) DEFAULT NULL,
  `checked` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `nom` varchar(254) DEFAULT NULL,
  `prenom` varchar(254) DEFAULT NULL,
  `motPasse` varchar(254) DEFAULT NULL,
  `numero` varchar(254) DEFAULT NULL,
  `email` varchar(254) DEFAULT NULL,
  `role` varchar(254) DEFAULT NULL,
  `photo` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `nom`, `prenom`, `motPasse`, `numero`, `email`, `role`, `photo`) VALUES
(6, 'Dupont', 'Jean', '$2y$10$O6zJna6lE5kHhLAKEf.dmuFDYXeBcDosR4WXOmFZH3ebnbfvrbZ42', '+237699699666', 'jean.dupont@example.com', 'encadrant', 'blog3.jpg'),
(17, 'Abondo', 'Daniel', '$2y$10$UWezkI10afkXQy3Z1Jw4xOP/sPw813b9KGkHo1W8S3CSXz2ijXqT6', '+237657822189', 'danielzklug@gmail.com', 'encadrant', NULL),
(30, 'Abondo', 'Daniel', '$2y$10$1Vc4dPW9.SZrV7mODVKdFemiT7mmG.CR4X.aAs3S8oS.ZHfCuaWcm', '+237657822189', 'danielzklug2@gmail.com', 'etudiant', NULL),
(31, 'Eyondo', 'Bertrand', '$2y$10$hhkRDsLonoOeCHr0W7fm5e/vqMl32Gd8PvhGAk6OB0b25g9xDAe5e', '+237655832639', 'ekofranky@gmail.com', 'encadrant', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`idClasse`),
  ADD KEY `classe_ibfk_1` (`Uti_idUtilisateur`,`Enc_idEncadrant`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`idCours`),
  ADD KEY `cours_ibfk_1` (`Cla_Uti_idUtilisateur`,`Enc_idEncadrant`,`Cla_idClasse`);

--
-- Index pour la table `encadrant`
--
ALTER TABLE `encadrant`
  ADD PRIMARY KEY (`idEncadrant`),
  ADD KEY `encadrant_ibfk_1` (`Uti_idUtilisateur`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`idMessage`),
  ADD KEY `message_ibfk_1` (`Uti_idUtilisateur`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`idNotification`),
  ADD KEY `notification_ibfk_1` (`Uti_idUtilisateur`);

--
-- Index pour la table `profilsocial`
--
ALTER TABLE `profilsocial`
  ADD PRIMARY KEY (`idPsocial`),
  ADD KEY `Enc_idEncadrant` (`Enc_idEncadrant`);

--
-- Index pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD PRIMARY KEY (`idStagiaire`),
  ADD KEY `stagiaire_ibfk_1` (`Cla_Uti_idUtilisateur`,`Enc_idEncadrant`,`Cla_idClasse`),
  ADD KEY `stagiaire_ibfk_2` (`Uti_idUtilisateur`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`idTache`),
  ADD KEY `tache_ibfk_1` (`Uti_idUtilisateur`),
  ADD KEY `tache_ibfk_2` (`Enc_idEncadrant`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `idClasse` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `idCours` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `encadrant`
--
ALTER TABLE `encadrant`
  MODIFY `idEncadrant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `idNotification` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `profilsocial`
--
ALTER TABLE `profilsocial`
  MODIFY `idPsocial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  MODIFY `idStagiaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `idTache` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `classe_ibfk_1` FOREIGN KEY (`Uti_idUtilisateur`,`Enc_idEncadrant`) REFERENCES `encadrant` (`Uti_idUtilisateur`, `idEncadrant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`Cla_Uti_idUtilisateur`,`Enc_idEncadrant`,`Cla_idClasse`) REFERENCES `classe` (`Uti_idUtilisateur`, `Enc_idEncadrant`, `idClasse`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `encadrant`
--
ALTER TABLE `encadrant`
  ADD CONSTRAINT `encadrant_ibfk_1` FOREIGN KEY (`Uti_idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`Uti_idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`Uti_idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `profilsocial`
--
ALTER TABLE `profilsocial`
  ADD CONSTRAINT `encadrant_idfk2` FOREIGN KEY (`Enc_idEncadrant`) REFERENCES `encadrant` (`idEncadrant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stagiaire`
--
ALTER TABLE `stagiaire`
  ADD CONSTRAINT `stagiaire_ibfk_1` FOREIGN KEY (`Cla_Uti_idUtilisateur`,`Enc_idEncadrant`,`Cla_idClasse`) REFERENCES `classe` (`Uti_idUtilisateur`, `Enc_idEncadrant`, `idClasse`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stagiaire_ibfk_2` FOREIGN KEY (`Uti_idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `tache_ibfk_1` FOREIGN KEY (`Uti_idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tache_ibfk_2` FOREIGN KEY (`Enc_idEncadrant`) REFERENCES `encadrant` (`idEncadrant`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
