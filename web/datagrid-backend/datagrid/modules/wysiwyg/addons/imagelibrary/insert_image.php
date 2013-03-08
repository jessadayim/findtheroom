<?php
/********************************************************************
 * openImageLibrary addon Copyright (c) 2006 openWebWare.com
 * Contact us at devs@openwebware.com
 * This copyright notice MUST stay intact for use.
 * 
 * Changed by ApPHP:
 * - Last changes: 11.09.2011
 ********************************************************************/
require('config.inc.php');

$HTTP_HOST = str_replace("///", "//", GetProtocol().GetServerName().GetPort().dirname($_SERVER['PHP_SELF']));

$post_dir = isset($_POST['dir']) ? $_POST['dir'] : "";
$get_dir = ($post_dir != "") ? $post_dir : (isset($_GET['dir']) ? $_GET['dir'] : "");

$phpallowuploads = true;

// get the identifier of the editor
$wysiwyg = $_GET['wysiwyg']; 
// set image dir
$leadon = $imagebasedir;

if($leadon=='.') $leadon = '';
if((substr($leadon, -1, 1)!='/') && $leadon!='') $leadon = $leadon . '/';
$startdir = $leadon;

// validate the directory
if($get_dir){
	if(substr($get_dir, -1, 1)!='/') {
		$get_dir = $get_dir . '/';
	}
	$dirok = true;
	$dirnames = explode('/', $get_dir);
	for($di=0; $di<sizeof($dirnames); $di++) {
		if($di<(sizeof($dirnames)-2)) {
			$dotdotdir = $dotdotdir . $dirnames[$di] . '/';
		}
	}
	if(substr($get_dir, 0, 1)=='/') {
		$dirok = false;
	}

	if($get_dir == $leadon) {
		$dirok = false;
	}
	
	if($dirok) {
		$leadon = $get_dir;
	}
}


if(!$is_demo){		
	// upload file
	if($allowuploads && isset($_FILES['file'])) {
		$upload = true;
		$ext = strtolower(substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], '.')+1));
		if(!in_array($ext, $supportedextentions)) {
			$upload = false;
		}
		if($upload) {
			move_uploaded_file($_FILES['file']['tmp_name'], $leadon . $_FILES['file']['name']);
		}
	}
	
	if($allowuploads) {
		$phpallowuploads = (bool) ini_get('file_uploads');		
		$phpmaxsize = ini_get('upload_max_filesize');
		$phpmaxsize = trim($phpmaxsize);
		$last = strtolower($phpmaxsize{strlen($phpmaxsize)-1});
		switch($last) {
			case 'g':
				$phpmaxsize *= 1024; break;
			case 'm':
				$phpmaxsize *= 1024; break;
			default:
				$phpmaxsize = "Unknown"; break;
		}
	}		
}


?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>openWYSIWYG | Insert Image</title>

<script type="text/javascript" src="../../scripts/wysiwyg-popup.js"></script>
<script language="JavaScript" type="text/javascript">

/* ---------------------------------------------------------------------- *\
  Function    : insertImage()
  Description : Inserts image into the WYSIWYG.
\* ---------------------------------------------------------------------- */
function insertImage() {
	// get values from form fields
	var src = document.getElementById('src').value;
	var alt = document.getElementById('alt').value;
	var align = document.getElementById('align').value
	var border = document.getElementById('border').value
	var vspace = document.getElementById('vspace').value
	var hspace = document.getElementById('hspace').value

	var image = '<img src="<?php echo $HTTP_HOST."/"; ?>' + src + '" alt="' + alt + '" alignment="' + align + '" border="' + border + '" hspace="' + hspace + '" vspace="' + vspace + '" />';
	
	window.opener.focus();
	window.opener.insertHTML(image, '<?php echo $wysiwyg; ?>');
	window.close();	
	
}


/* ---------------------------------------------------------------------- *\
  Function    : loadImage()
  Description : load the settings of a selected image into the form fields
\* ---------------------------------------------------------------------- */
function loadImage() {
	var n = WYSIWYG_Popup.getParam('wysiwyg');
	
	// get selection and range
	var sel = WYSIWYG.getSelection(n);
	var range = WYSIWYG.getRange(sel);
	
	// the current tag of range
	var img = WYSIWYG.findParent("img", range);
	
	// if no image is defined then return
	if(img == null) return;
		
	// assign the values to the form elements
	for(var i = 0;i < img.attributes.length;i++) {
		var attr = img.attributes[i].name.toLowerCase();
		var value = img.attributes[i].value;
		//alert(attr + " = " + value);
		if(attr && value && value != "null") {
			switch(attr) {
				case "src": 
					// strip off urls on IE
					if(WYSIWYG_Core.isMSIE) value = WYSIWYG.stripURLPath(n, value, false);
					document.getElementById('src').value = value;
				break;
				case "alt":
					document.getElementById('alt').value = value;
				break;
				case "align":
					selectItemByValue(document.getElementById('align'), value);
				break;
				case "border":
					document.getElementById('border').value = value;
				break;
				case "hspace":
					document.getElementById('hspace').value = value;
				break;
				case "vspace":
					document.getElementById('vspace').value = value;
				break;
				case "width":
					document.getElementById('width').value = value;
				break;
				case "height":
					document.getElementById('height').value = value;
				break;				
			}
		}
	}
	
	// get width and height from style attribute in none IE browsers
	if(!WYSIWYG_Core.isMSIE && document.getElementById('width').value == "" && document.getElementById('width').value == "") {
		document.getElementById('width').value = img.style.width.replace(/px/, "");
		document.getElementById('height').value = img.style.height.replace(/px/, "");
	}
}

/* ---------------------------------------------------------------------- *\
  Function    : selectItem()
  Description : Select an item of an select box element by value.
\* ---------------------------------------------------------------------- */
function selectItemByValue(element, value) {
	if(element.options.length) {
		for(var i=0;i<element.options.length;i++) {
			if(element.options[i].value == value) {
				element.options[i].selected = true;
			}
		}
	}
}

</script>
</head>
<!--
 onLoad="loadImage();"
-->
<body bgcolor="#EEEEEE" marginwidth="0" marginheight="0" topmargin="0" leftmargin="0">
<table border="0" cellpadding="0" cellspacing="0" style="padding: 10px;">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?wysiwyg=<?php echo $wysiwyg; ?>" enctype="multipart/form-data">
<input type="hidden" id="dir" name="dir" value="">
<tr>
<td style="vertical-align:top;">

<span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;">Insert Image: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if($is_demo) echo "<font color='#b60000'>Uploading is blocked in Demo Version</font>"; ?></span>
<table width="380" border="0" cellpadding="0" cellspacing="0" style="background-color: #F7F7F7; border: 2px solid #FFFFFF; padding: 5px;">
	<?php
	if($allowuploads) {
		if($phpallowuploads) {
		
	?>
		<tr>
			<td style="padding-top: 0px;padding-bottom: 0px; font-family: arial, verdana, helvetica; font-size: 11px;width:80px;">Upload:</td>
			<td style="padding-top: 0px;padding-bottom: 0px;width:300px;"><input type="file" name="file" size="30" style="font-size: 10px; width: 100%;" /></td>
		</tr>
		<tr>
			<td style="padding-top: 0px;padding-bottom: 2px;font-family: tahoma; font-size: 9px;">&nbsp;</td>
			<td style="padding-top: 0px;padding-bottom: 2px;font-family: tahoma; font-size: 9px;">(Max Filesize: <?php echo $phpmaxsize; ?>KB)</td>
		</tr>
	<?php }else { ?>
		<tr>
			<td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;" colspan="2">
				File uploads are disabled in your php.ini file. Please enable them.
			</td>
		</tr>			
	<?php
		}
	}
	?>				
	<tr>
		<td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;" width="80">Image URL:</td>
		<td style="padding-bottom: 2px; padding-top: 0px;" width="300"><input type="text" name="src" id="src" value=""  style="font-size: 10px; width: 100%;"></td>
	</tr>
	<tr>
		<td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">Alternate Text:</td>
		<td style="padding-bottom: 2px; padding-top: 0px;"><input type="text" name="alt" id="alt" value=""  style="font-size: 10px; width: 100%;"></td>
	</tr>
</table>
	
<table width="380" border="0" cellpadding="0" cellspacing="0"><tr><td style="vertical-align:top;">
<span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;">Layout:</span>
<table width="180" border="0" cellpadding="0" cellspacing="0" style="background-color: #F7F7F7; border: 2px solid #FFFFFF; padding: 5px;">
<tr>
  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">Width:</td>
  <td style="width:60px;padding-bottom: 2px; padding-top: 0px;"><input type="text" name="width" id="width" value=""  style="font-size: 10px; width: 100%;"></td>
 </tr>
 <tr>
  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">Height:</td>
	<td style="padding-bottom: 2px; padding-top: 0px;"><input type="text" name="height" id="height" value=""  style="font-size: 10px; width: 100%;"></td>
 </tr>
 <tr>
  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">Border:</td>
	<td style="padding-bottom: 2px; padding-top: 0px;"><input type="text" name="border" id="border" value="0"  style="font-size: 10px; width: 100%;"></td>
 </tr>
</table>	

</td>
<td width="10">&nbsp;</td>
<td style="vertical-align:top;">

<span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;">&nbsp;</span>
<table width="200" border="0" cellpadding="0" cellspacing="0" style="background-color: #F7F7F7; border: 2px solid #FFFFFF; padding: 5px;">
<tr>
  <td style="width: 115px;padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;" width="100">Alignment:</td>
	<td style="width: 85px;padding-bottom: 2px; padding-top: 0px;">
	<select name="align" id="align" style="font-family: arial, verdana, helvetica; font-size: 11px; width: 100%;">
	 <option value="">Not Set</option>
	 <option value="left">Left</option>
	 <option value="right">Right</option>
	 <option value="texttop">Texttop</option>
	 <option value="absmiddle">Absmiddle</option>
	 <option value="baseline">Baseline</option>
	 <option value="absbottom">Absbottom</option>
	 <option value="bottom">Bottom</option>
	 <option value="middle">Middle</option>
	 <option value="top">Top</option>
	</select>
	</td>
 </tr>
 <tr>
  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">Horizontal Space:</td>
	<td style="padding-bottom: 2px; padding-top: 0px;"><input type="text" name="hspace" id="hspace" value=""  style="font-size: 10px; width: 100%;"></td>
 </tr>
 <tr>
  <td style="padding-bottom: 2px; padding-top: 0px; font-family: arial, verdana, helvetica; font-size: 11px;">Vertical Space:</td>
	<td style="padding-bottom: 2px; padding-top: 0px;"><input type="text" name="vspace" id="vspace" value=""  style="font-size: 10px; width: 100%;"></td>
 </tr>
</table>	

</td>
</tr>
</table>
</td>
<td style="vertical-align: top;width: 150px; padding-left: 5px;">
	<span style="font-family: arial, verdana, helvetica; font-size: 11px; font-weight: bold;">Select Image:</span>
	<iframe id="chooser" frameborder="0" style="height:165px;width: 180px;border: 2px solid #FFFFFF; padding: 5px;" src="select_image.php?dir=<?php echo base64_encode($leadon); ?>"></iframe>
</td>
</tr>
<tr>
	<td colspan="2" align="right" style="padding-top: 5px;">
		<input type="button" value="  Submit  " onclick="insertImage(); return false;" style="font-size: 12px;">
		<?php if ( $allowuploads ) { ?> 
			<input type="submit" value="  Upload  " style="font-size: 12px;" <?php echo (($is_demo) ? "disabled='disabled'" : "");?>>
		<?php } ?> 		
		<input type="button" value="  Cancel  " onclick="window.close();" style="font-size: 12px;">	
	</td>
</tr>
</form>
</table>
</body>
</html>
<?	
    //--------------------------------------------------------------------------
    // Get http port 
    //--------------------------------------------------------------------------
    function GetPort(){        
        $port = "";
        if(isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != "80"){
            $port = ":".$_SERVER['SERVER_PORT'];
        }
        return $port;        
    }    

    //--------------------------------------------------------------------------
    // Get protocol (http/s)
    //--------------------------------------------------------------------------
    function GetProtocol(){        
        $protocol = "http://";
        if((isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != "off")) ||
            strtolower(substr($_SERVER['SERVER_PROTOCOL'], 0, 5)) == "https"){
            $protocol = "https://";
        }
        return $protocol;        
    }

    //--------------------------------------------------------------------------
    // Get server name
    //--------------------------------------------------------------------------
    function GetServerName(){
        $server = (isset($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : "";
        $colon = strpos($server,':');
        if ($colon > 0 && $colon < strlen($server)){
            $server = substr($server, 0, $colon);
        }
        return $server;
    }

?>