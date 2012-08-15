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
 * @package vBulletin
 * @subpackage Search
 * @author Ed Brown, vBulletin Development Team
 * @version $Id: visitormessage.php 30597 2009-04-30 22:25:07Z ksours $
 * @since $Date: 2009-04-30 15:25:07 -0700 (Thu, 30 Apr 2009) $
 * @copyright vBulletin Solutions Inc.
 */

require_once (DIR . '/vb/search/result.php');
require_once (DIR . '/vb/search/indexcontroller/null.php');
/**
 * Result Implementation for Visitor Messages
 *
 * @see vB_Search_Result
 * @package vBulletin
 * @subpackage Search
 */
class vBForum_Search_Result_VisitorMessage extends vB_Search_Result
{
// ###################### Start create ######################
	/**
	 * vBForum_Search_Result_VisitorMessage::create()
	 *
	 * @param integer $id
	 * @return result object
	 */
	public function create($id)
	{
		$items = self::create_array(array($id));
		if (count($items))
		{
			return array_shift($items);
		}
		else
		{
			return new vB_Search_Result_Null();
		}
	}

	public function create_array($ids)
	{
		global $vbulletin;

		$set = $vbulletin->db->query_read_slave ("
			SELECT visitormessage.*, user.username
			FROM ". TABLE_PREFIX . "visitormessage AS visitormessage JOIN
				". TABLE_PREFIX . "user AS user ON visitormessage.userid = user.userid
			WHERE vmid IN (" . implode(',', array_map('intval', $ids)) . ")
		");


		$items = array();
		while ($row = $vbulletin->db->fetch_array($set))
		{
			$item = new vBForum_Search_Result_VisitorMessage();
			$item->message = $row;
			$items[$row['vmid']] = $item;
		}

		return $items;
	}


// ###################### Start __construct ######################
	/**
	 * vBForum_Search_Result_VisitorMessage::__construct()
	 *
	 */
	protected function __construct() {}

	/**
	 * vBForum_Search_Result_VisitorMessage::get_contenttype()
	 *
	 * @return integer contenttypeid
	 */
	public function get_contenttype()
	{
		return vB_Search_Core::get_instance()->get_contenttypeid('vBForum', 'VisitorMessage');
	}

	// ###################### Start can_search ######################
	/**
	 * vBForum_Search_Result_VisitorMessage::can_search()
	 *
	 * @param mixed $user: the id of the user requesting access
	 * @return bool true
	 */
	public function can_search($user)
	//We have a function fetch_visitor_message_perm in functions_visitormessage
	// that tells whether we can see this message. It needs
	// $perm, &$userinfo, $message. $perm is 'canviewvisitormessages',
	// $userinfo is $vbulletin->userinfo, and $message is an array which,
	// as far as I can see, must have state and postuserid. The comment
	// says it's the result of a call to fetch_messageinfo(), but we don't have
	// any such function.
	//So.. if we just pass $message twice, we have all the necessary parameters.

	{
		require_once( DIR . '/includes/functions_visitormessage.php');
		return fetch_visitor_message_perm('canviewvisitormessages',
			 $this->message,  $this->message);
	}
	// ###################### Start getUserName ######################
	/**
	 * vBForum_Search_IndexController_VisitorMessage::getUserName()
	 *
	 * @param integer $userid
	 * @return string username : name of the user with that id.
	 */
	 /*
	private function getUserName($userid)
	{
		global $vbulletin;

	*/

	// ###################### Start render ######################
	/**
	 * vBForum_Search_Result_VisitorMessage::render()
	 *
	 * @param string $current_user
	 * @param object $criteria
	 * @return
	 */
	public function render($current_user, $criteria, $template_name = '')
	{
		global $vbulletin;

		if (!strlen($template_name)) {
			$template_name = 'search_results_visitormessage';
		}

		//TODO- create a template and pass it the necessary information
		//TODO- check vbphrase and see what we have to add.
		//TODO- figure if we are passing the right parameters. I suspect not.
		global $show;
		$template = vB_Template::create($template_name);
		$template->register('messagetext',
			vB_Search_Searchtools::getSummary($this->message['pagetext'], 100));
		//The template is out with the variables fromid and toid. It should just be
		// from and to, but we need to get out a simple patch.

		$from = array('userid' => $this->message['postuserid'], 'username' => $this->message['postusername']);
		$to = array('userid' => $this->message['userid'], 'username' => $this->message['username']);
		$template->register('vmid', $this->message['vmid']);
		$template->register('to', $this->message['username']);
		$template->register('from', $this->message['postusername']);
		$template->register('fromid', $from);
		$template->register('toid', $to);
		$template->register('sent', date($vbulletin->options['dateformat']. ' '
			. $vbulletin->options['default_timeformat'], $this->message['dateline']));
		$template->register('dateline', $this->message['dateline']);
		$template->register('dateformat', $vbulletin->options['dateformat']);
		$template->register('timeformat', $vbulletin->options['default_timeformat']);
		return $template->render();
	}

	/*** Returns the primary id. Allows us to cache a result item.
	*
	* @result	integer
	***/
	public function get_id()
	{
		if (isset($this->message) AND isset($this->message['vmid']) )
		{
			return $this->message['vmid'];
		}
		return false;
	}
	
	private $message;
}

/*======================================================================*\
|| ####################################################################
|| #
|| # SVN: $Revision: 30597 $
|| ####################################################################
\*======================================================================*/