<?php
$ch = curl_init('http://localhost/kanhakisliholiday/public/index.php/admin/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, true);
$res = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "Direct with index.php: HTTP $code\n";
echo substr($res, 0, 400) . "\n";
