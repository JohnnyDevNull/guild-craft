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
 * GuildCraftModelImport JModelLegacy
 *
 * @package Joomla.Administrator
 * @subpackage com_guildcraft
 *
 * @author Philipp John <info@jplace.de>
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @link https://github.com/JohnnyDevNull/guild-craft The GitHub project page
 * @license http://www.gnu.org/licenses/gpl-3.0
 */
class GuildCraftModelImport extends JModelLegacy
{
	/**
	 * @var JDatabaseQuery
	 */
	protected $_query;

	/**
	 * @param array $config
	 */
	public function __construct(array $config = array())
	{
		parent::__construct($config);

		if (empty($this->_query)) {
			$this->_query = $this->_db->getQuery(true);
		}
	}

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

			if (!empty($func) && method_exists($this, $func)) {
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
		switch ($filename) {
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

		return $funcName;
	}

	/**
	 * Imports the getDataResourceCharacterClasses.json data from the blizz api.
	 *
	 * @param mixed[] $data
	 */
	protected function _importClasses($data)
	{
		$updateCount = 0;
		$insertCount = 0;

		if (isset($data['classes'])) {
			foreach ($data['classes'] as $class) {
				$this->_query->clear();

				$fields = array (
					'id' => (int)$class['id'],
					'mask' => (int)$class['mask'],
					'powertype' => $this->_db->quote($class['powerType'], true),
					'name' => $this->_db->quote($class['name'], true),
				);

				$sql = 'SELECT COUNT(1)
						FROM `'.$this->_db->getPrefix().'guildcraft_classes`
						WHERE `id` = '.(int)$class['id'];
				$this->_db->setQuery($sql);

				if ((bool)$this->_db->loadResult()) {
					// UPDATE
					$where = array_slice($fields, 0, 1);
					$this->_query
						->update('#__guildcraft_classes')
						->set($this->_getQueryArray($fields))
						->where($this->_getQueryArray($where));
					$updateCount++;
				} else {
					// INSERT
					$columns = array_keys($fields);
					$values = array_values($fields);
					$this->_query
						->insert('#__guildcraft_classes')
						->columns($this->_db->quoteName($columns))
						->values(implode(',', $values));
					$insertCount++;
				}

				$this->_db->setQuery($this->_query);
				$this->_db->execute();
			}
		}

		$this->_importMessage($insertCount, $updateCount);
	}

	/**
	 * Imports the getDataResourceCharacterRaces.json data from the blizz api.
	 *
	 * @param mixed[] $data
	 */
	protected function _importRaces($data)
	{
		$updateCount = 0;
		$insertCount = 0;

		if (isset($data['races'])) {
			foreach ($data['races'] as $race) {
				$this->_query->clear();

				$fiels = array (
					'id' => (int)$race['id'],
					'mask' => (int)$race['mask'],
					'side' => $this->_db->quote($race['side'], true),
					'name' => $this->_db->quote($race['name'], true),
				);

				$sql = 'SELECT COUNT(1)
						FROM `'.$this->_db->getPrefix().'guildcraft_races`
						WHERE `id` = '.(int)$race['id'];
				$this->_db->setQuery($sql);

				if ((bool)$this->_db->loadResult()) {
					// UPDATE
					$where = array_slice($fiels, 0, 1);
					$this->_query
						->update('#__guildcraft_races')
						->set($this->_getQueryArray($fiels))
						->where($this->_getQueryArray($where));
					$updateCount++;
				} else {
					// INSERT
					$columns = array_keys($fiels);
					$values = array_values($fiels);
					$this->_query
						->insert('#__guildcraft_races')
						->columns($this->_db->quoteName($columns))
						->values(implode(',', $values));
					$insertCount++;
				}

				$this->_db->setQuery($this->_query);
				$this->_db->execute();
			}
		}

		$this->_importMessage($insertCount, $updateCount);
	}

	/**
	 * Imports the getGuild.json data from the blizz api.
	 *
	 * @param mixed[] $data
	 */
	protected function _importGuild($data)
	{
		$updateCount = 0;
		$insertCount = 0;

		if (!empty($data) && is_array($data)) {
			foreach ($data as $key => $value) {
				if (is_array($value)) {
					$value = json_encode($value);
				}

				$this->_query->clear();

				$sql = 'SELECT COUNT(1)
						FROM `'.$this->_db->getPrefix().'guildcraft_data`
						WHERE `key` = '.$this->_db->quote($key, true);
				$this->_db->setQuery($sql);

				if ((bool)$this->_db->loadResult()) {
					// UPDATE
					$this->_query
						->update($this->_db->quoteName('#__guildcraft_data'))
						->set('`value` = ' . $this->_db->quote($value, true))
						->where('`key` = ' . $this->_db->quote($key, true));
					$updateCount++;
				} else {
					// INSERT
					$this->_query
						->insert('#__guildcraft_data')
						->columns('`key`, `value`')
						->values (
							'"'.$this->_db->escape($key).'",'.
							'"'.$this->_db->escape($value).'"'
						);
					$insertCount++;
				}

				$this->_db->setQuery($this->_query);
				$this->_db->execute();
			}
		}

		$this->_importMessage($insertCount, $updateCount);
	}

	/**
	 * Imports the getGuildMembers.json data from the blizz api.
	 *
	 * @param mixed[] $data
	 */
	protected function _importMembers($data)
	{
		$updateCount = 0;
		$insertCount = 0;

		if (isset($data['members'])) {
			foreach ($data['members'] as $member) {
				$this->_query->clear();

				$spec = empty($member['character']['spec'])
					  ? '"{}"'
					  : $this->_db->quote(json_encode($member['character']['spec']), true);

				$realm = empty($member['character']['realm'])
					   ? (empty($member['character']['guildRealm'])
							? ''
							: $member['character']['guildRealm'])
					   : $member['character']['realm'];

				if (empty($realm)) {
					continue;
				}

				$fields = array (
					'name' => $this->_db->quote($member['character']['name'], true),
					'realm' => $this->_db->quote($realm, true),
					'rank_id' => (int)$member['rank'],
					'race_id' => (int)$member['character']['race'],
					'class_id' => (int)$member['character']['class'],
					'level' => (int)$member['character']['level'],
					'gender' => (int)$member['character']['gender'],
					'achievement_points' => (int)$member['character']['achievementPoints'],
					'thumbnail' => $this->_db->quote($member['character']['thumbnail'], true),
					'spec' => $spec,
					'published' => 0,
				);

				$sql = 'SELECT COUNT(1)
						FROM `'.$this->_db->getPrefix().'guildcraft_characters`
						WHERE `name` = '.$this->_db->quote($member['character']['name'], true).'
							AND `realm` = '.$this->_db->quote($realm, true);
				$this->_db->setQuery($sql);

				if ((bool)$this->_db->loadResult()) {
					// UPDATE
					$where = array_slice($fields, 0, 2);
					$this->_query
						->update('#__guildcraft_characters')
						->set($this->_getQueryArray($fields))
						->where($this->_getQueryArray($where));
					$updateCount++;
				} else {
					// INSERT
					$columns = array_keys($fields);
					$values = array_values($fields);
					$this->_query
						->insert('#__guildcraft_characters')
						->columns($this->_db->quoteName($columns))
						->values(implode(',', $values));
					$insertCount++;
				}

				$this->_db->setQuery($this->_query);
				$this->_db->execute();
			}
		}

		$this->_importMessage($insertCount, $updateCount);
	}

	/**
	 * @param int $insertCount
	 * @param int $updateCount
	 */
	protected function _importMessage($insertCount, $updateCount)
	{
		JFactory::getApplication()->enqueueMessage (
			'Import erfolgreich durchgeführt. Es wurden '.$insertCount.' neue '
			.' importiert und '.$updateCount.' Einträge aktualisiert.'
		);
	}

	/**
	 * @param mixed[] $fields
	 * @return string[]
	 */
	protected function _getQueryArray(array $fields)
	{
		$setArray = array();

		foreach ($fields as $key => $value) {
			$setArray[] = $this->_db->quoteName($key).' = '.$value;
		}

		return $setArray;
	}
}
