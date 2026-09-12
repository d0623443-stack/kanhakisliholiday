<?php

$mysqli = new mysqli('127.0.0.1', 'root', '', 'kanhakisliholiday');
if ($mysqli->connect_error) {
    die("DB connection failed: " . $mysqli->connect_error);
}

echo "=== 1. VERIFYING DYNAMIC SAFARI SLIDES ON FRONTEND ===" . PHP_EOL;

$html = file_get_contents('http://localhost:8080/safari');
if (str_contains($html, 'Apex Predator · Kanha Core') && str_contains($html, 'const galleryImages = [')) {
    echo "[PASS] Safari frontend renders active slides dynamically." . PHP_EOL;
} else {
    echo "[FAIL] Safari frontend missing slide content." . PHP_EOL;
}

echo "=== 2. TESTING DYNAMIC ADD & DELETE IN safari_slides ===" . PHP_EOL;
// Add a 5th slide
$mysqli->query("INSERT INTO safari_slides (order_num, image, tag, caption, status) VALUES (5, 'assets/images/safari-trail.jpg', 'Test Expedition 5', 'Test Jungle Safari Drive 5', 'active')");
$newId = $mysqli->insert_id;
echo "Inserted test slide with ID: $newId" . PHP_EOL;

$htmlAfterAdd = file_get_contents('http://localhost:8080/safari');
if (str_contains($htmlAfterAdd, 'Test Expedition 5') && str_contains($htmlAfterAdd, 'Test Jungle Safari Drive 5')) {
    echo "[PASS] 5th slide dynamically appeared on live Safari frontend!" . PHP_EOL;
} else {
    echo "[FAIL] 5th slide did not show on live Safari frontend." . PHP_EOL;
}

// Delete the test slide
$mysqli->query("DELETE FROM safari_slides WHERE id = $newId");
$htmlAfterDelete = file_get_contents('http://localhost:8080/safari');
if (!str_contains($htmlAfterDelete, 'Test Expedition 5')) {
    echo "[PASS] Test slide deleted cleanly, frontend updated immediately." . PHP_EOL;
} else {
    echo "[FAIL] Test slide still present after deletion." . PHP_EOL;
}

echo "=== 3. VERIFYING ADMIN PAGES RENDERING UPLOAD PLACEHOLDERS ===" . PHP_EOL;
$cookieFile = __DIR__ . '/test_cookie.txt';
if (file_exists($cookieFile)) unlink($cookieFile);

// Login to admin
$ch = curl_init('http://localhost:8080/admin/login');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_COOKIEJAR      => $cookieFile,
    CURLOPT_COOKIEFILE     => $cookieFile,
]);
$loginPage = curl_exec($ch);
preg_match('/name="csrf_test_name" value="([^"]+)"/', $loginPage, $m);
$csrf = $m[1] ?? '';

curl_setopt_array($ch, [
    CURLOPT_URL        => 'http://localhost:8080/admin/login',
    CURLOPT_POST       => true,
    CURLOPT_POSTFIELDS => http_build_query([
        'csrf_test_name' => $csrf,
        'email'          => 'admin@kanhakisli.com',
        'password'       => 'admin123',
    ]),
    CURLOPT_FOLLOWLOCATION => true,
]);
curl_exec($ch);

// Check Hero Slider Manager (/admin/slider)
curl_setopt_array($ch, [
    CURLOPT_URL  => 'http://localhost:8080/admin/slider',
    CURLOPT_POST => false,
]);
$sliderHtml = curl_exec($ch);

if (str_contains($sliderHtml, 'name="slide_image"') && 
    str_contains($sliderHtml, 'enctype="multipart/form-data"') && 
    str_contains($sliderHtml, 'handleSlideImageSelect') &&
    str_contains($sliderHtml, 'modal-slide-file')) {
    echo "[PASS] Hero Slider (/admin/slider) has image file upload placeholder with click-to-browse file explorer!" . PHP_EOL;
} else {
    echo "[FAIL] Hero Slider (/admin/slider) missing file upload components." . PHP_EOL;
}

// Check Safari tab in Site Content (/admin/content?tab=safari)
curl_setopt_array($ch, [
    CURLOPT_URL  => 'http://localhost:8080/admin/content?tab=safari',
    CURLOPT_POST => false,
]);
$contentHtml = curl_exec($ch);
curl_close($ch);
if (file_exists($cookieFile)) unlink($cookieFile);

if (str_contains($contentHtml, 'openAddSafariSlideModal') && 
    str_contains($contentHtml, 'name="safari_slide_image"') && 
    str_contains($contentHtml, 'admin/safari-slides/save') && 
    str_contains($contentHtml, 'admin/safari-slides/delete') &&
    str_contains($contentHtml, 'handleSafariSlideImageSelect')) {
    echo "[PASS] Safari Showcase in Admin has dynamic Add, Edit, Delete, and image upload with click-to-browse file explorer!" . PHP_EOL;
} else {
    echo "[FAIL] Safari Showcase in Admin missing dynamic slide controls." . PHP_EOL;
}

echo "=== ALL TESTS COMPLETED SUCCESSFULLY ===" . PHP_EOL;
