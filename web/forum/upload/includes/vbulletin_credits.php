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

if (!isset($GLOBALS['vbulletin']->db))
{
	exit;
}

// display the credits table for use in admin/mod control panels

print_form_header('index', 'home');
print_table_header($vbphrase['vbulletin_developers_and_contributors']);
print_column_style_code(array('white-space: nowrap', ''));
print_label_row('<b>' . $vbphrase['software_developed_by'] . '</b>', '
	vBulletin Solutions, Inc.,
	Internet Brands, Inc.
', '', 'top', NULL, false);
print_label_row('<b>' . $vbphrase['business_development'] . '</b>', '
	Adrian Harris,
	Fabian Schonholz
', '', 'top', NULL, false);
print_label_row('<b>' . $vbphrase['engineering'] . '</b>', '
	Kevin Sours,
	Freddie Bingham,
	Darren Gordon,
	Edwin Brown,
	Andrew Elkins,
	Xiaoyu Huang,
	Colin Frei,
	Joan Gauna,
	David Grove,
	Jerry Hutchings,
', '', 'top', NULL, false);
print_label_row('<b>' . $vbphrase['product'] . '</b>', '
	Don Kuramura
', '', 'top', NULL, false);
print_label_row('<b>' . $vbphrase['graphics_development'] . '</b>', '
	Sophie Xie
', '', 'top', NULL, false);
print_label_row('<b>' . $vbphrase['qa'] . '</b>', '
	Allen Lin,
	Fei Leung,
	Kevin Connery,
	Meghan Sensenbach,
	Michael Lavaveshkul
', '', 'top', NULL, false);
print_label_row('<b>' . $vbphrase['support'] . '</b>', '
	Steve Machol,
	Wayne Luke,
	Carrie Anderson,
	George Liu,
	Jake Bunce,
	Zachery Woods,
	Marco van Herwaarden,
	Marlena Machol,
	Trevor Hannant,
	Lynne Sands
', '', 'top', NULL, false);
print_label_row('<b>' . $vbphrase['special_thanks_to'] . '</b>', '
	Adrian Sacchi, Ajinkya Apte, Andreas Kirbach, Andy Huang, Aston Jay, Bob Pankala,
	Brian Swearingen, Brian Gunter, Chen Avinadav, Chevy Revata, Chris Holland, Christopher Riley,
	Daniel Clements, David Bonilla, David Webb, David Yancy, Dominic Schlatter, Don T. Romrell,
	Doron Rosenberg, Elmer Hernandez, Fernando Munoz, Floris Fiedeldij Dop, Forum Scriptz Team, 
        Giovanni Martinez, Hanafi Jamil, Hanson Wong, Hartmut Voss, Ivan Anfimov, Jacquii Cooke,
	Jan Allan Zischke, Jelle Van Loo, Jen Rundell, Jeremy Dentel, Joe Rosenblum, Joe Velez, Joel Young, John Jakubowski,
	John Percival, John Simpson, Jonathan Javier Coletta, Joseph DeTomaso, Kevin Schumacher,
	Kevin Wilkinson, Kier Darby, Kira Lerner, Kolby Bothe, Lisa Swift, Mark James,
	Martin Meredith, Matthew Gordon, Mert Gokceimam, Michael Biddle, Michael Henretty,
	Michael Kellogg, Michael \'Mystics\' K&ouml;nig, Michael Pierce, Mike Sullivan,
	Milad Kawas Cale, Nathan Wingate, Nawar Al-Mubaraki, Ole Vik, Overgrow, Paul Marsden,
	Peggy Lynn Gurney, Prince Shah, Pritesh Shah, Robert Beavan White, Ryan Royal,
	Sal Colascione III, Scott MacVicar, Scott Molinari, Scott William, Sebastiano Vassellatti,
	Shawn Vowell, Stephan \'pogo\' Pogodalla, Sven Keller, Tom Murphy, Tony Phoenix,
	Torstein H&oslash;nsi, Tully Rankin, Vinayak Gupta, Yves Rigaud
	', '', 'top', NULL, false);

print_label_row('<b>' . $vbphrase['other_contributions_from'] . '</b>', '
	Torstein H&oslash;nsi,
	Mark James
', '', 'top', NULL, false);
print_label_row('<b>' . $vbphrase['copyright_enforcement_by'] . '</b>', '
	vBulletin Solutions, Inc.
', '', 'top', NULL, false);
print_table_footer();

/*======================================================================*\
|| ####################################################################
|| #
|| # CVS: $RCSfile$ - $Revision: 37754 $
|| ####################################################################
\*======================================================================*/
?>