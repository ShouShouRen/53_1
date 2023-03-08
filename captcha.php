<?php
session_start();

// 產生四個隨機字母或數字
$captcha = "";
for ($i = 0; $i < 4; $i++) {
    $captcha .= chr(rand(48, 122));
}
// 將驗證碼內容儲存在 SESSION 中
$_SESSION['captcha'] = $captcha;

// 產生圖片
$image = imagecreatetruecolor(100, 50);
$bg_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
imagefill($image, 0, 0, $bg_color);
imagestring($image, 5, 20, 15, $captcha, $text_color);
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
