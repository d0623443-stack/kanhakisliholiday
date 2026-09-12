<?php
$urls = [
    'http://localhost/kanhakisliholiday/',
    'http://localhost/kanhakisliholiday/admin',
    'http://localhost/kanhakisliholiday/admin/login',
    'http://localhost/kanhakisliholiday/public/admin/login',
    'http://localhost/kanhakisliholiday/safari',
    'http://localhost/kanhakisliholiday/accommodation',
    'http://localhost/kanhakisliholiday/gallery',
    'http://localhost/kanhakisliholiday/contact',
    'http://localhost:8080/',
    'http://localhost:8080/admin/login',
    'http://localhost:8080/admin',
];

foreach ($urls as $u) {
    $ch = curl_init($u);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    $html = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    $hasLogin = strpos($html, 'Sign In to Dashboard') !== false ? 'YES' : 'NO';
    $hasAdminNav = strpos($html, 'Admin Login') !== false ? 'YES' : 'NO';
    $len = strlen($html);
    
    echo sprintf("%-55s => Code: %3d, Size: %5d, hasLoginUI: %s, hasAdminLink: %s\n", $u, $code, $len, $hasLogin, $hasAdminNav);
}
