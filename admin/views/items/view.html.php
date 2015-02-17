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
 * Items View
 *
 * @since 0.0.1
 */
class GuildCraftViewItems extends JViewLegacy
{
	/**
	 * Display the Items view
	 *
	 * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
	 * @return void
	 */
	function display($tpl = null)
	{
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
 
			return false;
		}
 
		// Add and set the sidebar
		GuildCraftHelper::addSubmenu('items');
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
	 * @since 1.6
	 */
	protected function addToolBar()
	{
		JToolBarHelper::title(JText::_('COM_GUILDCRAFT_MANAGER_ITEMS'), 'wrench');
		JToolBarHelper::addNew('item.add');
		JToolBarHelper::publishList('itemlist.publish');
		JToolBarHelper::unpublishList('itemlist.unpublish');
		JToolBarHelper::deleteList('', 'itemlist.remove');
		JToolBarHelper::preferences('com_guildcraft');
	}
}
