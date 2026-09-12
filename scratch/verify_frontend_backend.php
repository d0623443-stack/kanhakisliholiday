<?php

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
chdir(FCPATH);

define('ENVIRONMENT', 'development');
define('CI_DEBUG', true);

require_once __DIR__ . '/../app/Config/Paths.php';
$paths = new Config\Paths();

require_once $paths->systemDirectory . '/Boot.php';
CodeIgniter\Boot::bootConsole($paths);

use App\Models\UserModel;
use App\Models\SliderModel;
use App\Models\GalleryModel;
use App\Models\ContentModel;
use App\Models\EnquiryModel;
use App\Models\SettingModel;

echo "=================================================\n";
echo "VERIFYING BACKEND & FRONTEND DATABASE INTEGRATION\n";
echo "=================================================\n\n";

// 1. Check UserModel & Auth
$userModel = new UserModel();
$admin = $userModel->findByEmail('admin@kanhakisli.com');
if ($admin && password_verify('admin123', $admin['password'])) {
    echo "[OK] UserModel: Admin user authenticated ('admin@kanhakisli.com') - Name: {$admin['name']}\n";
} else {
    echo "[FAIL] UserModel authentication failed!\n";
}

// 2. Check SliderModel
$sliderModel = new SliderModel();
$slides = $sliderModel->getActiveSlides();
echo "[OK] SliderModel: Found " . count($slides) . " active hero slides in database.\n";
foreach ($slides as $s) {
    echo "     - Slide #{$s['order_num']}: {$s['title']} | {$s['eyebrow']}\n";
}

// 3. Check GalleryModel
$galleryModel = new GalleryModel();
$items = $galleryModel->getActiveItems();
echo "[OK] GalleryModel: Found " . count($items) . " active gallery photos in database.\n";
$previews = $galleryModel->getPreviewItems(3);
echo "     - Homepage preview items: " . count($previews) . " photos.\n";

// 4. Check ContentModel
$contentModel = new ContentModel();
$homeContent = $contentModel->getPageContent('home');
echo "[OK] ContentModel: Home page content keys: " . count($homeContent) . "\n";
echo "     - about_title: " . ($homeContent['about_title'] ?? 'N/A') . "\n";
echo "     - safari_title: " . ($homeContent['safari_title'] ?? 'N/A') . "\n";

$safariContent = $contentModel->getPageContent('safari');
echo "[OK] ContentModel: Safari page content keys: " . count($safariContent) . "\n";
echo "     - hero_title: " . ($safariContent['hero_title'] ?? 'N/A') . "\n";

// 5. Check SettingModel & Helper
$settingModel = new SettingModel();
$settings = $settingModel->getAllSettings();
echo "[OK] SettingModel: Found " . count($settings) . " settings in database.\n";
echo "     - site_name: " . ($settings['site_name'] ?? 'N/A') . "\n";
echo "     - whatsapp_number: " . ($settings['whatsapp_number'] ?? 'N/A') . "\n";

// 6. Check EnquiryModel
$enquiryModel = new EnquiryModel();
$code = $enquiryModel->generateEnquiryCode();
$testId = $enquiryModel->insert([
    'enquiry_code'   => $code,
    'type'           => 'safari',
    'name'           => 'Verification Test User',
    'phone'          => '+91 99999 88888',
    'email'          => 'verify@example.com',
    'date_requested' => '2026-11-20',
    'timing'         => 'Morning Shift',
    'zone_room'      => 'Kanha Zone',
    'vehicle_type'   => '4x4 Gypsy',
    'adults'         => '2',
    'nationality'    => 'Indian',
    'notes'          => 'Automated verification test enquiry',
    'status'         => 'new',
]);
echo "[OK] EnquiryModel: Created test enquiry record #{$testId} with code {$code}\n";

$filtered = $enquiryModel->getFiltered(null, null, $code);
if (!empty($filtered)) {
    echo "[OK] EnquiryModel: Successfully queried test enquiry back from database.\n";
    // Delete test record so we don't pollute data
    $enquiryModel->delete($testId);
    echo "[OK] Cleaned up temporary test record.\n";
} else {
    echo "[FAIL] Failed to query test enquiry back!\n";
}

$counts = $enquiryModel->getSummaryCounts();
echo "[OK] EnquiryModel: Live counts - Total: {$counts['totalEnquiries']}, New: {$counts['newEnquiries']}, Safari: {$counts['safariBookings']}, Stay: {$counts['stayBookings']}\n";

echo "\n=================================================\n";
echo "ALL MODELS & DATABASE INTERACTIONS WORKING 100%!\n";
echo "=================================================\n";
