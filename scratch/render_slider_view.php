<?php

define('FCPATH', 'c:/xampp8.2/htdocs/kanhakisliholiday/public/');
chdir(FCPATH);
define('ENVIRONMENT', 'development');
define('CI_DEBUG', true);

require 'c:/xampp8.2/htdocs/kanhakisliholiday/app/Config/Paths.php';
$paths = new Config\Paths();
require $paths->systemDirectory . '/Boot.php';
CodeIgniter\Boot::bootConsole($paths);

$sliderModel = new App\Models\SliderModel();
$rawSlides = $sliderModel->getAllSlides();
$slides = [];
foreach ($rawSlides as $s) {
    $slides[] = array_merge($s, ['order' => $s['order_num']]);
}
$data = [
    'metaTitle' => 'Hero Slider Manager',
    'activeNav' => 'slider',
    'slides' => $slides,
    'pageHeading' => 'Hero Slider',
    'adminName' => 'Rajesh Sharma',
    'adminRole' => 'Super Administrator',
];
file_put_contents(__DIR__ . '/rendered_slider.html', view('admin/slider', $data));
echo "RENDERED SUCCESSFULLY\n";
