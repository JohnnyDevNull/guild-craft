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
 * Guild Craft Dashbord Model
 *
 * @since  0.0.1
 */
class GuildCraftModelDashboard extends JModelList
{
	/**
	 * Method to build an SQL query to load the statistics data.
	 *
	 * @return string An SQL query
	 */
	public function getStatistics()
	{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
 		$counts = array();

		// Get the characters amount of the guild.
		$query->select('COUNT(*)')
			-> from($db->quoteName('#__guildcraft_characters'));
		$db->setQuery($query);
		$counts['char_amount'] = (int)$db->loadResult();

		// Get the amount of the characters without a user assigned.
		$query->clear();
		$query->select('COUNT(*)')
			-> from($db->quoteName('#__guildcraft_characters'))
			->where('user_id = 0');
		$db->setQuery($query);
		$counts['char_userless'] = (int)$db->loadResult();

		// Get the amount of the characters which are currently published.
		$query->clear();
		$query->select('COUNT(*)')
			-> from($db->quoteName('#__guildcraft_characters'))
			->where('published = 1');
		$db->setQuery($query);
		$counts['char_published'] = (int)$db->loadResult();

		// Get the amount of the characters which are currently unpublished.
		$query->clear();
		$query->select('COUNT(*)')
			-> from($db->quoteName('#__guildcraft_characters'))
			->where('published = 0');
		$db->setQuery($query);
		$counts['char_unpublished'] = (int)$db->loadResult();

		// Get the amount of the characters which are currently reached max level.
		$query->clear();
		$query->select('COUNT(*)')
			-> from($db->quoteName('#__guildcraft_characters'))
			->where('level = 100');
		$db->setQuery($query);
		$counts['char_maxlevel'] = (int)$db->loadResult();

		return $counts;
	}

	/**
	 * @return string[]
	 */
	public function getCachedFiles()
	{
		jimport('joomla.filesystem.folder');
		jimport('joomla.filesystem.file');

		$folder = JPATH_COMPONENT.DS.'cache'.DS;
		return JFolder::files($folder, 'get.*.\.json');
	}
}
