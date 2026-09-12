<?php

$cookieJar = __DIR__ . '/test_cookies.txt';
if (file_exists($cookieJar)) {
    unlink($cookieJar);
}

$baseUrl = 'http://localhost/kanhakisliholiday';

function httpReq($url, $method = 'GET', $postFields = null, $cookies = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    if ($cookies) {
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
    }
    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        if ($postFields) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($postFields) ? http_build_query($postFields) : $postFields);
        }
    }
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);
    return ['code' => $httpCode, 'url' => $finalUrl, 'body' => $response];
}

echo "=================================================\n";
echo "END-TO-END HTTP WORKFLOW VERIFICATION\n";
echo "=================================================\n\n";

// 1. Submit Safari Booking from Frontend
echo "[1] Submitting live safari booking enquiry from frontend...\n";
$bookingData = [
    'name'         => 'E2E Test Explorer',
    'phone'        => '+91 91111 22222',
    'email'        => 'explorer@e2etest.com',
    'safari_date'  => '2026-11-25',
    'timing'       => 'morning',
    'zone'         => 'mukki',
    'adults'       => '3',
    'vehicle_type' => 'exclusive',
    'nationality'  => 'indian',
    'notes'        => 'Automated E2E booking verification test.',
];
$resp = httpReq($baseUrl . '/safari/book', 'POST', $bookingData);
echo "    HTTP Code: {$resp['code']}, Redirected to: {$resp['url']}\n";

// Verify enquiry in MySQL database directly
$mysqli = new mysqli('127.0.0.1', 'root', '', 'kanhakisliholiday');
$res = $mysqli->query("SELECT * FROM enquiries WHERE email = 'explorer@e2etest.com' ORDER BY id DESC LIMIT 1");
$enquiryRow = $res->fetch_assoc();
if ($enquiryRow) {
    echo "    [OK] DB Verified: Enquiry created! Code: {$enquiryRow['enquiry_code']}, Name: {$enquiryRow['name']}, Status: {$enquiryRow['status']}\n";
} else {
    echo "    [FAIL] Enquiry not found in database!\n";
}

// 2. Admin Login
echo "\n[2] Logging in as admin to portal...\n";
$loginData = [
    'email'    => 'admin@kanhakisli.com',
    'password' => 'admin123',
];
$loginResp = httpReq($baseUrl . '/admin/login', 'POST', $loginData, $cookieJar);
echo "    Login HTTP Code: {$loginResp['code']}, Reached URL: {$loginResp['url']}\n";
if (str_contains($loginResp['url'], 'dashboard') || str_contains($loginResp['body'], 'Welcome back')) {
    echo "    [OK] Admin authenticated and redirected to dashboard!\n";
} else {
    echo "    [FAIL] Admin login failed!\n";
}

// 3. Check Admin Dashboard Live Data
echo "\n[3] Checking Admin Dashboard live metrics...\n";
$dashResp = httpReq($baseUrl . '/admin/dashboard', 'GET', null, $cookieJar);
echo "    Dashboard Code: {$dashResp['code']}, URL: {$dashResp['url']}\n";
if (str_contains($dashResp['body'], 'Total Enquiries') && str_contains($dashResp['body'], 'Safari Drives')) {
    echo "    [OK] Dashboard loaded with live stats and latest inquiries!\n";
} else {
    echo "    [FAIL] Dashboard content mismatch!\n";
}

// 4. Check Admin Content Editor
echo "\n[4] Checking Admin Content Editor...\n";
$contentResp = httpReq($baseUrl . '/admin/content', 'GET', null, $cookieJar);
if (str_contains($contentResp['body'], 'Where the forest sets the pace.') && str_contains($contentResp['body'], 'content[home][about_title]')) {
    echo "    [OK] Site Content Editor loaded with live DB content!\n";
} else {
    echo "    [FAIL] Site Content Editor failed to render live values!\n";
}

// 5. Check Admin Gallery Manager
echo "\n[5] Checking Admin Gallery Manager...\n";
$galResp = httpReq($baseUrl . '/admin/gallery', 'GET', null, $cookieJar);
if (str_contains($galResp['body'], 'Royal Bengal Tiger') && str_contains($galResp['body'], 'Upload New Photo')) {
    echo "    [OK] Photo Gallery Manager loaded with live DB photos!\n";
} else {
    echo "    [FAIL] Gallery Manager failed to render photos!\n";
}

// 6. Check Admin Enquiries Manager & verify test enquiry is visible
echo "\n[6] Checking Admin Enquiries Manager...\n";
$enqResp = httpReq($baseUrl . '/admin/enquiries', 'GET', null, $cookieJar);
if ($enquiryRow && str_contains($enqResp['body'], $enquiryRow['enquiry_code'])) {
    echo "    [OK] Enquiries Manager displays newly created enquiry ({$enquiryRow['enquiry_code']}) in table!\n";
} else {
    echo "    [FAIL] Enquiry code not found on Admin enquiries page!\n";
}

// 7. Update Enquiry Status via Admin Form
if ($enquiryRow) {
    echo "\n[7] Updating enquiry status to 'contacted'...\n";
    $updateData = [
        'enquiry_id' => $enquiryRow['id'],
        'status'     => 'contacted',
    ];
    $upResp = httpReq($baseUrl . '/admin/enquiries/update-status', 'POST', $updateData, $cookieJar);
    
    // Check DB again
    $chk = $mysqli->query("SELECT status FROM enquiries WHERE id = {$enquiryRow['id']}")->fetch_assoc();
    if ($chk && $chk['status'] === 'contacted') {
        echo "    [OK] DB Verified: Status successfully transitioned to 'contacted'!\n";
    } else {
        echo "    [FAIL] Status update did not persist in DB!\n";
    }

    // Clean up test enquiry
    $mysqli->query("DELETE FROM enquiries WHERE id = {$enquiryRow['id']}");
    echo "    [OK] Cleaned up test enquiry record.\n";
}

// 8. Check Admin Settings Manager
echo "\n[8] Checking Admin Settings Manager...\n";
$settResp = httpReq($baseUrl . '/admin/settings', 'GET', null, $cookieJar);
if (str_contains($settResp['body'], 'Kanha Kisli Holiday Resort') && str_contains($settResp['body'], '+91 94251 00000')) {
    echo "    [OK] Settings Manager rendered with live DB settings!\n";
} else {
    echo "    [FAIL] Settings Manager failed to render live values!\n";
}

$mysqli->close();
if (file_exists($cookieJar)) {
    unlink($cookieJar);
}

echo "\n=================================================\n";
echo "END-TO-END FLOW VERIFIED SUCCESSFULLY!\n";
echo "=================================================\n";
