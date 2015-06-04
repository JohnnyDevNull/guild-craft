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
 * Provides functions for the components list models to extend.
 */
abstract class GuildCraftModelList extends JModelList
{
	/**
	 * @var string
	 */
	protected $_resultType = 'object';

	/**
	 * @var string
	 */
	protected $_key = 'id';

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

	/**
	 * @param null|string $key
	 */
	public function setKey($key)
	{
		$this->_key = $key;
	}
}
