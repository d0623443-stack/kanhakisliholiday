<?php
$src_path = 'C:/Users/DK/.gemini/antigravity-ide/brain/2e99eeb3-586c-43ad-a52a-b5fd99db0d87/kanha_wildlife_etching_1789020304918.jpg';
$im = imagecreatefromjpeg($src_path);

$w = imagesx($im);
$h = imagesy($im);
echo "Image dimensions: {$w}x{$h}\n";

// Check corner pixels for white background levels
$c1 = imagecolorsforindex($im, imagecolorat($im, 5, 5));
$c2 = imagecolorsforindex($im, imagecolorat($im, $w - 5, 5));
$c3 = imagecolorsforindex($im, imagecolorat($im, $w - 5, $h - 5));
$c4 = imagecolorsforindex($im, imagecolorat($im, 5, $h - 5));

echo "Top-left: {$c1['red']}, {$c1['green']}, {$c1['blue']}\n";
echo "Top-right: {$c2['red']}, {$c2['green']}, {$c2['blue']}\n";
echo "Bottom-right: {$c3['red']}, {$c3['green']}, {$c3['blue']}\n";
echo "Bottom-left: {$c4['red']}, {$c4['green']}, {$c4['blue']}\n";
