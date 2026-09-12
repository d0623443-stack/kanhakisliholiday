<?php

$cookieJar = __DIR__ . '/cookie.txt';
$baseUrl = 'http://localhost/kanhakisliholiday';

// Login
$ch = curl_init($baseUrl . '/admin/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieJar);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['email' => 'admin@kanhakisli.com', 'password' => 'admin123']));
curl_exec($ch);
curl_close($ch);

// Fetch slider
$ch = curl_init($baseUrl . '/admin/slider');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieJar);
$html = curl_exec($ch);
curl_close($ch);

file_put_contents(__DIR__ . '/slider_page_output.html', $html);
echo "Saved slider page (" . strlen($html) . " bytes)\n";
