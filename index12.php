<?php
session_start();

// Генерируем случайный код (A-Z, 0-9)
$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
$captcha_code = '';
for ($i = 0; $i < 4; $i++) {
    $captcha_code .= $characters[rand(0, strlen($characters) - 1)];
}
$_SESSION['captcha'] = $captcha_code;

// Создаём изображение
$width = 150;
$height = 50;
$image = imagecreatetruecolor($width, $height);
$bg_color = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $bg_color);

// Добавляем случайные линии
for ($i = 0; $i < 3; $i++) {
    $line_color = imagecolorallocate($image, rand(100, 200), rand(100, 200), rand(100, 200));
    imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $line_color);
}

// Добавляем случайные точки (шум)
for ($i = 0; $i < 50; $i++) {
    $dot_color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    imagesetpixel($image, rand(0, $width), rand(0, $height), $dot_color);
}

// Добавляем символы
for ($i = 0; $i < 4; $i++) {
    $font_size = 20;
    $x = 20 + ($i * 30);
    $y = rand(30, 40);
    $angle = rand(-20, 20);
    $text_color = imagecolorallocate($image, 0, 0, 0);
    imagettftext($image, $font_size, $angle, $x, $y, $text_color, './arial.ttf', $captcha_code[$i]);
}

// Выводим изображение
header("Content-Type: image/png");
imagepng($image);
imagedestroy($image);
?>
