<?php
$src_path = 'C:/Users/DK/.gemini/antigravity-ide/brain/2e99eeb3-586c-43ad-a52a-b5fd99db0d87/.user_uploaded/media_1788987606260.png';
$im = imagecreatefrompng($src_path);
$w = imagesx($im);
$h = imagesy($im);
echo "W: $w, H: $h\n";

// Check corners
$corners = [
  'tl' => imagecolorsforindex($im, imagecolorat($im, 5, 5)),
  'tr' => imagecolorsforindex($im, imagecolorat($im, $w-5, 5)),
  'bl' => imagecolorsforindex($im, imagecolorat($im, 5, $h-5)),
  'br' => imagecolorsforindex($im, imagecolorat($im, $w-5, $h-5)),
  'top_mid' => imagecolorsforindex($im, imagecolorat($im, (int)($w/2), 5)),
];
echo "Corners: " . json_encode($corners) . "\n";
