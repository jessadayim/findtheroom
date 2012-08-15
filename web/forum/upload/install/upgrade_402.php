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

define('THIS_SCRIPT', 'upgrade_402.php');
define('VERSION', '4.0.2');
define('PREV_VERSION', '4.0.1');

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
	$doads = array(
		'thread_first_post_content' => 1,
		'thread_last_post_content'  => 1
	);
	require_once(DIR . '/includes/adminfunctions_template.php');
	$ads = $db->query_read("
		SELECT adlocation, COUNT( * ) AS count
		FROM " . TABLE_PREFIX . "ad
		WHERE
			adlocation IN ('" . implode('\', \'', array_keys($doads)) . "')
				AND
			active = 1
		GROUP BY
			adlocation
	");
	while ($ad = $db->fetch_array($ads))
	{
		unset($doads[$ad['adlocation']]);
	}

	$count = 0;
	foreach (array_keys($doads) AS $ad)
	{
		$count++;
		$template_un = '';
		$template = compile_template($template_un);
		$upgrade->run_query(
			sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'template', $count, count($doads)),
			"UPDATE " . TABLE_PREFIX . "template
			SET
				template = '" . $db->escape_string($template) . "',
				template_un = '',
				dateline = " . TIMENOW . "
			WHERE
				styleid IN (-1,0)
					AND
				title = 'ad_" . $db->escape_string($ad) . "'
			"
		);
	}

	$db_alter = new vB_Database_Alter_MySQL($db);
	if (
		$db_alter->fetch_table_info('blog_attachment')
			AND
		!$db->query_first("SELECT * FROM " . TABLE_PREFIX . "adminmessage WHERE varname = 'after_upgrade_40_update_blog_attachment'")
	)
	{
		$upgrade->run_query(
			sprintf($vbphrase['update_table'], TABLE_PREFIX . "adminmessage"),
			"INSERT INTO " . TABLE_PREFIX . "adminmessage
				(varname, dismissable, script, action, execurl, method, dateline, status)
			VALUES
				('after_upgrade_40_update_blog_attachment', 1, 'blog_admin.php', 'updateattachments', 'blog_admin.php?do=updateattachments&pp=25', 'get', " . TIMENOW . ", 'undone')
			"
		);
	}

	//change the standard icons to the new png images.
	for ($i = 1; $i < 14; $i++)
	{
		$upgrade->run_query(
			sprintf($upgrade_phrases['upgrade_402.php']['update_icon'], $i, 14),
			"UPDATE " . TABLE_PREFIX . "icon SET iconpath = 'images/icons/icon$i.png' 
			WHERE iconpath = 'images/icons/icon$i.gif' AND imagecategoryid = 2"
		);
	}

	$upgrade->execute();
	
	require_once(DIR . '/includes/adminfunctions.php');
	build_image_cache('icon');

	// Reload forum types to make blocktype title translatable
	require_once(DIR . '/includes/class_block.php');
	$blockmanager = vB_BlockManager::create($vbulletin);
	$blockmanager->reloadBlockTypes();

}

// #############################################################################
// FINAL step (notice the SCRIPTCOMPLETE define)
if ($vbulletin->GPC['step'] == 2)
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
|| # CVS: $RCSfile$ - $Revision: 35294 $
|| ####################################################################
\*======================================================================*/
?>
