<?php
$src_path = 'C:/Users/DK/.gemini/antigravity-ide/brain/2e99eeb3-586c-43ad-a52a-b5fd99db0d87/kanha_wildlife_etching_1789020304918.jpg';
$im = imagecreatefromjpeg($src_path);
$w = imagesx($im);
$h = imagesy($im);

function min_brightness_col($im, $x, $h) {
    $min = 255;
    for ($y = 0; $y < $h; $y++) {
        $c = imagecolorsforindex($im, imagecolorat($im, $x, $y));
        $b = ($c['red'] + $c['green'] + $c['blue']) / 3;
        if ($b < $min) $min = $b;
    }
    return $min;
}

echo "Left col x=0 min: " . min_brightness_col($im, 0, $h) . "\n";
echo "Left col x=10 min: " . min_brightness_col($im, 10, $h) . "\n";
echo "Left col x=30 min: " . min_brightness_col($im, 30, $h) . "\n";
echo "Right col x=" . ($w-1) . " min: " . min_brightness_col($im, $w-1, $h) . "\n";
echo "Right col x=" . ($w-20) . " min: " . min_brightness_col($im, $w-20, $h) . "\n";
