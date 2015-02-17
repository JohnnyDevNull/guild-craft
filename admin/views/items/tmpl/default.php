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
