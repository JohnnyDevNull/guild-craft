<?php
/**
 * @package Joomla.Administrator
 * @subpackage com_guildcraft
 *
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-3.0
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Die Joomla! JControllerForm Klasse importieren
jimport('joomla.application.component.controllerform');

/**
 * Dashboard Sub-Controller
 *
 * @since 0.0.1
 */
class GuildCraftControllerChar extends JControllerForm
{
	/**
	 * @var string
	 */
	protected $option = 'com_guildcraft';

	/**
	 * @var string
	 */
	protected $view_list = 'characters';
}
