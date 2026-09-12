<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('admin_content') ?>

<div class="space-y-8 max-w-7xl mx-auto">
  
  <form method="POST" action="<?= base_url('admin/content/update') ?>" id="contentForm">
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
      
      <!-- About Section Card -->
      <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-5">
        <div class="border-b border-stone/20 pb-3 flex items-center justify-between">
          <div>
            <h3 class="font-serif text-xl font-bold text-ink">Section: About Kanha Kisli Holiday</h3>
            <p class="text-xs text-muted">The introductory overview section displayed immediately below the hero slider.</p>
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

        <!-- Feature Badges -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
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

      <!-- Safari Journey Timeline Card -->
      <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-5">
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

        <div class="space-y-3 pt-2">
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

      <!-- Home Stay Preview Section Card -->
      <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-5">
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

        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Hero Background Image Asset Path</label>
          <div class="flex items-center gap-3">
            <div class="w-16 h-12 rounded-lg bg-forest-950 overflow-hidden border border-stone/30 shrink-0">
              <img src="<?= base_url(esc($content['safari']['hero_bg_image'] ?? 'assets/images/tiger-kanha-reserve.jpg')) ?>" class="w-full h-full object-cover">
            </div>
            <input type="text" name="content[safari][hero_bg_image]" value="<?= esc($content['safari']['hero_bg_image'] ?? 'assets/images/tiger-kanha-reserve.jpg') ?>" class="flex-1 px-3.5 py-2 rounded-xl border border-stone/50 bg-white text-xs font-mono">
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
            <p class="text-xs text-muted mt-0.5">The main interactive 4x4 Gypsy & wildlife photo slider on the Safari page. Click any slide to edit or upload a new photo from your computer.</p>
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
            <div class="p-5 rounded-2xl bg-ivory/80 border border-stone/30 relative group hover:border-[#D4B87C] hover:shadow-md transition-all flex flex-col justify-between space-y-4">
              
              <div class="space-y-3.5">
                <!-- Top Header: Slide Order, Status Toggle & Delete -->
                <div class="flex items-center justify-between border-b border-stone/20 pb-3">
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
                            class="px-2.5 py-0.5 rounded-full text-[10px] font-semibold cursor-pointer <?= ($sslide['status'] ?? 'active') === 'active' ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-stone/20 text-stone hover:bg-stone/30' ?>">
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

                <!-- Slide Content: Landscape Image + Metadata -->
                <div class="flex flex-col sm:flex-row gap-4 items-start">
                  <!-- Clickable Image Thumbnail that opens Edit Modal with photo preview -->
                  <div class="relative w-full sm:w-48 h-36 rounded-xl overflow-hidden bg-forest-950/20 border border-stone/30 cursor-pointer shadow-xs shrink-0 group/img" 
                       onclick="openEditSafariSlideModal(<?= htmlspecialchars(json_encode($sslide), ENT_QUOTES, 'UTF-8') ?>)">
                    <img src="<?= (str_starts_with($sslide['image'], 'http://') || str_starts_with($sslide['image'], 'https://')) ? esc($sslide['image']) : base_url(esc($sslide['image'])) ?>" 
                         alt="<?= esc($sslide['caption']) ?>" 
                         class="w-full h-full object-cover group-hover/img:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-forest-950/50 opacity-0 group-hover/img:opacity-100 transition-opacity flex items-center justify-center text-warm-white text-[11px] font-semibold gap-1 text-center px-2">
                      <svg class="w-3.5 h-3.5 text-[#D4B87C] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                      <span>Click to Edit / Upload</span>
                    </div>
                  </div>

                  <!-- Tag & Caption Title & Image Info -->
                  <div class="space-y-2 min-w-0 flex-1">
                    <span class="inline-block text-[10px] font-mono uppercase tracking-wider text-forest-700 bg-forest-900/10 px-2.5 py-0.5 rounded font-semibold truncate max-w-full">
                      <?= esc($sslide['tag'] ?: 'Safari Slide') ?>
                    </span>
                    <h4 class="text-sm font-bold text-ink line-clamp-2 leading-snug" title="<?= esc($sslide['caption']) ?>">
                      <?= esc($sslide['caption']) ?>
                    </h4>
                    <p class="text-[11px] text-muted font-mono truncate" title="<?= esc($sslide['image']) ?>">
                      <?= esc($sslide['image']) ?>
                    </p>
                  </div>
                </div>
              </div>

              <!-- Edit Action Button -->
              <div class="pt-3 border-t border-stone/20">
                <button type="button" 
                        onclick="openEditSafariSlideModal(<?= htmlspecialchars(json_encode($sslide), ENT_QUOTES, 'UTF-8') ?>)" 
                        class="w-full py-2 rounded-xl bg-forest-900/10 hover:bg-forest-900 hover:text-warm-white text-forest-900 text-xs font-semibold transition-colors cursor-pointer text-center flex items-center justify-center gap-1.5">
                  <svg class="w-3.5 h-3.5 text-[#D4B87C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                  <span>Edit Slide & Upload Image</span>
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
          </div>
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">Secondary Phone</label>
            <input type="text" name="content[contact][phone_secondary]" value="<?= esc($content['contact']['phone_secondary']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm font-mono focus:ring-2 focus:ring-forest-700/30 outline-none">
          </div>
          <div class="space-y-1">
            <label class="block text-xs font-semibold text-ink">WhatsApp Desk Number</label>
            <input type="text" name="content[contact][whatsapp]" value="<?= esc($content['contact']['whatsapp']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm font-mono focus:ring-2 focus:ring-forest-700/30 outline-none">
          </div>
          <div class="space-y-1">
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
</script>

<?= $this->endSection() ?>
