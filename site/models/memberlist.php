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
class GuildCraftModelMemberlist extends JModelList
{
	/**
	 * @param array $config
	 */
	public function __construct($config = array())
	{
		$config['filter_fields'] = array (
			'grade',
		);

		parent::__construct($config);
	}

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
			  ->from($db->quoteName('#__guildcraft_characters'));
 
		if(($gID = (int)$this->getState('filter.grade')) > 0) {
			$query->where('g_ID = '.$gID);
		}

		return $query;
	}

	/**
	 * @return stdClass[]
	 */
	public function getRanks()
	{
		$ranksModelPath = JPATH_ADMINISTRATOR.DS
						. 'components'.DS
						. 'com_guildcraft'.DS
						. 'models';

		JLoader::import('ranks', $ranksModelPath);
		$model = JModelLegacy::getInstance('Ranks', 'GuildCraftModel');

		return $model->getItems();
	}
}
