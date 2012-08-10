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

define('THIS_SCRIPT', 'upgrade_404.php');
define('VERSION', '4.0.4');
define('PREV_VERSION', '4.0.3');

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
if ($vbulletin->GPC['step'] == 1)
{
	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'userchangelog', 1, 1),
		'userchangelog',
		'ipaddress',
		'int',
		FIELD_DEFAULTS
	);

	// remove orphaned stylevars
	$upgrade->show_message($upgrade_phrases['upgrade_404.php']['checking_orphaned_stylevars']);

	$skipstyleids = '-1';
	$style_result = $db->query_read("SELECT styleid FROM " . TABLE_PREFIX . "style");
	while ($style_row = $db->fetch_array($style_result))
	{
		$skipstyleids .= ',' . intval($style_row['styleid']);
	}
	$db->query_write("DELETE FROM " . TABLE_PREFIX . "stylevar WHERE styleid NOT IN($skipstyleids)");

	$orphaned_stylevar_count = $db->affected_rows();
	if ($orphaned_stylevar_count > 0)
	{
		$upgrade->show_message(sprintf($upgrade_phrases['upgrade_404.php']['removed_x_orphaned_stylevars'], $orphaned_stylevar_count));
	}
	else
	{
		$upgrade->show_message($upgrade_phrases['upgrade_404.php']['no_orphaned_stylevars']);
	}


	$smilies_to_change = array (
		'smile', 'redface', 'biggrin', 'wink', 'tongue', 'cool',
		'rolleyes', 'mad', 'eek', 'confused', 'frown'
	);

	//change the standard icons to the new png images.
	$i = 0;
	foreach ($smilies_to_change as $smilie)
	{
		$i++;
		$upgrade->run_query(
			sprintf($upgrade_phrases['upgrade_404.php']['update_smilie'], $i, count($smilies_to_change)),
			"UPDATE " . TABLE_PREFIX . "smilie SET smiliepath = 'images/smilies/$smilie.png'
			WHERE smiliepath = 'images/smilies/$smilie.gif' AND imagecategoryid = 1"
		);
	}

	$upgrade->execute();

	require_once(DIR . '/includes/adminfunctions.php');
	build_image_cache('smilie');
}

if ($vbulletin->GPC['step'] == 2)
{
	// Do some queries to fix oddities between new installs and upgrades
	$upgrade->drop_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'usergroup', 1, 1),
		'usergroup',
		'albumpicmaxsize'
	);

	$upgrade->run_query(
		sprintf($upgradecore_phrases['altering_x_table'], 'usertitle', 1, 1),
		"ALTER TABLE " . TABLE_PREFIX . "usertitle CHANGE usertitleid usertitleid INT UNSIGNED NOT NULL AUTO_INCREMENT"
	);

	$upgrade->run_query(
		sprintf($upgradecore_phrases['altering_x_table'], 'album', 1, 1),
		"ALTER TABLE " . TABLE_PREFIX . "album CHANGE description description MEDIUMTEXT"
	);

	// The default on this field is not relevant since this value is determined at user creation but let's match what mysql-schema has
	$upgrade->run_query(
		sprintf($upgradecore_phrases['altering_x_table'], 'user', 1, 1),
		"ALTER TABLE " . TABLE_PREFIX . "user CHANGE options options INT UNSIGNED NOT NULL DEFAULT '33570831'"
	);

	$upgrade->drop_index(
		sprintf($upgradecore_phrases['altering_x_table'], 'contenttype', 1, 4),
		'contenttype',
		'package'
	);

	$upgrade->drop_index(
		sprintf($upgradecore_phrases['altering_x_table'], 'contenttype', 2, 4),
		'contenttype',
		'packageclass'
	);

	$upgrade->add_index(
		sprintf($upgradecore_phrases['altering_x_table'], 'contenttype', 3, 4),
		'contenttype',
		'packageclass',
		array('packageid', 'class'),
		'unique'
	);

	$upgrade->run_query(
		sprintf($upgradecore_phrases['altering_x_table'], 'contenttype', 4, 4),
			"ALTER TABLE " . TABLE_PREFIX . "contenttype ENGINE=$hightrafficengine"
	);

	$upgrade->drop_index(
		sprintf($upgradecore_phrases['altering_x_table'], 'prefixpermission', 1, 3),
		'prefixpermission',
		'prefixsetid'
	);

	$upgrade->drop_index(
		sprintf($upgradecore_phrases['altering_x_table'], 'prefixpermission', 2, 3),
		'prefixpermission',
		'prefixusergroup'
	);

	$upgrade->add_index(
		sprintf($upgradecore_phrases['altering_x_table'], 'prefixpermission', 3, 3),
		'prefixpermission',
		'prefixsetid',
		array('prefixid', 'usergroupid')
	);

	$upgrade->drop_index(
		sprintf($upgradecore_phrases['altering_x_table'], 'groupmessage', 1, 2),
		'groupmessage',
		'postuserid'
	);

	$upgrade->add_index(
		sprintf($upgradecore_phrases['altering_x_table'], 'groupmessage', 2, 2),
		'groupmessage',
		'postuserid',
		array('postuserid', 'discussionid', 'state')
	);

	$upgrade->run_query(
		sprintf($upgradecore_phrases['altering_x_table'], 'editlog', 1, 1),
			"ALTER TABLE " . TABLE_PREFIX . "editlog CHANGE hashistory hashistory SMALLINT UNSIGNED NOT NULL DEFAULT '0'"
	);

	$upgrade->run_query(
		sprintf($upgradecore_phrases['altering_x_table'], 'profilevisitor', 1, 1),
			"ALTER TABLE " . TABLE_PREFIX . "profilevisitor CHANGE visible visible SMALLINT UNSIGNED NOT NULL DEFAULT '1'"
	);


	$pcount = $db->query_first("SELECT SUM(replycount) AS postcount FROM " . TABLE_PREFIX . "forum");
	if ($postcount['postcount'] < 1200000)
	{
		$upgrade->drop_index(
			sprintf($upgradecore_phrases['altering_x_table'], 'groupmessage', 1, 1),
			'groupmessage',
			'gm_ft'
		);

		$upgrade->drop_index(
			sprintf($upgradecore_phrases['altering_x_table'], 'socialgroup', 1, 1),
			'socialgroup',
			'name'
		);

		$upgrade->drop_index(
			sprintf($upgradecore_phrases['altering_x_table'], 'post', 1, 1),
			'post',
			'title'
		);
	}
	else
	{
		echo $upgrade_phrases['upgrade_404.php']['indexes_not_removed'];
		if (!$db->query_first("SELECT * FROM " . TABLE_PREFIX . "adminmessage WHERE varname = 'after_upgrade_404_remove_indexes'"))
		{
			$upgrade->run_query(
				sprintf($vbphrase['update_table'], TABLE_PREFIX . "adminmessage"),
				"INSERT INTO " . TABLE_PREFIX . "adminmessage
					(varname, dismissable, script, action, execurl, method, dateline, status)
				VALUES
					('after_upgrade_404_remove_indexes', 1, '', '', '', '', " . TIMENOW . ", 'undone')
				"
			);
		}
	}

	if (!$vbulletin->options['attachthumbs'] AND $vbulletin->options['viewattachedimages'] == 1)
	{
		// Set viewattachedimages = 3 when we had thumbnails disabled and view full images enabled
		$upgrade->run_query(
			sprintf($upgradecore_phrases['altering_x_table'], 'setting', 1, 1),
				"UPDATE " . TABLE_PREFIX . "setting SET value = 3 WHERE varname = 'viewattachedimages'"
		);
	}


	// add the facebook name to the user table
	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'user', 1, 2),
		'user',
		'fbaccesstoken',
		'VARCHAR',
		array(
			'length' => 255
		)
	);

	// add the facebook name to the user table
	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'user', 2, 2),
		'user',
		'fbprofilepicurl',
		'VARCHAR',
		array(
			'length' => 100
		)
	);

	if (trim($vbulletin->options['facebookapikey']) != '' OR $vbulletin->options['enablefacebookconnect'])
	{
		$rows = $db->query_first("SELECT COUNT(*) AS count FROM " . TABLE_PREFIX . "adminmessage WHERE varname = 'after_upgrade_404_update_facebook'");
		if ($rows['count'] == 0)
		{
			$upgrade->run_query(
				sprintf($vbphrase['update_table'], TABLE_PREFIX . "adminmessage"),
				"INSERT INTO " . TABLE_PREFIX . "adminmessage
					(varname, dismissable, script, action, execurl, method, dateline, status)
				VALUES
					('after_upgrade_404_update_facebook', 1, '', '', '', '', " . TIMENOW . ", 'undone')
				"
			);
		}
	}

	$upgrade->execute();
}

if ($vbulletin->GPC['step'] == 3)
{
	require_once(DIR . '/includes/class_bootstrap_framework.php');
	vB_Bootstrap_Framework::init();

	//clear the cache.  There are some values that are incorrect because of code changes,
	//make sure that we don't allow those values to be used after the upgrade.
	vB_Cache::instance()->clean(false);
}

// #############################################################################
// FINAL step (notice the SCRIPTCOMPLETE define)\

//clear cache
if ($vbulletin->GPC['step'] == 4)
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
|| # CVS: $RCSfile$ - $Revision: 35017 $
|| ####################################################################
\*======================================================================*/
?>
