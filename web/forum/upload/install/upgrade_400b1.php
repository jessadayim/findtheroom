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

define('THIS_SCRIPT', 'upgrade_400b1.php');
define('VERSION', '4.0.0 Beta 1');
define('PREV_VERSION', '4.0.0 Alpha 6');

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

// #############################################################################
// step 1
if ($vbulletin->GPC['step'] == 1)
{
	$upgrade->drop_index(
		sprintf($upgradecore_phrases['altering_x_table'], 'attachment', 1, 2),
		'attachment',
		'contenttypeid'
	);

	$upgrade->add_index(
		sprintf($upgradecore_phrases['altering_x_table'], 'attachment', 2, 2),
		'attachment',
		'contenttypeid',
		array('contenttypeid', 'contentid', 'attachmentid')
	);

	$upgrade->execute();
}

// #############################################################################
// FINAL step (notice the SCRIPTCOMPLETE define)
if ($vbulletin->GPC['step'] == 2)
{
	//insert default notice for guests -- if we already have one by that title don't add another.
	$row = $vbulletin->db->query_first("
		SELECT COUNT(*) AS count FROM " . TABLE_PREFIX . "notice WHERE title='default_guest_message'
	");

	if ($row['count'] == 0)
	{
		require_once(DIR . '/includes/adminfunctions_notice.php');

		$criteria = array();
		$criteria['in_usergroup_x'] = array('active' => 1, 'condition1' => 1);

		require_once(DIR . '/includes/class_bootstrap_framework.php');
		vB_Bootstrap_Framework::init();
		try 
		{
			save_notice(null, 'default_guest_message', $upgrade_phrases['notice']['guest_default_message'], 
				10, 1, 1, 1, $criteria, 'System', VERSION);
		}
		catch(vB_Exception_AdminStopMessage $e)
		{
			print_admin_stop_exception($e);
			exit;
		}
	}

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
