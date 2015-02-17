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

// Die Joomla! JControllerAdmin Klasse importieren
jimport('joomla.application.component.controlleradmin');

/**
 * Dashboard Sub-Controller
 *
 * @since 0.0.1
 */
class GuildCraftControllerCharlist extends JControllerAdmin
{
	/**
	 * @var string
	 */
	protected $option = 'com_guildcraft';
}
