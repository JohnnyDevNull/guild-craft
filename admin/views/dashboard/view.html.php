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
 
/**
 * GuildCraftViewDashboard JViewLegacy
 *
 * @author Philipp John <info@jplace.de>
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @link https://github.com/JohnnyDevNull/guild-craft The GitHub project page
 * @license http://www.gnu.org/licenses/gpl-3.0
 */
class GuildCraftViewDashboard extends JViewLegacy
{
	/**
	 * Display the Dashboard view
	 *
	 * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
	 * @return void
	 */
	function display($tpl = null)
	{
		// Get data from the model
		$this->items['statistic'] = $this->get('Statistics');

		$params = JComponentHelper::getParams('com_guildcraft');
		$this->guild['name'] = $params->get('guild_name');
		$this->cachedFiles = $this->get('CachedFiles');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
 
			return false;
		}
 
		// Add and set the sidebar
		GuildCraftHelper::addSubmenu('dashboard');
		$this->sidebar = JHtmlSidebar::render();

		// Set the toolbars
		$this->addToolBar();

		// Display the template
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return void
	 */
	protected function addToolBar()
	{
		JToolBarHelper::title(JText::_('COM_GUILDCRAFT_MANAGER_DASHBOARD'), 'home-2');
		JToolBarHelper::custom('guild.getGuild', 'download', '', 'Gilde abrufen', false);
		JToolBarHelper::custom('guild.getGuildMembers', 'download', '', 'Gildenmitglieder abrufen', false);
		JToolBarHelper::custom('guild.getRaces', 'download', '', 'Rassen abrufen', false);
		JToolBarHelper::custom('guild.getClasses', 'download', '', 'Klassen abrufen', false);
		JToolBarHelper::custom('import.prepare', 'loop', '', 'Daten einlesen', false);
		JToolBarHelper::custom('reset', 'cancel', '', 'Gilde zurücksetzten', false);
		JToolBarHelper::preferences('com_guildcraft');
	}
}
