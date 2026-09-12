<?php
$src_path = 'C:/Users/DK/.gemini/antigravity-ide/brain/2e99eeb3-586c-43ad-a52a-b5fd99db0d87/.user_uploaded/media_1788987606260.png';
$im = imagecreatefrompng($src_path);

$crop_x1 = 28;
$crop_x2 = 585;
$crop_y1 = 45;
$crop_y2 = 285;

$crop_w = $crop_x2 - $crop_x1;
$crop_h = $crop_y2 - $crop_y1;

// 2x Hi-DPI resolution for crispness on modern displays
$scale = 2;
$out_w = $crop_w * $scale;
$out_h = $crop_h * $scale;

$out = imagecreatetruecolor($out_w, $out_h);
imagealphablending($out, false);
imagesavealpha($out, true);
$transparent = imagecolorallocatealpha($out, 0, 0, 0, 127);
imagefill($out, 0, 0, $transparent);

// Resample cropped source into 2x
$crop_im = imagecreatetruecolor($crop_w, $crop_h);
imagecopy($crop_im, $im, 0, 0, $crop_x1, $crop_y1, $crop_w, $crop_h);

$resampled = imagecreatetruecolor($out_w, $out_h);
imagecopyresampled($resampled, $crop_im, 0, 0, 0, 0, $out_w, $out_h, $crop_w, $crop_h);

$bg_r = 251;
$bg_g = 249;
$bg_b = 246;

// Target ink tone: Deep Forest Green (#234B35 -> 35, 75, 53)
$ink_r = 35;
$ink_g = 75;
$ink_b = 53;

for ($y = 0; $y < $out_h; $y++) {
    for ($x = 0; $x < $out_w; $x++) {
        $rgb = imagecolorsforindex($resampled, imagecolorat($resampled, $x, $y));
        
        $diff_r = max(0, $bg_r - $rgb['red']);
        $diff_g = max(0, $bg_g - $rgb['green']);
        $diff_b = max(0, $bg_b - $rgb['blue']);
        
        $ink = max($diff_r, $diff_g, $diff_b);
        
        // Slightly sharpen cutoff so faint compression artifacts are removed
        if ($ink < 4) {
            imagesetpixel($out, $x, $y, $transparent);
        } else {
            // Enhanced curve for rich contrast and visible clarity
            $alpha_factor = min(1.0, pow(($ink - 2) / 100.0, 0.85));
            $alpha_factor = min(1.0, $alpha_factor * 1.15);
            
            $gd_alpha = (int)(127 - ($alpha_factor * 127));
            $gd_alpha = max(0, min(127, $gd_alpha));
            
            // Mix original natural tonal variation with deep forest green
            $tone_factor = min(1.0, $ink / 90.0);
            $pix_r = (int)($ink_r * $tone_factor + 40 * (1 - $tone_factor));
            $pix_g = (int)($ink_g * $tone_factor + 70 * (1 - $tone_factor));
            $pix_b = (int)($ink_b * $tone_factor + 50 * (1 - $tone_factor));
            
            $col = imagecolorallocatealpha($out, $pix_r, $pix_g, $pix_b, $gd_alpha);
            imagesetpixel($out, $x, $y, $col);
        }
    }
}

$dest_path = 'c:/xampp8.2/htdocs/kanhakisliholiday/public/assets/images/safari-wildlife-illustration.png';
imagepng($out, $dest_path, 9);
echo "Saved high-res 2x illustration ({$out_w}x{$out_h}) to: $dest_path\n";
echo "File size: " . filesize($dest_path) . " bytes\n";
