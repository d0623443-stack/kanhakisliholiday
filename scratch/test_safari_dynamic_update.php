<?php
$mysqli = new mysqli('127.0.0.1', 'root', '', 'kanhakisliholiday');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// 1. Check current title
$res = $mysqli->query("SELECT content_value FROM site_content WHERE page_key='safari' AND content_key='hero_title'");
$row = $res->fetch_assoc();
$originalTitle = $row['content_value'] ?? 'Into the Heart of the Wild';
echo "Original title: $originalTitle" . PHP_EOL;

// 2. Set to test value
$testTitle = 'Into the Heart of the Wild [DYNAMIC-TEST]';
$stmt = $mysqli->prepare("UPDATE site_content SET content_value=? WHERE page_key='safari' AND content_key='hero_title'");
$stmt->bind_param('s', $testTitle);
$stmt->execute();

// 3. Fetch rendered page
$html = file_get_contents('http://localhost:8080/safari');
if (str_contains($html, $testTitle)) {
    echo "[PASS] Dynamic update confirmed! Rendered page reflected updated hero_title." . PHP_EOL;
} else {
    echo "[FAIL] Rendered page did not show test title." . PHP_EOL;
}

// 4. Restore original title
$stmt->bind_param('s', $originalTitle);
$stmt->execute();

// 5. Fetch rendered page to verify restoration
$htmlRestored = file_get_contents('http://localhost:8080/safari');
if (str_contains($htmlRestored, $originalTitle) && !str_contains($htmlRestored, $testTitle)) {
    echo "[PASS] Restored original title successfully!" . PHP_EOL;
} else {
    echo "[FAIL] Could not restore original title cleanly." . PHP_EOL;
}
