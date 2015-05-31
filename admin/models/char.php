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
jimport('joomla.application.component.modeladmin');

/**
 * Char Model
 *
 * @since  0.0.1
 */
class GuildCraftModelChar extends JModelAdmin
{
    /**
     * Returns a reference to the a Table object, always creating it.
     *
     * @param string $name The table name. Optional.
     * @param string $prefix The class prefix. Optional.
     * @param array $options Configuration array for model. Optional.
     * @return  JTable
     */
    public function getTable($name = 'Char', $prefix = 'GuildcraftTable', $options = array())
    {
        return JTable::getInstance($name, $prefix, $options);
    }

    /**
     * Method to get the record form.
     *
     * @param array $data Data for the form.
     * @param boolean $loadData True if the form is to load its own data (default case), false if not.
     * @return mixed A JForm object on success, false on failure
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm('com_guildcraft.char', 'char',
            array('control' => 'jform', 'load_data' => $loadData)
        );
 
        if (empty($form))
        {
            return false;
        }
 
        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @since       1.6
     * @return      mixed   The data for the form.
     */
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()
            ->getUserState('com_guildcraft.edit.char.data');
 
        if (empty($data))
        {
            $data = $this->getItem();
        }
 
        return $data;
    }
}
