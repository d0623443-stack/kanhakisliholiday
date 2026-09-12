<?php

namespace App\Controllers\Admin;

use App\Models\ContentModel;

class Content extends AdminBaseController
{
    protected ContentModel $contentModel;

    public function __construct()
    {
        $this->contentModel = new ContentModel();
    }

    public function index()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $activeTab = $this->request->getGet('tab') ?? 'home';

        // Default fallbacks to guarantee no undefined array keys
        $defaults = [
            'home' => [
                'about_eyebrow'   => 'About Kanha Kisli Holiday',
                'about_title'     => 'Where the forest sets the pace.',
                'about_desc'      => 'Discover Kanha through early morning safaris, thoughtful hospitality and unhurried moments in nature. We guide your journeys with respect for the wilderness and personal care for every guest.',
                'feature1_title'  => 'Safari assistance',
                'feature1_desc'   => 'Guidance for a smooth experience',
                'feature2_title'  => 'Personal attention',
                'feature2_desc'   => 'A more meaningful journey',
                'safari_eyebrow'  => 'Safari Experiences',
                'safari_title'    => 'Into the heart of Kanha.',
                'safari_quote'    => 'More than a destination. A wilder you.',
                'step1_title'     => 'Follow the forest trails',
                'step1_desc'      => 'Discover the beauty of Kanha with a guided safari through dense sal forests, open meadows, and winding rivers.',
                'step2_title'     => 'Look a little closer',
                'step2_desc'      => 'From birds to deer, every sighting tells a story. Watch for the rare hardground barasingha found nowhere else in the world.',
                'step3_title'     => 'Make it your journey',
                'step3_desc'      => 'Talk to us about your safari plans. We assist with gate permits, gypsy arrangements, and seasoned naturalists.',
                'stay_eyebrow'           => 'Stay Close to the Wild',
                'stay_title'             => 'Rest between the adventures.',
                'stay_desc'              => 'Thoughtful, unhurried hospitality designed to harmonize with the rhythm of the sal forest. Comfortable cottages, tranquil verandas, and warm evening gatherings after a day on the safari trail.',
                
                // Home page dynamic section images
                'about_primary_img'      => 'assets/images/safari-trail.jpg',
                'about_secondary_img'    => 'assets/images/indian-roller.jpg',
                'about_polaroid_caption' => 'Small moments. Big stories.',
                'safari_tiger_img'       => 'assets/images/tiger-portrait.jpg',
                'safari_etching_img'     => 'assets/images/kanha-meadow-wildlife-etching.png',
                'stay_cottage_img'       => 'assets/images/forest-lodge.jpg',
                'stay_interior_img'      => 'assets/images/lodge-interior.jpg',
            ],
            'safari' => [
                // Hero Banner
                'hero_bg_image'   => 'assets/images/tiger-kanha-reserve.jpg',
                'hero_eyebrow'    => 'Wilderness Safaris · Kanha Kisli',
                'hero_title'      => 'Into the Heart of the Wild',
                'hero_subtitle'   => 'Guided open 4x4 Gypsy drives across Kanha\'s legendary forest trails.',

                // 4 Interactive Gallery Showcase Slides (Images & Captions)
                'slide1_img'      => 'assets/images/tiger-kanha-reserve.jpg',
                'slide1_tag'      => 'Apex Predator · Kanha Core',
                'slide1_caption'  => 'Royal Bengal Tiger (Panthera tigris)',

                'slide2_img'      => 'assets/images/barasingha-kanha.jpg',
                'slide2_tag'      => 'State Animal of MP · Exclusive to Kanha',
                'slide2_caption'  => 'Hardground Barasingha (Rucervus duvaucelii branderi)',

                'slide3_img'      => 'assets/images/hero-safari-trail.jpg',
                'slide3_tag'      => 'Naturalist-Guided · 4x4 Expedition',
                'slide3_caption'  => 'Open 4x4 Gypsy Drives in Dense Sal Forest',

                'slide4_img'      => 'assets/images/indian-roller.jpg',
                'slide4_tag'      => 'Avian Diversity · 300+ Species',
                'slide4_caption'  => 'Indian Roller (Coracias benghalensis)',

                // Overview & Wildlife Haven
                'overview_eyebrow' => 'Kanha Tiger Reserve · Mandla & Balaghat Districts, MP',
                'overview_title'   => 'Explore Kanha National Park: Book Safaris Online',
                'overview_desc'    => 'Kanha National Park, nestled in the heart of central India, is celebrated worldwide for its rich biodiversity, soaring Sal canopies, open grasslands, and thriving tiger population. As Kipling\'s primary inspiration for The Jungle Book, every safari here is an unforgettable journey into untamed nature.',
                'haven_title'      => 'A Wildlife Haven & Ancient Sal Sanctuary',
                'haven_p1'         => 'Renowned for rescuing the central Indian Hardground Barasingha (swamp deer) from near extinction, Kanha is the world\'s sole surviving natural home for this magnificent subspecies. Along with healthy tiger lineages, the park shelters thriving populations of Indian leopards, sloth bears, wild dogs (dholes), and majestic gaurs (Indian bison).',
                'haven_p2'         => 'To ensure an authentic, ethical, and hassle-free experience, our safari desk arranges authorized 4x4 Maruti Gypsies, verified forest department permits, and dedicated naturalists who decode deer alarm calls and read pugmarks along the red forest soil.',

                // Key Reserve Stats
                'stat1_num'       => '940+',
                'stat1_label'     => 'km² Core Area',
                'stat2_num'       => '100+',
                'stat2_label'     => 'Wild Tigers',
                'stat3_num'       => '300+',
                'stat3_label'     => 'Bird Species',
                'stat4_num'       => '100%',
                'stat4_label'     => 'Official Permits',

                // Safari Zones & Gates
                'kisli_title'     => 'Kisli Zone (Core)',
                'kisli_gate'      => 'Khatia Gate',
                'kisli_desc'      => 'Directly accessible from Khatia Gate. Dense sal canopies, scenic ravines, and frequent sightings of tigers, gaur, and sambar.',

                'kanha_title'     => 'Kanha Zone (Core)',
                'kanha_gate'      => 'Iconic Grassland',
                'kanha_desc'      => 'The park\'s crown heartland featuring sprawling meadows, historic Shravan Tal lake, and the primary Barasingha herds.',

                'mukki_title'     => 'Mukki Zone (Core)',
                'mukki_gate'      => 'Mukki Gate',
                'mukki_desc'      => 'Known for Banjar riverbanks, rich bamboo thickets, tranquil trails, and exceptional photography angles in warm afternoon light.',

                'sarhi_title'     => 'Sarhi Zone (Core)',
                'sarhi_gate'      => 'Sarhi Gate',
                'sarhi_desc'      => 'Northern wild terrain of dry deciduous woods and rocky outcrops. A quiet haven for sloth bears, leopards, and wild dogs.',

                'buffer_title'    => 'Buffer Zones & Night Trails',
                'buffer_gate'     => 'Khatia / Khapa / Phen',
                'buffer_desc'     => 'Surrounding forest corridors open 7 days a week, including Wednesday afternoons and twilight night safaris for nocturnal wildlife.',

                // Shifts & Timings
                'morning_shift_title'   => 'Morning Shift: 06:00 AM – 11:00 AM',
                'morning_shift_desc'    => 'Gate opens at sunrise. Best for tracking overnight predator pugmarks, active bird chorus, and crisp morning mist over meadows.',
                'afternoon_shift_title' => 'Afternoon Shift: 02:30 PM – Sunset',
                'afternoon_shift_desc'  => 'Warm afternoon turning into dusk. Prime time for wildlife congregating around perennial waterholes and forest streams.',
                'regulations_notice'    => 'Every visitor must bring the original Photo ID (Aadhaar Card / Voter ID / Passport) used at the time of booking. Core zones remain closed on Wednesday afternoons. Buffer zones remain open all days.',

                // Tourism & Conservation
                'tourism_eyebrow' => 'Conservation First',
                'tourism_title'   => 'Responsible Wildlife Tourism',
                'tourism_desc'    => 'Kanha is a sacred wildlife sanctuary. We practice complete silence at sightings, respect park speed limits, and never litter or feed wild fauna. Every safari booked directly supports local forest guides and community conservation initiatives.',
            ],
            'accommodation' => [
                'hero_title'      => 'Rest Between the Adventures',
                'hero_subtitle'   => 'Peaceful, nature-immersed cottages surrounded by ancient Sal trees. Thoughtful comforts, fresh local cuisine, and starlit wilderness evenings.',
                'cottage1_title'  => 'Forest Cottages',
                'cottage1_price'  => '₹5,500 / night',
                'cottage1_desc'   => 'Independent stone and timber cottages surrounded by sal trees, offering private open verandas and modern ensuite baths.',
                'cottage2_title'  => 'Deluxe Family Veranda Suites',
                'cottage2_price'  => '₹8,500 / night',
                'cottage2_desc'   => 'Spacious dual-bedroom family retreat with extended viewing veranda facing the inner garden canopy.',
                'cottage3_title'  => 'Machan Treehouse Villas',
                'cottage3_price'  => '₹12,000 / night',
                'cottage3_desc'   => 'Elevated wooden stilt hideaway nestled directly into the forest canopy with 360-degree wilderness outlooks.',
            ],
            'contact' => [
                'phone_primary'   => '+91 94251 00000',
                'phone_secondary' => '+91 76422 00000',
                'phone_owner'     => '+91 75667 89123',
                'whatsapp'        => '+91 94251 00000',
                'email'           => 'stay@kanhakisliholiday.com',
                'address'         => 'Kanha Kisli Holiday, Near Khatia / Kisli Gate, Mandla District, Madhya Pradesh — 481768, India',
                'hours'           => 'Daily: 08:00 AM – 08:00 PM IST',
                'google_maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58728.89240410408!2d80.57500355!3d22.2858145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a2a68393693e507%3A0xc3d5d7e48ce19cf5!2sKanha%20Tiger%20Reserve%2C%20Khatia%20Gate!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin',
            ],
        ];

        // Fetch live from database
        $dbContent = $this->contentModel->getAllContentGrouped();

        // Merge DB values on top of defaults
        $content = [];
        foreach ($defaults as $page => $keys) {
            $content[$page] = array_merge($keys, $dbContent[$page] ?? []);
        }

        // Fetch Safari Showcase Carousel Slides
        $safariSlideModel = new \App\Models\SafariSlideModel();
        $safariSlides = $safariSlideModel->getAllSlides();

        $data = array_merge($this->adminData, [
            'metaTitle'    => 'Site Content Editor — Kanha Kisli Holiday Admin',
            'pageHeading'  => 'Site Content Editor',
            'activeNav'    => 'content',
            'activeTab'    => $activeTab,
            'content'      => $content,
            'safariSlides' => $safariSlides,
        ]);

        return view('admin/content', $data);
    }

    public function update()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $activeTab = $this->request->getPost('active_tab') ?? 'home';
        $postedContent = $this->request->getPost('content');

        if (is_array($postedContent)) {
            $sectionMap = [
                'about_eyebrow'   => 'about',
                'about_title'     => 'about',
                'about_desc'      => 'about',
                'feature1_title'  => 'about',
                'feature1_desc'   => 'about',
                'feature2_title'  => 'about',
                'feature2_desc'   => 'about',
                'safari_eyebrow'  => 'safari',
                'safari_title'    => 'safari',
                'safari_quote'    => 'safari',
                'step1_title'     => 'safari',
                'step1_desc'      => 'safari',
                'step2_title'     => 'safari',
                'step2_desc'      => 'safari',
                'step3_title'     => 'safari',
                'step3_desc'      => 'safari',
                'stay_eyebrow'    => 'stay',
                'stay_title'      => 'stay',
                'stay_desc'       => 'stay',

                // Home page dynamic section images
                'about_primary_img'      => 'about',
                'about_secondary_img'    => 'about',
                'about_polaroid_caption' => 'about',
                'safari_tiger_img'       => 'safari',
                'safari_etching_img'     => 'safari',
                'stay_cottage_img'       => 'stay',
                'stay_interior_img'      => 'stay',
                
                // Safari page mappings
                'hero_bg_image'   => 'hero',
                'hero_eyebrow'    => 'hero',
                'hero_title'      => 'hero',
                'hero_subtitle'   => 'hero',
                'slide1_img'      => 'showcase',
                'slide1_tag'      => 'showcase',
                'slide1_caption'  => 'showcase',
                'slide2_img'      => 'showcase',
                'slide2_tag'      => 'showcase',
                'slide2_caption'  => 'showcase',
                'slide3_img'      => 'showcase',
                'slide3_tag'      => 'showcase',
                'slide3_caption'  => 'showcase',
                'slide4_img'      => 'showcase',
                'slide4_tag'      => 'showcase',
                'slide4_caption'  => 'showcase',
                'overview_eyebrow'=> 'overview',
                'overview_title'  => 'overview',
                'overview_desc'   => 'overview',
                'haven_title'     => 'overview',
                'haven_p1'        => 'overview',
                'haven_p2'        => 'overview',
                'stat1_num'       => 'stats',
                'stat1_label'     => 'stats',
                'stat2_num'       => 'stats',
                'stat2_label'     => 'stats',
                'stat3_num'       => 'stats',
                'stat3_label'     => 'stats',
                'stat4_num'       => 'stats',
                'stat4_label'     => 'stats',
                'kisli_title'     => 'zones',
                'kisli_gate'      => 'zones',
                'kisli_desc'      => 'zones',
                'kanha_title'     => 'zones',
                'kanha_gate'      => 'zones',
                'kanha_desc'      => 'zones',
                'mukki_title'     => 'zones',
                'mukki_gate'      => 'zones',
                'mukki_desc'      => 'zones',
                'sarhi_title'     => 'zones',
                'sarhi_gate'      => 'zones',
                'sarhi_desc'      => 'zones',
                'buffer_title'    => 'zones',
                'buffer_gate'     => 'zones',
                'buffer_desc'     => 'zones',
                'morning_shift_title'   => 'shifts',
                'morning_shift_desc'    => 'shifts',
                'afternoon_shift_title' => 'shifts',
                'afternoon_shift_desc'  => 'shifts',
                'regulations_notice'    => 'shifts',
                'tourism_eyebrow' => 'conservation',
                'tourism_title'   => 'conservation',
                'tourism_desc'    => 'conservation',

                // Accommodation
                'cottage1_title'  => 'cottages',
                'cottage1_price'  => 'cottages',
                'cottage1_desc'   => 'cottages',
                'cottage2_title'  => 'cottages',
                'cottage2_price'  => 'cottages',
                'cottage2_desc'   => 'cottages',
                'cottage3_title'  => 'cottages',
                'cottage3_price'  => 'cottages',
                'cottage3_desc'   => 'cottages',

                // Contact
                'phone_primary'   => 'info',
                'phone_secondary' => 'info',
                'phone_owner'     => 'info',
                'whatsapp'        => 'info',
                'email'           => 'info',
                'address'         => 'info',
                'hours'           => 'info',
                'google_maps_embed' => 'map',
            ];

            foreach ($postedContent as $pageKey => $fields) {
                if (is_array($fields)) {
                    foreach ($fields as $contentKey => $val) {
                        $sectionKey = $sectionMap[$contentKey] ?? 'general';
                        $trimmedVal = trim((string)$val);
                        if ($contentKey === 'google_maps_embed') {
                            $trimmedVal = parse_map_embed_url($trimmedVal);
                        }
                        $this->contentModel->setContent(
                            $pageKey,
                            $sectionKey,
                            $contentKey,
                            $trimmedVal
                        );

                        // If owner phone was updated in content editor, sync to global site settings
                        if ($contentKey === 'phone_owner' || $contentKey === 'phone_secondary') {
                            $settingModel = new \App\Models\SettingModel();
                            $settingModel->setSetting('owner_phone', $trimmedVal);
                        } elseif ($contentKey === 'google_maps_embed') {
                            $settingModel = new \App\Models\SettingModel();
                            $settingModel->setSetting('google_maps_embed', $trimmedVal);
                        }
                    }
                }
            }
        }

        // Handle direct file uploads from file explorer dropzones
        $uploadedFiles = [
            'file_about_primary_img'   => ['page' => 'home', 'section' => 'about',  'key' => 'about_primary_img'],
            'file_about_secondary_img' => ['page' => 'home', 'section' => 'about',  'key' => 'about_secondary_img'],
            'file_safari_tiger_img'    => ['page' => 'home', 'section' => 'safari', 'key' => 'safari_tiger_img'],
            'file_safari_etching_img'  => ['page' => 'home', 'section' => 'safari', 'key' => 'safari_etching_img'],
            'file_stay_cottage_img'    => ['page' => 'home', 'section' => 'stay',   'key' => 'stay_cottage_img'],
            'file_stay_interior_img'   => ['page' => 'home', 'section' => 'stay',   'key' => 'stay_interior_img'],
            'file_safari_hero_bg'      => ['page' => 'safari', 'section' => 'hero', 'key' => 'hero_bg_image'],
        ];

        $hasUpload = false;
        foreach ($uploadedFiles as $inputName => $meta) {
            $file = $this->request->getFile($inputName);
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $uploadDir = FCPATH . 'uploads/' . $meta['page'];
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $ext = $file->guessExtension() ?: 'webp';
                $newName = $meta['key'] . '_' . time() . '_' . bin2hex(random_bytes(3)) . '.' . $ext;
                $file->move($uploadDir, $newName);
                $imagePath = 'uploads/' . $meta['page'] . '/' . $newName;

                $this->contentModel->setContent(
                    $meta['page'],
                    $meta['section'],
                    $meta['key'],
                    $imagePath
                );
                $hasUpload = true;
            }
        }

        if (is_array($postedContent) || $hasUpload) {
            session()->setFlashdata('success', 'Site content updated successfully across all sections!');
        }

        return redirect()->to(base_url('admin/content?tab=' . urlencode($activeTab)));
    }

    public function saveSafariSlide()
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $safariSlideModel = new \App\Models\SafariSlideModel();
        $id = $this->request->getPost('id');
        $imagePath = trim((string)$this->request->getPost('existing_image'));

        // Handle uploaded slide image from file explorer
        $imageFile = $this->request->getFile('safari_slide_image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $uploadDir = FCPATH . 'uploads/safari';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $ext = $imageFile->guessExtension() ?: 'webp';
            $newName = 'safari_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
            $imageFile->move($uploadDir, $newName);
            $imagePath = 'uploads/safari/' . $newName;
        }

        if (empty($imagePath)) {
            $imagePath = 'assets/images/tiger-kanha-reserve.jpg';
        }

        $tag = trim((string)$this->request->getPost('tag'));
        $caption = trim((string)$this->request->getPost('caption'));
        $orderNum = (int)($this->request->getPost('order_num') ?? 1);

        $slideData = [
            'image'     => $imagePath,
            'tag'       => $tag,
            'caption'   => $caption ?: 'Kanha Safari Experience',
            'order_num' => $orderNum,
            'status'    => $this->request->getPost('status') ?? 'active',
        ];

        if (!empty($id)) {
            $safariSlideModel->update($id, $slideData);
            $msg = 'Safari carousel slide updated successfully!';
        } else {
            if ($orderNum <= 1) {
                $count = $safariSlideModel->countAllResults();
                $slideData['order_num'] = $count + 1;
            }
            $safariSlideModel->insert($slideData);
            $msg = 'New safari carousel slide added successfully!';
        }

        return redirect()->to(base_url('admin/content?tab=safari'))->with('success', $msg);
    }

    public function deleteSafariSlide($id)
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $safariSlideModel = new \App\Models\SafariSlideModel();
        $slide = $safariSlideModel->find($id);
        if ($slide) {
            $safariSlideModel->delete($id);
            return redirect()->to(base_url('admin/content?tab=safari'))->with('success', 'Safari carousel slide removed.');
        }

        return redirect()->to(base_url('admin/content?tab=safari'))->with('error', 'Slide not found.');
    }

    public function toggleSafariSlide($id)
    {
        if ($redirect = $this->checkAuth()) {
            return $redirect;
        }

        $safariSlideModel = new \App\Models\SafariSlideModel();
        $slide = $safariSlideModel->find($id);
        if ($slide) {
            $newStatus = ($slide['status'] === 'active') ? 'inactive' : 'active';
            $safariSlideModel->update($id, ['status' => $newStatus]);
            return redirect()->to(base_url('admin/content?tab=safari'))->with('success', "Slide status changed to {$newStatus}.");
        }

        return redirect()->to(base_url('admin/content?tab=safari'))->with('error', 'Slide not found.');
    }
}
