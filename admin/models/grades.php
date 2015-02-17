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

// Die Joomla! JModelAdmin Klasse importieren
jimport('joomla.application.component.modellist');

/**
 * GuildCraftList Model
 *
 * @since  0.0.1
 */
class GuildCraftModelGrades extends JModelList
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
			  ->from($db->quoteName('#__guildcraft_grades'));
 
		return $query;
	}
}
