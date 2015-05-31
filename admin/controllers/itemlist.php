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
