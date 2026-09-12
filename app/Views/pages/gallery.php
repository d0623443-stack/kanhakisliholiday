<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- INNER HERO (Breadcrumb Banner) -->
<section class="relative bg-forest-950 text-warm-white flex flex-col justify-start items-center pt-32 sm:pt-40 md:pt-52 lg:pt-56 pb-16 md:pb-24 overflow-hidden">
  <div class="absolute inset-0 z-0">
    <img src="<?= base_url('assets/images/tiger-portrait.jpg') ?>" 
         alt="Kanha wildlife" 
         class="w-full h-full object-cover object-center opacity-60" />
    <!-- Top-to-bottom dark shadow covering menu section for effortless legibility -->
    <div class="absolute inset-0 bg-gradient-to-b from-forest-950/95 via-forest-950/50 to-forest-950/90"></div>
  </div>

  <div class="relative z-10 max-w-site mx-auto px-5 sm:px-8 md:px-12 text-center max-w-3xl">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="Breadcrumb" class="inline-flex items-center space-x-2 text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full bg-forest-950/70 border border-warm-white/15 text-sage mb-4 shadow-sm backdrop-blur-sm">
      <a href="<?= base_url('/') ?>" class="hover:text-warm-white transition-colors">Home</a>
      <span class="text-stone/60">/</span>
      <span class="text-warm-white font-bold">Gallery</span>
    </nav>

    <div class="text-xs font-semibold tracking-widest-plus uppercase text-sage mb-3">
      Visual Chronicles
    </div>
    <h1 class="font-serif text-4xl sm:text-6xl md:text-7xl font-bold text-warm-white leading-tight">
      A glimpse of Kanha.
    </h1>
    <p class="mt-6 text-stone text-base sm:text-lg md:text-xl font-normal leading-relaxed">
      A curated collection of wildlife encounters, deep sal canopy trails, vivid birdlife, and quiet moments in the jungle.
    </p>
  </div>
</section>


<!-- GALLERY SECTION -->
<section class="py-16 md:py-24 bg-warm-white" aria-label="Kanha Wildlife Gallery">
  <div class="max-w-site mx-auto px-5 sm:px-8 md:px-12">
    
    <!-- Filter Category Buttons -->
    <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-3 mb-12 md:mb-16">
      <button type="button" 
              class="gallery-filter-btn px-5 py-2 rounded-full text-sm font-medium transition-all duration-200 bg-forest-900 text-warm-white shadow-sm"
              data-filter="all">
        All Moments
      </button>
      <button type="button" 
              class="gallery-filter-btn px-5 py-2 rounded-full text-sm font-medium transition-all duration-200 bg-ivory text-forest-900 hover:bg-stone/30"
              data-filter="wildlife">
        Wildlife
      </button>
      <button type="button" 
              class="gallery-filter-btn px-5 py-2 rounded-full text-sm font-medium transition-all duration-200 bg-ivory text-forest-900 hover:bg-stone/30"
              data-filter="safari">
        Safari Trails
      </button>
      <button type="button" 
              class="gallery-filter-btn px-5 py-2 rounded-full text-sm font-medium transition-all duration-200 bg-ivory text-forest-900 hover:bg-stone/30"
              data-filter="birdlife">
        Birdlife
      </button>
      <button type="button" 
              class="gallery-filter-btn px-5 py-2 rounded-full text-sm font-medium transition-all duration-200 bg-ivory text-forest-900 hover:bg-stone/30"
              data-filter="stay">
        Stays & Grounds
      </button>
    </div>

    <!-- Gallery Grid -->
    <div id="gallery-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
      
      <?php foreach ($items as $index => $item): ?>
        <div class="gallery-item group relative overflow-hidden rounded-2xl bg-sand border border-stone/40 shadow-sm cursor-pointer transition-all duration-300 hover:shadow-lg"
             data-category="<?= esc($item['category']) ?>"
             data-src="<?= base_url(esc($item['image'])) ?>"
             data-title="<?= esc($item['title']) ?>"
             data-subtitle="<?= esc($item['subtitle']) ?>"
             tabindex="0"
             role="button"
             aria-label="View <?= esc($item['title']) ?> in lightbox">
          
          <!-- Image with Controlled Aspect Ratios -->
          <div class="w-full <?= $item['aspect'] === 'tall' ? 'h-96' : 'h-72' ?> overflow-hidden">
            <img src="<?= base_url(esc($item['image'])) ?>" 
                 alt="<?= esc($item['title']) ?>" 
                 loading="lazy"
                 decoding="async"
                 class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out" />
          </div>

          <!-- Subtle Hover Overlay with Title -->
          <div class="absolute inset-0 bg-gradient-to-t from-forest-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6 text-warm-white">
            <span class="text-xs uppercase tracking-widest text-sage"><?= esc($item['subtitle']) ?></span>
            <h3 class="font-serif text-xl font-bold leading-snug"><?= esc($item['title']) ?></h3>
          </div>

        </div>
      <?php endforeach; ?>

    </div>

  </div>
</section>


<!-- ACCESSIBLE LIGHTBOX MODAL -->
<div id="gallery-lightbox" 
     class="fixed inset-0 z-50 hidden bg-forest-950/90 backdrop-blur-md flex items-center justify-center p-4 sm:p-6"
     role="dialog" 
     aria-modal="true" 
     aria-label="Image Lightbox Viewer">
  
  <!-- Close Button -->
  <button id="lightbox-close" 
          type="button" 
          class="absolute top-6 right-6 w-12 h-12 rounded-full bg-forest-900/80 hover:bg-forest-800 text-warm-white flex items-center justify-center border border-forest-700 focus:outline-none focus:ring-2 focus:ring-sage transition-colors z-20"
          aria-label="Close Lightbox">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
  </button>

  <!-- Prev Button -->
  <button id="lightbox-prev" 
          type="button" 
          class="absolute left-4 sm:left-8 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-forest-900/80 hover:bg-forest-800 text-warm-white flex items-center justify-center border border-forest-700 focus:outline-none focus:ring-2 focus:ring-sage transition-colors z-20"
          aria-label="Previous Image">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
  </button>

  <!-- Next Button -->
  <button id="lightbox-next" 
          type="button" 
          class="absolute right-4 sm:right-8 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-forest-900/80 hover:bg-forest-800 text-warm-white flex items-center justify-center border border-forest-700 focus:outline-none focus:ring-2 focus:ring-sage transition-colors z-20"
          aria-label="Next Image">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
  </button>

  <!-- Lightbox Content Container -->
  <div class="relative max-w-4xl max-h-[85vh] flex flex-col items-center">
    <img id="lightbox-img" 
         src="" 
         alt="" 
         class="max-h-[75vh] w-auto object-contain rounded-xl shadow-2xl border border-forest-800/80" />
    
    <div class="mt-4 text-center text-warm-white space-y-1">
      <h3 id="lightbox-title" class="font-serif text-xl sm:text-2xl font-bold"></h3>
      <p id="lightbox-subtitle" class="text-xs sm:text-sm text-sage tracking-wider uppercase"></p>
    </div>
  </div>

</div>

<!-- FINAL CTA -->
<?= $this->include('partials/enquiry-cta') ?>

<?= $this->endSection() ?>
