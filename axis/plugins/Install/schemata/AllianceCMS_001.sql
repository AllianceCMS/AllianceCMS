SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `a_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `folder_name` varchar(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `a_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `parent` varchar(20) NOT NULL,
  `location` int(11) NOT NULL DEFAULT '1',
  `user_classes` varchar(100) NOT NULL,
  `link_order` int(11) NOT NULL DEFAULT '1',
  `active` int(11) NOT NULL DEFAULT '2',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `a_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `version` varchar(20) NOT NULL,
  `folder_path` varchar(255) NOT NULL,
  `folder_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `developer` varchar(50) NOT NULL,
  `developer_email` varchar(100) NOT NULL,
  `developer_site` varchar(100) NOT NULL,
  `user_classes` varchar(100) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '2',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `folder_path` (`folder_path`),
  KEY `folder_path_2` (`folder_path`),
  KEY `folder_path_3` (`folder_path`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `a_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `version` varchar(20) NOT NULL,
  `folder_path` varchar(255) NOT NULL,
  `folder_name` varchar(100) NOT NULL,
  `favicon` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `author_email` varchar(50) NOT NULL,
  `author_site` varchar(100) NOT NULL,
  `selectable` int(11) NOT NULL DEFAULT '2',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `a_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `display_name` varchar(20) NOT NULL,
  `real_name` varchar(30) NOT NULL,
  `login_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `hide_email_address` int(11) NOT NULL DEFAULT '2',
  `timezone_offset` int(11) NOT NULL DEFAULT '0',
  `location` varchar(200) NOT NULL,
  `website` varchar(100) NOT NULL,
  `bio` text NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `signature` text NOT NULL,
  `preferred_theme` int(11) NOT NULL DEFAULT '1',
  `user_classes` varchar(100) NOT NULL,
  `last_ip` varchar(20) NOT NULL,
  `last_login_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `registration_ip` varchar(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `a_venues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `tagline` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `venue_email` varchar(100) NOT NULL,
  `venue_email_name` varchar(100) NOT NULL,
  `venue_admin` int(11) NOT NULL DEFAULT '1',
  `active_theme` int(11) NOT NULL DEFAULT '1',
  `default_plugin` int(11) NOT NULL DEFAULT '1',
  `maintenance_flag` int(11) NOT NULL DEFAULT '1',
  `maintenance_flag_text` text NOT NULL,
  `language` int(11) NOT NULL DEFAULT '1',
  `active` int(11) NOT NULL DEFAULT '2',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
