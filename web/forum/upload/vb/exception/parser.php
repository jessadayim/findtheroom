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
 * Parser Exception
 * Exception thrown when the parser encounters unexpected input
 *
 * @package vBulletin
 * @author Michael Henretty, vBulletin Development Team
 * @version $Revision: 34912 $
 * @since $Date: 2010-01-11 17:05:25 -0800 (Mon, 11 Jan 2010) $
 * @copyright vBulletin Solutions Inc.
 */
class vB_Exception_Parser extends vB_Exception
{
	public function __construct($message, $line = false, $code = false, $file = false, $line = false)
	{
		$message = $message ? $message : 'Parser Error';
		
		if (!empty($line))
		{
			$message .= "::$line";
		}
		
		parent::__construct($message, $code, $file, $line);
	}
}

/*======================================================================*\
|| ####################################################################
|| #
|| # SVN: $Revision: 34912 $
|| ####################################################################
\*======================================================================*/
?>
