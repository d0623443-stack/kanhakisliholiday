<?php
$isTransparent = !empty($isTransparentHeader);
?>
<header id="site-header" 
        class="header-wrapper fixed top-0 left-0 right-0 z-40 w-full pt-3 pb-3 md:pt-5 md:pb-5 <?= $isTransparent ? 'bg-transparent text-warm-white' : 'bg-forest-950/90 text-warm-white backdrop-blur-md' ?>"
        data-transparent="<?= $isTransparent ? 'true' : 'false' ?>">
  
  <!-- Top-Down Dark Shadow overlay covering menu section for effortless legibility -->
  <div class="header-top-shadow absolute top-0 left-0 right-0 h-44 md:h-60 bg-gradient-to-b from-forest-950/95 via-forest-950/65 to-transparent pointer-events-none -z-10"></div>

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
          <a href="<?= base_url('admin/login') ?>" 
             title="Staff / Admin Portal"
             class="nav-link relative py-1.5 opacity-75 hover:opacity-100 flex items-center gap-1 text-xs uppercase tracking-wider text-[#D4B87C] hover:text-warm-white">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            <span>Admin</span>
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
