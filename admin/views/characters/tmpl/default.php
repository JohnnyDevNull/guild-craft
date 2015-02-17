<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

// Das Tooltip Behavior wird geladen
JHtml::_('behavior.tooltip');

?>
<form action="index.php?option=com_guildcraft&view=characters"
	  method="post"
	  id="adminForm"
	  name="adminForm">
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
		<table class="table table-striped table-hover">
			<colgroup>
				<col style="width: 30px" />
				<col style="width: 80px" />
				<col style="" />
				<col style="width: 100px" />
				<col style="width: 100px" />
				<col style="width: 100px" />
				<col style="width: 80px" />
			</colgroup>
			<thead>
				<tr>
					<th><?php echo JHtml::_('grid.checkall'); ?></th>
					<th><?php echo JText::_('COM_GUILDCRAFT_NUM'); ?></th>
					<th><?php echo JText::_('COM_GUILDCRAFT_CHARACTERS_NAME') ;?></th>
					<th><?php echo JText::_('COM_GUILDCRAFT_CHARACTERS_LEVEL') ;?></th>
					<th><?php echo JText::_('COM_GUILDCRAFT_CHARACTERS_CLASS') ;?></th>
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
					<td><?php echo JHtml::_('grid.id', $i, $row->id); ?></td>
					<td><?php echo $this->pagination->getRowOffset($i); ?></td>
					<td>
						<a href="<?php echo $link; ?>"
						   title="<?php echo JText::_('COM_GUILDCRAFT_EDIT_CHARACTER'); ?>">
							<?php echo $row->nickname; ?>
						</a>
					</td>
					<td><?php echo $row->level; ?></td>
					<td><?php echo $row->class; ?></td>
					<td align="center">
						<?php echo JHtml::_(
							'jgrid.published',
							$row->published,
							$i,
							'characters.',
							true,
							'cb'
						);?>
					</td>
					<td align="center"><?php echo $row->c_id; ?></td>
				</tr>
				<?php endforeach; ?>
			<?php endif; ?>
			</tbody>
			<tfoot>
				<tr><td colspan="7"><?php echo $this->pagination->getListFooter(); ?></td></tr>
			</tfoot>
		</table>
		<input type="hidden" name="task" value=""/>
		<input type="hidden" name="boxchecked" value="0"/>
	</div>
	<?php echo JHtml::_('form.token'); ?>
</form>
