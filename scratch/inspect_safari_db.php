<?php

$mysqli = new mysqli('127.0.0.1', 'root', '', 'kanhakisliholiday');
$res = $mysqli->query("SELECT section_key, content_key, content_value FROM site_content WHERE page_key = 'safari'");
echo "Existing safari keys:\n";
while ($r = $res->fetch_assoc()) {
    echo "  [{$r['section_key']}] {$r['content_key']} => " . substr($r['content_value'], 0, 45) . "...\n";
}
