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

$viewsUseAdminModels = array (
	'characters',
);

if(!class_exists('')) {
	require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'guildcraft.php';
}

JHtml::stylesheet('com_guildcraft/styles.css', array('language' => 'text/css'), true);

$requestView = JFactory::getApplication()->input->get('view', 'characters');
$controller = JControllerLegacy::getInstance('GuildCraft');

if(in_array($requestView, $viewsUseAdminModels)) {
	GuildCraftHelper::import('model.list', 'GuildCraftModelList', JPATH_COMPONENT_ADMINISTRATOR);
	$controller->addModelPath(JPATH_COMPONENT_ADMINISTRATOR.DS.'models');
}

$controller->execute(JFactory::getApplication()->input->getCmd('task'));
$controller->redirect();
