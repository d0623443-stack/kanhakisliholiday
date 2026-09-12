<?php
// Simulate section rendering
$w = 1200;
$h = 500;
$canvas = imagecreatetruecolor($w, $h);

// Section background: bg-ivory/60 over warm-white
// warm-white is #FBFAF6 (251, 250, 246)
// ivory is #F7F4EC (247, 244, 236)
// 60% ivory over warm-white:
// R = 247*0.6 + 251*0.4 = 248.6 (~249)
// G = 244*0.6 + 250*0.4 = 246.4 (~246)
// B = 236*0.6 + 246*0.4 = 240 (~240)
$bg = imagecolorallocate($canvas, 249, 246, 240);
imagefill($canvas, 0, 0, $bg);

// Load etching
$etch = imagecreatefrompng('public/assets/images/kanha-meadow-wildlife-etching.png');
$ew = imagesx($etch);
$eh = imagesy($etch);

// Target size: 540px wide, maintain aspect ratio
$tw = 540;
$th = (int)($eh * ($tw / $ew));

// Resize etching
$etchResized = imagecreatetruecolor($tw, $th);
imagealphablending($etchResized, false);
imagesavealpha($etchResized, true);
$trans = imagecolorallocatealpha($etchResized, 0, 0, 0, 127);
imagefill($etchResized, 0, 0, $trans);
imagecopyresampled($etchResized, $etch, 0, 0, 0, 0, $tw, $th, $ew, $eh);

// Position at bottom-right of canvas
$dstX = $w - $tw;
$dstY = $h - $th;

// Test 1: Current approach (simple opacity ~35%)
$canvasCurrent = imagecreatetruecolor($w, $h);
imagecopy($canvasCurrent, $canvas, 0, 0, 0, 0, $w, $h);
for ($y = 0; $y < $th; $y++) {
    for ($x = 0; $x < $tw; $x++) {
        $c = imagecolorat($etchResized, $x, $y);
        $srcA = ($c >> 24) & 0x7F; // 0 (opaque) to 127 (transparent)
        if ($srcA < 127) {
            $srcAlphaFrac = (127 - $srcA) / 127.0; // 0 to 1
            $effectiveAlpha = $srcAlphaFrac * 0.35; // 35% opacity
            $sr = ($c >> 16) & 0xFF;
            $sg = ($c >> 8) & 0xFF;
            $sb = $c & 0xFF;
            
            $bgC = imagecolorat($canvasCurrent, $dstX + $x, $dstY + $y);
            $br = ($bgC >> 16) & 0xFF;
            $bgCol = ($bgC >> 8) & 0xFF;
            $bb = $bgC & 0xFF;
            
            $finalR = (int)($sr * $effectiveAlpha + $br * (1 - $effectiveAlpha));
            $finalG = (int)($sg * $effectiveAlpha + $bgCol * (1 - $effectiveAlpha));
            $finalB = (int)($sb * $effectiveAlpha + $bb * (1 - $effectiveAlpha));
            
            imagesetpixel($canvasCurrent, $dstX + $x, $dstY + $y, imagecolorallocate($canvasCurrent, $finalR, $finalG, $finalB));
        }
    }
}
imagepng($canvasCurrent, 'scratch/test_current.png');

// Test 2: Radial gradient feathering + opacity
$canvasBlended = imagecreatetruecolor($w, $h);
imagecopy($canvasBlended, $canvas, 0, 0, 0, 0, $w, $h);
for ($y = 0; $y < $th; $y++) {
    for ($x = 0; $x < $tw; $x++) {
        $c = imagecolorat($etchResized, $x, $y);
        $srcA = ($c >> 24) & 0x7F;
        if ($srcA < 127) {
            $srcAlphaFrac = (127 - $srcA) / 127.0;
            
            // Normalized coordinates from center of mask at bottom right (85%, 85%)
            $cx = 0.85 * $tw;
            $cy = 0.85 * $th;
            $dx = ($x - $cx) / ($tw * 0.85);
            $dy = ($y - $cy) / ($th * 0.85);
            $dist = sqrt($dx*$dx + $dy*$dy);
            
            // Mask falloff
            $mask = 1.0;
            if ($dist > 0.4) {
                $mask = max(0.0, 1.0 - ($dist - 0.4) / 0.6);
            }
            $mask = pow($mask, 1.5); // smooth ease
            
            $effectiveAlpha = $srcAlphaFrac * 0.40 * $mask;
            if ($effectiveAlpha > 0.001) {
                $sr = ($c >> 16) & 0xFF;
                $sg = ($c >> 8) & 0xFF;
                $sb = $c & 0xFF;
                
                $bgC = imagecolorat($canvasBlended, $dstX + $x, $dstY + $y);
                $br = ($bgC >> 16) & 0xFF;
                $bgCol = ($bgC >> 8) & 0xFF;
                $bb = $bgC & 0xFF;
                
                // Multiply blend
                $multR = ($sr * $br) / 255.0;
                $multG = ($sg * $bgCol) / 255.0;
                $multB = ($sb * $bb) / 255.0;
                
                $finalR = (int)($multR * $effectiveAlpha + $br * (1 - $effectiveAlpha));
                $finalG = (int)($multG * $effectiveAlpha + $bgCol * (1 - $effectiveAlpha));
                $finalB = (int)($multB * $effectiveAlpha + $bb * (1 - $effectiveAlpha));
                
                imagesetpixel($canvasBlended, $dstX + $x, $dstY + $y, imagecolorallocate($canvasBlended, $finalR, $finalG, $finalB));
            }
        }
    }
}
imagepng($canvasBlended, 'scratch/test_blended.png');

echo "Saved test_current.png and test_blended.png\n";
