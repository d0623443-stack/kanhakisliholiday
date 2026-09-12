<!-- Accessible Mobile Navigation Drawer -->
<div id="mobile-drawer" 
     class="fixed inset-0 z-50 pointer-events-none transition-opacity duration-300 opacity-0"
     role="dialog" 
     aria-modal="true" 
     aria-label="Site Navigation">
  
  <!-- Backdrop -->
  <div id="mobile-backdrop" 
       class="absolute inset-0 bg-forest-950/70 backdrop-blur-sm transition-opacity duration-300"></div>

  <!-- Off-canvas panel -->
  <div id="mobile-panel" 
       class="relative ml-auto w-full max-w-sm h-full bg-forest-950 text-ivory flex flex-col justify-between p-6 sm:p-8 transform translate-x-full transition-transform duration-300 ease-in-out pointer-events-auto border-l border-forest-800">
    
    <!-- Top Bar with Close Button -->
    <div class="flex items-center justify-between pb-6 border-b border-forest-800/80">
      <div class="flex items-center space-x-3">
        <img src="<?= base_url('assets/images/logo.png') ?>" 
             alt="Kanha Kisli Holiday Logo" 
             class="w-10 h-10 rounded-full object-contain filter drop-shadow-md" />
        <div>
          <span class="block text-sm font-semibold tracking-wider text-warm-white">KANHA KISLI</span>
          <span class="block text-xs text-sage tracking-widest uppercase">Holiday</span>
        </div>
      </div>

      <button id="mobile-menu-close" 
              type="button" 
              class="w-10 h-10 rounded-full border border-forest-700/60 flex items-center justify-center text-ivory hover:bg-forest-900 transition-colors focus:outline-none focus:ring-2 focus:ring-sage"
              aria-label="Close navigation menu">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!-- Navigation Links -->
    <nav class="my-auto py-8 space-y-4">
      <a href="<?= base_url('/') ?>" 
         class="block text-2xl font-serif italic py-2 px-3 rounded-lg transition-colors <?= ($activeNav ?? '') === 'home' ? 'text-warm-white bg-forest-900 font-semibold' : 'text-stone hover:text-warm-white hover:bg-forest-900/50' ?>">
        Home
      </a>
      <a href="<?= base_url('/#about') ?>" 
         class="block text-2xl font-serif italic py-2 px-3 rounded-lg transition-colors text-stone hover:text-warm-white hover:bg-forest-900/50">
        About Us
      </a>
      <a href="<?= base_url('safari') ?>" 
         class="block text-2xl font-serif italic py-2 px-3 rounded-lg transition-colors <?= ($activeNav ?? '') === 'safari' ? 'text-warm-white bg-forest-900 font-semibold' : 'text-stone hover:text-warm-white hover:bg-forest-900/50' ?>">
        Safari
      </a>
      <a href="<?= base_url('accommodation') ?>" 
         class="block text-2xl font-serif italic py-2 px-3 rounded-lg transition-colors <?= ($activeNav ?? '') === 'accommodation' ? 'text-warm-white bg-forest-900 font-semibold' : 'text-stone hover:text-warm-white hover:bg-forest-900/50' ?>">
        Accommodation
      </a>
      <a href="<?= base_url('gallery') ?>" 
         class="block text-2xl font-serif italic py-2 px-3 rounded-lg transition-colors <?= ($activeNav ?? '') === 'gallery' ? 'text-warm-white bg-forest-900 font-semibold' : 'text-stone hover:text-warm-white hover:bg-forest-900/50' ?>">
        Gallery
      </a>
      <a href="<?= base_url('contact') ?>" 
         class="block text-2xl font-serif italic py-2 px-3 rounded-lg transition-colors <?= ($activeNav ?? '') === 'contact' ? 'text-warm-white bg-forest-900 font-semibold' : 'text-stone hover:text-warm-white hover:bg-forest-900/50' ?>">
        Contact
      </a>
    </nav>

    <!-- Bottom Contact Details -->
    <div class="pt-6 border-t border-forest-800/80 space-y-4">
      <div class="text-xs tracking-wider uppercase text-sage">Kanha National Park, MP</div>

      <!-- Quick Contact Links in Drawer -->
      <div class="space-y-2.5 text-xs">
        <a href="tel:<?= preg_replace('/\s+/', '', get_site_setting('helpline_phone', '+91 94251 00000')) ?>" 
           class="flex items-center gap-2.5 text-stone hover:text-warm-white transition-colors">
          <span class="w-6 h-6 rounded-full bg-forest-900 border border-forest-700/60 flex items-center justify-center text-[#D4B87C] shrink-0">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          </span>
          <span class="font-sans font-medium text-warm-white"><?= esc(get_site_setting('helpline_phone', '+91 94251 00000')) ?></span>
        </a>

        <?php if (!empty($drawerOwner = get_site_setting('owner_phone', ''))): ?>
          <a href="tel:<?= preg_replace('/\s+/', '', $drawerOwner) ?>" 
             class="flex items-center gap-2.5 text-stone hover:text-warm-white transition-colors">
            <span class="w-6 h-6 rounded-full bg-forest-900 border border-forest-700/60 flex items-center justify-center text-[#D4B87C] shrink-0">
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </span>
            <span class="font-sans font-medium text-warm-white"><?= esc($drawerOwner) ?></span>
          </a>
        <?php endif; ?>

        <a href="mailto:<?= esc(get_site_setting('notification_mail', 'stay@kanhakisliholiday.com')) ?>" 
           class="flex items-center gap-2.5 text-stone hover:text-warm-white transition-colors">
          <span class="w-6 h-6 rounded-full bg-forest-900 border border-forest-700/60 flex items-center justify-center text-[#D4B87C] shrink-0">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          </span>
          <span class="font-sans text-xs text-warm-white truncate"><?= esc(get_site_setting('notification_mail', 'stay@kanhakisliholiday.com')) ?></span>
        </a>
      </div>

      <a href="<?= base_url('contact') ?>" 
         class="inline-flex items-center justify-center w-full px-5 py-3 rounded-full bg-forest-800 hover:bg-forest-700 text-warm-white font-medium text-sm transition-colors border border-forest-600/40">
        <span>Plan Your Safari</span>
        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
        </svg>
      </a>
    </div>

  </div>
</div>
