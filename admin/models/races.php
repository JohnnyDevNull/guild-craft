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
 * GuildCraftModelRanks GuildCraftModelList
 *
 * @package Joomla.Administrator
 * @subpackage com_guildcraft
 *
 * @author Philipp John <info@jplace.de>
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @link https://github.com/JohnnyDevNull/guild-craft The GitHub project page
 * @license http://www.gnu.org/licenses/gpl-3.0
 */
class GuildCraftModelRaces extends GuildCraftModelList
{
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return string An SQL query
	 */
	protected function getListQuery()
	{
		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
 
		// Create the base select statement.
		$query->select('*')
			  ->from($db->quoteName('#__guildcraft_ranks'));
 
		return $query;
	}

	/**
	 * @param string $query
	 * @param int $limitstart
	 * @param int $limit
	 * @return stdClass|array
	 */
	protected function _getList($query, $limitstart = 0, $limit = 0)
	{
		$this->_db->setQuery($query, $limitstart, $limit);

		$result = null;

		if ($this->_resultType == 'object') {
			$result = $this->_db->loadObjectList($this->_key);
		} else if ($this->_resultType == 'assoc') {
			$result = $this->_db->loadAssocList($this->_key);
		}

		return $result;
	}
}
