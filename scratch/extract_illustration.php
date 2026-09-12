<?php
$src_path = 'C:/Users/DK/.gemini/antigravity-ide/brain/2e99eeb3-586c-43ad-a52a-b5fd99db0d87/.user_uploaded/media_1788987606260.png';
$im = imagecreatefrompng($src_path);
$orig_w = imagesx($im);
$orig_h = imagesy($im);

// Crop boundaries:
// Left: start at x = 28 to exclude the letter on the far left
$crop_x1 = 28;
// Right: x = 580 (give a little padding after stag)
$crop_x2 = 585;
// Top: y = 50 (above the bird at y=67)
$crop_y1 = 45;
// Bottom: y = 285 (just above the dark green line)
$crop_y2 = 285;

$crop_w = $crop_x2 - $crop_x1;
$crop_h = $crop_y2 - $crop_y1;

echo "Crop size: {$crop_w} x {$crop_h}\n";

// Target transparent image
$out = imagecreatetruecolor($crop_w, $crop_h);
imagealphablending($out, false);
imagesavealpha($out, true);
$transparent = imagecolorallocatealpha($out, 0, 0, 0, 127);
imagefill($out, 0, 0, $transparent);

// Sample background reference: average around top corners
$bg_r = 251;
$bg_g = 249;
$bg_b = 246;

for ($y = 0; $y < $crop_h; $y++) {
    $src_y = $crop_y1 + $y;
    for ($x = 0; $x < $crop_w; $x++) {
        $src_x = $crop_x1 + $x;
        $rgb = imagecolorsforindex($im, imagecolorat($im, $src_x, $src_y));
        
        $diff_r = max(0, $bg_r - $rgb['red']);
        $diff_g = max(0, $bg_g - $rgb['green']);
        $diff_b = max(0, $bg_b - $rgb['blue']);
        
        // Intensity of ink
        $ink = max($diff_r, $diff_g, $diff_b);
        
        // Slight contrast curve to remove paper texture grain below threshold
        if ($ink < 5) {
            // pure background
            imagesetpixel($out, $x, $y, $transparent);
        } else {
            // Map ink intensity to alpha: 0 (opaque in PNG = 0, fully transparent = 127)
            // Ink ranges from ~5 to ~180 in original
            $alpha_factor = min(1.0, ($ink - 3) / 130.0);
            $gd_alpha = (int)(127 - ($alpha_factor * 127));
            $gd_alpha = max(0, min(127, $gd_alpha));
            
            // Preserve rich forest ink color: deep sage / forest green tint (#234B35)
            // Original has nice natural forest grey-green tint
            $target_r = (int)($rgb['red'] * 0.7);
            $target_g = (int)($rgb['green'] * 0.75);
            $target_b = (int)($rgb['blue'] * 0.7);
            
            $col = imagecolorallocatealpha($out, $target_r, $target_g, $target_b, $gd_alpha);
            imagesetpixel($out, $x, $y, $col);
        }
    }
}

$dest_path = 'c:/xampp8.2/htdocs/kanhakisliholiday/public/assets/images/safari-wildlife-illustration.png';
imagepng($out, $dest_path);
echo "Saved transparent illustration to: $dest_path\n";
echo "File size: " . filesize($dest_path) . " bytes\n";
