-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.9-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table ironworkshop.about_us
CREATE TABLE IF NOT EXISTS `about_us` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table ironworkshop.about_us: ~0 rows (approximately)
/*!40000 ALTER TABLE `about_us` DISABLE KEYS */;
/*!40000 ALTER TABLE `about_us` ENABLE KEYS */;


-- Dumping structure for table ironworkshop.backend_users
CREATE TABLE IF NOT EXISTS `backend_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `salt` int(11) unsigned NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `is_super` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table ironworkshop.backend_users: ~0 rows (approximately)
/*!40000 ALTER TABLE `backend_users` DISABLE KEYS */;
INSERT INTO `backend_users` (`id`, `user_name`, `user_pass`, `user_email`, `salt`, `display_name`, `is_super`, `created`, `modified`) VALUES
	(1, 'creative', '44e32df05cb0bc59d45534e152c54e4dcf5cfc1b192fe2d2396971a5c4858b36', 'william@outputdigital.com', 1435578356, 'William', 1, '2016-01-11 15:13:56', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `backend_users` ENABLE KEYS */;


-- Dumping structure for table ironworkshop.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table ironworkshop.categories: ~5 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `is_active`) VALUES
	(2, 'test', 1),
	(3, 'news', 1),
	(4, 'powerlifting', 1),
	(5, 'diet', 1),
	(6, 'training', 1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


-- Dumping structure for table ironworkshop.contact_us
CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `facebook` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `text` text,
  `location` text NOT NULL,
  `lat` float NOT NULL,
  `lang` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table ironworkshop.contact_us: ~0 rows (approximately)
/*!40000 ALTER TABLE `contact_us` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_us` ENABLE KEYS */;


-- Dumping structure for table ironworkshop.emails
CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table ironworkshop.emails: ~0 rows (approximately)
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;


-- Dumping structure for table ironworkshop.faqs
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `sort` int(11) unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table ironworkshop.faqs: ~0 rows (approximately)
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` (`id`, `question`, `answer`, `sort`, `is_active`) VALUES
	(2, 'This is a question', 'test', 1, 1),
	(3, 'question two?', 'yo!', 3, 1),
	(4, 'So many questions but no answers?', 'yo', 2, 1);
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;


-- Dumping structure for table ironworkshop.galleries
CREATE TABLE IF NOT EXISTS `galleries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `sort` int(11) unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- Dumping data for table ironworkshop.galleries: ~0 rows (approximately)
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` (`id`, `title`, `slug`, `image`, `video`, `sort`, `is_active`) VALUES
	(2, 'this is a test', 'this-is-a-test', 'slidermain.jpg', '', 1, 1),
	(3, 'another imaged', 'another-imaged', 'Penguins.jpg', '', 2, 1),
	(4, 'ldnsland', 'ldnsland', 'Jellyfish.jpg', '', 3, 1);
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;


-- Dumping structure for table ironworkshop.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table ironworkshop.news: ~1 rows (approximately)
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `title`, `slug`, `text`, `image`, `video`, `date`) VALUES
	(3, 'test', 'test', '<p>sdfdfsdfsdfsdf</p>\r\n', 'Penguins.jpg', '', '2016-05-25 00:00:00');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;


-- Dumping structure for table ironworkshop.news_categories
CREATE TABLE IF NOT EXISTS `news_categories` (
  `news_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  KEY `FK__news` (`news_id`),
  KEY `FK__categories` (`category_id`),
  CONSTRAINT `FK__categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__news` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ironworkshop.news_categories: ~3 rows (approximately)
/*!40000 ALTER TABLE `news_categories` DISABLE KEYS */;
INSERT INTO `news_categories` (`news_id`, `category_id`) VALUES
	(3, 5),
	(3, 4),
	(3, 2);
/*!40000 ALTER TABLE `news_categories` ENABLE KEYS */;


-- Dumping structure for table ironworkshop.results
CREATE TABLE IF NOT EXISTS `results` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `trainer_id` int(11) unsigned DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `sort` int(11) unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK__trainers_results` (`trainer_id`),
  CONSTRAINT `FK__trainers_results` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ironworkshop.results: ~0 rows (approximately)
/*!40000 ALTER TABLE `results` DISABLE KEYS */;
/*!40000 ALTER TABLE `results` ENABLE KEYS */;


-- Dumping structure for table ironworkshop.stores
CREATE TABLE IF NOT EXISTS `stores` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `price` float(11,2) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `sort` int(11) unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ironworkshop.stores: ~0 rows (approximately)
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;


-- Dumping structure for table ironworkshop.store_images
CREATE TABLE IF NOT EXISTS `store_images` (
  `store_id` int(11) unsigned NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  KEY `FK__store` (`store_id`),
  CONSTRAINT `FK__store` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ironworkshop.store_images: ~0 rows (approximately)
/*!40000 ALTER TABLE `store_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `store_images` ENABLE KEYS */;


-- Dumping structure for table ironworkshop.trainers
CREATE TABLE IF NOT EXISTS `trainers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ironworkshop.trainers: ~0 rows (approximately)
/*!40000 ALTER TABLE `trainers` DISABLE KEYS */;
/*!40000 ALTER TABLE `trainers` ENABLE KEYS */;


-- Dumping structure for table ironworkshop.trainer_images
CREATE TABLE IF NOT EXISTS `trainer_images` (
  `trainer_id` int(11) unsigned NOT NULL,
  `image` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `sort` int(11) unsigned NOT NULL DEFAULT '0',
  KEY `FK__trainers` (`trainer_id`),
  CONSTRAINT `FK__trainers` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ironworkshop.trainer_images: ~0 rows (approximately)
/*!40000 ALTER TABLE `trainer_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `trainer_images` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
