<?php
/**
* @version    $Id: form.php 89 2008-05-02 06:46:38Z julienv $ 
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

<?php
	// Set toolbar items for the page
	$edit		= JRequest::getVar('edit',true);
	$text = !$edit ? JText::_('COM_TRACKS_New' ) : JText::_('COM_TRACKS_Edit' );
	JToolBarHelper::title(   JText::_('COM_TRACKS_Project' ).': <small><small>[ ' . $text.' ]</small></small>' );
	JToolBarHelper::save();
	JToolBarHelper::apply();
	if (!$edit)  {
		JToolBarHelper::cancel();
	} else {
		// for existing items the button is renamed `close`
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
    JToolBarHelper::help( 'screen.tracks.edit', true );
?>

<script type="text/javascript">
	Joomla.submitbutton = function (pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			Joomla.submitform( pressbutton );
			return;
		}

		// do field validation
    var validator = document.formvalidator;
		if (validator.validate(form.individual_id) === false) {
			alert( "<?php echo JText::_('COM_TRACKS_You_must_chose_a_person', true ); ?>" );
		} else {
			Joomla.submitform( pressbutton );
		}
	}
</script>
<style type="text/css">
	table.paramlist td.paramlist_key {
		width: 92px;
		text-align: left;
		height: 30px;
	}
</style>

<div id="tracksmain">
<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col50">
	<fieldset class="adminform">
		<legend><?php echo JText::_('COM_TRACKS_Project_Participant' ); ?></legend>

		<ul class="adminformlist">
			<li>
				<?php echo $this->form->getLabel('individual_id'); ?>
				<?php echo $this->form->getInput('individual_id'); ?>
			</li>
			<li>
				<?php echo $this->form->getLabel('number'); ?>
				<?php echo $this->form->getInput('number'); ?>
			</li>
			<li>
				<?php echo $this->form->getLabel('team_id'); ?>
				<?php echo $this->form->getInput('team_id'); ?>
			</li>
		</ul>
	</fieldset>
</div>

<div class="clr"></div>

<input type="hidden" name="option" value="com_tracks" />
<input type="hidden" name="controller" value="projectindividual" />
<input type="hidden" name="cid[]" value="<?php echo $this->projectindividual->id; ?>" />
<input type="hidden" name="project_id" value="<?php echo $this->projectindividual->project_id; ?>" />
<input type="hidden" name="task" value="" />
</form>
</div>