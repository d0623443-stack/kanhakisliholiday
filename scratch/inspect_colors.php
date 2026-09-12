<?php
$im = imagecreatefrompng('public/assets/images/kanha-meadow-wildlife-etching.png');
$w = imagesx($im);
$h = imagesy($im);
$colors = [];
for ($y = 0; $y < $h; $y += 5) {
    for ($x = 0; $x < $w; $x += 5) {
        $c = imagecolorat($im, $x, $y);
        $a = ($c >> 24) & 0x7F;
        $r = ($c >> 16) & 0xFF;
        $g = ($c >> 8) & 0xFF;
        $b = $c & 0xFF;
        if ($a < 100) {
            $key = sprintf("R:%d,G:%d,B:%d,A:%d", $r, $g, $b, $a);
            $colors[$key] = ($colors[$key] ?? 0) + 1;
        }
    }
}
arsort($colors);
echo "Most frequent non-transparent colors:\n";
$i = 0;
foreach ($colors as $col => $cnt) {
    echo "$col -> count: $cnt\n";
    if (++$i > 20) break;
}
