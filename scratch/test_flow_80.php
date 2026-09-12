<?php
$cookieFile = __DIR__ . '/test_cookie_80.txt';
if (file_exists($cookieFile)) unlink($cookieFile);

// 1. GET login page
$ch = curl_init('http://localhost/kanhakisliholiday/admin/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
$loginHtml = curl_exec($ch);
curl_close($ch);

// 2. POST login credentials
$ch = curl_init('http://localhost/kanhakisliholiday/admin/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'email'    => 'admin@kanhakisli.com',
    'password' => 'admin123',
]));
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, true);
$res = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "POST login response code: $code\n";

// 3. GET dashboard with session
$ch = curl_init('http://localhost/kanhakisliholiday/admin/dashboard');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
$dashHtml = curl_exec($ch);
$dashCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Dashboard status code: $dashCode\n";
echo "Has 'Welcome back, Rajesh Sharma': " . (strpos($dashHtml, 'Welcome back, Rajesh Sharma') !== false ? 'YES' : 'NO') . "\n";
echo "Has 'Hero Slider Management' link: " . (strpos($dashHtml, 'admin/slider') !== false ? 'YES' : 'NO') . "\n";
echo "Has 'Recent Guest Enquiries': " . (strpos($dashHtml, 'Recent Guest Enquiries') !== false ? 'YES' : 'NO') . "\n";

if (file_exists($cookieFile)) unlink($cookieFile);
