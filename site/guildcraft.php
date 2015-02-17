<?php
/**
 * @package Joomla.Site
 * @subpackage com_guildcraft
 *
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-3.0
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

$controller = JControllerLegacy::getInstance('GuildCraft');
$controller->execute(JFactory::getApplication()->input->getCmd('task'));
$controller->redirect();
