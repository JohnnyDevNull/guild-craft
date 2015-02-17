<?php
/**
 * @package Joomla.Site
 * @subpackage com_guildcraft
 *
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
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
