<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
// Helper to resolve local assets or uploaded image paths with fallback
$resolveImg = function(?string $path, string $fallback): string {
    $img = !empty($path) ? trim($path) : $fallback;
    if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
        return $img;
    }
    return base_url($img);
};
?>

<!-- SECTION 1: HERO SLIDER -->
<section id="hero-slider" class="relative w-full min-h-[580px] sm:min-h-[660px] md:min-h-screen bg-forest-950 text-warm-white overflow-hidden flex items-center select-none" aria-label="Hero Showcase">
  
  <!-- Slides Container -->
  <div class="absolute inset-0 w-full h-full">
    <?php if (!empty($slides)): ?>
      <?php foreach ($slides as $index => $slide): ?>
        <div class="hero-slide absolute inset-0 w-full h-full <?= $index === 0 ? 'opacity-100' : 'opacity-0' ?> transition-opacity duration-1000 ease-in-out" 
             data-slide="<?= $index + 1 ?>"
             data-eyebrow="<?= esc($slide['eyebrow']) ?>"
             data-title="<?= esc($slide['title']) ?>"
             data-subtitle="<?= esc($slide['subtitle_italic']) ?>"
             data-description="<?= esc($slide['description']) ?>"
             data-btn1-link="<?= esc($slide['btn1_link']) ?>"
             data-btn2-link="<?= esc($slide['btn2_link']) ?>">
          <img src="<?= base_url(esc($slide['image'])) ?>" 
               alt="<?= esc($slide['alt'] ?? $slide['title']) ?>" 
               class="w-full h-full object-cover object-center transform scale-100 transition-transform duration-10000 ease-out" />
          <!-- Asymmetric Dark Gradient Overlay: Darker on left for copy, top-down for menu contrast -->
          <div class="absolute inset-0 bg-gradient-to-r from-forest-950/90 via-forest-950/50 to-transparent"></div>
          <div class="absolute inset-0 bg-gradient-to-t from-forest-950/70 via-transparent to-transparent"></div>
          <div class="absolute inset-0 bg-gradient-to-b from-forest-950/85 via-forest-950/30 to-transparent h-48 md:h-64"></div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- Hero Content (Within Left 45% of Container) -->
  <div class="relative z-20 max-w-site mx-auto w-full px-5 sm:px-8 md:px-12 pt-24 sm:pt-28 pb-16 sm:pb-20 md:py-32">
    <div class="max-w-2xl space-y-5 sm:space-y-6 md:space-y-8">
      
      <!-- Eyebrow -->
      <div class="inline-flex items-center space-x-2 text-xs md:text-sm font-semibold tracking-widest-plus uppercase text-sage">
        <span id="hero-eyebrow"><?= esc($slides[0]['eyebrow'] ?? 'Kanha · Madhya Pradesh') ?></span>
      </div>

      <!-- Main Headline -->
      <h1 class="font-serif text-3xl sm:text-5xl md:text-7xl lg:text-[5rem] font-bold text-warm-white leading-[1.08] tracking-tight">
        <span id="hero-title"><?= esc($slides[0]['title'] ?? 'Discover the wild.') ?></span><br>
        <span id="hero-subtitle" class="font-normal italic"><?= esc($slides[0]['subtitle_italic'] ?? 'Feel closer to nature.') ?></span>
      </h1>

      <!-- Subtitle -->
      <p id="hero-desc" class="text-stone text-sm sm:text-base md:text-xl font-normal max-w-lg leading-relaxed">
        <?= esc($slides[0]['description'] ?? 'Memorable safaris and peaceful stays in the heart of Kanha.') ?>
      </p>

      <!-- Hero Action Buttons with WhatsApp & Call -->
      <div class="space-y-4 pt-2">
        <div class="flex flex-wrap items-center gap-3">
          <!-- WhatsApp Button -->
          <a id="hero-btn-wa" 
             href="<?= esc($slides[0]['btn1_link'] ?? 'https://wa.me/919425100000') ?>" 
             target="_blank" 
             rel="noopener noreferrer" 
             class="inline-flex items-center justify-center px-5 py-3 sm:px-6 sm:py-3.5 rounded-full bg-[#25D366] hover:bg-[#20bd5a] text-white font-semibold text-xs sm:text-base transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5 group cursor-pointer">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-2.5 fill-current" viewBox="0 0 24 24">
              <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>
            <span><?= esc($slides[0]['btn1_text'] ?? 'WhatsApp') ?></span>
          </a>

          <!-- Call Button -->
          <a id="hero-btn-call" 
             href="<?= esc($slides[0]['btn2_link'] ?? 'tel:+919425100000') ?>" 
             class="inline-flex items-center justify-center px-5 py-3 sm:px-6 sm:py-3.5 rounded-full bg-[#D4B87C] hover:bg-[#c4a668] text-forest-950 font-semibold text-xs sm:text-base transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5 group cursor-pointer">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2 text-forest-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <span><?= esc($slides[0]['btn2_text'] ?? 'Call Now') ?></span>
          </a>
        </div>

        <!-- Quick Help Micro-Badge -->
        <div class="flex flex-wrap items-center gap-2 sm:gap-3 text-xs text-stone/80">
          <span class="inline-flex items-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            Direct Assistance:
          </span>
          <a href="tel:<?= esc($settings['helpline_phone'] ?? '+919425100000') ?>" class="hover:text-warm-white transition-colors underline decoration-stone/40"><?= esc($settings['helpline_phone'] ?? '+91 94251 00000') ?></a>
          <span class="text-stone/40 hidden sm:inline">&middot;</span>
          <span class="text-[11px] sm:text-xs">Kanha Wildlife Desk</span>
        </div>
      </div>

    </div>
  </div>

  <!-- Side Navigation Arrow Controls (Visible on tablet/desktop) -->
  <button id="hero-prev" 
          type="button" 
          class="hidden sm:flex absolute left-4 md:left-8 top-1/2 -translate-y-1/2 z-20 w-11 h-11 md:w-12 md:h-12 rounded-full border border-warm-white/30 text-warm-white hover:bg-forest-900/60 hover:border-warm-white/70 backdrop-blur-sm items-center justify-center transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-sage"
          aria-label="Previous slide">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
    </svg>
  </button>

  <button id="hero-next" 
          type="button" 
          class="hidden sm:flex absolute right-4 md:right-8 top-1/2 -translate-y-1/2 z-20 w-11 h-11 md:w-12 md:h-12 rounded-full border border-warm-white/30 text-warm-white hover:bg-forest-900/60 hover:border-warm-white/70 backdrop-blur-sm items-center justify-center transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-sage"
          aria-label="Next slide">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
  </button>

  <!-- Bottom Slider Progress & Counter (01 / 02) -->
  <div class="absolute bottom-5 sm:bottom-8 left-5 sm:left-8 md:left-12 z-20 flex items-center space-x-3 sm:space-x-4 text-xs font-mono tracking-widest text-warm-white">
    <span id="slide-counter-current">01</span>
    <span>/</span>
    <span id="slide-counter-total"><?= str_pad(count($slides), 2, '0', STR_PAD_LEFT) ?></span>
    
    <!-- Visual Progress Bars -->
    <div class="flex items-center space-x-2 pl-2">
      <?php foreach ($slides as $index => $slide): ?>
        <div class="hero-bar h-1 w-7 sm:w-8 rounded-full <?= $index === 0 ? 'bg-warm-white' : 'bg-warm-white/30' ?> transition-all duration-300" data-bar="<?= $index + 1 ?>"></div>
      <?php endforeach; ?>
    </div>
  </div>

</section>


<!-- SECTION 2: ABOUT KANHA KISLI HOLIDAY -->
<section id="about" class="py-14 sm:py-20 md:py-32 bg-warm-white relative overflow-hidden scroll-mt-16" aria-label="About Us">
  <div class="max-w-site mx-auto px-5 sm:px-8 md:px-12">
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
      
      <!-- Text Column (Roughly 42% on desktop) -->
      <div class="lg:col-span-5 space-y-5 sm:space-y-6">
        
        <div class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700">
          <?= esc($content['about_eyebrow'] ?? 'About Kanha Kisli Holiday') ?>
        </div>

        <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-ink leading-[1.15]">
          <?= esc($content['about_title'] ?? 'Where the forest sets the pace.') ?>
        </h2>

        <p class="text-body text-sm sm:text-base md:text-lg leading-relaxed">
          <?= esc($content['about_desc'] ?? 'Discover Kanha through early morning safaris, thoughtful hospitality and unhurried moments in nature. We guide your journeys with respect for the wilderness and personal care for every guest.') ?>
        </p>

        <!-- Feature Points (Delicate line icons, no bulky cards) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 pt-2 sm:pt-4 pb-2">
          
          <!-- Feature 1: Safari assistance -->
          <div class="flex items-start space-x-3.5">
            <div class="w-10 h-10 rounded-full bg-ivory border border-stone/50 flex items-center justify-center text-forest-800 flex-shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-ink text-sm sm:text-base"><?= esc($content['feature1_title'] ?? 'Safari assistance') ?></h3>
              <p class="text-muted text-xs sm:text-sm mt-0.5"><?= esc($content['feature1_desc'] ?? 'Guidance for a smooth experience') ?></p>
            </div>
          </div>

          <!-- Feature 2: Personal attention -->
          <div class="flex items-start space-x-3.5">
            <div class="w-10 h-10 rounded-full bg-ivory border border-stone/50 flex items-center justify-center text-forest-800 flex-shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-ink text-sm sm:text-base"><?= esc($content['feature2_title'] ?? 'Personal attention') ?></h3>
              <p class="text-muted text-xs sm:text-sm mt-0.5"><?= esc($content['feature2_desc'] ?? 'A more meaningful journey') ?></p>
            </div>
          </div>

        </div>

        <!-- Text Link -->
        <div class="pt-2">
          <a href="<?= base_url('safari') ?>" 
             class="group inline-flex items-center text-forest-900 font-semibold text-sm sm:text-base hover:text-forest-700 transition-colors">
            <span class="border-b border-forest-900/40 group-hover:border-forest-700 pb-0.5">Get to know us</span>
            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </a>
        </div>

      </div>

      <!-- Imagery Column: Asymmetric Layered Editorial Collage -->
      <div class="lg:col-span-7 relative flex items-center justify-center lg:justify-end pt-4 lg:pt-0">
        
        <!-- Botanical Background Accent -->
        <div class="absolute -top-10 -right-6 w-48 sm:w-64 pointer-events-none opacity-20 text-moss">
          <img src="<?= base_url('assets/icons/leaf-branch.svg') ?>" alt="" class="w-full h-auto" />
        </div>

        <div class="relative w-full max-w-lg lg:max-w-none">
          
          <!-- Primary Image: Safari Forest Perspective -->
          <div class="relative w-full sm:w-4/5 lg:w-3/4 h-64 sm:h-80 md:h-[420px] rounded-3xl overflow-hidden shadow-2xl border border-stone/30 group">
            <img src="<?= $resolveImg($content['about_primary_img'] ?? null, 'assets/images/safari-trail.jpg') ?>" 
                 alt="Sunbeams filtering through ancient sal trees in Kanha" 
                 class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" />
            <!-- Luxury Gold Corner Accent Lines -->
            <div class="absolute top-4 left-4 w-6 h-6 border-t-2 border-l-2 border-[#D4B87C]/80 pointer-events-none"></div>
            <div class="absolute bottom-4 right-4 w-6 h-6 border-b-2 border-r-2 border-[#D4B87C]/80 pointer-events-none"></div>
            <!-- Subtle Vignette -->
            <div class="absolute inset-0 bg-gradient-to-t from-forest-950/60 via-transparent to-transparent pointer-events-none"></div>
            <!-- Reserve Location Badge -->
            <div class="absolute bottom-4 left-4 z-10 bg-forest-950/85 backdrop-blur-md border border-[#D4B87C]/40 text-warm-white px-3.5 py-1.5 rounded-full text-xs font-medium flex items-center gap-2 shadow-lg">
              <span class="w-2 h-2 rounded-full bg-[#D4B87C] animate-pulse"></span>
              <span class="font-serif tracking-wide text-xs">Kanha Tiger Reserve · Sal Forest Trail</span>
            </div>
          </div>

          <!-- Secondary Overlapping Image: Polaroid Print of Indian Roller Bird -->
          <div class="w-52 sm:w-64 md:w-76 bg-warm-white p-3 sm:p-4 pb-5 sm:pb-7 rounded-2xl polaroid-shadow border border-stone/30 -mt-24 sm:-mt-36 md:-mt-44 lg:-mt-44 ml-auto mr-2 sm:mr-6 lg:-ml-12 transform rotate-2 hover:rotate-0 transition-transform duration-500 z-10 relative group">
            <!-- Washi tape / antique pin accent at top center -->
            <div class="absolute -top-2.5 left-1/2 -translate-x-1/2 w-12 h-3.5 bg-[#D4B87C]/40 backdrop-blur-xs rounded-xs border border-white/40 transform -rotate-1 pointer-events-none"></div>
            <div class="w-full h-40 sm:h-48 md:h-56 rounded-xl overflow-hidden bg-sand">
              <img src="<?= $resolveImg($content['about_secondary_img'] ?? null, 'assets/images/indian-roller.jpg') ?>" 
                   alt="Indian Roller bird perched on branch" 
                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
            </div>
            <div class="pt-2.5 sm:pt-3.5 text-center">
              <span class="font-script text-ink text-sm sm:text-base md:text-lg tracking-wide"><?= esc($content['about_polaroid_caption'] ?? 'Small moments. Big stories.') ?></span>
            </div>
          </div>

        </div>

      </div>

    </div>

  </div>
</section>


<!-- SECTION 3: SAFARI EXPERIENCE (Tiger in Arched Frame + Numbered Timeline) -->
<section class="py-14 sm:py-20 md:py-32 bg-ivory/60 relative overflow-hidden" aria-label="Safari Experience">
  
  <!-- Background Botanical Wildlife Etching: Ancient Sal Tree, Hardground Barasingha Stag & Doe in Meadow -->
  <div class="absolute bottom-0 right-0 w-[240px] sm:w-[340px] md:w-[440px] lg:w-[500px] xl:w-[540px] pointer-events-none select-none botanical-etching-blend opacity-35 md:opacity-45 transition-opacity duration-500 z-0">
    <img src="<?= $resolveImg($content['safari_etching_img'] ?? null, 'assets/images/kanha-meadow-wildlife-etching.png') ?>" 
         alt="Vintage lithograph engraving of ancient Sal tree and Hardground Barasingha deer in Kanha meadow" 
         class="w-full h-auto object-contain pointer-events-none" />
  </div>

  <div class="max-w-site mx-auto px-5 sm:px-8 md:px-12 relative z-10">
    
    <!-- Section Eyebrow & Heading (Centered) -->
    <div class="text-center max-w-xl mx-auto space-y-2 sm:space-y-3 mb-10 sm:mb-16 md:mb-24">
      <div class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700">
        <?= esc($content['safari_eyebrow'] ?? 'Safari Experiences') ?>
      </div>
      <h2 class="font-serif text-3xl sm:text-5xl font-bold text-ink leading-tight">
        <?= esc($content['safari_title'] ?? 'Into the heart of Kanha.') ?>
      </h2>
    </div>

    <!-- 2-Column Composition -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
      
      <!-- Left Column: Royal Bengal Tiger in Arched Top Frame -->
      <div class="lg:col-span-5 relative flex flex-col items-center">
        
        <!-- Botanical Leaf Branch Accent (Top Left) -->
        <div class="absolute -top-8 -left-8 w-36 sm:w-44 pointer-events-none opacity-25 text-forest-700">
          <img src="<?= base_url('assets/icons/leaf-branch.svg') ?>" alt="" class="w-full h-auto" />
        </div>

        <!-- The Arch Frame Container with Luxury Double Border & Glow -->
        <div class="relative w-full max-w-[290px] sm:max-w-sm arch-frame overflow-hidden shadow-2xl border-4 border-warm-white bg-sand ring-1 ring-[#D4B87C]/50 group">
          <img src="<?= $resolveImg($content['safari_tiger_img'] ?? null, 'assets/images/tiger-portrait.jpg') ?>" 
               alt="Royal Bengal Tiger walking towards camera in Kanha forest" 
               class="w-full h-[340px] sm:h-[440px] md:h-[510px] object-cover object-center transform group-hover:scale-105 transition-transform duration-700" />
          <!-- Subtle Depth Vignette -->
          <div class="absolute inset-0 bg-gradient-to-t from-forest-950/65 via-transparent to-transparent pointer-events-none"></div>
          <!-- Floating Museum Tag at Arch Base -->
          <div class="absolute bottom-5 left-1/2 -translate-x-1/2 z-10 bg-forest-950/85 backdrop-blur-md border border-[#D4B87C]/50 text-warm-white px-4 py-1.5 rounded-full text-[11px] font-mono tracking-widest uppercase whitespace-nowrap shadow-xl flex items-center gap-2">
            <span class="text-[#D4B87C]">✦</span>
            <span>King of Kanha · Royal Bengal</span>
          </div>
        </div>

        <!-- Editorial Script Quote -->
        <div class="mt-5 sm:mt-7 text-center sm:text-left self-center sm:self-start pl-0 sm:pl-8">
          <p class="font-script text-xl sm:text-3xl text-forest-800 leading-snug">
            <?= nl2br(esc($content['safari_quote'] ?? "More than a destination.\nA wilder you.")) ?>
          </p>
        </div>

      </div>

      <!-- Right Column: Numbered Trail Journey -->
      <div class="lg:col-span-7 space-y-8 sm:space-y-10 lg:pl-8">
        
        <div class="relative space-y-6 sm:space-y-8 pl-0 sm:pl-4">
          
          <!-- Vertical Dotted Line Connecting Steps -->
          <div class="hidden sm:block absolute top-6 bottom-6 left-10 w-[2px] timeline-dotted-line pointer-events-none"></div>

          <!-- Step 01 -->
          <div class="relative flex items-start space-x-4 sm:space-x-6 group">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-warm-white border border-forest-800/30 text-forest-900 font-mono font-semibold text-xs sm:text-sm flex items-center justify-center flex-shrink-0 shadow-sm z-10 group-hover:bg-forest-900 group-hover:text-warm-white transition-colors duration-300">
              01
            </div>
            <div class="pt-0.5 sm:pt-1.5 space-y-1 max-w-md">
              <h3 class="font-serif text-xl sm:text-2xl font-bold text-ink"><?= esc($content['step1_title'] ?? 'Follow the forest trails') ?></h3>
              <p class="text-body text-xs sm:text-sm md:text-base leading-relaxed">
                <?= esc($content['step1_desc'] ?? 'Discover the beauty of Kanha with a guided safari through dense sal forests, open meadows, and winding rivers.') ?>
              </p>
            </div>
          </div>

          <!-- Step 02 -->
          <div class="relative flex items-start space-x-4 sm:space-x-6 group">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-warm-white border border-forest-800/30 text-forest-900 font-mono font-semibold text-xs sm:text-sm flex items-center justify-center flex-shrink-0 shadow-sm z-10 group-hover:bg-forest-900 group-hover:text-warm-white transition-colors duration-300">
              02
            </div>
            <div class="pt-0.5 sm:pt-1.5 space-y-1 max-w-md">
              <h3 class="font-serif text-xl sm:text-2xl font-bold text-ink"><?= esc($content['step2_title'] ?? 'Look a little closer') ?></h3>
              <p class="text-body text-xs sm:text-sm md:text-base leading-relaxed">
                <?= esc($content['step2_desc'] ?? 'From birds to deer, every sighting tells a story. Watch for the rare hardground barasingha found nowhere else in the world.') ?>
              </p>
            </div>
          </div>

          <!-- Step 03 -->
          <div class="relative flex items-start space-x-4 sm:space-x-6 group">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-warm-white border border-forest-800/30 text-forest-900 font-mono font-semibold text-xs sm:text-sm flex items-center justify-center flex-shrink-0 shadow-sm z-10 group-hover:bg-forest-900 group-hover:text-warm-white transition-colors duration-300">
              03
            </div>
            <div class="pt-0.5 sm:pt-1.5 space-y-1 max-w-md">
              <h3 class="font-serif text-xl sm:text-2xl font-bold text-ink"><?= esc($content['step3_title'] ?? 'Make it your journey') ?></h3>
              <p class="text-body text-xs sm:text-sm md:text-base leading-relaxed">
                <?= esc($content['step3_desc'] ?? 'Talk to us about your safari plans. We assist with gate permits, gypsy arrangements, and seasoned naturalists.') ?>
              </p>
            </div>
          </div>

        </div>

        <!-- Action Button -->
        <div class="pt-2 sm:pt-4 pl-0 sm:pl-16 relative z-20">
          <a href="<?= base_url('safari') ?>" 
             class="inline-flex items-center justify-center px-6 sm:px-8 py-3.5 sm:py-4 rounded-full bg-forest-900 hover:bg-forest-800 text-warm-white font-medium text-xs sm:text-base transition-all duration-200 shadow-md hover:shadow-lg group">
            <span>Discover Safari</span>
            <svg class="w-4 h-4 ml-2 sm:ml-2.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </a>
        </div>

      </div>

    </div>

  </div>
</section>


<!-- SECTION 4: ACCOMMODATION PREVIEW (Required Upgrade per spec) -->
<section class="py-14 sm:py-20 md:py-32 bg-warm-white" aria-label="Accommodation Preview">
  <div class="max-w-site mx-auto px-5 sm:px-8 md:px-12">
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
      
      <!-- Text Description -->
      <div class="lg:col-span-5 space-y-5 sm:space-y-6">
        <div class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700">
          <?= esc($content['stay_eyebrow'] ?? 'Stay Close to the Wild') ?>
        </div>

        <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-ink leading-tight">
          <?= esc($content['stay_title'] ?? 'Rest between the adventures.') ?>
        </h2>

        <p class="text-body text-sm sm:text-base md:text-lg leading-relaxed">
          <?= esc($content['stay_desc'] ?? 'Thoughtful, unhurried hospitality designed to harmonize with the rhythm of the sal forest. Comfortable cottages, tranquil verandas, and warm evening gatherings after a day on the safari trail.') ?>
        </p>

        <!-- Descriptive Highlights -->
        <div class="space-y-2.5 sm:space-y-3 pt-2">
          <div class="flex items-center space-x-3 text-xs sm:text-sm text-ink font-medium">
            <span class="w-2 h-2 rounded-full bg-forest-700 flex-shrink-0"></span>
            <span>Tranquil forest setting surrounded by native sal trees</span>
          </div>
          <div class="flex items-center space-x-3 text-xs sm:text-sm text-ink font-medium">
            <span class="w-2 h-2 rounded-full bg-forest-700 flex-shrink-0"></span>
            <span>Freshly prepared local and regional dining</span>
          </div>
          <div class="flex items-center space-x-3 text-xs sm:text-sm text-ink font-medium">
            <span class="w-2 h-2 rounded-full bg-forest-700 flex-shrink-0"></span>
            <span>Close proximity to Kanha core safari gates</span>
          </div>
        </div>

        <div class="pt-2 sm:pt-4">
          <a href="<?= base_url('accommodation') ?>" 
             class="group inline-flex items-center text-forest-900 font-semibold text-sm sm:text-base hover:text-forest-700 transition-colors">
            <span class="border-b border-forest-900/40 group-hover:border-forest-700 pb-0.5">Explore Accommodation</span>
            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </a>
        </div>
      </div>

      <!-- Imagery: Large Forest Lodge Cottage & Veranda (Architectural Spread) -->
      <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-12 gap-5 sm:gap-6 items-center">
        <!-- Main Cottage Photo -->
        <div class="sm:col-span-7 h-64 sm:h-84 md:h-[410px] rounded-3xl overflow-hidden shadow-2xl border border-stone/30 relative group">
          <img src="<?= $resolveImg($content['stay_cottage_img'] ?? null, 'assets/images/hotel/hotel-pool-aerial.jpg') ?>" 
               alt="Peaceful boutique forest cottage and pool grounds near Kanha" 
               class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" />
          <div class="absolute inset-0 bg-gradient-to-t from-forest-950/50 via-transparent to-transparent pointer-events-none"></div>
          <div class="absolute bottom-4 left-4 z-10 bg-forest-950/80 backdrop-blur-md border border-[#D4B87C]/40 text-warm-white px-3.5 py-1.5 rounded-full text-xs font-medium flex items-center gap-2 shadow-lg">
            <span class="w-2 h-2 rounded-full bg-[#D4B87C]"></span>
            <span>Resort Grounds &amp; Pool</span>
          </div>
        </div>
        <!-- Detail Veranda Photo (Staggered Offset) -->
        <div class="sm:col-span-5 h-52 sm:h-72 md:h-[330px] sm:-mt-8 rounded-3xl overflow-hidden shadow-2xl border border-stone/30 relative group">
          <img src="<?= $resolveImg($content['stay_interior_img'] ?? null, 'assets/images/hotel/hotel-veranda-coffee.jpg') ?>" 
               alt="Private cottage veranda and artisanal coffee" 
               class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" />
          <div class="absolute inset-0 bg-gradient-to-t from-forest-950/50 via-transparent to-transparent pointer-events-none"></div>
          <div class="absolute bottom-4 left-4 z-10 bg-forest-950/80 backdrop-blur-md border border-[#D4B87C]/40 text-warm-white px-3.5 py-1.5 rounded-full text-xs font-medium flex items-center gap-2 shadow-lg">
            <span class="text-[#D4B87C]">✦</span>
            <span>Private Veranda</span>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>


<!-- SECTION 5: GALLERY PREVIEW (Editorial Image Grid) -->
<section class="py-14 sm:py-20 md:py-32 bg-ivory/50 relative overflow-hidden" aria-label="Gallery Preview">
  
  <!-- Subtle Botanical Framing on Edges -->
  <div class="absolute top-12 left-0 w-36 pointer-events-none opacity-20 text-moss transform -scale-x-100">
    <img src="<?= base_url('assets/icons/leaf-branch.svg') ?>" alt="" class="w-full h-auto" />
  </div>
  <div class="absolute bottom-12 right-0 w-36 pointer-events-none opacity-20 text-moss">
    <img src="<?= base_url('assets/icons/leaf-branch.svg') ?>" alt="" class="w-full h-auto" />
  </div>

  <div class="max-w-site mx-auto px-5 sm:px-8 md:px-12 relative z-10">
    
    <!-- Heading -->
    <div class="text-center max-w-xl mx-auto space-y-2 mb-10 sm:mb-12 md:mb-16">
      <div class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700">
        Gallery
      </div>
      <h2 class="font-serif text-3xl sm:text-5xl font-bold text-ink">
        A glimpse of Kanha.
      </h2>
      <p class="text-body text-xs sm:text-sm md:text-base">
        Moments from the forest.
      </p>
    </div>

    <!-- 3 Editorial Photos from DB -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
      <?php if (!empty($galleryPreview)): ?>
        <?php foreach ($galleryPreview as $pItem): ?>
          <a href="<?= base_url('gallery') ?>" class="group block space-y-2.5 sm:space-y-3">
            <div class="w-full h-48 sm:h-64 md:h-72 rounded-2xl overflow-hidden bg-sand shadow-md border border-stone/30">
              <img src="<?= base_url(esc($pItem['image'])) ?>" 
                   alt="<?= esc($pItem['title']) ?>" 
                   class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500" />
            </div>
            <div class="text-center">
              <span class="font-serif text-base sm:text-lg font-semibold text-ink group-hover:text-forest-800 transition-colors"><?= esc($pItem['title']) ?></span>
              <span class="block text-xs uppercase tracking-wider text-muted"><?= esc($pItem['subtitle'] ?? ucfirst($pItem['category'])) ?></span>
            </div>
          </a>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- Bottom Link -->
    <div class="text-center pt-8 sm:pt-10">
      <a href="<?= base_url('gallery') ?>" 
         class="group inline-flex items-center text-forest-900 font-semibold text-xs sm:text-base hover:text-forest-700 transition-colors">
        <span class="border-b border-forest-900/40 group-hover:border-forest-700 pb-0.5">View Gallery</span>
        <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
        </svg>
      </a>
    </div>

  </div>
</section>


<!-- SECTION 6: GUEST STORIES -->
<section class="py-14 sm:py-20 md:py-28 bg-warm-white" aria-label="Guest Stories">
  <div class="max-w-site mx-auto px-5 sm:px-8 md:px-12">
    
    <!-- Section Heading -->
    <div class="text-center max-w-xl mx-auto space-y-2 mb-10 sm:mb-12 md:mb-16">
      <div class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700">
        Guest Stories
      </div>
      <h2 class="font-serif text-3xl sm:text-5xl font-bold text-ink">
        Stories from the forest.
      </h2>
    </div>

    <!-- Restrained Testimonial Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 max-w-4xl mx-auto">
      
      <!-- Story 1 -->
      <div class="relative bg-warm-white border border-stone/50 rounded-2xl p-6 sm:p-8 md:p-10 shadow-sm overflow-hidden flex flex-col justify-between">
        <div class="absolute top-4 right-4 w-24 sm:w-28 pointer-events-none opacity-10 text-moss">
          <img src="<?= base_url('assets/icons/leaf-branch.svg') ?>" alt="" class="w-full h-auto" />
        </div>
        <div class="space-y-3 sm:space-y-4 relative z-10">
          <div class="text-forest-700">
            <svg class="w-7 h-7 sm:w-8 sm:h-8 opacity-80" fill="currentColor" viewBox="0 0 24 24">
              <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
            </svg>
          </div>
          <p class="font-serif text-lg sm:text-xl md:text-2xl text-ink leading-snug">
            &ldquo;The early morning safari was the highlight of our trip.&rdquo;
          </p>
        </div>
        <div class="pt-4 sm:pt-6 border-t border-stone/20 mt-4 sm:mt-6 relative z-10">
          <span class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700">Guest Experience</span>
        </div>
      </div>

      <!-- Story 2 -->
      <div class="relative bg-warm-white border border-stone/50 rounded-2xl p-6 sm:p-8 md:p-10 shadow-sm overflow-hidden flex flex-col justify-between">
        <div class="absolute top-4 right-4 w-24 sm:w-28 pointer-events-none opacity-10 text-moss">
          <img src="<?= base_url('assets/icons/leaf-branch.svg') ?>" alt="" class="w-full h-auto" />
        </div>
        <div class="space-y-3 sm:space-y-4 relative z-10">
          <div class="text-forest-700">
            <svg class="w-7 h-7 sm:w-8 sm:h-8 opacity-80" fill="currentColor" viewBox="0 0 24 24">
              <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
            </svg>
          </div>
          <p class="font-serif text-lg sm:text-xl md:text-2xl text-ink leading-snug">
            &ldquo;Peaceful moments, beautiful forests and memories to take home.&rdquo;
          </p>
        </div>
        <div class="pt-4 sm:pt-6 border-t border-stone/20 mt-4 sm:mt-6 relative z-10">
          <span class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700">Guest Experience</span>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- SECTION 7: FINAL CTA BANNER -->
<?= $this->include('partials/enquiry-cta') ?>

<?= $this->endSection() ?>
