<?php
$html = file_get_contents('http://localhost/kanhakisliholiday/');
echo "Length: " . strlen($html) . "\n";
echo "First 500 chars:\n" . substr($html, 0, 500) . "\n";
