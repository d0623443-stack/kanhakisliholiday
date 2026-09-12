<?php
$ch = curl_init('http://localhost:8080/admin/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_HEADER, true);
$res = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$err = curl_error($ch);
curl_close($ch);
echo "Port 8080 /admin/login: HTTP $code, Err: $err\n";
echo "Response snippet:\n" . substr($res, 0, 500) . "\n";
