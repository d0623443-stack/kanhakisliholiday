<?php
function testGet($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    $html = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $isLogin = strpos($html, 'Admin Login') !== false ? 'YES' : 'NO';
    $isHome = strpos($html, 'Discover the wild') !== false ? 'YES' : 'NO';
    echo "$url => Code: $code, hasLogin: $isLogin, hasHome: $isHome\n";
}

echo "Testing GET requests:\n";
testGet('http://localhost:8080/admin/login');
testGet('http://localhost/kanhakisliholiday/public/admin/login');
testGet('http://localhost/kanhakisliholiday/admin/login');
testGet('http://localhost/kanhakisliholiday/admin');
testGet('http://localhost/kanhakisliholiday/');
