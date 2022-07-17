<?php
session_start();
$captcha_num = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
$captcha_num = substr(str_shuffle($captcha_num), 0, 6);
$_SESSION["code"] = $captcha_num;

header('Content-type: image/jpeg');
$font = 'monofont.ttf';
$font_size = 30;
$img_width = 115;
$img_height = 40;
$image = imagecreate($img_width, $img_height); // create background image with dimensions
imagecolorallocate($image, 255, 255, 255); // set background color
$pixel_color = imagecolorallocate($image, 54,1,63);
for($i=0;$i<1000;$i++) {
    imagesetpixel($image,rand()%200,rand()%50,$pixel_color);
}  
$line_color = imagecolorallocate($image, 0, 51, 102); 
for($i=0;$i<10;$i++) {
    imageline($image,0,rand()%50,200,rand()%50,$line_color);
}

$text_color = imagecolorallocate($image, 0, 0, 0); // set captcha text color
imagettftext($image, $font_size, 0, 15, 30, $text_color, $font, $captcha_num);
imagejpeg($image);
?>