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
<form action="index.php?option=com_guildcraft&view=dashboard"
	  method="post"
	  id="adminForm"
	  name="adminForm">
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
		<div class="row-fluid">
			<div class="span4" style="padding-right: 10px;">
				<h3><?php echo JText::_('COM_GUILDCRAFT_DASHBOARD_GUILD_HEADING'); ?></h3>
				<table class="table">
					<tr>
						<td><?php echo JText::_('COM_GUILDCRAFT_DASHBOARD_GUILD_NAME_LABEL'); ?></td>
						<td><?php echo $this->guild['name'] ?: JText::_('COM_GUILDCRAFT_NA'); ; ?></td>
					</tr>
				</table>
			</div>
			<div class="span3" style="padding: 0px 10px;">
				<h3><?php echo JText::_('COM_GUILDCRAFT_DASHBOARD_STATISTIC_HEADING'); ?></h3>
				<table class="table">
					<?php foreach($this->items['statistic'] as $key => $count) : ?>
					<tr>
						<td><?php echo JText::_('COM_GUILDCRAFT_DASHBOARD_STATISTIC_'.strtoupper($key).'_LABEL'); ?></td>
						<td><?php echo $count; ?></td>
					</tr>
					<?php endforeach; ?>
				</table>
			</div>
			<div class="span5" style="padding-left: 10px;">
				<h3><?php echo JText::_('COM_GUILDCRAFT_DASHBOARD_CACHE_HEADING'); ?></h3>
				<table class="table">
					<?php foreach($this->cachedFiles as $file) :
						$filepath = JPATH_COMPONENT.DS.'cache'.DS.$file;
						$actionUrl = 'index.php?option=com_guildcraft&view=dashboard&task=removeCachedFile&file='.$file;
						?>
						<tr>
							<td><?php echo $file ?></td>
							<td><i class="icon-calendar"></i> <?php echo date('Y-m-d H:i:s', filemtime($filepath)); ?></td>
							<td style="text-align: right;">
								<?php echo round((filesize($filepath) / 1024), 2); ?> Kb
							</td>
							<td style="text-align: right;">
								<a class="btn btn-micro hasTooltip"
								   title="Chache Datei löschen"
								   href="<?php echo $actionUrl; ?>">
									<i class="icon-trash"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
		<input type="hidden" name="task" value=""/>
		<input type="hidden" name="boxchecked" value="0"/>
	</div>
	<?php echo JHtml::_('form.token'); ?>
</form>