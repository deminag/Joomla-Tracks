<?php
/**
* @version    $Id: projectroundresult.php 133 2008-06-08 10:24:29Z julienv $
* @package    JoomlaTracks
* @copyright  Copyright (C) 2008 Julien Vonthron. All rights reserved.
* @license    GNU/GPL, see LICENSE.php
* Joomla Tracks is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// No direct access
defined('_JEXEC') or die('Restricted access');

// Include library dependencies
jimport('joomla.filter.input');

/**
* Subround result Table class
*
* @package  Tracks
* @since    0.1
*/
class TracksTableSubroundresult extends FOFTable
{
	/**
	 * constructor
	 *
	 * @param   string           $table  name of the table
	 * @param   string           $key    table primary key
	 * @param   JDatabaseDriver  &$db    A database connector object
	 */
	public function __construct($table, $key, &$db)
	{
		parent::__construct('#__tracks_rounds_results', 'id', $db);
	}
}