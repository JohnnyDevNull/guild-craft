<?php
 
// Den direkten Aufruf verbieten.
defined('_JEXEC') or die;
 
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
     * display method of HalloWelt view.
     *
     * @param null $tpl
     *
     * @return void
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
