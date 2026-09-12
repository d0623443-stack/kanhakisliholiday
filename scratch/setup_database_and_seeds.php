<?php
/**
 * Database Initialization and Live Seeder Script for Kanha Kisli Holiday
 * Creates database 'kanhakisliholiday', builds schema, and seeds all live content.
 */

$host = 'localhost';
$user = 'root';
$pass = '';
$dbName = 'kanhakisliholiday';

echo "1. Connecting to MySQL on $host...\n";
$mysqli = new mysqli($host, $user, $pass);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error . "\n");
}

echo "2. Creating database `$dbName` if not exists...\n";
$mysqli->query("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
$mysqli->select_db($dbName);

// -------------------------------------------------------------
// TABLES CREATION
// -------------------------------------------------------------
echo "3. Creating tables...\n";

// 1. Users / Admins Table
$mysqli->query("CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` VARCHAR(50) DEFAULT 'admin',
    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

// 2. Slider Slides Table
$mysqli->query("CREATE TABLE IF NOT EXISTS `slider_slides` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_num` INT DEFAULT 1,
    `eyebrow` VARCHAR(100) NULL,
    `title` VARCHAR(255) NOT NULL,
    `subtitle_italic` VARCHAR(255) NULL,
    `description` TEXT NULL,
    `image` VARCHAR(255) NOT NULL,
    `alt` VARCHAR(255) NULL,
    `btn1_text` VARCHAR(50) NULL,
    `btn1_link` VARCHAR(255) NULL,
    `btn2_text` VARCHAR(50) NULL,
    `btn2_link` VARCHAR(255) NULL,
    `phone_text` VARCHAR(50) NULL,
    `status` ENUM('active', 'inactive') DEFAULT 'active',
    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

// 3. Gallery Items Table
$mysqli->query("CREATE TABLE IF NOT EXISTS `gallery_items` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `category` VARCHAR(50) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `subtitle` VARCHAR(255) NULL,
    `image` VARCHAR(255) NOT NULL,
    `aspect` VARCHAR(50) DEFAULT 'standard',
    `order_num` INT DEFAULT 1,
    `views` INT DEFAULT 0,
    `status` ENUM('active', 'inactive') DEFAULT 'active',
    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

// 4. Site Content Table
$mysqli->query("CREATE TABLE IF NOT EXISTS `site_content` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `page_key` VARCHAR(50) NOT NULL,
    `section_key` VARCHAR(50) NOT NULL,
    `content_key` VARCHAR(100) NOT NULL,
    `content_value` MEDIUMTEXT NULL,
    `updated_at` DATETIME NULL,
    UNIQUE KEY `page_sec_key` (`page_key`, `section_key`, `content_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

// 5. Enquiries Table
$mysqli->query("CREATE TABLE IF NOT EXISTS `enquiries` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `enquiry_code` VARCHAR(50) NOT NULL UNIQUE,
    `type` VARCHAR(30) NOT NULL,
    `name` VARCHAR(150) NOT NULL,
    `phone` VARCHAR(50) NOT NULL,
    `email` VARCHAR(150) NULL,
    `date_requested` VARCHAR(100) NULL,
    `timing` VARCHAR(50) NULL,
    `zone_room` VARCHAR(100) NULL,
    `vehicle_type` VARCHAR(50) NULL,
    `adults` VARCHAR(20) NULL,
    `children` VARCHAR(20) NULL,
    `meal_plan` VARCHAR(50) NULL,
    `nationality` VARCHAR(50) NULL,
    `notes` TEXT NULL,
    `status` ENUM('new', 'contacted', 'confirmed', 'archived') DEFAULT 'new',
    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

// 6. Settings Table
$mysqli->query("CREATE TABLE IF NOT EXISTS `settings` (
    `key_name` VARCHAR(100) PRIMARY KEY,
    `value_content` TEXT NULL,
    `updated_at` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

echo "Tables created successfully.\n";

// -------------------------------------------------------------
// SEEDING DATA
// -------------------------------------------------------------
echo "4. Seeding live data...\n";

// Clear existing records to ensure idempotent clean seed
$mysqli->query("TRUNCATE TABLE `users`");
$mysqli->query("TRUNCATE TABLE `slider_slides`");
$mysqli->query("TRUNCATE TABLE `gallery_items`");
$mysqli->query("TRUNCATE TABLE `site_content`");
$mysqli->query("TRUNCATE TABLE `enquiries`");
$mysqli->query("TRUNCATE TABLE `settings`");

// 1. Seed Admin User
$adminPass = password_hash('admin123', PASSWORD_BCRYPT);
$stmt = $mysqli->prepare("INSERT INTO `users` (`name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, NOW(), NOW())");
$name = 'Rajesh Sharma';
$email = 'admin@kanhakisli.com';
$role = 'General Manager';
$stmt->bind_param('ssss', $name, $email, $adminPass, $role);
$stmt->execute();
echo "-> Admin user seeded.\n";

// 2. Seed Slider Slides
$slides = [
    [
        'order_num'       => 1,
        'eyebrow'         => 'Kanha · Madhya Pradesh',
        'title'           => 'Discover the wild.',
        'subtitle_italic' => 'Feel closer to nature.',
        'description'     => 'Memorable safaris and peaceful stays in the heart of Kanha.',
        'image'           => 'assets/images/slider/1.webp',
        'alt'             => 'Kanha Kisli Holiday Resort pool and forest dining deck',
        'btn1_text'       => 'WhatsApp',
        'btn1_link'       => 'https://wa.me/919425100000?text=Hi%20Kanha%20Kisli%20Holiday,%20I%20would%20like%20to%20inquire%20about%20stay%20and%20safari%20booking',
        'btn2_text'       => 'Call Now',
        'btn2_link'       => 'tel:+919425100000',
        'phone_text'      => '+91 94251 00000',
        'status'          => 'active',
    ],
    [
        'order_num'       => 2,
        'eyebrow'         => 'Heart of Central India',
        'title'           => 'Wild Encounters.',
        'subtitle_italic' => 'Unhurried wilderness moments.',
        'description'     => 'Open Gypsy safari drives and peaceful evenings under sal canopies.',
        'image'           => 'assets/images/slider/2.jpg',
        'alt'             => 'Romantic poolside candlelit dinner with fairy lights at Kanha Kisli Holiday',
        'btn1_text'       => 'WhatsApp',
        'btn1_link'       => 'https://wa.me/919425100000?text=Hi%20Kanha%20Kisli%20Holiday,%20I%20would%20like%20to%20inquire%20about%20stay%20and%20safari%20booking',
        'btn2_text'       => 'Call Now',
        'btn2_link'       => 'tel:+919425100000',
        'phone_text'      => '+91 94251 00000',
        'status'          => 'active',
    ],
];

$stmtSlide = $mysqli->prepare("INSERT INTO `slider_slides` (`order_num`, `eyebrow`, `title`, `subtitle_italic`, `description`, `image`, `alt`, `btn1_text`, `btn1_link`, `btn2_text`, `btn2_link`, `phone_text`, `status`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
foreach ($slides as $s) {
    $stmtSlide->bind_param('issssssssssss', $s['order_num'], $s['eyebrow'], $s['title'], $s['subtitle_italic'], $s['description'], $s['image'], $s['alt'], $s['btn1_text'], $s['btn1_link'], $s['btn2_text'], $s['btn2_link'], $s['phone_text'], $s['status']);
    $stmtSlide->execute();
}
echo "-> Slider slides seeded (" . count($slides) . " slides).\n";

// 3. Seed Gallery Items
$gallery = [
    [
        'category'  => 'wildlife',
        'title'     => 'Royal Bengal Tiger on Forest Trail',
        'subtitle'  => 'Kanha Core Zone',
        'image'     => 'assets/images/tiger-portrait.jpg',
        'aspect'    => 'tall',
        'order_num' => 1,
        'views'     => 1420,
    ],
    [
        'category'  => 'safari',
        'title'     => 'Morning Gypsy Safari in Sal Canopy',
        'subtitle'  => 'Kisli Gate Trails',
        'image'     => 'assets/images/hero-safari-trail.jpg',
        'aspect'    => 'wide',
        'order_num' => 2,
        'views'     => 980,
    ],
    [
        'category'  => 'birdlife',
        'title'     => 'Indian Roller on Forest Branch',
        'subtitle'  => 'Kanha Meadows',
        'image'     => 'assets/images/indian-roller.jpg',
        'aspect'    => 'square',
        'order_num' => 3,
        'views'     => 650,
    ],
    [
        'category'  => 'wildlife',
        'title'     => 'Spotted Deer in Morning Mist',
        'subtitle'  => 'Mukki Grasslands',
        'image'     => 'assets/images/deer-meadow.jpg',
        'aspect'    => 'standard',
        'order_num' => 4,
        'views'     => 820,
    ],
    [
        'category'  => 'stay',
        'title'     => 'Forest Cottages at Dusk',
        'subtitle'  => 'Kanha Kisli Retreat',
        'image'     => 'assets/images/forest-lodge.jpg',
        'aspect'    => 'wide',
        'order_num' => 5,
        'views'     => 1150,
    ],
    [
        'category'  => 'forest',
        'title'     => 'Sunbeams through Ancient Sal Canopy',
        'subtitle'  => 'Kanha Forest Trail',
        'image'     => 'assets/images/safari-trail.jpg',
        'aspect'    => 'tall',
        'order_num' => 6,
        'views'     => 730,
    ],
    [
        'category'  => 'stay',
        'title'     => 'Veranda with Forest Views',
        'subtitle'  => 'Peaceful Mornings',
        'image'     => 'assets/images/lodge-interior.jpg',
        'aspect'    => 'standard',
        'order_num' => 7,
        'views'     => 540,
    ],
    [
        'category'  => 'forest',
        'title'     => 'Golden Kanha Meadows at Sunrise',
        'subtitle'  => 'Sal Forest Perimeter',
        'image'     => 'assets/images/kanha-landscape.jpg',
        'aspect'    => 'wide',
        'order_num' => 8,
        'views'     => 910,
    ],
];

$stmtGal = $mysqli->prepare("INSERT INTO `gallery_items` (`category`, `title`, `subtitle`, `image`, `aspect`, `order_num`, `views`, `status`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?, ?, 'active', NOW(), NOW())");
foreach ($gallery as $g) {
    $stmtGal->bind_param('sssssii', $g['category'], $g['title'], $g['subtitle'], $g['image'], $g['aspect'], $g['order_num'], $g['views']);
    $stmtGal->execute();
}
echo "-> Gallery items seeded (" . count($gallery) . " items).\n";

// 4. Seed Site Content
$contents = [
    // Home Page
    ['home', 'about', 'about_eyebrow', 'About Kanha Kisli Holiday'],
    ['home', 'about', 'about_title', 'Where the forest sets the pace.'],
    ['home', 'about', 'about_desc', 'Discover Kanha through early morning safaris, thoughtful hospitality and unhurried moments in nature. We guide your journeys with respect for the wilderness and personal care for every guest.'],
    ['home', 'about', 'feature1_title', 'Safari assistance'],
    ['home', 'about', 'feature1_desc', 'Guidance for a smooth experience'],
    ['home', 'about', 'feature2_title', 'Personal attention'],
    ['home', 'about', 'feature2_desc', 'A more meaningful journey'],
    ['home', 'safari', 'safari_eyebrow', 'Safari Experiences'],
    ['home', 'safari', 'safari_title', 'Into the heart of Kanha.'],
    ['home', 'safari', 'safari_quote', 'More than a destination. A wilder you.'],
    ['home', 'safari', 'step1_title', 'Follow the forest trails'],
    ['home', 'safari', 'step1_desc', 'Discover the beauty of Kanha with a guided safari through dense sal forests, open meadows, and winding rivers.'],
    ['home', 'safari', 'step2_title', 'Look a little closer'],
    ['home', 'safari', 'step2_desc', 'From birds to deer, every sighting tells a story. Watch for the rare hardground barasingha found nowhere else in the world.'],
    ['home', 'safari', 'step3_title', 'Make it your journey'],
    ['home', 'safari', 'step3_desc', 'Talk to us about your safari plans. We assist with gate permits, gypsy arrangements, and seasoned naturalists.'],
    ['home', 'stay', 'stay_eyebrow', 'Stay Close to the Wild'],
    ['home', 'stay', 'stay_title', 'Rest between the adventures.'],
    ['home', 'stay', 'stay_desc', 'Thoughtful, unhurried hospitality designed to harmonize with the rhythm of the sal forest. Comfortable cottages, tranquil verandas, and warm evening gatherings after a day on the safari trail.'],

    // Safari Page
    ['safari', 'hero', 'hero_title', 'Into the Heart of the Wild'],
    ['safari', 'hero', 'hero_subtitle', 'Open 4x4 Gypsy safaris, certified naturalist guides, and seamless forest permit bookings across Kanha\'s legendary core and buffer zones.'],
    ['safari', 'stats', 'stat1_num', '940+'],
    ['safari', 'stats', 'stat1_label', 'km² Core Area'],
    ['safari', 'stats', 'stat2_num', '100+'],
    ['safari', 'stats', 'stat2_label', 'Wild Tigers'],
    ['safari', 'stats', 'stat3_num', '300+'],
    ['safari', 'stats', 'stat3_label', 'Bird Species'],
    ['safari', 'stats', 'stat4_num', '100%'],
    ['safari', 'stats', 'stat4_label', 'Official Permits'],
    ['safari', 'zones', 'kisli_desc', 'Directly accessible from Khatia Gate. Dense sal canopies, scenic ravines, and frequent sightings of tigers, gaur, and sambar.'],
    ['safari', 'zones', 'kanha_desc', 'The park\'s crown heartland featuring sprawling meadows, historic Shravan Tal lake, and the primary Barasingha herds.'],
    ['safari', 'zones', 'mukki_desc', 'Known for Banjar riverbanks, rich bamboo thickets, tranquil trails, and exceptional photography angles in warm afternoon light.'],
    ['safari', 'zones', 'sarhi_desc', 'Vast dry-deciduous forests, picturesque hills, and serene landscapes frequented by leopards, blue bulls, and birds of prey.'],

    // Accommodation Page
    ['accommodation', 'hero', 'hero_title', 'Rest Between the Adventures'],
    ['accommodation', 'hero', 'hero_subtitle', 'Peaceful, nature-immersed cottages surrounded by ancient Sal trees. Thoughtful comforts, fresh local cuisine, and starlit wilderness evenings.'],
    ['accommodation', 'cottages', 'cottage1_title', 'Forest Cottages'],
    ['accommodation', 'cottages', 'cottage1_price', '₹5,500 / night'],
    ['accommodation', 'cottages', 'cottage1_desc', 'Independent stone and timber cottages surrounded by sal trees, offering private open verandas and modern ensuite baths.'],
    ['accommodation', 'cottages', 'cottage2_title', 'Deluxe Family Veranda Suites'],
    ['accommodation', 'cottages', 'cottage2_price', '₹8,500 / night'],
    ['accommodation', 'cottages', 'cottage2_desc', 'Spacious dual-bedroom family retreat with extended viewing veranda facing the inner garden canopy.'],
    ['accommodation', 'cottages', 'cottage3_title', 'Machan Treehouse Villas'],
    ['accommodation', 'cottages', 'cottage3_price', '₹12,000 / night'],
    ['accommodation', 'cottages', 'cottage3_desc', 'Elevated wooden stilt hideaway nestled directly into the forest canopy with 360-degree wilderness outlooks.'],

    // Contact Page & Global
    ['contact', 'info', 'phone_primary', '+91 94251 00000'],
    ['contact', 'info', 'phone_secondary', '+91 76422 00000'],
    ['contact', 'info', 'whatsapp', '+91 94251 00000'],
    ['contact', 'info', 'email', 'stay@kanhakisliholiday.com'],
    ['contact', 'info', 'address', 'Kanha Kisli Holiday, Near Khatia / Kisli Gate, Mandla District, Madhya Pradesh — 481768, India'],
    ['contact', 'info', 'hours', 'Daily: 08:00 AM – 08:00 PM IST'],
];

$stmtCont = $mysqli->prepare("INSERT INTO `site_content` (`page_key`, `section_key`, `content_key`, `content_value`, `updated_at`) VALUES (?, ?, ?, ?, NOW())");
foreach ($contents as $c) {
    $stmtCont->bind_param('ssss', $c[0], $c[1], $c[2], $c[3]);
    $stmtCont->execute();
}
echo "-> Site content seeded (" . count($contents) . " records).\n";

// 5. Seed Enquiries
$enquiries = [
    [
        'enquiry_code'   => 'ENQ-8821',
        'type'           => 'safari',
        'name'           => 'Vikram Singhania',
        'phone'          => '+91 98201 44552',
        'email'          => 'vikram.s@singhania.in',
        'date_requested' => '2026-10-14',
        'timing'         => 'Morning (06:00 AM)',
        'zone_room'      => 'Kanha Zone (Core)',
        'vehicle_type'   => 'Exclusive 4x4 Gypsy',
        'adults'         => '4',
        'children'       => '0',
        'meal_plan'      => null,
        'nationality'    => 'Indian',
        'notes'          => 'Need senior naturalist for tiger photography and bird tracking. Arriving via Jabalpur.',
        'status'         => 'new',
        'created_at'     => '2026-09-11 11:42:00',
    ],
    [
        'enquiry_code'   => 'ENQ-8820',
        'type'           => 'stay',
        'name'           => 'Dr. Ananya Roy',
        'phone'          => '+91 97110 88231',
        'email'          => 'ananya.roy@aiims.edu',
        'date_requested' => '2026-10-22 to 2026-10-25',
        'timing'         => 'Check-in: 01:00 PM',
        'zone_room'      => 'Deluxe Veranda Suite',
        'vehicle_type'   => 'Resort Transfer',
        'adults'         => '2',
        'children'       => '1',
        'meal_plan'      => 'Breakfast Included',
        'nationality'    => 'Indian',
        'notes'          => 'Family trip with 1 child (8 yrs). Require vegetarian food without onion/garlic.',
        'status'         => 'contacted',
        'created_at'     => '2026-09-11 09:30:00',
    ],
    [
        'enquiry_code'   => 'ENQ-8819',
        'type'           => 'safari',
        'name'           => 'Marcus & Elena Weber',
        'phone'          => '+49 170 5549210',
        'email'          => 'm.weber@berlin-wild.de',
        'date_requested' => '2026-11-02 to 2026-11-06',
        'timing'         => 'Both Shifts (Morning & Afternoon)',
        'zone_room'      => 'Mukki & Kisli (4 Drives)',
        'vehicle_type'   => 'Exclusive 4x4 Gypsy',
        'adults'         => '2',
        'children'       => '0',
        'meal_plan'      => null,
        'nationality'    => 'Foreign',
        'notes'          => 'Wildlife documentary filming. Need permits processed with English speaking senior tracker.',
        'status'         => 'confirmed',
        'created_at'     => '2026-09-11 06:15:00',
    ],
    [
        'enquiry_code'   => 'ENQ-8818',
        'type'           => 'general',
        'name'           => 'Sunil Deshmukh',
        'phone'          => '+91 94221 67890',
        'email'          => 'sunil.deshmukh@nagpur.com',
        'date_requested' => '2026-09-28',
        'timing'         => 'Day Tour',
        'zone_room'      => 'Buffer Zones',
        'vehicle_type'   => 'Own Vehicle + Gypsy',
        'adults'         => '6',
        'children'       => '0',
        'meal_plan'      => null,
        'nationality'    => 'Indian',
        'notes'          => 'Inquiring if buffer gates (Khatia/Khapa) are open during late September.',
        'status'         => 'new',
        'created_at'     => '2026-09-10 16:20:00',
    ],
    [
        'enquiry_code'   => 'ENQ-8817',
        'type'           => 'safari',
        'name'           => 'Pooja Kashyap',
        'phone'          => '+91 98912 34567',
        'email'          => 'pooja.k@delhimedia.com',
        'date_requested' => '2026-10-08',
        'timing'         => 'Morning (06:00 AM)',
        'zone_room'      => 'Sarhi Gate',
        'vehicle_type'   => 'Exclusive 4x4 Gypsy',
        'adults'         => '2',
        'children'       => '0',
        'meal_plan'      => null,
        'nationality'    => 'Indian',
        'notes'          => 'Special wildlife photography permits.',
        'status'         => 'confirmed',
        'created_at'     => '2026-09-09 14:45:00',
    ],
];

$stmtEnq = $mysqli->prepare("INSERT INTO `enquiries` (`enquiry_code`, `type`, `name`, `phone`, `email`, `date_requested`, `timing`, `zone_room`, `vehicle_type`, `adults`, `children`, `meal_plan`, `nationality`, `notes`, `status`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
foreach ($enquiries as $e) {
    $stmtEnq->bind_param('ssssssssssssssss', $e['enquiry_code'], $e['type'], $e['name'], $e['phone'], $e['email'], $e['date_requested'], $e['timing'], $e['zone_room'], $e['vehicle_type'], $e['adults'], $e['children'], $e['meal_plan'], $e['nationality'], $e['notes'], $e['status'], $e['created_at']);
    $stmtEnq->execute();
}
echo "-> Enquiries seeded (" . count($enquiries) . " leads).\n";

// 6. Seed Settings
$settings = [
    'site_name'         => 'Kanha Kisli Holiday Resort',
    'site_tagline'      => 'Discover the wild. Feel closer to nature.',
    'admin_email'       => 'admin@kanhakisli.com',
    'notification_mail' => 'bookings@kanhakisliholiday.com',
    'whatsapp_number'   => '+91 94251 00000',
    'helpline_phone'    => '+91 94251 00000',
    'location_text'     => 'Near Khatia / Kisli Gate, Kanha Tiger Reserve, MP',
    'status'            => 'live',
    'auto_email_lead'   => '1',
];

$stmtSet = $mysqli->prepare("INSERT INTO `settings` (`key_name`, `value_content`, `updated_at`) VALUES (?, ?, NOW())");
foreach ($settings as $k => $v) {
    $stmtSet->bind_param('ss', $k, $v);
    $stmtSet->execute();
}
echo "-> Settings seeded (" . count($settings) . " settings).\n";

echo "\n============================================\n";
echo "DATABASE SETUP & SEEDING COMPLETED SUCCESSFULLY!\n";
echo "Database: $dbName\n";
echo "Host: $host\n";
echo "============================================\n";

$mysqli->close();
