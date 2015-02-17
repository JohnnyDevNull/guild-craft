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
<form action="index.php?option=com_guildcraft&view=items"
	  method="post"
	  id="adminForm"
	  name="adminForm">
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
		<h3><?php echo JText::_('COM_GUILDCRAFT_COMING_SOON'); ?></h3>
		<input type="hidden" name="task" value=""/>
		<input type="hidden" name="boxchecked" value="0"/>
	</div>
	<?php echo JHtml::_('form.token'); ?>
</form>
