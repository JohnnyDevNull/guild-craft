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
 * GuildCraftViewCharacters JViewLegacy
 *
 * @author Philipp John <info@jplace.de>
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @link https://github.com/JohnnyDevNull/guild-craft The GitHub project page
 * @license http://www.gnu.org/licenses/gpl-3.0
 */
class GuildCraftViewCharacters extends JViewLegacy
{
	/**
	 * @var stdClass[]
	 */
	public $items;

	/**
	 * @var stdClass[]
	 */
	public $races;

	/**
	 * @var stdClass[]
	 */
	public $classes;

	/**
	 * @var stdClass[]
	 */
	public $ranks;

	/**
	 * Display the Dashboard view
	 *
	 * @param string $tpl
	 * @return void
	 */
	function display($tpl = null)
	{
		// Get data from the model
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
 
		$model = JModelLegacy::getInstance('Races', 'GuildCraftModel');
		$this->races = $model->getItems();

		$model = JModelLegacy::getInstance('Classes', 'GuildCraftModel');
		$this->classes = $model->getItems();

		$model = JModelLegacy::getInstance('Ranks', 'GuildCraftModel');
		$this->ranks = $model->getItems();

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode('<br />', $errors));
 
			return false;
		}
 
		// Add and set the sidebar
		GuildCraftHelper::addSubmenu('characters');
		$this->sidebar = JHtmlSidebar::render();

		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 */
	protected function addToolBar()
	{
		JToolBarHelper::title(JText::_('COM_GUILDCRAFT_MANAGER_DASHBOARD'), 'users');
		JToolBarHelper::addNew('char.add');
		JToolBarHelper::publishList('charlist.publish');
		JToolBarHelper::unpublishList('charlist.unpublish');
		JToolBarHelper::deleteList('', 'charlist.remove');
		JToolBarHelper::preferences('com_guildcraft');
	}
}
