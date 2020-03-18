-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 18 mars 2020 à 17:45
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `shlagithon`
--

-- --------------------------------------------------------

--
-- Structure de la table `allergen`
--

DROP TABLE IF EXISTS `allergen`;
CREATE TABLE IF NOT EXISTS `allergen` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `allergen`
--

INSERT INTO `allergen` (`a_id`, `a_label`) VALUES
(1, 'blé'),
(2, 'seigle'),
(3, 'orge'),
(4, 'avoine'),
(5, 'épeautre'),
(6, 'kamut'),
(7, 'crustacé'),
(8, 'oeuf'),
(9, 'arachide'),
(10, 'poisson'),
(11, 'soja'),
(12, 'lait'),
(13, 'amande'),
(14, 'noisette'),
(15, 'noix'),
(16, 'noix de cajou'),
(17, 'pécan'),
(18, 'macadamia'),
(19, 'pistache'),
(20, 'céleri'),
(21, 'moutare'),
(22, 'sésame'),
(23, 'sulfite'),
(24, 'lupin'),
(25, 'mollusque');

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `i_fk_requirement_id` int(11) NOT NULL,
  PRIMARY KEY (`i_fk_requirement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`i_fk_requirement_id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient_allergen`
--

DROP TABLE IF EXISTS `ingredient_allergen`;
CREATE TABLE IF NOT EXISTS `ingredient_allergen` (
  `ia_fk_ingredient_id` int(11) NOT NULL,
  `ia_fk_allergen_id` int(11) NOT NULL,
  PRIMARY KEY (`ia_fk_ingredient_id`,`ia_fk_allergen_id`),
  KEY `fk_ingredient_allergen_allergen` (`ia_fk_allergen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ingredient_allergen`
--

INSERT INTO `ingredient_allergen` (`ia_fk_ingredient_id`, `ia_fk_allergen_id`) VALUES
(1, 1),
(1, 12),
(3, 12),
(4, 8),
(5, 12),
(15, 1),
(15, 8),
(20, 12),
(27, 8),
(28, 1),
(29, 23),
(30, 1),
(35, 23),
(39, 12),
(40, 12);

-- --------------------------------------------------------

--
-- Structure de la table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `m_firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `m_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `m_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `m_type` enum('MEMBER','ADMIN') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'MEMBER',
  `m_is_confirmed` tinyint(1) NOT NULL,
  `m_creation_date` date NOT NULL,
  `m_last_connection_date` date DEFAULT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `member`
--

INSERT INTO `member` (`m_id`, `m_name`, `m_firstname`, `m_email`, `m_password`, `m_type`, `m_is_confirmed`, `m_creation_date`, `m_last_connection_date`) VALUES
(1, 'Michels', 'Paul', 'paul_michels@hotmail.fr', 'cxv262sdfs2s26df', 'ADMIN', 1, '2020-03-18', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE IF NOT EXISTS `recipe` (
  `rec_id` int(11) NOT NULL AUTO_INCREMENT,
  `rec_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rec_description` text COLLATE utf8_unicode_ci NOT NULL,
  `rec_image` blob NOT NULL,
  `rec_difficulty` enum('1','2','3','4','5') COLLATE utf8_unicode_ci NOT NULL,
  `rec_time` int(11) NOT NULL,
  `rec_nb_persons` int(11) NOT NULL,
  `rec_advice` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rec_fk_member_id` int(11) NOT NULL,
  PRIMARY KEY (`rec_id`),
  KEY `fk_recipe` (`rec_fk_member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `recipe`
--

INSERT INTO `recipe` (`rec_id`, `rec_name`, `rec_description`, `rec_image`, `rec_difficulty`, `rec_time`, `rec_nb_persons`, `rec_advice`, `rec_fk_member_id`) VALUES
(1, 'Quiche lorraine', 'La composition originale de la quiche est celle de la quiche lorraine. La quiche lorraine, de nos jours, est une tarte salée composée d\'une pâte brisée (dans l\'est-mosellan, on utilise volontiers une pâte à pain, comme pour la tarte flambée et la pizza) garnie d\'une migaine, et de lardons fumés. La migaine est constituée d\'œufs, de crème fraîche, de poivre, éventuellement du sel (pas nécessaire à cause des lardons) ; certains rajoutent un peu de muscade.\r\nOn parle maintenant de quiche vosgienne lorsque la garniture est additionnée de fromage, et de quiche alsacienne lorsqu\'elle est additionnée d\'oignons rissolés. On parle aussi de quiche pour une pâte brisée lorsque la garniture est composée de poisson (thon) avec de l’œuf, avec ou sans crème fraîche et avec une pâte feuilletée.\r\nLa quiche est une entrée tellement populaire au XXIe siècle que son nom est désormais employé à tort pour désigner des tartes garnies d\'un appareil à crème prise, salées et garnies d\'ingrédients divers.\r\nLe mot est passé dans l\'argot français pour désigner quelqu\'un de bête ou de maladroit.', '', '1', 60, 4, '', 1),
(2, 'Tomates farcies', 'Les tomates farcies sont faites de tomates farcies de viande et de riz. Les ingrédients sont de la viande hachée, du riz, de l\'oignon, du persil, de l\'huile d\'olive, de la menthe, du poivre noir et du sel.', '', '2', 50, 4, '', 1),
(3, 'Tartiflette', 'La tartiflette est une recette de cuisine inspirée de recettes traditionnelles de cuisine savoyarde, de gratin de pommes de terre, oignons, lardons, le tout gratiné au reblochon.', '', '1', 75, 4, '', 1),
(4, 'Blanquette de veau', 'La blanquette ou blanquette de veau ou blanquette de veau à l\'ancienne est une recette de cuisine traditionnelle de la cuisine française, à base de ragoût de viande de veau marinée, puis mijotée dans un court-bouillon de vin blanc, de carotte, de poireau, d\'oignon, de champignon de Paris, de bouquet garni, liée en sauce blanche à la crème et au beurre.', '', '1', 135, 4, '', 1),
(5, 'Gratin Dauphinois', 'Le gratin dauphinois ou pommes de terre à la dauphinoise est un plat gratiné traditionnel de la cuisine française, d\'origine dauphinoise, à base de pommes de terre et de lait. Ce plat est connu en Amérique du Nord comme « au gratin style potatoes » ou « pommes de terre au gratin ».', '', '2', 85, 6, '', 1),
(6, 'Lasagnes à la bolognaise', 'Les lasagnes sont des pâtes alimentaires en forme de larges plaques. Il s\'agit également de la préparation utilisant ces mêmes pâtes et généralement faite de couches alternées de pâtes, de fromage et d\'une sauce tomate avec de la viande, bien qu\'il en existe au poisson, notamment au saumon, et végétariennes.', '', '3', 125, 8, '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `recipe_member`
--

DROP TABLE IF EXISTS `recipe_member`;
CREATE TABLE IF NOT EXISTS `recipe_member` (
  `rm_fk_recipe_id` int(11) NOT NULL,
  `rm_fk_member_id` int(11) NOT NULL,
  PRIMARY KEY (`rm_fk_recipe_id`,`rm_fk_member_id`),
  KEY `fk_recipe_member_member` (`rm_fk_member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `recipe_member`
--

INSERT INTO `recipe_member` (`rm_fk_recipe_id`, `rm_fk_member_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `recipe_requirement`
--

DROP TABLE IF EXISTS `recipe_requirement`;
CREATE TABLE IF NOT EXISTS `recipe_requirement` (
  `rr_fk_recipe_id` int(11) NOT NULL,
  `rr_fk_requirement_id` int(11) NOT NULL,
  `rr_quantity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`rr_fk_recipe_id`,`rr_fk_requirement_id`),
  KEY `fk_recipe_requirement_requirement` (`rr_fk_requirement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `recipe_requirement`
--

INSERT INTO `recipe_requirement` (`rr_fk_recipe_id`, `rr_fk_requirement_id`, `rr_quantity`) VALUES
(1, 1, '200g'),
(1, 2, '200g'),
(1, 3, '30g'),
(1, 4, '3'),
(1, 5, '20cl'),
(1, 6, '20cl'),
(1, 7, ''),
(1, 8, ''),
(1, 9, ''),
(1, 41, '1'),
(1, 42, '1'),
(1, 43, '1'),
(1, 44, '1'),
(2, 6, '2 cuillères à soupe'),
(2, 10, '8'),
(2, 11, '500g'),
(2, 12, '2'),
(2, 13, '2'),
(2, 14, '2'),
(2, 15, '2'),
(2, 16, '20cl'),
(2, 17, '250g'),
(2, 41, '1'),
(2, 45, '1'),
(2, 46, '1'),
(2, 47, '1'),
(2, 48, '1'),
(2, 49, '1'),
(3, 8, ''),
(3, 9, ''),
(3, 12, '200g'),
(3, 14, '1'),
(3, 16, '2 cuillères à soupe'),
(3, 18, '1kg'),
(3, 19, '200g'),
(3, 20, '1'),
(3, 41, '1'),
(3, 43, '1'),
(3, 49, '1'),
(3, 50, '1'),
(3, 51, '1'),
(3, 52, '1'),
(3, 53, '1'),
(4, 5, '1 petit pot'),
(4, 8, ''),
(4, 9, ''),
(4, 12, '1'),
(4, 21, '1kg'),
(4, 22, '1'),
(4, 23, '1'),
(4, 24, '2'),
(4, 25, '1 petite boîte'),
(4, 26, ''),
(4, 27, '1'),
(4, 28, ''),
(4, 29, '25cl'),
(4, 43, '1'),
(4, 45, '1'),
(4, 48, '1'),
(4, 49, '1'),
(4, 54, '1'),
(4, 56, '1'),
(5, 3, '100g'),
(5, 5, '30cl'),
(5, 6, '1l'),
(5, 7, ''),
(5, 8, ''),
(5, 9, ''),
(5, 14, '2'),
(5, 18, '1.5kg'),
(5, 46, '1'),
(5, 49, '1'),
(5, 50, '1'),
(5, 53, '1'),
(6, 3, '125g'),
(6, 6, '1l'),
(6, 7, '3 pincées'),
(6, 9, ''),
(6, 12, '3'),
(6, 14, '2'),
(6, 24, '1'),
(6, 28, '100g'),
(6, 30, '1 paquet'),
(6, 31, '1'),
(6, 32, '600g'),
(6, 33, '800g'),
(6, 34, '15cl'),
(6, 35, '20cl'),
(6, 36, '2'),
(6, 37, ''),
(6, 38, ''),
(6, 39, '70g'),
(6, 40, '125'),
(6, 41, '1'),
(6, 43, '1'),
(6, 44, '1'),
(6, 45, '1'),
(6, 46, '1'),
(6, 48, '1'),
(6, 49, '1'),
(6, 51, '1'),
(6, 53, '1'),
(6, 54, '1'),
(6, 55, '1'),
(6, 57, '1');

-- --------------------------------------------------------

--
-- Structure de la table `recipe_tag`
--

DROP TABLE IF EXISTS `recipe_tag`;
CREATE TABLE IF NOT EXISTS `recipe_tag` (
  `rt_fk_recipe_id` int(11) NOT NULL,
  `rt_fk_tag_id` int(11) NOT NULL,
  PRIMARY KEY (`rt_fk_recipe_id`,`rt_fk_tag_id`),
  KEY `fk_recipe_tag_tag` (`rt_fk_tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `recipe_tag`
--

INSERT INTO `recipe_tag` (`rt_fk_recipe_id`, `rt_fk_tag_id`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2);

-- --------------------------------------------------------

--
-- Structure de la table `requirement`
--

DROP TABLE IF EXISTS `requirement`;
CREATE TABLE IF NOT EXISTS `requirement` (
  `req_id` int(11) NOT NULL AUTO_INCREMENT,
  `req_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`req_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `requirement`
--

INSERT INTO `requirement` (`req_id`, `req_name`) VALUES
(1, 'pâte brisée'),
(2, 'lardon'),
(3, 'beurre'),
(4, 'oeuf'),
(5, 'crème fraîche'),
(6, 'lait'),
(7, 'muscade'),
(8, 'sel'),
(9, 'poivre'),
(10, 'tomate'),
(11, 'chair à saucisse'),
(12, 'oignon'),
(13, 'échalote'),
(14, 'gousse d\'ail'),
(15, 'tranche de pain de mie'),
(16, 'huile d\'olive'),
(17, 'riz blanc'),
(18, 'pomme de terre'),
(19, 'lardon fumé'),
(20, 'reblochon'),
(21, 'blanquette de veau'),
(22, 'cube de bouillon de légumes'),
(23, 'bouillon de poule'),
(24, 'carotte'),
(25, 'champignon de Paris'),
(26, 'citron'),
(27, 'jaune d\'oeuf'),
(28, 'farine'),
(29, 'vin blanc'),
(30, 'pâtes de lasagnes'),
(31, 'branche de céleri'),
(32, 'viande de boeuf hachée'),
(33, 'purée de tomate'),
(34, 'eau'),
(35, 'vin rouge'),
(36, 'feuille de laurier'),
(37, 'thym'),
(38, 'basilic'),
(39, 'fromage râpé'),
(40, 'parmesan'),
(41, 'four'),
(42, 'rouleau à patisserie'),
(43, 'poêle'),
(44, 'fouet'),
(45, 'bol'),
(46, 'mixeur'),
(47, 'spatule'),
(48, 'saladier'),
(49, 'couteau'),
(50, 'économe'),
(51, 'casserole'),
(52, 'pinceau'),
(53, 'plat à gratin'),
(54, 'cuillère en bois'),
(55, 'couvercle'),
(56, 'mijoteuse crock pot'),
(57, 'râpe');

-- --------------------------------------------------------

--
-- Structure de la table `step`
--

DROP TABLE IF EXISTS `step`;
CREATE TABLE IF NOT EXISTS `step` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_description` text COLLATE utf8_unicode_ci NOT NULL,
  `s_order` int(11) NOT NULL,
  `s_fk_recipe_id` int(11) NOT NULL,
  PRIMARY KEY (`s_id`),
  KEY `fk_step` (`s_fk_recipe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `step`
--

INSERT INTO `step` (`s_id`, `s_description`, `s_order`, `s_fk_recipe_id`) VALUES
(1, 'Préchauffer le four à 180°C (thermostat 6).', 1, 1),
(2, 'Etaler la pâte dans un moule.', 2, 1),
(3, 'la piquer à la fourchette. Parsemer de copeaux de beurre.', 3, 1),
(4, 'Faire rissoler les lardons à la poêle.', 4, 1),
(5, 'Battre les oeufs, la crème fraîche et le lait.', 5, 1),
(6, 'Ajouter les lardons.', 6, 1),
(7, 'Assaisonner de sel, de poivre et de muscade.', 7, 1),
(8, 'Verser sur la pâte.', 8, 1),
(9, 'Cuire 45 à 50 min.', 9, 1),
(10, 'C\'est prêt', 10, 1),
(11, 'Déguster', 11, 1),
(12, 'Faire tremper le pain de mie dans le lait 5 min.', 1, 2),
(13, 'Placer dans le bol du Thermomix : le pain sorti du lait, 1 oignon épluché, les échalotes épluchées, la gousse d\'ail épluchée, les 2/3 des herbes lavées et un peu de sel.', 2, 2),
(14, 'Mixer 20 secondes à vitesse 8.', 3, 2),
(15, 'Ajouter la viande et mixer 20 secondes à vitesse 8.', 4, 2),
(16, 'Vérifier que la farce est homogène en allant voir au fond du bol avec une spatule. Si besoin, mixer à nouveau 10 secondes.', 5, 2),
(17, 'Couper le haut de chaque tomate et l\'évider dans un saladier (une cuillère parisienne est idéale pour ce travail, mais sinon on peut le faire avec une cuillère à café).', 6, 2),
(18, 'Mettre un peu de sel au fond des tomates et les disposer dans le plat de cuisson.', 7, 2),
(19, 'Garnir les tomates avec la farce et remettre le \"petit chapeau\" sur chacune.', 8, 2),
(20, 'Placer au four préchauffé à 180°C pendant une demi-heure environ.', 9, 2),
(21, 'Nettoyer le bol du Thermomix et placer dedans le reste des herbes, le second oignon épluché, l\'huile d\'olive et du sel.', 10, 2),
(22, 'Mixer 10 secondes à vitesse 8, puis 5 min à vitesse 4 en chauffant à 100°C.', 11, 2),
(23, 'Ajouter la chair des tomates, mixer 10 secondes à vitesse 8, puis cuire à 80°C et à vitesse 3 pendant 10 min.', 12, 2),
(24, 'Goûter (sans vous brûler !) et ajuster l\'assaisonnement si besoin.', 13, 2),
(25, 'Servir les tomates à la sortie du four, avec la sauce tomate et un riz blanc.', 14, 2),
(26, 'Eplucher les pommes de terre, les couper en dés, bien les rincer et les essuyer dans un torchon propre.', 1, 3),
(27, 'Faire chauffer l\'huile dans une poêle, y faire fondre les oignons.', 2, 3),
(28, 'Lorsque les oignons sont fondus, ajouter les pommes de terre et les faire dorer de tous les côtés.', 3, 3),
(29, 'Lorsqu\'elles sont dorées, ajouter les lardons et finir de cuire.', 4, 3),
(30, 'D\'autre part, gratter la croûte du reblochon et le couper en deux (ou en quatre).', 5, 3),
(31, 'Préchauffer le four à 200°C (thermostat 6-7) et préparer un plat à gratin en frottant le fond et les bords avec la gousse d\'ail épluchée.', 6, 3),
(32, 'Dans le plat à gratin, étaler une couche de pommes de terre aux lardons, disposer dessus la moitié du reblochon, puis de nouveau des pommes de terre. Terminer avec le reste du reblochon (croûte vers les pommes de terre).', 7, 3),
(33, 'Enfourner pour environ 20 minutes de cuisson.', 8, 3),
(34, 'Faire revenir la viande dans un peu de beurre doux jusqu\'à ce que les morceaux soient un peu dorés.', 1, 4),
(35, 'Saupoudrer de 2 cuillères de farine. Bien remuer.', 2, 4),
(36, 'Ajouter 2 ou 3 verres d\'eau, les cubes de bouillon, le vin et remuer. Ajouter de l\'eau si nécessaire pour couvrir.', 3, 4),
(37, 'Couper les carottes en rondelles et émincer les oignons puis les incorporer à la viande, ainsi que les champignons.', 4, 4),
(38, 'Laisser mijoter à feu très doux environ 1h30 à 2h00 en remuant.', 5, 4),
(39, 'Si nécessaire, ajouter de l\'eau de temps en temps.', 6, 4),
(40, 'Dans un bol, bien mélanger la crème fraîche, le jaune d’oeuf et le jus de citron. Ajouter ce mélange au dernier moment, bien remuer et servir tout de suite.', 7, 4),
(41, 'Eplucher, laver et couper les pommes de terre en rondelles fines (NB : ne pas les laver APRES les avoir coupées, car l\'amidon est nécessaire à une consistance correcte).', 1, 5),
(42, 'Hacher l\'ail très finement.\r\n', 2, 5),
(43, 'Porter à ébullition dans une casserole le lait, l\'ail, le sel, le poivre et la muscade puis y plonger les pommes de terre et laisser cuire 10 à 15 min, selon leur fermeté.', 3, 5),
(44, 'Préchauffer le four à 180°C (thermostat 6) et beurrer un plat à gratin.', 4, 5),
(45, 'Placer les pommes de terre égouttées dans le plat. Les recouvrir de crème, puis disposer des petites noix de beurre sur le dessus.', 5, 5),
(46, 'Enfourner pour 50 min à 1 heure de cuisson.', 6, 5),
(47, 'Faire revenir gousses hachées d\'ail et les oignons émincés dans un peu d\'huile d\'olive.', 1, 6),
(48, 'Ajouter la carotte et la branche de céleri hachée puis la viande et faire revenir le tout.', 2, 6),
(49, 'Au bout de quelques minutes, ajouter le vin rouge. Laisser cuire jusqu\'à évaporation.', 3, 6),
(50, 'Ajouter la purée de tomates, l\'eau et les herbes. Saler, poivrer, puis laisser mijoter à feu doux 45 minutes.', 4, 6),
(51, 'Préparer la béchamel : faire fondre le beurre.', 5, 6),
(52, 'Hors du feu, ajouter la farine d\'un coup.', 6, 6),
(53, 'Remettre sur le feu et remuer avec un fouet jusqu\'à l\'obtention d\'un mélange bien lisse.', 7, 6),
(54, 'Ajouter le lait peu à peu.', 8, 6),
(55, 'Remuer sans cesse, jusqu\'à ce que le mélange s\'épaississe.', 9, 6),
(56, 'Ensuite, parfumer avec la muscade, saler, poivrer. Laisser cuire environ 5 minutes, à feu très doux, en remuant. Réserver.', 10, 6),
(57, 'Préchauffer le four à 200°C (thermostat 6-7). Huiler le plat à lasagnes. Poser une fine couche de béchamel puis des feuilles de lasagnes, de la bolognaise, de la béchamel et du parmesan. Répéter l\'opération 3 fois de suite.', 11, 6),
(58, 'Sur la dernière couche de lasagnes, ne mettre que de la béchamel et recouvrir de fromage râpé. Parsemer quelques noisettes de beurre.', 12, 6),
(59, 'Enfourner pour environ 25 minutes de cuisson.', 13, 6),
(60, 'Déguster', 14, 6);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`t_id`, `t_label`) VALUES
(1, 'entrée'),
(2, 'plat'),
(3, 'dessert'),
(4, 'amuse bouche'),
(5, 'sauce'),
(6, 'accompagnement'),
(7, 'boisson'),
(8, 'hiver'),
(9, 'printemps'),
(10, 'autonme'),
(11, 'été');

-- --------------------------------------------------------

--
-- Structure de la table `ustencil`
--

DROP TABLE IF EXISTS `ustencil`;
CREATE TABLE IF NOT EXISTS `ustencil` (
  `u_fk_requirement_id` int(11) NOT NULL,
  PRIMARY KEY (`u_fk_requirement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ustencil`
--

INSERT INTO `ustencil` (`u_fk_requirement_id`) VALUES
(41),
(42),
(43),
(44),
(45),
(46),
(47),
(48),
(49),
(50),
(51),
(52),
(53),
(54),
(55),
(56),
(57);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `fk_ingredient` FOREIGN KEY (`i_fk_requirement_id`) REFERENCES `requirement` (`req_id`);

--
-- Contraintes pour la table `ingredient_allergen`
--
ALTER TABLE `ingredient_allergen`
  ADD CONSTRAINT `fk_ingredient_allergen_allergen` FOREIGN KEY (`ia_fk_allergen_id`) REFERENCES `allergen` (`a_id`),
  ADD CONSTRAINT `fk_ingredient_allergen_ingredient` FOREIGN KEY (`ia_fk_ingredient_id`) REFERENCES `ingredient` (`i_fk_requirement_id`);

--
-- Contraintes pour la table `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `fk_recipe` FOREIGN KEY (`rec_fk_member_id`) REFERENCES `member` (`m_id`);

--
-- Contraintes pour la table `recipe_member`
--
ALTER TABLE `recipe_member`
  ADD CONSTRAINT `fk_recipe_member_member` FOREIGN KEY (`rm_fk_member_id`) REFERENCES `member` (`m_id`),
  ADD CONSTRAINT `fk_recipe_member_recipe` FOREIGN KEY (`rm_fk_recipe_id`) REFERENCES `recipe` (`rec_id`);

--
-- Contraintes pour la table `recipe_requirement`
--
ALTER TABLE `recipe_requirement`
  ADD CONSTRAINT `fk_recipe_requirement_recipe` FOREIGN KEY (`rr_fk_recipe_id`) REFERENCES `recipe` (`rec_id`),
  ADD CONSTRAINT `fk_recipe_requirement_requirement` FOREIGN KEY (`rr_fk_requirement_id`) REFERENCES `requirement` (`req_id`);

--
-- Contraintes pour la table `recipe_tag`
--
ALTER TABLE `recipe_tag`
  ADD CONSTRAINT `fk_recipe_tag_recipe` FOREIGN KEY (`rt_fk_recipe_id`) REFERENCES `recipe` (`rec_id`),
  ADD CONSTRAINT `fk_recipe_tag_tag` FOREIGN KEY (`rt_fk_tag_id`) REFERENCES `tag` (`t_id`);

--
-- Contraintes pour la table `step`
--
ALTER TABLE `step`
  ADD CONSTRAINT `fk_step` FOREIGN KEY (`s_fk_recipe_id`) REFERENCES `recipe` (`rec_id`);

--
-- Contraintes pour la table `ustencil`
--
ALTER TABLE `ustencil`
  ADD CONSTRAINT `fk_ustencil` FOREIGN KEY (`u_fk_requirement_id`) REFERENCES `requirement` (`req_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
