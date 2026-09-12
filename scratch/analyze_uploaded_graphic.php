<?php
$path = 'C:/Users/DK/.gemini/antigravity-ide/brain/2e99eeb3-586c-43ad-a52a-b5fd99db0d87/.user_uploaded/media_1788987606260.png';
$info = getimagesize($path);
echo "Image dimensions: " . $info[0] . "x" . $info[1] . " mime: " . $info['mime'] . "\n";

$im = imagecreatefrompng($path);
$w = imagesx($im);
$h = imagesy($im);

// Sample background color at top right
$rgb = imagecolorat($im, $w - 5, 5);
$colors = imagecolorsforindex($im, $rgb);
echo "Top right pixel: " . json_encode($colors) . "\n";

// Sample bottom left pixel
$rgb_b = imagecolorat($im, 5, $h - 5);
echo "Bottom left pixel: " . json_encode(imagecolorsforindex($im, $rgb_b)) . "\n";
