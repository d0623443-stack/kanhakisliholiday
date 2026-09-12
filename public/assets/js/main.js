/**
 * Kanha Kisli Holiday — Main Client-Side Interactions
 */

document.addEventListener('DOMContentLoaded', () => {
  initHeader();
  initMobileMenu();
  initHeroSlider();
  initGallery();
});

/* -------------------------------------------------------------------------- */
/* 1. Header Scroll Behavior                                                  */
/* -------------------------------------------------------------------------- */
function initHeader() {
  const header = document.getElementById('site-header');
  if (!header) return;

  const isTransparent = header.getAttribute('data-transparent') === 'true';

  const updateHeaderState = () => {
    const isScrolled = window.scrollY > 40;
    header.classList.toggle('is-scrolled', isScrolled);

    if (isTransparent) {
      if (isScrolled) {
        header.classList.remove('bg-transparent');
      } else {
        header.classList.add('bg-transparent');
      }
    }
  };

  window.addEventListener('scroll', updateHeaderState, { passive: true });
  updateHeaderState();
}

/* -------------------------------------------------------------------------- */
/* 2. Mobile Navigation Drawer                                                */
/* -------------------------------------------------------------------------- */
function initMobileMenu() {
  const openBtn = document.getElementById('mobile-menu-open');
  const closeBtn = document.getElementById('mobile-menu-close');
  const drawer = document.getElementById('mobile-drawer');
  const panel = document.getElementById('mobile-panel');
  const backdrop = document.getElementById('mobile-backdrop');

  if (!openBtn || !drawer || !panel) return;

  const openMenu = () => {
    drawer.classList.remove('opacity-0', 'pointer-events-none');
    drawer.classList.add('opacity-100');
    panel.classList.remove('translate-x-full');
    panel.classList.add('translate-x-0');
    openBtn.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden';
    if (closeBtn) closeBtn.focus();
  };

  const closeMenu = () => {
    drawer.classList.remove('opacity-100');
    drawer.classList.add('opacity-0', 'pointer-events-none');
    panel.classList.remove('translate-x-0');
    panel.classList.add('translate-x-full');
    openBtn.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
    openBtn.focus();
  };

  openBtn.addEventListener('click', openMenu);
  if (closeBtn) closeBtn.addEventListener('click', closeMenu);
  if (backdrop) backdrop.addEventListener('click', closeMenu);

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !drawer.classList.contains('pointer-events-none')) {
      closeMenu();
    }
  });
}

/* -------------------------------------------------------------------------- */
/* 3. Hero Slider                                                             */
/* -------------------------------------------------------------------------- */
function initHeroSlider() {
  const slider = document.getElementById('hero-slider');
  if (!slider) return;

  const slides = Array.from(slider.querySelectorAll('.hero-slide'));
  const prevBtn = document.getElementById('hero-prev');
  const nextBtn = document.getElementById('hero-next');
  const counterCurrent = document.getElementById('slide-counter-current');
  const counterTotal = document.getElementById('slide-counter-total');
  const bars = Array.from(slider.querySelectorAll('.hero-bar'));

  if (!slides.length) return;

  if (counterTotal) {
    counterTotal.textContent = String(slides.length).padStart(2, '0');
  }

  let currentIndex = 0;
  let autoplayTimer = null;
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  const showSlide = (index) => {
    currentIndex = (index + slides.length) % slides.length;

    slides.forEach((slide, idx) => {
      if (idx === currentIndex) {
        slide.classList.remove('opacity-0');
        slide.classList.add('opacity-100');
      } else {
        slide.classList.remove('opacity-100');
        slide.classList.add('opacity-0');
      }
    });

    if (counterCurrent) {
      counterCurrent.textContent = String(currentIndex + 1).padStart(2, '0');
    }

    bars.forEach((bar, idx) => {
      if (idx === currentIndex) {
        bar.classList.remove('bg-warm-white/30');
        bar.classList.add('bg-warm-white');
      } else {
        bar.classList.remove('bg-warm-white');
        bar.classList.add('bg-warm-white/30');
      }
    });

    // Update dynamic slide text if available
    const activeSlide = slides[currentIndex];
    if (activeSlide) {
      const eyebrowEl = document.getElementById('hero-eyebrow');
      const titleEl = document.getElementById('hero-title');
      const subtitleEl = document.getElementById('hero-subtitle');
      const descEl = document.getElementById('hero-desc');
      const btnWaEl = document.getElementById('hero-btn-wa');
      const btnCallEl = document.getElementById('hero-btn-call');

      if (eyebrowEl && activeSlide.dataset.eyebrow) eyebrowEl.textContent = activeSlide.dataset.eyebrow;
      if (titleEl && activeSlide.dataset.title) titleEl.textContent = activeSlide.dataset.title;
      if (subtitleEl && activeSlide.dataset.subtitle) subtitleEl.textContent = activeSlide.dataset.subtitle;
      if (descEl && activeSlide.dataset.description) descEl.textContent = activeSlide.dataset.description;
      if (btnWaEl && activeSlide.dataset.btn1Link) btnWaEl.href = activeSlide.dataset.btn1Link;
      if (btnCallEl && activeSlide.dataset.btn2Link) btnCallEl.href = activeSlide.dataset.btn2Link;
    }
  };

  const nextSlide = () => showSlide(currentIndex + 1);
  const prevSlide = () => showSlide(currentIndex - 1);

  if (nextBtn) nextBtn.addEventListener('click', () => { resetAutoplay(); nextSlide(); });
  if (prevBtn) prevBtn.addEventListener('click', () => { resetAutoplay(); prevSlide(); });

  const startAutoplay = () => {
    if (prefersReducedMotion) return;
    stopAutoplay();
    autoplayTimer = setInterval(nextSlide, 4500);
  };

  const stopAutoplay = () => {
    if (autoplayTimer) {
      clearInterval(autoplayTimer);
      autoplayTimer = null;
    }
  };

  const resetAutoplay = () => {
    stopAutoplay();
    startAutoplay();
  };

  // Pause only when hovering over next/prev control buttons
  if (prevBtn) {
    prevBtn.addEventListener('mouseenter', stopAutoplay);
    prevBtn.addEventListener('mouseleave', startAutoplay);
  }
  if (nextBtn) {
    nextBtn.addEventListener('mouseenter', stopAutoplay);
    nextBtn.addEventListener('mouseleave', startAutoplay);
  }

  // Keyboard navigation
  slider.setAttribute('tabindex', '0');
  slider.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight') { resetAutoplay(); nextSlide(); }
    else if (e.key === 'ArrowLeft') { resetAutoplay(); prevSlide(); }
  });

  // Mobile Touch Swipe support
  let touchStartX = 0;
  let touchEndX = 0;
  slider.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
  }, { passive: true });
  slider.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].screenX;
    if (touchStartX - touchEndX > 50) {
      resetAutoplay();
      nextSlide();
    } else if (touchEndX - touchStartX > 50) {
      resetAutoplay();
      prevSlide();
    }
  }, { passive: true });

  startAutoplay();
}

/* -------------------------------------------------------------------------- */
/* 4. Gallery Filter & Lightbox                                               */
/* -------------------------------------------------------------------------- */
function initGallery() {
  const filterBtns = Array.from(document.querySelectorAll('.gallery-filter-btn'));
  const items = Array.from(document.querySelectorAll('.gallery-item'));
  const lightbox = document.getElementById('gallery-lightbox');
  const lightboxImg = document.getElementById('lightbox-img');
  const lightboxTitle = document.getElementById('lightbox-title');
  const lightboxSubtitle = document.getElementById('lightbox-subtitle');
  const lightboxClose = document.getElementById('lightbox-close');
  const lightboxPrev = document.getElementById('lightbox-prev');
  const lightboxNext = document.getElementById('lightbox-next');

  // Filtering
  if (filterBtns.length && items.length) {
    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const filter = btn.getAttribute('data-filter');

        // Update active button classes
        filterBtns.forEach(b => {
          b.classList.remove('bg-forest-900', 'text-warm-white', 'shadow-sm');
          b.classList.add('bg-ivory', 'text-forest-900');
        });
        btn.classList.add('bg-forest-900', 'text-warm-white', 'shadow-sm');
        btn.classList.remove('bg-ivory');

        // Filter items
        items.forEach(item => {
          const category = item.getAttribute('data-category');
          if (filter === 'all' || category === filter) {
            item.style.display = '';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  }

  // Lightbox
  if (!lightbox || !lightboxImg) return;

  let visibleItems = [];
  let currentLightboxIdx = 0;

  const updateLightboxContent = (index) => {
    currentLightboxIdx = (index + visibleItems.length) % visibleItems.length;
    const current = visibleItems[currentLightboxIdx];
    if (!current) return;

    const src = current.getAttribute('data-src');
    const title = current.getAttribute('data-title') || '';
    const subtitle = current.getAttribute('data-subtitle') || '';

    lightboxImg.src = src;
    lightboxImg.alt = title;
    if (lightboxTitle) lightboxTitle.textContent = title;
    if (lightboxSubtitle) lightboxSubtitle.textContent = subtitle;
  };

  const openLightbox = (clickedItem) => {
    visibleItems = items.filter(item => item.style.display !== 'none');
    currentLightboxIdx = visibleItems.indexOf(clickedItem);
    if (currentLightboxIdx === -1) currentLightboxIdx = 0;

    updateLightboxContent(currentLightboxIdx);
    lightbox.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    if (lightboxClose) lightboxClose.focus();
  };

  const closeLightbox = () => {
    lightbox.classList.add('hidden');
    document.body.style.overflow = '';
  };

  items.forEach(item => {
    item.addEventListener('click', () => openLightbox(item));
    item.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        openLightbox(item);
      }
    });
  });

  if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
  if (lightboxPrev) lightboxPrev.addEventListener('click', () => updateLightboxContent(currentLightboxIdx - 1));
  if (lightboxNext) lightboxNext.addEventListener('click', () => updateLightboxContent(currentLightboxIdx + 1));

  lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox) closeLightbox();
  });

  document.addEventListener('keydown', (e) => {
    if (lightbox.classList.contains('hidden')) return;

    if (e.key === 'Escape') closeLightbox();
    else if (e.key === 'ArrowLeft') updateLightboxContent(currentLightboxIdx - 1);
    else if (e.key === 'ArrowRight') updateLightboxContent(currentLightboxIdx + 1);
  });
}
