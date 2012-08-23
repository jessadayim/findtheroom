<?php
/*==============================================================================*\
|| ############################################################################ ||
|| # vBulletin 4.0.5                                                          # ||
|| # ----------------------------------------------------------------         # ||
|| # Copyright ©2000-2010 vBulletin Solutions Inc. All Rights Reserved. # ||
|| # This file may not be redistributed in whole or significant part.         # ||
|| # With great thanks to the contribution provided by Andreas                # ||
|| # for the development of this script.                                      # ||
|| # ---------------- VBULLETIN IS NOT FREE SOFTWARE ----------------         # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html         # ||
|| ############################################################################ ||
\*==============================================================================*/

// ######################## SET PHP ENVIRONMENT ###########################
@error_reporting(0);

if (!function_exists('readline'))
{
	function readline( $prompt = '' )
	{
		echo $prompt;
		return rtrim( fgets( STDIN ), "\n" );
	}
}

function fetch_postindex_exec_time($seconds)
{
	$d['h'] = floor($seconds/3600);
	$d['m'] = str_pad( floor( ($seconds - ($d['h']*3600)) / 60 ), 2, 0, STR_PAD_LEFT);
	$d['s'] = str_pad($seconds % 60, 2, 0, STR_PAD_LEFT);

	return "$d[h] hours, $d[m] minutes and $d[s] seconds";
}

$forumspath = trim(readline('Please enter the path to your vBulletin directory: '));

while (!is_dir($forumspath))
{
	print ("\n$forumspath is not a valid directory, please try again\n");
	$forumspath = readline('Please enter the path to your vBulletin directory: ');
}

// ##################### DEFINE IMPORTANT CONSTANTS #######################
define('VB_AREA', 'Maintenance');
define('SKIP_SESSIONCREATE', 1);
define('VB_ENTRY', true);
define('NOCOOKIES', 1);
define('CWD', $forumspath);

// ################### PRE-CACHE TEMPLATES AND DATA ######################
// get special phrase groups
$phrasegroups = array('maintenance');

// ########################################################################
// ######################### START MAIN SCRIPT ############################
// ########################################################################
require(CWD . '/includes/init.php');

$vbphrase = init_language();

echo(strip_tags($vbphrase['rebuild_search_index']) . "\n");
echo(str_repeat('-', vbstrlen($vbphrase['rebuild_search_index'])) . "\n");

echo(strip_tags($vbphrase['note_reindexing_empty_indexes_x']) . "\n");
$emptyindex = intval(readline('Empty Index [0/1,Default=0]: '));

echo("\n");

require_once(DIR . '/vb/search/core.php');
require_once(DIR . '/includes/class_bootstrap_framework.php');
vB_Bootstrap_Framework::init();

$contenttypeid['thread'] = vB_Types::instance()->getContentTypeID('vBForum_Thread');
$contenttypeid['post'] = vB_Types::instance()->getContentTypeID('vBForum_Post');

$types = array ( 0 => $vbphrase['all']) + vB_Search_Searchtools::get_type_options();

foreach ($types AS $typeid => $type)
{
	echo("$typeid) $type\n");
}

$indextypes = intval(readline($vbphrase['search_content_type_to_index'] . ' [Default=0]: '));

if ($indextypes == $contenttypeid['post'] AND (empty($vbulletin->options['searchimplementation']) OR $vbulletin->options['searchimplementation'] == 'vBDBSearch_Core'))
{
	$agressive = intval(readline("\nYou are indexing posts only. Indexing posts can be done in 2 ways:\nBy using the built-in indexer functions (normal) or by bypassing them completely and using SQL commands only (agressive).\nAgressive mode is usually a lot faster but it does not guarantee 100% correct results.\nEnable Agressive Mode [0/1=Default=0]: "));
}

$disableindex = intval(readline('Turn off DB indexes during rebuild [0/1,Default=0]: '));

$totalstart = microtime(true);

if ($emptyindex)
{
	vB_Search_Core::get_instance()->get_core_indexer()->empty_index();
}

if ($disableindex)
{
	$db->query_write("ALTER TABLE " . TABLE_PREFIX . "searchcore DISABLE KEYS");
	$db->query_write("ALTER TABLE " . TABLE_PREFIX . "searchcore_text DISABLE KEYS");
	$db->query_write("ALTER TABLE " . TABLE_PREFIX . "searchgroup DISABLE KEYS");
	$db->query_write("ALTER TABLE " . TABLE_PREFIX . "searchgroup_text DISABLE KEYS");
}

if (!$agressive)
{
	$startat = intval(readline($vbphrase['search_start_item_id'] . ' [Default=0]: '));
	$perpage = intval(readline($vbphrase['search_items_batch'] . ' [Default=10000]: '));

	if (!$perpage)
	{
		$perpage = 10000;
	}

	echo("\n");
	$types = vB_Search_Core::get_instance();
	$indexed_types = $types->get_indexed_types();

	if ($indextypes == 0)
	{
		foreach ($indexed_types AS $id => $details)
		{
			$stack['next'][] = array('package' => $details['package'], 'classname' => $details['class']);
		}
	}
	else if (array_key_exists($indextypes, $indexed_types))
	{
		$stack['next'] = array(array('package' => $indexed_types[$indextypes]['package'], 'classname' => $indexed_types[$indextypes]['class']));
	}
	else
	{
		die(fetch_error('search_no_indexer'));
	}

	$itemstartat = $startat;
	while ($stack['current'] = array_shift($stack['next']))
	{
		$startat = $itemstartat;

		$indexer = vB_Search_Core::get_instance()->get_index_controller($stack['current']['package'], $stack['current']['classname']);
		$max_id = $indexer->get_max_id();
		echo($vbphrase['building_search_index'] . ' ' . vB_Search_Core::get_instance()->get_search_type($stack['current']['package'], $stack['current']['classname'])->get_display_name() . " ...\n");

		while (($finishat = min($startat + $perpage, $max_id)) <= $max_id AND $startat < $finishat)
		{
			$start = microtime(true);
			echo("IDs $startat-$finishat ... ");
			$indexer->index_id_range($startat, $finishat);
			$end = microtime(true);
			$startat += $perpage;
			echo($vbphrase['done'] . ' (' . number_format($end-$start, 2) . " sec)\n");
		}
		echo($vbphrase['building_search_index'] . ' ' . vB_Search_Core::get_instance()->get_search_type($stack['current']['package'], $stack['current']['classname'])->get_display_name()  . ': ' . $vbphrase['done'] . "\n");
	}
}
else
{
	vB_Search_Core::get_instance()->get_core_indexer()->empty_index();

	echo($vbphrase['building_search_index'] . ' ' . vB_Search_Core::get_instance()->get_search_type('vBForum', 'Thread')->get_display_name() . ' ... ');
	foreach ($vbulletin->forumcache AS $forum)
	{
		if ($forum['options'] & $vbulletin->bf_misc_forumoptions['indexposts'])
		{
			$forumids .= ",$forum[forumid]";
		}
	}

	$start = microtime(true);
	$db->query_write("
		INSERT INTO " . TABLE_PREFIX . "searchgroup
		(contenttypeid, groupid, dateline, userid, username)
		(
			SELECT $contenttypeid[thread], threadid, dateline, postuserid, postusername
			FROM " . TABLE_PREFIX . "thread
			WHERE forumid IN (0$forumids)
				AND open != 10
		)
	");

	$db->query_write("
		INSERT INTO " . TABLE_PREFIX . "searchgroup_text
		(searchgroupid, title)
		(
			SELECT searchgroupid, thread.title
			FROM " . TABLE_PREFIX . "searchgroup AS searchgroup
			INNER JOIN " . TABLE_PREFIX . "thread AS thread ON (thread.threadid = searchgroup.groupid)
			WHERE searchgroup.contenttypeid = $contenttypeid[thread]
		)
	");
	$end = microtime(true);
	echo($vbphrase['done'] . ' (' . number_format($end-$start, 2) . " sec)\n");

	echo($vbphrase['building_search_index'] . ' ' . vB_Search_Core::get_instance()->get_search_type('vBForum', 'Post')->get_display_name() . ' ... ');
	$start = microtime(true);
	$db->query_write("
		INSERT INTO " . TABLE_PREFIX . "searchcore
		(contenttypeid, primaryid, groupcontenttypeid, groupid, dateline, userid, username, ipaddress, searchgroupid)
		(
			SELECT $contenttypeid[post], postid, contenttypeid, post.threadid, post.dateline, post.userid, post.username, INET_ATON(post.ipaddress), searchgroupid
			FROM " . TABLE_PREFIX . "searchgroup AS searchgroup
			INNER JOIN " . TABLE_PREFIX . "post AS post ON (post.threadid = searchgroup.groupid)
			WHERE searchgroup.contenttypeid = $contenttypeid[thread]
		)
	");

	$db->query_write("
		INSERT INTO " . TABLE_PREFIX . "searchcore_text
		(searchcoreid, keywordtext, title)
		(
			SELECT searchcoreid, TRIM(CONCAT(title, ' ', pagetext)), title
			FROM " . TABLE_PREFIX . "searchcore AS searchcore
			INNER JOIN " . TABLE_PREFIX . "post AS post ON (post.postid = searchcore.primaryid)
			WHERE searchcore.contenttypeid = $contenttypeid[post]
		)
	");
	$end = microtime(true);
	echo($vbphrase['done'] . ' (' . number_format($end-$start, 2) . " sec)\n");
}

if ($disableindex)
{
	echo('Re-Enabling indexes and repairing tables, please stand by ... ');
	$db->query_write("ALTER TABLE " . TABLE_PREFIX . "searchcore ENABLE KEYS");
	$db->query_write("ALTER TABLE " . TABLE_PREFIX . "searchcore_text ENABLE KEYS");
	$db->query_write("ALTER TABLE " . TABLE_PREFIX . "searchgroup ENABLE KEYS");
	$db->query_write("ALTER TABLE " . TABLE_PREFIX . "searchgroup_text ENABLE KEYS");
	echo("$vbphrase[done]\n");
}
$totalend = microtime(true);

echo($vbphrase['building_search_index'] . ': ' . fetch_postindex_exec_time($totalend-$totalstart) . "\n");

/*======================================================================*\
|| ####################################################################
|| #
|| # CVS: $RCSfile$ - $Revision: 36398 $
|| ####################################################################
\*======================================================================*/
?>
