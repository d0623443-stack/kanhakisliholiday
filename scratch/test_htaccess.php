<?php
// Let's test modifying public/.htaccess temporarily
$orig = file_get_contents('public/.htaccess');

// Test 1: RewriteRule ^ index.php [L]
$test1 = str_replace(
    'RewriteRule ^([\s\S]*)$ index.php/$1 [L,NC,QSA]',
    'RewriteRule ^ index.php [L]',
    $orig
);
file_put_contents('public/.htaccess', $test1);

$ch = curl_init('http://localhost/kanhakisliholiday/public/admin/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, true);
$res1 = curl_exec($ch);
$code1 = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "Test 1 (RewriteRule ^ index.php [L]): HTTP $code1\n";

// Test 2: With RewriteRule ^(.*)$ index.php?/$1 [L]
$test2 = str_replace(
    'RewriteRule ^([\s\S]*)$ index.php/$1 [L,NC,QSA]',
    'RewriteRule ^(.*)$ index.php?/$1 [L]',
    $orig
);
file_put_contents('public/.htaccess', $test2);

$ch = curl_init('http://localhost/kanhakisliholiday/public/admin/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, true);
$res2 = curl_exec($ch);
$code2 = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "Test 2 (RewriteRule ^(.*)$ index.php?/$1 [L]): HTTP $code2\n";

// Restore original
file_put_contents('public/.htaccess', $orig);
