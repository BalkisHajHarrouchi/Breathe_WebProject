-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 13 mai 2023 à 00:40
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `blogs`
--

CREATE TABLE `blogs` (
  `idBlog` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `source` varchar(100) NOT NULL,
  `contenu` varchar(500) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `blogs`
--

INSERT INTO `blogs` (`idBlog`, `titre`, `source`, `contenu`, `categorie`, `image`) VALUES
(37, 'earth', 'internet', '                                   According to botanist and medical biochemist, Diana Beresford-Kroeger, taking a walk in an evergreen forest exposes our mind and body to aerosols that travel deep into our lungs where they are readily absorbed.             ', 'garden', 0x617274332e706e67),
(40, 'waste', 'book', '                                Striving for a Zero Waste holiday season means thinking carefully about what we give and receive, along with choosing purchases that are useful, long lasting, and compostable or recyclable.\r\n\r\nThe following gifts help their users achieve less waste by displacing plastic and disposable alternatives. They also help streamline what we tend to accumulate by having a practical, everyday purpose.', 'ecology', 0x617274392e504e47),
(41, 'trees', 'internet', '                                Thinning the small fruit clusters in a fruit tree is a rite of spring for orchardists and homeowners with backyard fruit trees. But with the busy schedules gardeners have in the spring, it’s easy to overlook fruit thinning until it’s too late.', 'garden', 0x617274362e504e47),
(42, 'backyard', 'internet', 'By now most of your garden vegetables should be well established, with strong roots and a flush of early season growth. To keep things growing strong, it’s important to add a dose of organic fertilizer to give plants what they need for the long haul', 'garden', 0x617274352e504e47),
(43, 'gifts', 'internet', 'It’s that time of year again, when the sustainably-minded try to balance out a desire to give with the rampant consumerism of the holiday season. Not only are the following homemade gifts sustainable, your handiwork adds a valued personal touch', 'ecology', 0x61727431302e504e47),
(53, 'jhekej', 'ihele', '            Striving for a Zero Waste holiday season means thinking carefully about what we give and receive, along with choosing purchases that are useful, long lasting, and compostable or recyclable. The following gifts help their users achieve less waste by displacing plastic and disposable alternatives. They also help streamline what we tend to accumulate by having a practical, everyday purpose             ', 'plants', '');

-- --------------------------------------------------------

--
-- Structure de la table `categrecyclages`
--

CREATE TABLE `categrecyclages` (
  `idCateg_re` int(11) NOT NULL,
  `nomCateg` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `nbr_demande` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categrecyclages`
--

INSERT INTO `categrecyclages` (`idCateg_re`, `nomCateg`, `description`, `nbr_demande`, `image`) VALUES
(20, 'Plastique', 'new categorie', 21, 'img2.jpg'),
(21, 'Bout de cigarette', 'New categorie', 6, 'img1.jpg'),
(26, 'plastique_organique', 'new categorie', 7, 'img4.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `categshops`
--

CREATE TABLE `categshops` (
  `idCtegorie` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `nom_cles` varchar(30) NOT NULL,
  `marque` varchar(30) NOT NULL,
  `budget` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categshops`
--

INSERT INTO `categshops` (`idCtegorie`, `description`, `nom_cles`, `marque`, `budget`) VALUES
(5, 'Rose', 'flowers', 'eco', 150),
(21, 'masque', 'masque', 'eco', 548),
(22, 'cloths', 'cloths', 'eco', 540),
(33, 'bebe', 'roses', 'naturel', 9000);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `idCommentaire` int(11) NOT NULL,
  `idBlog` int(11) NOT NULL,
  `contenu` varchar(100) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idSession` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`idCommentaire`, `idBlog`, `contenu`, `idUser`, `idSession`) VALUES
(113, 37, 'bood job', 0, 0),
(114, 37, '                          ****** this works      ', 0, 131),
(115, 37, '                nice this is detailed', 0, 131),
(116, 37, '         ****** works well                       ', 0, 131),
(120, 37, '                                ****** yyyyyy', 0, 165),
(122, 37, '                JKLEJ;LEJELJELE.', 0, 158),
(124, 37, 'updated successefuly', 0, 186),
(132, 41, '                                waw i like it', 0, 157),
(133, 40, '                        **** this is epic        ', 0, 160);

-- --------------------------------------------------------

--
-- Structure de la table `demande_recyclage`
--

CREATE TABLE `demande_recyclage` (
  `id_recy` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `quantite` float NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_recy` date NOT NULL,
  `idCateg_re` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `demande_recyclage`
--

INSERT INTO `demande_recyclage` (`id_recy`, `type`, `quantite`, `email`, `date_recy`, `idCateg_re`) VALUES
(92, 'Pile', 8, 'amamiaboubaker@gmail.com', '2023-06-06', 20),
(96, 'Fer', 8, 'zeineb.boussaidi@esprit.tn', '2023-05-14', 20),
(97, 'Fer', 8, 'zeineb.boussaidi@esprit.tn', '2023-05-12', 20),
(98, 'Fer', 8, 'zeineb.boussaidi@esprit.tn', '2023-05-12', 20),
(99, 'Verre', 6, 'zeineb.boussaidi@esprit.tn', '2023-05-12', 20),
(101, 'Plastique', 6, 'balkis.hajharrouchi@esprit.tn', '2023-05-27', 20);

-- --------------------------------------------------------

--
-- Structure de la table `dislikes`
--

CREATE TABLE `dislikes` (
  `idDislike` int(11) NOT NULL,
  `idBlog` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `dislikes`
--

INSERT INTO `dislikes` (`idDislike`, `idBlog`, `idUser`) VALUES
(6, 37, 157),
(7, 40, 160);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `idEvent` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `dateEventStart` datetime NOT NULL,
  `dateEventEnd` datetime NOT NULL,
  `lieu` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `nbPlaces` int(11) NOT NULL,
  `image` longblob NOT NULL,
  `prixEvent` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`idEvent`, `nom`, `type`, `dateEventStart`, `dateEventEnd`, `lieu`, `description`, `nbPlaces`, `image`, `prixEvent`) VALUES
(66, 'AgriPlus', 'Agriculture', '2023-04-30 17:20:00', '2023-04-30 20:15:00', 'garden', 'farmers and nature lovers will profit from discounts', 8, 0x6576332e706e67, 10),
(67, 'CleanPlus', 'Cleaning', '2023-05-08 14:15:00', '2023-05-09 15:16:00', 'Public station', 'with our collaborative work we\'ll clean the city', 6, 0x6576312e706e67, 0),
(84, 'collectos', 'Donation', '2023-05-05 00:00:00', '2023-05-06 05:05:00', 'jardin', 'kkkkkkkkkk', 15, 0x426c756520496c6c75737472617465642043686172697479204576656e7420506f737465722e706e67, 0),
(93, 'ZAnimo', 'Animals', '2023-05-14 13:30:00', '2023-05-05 10:35:00', 'jardin publique', 'for all pet lovers stay tuned!', 4, 0x4d756c7469636f6c6f722042726967687420416e696d616c2043686172697469657320506f737465722e706e67, 0),
(96, 'Campyx', 'Entertainment', '2023-05-15 18:00:00', '2023-05-07 16:58:16', 'forest', 'a great opportunity to explore and have fun in the open nature', 10, 0x496c6c757374726174697665204d696e696d616c2043616d70696e6720466573746976616c20506f737465722e706e67, 25),
(99, 'courseValidation', 'Sports', '2023-05-12 10:04:00', '2023-05-12 10:08:00', 'jardin', 'welcome everyone', 5, 0x6576352e706e67, 0);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `idLike` int(11) NOT NULL,
  `idBlog` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`idLike`, `idBlog`, `idUser`) VALUES
(10, 27, 157),
(13, 40, 157),
(14, 41, 157),
(15, 41, 159);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `idProduit` int(11) NOT NULL,
  `nomproduit` varchar(255) NOT NULL,
  `typeprod` varchar(255) NOT NULL,
  `prix` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `codeBarre` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `image` blob NOT NULL,
  `idCtegorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`idProduit`, `nomproduit`, `typeprod`, `prix`, `stock`, `codeBarre`, `status`, `image`, `idCtegorie`) VALUES
(172, 'rose', 'new', 156, 14, 4587, 'sold out', 0x726f73652e6a7067, 5),
(173, 'white daisy', 'new', 98, 4, 5648, 'in stock', 0x77686974655f646169736965732e6a7067, 5),
(174, 'face masque', 'new', 123, 50, 8854, 'in stock', 0x66616365206d75736b2e6a7067, 21),
(175, 'pull', 'eco', 123, 23, 2278, 'in stock', 0x636c6f74682e6a7067, 22),
(176, 'economic bags', 'eco', 100, 200, 1133, 'in stock', 0x626167732e6a7067, 21),
(177, 'lavander', 'flower', 149, 30, 5578, 'in stock', 0x6c6176616e6465722e6a7067, 5),
(178, 'pink lilies', 'flower', 160, 12, 8845, 'in stock', 0x70696e6b206c696c6965732e6a706567, 5),
(179, 'blue moon rose', 'flower', 456, 70, 5512, 'in stock', 0x526f73655f426c75655f4d6f6f6e2e6a7067, 5),
(180, 'tulip', 'flower', 120, 50, 5523, 'sold out', 0x74756c69702e6a7067, 5),
(182, 'Linen cloths', 'eco', 399, 20, 1130, 'in stock', 0x4c696e656e636c6f7468732e6a7067, 22),
(184, 'Bamboo cloths ', 'eco', 114, 30, 9574, 'in stock', 0x42616d626f6f636c6f7468732e6a7067, 22),
(185, 'Plantbased face masks', 'eco', 140, 200, 3365, 'in stock', 0x506c616e742d6261736564666163656d61736b732e6a7067, 21),
(186, 'Biodegradable face masks', 'eco', 130, 200, 2213, 'sold out', 0x42696f64656772616461626c65666163656d61736b732e6a7067, 21),
(187, 'Linen face masks', 'new', 654, 200, 3325, 'sold out', 0x4c696e656e666163656d61736b732e6a7067, 21);

-- --------------------------------------------------------

--
-- Structure de la table `tickets`
--

CREATE TABLE `tickets` (
  `idTicket` int(11) NOT NULL,
  `idEvent` int(11) NOT NULL,
  `dateTicketExp` date NOT NULL,
  `vendu` tinyint(1) NOT NULL,
  `codeTicket` longblob NOT NULL,
  `detailTicket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tickets`
--

INSERT INTO `tickets` (`idTicket`, `idEvent`, `dateTicketExp`, `vendu`, `codeTicket`, `detailTicket`) VALUES
(765, 96, '2023-05-14', 0, 0x39362d43616d7079782d323032332d30352d313442524541544845, 'sos'),
(766, 96, '2023-05-14', 0, 0x39362d43616d7079782d323032332d30352d313442524541544845, 'sos'),
(767, 96, '2023-05-14', 0, 0x39362d43616d7079782d323032332d30352d313442524541544845, 'sos'),
(768, 96, '2023-05-14', 0, 0x39362d43616d7079782d323032332d30352d313442524541544845, 'sos'),
(769, 96, '2023-05-14', 0, 0x39362d43616d7079782d323032332d30352d313442524541544845, 'sos'),
(770, 96, '2023-05-14', 0, 0x39362d43616d7079782d323032332d30352d313442524541544845, 'sos'),
(771, 96, '2023-05-14', 0, 0x39362d43616d7079782d323032332d30352d313442524541544845, 'sos'),
(772, 96, '2023-05-14', 0, 0x39362d43616d7079782d323032332d30352d313442524541544845, 'sos'),
(773, 96, '2023-05-14', 0, 0x39362d43616d7079782d323032332d30352d313442524541544845, 'sos'),
(774, 96, '2023-05-14', 0, 0x39362d43616d7079782d323032332d30352d313442524541544845, 'sos'),
(782, 99, '2023-05-21', 1, 0x39392d636f7572736556616c69646174696f6e2d323032332d30352d323142524541544845, 'test'),
(783, 99, '2023-05-21', 1, 0x39392d636f7572736556616c69646174696f6e2d323032332d30352d323142524541544845, 'test'),
(784, 99, '2023-05-21', 0, 0x39392d636f7572736556616c69646174696f6e2d323032332d30352d323142524541544845, 'test'),
(785, 99, '2023-05-21', 0, 0x39392d636f7572736556616c69646174696f6e2d323032332d30352d323142524541544845, 'test'),
(786, 99, '2023-05-21', 0, 0x39392d636f7572736556616c69646174696f6e2d323032332d30352d323142524541544845, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `google_id` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `verification_token` varchar(64) DEFAULT NULL,
  `verified` tinyint(1) DEFAULT 0,
  `reset_token` varchar(255) NOT NULL,
  `reset_expiry` datetime DEFAULT NULL,
  `blocked` tinyint(1) DEFAULT 0,
  `blocked_until` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `google_id`, `firstname`, `lastname`, `dob`, `email`, `password`, `role`, `verification_token`, `verified`, `reset_token`, `reset_expiry`, `blocked`, `blocked_until`) VALUES
(157, '', 'balkis', 'haj harrouchi', '2003-03-05', 'balkis.hajharrouchi@esprit.tn', '$2y$10$uqnDfmPLDR5LP6nJTrbiRuFR99oja4zLBdvGjNxh6cCKXYUYESFDe', 'admin', '', 1, '', NULL, 0, NULL),
(158, '100595668641762477098', 'BEmo', 'Eats', NULL, 'bemoeats@gmail.com', '', 'user', NULL, 0, '', NULL, 0, NULL),
(160, '', 'zeineb', 'boussaida', '2023-05-10', 'zeineb.boussaidi@esprit.tn', '$2y$10$WgWH1o4Il1XJaQDZbsjv0uXcBgBm.8URMQ0Pm38j0vO6d/hG17pHC', 'user', '', 1, '', NULL, 0, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`idBlog`);

--
-- Index pour la table `categrecyclages`
--
ALTER TABLE `categrecyclages`
  ADD PRIMARY KEY (`idCateg_re`);

--
-- Index pour la table `categshops`
--
ALTER TABLE `categshops`
  ADD PRIMARY KEY (`idCtegorie`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`idCommentaire`),
  ADD KEY `fk_blog_cmnt` (`idBlog`);

--
-- Index pour la table `demande_recyclage`
--
ALTER TABLE `demande_recyclage`
  ADD PRIMARY KEY (`id_recy`),
  ADD KEY `fk_cagtREC` (`idCateg_re`);

--
-- Index pour la table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`idDislike`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`idEvent`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`idLike`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`idProduit`),
  ADD KEY `fk_prod_cteg` (`idCtegorie`);

--
-- Index pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`idTicket`),
  ADD KEY `fk_event_ticket` (`idEvent`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `idBlog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pour la table `categrecyclages`
--
ALTER TABLE `categrecyclages`
  MODIFY `idCateg_re` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `categshops`
--
ALTER TABLE `categshops`
  MODIFY `idCtegorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `idCommentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT pour la table `demande_recyclage`
--
ALTER TABLE `demande_recyclage`
  MODIFY `id_recy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT pour la table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `idDislike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `idEvent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `idLike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `idProduit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT pour la table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `idTicket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=787;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `fk_blog_cmnt` FOREIGN KEY (`idBlog`) REFERENCES `blogs` (`idBlog`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `demande_recyclage`
--
ALTER TABLE `demande_recyclage`
  ADD CONSTRAINT `fk_cagtREC` FOREIGN KEY (`idCateg_re`) REFERENCES `categrecyclages` (`idCateg_re`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `fk_prod_cteg` FOREIGN KEY (`idCtegorie`) REFERENCES `categshops` (`idCtegorie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_event_ticket` FOREIGN KEY (`idEvent`) REFERENCES `events` (`idEvent`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
