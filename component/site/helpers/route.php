<?php
/**
* @version    $Id$ 
* @package    JoomlaTracks
* @copyright  Copyright (C) 2008 Julien Vonthron. All rights reserved.
* @license    GNU/GPL, see LICENSE.php
* Joomla Tracks is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

defined('_JEXEC') or die('Restricted access');

class TracksHelperRoute
{	
	/**
	 * return link to details view of specified event
	 * @param int $id
	 * @param int $xref
	 * @return url
	 */
	public static function getRoundResultRoute($id = 0)
	{
		$parts = array( "option" => "com_tracks",
		                "view"   => "roundresult" );
		if ($id) {
			$parts['pr'] = $id;
		}
		return self::buildUrl( $parts );
	}
	
	/**
	 * return link to details view of specified event
	 * @param int $id
	 * @param int $xref
	 * @return url
	 */
	public static function getRoundRoute($id = 0)
	{
		$parts = array( "option" => "com_tracks",
		                "view"   => "round" );
		if ($id) {
			$parts['r'] = $id;
		}
		return self::buildUrl( $parts );
	}
	
	public static function getIndividualRoute($id = 0, $project = 0)
	{
		$parts = array( "option" => "com_tracks",
		                "view"   => "individual" );		
		if ($id) {
			$parts['i'] = $id;
		}
		if ($project) {
			$parts['p'] = $project;
		}
		return self::buildUrl( $parts );
	}
	
	public static function getEditIndividualRoute($id = 0)
	{
		$parts = array( "option" => "com_tracks",
		                "view"   => "individual",
		                "controller" => "individual" );		
		if ($id) {
			$parts['i'] = $id;
		}
		return self::buildUrl( $parts );
	}
	
	public static function getProjectRoute($id = 0)
	{
		$parts = array( "option" => "com_tracks",
		                "view"   => "project" );		
		if ($id) {
			$parts['p'] = $id;
		}
		return self::buildUrl( $parts );
	}
	
	public static function getTeamRoute($id = 0, $project = 0)
	{
		$parts = array( "option" => "com_tracks",
		                "view"   => "team" );		
		if ($id) {
			$parts['t'] = $id;
		}
		if ($project) {
			$parts['p'] = $project;
		}
		return self::buildUrl( $parts );
	}
	
	public static function getRankingRoute($id = 0)
	{
		$parts = array( "option" => "com_tracks",
		                "view"   => "ranking" );		
		if ($id) {
			$parts['p'] = $id;
		}
		return self::buildUrl( $parts );
	}
	
	public static function getProjectResultRoute($id = 0)
	{
		$parts = array( "option" => "com_tracks",
		                "view"   => "projectresults" );		
		if ($id) {
			$parts['p'] = $id;
		}
		return self::buildUrl( $parts );
	}
	
	public static function getTeamRankingRoute($id = 0)
	{
		$parts = array( "option" => "com_tracks",
		                "view"   => "teamranking" );		
		if ($id) {
			$parts['p'] = $id;
		}
		return self::buildUrl( $parts );
	}
	
	public static function buildUrl($parts)
	{		
		if($item = self::_findItem($parts)) {
			$parts['Itemid'] = $item->id;
		};
		
		return 'index.php?'.JURI::buildQuery( $parts );
	}
	
	/**
	 * Determines the Itemid
	 *
	 * searches if a menuitem for this item exists
	 * if not the first match will be returned
	 *
	 * @param array url parameters
	 * @since 0.9
	 *
	 * @return int Itemid
	 */
	protected static function _findItem($query)
	{
		$component = JComponentHelper::getComponent('com_tracks');
		$menus	= JSite::getMenu();
		$items	= $menus->getItems('component_id', $component->id);
		$user 	= JFactory::getUser();
				
		if ($items) 
		{
			foreach($items as $item)
			{	
				if ((@$item->query['view'] == $query['view']))
				{					
					switch ($query['view'])
					{
						case 'individual':
							if ((int) @$item->query['i'] == (int) @$query['i']) {
								return $item;
							}					
							break;
							
						case 'ranking':
						case 'teamranking':
							if ((int) @$item->query['p'] == (int) @$query['p']) {
								return $item;
							}					
							break;
							
						case 'round':
							if ((int) @$item->query['r'] == (int) @$query['r']) {
								return $item;
							}						
						  break;
							
						case 'roundresult':
							if ((int) @$item->query['pr'] == (int) @$query['pr']) {
								return $item;
							}						
						  break;
						  
						case 'team':
							if ((int) @$item->query['t'] == (int) @$query['t']) {
								return $item;
							}					
							break;
							
						default:
							if (!isset($query['id']) || (int) @$item->query['id'] == (int) @$query['id']) {
								return $item;
							}
					}
				}
			}
		}

		return false;
	}
}
?>