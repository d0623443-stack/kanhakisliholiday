<?php
$w = 1200;
$h = 520;
$canvas = imagecreatetruecolor($w, $h);
$bg = imagecolorallocate($canvas, 249, 246, 240); // ivory over warm-white
imagefill($canvas, 0, 0, $bg);

$etch = imagecreatefrompng('scratch/feathered_etching.png');
$ew = imagesx($etch);
$eh = imagesy($etch);
$tw = 540;
$th = (int)($eh * ($tw / $ew));

$etchResized = imagecreatetruecolor($tw, $th);
imagealphablending($etchResized, false);
imagesavealpha($etchResized, true);
$trans = imagecolorallocatealpha($etchResized, 0, 0, 0, 127);
imagefill($etchResized, 0, 0, $trans);
imagecopyresampled($etchResized, $etch, 0, 0, 0, 0, $tw, $th, $ew, $eh);

$dstX = $w - $tw;
$dstY = $h - $th;

for ($y = 0; $y < $th; $y++) {
    for ($x = 0; $x < $tw; $x++) {
        $c = imagecolorat($etchResized, $x, $y);
        $srcA = ($c >> 24) & 0x7F;
        if ($srcA < 127) {
            $srcAlphaFrac = (127 - $srcA) / 127.0;
            // 40% overall section opacity
            $effectiveAlpha = $srcAlphaFrac * 0.40;
            
            $sr = ($c >> 16) & 0xFF;
            $sg = ($c >> 8) & 0xFF;
            $sb = $c & 0xFF;
            
            $bgC = imagecolorat($canvas, $dstX + $x, $dstY + $y);
            $br = ($bgC >> 16) & 0xFF;
            $bgCol = ($bgC >> 8) & 0xFF;
            $bb = $bgC & 0xFF;
            
            // Multiply blend mode
            $multR = ($sr * $br) / 255.0;
            $multG = ($sg * $bgCol) / 255.0;
            $multB = ($sb * $bb) / 255.0;
            
            $finalR = (int)($multR * $effectiveAlpha + $br * (1 - $effectiveAlpha));
            $finalG = (int)($multG * $effectiveAlpha + $bgCol * (1 - $effectiveAlpha));
            $finalB = (int)($multB * $effectiveAlpha + $bb * (1 - $effectiveAlpha));
            
            imagesetpixel($canvas, $dstX + $x, $dstY + $y, imagecolorallocate($canvas, $finalR, $finalG, $finalB));
        }
    }
}

// Add the button "Discover Safari ->" over it at roughly its location to check the visual composition
// Button is around x=580, y=380, width 180, height 48, rounded pill, forest green #18382B
$btnBg = imagecolorallocate($canvas, 24, 56, 43);
$btnText = imagecolorallocate($canvas, 251, 250, 246);
// Draw rounded rect approximation
imagefilledrectangle($canvas, 580, 380, 780, 428, $btnBg);

imagepng($canvas, 'scratch/feathered_composite_test.png');
echo "Saved scratch/feathered_composite_test.png\n";
