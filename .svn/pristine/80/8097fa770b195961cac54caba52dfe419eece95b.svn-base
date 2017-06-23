SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `my_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `my_db`;

DROP TABLE IF EXISTS `email`;
CREATE TABLE IF NOT EXISTS `email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

TRUNCATE TABLE `email`;
INSERT INTO `email` (`id`, `person_id`, `email_address`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 32, 'anjana@millertech.co.uk', NULL, NULL, NULL, NULL),
(2, 1, 'samir@millertech.co.uk', NULL, NULL, NULL, NULL);


DROP TABLE IF EXISTS `fos_group`;
CREATE TABLE IF NOT EXISTS `fos_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `roles` longtext COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

TRUNCATE TABLE `fos_group`;
INSERT INTO `fos_group` (`id`, `name`, `roles`) VALUES
(1, 'Administrators', 'a:1:{i:0;s:10:"ROLE_ADMIN";}'),
(2, 'Merlin Users', 'a:1:{i:0;s:16:"ROLE_MERLIN_USER";}');

DROP TABLE IF EXISTS `fos_user`;
CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `username_canonical` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_canonical` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

TRUNCATE TABLE `fos_user`;
INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(41, 'anjana', 'anjana', 'anjana@millertech.co.uk', 'anjana@millertech.co.uk', 1, 'mhq5fvto88goggs4sww8ko0swc0kk04', 'R71eTnr2Vu9IaQgPcFPf4psn7/zJCGSfBOIsN/2g1Lq1kiZnLHy5fEUSBucrHC/3SlbmDofXk1nlRgZazZvftg==', '2016-11-15 11:39:34', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:9:"ROLE_USER";}', 0, NULL),
(50, 'ramesht', 'ramesht', 'anjana@millertech.co.uk', 'anjana@millertech.co.uk', 1, 'u75i2i2t1k0g08ockgc4c4kso0c0cs', '/iiAX6LPmEttIxdOcR57f/s5ibs2J4bMx22omoweVJ/cdbyrrgb5GPqr36wuRI8ybJmCnPRGOQVuoY4ybVChng==', '2016-11-14 15:22:31', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:9:"ROLE_USER";}', 0, NULL),
(51, 'testuser1', 'testuser1', 'anjana@millertech.co.uk', 'anjana@millertech.co.uk', 1, 'g1g6x1gp85ws8owwk48ggkkcgook0w0', 'QSmUCTAXTDLCAp0xCj4dqHqrnJsa/8aHLp9wKi5ii7CgicgWXxMXdkiE6yOs3EMspiFE/XofFRnrkL/rzDPSIg==', '2016-11-14 15:12:30', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:9:"ROLE_USER";}', 0, NULL),
(54, 'anjanasilva1', 'anjanasilva1', 'anjana@millertech.co.uk', 'anjana@millertech.co.uk', 1, '8pt48vv8cuww8c8808ckk0c400kw44g', 'X2LzW2Tn1LcjJvHHyZ17fJezmmf2+jyPnZqN3l/BvrYfMQZO7BxN4Na1AvjxB8YB2o2D0y8mWHJF3A2/PYxHyw==', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:9:"ROLE_USER";}', 0, NULL),
(55, 'anotheruser', 'anotheruser', 'anjana@millertech.co.uk', 'anjana@millertech.co.uk', 1, '3xwfydckh2iogcw00kkco0wow4o8kk4', 'ecLywTGuM0M6ntE6vfE7qTC6S4qMaopDwgZRgchz1pXxJhifUTRJw7F2aIUxbdHv+yVRDBJ+sY1y5H4tShW/uw==', NULL, 0, 0, NULL, 'f0619b13ed9b60e0fe232038631b859a', NULL, 'a:1:{i:0;s:9:"ROLE_USER";}', 0, NULL),
(56, 'anjanasilva2', 'anjanasilva2', 'anjana@millertech.co.uk', 'anjana@millertech.co.uk', 1, 'nwam29lni34cssk8w0osgckc80ww0so', 'XWEEYrrHPw9MYQNtjWnvWIP0ZL9CYj9ootZddvt8YRx3QPylVycOgNINUn3Eyr9139R9CeDzMkPqElleDpZ8QA==', NULL, 0, 0, NULL, '2a244bc56f58997563e7d9a33c60dc2c', NULL, 'a:1:{i:0;s:9:"ROLE_USER";}', 0, NULL),
(57, 'anjanasilva3', 'anjanasilva3', 'anjana@millertech.co.uk', 'anjana@millertech.co.uk', 0, '2tjz9kr7ix6o8s44cssk04gskso4gks', '+CKEMLXI1ZBQtIJ9EVikURkrx0lSILQnj6nIRHvYTcf0gqk05JwbF32WzlxYADqadmkYY5F1FOfQZf9DFN8y/w==', NULL, 0, 0, NULL, 'a6d56fc8222cbd353eedd2907c889906', NULL, 'a:1:{i:0;s:9:"ROLE_USER";}', 0, NULL),
(58, 'testuser2', 'testuser2', 'anjana@millertech.co.uk', 'anjana@millertech.co.uk', 1, 'rh3geeobyogcsscwkk4w44gckc4o4sg', 'mtxI9OXpNdc2riMe3XS6Vq6UzsD7YJPPcRZzimBeF3pMkHYxCHagfMOmEGfxyDFHEKF7f28/398fj1bm47oaeg==', NULL, 0, 0, NULL, '8e9ddc3e38f8112a44eb7e1cac8e100e', NULL, 'a:1:{i:0;s:9:"ROLE_USER";}', 0, NULL),
(59, 'testuser3', 'testuser3', 'anjana@millertech.co.uk', 'anjana@millertech.co.uk', 1, 'tdx30q21apcskg44c4kg0sg8s8kc4k0', '8OasB3totmBVd9vs531Pl9Ecp14cvADo8LIshE33ghjBg4PonSg3Fg3XdrW/qc9EwO8be9xBxsnCucN+J4lE5A==', NULL, 0, 0, NULL, '3c32e440f20289157e1a7ec29094b543', NULL, 'a:1:{i:0;s:9:"ROLE_USER";}', 0, NULL);

DROP TABLE IF EXISTS `fos_user_group`;
CREATE TABLE IF NOT EXISTS `fos_user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `fk_fos_user_group_fos_user1_idx` (`user_id`),
  KEY `fk_fos_user_group_fos_group1_idx` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE TABLE `fos_user_group`;
INSERT INTO `fos_user_group` (`user_id`, `group_id`) VALUES
(41, 1),
(50, 1),
(51, 2),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 2),
(59, 2);

DROP TABLE IF EXISTS `media_store`;
CREATE TABLE IF NOT EXISTS `media_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_type_id` int(11) NOT NULL,
  `file_size` int(11) NOT NULL,
  `file_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `file_extension` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `content` longblob NOT NULL,
  `entity_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entity_id` int(11) NOT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `dpi` int(11) DEFAULT NULL,
  `temp_token` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E04E9CC6A49B0ADA` (`media_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

TRUNCATE TABLE `media_store`;
DROP TABLE IF EXISTS `media_type`;
CREATE TABLE IF NOT EXISTS `media_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

TRUNCATE TABLE `media_type`;
INSERT INTO `media_type` (`id`, `name`, `mime_type`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'CSV', 'text/csv', NULL, NULL, NULL, NULL);

DROP TABLE IF EXISTS `mm_user_profile`;
CREATE TABLE IF NOT EXISTS `mm_user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_group_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_MmUserProfile_a1_idx` (`code`),
  UNIQUE KEY `idx_MmUserProfile_a_idx` (`default_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

TRUNCATE TABLE `mm_user_profile`;
INSERT INTO `mm_user_profile` (`id`, `code`, `description`, `default_group_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'ALLUSERS', 'All users', 1, NULL, NULL, NULL, NULL);

DROP TABLE IF EXISTS `mm_user_setting`;
CREATE TABLE IF NOT EXISTS `mm_user_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mm_user_profile_id` int(11) NOT NULL,
  `account_type_id` int(11) DEFAULT NULL,
  `auto_save` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `last_viewed_news` datetime NOT NULL,
  `layout_state` longtext COLLATE utf8_unicode_ci NOT NULL,
  `menu_state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status_date` datetime NOT NULL,
  `theme` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `theme_font_size` float NOT NULL,
  `theme_width` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `fos_user_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk_mmuseset_cont_fos_idx` (`person_id`,`fos_user_id`),
  KEY `fk_mmuseset_fosuse_idx` (`fos_user_id`),
  KEY `fk_mmuseset_person_idx` (`person_id`),
  KEY `fk_mmuseset_mmusepro_idx` (`mm_user_profile_id`),
  KEY `fk_mmuseset_app_idx` (`account_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=56 ;

TRUNCATE TABLE `mm_user_setting`;
INSERT INTO `mm_user_setting` (`id`, `mm_user_profile_id`, `account_type_id`, `auto_save`, `language`, `last_viewed_news`, `layout_state`, `menu_state`, `status_date`, `theme`, `theme_font_size`, `theme_width`, `created_at`, `updated_at`, `created_by`, `updated_by`, `fos_user_id`, `person_id`) VALUES
(37, 1, NULL, '10', 'en', '2016-11-14 11:11:07', 'Test Layout State', 'grid_menu', '2016-11-14 11:11:07', 'mtl', 12, '720', '2016-11-14 11:11:07', NULL, 34, NULL, 41, 32),
(46, 1, NULL, '10', 'en', '2016-11-14 13:29:42', 'Test Layout State', 'grid_menu', '2016-11-14 13:29:42', 'mtl', 12, '720', '2016-11-14 13:29:42', NULL, 41, NULL, 50, 32),
(47, 1, NULL, '10', 'en', '2016-11-14 14:07:05', 'Test Layout State', 'grid_menu', '2016-11-14 14:07:05', 'mtl', 12, '720', '2016-11-14 14:07:05', NULL, 41, NULL, 51, 32),
(50, 1, NULL, '10', 'en', '2016-11-15 11:38:05', 'Test Layout State', 'grid_menu', '2016-11-15 11:38:05', 'mtl', 12, '720', '2016-11-15 11:38:05', NULL, 41, NULL, 54, 32),
(51, 1, NULL, '10', 'en', '2016-11-15 12:03:16', 'Test Layout State', 'grid_menu', '2016-11-15 12:03:16', 'mtl', 12, '720', '2016-11-15 12:03:16', NULL, 41, NULL, 55, 32),
(52, 1, NULL, '10', 'en', '2016-11-15 12:16:50', 'Test Layout State', 'grid_menu', '2016-11-15 12:16:50', 'mtl', 12, '720', '2016-11-15 12:16:50', NULL, 41, NULL, 56, 32),
(53, 1, NULL, '10', 'en', '2016-11-15 12:24:32', 'Test Layout State', 'grid_menu', '2016-11-15 12:24:32', 'mtl', 12, '720', '2016-11-15 12:24:32', NULL, 41, NULL, 57, 32),
(54, 1, NULL, '10', 'en', '2016-11-15 12:25:01', 'Test Layout State', 'grid_menu', '2016-11-15 12:25:01', 'mtl', 12, '720', '2016-11-15 12:25:01', NULL, 41, NULL, 58, 32),
(55, 1, NULL, '10', 'en', '2016-11-15 12:29:58', 'Test Layout State', 'grid_menu', '2016-11-15 12:29:58', 'mtl', 12, '720', '2016-11-15 12:29:58', NULL, 41, NULL, 59, 32);

DROP TABLE IF EXISTS `person`;
CREATE TABLE IF NOT EXISTS `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_date` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_person_person_id_idx` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

TRUNCATE TABLE `person`;
INSERT INTO `person` (`id`, `forename`, `surname`, `status_date`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'John', 'Smith', '2014-09-05 16:46:02', NULL, NULL, NULL, NULL),
(32, 'Anjana', 'Silva', '2016-05-01 00:00:00', NULL, NULL, NULL, NULL);


CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eserv_v_user` AS select `mm`.`id` AS `dtindex`,`mm`.`id` AS `mm_user_setting_id`,`p`.`id` AS `person_id`,`fu`.`id` AS `fos_user_id`,concat(`p`.`forename`,' ',`p`.`surname`) AS `full_name`,`fu`.`username` AS `username`,`fu`.`email` AS `fos_user_email`,`fu`.`enabled` AS `enabled`,`fu`.`password` AS `password`,`fu`.`last_login` AS `last_login`,(case `fu`.`locked` when 0 then 'N' when 1 then 'Y' end) AS `locked`,`fu`.`expired` AS `expired`,`fu`.`expires_at` AS `expires_at`,`fu`.`roles` AS `roles`,`fg`.`name` AS `fos_group_name` from ((((`mm_user_setting` `mm` left join `person` `p` on((`mm`.`person_id` = `p`.`id`))) left join `fos_user` `fu` on((`mm`.`fos_user_id` = `fu`.`id`))) left join `fos_user_group` `fug` on((`fu`.`id` = `fug`.`user_id`))) left join `fos_group` `fg` on((`fg`.`id` = `fug`.`group_id`)));