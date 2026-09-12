<?php

function testUrl($url, $expectedCode = 200, $postData = null, &$cookieJar = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_HEADER, true);
    if ($cookieJar !== null) {
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieJar);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieJar);
    }
    if ($postData !== null) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    }
    $res = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headers = substr($res, 0, $headerSize);
    $body = substr($res, $headerSize);
    curl_close($ch);

    return [
        'code'    => $httpCode,
        'headers' => $headers,
        'body'    => $body,
        'ok'      => ($httpCode === $expectedCode),
    ];
}

$cookieFile = __DIR__ . '/admin_cookie.txt';
if (file_exists($cookieFile)) unlink($cookieFile);

echo "1. Testing GET /admin (should redirect to /admin/login when unauthenticated)...\n";
$t1 = testUrl('http://localhost/kanhakisliholiday/public/admin', 302, null, $cookieFile);
echo "   Status: {$t1['code']} (Expected 302)\n";

echo "2. Testing GET /admin/login (should return 200)...\n";
$t2 = testUrl('http://localhost/kanhakisliholiday/public/admin/login', 200, null, $cookieFile);
echo "   Status: {$t2['code']} (Expected 200) - Contains 'Sign In to Dashboard': " . (strpos($t2['body'], 'Sign In to Dashboard') !== false ? 'YES' : 'NO') . "\n";

echo "3. Testing POST /admin/login with demo credentials (admin@kanhakisli.com / admin123)...\n";
$t3 = testUrl('http://localhost/kanhakisliholiday/public/admin/login', 302, ['email' => 'admin@kanhakisli.com', 'password' => 'admin123'], $cookieFile);
echo "   Status: {$t3['code']} (Expected 302 redirect to dashboard)\n";

echo "4. Testing GET /admin/dashboard (authenticated with session cookie)...\n";
$t4 = testUrl('http://localhost/kanhakisliholiday/public/admin/dashboard', 200, null, $cookieFile);
echo "   Status: {$t4['code']} (Expected 200) - Contains 'Welcome back': " . (strpos($t4['body'], 'Welcome back') !== false ? 'YES' : 'NO') . "\n";

echo "5. Testing GET /admin/slider (authenticated)...\n";
$t5 = testUrl('http://localhost/kanhakisliholiday/public/admin/slider', 200, null, $cookieFile);
echo "   Status: {$t5['code']} (Expected 200) - Contains 'Hero Slider Management': " . (strpos($t5['body'], 'Hero Slider Management') !== false ? 'YES' : 'NO') . "\n";

echo "6. Testing GET /admin/content (authenticated)...\n";
$t6 = testUrl('http://localhost/kanhakisliholiday/public/admin/content', 200, null, $cookieFile);
echo "   Status: {$t6['code']} (Expected 200) - Contains 'Site Content Editor': " . (strpos($t6['body'], 'Site Content Editor') !== false ? 'YES' : 'NO') . "\n";

echo "7. Testing GET /admin/gallery (authenticated)...\n";
$t7 = testUrl('http://localhost/kanhakisliholiday/public/admin/gallery', 200, null, $cookieFile);
echo "   Status: {$t7['code']} (Expected 200) - Contains 'Photo Gallery Management': " . (strpos($t7['body'], 'Photo Gallery Management') !== false ? 'YES' : 'NO') . "\n";

echo "8. Testing GET /admin/enquiries (authenticated)...\n";
$t8 = testUrl('http://localhost/kanhakisliholiday/public/admin/enquiries', 200, null, $cookieFile);
echo "   Status: {$t8['code']} (Expected 200) - Contains 'Guest Enquiries & Safari Leads': " . (strpos($t8['body'], 'Guest Enquiries & Safari Leads') !== false ? 'YES' : 'NO') . "\n";

echo "9. Testing GET /admin/settings (authenticated)...\n";
$t9 = testUrl('http://localhost/kanhakisliholiday/public/admin/settings', 200, null, $cookieFile);
echo "   Status: {$t9['code']} (Expected 200) - Contains 'General Settings': " . (strpos($t9['body'], 'General Settings') !== false ? 'YES' : 'NO') . "\n";

echo "\n10. Testing GET /admin/logout...\n";
$t10 = testUrl('http://localhost/kanhakisliholiday/public/admin/logout', 302, null, $cookieFile);
echo "   Status: {$t10['code']} (Expected 302 redirect to login)\n";

if (file_exists($cookieFile)) unlink($cookieFile);
echo "\nAll test cases executed successfully!\n";
