<?php
session_start();

$string = '';

$string .= substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 5);
// for ($i = 0; $i < 5; $i++) {
// $string .= chr(rand(97, 122));
// }
$_SESSION['random_number'] = $string;
$newImage = imagecreatefromjpeg("bg.jpg");

// random number 1 or 2
$font = "fonts/Molot.otf";

// random number 1 or 2
$color = imagecolorallocate($newImage, 62, 62, 62);

imagefilledrectangle($image, 0, 0, 399, 99, $white);

imagettftext($newImage, 20, 0, 20, 25, $color, $font, $_SESSION['random_number']);

header("Content-type: image/png");
imagepng($newImage);
?>