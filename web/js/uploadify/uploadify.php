<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
// get more knowledge at http://www.uploadify.com/documentation/
// Define a destination
$targetFolder = '/findtheroom/web/images/building'; // Relative to the root
$ownername = $_POST['ownername'];
$build_id = $_POST['buildid'];
$fieldname = $_POST['fieldname'];
$now = date('Y-m-d');
if (!empty($_FILES)) {
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	$fileextension = $fileParts['extension'];
	$fixfilename = $fieldname.'.'.$fileextension;
	
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' .$build_id;
	$targetFile = rtrim($targetPath,'/') . '/' . $fixfilename;//$_FILES['Filedata']['name'];
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		//echo $targetFolder . '/' . $_FILES['Filedata']['name'];
		echo $fixfilename;
		//echo '1';
	} else {
		echo 'Invalid file type.';
	}
}

?>