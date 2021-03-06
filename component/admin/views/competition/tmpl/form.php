<?php
/**
 * @version    $Id: form.php 94 2008-05-02 10:28:05Z julienv $
 * @package    JoomlaTracks
 * @copyright	Copyright (C) 2008 Julien Vonthron. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla Tracks is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

defined('_JEXEC') or die('Restricted access'); ?>

<?php JHTML::_('behavior.tooltip'); ?>
<?php JHTML::_('behavior.formvalidation'); ?>

<?php
// Set toolbar items for the page
$edit		= JRequest::getVar('edit',true);
$text = !$edit ? JText::_('COM_TRACKS_New' ) : JText::_('COM_TRACKS_Edit' );
JToolBarHelper::title(   JText::_('COM_TRACKS_Competition' ).': <small><small>[ ' . $text.' ]</small></small>' );
JToolBarHelper::save();
JToolBarHelper::apply();
if (!$edit)  {
	JToolBarHelper::cancel();
} else {
	// for existing items the button is renamed `close`
	JToolBarHelper::cancel( 'cancel', 'Close' );
}
JToolBarHelper::help( 'screen.tracks.edit' );
?>

<script language="javascript" type="text/javascript">
	Joomla.submitbutton = function (pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			Joomla.submitform( pressbutton );
			return;
		}

    // do field validation
    var validator = document.formvalidator;
    if ( validator.validate(form.name) === false ){
      alert( "<?php echo JText::_('COM_TRACKS_COMPETITION_NAME_IS_REQUIRED', true ); ?>" );
    } else {
    	Joomla.submitform( pressbutton );
    }
	}
</script>

<div id="tracksmain">
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="width-50">
<fieldset class="adminform">
	<legend><?php echo JText::_('COM_TRACKS_Competition' ); ?></legend>
	<ul class="adminformlist">
		<li>
			<label for="name"> <?php echo JText::_('COM_TRACKS_Name' ); ?>:</label>
			<input class="text_area required" type="text" name="name" id="name"
		         size="32" maxlength="250" value="<?php echo $this->object->name?>" />
		</li>
		<li>
			<label for="alias"> <?php echo JText::_('COM_TRACKS_Alias' ); ?>:</label>
				<input class="text_area" type="text" name="alias" id="alias"
               size="32" maxlength="250" value="<?php echo $this->object->alias?>" />
		</li>
		<li>
			<label for="published"><?php echo JText::_('COM_TRACKS_Published' ); ?>:</label>
			<?php echo $this->lists['published']; ?>
		</li>
		<li>
			<label for="ordering"> <?php echo JText::_('COM_TRACKS_Ordering' ); ?>:</label>
			<?php echo $this->lists['ordering']; ?>
		</li>
	</ul>
</fieldset>
</div>

<div class="clr"></div>

<input type="hidden" name="option" value="com_tracks" /> <input
	type="hidden" name="controller" value="competition" /> <input
	type="hidden" name="cid[]" value="<?php echo $this->object->id; ?>" />
<input type="hidden" name="task" value="" /></form>
</div>