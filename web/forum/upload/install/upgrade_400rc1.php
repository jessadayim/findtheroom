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

define('THIS_SCRIPT', 'upgrade_400rc1.php');
define('VERSION', '4.0.0 Release Candidate 1');
define('PREV_VERSION', '4.0.0 Beta 5');

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
	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'block'),
		"CREATE TABLE " . TABLE_PREFIX . "block (
			blockid INT UNSIGNED NOT NULL AUTO_INCREMENT,
			blocktypeid INT NOT NULL DEFAULT '0',
			title VARCHAR(255) NOT NULL DEFAULT '',
			description MEDIUMTEXT,
			url VARCHAR(100) NOT NULL DEFAULT '',
			cachettl INT NOT NULL DEFAULT '0',
			displayorder SMALLINT NOT NULL DEFAULT '0',
			active SMALLINT NOT NULL DEFAULT '0',
			configcache MEDIUMBLOB,
			PRIMARY KEY (blockid),
			KEY blocktypeid (blocktypeid)
		)",
		MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'blockconfig'),
		"CREATE TABLE " . TABLE_PREFIX . "blockconfig (
			blockid INT UNSIGNED NOT NULL AUTO_INCREMENT,
			name VARCHAR(255) NOT NULL DEFAULT '',
			value MEDIUMTEXT,
			serialized TINYINT NOT NULL DEFAULT '0',
			PRIMARY KEY (blockid, name)
		)",
		MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'blocktype'),
		"CREATE TABLE " . TABLE_PREFIX . "blocktype (
			blocktypeid INT UNSIGNED NOT NULL AUTO_INCREMENT,
			productid VARCHAR(25) NOT NULL DEFAULT '',
			name VARCHAR(50) NOT NULL DEFAULT '',
			title VARCHAR(255) NOT NULL DEFAULT '',
			description MEDIUMTEXT,
			allowcache TINYINT NOT NULL DEFAULT '0',
			PRIMARY KEY (blocktypeid),
			UNIQUE KEY (name),
			KEY productid (productid)
		)",
		MYSQL_ERROR_TABLE_EXISTS
	);

	// New phrase types
	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'language', 1, 1),
		'language',
		'phrasegroup_vbblock',
		'mediumtext',
		FIELD_DEFAULTS
	);

	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'language', 1, 1),
		'language',
		'phrasegroup_vbblocksettings',
		'mediumtext',
		FIELD_DEFAULTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['update_table'], TABLE_PREFIX . "phrasetype"),
		"INSERT IGNORE INTO " . TABLE_PREFIX . "phrasetype
			(title, editrows, fieldname, special)
		VALUES
			('{$phrasetype['vbblock']}', 3, 'vbblock', 0),
			('{$phrasetype['vbblocksettings']}', 3, 'vbblocksettings', 0)
		"
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
