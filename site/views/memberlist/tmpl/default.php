<?php
/**
 * @package Joomla.Site
 * @subpackage com_guildcraft
 *
 * @author Philipp John <info@jplace.de>
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @link https://github.com/JohnnyDevNull/guild-craft The GitHub project page
 * @license http://www.gnu.org/licenses/gpl-3.0
 */

defined('_JEXEC') or die('RESTRICTED ACCESS');

?>
<table class="table gc-memberlist">
	<colgroup>
		<col style="width: 40px" />
		<col style="width: 80px" />
		<col style="" />
		<col style="width: 80px" />
	</colgroup>
	<thead>
		<tr>
			<th><?php echo JText::_('COM_GUILDCRAFT_NUM'); ?></th>
			<th><?php echo JText::_('COM_GUILDCRAFT_CHARACTERS_LEVEL') ;?></th>
			<th><?php echo JText::_('COM_GUILDCRAFT_CHARACTERS_NAME') ;?></th>
			<th><?php echo JText::_('COM_GUILDCRAFT_CHARACTERS_CLASS') ;?></th>
		</tr>
	</thead>
	<tbody>
	<?php if (!empty($this->items)) : ?>
		<?php foreach ($this->items as $i => $item) : ?>
			<tr>
				<td><?php echo $i + 1; ?></td>
				<td><?php echo $item->level ?></td>
				<td><?php echo $item->name ?></td>
				<td><?php echo $item->class ?></td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
	</tbody>
	<tfoot>
		<tr><td colspan="4"><?php echo $this->pagination->getListFooter(); ?></td></tr>
	</tfoot>
</table>