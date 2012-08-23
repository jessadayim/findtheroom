<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>captcha_thai</title>

<script language="javascript" type="text/javascript">
function post_comment22(){
		 if(document.getElementById('cap1').value==''){
			alert('กรุณากรอกข้อมูลที่มองเห็น');
			document.getElementById('cap1').focus();
			return false;
		}else if(document.getElementById('cap1').value != document.getElementById('cap2').value){
			alert('กรุณากรอกข้อมูลให้ถูกต้อง');
			document.getElementById('cap1').focus();
			return false;
		}else{
			//ทำงานถูกต้อง
			alert('welcome to SiAMFOCUS.com');
			return true;
		}
	}
</script>

</head>

<body>
<?php
	//BEGIN FUNCTION 
		
	function random_password($length,$validchars) {
	$numchars = mb_strlen ($validchars,'utf-8');
	$password = '';

	// each loop random 1 character
	for ($i = 0; $i < $length; $i++) {
		mt_srand();
		// random index of valid characters
		$index = mt_rand(0, $numchars - 1);
		// get character at index and append to password
		$password .= mb_substr($validchars, $index, 1,'utf-8');
		if(mb_strlen($password,'utf-8')==$length){
			break;	
		}
	}
	return $password;
}


	function imgCode($code){
		if($code!=""){
		
				$font = 'captcha_thai/LayijiBao.ttf';
				$font_size = 30;
				$string = $code; // String
				
				$im = imagecreatefromjpeg("captcha_thai/bg.jpg"); // Path From Upload Temp
				$color = imagecolorallocate($im, 0, 0, 0); // Text BackColor
				$pxX = ((imagesx($im))/2)-40;
				$pxY = 25;
			
				imagettftext($im, $font_size, 0, $pxX, $pxY, $color, $font, $string);
				$file_path = "captcha_thai/test.jpg";
				imageJpeg($im,$file_path);
				ImageDestroy($im);

				return "<img src=\"captcha_thai/test.jpg\" alt=\"banboon_code\" width=\"120\" height=\"30\"/>";
		}else{
			return "";
		}
	}

// END OF FUNTION
?>
<div align="center">
<form name="myform" id="myform" method="post" action="#" onsubmit="return post_comment22()">
							<?php
                                $chkChar = random_password(5,'23456789ABCDEFGHJKLMN');
								//print $chkChar;
								?>
							<br /><br />
  <table width="250" border="0" cellpadding="1" cellspacing="1" bgcolor="#C0504D">
                                  <tr>
                                    <td colspan="2" style="color:#FFF; font-weight:bold; font-size:12px;">กรุณากรอกข้อมูลที่มองเห็น</td>
                                  </tr>
                                  <tr>
                                    <td width="122" bgcolor="#FFFFFF"><input name="cap1" type="text" class="general_frm" id="cap1" style="width:120px; border:1px solid #999; background-color:#f2f2f2; padding:5px;" maxlength="5" />
                                    <input name="cap2" type="hidden" value="<?php print  trim($chkChar); ?>" id="cap2" /></td>
                                    <td width="121" bgcolor="#FFFFFF"><?php
                                        print imgCode($chkChar);
                                ?></td>
                                  </tr>
                                  <tr>
                                    <td bgcolor="#FFFFFF"><input type="submit" value="ทดสอบ" /></td>
                                    <td bgcolor="#FFFFFF">&nbsp;</td>
                                  </tr>
  </table>
</form>

</div>
</body>
</html>