<?php
$src_path = 'C:/Users/DK/.gemini/antigravity-ide/brain/2e99eeb3-586c-43ad-a52a-b5fd99db0d87/.user_uploaded/media_1788987606260.png';
$im = imagecreatefrompng($src_path);
$w = imagesx($im);
$h = imagesy($im);

for ($y = 0; $y < 100; $y++) {
    $darkest = 255;
    // scan between x=40 and x=560 (avoiding the left text)
    for ($x = 40; $x < 560; $x++) {
        $rgb = imagecolorsforindex($im, imagecolorat($im, $x, $y));
        $brightness = ($rgb['red'] + $rgb['green'] + $rgb['blue']) / 3;
        if ($brightness < $darkest) {
            $darkest = $brightness;
        }
    }
    if ($darkest < 235) {
        echo "Top edge y=$y has min brightness $darkest\n";
        break;
    }
}
