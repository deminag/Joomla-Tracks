<?php
/**
* @version    $Id: view.html.php 25 2008-02-15 09:00:36Z julienv $ 
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

require_once (JPATH_COMPONENT.DS.'abstract'.DS.'tracksview.php');

/**
 * HTML View class for the Tracks component
 *
 * @static
 * @package		Tracks
 * @since 0.1
 */
class TracksViewProjectindividual extends JView
{
	function display($tpl = null)
	{
		$mainframe = JFactory::getApplication();
		$option = JRequest::getCmd('option');

		if($this->getLayout() == 'form') {
			$this->_displayForm($tpl);
			return;
		}

		//get the project
		$projectindividual = $this->get('data');
		
		parent::display($tpl);
	}

	function _displayForm($tpl)
	{
		$mainframe = JFactory::getApplication();
		$option = JRequest::getCmd('option');

		$db		= JFactory::getDBO();
		$uri 	= JFactory::getURI();
		$user 	= JFactory::getUser();
		$model	= $this->getModel();

		JHTML::_('behavior.formvalidation');
		
		$lists = array();
		//get the project
		$projectindividual	= $this->get('data');
		$isNew		= ($projectindividual->id < 1);

		// fail if checked out not by 'me'
		if ($model->isCheckedOut( $user->get('id') )) 
    {
			$msg = JText::sprintf( 'DESCBEINGEDITTED', JText::_('COM_TRACKS_The_project_participant' ), 
                              $projectindividual->first_name. ' ' . $projectindividual->last_name );
			$mainframe->redirect( 'index.php?option='. $option, $msg );
		}

		// Edit or Create?
		if (!$isNew) {
			$model->checkout( $user->get('id') );
		}
		else
		{
			// initialise new record
			$projectindividual->project_id 	= $mainframe->getUserState( $option.'project' );
		}
		    
		// build the html select list
		//$lists['published'] 		= JHTML::_('select.booleanlist',  'published', 'class="inputbox"', $projectindividual->published );

		$this->assignRef('lists',		$lists);
		$this->assignRef('form',		$this->get('form'));
		$this->assignRef('projectindividual',		$projectindividual);

		parent::display($tpl);
	}
}
?>
