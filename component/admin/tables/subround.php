<?php
/**
* @version    $Id$ 
* @package    JoomlaTracks
* @copyright	Copyright (C) 2008 Julien Vonthron. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla Tracks is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Include library dependencies
jimport('joomla.filter.input');

/**
* Projectrounds Table class
*
* @package		Tracks
* @since 0.1
*/
class TableSubround extends JTable
{
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	function __construct(& $db) {
		parent::__construct('#__tracks_projects_subrounds', 'id', $db);
	}

	/**
	 * Overloaded check method to ensure data integrity
	 *
	 * @access public
	 * @return boolean True on success
	 * @since 1.0
	 */
	function check()
	{
		if ( !$this->projectround_id ) 
		{			
			$this->setError( JTEXT::_('COM_TRACKS_Error_check_missing_projectround_id') );
			return false;
		}
    if ( !$this->type ) 
    {     
      $this->setError( JTEXT::_('COM_TRACKS_Error_check_missing_subround_type') );
      return false;
    }
		return true;
	}
}
?>
