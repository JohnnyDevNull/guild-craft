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
 
/**
 * Dashboard View
 *
 * @since  0.0.1
 */
class GuildCraftViewDashboard extends JViewLegacy
{
	/**
	 * Display the Dashboard view
	 *
	 * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
	 *
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

		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return void
	 *
	 * @since 1.6
	 */
	protected function addToolBar()
	{
		JToolBarHelper::title(JText::_('COM_GUILDCRAFT_MANAGER_DASHBOARD'), 'home-2');
		JToolBarHelper::custom('guild.getGuild', 'download', '', 'Gilde abrufen', false);
		JToolBarHelper::custom('guild.getGuildMembers', 'download', '', 'Gildenmitglieder abrufen', false);
		JToolBarHelper::custom('guild.getRaces', 'download', '', 'Rassen abrufen', false);
		JToolBarHelper::custom('guild.getClasses', 'download', '', 'Klassen abrufen', false);
		JToolBarHelper::custom('guild.read', 'loop', '', 'Daten einlesen', false);
		JToolBarHelper::custom('guild.reset', 'cancel', '', 'Gilde zurücksetzten', false);
		JToolBarHelper::preferences('com_guildcraft');
	}
}
