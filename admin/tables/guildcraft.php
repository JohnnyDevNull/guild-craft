<?php
/**
 * @package Joomla.Administrator
 * @subpackage com_guildcraft
 *
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-3.0
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * guildcraft_grades Table Class
 *
 * @since 0.0.1
 */
class GuildCraftTableGuildCraft extends JTable
{
	/**
	 * @param JDatabaseDriver &$db A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__guildcraft_grades', 'id', $db);
	}
}
