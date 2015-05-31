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
 * GuildCraft Import Model
 */
class GuildCraftModelImport extends JModelLegacy
{
	/**
	 * Starts the import.
	 *
	 * @return bool
	 */
	public function import($filepath)
	{
		$content = file_get_contents($filepath);

		if (
			!empty($content)
			&& ($jsonData = json_decode($content, true)) !== false
		) {
			$func = $this->_getImportFunctionFromFilename(basename($filepath, '.json'));

			if(!empty($func) && method_exists($this, $func)) {
				return $this->$func($jsonData);
			}
		}

		return false;
	}

	/**
	 * Matches the filenames to a specific import function.
	 *
	 * @param string $filename
	 * @return string
	 */
	protected function _getImportFunctionFromFilename($filename)
	{
		switch($filename) {
			case 'getDataResourceCharacterClasses':
				$funcName = '_importClasses';
				break;

			case 'getDataResourceCharacterRaces':
				$funcName = '_importRaces';
				break;

			case 'getGuild':
				$funcName = '_importGuild';
				break;

			case 'getGuildMembers':
				$funcName = '_importMembers';
				break;

			default:
				$funcName = '';
		}

		if(!empty($funcName)) {
			$funcName = ucfirst($funcName);
		}

		return $funcName;
	}

	/**
	 * Imports the getDataResourceCharacterClasses.json data from the blizz api.
	 *
	 * @param mixed[] $jsonData
	 */
	protected function _importClasses($jsonData)
	{
		if(isset($jsonData['classes'])) {
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);

			foreach($jsonData['classes'] as $class) {
				$query->insert('#__guildcraft_classes')
					  ->columns('id, mask, power_type, name')
					  ->values ( 
						  $class['id'].','
						  .$class['mask'].','
						  .$class['power_type'].','
						  .$class['name']);
				$db->setQuery($query);
			}

			return $db->execute();
		}
	}

	/**
	 * Imports the getDataResourceCharacterRaces.json data from the blizz api.
	 *
	 * @param mixed[] $jsonData
	 */
	protected function _importRaces($jsonData)
	{
		if(isset($jsonData['races'])) {
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);

			foreach($jsonData['races'] as $class) {
				$query->insert('#__guildcraft_races')
					  ->columns('id, mask, side, name')
					  ->values(
						  $class['id'].','
						  .$class['mask'].','
						  .$class['side'].','
						  .$class['name']);
				$db->setQuery($query);
			}

			return $db->execute();
		}
	}

	/**
	 * Imports the getGuild.json data from the blizz api.
	 *
	 * @param mixed[] $jsonData
	 */
	protected function _importGuild($jsonData)
	{
		if(!empty($jsonData) && is_array($jsonData)) {
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);

			foreach($jsonData as $key => $value) {
				if(in_array($key, array('name', 'realm'))){
					continue;
				}

				$query->insert('#__guildcraft_guild')
					  ->columns('key, value')
					  ->values($db->escape($key).','.$db->escape($value));
				$db->setQuery($query);
			}

			return $db->execute();
		}
	}

	/**
	 * Imports the getGuildMembers.json data from the blizz api.
	 *
	 * @param mixed[] $jsonData
	 */
	protected function _importMembers($jsonData)
	{
		if(isset($jsonData['members'])) {
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);

			foreach($jsonData['members'] as $members) {

				$fields = array (
					'char_id' => 0,
					'user_id' => 0,
					'name' => $db->escape($members['name']),
					'class' => $db->escape($members['class']),
					'race' => (int)$members['race'],
					'gender' => (int)$members['gender'],
					'level' => (int)$members['level'],
					'achievment_points' => (int)$members['achievmentPoints'],
					'thumbnail' => $db->escape($members['thumbnail']),
					'spec' => $db->escape(json_encode($members['spec'])),
				);
				$columns = implode(array_keys($fields));
				$values = '"'.implode('","', array_values($fields)).'"';

				$query->insert('#__guildcraft_characters')
					  ->columns($columns)
					  ->values($values);
				$db->setQuery($query);
			}

			return $db->execute();
		}
	}
}
