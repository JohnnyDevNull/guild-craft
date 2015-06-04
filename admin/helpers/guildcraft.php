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

/**
 * GuildCraft component helper.
 *
 * @author Philipp John <info@jplace.de>
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @link https://github.com/JohnnyDevNull/guild-craft The GitHub project page
 * @license http://www.gnu.org/licenses/gpl-3.0
 */
class GuildCraftHelper extends JHelperContent
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param string $vName The name of the active view.
	 * @return void
	 * @since 0.1
	 */
	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_GUILDCRAFT_SUBMENU_DASHBOARD'),
			'index.php?option=com_guildcraft&view=dashboard',
			$vName == 'dashboard'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_GUILDCRAFT_SUBMENU_CHARACTERS'),
			'index.php?option=com_guildcraft&view=characters',
			$vName == 'characters'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_GUILDCRAFT_SUBMENU_GRADES'),
			'index.php?option=com_guildcraft&view=ranks',
			$vName == 'grades'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_GUILDCRAFT_SUBMENU_ITEMS'),
			'index.php?option=com_guildcraft&view=items',
			$vName == 'items'
		);
	}

	/**
	 * Caches results to json files in the components cache folder.
	 *
	 * @param string $result The result to cache
	 * @param string $prefix The file prefix which will be suffixed by _.time()
	 * @param string $extension [optional] defaul: ".json"
	 */
	public static function cacheResult($result, $prefix, $extension = '.json')
	{
		jimport('joomla.filesystem.file');

		$filepath = JPATH_COMPONENT.DS.'cache'.DS.$prefix.$extension;
		return JFile::write($filepath, $result);
	}

	/**
	 * Checks if chached files for the new request exists.
	 *
	 * @param string $prefix The fileprefix to search for.
	 * @param int $cacheDuration [optional] default: 600
	 * @param string $extension [optional] default: ".json"
	 * @return false|string
	 */
	public static function getCachedResult($prefix, $cacheDuration = 600, $extension = '.json')
	{
		jimport('joomla.filesystem.folder');
		jimport('joomla.filesystem.file');

		$folder = JPATH_COMPONENT.DS.'cache'.DS;
		$fileArray = JFolder::files($folder, $prefix.'.*.\.json');

		foreach($fileArray as $file)
		{
			$filename = basename($file, $extension);
			$nameParts = explode('_', $filename);
			$timestamp = end($nameParts);
			$timediff = time() - (int)$timestamp;

			if($timediff > $cacheDuration)
			{
				JFile::delete($folder.$file);
			}
			else
			{
				return file_get_contents($folder.$file);
			}
		}

		return false;
	}

	/**
	 * Helper function to import classes from the components lib folder.
	 *
	 * @param string $path The path to the file seperated by dots like the jimport function does.
	 * @param string $class If a value is given a class_exists check will be performed and if it fails a JError thrown.
	 */
	public static function import($path, $class = '', $basePath = '')
	{
		if(empty($basePath)) {
			$basePath = JPATH_COMPONENT;
		}

		$parts = explode('.', $path);
		$filepath = $basePath.DS. 'lib'.DS.implode(DS, $parts).'.php';

		if(is_file($filepath)) {
			require_once $filepath;

			if(!empty($class) && !class_exists($class)) {
				JError::raiseError (
					500,
					'The requested helper class "'
						.htmlspecialchars($class)
						.'" could not be found.'
				);
			}
		}
	}
}
