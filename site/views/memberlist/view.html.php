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

/**
 * HTML View class for the Guild Craft Component
 */
class GuildCraftViewMemberlist extends JViewLegacy
{
	/**
	 * Display the Guild Craft view.
	 *
	 * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
	 * @return false|null
	 */
	public function display($tpl = null) 
	{
		// Assign data to the view
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
			return false;
		}

		// Display the view
		parent::display($tpl);
	}
}
