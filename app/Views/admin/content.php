<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('admin_content') ?>

<div class="space-y-8 max-w-7xl mx-auto">
  
  <form method="POST" action="<?= base_url('admin/content/update') ?>" id="contentForm" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="active_tab" id="activeTabInput" value="<?= esc($activeTab ?? 'home') ?>">

    <!-- PAGE HEADER & ACTION BAR -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
      <div>
        <div class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700">
          Copy & Information Management
        </div>
        <h2 class="font-serif text-2xl sm:text-3xl font-bold text-ink">
          Site Content Editor
        </h2>
        <p class="text-xs sm:text-sm text-body mt-0.5">
          Live website copy synced directly with the database. Changes reflect instantly on frontend pages.
        </p>
      </div>

      <div class="flex items-center space-x-3">
        <a href="<?= base_url() ?>" target="_blank" class="hidden sm:inline-flex items-center px-4 py-2.5 rounded-full border border-stone/40 bg-white text-forest-900 font-semibold text-xs sm:text-sm hover:bg-stone/20 transition-all">
          <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
          <span>View Website</span>
        </a>
        <button type="submit" 
                class="inline-flex items-center justify-center px-5 py-2.5 rounded-full bg-forest-900 hover:bg-forest-800 text-warm-white font-semibold text-xs sm:text-sm shadow-md transition-all hover:-translate-y-0.5 cursor-pointer">
          <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
          <span>Save All Changes</span>
        </button>
      </div>
    </div>

    <!-- TAB NAVIGATION BAR -->
    <div class="flex flex-wrap items-center gap-2 border-b border-stone/30 pb-3 mb-6">
      <button type="button" 
              onclick="switchContentTab('home')" 
              id="btn-tab-home"
              class="content-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all <?= ($activeTab ?? 'home') === 'home' ? 'bg-forest-900 text-[#D4B87C] shadow-xs' : 'bg-warm-white text-body hover:bg-stone/20' ?>">
        1. Home Page
      </button>
      <button type="button" 
              onclick="switchContentTab('safari')" 
              id="btn-tab-safari"
              class="content-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all <?= ($activeTab ?? '') === 'safari' ? 'bg-forest-900 text-[#D4B87C] shadow-xs' : 'bg-warm-white text-body hover:bg-stone/20' ?>">
        2. Safari Page
      </button>
      <button type="button" 
              onclick="switchContentTab('accommodation')" 
              id="btn-tab-accommodation"
              class="content-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all <?= ($activeTab ?? '') === 'accommodation' ? 'bg-forest-900 text-[#D4B87C] shadow-xs' : 'bg-warm-white text-body hover:bg-stone/20' ?>">
        3. Accommodation Page
      </button>
      <button type="button" 
              onclick="switchContentTab('contact')" 
              id="btn-tab-contact"
              class="content-tab-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all <?= ($activeTab ?? '') === 'contact' ? 'bg-forest-900 text-[#D4B87C] shadow-xs' : 'bg-warm-white text-body hover:bg-stone/20' ?>">
        4. Contact & Footer
      </button>
    </div>

    <!-- TAB 1: HOME PAGE CONTENT -->
    <div id="tab-home" class="content-tab-pane space-y-6 <?= ($activeTab ?? 'home') === 'home' ? '' : 'hidden' ?>">
      
      <!-- Quick Media Navigation Banner for Home Page -->
      <div class="bg-forest-900/5 rounded-3xl border border-forest-900/15 p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-start sm:items-center space-x-3.5">
          <div class="w-10 h-10 rounded-2xl bg-forest-900 text-[#D4B87C] flex items-center justify-center shrink-0 shadow-xs">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          </div>
          <div>
            <h4 class="text-sm font-bold text-ink flex items-center gap-2">
              <span>Homepage Media & Content Editor</span>
              <span class="px-2 py-0.5 rounded-full bg-forest-900/10 text-forest-900 text-[10px] font-mono font-bold">Live Synced</span>
            </h4>
            <p class="text-xs text-muted mt-0.5">Edit copy and upload new photos for all homepage sections. Click any photo preview below to open your computer's file explorer.</p>
          </div>
        </div>
        <div class="flex items-center gap-2 shrink-0">
          <a href="<?= base_url('admin/slider') ?>" class="inline-flex items-center px-4 py-2 rounded-full bg-forest-900 hover:bg-forest-800 text-warm-white text-xs font-semibold shadow-xs transition-all hover:-translate-y-0.5">
            <svg class="w-3.5 h-3.5 mr-1.5 text-[#D4B87C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
            <span>Hero Slider Manager &rarr;</span>
          </a>
          <a href="<?= base_url('admin/gallery') ?>" class="inline-flex items-center px-4 py-2 rounded-full border border-stone/50 bg-white hover:bg-stone/20 text-ink text-xs font-semibold shadow-xs transition-all">
            <span>Gallery Manager</span>
          </a>
        </div>
      </div>

      <!-- Section 2: About Kanha Kisli Holiday Card -->
      <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-6">
        <div class="border-b border-stone/20 pb-3 flex items-center justify-between">
          <div>
            <h3 class="font-serif text-xl font-bold text-ink">Section: About Kanha Kisli Holiday</h3>
            <p class="text-xs text-muted">The introductory editorial overview section displayed immediately below the hero slider.</p>
          </div>
          <span class="text-xs font-mono text-sage">Home &middot; Section 2</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">Eyebrow Title</label>
            <input type="text" name="content[home][about_eyebrow]" value="<?= esc($content['home']['about_eyebrow']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
          </div>
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">Section Main Heading</label>
            <input type="text" name="content[home][about_title]" value="<?= esc($content['home']['about_title']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
          </div>
        </div>

        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">About Description Paragraph</label>
          <textarea name="content[home][about_desc]" rows="3" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm leading-relaxed focus:ring-2 focus:ring-forest-700/30 outline-none"><?= esc($content['home']['about_desc']) ?></textarea>
        </div>

        <!-- Section 2 Visual Media Studio (Two-Column Interactive Studio) -->
        <div class="border-t border-stone/20 pt-6 space-y-4">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
              <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 rounded-md bg-forest-900 text-[#D4B87C] text-[10px] font-mono font-bold uppercase tracking-wider">Visual Studio</span>
                <h4 class="font-serif text-lg font-bold text-ink">Section Photos &amp; Editorial Collage</h4>
              </div>
              <p class="text-xs text-muted mt-0.5">These 2 dynamic assets compose the asymmetric layered collage on the homepage. Drag &amp; drop files or click to replace.</p>
            </div>
            <div class="flex items-center gap-2">
              <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-[11px] font-semibold">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Live Dynamic Sync</span>
              </span>
            </div>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pt-2">
            
            <!-- Asset 1: Primary Forest Perspective (7 Cols) -->
            <div class="lg:col-span-7 bg-ivory/80 rounded-2xl border border-stone/40 p-5 space-y-4 flex flex-col justify-between hover:border-[#D4B87C] transition-all shadow-xs group/card">
              <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                  <span class="text-xs font-bold text-forest-900 flex items-center gap-1.5">
                    <span class="w-5 h-5 rounded-full bg-forest-900 text-[#D4B87C] text-[10px] font-mono font-bold flex items-center justify-center">01</span>
                    <span>Primary Landscape Photo</span>
                  </span>
                  <span class="text-[10px] font-mono text-muted px-2 py-0.5 rounded bg-white border border-stone/30">1200&times;800 (16:10 or 4:3)</span>
                </div>
                <p class="text-[11px] text-muted">The main background forest trail canvas that sets the atmosphere.</p>
              </div>

              <!-- Clickable & Droppable Image Studio Box -->
              <input type="file" 
                     name="file_about_primary_img" 
                     id="file-about-primary" 
                     accept="image/*" 
                     class="hidden" 
                     onchange="previewHomeImage(this, 'preview-about-primary')">
              <input type="hidden" 
                     name="content[home][about_primary_img]" 
                     value="<?= esc($content['home']['about_primary_img'] ?? 'assets/images/safari-trail.jpg') ?>">

              <div id="dropzone-about-primary"
                   onclick="document.getElementById('file-about-primary').click()" 
                   class="relative w-full h-52 sm:h-60 rounded-xl overflow-hidden bg-forest-950/20 border-2 border-dashed border-stone/50 hover:border-[#D4B87C] cursor-pointer shadow-inner group transition-all">
                <img id="preview-about-primary" 
                     src="<?= (str_starts_with($content['home']['about_primary_img'] ?? '', 'http')) ? esc($content['home']['about_primary_img']) : base_url(esc($content['home']['about_primary_img'] ?? 'assets/images/safari-trail.jpg')) ?>" 
                     alt="Primary landscape preview" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                
                <!-- Floating Corner Badges -->
                <div class="absolute top-3 left-3 bg-forest-950/70 backdrop-blur-xs text-warm-white text-[10px] font-mono px-2 py-0.5 rounded-md border border-white/15">
                  Slot 01 · Wide Landscape
                </div>

                <!-- Hover Overlay -->
                <div class="absolute inset-0 bg-forest-950/75 backdrop-blur-xs opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-warm-white text-xs font-semibold gap-2 p-4 text-center">
                  <div class="w-10 h-10 rounded-full bg-forest-900 border border-[#D4B87C] text-[#D4B87C] flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                  </div>
                  <span class="font-bold text-sm text-warm-white">Drop Photo or Click to Browse</span>
                  <span class="text-[11px] text-stone/90 font-normal">Opens file explorer · Supports JPG, WebP, PNG</span>
                </div>
              </div>

              <!-- Metadata & Control Bar -->
              <div class="pt-1 space-y-2">
                <div class="flex items-center justify-between gap-3 text-xs">
                  <div class="min-w-0 flex-1">
                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted block">Current Asset</span>
                    <span class="font-mono text-[11px] text-ink block truncate font-medium" title="<?= esc($content['home']['about_primary_img'] ?? 'assets/images/safari-trail.jpg') ?>">
                      <?= esc($content['home']['about_primary_img'] ?? 'assets/images/safari-trail.jpg') ?>
                    </span>
                  </div>
                  <button type="button" 
                          onclick="document.getElementById('file-about-primary').click()" 
                          class="px-3.5 py-1.5 rounded-lg bg-forest-900 hover:bg-forest-800 text-[#D4B87C] hover:text-warm-white text-xs font-semibold transition-all shadow-xs cursor-pointer inline-flex items-center gap-1.5 shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    <span>Change Photo</span>
                  </button>
                </div>
                <div id="preview-about-primary-filename" class="text-[11px] font-semibold text-emerald-800 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-md hidden"></div>
              </div>
            </div>

            <!-- Asset 2: Overlapping Polaroid Wildlife Print (5 Cols) -->
            <div class="lg:col-span-5 bg-ivory/80 rounded-2xl border border-stone/40 p-5 space-y-4 flex flex-col justify-between hover:border-[#D4B87C] transition-all shadow-xs group/card">
              <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                  <span class="text-xs font-bold text-forest-900 flex items-center gap-1.5">
                    <span class="w-5 h-5 rounded-full bg-forest-900 text-[#D4B87C] text-[10px] font-mono font-bold flex items-center justify-center">02</span>
                    <span>Polaroid Wildlife Print</span>
                  </span>
                  <span class="text-[10px] font-mono text-muted px-2 py-0.5 rounded bg-white border border-stone/30">Square or 4:3 (~800&times;800)</span>
                </div>
                <p class="text-[11px] text-muted">The foreground polaroid card with authentic handwritten caption.</p>
              </div>

              <!-- Clickable & Droppable Image Studio Box (Rendered as an Authentic Polaroid) -->
              <input type="file" 
                     name="file_about_secondary_img" 
                     id="file-about-secondary" 
                     accept="image/*" 
                     class="hidden" 
                     onchange="previewHomeImage(this, 'preview-about-secondary')">
              <input type="hidden" 
                     name="content[home][about_secondary_img]" 
                     value="<?= esc($content['home']['about_secondary_img'] ?? 'assets/images/indian-roller.jpg') ?>">

              <div class="py-1 flex justify-center">
                <div id="dropzone-about-secondary"
                     onclick="document.getElementById('file-about-secondary').click()" 
                     class="w-56 bg-white p-3 pb-4 rounded-xl shadow-md border border-stone/30 cursor-pointer group hover:rotate-0 rotate-1 transition-all duration-300 relative">
                  
                  <!-- Subtle Washi Tape / Pin Decorator -->
                  <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-10 h-3 bg-[#D4B87C]/35 rounded-xs border border-white/50 pointer-events-none"></div>

                  <!-- Image Area Inside Polaroid -->
                  <div class="w-full h-36 rounded-lg overflow-hidden bg-sand relative">
                    <img id="preview-about-secondary" 
                         src="<?= (str_starts_with($content['home']['about_secondary_img'] ?? '', 'http')) ? esc($content['home']['about_secondary_img']) : base_url(esc($content['home']['about_secondary_img'] ?? 'assets/images/indian-roller.jpg')) ?>" 
                         alt="Polaroid photo preview" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    
                    <div class="absolute inset-0 bg-forest-950/70 backdrop-blur-xs opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-warm-white text-[11px] font-semibold gap-1 p-2 text-center">
                      <svg class="w-5 h-5 text-[#D4B87C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                      <span>Click to Browse</span>
                    </div>
                  </div>

                  <!-- Polaroid Handwritten Text Preview -->
                  <div class="pt-2 text-center">
                    <span id="preview-polaroid-note" class="font-script text-ink text-xs block truncate italic">
                      <?= esc($content['home']['about_polaroid_caption'] ?? 'Small moments. Big stories.') ?>
                    </span>
                  </div>
                </div>
              </div>

              <!-- Editable Caption & Control Bar -->
              <div class="space-y-3 pt-1">
                <div class="space-y-1">
                  <label class="block text-[11px] font-semibold text-ink flex items-center justify-between">
                    <span>Polaroid Handwritten Caption</span>
                    <span class="text-[10px] text-muted font-normal">Shows in script font below photo</span>
                  </label>
                  <input type="text" 
                         name="content[home][about_polaroid_caption]" 
                         id="input-about-polaroid-caption"
                         value="<?= esc($content['home']['about_polaroid_caption'] ?? 'Small moments. Big stories.') ?>" 
                         oninput="document.getElementById('preview-polaroid-note').textContent = this.value || 'Small moments. Big stories.'"
                         placeholder="e.g. Small moments. Big stories."
                         class="w-full px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs font-medium text-ink focus:ring-2 focus:ring-forest-700/30 outline-none">
                </div>

                <div class="flex items-center justify-between gap-3 text-xs pt-1 border-t border-stone/20">
                  <div class="min-w-0 flex-1">
                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted block">Current Asset</span>
                    <span class="font-mono text-[11px] text-ink block truncate font-medium" title="<?= esc($content['home']['about_secondary_img'] ?? 'assets/images/indian-roller.jpg') ?>">
                      <?= esc($content['home']['about_secondary_img'] ?? 'assets/images/indian-roller.jpg') ?>
                    </span>
                  </div>
                  <button type="button" 
                          onclick="document.getElementById('file-about-secondary').click()" 
                          class="px-3.5 py-1.5 rounded-lg bg-forest-900 hover:bg-forest-800 text-[#D4B87C] hover:text-warm-white text-xs font-semibold transition-all shadow-xs cursor-pointer inline-flex items-center gap-1.5 shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    <span>Change Photo</span>
                  </button>
                </div>
                <div id="preview-about-secondary-filename" class="text-[11px] font-semibold text-emerald-800 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-md hidden"></div>
              </div>
            </div>

          </div>
        </div>

        <!-- Feature Badges -->
        <div class="border-t border-stone/20 pt-4 space-y-3">
          <label class="block text-xs font-semibold text-ink uppercase tracking-wider">Highlight Feature Badges</label>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="p-4 rounded-2xl bg-ivory/60 border border-stone/30 space-y-2">
              <span class="font-semibold text-xs text-forest-800 uppercase tracking-wider block">Feature 1</span>
              <input type="text" name="content[home][feature1_title]" value="<?= esc($content['home']['feature1_title']) ?>" placeholder="Title" class="w-full px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs font-semibold focus:ring-1 focus:ring-forest-700 outline-none">
              <input type="text" name="content[home][feature1_desc]" value="<?= esc($content['home']['feature1_desc']) ?>" placeholder="Short description" class="w-full px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs focus:ring-1 focus:ring-forest-700 outline-none">
            </div>
            <div class="p-4 rounded-2xl bg-ivory/60 border border-stone/30 space-y-2">
              <span class="font-semibold text-xs text-forest-800 uppercase tracking-wider block">Feature 2</span>
              <input type="text" name="content[home][feature2_title]" value="<?= esc($content['home']['feature2_title']) ?>" placeholder="Title" class="w-full px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs font-semibold focus:ring-1 focus:ring-forest-700 outline-none">
              <input type="text" name="content[home][feature2_desc]" value="<?= esc($content['home']['feature2_desc']) ?>" placeholder="Short description" class="w-full px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs focus:ring-1 focus:ring-forest-700 outline-none">
            </div>
          </div>
        </div>
      </div>

      <!-- Section 3: Safari Journey Timeline & Imagery Card -->
      <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-6">
        <div class="border-b border-stone/20 pb-3 flex items-center justify-between">
          <div>
            <h3 class="font-serif text-xl font-bold text-ink">Section: Safari Experience & 3-Step Journey</h3>
            <p class="text-xs text-muted">The editorial timeline next to the arched tiger portrait and Barasingha meadow etching.</p>
          </div>
          <span class="text-xs font-mono text-sage">Home &middot; Section 3</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">Section Eyebrow</label>
            <input type="text" name="content[home][safari_eyebrow]" value="<?= esc($content['home']['safari_eyebrow']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
          </div>
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">Section Heading</label>
            <input type="text" name="content[home][safari_title]" value="<?= esc($content['home']['safari_title']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
          </div>
        </div>

        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Editorial Script Quote</label>
          <input type="text" name="content[home][safari_quote]" value="<?= esc($content['home']['safari_quote']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
        </div>

        <!-- Section 3 Visual Media Studio (Tiger Arch & Botanical Etching) -->
        <div class="border-t border-stone/20 pt-6 space-y-4">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
              <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 rounded-md bg-forest-900 text-[#D4B87C] text-[10px] font-mono font-bold uppercase tracking-wider">Visual Studio</span>
                <h4 class="font-serif text-lg font-bold text-ink">Section Imagery (Tiger Portrait &amp; Botanical Artwork)</h4>
              </div>
              <p class="text-xs text-muted mt-0.5">The signature arched wildlife portrait and the authentic background meadow lithograph engraving.</p>
            </div>
            <div class="flex items-center gap-2">
              <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-[11px] font-semibold">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Live Dynamic Sync</span>
              </span>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
            
            <!-- Asset 1: Royal Bengal Tiger in Architectural Arch Frame -->
            <div class="bg-ivory/80 rounded-2xl border border-stone/40 p-5 space-y-4 flex flex-col justify-between hover:border-[#D4B87C] transition-all shadow-xs group/card">
              <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                  <span class="text-xs font-bold text-forest-900 flex items-center gap-1.5">
                    <span class="w-5 h-5 rounded-full bg-forest-900 text-[#D4B87C] text-[10px] font-mono font-bold flex items-center justify-center">01</span>
                    <span>Royal Bengal Tiger (Arched Portrait)</span>
                  </span>
                  <span class="text-[10px] font-mono text-muted px-2 py-0.5 rounded bg-white border border-stone/30">Portrait 3:4 (~600&times;900)</span>
                </div>
                <p class="text-[11px] text-muted">Renders inside the signature architectural arch frame with gold rim.</p>
              </div>

              <!-- Clickable & Droppable Image Studio Box (Simulating Real Arch) -->
              <input type="file" 
                     name="file_safari_tiger_img" 
                     id="file-safari-tiger" 
                     accept="image/*" 
                     class="hidden" 
                     onchange="previewHomeImage(this, 'preview-safari-tiger')">
              <input type="hidden" 
                     name="content[home][safari_tiger_img]" 
                     value="<?= esc($content['home']['safari_tiger_img'] ?? 'assets/images/tiger-portrait.jpg') ?>">

              <div class="py-2 flex items-center justify-center bg-sand/35 rounded-2xl border border-stone/30">
                <div id="dropzone-safari-tiger"
                     onclick="document.getElementById('file-safari-tiger').click()" 
                     class="w-36 sm:w-44 h-52 sm:h-60 rounded-t-[3.5rem] rounded-b-xl overflow-hidden border-4 border-warm-white shadow-xl ring-1 ring-[#D4B87C]/50 cursor-pointer relative group transition-transform duration-300 hover:scale-[1.02]">
                  <img id="preview-safari-tiger" 
                       src="<?= (str_starts_with($content['home']['safari_tiger_img'] ?? '', 'http')) ? esc($content['home']['safari_tiger_img']) : base_url(esc($content['home']['safari_tiger_img'] ?? 'assets/images/tiger-portrait.jpg')) ?>" 
                       alt="Tiger portrait preview" 
                       class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                  
                  <div class="absolute inset-0 bg-forest-950/75 backdrop-blur-xs opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-warm-white text-xs font-semibold gap-1.5 p-3 text-center">
                    <svg class="w-6 h-6 text-[#D4B87C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    <span>Click or Drop New Photo</span>
                    <span class="text-[10px] text-stone/90 font-normal">Vertical portrait</span>
                  </div>
                </div>
              </div>

              <!-- Metadata & Control Bar -->
              <div class="pt-1 space-y-2">
                <div class="flex items-center justify-between gap-3 text-xs">
                  <div class="min-w-0 flex-1">
                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted block">Current Asset</span>
                    <span class="font-mono text-[11px] text-ink block truncate font-medium" title="<?= esc($content['home']['safari_tiger_img'] ?? 'assets/images/tiger-portrait.jpg') ?>">
                      <?= esc($content['home']['safari_tiger_img'] ?? 'assets/images/tiger-portrait.jpg') ?>
                    </span>
                  </div>
                  <button type="button" 
                          onclick="document.getElementById('file-safari-tiger').click()" 
                          class="px-3.5 py-1.5 rounded-lg bg-forest-900 hover:bg-forest-800 text-[#D4B87C] hover:text-warm-white text-xs font-semibold transition-all shadow-xs cursor-pointer inline-flex items-center gap-1.5 shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    <span>Change Photo</span>
                  </button>
                </div>
                <div id="preview-safari-tiger-filename" class="text-[11px] font-semibold text-emerald-800 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-md hidden"></div>
              </div>
            </div>

            <!-- Asset 2: Background Botanical Wildlife Etching Artwork -->
            <div class="bg-ivory/80 rounded-2xl border border-stone/40 p-5 space-y-4 flex flex-col justify-between hover:border-[#D4B87C] transition-all shadow-xs group/card">
              <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                  <span class="text-xs font-bold text-forest-900 flex items-center gap-1.5">
                    <span class="w-5 h-5 rounded-full bg-forest-900 text-[#D4B87C] text-[10px] font-mono font-bold flex items-center justify-center">02</span>
                    <span>Background Wildlife Etching</span>
                  </span>
                  <span class="text-[10px] font-mono text-muted px-2 py-0.5 rounded bg-white border border-stone/30">Transparent PNG (~1200&times;800)</span>
                </div>
                <p class="text-[11px] text-muted">Subtle vintage lithograph engraving of Sal tree and Barasingha deer.</p>
              </div>

              <!-- Clickable & Droppable Image Studio Box (Parchment Artwork Canvas) -->
              <input type="file" 
                     name="file_safari_etching_img" 
                     id="file-safari-etching" 
                     accept="image/*" 
                     class="hidden" 
                     onchange="previewHomeImage(this, 'preview-safari-etching')">
              <input type="hidden" 
                     name="content[home][safari_etching_img]" 
                     value="<?= esc($content['home']['safari_etching_img'] ?? 'assets/images/kanha-meadow-wildlife-etching.png') ?>">

              <div class="py-2 flex items-center justify-center bg-[#F4EFE6] rounded-2xl border border-stone/40 shadow-inner">
                <div id="dropzone-safari-etching"
                     onclick="document.getElementById('file-safari-etching').click()" 
                     class="w-full h-52 sm:h-60 rounded-xl overflow-hidden cursor-pointer relative group flex items-center justify-center p-4">
                  <img id="preview-safari-etching" 
                       src="<?= (str_starts_with($content['home']['safari_etching_img'] ?? '', 'http')) ? esc($content['home']['safari_etching_img']) : base_url(esc($content['home']['safari_etching_img'] ?? 'assets/images/kanha-meadow-wildlife-etching.png')) ?>" 
                       alt="Wildlife etching artwork preview" 
                       class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500">
                  
                  <div class="absolute inset-0 bg-forest-950/75 backdrop-blur-xs opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-warm-white text-xs font-semibold gap-1.5 p-3 text-center">
                    <svg class="w-6 h-6 text-[#D4B87C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    <span>Click or Drop New Artwork</span>
                    <span class="text-[10px] text-stone/90 font-normal">Transparent PNG recommended</span>
                  </div>
                </div>
              </div>

              <!-- Metadata & Control Bar -->
              <div class="pt-1 space-y-2">
                <div class="flex items-center justify-between gap-3 text-xs">
                  <div class="min-w-0 flex-1">
                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted block">Current Asset</span>
                    <span class="font-mono text-[11px] text-ink block truncate font-medium" title="<?= esc($content['home']['safari_etching_img'] ?? 'assets/images/kanha-meadow-wildlife-etching.png') ?>">
                      <?= esc($content['home']['safari_etching_img'] ?? 'assets/images/kanha-meadow-wildlife-etching.png') ?>
                    </span>
                  </div>
                  <button type="button" 
                          onclick="document.getElementById('file-safari-etching').click()" 
                          class="px-3.5 py-1.5 rounded-lg bg-forest-900 hover:bg-forest-800 text-[#D4B87C] hover:text-warm-white text-xs font-semibold transition-all shadow-xs cursor-pointer inline-flex items-center gap-1.5 shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    <span>Change Artwork</span>
                  </button>
                </div>
                <div id="preview-safari-etching-filename" class="text-[11px] font-semibold text-emerald-800 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-md hidden"></div>
              </div>
            </div>

          </div>
        </div>

        <!-- 3-Step Timeline Copy -->
        <div class="border-t border-stone/20 pt-4 space-y-3">
          <label class="block text-xs font-semibold text-ink uppercase tracking-wider">Numbered 3-Step Trail Journey</label>
          <div class="space-y-3">
            <!-- Step 1 -->
            <div class="p-4 rounded-2xl bg-ivory/60 border border-stone/30 space-y-2">
              <div class="flex items-center space-x-2">
                <span class="w-6 h-6 rounded-full bg-forest-900 text-warm-white text-[10px] font-mono flex items-center justify-center font-bold">01</span>
                <input type="text" name="content[home][step1_title]" value="<?= esc($content['home']['step1_title']) ?>" class="flex-1 px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs font-semibold focus:ring-1 focus:ring-forest-700 outline-none">
              </div>
              <textarea name="content[home][step1_desc]" rows="2" class="w-full px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs focus:ring-1 focus:ring-forest-700 outline-none"><?= esc($content['home']['step1_desc']) ?></textarea>
            </div>
            <!-- Step 2 -->
            <div class="p-4 rounded-2xl bg-ivory/60 border border-stone/30 space-y-2">
              <div class="flex items-center space-x-2">
                <span class="w-6 h-6 rounded-full bg-forest-900 text-warm-white text-[10px] font-mono flex items-center justify-center font-bold">02</span>
                <input type="text" name="content[home][step2_title]" value="<?= esc($content['home']['step2_title']) ?>" class="flex-1 px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs font-semibold focus:ring-1 focus:ring-forest-700 outline-none">
              </div>
              <textarea name="content[home][step2_desc]" rows="2" class="w-full px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs focus:ring-1 focus:ring-forest-700 outline-none"><?= esc($content['home']['step2_desc']) ?></textarea>
            </div>
            <!-- Step 3 -->
            <div class="p-4 rounded-2xl bg-ivory/60 border border-stone/30 space-y-2">
              <div class="flex items-center space-x-2">
                <span class="w-6 h-6 rounded-full bg-forest-900 text-warm-white text-[10px] font-mono flex items-center justify-center font-bold">03</span>
                <input type="text" name="content[home][step3_title]" value="<?= esc($content['home']['step3_title']) ?>" class="flex-1 px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs font-semibold focus:ring-1 focus:ring-forest-700 outline-none">
              </div>
              <textarea name="content[home][step3_desc]" rows="2" class="w-full px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs focus:ring-1 focus:ring-forest-700 outline-none"><?= esc($content['home']['step3_desc']) ?></textarea>
            </div>
          </div>
        </div>
      </div>

      <!-- Section 4: Home Stay Preview / Accommodation Featurette Card -->
      <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-6">
        <div class="border-b border-stone/20 pb-3 flex items-center justify-between">
          <div>
            <h3 class="font-serif text-xl font-bold text-ink">Section: Accommodation Featurette</h3>
            <p class="text-xs text-muted">Stay banner and retreat headline shown on the homepage.</p>
          </div>
          <span class="text-xs font-mono text-sage">Home &middot; Section 4</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">Eyebrow</label>
            <input type="text" name="content[home][stay_eyebrow]" value="<?= esc($content['home']['stay_eyebrow']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
          </div>
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">Title</label>
            <input type="text" name="content[home][stay_title]" value="<?= esc($content['home']['stay_title']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
          </div>
        </div>

        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Description</label>
          <textarea name="content[home][stay_desc]" rows="2" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none"><?= esc($content['home']['stay_desc']) ?></textarea>
        </div>

        <!-- Section 4 Visual Media Studio (Cottage & Veranda Photos) -->
        <div class="border-t border-stone/20 pt-6 space-y-4">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
              <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 rounded-md bg-forest-900 text-[#D4B87C] text-[10px] font-mono font-bold uppercase tracking-wider">Visual Studio</span>
                <h4 class="font-serif text-lg font-bold text-ink">Section Photos &amp; Architectural Spread</h4>
              </div>
              <p class="text-xs text-muted mt-0.5">The primary forest cottage exterior architecture canvas and peaceful veranda living photo.</p>
            </div>
            <div class="flex items-center gap-2">
              <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-[11px] font-semibold">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Live Dynamic Sync</span>
              </span>
            </div>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pt-2">
            
            <!-- Asset 1: Main Cottage Exterior Architecture (7 Cols) -->
            <div class="lg:col-span-7 bg-ivory/80 rounded-2xl border border-stone/40 p-5 space-y-4 flex flex-col justify-between hover:border-[#D4B87C] transition-all shadow-xs group/card">
              <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                  <span class="text-xs font-bold text-forest-900 flex items-center gap-1.5">
                    <span class="w-5 h-5 rounded-full bg-forest-900 text-[#D4B87C] text-[10px] font-mono font-bold flex items-center justify-center">01</span>
                    <span>Cottage Exterior Architecture</span>
                  </span>
                  <span class="text-[10px] font-mono text-muted px-2 py-0.5 rounded bg-white border border-stone/30">1200&times;800 (16:10)</span>
                </div>
                <p class="text-[11px] text-muted">Primary lodging photograph showcasing resort architecture amongst the sal trees.</p>
              </div>

              <!-- Clickable & Droppable Image Studio Box -->
              <input type="file" 
                     name="file_stay_cottage_img" 
                     id="file-stay-cottage" 
                     accept="image/*" 
                     class="hidden" 
                     onchange="previewHomeImage(this, 'preview-stay-cottage')">
              <input type="hidden" 
                     name="content[home][stay_cottage_img]" 
                     value="<?= esc($content['home']['stay_cottage_img'] ?? 'assets/images/forest-lodge.jpg') ?>">

              <div id="dropzone-stay-cottage"
                   onclick="document.getElementById('file-stay-cottage').click()" 
                   class="relative w-full h-52 sm:h-60 rounded-xl overflow-hidden bg-forest-950/20 border-2 border-dashed border-stone/50 hover:border-[#D4B87C] cursor-pointer shadow-inner group transition-all">
                <img id="preview-stay-cottage" 
                     src="<?= (str_starts_with($content['home']['stay_cottage_img'] ?? '', 'http')) ? esc($content['home']['stay_cottage_img']) : base_url(esc($content['home']['stay_cottage_img'] ?? 'assets/images/forest-lodge.jpg')) ?>" 
                     alt="Cottage exterior preview" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                
                <div class="absolute top-3 left-3 bg-forest-950/70 backdrop-blur-xs text-warm-white text-[10px] font-mono px-2 py-0.5 rounded-md border border-white/15">
                  Slot 01 · Main Architecture
                </div>

                <div class="absolute inset-0 bg-forest-950/75 backdrop-blur-xs opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-warm-white text-xs font-semibold gap-2 p-4 text-center">
                  <div class="w-10 h-10 rounded-full bg-forest-900 border border-[#D4B87C] text-[#D4B87C] flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                  </div>
                  <span class="font-bold text-sm text-warm-white">Drop Photo or Click to Browse</span>
                  <span class="text-[11px] text-stone/90 font-normal">Opens file explorer · Supports JPG, WebP, PNG</span>
                </div>
              </div>

              <!-- Metadata & Control Bar -->
              <div class="pt-1 space-y-2">
                <div class="flex items-center justify-between gap-3 text-xs">
                  <div class="min-w-0 flex-1">
                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted block">Current Asset</span>
                    <span class="font-mono text-[11px] text-ink block truncate font-medium" title="<?= esc($content['home']['stay_cottage_img'] ?? 'assets/images/forest-lodge.jpg') ?>">
                      <?= esc($content['home']['stay_cottage_img'] ?? 'assets/images/forest-lodge.jpg') ?>
                    </span>
                  </div>
                  <button type="button" 
                          onclick="document.getElementById('file-stay-cottage').click()" 
                          class="px-3.5 py-1.5 rounded-lg bg-forest-900 hover:bg-forest-800 text-[#D4B87C] hover:text-warm-white text-xs font-semibold transition-all shadow-xs cursor-pointer inline-flex items-center gap-1.5 shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    <span>Change Photo</span>
                  </button>
                </div>
                <div id="preview-stay-cottage-filename" class="text-[11px] font-semibold text-emerald-800 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-md hidden"></div>
              </div>
            </div>

            <!-- Asset 2: Veranda & Interior Comfort Detail (5 Cols) -->
            <div class="lg:col-span-5 bg-ivory/80 rounded-2xl border border-stone/40 p-5 space-y-4 flex flex-col justify-between hover:border-[#D4B87C] transition-all shadow-xs group/card">
              <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                  <span class="text-xs font-bold text-forest-900 flex items-center gap-1.5">
                    <span class="w-5 h-5 rounded-full bg-forest-900 text-[#D4B87C] text-[10px] font-mono font-bold flex items-center justify-center">02</span>
                    <span>Veranda &amp; Interior Comfort</span>
                  </span>
                  <span class="text-[10px] font-mono text-muted px-2 py-0.5 rounded bg-white border border-stone/30">800&times;600 (4:3)</span>
                </div>
                <p class="text-[11px] text-muted">Detail perspective of the peaceful private veranda and room amenities.</p>
              </div>

              <!-- Clickable & Droppable Image Studio Box -->
              <input type="file" 
                     name="file_stay_interior_img" 
                     id="file-stay-interior" 
                     accept="image/*" 
                     class="hidden" 
                     onchange="previewHomeImage(this, 'preview-stay-interior')">
              <input type="hidden" 
                     name="content[home][stay_interior_img]" 
                     value="<?= esc($content['home']['stay_interior_img'] ?? 'assets/images/lodge-interior.jpg') ?>">

              <div id="dropzone-stay-interior"
                   onclick="document.getElementById('file-stay-interior').click()" 
                   class="relative w-full h-52 sm:h-60 rounded-xl overflow-hidden bg-forest-950/20 border-2 border-dashed border-stone/50 hover:border-[#D4B87C] cursor-pointer shadow-inner group transition-all">
                <img id="preview-stay-interior" 
                     src="<?= (str_starts_with($content['home']['stay_interior_img'] ?? '', 'http')) ? esc($content['home']['stay_interior_img']) : base_url(esc($content['home']['stay_interior_img'] ?? 'assets/images/lodge-interior.jpg')) ?>" 
                     alt="Veranda and interior preview" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                
                <div class="absolute top-3 left-3 bg-forest-950/70 backdrop-blur-xs text-warm-white text-[10px] font-mono px-2 py-0.5 rounded-md border border-white/15">
                  Slot 02 · Veranda Living
                </div>

                <div class="absolute inset-0 bg-forest-950/75 backdrop-blur-xs opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-warm-white text-xs font-semibold gap-2 p-4 text-center">
                  <div class="w-10 h-10 rounded-full bg-forest-900 border border-[#D4B87C] text-[#D4B87C] flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                  </div>
                  <span class="font-bold text-sm text-warm-white">Drop Photo or Click to Browse</span>
                  <span class="text-[11px] text-stone/90 font-normal">Opens file explorer · Supports JPG, WebP, PNG</span>
                </div>
              </div>

              <!-- Metadata & Control Bar -->
              <div class="pt-1 space-y-2">
                <div class="flex items-center justify-between gap-3 text-xs">
                  <div class="min-w-0 flex-1">
                    <span class="text-[10px] uppercase tracking-wider font-semibold text-muted block">Current Asset</span>
                    <span class="font-mono text-[11px] text-ink block truncate font-medium" title="<?= esc($content['home']['stay_interior_img'] ?? 'assets/images/lodge-interior.jpg') ?>">
                      <?= esc($content['home']['stay_interior_img'] ?? 'assets/images/lodge-interior.jpg') ?>
                    </span>
                  </div>
                  <button type="button" 
                          onclick="document.getElementById('file-stay-interior').click()" 
                          class="px-3.5 py-1.5 rounded-lg bg-forest-900 hover:bg-forest-800 text-[#D4B87C] hover:text-warm-white text-xs font-semibold transition-all shadow-xs cursor-pointer inline-flex items-center gap-1.5 shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    <span>Change Photo</span>
                  </button>
                </div>
                <div id="preview-stay-interior-filename" class="text-[11px] font-semibold text-emerald-800 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-md hidden"></div>
              </div>
            </div>

          </div>
        </div>

      </div>

    </div>


    <!-- TAB 2: SAFARI PAGE CONTENT -->
    <div id="tab-safari" class="content-tab-pane space-y-6 <?= ($activeTab ?? '') === 'safari' ? '' : 'hidden' ?>">
      
      <!-- 1. Hero & Header Banner -->
      <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-5">
        <div class="border-b border-stone/20 pb-3 flex items-center justify-between">
          <div>
            <h3 class="font-serif text-xl font-bold text-ink">Hero Banner & Header Copy</h3>
            <p class="text-xs text-muted">The top breadcrumb header and background image on the Safari page.</p>
          </div>
          <span class="text-xs font-mono text-sage">Safari &middot; Section 1</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">Eyebrow Notice</label>
            <input type="text" name="content[safari][hero_eyebrow]" value="<?= esc($content['safari']['hero_eyebrow'] ?? 'Official Safari Booking · Kanha Tiger Reserve') ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
          </div>
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">Hero Main Heading</label>
            <input type="text" name="content[safari][hero_title]" value="<?= esc($content['safari']['hero_title'] ?? 'Into the Heart of the Wild') ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
          </div>
        </div>

        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Hero Subtitle Paragraph</label>
          <textarea name="content[safari][hero_subtitle]" rows="2" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none"><?= esc($content['safari']['hero_subtitle'] ?? '') ?></textarea>
        </div>

        <!-- Hero Background Banner Studio Card -->
        <div class="space-y-3 pt-2">
          <div class="rounded-2xl bg-white border border-stone/40 hover:border-[#D4B87C] transition-all p-5 sm:p-6 shadow-xs space-y-4">
            
            <!-- Card Header: Title, Live Status & Specs -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3 border-b border-stone/20">
              <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-forest-900 text-[#D4B87C] flex items-center justify-center shrink-0 shadow-xs">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                  <h4 class="text-sm font-bold text-ink flex items-center gap-2">
                    <span>Hero Panoramic Background Photo</span>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-[10px] font-semibold">
                      <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                      <span>Live on Safari Gateway</span>
                    </span>
                  </h4>
                  <p class="text-[11px] text-muted">The primary full-bleed panoramic backdrop rendered behind the main headline on the Safari page.</p>
                </div>
              </div>
              
              <div class="shrink-0">
                <span class="inline-block text-[10px] font-mono text-muted bg-ivory border border-stone/30 px-2.5 py-1 rounded-md">
                  Recommended: 1920 &times; 1080px &middot; 16:9 or 21:9
                </span>
              </div>
            </div>

            <!-- Hidden Inputs for Form Submission and File Trigger -->
            <input type="file" 
                   name="file_safari_hero_bg" 
                   id="file-safari-hero-bg" 
                   accept="image/*" 
                   class="hidden" 
                   onchange="previewHomeImage(this, 'preview-safari-hero-bg')">
            <input type="hidden" 
                   name="content[safari][hero_bg_image]" 
                   value="<?= esc($content['safari']['hero_bg_image'] ?? 'assets/images/tiger-kanha-reserve.jpg') ?>">

            <!-- Full-Width Panoramic Banner Canvas (Spacious, Cinematic Aspect Ratio) -->
            <div id="dropzone-safari-hero-bg"
                 onclick="document.getElementById('file-safari-hero-bg').click()" 
                 class="relative w-full h-64 sm:h-72 lg:h-80 rounded-xl overflow-hidden bg-forest-950/20 border-2 border-dashed border-stone/40 hover:border-[#D4B87C] cursor-pointer group shadow-inner transition-all">
              
              <!-- Banner Image Preview -->
              <img id="preview-safari-hero-bg" 
                   src="<?= (str_starts_with($content['safari']['hero_bg_image'] ?? '', 'http')) ? esc($content['safari']['hero_bg_image']) : base_url(esc($content['safari']['hero_bg_image'] ?? 'assets/images/tiger-kanha-reserve.jpg')) ?>" 
                   alt="Safari Hero Background Preview" 
                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
              
              <!-- Floating Corner Badge -->
              <div class="absolute top-3 left-3 bg-forest-950/80 backdrop-blur-sm text-[#D4B87C] text-[11px] font-mono px-3 py-1 rounded-md border border-white/10 shadow-sm flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-[#D4B87C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Safari Hero Canvas</span>
              </div>

              <!-- Interactive Glassmorphic Hover Overlay -->
              <div class="absolute inset-0 bg-forest-950/75 backdrop-blur-xs opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-warm-white gap-2 p-6 text-center">
                <div class="w-12 h-12 rounded-full bg-forest-900 border-2 border-[#D4B87C] text-[#D4B87C] flex items-center justify-center shadow-xl transform group-hover:scale-110 transition-transform">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                </div>
                <div class="space-y-0.5">
                  <p class="font-serif text-base font-bold text-warm-white">Drop New Hero Photo or Click to Browse</p>
                  <p class="text-xs text-stone font-normal">Opens your computer's file explorer &middot; Supports JPG, WebP, PNG</p>
                </div>
              </div>
            </div>

            <!-- Bottom Metadata & Action Bar -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-2">
              <div class="space-y-0.5 min-w-0 flex-1">
                <span class="text-[10px] uppercase tracking-wider font-semibold text-muted block">Current Active Asset</span>
                <span class="font-mono text-xs text-ink font-medium truncate block max-w-lg" title="<?= esc($content['safari']['hero_bg_image'] ?? 'assets/images/tiger-kanha-reserve.jpg') ?>">
                  <?= esc($content['safari']['hero_bg_image'] ?? 'assets/images/tiger-kanha-reserve.jpg') ?>
                </span>
              </div>

              <div class="flex items-center gap-3 shrink-0">
                <div id="preview-safari-hero-bg-filename" class="text-[11px] font-semibold text-emerald-800 bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-lg hidden"></div>
                
                <button type="button" 
                        onclick="document.getElementById('file-safari-hero-bg').click()" 
                        class="px-4 py-2 rounded-xl bg-forest-900 hover:bg-forest-800 text-[#D4B87C] hover:text-warm-white text-xs font-semibold transition-all shadow-xs hover:shadow cursor-pointer inline-flex items-center gap-2 whitespace-nowrap">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                  <span>Change Hero Photo</span>
                </button>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- 2. Showcase Carousel Slides Manager (Dynamic with Add, Edit, Delete & Image Upload) -->
      <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-6">
        <div class="border-b border-stone/20 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
          <div>
            <div class="flex items-center gap-2.5">
              <h3 class="font-serif text-xl font-bold text-ink">Showcase Carousel Slides</h3>
              <span class="px-2.5 py-0.5 rounded-full bg-forest-900/10 text-forest-900 text-xs font-mono font-bold">
                <?= count($safariSlides) ?> Slides
              </span>
            </div>
            <p class="text-xs text-muted mt-0.5">The main interactive 4x4 Gypsy &amp; wildlife photo slider on the Safari page. Click any slide to edit or upload a new photo from your computer.</p>
          </div>
          
          <button type="button" 
                  onclick="openAddSafariSlideModal()" 
                  class="inline-flex items-center justify-center px-4 py-2 rounded-full bg-forest-900 hover:bg-forest-800 text-warm-white font-semibold text-xs transition-all shadow-sm hover:shadow hover:-translate-y-0.5 shrink-0 cursor-pointer">
            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Add Carousel Slide</span>
          </button>
        </div>

        <!-- Slides Grid: 2 Slides in One Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-stretch">
          <?php foreach ($safariSlides as $idx => $sslide): ?>
            <div class="p-5 rounded-2xl bg-white border border-stone/30 relative group hover:border-[#D4B87C] hover:shadow-md transition-all flex flex-col justify-between space-y-4">
              
              <div class="space-y-3.5">
                <!-- Top Header: Slide Order, Status Toggle & Delete -->
                <div class="flex items-center justify-between border-b border-stone/15 pb-3">
                  <div class="flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-forest-900 text-[#D4B87C] text-[11px] font-mono font-bold flex items-center justify-center shadow-xs">
                      0<?= esc($sslide['order_num'] ?? ($idx + 1)) ?>
                    </span>
                    <span class="text-xs font-serif font-bold text-ink">Slide #<?= esc($sslide['order_num'] ?? ($idx + 1)) ?></span>
                  </div>
                  
                  <div class="flex items-center gap-1.5">
                    <!-- Status Toggle -->
                    <button type="button" 
                            onclick="toggleSafariSlide(<?= $sslide['id'] ?>)" 
                            title="Click to toggle active/inactive" 
                            class="px-2.5 py-0.5 rounded-full text-[10px] font-semibold cursor-pointer transition-colors <?= ($sslide['status'] ?? 'active') === 'active' ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-stone/20 text-stone hover:bg-stone/30' ?>">
                      <?= ($sslide['status'] ?? 'active') === 'active' ? 'Active' : 'Hidden' ?>
                    </button>

                    <!-- Delete Slide Button -->
                    <?php if (count($safariSlides) > 1): ?>
                      <button type="button" 
                              onclick="deleteSafariSlide(<?= $sslide['id'] ?>)" 
                              class="p-1 text-red-600 hover:text-red-800 hover:bg-red-50 rounded transition-colors cursor-pointer" 
                              title="Delete Slide">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                      </button>
                    <?php endif; ?>
                  </div>
                </div>

                <!-- Slide Landscape Photo Showcase Canvas -->
                <div class="relative w-full h-44 sm:h-48 rounded-xl overflow-hidden bg-forest-950/20 border border-stone/30 cursor-pointer shadow-xs group/img" 
                     onclick="openEditSafariSlideModal(<?= htmlspecialchars(json_encode($sslide), ENT_QUOTES, 'UTF-8') ?>)">
                  <img src="<?= (str_starts_with($sslide['image'], 'http://') || str_starts_with($sslide['image'], 'https://')) ? esc($sslide['image']) : base_url(esc($sslide['image'])) ?>" 
                       alt="<?= esc($sslide['caption']) ?>" 
                       class="w-full h-full object-cover group-hover/img:scale-105 transition-transform duration-500">
                  
                  <!-- Pinned Tag Badge -->
                  <div class="absolute top-2.5 left-2.5 bg-forest-950/80 backdrop-blur-xs text-[#D4B87C] text-[10px] font-mono px-2.5 py-0.5 rounded-md border border-white/10 truncate max-w-[80%]">
                    <?= esc($sslide['tag'] ?: 'Safari Slide') ?>
                  </div>

                  <!-- Hover Overlay -->
                  <div class="absolute inset-0 bg-forest-950/60 backdrop-blur-xs opacity-0 group-hover/img:opacity-100 transition-opacity flex items-center justify-center text-warm-white text-xs font-semibold gap-1.5 text-center px-4">
                    <svg class="w-4 h-4 text-[#D4B87C] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    <span>Click to Edit Slide &amp; Replace Photo</span>
                  </div>
                </div>

                <!-- Caption Title & Image Info -->
                <div class="space-y-1 pt-1">
                  <h4 class="text-sm font-bold text-ink line-clamp-2 leading-snug" title="<?= esc($sslide['caption']) ?>">
                    <?= esc($sslide['caption']) ?>
                  </h4>
                  <p class="text-[11px] text-muted font-mono truncate" title="<?= esc($sslide['image']) ?>">
                    <?= esc($sslide['image']) ?>
                  </p>
                </div>
              </div>

              <!-- Edit Action Button -->
              <div class="pt-3 border-t border-stone/20">
                <button type="button" 
                        onclick="openEditSafariSlideModal(<?= htmlspecialchars(json_encode($sslide), ENT_QUOTES, 'UTF-8') ?>)" 
                        class="w-full py-2.5 rounded-xl bg-forest-900 hover:bg-forest-800 text-[#D4B87C] hover:text-warm-white text-xs font-semibold transition-all shadow-xs flex items-center justify-center gap-2 cursor-pointer">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                  <span>Edit Slide &amp; Replace Photo</span>
                </button>
              </div>

            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- 3. Overview & Wildlife Haven Section -->
      <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-5">
        <div class="border-b border-stone/20 pb-3 flex items-center justify-between">
          <div>
            <h3 class="font-serif text-xl font-bold text-ink">Park Overview & Wildlife Haven Editorial</h3>
            <p class="text-xs text-muted">The main editorial narrative about Kipling's inspiration and the Barasingha conservation sanctuary.</p>
          </div>
          <span class="text-xs font-mono text-sage">Safari &middot; Section 3</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">Overview Eyebrow</label>
            <input type="text" name="content[safari][overview_eyebrow]" value="<?= esc($content['safari']['overview_eyebrow'] ?? 'Kanha Tiger Reserve · Mandla & Balaghat Districts, MP') ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
          </div>
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">Overview Main Heading</label>
            <input type="text" name="content[safari][overview_title]" value="<?= esc($content['safari']['overview_title'] ?? 'Explore Kanha National Park: Book Safaris Online') ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
          </div>
        </div>

        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Overview Lead Paragraph</label>
          <textarea name="content[safari][overview_desc]" rows="3" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none"><?= esc($content['safari']['overview_desc'] ?? '') ?></textarea>
        </div>

        <!-- Wildlife Haven Card Inner -->
        <div class="p-5 rounded-2xl bg-ivory/80 border border-stone/30 space-y-4 pt-4">
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-forest-800">Card Heading</label>
            <input type="text" name="content[safari][haven_title]" value="<?= esc($content['safari']['haven_title'] ?? 'A Wildlife Haven & Ancient Sal Sanctuary') ?>" class="w-full px-3.5 py-2 rounded-xl border border-stone/50 bg-white text-sm font-semibold">
          </div>
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-forest-800">Paragraph 1 (Species & Barasingha Heritage)</label>
            <textarea name="content[safari][haven_p1]" rows="3" class="w-full px-3.5 py-2 rounded-xl border border-stone/50 bg-white text-xs leading-relaxed"><?= esc($content['safari']['haven_p1'] ?? '') ?></textarea>
          </div>
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-forest-800">Paragraph 2 (Gypsy & Naturalist Commitment)</label>
            <textarea name="content[safari][haven_p2]" rows="2" class="w-full px-3.5 py-2 rounded-xl border border-stone/50 bg-white text-xs leading-relaxed"><?= esc($content['safari']['haven_p2'] ?? '') ?></textarea>
          </div>
        </div>
      </div>

      <!-- 4. Key Reserve Statistics Grid (4 Counters) -->
      <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-4">
        <div class="border-b border-stone/20 pb-3 flex items-center justify-between">
          <div>
            <h3 class="font-serif text-xl font-bold text-ink">Reserve Statistics & Metrics</h3>
            <p class="text-xs text-muted">The 4 prominent statistical counters rendered inside the wildlife overview.</p>
          </div>
          <span class="text-xs font-mono text-sage">Safari &middot; Stats</span>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
          <div class="p-3 bg-ivory rounded-xl border border-stone/30 space-y-1">
            <label class="block text-[10px] uppercase font-bold text-forest-800">Stat 1</label>
            <input type="text" name="content[safari][stat1_num]" value="<?= esc($content['safari']['stat1_num'] ?? '940+') ?>" class="w-full px-2 py-1.5 rounded bg-white text-xs font-bold text-forest-900 border border-stone/30">
            <input type="text" name="content[safari][stat1_label]" value="<?= esc($content['safari']['stat1_label'] ?? 'km² Core Area') ?>" class="w-full px-2 py-1.5 rounded bg-white text-xs text-muted border border-stone/30">
          </div>
          <div class="p-3 bg-ivory rounded-xl border border-stone/30 space-y-1">
            <label class="block text-[10px] uppercase font-bold text-forest-800">Stat 2</label>
            <input type="text" name="content[safari][stat2_num]" value="<?= esc($content['safari']['stat2_num'] ?? '100+') ?>" class="w-full px-2 py-1.5 rounded bg-white text-xs font-bold text-forest-900 border border-stone/30">
            <input type="text" name="content[safari][stat2_label]" value="<?= esc($content['safari']['stat2_label'] ?? 'Wild Tigers') ?>" class="w-full px-2 py-1.5 rounded bg-white text-xs text-muted border border-stone/30">
          </div>
          <div class="p-3 bg-ivory rounded-xl border border-stone/30 space-y-1">
            <label class="block text-[10px] uppercase font-bold text-forest-800">Stat 3</label>
            <input type="text" name="content[safari][stat3_num]" value="<?= esc($content['safari']['stat3_num'] ?? '300+') ?>" class="w-full px-2 py-1.5 rounded bg-white text-xs font-bold text-forest-900 border border-stone/30">
            <input type="text" name="content[safari][stat3_label]" value="<?= esc($content['safari']['stat3_label'] ?? 'Bird Species') ?>" class="w-full px-2 py-1.5 rounded bg-white text-xs text-muted border border-stone/30">
          </div>
          <div class="p-3 bg-ivory rounded-xl border border-stone/30 space-y-1">
            <label class="block text-[10px] uppercase font-bold text-forest-800">Stat 4</label>
            <input type="text" name="content[safari][stat4_num]" value="<?= esc($content['safari']['stat4_num'] ?? '100%') ?>" class="w-full px-2 py-1.5 rounded bg-white text-xs font-bold text-forest-900 border border-stone/30">
            <input type="text" name="content[safari][stat4_label]" value="<?= esc($content['safari']['stat4_label'] ?? 'Official Permits') ?>" class="w-full px-2 py-1.5 rounded bg-white text-xs text-muted border border-stone/30">
          </div>
        </div>
      </div>

      <!-- 5. Core & Buffer Safari Zones -->
      <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-5">
        <div class="border-b border-stone/20 pb-3 flex items-center justify-between">
          <div>
            <h3 class="font-serif text-xl font-bold text-ink">Safari Zones & Gates Guide</h3>
            <p class="text-xs text-muted">Core and buffer zone titles, gate names, and descriptions.</p>
          </div>
          <span class="text-xs font-mono text-sage">Safari &middot; Zones</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <!-- Kisli -->
          <div class="p-4 rounded-2xl bg-ivory/70 border border-stone/30 space-y-2">
            <div class="flex items-center gap-2">
              <input type="text" name="content[safari][kisli_title]" value="<?= esc($content['safari']['kisli_title'] ?? 'Kisli Zone (Core)') ?>" class="flex-1 px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs font-bold">
              <input type="text" name="content[safari][kisli_gate]" value="<?= esc($content['safari']['kisli_gate'] ?? 'Khatia Gate') ?>" class="w-28 px-2 py-1.5 rounded-lg border border-stone/50 bg-white text-[11px] font-mono">
            </div>
            <textarea name="content[safari][kisli_desc]" rows="3" class="w-full px-3 py-2 rounded-xl border border-stone/50 text-xs bg-white focus:ring-1 focus:ring-forest-700 outline-none"><?= esc($content['safari']['kisli_desc'] ?? '') ?></textarea>
          </div>

          <!-- Kanha -->
          <div class="p-4 rounded-2xl bg-ivory/70 border border-stone/30 space-y-2">
            <div class="flex items-center gap-2">
              <input type="text" name="content[safari][kanha_title]" value="<?= esc($content['safari']['kanha_title'] ?? 'Kanha Zone (Core)') ?>" class="flex-1 px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs font-bold">
              <input type="text" name="content[safari][kanha_gate]" value="<?= esc($content['safari']['kanha_gate'] ?? 'Iconic Grassland') ?>" class="w-28 px-2 py-1.5 rounded-lg border border-stone/50 bg-white text-[11px] font-mono">
            </div>
            <textarea name="content[safari][kanha_desc]" rows="3" class="w-full px-3 py-2 rounded-xl border border-stone/50 text-xs bg-white focus:ring-1 focus:ring-forest-700 outline-none"><?= esc($content['safari']['kanha_desc'] ?? '') ?></textarea>
          </div>

          <!-- Mukki -->
          <div class="p-4 rounded-2xl bg-ivory/70 border border-stone/30 space-y-2">
            <div class="flex items-center gap-2">
              <input type="text" name="content[safari][mukki_title]" value="<?= esc($content['safari']['mukki_title'] ?? 'Mukki Zone (Core)') ?>" class="flex-1 px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs font-bold">
              <input type="text" name="content[safari][mukki_gate]" value="<?= esc($content['safari']['mukki_gate'] ?? 'Mukki Gate') ?>" class="w-28 px-2 py-1.5 rounded-lg border border-stone/50 bg-white text-[11px] font-mono">
            </div>
            <textarea name="content[safari][mukki_desc]" rows="3" class="w-full px-3 py-2 rounded-xl border border-stone/50 text-xs bg-white focus:ring-1 focus:ring-forest-700 outline-none"><?= esc($content['safari']['mukki_desc'] ?? '') ?></textarea>
          </div>

          <!-- Sarhi -->
          <div class="p-4 rounded-2xl bg-ivory/70 border border-stone/30 space-y-2">
            <div class="flex items-center gap-2">
              <input type="text" name="content[safari][sarhi_title]" value="<?= esc($content['safari']['sarhi_title'] ?? 'Sarhi Zone (Core)') ?>" class="flex-1 px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs font-bold">
              <input type="text" name="content[safari][sarhi_gate]" value="<?= esc($content['safari']['sarhi_gate'] ?? 'Sarhi Gate') ?>" class="w-28 px-2 py-1.5 rounded-lg border border-stone/50 bg-white text-[11px] font-mono">
            </div>
            <textarea name="content[safari][sarhi_desc]" rows="3" class="w-full px-3 py-2 rounded-xl border border-stone/50 text-xs bg-white focus:ring-1 focus:ring-forest-700 outline-none"><?= esc($content['safari']['sarhi_desc'] ?? '') ?></textarea>
          </div>

          <!-- Buffer Zones -->
          <div class="p-4 rounded-2xl bg-ivory/70 border border-stone/30 space-y-2 sm:col-span-2">
            <div class="flex items-center gap-2">
              <input type="text" name="content[safari][buffer_title]" value="<?= esc($content['safari']['buffer_title'] ?? 'Buffer Zones & Night Trails') ?>" class="flex-1 px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs font-bold">
              <input type="text" name="content[safari][buffer_gate]" value="<?= esc($content['safari']['buffer_gate'] ?? 'Khatia / Khapa / Phen') ?>" class="w-44 px-2 py-1.5 rounded-lg border border-stone/50 bg-white text-[11px] font-mono">
            </div>
            <textarea name="content[safari][buffer_desc]" rows="2" class="w-full px-3 py-2 rounded-xl border border-stone/50 text-xs bg-white focus:ring-1 focus:ring-forest-700 outline-none"><?= esc($content['safari']['buffer_desc'] ?? '') ?></textarea>
          </div>
        </div>
      </div>

      <!-- 6. Safari Shifts, Timings & Regulations -->
      <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-5">
        <div class="border-b border-stone/20 pb-3 flex items-center justify-between">
          <div>
            <h3 class="font-serif text-xl font-bold text-ink">Shifts, Timings & Forest Regulations</h3>
            <p class="text-xs text-muted">Morning/afternoon drive hours, sunset shifts, and visitor mandatory ID guidelines.</p>
          </div>
          <span class="text-xs font-mono text-sage">Safari &middot; Shifts</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <!-- Morning -->
          <div class="p-4 rounded-2xl bg-ivory/70 border border-stone/30 space-y-2">
            <label class="block text-[11px] font-bold text-forest-900">Morning Shift</label>
            <input type="text" name="content[safari][morning_shift_title]" value="<?= esc($content['safari']['morning_shift_title'] ?? 'Morning Shift: 06:00 AM – 11:00 AM') ?>" class="w-full px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs font-semibold">
            <textarea name="content[safari][morning_shift_desc]" rows="2" class="w-full px-3 py-2 rounded-xl border border-stone/50 text-xs bg-white focus:ring-1 focus:ring-forest-700 outline-none"><?= esc($content['safari']['morning_shift_desc'] ?? '') ?></textarea>
          </div>

          <!-- Afternoon -->
          <div class="p-4 rounded-2xl bg-ivory/70 border border-stone/30 space-y-2">
            <label class="block text-[11px] font-bold text-forest-900">Afternoon Shift</label>
            <input type="text" name="content[safari][afternoon_shift_title]" value="<?= esc($content['safari']['afternoon_shift_title'] ?? 'Afternoon Shift: 02:30 PM – Sunset') ?>" class="w-full px-3 py-1.5 rounded-lg border border-stone/50 bg-white text-xs font-semibold">
            <textarea name="content[safari][afternoon_shift_desc]" rows="2" class="w-full px-3 py-2 rounded-xl border border-stone/50 text-xs bg-white focus:ring-1 focus:ring-forest-700 outline-none"><?= esc($content['safari']['afternoon_shift_desc'] ?? '') ?></textarea>
          </div>
        </div>

        <div class="space-y-1 pt-2">
          <label class="block text-xs font-semibold text-ink">Official Mandatory Forest Regulations Notice</label>
          <textarea name="content[safari][regulations_notice]" rows="2" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-xs focus:ring-1 focus:ring-forest-700 outline-none"><?= esc($content['safari']['regulations_notice'] ?? '') ?></textarea>
        </div>
      </div>

      <!-- 7. Responsible Tourism & Conservation Callout -->
      <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-5">
        <div class="border-b border-stone/20 pb-3 flex items-center justify-between">
          <div>
            <h3 class="font-serif text-xl font-bold text-ink">Conservation & Responsible Tourism Callout</h3>
            <p class="text-xs text-muted">The bottom conservation callout section above the enquiry banner.</p>
          </div>
          <span class="text-xs font-mono text-sage">Safari &middot; Conservation</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">Eyebrow</label>
            <input type="text" name="content[safari][tourism_eyebrow]" value="<?= esc($content['safari']['tourism_eyebrow'] ?? 'Conservation First') ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
          </div>
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">Heading</label>
            <input type="text" name="content[safari][tourism_title]" value="<?= esc($content['safari']['tourism_title'] ?? 'Responsible Wildlife Tourism') ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
          </div>
        </div>

        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Conservation Narrative</label>
          <textarea name="content[safari][tourism_desc]" rows="3" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none"><?= esc($content['safari']['tourism_desc'] ?? '') ?></textarea>
        </div>
      </div>

    </div>


    <!-- TAB 3: ACCOMMODATION CONTENT -->
    <div id="tab-accommodation" class="content-tab-pane space-y-6 <?= ($activeTab ?? '') === 'accommodation' ? '' : 'hidden' ?>">
      
      <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-5">
        <div class="border-b border-stone/20 pb-3 flex items-center justify-between">
          <div>
            <h3 class="font-serif text-xl font-bold text-ink">Accommodation Hero & Overview</h3>
            <p class="text-xs text-muted">Page headline and subtitle for the cottages section.</p>
          </div>
          <span class="text-xs font-mono text-sage">Accommodation &middot; Intro</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">Hero Title</label>
            <input type="text" name="content[accommodation][hero_title]" value="<?= esc($content['accommodation']['hero_title']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
          </div>
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">Hero Subtitle</label>
            <input type="text" name="content[accommodation][hero_subtitle]" value="<?= esc($content['accommodation']['hero_subtitle']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
          </div>
        </div>

        <div class="border-b border-stone/20 pt-4 pb-2">
          <h4 class="font-serif text-lg font-bold text-ink">Cottage Categories & Tariffs</h4>
          <p class="text-xs text-muted">Update room names, nightly tariffs and descriptions.</p>
        </div>

        <!-- Room 1 -->
        <div class="p-4 rounded-2xl bg-ivory/60 border border-stone/30 space-y-2">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div class="space-y-1">
              <label class="block text-[11px] font-semibold text-forest-800">Cottage 1 Name</label>
              <input type="text" name="content[accommodation][cottage1_title]" value="<?= esc($content['accommodation']['cottage1_title']) ?>" class="w-full px-3 py-2 rounded-xl border border-stone/50 bg-white text-xs font-bold focus:ring-1 focus:ring-forest-700 outline-none">
            </div>
            <div class="space-y-1">
              <label class="block text-[11px] font-semibold text-forest-800">Starting Price</label>
              <input type="text" name="content[accommodation][cottage1_price]" value="<?= esc($content['accommodation']['cottage1_price']) ?>" class="w-full px-3 py-2 rounded-xl border border-stone/50 bg-white text-xs focus:ring-1 focus:ring-forest-700 outline-none">
            </div>
          </div>
          <textarea name="content[accommodation][cottage1_desc]" rows="2" class="w-full px-3 py-2 rounded-xl border border-stone/50 bg-white text-xs focus:ring-1 focus:ring-forest-700 outline-none"><?= esc($content['accommodation']['cottage1_desc']) ?></textarea>
        </div>

        <!-- Room 2 -->
        <div class="p-4 rounded-2xl bg-ivory/60 border border-stone/30 space-y-2">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div class="space-y-1">
              <label class="block text-[11px] font-semibold text-forest-800">Cottage 2 Name</label>
              <input type="text" name="content[accommodation][cottage2_title]" value="<?= esc($content['accommodation']['cottage2_title']) ?>" class="w-full px-3 py-2 rounded-xl border border-stone/50 bg-white text-xs font-bold focus:ring-1 focus:ring-forest-700 outline-none">
            </div>
            <div class="space-y-1">
              <label class="block text-[11px] font-semibold text-forest-800">Starting Price</label>
              <input type="text" name="content[accommodation][cottage2_price]" value="<?= esc($content['accommodation']['cottage2_price']) ?>" class="w-full px-3 py-2 rounded-xl border border-stone/50 bg-white text-xs focus:ring-1 focus:ring-forest-700 outline-none">
            </div>
          </div>
          <textarea name="content[accommodation][cottage2_desc]" rows="2" class="w-full px-3 py-2 rounded-xl border border-stone/50 bg-white text-xs focus:ring-1 focus:ring-forest-700 outline-none"><?= esc($content['accommodation']['cottage2_desc']) ?></textarea>
        </div>

        <!-- Room 3 -->
        <div class="p-4 rounded-2xl bg-ivory/60 border border-stone/30 space-y-2">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div class="space-y-1">
              <label class="block text-[11px] font-semibold text-forest-800">Cottage 3 Name</label>
              <input type="text" name="content[accommodation][cottage3_title]" value="<?= esc($content['accommodation']['cottage3_title']) ?>" class="w-full px-3 py-2 rounded-xl border border-stone/50 bg-white text-xs font-bold focus:ring-1 focus:ring-forest-700 outline-none">
            </div>
            <div class="space-y-1">
              <label class="block text-[11px] font-semibold text-forest-800">Starting Price</label>
              <input type="text" name="content[accommodation][cottage3_price]" value="<?= esc($content['accommodation']['cottage3_price']) ?>" class="w-full px-3 py-2 rounded-xl border border-stone/50 bg-white text-xs focus:ring-1 focus:ring-forest-700 outline-none">
            </div>
          </div>
          <textarea name="content[accommodation][cottage3_desc]" rows="2" class="w-full px-3 py-2 rounded-xl border border-stone/50 bg-white text-xs focus:ring-1 focus:ring-forest-700 outline-none"><?= esc($content['accommodation']['cottage3_desc']) ?></textarea>
        </div>

      </div>

    </div>


    <!-- TAB 4: CONTACT & FOOTER -->
    <div id="tab-contact" class="content-tab-pane space-y-6 <?= ($activeTab ?? '') === 'contact' ? '' : 'hidden' ?>">
      
      <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-5">
        <div class="border-b border-stone/20 pb-3 flex items-center justify-between">
          <div>
            <h3 class="font-serif text-xl font-bold text-ink">Official Contact & Help Desk Numbers</h3>
            <p class="text-xs text-muted">Direct contact channels rendered across the header, contact page, and footer.</p>
          </div>
          <span class="text-xs font-mono text-sage">Global &middot; Contact</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">Primary Safari Phone</label>
            <input type="text" name="content[contact][phone_primary]" value="<?= esc($content['contact']['phone_primary']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm font-mono focus:ring-2 focus:ring-forest-700/30 outline-none">
            <span class="text-[11px] text-muted">Primary helpline for guest safari inquiries</span>
          </div>
          <div class="space-y-1">
            <div class="flex items-center justify-between">
              <label class="block text-xs font-semibold text-ink">Website Owner Mobile Number (Direct)</label>
              <span class="px-2 py-0.5 rounded-full bg-forest-900 text-[#D4B87C] text-[10px] font-mono font-bold">Owner Direct</span>
            </div>
            <input type="text" name="content[contact][phone_owner]" value="<?= esc($content['contact']['phone_owner'] ?? $content['contact']['phone_secondary'] ?? '+91 75667 89123') ?>" placeholder="e.g. +91 98260 12345" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm font-mono focus:ring-2 focus:ring-forest-700/30 outline-none">
            <span class="text-[11px] text-muted">Direct mobile number of the website owner / managing director</span>
          </div>
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">Secondary Safari Phone (Optional)</label>
            <input type="text" name="content[contact][phone_secondary]" value="<?= esc($content['contact']['phone_secondary']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm font-mono focus:ring-2 focus:ring-forest-700/30 outline-none">
            <span class="text-[11px] text-muted">Secondary backup desk line</span>
          </div>
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">WhatsApp Desk Number</label>
            <input type="text" name="content[contact][whatsapp]" value="<?= esc($content['contact']['whatsapp']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm font-mono focus:ring-2 focus:ring-forest-700/30 outline-none">
            <span class="text-[11px] text-muted">For instant 1-click WhatsApp assistance</span>
          </div>
          <div class="space-y-1 sm:col-span-2">
            <label class="block text-xs font-semibold text-ink">Inquiry Email</label>
            <input type="email" name="content[contact][email]" value="<?= esc($content['contact']['email']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
          </div>
        </div>

        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Desk Operating Hours</label>
          <input type="text" name="content[contact][hours]" value="<?= esc($content['contact']['hours']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
        </div>

        <div class="space-y-1 pt-2">
          <label class="block text-xs font-semibold text-ink">Official Resort Postal Address & Landmark</label>
          <textarea name="content[contact][address]" rows="2" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none"><?= esc($content['contact']['address']) ?></textarea>
        </div>

        <div class="space-y-1 pt-2">
          <div class="flex items-center justify-between">
            <label class="block text-xs font-semibold text-ink">Google Maps Embed Link (Iframe / URL)</label>
            <?php if (!empty($content['contact']['google_maps_embed'])): ?>
              <a href="<?= esc(parse_map_embed_url($content['contact']['google_maps_embed'])) ?>" target="_blank" rel="noopener noreferrer" class="text-[11px] text-forest-700 hover:underline inline-flex items-center">
                <span>Preview Map</span>
                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
              </a>
            <?php endif; ?>
          </div>
          <textarea name="content[contact][google_maps_embed]" rows="3" placeholder="Paste Google Maps embed URL (https://www.google.com/maps/embed?pb=...) or entire iframe tag" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-xs font-mono focus:ring-2 focus:ring-forest-700/30 outline-none leading-relaxed"><?= esc($content['contact']['google_maps_embed'] ?? '') ?></textarea>
          <span class="text-[11px] text-muted">Paste your Google Maps embed URL or the full &lt;iframe&gt; code copied from Google Maps Share &gt; Embed a map. Dynamically loaded on the Contact page.</span>
        </div>

      </div>

    </div>

    <!-- BOTTOM FLOATING SAVE ACTION -->
    <div class="flex items-center justify-between pt-6 border-t border-stone/30 mt-6">
      <div class="text-xs text-muted">
        Saved changes take effect across the entire website immediately.
      </div>
      <button type="submit" 
              class="inline-flex items-center justify-center px-6 py-3 rounded-full bg-forest-900 hover:bg-forest-800 text-[#D4B87C] font-semibold text-sm shadow-md transition-all hover:-translate-y-0.5 cursor-pointer">
        <svg class="w-4 h-4 mr-2 text-[#D4B87C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        <span>Save All Content Changes</span>
      </button>
    </div>

  </form>

</div>


<!-- SAFARI CAROUSEL SLIDE ADD / EDIT MODAL -->
<div id="safari-slide-modal" class="fixed inset-0 z-50 bg-forest-950/70 backdrop-blur-xs flex items-center justify-center p-4 hidden">
  <div class="bg-warm-white rounded-3xl border border-stone/40 max-w-xl w-full p-6 sm:p-8 shadow-2xl space-y-5 max-h-[90vh] overflow-y-auto">
    
    <div class="flex items-center justify-between border-b border-stone/30 pb-4">
      <div>
        <h3 class="font-serif text-xl sm:text-2xl font-bold text-ink" id="safari-modal-heading">Edit Carousel Slide</h3>
        <p class="text-xs text-muted">Upload a photo from your computer and customize the category badge and caption.</p>
      </div>
      <button type="button" onclick="closeSafariSlideModal()" class="text-stone hover:text-ink text-xl font-bold p-1 cursor-pointer">&times;</button>
    </div>

    <form method="POST" action="<?= base_url('admin/safari-slides/save') ?>" enctype="multipart/form-data" class="space-y-4">
      <?= csrf_field() ?>
      <input type="hidden" name="id" id="safari-modal-id" value="">
      <input type="hidden" name="existing_image" id="safari-modal-existing-image" value="">

      <!-- Image Upload Placeholder / Previous Upload Box -->
      <div class="space-y-1.5">
        <label class="block text-xs font-semibold text-ink flex items-center justify-between">
          <span>Carousel Slide Image <span class="text-[#D4B87C]">*</span></span>
          <span class="text-[11px] text-forest-700 font-normal">Click image below to choose file</span>
        </label>
        
        <!-- Hidden file input triggered when clicking the box -->
        <input type="file" 
               name="safari_slide_image" 
               id="safari-modal-file" 
               accept="image/png, image/jpeg, image/webp, image/jpg" 
               class="hidden" 
               onchange="handleSafariSlideImageSelect(this)">

        <!-- Clickable Image Upload Box / Previous Image -->
        <div id="safari-image-dropzone" 
             onclick="document.getElementById('safari-modal-file').click()" 
             class="relative group rounded-2xl border-2 border-dashed border-stone/40 hover:border-[#D4B87C] bg-ivory/60 hover:bg-ivory transition-all cursor-pointer overflow-hidden p-2 text-center flex flex-col items-center justify-center">
          
          <!-- Image preview (shows previous uploaded image or newly selected image) -->
          <div id="safari-preview-wrapper" class="relative w-full h-48 rounded-xl overflow-hidden bg-forest-950/20">
            <img id="safari-modal-image-preview" 
                 src="<?= base_url('assets/images/tiger-kanha-reserve.jpg') ?>" 
                 alt="Slide preview" 
                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
            
            <div class="absolute inset-0 bg-forest-950/50 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-1.5 text-warm-white">
              <div class="w-10 h-10 rounded-full bg-forest-900/90 text-[#D4B87C] border border-[#D4B87C]/50 flex items-center justify-center shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
              </div>
              <span class="text-xs font-semibold drop-shadow">Click to browse & replace image</span>
              <span class="text-[10px] text-warm-white/80">Opens your computer's file explorer</span>
            </div>
          </div>

          <!-- Upload prompt bar -->
          <div class="pt-2 flex items-center justify-between w-full px-2 text-[11px]">
            <span id="safari-modal-image-status" class="flex items-center gap-1.5 text-forest-800 font-medium">
              <svg class="w-3.5 h-3.5 text-forest-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
              <span>Click box to choose photo from computer</span>
            </span>
            <span class="text-[10px] text-stone">JPG, PNG, WEBP</span>
          </div>
        </div>
      </div>

      <!-- Badge Tag -->
      <div class="space-y-1">
        <label class="block text-xs font-semibold text-ink">Category / Badge Tag</label>
        <input type="text" name="tag" id="safari-modal-tag" placeholder="e.g. Apex Predator · Kanha Core" class="w-full px-3.5 py-2 rounded-xl border border-stone/50 bg-white text-xs sm:text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
      </div>

      <!-- Caption / Animal Title -->
      <div class="space-y-1">
        <label class="block text-xs font-semibold text-ink">Slide Caption / Title <span class="text-[#D4B87C]">*</span></label>
        <input type="text" name="caption" id="safari-modal-caption" required placeholder="e.g. Royal Bengal Tiger (Panthera tigris)" class="w-full px-3.5 py-2 rounded-xl border border-stone/50 bg-white text-xs sm:text-sm font-semibold focus:ring-2 focus:ring-forest-700/30 outline-none">
      </div>

      <!-- Display Order & Status -->
      <div class="grid grid-cols-2 gap-3">
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Display Order</label>
          <input type="number" name="order_num" id="safari-modal-order" min="1" max="99" value="1" class="w-full px-3.5 py-2 rounded-xl border border-stone/50 bg-white text-xs sm:text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
        </div>
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Slide Visibility</label>
          <select name="status" id="safari-modal-status" class="w-full px-3.5 py-2 rounded-xl border border-stone/50 bg-white text-xs sm:text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
            <option value="active">Active on Live Site</option>
            <option value="inactive">Hidden</option>
          </select>
        </div>
      </div>

      <!-- Actions -->
      <div class="flex items-center justify-end space-x-3 pt-4 border-t border-stone/30">
        <button type="button" onclick="closeSafariSlideModal()" class="px-5 py-2 rounded-full border border-stone/60 text-xs font-semibold hover:bg-stone/20 cursor-pointer">
          Cancel
        </button>
        <button type="submit" class="px-6 py-2 rounded-full bg-forest-900 hover:bg-forest-800 text-warm-white text-xs font-semibold shadow-md cursor-pointer">
          Save Carousel Slide
        </button>
      </div>

    </form>
  </div>
</div>

<!-- Dedicated Hidden Form for Delete / Toggle Actions -->
<form id="safariSlideActionForm" method="POST" action="" class="hidden">
  <?= csrf_field() ?>
</form>


<script>
  function switchContentTab(tabKey) {
    // Set hidden input
    const tabInput = document.getElementById('activeTabInput');
    if (tabInput) tabInput.value = tabKey;

    // Hide all tab panes
    document.querySelectorAll('.content-tab-pane').forEach(el => el.classList.add('hidden'));
    
    // Reset buttons
    document.querySelectorAll('.content-tab-btn').forEach(btn => {
      btn.classList.remove('bg-forest-900', 'text-[#D4B87C]', 'shadow-xs');
      btn.classList.add('bg-warm-white', 'text-body');
    });

    // Show selected pane
    const pane = document.getElementById('tab-' + tabKey);
    if (pane) pane.classList.remove('hidden');

    // Highlight button
    const activeBtn = document.getElementById('btn-tab-' + tabKey);
    if (activeBtn) {
      activeBtn.classList.remove('bg-warm-white', 'text-body');
      activeBtn.classList.add('bg-forest-900', 'text-[#D4B87C]', 'shadow-xs');
    }
  }

  // SAFARI CAROUSEL SLIDES HANDLERS
  function handleSafariSlideImageSelect(input) {
    if (input.files && input.files[0]) {
      const file = input.files[0];
      const previewImg = document.getElementById('safari-modal-image-preview');
      const statusSpan = document.getElementById('safari-modal-image-status');
      
      const objectUrl = URL.createObjectURL(file);
      previewImg.src = objectUrl;
      
      if (statusSpan) {
        statusSpan.innerHTML = `<span class="text-emerald-700 font-semibold flex items-center gap-1"><svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Selected: ${file.name}</span>`;
      }
    }
  }

  function openEditSafariSlideModal(slide) {
    document.getElementById('safari-modal-id').value = slide.id || '';
    document.getElementById('safari-modal-existing-image').value = slide.image || '';
    
    const previewImg = document.getElementById('safari-modal-image-preview');
    if (slide.image) {
      const isHttp = slide.image.startsWith('http://') || slide.image.startsWith('https://');
      previewImg.src = isHttp ? slide.image : '<?= base_url() ?>/' + slide.image.replace(/^\/+/, '');
    }
    document.getElementById('safari-modal-file').value = '';
    document.getElementById('safari-modal-image-status').innerHTML = '<span class="text-forest-800">Current image shown &middot; Click box to choose new from computer</span>';

    document.getElementById('safari-modal-tag').value = slide.tag || '';
    document.getElementById('safari-modal-caption').value = slide.caption || '';
    document.getElementById('safari-modal-order').value = slide.order_num || 1;
    document.getElementById('safari-modal-status').value = slide.status || 'active';
    
    document.getElementById('safari-modal-heading').innerText = 'Edit Carousel Slide #' + (slide.order_num || slide.id);
    document.getElementById('safari-slide-modal').classList.remove('hidden');
  }

  function openAddSafariSlideModal() {
    document.getElementById('safari-modal-id').value = '';
    document.getElementById('safari-modal-existing-image').value = 'assets/images/tiger-kanha-reserve.jpg';
    document.getElementById('safari-modal-image-preview').src = '<?= base_url("assets/images/tiger-kanha-reserve.jpg") ?>';
    document.getElementById('safari-modal-file').value = '';
    document.getElementById('safari-modal-image-status').innerHTML = '<span class="text-forest-800">Click box to choose photo from computer</span>';

    document.getElementById('safari-modal-tag').value = 'Apex Predator · Kanha Core';
    document.getElementById('safari-modal-caption').value = '';
    document.getElementById('safari-modal-order').value = <?= count($safariSlides) + 1 ?>;
    document.getElementById('safari-modal-status').value = 'active';

    document.getElementById('safari-modal-heading').innerText = 'Add New Carousel Slide';
    document.getElementById('safari-slide-modal').classList.remove('hidden');
  }

  function closeSafariSlideModal() {
    document.getElementById('safari-slide-modal').classList.add('hidden');
  }

  function deleteSafariSlide(id) {
    if (confirm('Are you sure you want to remove this safari carousel slide?')) {
      const f = document.getElementById('safariSlideActionForm');
      f.action = '<?= base_url('admin/safari-slides/delete') ?>/' + id;
      f.submit();
    }
  }

  function toggleSafariSlide(id) {
    const f = document.getElementById('safariSlideActionForm');
    f.action = '<?= base_url('admin/safari-slides/toggle') ?>/' + id;
    f.submit();
  }

  function previewHomeImage(input, previewId) {
    if (input.files && input.files[0]) {
      const file = input.files[0];
      const previewImg = document.getElementById(previewId);
      if (previewImg) {
        previewImg.src = URL.createObjectURL(file);
      }
      const filenameDiv = document.getElementById(previewId + '-filename');
      if (filenameDiv) {
        filenameDiv.innerHTML = '<span class="inline-flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span>Selected: <strong>' + file.name + '</strong> (' + (file.size / 1024).toFixed(1) + ' KB) &mdash; Ready to Save</span></span>';
        filenameDiv.classList.remove('hidden');
      }
    }
  }

  function setupDropzone(dropzoneId, inputId, previewId) {
    const dz = document.getElementById(dropzoneId);
    const inp = document.getElementById(inputId);
    if (!dz || !inp) return;

    ['dragenter', 'dragover'].forEach(name => {
      dz.addEventListener(name, (e) => {
        e.preventDefault();
        e.stopPropagation();
        dz.classList.add('border-[#D4B87C]', 'ring-4', 'ring-[#D4B87C]/30', 'scale-[1.01]');
      }, false);
    });

    ['dragleave', 'drop'].forEach(name => {
      dz.addEventListener(name, (e) => {
        e.preventDefault();
        e.stopPropagation();
        dz.classList.remove('border-[#D4B87C]', 'ring-4', 'ring-[#D4B87C]/30', 'scale-[1.01]');
      }, false);
    });

    dz.addEventListener('drop', (e) => {
      const dt = e.dataTransfer;
      const files = dt.files;
      if (files && files.length > 0) {
        inp.files = files;
        previewHomeImage(inp, previewId);
      }
    }, false);
  }

  document.addEventListener('DOMContentLoaded', () => {
    setupDropzone('dropzone-about-primary', 'file-about-primary', 'preview-about-primary');
    setupDropzone('dropzone-about-secondary', 'file-about-secondary', 'preview-about-secondary');
    setupDropzone('dropzone-safari-tiger', 'file-safari-tiger', 'preview-safari-tiger');
    setupDropzone('dropzone-safari-etching', 'file-safari-etching', 'preview-safari-etching');
    setupDropzone('dropzone-stay-cottage', 'file-stay-cottage', 'preview-stay-cottage');
    setupDropzone('dropzone-stay-interior', 'file-stay-interior', 'preview-stay-interior');
    setupDropzone('dropzone-safari-hero-bg', 'file-safari-hero-bg', 'preview-safari-hero-bg');
  });
</script>

<?= $this->endSection() ?>
