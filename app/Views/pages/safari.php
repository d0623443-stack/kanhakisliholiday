<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
$resolveImg = static function (?string $path, string $fallback): string {
    $src = !empty($path) ? trim($path) : $fallback;
    return (str_starts_with($src, 'http://') || str_starts_with($src, 'https://')) ? $src : base_url($src);
};

// Ensure $safariSlides has active slides with fallback
if (empty($safariSlides)) {
    $safariSlides = [
        [
            'id'        => 1,
            'image'     => $content['slide1_img'] ?? 'assets/images/tiger-kanha-reserve.jpg',
            'tag'       => $content['slide1_tag'] ?? 'Apex Predator · Kanha Core',
            'caption'   => $content['slide1_caption'] ?? 'Royal Bengal Tiger (Panthera tigris)',
        ],
        [
            'id'        => 2,
            'image'     => $content['slide2_img'] ?? 'assets/images/barasingha-kanha.jpg',
            'tag'       => $content['slide2_tag'] ?? 'State Animal of MP · Exclusive to Kanha',
            'caption'   => $content['slide2_caption'] ?? 'Hardground Barasingha (Rucervus duvaucelii branderi)',
        ],
        [
            'id'        => 3,
            'image'     => $content['slide3_img'] ?? 'assets/images/hero-safari-trail.jpg',
            'tag'       => $content['slide3_tag'] ?? 'Naturalist-Guided · 4x4 Expedition',
            'caption'   => $content['slide3_caption'] ?? 'Open 4x4 Gypsy Drives in Dense Sal Forest',
        ],
        [
            'id'        => 4,
            'image'     => $content['slide4_img'] ?? 'assets/images/indian-roller.jpg',
            'tag'       => $content['slide4_tag'] ?? 'Avian Diversity · 300+ Species',
            'caption'   => $content['slide4_caption'] ?? 'Indian Roller (Coracias benghalensis)',
        ],
    ];
}
$firstSlide = $safariSlides[0];
?>

<!-- INNER HERO (Breadcrumb Banner) -->
<section class="relative bg-forest-950 text-warm-white flex flex-col justify-start items-center pt-32 sm:pt-40 md:pt-52 lg:pt-56 pb-14 sm:pb-16 md:pb-20 overflow-hidden">
  <div class="absolute inset-0 z-0">
    <img src="<?= $resolveImg($content['hero_bg_image'] ?? null, 'assets/images/tiger-kanha-reserve.jpg') ?>" 
         alt="<?= esc($content['hero_title'] ?? 'Royal Bengal Tiger in Kanha Tiger Reserve') ?>" 
         class="w-full h-full object-cover object-center filter brightness-90 transform scale-105 transition-transform duration-10000" />
    <div class="absolute inset-0 bg-gradient-to-b from-forest-950/95 via-forest-950/70 to-forest-950/95"></div>
  </div>

  <div class="relative z-10 max-w-site mx-auto px-5 sm:px-8 text-center max-w-3xl">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="Breadcrumb" class="inline-flex items-center space-x-2 text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full bg-forest-950/70 border border-warm-white/15 text-sage mb-3 sm:mb-4 shadow-sm backdrop-blur-sm">
      <a href="<?= base_url('/') ?>" class="hover:text-warm-white transition-colors">Home</a>
      <span class="text-stone/60">/</span>
      <span class="text-warm-white font-bold">Safari</span>
    </nav>

    <div class="text-xs font-semibold tracking-widest-plus uppercase text-[#D4B87C] mb-2">
      <?= esc($content['hero_eyebrow'] ?? 'Wilderness Safaris · Kanha Kisli') ?>
    </div>
    <h1 class="font-serif text-3xl sm:text-5xl md:text-6xl font-bold text-warm-white leading-tight">
      <?= esc($content['hero_title'] ?? 'Into the Heart of the Wild') ?>
    </h1>
    <p class="mt-2.5 sm:mt-3 text-stone text-xs sm:text-base md:text-lg font-normal leading-relaxed max-w-xl mx-auto">
      <?= esc($content['hero_subtitle'] ?? "Guided open 4x4 Gypsy drives across Kanha's legendary forest trails.") ?>
    </p>

    <!-- Quick CTA Button -->
    <div class="mt-5 sm:mt-6 flex items-center justify-center">
      <a href="#safari-booking-form-card" 
         class="inline-flex items-center justify-center px-7 py-2.5 sm:py-3 rounded-full bg-[#D4B87C] hover:bg-[#c4a668] text-forest-950 font-semibold text-xs sm:text-sm transition-all duration-200 shadow-md hover:shadow-lg hover:-translate-y-0.5 group">
        <span>Book Safari</span>
        <svg class="w-4 h-4 ml-2 transform group-hover:translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
      </a>
    </div>
  </div>
</section>


<!-- MAIN 2-COLUMN SECTION: GALLERY & OVERVIEW (LEFT) + COMPACT STICKY FORM (RIGHT) -->
<section id="safari-booking" class="py-8 sm:py-14 md:py-20 bg-warm-white relative scroll-mt-24">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 lg:items-start relative">
      
      <!-- LEFT COLUMN: Image Gallery & Safari Overview (65%) -->
      <div class="w-full lg:w-[65%] space-y-8 sm:space-y-10">
        
        <!-- Interactive Gallery Showcase (Dynamic Carousel) -->
        <div class="space-y-3 sm:space-y-4">
          <!-- Main Hero Image Frame -->
          <div class="relative w-full h-[260px] sm:h-[380px] md:h-[480px] lg:h-[520px] rounded-2xl sm:rounded-3xl overflow-hidden shadow-xl bg-forest-950 border border-stone/30 group">
            <img id="gallery-main-img" 
                 src="<?= $resolveImg($firstSlide['image'], 'assets/images/tiger-kanha-reserve.jpg') ?>" 
                 alt="<?= esc($firstSlide['caption']) ?>" 
                 class="w-full h-full object-cover transition-opacity duration-300 transform group-hover:scale-105 transition-transform duration-700" />
            
            <!-- Dark Gradient Vignette for Text Contrast -->
            <div class="absolute inset-0 bg-gradient-to-t from-forest-950/85 via-transparent to-black/20 pointer-events-none"></div>
            
            <!-- Floating Image Caption Info -->
            <div class="absolute bottom-3 sm:bottom-5 left-3 sm:left-5 right-3 sm:right-5 flex items-end justify-between pointer-events-none">
              <div class="space-y-0.5 sm:space-y-1">
                <span id="gallery-tag" class="inline-block text-[10px] sm:text-[11px] font-mono uppercase tracking-wider px-2.5 py-0.5 sm:px-3 sm:py-1 rounded-full bg-forest-900/90 text-[#D4B87C] border border-[#D4B87C]/40 backdrop-blur-md">
                  <?= esc($firstSlide['tag'] ?? 'Kanha Tiger Reserve') ?>
                </span>
                <h3 id="gallery-caption" class="text-base sm:text-2xl font-serif font-bold text-warm-white drop-shadow">
                  <?= esc($firstSlide['caption']) ?>
                </h3>
              </div>
              <div id="gallery-counter" class="text-[11px] sm:text-xs font-mono px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-full bg-black/60 backdrop-blur-md text-warm-white border border-warm-white/20">
                1 / <?= count($safariSlides) ?>
              </div>
            </div>

            <!-- Left & Right Carousel Navigation Buttons -->
            <?php if (count($safariSlides) > 1): ?>
              <button type="button" 
                      onclick="changeGallerySlide(-1)" 
                      aria-label="Previous Slide" 
                      class="absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-forest-950/70 hover:bg-forest-950 text-warm-white flex items-center justify-center backdrop-blur-md border border-warm-white/20 shadow-lg transition-all opacity-80 hover:opacity-100 hover:scale-110 cursor-pointer">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
              </button>
              <button type="button" 
                      onclick="changeGallerySlide(1)" 
                      aria-label="Next Slide" 
                      class="absolute right-3 sm:right-4 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-forest-950/70 hover:bg-forest-950 text-warm-white flex items-center justify-center backdrop-blur-md border border-warm-white/20 shadow-lg transition-all opacity-80 hover:opacity-100 hover:scale-110 cursor-pointer">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
              </button>
            <?php endif; ?>
          </div>

          <!-- Dynamic Thumbnail Strip -->
          <div class="grid grid-cols-4 sm:grid-cols-<?= min(count($safariSlides), 6) ?> gap-2 sm:gap-3">
            <?php foreach ($safariSlides as $sidx => $sslide): ?>
              <button type="button" 
                      onclick="selectGallerySlide(<?= $sidx ?>, true)" 
                      class="gallery-thumb group relative rounded-xl sm:rounded-2xl overflow-hidden aspect-video border-2 <?= $sidx === 0 ? 'border-[#D4B87C] ring-2 ring-[#D4B87C]/50 opacity-100' : 'border-transparent opacity-70 hover:opacity-100' ?> shadow-md transition-all cursor-pointer">
                <img src="<?= $resolveImg($sslide['image'], 'assets/images/tiger-kanha-reserve.jpg') ?>" alt="<?= esc($sslide['tag'] ?: $sslide['caption']) ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                <div class="absolute inset-0 bg-forest-950/20 group-hover:bg-transparent transition-colors"></div>
                <?php if (!empty($sslide['tag'])): ?>
                  <span class="absolute bottom-1.5 left-2 text-[10px] font-bold text-warm-white drop-shadow hidden sm:block truncate max-w-[90%]">
                    <?= esc(explode('·', $sslide['tag'])[0]) ?>
                  </span>
                <?php endif; ?>
              </button>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Mobile Quick Booking Jump Callout (Visible on Mobile Only) -->
        <div class="lg:hidden bg-gradient-to-r from-forest-950 via-forest-900 to-forest-950 p-4 rounded-2xl border border-[#D4B87C]/40 shadow-lg flex items-center justify-between gap-3 text-warm-white">
          <div class="space-y-0.5 min-w-0">
            <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-xs font-mono font-semibold uppercase tracking-wider text-[#D4B87C]">
              <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
              Core & Buffer Permits
            </span>
            <div class="text-xs sm:text-sm font-medium text-warm-white truncate">Ready to book a 4x4 Gypsy?</div>
          </div>
          <a href="#safari-booking-form-card" 
             class="px-4 py-2 rounded-full bg-[#D4B87C] hover:bg-[#c4a668] text-forest-950 font-semibold text-xs whitespace-nowrap shadow transition-colors flex items-center gap-1 shrink-0 cursor-pointer">
            <span>Inquire Now</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
          </a>
        </div>

        <!-- Title & Introduction (Matching kanhawild.in) -->
        <div class="pt-2">
          <div class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700 mb-2">
            <?= esc($content['overview_eyebrow'] ?? 'Kanha Tiger Reserve · Mandla & Balaghat Districts, MP') ?>
          </div>
          <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-ink leading-tight mb-4">
            <?= esc($content['overview_title'] ?? 'Explore Kanha National Park: Book Safaris Online') ?>
          </h2>
          <p class="text-body text-base sm:text-lg leading-relaxed">
            <?= esc($content['overview_desc'] ?? 'Kanha National Park, nestled in the heart of central India, is celebrated worldwide for its rich biodiversity, soaring Sal canopies, open grasslands, and thriving tiger population. As Kipling\'s primary inspiration for The Jungle Book, every safari here is an unforgettable journey into untamed nature.') ?>
          </p>
        </div>

        <!-- Detailed Description Card ("A Wildlife Haven") -->
        <div class="bg-ivory/80 rounded-2xl sm:rounded-3xl p-5 sm:p-7 md:p-9 border border-stone/40 shadow-sm space-y-5 sm:space-y-6">
          <h3 class="font-serif text-xl sm:text-2xl md:text-3xl font-bold text-ink flex items-center gap-3">
            <span class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-[#D4B87C] shrink-0"></span>
            <?= esc($content['haven_title'] ?? 'A Wildlife Haven & Ancient Sal Sanctuary') ?>
          </h3>
          
          <div class="text-body text-sm sm:text-base leading-relaxed space-y-4">
            <p>
              <?= esc($content['haven_p1'] ?? "Renowned for rescuing the central Indian Hardground Barasingha (swamp deer) from near extinction, Kanha is the world's sole surviving natural home for this magnificent subspecies. Along with healthy tiger lineages, the park shelters thriving populations of Indian leopards, sloth bears, wild dogs (dholes), and majestic gaurs (Indian bison).") ?>
            </p>
            <p>
              <?= esc($content['haven_p2'] ?? "To ensure an authentic, ethical, and hassle-free experience, our safari desk arranges authorized 4x4 Maruti Gypsies, verified forest department permits, and dedicated naturalists who decode deer alarm calls and read pugmarks along the red forest soil.") ?>
            </p>
          </div>

          <!-- Key Reserve Stats Grid -->
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-2">
            <div class="bg-warm-white p-4 rounded-2xl border border-stone/30 text-center shadow-xs">
              <span class="block font-serif text-2xl sm:text-3xl font-bold text-forest-900"><?= esc($content['stat1_num'] ?? '940+') ?></span>
              <span class="text-xs text-forest-700/80 font-medium"><?= esc($content['stat1_label'] ?? 'km² Core Area') ?></span>
            </div>
            <div class="bg-warm-white p-4 rounded-2xl border border-stone/30 text-center shadow-xs">
              <span class="block font-serif text-2xl sm:text-3xl font-bold text-forest-900"><?= esc($content['stat2_num'] ?? '100+') ?></span>
              <span class="text-xs text-forest-700/80 font-medium"><?= esc($content['stat2_label'] ?? 'Wild Tigers') ?></span>
            </div>
            <div class="bg-warm-white p-4 rounded-2xl border border-stone/30 text-center shadow-xs">
              <span class="block font-serif text-2xl sm:text-3xl font-bold text-forest-900"><?= esc($content['stat3_num'] ?? '300+') ?></span>
              <span class="text-xs text-forest-700/80 font-medium"><?= esc($content['stat3_label'] ?? 'Bird Species') ?></span>
            </div>
            <div class="bg-warm-white p-4 rounded-2xl border border-stone/30 text-center shadow-xs">
              <span class="block font-serif text-2xl sm:text-3xl font-bold text-forest-900"><?= esc($content['stat4_num'] ?? '100%') ?></span>
              <span class="text-xs text-forest-700/80 font-medium"><?= esc($content['stat4_label'] ?? 'Official Permits') ?></span>
            </div>
          </div>
        </div>

        <!-- Safari Zones & Gates Breakdown -->
        <div class="space-y-6 pt-2">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <h3 class="font-serif text-2xl sm:text-3xl font-bold text-ink">
              Safari Zones & Gates
            </h3>
            <span class="text-xs font-semibold uppercase tracking-wider text-forest-700 bg-forest-900/10 px-3 py-1 rounded-full w-fit">
              4 Core Zones &middot; 3 Buffer Gates
            </span>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Zone 1: Kisli -->
            <div class="p-5 rounded-2xl bg-ivory border border-stone/40 space-y-2 hover:border-[#D4B87C] transition-colors">
              <div class="flex items-center justify-between">
                <span class="font-serif text-lg font-bold text-ink"><?= esc($content['kisli_title'] ?? 'Kisli Zone (Core)') ?></span>
                <span class="text-[11px] font-mono font-medium px-2 py-0.5 rounded bg-forest-900/10 text-forest-800"><?= esc($content['kisli_gate'] ?? 'Khatia Gate') ?></span>
              </div>
              <p class="text-body text-xs sm:text-sm leading-relaxed">
                <?= esc($content['kisli_desc'] ?? 'Directly accessible from Khatia Gate. Dense sal canopies, scenic ravines, and frequent sightings of tigers, gaur, and sambar.') ?>
              </p>
            </div>

            <!-- Zone 2: Kanha -->
            <div class="p-5 rounded-2xl bg-ivory border border-stone/40 space-y-2 hover:border-[#D4B87C] transition-colors">
              <div class="flex items-center justify-between">
                <span class="font-serif text-lg font-bold text-ink"><?= esc($content['kanha_title'] ?? 'Kanha Zone (Core)') ?></span>
                <span class="text-[11px] font-mono font-medium px-2 py-0.5 rounded bg-[#D4B87C]/20 text-forest-900"><?= esc($content['kanha_gate'] ?? 'Iconic Grassland') ?></span>
              </div>
              <p class="text-body text-xs sm:text-sm leading-relaxed">
                <?= esc($content['kanha_desc'] ?? 'The park\'s crown heartland featuring sprawling meadows, historic Shravan Tal lake, and the primary Barasingha herds.') ?>
              </p>
            </div>

            <!-- Zone 3: Mukki -->
            <div class="p-5 rounded-2xl bg-ivory border border-stone/40 space-y-2 hover:border-[#D4B87C] transition-colors">
              <div class="flex items-center justify-between">
                <span class="font-serif text-lg font-bold text-ink"><?= esc($content['mukki_title'] ?? 'Mukki Zone (Core)') ?></span>
                <span class="text-[11px] font-mono font-medium px-2 py-0.5 rounded bg-forest-900/10 text-forest-800"><?= esc($content['mukki_gate'] ?? 'Mukki Gate') ?></span>
              </div>
              <p class="text-body text-xs sm:text-sm leading-relaxed">
                <?= esc($content['mukki_desc'] ?? 'Known for Banjar riverbanks, rich bamboo thickets, tranquil trails, and exceptional photography angles in warm afternoon light.') ?>
              </p>
            </div>

            <!-- Zone 4: Sarhi -->
            <div class="p-5 rounded-2xl bg-ivory border border-stone/40 space-y-2 hover:border-[#D4B87C] transition-colors">
              <div class="flex items-center justify-between">
                <span class="font-serif text-lg font-bold text-ink"><?= esc($content['sarhi_title'] ?? 'Sarhi Zone (Core)') ?></span>
                <span class="text-[11px] font-mono font-medium px-2 py-0.5 rounded bg-forest-900/10 text-forest-800"><?= esc($content['sarhi_gate'] ?? 'Sarhi Gate') ?></span>
              </div>
              <p class="text-body text-xs sm:text-sm leading-relaxed">
                <?= esc($content['sarhi_desc'] ?? 'Northern wild terrain of dry deciduous woods and rocky outcrops. A quiet haven for sloth bears, leopards, and wild dogs.') ?>
              </p>
            </div>

            <!-- Buffer Zones: Khatia, Khapa & Phen -->
            <div class="p-5 rounded-2xl bg-ivory border border-stone/40 space-y-2 sm:col-span-2">
              <div class="flex items-center justify-between">
                <span class="font-serif text-lg font-bold text-ink"><?= esc($content['buffer_title'] ?? 'Buffer Zones & Night Trails') ?></span>
                <span class="text-[11px] font-mono font-medium px-2 py-0.5 rounded bg-emerald-900/10 text-emerald-800"><?= esc($content['buffer_gate'] ?? 'Khatia / Khapa / Phen') ?></span>
              </div>
              <p class="text-body text-xs sm:text-sm leading-relaxed">
                <?= esc($content['buffer_desc'] ?? 'Surrounding forest corridors open 7 days a week, including Wednesday afternoons and twilight night safaris for nocturnal wildlife.') ?>
              </p>
            </div>
          </div>
        </div>

        <!-- Shift & Timing Cards -->
        <div class="space-y-4 pt-2">
          <h3 class="font-serif text-2xl font-bold text-ink">
            Safari Shifts & Timings
          </h3>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="p-5 rounded-2xl bg-ivory border border-stone/40 space-y-2">
              <div class="flex items-center gap-2 text-forest-900 font-bold text-sm">
                <svg class="w-4 h-4 text-[#D4B87C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <span><?= esc($content['morning_shift_title'] ?? 'Morning Shift: 06:00 AM – 11:00 AM') ?></span>
              </div>
              <p class="text-xs text-body leading-relaxed">
                <?= esc($content['morning_shift_desc'] ?? 'Gate opens at sunrise. Best for tracking overnight predator pugmarks, active bird chorus, and crisp morning mist over meadows.') ?>
              </p>
            </div>

            <div class="p-5 rounded-2xl bg-ivory border border-stone/40 space-y-2">
              <div class="flex items-center gap-2 text-forest-900 font-bold text-sm">
                <svg class="w-4 h-4 text-[#D4B87C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                <span><?= esc($content['afternoon_shift_title'] ?? 'Afternoon Shift: 02:30 PM – Sunset') ?></span>
              </div>
              <p class="text-xs text-body leading-relaxed">
                <?= esc($content['afternoon_shift_desc'] ?? 'Warm afternoon turning into dusk. Prime time for wildlife congregating around perennial waterholes and forest streams.') ?>
              </p>
            </div>
          </div>

          <!-- Permit & ID Notice -->
          <div class="p-4 rounded-xl bg-[#D4B87C]/15 border border-[#D4B87C]/40 text-xs text-forest-900 space-y-1">
            <?= nl2br(esc($content['regulations_notice'] ?? "Important Forest Regulations:\n• Every visitor must bring the original Photo ID (Aadhaar Card / Voter ID / Passport) used at the time of booking.\n• Core zones remain closed on Wednesday afternoons. Buffer zones remain open all days.")) ?>
          </div>
        </div>

      </div>

      <!-- RIGHT COLUMN: Compact Sticky Booking Enquiry Form (35%) -->
      <div id="safari-booking-form-card" class="w-full lg:w-[35%] lg:sticky lg:top-28 z-20 scroll-mt-28">
        <div class="bg-forest-950 text-warm-white rounded-3xl p-6 sm:p-8 shadow-2xl border border-stone/30 relative overflow-hidden backdrop-blur-md">
          
          <!-- Golden Accent Line -->
          <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-transparent via-[#D4B87C] to-transparent"></div>

          <div class="mb-5 space-y-1">
            <span class="text-[11px] font-mono uppercase tracking-widest text-[#D4B87C] font-semibold block">Official Permit Quotas</span>
            <h3 class="text-2xl font-serif font-bold text-warm-white">Inquire Safari Booking</h3>
            <p class="text-stone text-xs leading-relaxed">
              Verify live MP Forest permit slots & reserve your 4x4 Gypsy.
            </p>
          </div>

          <!-- Flash Messages (Inside card for instant visibility) -->
          <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-4 p-4 rounded-2xl bg-forest-900 border border-[#D4B87C]/60 text-warm-white text-xs leading-relaxed flex items-start gap-2.5 shadow-md">
              <div class="p-1 rounded-full bg-[#D4B87C] text-forest-950 shrink-0 mt-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
              </div>
              <div>
                <strong class="block text-warm-white font-bold mb-0.5">Booking Request Received!</strong>
                <?= session()->getFlashdata('success') ?>
              </div>
            </div>
          <?php endif; ?>

          <?php if (session()->getFlashdata('errors')): ?>
            <div class="mb-4 p-4 rounded-2xl bg-red-950/80 border border-red-500/50 text-warm-white text-xs shadow-md">
              <div class="font-bold text-red-300 mb-1 flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                Please correct the following:
              </div>
              <ul class="list-disc list-inside text-red-200 space-y-0.5">
                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                  <li><?= esc($err) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <!-- Compact Form (Matching kanhawild.in) -->
          <form action="<?= base_url('safari/book') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="park_name" value="Kanha Tiger Reserve">

            <!-- Full Name -->
            <div>
              <label for="safari-name" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                Full Name <span class="text-[#D4B87C]">*</span>
              </label>
              <input type="text" 
                     id="safari-name" 
                     name="name" 
                     required 
                     value="<?= old('name') ?>" 
                     placeholder="e.g. Vikramaditya Sharma" 
                     class="w-full px-3.5 py-2.5 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white placeholder-stone/50 focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm" />
            </div>

            <!-- 2-Col: Mobile * & Email -->
            <div class="grid grid-cols-2 gap-3">
              <div>
                <label for="safari-phone" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                  Mobile <span class="text-[#D4B87C]">*</span>
                </label>
                <input type="tel" 
                       id="safari-phone" 
                       name="phone" 
                       required 
                       value="<?= old('phone') ?>" 
                       placeholder="+91 98765..." 
                       class="w-full px-3.5 py-2.5 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white placeholder-stone/50 focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm" />
              </div>
              <div>
                <label for="safari-email" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                  Email
                </label>
                <input type="email" 
                       id="safari-email" 
                       name="email" 
                       value="<?= old('email') ?>" 
                       placeholder="name@mail.com" 
                       class="w-full px-3.5 py-2.5 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white placeholder-stone/50 focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm" />
              </div>
            </div>

            <!-- 2-Col: Safari Date * & Guests (Adults) -->
            <div class="grid grid-cols-2 gap-3">
              <div>
                <label for="safari-date" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                  Safari Date <span class="text-[#D4B87C]">*</span>
                </label>
                <input type="date" 
                       id="safari-date" 
                       name="safari_date" 
                       required 
                       min="<?= date('Y-m-d', strtotime('+1 day')) ?>" 
                       value="<?= old('safari_date') ?>" 
                       class="w-full px-3 py-2.5 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm" />
              </div>
              <div>
                <label for="safari-adults" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                  Guests (Adults)
                </label>
                <select id="safari-adults" 
                        name="adults" 
                        class="w-full px-3 py-2.5 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm">
                  <option value="1" <?= old('adults') === '1' ? 'selected' : '' ?>>1 Person</option>
                  <option value="2" <?= old('adults') === '2' || !old('adults') ? 'selected' : '' ?>>2 Persons</option>
                  <option value="4" <?= old('adults') === '4' ? 'selected' : '' ?>>4 Persons</option>
                  <option value="6" <?= old('adults') === '6' ? 'selected' : '' ?>>6 (Full Gypsy)</option>
                  <option value="8" <?= old('adults') === '8' ? 'selected' : '' ?>>8+ Group</option>
                </select>
              </div>
            </div>

            <!-- 2-Col: Shift / Timing & Vehicle -->
            <div class="grid grid-cols-2 gap-3">
              <div>
                <label for="safari-timing" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                  Shift / Timing
                </label>
                <select id="safari-timing" 
                        name="timing" 
                        class="w-full px-3 py-2.5 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm">
                  <option value="morning" <?= old('timing') === 'morning' ? 'selected' : '' ?>>Morning Shift</option>
                  <option value="afternoon" <?= old('timing') === 'afternoon' ? 'selected' : '' ?>>Afternoon Shift</option>
                  <option value="both" <?= old('timing') === 'both' ? 'selected' : '' ?>>Both Shifts</option>
                </select>
              </div>
              <div>
                <label for="safari-vehicle" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                  Vehicle Type
                </label>
                <select id="safari-vehicle" 
                        name="vehicle_type" 
                        class="w-full px-3 py-2.5 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm">
                  <option value="exclusive" <?= old('vehicle_type') === 'exclusive' ? 'selected' : '' ?>>Exclusive Gypsy</option>
                  <option value="shared" <?= old('vehicle_type') === 'shared' ? 'selected' : '' ?>>Shared Gypsy</option>
                </select>
              </div>
            </div>

            <!-- Preferred Gate / Zone -->
            <div>
              <label for="safari-zone" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                Preferred Gate / Zone <span class="text-[#D4B87C]">*</span>
              </label>
              <select id="safari-zone" 
                      name="zone" 
                      required 
                      class="w-full px-3.5 py-2.5 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm">
                <option value="Kanha (Core)" <?= old('zone') === 'Kanha (Core)' ? 'selected' : '' ?>>Kanha (Core Meadow)</option>
                <option value="Kisli (Core)" <?= old('zone') === 'Kisli (Core)' || !old('zone') ? 'selected' : '' ?>>Kisli (Core Khatia Gate)</option>
                <option value="Mukki (Core)" <?= old('zone') === 'Mukki (Core)' ? 'selected' : '' ?>>Mukki (Core Riverbed)</option>
                <option value="Sarhi (Core)" <?= old('zone') === 'Sarhi (Core)' ? 'selected' : '' ?>>Sarhi (Core Northern)</option>
                <option value="Khatia (Buffer)" <?= old('zone') === 'Khatia (Buffer)' ? 'selected' : '' ?>>Khatia (Buffer Zone)</option>
                <option value="Khapa (Buffer)" <?= old('zone') === 'Khapa (Buffer)' ? 'selected' : '' ?>>Khapa (Buffer Zone)</option>
                <option value="Phen Sanctuary" <?= old('zone') === 'Phen Sanctuary' ? 'selected' : '' ?>>Phen Wildlife Sanctuary</option>
              </select>
            </div>

            <!-- Special Requests / Resort Details -->
            <div>
              <label for="safari-notes" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                Special Requests
              </label>
              <textarea id="safari-notes" 
                        name="notes" 
                        rows="2" 
                        placeholder="Resort pickup, photography gear, gate preference..." 
                        class="w-full px-3.5 py-2 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white placeholder-stone/50 focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm"><?= old('notes') ?></textarea>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
              <button type="submit" 
                      class="w-full bg-[#D4B87C] hover:bg-[#c4a668] text-forest-950 font-bold py-3.5 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-[1.01] flex items-center justify-center gap-2 cursor-pointer text-sm">
                <span>Check Availability & Book</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
              </button>
              <span class="block text-[11px] text-center text-stone/70 mt-2">
                🔒 Official Forest Quota &middot; No advance payment until slot is confirmed.
              </span>
            </div>

          </form>

          <!-- Direct Phone / WhatsApp Wildlife Desk Assistance inside sticky card -->
          <?php 
            $stickyDeskPhone = get_owner_phone() ?: get_helpline_phone(); 
            $stickyWaPhone   = get_whatsapp_number();
          ?>
          <div class="mt-5 pt-4 border-t border-stone/20 flex items-center justify-between">
            <div class="text-[11px] text-stone">
              <span>Direct Wildlife Desk:</span>
              <a href="tel:<?= get_clean_phone($stickyDeskPhone) ?>" class="block font-bold text-[#D4B87C] hover:underline"><?= esc($stickyDeskPhone) ?></a>
            </div>
            <a href="<?= esc(get_whatsapp_link($stickyWaPhone, 'Hi Kisli Holiday, I want to inquire about Kanha Safari booking')) ?>" 
               target="_blank" 
               rel="noopener" 
               class="px-3 py-1.5 rounded-lg bg-emerald-700/80 hover:bg-emerald-600 text-warm-white text-[11px] font-medium flex items-center gap-1.5 transition">
              <span>WhatsApp</span>
            </a>
          </div>

        </div>
      </div>

    </div>

  </div>
</section>


<!-- SECTION: RESPONSIBLE WILDLIFE TOURISM CALLOUT -->
<section class="py-16 bg-warm-white border-t border-stone/30">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-ivory rounded-3xl p-8 sm:p-10 border border-stone/40 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
      <div class="space-y-2 max-w-2xl">
        <span class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700"><?= esc($content['tourism_eyebrow'] ?? 'Conservation First') ?></span>
        <h3 class="font-serif text-2xl sm:text-3xl font-bold text-ink"><?= esc($content['tourism_title'] ?? 'Responsible Wildlife Tourism') ?></h3>
        <p class="text-body text-sm leading-relaxed">
          <?= esc($content['tourism_desc'] ?? 'Kanha is a sacred wildlife sanctuary. We practice complete silence at sightings, respect park speed limits, and never litter or feed wild fauna. Every safari booked directly supports local forest guides and community conservation initiatives.') ?>
        </p>
      </div>
      <div class="flex-shrink-0">
        <a href="<?= base_url('contact') ?>" 
           class="inline-flex items-center justify-center px-7 py-3.5 rounded-full bg-forest-900 hover:bg-forest-800 text-warm-white text-sm font-medium transition-colors shadow-sm">
          <span>Contact Safari Team</span>
          <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ENQUIRY CTA PARTIAL -->
<?= $this->include('partials/enquiry-cta') ?>


<!-- GALLERY INTERACTIVE SCRIPT -->
<script>
  const galleryImages = <?= json_encode(array_values(array_map(static function($s) use ($resolveImg) {
      return [
          'src'     => $resolveImg($s['image'], 'assets/images/tiger-kanha-reserve.jpg'),
          'alt'     => $s['caption'],
          'tag'     => $s['tag'] ?? '',
          'caption' => $s['caption'],
      ];
  }, $safariSlides)), JSON_UNESCAPED_SLASHES) ?>;

  let currentGalleryIndex = 0;
  let galleryAutoplayTimer = null;

  function selectGallerySlide(idx, isManual = false) {
    currentGalleryIndex = (idx + galleryImages.length) % galleryImages.length;
    const item = galleryImages[currentGalleryIndex];

    const mainImg = document.getElementById('gallery-main-img');
    const tag = document.getElementById('gallery-tag');
    const caption = document.getElementById('gallery-caption');
    const counter = document.getElementById('gallery-counter');

    if (mainImg) {
      mainImg.style.opacity = '0.4';
      setTimeout(() => {
        mainImg.src = item.src;
        mainImg.alt = item.alt;
        mainImg.style.opacity = '1';
      }, 120);
    }
    if (tag) tag.textContent = item.tag;
    if (caption) caption.textContent = item.caption;
    if (counter) counter.textContent = `${currentGalleryIndex + 1} / ${galleryImages.length}`;

    // Update thumbnail border and ring highlights
    const thumbs = document.querySelectorAll('.gallery-thumb');
    thumbs.forEach((th, i) => {
      if (i === currentGalleryIndex) {
        th.classList.add('border-[#D4B87C]', 'ring-2', 'ring-[#D4B87C]/50', 'opacity-100');
        th.classList.remove('border-transparent', 'opacity-70');
      } else {
        th.classList.remove('border-[#D4B87C]', 'ring-2', 'ring-[#D4B87C]/50', 'opacity-100');
        th.classList.add('border-transparent', 'opacity-70');
      }
    });

    if (isManual) {
      restartGalleryAutoplay();
    }
  }

  function changeGallerySlide(delta) {
    selectGallerySlide(currentGalleryIndex + delta, true);
  }

  function startGalleryAutoplay() {
    stopGalleryAutoplay();
    galleryAutoplayTimer = setInterval(() => {
      selectGallerySlide(currentGalleryIndex + 1, false);
    }, 4500);
  }

  function stopGalleryAutoplay() {
    if (galleryAutoplayTimer) {
      clearInterval(galleryAutoplayTimer);
      galleryAutoplayTimer = null;
    }
  }

  function restartGalleryAutoplay() {
    stopGalleryAutoplay();
    startGalleryAutoplay();
  }

  // Start autoplay on load
  startGalleryAutoplay();

  // Pause on hover over main showcase
  const mainImgFrame = document.getElementById('gallery-main-img')?.parentElement;
  if (mainImgFrame) {
    mainImgFrame.addEventListener('mouseenter', stopGalleryAutoplay);
    mainImgFrame.addEventListener('mouseleave', startGalleryAutoplay);
  }
</script>

<?= $this->endSection() ?>
