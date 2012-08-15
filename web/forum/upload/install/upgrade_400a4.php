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

define('THIS_SCRIPT', 'upgrade_400a4.php');
define('VERSION', '4.0.0 Alpha 4');
define('PREV_VERSION', '4.0.0 Alpha 3');

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
	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'bbcode_video'),
		"CREATE TABLE " . TABLE_PREFIX . "bbcode_video (
		  providerid INT UNSIGNED NOT NULL AUTO_INCREMENT,
		  tagoption VARCHAR(50) NOT NULL DEFAULT '',
		  provider VARCHAR(50) NOT NULL DEFAULT '',
		  url VARCHAR(100) NOT NULL DEFAULT '',
		  regex_url VARCHAR(254) NOT NULL DEFAULT '',
		  regex_scrape VARCHAR(254) NOT NULL DEFAULT '',
		  embed MEDIUMTEXT,
		  priority INT UNSIGNED NOT NULL DEFAULT '0',
		  PRIMARY KEY  (providerid),
		  UNIQUE KEY tagoption (tagoption),
		  KEY priority (priority),
		  KEY provider (provider)
		)",
		MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->execute();
}

// #############################################################################
// FINAL step (notice the SCRIPTCOMPLETE define)
if ($vbulletin->GPC['step'] == 2)
{
	require_once(DIR . '/includes/functions_databuild.php');
	build_bbcode_video();

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
