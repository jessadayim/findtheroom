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

define('THIS_SCRIPT', 'upgrade_400a5.php');
define('VERSION', '4.0.0 Alpha 5');
define('PREV_VERSION', '4.0.0 Alpha 4');

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
	// this is also in Alpha 1 upgrade script since the picture conversion code is there but this bit is needed
	// to stop references to picture.php from throwin errors. All of the alpha scripts should be converged into one Beta 1 script any way.
	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'picturelegacy'),
		"CREATE TABLE " . TABLE_PREFIX . "picturelegacy (
			type ENUM('album', 'group') NOT NULL DEFAULT 'album',
			primaryid INT UNSIGNED NOT NULL DEFAULT '0',
			pictureid INT UNSIGNED NOT NULL DEFAULT '0',
			attachmentid INT UNSIGNED NOT NULL DEFAULT '0',
			PRIMARY KEY (type, primaryid, pictureid)
		)",
		MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->add_field(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'style', 1, 1),
		'style',
		'dateline',
		'int',
		FIELD_DEFAULTS
	);

	$upgrade->execute();
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
|| # CVS: $RCSfile$ - $Revision: 34930 $
|| ####################################################################
\*======================================================================*/
?>
