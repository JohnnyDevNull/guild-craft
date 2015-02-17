<?php
/**
 * @package Joomla.Administrator
 * @subpackage com_guildcraft
 *
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * guildcraft_characters Table Class
 *
 * @since 0.0.1
 */
class GuildCraftTableChar extends JTable
{
	/**
	 * @param JDatabaseDriver &$db A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__guildcraft_characters', 'id', $db);
	}
}
