<?php
/**
* @version    $Id: view.html.php 135 2008-06-08 21:50:12Z julienv $ 
* @package    JoomlaTracks
* @copyright	Copyright (C) 2008 Julien Vonthron. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla Tracks is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Tracks component
 *
 * @static
 * @package		Tracks
 * @since 0.1
 */
class TracksViewProjectindividuals extends JView
{
  function display($tpl = null)
  {
    $mainframe = &JFactory::getApplication();
		$option = JRequest::getCmd('option');

    $project_id = JRequest::getVar( 'p', 0, '', 'int' );
    $params = $mainframe->getParams();
    
    $model =& $this->getModel();
    $individuals = $model->getIndividuals( $project_id );
    $project  = $model->getProject( $project_id );
    $projectparams = & $model->getParams($project_id);

    $breadcrumbs =& $mainframe->getPathWay();
    $breadcrumbs->addItem( $project->name. ' ' . JText::_('COM_TRACKS_Participants' ), 'index.php?option=com_tracks&view=projectindividuals&p=' . $project_id );

    $document =& JFactory::getDocument();
    $document->setTitle( $project->name. ' ' . JText::_('COM_TRACKS_Participants' ) );
    
    $this->assignRef( 'params',    $params );
    $this->assignRef( 'project',    $project );
    $this->assignRef( 'projectparams',    $projectparams );
    
    $individuals = $this->orderRanking($individuals);
    $this->assignRef( 'individuals',	$individuals );

    parent::display($tpl);
  }
  
  private function orderRanking($individuals)
  {  	
		require_once (JPATH_SITE.DS.'components'.DS.'com_tracks'.DS.'sports'.DS.'default'.DS.'rankingtool.php');
  	$rankingtool = new TracksRankingTool($this->project->id);
  	$ranking = $rankingtool->getIndividualsRankings();
  	
  	$sorted = array();
  	foreach ($individuals as $k => $i)
  	{
  		if (isset($ranking[$i->id])) {
  			$individuals[$k]->rank = $ranking[$i->id]->rank;
  		}
  		else {
  			$individuals[$k]->rank = 0;
  		}
  	}
  	
  	uasort($individuals, array('TracksFrontViewProjectindividuals', '_sortRanking'));
  	
  	return $individuals;
  }
  
  private function _sortRanking($a, $b)
  {
  	if (!$a->rank && $b->rank) {
  		return $b;
  	}
  	if ($a->rank && !$b->rank) {
  		return $a;
  	}
  	if ($a->rank != $b->rank) {
  		return $a->rank-$b->rank;
  	}
  	else {
  		return strcasecmp($a->last_name.$a->first_name, $b->last_name.$b->first_name);
  	}
  }
}
?>
