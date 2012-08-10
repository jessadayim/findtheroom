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

define('THIS_SCRIPT', 'upgrade_400b3.php');
define('VERSION', '4.0.0 Beta 3');
define('PREV_VERSION', '4.0.0 Beta 2');

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
	require_once(DIR . '/includes/functions_databuild.php');
	build_bbcode_video();
	
	// retire existing styles
	$upgrade->run_query(
		$upgrade_phrases['upgrade_400b3.php']['updating_styles'],
		"UPDATE " . TABLE_PREFIX . "style
		SET userselect = 0,
			displayorder = displayorder + 30000,
		    title = 
		    	IF(title LIKE '%" . $vbulletin->db->escape_string_like($upgrade_phrases['upgrade_400b3.php']['incompatible']) . "',
		    	title,
		    	CONCAT(title, '" . $vbulletin->db->escape_string($upgrade_phrases['upgrade_400b3.php']['incompatible']) . "'))
	");
		
	// disassociate styles with forums
	$upgrade->run_query(
		$upgrade_phrases['upgrade_400b3.php']['updating_forum_styles'],
		"UPDATE " . TABLE_PREFIX . "forum 
		SET styleid = 0
	");
	
	// clear user style preferences
	$upgrade->run_query(
		$upgrade_phrases['upgrade_400b3.php']['updating_user_styles'],
		"UPDATE " . TABLE_PREFIX . "user 
		SET styleid = 0
	");
	
	// clear blog style
	$upgrade->run_query(
		$upgrade_phrases['upgrade_400b3.php']['updating_blog_styles'],
		"UPDATE " . TABLE_PREFIX . "setting
		SET value = '0' 
		WHERE varname = 'vbblog_style'
	");
	
	$upgrade->execute();
}

// #############################################################################
// FINAL step (notice the SCRIPTCOMPLETE define)
if ($vbulletin->GPC['step'] == 2)
{
	// create new style
	$vbulletin->db->query("
		INSERT INTO " . TABLE_PREFIX . "style
			(title, 
			 parentid, userselect, displayorder)
		VALUES
			('" . $vbulletin->db->escape_string($upgrade_phrases['upgrade_400b3.php']['default_style']) . "',
			 -1, 1, 1)
	");
	$styleid = $vbulletin->db->insert_id();
	
	$vbulletin->db->query("
		UPDATE " . TABLE_PREFIX . "style 
		SET parentlist = '" . intval($styleid) . ",-1' 
		WHERE styleid = " . intval($styleid)
	);
	
	// update default style
	$upgrade->run_query(
		$upgrade_phrases['upgrade_400b3.php']['updating_forum_styles'],
		"UPDATE " . TABLE_PREFIX . "setting
		SET value = '" . intval($styleid) . "'  
		WHERE varname = 'styleid'
	");
		
	$upgrade->execute();
	
	require_once(DIR . '/includes/adminfunctions.php');
	build_forum_permissions();
	build_options();
	
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