<?php
/**
 * @package Joomla.Administrator
 * @subpackage com_guildcraft
 *
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-3.0
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

if (!JFactory::getUser()->authorise('core.manage', 'com_guildcraft')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

if(!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

require_once  JPATH_COMPONENT.DS.'helpers'.DS.'guildcraft.php';

$controller = JControllerLegacy::getInstance('GuildCraft');
$controller->execute(JFactory::getApplication()->input->getCmd('task'));
$controller->redirect();
