<?php
$im = imagecreatefrompng('public/assets/images/kanha-meadow-wildlife-etching.png');
$w = imagesx($im);
$h = imagesy($im);
echo "Image size: {$w}x{$h}\n";

$hasWhite = 0;
$hasTransparent = 0;
$hasSemi = 0;
$hasOpaque = 0;

for ($y = 0; $y < $h; $y += 10) {
    for ($x = 0; $x < $w; $x += 10) {
        $c = imagecolorat($im, $x, $y);
        $a = ($c >> 24) & 0x7F;
        $r = ($c >> 16) & 0xFF;
        $g = ($c >> 8) & 0xFF;
        $b = $c & 0xFF;

        if ($a == 127) {
            $hasTransparent++;
        } elseif ($a == 0) {
            $hasOpaque++;
            if ($r > 240 && $g > 240 && $b > 240) {
                $hasWhite++;
            }
        } else {
            $hasSemi++;
        }
    }
}

echo "Sampled grid (every 10px):\n";
echo "Transparent (a=127): $hasTransparent\n";
echo "Semi-transparent: $hasSemi\n";
echo "Opaque: $hasOpaque\n";
echo "Opaque White (>240): $hasWhite\n";
