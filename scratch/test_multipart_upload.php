<?php

// Create a small test image in scratch
$testImgPath = __DIR__ . '/test_sample_upload.png';
$im = imagecreatetruecolor(400, 250);
$bg = imagecolorallocate($im, 35, 75, 53); // forest green
$textCol = imagecolorallocate($im, 212, 184, 124); // gold
imagefill($im, 0, 0, $bg);
imagestring($im, 5, 50, 110, "Test Safari Upload", $textCol);
imagepng($im, $testImgPath);
imagedestroy($im);

echo "Created test image: $testImgPath (" . filesize($testImgPath) . " bytes)" . PHP_EOL;

$cookieFile = __DIR__ . '/test_upload_cookie.txt';
if (file_exists($cookieFile)) unlink($cookieFile);

// 1. Login
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

// 2. Fetch Safari tab to get fresh CSRF token
curl_setopt_array($ch, [
    CURLOPT_URL  => 'http://localhost:8080/admin/content?tab=safari',
    CURLOPT_POST => false,
]);
$contentHtml = curl_exec($ch);
preg_match('/name="csrf_test_name" value="([^"]+)"/', $contentHtml, $m2);
$csrf2 = $m2[1] ?? '';

// 3. Post multipart/form-data to admin/safari-slides/save with file
$postData = [
    'csrf_test_name'     => $csrf2,
    'id'                 => '',
    'existing_image'     => 'assets/images/tiger-kanha-reserve.jpg',
    'safari_slide_image' => new CURLFile($testImgPath, 'image/png', 'test_sample_upload.png'),
    'tag'                => 'Real Uploaded Test Tag',
    'caption'            => 'Real Uploaded Test Caption',
    'order_num'          => '10',
    'status'             => 'active',
];

curl_setopt_array($ch, [
    CURLOPT_URL        => 'http://localhost:8080/admin/safari-slides/save',
    CURLOPT_POST       => true,
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_FOLLOWLOCATION => true,
]);
$res = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Check database for new slide
$mysqli = new mysqli('127.0.0.1', 'root', '', 'kanhakisliholiday');
$checkRes = $mysqli->query("SELECT * FROM safari_slides WHERE tag = 'Real Uploaded Test Tag'");
$uploadedSlide = $checkRes->fetch_assoc();

if ($uploadedSlide) {
    echo "[PASS] Slide created in DB with image: " . $uploadedSlide['image'] . PHP_EOL;
    $fullPhysicalPath = __DIR__ . '/../public/' . $uploadedSlide['image'];
    if (file_exists($fullPhysicalPath)) {
        echo "[PASS] File was successfully saved to disk at: " . realpath($fullPhysicalPath) . " (" . filesize($fullPhysicalPath) . " bytes)" . PHP_EOL;
    } else {
        echo "[FAIL] Physical file not found at: " . $fullPhysicalPath . PHP_EOL;
    }

    // Clean up test slide from DB and disk
    $mysqli->query("DELETE FROM safari_slides WHERE id = " . $uploadedSlide['id']);
    if (file_exists($fullPhysicalPath)) unlink($fullPhysicalPath);
    echo "Cleaned up test uploaded slide from DB and disk." . PHP_EOL;
} else {
    echo "[FAIL] Slide was not found in DB." . PHP_EOL;
}

// Clean up
if (file_exists($testImgPath)) unlink($testImgPath);
if (file_exists($cookieFile)) unlink($cookieFile);

echo "=== FILE UPLOAD INTEGRATION TEST COMPLETE ===" . PHP_EOL;
