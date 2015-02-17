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
 * Items Sub-Controller
 *
 * @since 0.0.1
 */
class GuildCraftControllerItemlist extends JControllerAdmin
{
	/**
	 * @var string
	 */
	protected $option = 'com_guildcraft';

	public function publish()
	{
		echo 'It Works';
	}

	public function unpublish()
	{
		echo 'It Works';
	}

	public function remove()
	{
		echo 'It Works';
	}
}
