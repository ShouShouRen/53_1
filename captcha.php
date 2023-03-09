<?php
session_start();

// 產生四個隨機字母或數字
$captcha = "";
for ($i = 0; $i < 4; $i++) {
    $captcha .= chr(rand(48, 122));
}
// 將驗證碼內容儲存在 SESSION 中，並按照 ASCII code 排序
$_SESSION['captcha'] = implode('', array_sort(str_split($captcha)));

// 產生圖片
$image = imagecreatetruecolor(100, 50);
$bg_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
imagefill($image, 0, 0, $bg_color);
imagestring($image, 5, 20, 15, $captcha, $text_color);
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);

// 按照 ASCII code 的大小排序字元陣列
function array_sort($arr) {
    usort($arr, function($a, $b) {
        return ord($a) - ord($b);
    });
    return $arr;
}