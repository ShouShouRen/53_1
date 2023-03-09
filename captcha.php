<?php
session_start();
$captcha = "";
for ($i = 0; $i < 4; $i++) {
    $captcha .= chr(rand(48, 122));
}
$_SESSION['captcha'] = implode('', array_sort(str_split($captcha)));
$image = imagecreatetruecolor(100, 50);
$bg_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
imagefill($image, 0, 0, $bg_color);
imagestring($image, 5, 20, 15, $captcha, $text_color);
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);

function array_sort($arr) {
    usort($arr, function($a, $b) {
        return ord($a) - ord($b);
    });
    return $arr;
}