<?php if (!defined('VB_ENTRY')) die('Access denied.');
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

/**
 * Critical Exception
 * Exception thrown when the system cannot continue.
 *
 * @todo Set the reroute path from vB_Router::get500Path();
 *
 * @package vBulletin
 * @author vBulletin Development Team
 * @version $Revision: 28674 $
 * @since $Date: 2008-12-03 12:56:57 +0000 (Wed, 03 Dec 2008) $
 * @copyright vBulletin Solutions Inc.
 */
class vB_Exception_Critical extends vB_Exception
{
}

/*======================================================================*\
|| ####################################################################
|| #
|| # SVN: $Revision: 28674 $
|| ####################################################################
\*======================================================================*/
?>
