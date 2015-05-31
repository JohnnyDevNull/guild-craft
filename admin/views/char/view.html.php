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
 * HalloWelt View.
 */
class GuildCraftViewChar extends JViewLegacy
{
    /**
     * @var stdClass
     */
    protected $item;
 
    /**
     * @var JForm
     */
    protected $form;
 
    /**
     * display method of Character view.
     *
     * @param string $tpl [default: null]
     */
    public function display($tpl = null)
    {
        // Die Daten werden bezogen.
        $this->item = $this->get('Item');
 
        // Das Formular.
        $this->form = $this->get('Form');
 
        // Die Toolbar hinzufügen.
        $this->addToolBar();
 
        // Das Template wird aufgerufen.
        parent::display($tpl);
    }
 
    /**
     * Setting the toolbar.
     */
    protected function addToolBar()
    {
        JFactory::getApplication()->input->set('hidemainmenu', true);
 
        $isNew = ($this->item->id == 0);
 
        JToolBarHelper::title(
            $isNew
            ? JText::_('COM_GUILDCRAFT_MANAGER_CHAR_NEW')
            : JText::_('COM_GUILDCRAFT_MANAGER_CHAR_EDIT')
        );
 
        JToolBarHelper::save('char.save');
 
        JToolBarHelper::cancel('char.cancel',
            $isNew
            ? 'JTOOLBAR_CANCEL'
            : 'JTOOLBAR_CLOSE');
    }
}
