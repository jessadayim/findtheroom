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

define('THIS_SCRIPT', 'finalupgrade.php');

// #############################################################################
// require the code that makes it all work...
require_once('./upgradecore.php');

// #############################################################################
// welcome step
if ($vbulletin->GPC['step'] == 'welcome')
{
	if ($vbulletin->options['templateversion'] == FILE_VERSION)
	{
		echo "<blockquote><p>&nbsp;</p>";
		echo $upgrade_phrases['finalupgrade.php']['upgrade_start_message'];
		echo "<p>&nbsp;</p></blockquote>";
	}
	else
	{
		echo "<blockquote><p>&nbsp;</p>";
		echo sprintf($upgrade_phrases['finalupgrade.php']['upgrade_version_mismatch'], $vbulletin->options['templateversion'], FILE_VERSION);
		echo "<p>&nbsp;</p></blockquote>";
		print_upgrade_footer();
	}
}

// #############################################################################
// import vbulletin options
if ($vbulletin->GPC['step'] == 1)
{
	// options might need this, so lets sneak it in
	require_once(DIR . '/includes/class_bitfield_builder.php');
	vB_Bitfield_Builder::save($db);
	build_forum_permissions();

	vBulletinHook::build_datastore($db);
	build_product_datastore();

	require_once(DIR . '/includes/adminfunctions_options.php');

	if (!($xml = file_read(DIR . '/install/vbulletin-settings.xml')))
	{
		echo '<p>' . sprintf($vbphrase['file_not_found'], 'vbulletin-settings.xml') . '</p>';
		print_cp_footer();
	}

	if (isset($vbulletin->options['showdeficon']))
	{
		if ($vbulletin->options['showdeficon'] == 1)
		{ // lets show that bug who's boss! (Scott)
			$vbulletin->options['showdeficon'] = "images/icons/icon1.gif";
		}
	}

	echo '<p>' . sprintf($vbphrase['importing_file'], 'vbulletin-settings.xml');

	xml_import_settings($xml);
	echo "<br /><span class=\"smallfont\"><b>$vbphrase[ok]</b></span></p>";
}

// #############################################################################
// import admin help
if ($vbulletin->GPC['step'] == 2)
{
	require_once(DIR . '/includes/adminfunctions_help.php');

	if (!($xml = file_read(DIR . '/install/vbulletin-adminhelp.xml')))
	{
		echo '<p>' . sprintf($vbphrase['file_not_found'], 'vbulletin-adminhelp.xml') . '</p>';
		print_cp_footer();
	}

	echo '<p>' . sprintf($vbphrase['importing_file'], 'vbulletin-adminhelp.xml');

	xml_import_help_topics($xml);
	echo "<br /><span class=\"smallfont\"><b>$vbphrase[ok]</b></span></p>";
}

// #############################################################################
// import language
if ($vbulletin->GPC['step'] == 3)
{
	require_once(DIR . '/includes/adminfunctions_language.php');


	if (!($xml = file_read(DIR . '/install/vbulletin-language.xml')))
	{
		echo '<p>' . sprintf($vbphrase['file_not_found'], 'vbulletin-language.xml') . '</p>';
		print_cp_footer();
	}

	echo '<p>' . sprintf($vbphrase['importing_file'], 'vbulletin-language.xml');

	xml_import_language($xml);
	build_language();
	build_language_datastore();
	echo "<br /><span class=\"smallfont\"><b>$vbphrase[ok]</b></span></p>";
}

// #############################################################################
// import style
if ($vbulletin->GPC['step'] == 4)
{
	require_once(DIR . '/includes/adminfunctions_template.php');

	if (!($xml = file_read(DIR . '/install/vbulletin-style.xml')))
	{
		echo '<p>' . sprintf($vbphrase['file_not_found'], 'vbulletin-style.xml') . '</p>';
		print_cp_footer();
	}

	echo '<p>' . sprintf($vbphrase['importing_file'], 'vbulletin-style.xml');

	//needed for next_page processing.
	$vbulletin->GPC['perpage'] = 10;

	$info = xml_import_style($xml, -1, -1, '', false, 1, false,
		$vbulletin->GPC['startat'], $vbulletin->GPC['perpage']);
	if (!$info['done'])
	{
		print_next_page();
	}
	else
	{
		// Build video bbcode template
		require_once(DIR . '/includes/functions_databuild.php');
		build_bbcode_video();
	}

	echo "<br /><span class=\"smallfont\"><b>$vbphrase[ok]</b></span></p>";
}


if (should_install_suite())
{
	if ($vbulletin->GPC['step'] == 5)
	{
		upgrade_product_step('vbblog');
	}

	if ($vbulletin->GPC['step'] == 6)
	{
		$vbulletin->input->clean_array_gpc('p', array(
			'upgrade_do' => TYPE_STR,
			'username' => TYPE_STR,
		));

		if ($vbulletin->GPC['upgrade_do'] <> 'install_data')
		{
			if (upgrade_product_step('vbcms'))
			{
				$row = $vbulletin->db->query_first("
					SELECT COUNT(*) AS count
					FROM " . TABLE_PREFIX . "cms_node
					WHERE nodeid <> 1"
				);

		  	require_once(DIR . "/install/cmsdefaultdata/default_data_functions.php");
				if ($row['count'] == 0 AND can_install_default_data())
				{
					print_cms_default_data_form();
				}
			}
		}
		else
		{
			$row = $vbulletin->db->query_first("
				SELECT userid
				FROM " . TABLE_PREFIX . "user
				WHERE username = '" . $vbulletin->db->escape_string($vbulletin->GPC['username']) . "'"
			);

			if (!$row)
			{
				print_cms_default_data_form($upgrade_phrases['finalupgrade.php']['user_not_found']);
			}
			else
			{
		  	require_once(DIR . "/install/cmsdefaultdata/default_data_functions.php");
				if (can_install_default_data())
				{
					add_default_data();
  				add_default_attachments($row['userid']);
					echo_flush("<p>" . $upgrade_phrases['finalupgrade.php']['cms_data_import_success'] . "</p>");
				}
			}
		}
	}
}

function print_cms_default_data_form($error="")
{
	global $upgradecore_phrases, $upgrade_phrases, $vbulletin;
	print_form_header('finalupgrade', '');
	construct_hidden_code('upgrade_do', 'install_data');
	construct_hidden_code('step', $vbulletin->GPC['step']);
	print_table_header($upgrade_phrases['finalupgrade.php']['cms_default_data_install']);
	print_description_row($upgrade_phrases['finalupgrade.php']['cms_default_data_overwrite']);
	if ($error)
	{
		print_description_row($error);
	}

	print_input_row("<b>{$upgradecore_phrases['username']}</b> (" . $upgrade_phrases['finalupgrade.php']['user_must_exist'] . ")",
		'username', $vbulletin->GPC['username']);
	print_submit_row($upgrade_phrases['finalupgrade.php']['install'], "");
}

// #############################################################################
if ($vbulletin->GPC['step'] == (should_install_suite() ? 7 : 5))
{
	require_once(DIR . '/includes/class_template_merge.php');

	$products = array("''", "'vbulletin'");

	if (should_install_suite())
	{
		$products = array_merge($products, array("'vbblog'", "'vbcms'"));
 	}

	$merge_data = new vB_Template_Merge_Data($vbulletin);
	$merge_data->start_offset = $vbulletin->GPC['startat'];
	$merge_data->add_condition($c = "tnewmaster.product IN (" . implode(', ', $products) . ")");

	$merge = new vB_Template_Merge($vbulletin);
	$merge->time_limit = 4;
	$completed = $merge->merge_templates($merge_data);

	if ($completed)
	{
		// completed
		build_all_styles();
	}
	else
	{
		// more templates to merge
		print_next_page(0, $merge_data->start_offset + $merge->fetch_processed_count());
	}
}

// #############################################################################
if ($vbulletin->GPC['step'] == (should_install_suite() ? 8 : 6))
{
	$gotopage = '../' . $vbulletin->config['Misc']['admincpdir'] . '/index.php';

	echo '<p align="center" class="smallfont"><a href="' . $gotopage . '">' . $vbphrase['proceed'] . '</a></p>';
	echo "\n<script type=\"text/javascript\">\n";
	echo "window.location=\"$gotopage\";";
	echo "\n</script>\n";

	print_upgrade_footer();
	exit;
}


// #############################################################################

print_next_step();
print_upgrade_footer();

/*======================================================================*\
|| ####################################################################
|| #
|| # CVS: $RCSfile$ - $Revision: 35697 $
|| ####################################################################
\*======================================================================*/
?>
