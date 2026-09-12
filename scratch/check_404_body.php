<?php
$html = file_get_contents('http://localhost:8080/admin/login');
echo "8080 content:\n" . substr($html, 0, 1000) . "\n";
