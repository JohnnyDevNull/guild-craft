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
jimport('joomla.application.component.controller');

/**
 * General Controller of the GuildCraft component
 *
 * @package Joomla.Administrator
 * @subpackage com_guildcraft
 */
class GuildCraftController extends JControllerLegacy
{
	/**
	 * The default view for the display method.
	 *
	 * @var string
	 */
	protected $default_view = 'dashboard';

	/**
	 * Deletes a file from the cache folder.
	 *
	 * @return null
	 */
	public function removeCachedFile()
	{
		jimport('joomla.filesystem.folder');
		jimport('joomla.filesystem.file');

		$filename = JFactory::getApplication()->input->getCmd('file');
		JFile::delete(JPATH_COMPONENT.DS.'cache'.DS.$filename);
		parent::display();
	}

	/**
	 * Deletes a file from the cache folder.
	 *
	 * @return null
	 */
	public function importCachedFile()
	{
		$filename = JFactory::getApplication()->input->getCmd('file');
		$filepath = JPATH_COMPONENT.DS.'cache'.DS.$filename;

		if(is_file($filepath)) {
			$model = JModelLegacy::getInstance('Import', 'GuildCraft');
			$model->import($filepath);
		}

		parent::display();
	}
}
