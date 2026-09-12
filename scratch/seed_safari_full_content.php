<?php

$mysqli = new mysqli('127.0.0.1', 'root', '', 'kanhakisliholiday');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$safariContent = [
    // Hero Banner
    ['hero', 'hero_bg_image', 'assets/images/tiger-kanha-reserve.jpg'],
    ['hero', 'hero_eyebrow', 'Official Safari Booking · Kanha Tiger Reserve'],
    ['hero', 'hero_title', 'Into the Heart of the Wild'],
    ['hero', 'hero_subtitle', 'Open 4x4 Gypsy safaris, certified naturalist guides, and seamless forest permit bookings across Kanha\'s legendary core and buffer zones.'],

    // 4 Interactive Gallery Showcase Slides (Images & Captions)
    ['showcase', 'slide1_img', 'assets/images/tiger-kanha-reserve.jpg'],
    ['showcase', 'slide1_tag', 'Apex Predator · Kanha Core'],
    ['showcase', 'slide1_caption', 'Royal Bengal Tiger (Panthera tigris)'],
    
    ['showcase', 'slide2_img', 'assets/images/barasingha-kanha.jpg'],
    ['showcase', 'slide2_tag', 'State Animal of MP · Exclusive to Kanha'],
    ['showcase', 'slide2_caption', 'Hardground Barasingha (Rucervus duvaucelii branderi)'],

    ['showcase', 'slide3_img', 'assets/images/hero-safari-trail.jpg'],
    ['showcase', 'slide3_tag', 'Naturalist-Guided · 4x4 Expedition'],
    ['showcase', 'slide3_caption', 'Open 4x4 Gypsy Drives in Dense Sal Forest'],

    ['showcase', 'slide4_img', 'assets/images/indian-roller.jpg'],
    ['showcase', 'slide4_tag', 'Avian Diversity · 300+ Species'],
    ['showcase', 'slide4_caption', 'Indian Roller (Coracias benghalensis)'],

    // Overview & Wildlife Haven
    ['overview', 'overview_eyebrow', 'Kanha Tiger Reserve · Mandla & Balaghat Districts, MP'],
    ['overview', 'overview_title', 'Explore Kanha National Park: Book Safaris Online'],
    ['overview', 'overview_desc', 'Kanha National Park, nestled in the heart of central India, is celebrated worldwide for its rich biodiversity, soaring Sal canopies, open grasslands, and thriving tiger population. As Kipling\'s primary inspiration for The Jungle Book, every safari here is an unforgettable journey into untamed nature.'],
    ['overview', 'haven_title', 'A Wildlife Haven & Ancient Sal Sanctuary'],
    ['overview', 'haven_p1', 'Renowned for rescuing the central Indian Hardground Barasingha (swamp deer) from near extinction, Kanha is the world\'s sole surviving natural home for this magnificent subspecies. Along with healthy tiger lineages, the park shelters thriving populations of Indian leopards, sloth bears, wild dogs (dholes), and majestic gaurs (Indian bison).'],
    ['overview', 'haven_p2', 'To ensure an authentic, ethical, and hassle-free experience, our safari desk arranges authorized 4x4 Maruti Gypsies, verified forest department permits, and dedicated naturalists who decode deer alarm calls and read pugmarks along the red forest soil.'],

    // Reserve Key Stats
    ['stats', 'stat1_num', '940+'],
    ['stats', 'stat1_label', 'km² Core Area'],
    ['stats', 'stat2_num', '100+'],
    ['stats', 'stat2_label', 'Wild Tigers'],
    ['stats', 'stat3_num', '300+'],
    ['stats', 'stat3_label', 'Bird Species'],
    ['stats', 'stat4_num', '100%'],
    ['stats', 'stat4_label', 'Official Permits'],

    // Safari Zones & Gates
    ['zones', 'kisli_title', 'Kisli Zone (Core)'],
    ['zones', 'kisli_gate', 'Khatia Gate'],
    ['zones', 'kisli_desc', 'Directly accessible from Khatia Gate. Dense sal canopies, scenic ravines, and frequent sightings of tigers, gaur, and sambar.'],

    ['zones', 'kanha_title', 'Kanha Zone (Core)'],
    ['zones', 'kanha_gate', 'Iconic Grassland'],
    ['zones', 'kanha_desc', 'The park\'s crown heartland featuring sprawling meadows, historic Shravan Tal lake, and the primary Barasingha herds.'],

    ['zones', 'mukki_title', 'Mukki Zone (Core)'],
    ['zones', 'mukki_gate', 'Mukki Gate'],
    ['zones', 'mukki_desc', 'Known for Banjar riverbanks, rich bamboo thickets, tranquil trails, and exceptional photography angles in warm afternoon light.'],

    ['zones', 'sarhi_title', 'Sarhi Zone (Core)'],
    ['zones', 'sarhi_gate', 'Sarhi Gate'],
    ['zones', 'sarhi_desc', 'Northern wild terrain of dry deciduous woods and rocky outcrops. A quiet haven for sloth bears, leopards, and wild dogs.'],

    ['zones', 'buffer_title', 'Buffer Zones & Night Trails'],
    ['zones', 'buffer_gate', 'Khatia / Khapa / Phen'],
    ['zones', 'buffer_desc', 'Surrounding forest corridors open 7 days a week, including Wednesday afternoons and twilight night safaris for nocturnal wildlife.'],

    // Shifts, Timings & Regulations
    ['shifts', 'morning_shift_title', 'Morning Shift: 06:00 AM – 11:00 AM'],
    ['shifts', 'morning_shift_desc', 'Gate opens at sunrise. Best for tracking overnight predator pugmarks, active bird chorus, and crisp morning mist over meadows.'],
    ['shifts', 'afternoon_shift_title', 'Afternoon Shift: 02:30 PM – Sunset'],
    ['shifts', 'afternoon_shift_desc', 'Warm afternoon turning into dusk. Prime time for wildlife congregating around perennial waterholes and forest streams.'],
    ['shifts', 'regulations_notice', 'Every visitor must bring the original Photo ID (Aadhaar Card / Voter ID / Passport) used at the time of booking. Core zones remain closed on Wednesday afternoons. Buffer zones remain open all days.'],

    // Tourism & Conservation
    ['conservation', 'tourism_eyebrow', 'Conservation First'],
    ['conservation', 'tourism_title', 'Responsible Wildlife Tourism'],
    ['conservation', 'tourism_desc', 'Kanha is a sacred wildlife sanctuary. We practice complete silence at sightings, respect park speed limits, and never litter or feed wild fauna. Every safari booked directly supports local forest guides and community conservation initiatives.'],
];

$stmt = $mysqli->prepare("INSERT INTO `site_content` (`page_key`, `section_key`, `content_key`, `content_value`, `updated_at`) 
                          VALUES ('safari', ?, ?, ?, NOW()) 
                          ON DUPLICATE KEY UPDATE `section_key` = VALUES(`section_key`), `content_value` = VALUES(`content_value`), `updated_at` = NOW()");

$count = 0;
foreach ($safariContent as $item) {
    $sectionKey = $item[0];
    $contentKey = $item[1];
    $contentVal = $item[2];

    // Check if exists
    $check = $mysqli->query("SELECT id FROM `site_content` WHERE `page_key` = 'safari' AND `content_key` = '" . $mysqli->real_escape_string($contentKey) . "'");
    if ($check && $check->num_rows > 0) {
        $row = $check->fetch_assoc();
        $up = $mysqli->prepare("UPDATE `site_content` SET `section_key` = ?, `content_value` = ?, `updated_at` = NOW() WHERE `id` = ?");
        $up->bind_param('ssi', $sectionKey, $contentVal, $row['id']);
        $up->execute();
    } else {
        $ins = $mysqli->prepare("INSERT INTO `site_content` (`page_key`, `section_key`, `content_key`, `content_value`, `updated_at`) VALUES ('safari', ?, ?, ?, NOW())");
        $ins->bind_param('sss', $sectionKey, $contentKey, $contentVal);
        $ins->execute();
    }
    $count++;
}

echo "Successfully seeded/updated {$count} Safari content keys in database.\n";
$mysqli->close();
