<?php
/**
* @version    $Id: default.php 101 2008-05-22 08:32:12Z julienv $ 
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

?>

<div id="tracks">
<!-- Title -->
<h1><?php echo $this->title; ?></h1>

<?php if ($r = $this->userindividual): ?>
	<div class="userindividual">
	<?php $link = JRoute::_( TracksHelperRoute::getIndividualRoute($r->slug) ); ?>
	<A HREF="<?php echo $link ?>">
		<?php echo ( $r->picture_small ? '<IMG style="margin-bottom:1px;" SRC="' . HTMLTracks::getIndividualThumb($r, 100) .'"><br>' : '' ) ?>
    </A>
	<?php if ( $r->country_code ): ?>
	          <?php echo TracksCountries::getCountryFlag($r->country_code); ?>
    <?php endif ?>
    <A HREF="<?php echo $link ?>">
		<?php echo  $r->first_name . ' ' . $r->last_name ; ?>
	</A>
	</div>
<?php endif; unset($r);unset($link); ?>

<ul>
	<?php foreach ($this->rows as $r): ?>
	<?php $link = JRoute::_( TracksHelperRoute::getIndividualRoute($r->slug) ); ?>
	<li><?php echo JHTML::image(HTMLTracks::getIndividualThumb($r, 20), $r->first_name . ' ' . $r->last_name); ?>	
	<?php if ($this->params->get('ordering')): ?>
		<?php echo JHTML::link($link, $r->first_name . ', ' . $r->last_name); ?>
	<?php else: ?>
		<?php echo JHTML::link($link, $r->last_name . ', ' . $r->first_name); ?>
	<?php endif; ?>
	</li>
	<?php endforeach; ?>
</ul>

</div>