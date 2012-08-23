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

// ####################### SET PHP ENVIRONMENT ###########################
error_reporting(E_ALL & ~E_NOTICE);

// #################### DEFINE IMPORTANT CONSTANTS #######################
define('THIS_SCRIPT', 'member');
define('CSRF_PROTECTION', true);
define('BYPASS_STYLE_OVERRIDE', 1);
define('FRIENDLY_URL_LINK', 'member');

// ################### PRE-CACHE TEMPLATES AND DATA ######################
// get special phrase groups
$phrasegroups = array(
	'wol',
	'user',
	'messaging',
	'cprofilefield',
	'reputationlevel',
	'infractionlevel',
	'posting',
);

// get special data templates from the datastore
$specialtemplates = array(
	'smiliecache',
	'bbcodecache'
);

// pre-cache templates used by all actions
$globaltemplates = array(
	'MEMBERINFO',
	'memberinfo_membergroupbit',
	'im_aim',
	'im_icq',
	'im_msn',
	'im_yahoo',
	'im_skype',
	'bbcode_code',
	'bbcode_html',
	'bbcode_php',
	'bbcode_quote',
	'bbcode_video',
	'editor_clientscript',
	'editor_toolbar_fontname',
	'editor_toolbar_fontsize',
	'editor_toolbar_colors',
	'editor_jsoptions_font',
	'editor_jsoptions_size',
	'postbit_reputation',
	'postbit_onlinestatus',
	'userfield_checkbox_option',
	'userfield_select_option',
	'memberinfo_block',
	'memberinfo_block_aboutme',
	'memberinfo_block_albums',
	'memberinfo_block_contactinfo',
	'memberinfo_block_friends',
	'memberinfo_block_friends_mini',
	'memberinfo_block_groups',
	'memberinfo_block_infractions',
	'memberinfo_block_ministats',
	'memberinfo_block_profilefield',
	'memberinfo_block_visitormessaging',
	'memberinfo_block_recentvisitors',
	'memberinfo_block_statistics',
	'memberinfo_block_profilepicture',
	'memberinfo_infractionbit',
	'memberinfo_profilefield',
	'memberinfo_profilefield_category',
	'memberinfo_visitormessage',
	'memberinfo_small',
	'memberinfo_socialgroupbit',
	'memberinfo_socialgroupbit_text',
	'memberinfo_tab',
	'memberinfo_tiny',
	'memberinfo_visitorbit',
	'memberinfo_albumbit',
	'memberinfo_imbit',
	'memberinfo_publicgroupbit',
	'memberinfo_visitormessage_deleted',
	'memberinfo_visitormessage_ignored',
	'memberinfo_visitormessage_global_ignored',
	'memberinfo_usercss',
	'showthread_quickreply',
);


// pre-cache templates used by specific actions
$actiontemplates = array();

if ($_REQUEST['do'] == 'vcard') // don't alter this $_REQUEST
{
	define('NOHEADER', 1);
}

// ######################### REQUIRE BACK-END ############################
require_once('./global.php');
require_once(DIR . '/includes/class_postbit.php');
require_once(DIR . '/includes/functions_user.php');

// #######################################################################
// ######################## START MAIN SCRIPT ############################
// #######################################################################

if (!($permissions['forumpermissions'] & $vbulletin->bf_ugp_forumpermissions['canview']) OR !($permissions['genericpermissions'] & $vbulletin->bf_ugp_genericpermissions['canviewmembers']))
{
	print_no_permission();
}

$vbulletin->input->clean_array_gpc('r', array(
	'find'        => TYPE_STR,
	'moderatorid' => TYPE_UINT,
	'userid'      => TYPE_UINT,
	'username'    => TYPE_NOHTML,
));

($hook = vBulletinHook::fetch_hook('member_start')) ? eval($hook) : false;

if ($vbulletin->GPC['find'] == 'firstposter' AND $threadinfo['threadid'])
{
	if ((!$threadinfo['visible'] AND !can_moderate($threadinfo['forumid'], 'canmoderateposts')) OR ($threadinfo['isdeleted'] AND !can_moderate($threadinfo['forumid'])))
	{
		eval(standard_error(fetch_error('invalidid', $vbphrase['thread'], $vbulletin->options['contactuslink'])));
	}
	if (in_coventry($threadinfo['postuserid']) AND !can_moderate($threadinfo['forumid']))
	{
		eval(standard_error(fetch_error('invalidid', $vbphrase['thread'], $vbulletin->options['contactuslink'])));
	}

	$forumperms = fetch_permissions($threadinfo['forumid']);
	if (!($forumperms & $vbulletin->bf_ugp_forumpermissions['canview']))
	{
		print_no_permission();
	}
	if (!($forumperms & $vbulletin->bf_ugp_forumpermissions['canviewothers']) AND ($threadinfo['postuserid'] != $vbulletin->userinfo['userid'] OR $vbulletin->userinfo['userid'] == 0))
	{
		print_no_permission();
	}

	exec_header_redirect(fetch_seo_url('member|js', $threadinfo, null, 'postuserid', 'postusername'));
}
else if ($vbulletin->GPC['find'] == 'lastposter' AND $threadinfo['threadid'])
{
	if ((!$threadinfo['visible'] AND !can_moderate($threadinfo['forumid'], 'canmoderateposts')) OR ($threadinfo['isdeleted'] AND !can_moderate($threadinfo['forumid'])))
	{
		eval(standard_error(fetch_error('invalidid', $vbphrase['thread'], $vbulletin->options['contactuslink'])));
	}
	if (in_coventry($threadinfo['postuserid']) AND !can_moderate($threadinfo['forumid']))
	{
		eval(standard_error(fetch_error('invalidid', $vbphrase['thread'], $vbulletin->options['contactuslink'])));
	}

	$forumperms = fetch_permissions($threadinfo['forumid']);
	if (!($forumperms & $vbulletin->bf_ugp_forumpermissions['canview']))
	{
		print_no_permission();
	}
	if (!($forumperms & $vbulletin->bf_ugp_forumpermissions['canviewothers']) AND ($threadinfo['postuserid'] != $vbulletin->userinfo['userid'] OR $vbulletin->userinfo['userid'] == 0))
	{
		print_no_permission();
	}

	require_once(DIR . '/includes/functions_bigthree.php');
	$coventry = fetch_coventry('string');

	$getuserid = $db->query_first_slave("
		SELECT post.userid, post.username
		FROM " . TABLE_PREFIX . "post AS post
		WHERE post.threadid = $threadinfo[threadid]
			AND post.visible = 1
			". ($coventry ? "AND post.userid NOT IN ($coventry)" : '') . "
		ORDER BY dateline DESC
		LIMIT 1
	");

	exec_header_redirect(fetch_seo_url('member|js', $getuserid));
}
else if ($vbulletin->GPC['find'] == 'lastposter' AND $foruminfo['forumid'])
{
	$_permsgetter_ = 'lastposter fperms';
	$forumperms = fetch_permissions($foruminfo['forumid']);
	if (!($forumperms & $vbulletin->bf_ugp_forumpermissions['canview']))
	{
		print_no_permission();
	}

	if ($vbulletin->userinfo['userid'] AND in_coventry($vbulletin->userinfo['userid'], true))
	{
		$tachyjoin = "LEFT JOIN " . TABLE_PREFIX . "tachythreadpost AS tachythreadpost ON " .
			"(tachythreadpost.threadid = thread.threadid AND tachythreadpost.userid = " . $vbulletin->userinfo['userid'] . ')';
	}
	else
	{
		$tachyjoin = '';
	}

	// check if there is a forum password and if so, ensure the user has it set
	verify_forum_password($foruminfo['forumid'], $foruminfo['password']);

	//require_once(DIR . '/includes/functions_misc.php');
	//$forumslist = $forumid . ',' . fetch_child_forums($foruminfo['forumid']);
	$forumslist = $forumid;

	require_once(DIR . '/includes/functions_bigthree.php');
	// this isn't including moderator checks, because the last post checks don't either
	if ($coventry = fetch_coventry('string')) // takes self into account
	{
		$globalignore_post = "AND post.userid NOT IN ($coventry)";
		$globalignore_thread = "AND thread.postuserid NOT IN ($coventry)";
	}
	else
	{
		$globalignore_post = '';
		$globalignore_thread = '';
	}

	cache_ordered_forums(1);

	$datecutoff = $vbulletin->forumcache["$foruminfo[forumid]"]['lastpost'] - 30;

	$thread = $db->query_first_slave("
		SELECT thread.threadid
			" . ($tachyjoin ? ', IF(tachythreadpost.lastpost > thread.lastpost, tachythreadpost.lastpost, thread.lastpost) AS lastpost' : '') . "
		FROM " . TABLE_PREFIX . "thread AS thread
		$tachyjoin
		WHERE thread.forumid = $forumid
			AND thread.visible = 1
			AND thread.sticky IN (0,1)
			AND thread.open <> 10
			" . (!$tachyjoin ? "AND lastpost > $datecutoff" : '') . "
			$globalignore_thread
		ORDER BY lastpost DESC
		LIMIT 1
	");

	if (!$thread)
	{
		eval(standard_error(fetch_error('invalidid', $vbphrase['user'], $vbulletin->options['contactuslink'])));
	}

	$getuserid = $db->query_first_slave("
		SELECT post.userid, post.username
		FROM " . TABLE_PREFIX . "post AS post
		WHERE threadid = $thread[threadid]
			AND visible = 1
			$globalignore_post
		ORDER BY dateline DESC
		LIMIT 1
	");

	if (!($forumperms & $vbulletin->bf_ugp_forumpermissions['canviewothers']) AND ($getuserid['userid'] != $vbulletin->userinfo['userid'] OR $vbulletin->userinfo['userid'] == 0))
	{
		print_no_permission();
	}

	exec_header_redirect(fetch_seo_url('member|js', $getuserid));
}
/*
else if ($vbulletin->GPC['find'] == 'moderator' AND $vbulletin->GPC['moderatorid'])
{	// For this fetch_seo_url to work, verify_id needs to return the moderators username as 'username'
	$moderatorinfo = verify_id('moderator', $vbulletin->GPC['moderatorid'], 1, 1);
	exec_header_redirect(fetch_seo_url('member|js', $moderatorinfo));
}
*/
else if ($vbulletin->GPC['username'] != '' AND !$vbulletin->GPC['userid'])
{
	$user = $db->query_first_slave("SELECT userid FROM " . TABLE_PREFIX . "user WHERE username = '" . $db->escape_string($vbulletin->GPC['username']) . "'");
	$vbulletin->GPC['userid'] = $user['userid'];
}

if (!$vbulletin->GPC['userid'])
{
	eval(standard_error(fetch_error('unregistereduser')));
}

$fetch_userinfo_options = (
	FETCH_USERINFO_AVATAR | FETCH_USERINFO_LOCATION |
	FETCH_USERINFO_PROFILEPIC | FETCH_USERINFO_SIGPIC |
	FETCH_USERINFO_USERCSS | FETCH_USERINFO_ISFRIEND
);

($hook = vBulletinHook::fetch_hook('member_start_fetch_user')) ? eval($hook) : false;

$userinfo = verify_id('user', $vbulletin->GPC['userid'], 1, 1, $fetch_userinfo_options);

if ($userinfo['usergroupid'] == 4 AND !($permissions['adminpermissions'] & $vbulletin->bf_ugp_adminpermissions['cancontrolpanel']))
{
	print_no_permission();
}

// verify that we are at the canonical SEO url
// and redirect to this if not
verify_seo_url('member|js', $userinfo);


$show['vcard'] = ($vbulletin->userinfo['userid'] AND $userinfo['showvcard']);

if ($_REQUEST['do'] == 'vcard' AND $show['vcard'])
{
	// source: http://www.ietf.org/rfc/rfc2426.txt
	$text = "BEGIN:VCARD\r\n";
	$text .= "VERSION:2.1\r\n";
	$text .= "N:;$userinfo[username]\r\n";
	$text .= "FN:$userinfo[username]\r\n";
	$text .= "EMAIL;PREF;INTERNET:$userinfo[email]\r\n";
	if (!empty($userinfo['birthday'][7]) AND $userinfo['showbirthday'] == 2)
	{
		$birthday = explode('-', $userinfo['birthday']);
		$text .= "BDAY:$birthday[2]-$birthday[0]-$birthday[1]\r\n";
	}
	if (!empty($userinfo['homepage']))
	{
		$text .= "URL:$userinfo[homepage]\r\n";
	}
	$text .= 'REV:' . date('Y-m-d') . 'T' . date('H:i:s') . "Z\r\n";
	$text .= "END:VCARD\r\n";

	$filename = $userinfo['userid'] . '.vcf';

	header("Content-Disposition: attachment; filename=$filename");
	header('Content-Length: ' . strlen($text));
	header('Connection: close');
	header("Content-Type: text/x-vCard; name=$filename");
	echo $text;
	exit;
}

// display user info
$userperms = cache_permissions($userinfo, false);

$show['edit_profile'] = (($vbulletin->userinfo['permissions']['adminpermissions'] & $vbulletin->bf_ugp_adminpermissions['cancontrolpanel']) OR can_moderate(0, 'canviewprofile'));

// Check if blog is installed, and show link if so
$show['viewblog'] = $vbulletin->products['vbblog'];

// Check if CMS is installed, and show link if so
$show['viewarticles'] = $vbulletin->products['vbcms'];

($hook = vBulletinHook::fetch_hook('member_execute_start')) ? eval($hook) : false;

require_once(DIR . '/includes/class_userprofile.php');
require_once(DIR . '/includes/class_profileblock.php');

$vbulletin->input->clean_array_gpc('r', array(
	'pagenumber'  => TYPE_UINT,
	'tab'         => TYPE_NOHTML,
	'perpage'     => TYPE_UINT,
	'vmid'        => TYPE_UINT,
	'showignored' => TYPE_BOOL,
	'simple'      => TYPE_BOOL,
));

if ($vbulletin->GPC['vmid'] AND !$vbulletin->GPC['tab'])
{
	$vbulletin->GPC['tab'] = 'visitor_messaging';
}

$profileobj = new vB_UserProfile($vbulletin, $userinfo);
$profileobj->prepare_blogurl();
$blockfactory = new vB_ProfileBlockFactory($vbulletin, $profileobj);

$prepared =& $profileobj->prepared;
$blocks = array();
$tabs = array();
$tablinks = array();

$blocklist = array(
	'stats_mini' => array(
		'class' => 'MiniStats',
		'title' => $vbphrase['mini_statistics'],
	),
	'friends_mini' => array(
		'class' => 'Friends',
		'title' => $vbphrase['friends'],
	),
	'albums' => array(
		'class' => 'Albums',
		'title' => $vbphrase['albums'],
	),
	'visitors' => array(
		'class' => 'RecentVisitors',
		'title' => $vbphrase['recent_visitors'],
		'options' => array(
			'profilemaxvisitors' => $vbulletin->options['profilemaxvisitors']
		)
	),
	'groups' => array(
		'class' => 'Groups',
		'title' => $vbphrase['group_memberships'],
	),
	// VMs must come before Stats to save a query
	'visitor_messaging' => array(
		'class'   => 'VisitorMessaging',
		'title'   => $vbphrase['visitor_messages_tab'],
		'options' => array(
			'pagenumber'  => $vbulletin->GPC['pagenumber'],
			'tab'         => $vbulletin->GPC['tab'],
			'vmid'        => $vbulletin->GPC['vmid'],
			'showignored' => $vbulletin->GPC['showignored'],
		)
	),
	// stats must come before about me to display stats in the about me tab
	'stats' => array(
		'class' => 'Statistics',
		'title' => $vbphrase['statistics'],
	),
	'aboutme' => array(
		'class' => 'AboutMe',
		'title' => $vbphrase['about_me'],
		'options' => array(
			'simple' => $vbulletin->GPC['simple'],
		),
	),
	'contactinfo' => array(
		'class' => 'ContactInfo',
		'title' => $vbphrase['contact_info'],
	),
	'friends' => array(
		'class'   => 'Friends',
		'title'   => $vbphrase['friends'],
		'type'    => 'tab',
		'options' => array(
			'fetchamount'       => $vbulletin->options['friends_per_page'],
			'membertemplate'    => 'memberinfo_small',
			'template_override'	=> 'memberinfo_block_friends',
			'pagenumber'        => $vbulletin->GPC['pagenumber'],
			'tab'               => $vbulletin->GPC['tab'],
			'fetchorder'        => 'asc',
		),
	),
	'infractions' => array(
		'class'   => 'Infractions',
		'title'   => $vbphrase['infractions'],
		'options' => array(
			'pagenumber' => $vbulletin->GPC['pagenumber'],
			'tab'        => $vbulletin->GPC['tab'],
		),
	),
	'profile_picture' => array(
		'class'  => 'ProfilePicture'
	)
);

if (!empty($vbulletin->GPC['tab']) AND !empty($vbulletin->GPC['perpage']) AND isset($blocklist["{$vbulletin->GPC['tab']}"]))
{
	$blocklist["{$vbulletin->GPC['tab']}"]['options']['perpage'] = $vbulletin->GPC['perpage'];
}

$vbulletin->GPC['simple'] = ($prepared['myprofile'] ? $vbulletin->GPC['simple'] : false);

$profileblock =& $blockfactory->fetch('ProfileFields');
$profileblock->build_field_data($vbulletin->GPC['simple']);

foreach ($profileblock->locations AS $profilecategoryid => $location)
{
	if ($location)
	{
		if (strpos($location, 'profile_tabs') !== false)
		{
			$wrap = false;
		}
		else
		{
			$wrap = true;
		}
		$blocklist["profile_cat$profilecategoryid"] = array(
			'class'         => 'ProfileFields',
			'title'         => $vbphrase["category{$profilecategoryid}_title"],
			'options'       => array(
				'category' => $profilecategoryid,
				'simple'   => $vbulletin->GPC['simple'],
			),
			'hook_location' => $location,
			'wrap' => $wrap,
		);
	}
}

($hook = vBulletinHook::fetch_hook('member_build_blocks_start')) ? eval($hook) : false;

if (!empty($vbulletin->GPC['tab']) AND isset($blocklist["{$vbulletin->GPC['tab']}"]))
{
	$selected_tab = $vbulletin->GPC['tab'];
}
else
{
	$selected_tab = '';
}

foreach ($blocklist AS $blockid => $blockinfo)
{
	$blockobj = $blockfactory->fetch($blockinfo['class']);
	// added a new param for $blocklist var 'wrap'. if it's set to true,
	// the block html will be wrapped by memberinfo_block template.
	// but if this may not be what you want, then set it to false.
	// if you don't set it, it will be determined by 'nowrap' var of the instance of $blocklist['class']
	if (isset($blockinfo['wrap']))
	{
		if ($blockinfo['wrap'] == true)
		{
			$blockobj->nowrap = false;
		}
		else
		{
			$blockobj->nowrap = true;
		}
	}
	$block_html = $blockobj->fetch($blockinfo['title'], $blockid, $blockinfo['options'], $vbulletin->userinfo);

	if (!empty($blockinfo['hook_location']))
	{
		if (!empty($block_html) && strpos($blockinfo['hook_location'], 'profile_tabs') !== false)
		{
			$templater = vB_Template::create('memberinfo_tab');
				$templater->register('selected_tab', $selected_tab);
				$templater->register('blockid', $blockid);
				$templater->register('blockinfo', $blockinfo);
			$tab_html = $templater->render();
			$template_hook["$blockinfo[hook_location]"] .= $tab_html;
			$template_hook["profile_tabs"] .= $block_html;
		}
		else
		{
			$template_hook["$blockinfo[hook_location]"] .= $block_html;
		}
	}
	else
	{
		$blocks["$blockid"] = $block_html;
	}
}

$usercss = construct_usercss($userinfo, $show['usercss_switch']);
construct_usercss_switch($show['usercss_switch'], $usercss_switch_phrase);

// check to see if we can see a 'Members List' link in the breadcrumb
if ($vbulletin->options['enablememberlist'] AND $permissions['genericpermissions'] & $vbulletin->bf_ugp_genericpermissions['canviewmembers'])
{
	$navbits = construct_navbits(array(
		'memberlist.php' . $vbulletin->session->vars['sessionurl_q'] => $vbphrase['members_list'],
		'' => $userinfo['username']
	));
}
else // no, we can't, so miss off that part of the breadcrumb
{
	$navbits = construct_navbits(array(
		'' => $userinfo['username']
	));
}

if ($vbulletin->products['vbcms'])
{
	require_once(DIR . '/includes/class_bootstrap_framework.php');
	vB_Bootstrap_Framework::init();
	$segments = array('type' =>'author', 'value' => $userinfo['userid'] . '-' . $userinfo['username']);
	$author_list_url = vBCms_Route_List::getURL($segments);
}
else
{
	$author_list_url = '';
}

$navbar = render_navbar_template($navbits);

$templatename = 'MEMBERINFO';

($hook = vBulletinHook::fetch_hook('member_complete')) ? eval($hook) : false;

$page_templater = vB_Template::create($templatename);
	$page_templater->register_page_templates();
	$page_templater->register('blocks', $blocks);
	$page_templater->register('navbar', $navbar);
	$page_templater->register('prepared', $prepared);
	$page_templater->register('selected_tab', $selected_tab);
	$page_templater->register('template_hook', $template_hook);
	$page_templater->register('author_list_url', $author_list_url);
	$page_templater->register('usercss', $usercss);
	$page_templater->register('usercss_switch_phrase', $usercss_switch_phrase);
	$page_templater->register('userinfo', $userinfo);

print_output($page_templater->render());

/*======================================================================*\
|| ####################################################################
|| #
|| # CVS: $RCSfile$ - $Revision: 37680 $
|| ####################################################################
\*======================================================================*/