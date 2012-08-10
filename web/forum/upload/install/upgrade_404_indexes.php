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

/*
INSTRUCTIONS FOR USE:

This script installs a number of indexes on the post table.
You do not need to run this script unless you were instructed to do while
upgrading.  If you ran the vBulletin 4.0 upgrade and were not instructed
to run this script then the indexes where installed automatically.

Running this script may take substantial time on a board with a large number of
posts, up to several hours for a database with tens of millions of posts.  The
board should be taken offline while the script is run (in most cases it will be
unresponsive while the script is running even if not taken down).

You may run this script from the command line via
cd {path_to_vb}/install/
php upgrade_404_indexes.php

If you don't have access to the command line you may run it via the web as
http://{path_to_vb}/install/upgrade_404_indexes.php

However, to avoid any timeout problems, we strongly recommend that the script be run
from the command line.

If you have manually customized the indexes directly in the database, you should review
you customized indexes and the indexes being added below so that you can remove any
duplicate indexes.  If you don't understand how to do this, please consult with your
technical team.
*/

$post_index_query = "
	ALTER TABLE %spost
	  DROP INDEX title
";

$gm_index_query = "
	ALTER TABLE %sgroupmessage
		DROP INDEX gm_ft
";

$sg_index_query = "
	ALTER TABLE %ssocialgroup
		DROP INDEX name
";


// #############################################################################
// Don't change anything past this line
// #############################################################################

//disable any php timeouts -- only needed if calling from the web which
//people shouldn't do, but probably will
@set_time_limit(0);
error_reporting(E_ALL & ~E_NOTICE);

// #############################################################################
// require the code that makes it all work...
define('CWD', dirname(__FILE__).'/../');

define('THIS_SCRIPT', 'upgrade_404_indexes.php');
define('VB_AREA', 'Forum');
require_once(CWD . '/includes/init.php');
require_once(CWD . '/install/functions_installupgrade.php');
require_once(CWD . '/install/upgrade_language_en.php');

$vbulletin->db->hide_errors();

//not really a defined way to check if we're run from the command line.
//this seems particularly unlikely to be set if we aren't being run
//through a webserver.
$is_console =  (!isset($_SERVER['REQUEST_METHOD']));
if(!$is_console)
{
	echo "<pre>";
}


echo $upgrade_phrases['upgrade_404_indexes.php']['removing_indexes'];
echo "\n";
if (run_index_query($vbulletin->db, $post_index_query, $upgrade_phrases))
{
	echo $upgrade_phrases['upgrade_404_indexes.php']['post_index_success'];
	echo "\n";
}
echo "\n\n";
if (run_index_query($vbulletin->db, $gm_index_query, $upgrade_phrases))
{
	echo $upgrade_phrases['upgrade_404_indexes.php']['gm_index_success'];
	echo "\n";
}
echo "\n\n";
if (run_index_query($vbulletin->db, $sg_index_query, $upgrade_phrases))
{
	echo $upgrade_phrases['upgrade_404_indexes.php']['sg_index_success'];
	echo "\n";
}
echo "\n\n";


if (!$is_console)
{
	echo "</pre>";
}

function run_index_query($db, $query, $upgrade_phrases)
{
	$db->query_write($q = sprintf($query, TABLE_PREFIX));
	$result = $db->errno();
	if ($result <> 0)
	{
		if ($result == 1061)
		{
			echo $upgrade_phrases['upgrade_400a1_indexes.php']['duplicate_index'];
			echo ' ';
			echo $upgrade_phrases['upgrade_400a1_indexes.php']['error_can_be_ignored'];
			echo "\n";
		}
		else if ($result == 1091)
		{
			echo $upgrade_phrases['upgrade_400a1_indexes.php']['index_not_found'];
			echo ' ';
			echo $upgrade_phrases['upgrade_400a1_indexes.php']['error_can_be_ignored'];
			echo "\n";
		}
		//otherwise just dump the error
		echo "$q\n";
		echo $db->error() . "\n";
		return false;
	}
	else
	{
		return true;
	}
}

/*======================================================================*\
|| ####################################################################
|| #
|| # CVS: $RCSfile$ - $Revision: 34930 $
|| ####################################################################
\*======================================================================*/
