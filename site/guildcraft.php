<?php
/**
 * @package Joomla.Site
 * @subpackage com_guildcraft
 *
 * @author Philipp John <info@jplace.de>
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @link https://github.com/JohnnyDevNull/guild-craft The GitHub project page
 * @license http://www.gnu.org/licenses/gpl-3.0
 */

defined('_JEXEC') or die('RESTRICTED ACCESS');

if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

$controller = JControllerLegacy::getInstance('GuildCraft');
$controller->execute(JFactory::getApplication()->input->getCmd('task'));
$controller->redirect();
