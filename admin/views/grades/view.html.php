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
 
/**
 * Dashboard View
 *
 * @since 0.0.1
 */
class GuildCraftViewGrades extends JViewLegacy
{
	/**
	 * Display the Grades view
	 *
	 * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return void
	 */
	function display($tpl = null)
	{
		// Get data from the model
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
 
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
 
			return false;
		}
 
		// Add and set the sidebar
		GuildCraftHelper::addSubmenu('grades');
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
		JToolBarHelper::title(JText::_('COM_GUILDCRAFT_MANAGER_GRADES'), 'list');
		JToolBarHelper::addNew('grade.add');
		JToolBarHelper::publishList('gradelist.publish');
		JToolBarHelper::unpublishList('gradelist.unpublish');
		JToolBarHelper::deleteList('', 'gradelist.remove');
		JToolBarHelper::preferences('com_guildcraft');
	}
}
