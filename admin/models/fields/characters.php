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
JFormHelper::loadFieldClass('list');

/**
 * JFormFieldCharacters JFormFieldList
 *
 * @since 0.0.1
 */
class JFormFieldCharacters extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var string
	 */
	protected $type = 'Lists';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return array An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id,name');
		$query->from('#__guildcraft_characters');
		$db->setQuery((string) $query);
		$characters = $db->loadObjectList();
		$options  = array();
 
		if ($characters)
		{
			foreach ($characters as $character)
			{
				$options[] = JHtml::_('select.option', $character->id, $character->name);
			}
		}
 
		$options = array_merge(parent::getOptions(), $options);
 
		return $options;
	}
}
