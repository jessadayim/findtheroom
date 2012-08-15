<?php if (!defined('VB_ENTRY')) die('Access denied.');
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

/**
 * AccessDenied Exception
 * Thrown whenever an unrecoverable access denied occurs.
 * This should cause a reroute to the error page with a generic permissions error.
 *
 * @package vBulletin
 * @author vBulletin Development Team
 * @version $Revision: 28674 $
 * @since $Date: 2008-12-03 12:56:57 +0000 (Wed, 03 Dec 2008) $
 * @copyright vBulletin Solutions Inc.
 */
class vB_Exception_AccessDenied extends vB_Exception_Reroute
{
	/*Initialisation================================================================*/

	/**
	 * Creates a 403 exception with the given message
	 *
	 * @param string $message					- A user friendly error
	 * @param int $code							- The PHP code of the error
	 * @param string $file						- The file the exception was thrown from
	 * @param int $line							- The line the exception was thrown from
	 */
	public function __construct($message = false, $code = false, $file = false, $line = false)
	{
		$message = $message ? $message : new vB_Phrase('error', 'access_denied_message');

		// Standard exception initialisation
		parent::__construct(vB_Router::get403Path(), $message, $code, $file, $line);
	}
}

/*======================================================================*\
|| ####################################################################
|| #
|| # SVN: $Revision: 28674 $
|| ####################################################################
\*======================================================================*/
?>