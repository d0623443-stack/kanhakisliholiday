<?php
$urls = [
    'http://localhost/kanhakisliholiday/',
    'http://localhost/kanhakisliholiday/admin',
    'http://localhost/kanhakisliholiday/admin/login',
    'http://localhost/kanhakisliholiday/login',
    'http://localhost/kanhakisliholiday/public/',
    'http://localhost/kanhakisliholiday/public/index.php/admin/login',
    'http://localhost/kanhakisliholiday/public/admin/login',
    'http://localhost/kanhakisliholiday/public/admin',
];

foreach ($urls as $u) {
    $ch = curl_init($u);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    echo "$u => HTTP $code\n";
}
