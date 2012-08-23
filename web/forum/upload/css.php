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
define('THIS_SCRIPT', 'css');
define('CSRF_PROTECTION', true);
define('NOPMPOPUP', 1);
define('NOCOOKIES', 1);
define('NONOTICES', 1);
define('NOHEADER', 1);
define('NOSHUTDOWNFUNC', 1);
define('LOCATION_BYPASS', 1);

define('NOCHECKSTATE', 1);
define('SKIP_SESSIONCREATE', 1);

// Immediately send back the 304 Not Modified header if this css is cached, don't load global.php
if ((!empty($_SERVER['HTTP_IF_MODIFIED_SINCE']) OR !empty($_SERVER['HTTP_IF_NONE_MATCH'])))
{
	$sapi_name = php_sapi_name();
	if ($sapi_name == 'cgi' OR $sapi_name == 'cgi-fcgi')
	{
		header('Status: 304 Not Modified');
	}
	else
	{
		header('HTTP/1.1 304 Not Modified');
	}
	// remove the content-type and X-Powered headers to emulate a 304 Not Modified response as close as possible
	header('Content-Type:');
	header('X-Powered-By:');
	exit;
}

// ################### PRE-CACHE TEMPLATES AND DATA ######################
// get special phrase groups
$phrasegroups = array();

// get special data templates from the datastore
$specialtemplates = array();

// pre-cache templates used by all actions  - build
preg_match_all('#([a-z0-9_\-]+\.css)#i', $_REQUEST['sheet'], $matches);
if ($matches[1])
{
	foreach ($matches[1] AS $cssfile)
	{
		$globaltemplates[] = $cssfile;
	}
}
else
{
	$globaltemplates = array();
}

// pre-cache templates used by specific actions
$actiontemplates = array();

// ######################### REQUIRE BACK-END ############################
require_once('./global.php');

// #######################################################################
// ######################## START MAIN SCRIPT ############################
// #######################################################################

header('Content-Type: text/css');

($hook = vBulletinHook::fetch_hook('css_start')) ? eval($hook) : false;

if (empty($matches[1]))
{
	echo "/* Unable to find css sheet */";
}
else
{
	//		Note that the css publishing mechanism relies on the fact that
	//		there isn't any user specific data passed to the css templates.

	$templates = '';
	$count = 0;
	foreach ($matches[1] AS $template)
	{
		if ($count > 0)
		{
			$templates .= "\r\n\r\n";
		}
		$templater = vB_Template::create($template);
		$template = $templater->render(true);
		if ($count > 0)
		{
			$template = preg_replace("#@charset .*#i", "", $template);
		}
		$templates .= $template;
		$count++;
	}

	// TODO - Remove this
	//temporary -- allows me to fix the stylevars without destroying everybody else's work.
	// commented-out by chris: 01/14/2010
	//$templates = str_replace('pxpx', 'px', $templates);

	header('Cache-control: max-age=31536000, private');
	header('Expires: ' . gmdate("D, d M Y H:i:s", TIMENOW + 31536000) . ' GMT');
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $style['dateline']) . ' GMT');

	echo $templates;
}

/*======================================================================*\
|| ####################################################################
|| #
|| # CVS: $RCSfile$ - $Revision: 30573 $
|| ####################################################################
\*======================================================================*/
