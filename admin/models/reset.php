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
 * GuildCraftModelReset JModelLegacy
 *
 * @package Joomla.Administrator
 * @subpackage com_guildcraft
 *
 * @author Philipp John <info@jplace.de>
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @link https://github.com/JohnnyDevNull/guild-craft The GitHub project page
 * @license http://www.gnu.org/licenses/gpl-3.0
 */
class GuildCraftModelReset extends JModelLegacy
{
	/**
	 * Starts the import.
	 *
	 * @return bool
	 */
	public function reset()
	{
		$tables = array (
			'characters',
			'classes',
			'data',
			'races',
		);

		$affectedRows = 0;
		$query = $this->_db->getQuery();

		foreach($tables as $table) {
			$query->clear()->delete('#__guildcraft_'.$table);
			$this->_db->setQuery($query);
			$this->_db->execute();
			$affectedRows += $this->_db->getAffectedRows();
		}

		JFactory::getApplication()->enqueueMessage (
			$affectedRows.' Einträge wurden erfolgreich gelöscht.'
		);
	}
}
