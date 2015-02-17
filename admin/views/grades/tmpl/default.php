<?php
/**
 * @package Joomla.Administrator
 * @subpackage com_guildcraft
 *
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-3.0
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

// Das Tooltip Behavior wird geladen
JHtml::_('behavior.tooltip');

?>
<form action="index.php?option=com_guildcraft&view=grades"
	  method="post"
	  id="adminForm"
	  name="adminForm">
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
		<table class="table table-striped table-hover">
			<thead>
			<tr>
				<th><?php echo JText::_('COM_GUILDCRAFT_NUM'); ?></th>
				<th><?php echo JHtml::_('grid.checkall'); ?></th>
				<th><?php echo JText::_('COM_GUILDCRAFT_GRADES_NAME') ;?></th>
				<th><?php echo JText::_('COM_GUILDCRAFT_PUBLISHED'); ?></th>
				<th><?php echo JText::_('COM_GUILDCRAFT_ID'); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) :
					$link = JRoute::_('index.php?option=com_guildcraft&task=char.edit&id=' . $row->id);
				?>
					<tr>
						<td><?php echo $this->pagination->getRowOffset($i); ?></td>
						<td><?php echo JHtml::_('grid.id', $i, $row->id); ?></td>
						<td>
							<a href="<?php echo $link; ?>"
							   title="<?php echo JText::_('COM_GUILDCRAFT_EDIT_GRADE'); ?>">
								<?php echo $row->name; ?>
							</a>
						</td>
						<td align="center"><?php echo JHtml::_('jgrid.published', $row->published, $i, 'grades.', true, 'cb'); ?></td>
						<td align="center"><?php echo $row->id; ?></td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="5"><?php echo $this->pagination->getListFooter(); ?></td>
				</tr>
			</tfoot>
		</table>
		<input type="hidden" name="task" value=""/>
		<input type="hidden" name="boxchecked" value="0"/>
	</div>
	<?php echo JHtml::_('form.token'); ?>
</form>
