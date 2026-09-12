<?php
$w = 1200;
$h = 500;
$canvas = imagecreatetruecolor($w, $h);
$bg = imagecolorallocate($canvas, 249, 246, 240);
imagefill($canvas, 0, 0, $bg);

$etch = imagecreatefrompng('public/assets/images/kanha-meadow-wildlife-etching.png');
$ew = imagesx($etch);
$eh = imagesy($etch);
$tw = 560;
$th = (int)($eh * ($tw / $ew));

$etchResized = imagecreatetruecolor($tw, $th);
imagealphablending($etchResized, false);
imagesavealpha($etchResized, true);
$trans = imagecolorallocatealpha($etchResized, 0, 0, 0, 127);
imagefill($etchResized, 0, 0, $trans);
imagecopyresampled($etchResized, $etch, 0, 0, 0, 0, $tw, $th, $ew, $eh);

$dstX = $w - $tw;
$dstY = $h - $th;

// Style 1: Gentle edge feather (top 25% fades in, left 25% fades in, bottom 5% fades out, right 5% fades out)
$c1 = imagecreatetruecolor($w, $h);
imagecopy($c1, $canvas, 0, 0, 0, 0, $w, $h);

for ($y = 0; $y < $th; $y++) {
    $fadeY = 1.0;
    if ($y < $th * 0.25) {
        $fadeY = $y / ($th * 0.25);
    } elseif ($y > $th * 0.95) {
        $fadeY = ($th - $y) / ($th * 0.05);
    }
    
    for ($x = 0; $x < $tw; $x++) {
        $fadeX = 1.0;
        if ($x < $tw * 0.25) {
            $fadeX = $x / ($tw * 0.25);
        } elseif ($x > $tw * 0.95) {
            $fadeX = ($tw - $x) / ($tw * 0.05);
        }
        
        $mask = sin($fadeX * M_PI / 2) * sin($fadeY * M_PI / 2); // smooth ease
        
        $c = imagecolorat($etchResized, $x, $y);
        $srcA = ($c >> 24) & 0x7F;
        if ($srcA < 127) {
            $srcAlphaFrac = (127 - $srcA) / 127.0;
            $effectiveAlpha = $srcAlphaFrac * 0.40 * $mask;
            if ($effectiveAlpha > 0.001) {
                $sr = ($c >> 16) & 0xFF;
                $sg = ($c >> 8) & 0xFF;
                $sb = $c & 0xFF;
                
                $bgC = imagecolorat($c1, $dstX + $x, $dstY + $y);
                $br = ($bgC >> 16) & 0xFF;
                $bgCol = ($bgC >> 8) & 0xFF;
                $bb = $bgC & 0xFF;
                
                $multR = ($sr * $br) / 255.0;
                $multG = ($sg * $bgCol) / 255.0;
                $multB = ($sb * $bb) / 255.0;
                
                $finalR = (int)($multR * $effectiveAlpha + $br * (1 - $effectiveAlpha));
                $finalG = (int)($multG * $effectiveAlpha + $bgCol * (1 - $effectiveAlpha));
                $finalB = (int)($multB * $effectiveAlpha + $bb * (1 - $effectiveAlpha));
                
                imagesetpixel($c1, $dstX + $x, $dstY + $y, imagecolorallocate($c1, $finalR, $finalG, $finalB));
            }
        }
    }
}
imagepng($c1, 'scratch/test_style1.png');

// Style 2: Diagonal Vignette (soft diagonal gradient from top-left 0 to bottom-right 100%)
$c2 = imagecreatetruecolor($w, $h);
imagecopy($c2, $canvas, 0, 0, 0, 0, $w, $h);

for ($y = 0; $y < $th; $y++) {
    for ($x = 0; $x < $tw; $x++) {
        // Diagonal distance from top-left (0,0) to bottom-right (tw, th)
        // 0 at top-left, 1 at bottom-right
        $diag = (($x / $tw) * 0.6 + ($y / $th) * 0.4);
        // Map: 0..0.2 = 0, 0.2..0.8 = smooth 0..1, 0.8..1 = 1
        $mask = 0.0;
        if ($diag > 0.2) {
            $mask = min(1.0, ($diag - 0.2) / 0.6);
            $mask = sin($mask * M_PI / 2);
        }
        
        $c = imagecolorat($etchResized, $x, $y);
        $srcA = ($c >> 24) & 0x7F;
        if ($srcA < 127) {
            $srcAlphaFrac = (127 - $srcA) / 127.0;
            $effectiveAlpha = $srcAlphaFrac * 0.42 * $mask;
            if ($effectiveAlpha > 0.001) {
                $sr = ($c >> 16) & 0xFF;
                $sg = ($c >> 8) & 0xFF;
                $sb = $c & 0xFF;
                
                $bgC = imagecolorat($c2, $dstX + $x, $dstY + $y);
                $br = ($bgC >> 16) & 0xFF;
                $bgCol = ($bgC >> 8) & 0xFF;
                $bb = $bgC & 0xFF;
                
                $multR = ($sr * $br) / 255.0;
                $multG = ($sg * $bgCol) / 255.0;
                $multB = ($sb * $bb) / 255.0;
                
                $finalR = (int)($multR * $effectiveAlpha + $br * (1 - $effectiveAlpha));
                $finalG = (int)($multG * $effectiveAlpha + $bgCol * (1 - $effectiveAlpha));
                $finalB = (int)($multB * $effectiveAlpha + $bb * (1 - $effectiveAlpha));
                
                imagesetpixel($c2, $dstX + $x, $dstY + $y, imagecolorallocate($c2, $finalR, $finalG, $finalB));
            }
        }
    }
}
imagepng($c2, 'scratch/test_style2.png');
