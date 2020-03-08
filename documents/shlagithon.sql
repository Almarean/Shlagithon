SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP SCHEMA IF EXISTS `shlagithon`;
CREATE SCHEMA IF NOT EXISTS `shlagithon`;

USE `shlagithon`;

DROP TABLE IF EXISTS `requirement`;
CREATE TABLE IF NOT EXISTS `requirement` (
    `req_id` int(11) NOT NULL AUTO_INCREMENT,
    `req_name` varchar(255) NOT NULL,
    PRIMARY KEY (`req_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `ustencil`;
CREATE TABLE IF NOT EXISTS `ustencil` (
    `u_fk_requirement_id` int(11) NOT NULL,
    PRIMARY KEY( `u_fk_requirement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
    `i_fk_requirement_id` int(11) NOT NULL,
    PRIMARY KEY (`i_fk_requirement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
    `m_id` int(11) NOT NULL AUTO_INCREMENT,
    `m_name` varchar(255) NOT NULL,
    `m_firstname` varchar(255) NOT NULL,
    `m_email` varchar(255) NOT NULL,
    `m_password` varchar(255) NOT NULL,
    `m_type` ENUM('MEMBER', 'ADMIN') NOT NULL DEFAULT 'MEMBER',
    `m_is_confirmed` boolean NOT NULL,
    `m_creation_date` date NOT NULL,
    `m_last_connection_date` date NULL,
    PRIMARY KEY (`m_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `recipe`;
CREATE TABLE IF NOT EXISTS `recipe` (
    `rec_id` int(11) NOT NULL AUTO_INCREMENT,
    `rec_name` varchar(255) NOT NULL,
    `rec_description` text NOT NULL,
    `rec_image` BLOB NOT NULL,
    `rec_difficulty` ENUM('1', '2', '3', '4', '5') NOT NULL,
    `rec_time` int(11) NOT NULL,
    `rec_nb_persons` int(11) NOT NULL,
    `rec_advice` text NULL,
    `rec_fk_member_id` int(11) NOT NULL,
    PRIMARY KEY (`rec_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `recipe_requirement`;
CREATE TABLE IF NOT EXISTS `recipe_requirement` (
    `rr_fk_recipe_id` int(11) NOT NULL,
    `rr_fk_requirement_id` int(11) NOT NULL,
    `rr_quantity` int(11) NOT NULL,
    PRIMARY KEY (`rr_fk_recipe_id`, `rr_fk_requirement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `recipe_member`;
CREATE TABLE IF NOT EXISTS `recipe_member` (
    `rm_fk_recipe_id` int(11) NOT NULL,
    `rm_fk_member_id` int(11) NOT NULL,
    PRIMARY KEY(`rm_fk_recipe_id`, `rm_fk_member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `step`;
CREATE TABLE IF NOT EXISTS `step` (
    `s_id` int(11) NOT NULL AUTO_INCREMENT,
    `s_description` text NOT NULL,
    `s_order` int(11) NOT NULL,
    `s_fk_recipe_id` int(11) NOT NULL,
    PRIMARY KEY(`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
    `t_id` int(11) NOT NULL AUTO_INCREMENT,
    `t_name` varchar(255) NOT NULL,
    PRIMARY KEY(`t_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `recipe_tag`;
CREATE TABLE IF NOT EXISTS `recipe_tag` (
    `rt_fk_recipe_id` int(11) NOT NULL,
    `rt_fk_tag_id` int(11) NOT NULL,
    PRIMARY KEY(`rt_fk_recipe_id`, `rt_fk_tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `allergen`;
CREATE TABLE IF NOT EXISTS `allergen` (
    `a_id` int(11) NOT NULL AUTO_INCREMENT,
    `a_name` varchar(255) NOT NULL,
    PRIMARY KEY(`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `ingredient_allergen`;
CREATE TABLE IF NOT EXISTS `ingredient_allergen` (
    `ia_fk_ingredient_id` int(11) NOT NULL,
    `ia_fk_allergen_id` int(11) NOT NULL,
    PRIMARY KEY(`ia_fk_ingredient_id`, `ia_fk_allergen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `ustencil` ADD CONSTRAINT `fk_ustencil` FOREIGN KEY (`u_fk_requirement_id`) REFERENCES `requirement`(`req_id`);
ALTER TABLE `ingredient` ADD CONSTRAINT `fk_ingredient` FOREIGN KEY (`i_fk_requirement_id`) REFERENCES `requirement`(`req_id`);
ALTER TABLE `ingredient_allergen` ADD CONSTRAINT `fk_ingredient_allergen_allergen` FOREIGN KEY (`ia_fk_allergen_id`) REFERENCES `allergen`(`a_id`);
ALTER TABLE `ingredient_allergen` ADD CONSTRAINT `fk_ingredient_allergen_ingredient` FOREIGN KEY (`ia_fk_ingredient_id`) REFERENCES `ingredient`(`i_fk_requirement_id`);
ALTER TABLE `recipe_requirement` ADD CONSTRAINT `fk_recipe_requirement_requirement` FOREIGN KEY (`rr_fk_requirement_id`) REFERENCES `requirement`(`req_id`);
ALTER TABLE `recipe_requirement` ADD CONSTRAINT `fk_recipe_requirement_recipe` FOREIGN KEY (`rr_fk_recipe_id`) REFERENCES `recipe`(`rec_id`);
ALTER TABLE `step` ADD CONSTRAINT `fk_step` FOREIGN KEY (`s_fk_recipe_id`) REFERENCES `recipe`(`rec_id`);
ALTER TABLE `recipe_tag` ADD CONSTRAINT `fk_recipe_tag_tag` FOREIGN KEY (`rt_fk_tag_id`) REFERENCES `tag`(`t_id`);
ALTER TABLE `recipe_tag` ADD CONSTRAINT `fk_recipe_tag_recipe` FOREIGN KEY (`rt_fk_recipe_id`) REFERENCES `recipe`(`rec_id`);
ALTER TABLE `recipe` ADD CONSTRAINT `fk_recipe` FOREIGN KEY (`rec_fk_member_id`) REFERENCES `member`(`m_id`);
ALTER TABLE `recipe_member` ADD CONSTRAINT `fk_recipe_member_recipe` FOREIGN KEY (`rm_fk_recipe_id`) REFERENCES `recipe`(`rec_id`);
ALTER TABLE `recipe_member` ADD CONSTRAINT `fk_recipe_member_member` FOREIGN KEY (`rm_fk_member_id`) REFERENCES `member`(`m_id`);