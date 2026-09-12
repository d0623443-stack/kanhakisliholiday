<?php
define('FCPATH', __DIR__ . '/../public/');
chdir(__DIR__ . '/../');
require 'app/Config/Paths.php';
$paths = new Config\Paths();
require 'system/bootstrap.php';

$db = \Config\Database::connect();
echo "CI4 DB Connected: " . $db->getDatabase() . "\n";
echo "Tables found: " . implode(', ', $db->listTables()) . "\n";

foreach ($db->listTables() as $table) {
    $count = $db->table($table)->countAllResults();
    echo " - $table: $count rows\n";
}
