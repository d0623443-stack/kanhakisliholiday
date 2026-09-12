<?php

$mysqli = new mysqli('127.0.0.1', 'root', '', 'kanhakisliholiday');
if ($mysqli->connect_error) {
    die("Connection error: " . $mysqli->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS `safari_slides` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `order_num` INT(11) DEFAULT 1,
    `image` VARCHAR(255) NOT NULL,
    `tag` VARCHAR(100) DEFAULT NULL,
    `caption` VARCHAR(255) NOT NULL,
    `status` ENUM('active','inactive') DEFAULT 'active',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$mysqli->query($sql);
echo "Table safari_slides created or verified." . PHP_EOL;

// Check if any slides exist
$res = $mysqli->query("SELECT COUNT(*) as cnt FROM safari_slides");
$count = (int)$res->fetch_assoc()['cnt'];

if ($count === 0) {
    $seedSlides = [
        [1, 'assets/images/tiger-kanha-reserve.jpg', 'Apex Predator · Kanha Core', 'Royal Bengal Tiger (Panthera tigris)', 'active'],
        [2, 'assets/images/barasingha-kanha.jpg', 'State Animal of MP · Exclusive to Kanha', 'Hardground Barasingha (Rucervus duvaucelii branderi)', 'active'],
        [3, 'assets/images/hero-safari-trail.jpg', 'Naturalist-Guided · 4x4 Expedition', 'Open 4x4 Gypsy Drives in Dense Sal Forest', 'active'],
        [4, 'assets/images/indian-roller.jpg', 'Avian Diversity · 300+ Species', 'Indian Roller (Coracias benghalensis)', 'active'],
    ];

    $stmt = $mysqli->prepare("INSERT INTO safari_slides (order_num, image, tag, caption, status) VALUES (?, ?, ?, ?, ?)");
    foreach ($seedSlides as $s) {
        $stmt->bind_param('issss', $s[0], $s[1], $s[2], $s[3], $s[4]);
        $stmt->execute();
    }
    echo "Seeded 4 initial safari slides." . PHP_EOL;
} else {
    echo "safari_slides already has $count slides." . PHP_EOL;
}
