<?php
/*======================================================================*\
|| #################################################################### ||
|| # vBulletin 4.0.5
|| # ---------------------------------------------------------------- # ||
|| # Copyright ©2000-2010 vBulletin Solutions Inc. All Rights Reserved. ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/

error_reporting(E_ALL & ~E_NOTICE);

define('THIS_SCRIPT', 'upgrade_400rc2.php');
define('VERSION', '4.0.0 Release Candidate 2');
define('PREV_VERSION', '4.0.0 Release Candidate 1');

$phrasegroups = array();
$specialtemplates = array();


// require the code that makes it all work...
require_once('./upgradecore.php');

// #############################################################################
// welcome step
if ($vbulletin->GPC['step'] == 'welcome')
{
	if ($vbulletin->options['templateversion'] == PREV_VERSION)
	{
		echo "<blockquote><p>&nbsp;</p>";
		echo "$vbphrase[upgrade_start_message]";
		echo "<p>&nbsp;</p></blockquote>";
	}
	else
	{
		echo "<blockquote><p>&nbsp;</p>";
		echo "$vbphrase[upgrade_wrong_version]";
		echo "<p>&nbsp;</p></blockquote>";
		print_upgrade_footer();
	}
}

if ($vbulletin->GPC['step'] == 1)
{
	$upgrade->add_index(
		sprintf($upgradecore_phrases['create_index_x_on_y'], 'user_activity', TABLE_PREFIX . 'session'),
		'session',
		'user_activity',
		array('userid', 'lastactivity')
	);

	$upgrade->add_index(
		sprintf($upgradecore_phrases['create_index_x_on_y'], 'guest_lookup', TABLE_PREFIX . 'session'),
		'session',
		'guest_lookup',
		array('idhash', 'host', 'userid')
	);

	$upgrade->add_index(
		sprintf($upgradecore_phrases['create_index_x_on_y'], 'styleid', TABLE_PREFIX . 'template'),
		'template',
		'styleid',
		array('styleid')
	);


	$upgrade->execute();
}

if ($vbulletin->GPC['step'] == 2)
{
	$profile_field_category_locations = array(
		'profile_left_first'  => 'profile_tabs_first',
		'profile_left_last'   => 'profile_tabs_last',
		'profile_right_first' => 'profile_sidebar_first',
		'profile_right_mini'  => 'profile_sidebar_stats',
		'profile_right_album' => 'profile_sidebar_albums',
		'profile_right_last'  => 'profile_sidebar_last',
	);

	foreach ($profile_field_category_locations AS $old_category_location => $new_category_location)
	{
		$upgrade->run_query(
			$upgrade_phrases['upgrade_400rc2.php']['updating_profile_field_category_data'],
			"UPDATE " . TABLE_PREFIX . "profilefieldcategory 
				SET location = '$new_category_location'
				WHERE location = '$old_category_location'"
		);
	}

	$upgrade->execute();
}


// #############################################################################
// FINAL step (notice the SCRIPTCOMPLETE define)
if ($vbulletin->GPC['step'] == 3)
{
	// tell log_upgrade_step() that the script is done
	define('SCRIPTCOMPLETE', true);
}

// #############################################################################

print_next_step();
print_upgrade_footer();

/*======================================================================*\
|| ####################################################################
|| #
|| # CVS: $RCSfile$ - $Revision: 34930 $
|| ####################################################################
\*======================================================================*/
?>
