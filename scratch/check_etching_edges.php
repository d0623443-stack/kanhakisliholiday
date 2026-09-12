<?php
$src_path = 'C:/Users/DK/.gemini/antigravity-ide/brain/2e99eeb3-586c-43ad-a52a-b5fd99db0d87/kanha_wildlife_etching_1789020304918.jpg';
$im = imagecreatefromjpeg($src_path);
$w = imagesx($im);
$h = imagesy($im);

// Sample edges
function min_brightness_row($im, $y, $w) {
    $min = 255;
    for ($x = 0; $x < $w; $x++) {
        $c = imagecolorsforindex($im, imagecolorat($im, $x, $y));
        $b = ($c['red'] + $c['green'] + $c['blue']) / 3;
        if ($b < $min) $min = $b;
    }
    return $min;
}

echo "Top row y=0 min brightness: " . min_brightness_row($im, 0, $w) . "\n";
echo "Bottom row y=" . ($h-1) . " min brightness: " . min_brightness_row($im, $h - 1, $w) . "\n";
echo "Row y=5 min brightness: " . min_brightness_row($im, 5, $w) . "\n";
echo "Row y=" . ($h-6) . " min brightness: " . min_brightness_row($im, $h - 6, $w) . "\n";
