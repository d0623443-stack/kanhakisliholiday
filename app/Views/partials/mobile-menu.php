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
      <a href="<?= base_url('/#taxi-transfers') ?>" 
         class="block text-2xl font-serif italic py-2 px-3 rounded-lg transition-colors text-stone hover:text-warm-white hover:bg-forest-900/50">
        Taxi &amp; Transfers
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
      <div class="text-xs tracking-wider uppercase text-sage leading-relaxed"><?= esc(get_resort_address()) ?></div>

      <!-- Quick Contact Links in Drawer -->
      <div class="space-y-2.5 text-xs">
        <?php 
          $drawerHelpline = get_helpline_phone();
          $drawerOwner    = get_owner_phone('');
          $drawerWa       = get_whatsapp_number();
        ?>
        <a href="tel:<?= get_clean_phone($drawerHelpline) ?>" 
           class="flex items-center gap-2.5 text-stone hover:text-warm-white transition-colors">
          <span class="w-6 h-6 rounded-full bg-forest-900 border border-forest-700/60 flex items-center justify-center text-[#D4B87C] shrink-0">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          </span>
          <span class="font-sans font-medium text-warm-white"><?= esc($drawerHelpline) ?></span>
        </a>

        <?php if (!empty($drawerOwner)): ?>
          <a href="tel:<?= get_clean_phone($drawerOwner) ?>" 
             class="flex items-center gap-2.5 text-stone hover:text-warm-white transition-colors">
            <span class="w-6 h-6 rounded-full bg-forest-900 border border-forest-700/60 flex items-center justify-center text-[#D4B87C] shrink-0">
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </span>
            <span class="font-sans font-medium text-warm-white"><?= esc($drawerOwner) ?></span>
          </a>
        <?php endif; ?>

        <?php if (!empty($drawerWa)): ?>
          <a href="<?= esc(get_whatsapp_link($drawerWa, 'Hello Kanha Kisli Holiday, I am interested in safari booking and resort stay')) ?>" 
             target="_blank" 
             rel="noopener noreferrer" 
             class="flex items-center gap-2.5 text-stone hover:text-warm-white transition-colors">
            <span class="w-6 h-6 rounded-full bg-[#25D366]/20 border border-[#25D366]/40 flex items-center justify-center text-[#25D366] shrink-0">
              <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            </span>
            <span class="font-sans font-medium text-warm-white">WhatsApp Desk</span>
          </a>
        <?php endif; ?>

        <a href="mailto:<?= esc(get_site_email()) ?>" 
           class="flex items-center gap-2.5 text-stone hover:text-warm-white transition-colors">
          <span class="w-6 h-6 rounded-full bg-forest-900 border border-forest-700/60 flex items-center justify-center text-[#D4B87C] shrink-0">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          </span>
          <span class="font-sans text-xs text-warm-white truncate"><?= esc(get_site_email()) ?></span>
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
