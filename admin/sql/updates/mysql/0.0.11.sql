/**
 * @package Joomla.Administrator
 * @subpackage com_guildcraft
 *
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-3.0
 */

DROP TABLE IF EXISTS `#__guildcraft_guild`;

CREATE TABLE IF NOT EXISTS `#__guildcraft_guild` (
	`key`		VARCHAR(50)		NOT NULL,
	`value`		VARCHAR(100)	NOT NULL,
	UNIQUE `key` (`key`)
)
	ENGINE=MyISAM
	AUTO_INCREMENT=0
	DEFAULT CHARSET=utf8;

/* -------------------------------------------------------- */

DROP TABLE IF EXISTS `#__guildcraft_characters`;

CREATE TABLE IF NOT EXISTS `#__guildcraft_characters` (
	`id`		INT(11)			NOT NULL AUTO_INCREMENT,
	`c_id`		INT(11)			NOT NULL,
	`u_id`		INT(11)			NOT NULL,
	`g_id`		INT(11)			NOT NULL,
	`nickname`	VARCHAR(25)		NOT NULL,
	`level`		tinyint(4)		NOT NULL,
	`class`		VARCHAR(100)	NOT NULL,
	`published`	tinyint(4)		NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE `char_assignment` (`c_id`, `u_id`)
)
	ENGINE=MyISAM
	AUTO_INCREMENT=0
	DEFAULT CHARSET=utf8;

/* -------------------------------------------------------- */

DROP TABLE IF EXISTS `#__guildcraft_grades`;

CREATE TABLE IF NOT EXISTS `#__guildcraft_grades` (
	`id`		INT(11)			NOT NULL AUTO_INCREMENT,
	`rank`		INT(2)			NOT NULL,
	`name`		VARCHAR(25)		NOT NULL,
	`published`	tinyint(4)		NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE `rank` (`rank`)
)
	ENGINE=MyISAM
	AUTO_INCREMENT=0
	DEFAULT CHARSET=utf8;

INSERT IGNORE INTO `#__guildcraft_grades`
	( `id`, `rank`, `name`, `published`)
VALUES
	(0, 0 'Oberhaupt',		0),
	(1, 1 'Ratsmitglied',	0),
	(2, 2 'Offizier',		0),
	(3, 3 'Raid-Mitglied',	0),
	(4, 4 'PVP-Mitglied',	0),
	(5, 5 'Mitglied',		0),
	(6, 6 'Probemitglied',	0),
	(7, 7 'Twink',			0);

/* -------------------------------------------------------- */

DROP TABLE IF EXISTS `#__guildcraft_races`;

CREATE TABLE IF NOT EXISTS `#__guildcraft_races` (
	`id`		INT(11)			NOT NULL AUTO_INCREMENT,
	`mask`		INT(11)			NOT NULL,
	`side`		varchar(50)		NOT NULL,
	`name`		VARCHAR(50)		NOT NULL
	PRIMARY KEY (`id`),
)
	ENGINE=MyISAM
	AUTO_INCREMENT=0
	DEFAULT CHARSET=utf8;

/* -------------------------------------------------------- */

DROP TABLE IF EXISTS `#__guildcraft_classes`;

CREATE TABLE IF NOT EXISTS `#__guildcraft_classes` (
	`id`		INT(11)			NOT NULL AUTO_INCREMENT,
	`mask`		INT(11)			NOT NULL,
	`powertype`	VARCHAR(50)		NOT NULL,
	`name`		VARCHAR(50)		NOT NULL
	PRIMARY KEY (`id`),
)
	ENGINE=MyISAM
	AUTO_INCREMENT=0
	DEFAULT CHARSET=utf8;
