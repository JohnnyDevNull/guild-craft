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
			</colgroup>
			<thead>
				<tr>
					<th><?php echo JHtml::_('grid.checkall'); ?></th>
					<th><?php echo JText::_('COM_GUILDCRAFT_NUM'); ?></th>
					<th><?php echo JText::_('COM_GUILDCRAFT_CHARACTERS_NAME') ;?></th>
					<th><?php echo JText::_('COM_GUILDCRAFT_CHARACTERS_LEVEL') ;?></th>
					<th><?php echo JText::_('COM_GUILDCRAFT_CHARACTERS_CLASS') ;?></th>
					<th class="text-center"><?php echo JText::_('COM_GUILDCRAFT_PUBLISHED'); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $character) :
					//var_dump($this->classes);
					$link = JRoute::_('index.php?option=com_guildcraft&task=char.edit&id=' . $character->id);
				?>
				<tr>
					<td><?php echo JHtml::_('grid.id', $i, $character->id); ?></td>
					<td><?php echo $this->pagination->getRowOffset($i); ?></td>
					<td>
						<a href="<?php echo $link; ?>"
						   title="<?php echo JText::_('COM_GUILDCRAFT_EDIT_CHARACTER'); ?>">
							<?php echo $character->name; ?>
						</a>
					</td>
					<td><?php echo $character->level; ?></td>
					<td><?php echo $this->classes[$character->class_id]->name; ?></td>
					<td class="text-center">
						<?php echo JHtml::_('jgrid.published', $character->published, $i, 'characters.', true, 'cb' ); ?>
					</td>
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
