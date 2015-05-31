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
jimport('joomla.application.component.modellist');

/**
 * GuildCraftList Model
 *
 * @since  0.0.1
 */
class GuildCraftModelRanks extends JModelList
{
	/**
	 * @var string
	 */
	protected $resultType = 'object';

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

		if ($this->resultType == 'object') {
			$result = $this->_db->loadObjectList();
		} else if ($this->resultType == 'assoc') {
			$result = $this->_db->loadAssocList();
		}

		return $result;
	}

	/**
	 * @param string $type array('assoc', 'object')
	 */
	public function setResultType($type)
	{
		if(in_array($type, array('assoc', 'object')))
		{
			$this->_resultType = $type;
		}
	}
}
