<?php
/**
 * @package Joomla.Site
 * @subpackage com_guildcraft
 *
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-3.0
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Guild Craft Model
 */
class GuildCraftModelGuildCraft extends JModelItem
{
	/**
	 * @var string message
	 */
	protected $grades;

	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param string $type The table name. Optional.
	 * @param string $prefix The class prefix. Optional.
	 * @param array $config Configuration array for model. Optional.
	 * @return JTable A JTable object
	 */
	public function getTable($type = 'GuildCraft', $prefix = 'GuildCraftTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Get the Grades.
	 *
	 * @param integer $id Greeting Id
	 * @return string Fetched String from Table for relevant Id
	 */
	public function getGrades($id = 1)
	{
		if (!is_array($this->grades))
		{
			$this->grades = array();
		}

		if (!isset($this->grades[$id]))
		{
			// Request the selected id
			$jinput = JFactory::getApplication()->input;
			$id     = $jinput->get('id', 1, 'INT');

			// Get a TableHelloWorld instance
			$table = $this->getTable();
 
			// Load the message
			$table->load($id);
 
			// Assign the message
			$this->grades[$id] = $table->name;
		}

		return $this->grades[$id];
	}
}
