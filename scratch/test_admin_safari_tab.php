<?php
// Simulate logging into admin and visiting /admin/content?tab=safari

$cookieFile = __DIR__ . '/cookie.txt';
if (file_exists($cookieFile)) {
    unlink($cookieFile);
}

// 1. Fetch login page to get CSRF token
$ch = curl_init('http://localhost:8080/admin/login');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_COOKIEJAR      => $cookieFile,
    CURLOPT_COOKIEFILE     => $cookieFile,
]);
$loginPage = curl_exec($ch);

preg_match('/name="csrf_test_name" value="([^"]+)"/', $loginPage, $csrfMatches);
$csrfToken = $csrfMatches[1] ?? '';

// 2. Post login
curl_setopt_array($ch, [
    CURLOPT_URL        => 'http://localhost:8080/admin/login',
    CURLOPT_POST       => true,
    CURLOPT_POSTFIELDS => http_build_query([
        'csrf_test_name' => $csrfToken,
        'email'          => 'admin@kanhakisli.com',
        'password'       => 'admin123',
    ]),
    CURLOPT_FOLLOWLOCATION => true,
]);
$dash = curl_exec($ch);

// 3. Request /admin/content?tab=safari
curl_setopt_array($ch, [
    CURLOPT_URL  => 'http://localhost:8080/admin/content?tab=safari',
    CURLOPT_POST => false,
]);
$safariAdmin = curl_exec($ch);
echo "HTTP code: " . curl_getinfo($ch, CURLINFO_HTTP_CODE) . ", Length: " . strlen($safariAdmin) . PHP_EOL;
echo "First 200 chars: " . substr(strip_tags($safariAdmin), 0, 200) . PHP_EOL;
curl_close($ch);

$sections = [
    'Hero Banner Section'              => 'hero_title',
    'Interactive 4-Photo Showcase'    => 'slide1_img',
    'Overview & Wildlife Haven'        => 'haven_title',
    'Reserve Fast Stats'               => 'stat1_num',
    'Safari Zones & Gates'             => 'kisli_title',
    'Safari Shifts & Timings'          => 'morning_shift_title',
    'Conservation & Eco-Guidelines'    => 'tourism_title',
];

echo "=== ADMIN SAFARI TAB AUDIT ===" . PHP_EOL;
$allFound = true;
foreach ($sections as $name => $field) {
    if (str_contains($safariAdmin, "name=\"content[safari][{$field}]\"")) {
        echo "[PASS] Section '{$name}' input field 'content[safari][{$field}]' found in admin editor." . PHP_EOL;
    } else {
        echo "[FAIL] Field 'content[safari][{$field}]' not found for '{$name}'" . PHP_EOL;
        $allFound = false;
    }
}

if ($allFound) {
    echo "ALL 7 SAFARI SECTIONS CONFIRMED IN ADMIN PANEL!" . PHP_EOL;
} else {
    echo "SOME SECTIONS WERE MISSING IN ADMIN PANEL!" . PHP_EOL;
}
