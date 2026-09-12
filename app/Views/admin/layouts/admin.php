<!DOCTYPE html>
<html lang="en" class="h-full bg-[#F6F4EE]">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($metaTitle ?? 'Admin Portal — Kanha Kisli Holiday') ?></title>
  <meta name="robots" content="noindex, nofollow">

  <!-- Google Fonts Preconnect & Stylesheet -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo.png') ?>">

  <!-- Tailwind Stylesheet -->
  <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">

  <style>
    /* Custom scrollbar for admin tables and lists */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: #F0EDE4; }
    ::-webkit-scrollbar-thumb { background: #CBC4B8; border-radius: 9999px; }
    ::-webkit-scrollbar-thumb:hover { background: #AEBCA4; }
  </style>
</head>
<body class="h-full font-sans antialiased text-body flex flex-col md:flex-row overflow-hidden select-none">

  <!-- MOBILE SIDEBAR OVERLAY -->
  <div id="admin-mobile-overlay" 
       class="fixed inset-0 bg-forest-950/70 backdrop-blur-xs z-40 md:hidden hidden transition-opacity duration-300"
       onclick="toggleAdminMobileNav()"></div>

  <!-- SIDEBAR NAVIGATION -->
  <aside id="admin-sidebar" 
         class="fixed inset-y-0 left-0 z-50 w-72 bg-[#11241B] text-warm-white flex flex-col justify-between border-r border-forest-900 shadow-2xl transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0 md:static md:shadow-none flex-shrink-0">
    
    <!-- Top Brand Header -->
    <div>
      <div class="p-6 border-b border-forest-900/80 flex items-center justify-between">
        <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center space-x-3 group">
          <div class="w-10 h-10 rounded-full bg-forest-900 border border-[#D4B87C]/40 p-1 flex items-center justify-center flex-shrink-0 shadow-md">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="Kanha Kisli Logo" class="w-full h-full object-contain">
          </div>
          <div>
            <span class="block font-serif text-lg font-bold text-warm-white tracking-wide leading-tight group-hover:text-[#D4B87C] transition-colors">
              Kanha Kisli
            </span>
            <span class="block text-[11px] font-mono tracking-widest-plus uppercase text-sage">
              Admin Portal
            </span>
          </div>
        </a>

        <!-- Mobile Close Button -->
        <button type="button" 
                onclick="toggleAdminMobileNav()" 
                class="md:hidden text-stone hover:text-warm-white p-1.5 rounded-lg hover:bg-forest-900">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      <!-- Navigation Links -->
      <nav class="p-4 space-y-1.5">
        
        <!-- 1. Dashboard -->
        <a href="<?= base_url('admin/dashboard') ?>" 
           class="flex items-center space-x-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all <?= ($activeNav ?? '') === 'dashboard' ? 'bg-forest-900 text-[#D4B87C] font-semibold shadow-inner border border-forest-700/60' : 'text-stone hover:bg-forest-900/60 hover:text-warm-white' ?>">
          <svg class="w-5 h-5 flex-shrink-0 <?= ($activeNav ?? '') === 'dashboard' ? 'text-[#D4B87C]' : 'text-sage' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
          </svg>
          <span>Dashboard</span>
        </a>

        <!-- 2. Hero Slider -->
        <a href="<?= base_url('admin/slider') ?>" 
           class="flex items-center space-x-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all <?= ($activeNav ?? '') === 'slider' ? 'bg-forest-900 text-[#D4B87C] font-semibold shadow-inner border border-forest-700/60' : 'text-stone hover:bg-forest-900/60 hover:text-warm-white' ?>">
          <svg class="w-5 h-5 flex-shrink-0 <?= ($activeNav ?? '') === 'slider' ? 'text-[#D4B87C]' : 'text-sage' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
          <span>Hero Slider</span>
        </a>

        <!-- 3. Site Content -->
        <a href="<?= base_url('admin/content') ?>" 
           class="flex items-center space-x-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all <?= ($activeNav ?? '') === 'content' ? 'bg-forest-900 text-[#D4B87C] font-semibold shadow-inner border border-forest-700/60' : 'text-stone hover:bg-forest-900/60 hover:text-warm-white' ?>">
          <svg class="w-5 h-5 flex-shrink-0 <?= ($activeNav ?? '') === 'content' ? 'text-[#D4B87C]' : 'text-sage' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
          </svg>
          <span>Site Content</span>
        </a>

        <!-- 4. Photo Gallery -->
        <a href="<?= base_url('admin/gallery') ?>" 
           class="flex items-center space-x-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all <?= ($activeNav ?? '') === 'gallery' ? 'bg-forest-900 text-[#D4B87C] font-semibold shadow-inner border border-forest-700/60' : 'text-stone hover:bg-forest-900/60 hover:text-warm-white' ?>">
          <svg class="w-5 h-5 flex-shrink-0 <?= ($activeNav ?? '') === 'gallery' ? 'text-[#D4B87C]' : 'text-sage' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
          </svg>
          <span>Photo Gallery</span>
        </a>

        <!-- 5. Enquiries & Leads -->
        <a href="<?= base_url('admin/enquiries') ?>" 
           class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium transition-all <?= ($activeNav ?? '') === 'enquiries' ? 'bg-forest-900 text-[#D4B87C] font-semibold shadow-inner border border-forest-700/60' : 'text-stone hover:bg-forest-900/60 hover:text-warm-white' ?>">
          <div class="flex items-center space-x-3.5">
            <svg class="w-5 h-5 flex-shrink-0 <?= ($activeNav ?? '') === 'enquiries' ? 'text-[#D4B87C]' : 'text-sage' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <span>Enquiries & Leads</span>
          </div>
          <span class="px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-[#D4B87C] text-forest-950">
            <?= $unreadCount ?? 4 ?> New
          </span>
        </a>

        <!-- 6. Settings -->
        <a href="<?= base_url('admin/settings') ?>" 
           class="flex items-center space-x-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all <?= ($activeNav ?? '') === 'settings' ? 'bg-forest-900 text-[#D4B87C] font-semibold shadow-inner border border-forest-700/60' : 'text-stone hover:bg-forest-900/60 hover:text-warm-white' ?>">
          <svg class="w-5 h-5 flex-shrink-0 <?= ($activeNav ?? '') === 'settings' ? 'text-[#D4B87C]' : 'text-sage' ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
          <span>Settings</span>
        </a>

      </nav>
    </div>

    <!-- Bottom User Bar & View Site Action -->
    <div class="p-4 border-t border-forest-900/80 space-y-3">
      <!-- View Live Website Button -->
      <a href="<?= base_url('/') ?>" 
         target="_blank" 
         class="flex items-center justify-center space-x-2 w-full py-2.5 px-4 rounded-xl bg-forest-900/80 hover:bg-forest-800 text-sage hover:text-warm-white text-xs font-semibold uppercase tracking-wider transition-colors border border-forest-700/40">
        <span>View Live Site</span>
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
      </a>

      <!-- Admin Profile Pill -->
      <div class="flex items-center justify-between pt-1">
        <div class="flex items-center space-x-3 min-w-0">
          <div class="w-9 h-9 rounded-full bg-[#D4B87C] text-forest-950 font-bold text-sm flex items-center justify-center flex-shrink-0">
            RS
          </div>
          <div class="min-w-0">
            <span class="block text-xs font-semibold text-warm-white truncate"><?= esc($adminName ?? 'Rajesh Sharma') ?></span>
            <span class="block text-[10px] text-stone truncate"><?= esc($adminRole ?? 'General Manager') ?></span>
          </div>
        </div>

        <a href="<?= base_url('admin/logout') ?>" 
           title="Logout" 
           class="p-2 text-stone hover:text-rose-400 hover:bg-forest-900 rounded-lg transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
          </svg>
        </a>
      </div>
    </div>

  </aside>


  <!-- MAIN CONTENT WRAPPER -->
  <div class="flex-1 flex flex-col h-full overflow-hidden">
    
    <!-- TOP APP BAR -->
    <header class="h-16 bg-warm-white border-b border-stone/30 flex items-center justify-between px-4 sm:px-6 md:px-8 z-30 flex-shrink-0">
      
      <!-- Left: Mobile Menu Toggle & Breadcrumb Title -->
      <div class="flex items-center space-x-3">
        <button type="button" 
                onclick="toggleAdminMobileNav()" 
                class="md:hidden p-2 rounded-lg text-forest-950 hover:bg-stone/20 focus:outline-none">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <div>
          <h1 class="font-serif text-xl sm:text-2xl font-bold text-ink leading-tight">
            <?= esc($pageHeading ?? 'Administration') ?>
          </h1>
        </div>
      </div>

      <!-- Right: Quick Actions & Live Status Badge -->
      <div class="flex items-center space-x-3 sm:space-x-4">
        <!-- Live Status indicator -->
        <div class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-xs font-medium">
          <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
          <span>Website Live</span>
        </div>

        <!-- Direct WhatsApp Safari Desk Quick Link -->
        <a href="https://wa.me/919425100000" 
           target="_blank" 
           class="hidden sm:inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-full bg-[#25D366]/10 text-[#1b803f] border border-[#25D366]/30 hover:bg-[#25D366]/20 transition-colors text-xs font-semibold">
          <span>WhatsApp Desk</span>
        </a>

        <!-- Notifications Bell -->
        <a href="<?= base_url('admin/enquiries') ?>" 
           class="relative p-2 rounded-full text-forest-900 hover:bg-stone/20 transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
          <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-rose-500"></span>
        </a>
      </div>

    </header>

    <!-- FLASH MESSAGES NOTIFICATION -->
    <?php if (session()->getFlashdata('success')): ?>
      <div class="mx-4 sm:mx-6 md:mx-8 mt-4 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-center justify-between shadow-xs">
        <div class="flex items-center space-x-2.5 text-sm">
          <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <span class="font-medium"><?= session()->getFlashdata('success') ?></span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900 text-sm font-bold ml-4">&times;</button>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="mx-4 sm:mx-6 md:mx-8 mt-4 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 flex items-center justify-between shadow-xs">
        <div class="flex items-center space-x-2.5 text-sm">
          <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <span class="font-medium"><?= session()->getFlashdata('error') ?></span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-rose-700 hover:text-rose-900 text-sm font-bold ml-4">&times;</button>
      </div>
    <?php endif; ?>

    <!-- SCROLLABLE PAGE BODY -->
    <main class="flex-1 overflow-y-auto p-4 sm:p-6 md:p-8">
      <?= $this->renderSection('admin_content') ?>
    </main>

  </div>

  <script>
    function toggleAdminMobileNav() {
      const sidebar = document.getElementById('admin-sidebar');
      const overlay = document.getElementById('admin-mobile-overlay');
      const isOpen = !sidebar.classList.contains('-translate-x-full');

      if (isOpen) {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
      } else {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
      }
    }

    // Interactive Toast Notification Trigger
    function showAdminToast(msg, type = 'success') {
      const toast = document.createElement('div');
      toast.className = `fixed bottom-6 right-6 z-50 px-5 py-3.5 rounded-xl shadow-xl border text-sm font-medium transition-all transform translate-y-0 flex items-center space-x-2 ${
        type === 'success' ? 'bg-forest-900 text-warm-white border-forest-700' : 'bg-rose-900 text-warm-white border-rose-700'
      }`;
      toast.innerHTML = `
        <svg class="w-4 h-4 ${type === 'success' ? 'text-[#D4B87C]' : 'text-rose-300'}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        <span>${msg}</span>
      `;
      document.body.appendChild(toast);
      setTimeout(() => {
        toast.classList.add('opacity-0', 'translate-y-2');
        setTimeout(() => toast.remove(), 300);
      }, 3500);
    }
  </script>

</body>
</html>
