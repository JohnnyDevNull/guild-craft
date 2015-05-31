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
 * Guild Craft Model
 */
class GuildCraftModelCharacter extends JModelItem
{
	/**
	 * @var GuildCraftTableCharacter[] message
	 */
	protected $character;

	/**
	 * @param string $type The table name. Optional.
	 * @param string $prefix The class prefix. Optional.
	 * @param array $config Configuration array for model. Optional.
	 * @return JTable A JTable object
	 */
	public function getTable($type = 'Character', $prefix = 'GuildCraftTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * @param integer $id [optional] default: 1
	 * @return GuildCraftTableCharacter
	 */
	public function getGrades($id = 1)
	{
		if (!is_array($this->character))
		{
			$this->character = array();
		}

		if (!isset($this->character[$id]))
		{
			// Request the selected id
			$jinput = JFactory::getApplication()->input;
			$id     = $jinput->get('id', 1, 'INT');
			$table = $this->getTable();
			$table->load($id);
			$this->character[$id] = $table;
		}

		return $this->character[$id];
	}
}
