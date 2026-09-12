<?php
$src_path = 'C:/Users/DK/.gemini/antigravity-ide/brain/2e99eeb3-586c-43ad-a52a-b5fd99db0d87/.user_uploaded/media_1788987606260.png';
$im = imagecreatefrompng($src_path);
$w = imagesx($im);
$h = imagesy($im);

for ($x = $w - 1; $x >= $w - 200; $x--) {
    $darkest = 255;
    for ($y = 0; $y < $h - 20; $y++) {
        $rgb = imagecolorsforindex($im, imagecolorat($im, $x, $y));
        $brightness = ($rgb['red'] + $rgb['green'] + $rgb['blue']) / 3;
        if ($brightness < $darkest) {
            $darkest = $brightness;
        }
    }
    if ($darkest < 235) {
        echo "Right edge x=$x has min brightness $darkest\n";
        break;
    }
}
