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
