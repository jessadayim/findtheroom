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

define('THIS_SCRIPT', 'upgrade_403.php');
define('VERSION', '4.0.3');
define('PREV_VERSION', '4.0.2');

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
	require_once(DIR . '/includes/class_bitfield_builder.php');
	vB_Bitfield_Builder::save($db);

	// give all admins tags perms if they have thread perms
	$db->query_write("
		UPDATE " . TABLE_PREFIX . "administrator SET
			adminpermissions = adminpermissions | " . $vbulletin->bf_ugp_adminpermissions['canadmintags'] . "
		WHERE
			adminpermissions & " . $vbulletin->bf_ugp_adminpermissions['canadminthreads'] . "
	");

	$upgrade->add_field(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'attachment', 1, 1),
		'attachment',
		'displayorder',
		'int',
		FIELD_DEFAULTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['update_table'], TABLE_PREFIX . 'attachment'),
		"UPDATE " . TABLE_PREFIX . "attachment SET displayorder = attachmentid
	");

	// correctly store master style template history records
	$upgrade->run_query(
		sprintf($upgradecore_phrases['altering_x_table'], 'templatehistory', 1, 1),
		"ALTER TABLE " . TABLE_PREFIX . "templatehistory CHANGE styleid styleid SMALLINT NOT NULL DEFAULT '0'"
	);
	$upgrade->run_query(
		sprintf($vbphrase['update_table'], TABLE_PREFIX . 'templatehistory'),
		"UPDATE " . TABLE_PREFIX . "templatehistory SET styleid = -1 WHERE styleid = 0"
	);

	//Make sure there's a cron job to do queued cache updates
	if (!$db->query_first("SELECT filename FROM " . TABLE_PREFIX . "cron WHERE filename = './includes/cron/queueprocessor.php'"))
	{
		$upgrade->run_query(
		sprintf($vbphrase['update_table'], TABLE_PREFIX . 'cron'),
		"INSERT INTO " . TABLE_PREFIX . "cron
				(nextrun, weekday, day, hour, minute, filename, loglevel, varname, volatile, product)
			VALUES
				(1232082000, -1, -1, -1, 'a:6:{i:0;i:0;i:1;i:10;i:2;i:20;i:3;i:30;i:4;i:40;i:5;i:50;}', './includes/cron/queueprocessor.php', 1, 'searchqueueupdates', 1, 'vbulletin')"
		);
	}

	$upgrade->add_field(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'post', 1, 1),
		'post',
		'htmlstate',
		'enum',
		array('attributes' => "('off', 'on', 'on_nl2br')", 'null' => false, 'default' => 'on_nl2br')
	);

	$upgrade->add_field(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'bookmarksite', 1, 1),
		'bookmarksite',
		'utf8encode',
		'smallint',
		FIELD_DEFAULTS
	);

	// widen attachment filenames
	$upgrade->run_query(
		sprintf($upgradecore_phrases['altering_x_table'], 'attachment', 1, 1),
		"ALTER TABLE " . TABLE_PREFIX . "attachment CHANGE filename filename VARCHAR(255) NOT NULL DEFAULT ''"
	);
	$upgrade->run_query(
		sprintf($upgradecore_phrases['altering_x_table'], 'attachmentcategoryuser', 1, 1),
		"ALTER TABLE " . TABLE_PREFIX . "attachmentcategoryuser CHANGE filename filename VARCHAR(255) NOT NULL DEFAULT ''"
	);

	// widen the user salt
	$upgrade->run_query(
		sprintf($upgradecore_phrases['altering_x_table'], 'user', 1, 1),
		"ALTER TABLE " . TABLE_PREFIX . "user MODIFY salt CHAR(30) NOT NULL DEFAULT ''"
	);

	$upgrade->execute();
}

if ($vbulletin->GPC['step'] == 2)
{
	// rebuild ads that use the is_date criterion #36100 or browsing forum criteria #34416
	echo '<p>' . $upgrade_phrases['upgrade_403.php']['rebuilding_ad_criteria'];

	$ad_result = $db->query_read("
		SELECT ad.*
		FROM " . TABLE_PREFIX . "ad AS ad
		LEFT JOIN " . TABLE_PREFIX . "adcriteria AS adcriteria ON(adcriteria.adid = ad.adid)
		WHERE adcriteria.criteriaid IN('is_date', 'browsing_forum_x', 'browsing_forum_x_and_children')
	");
	if ($db->num_rows($ad_result) > 0)
	{
		$ad_cache = array();
		$ad_locations = array();

		while ($ad = $db->fetch_array($ad_result))
		{
			$ad_cache["$ad[adid]"] = $ad;
			$ad_locations[] = $ad['adlocation'];
		}

		require_once(DIR . '/includes/functions_ad.php');
		require_once(DIR . '/includes/adminfunctions_template.php');

		foreach($ad_locations AS $location)
		{
			$template = wrap_ad_template(build_ad_template($location), $location);

			$template_un = $template;
			$template = compile_template($template);

			$db->query_write("
				UPDATE " . TABLE_PREFIX . "template SET
					template = '" . $db->escape_string($template) . "',
					template_un = '" . $db->escape_string($template_un) . "',
					dateline = " . TIMENOW . ",
					username = '" . $db->escape_string($vbulletin->userinfo['username']) . "'
				WHERE
					title = 'ad_" . $db->escape_string($location) . "'
					AND styleid IN (-1,0)
			");
		}

		build_all_styles();
	}

	$db->free_result($ad_result);

	echo "<br /><span class=\"smallfont\"><b>$vbphrase[done]</b></span></p>";
}

if ($vbulletin->GPC['step'] == 3)
{
	// add the facebook userid to the user table
	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'user', 1, 4),
		'user',
		'fbuserid',
		'VARCHAR',
		array(
			'length' => 255
		)
	);

	// add index to facebook userid
	$upgrade->add_index(
		sprintf($upgradecore_phrases['create_index_x_on_y'], 'fbuserid', TABLE_PREFIX . 'user'),
		'user',
		'fbuserid',
		array('fbuserid')
	);

	// add facebook join date to the user table
	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'user', 2, 4),
		'user',
		'fbjoindate',
		'INT',
		FIELD_DEFAULTS
	);

	// add the facebook name to the user table
	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'user', 3, 4),
		'user',
		'fbname',
		'VARCHAR',
		array(
			'length' => 255
		)
	);
	
	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'user', 4, 4),
		'user',
		'logintype',
		'enum',
		array('attributes' => "('vb', 'fb')", 'null' => false, 'default' => 'vb')
	);

	$upgrade->execute();
}

// #############################################################################
// FINAL step (notice the SCRIPTCOMPLETE define)
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
