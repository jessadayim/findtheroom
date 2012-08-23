
<?
	$font = 'Layiji.ttf';
	$font_size = 30;
	$string = "ABabc"; // String
	
	$im = imagecreatefromjpeg("bg_code.jpg"); // Path From Upload Temp

	$color = imagecolorallocate($im, 0, 0, 0); // Text BackColor
	$pxX = ((imagesx($im))/2)-40;
	$pxY = 25;

	imagettftext($im, $font_size, 0, $pxX, $pxY, $color, $font, $string);
	$file_path = "test.jpg";




	imageJpeg($im,$file_path);
	ImageDestroy($im);
	
	

?>

<img src="test.jpg?<?php print date("ms");?>" alt="test" width="120" height="30" />