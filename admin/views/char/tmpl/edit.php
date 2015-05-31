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
JHtml::_('bootstrap.tooltip', '.hasTip');
 
$actionLink = JRoute::_('index.php?option=com_guildcraft&layout=edit&id='.(int)$this->item->id);
?>
<form action="<?php echo $actionLink; ?>" method="post" name="adminForm" id="adminForm">
    <fieldset class="adminform">
        <legend><?php echo JText::_('COM_GUILDCRAFT_CHAR_DETAILS'); ?></legend>
 
        <?php foreach ($this->form->getFieldset() as $field): ?>
            <?php echo $field->label;
            echo $field->input; ?>
        <?php endforeach; ?>
    </fieldset>
    <div>
        <input type="hidden" name="task" value="guildcraft.edit"/>
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
