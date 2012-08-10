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

require_once(DIR . '/includes/functions_file.php');
require_once(DIR . '/includes/class_upload.php');
require_once(DIR . '/includes/class_image.php');
require_once(DIR . '/packages/vbattach/attach.php');

/*
	Hack the upload attachment class to avoid a couple of validation checks that
	are unneeded and otherwise difficult to work around
*/
class vB_Upload_Attachment_Backend extends vB_Upload_Attachment
{
	function accept_upload(&$upload)
	{
		$this->upload['filename'] = trim($upload['name']);
		$this->upload['filesize'] = intval($upload['size']);
		$this->upload['location'] = trim($upload['tmp_name']);
		$this->upload['extension'] = strtolower(file_extension($this->upload['filename']));
		$this->upload['thumbnail'] = '';
		$this->upload['filestuff'] = '';
		return true;
	}

	//don't check user permissions for default data images
	function fetch_max_uploadsize($extension)
	{
		return 100000;
	}
}


function can_install_default_data()
{
	//check that we can write to the configured temp directory.  If we can't then
	//we'll just have to skip the default data install.
	global $vbulletin;
	if ($vbulletin->options['safeupload'])
	{
		$temp_name = $vbulletin->options['tmppath'] . '/vbupload-install-' . substr(TIMENOW, -4);
		$result = @touch($temp_name);
		if ($result)
		{
			@unlink($temp_name);
			return true;
		}
		return false;
	}
	else
	{
		$temp_name = @tempnam(ini_get('upload_tmp_dir'), 'vbupload');
		if ($temp_name)
		{
			@unlink($temp_name);
			return true;
		}
		return false;
	}
}

function add_default_data()
{
	global $vbulletin;
	require_once(DIR . "/install/cmsdefaultdata/default_data_queries.php");
	foreach($cms_data_queries AS $query)
	{
		$vbulletin->db->query_write($query);
	}

	//we need to truncate the grids table in order to make all of the ids line up
	require_once(DIR . "/includes/adminfunctions_cms.php");
	$vbulletin->db->query_write("TRUNCATE TABLE " . TABLE_PREFIX . "cms_grid");
	xml_import_grid(file_get_contents(DIR . "/install/vbulletin-grid.xml"), true);
}

function add_default_attachments($userid)
{
	@set_time_limit(0);
	global $vbulletin, $startimage, $endimage;
	require_once(DIR . '/includes/class_bootstrap_framework.php');
	vB_Bootstrap_Framework::init();

	$imagedir = DIR . '/install/cmsdefaultdata/attachments/';

	//fake the user login if we don't have a user
	if (!$vbulletin->userinfo)
	{
		$vbulletin->userinfo = fetch_userinfo($userid);
		cache_permissions($vbulletin->userinfo, true);
	}

	fix_images($imagedir);
	$vbulletin->db->query_write(
		"UPDATE " . TABLE_PREFIX . "cms_node
		SET userid = " . $vbulletin->userinfo['userid'] . " WHERE userid = 1"
	);

	//if we can, automatically blow out the cache.
	require_once DIR . '/includes/class_bootstrap_framework.php';
	vB_Bootstrap_Framework::init();
	print_cp_header($vbphrase['category_manager']);
	if (method_exists(vB_Cache::instance(), 'clean'))
	{
		vB_Cache::instance()->clean(false);
	}
}


function fix_images($filedirectory)
{
	global $vbulletin;
	$contenttypeid = vB_Types::instance()->getContentTypeId("vBCms_Article");
	$set = $vbulletin->db->query_read("
		SELECT cms_node.nodeid, cms_article.*
		FROM " . TABLE_PREFIX . "cms_article AS cms_article JOIN " .
			TABLE_PREFIX . "cms_node AS cms_node ON
				(cms_article.contentid = cms_node.contentid AND cms_node.contenttypeid = $contenttypeid)
	");

	while ($row = $vbulletin->db->fetch_array($set))
	{
		$attachment_map = array();
		$pagetext = $row['pagetext'];

		//get attachments and replace with new ids
		$matches = array();
		if (preg_match_all("#\\[ATTACH=CONFIG\\](\\d+)\\[/ATTACH\\]#i", $row['pagetext'], $matches))
		{
			foreach($matches[1] AS $attachmentid)
			{
				if (!array_key_exists($attachmentid, $attachment_map))
				{
					$file_name = get_image_filename($filedirectory, $attachmentid);
					$attachment_map[$attachmentid] = attach_image($file_name, $filedirectory, $row['nodeid']);
				}
			}

			if (count($attachment_map))
			{
				$orig = array();
				$replacement = array();
				foreach($attachment_map AS $oldid => $newid)
				{
					$orig[] = "[ATTACH=CONFIG]" . $oldid . "[/ATTACH]";
					$replacement[] = "[ATTACH=CONFIG]" . $newid . "[/ATTACH]";
				}

				if (count($orig))
				{
					$pagetext = str_replace($orig, $replacement, $pagetext);
				}

				$vbulletin->db->query_write("
					UPDATE " . TABLE_PREFIX . "cms_article
					SET pagetext = '" . $vbulletin->db->escape_string($pagetext) . "'
					WHERE contentid = $row[contentid]
				");

			}
		}

		//find and replace attachments added as IMG tags.  Otherwise they'll look for the live site, which is bad.

		$matches = array();
		if (preg_match_all("#\\[IMG\\][^]]*attachmentid=(\\d+)[^]]*\\[/IMG\\]#i", $row['pagetext'], $matches))
		{
			$orig = array();
			$replacement = array();
			foreach($matches[1] AS $key => $attachmentid)
			{
				if (!array_key_exists($attachmentid, $attachment_map))
				{
					$file_name = get_image_filename($filedirectory, $attachmentid);
					$attachment_map[$attachmentid] = attach_image($file_name, $filedirectory, $row['nodeid']);
				}

				if ($attachment_map[$attachmentid])
				{
					$orig[] = $matches[0][$key];
					$replacement[] = "[ATTACH]" . $attachment_map[$attachmentid] . "[/ATTACH]";
				}
			}
			if (count($orig))
			{
				$pagetext = str_replace($orig, $replacement, $pagetext);
				$vbulletin->db->query_write("
					UPDATE " . TABLE_PREFIX . "cms_article
					SET pagetext = '" . $vbulletin->db->escape_string($pagetext) . "'
					WHERE contentid = $row[contentid]
				");
			}
		}

		//handle preview images
		$matches = array();
		if (preg_match("#attachmentid=(\\d+)&#", $row['previewimage'], $matches))
		{
			$attachmentid = $matches[1];
			if ($attachmentid)
			{
				if (!array_key_exists($attachmentid, $attachment_map))
				{
					$file_name = get_image_filename($filedirectory, $attachmentid);
					$attachment_map[$attachmentid] = attach_image($file_name, $filedirectory, $row['nodeid']);
				}

				$newid = $attachment_map[$attachmentid];
				if ($newid)
				{
					$record = $vbulletin->db->query_first($q = "
						SELECT thumbnail_width, thumbnail_height
						FROM " .
							TABLE_PREFIX . "attachment AS attach INNER JOIN "  .
							TABLE_PREFIX . "filedata AS data ON data.filedataid = attach.filedataid WHERE attachmentid = $newid"
					);

					$vbulletin->db->query_write($q = "
						UPDATE " . TABLE_PREFIX . "cms_article
						SET previewimage = 'attachment.php?attachmentid=$newid&amp;cid=$contenttypeid',
							imagewidth = $record[thumbnail_width], imageheight = $record[thumbnail_height]
						WHERE contentid = $row[contentid]
					");
				}
				else
				{
					echo "<p>Could not find attachmentid $attachmentid</p>";
				}


			}
			else
			{
				var_dump($row['contentid'], $row['previewimage']);
			}
		}
	}
}


function attach_image ($file_name, $filedirectory, $nodeid)
{
	global $vbulletin;
	//make a copy of the file, the attachment code assumes its a temp file and deletes it.

	$file_location = "$filedirectory/$file_name";
	if (!$file_name OR !file_exists($file_location))
	{
		echo "<p>Could not find file $file_location\n";
		exit;
	}

	if ($vbulletin->options['safeupload'])
	{
		$temp_name = $vbulletin->options['tmppath'] . '/vbupload-install-' . substr(TIMENOW, -4);
	}
	else
	{
		$temp_name = @tempnam(ini_get('upload_tmp_dir'), 'vbupload');
	}

	if (!copy($file_location, $temp_name))
	{
		echo "<p>Could not make temporary copy of image in $temp_name</p>";
		exit;
	}

	//need to clear the cache so that the filesize operation works below.
	clearstatcache();

	$attachment = array(
		'name'     => $file_name,
		'tmp_name' => $temp_name,
		'error'    => array(),
		'size'     => filesize($temp_name)
	);

	$poststarttime = time();
	$posthash = md5($vbulletin->GPC['poststarttime'] . $vbulletin->userinfo['userid'] . $vbulletin->userinfo['salt']);

	$contenttypeid = vB_Types::instance()->getContentTypeId("vBCms_Article");

	// here we call the attach/file data combined dm
	$attachdata =& datamanager_init('AttachmentFiledata', $vbulletin, ERRTYPE_ARRAY, 'attachment');
	$attachdata->set('contenttypeid', $contenttypeid);
	$attachdata->set('posthash', $posthash);
	$attachdata->set('contentid', $nodeid);
	$attachdata->set_info('categoryid', 0);
	$attachdata->set('state', 'visible');

	$upload = new vB_Upload_Attachment_Backend($vbulletin);
	$upload->contenttypeid = $contenttypeid;
	$upload->userinfo = $vbulletin->userinfo;
	$upload->data =& $attachdata;
	$upload->image =& vB_Image::fetch_library($vbulletin);

	$attachmentid = $upload->process_upload($attachment);
	if(!$attachmentid)
	{
		echo "<p>Error loading image '$file_name':" . $upload->error . "</p>";
	}
	return $attachmentid;
}

function get_image_filename($filedirectory, $id)
{
	$filepath = "$filedirectory/$id.jpg";
	if (file_exists($filepath))
	{
		return "$id.jpg";
	}

	$filepath = "$filedirectory/$id.png";
	if (file_exists($filepath))
	{
		return "$id.png";
	}

	echo "<p>Could not find file for for id $id</p>";
	exit;
}