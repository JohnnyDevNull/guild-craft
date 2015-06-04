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
	 * Display the Guild Craft view.
	 *
	 * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
	 * @return false|null
	 */
	public function display($tpl = null) 
	{
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
 
		$model = JModelLegacy::getInstance('Races', 'GuildCraftModel');
		$this->races = $model->getItems();

		$model = JModelLegacy::getInstance('Classes', 'GuildCraftModel');
		$this->classes = $model->getItems();

		$model = JModelLegacy::getInstance('Ranks', 'GuildCraftModel');
		$this->ranks = $model->getItems();

		if (count($errors = $this->get('Errors')))
		{
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
			return false;
		}

		parent::display($tpl);
	}
}
