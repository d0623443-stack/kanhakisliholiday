<?php
$src_path = 'C:/Users/DK/.gemini/antigravity-ide/brain/2e99eeb3-586c-43ad-a52a-b5fd99db0d87/.user_uploaded/media_1788987606260.png';
$im = imagecreatefrompng($src_path);
$w = imagesx($im);
$h = imagesy($im);

for ($y = $h - 1; $y >= $h - 30; $y--) {
    $rgb = imagecolorsforindex($im, imagecolorat($im, (int)($w/2), $y));
    echo "y=$y: " . json_encode($rgb) . "\n";
}
