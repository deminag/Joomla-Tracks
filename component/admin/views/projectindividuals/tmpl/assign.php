<?php
/**
* @version    $Id: assign.php 142 2008-06-10 17:00:28Z julienv $ 
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

<?php
$user 	= JFactory::getUser();

JHTML::_('behavior.tooltip');
?>
<script language="javascript" type="text/javascript">
  Joomla.submitbutton = function (pressbutton) {
    if (pressbutton) {
      document.adminForm.task.value=pressbutton;
    }
    
    // do field validation
    if (pressbutton == "saveassign" && document.adminForm.project_id.value == "0"){
      alert( "<?php echo JText::_('COM_TRACKS_You_must_select_a_project', true ); ?>" );
    } else {    
	    if (typeof document.adminForm.onsubmit == "function") {
	      document.adminForm.onsubmit();
	    }
	    document.adminForm.submit();
    }
  }
</script>
<div id="tracksmain">
<form action="<?php echo $this->request_url; ?>" method="post" name="adminForm" id="adminForm">
<div id="projectsel">
<?php echo JText::_('COM_TRACKS_Assign_to ' ) . $this->lists['projects']; ?>
</div>
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_('COM_TRACKS_Id' ); ?>
			</th>
			<th class="title">
        <?php echo JText::_('COM_TRACKS_Individual' ); ?>
			</th>
			<th class="title">
        <?php echo JText::_('COM_TRACKS_Team' ); ?>
			</th>
      <th width="10">
        <?php echo JText::_('COM_TRACKS_Number' ); ?>
      </th>
		</tr>
	</thead>
	<tbody>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->players ); $i < $n; $i++)
	{
		$row = $this->players[$i];
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $row->id; ?>
				<input id="cb<?php echo $i; ?>" type="hidden" value="<?php echo $row->id; ?>" name="cid[]"/>
			</td>
			<td>
				<?php
				echo $row->last_name.', '.$row->first_name;
				?>
			</td>
      <td>
				<?php echo JHTML::_('select.genericlist',  $this->teamoptions, 'team_id[]', 'class="inputbox" size="1"', 'id', 'name'); ?>
			</td>
			<td>
			  <input name="number[]" id="number<?php echo $row->id; ?>" type="text" value="" size="3" />
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
	</tbody>
	</table>
</div>

<input type="hidden" name="controller" value="projectindividual" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>
</div>