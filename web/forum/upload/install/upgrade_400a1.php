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

define('THIS_SCRIPT', 'upgrade_400a1.php');
define('VERSION', '4.0.0 Alpha 1');
define('PREV_VERSION', '3.8.0+');

define('VERSION_COMPAT_STARTS', '3.8.0');
define('VERSION_COMPAT_ENDS', '3.8.99');

$phrasegroups = array();
$specialtemplates = array();

// #############################################################################
// require the code that makes it all work...
require_once('./upgradecore.php');

// #############################################################################
// welcome step
if ($vbulletin->GPC['step'] == 'welcome')
{
	if (version_compare($vbulletin->options['templateversion'], VERSION_COMPAT_STARTS, '>=') AND version_compare($vbulletin->options['templateversion'], VERSION_COMPAT_ENDS, '<'))
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

$enginetype = (version_compare(MYSQL_VERSION, '4.0.18', '<')) ? 'TYPE' : 'ENGINE';

// #############################################################################
if ($vbulletin->GPC['step'] == 1)
{
	require_once(DIR . '/includes/class_bitfield_builder.php');
	vB_Bitfield_Builder::save($db);

	//Consolidated 3.8.x changes.
	//Rather than run all of the later 3.8 scripts for a 4.0 upgrade we will consolidate the
	//the changes here and skip to the 4.0 installer for the "missing" upgrade files.
	//This avoids a bunch of button mashing by the administrator for relatively small changes.
	//These changes *must be repeatable* because we may be upgrading from a version that
	//has already applied the change.  If the change/query cannot be safely repeated,
	//detection logic must be applied.

	$upgrade->run_query(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'reputation', 1, 4),
		"ALTER TABLE " . TABLE_PREFIX . "reputation CHANGE postid postid INT UNSIGNED NOT NULL DEFAULT '1'"
	);

	$upgrade->run_query(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'reputation', 2, 4),
		"ALTER TABLE " . TABLE_PREFIX . "reputation CHANGE userid userid INT UNSIGNED NOT NULL DEFAULT '1'"
	);

	$upgrade->run_query(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'reputation', 3, 4),
		"ALTER TABLE " . TABLE_PREFIX . "reputation CHANGE whoadded whoadded INT UNSIGNED NOT NULL DEFAULT '0'"
	);

	$upgrade->run_query(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'reputation', 4, 4),
		"ALTER TABLE " . TABLE_PREFIX . "reputation CHANGE dateline dateline INT UNSIGNED NOT NULL DEFAULT '0'"
	);

	$upgrade->add_field(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'subscribegroup', 1, 1),
		'subscribegroup',
		'emailupdate',
		'enum',
		array('attributes' => "('daily', 'weekly', 'none')", 'null' => false, 'default' => 'none')
	);

	$upgrade->run_query(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'thread', 1, 1),
		"ALTER TABLE " . TABLE_PREFIX . "thread CHANGE lastposter lastposter VARCHAR(100) NOT NULL default ''"
	);

	//4.0 table changes.
	$upgrade->drop_index(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'reputation', 1, 2),
		'reputation',
		'whoadded_postid'
	);

	$upgrade->run_query(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'reputation', 2, 2),
		"ALTER IGNORE TABLE " . TABLE_PREFIX . "reputation ADD UNIQUE INDEX
			whoadded_postid (whoadded, postid)",
		MYSQL_ERROR_KEY_EXISTS
	);

	$upgrade->execute();
}

// #############################################################################
if ($vbulletin->GPC['step'] == 2)
{
	$hightrafficengine = get_high_concurrency_table_engine($db);

	$upgrade->add_field(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'subscribegroup', 1, 1),
		'subscribegroup',
		'emailupdate',
		'enum',
		array('attributes' => "('daily', 'weekly', 'none')", 'null' => false, 'default' => 'none')
	);

	$upgrade->add_field(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'forum', 1, 1),
		'forum',
		'lastposterid',
		'int',
		FIELD_DEFAULTS
	);

	$upgrade->add_field(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'thread', 1, 2),
		'thread',
		'lastposterid',
		'int',
		FIELD_DEFAULTS
	);

	$upgrade->add_field(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'thread', 2, 2),
		'thread',
		'keywords',
		'mediumtext',
		FIELD_DEFAULTS
	);

	$upgrade->add_field(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'tachyforumpost', 1, 1),
		'tachyforumpost',
		'lastposterid',
		'int',
		FIELD_DEFAULTS
	);

	$upgrade->add_field(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'tachythreadpost', 1, 1),
		'tachythreadpost',
		'lastposterid',
		'int',
		FIELD_DEFAULTS
	);


	$upgrade->add_field(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'style', 1, 1),
		'style',
		'newstylevars',
		'mediumtext',
		FIELD_DEFAULTS
	);

	$upgrade->run_query(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'template', 1, 1),
		"ALTER  TABLE  " . TABLE_PREFIX . "template ADD mergestatus ENUM('none', 'merged', 'conflicted') NOT NULL DEFAULT 'none'",
		MYSQL_ERROR_COLUMN_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'templatemerge'),
		"CREATE TABLE " . TABLE_PREFIX . "templatemerge (
			templateid INT UNSIGNED NOT NULL DEFAULT '0',
			template MEDIUMTEXT,
			version VARCHAR(30) NOT NULL DEFAULT '',
			savedtemplateid INT UNSIGNED NOT NULL DEFAULT '0',
			PRIMARY KEY (templateid)
		)",
		MYSQL_ERROR_TABLE_EXISTS
	);

	if (!$db->query_first("SELECT * FROM " . TABLE_PREFIX . "adminmessage WHERE varname = 'after_upgrade_40_update_thread_counters'"))
	{
		$upgrade->run_query(
			sprintf($vbphrase['update_table'], TABLE_PREFIX . "adminmessage"),
			"INSERT INTO " . TABLE_PREFIX . "adminmessage
				(varname, dismissable, script, action, execurl, method, dateline, status)
			VALUES
				('after_upgrade_40_update_thread_counters', 1, 'misc.php', 'updatethread', 'misc.php?do=updatethread', 'get', " . TIMENOW . ", 'undone')
			"
		);
	}

	if (!$db->query_first("SELECT * FROM " . TABLE_PREFIX . "adminmessage WHERE varname = 'after_upgrade_40_add_thread_keywords'"))
	{
		$upgrade->run_query(
			sprintf($vbphrase['update_table'], TABLE_PREFIX . "adminmessage"),
			"INSERT INTO " . TABLE_PREFIX . "adminmessage
				(varname, dismissable, script, action, execurl, method, dateline, status)
			VALUES
				('after_upgrade_40_add_thread_keywords', 1, 'misc.php', 'addmissingkeywords', 'misc.php?do=addmissingkeywords', 'get', " . TIMENOW . ", 'undone')
			"
		);
	}

	if (!$db->query_first("SELECT * FROM " . TABLE_PREFIX . "adminmessage WHERE varname = 'after_upgrade_40_rebuild_search_index'"))
	{
		$upgrade->run_query(
			sprintf($vbphrase['update_table'], TABLE_PREFIX . "adminmessage"),
			"INSERT INTO " . TABLE_PREFIX . "adminmessage
				(varname, dismissable, script, action, execurl, method, dateline, status)
			VALUES
				('after_upgrade_40_rebuild_search_index', 1, 'misc.php', 'doindextypes', 'misc.php?do=doindextypes&pp=250&autoredirect=1', 'get', " . TIMENOW . ", 'undone')
			"
		);
	}

	//stuff for new tagging features (synonyms and multi content tagging)
	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'tag', 1, 1),
		'tag',
		'canonicaltagid',
		'int',
		FIELD_DEFAULTS
	);

	$upgrade->add_index(
		sprintf($upgradecore_phrases['create_index_x_on_y'], 'canonicaltagid', TABLE_PREFIX . 'tag'),
		'tag',
		'canonicaltagid',
		array('canonicaltagid')
	);

	$upgrade->run_query(
		sprintf($vbphrase['update_table'], TABLE_PREFIX . "phrasetype"),
			"ALTER TABLE " . TABLE_PREFIX . "tag ENGINE=$hightrafficengine ",
			sprintf($vbphrases['alter_table'], 'tag')
	);

	//note -- any changes to the type datamodel in later releases need to be
	//reflected here if they break the core type module.  Otherwise the upgrade
	//will not correctly run.  The changes should also be put in the later
	//release upgrade for people upgrading from releases later than 4.0a1 in
	//a way that will not break if they changes were already made (the basic
	//add_field function handles this).
	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'contenttype'),
		"CREATE TABLE " . TABLE_PREFIX . "contenttype (
			contenttypeid INT UNSIGNED NOT NULL AUTO_INCREMENT,
			class VARBINARY(50) NOT NULL,
			packageid INT UNSIGNED NOT NULL,
			canplace ENUM('0','1') DEFAULT  '0',
			cansearch ENUM('0','1') DEFAULT '0',
			cantag ENUM('0','1') DEFAULT '0',
			canattach ENUM('0','1') DEFAULT '0',
			isaggregator ENUM('0','1') NOT NULL DEFAULT '0',
			PRIMARY KEY (contenttypeid),
			UNIQUE KEY package (packageid, class)
		) ENGINE=$hightrafficengine
		",
		MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['update_table'], TABLE_PREFIX . "contenttype"),
		"INSERT IGNORE INTO " . TABLE_PREFIX . "contenttype
			(contenttypeid, class, packageid, canplace, cansearch, cantag, canattach)
		VALUES
			(1, 'Post', 1, '0', '1', '0', '1'),
			(2, 'Thread', 1, '0', '0', '1', '0'),
			(3, 'Forum', 1, '0', '1', '0', '0'),
			(4, 'Announcement', 1, '0', '0', '0', '0'),
			(5, 'SocialGroupMessage', 1, '0', '1', '0', '0'),
			(6, 'SocialGroupDiscussion', 1, '0', '0', '0', '0'),
			(7, 'SocialGroup', 1, '0', '1', '0', '1'),
			(8, 'Album', 1, '0', '0', '0', '1'),
			(9, 'Picture', 1, '0', '0', '0', '0'),
			(10, 'PictureComment', 1, '0', '0', '0', '0'),
			(11, 'VisitorMessage', 1, '0', '1', '0', '0'),
			(12, 'User', 1, '0', '0', '0', '0'),
			(13, 'Event', 1, '0', '0', '0', '0'),
			(14, 'Calendar', 1, '0', '0', '0', '0')
		");

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'tagcontent'),
		"CREATE TABLE " . TABLE_PREFIX . "tagcontent (
			tagid INT UNSIGNED NOT NULL DEFAULT 0,
			contenttypeid INT UNSIGNED NOT NULL,
			contentid INT UNSIGNED NOT NULL DEFAULT '0',
			userid INT UNSIGNED NOT NULL DEFAULT '0',
			dateline INT UNSIGNED NOT NULL DEFAULT '0',
			PRIMARY KEY tag_type_cid (tagid, contenttypeid, contentid),
			KEY id_type_user (contentid, contenttypeid, userid),
			KEY user (userid),
			KEY dateline (dateline)
		) ENGINE=$hightrafficengine
		",
		MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'package'),
		"CREATE TABLE " . TABLE_PREFIX . "package (
			packageid INT UNSIGNED NOT NULL AUTO_INCREMENT,
			productid VARCHAR(25) NOT NULL,
			class VARBINARY(50) NOT NULL,
			PRIMARY KEY  (packageid),
			UNIQUE KEY class (class)
		)
		",
		MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['update_table'], TABLE_PREFIX . "package"),
		"INSERT IGNORE INTO " . TABLE_PREFIX . "package (packageid, productid, class)
			VALUES
		(1, 'vbulletin', 'vBForum')"
	);

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'route'),
		"CREATE TABLE " . TABLE_PREFIX . "route (
			routeid INT UNSIGNED NOT NULL AUTO_INCREMENT,
			userrequest VARCHAR(50) NOT NULL,
			packageid INT UNSIGNED NOT NULL,
			class VARBINARY(50) NOT NULL,
			PRIMARY KEY (routeid),
			UNIQUE KEY (userrequest),
			UNIQUE KEY(packageid, class)
		)",
		MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['update_table'], TABLE_PREFIX . "route"),
		"INSERT IGNORE INTO " . TABLE_PREFIX . "route
			(routeid, userrequest, packageid, class)
		VALUES
			(1, 'error', 1, 'Error')"
	);

	$upgrade->execute();
}

// #############################################################################
if ($vbulletin->GPC['step'] == 3)
{
	$upgrade->run_query(
		sprintf($vbphrase['update_table'], TABLE_PREFIX . "tagcontent"),
		"INSERT INTO " . TABLE_PREFIX . "tagcontent
			(tagid, contenttypeid, contentid, userid, dateline)
		SELECT tagid, 2, threadid, userid, dateline
		FROM " . TABLE_PREFIX . "tagthread
		ON DUPLICATE KEY UPDATE contenttypeid = 2",
		MYSQL_ERROR_TABLE_MISSING
	);

//	$upgrade->run_query(
//		sprintf($upgrade_phrases['upgrade_370rc3.php']['dropping_old_table_x'], TABLE_PREFIX . "tagthread"),
//		"DROP TABLE IF EXISTS " . TABLE_PREFIX . "tagthread"
//	);

	$upgrade->run_query(
		sprintf($vbphrase['update_table'], TABLE_PREFIX . "phrasetype"),
		"INSERT IGNORE INTO " . TABLE_PREFIX . "phrasetype
			(title, editrows, fieldname, special)
		VALUES
			('{$phrasetype['tagscategories']}', 3, 'tagscategories', 0),
			('{$phrasetype['contenttypes']}', 3, 'contenttypes', 0)
		"
	);

	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'language', 1, 1),
		'language',
		'phrasegroup_tagscategories',
		'mediumtext',
		FIELD_DEFAULTS
	);

	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'language', 1, 1),
		'language',
		'phrasegroup_contenttypes',
		'mediumtext',
		FIELD_DEFAULTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'cache'),
		"CREATE TABLE " . TABLE_PREFIX . "cache (
			cacheid VARBINARY(64) NOT NULL,
			expires INT UNSIGNED NOT NULL,
			created INT UNSIGNED NOT NULL,
			locktime INT UNSIGNED NOT NULL,
			serialized ENUM('0','1') NOT NULL DEFAULT '0',
			data BLOB,
			PRIMARY KEY (cacheid)
		)",
		MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'cacheevent'),
		"CREATE TABLE " . TABLE_PREFIX . "cacheevent (
			cacheid VARBINARY(64) NOT NULL,
			event VARBINARY(50) NOT NULL,
			PRIMARY KEY (cacheid, event)
		)",
		MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'action'),
		"CREATE TABLE " . TABLE_PREFIX . "action (
			actionid INT UNSIGNED NOT NULL AUTO_INCREMENT,
			routeid INT UNSIGNED NOT NULL,
			packageid INT UNSIGNED NOT NULL,
			controller VARBINARY(50) NOT NULL,
			useraction VARCHAR(50) NOT NULL,
			classaction VARBINARY(50) NOT NULL,
			PRIMARY KEY (actionid),
			UNIQUE KEY useraction (routeid, useraction),
			UNIQUE KEY classaction (packageid, controller, classaction)
		)",
		MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'contentpriority'),
		"CREATE TABLE " . TABLE_PREFIX . "contentpriority (
			contenttypeid varchar(20) NOT NULL,
	  		sourceid INT(10) UNSIGNED NOT NULL,
	  		prioritylevel DOUBLE(2,1) UNSIGNED NOT NULL,
	  		PRIMARY KEY (contenttypeid, sourceid)
		)",
		MYSQL_ERROR_TABLE_EXISTS
	);

	// Add cron job for sitemap
	if (!$db->query_first("SELECT filename FROM " . TABLE_PREFIX . "cron WHERE filename = './includes/cron/sitemap.php'"))
	{
		$upgrade->run_query(
			sprintf($upgrade_phrases['upgrade_400a1.php']['altering_x_table'], 'cron', 1, 1),
			"INSERT INTO " . TABLE_PREFIX . "cron
				(nextrun, weekday, day, hour, minute, filename, loglevel, varname, volatile, product)
			VALUES
				(1232082000, -1, -1, 5, 'a:1:{i:0;i:0;}', './includes/cron/sitemap.php', 1, 'sitemap', 1, 'vbulletin')"
		);
	}

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'searchcore'),
		"CREATE TABLE " . TABLE_PREFIX . "searchcore (
			searchcoreid INT UNSIGNED NOT NULL AUTO_INCREMENT,
			contenttypeid INT UNSIGNED NOT NULL,
			primaryid INT UNSIGNED  NOT NULL,
			groupcontenttypeid INT UNSIGNED NOT NULL,
			groupid INT UNSIGNED NOT NULL DEFAULT 0,
			dateline INT UNSIGNED NOT NULL DEFAULT 0,
			userid INT UNSIGNED NOT NULL DEFAULT 0,
			username VARCHAR(100) NOT NULL,
			ipaddress INT UNSIGNED NOT NULL,
			searchgroupid INT UNSIGNED NOT NULL,
			PRIMARY KEY (searchcoreid),
			UNIQUE KEY contentunique (contenttypeid, primaryid),
			KEY groupid (groupcontenttypeid, groupid),
			KEY ipaddress (ipaddress),
			KEY dateline (dateline),
			KEY userid (userid),
			KEY searchgroupid (searchgroupid)
		) ENGINE=$hightrafficengine
		", MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'searchcore_text'),
		"CREATE TABLE " . TABLE_PREFIX . "searchcore_text (
			searchcoreid INT UNSIGNED NOT NULL,
			keywordtext MEDIUMTEXT,
			title VARCHAR(255) NOT NULL DEFAULT '',
			PRIMARY KEY (searchcoreid),
			FULLTEXT KEY text (title, keywordtext)
		) ENGINE=MyISAM
		", MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'searchgroup'),
		"CREATE TABLE " . TABLE_PREFIX . "searchgroup (
			searchgroupid INT UNSIGNED NOT NULL AUTO_INCREMENT,
			contenttypeid INT UNSIGNED NOT NULL,
			groupid INT UNSIGNED  NOT NULL,
			dateline INT UNSIGNED NOT NULL DEFAULT 0,
			userid INT UNSIGNED NOT NULL DEFAULT 0,
			username VARCHAR(100) NOT NULL,
			PRIMARY KEY (searchgroupid),
			UNIQUE KEY groupunique (contenttypeid, groupid),
			KEY dateline (dateline),
			KEY userid (userid)
		) ENGINE=$hightrafficengine
		", MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'searchgroup_text'),
		"CREATE TABLE " . TABLE_PREFIX . "searchgroup_text (
			searchgroupid INT UNSIGNED NOT NULL,
			title VARCHAR(255) NOT NULL,
			PRIMARY KEY (searchgroupid),
			FULLTEXT KEY grouptitle (title)
		) ENGINE=MyISAM
		", MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'searchlog'),
		"CREATE TABLE " . TABLE_PREFIX . "searchlog (
			searchlogid INT UNSIGNED NOT NULL AUTO_INCREMENT,
			userid INT UNSIGNED NOT NULL DEFAULT '0',
			ipaddress VARCHAR(15) NOT NULL DEFAULT '',
			searchhash VARCHAR(32) NOT NULL,
			sortby VARCHAR(15) NOT NULL DEFAULT '',
			sortorder ENUM('asc','desc') NOT NULL DEFAULT 'asc',
			searchtime FLOAT UNSIGNED NOT NULL DEFAULT '0',
			dateline INT UNSIGNED NOT NULL DEFAULT '0',
			completed SMALLINT UNSIGNED NOT NULL DEFAULT '0',
			criteria TEXT NOT NULL,
			results MEDIUMBLOB,
			PRIMARY KEY (searchlogid),
			KEY search (userid, searchhash, sortby, sortorder),
			KEY userfloodcheck (userid, dateline),
			KEY ipfloodcheck (ipaddress, dateline)
		) ENGINE=$hightrafficengine
		", MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'indexqueue'),
		"CREATE TABLE " . TABLE_PREFIX . "indexqueue (
				queueid INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
				contenttype VARCHAR(45) NOT NULL,
				newid INTEGER UNSIGNED NOT NULL,
				id2 INTEGER UNSIGNED NOT NULL,
				package VARCHAR(64) NOT NULL,
				operation VARCHAR(64) NOT NULL,
				data TEXT NOT NULL,
				PRIMARY KEY (queueid)
			)
		", MYSQL_ERROR_TABLE_EXISTS
	);

	//remove old tables
	$upgrade->run_query(
		sprintf($upgrade_phrases['upgrade_370rc3.php']['dropping_old_table_x'], TABLE_PREFIX . "search"),
		"DROP TABLE IF EXISTS " . TABLE_PREFIX . "search"
	);

	$upgrade->run_query(
		sprintf($upgrade_phrases['upgrade_370rc3.php']['dropping_old_table_x'], TABLE_PREFIX . "word"),
		"DROP TABLE IF EXISTS " . TABLE_PREFIX . "word"
	);

	$upgrade->run_query(
		sprintf($upgrade_phrases['upgrade_370rc3.php']['dropping_old_table_x'], TABLE_PREFIX . "tagthread"),
		"DROP TABLE IF EXISTS " . TABLE_PREFIX . "tagthread"
	);

	$upgrade->execute();
}

// #############################################################################
/*
	Make the renames into their own step so that they don't trip the "existing table" check
	The check takes place on each step prior to the rename so that the attachment file we are moving
	will conflict with the attachment file we are creating.  An extra step is a quicker and safer
	alternative to coding overrides into the check code.
*/
if ($vbulletin->GPC['step'] == 4)
{
	if (!$upgrade->field_exists('attachment', 'filedataid') AND $upgrade->field_exists('filedata', 'filedataid'))
	{
		// We have a vb3 attachment table and a vb4 filedata table which causes a problem so move the vb4 filedata table
		$upgrade->run_query(
			sprintf($vbphrase['update_table'], TABLE_PREFIX . "filedata"),
			"RENAME TABLE " . TABLE_PREFIX . "filedata TO " . TABLE_PREFIX . "filedata" . vbrand(0, 1000000),
			MYSQL_ERROR_TABLE_EXISTS
		);
	}

	$upgrade->run_query(
		sprintf($vbphrase['update_table'], TABLE_PREFIX . "attachment"),
		"RENAME TABLE " . TABLE_PREFIX . "attachment TO " . TABLE_PREFIX . "filedata",
		MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->execute();
}

// #############################################################################
if ($vbulletin->GPC['step'] == 5)
{

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'attachment'),
		"CREATE TABLE " . TABLE_PREFIX . "attachment (
			attachmentid INT UNSIGNED NOT NULL AUTO_INCREMENT,
			contenttypeid INT UNSIGNED NOT NULL DEFAULT '0',
			contentid INT UNSIGNED NOT NULL DEFAULT '0',
			userid INT UNSIGNED NOT NULL DEFAULT '0',
			dateline INT UNSIGNED NOT NULL DEFAULT '0',
			filedataid INT UNSIGNED NOT NULL DEFAULT '0',
			state ENUM('visible', 'moderation') NOT NULL DEFAULT 'visible',
			counter INT UNSIGNED NOT NULL DEFAULT '0',
			posthash VARCHAR(32) NOT NULL DEFAULT '',
			filename VARCHAR(100) NOT NULL DEFAULT '',
			caption TEXT,
			reportthreadid INT UNSIGNED NOT NULL DEFAULT '0',
			PRIMARY KEY (attachmentid),
			KEY contenttypeid (contenttypeid, contentid),
			KEY contentid (contentid),
			KEY userid (userid, contenttypeid),
			KEY posthash (posthash, userid),
			KEY filedataid (filedataid, userid)
		)",
		MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'attachmentcategory'),
		"CREATE TABLE " . TABLE_PREFIX . "attachmentcategory (
			categoryid INT UNSIGNED NOT NULL AUTO_INCREMENT,
			userid INT UNSIGNED NOT NULL DEFAULT '0',
			title VARCHAR(255) NOT NULL DEFAULT '',
			parentid INT UNSIGNED NOT NULL DEFAULT '0',
			displayorder INT UNSIGNED NOT NULL DEFAULT '0',
			PRIMARY KEY (categoryid),
			KEY userid (userid, parentid, displayorder)
		)",
		MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'attachmentcategoryuser'),
		"CREATE TABLE " . TABLE_PREFIX . "attachmentcategoryuser (
			filedataid INT UNSIGNED NOT NULL DEFAULT '0',
			userid INT UNSIGNED NOT NULL DEFAULT '0',
			categoryid INT UNSIGNED NOT NULL DEFAULT '0',
			filename VARCHAR(100) NOT NULL DEFAULT '',
			dateline INT UNSIGNED NOT NULL DEFAULT '0',
			PRIMARY KEY (filedataid, userid),
			KEY categoryid (categoryid, userid, filedataid),
			KEY userid (userid, categoryid, dateline)
		)",
		MYSQL_ERROR_TABLE_EXISTS
	);

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

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'stylevar'),
		"CREATE TABLE " . TABLE_PREFIX . "stylevar (
			stylevarid varchar(250) NOT NULL,
			styleid SMALLINT NOT NULL DEFAULT '-1',
			value MEDIUMBLOB NOT NULL,
			dateline INT UNSIGNED NOT NULL DEFAULT '0',
			username VARCHAR(100) NOT NULL DEFAULT '',
			UNIQUE KEY stylevarinstance (stylevarid, styleid)
		)",
		MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->run_query(
		sprintf($vbphrase['create_table'], TABLE_PREFIX . 'stylevardfn'),
		"CREATE TABLE " . TABLE_PREFIX . "stylevardfn (
			stylevarid varchar(250) NOT NULL,
			styleid SMALLINT NOT NULL DEFAULT '-1',
			parentid SMALLINT NOT NULL,
			parentlist varchar(250) NOT NULL DEFAULT '0',
			stylevargroup varchar(250) NOT NULL,
			product varchar(25) NOT NULL default 'vbulletin',
			datatype varchar(25) NOT NULL default 'string',
			validation varchar(250) NOT NULL,
			failsafe MEDIUMBLOB NOT NULL,
			units enum('','%','px','pt','em','ex','pc','in','cm','mm') NOT NULL default '',
			uneditable tinyint(3) unsigned NOT NULL default '0',
			PRIMARY KEY (stylevarid)
		)",
		MYSQL_ERROR_TABLE_EXISTS
	);

	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'user', 1, 1),
		'user',
		'assetposthash',
		'varchar',
		array('length' => 32, 'attributes' => FIELD_DEFAULTS)
	);

	$upgrade->run_query(
		sprintf($vbphrase['update_table'], TABLE_PREFIX . 'user'),
		"UPDATE " . TABLE_PREFIX . "user SET options = options | " . $vbulletin->bf_misc_useroptions['vbasset_enable']
	);

	// Enable asset manager as a default for new users
	$upgrade->run_query(
		sprintf($vbphrase['update_table'], TABLE_PREFIX . 'setting'),
		"UPDATE " . TABLE_PREFIX . "setting SET
			value = value | " . $vbulletin->bf_misc_regoptions['vbasset_enable'] . "
		WHERE varname = 'defaultregoptions'"
	);

	$upgrade->execute();
}

// #############################################################################
if ($vbulletin->GPC['step'] == 6)
{
	$perpage = 100;

	if ($upgrade->field_exists('filedata', 'attachmentid'))
	{
		$files = $db->query_read("
			SELECT attachmentid, postid, userid, dateline, visible, counter, filename
			FROM " . TABLE_PREFIX . "filedata
			WHERE attachmentid > {$vbulletin->GPC['startat']}
			ORDER BY attachmentid ASC
			LIMIT 0, $perpage
		");

		if ($db->num_rows($files))
		{
			$lastid = 0;
			$sql = $sql2 = array();
			while ($file = $db->fetch_array($files))
			{
				echo sprintf($upgrade_phrases['upgrade_400a1.php']['convert_attachment'], $file['attachmentid']);
				$sql[] = "(
					$file[attachmentid],
					1,
					$file[postid],
					$file[userid],
					$file[dateline],
					$file[attachmentid],
					'" . ($file['visible'] ? 'visible' : 'moderation') . "',
					$file[counter],
					'" . $db->escape_string($file['filename']) . "'
				)";

				$sql2[] = "(
					$file[attachmentid],
					$file[userid],
					0,
					'" . $db->escape_string($file['filename']) . "',
					$file[dateline]
				)";
				$lastid = $file['attachmentid'];
			}

			if (!empty($sql))
			{
				$db->query_write("
					INSERT IGNORE INTO " . TABLE_PREFIX . "attachment
						(attachmentid, contenttypeid, contentid, userid, dateline, filedataid, state, counter, filename)
					VALUES
						" . implode(",\r\n\t\t", $sql) . "
				");
				$db->query_write("
					INSERT IGNORE INTO " . TABLE_PREFIX . "attachmentcategoryuser
						(filedataid, userid, categoryid, filename, dateline)
					VALUES
						" . implode(",\r\n\t\t", $sql2) . "
				");
			}

			print_next_page(1, $lastid);
		}
		else
		{
			echo $upgrade_phrases['upgrade_400a1.php']['update_attachments_complete'];
		}
	}
	else
	{
		echo $upgrade_phrases['upgrade_400a1.php']['update_attachments_complete'];
	}
}

// #############################################################################
if ($vbulletin->GPC['step'] == 7)
{
	$x = 1; $y = 12;
	if ($upgrade->field_exists('filedata', 'attachmentid'))
	{
		$upgrade->run_query(
			sprintf($upgradecore_phrases['altering_x_table'], 'filedata', $x++, ++$y),
			"ALTER TABLE " . TABLE_PREFIX . "filedata CHANGE attachmentid filedataid INT UNSIGNED NOT NULL AUTO_INCREMENT"
		);
	}

	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'filedata', $x++, $y),
		'filedata',
		'width',
		'smallint',
		FIELD_DEFAULTS
	);

	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'filedata', $x++, $y),
		'filedata',
		'height',
		'smallint',
		FIELD_DEFAULTS
	);

	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'filedata', $x++, $y),
		'filedata',
		'thumbnail_width',
		'smallint',
		FIELD_DEFAULTS
	);

	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'filedata', $x++, $y),
		'filedata',
		'thumbnail_height',
		'smallint',
		FIELD_DEFAULTS
	);

	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'filedata', $x++, $y),
		'filedata',
		'refcount',
		'int',
		FIELD_DEFAULTS
	);

	if (!$upgrade->field_exists('filedata', 'refcount'))
	{
		$upgrade->run_query(
			sprintf($upgradecore_phrases['altering_x_table'], 'filedata', $x++, ++$y),
			"UPDATE " . TABLE_PREFIX . "filedata SET refcount = 1"
		);
	}

	$upgrade->add_index(
		sprintf($upgradecore_phrases['altering_x_table'], 'filedata', $x++, $y),
		'filedata',
		'refcount',
		array('refcount', 'dateline')
	);

	$upgrade->drop_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'filedata', $x++, $y),
		'filedata',
		'filename'
	);

	$upgrade->drop_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'filedata', $x++, $y),
		'filedata',
		'counter'
	);

	$upgrade->drop_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'filedata', $x++, $y),
		'filedata',
		'visible'
	);

	$upgrade->drop_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'filedata', $x++, $y),
		'filedata',
		'postid'
	);

	$upgrade->drop_index(
		sprintf($upgradecore_phrases['altering_x_table'], 'filedata', $x, $y),
		'filedata',
		'posthash'
	);

	$upgrade->drop_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'filedata', $x, $y),
		'filedata',
		'posthash'
	);

	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'attachmenttype', 1, 1),
		'attachmenttype',
		'contenttypes',
		'mediumtext',
		FIELD_DEFAULTS
	);

	$upgrade->execute();

	$extensions = $db->query_read("
		SELECT *
		FROM " . TABLE_PREFIX . "attachmenttype
	");
	while ($ext = $db->fetch_array($extensions))
	{
		if (isset($ext['enabled']))
		{
			$cache = array(
				1 => array(
					'n' => $ext['newwindow'],
					'e' => $ext['enabled'],
				),
				2 => array(
					'n' => $ext['newwindow'],
					'e' => in_array($ext['extension'], array('gif','jpe','jpeg','jpg','png','bmp')) ? 1 : 0
				)
			);
			$db->query_write("
				UPDATE " . TABLE_PREFIX . "attachmenttype
				SET contenttypes = '" . $db->escape_string(serialize($cache)) . "'
				WHERE extension = '" . $db->escape_string($ext['extension']) . "'
			");
		}
	}
}

// #############################################################################
if ($vbulletin->GPC['step'] == 8)
{
	$upgrade->drop_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'attachmenttype', 1, 3),
		'attachmenttype',
		'enabled'
	);

	$upgrade->drop_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'attachmenttype', 2, 3),
		'attachmenttype',
		'newwindow'
	);

	$upgrade->drop_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'attachmenttype', 3, 3),
		'attachmenttype',
		'thumbnail'
	);

	if ($upgrade->field_exists('albumpicture', 'pictureid'))
	{
		$upgrade->add_field(
			sprintf($upgradecore_phrases['altering_x_table'], 'albumpicture', 1, 1),
			'albumpicture',
			'attachmentid',
			'int',
			FIELD_DEFAULTS
		);
	}

	if ($upgrade->field_exists('socialgrouppicture', 'pictureid'))
	{
		$upgrade->add_field(
			sprintf($upgradecore_phrases['altering_x_table'], 'socialgrouppicture', 1, 1),
			'socialgrouppicture',
			'attachmentid',
			'int',
			FIELD_DEFAULTS
		);
	}

	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'usercss', 1, 1),
		'usercss',
		'converted',
		'smallint',
		FIELD_DEFAULTS
	);

	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'picturecomment', 1, 2),
		'picturecomment',
		'filedataid',
		'int',
		FIELD_DEFAULTS
	);

	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'picturecomment', 2, 2),
		'picturecomment',
		'userid',
		'int',
		FIELD_DEFAULTS
	);

	if ($upgrade->field_exists('picturecomment_hash', 'pictureid'))
	{
		$upgrade->run_query(
			sprintf($upgradecore_phrases['altering_x_table'], 'picturecomment_hash', 1, 2),
			"ALTER TABLE " . TABLE_PREFIX . "picturecomment_hash CHANGE pictureid filedataid INT UNSIGNED NOT NULL DEFAULT '0'"
		);
	}

	$upgrade->add_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'picturecomment_hash', 2, 2),
		'picturecomment_hash',
		'userid',
		'int',
		FIELD_DEFAULTS
	);

	if ($upgrade->field_exists('album', 'coverpictureid'))
	{
		$upgrade->run_query(
			sprintf($upgradecore_phrases['altering_x_table'], 'album', 1, 1),
			"ALTER TABLE " . TABLE_PREFIX . "album CHANGE coverpictureid coverattachmentid INT UNSIGNED NOT NULL DEFAULT '0'"
		);
	}

	$upgrade->drop_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'usergroup', 1, 1),
		'usergroup',
		'albumpicmaxsize'
	);

	$upgrade->execute();
}

// #############################################################################
if ($vbulletin->GPC['step'] == 9)
{
	$users = array();
	// Convert Albums
	$db_alter = new vB_Database_Alter_MySQL($db);
	if ($db_alter->fetch_table_info('albumpicture'))
	{
		$vbulletin->GPC['perpage'] = 25;
		$pictures = $db->query_read("
			SELECT
				albumpicture.albumid, albumpicture.dateline,
				picture.*
			FROM " . TABLE_PREFIX . "albumpicture AS albumpicture
			INNER JOIN " . TABLE_PREFIX . "picture AS picture ON (albumpicture.pictureid = picture.pictureid)
			WHERE
				albumpicture.pictureid > {$vbulletin->GPC['startat']}
					AND
				albumpicture.attachmentid = 0
			ORDER BY albumpicture.pictureid ASC
			LIMIT 0, {$vbulletin->GPC['perpage']}
		");
		if ($db->num_rows($pictures))
		{
			$lastid = 0;
			while ($picture = $db->fetch_array($pictures))
			{
				echo sprintf($upgrade_phrases['upgrade_400a1.php']['convert_picture'], $picture['pictureid']);
				$lastid = $picture['pictureid'];

				if ($vbulletin->options['album_dataloc'] == 'db')
				{
					$thumbnail =& $picture['thumbnail'];
					$filedata =& $picture['filedata'];
				}
				else
				{
					$attachpath = $vbulletin->options['album_picpath'] . '/' . floor($picture['pictureid'] / 1000) . "/$picture[pictureid].picture";
					if ($vbulletin->options['album_dataloc'] == 'fs_directthumb')
					{
						$attachthumbpath = $vbulletin->options['album_thumbpath'] . '/' . floor($picture['pictureid'] / 1000);
					}
					else
					{
						$attachthumbpath = $vbulletin->options['album_picpath'] . '/' . floor($picture['pictureid'] / 1000);
					}
					$attachthumbpath .= "/$picture[idhash]_$picture[pictureid].$picture[extension]";

					$thumbnail = @file_get_contents($attachthumbpath);
					$filedata = @file_get_contents($attachpath);
					if ($filedata === false)
					{
						echo sprintf($upgrade_phrases['upgrade_400a1.php']['could_not_find_file'], $attachpath);
						continue;
					}
				}

				$attachdm =& datamanager_init('AttachmentFiledata', $vbulletin, ERRTYPE_CP, 'attachment');
				$attachdm->set('contenttypeid', 8);
				$attachdm->set('contentid', $picture['albumid']);
				$attachdm->set('filename', $picture['pictureid'] . '.' . $picture['extension']);
				$attachdm->set('width', $picture['width']);
				$attachdm->set('height', $picture['height']);
				$attachdm->set('state', $picture['state']);
				$attachdm->set('reportthreadid', $picture['reportthreadid']);
				$attachdm->set('userid', $picture['userid']);
				$attachdm->set('caption', $picture['caption']);
				$attachdm->set('dateline', $picture['dateline']);
				$attachdm->set('thumbnail_dateline', $picture['thumbnail_dateline']);
				$attachdm->setr('filedata', $filedata);
				$attachdm->setr('thumbnail', $thumbnail);

				if ($attachmentid = $attachdm->save())
				{
					$db->query_write("
						UPDATE " . TABLE_PREFIX . "albumpicture
						SET
							attachmentid = $attachmentid
						WHERE
							pictureid = $picture[pictureid]
								AND
							albumid = $picture[albumid]
					");

					$db->query_write("
						INSERT IGNORE INTO " . TABLE_PREFIX . "picturelegacy
							(type, primaryid, pictureid, attachmentid)
						VALUES
							('album', $picture[albumid], $picture[pictureid], $attachmentid)
					");

					$db->query_write("
						UPDATE " . TABLE_PREFIX . "picturecomment
						SET
							filedataid = " . $attachdm->fetch_field('filedataid') . ",
							userid = $picture[userid]
						WHERE
							pictureid = $picture[pictureid]
					");

					$db->query_write("
						UPDATE " . TABLE_PREFIX . "album
						SET coverattachmentid = $attachmentid
						WHERE
							coverattachmentid = $picture[pictureid]
								AND
							albumid = $picture[albumid]
					");

					$oldvalue = "$picture[albumid],$picture[userid]";
					$newvalue = "$picture[albumid],$attachmentid]";
					$db->query_write("
						UPDATE " . TABLE_PREFIX . "usercss
						SET
							value = '" . $db->escape_string($newvalue) . "',
							converted = 1
						WHERE
							property = 'background_image'
								AND
							value = '" . $db->escape_string($oldvalue) . "'
								AND
							userid = $picture[userid]
								AND
							converted = 0
					");
					if ($db->affected_rows())
					{
						$users["$picture[userid]"] = 1;
					}
				}
				else
				{
					//will print errors and die.
					$attachdm->has_errors(true);
				}
			}

			if (!empty($users))
			{
				require_once(DIR . '/includes/class_usercss.php');
				foreach(array_keys($users) AS $userid)
				{
					$usercss = new vB_UserCSS($vbulletin, $userid, false);
					$usercss->update_css_cache();
				}
			}

			print_next_page(1, $lastid);
		}
		else
		{
			echo $upgrade_phrases['upgrade_400a1.php']['update_albums_complete'];
		}
	}
	else
	{
		echo $upgrade_phrases['upgrade_400a1.php']['update_albums_complete'];
	}
}

// #############################################################################
if ($vbulletin->GPC['step'] == 10)
{
	// Convert Social Groups
	$db_alter = new vB_Database_Alter_MySQL($db);
	if ($db_alter->fetch_table_info('albumpicture'))
	{
		$vbulletin->GPC['perpage'] = 25;
		$pictures = $db->query_read("
			SELECT
				sgp.groupid, sgp.dateline,
				picture.*
			FROM " . TABLE_PREFIX . "socialgrouppicture AS sgp
			INNER JOIN " . TABLE_PREFIX . "picture AS picture ON (sgp.pictureid = picture.pictureid)
			WHERE
				sgp.pictureid > {$vbulletin->GPC['startat']}
					AND
				sgp.attachmentid = 0
			ORDER BY sgp.pictureid ASC
			LIMIT 0, {$vbulletin->GPC['perpage']}
		");
		if ($db->num_rows($pictures))
		{
			$lastid = 0;
			while ($picture = $db->fetch_array($pictures))
			{
				echo sprintf($upgrade_phrases['upgrade_400a1.php']['convert_picture'], $picture['pictureid']);
				$lastid = $picture['pictureid'];

				if ($vbulletin->options['album_dataloc'] == 'db')
				{
					$thumbnail =& $picture['thumbnail'];
					$filedata =& $picture['filedata'];
				}
				else
				{
					$attachpath = $vbulletin->options['album_picpath'] . '/' . floor($picture['pictureid'] / 1000) . "/$picture[pictureid].picture";
					if ($vbulletin->options['album_dataloc'] == 'fs_directthumb')
					{
						$attachthumbpath = $vbulletin->options['album_thumbpath'] . '/' . floor($picture['pictureid'] / 1000);
					}
					else
					{
						$attachthumbpath = $vbulletin->options['album_picpath'] . '/' . floor($picture['pictureid'] / 1000);
					}
					$attachthumbpath .= "/$picture[idhash]_$picture[pictureid].$picture[extension]";

					$thumbnail = @file_get_contents($attachthumbpath);
					$filedata = @file_get_contents($attachpath);

					if ($filedata === false)
					{
						echo sprintf($upgrade_phrases['upgrade_400a1.php']['could_not_find_file'], $attachpath);
						continue;
					}
				}

				$attachdm =& datamanager_init('AttachmentFiledata', $vbulletin, ERRTYPE_ARRAY, 'attachment');
				$attachdm->set('contenttypeid', 7);
				$attachdm->set('contentid', $picture['groupid']);
				$attachdm->set('filename', $picture['pictureid'] . '.' . $picture['extension']);
				$attachdm->set('width', $picture['width']);
				$attachdm->set('height', $picture['height']);
				$attachdm->set('state', $picture['state']);
				$attachdm->set('reportthreadid', $picture['reportthreadid']);
				$attachdm->set('userid', $picture['userid']);
				$attachdm->set('caption', $picture['caption']);
				$attachdm->set('dateline', $picture['dateline']);
				$attachdm->set('thumbnail_dateline', $picture['thumbnail_dateline']);
				$attachdm->setr('filedata', $filedata);
				$attachdm->setr('thumbnail', $thumbnail);
				if ($attachmentid = $attachdm->save())
				{
					$db->query_write("
						UPDATE " . TABLE_PREFIX . "socialgrouppicture
						SET
							attachmentid = $attachmentid
						WHERE
							pictureid = $picture[pictureid]
								AND
							groupid = $picture[groupid]
					");

					$db->query_write("
						INSERT IGNORE INTO " . TABLE_PREFIX . "picturelegacy
							(type, primaryid, pictureid, attachmentid)
						VALUES
							('group', $picture[groupid], $picture[pictureid], $attachmentid)
					");
				}
				else
				{
					//will print errors and die.
					$attachdm->has_errors(true);
				}
			}
			print_next_page(1, $lastid);
		}
		else
		{
			echo $upgrade_phrases['upgrade_400a1.php']['update_groups_complete'];
		}
	}
	else
	{
		echo $upgrade_phrases['upgrade_400a1.php']['update_groups_complete'];
	}
}

// #############################################################################
if ($vbulletin->GPC['step'] == 11)
{

	$upgrade->run_query(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'moderator', 1, 1),
		"UPDATE " . TABLE_PREFIX . "moderator SET
			permissions2 = permissions2 |
				IF(permissions2 & " . $vbulletin->bf_misc_moderatorpermissions2['caneditalbumpicture'] . ", " . $vbulletin->bf_misc_moderatorpermissions2['caneditgrouppicture'] . ", 0) |
				IF(permissions2 & " . $vbulletin->bf_misc_moderatorpermissions2['candeletealbumpicture'] . ", " . $vbulletin->bf_misc_moderatorpermissions2['candeletegrouppicture'] . ", 0) |
				IF(permissions2 & " . $vbulletin->bf_misc_moderatorpermissions2['canmoderatepictures'] . ", " . $vbulletin->bf_misc_moderatorpermissions2['canmoderategrouppicture'] . ", 0)
		"
	);

	$upgrade->run_query(
		sprintf($upgrade_phrases['upgrade_300b3.php']['altering_x_table'], 'usergroup', 1, 1),
		"UPDATE " . TABLE_PREFIX . "usergroup SET
			socialgrouppermissions = socialgrouppermissions |
				IF(albumpermissions & " . $vbulletin->bf_ugp_albumpermissions['canalbum'] . ", " . $vbulletin->bf_ugp_socialgrouppermissions['canupload'] . ", 0) |
				IF(albumpermissions & " . $vbulletin->bf_ugp_albumpermissions['picturefollowforummoderation'] . ", " . $vbulletin->bf_ugp_socialgrouppermissions['groupfollowforummoderation'] . ", 0)
		"
	);

	$upgrade->run_query(
		sprintf($upgrade_phrases['upgrade_370rc3.php']['dropping_old_table_x'], TABLE_PREFIX . "albumpicture"),
		"DROP TABLE IF EXISTS " . TABLE_PREFIX . "albumpicture"
	);

	$upgrade->run_query(
		sprintf($upgrade_phrases['upgrade_370rc3.php']['dropping_old_table_x'], TABLE_PREFIX . "socialgrouppicture"),
		"DROP TABLE IF EXISTS " . TABLE_PREFIX . "socialgrouppicture"
	);

	$upgrade->run_query(
		sprintf($upgrade_phrases['upgrade_370rc3.php']['dropping_old_table_x'], TABLE_PREFIX . "picture"),
		"DROP TABLE IF EXISTS " . TABLE_PREFIX . "picture"
	);

	$upgrade->drop_field(
		sprintf($upgradecore_phrases['altering_x_table'], 'picturecomment', 1, 6),
		'picturecomment',
		'pictureid'
	);

	$upgrade->drop_index(
		sprintf($upgradecore_phrases['altering_x_table'], 'picturecomment', 2, 6),
		'picturecomment',
		'pictureid'
	);

	$upgrade->drop_index(
		sprintf($upgradecore_phrases['altering_x_table'], 'picturecomment', 3, 6),
		'picturecomment',
		'postuserid'
	);

	$upgrade->add_index(
		sprintf($upgradecore_phrases['altering_x_table'], 'picturecomment', 4, 6),
		'picturecomment',
		'filedataid',
		array('filedataid', 'userid', 'dateline', 'state')
	);

	$upgrade->add_index(
		sprintf($upgradecore_phrases['altering_x_table'], 'filedata', 5, 6),
		'picturecomment',
		'postuserid',
		array('postuserid', 'filedataid', 'userid', 'state')
	);

	$upgrade->add_index(
		sprintf($upgradecore_phrases['altering_x_table'], 'filedata', 6, 6),
		'picturecomment',
		'userid',
		array('userid')
	);

	$postcount = $db->query_first("SELECT SUM(replycount) AS postcount FROM " . TABLE_PREFIX . "forum");
	if ($postcount['postcount'] > 1200000)
	{
		$upgrade->long_next_step();
	}

	$upgrade->execute();

	require_once(DIR . '/includes/adminfunctions_attachment.php');
	build_attachment_permissions();

	// Kill duplicate files in the filedata table
	$files = $db->query_read("
		SELECT count(*) AS count, filehash, filesize
		FROM " . TABLE_PREFIX . "filedata
		GROUP BY filehash, filesize
		HAVING count > 1
	");
	while ($file = $db->fetch_array($files))
	{
		$refcount = 0;
		$filedataid = 0;
		$killfiles = array();
		$files2 = $db->query("
			SELECT
				filedataid, refcount, userid
			FROM " . TABLE_PREFIX . "filedata
			WHERE
				filehash = '$file[filehash]'
					AND
				filesize = $file[filesize]
		");
		while ($file2 = $db->fetch_array($files2))
		{
			$refcount += $file2['refcount'];
			if (!$filedataid)
			{
				$filedataid = $file2['filedataid'];
			}
			else
			{
				$killfiles[$file2['filedataid']] = $file2['userid'];
			}
		}

		$db->query_write("UPDATE " . TABLE_PREFIX . "filedata SET refcount = $refcount WHERE filedataid = $filedataid");
		$db->query_write("UPDATE " . TABLE_PREFIX . "attachment SET filedataid = $filedataid WHERE filedataid IN (" . implode(",", array_keys($killfiles)) . ")");
		$db->query_write("DELETE FROM " . TABLE_PREFIX . "filedata WHERE filedataid IN (" . implode(",", array_keys($killfiles)) . ")");
		foreach ($killfiles AS $filedataid => $userid)
		{
			if ($vbulletin->GPC['attachtype'] == ATTACH_AS_FILES_NEW)
			{
				$path = $vbulletin->options['attachpath'] . '/' . implode('/', preg_split('//', $userid,  -1, PREG_SPLIT_NO_EMPTY));
			}
			else
			{
				$path = $vbulletin->options['attachpath'] . '/' . $userid;
			}
			@unlink($path . '/' . $filedataid . '.attach');
			@unlink($path . '/' . $filedataid . '.thumb');
		}
	}
}

if ($vbulletin->GPC['step'] == 12)
{
	$db->query_write("
		UPDATE " . TABLE_PREFIX . "setting
		SET value = 'ssl'
		WHERE varname = 'smtp_tls' AND value = '1'
	");

	//we don't do select COUNT(*) post on purpose.  We're trying to not hold up the upgrade
	//for big boards on the indexes and COUNT(*) on a say 10 million post INNODB table can
	//take minutes.  Besides we're only looking for a ball park, so this should work out
	//sufficiently well.
	$postcount = $db->query_first("SELECT SUM(replycount) AS postcount FROM " . TABLE_PREFIX . "forum");
	if ($postcount['postcount'] < 1200000)
	{
		$upgrade->add_index(
			sprintf($upgradecore_phrases['create_index_x_on_y'], 'threadid_visible_dateline', TABLE_PREFIX . 'post'),
			'post',
			'threadid_visible_dateline',
			array('threadid', 'visible', 'dateline', 'userid', 'postid')
		);

		$upgrade->add_index(
			sprintf($upgradecore_phrases['create_index_x_on_y'], 'ipaddress', TABLE_PREFIX . 'post'),
			'post',
			'ipaddress',
			array('ipaddress')
		);

		$upgrade->add_index(
			sprintf($upgradecore_phrases['create_index_x_on_y'], 'dateline', TABLE_PREFIX . 'post'),
			'post',
			'dateline',
			array('dateline')
		);

		$upgrade->add_index(
			sprintf($upgradecore_phrases['create_index_x_on_y'], 'forumid_lastpost', TABLE_PREFIX . 'thread'),
			'thread',
			'forumid_lastpost',
			array('forumid', 'lastpost')
		);

		$upgrade->drop_index(
			sprintf($upgradecore_phrases['drop_index_x_on_y'], 'lastpost', TABLE_PREFIX . 'post'),
			'thread',
			'lastpost'
		);

		$upgrade->add_index(
			sprintf($upgradecore_phrases['create_index_x_on_y'], 'lastpost', TABLE_PREFIX . 'post'),
			'thread',
			'lastpost',
			array('lastpost')
		);
	}
	else
	{
		echo $upgrade_phrases['upgrade_400a1.php']['post_indexes_not_added'];
		if (!$db->query_first("SELECT * FROM " . TABLE_PREFIX . "adminmessage WHERE varname = 'after_upgrade_40_add_indexes'"))
		{
			$upgrade->run_query(
				sprintf($vbphrase['update_table'], TABLE_PREFIX . "adminmessage"),
				"INSERT INTO " . TABLE_PREFIX . "adminmessage
					(varname, dismissable, script, action, execurl, method, dateline, status)
				VALUES
					('after_upgrade_40_add_indexes', 1, '', '', '', '', " . TIMENOW . ", 'undone')
				"
			);
		}
	}

	$upgrade->execute();
}

// #############################################################################
// FINAL step (notice the SCRIPTCOMPLETE define)
if ($vbulletin->GPC['step'] == 13)
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
|| # CVS: $RCSfile$ - $Revision: 35750 $
|| ####################################################################
\*======================================================================*/
