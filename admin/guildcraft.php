<?php
/**
 * @package Joomla.Administrator
 * @subpackage com_guildcraft
 *
 * @author Philipp John <info@jplace.de>
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @link https://github.com/JohnnyDevNull/guild-craft The GitHub project page
 * @license http://www.gnu.org/licenses/gpl-3.0
 */

defined('_JEXEC') or die('RESTRICTED ACCESS');

if (!JFactory::getUser()->authorise('core.manage', 'com_guildcraft')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

if(!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

require_once  JPATH_COMPONENT.DS.'helpers'.DS.'guildcraft.php';
GuildCraftHelper::import('model.list', 'GuildCraftModelList');
JHtml::stylesheet('com_guildcraft/styles.css', array('language' => 'text/css'), true);

$controller = JControllerLegacy::getInstance('GuildCraft');
$controller->execute(JFactory::getApplication()->input->getCmd('task'));
$controller->redirect();
