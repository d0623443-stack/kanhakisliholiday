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

for ($y = 0; $y < $h; $y++) {
    for ($x = 0; $x < $w; $x++) {
        $rgb = imagecolorsforindex($im, imagecolorat($im, $x, $y));
        $gray = ($rgb['red'] + $rgb['green'] + $rgb['blue']) / 3;
        
        $ink_intensity = max(0, $paper_white - $gray);
        
        if ($ink_intensity < 8) {
            imagesetpixel($out, $x, $y, $transparent);
        } else {
            // Smooth alpha curve for rich engraving contrast
            $alpha_factor = min(1.0, pow(($ink_intensity - 5) / 130.0, 0.9));
            $alpha_factor = min(1.0, $alpha_factor * 1.25);
            
            $gd_alpha = (int)(127 - ($alpha_factor * 127));
            $gd_alpha = max(0, min(127, $gd_alpha));
            
            $pixel = imagecolorallocatealpha($out, $ink_r, $ink_g, $ink_b, $gd_alpha);
            imagesetpixel($out, $x, $y, $pixel);
        }
    }
}

imagepng($out, 'c:/xampp8.2/htdocs/kanhakisliholiday/public/assets/images/kanha-meadow-wildlife-etching.png', 9);
imagedestroy($out);
imagedestroy($im);
echo "Successfully created public/assets/images/kanha-meadow-wildlife-etching.png\n";
