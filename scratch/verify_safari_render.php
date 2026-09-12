<?php

$html = file_get_contents('http://localhost:8080/safari');

$checks = [
    'Hero Title'   => 'Into the Heart of the Wild',
    'Haven Title'  => 'A Wildlife Haven &amp; Ancient Sal Sanctuary', // html escaped & or plain
    'Kisli Gate'   => 'Khatia Gate',
    'Barasingha'   => 'Hardground Barasingha',
    'Tourism'      => 'Responsible Wildlife Tourism',
    'Gallery JS'   => 'const galleryImages = [',
    'Image 1'      => 'tiger-kanha-reserve.jpg',
    'Image 2'      => 'barasingha-kanha.jpg',
    'Image 3'      => 'hero-safari-trail.jpg',
    'Image 4'      => 'indian-roller.jpg',
];

echo "=== SAFARI PAGE VERIFICATION ===" . PHP_EOL;
$allPass = true;
foreach ($checks as $name => $str) {
    if (str_contains($html, $str) || str_contains($html, htmlspecialchars($str))) {
        echo "[PASS] $name found" . PHP_EOL;
    } else {
        echo "[FAIL] $name NOT found ($str)" . PHP_EOL;
        $allPass = false;
    }
}

if ($allPass) {
    echo "ALL SAFARI CHECKS PASSED!" . PHP_EOL;
} else {
    echo "SOME CHECKS FAILED!" . PHP_EOL;
}
