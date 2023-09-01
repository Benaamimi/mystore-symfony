-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 01 sep. 2023 à 16:36
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecommerce_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230829114702', '2023-08-29 11:47:19', 90),
('DoctrineMigrations\\Version20230830074552', '2023-08-30 07:46:02', 34),
('DoctrineMigrations\\Version20230830091420', '2023-08-30 09:14:25', 26),
('DoctrineMigrations\\Version20230831114325', '2023-08-31 11:43:43', 108),
('DoctrineMigrations\\Version20230831132452', '2023-08-31 13:25:00', 27);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `users_id`, `products_id`, `quantity`, `total_price`, `created_at`) VALUES
(63, 1, 1, 1, 20, '2023-09-01 13:02:18'),
(66, 5, 3, 1, 30, '2023-09-01 13:03:17'),
(67, 5, 4, 3, 25, '2023-09-01 13:03:17'),
(68, 5, 1, 1, 20, '2023-09-01 13:03:17'),
(69, 2, 1, 1, 20, '2023-09-01 13:03:39'),
(70, 1, 1, 1, 20, '2023-09-01 13:07:07'),
(71, 1, 3, 1, 30, '2023-09-01 13:07:07');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `color` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `collection` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `title`, `description`, `color`, `size`, `collection`, `image`, `price`, `stock`, `created_at`) VALUES
(1, 'Chemise', 'Chemise cotton grise', 'gris', 'M', 'Men', 'img/chemise.png', 20, 200, '2023-08-29 13:42:58'),
(3, 'Pull', 'Pull 100% cotton', 'blanc et noir', 'XL', 'Women', 'img/pull.png', 30, 100, '2023-08-29 20:07:04'),
(4, 'T-shrit', 'Matière confortable cotton d\'Egipte', 'bleue', 'M', 'Men', 'img/t-shirt.png', 25, 350, '2023-08-31 09:44:24'),
(5, 'Robe', 'Robe longue', 'Crème', 'M', 'Women', 'img/robe.png', 60, 320, '2023-09-01 14:26:46');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `pseudo` varchar(20) DEFAULT NULL,
  `gender` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `full_name`, `email`, `roles`, `password`, `pseudo`, `gender`, `created_at`) VALUES
(1, 'Admin', 'admin@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$neRxA6034KimhuGivyyxgOU946831avtNRR9Xdz82brQU2Q.9kCJ.', 'Admin', 'Women', '2023-08-30 09:02:32'),
(2, 'BENAAMIMI Tarik', 'tarik@tarik.com', '[\"ROLE_ADMIN\"]', '$2y$13$2jOw6Ru2QAaEqTEGK327QeOXr1OEtAS.urc3JvjTgAqppXcYoHSaq', 'Tarik_B', 'Men', '2023-08-30 09:14:31'),
(5, 'TATA', 'tatahoo@gmail.com', '[]', '$2y$13$rq/WzcL/NLVHOUXNfVk5juqTZNDWg50TVI97XXMWdHkcfqnSz9wfW', 'Hoo', 'Women', '2023-09-01 07:34:57');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E52FFDEE67B3B43D` (`users_id`),
  ADD KEY `IDX_E52FFDEE6C8A81A9` (`products_id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_E52FFDEE67B3B43D` FOREIGN KEY (`users_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_E52FFDEE6C8A81A9` FOREIGN KEY (`products_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
