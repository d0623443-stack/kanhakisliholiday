<?php
$isTransparent = !empty($isTransparentHeader);
$helplinePhone = get_helpline_phone();
$ownerPhone    = get_owner_phone('');
$topEmail      = get_site_setting('notification_mail', 'bookings@kanhakisliholiday.in');
$topWa         = get_whatsapp_number();
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
      <div class="flex items-center gap-1.5 sm:gap-2.5 min-w-0">
        <!-- Single Phone Icon for contact numbers -->
        <span class="w-5 h-5 rounded-full bg-white/10 flex items-center justify-center text-[#D4B87C] shrink-0">
          <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
          </svg>
        </span>
        
        <!-- Primary Mobile Number -->
        <a href="tel:<?= preg_replace('/\s+/', '', $helplinePhone) ?>" 
           class="text-warm-white hover:text-[#D4B87C] transition-colors font-sans font-semibold text-xs sm:text-sm shrink-0 whitespace-nowrap"
           title="Call <?= esc($helplinePhone) ?>">
          <?= esc($helplinePhone) ?>
        </a>

        <!-- Additional Mobile Number (if set) - visible on desktop -->
        <?php if (!empty($ownerPhone)): ?>
          <span class="text-white/40 font-light select-none hidden md:inline">/</span>
          <a href="tel:<?= preg_replace('/\s+/', '', $ownerPhone) ?>" 
             class="text-warm-white hover:text-[#D4B87C] transition-colors font-sans font-semibold text-xs sm:text-sm shrink-0 whitespace-nowrap hidden md:inline"
             title="Call <?= esc($ownerPhone) ?>">
            <?= esc($ownerPhone) ?>
          </a>
        <?php endif; ?>
      </div>

      <!-- Right: Email & WhatsApp -->
      <div class="flex items-center gap-2 sm:gap-4 shrink-0">
        <!-- Inquiry Email with Hover Popover & 1-Click Copy -->
        <div class="email-tooltip-wrapper" id="header-email-wrapper">
          <button type="button" 
                  id="top-email-trigger"
                  class="inline-flex items-center gap-1.5 text-warm-white hover:text-[#D4B87C] transition-colors font-medium group shrink-0 focus:outline-none cursor-pointer"
                  aria-label="Official Email: <?= esc($topEmail) ?> - Hover or tap to view and copy">
            <span class="w-5 h-5 rounded-full bg-white/10 flex items-center justify-center text-[#D4B87C] group-hover:bg-[#D4B87C]/25 transition-colors shrink-0">
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z" />
              </svg>
            </span>
            <!-- Desktop: Full Email | Mobile: Compact 'Email' so it never overlaps with phone -->
            <span class="font-sans text-xs sm:text-sm hidden md:inline text-warm-white group-hover:text-[#D4B87C] transition-colors font-medium whitespace-nowrap">
              <?= esc($topEmail) ?>
            </span>
            <span class="font-sans text-xs font-semibold text-warm-white md:hidden whitespace-nowrap">
              Email
            </span>
            <!-- Small copy indicator icon -->
            <svg class="w-3.5 h-3.5 text-[#D4B87C]/75 group-hover:text-[#D4B87C] transition-colors shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" title="Click to view & copy">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
          </button>

          <!-- Hover & Tap Popover Card -->
          <div id="email-popover-card" class="email-popover-box" onclick="event.stopPropagation()">
            <div class="space-y-2.5">
              
              <div class="flex items-center justify-between gap-2">
                <span class="text-[10px] font-mono uppercase tracking-widest text-[#D4B87C]">Official Contact Email</span>
                <span id="copy-status-badge" class="hidden text-[10px] font-semibold text-emerald-300 bg-emerald-950 px-2 py-0.5 rounded-full border border-emerald-500/40">
                  ✓ Copied to clipboard!
                </span>
              </div>

              <!-- Full Email Address Display Box -->
              <div class="p-2.5 rounded-xl bg-forest-900/90 border border-white/10 flex items-center justify-between gap-2">
                <span id="email-text-val" class="font-mono text-xs sm:text-[13px] text-warm-white select-all break-all leading-snug font-medium">
                  <?= esc($topEmail) ?>
                </span>
              </div>

              <!-- Action Buttons -->
              <div class="grid grid-cols-2 gap-2 pt-0.5">
                <button type="button" 
                        onclick="copyEmailAddress(event, '<?= esc($topEmail) ?>')"
                        id="copy-email-btn"
                        class="copy-pill-btn justify-center">
                  <svg id="copy-icon" class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                  </svg>
                  <span id="copy-btn-text">Copy Email</span>
                </button>

                <a href="mailto:<?= esc($topEmail) ?>" 
                   class="flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-warm-white text-xs font-medium border border-white/15 transition-all text-center">
                  <svg class="w-3.5 h-3.5 text-[#D4B87C] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2z" />
                  </svg>
                  <span>Send Mail</span>
                </a>
              </div>

              <div class="text-[10px] text-stone/75 text-center pt-0.5">
                Click to copy address &middot; Hover to inspect
              </div>

            </div>
          </div>
        </div>

        <!-- WhatsApp Chat Desk -->
        <?php if (!empty($topWa)): ?>
          <span class="text-white/25 hidden md:inline">&vert;</span>
          <a href="<?= esc(get_whatsapp_link($topWa, 'Hello Kanha Kisli Holiday, I am interested in safari booking')) ?>" 
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

<!-- Email Copy & Popover Interactive Styles & Script -->
<style>
.email-tooltip-wrapper {
  position: relative;
  display: inline-flex;
  align-items: center;
}
.email-popover-box {
  position: absolute;
  top: calc(100% + 8px);
  right: 0;
  z-index: 1000;
  width: 290px;
  max-width: calc(100vw - 24px);
  background: #0E1E14;
  background: rgba(14, 30, 20, 0.98);
  border: 1px solid rgba(212, 184, 124, 0.45);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border-radius: 16px;
  padding: 14px;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.65), 0 0 20px rgba(212, 184, 124, 0.2);
  opacity: 0;
  visibility: hidden;
  pointer-events: none;
  transform: translateY(6px);
  transition: opacity 0.22s ease, transform 0.22s ease, visibility 0.22s;
}

/* Hover on desktop */
.email-tooltip-wrapper:hover .email-popover-box,
.email-tooltip-wrapper:focus-within .email-popover-box,
.email-popover-box.is-active {
  opacity: 1 !important;
  visibility: visible !important;
  pointer-events: auto !important;
  transform: translateY(0) !important;
}

.email-popover-box::before {
  content: '';
  position: absolute;
  top: -6px;
  right: 22px;
  width: 12px;
  height: 12px;
  background: #0E1E14;
  background: rgba(14, 30, 20, 0.98);
  border-left: 1px solid rgba(212, 184, 124, 0.45);
  border-top: 1px solid rgba(212, 184, 124, 0.45);
  transform: rotate(45deg);
}

.copy-pill-btn {
  background: #D4B87C;
  color: #11281A;
  font-weight: 700;
  font-size: 12px;
  border-radius: 10px;
  padding: 8px 14px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  cursor: pointer;
  border: none;
  transition: all 0.2s ease;
  box-shadow: 0 2px 8px rgba(0,0,0,0.25);
}
.copy-pill-btn:hover {
  background: #e5cf9e;
  transform: translateY(-1px);
}
.copy-pill-btn.is-copied {
  background: #10B981 !important;
  color: #ffffff !important;
}

/* Floating copy toast notification */
#global-copy-toast {
  position: fixed;
  top: 70px;
  left: 50%;
  transform: translateX(-50%) translateY(-12px);
  z-index: 999999;
  background: #0E1E14;
  color: #D4B87C;
  border: 1px solid rgba(212, 184, 124, 0.6);
  backdrop-filter: blur(16px);
  padding: 8px 18px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 600;
  box-shadow: 0 12px 30px rgba(0,0,0,0.6);
  opacity: 0;
  pointer-events: none;
  transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
}
#global-copy-toast.show {
  opacity: 1;
  transform: translateX(-50%) translateY(0);
}
</style>

<script>
function showCopyToast(msg) {
  let toast = document.getElementById('global-copy-toast');
  if (!toast) {
    toast = document.createElement('div');
    toast.id = 'global-copy-toast';
    document.body.appendChild(toast);
  }
  toast.innerHTML = '✓ ' + msg;
  toast.classList.add('show');
  setTimeout(() => toast.classList.remove('show'), 2500);
}

function copyEmailAddress(event, email) {
  if (event) {
    event.preventDefault();
    event.stopPropagation();
  }

  const finishCopy = () => {
    const btnText = document.getElementById('copy-btn-text');
    const badge   = document.getElementById('copy-status-badge');
    const btn     = document.getElementById('copy-email-btn');

    if (btnText) btnText.textContent = 'Copied!';
    if (badge) badge.classList.remove('hidden');
    if (btn) btn.classList.add('is-copied');

    showCopyToast('Copied: ' + email);

    setTimeout(() => {
      if (btnText) btnText.textContent = 'Copy Email';
      if (badge) badge.classList.add('hidden');
      if (btn) btn.classList.remove('is-copied');
    }, 2500);
  };

  if (navigator.clipboard && window.isSecureContext) {
    navigator.clipboard.writeText(email)
      .then(finishCopy)
      .catch(() => fallbackCopyText(email, finishCopy));
  } else {
    fallbackCopyText(email, finishCopy);
  }
}

function fallbackCopyText(text, callback) {
  const textArea = document.createElement('textarea');
  textArea.value = text;
  textArea.style.position = 'fixed';
  textArea.style.left = '-9999px';
  textArea.style.top = '0';
  document.body.appendChild(textArea);
  textArea.focus();
  textArea.select();
  try {
    document.execCommand('copy');
    if (callback) callback();
  } catch (err) {
    console.error('Copy to clipboard failed', err);
  }
  document.body.removeChild(textArea);
}

document.addEventListener('DOMContentLoaded', function() {
  const wrapper = document.getElementById('header-email-wrapper');
  const trigger = document.getElementById('top-email-trigger');
  const popover = document.getElementById('email-popover-card');

  if (wrapper && trigger && popover) {
    trigger.addEventListener('click', function(e) {
      e.stopPropagation();
      const isActive = popover.classList.contains('is-active');
      if (isActive) {
        popover.classList.remove('is-active');
      } else {
        popover.classList.add('is-active');
      }
    });

    document.addEventListener('click', function(e) {
      if (!wrapper.contains(e.target)) {
        popover.classList.remove('is-active');
      }
    });
  }
});
</script>
