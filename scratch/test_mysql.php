<?php
$attempts = [
    ['host' => 'localhost', 'user' => 'root', 'pass' => ''],
    ['host' => '127.0.0.1', 'user' => 'root', 'pass' => ''],
    ['host' => 'localhost', 'user' => 'root', 'pass' => 'root'],
    ['host' => '127.0.0.1', 'user' => 'root', 'pass' => 'root'],
];

foreach ($attempts as $a) {
    try {
        $mysqli = new mysqli($a['host'], $a['user'], $a['pass']);
        if ($mysqli->connect_error) {
            echo "Failed {$a['host']} pass '{$a['pass']}': " . $mysqli->connect_error . "\n";
        } else {
            echo "SUCCESS connected to MySQL with host={$a['host']}, user={$a['user']}, pass='{$a['pass']}'\n";
            $res = $mysqli->query("SHOW DATABASES");
            $dbs = [];
            while ($row = $res->fetch_row()) {
                $dbs[] = $row[0];
            }
            echo "Existing databases: " . implode(', ', $dbs) . "\n";
            $mysqli->close();
            break;
        }
    } catch (\Throwable $e) {
        echo "Exception on {$a['host']}: " . $e->getMessage() . "\n";
    }
}
