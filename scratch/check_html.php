<?php
$html = file_get_contents('http://localhost/kanhakisliholiday/public/');
echo "HTML length: " . strlen($html) . "\n";
echo "botanical-etching-blend present: " . (strpos($html, 'botanical-etching-blend') !== false ? 'YES' : 'NO') . "\n";
echo "cta-etching-blend present: " . (strpos($html, 'cta-etching-blend') !== false ? 'YES' : 'NO') . "\n";
echo "kanha-meadow-wildlife-etching.png present: " . (strpos($html, 'kanha-meadow-wildlife-etching.png') !== false ? 'YES' : 'NO') . "\n";
