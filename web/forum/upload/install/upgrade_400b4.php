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

define('THIS_SCRIPT', 'upgrade_400b4.php');
define('VERSION', '4.0.0 Beta 4');
define('PREV_VERSION', '4.0.0 Beta 3');

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
// Advertising step 
if ($vbulletin->GPC['step'] == 1)
{
	
	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . "ad"),
		"CREATE TABLE " . TABLE_PREFIX . "ad (
			adid INT UNSIGNED NOT NULL auto_increment,
			title VARCHAR(250) NOT NULL DEFAULT '',
			adlocation VARCHAR(250) NOT NULL DEFAULT '',
			displayorder INT UNSIGNED NOT NULL DEFAULT '0',
			active SMALLINT UNSIGNED NOT NULL DEFAULT '0',
			snippet MEDIUMTEXT,
			PRIMARY KEY (adid),
			KEY active (active)
		)",
		MYSQL_ERROR_TABLE_EXISTS
	);
	
	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . "adcriteria"),
		"CREATE TABLE " . TABLE_PREFIX . "adcriteria (
			adid INT UNSIGNED NOT NULL DEFAULT '0',
			criteriaid VARCHAR(250) NOT NULL DEFAULT '',
			condition1 VARCHAR(250) NOT NULL DEFAULT '',
			condition2 VARCHAR(250) NOT NULL DEFAULT '',
			condition3 VARCHAR(250) NOT NULL DEFAULT '',
			PRIMARY KEY (adid,criteriaid)
		)
		",
		MYSQL_ERROR_TABLE_EXISTS
	);
	

	if (!$upgrade->field_exists('language', 'phrasegroup_advertising'))
	{
		$upgrade->run_query(
			sprintf($vbphrase['update_table'], TABLE_PREFIX . "advertising"),
			"ALTER TABLE " . TABLE_PREFIX . "language ADD phrasegroup_advertising mediumtext not null"
		);
	}
	
	if (!$db->query_first("SELECT * FROM " . TABLE_PREFIX . "phrasetype WHERE fieldname = 'advertising'"))
	{
		$upgrade->run_query(
			sprintf($vbphrase['update_table'], TABLE_PREFIX . "phrasetype"),
			"INSERT INTO " . TABLE_PREFIX . "phrasetype
			VALUES
				('advertising', 'Advertising', 3, '', 0)
			"
		);
	}	
		
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
