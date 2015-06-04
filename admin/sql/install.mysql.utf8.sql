/**
 * @package Joomla.Administrator
 * @subpackage com_guildcraft
 *
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-3.0
 */

/* -------------------------------------------------------- */

DROP TABLE IF EXISTS `#__guildcraft_data`;

CREATE TABLE IF NOT EXISTS `#__guildcraft_data` (
	`key`		VARCHAR(50)		NOT NULL,
	`value`		TEXT			NOT NULL,
	UNIQUE `key` (`key`)
)
	ENGINE=MyISAM
	AUTO_INCREMENT=0
	DEFAULT CHARSET=utf8;

INSERT IGNORE INTO `#__guildcraft_data`
	( `key`, `value`)
VALUES
	('last_modified',		''),
	('name',				''),
	('realm',				''),
	('level',				''),
	('side',				''),
	('achievement_points',	'');

/* -------------------------------------------------------- */

DROP TABLE IF EXISTS `#__guildcraft_characters`;

CREATE TABLE IF NOT EXISTS `#__guildcraft_characters` (
	`id`					INT(11)			UNSIGNED NOT NULL AUTO_INCREMENT,
	`name`					VARCHAR(50)		NOT NULL,
	`realm`					VARCHAR(50)		NOT NULL,
	`user_id`				INT(11)			UNSIGNED NOT NULL DEFAULT '0',
	`rank_id`				INT(11)			UNSIGNED NOT NULL,
	`race_id`				INT(11)			UNSIGNED NOT NULL,
	`class_id`				INT(11)			UNSIGNED NOT NULL,
	`level`					tinyint(4)		UNSIGNED NOT NULL,
	`gender`				tinyint(4)		UNSIGNED NOT NULL,
	`achievement_points`	int(11)			UNSIGNED NOT NULL,
	`thumbnail`				VARCHAR(200)	NOT NULL,
	`spec`					VARCHAR(510)	NOT NULL,
	`published`				tinyint(4)		UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	UNIQUE `name_realm` (`name`, `realm`)
)
	ENGINE=MyISAM
	AUTO_INCREMENT=0
	DEFAULT CHARSET=utf8;

/* -------------------------------------------------------- */

DROP TABLE IF EXISTS `#__guildcraft_ranks`;

CREATE TABLE IF NOT EXISTS `#__guildcraft_ranks` (
	`id`		INT(11)			UNSIGNED NOT NULL AUTO_INCREMENT,
	`rank`		INT(11)			UNSIGNED NOT NULL,
	`name`		VARCHAR(50)		NOT NULL,
	`published`	tinyint(4)		UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE `rank` (`rank`)
)
	ENGINE=MyISAM
	AUTO_INCREMENT=0
	DEFAULT CHARSET=utf8;

INSERT IGNORE INTO `#__guildcraft_ranks`
	( `rank`, `name`, `published`)
VALUES
	(0, 'Oberhaupt',		0),
	(1, 'Ratsmitglied',		0),
	(2, 'Offizier',			0),
	(3, 'Raid-Mitglied',	0),
	(4, 'PVP-Mitglied',		0),
	(5, 'Mitglied',			0),
	(6, 'Probemitglied',	0),
	(7, 'Twink',			0);

/* -------------------------------------------------------- */

DROP TABLE IF EXISTS `#__guildcraft_races`;

CREATE TABLE IF NOT EXISTS `#__guildcraft_races` (
	`id`		INT(11)			UNSIGNED NOT NULL AUTO_INCREMENT,
	`mask`		INT(11)			UNSIGNED NOT NULL,
	`side`		VARCHAR(50)		NOT NULL,
	`name`		VARCHAR(50)		NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE `id_mask` (`id`, `mask`)
)
	ENGINE=MyISAM
	AUTO_INCREMENT=0
	DEFAULT CHARSET=utf8;

/* -------------------------------------------------------- */

DROP TABLE IF EXISTS `#__guildcraft_classes`;

CREATE TABLE IF NOT EXISTS `#__guildcraft_classes` (
	`id`		INT(11)			UNSIGNED NOT NULL AUTO_INCREMENT,
	`mask`		INT(11)			UNSIGNED NOT NULL,
	`powertype`	VARCHAR(50)		NOT NULL,
	`name`		VARCHAR(50)		NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE `id_mask` (`id`, `mask`)
)
	ENGINE=MyISAM
	AUTO_INCREMENT=0
	DEFAULT CHARSET=utf8;

/* -------------------------------------------------------- */
