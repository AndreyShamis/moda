<?
header("Content-Type: image/png");

$im = imagecreatetruecolor(100, 20);
$white = imagecolorallocate($im,  255, 255, 255);
$seriy = imagecolorallocate($im,30, 20, 10);
$hz = imagecolorallocate($im,80, 210, 458);
$hz2 = imagecolorallocate($im,70, 110, 218);
$hz3 = imagecolorallocate($im,50, 130, 118);
$hz4 = imagecolorallocate($im,210, 180, 75);

$black = imagecolorallocate($im, 0x00, 0x00, 0x00);

$red = imagecolorallocate($im,255, 0, 0);
$white = imagecolorallocate($im,  255, 255, 255);
// Draw a white rectangle
imagefilledrectangle($im, 2, 2, 98, 18, $white);




 $tahoma_file = 'tahoma.ttf';
 $times_file = 'times.ttf';
 $arialbdfile = 'arialbd.ttf';

imagepng($im);
imagedestroy($im);

?>