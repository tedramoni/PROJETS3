<?php
	session_start();
	$rand=rand(10000,99999);
	$_SESSION['secure']=$rand;
	$img = imagecreatetruecolor(80, 30);
	$fill_color=imagecolorallocate($img,255,255,255);
	imagefilledrectangle($img, 0, 0, 80, 30, $fill_color);
	$text_color=imagecolorallocate($img,10,10,10);
	$font = './police/28DaysLater.ttf';
	imagettftext($img, 23, 0, 5,30, $text_color, $font, $_SESSION['secure']);
	header("Content-type: image/jpeg");
	imagejpeg($img);
	imagedestroy($img);
?>