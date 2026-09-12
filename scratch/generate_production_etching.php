<?php
$src_path = 'C:/Users/DK/.gemini/antigravity-ide/brain/2e99eeb3-586c-43ad-a52a-b5fd99db0d87/kanha_wildlife_etching_1789020304918.jpg';
$im = imagecreatefromjpeg($src_path);
$w = imagesx($im);
$h = imagesy($im);

$out = imagecreatetruecolor($w, $h);
imagealphablending($out, false);
imagesavealpha($out, true);
$transparent = imagecolorallocatealpha($out, 0, 0, 0, 127);
imagefill($out, 0, 0, $transparent);

// Target ink tone: Deep Forest Green (#234B35 -> R: 35, G: 75, B: 53)
$ink_r = 35;
$ink_g = 75;
$ink_b = 53;

$paper_white = 248;

$feather_left = 200;
$feather_top = 150;
$feather_right = 90;
$feather_bottom = 45;

for ($y = 0; $y < $h; $y++) {
    $fade_y = 1.0;
    if ($y < $feather_top) {
        $t = $y / (float)$feather_top;
        $fade_y = pow(sin($t * M_PI / 2), 2);
    } elseif ($y > ($h - $feather_bottom)) {
        $t = ($h - $y) / (float)$feather_bottom;
        $fade_y = pow(sin($t * M_PI / 2), 2);
    }

    for ($x = 0; $x < $w; $x++) {
        $fade_x = 1.0;
        if ($x < $feather_left) {
            $t = $x / (float)$feather_left;
            $fade_x = pow(sin($t * M_PI / 2), 2);
        } elseif ($x > ($w - $feather_right)) {
            $t = ($w - $x) / (float)$feather_right;
            $fade_x = pow(sin($t * M_PI / 2), 2);
        }

        $edge_factor = $fade_x * $fade_y;

        $rgb = imagecolorsforindex($im, imagecolorat($im, $x, $y));
        $gray = ($rgb['red'] + $rgb['green'] + $rgb['blue']) / 3;
        
        $ink_intensity = max(0, $paper_white - $gray);
        
        if ($ink_intensity < 8 || $edge_factor < 0.005) {
            imagesetpixel($out, $x, $y, $transparent);
        } else {
            $alpha_factor = min(1.0, pow(($ink_intensity - 5) / 130.0, 0.9));
            $alpha_factor = min(1.0, $alpha_factor * 1.25);
            $alpha_factor = $alpha_factor * $edge_factor;
            
            $gd_alpha = (int)(127 - ($alpha_factor * 127));
            $gd_alpha = max(0, min(127, $gd_alpha));
            
            $pixel = imagecolorallocatealpha($out, $ink_r, $ink_g, $ink_b, $gd_alpha);
            imagesetpixel($out, $x, $y, $pixel);
        }
    }
}

imagepng($out, 'public/assets/images/kanha-meadow-wildlife-etching.png', 9);
imagedestroy($out);
imagedestroy($im);
echo "Successfully updated public/assets/images/kanha-meadow-wildlife-etching.png\n";
