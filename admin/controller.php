<?php
/**
 * @package Joomla.Administrator
 * @subpackage com_guildcraft
 *
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// Die Joomla! JControllerLegacy Klasse importieren
jimport('joomla.application.component.controller');

/**
 * General Controller of HelloWorld component
 *
 * @package Joomla.Administrator
 * @subpackage com_guildcraft
 * @since 0.0.7
 */
class GuildCraftController extends JControllerLegacy
{
	/**
	 * The default view for the display method.
	 *
	 * @var string
	 * @since 12.2
	 */
	protected $default_view = 'dashboard';

	/**
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
}
