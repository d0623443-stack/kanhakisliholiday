<?php
$isTransparent = !empty($isTransparentHeader);
$helplinePhone = get_site_setting('helpline_phone', '+91 94251 00000');
$ownerPhone    = get_site_setting('owner_phone', '');
$topEmail      = get_site_setting('notification_mail', 'stay@kanhakisliholiday.com');
$topWa         = get_site_setting('whatsapp_number', '+91 94251 00000');
?>
<header id="site-header" 
        class="header-wrapper fixed top-0 left-0 right-0 z-40 w-full pt-2 pb-2 md:pt-2.5 md:pb-4 <?= $isTransparent ? 'bg-transparent text-warm-white' : 'bg-forest-950/90 text-warm-white backdrop-blur-md' ?>"
        data-transparent="<?= $isTransparent ? 'true' : 'false' ?>">
  
  <!-- Top-Down Dark Shadow overlay covering menu section for effortless legibility -->
  <div class="header-top-shadow absolute top-0 left-0 right-0 h-48 md:h-64 bg-gradient-to-b from-forest-950/95 via-forest-950/70 to-transparent pointer-events-none -z-10"></div>

  <!-- TOP TRANSPARENT CONTACT SECTION (Mobile & Email Bar) -->
  <div class="header-top-bar w-full border-b border-white/15 pb-2 mb-2 sm:pb-2.5 sm:mb-3">
    <div class="w-full max-w-site mx-auto px-4 sm:px-6 md:px-8 flex items-center justify-between text-xs sm:text-[13px] tracking-wide">
      
      <!-- Left: Mobile Numbers -->
      <div class="flex items-center gap-2 sm:gap-2.5 min-w-0">
        <!-- Single Phone Icon for contact numbers -->
        <span class="w-5 h-5 rounded-full bg-white/10 flex items-center justify-center text-[#D4B87C] shrink-0">
          <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
          </svg>
        </span>
        
        <!-- Primary Mobile Number -->
        <a href="tel:<?= preg_replace('/\s+/', '', $helplinePhone) ?>" 
           class="text-warm-white hover:text-[#D4B87C] transition-colors font-sans font-semibold text-xs sm:text-sm shrink-0"
           title="Call <?= esc($helplinePhone) ?>">
          <?= esc($helplinePhone) ?>
        </a>

        <!-- Additional Mobile Number (if set) -->
        <?php if (!empty($ownerPhone)): ?>
          <span class="text-white/40 font-light select-none">/</span>
          <a href="tel:<?= preg_replace('/\s+/', '', $ownerPhone) ?>" 
             class="text-warm-white hover:text-[#D4B87C] transition-colors font-sans font-semibold text-xs sm:text-sm shrink-0"
             title="Call <?= esc($ownerPhone) ?>">
            <?= esc($ownerPhone) ?>
          </a>
        <?php endif; ?>
      </div>

      <!-- Right: Email & WhatsApp -->
      <div class="flex items-center gap-3 sm:gap-4.5 shrink-0">
        <!-- Inquiry Email -->
        <a href="mailto:<?= esc($topEmail) ?>" 
           class="inline-flex items-center gap-1.5 text-warm-white hover:text-[#D4B87C] transition-colors font-medium group"
           title="Send Email Enquiry">
          <span class="w-5 h-5 rounded-full bg-white/10 flex items-center justify-center text-[#D4B87C] group-hover:bg-[#D4B87C]/20 transition-colors">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
          </span>
          <span class="font-sans text-xs sm:text-sm truncate max-w-[170px] sm:max-w-none"><?= esc($topEmail) ?></span>
        </a>

        <!-- WhatsApp Chat Desk -->
        <?php if (!empty($topWa)): ?>
          <span class="text-white/25 hidden md:inline">&vert;</span>
          <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $topWa) ?>?text=Hello%20Kanha%20Kisli%20Holiday,%20I%20am%20interested%20in%20safari%20booking" 
             target="_blank" 
             rel="noopener noreferrer" 
             class="hidden md:inline-flex items-center gap-1.5 text-warm-white hover:text-[#25D366] transition-colors font-medium"
             title="Chat with Safari Desk on WhatsApp">
            <span class="w-2 h-2 rounded-full bg-[#25D366] animate-pulse"></span>
            <span class="text-xs font-semibold">WhatsApp Desk</span>
          </a>
        <?php endif; ?>
      </div>

    </div>
  </div>

  <div class="w-full max-w-site mx-auto px-4 sm:px-6 md:px-8 flex justify-center">
    
    <!-- Desktop Header: Pill Container that smoothly morphs on scroll -->
    <div id="header-pill" class="header-pill hidden md:flex items-center justify-between w-full relative">
      
      <!-- Left Navigation (Home, About Us & Safari) -->
      <nav class="relative z-10 flex-1 flex items-center justify-end pr-8 lg:pr-12 text-base lg:text-[17px]">
        <div class="header-nav-inner relative h-28 flex items-center space-x-9 lg:space-x-12 transition-all duration-300">
          <a href="<?= base_url('/') ?>" 
             class="nav-link relative py-1.5 <?= ($activeNav ?? '') === 'home' ? 'is-active opacity-100 font-semibold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-[2px] after:bg-current' : 'opacity-85 hover:opacity-100' ?>">
            Home
          </a>
          <a href="<?= base_url('/#about') ?>" 
             class="nav-link relative py-1.5 opacity-85 hover:opacity-100">
            About Us
          </a>
          <a href="<?= base_url('safari') ?>" 
             class="nav-link relative py-1.5 <?= ($activeNav ?? '') === 'safari' ? 'is-active opacity-100 font-semibold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-[2px] after:bg-current' : 'opacity-85 hover:opacity-100' ?>">
            Safari
          </a>
        </div>
      </nav>

      <!-- Center Emblem / Logo Badge -->
      <div class="header-logo-container relative z-10 flex-shrink-0 flex items-center justify-center mx-2 w-28 h-28 transition-all duration-300">
        <a href="<?= base_url('/') ?>" 
           class="group block transition-transform duration-300 hover:scale-105 relative z-10" 
           aria-label="Kanha Kisli Holiday - Return to Homepage">
          <img id="header-logo-badge" 
               src="<?= base_url('assets/images/logo.png') ?>" 
               alt="Kanha Kisli Holiday Logo" 
               class="header-logo-badge w-28 h-28 rounded-full object-contain filter drop-shadow-[0_8px_20px_rgba(0,0,0,0.45)]" />
        </a>
      </div>

      <!-- Right Navigation (Accommodation, Gallery, Contact) -->
      <nav class="relative z-10 flex-1 flex items-center justify-start pl-8 lg:pl-12 text-base lg:text-[17px]">
        <div class="header-nav-inner relative h-28 flex items-center space-x-9 lg:space-x-12 transition-all duration-300">
          <a href="<?= base_url('accommodation') ?>" 
             class="nav-link relative py-1.5 <?= ($activeNav ?? '') === 'accommodation' ? 'is-active opacity-100 font-semibold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-[2px] after:bg-current' : 'opacity-85' ?>">
            Accommodation
          </a>
          <a href="<?= base_url('gallery') ?>" 
             class="nav-link relative py-1.5 <?= ($activeNav ?? '') === 'gallery' ? 'is-active opacity-100 font-semibold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-[2px] after:bg-current' : 'opacity-85' ?>">
            Gallery
          </a>
          <a href="<?= base_url('contact') ?>" 
             class="nav-link relative py-1.5 <?= ($activeNav ?? '') === 'contact' ? 'is-active opacity-100 font-semibold after:content-[\'\'] after:absolute after:bottom-0 after:left-0 after:right-0 after:h-[2px] after:bg-current' : 'opacity-85' ?>">
            Contact
          </a>
        </div>
      </nav>

    </div>

    <!-- Mobile Header Container (Full-Width Edge-to-Edge Navigation Bar) -->
    <div id="mobile-header-bar" class="mobile-bar md:hidden flex items-center justify-between w-full transition-all duration-300">
      <a href="<?= base_url('/') ?>" class="flex items-center space-x-2.5 sm:space-x-3 group min-w-0">
        <img src="<?= base_url('assets/images/logo.png') ?>" 
             alt="Kanha Kisli Holiday Logo" 
             class="mobile-logo w-11 h-11 sm:w-12 sm:h-12 rounded-full object-contain filter drop-shadow-md flex-shrink-0 transition-transform duration-300 group-hover:scale-105" />
        <span class="mobile-brand-title font-serif text-base sm:text-lg tracking-wider font-semibold text-warm-white truncate transition-colors">KANHA KISLI HOLIDAY</span>
      </a>

      <!-- Hamburger Button -->
      <button id="mobile-menu-open" 
              type="button" 
              class="mobile-menu-btn p-2 sm:p-2.5 rounded-full border border-current/30 text-current hover:bg-current/10 focus:outline-none focus:ring-2 focus:ring-sage flex-shrink-0 ml-2 transition-colors"
              aria-label="Open navigation menu"
              aria-expanded="false"
              aria-controls="mobile-drawer">
        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>

  </div>
</header>
