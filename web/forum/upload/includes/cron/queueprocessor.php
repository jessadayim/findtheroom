<?php
/*======================================================================*\
|| #################################################################### ||
|| # vBulletin 4.0.5
|| # ---------------------------------------------------------------- # ||
|| # Copyright �2000-2010 vBulletin Solutions Inc. All Rights Reserved. ||
|| # This file may not be redistributed in whole or significant part. # ||
|| # ---------------- VBULLETIN IS NOT FREE SOFTWARE ---------------- # ||
|| # http://www.vbulletin.com | http://www.vbulletin.com/license.html # ||
|| #################################################################### ||
\*======================================================================*/

// ######################## SET PHP ENVIRONMENT ###########################
error_reporting(E_ALL & ~E_NOTICE);
if (!is_object($vbulletin->db))
{
	exit;
}

// ########################################################################
// ######################### START MAIN SCRIPT ############################
// ########################################################################

/*********************
* We are called by a cron job. Our task is to read from the database all the records
* that should be processed and take care of them. For each we:
*    figure out what object we need.
*    extract the parameters
*    statically call the method
*    remove the record from the database
*
*****/

require_once(DIR . '/vb/search/indexcontroller/queueprocessor.php');
vB_Search_Indexcontroller_QueueProcessor::index();

/*======================================================================*\
|| ####################################################################
|| #
|| # CVS: $RCSfile$ - $Revision: 28470 $
|| ####################################################################
\*======================================================================*/
