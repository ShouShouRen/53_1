<?php
session_start();

$captcha = "";
for ($i = 0; $i < 4; $i++) {
    $char = chr(rand(48, 122));
    while (!ctype_alnum($char)) {
        $char = chr(rand(48, 122));
    }
    $captcha .= $char;
}
$captcha = preg_replace("/[^a-zA-Z0-9]/", "", $captcha);
$captcha_sorted = implode('', array_sort(str_split($captcha)));
$_SESSION['captcha'] = $captcha_sorted;

$image = imagecreatetruecolor(100, 50);
$bg_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
imagefill($image, 0, 0, $bg_color);
$font = 'arial.ttf';
$font_size = 22;
$text_box = imagettfbbox($font_size, 0, $font, $captcha_sorted);
$text_width = $text_box[2] - $text_box[0];
$text_height = $text_box[1] - $text_box[7];
$x = (100 - $text_width) / 2;
$y = (50 - $text_height) / 2 + $text_height;
imagettftext($image, $font_size, 0, $x, $y, $text_color, $font, $captcha_sorted);

header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);

function array_sort($arr) {
    usort($arr, function($a, $b) {
        return ord($a) - ord($b);
    });
    return $arr;
}
?>
