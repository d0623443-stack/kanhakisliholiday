<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- INNER HERO (Breadcrumb Banner) -->
<section class="relative bg-forest-950 text-warm-white flex flex-col justify-start items-center pt-32 sm:pt-40 md:pt-52 lg:pt-56 pb-14 sm:pb-16 md:pb-20 overflow-hidden">
  <div class="absolute inset-0 z-0">
    <img src="<?= base_url('assets/images/forest-lodge.jpg') ?>" 
         alt="Kanha Kisli Holiday Resort and cottages nestled under sal trees" 
         class="w-full h-full object-cover object-center filter brightness-90 transform scale-105 transition-transform duration-10000" />
    <div class="absolute inset-0 bg-gradient-to-b from-forest-950/95 via-forest-950/70 to-forest-950/95"></div>
  </div>

  <div class="relative z-10 max-w-site mx-auto px-5 sm:px-8 text-center max-w-3xl">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="Breadcrumb" class="inline-flex items-center space-x-2 text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full bg-forest-950/70 border border-warm-white/15 text-sage mb-3 sm:mb-4 shadow-sm backdrop-blur-sm">
      <a href="<?= base_url('/') ?>" class="hover:text-warm-white transition-colors">Home</a>
      <span class="text-stone/60">/</span>
      <span class="text-warm-white font-bold">Accommodation</span>
    </nav>

    <div class="text-xs font-semibold tracking-widest-plus uppercase text-[#D4B87C] mb-2">
      Hospitality in the Wild &middot; Kanha Kisli
    </div>
    <h1 class="font-serif text-3xl sm:text-5xl md:text-6xl font-bold text-warm-white leading-tight">
      Rest Between the Adventures
    </h1>
    <p class="mt-2.5 sm:mt-3 text-stone text-xs sm:text-base md:text-lg font-normal leading-relaxed max-w-2xl mx-auto">
      Peaceful, nature-immersed cottages surrounded by ancient Sal trees. Thoughtful comforts, fresh local cuisine, and starlit wilderness evenings.
    </p>

    <!-- Quick Jump Buttons -->
    <div class="mt-5 sm:mt-6 flex flex-wrap items-center justify-center gap-2.5 sm:gap-3">
      <a href="#stay-booking-form-card" 
         class="inline-flex items-center justify-center px-5 sm:px-6 py-2 sm:py-2.5 rounded-full bg-[#D4B87C] hover:bg-[#c4a668] text-forest-950 font-semibold text-xs sm:text-sm transition-all duration-200 shadow-md hover:shadow-lg hover:-translate-y-0.5">
        <span>Book Your Stay</span>
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
      </a>
      <a href="#cottage-categories" 
         class="inline-flex items-center justify-center px-5 sm:px-6 py-2 sm:py-2.5 rounded-full bg-forest-900/70 hover:bg-forest-900 text-warm-white border border-stone/30 font-medium text-xs sm:text-sm backdrop-blur-sm transition-all duration-200 hover:-translate-y-0.5">
        <span>Explore Rooms</span>
        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </a>
    </div>
  </div>
</section>


<!-- MAIN 2-COLUMN SECTION: GALLERY & OVERVIEW (LEFT) + COMPACT STICKY FORM (RIGHT) -->
<section id="stay-booking" class="py-8 sm:py-14 md:py-20 bg-warm-white relative scroll-mt-24">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 lg:items-start relative">
      
      <!-- LEFT COLUMN: Image Gallery & Stay Overview (65%) -->
      <div class="w-full lg:w-[65%] space-y-8 sm:space-y-10">
        
        <!-- Interactive Gallery Showcase -->
        <div class="space-y-3 sm:space-y-4">
          <!-- Main Hero Image Frame -->
          <div class="relative w-full h-[260px] sm:h-[380px] md:h-[480px] lg:h-[520px] rounded-2xl sm:rounded-3xl overflow-hidden shadow-xl bg-forest-950 border border-stone/30 group">
            <img id="gallery-main-img" 
                 src="<?= base_url('assets/images/hotel/hotel-pool-aerial.jpg') ?>" 
                 alt="Aerial view of Kanha Kisli Holiday resort swimming pool and forest canopy" 
                 class="w-full h-full object-cover transition-opacity duration-300 transform group-hover:scale-105 transition-transform duration-700" />
            
            <!-- Dark Gradient Vignette for Text Contrast -->
            <div class="absolute inset-0 bg-gradient-to-t from-forest-950/85 via-transparent to-black/20 pointer-events-none"></div>
            
            <!-- Floating Image Caption Info -->
            <div class="absolute bottom-3 sm:bottom-5 left-3 sm:left-5 right-3 sm:right-5 flex items-end justify-between pointer-events-none">
              <div class="space-y-0.5 sm:space-y-1">
                <span id="gallery-tag" class="inline-block text-[10px] sm:text-[11px] font-mono uppercase tracking-wider px-2.5 py-0.5 sm:px-3 sm:py-1 rounded-full bg-forest-900/90 text-[#D4B87C] border border-[#D4B87C]/40 backdrop-blur-md">
                  Resort Grounds &middot; Nature Pool
                </span>
                <h3 id="gallery-caption" class="text-base sm:text-2xl font-serif font-bold text-warm-white drop-shadow">
                  Serene Swimming Pool &amp; Elevated Canopy Huts Under Sal Trees
                </h3>
              </div>
              <div id="gallery-counter" class="text-[11px] sm:text-xs font-mono px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-full bg-black/60 backdrop-blur-md text-warm-white border border-warm-white/20">
                1 / 4
              </div>
            </div>

            <!-- Left & Right Carousel Navigation Buttons -->
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
          </div>

          <!-- Thumbnail Strip -->
          <div class="grid grid-cols-4 gap-2 sm:gap-4">
            <!-- Thumb 1: Pool & Aerial Grounds -->
            <button type="button" 
                    onclick="selectGallerySlide(0)" 
                    class="gallery-thumb group relative rounded-xl sm:rounded-2xl overflow-hidden aspect-video border-2 border-[#D4B87C] ring-2 ring-[#D4B87C]/50 shadow-md transition-all cursor-pointer">
              <img src="<?= base_url('assets/images/hotel/hotel-pool-aerial.jpg') ?>" alt="Resort Swimming Pool" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
              <div class="absolute inset-0 bg-forest-950/20 group-hover:bg-transparent transition-colors"></div>
              <span class="absolute bottom-1.5 left-2 text-[10px] font-bold text-warm-white drop-shadow hidden sm:block">Pool Deck</span>
            </button>

            <!-- Thumb 2: Deluxe Bedroom Interior -->
            <button type="button" 
                    onclick="selectGallerySlide(1)" 
                    class="gallery-thumb group relative rounded-xl sm:rounded-2xl overflow-hidden aspect-video border-2 border-transparent hover:border-[#D4B87C]/60 shadow-md transition-all cursor-pointer opacity-70 hover:opacity-100">
              <img src="<?= base_url('assets/images/hotel/hotel-room-interior.jpg') ?>" alt="Cottage Bedroom Interior" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
              <div class="absolute inset-0 bg-forest-950/20 group-hover:bg-transparent transition-colors"></div>
              <span class="absolute bottom-1.5 left-2 text-[10px] font-bold text-warm-white drop-shadow hidden sm:block">Bedroom</span>
            </button>

            <!-- Thumb 3: Private Veranda -->
            <button type="button" 
                    onclick="selectGallerySlide(2)" 
                    class="gallery-thumb group relative rounded-xl sm:rounded-2xl overflow-hidden aspect-video border-2 border-transparent hover:border-[#D4B87C]/60 shadow-md transition-all cursor-pointer opacity-70 hover:opacity-100">
              <img src="<?= base_url('assets/images/hotel/hotel-veranda-coffee.jpg') ?>" alt="Private Cottage Veranda" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
              <div class="absolute inset-0 bg-forest-950/20 group-hover:bg-transparent transition-colors"></div>
              <span class="absolute bottom-1.5 left-2 text-[10px] font-bold text-warm-white drop-shadow hidden sm:block">Veranda</span>
            </button>

            <!-- Thumb 4: Open-Air Lounge & Dining -->
            <button type="button" 
                    onclick="selectGallerySlide(3)" 
                    class="gallery-thumb group relative rounded-xl sm:rounded-2xl overflow-hidden aspect-video border-2 border-transparent hover:border-[#D4B87C]/60 shadow-md transition-all cursor-pointer opacity-70 hover:opacity-100">
              <img src="<?= base_url('assets/images/hotel/hotel-dining-pavilion.jpg') ?>" alt="Dining & Lounge Pavilion" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
              <div class="absolute inset-0 bg-forest-950/20 group-hover:bg-transparent transition-colors"></div>
              <span class="absolute bottom-1.5 left-2 text-[10px] font-bold text-warm-white drop-shadow hidden sm:block">Dining</span>
            </button>
          </div>
        </div>

        <!-- Mobile Quick Booking Jump Callout (Visible on Mobile Only) -->
        <div class="lg:hidden bg-gradient-to-r from-forest-950 via-forest-900 to-forest-950 p-4 rounded-2xl border border-[#D4B87C]/40 shadow-lg flex items-center justify-between gap-3 text-warm-white">
          <div class="space-y-0.5 min-w-0">
            <span class="inline-flex items-center gap-1.5 text-[10px] sm:text-xs font-mono font-semibold uppercase tracking-wider text-[#D4B87C]">
              <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
              Forest Stays & Cottages
            </span>
            <div class="text-xs sm:text-sm font-medium text-warm-white truncate">Reserve your stay in Kanha</div>
          </div>
          <a href="#stay-booking-form-card" 
             class="px-4 py-2 rounded-full bg-[#D4B87C] hover:bg-[#c4a668] text-forest-950 font-semibold text-xs whitespace-nowrap shadow transition-colors flex items-center gap-1 shrink-0 cursor-pointer">
            <span>Inquire Now</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
          </a>
        </div>

        <!-- Title & Introduction -->
        <div class="pt-2">
          <div class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700 mb-2">
            Kanha National Park &middot; Khatia / Kisli Gate Border
          </div>
          <h2 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-ink leading-tight mb-4">
            Where Nature Remains the Central Guest
          </h2>
          <p class="text-body text-base sm:text-lg leading-relaxed">
            Our resort cottages are built using earthy stone, warm seasoned wood, and terracotta tiles, blending harmoniously into the surrounding Sal forest. Located just moments from the Khatia and Kisli safari gates, your mornings begin unhurried with birdsong, steaming chai on private verandas, and swift access to your 4x4 Gypsy safari.
          </p>
        </div>

        <!-- Detailed Room Categories Breakdown -->
        <div id="cottage-categories" class="space-y-6 pt-2 scroll-mt-24">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <h3 class="font-serif text-2xl sm:text-3xl font-bold text-ink">
              Cottage & Room Categories
            </h3>
            <span class="text-xs font-semibold uppercase tracking-wider text-forest-700 bg-forest-900/10 px-3 py-1 rounded-full w-fit">
              Tailored for Wildlife Travellers
            </span>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            
            <!-- Category 1: Forest Cottage -->
            <div class="rounded-2xl bg-ivory border border-stone/40 overflow-hidden hover:border-[#D4B87C] transition-colors shadow-xs group">
              <div class="h-44 sm:h-48 overflow-hidden relative">
                <img src="<?= base_url('assets/images/hotel/hotel-room-interior.jpg') ?>" alt="Forest Cottage Bedroom" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <span class="absolute top-3 right-3 text-[11px] font-mono font-bold px-2.5 py-1 rounded-full bg-forest-950/80 text-[#D4B87C] border border-[#D4B87C]/40 backdrop-blur-md"><?= esc($content['cottage1_price'] ?? '₹5,500 / night') ?></span>
              </div>
              <div class="p-5 space-y-2.5">
                <span class="font-serif text-xl font-bold text-ink block"><?= esc($content['cottage1_title'] ?? 'Forest Cottages') ?></span>
                <p class="text-body text-xs sm:text-sm leading-relaxed">
                  <?= esc($content['cottage1_desc'] ?? 'Independent stone and timber cottages surrounded by sal trees, offering private open verandas and modern ensuite baths.') ?>
                </p>
                <div class="pt-2 text-xs text-forest-800/80 space-y-1 border-t border-stone/30">
                  <div>&bull; King Bed &middot; Private Veranda &middot; En-suite Rain Shower</div>
                  <div>&bull; Max Occupancy: 2 Adults + 1 Child</div>
                </div>
              </div>
            </div>

            <!-- Category 2: Deluxe Family Veranda Suite -->
            <div class="rounded-2xl bg-ivory border border-stone/40 overflow-hidden hover:border-[#D4B87C] transition-colors shadow-xs group">
              <div class="h-44 sm:h-48 overflow-hidden relative">
                <img src="<?= base_url('assets/images/hotel/hotel-veranda-coffee.jpg') ?>" alt="Deluxe Family Veranda Suite" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <span class="absolute top-3 right-3 text-[11px] font-mono font-bold px-2.5 py-1 rounded-full bg-forest-950/80 text-[#D4B87C] border border-[#D4B87C]/40 backdrop-blur-md"><?= esc($content['cottage2_price'] ?? '₹8,500 / night') ?></span>
              </div>
              <div class="p-5 space-y-2.5">
                <span class="font-serif text-xl font-bold text-ink block"><?= esc($content['cottage2_title'] ?? 'Deluxe Family Veranda Suites') ?></span>
                <p class="text-body text-xs sm:text-sm leading-relaxed">
                  <?= esc($content['cottage2_desc'] ?? 'Spacious dual-bedroom family retreat with extended viewing veranda facing the inner garden canopy.') ?>
                </p>
                <div class="pt-2 text-xs text-forest-800/80 space-y-1 border-t border-stone/30">
                  <div>&bull; Lounge Area &middot; Open Sky Shower &middot; Private Garden</div>
                  <div>&bull; Max Occupancy: 3 Adults or 2 Adults + 2 Children</div>
                </div>
              </div>
            </div>

            <!-- Category 3: Machan Treehouse Villa -->
            <div class="rounded-2xl bg-ivory border border-stone/40 overflow-hidden hover:border-[#D4B87C] transition-colors shadow-xs group">
              <div class="h-44 sm:h-48 overflow-hidden relative">
                <img src="<?= base_url('assets/images/hotel/hotel-pool-aerial.jpg') ?>" alt="Machan Treehouse Villas" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <span class="absolute top-3 right-3 text-[11px] font-mono font-bold px-2.5 py-1 rounded-full bg-forest-950/80 text-[#D4B87C] border border-[#D4B87C]/40 backdrop-blur-md"><?= esc($content['cottage3_price'] ?? '₹12,000 / night') ?></span>
              </div>
              <div class="p-5 space-y-2.5">
                <span class="font-serif text-xl font-bold text-ink block"><?= esc($content['cottage3_title'] ?? 'Machan Treehouse Villas') ?></span>
                <p class="text-body text-xs sm:text-sm leading-relaxed">
                  <?= esc($content['cottage3_desc'] ?? 'Elevated wooden stilt hideaway nestled directly into the forest canopy with 360-degree wilderness outlooks.') ?>
                </p>
                <div class="pt-2 text-xs text-forest-800/80 space-y-1 border-t border-stone/30">
                  <div>&bull; Canopy Deck &middot; Stargazing Balcony &middot; Solar Powered</div>
                  <div>&bull; Max Occupancy: 2 Adults</div>
                </div>
              </div>
            </div>

            <!-- Category 4: Family Forest Suite -->
            <div class="rounded-2xl bg-ivory border border-stone/40 overflow-hidden hover:border-[#D4B87C] transition-colors shadow-xs group">
              <div class="h-44 sm:h-48 overflow-hidden relative">
                <img src="<?= base_url('assets/images/hotel/hotel-dining-pavilion.jpg') ?>" alt="Family Forest Suite" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <span class="absolute top-3 right-3 text-[11px] font-mono font-bold px-2.5 py-1 rounded-full bg-forest-950/80 text-[#D4B87C] border border-[#D4B87C]/40 backdrop-blur-md">Families &amp; Groups</span>
              </div>
              <div class="p-5 space-y-2.5">
                <span class="font-serif text-xl font-bold text-ink block">Family Forest Suite</span>
                <p class="text-body text-xs sm:text-sm leading-relaxed">
                  Two interconnected bedroom suites with shared living deck and courtyard. Perfectly tailored for families wanting privacy and togetherness.
                </p>
                <div class="pt-2 text-xs text-forest-800/80 space-y-1 border-t border-stone/30">
                  <div>&bull; 2 Bedrooms &middot; 2 Bathrooms &middot; Family Living Deck</div>
                  <div>&bull; Max Occupancy: 4-6 Guests</div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Comforts & Dining Experience Card -->
        <div class="bg-ivory/80 rounded-3xl p-7 sm:p-9 border border-stone/40 shadow-sm space-y-6">
          <h3 class="font-serif text-2xl sm:text-3xl font-bold text-ink flex items-center gap-3">
            <span class="w-3 h-3 rounded-full bg-[#D4B87C]"></span>
            Thoughtful Comforts & Homestyle Dining
          </h3>
          
          <div class="text-body text-sm sm:text-base leading-relaxed space-y-4">
            <p>
              Dining at Kanha Kisli Holiday is rooted in fresh seasonal ingredients sourced from regional organic farms. Enjoy wholesome breakfast hampers packed fresh for dawn safaris, relaxed poolside lunches under the trees, and lantern-lit evening buffets featuring local Bundelkhandi and Indian specialties.
            </p>
          </div>

          <!-- Key Amenities Badges Grid -->
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-2">
            <div class="bg-warm-white p-4 rounded-2xl border border-stone/30 text-center shadow-xs">
              <span class="block font-serif text-xl sm:text-2xl font-bold text-forest-900">5 Mins</span>
              <span class="text-xs text-forest-700/80 font-medium">To Khatia Gate</span>
            </div>
            <div class="bg-warm-white p-4 rounded-2xl border border-stone/30 text-center shadow-xs">
              <span class="block font-serif text-xl sm:text-2xl font-bold text-forest-900">100%</span>
              <span class="text-xs text-forest-700/80 font-medium">Power Backup & Hot Water</span>
            </div>
            <div class="bg-warm-white p-4 rounded-2xl border border-stone/30 text-center shadow-xs">
              <span class="block font-serif text-xl sm:text-2xl font-bold text-forest-900">Poolside</span>
              <span class="text-xs text-forest-700/80 font-medium">Forest Dining & Bonfire</span>
            </div>
            <div class="bg-warm-white p-4 rounded-2xl border border-stone/30 text-center shadow-xs">
              <span class="block font-serif text-xl sm:text-2xl font-bold text-forest-900">Safari Desk</span>
              <span class="text-xs text-forest-700/80 font-medium">Doorstep Gypsy Pickup</span>
            </div>
          </div>
        </div>

        <!-- Stay Policies & Guidelines -->
        <div class="p-5 rounded-2xl bg-[#D4B87C]/15 border border-[#D4B87C]/40 text-xs text-forest-900 space-y-2">
          <span class="font-bold block text-sm text-forest-950">Stay Policies & Check-in Guidelines:</span>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-body">
            <div>&bull; <strong>Check-in:</strong> 12:00 PM | <strong>Check-out:</strong> 11:00 AM</div>
            <div>&bull; <strong>Photo ID:</strong> Mandatory at check-in (Aadhaar / Passport)</div>
            <div>&bull; <strong>Meals:</strong> Breakfast, Lunch & Dinner options available</div>
            <div>&bull; <strong>Safari Transfers:</strong> Pickup directly from cottage entrance</div>
          </div>
        </div>

      </div>

      <!-- RIGHT COLUMN: Compact Sticky Stay Booking Enquiry Form (35%) -->
      <div id="stay-booking-form-card" class="w-full lg:w-[35%] lg:sticky lg:top-28 z-20 scroll-mt-28">
        <div class="bg-forest-950 text-warm-white rounded-3xl p-6 sm:p-8 shadow-2xl border border-stone/30 relative overflow-hidden backdrop-blur-md">
          
          <!-- Golden Accent Line -->
          <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-transparent via-[#D4B87C] to-transparent"></div>

          <div class="mb-5 space-y-1">
            <span class="text-[11px] font-mono uppercase tracking-widest text-[#D4B87C] font-semibold block">Direct Resort Rates</span>
            <h3 class="text-2xl font-serif font-bold text-warm-white">Inquire Stay Booking</h3>
            <p class="text-stone text-xs leading-relaxed">
              Check live cottage availability & plan your Kanha holiday.
            </p>
          </div>

          <!-- Flash Messages (Inside card for instant visibility) -->
          <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-4 p-4 rounded-2xl bg-forest-900 border border-[#D4B87C]/60 text-warm-white text-xs leading-relaxed flex items-start gap-2.5 shadow-md">
              <div class="p-1 rounded-full bg-[#D4B87C] text-forest-950 shrink-0 mt-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
              </div>
              <div>
                <strong class="block text-warm-white font-bold mb-0.5">Reservation Request Received!</strong>
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

          <!-- Compact Form (Matching safari page style) -->
          <form action="<?= base_url('accommodation/book') ?>" method="POST" class="space-y-4">
            <?= csrf_field() ?>
            <input type="hidden" name="resort_name" value="Kanha Kisli Holiday">

            <!-- Full Name -->
            <div>
              <label for="stay-name" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                Full Name <span class="text-[#D4B87C]">*</span>
              </label>
              <input type="text" 
                     id="stay-name" 
                     name="name" 
                     required 
                     value="<?= old('name') ?>" 
                     placeholder="e.g. Vikramaditya Sharma" 
                     class="w-full px-3.5 py-2.5 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white placeholder-stone/50 focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm" />
            </div>

            <!-- 2-Col: Mobile * & Email -->
            <div class="grid grid-cols-2 gap-3">
              <div>
                <label for="stay-phone" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                  Mobile <span class="text-[#D4B87C]">*</span>
                </label>
                <input type="tel" 
                       id="stay-phone" 
                       name="phone" 
                       required 
                       value="<?= old('phone') ?>" 
                       placeholder="+91 98765..." 
                       class="w-full px-3.5 py-2.5 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white placeholder-stone/50 focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm" />
              </div>
              <div>
                <label for="stay-email" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                  Email
                </label>
                <input type="email" 
                       id="stay-email" 
                       name="email" 
                       value="<?= old('email') ?>" 
                       placeholder="name@mail.com" 
                       class="w-full px-3.5 py-2.5 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white placeholder-stone/50 focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm" />
              </div>
            </div>

            <!-- 2-Col: Check-in * & Check-out * -->
            <div class="grid grid-cols-2 gap-3">
              <div>
                <label for="stay-checkin" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                  Check-in <span class="text-[#D4B87C]">*</span>
                </label>
                <input type="date" 
                       id="stay-checkin" 
                       name="checkin" 
                       required 
                       min="<?= date('Y-m-d') ?>" 
                       value="<?= old('checkin') ?>" 
                       class="w-full px-3 py-2.5 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm" />
              </div>
              <div>
                <label for="stay-checkout" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                  Check-out <span class="text-[#D4B87C]">*</span>
                </label>
                <input type="date" 
                       id="stay-checkout" 
                       name="checkout" 
                       required 
                       min="<?= date('Y-m-d', strtotime('+1 day')) ?>" 
                       value="<?= old('checkout') ?>" 
                       class="w-full px-3 py-2.5 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm" />
              </div>
            </div>

            <!-- Cottage Category Dropdown -->
            <div>
              <label for="stay-room" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                Cottage Category <span class="text-[#D4B87C]">*</span>
              </label>
              <select id="stay-room" 
                      name="room_type" 
                      required 
                      class="w-full px-3.5 py-2.5 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm">
                <option value="Deluxe Forest Cottage" <?= old('room_type') === 'Deluxe Forest Cottage' ? 'selected' : '' ?>>Deluxe Forest Cottage (King Bed & Veranda)</option>
                <option value="Luxury Sal Villa" <?= old('room_type') === 'Luxury Sal Villa' ? 'selected' : '' ?>>Luxury Sal Villa (Lounge & Open Sky Shower)</option>
                <option value="Machan Treehouse Stay" <?= old('room_type') === 'Machan Treehouse Stay' ? 'selected' : '' ?>>Machan Treehouse Stay (Canopy Living)</option>
                <option value="Family Forest Suite" <?= old('room_type') === 'Family Forest Suite' ? 'selected' : '' ?>>Family Forest Suite (Interconnected Rooms)</option>
                <option value="Standard Forest Room" <?= old('room_type') === 'Standard Forest Room' ? 'selected' : '' ?>>Standard Forest Room</option>
              </select>
            </div>

            <!-- 2-Col: Guests (Adults) & Children -->
            <div class="grid grid-cols-2 gap-3">
              <div>
                <label for="stay-adults" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                  Adults
                </label>
                <select id="stay-adults" 
                        name="adults" 
                        class="w-full px-3 py-2.5 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm">
                  <option value="1" <?= old('adults') === '1' ? 'selected' : '' ?>>1 Adult</option>
                  <option value="2" <?= old('adults') === '2' || !old('adults') ? 'selected' : '' ?>>2 Adults</option>
                  <option value="3" <?= old('adults') === '3' ? 'selected' : '' ?>>3 Adults</option>
                  <option value="4" <?= old('adults') === '4' ? 'selected' : '' ?>>4 Adults</option>
                  <option value="5" <?= old('adults') === '5' ? 'selected' : '' ?>>5+ Adults</option>
                </select>
              </div>
              <div>
                <label for="stay-children" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                  Children (0-12 yrs)
                </label>
                <select id="stay-children" 
                        name="children" 
                        class="w-full px-3 py-2.5 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm">
                  <option value="0" <?= old('children') === '0' || !old('children') ? 'selected' : '' ?>>0 Children</option>
                  <option value="1" <?= old('children') === '1' ? 'selected' : '' ?>>1 Child</option>
                  <option value="2" <?= old('children') === '2' ? 'selected' : '' ?>>2 Children</option>
                  <option value="3" <?= old('children') === '3' ? 'selected' : '' ?>>3+ Children</option>
                </select>
              </div>
            </div>

            <!-- Meal Plan Preference -->
            <div>
              <label for="stay-meal" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                Meal Plan Preference
              </label>
              <select id="stay-meal" 
                      name="meal_plan" 
                      class="w-full px-3.5 py-2.5 rounded-xl bg-forest-900/90 border border-stone/40 text-warm-white focus:outline-none focus:border-[#D4B87C] focus:ring-1 focus:ring-[#D4B87C] transition-all text-xs sm:text-sm">
                <option value="All Meals Included (Breakfast, Lunch & Dinner)" <?= old('meal_plan') === 'All Meals Included (Breakfast, Lunch & Dinner)' ? 'selected' : '' ?>>All Meals (Breakfast, Lunch & Dinner - AP)</option>
                <option value="Breakfast & Dinner (MAP)" <?= old('meal_plan') === 'Breakfast & Dinner (MAP)' ? 'selected' : '' ?>>Breakfast & Dinner (MAP)</option>
                <option value="Breakfast Included (CP)" <?= old('meal_plan') === 'Breakfast Included (CP)' || !old('meal_plan') ? 'selected' : '' ?>>Breakfast Only (CP)</option>
                <option value="Room Only (EP)" <?= old('meal_plan') === 'Room Only (EP)' ? 'selected' : '' ?>>Room Only (EP)</option>
              </select>
            </div>

            <!-- Special Requests / Notes -->
            <div>
              <label for="stay-notes" class="block text-[11px] font-semibold uppercase tracking-wider text-stone mb-1.5">
                Special Requests / Safari Packages
              </label>
              <textarea id="stay-notes" 
                        name="notes" 
                        rows="2" 
                        placeholder="Safari combos, anniversary setup, resort pickup details..." 
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
                🔒 Direct Resort Booking &middot; No advance charge until cottage is confirmed.
              </span>
            </div>

          </form>

          <!-- Direct Phone / WhatsApp Wildlife Desk Assistance inside sticky card -->
          <?php 
            $stayDeskPhone = get_site_setting('owner_phone') ?: get_site_setting('helpline_phone', '+91 94251 00000'); 
            $stayWaPhone   = get_site_setting('whatsapp_number', '+91 94251 00000');
          ?>
          <div class="mt-5 pt-4 border-t border-stone/20 flex items-center justify-between">
            <div class="text-[11px] text-stone">
              <span>Direct Reservation Desk:</span>
              <a href="tel:<?= preg_replace('/\s+/', '', $stayDeskPhone) ?>" class="block font-bold text-[#D4B87C] hover:underline"><?= esc($stayDeskPhone) ?></a>
            </div>
            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $stayWaPhone) ?>?text=Hi%20Kanha%20Kisli%20Holiday,%20I%20want%20to%20inquire%20about%20cottage%20stay%20booking" 
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


<!-- SECTION: RESPONSIBLE ECO-TOURISM CALLOUT -->
<section class="py-16 bg-warm-white border-t border-stone/30">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-ivory rounded-3xl p-8 sm:p-10 border border-stone/40 shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
      <div class="space-y-2 max-w-2xl">
        <span class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700">Eco-Conscious Wilderness</span>
        <h3 class="font-serif text-2xl sm:text-3xl font-bold text-ink">Sustainable Forest Living</h3>
        <p class="text-body text-sm leading-relaxed">
          We honor Kanha's pristine ecology. Our lodge minimizes single-use plastics, harvests rainwater, employs indigenous naturalists, and uses solar-assisted energy so that your stay actively supports the forest and local communities.
        </p>
      </div>
      <div class="flex-shrink-0">
        <a href="<?= base_url('contact') ?>" 
           class="inline-flex items-center justify-center px-7 py-3.5 rounded-full bg-forest-900 hover:bg-forest-800 text-warm-white text-sm font-medium transition-colors shadow-sm">
          <span>Contact Reservation Team</span>
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
  const galleryImages = [
    {
      src: "<?= base_url('assets/images/hotel/hotel-pool-aerial.jpg') ?>",
      alt: "Aerial view of Kanha Kisli Holiday resort swimming pool and forest canopy",
      tag: "Resort Grounds · Nature Pool",
      caption: "Serene Swimming Pool & Elevated Canopy Huts Under Sal Trees"
    },
    {
      src: "<?= base_url('assets/images/hotel/hotel-room-interior.jpg') ?>",
      alt: "Luxury twin cottage bedroom with handcrafted furniture and balcony view",
      tag: "Cottage Bedroom · Forest View",
      caption: "Handcrafted Teakwood Interiors & Forest Balcony Outlook"
    },
    {
      src: "<?= base_url('assets/images/hotel/hotel-veranda-coffee.jpg') ?>",
      alt: "Private wooden veranda sit-out with artisanal coffee and daybed lounger",
      tag: "Private Veranda · Sal Forest",
      caption: "Unhurried Morning Chai & Coffee on Your Private Veranda"
    },
    {
      src: "<?= base_url('assets/images/hotel/hotel-dining-pavilion.jpg') ?>",
      alt: "Open-air wooden lounge and dining pavilion with lanterns and forest panorama",
      tag: "Dining & Lounge · Wilderness Deck",
      caption: "Open-Air Forest Lounge Pavilion & Evening Fireside Gatherings"
    }
  ];

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
