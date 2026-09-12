<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('admin_content') ?>

<div class="space-y-8 max-w-7xl mx-auto">
  
  <!-- PAGE HEADER & ACTION BAR -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <div class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700">
        Homepage Showcase
      </div>
      <h2 class="font-serif text-2xl sm:text-3xl font-bold text-ink">
        Hero Slider Management
      </h2>
      <p class="text-xs sm:text-sm text-body mt-0.5">
        Manage top fullscreen showcase slides, forest photography, headlines and call-to-action buttons.
      </p>
    </div>

    <div class="flex items-center space-x-3">
      <button type="button" 
              onclick="openAddSlideModal()" 
              class="inline-flex items-center justify-center px-4 py-2.5 rounded-full bg-forest-900 hover:bg-forest-800 text-warm-white font-semibold text-xs sm:text-sm shadow-md transition-all hover:-translate-y-0.5 cursor-pointer">
        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        <span>Add New Slide</span>
      </button>
    </div>
  </div>


  <!-- SLIDES LIST: 2 Slides in One Row -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-stretch">
    <?php foreach ($slides as $index => $slide): ?>
      <div class="bg-warm-white rounded-3xl border border-stone/40 p-5 sm:p-6 shadow-xs hover:border-forest-700/40 transition-all flex flex-col justify-between space-y-5">
        
        <div class="space-y-4">
          <!-- Top Metadata & Control Bar -->
          <div class="flex items-center justify-between gap-2 border-b border-stone/20 pb-3.5">
            <div class="flex items-center space-x-2.5 min-w-0">
              <span class="w-7 h-7 rounded-full bg-forest-900 text-[#D4B87C] font-mono font-bold text-xs flex items-center justify-center shadow-xs shrink-0">
                0<?= esc($slide['order']) ?>
              </span>
              <div class="min-w-0">
                <span class="font-serif text-base font-bold text-ink block truncate">Slide #<?= esc($slide['order']) ?></span>
                <span class="text-[11px] text-muted block truncate font-mono"><?= esc($slide['eyebrow']) ?></span>
              </div>
            </div>

            <div class="flex items-center space-x-1.5 shrink-0">
              <!-- Active / Inactive Toggle -->
              <form method="POST" action="<?= base_url('admin/slider/toggle/' . $slide['id']) ?>" class="inline">
                <?= csrf_field() ?>
                <?php if (($slide['status'] ?? 'active') === 'active'): ?>
                  <button type="submit" title="Click to hide from live site" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-100 text-emerald-800 hover:bg-emerald-200 transition-colors cursor-pointer">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <span>Active</span>
                  </button>
                <?php else: ?>
                  <button type="submit" title="Click to activate on live site" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-100 text-amber-800 hover:bg-amber-200 transition-colors cursor-pointer">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    <span>Hidden</span>
                  </button>
                <?php endif; ?>
              </form>

              <!-- Edit Button -->
              <button type="button" 
                      onclick="openEditSlideModal(<?= htmlspecialchars(json_encode($slide), ENT_QUOTES, 'UTF-8') ?>)" 
                      class="px-2.5 py-1 rounded-lg bg-forest-900/10 hover:bg-forest-900 hover:text-warm-white text-forest-900 text-xs font-semibold transition-colors cursor-pointer">
                Edit
              </button>

              <!-- Delete Button (if more than 1) -->
              <?php if (count($slides) > 1): ?>
                <form method="POST" action="<?= base_url('admin/slider/delete/' . $slide['id']) ?>" onsubmit="return confirm('Are you sure you want to delete this hero slide?')" class="inline">
                  <?= csrf_field() ?>
                  <button type="submit" class="p-1 rounded-lg text-red-700 hover:bg-red-100 transition-colors text-xs font-semibold cursor-pointer" title="Delete Slide">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                  </button>
                </form>
              <?php endif; ?>
            </div>
          </div>

          <!-- Image Frame with Aspect Preview & Click to Edit -->
          <div class="relative h-56 sm:h-64 rounded-2xl overflow-hidden bg-forest-950 border border-stone/30 shadow-sm group cursor-pointer"
               onclick="openEditSlideModal(<?= htmlspecialchars(json_encode($slide), ENT_QUOTES, 'UTF-8') ?>)">
            <img src="<?= base_url(esc($slide['image'])) ?>" 
                 alt="<?= esc($slide['alt']) ?>" 
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-forest-950/85 via-forest-950/20 to-transparent pointer-events-none"></div>
            
            <!-- Floating Hover Overlay -->
            <div class="absolute inset-0 bg-forest-950/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-warm-white text-xs font-semibold gap-2">
              <svg class="w-4 h-4 text-[#D4B87C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
              <span>Click to Upload New Photo or Edit</span>
            </div>

            <!-- Resolution & File Path Badges -->
            <span class="absolute top-2.5 left-2.5 px-2 py-0.5 rounded-md bg-forest-950/80 backdrop-blur-sm text-warm-white text-[10px] font-mono border border-warm-white/20">
              1920 &times; 1080
            </span>
            <span class="absolute bottom-2.5 left-2.5 text-[11px] text-warm-white/90 truncate max-w-[88%] font-mono">
              <?= esc($slide['image']) ?>
            </span>
          </div>

          <!-- Slide Copy & Headlines -->
          <div class="space-y-2">
            <span class="text-[10px] font-mono uppercase tracking-wider text-forest-700 font-semibold block">
              <?= esc($slide['eyebrow']) ?>
            </span>
            <h3 class="font-serif text-xl sm:text-2xl font-bold text-ink leading-tight">
              <?= esc($slide['title']) ?> <span class="italic font-normal text-muted"><?= esc($slide['subtitle_italic']) ?></span>
            </h3>
            <p class="text-body text-xs sm:text-sm leading-relaxed line-clamp-3">
              <?= esc($slide['description']) ?>
            </p>
          </div>
        </div>

        <!-- Action Buttons Preview & Quick Edit -->
        <div class="pt-3 border-t border-stone/20 space-y-3">
          <div class="flex flex-wrap items-center gap-2">
            <span class="text-[10px] font-semibold text-muted uppercase tracking-wider">Buttons:</span>
            <div class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-full bg-[#25D366] text-white text-[11px] font-semibold shadow-2xs" title="<?= esc($slide['btn1_link']) ?>">
              <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
              <span><?= esc($slide['btn1_text']) ?></span>
            </div>
            <div class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-full bg-[#D4B87C] text-forest-950 text-[11px] font-semibold shadow-2xs" title="<?= esc($slide['btn2_link']) ?>">
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
              <span><?= esc($slide['btn2_text']) ?></span>
            </div>
          </div>

          <button type="button" 
                  onclick="openEditSlideModal(<?= htmlspecialchars(json_encode($slide), ENT_QUOTES, 'UTF-8') ?>)" 
                  class="w-full py-2 rounded-xl bg-forest-900/10 hover:bg-forest-900 hover:text-warm-white text-forest-900 text-xs font-semibold transition-colors cursor-pointer text-center flex items-center justify-center gap-1.5">
            <svg class="w-3.5 h-3.5 text-[#D4B87C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
            <span>Edit Slide & Upload Image</span>
          </button>
        </div>

      </div>
    <?php endforeach; ?>
  </div>

</div>


<!-- EDIT SLIDE MODAL -->
<div id="edit-slide-modal" class="fixed inset-0 z-50 bg-forest-950/70 backdrop-blur-xs flex items-center justify-center p-4 hidden">
  <div class="bg-warm-white rounded-3xl border border-stone/40 max-w-2xl w-full p-6 sm:p-8 shadow-2xl space-y-6 max-h-[90vh] overflow-y-auto">
    
    <div class="flex items-center justify-between border-b border-stone/30 pb-4">
      <div>
        <h3 class="font-serif text-xl sm:text-2xl font-bold text-ink" id="edit-modal-heading">Edit Hero Slide</h3>
        <p class="text-xs text-muted">Upload slide photo from your computer, set headline copy and call-to-actions.</p>
      </div>
      <button type="button" onclick="closeEditSlideModal()" class="text-stone hover:text-ink text-xl font-bold p-1">&times;</button>
    </div>

    <form method="POST" action="<?= base_url('admin/slider/save') ?>" enctype="multipart/form-data" class="space-y-4">
      <?= csrf_field() ?>
      <input type="hidden" name="id" id="modal-slide-id" value="">

      <!-- Image Upload Placeholder / Previous Upload Box -->
      <div class="space-y-1.5">
        <label class="block text-xs font-semibold text-ink flex items-center justify-between">
          <span>Hero Slide Image <span class="text-[#D4B87C]">*</span></span>
          <span class="text-[11px] text-forest-700 font-normal">Click image below to choose file</span>
        </label>
        
        <!-- Hidden file input triggered when clicking the box -->
        <input type="file" 
               name="slide_image" 
               id="modal-slide-file" 
               accept="image/png, image/jpeg, image/webp, image/jpg" 
               class="hidden" 
               onchange="handleSlideImageSelect(this)">
        <input type="hidden" name="existing_image" id="modal-existing-image" value="">

        <!-- Clickable Image Upload Box / Previous Image -->
        <div id="slide-image-dropzone" 
             onclick="document.getElementById('modal-slide-file').click()" 
             class="relative group rounded-2xl border-2 border-dashed border-stone/40 hover:border-[#D4B87C] bg-ivory/60 hover:bg-ivory transition-all cursor-pointer overflow-hidden p-2 text-center flex flex-col items-center justify-center">
          
          <!-- Image preview (shows previous uploaded image or newly selected image) -->
          <div id="modal-preview-wrapper" class="relative w-full h-48 rounded-xl overflow-hidden bg-forest-950/20">
            <img id="modal-image-preview" 
                 src="<?= base_url('assets/images/slider/1.webp') ?>" 
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
            <span id="modal-image-status" class="flex items-center gap-1.5 text-forest-800 font-medium">
              <svg class="w-3.5 h-3.5 text-forest-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
              <span>Click box to choose photo from computer</span>
            </span>
            <span class="text-[10px] text-stone">JPG, PNG, WEBP &middot; High Resolution</span>
          </div>
        </div>
      </div>

      <!-- Eyebrow -->
      <div class="space-y-1">
        <label class="block text-xs font-semibold text-ink">Eyebrow Location / Tag</label>
        <input type="text" name="eyebrow" id="modal-eyebrow" class="w-full px-3.5 py-2 rounded-xl border border-stone/60 text-sm focus:ring-2 focus:ring-forest-800">
      </div>

      <!-- Main Headline -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Main Headline</label>
          <input type="text" name="title" id="modal-title" required class="w-full px-3.5 py-2 rounded-xl border border-stone/60 text-sm focus:ring-2 focus:ring-forest-800">
        </div>
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Italic Accent Headline</label>
          <input type="text" name="subtitle_italic" id="modal-italic" class="w-full px-3.5 py-2 rounded-xl border border-stone/60 text-sm focus:ring-2 focus:ring-forest-800">
        </div>
      </div>

      <!-- Subtitle Description -->
      <div class="space-y-1">
        <label class="block text-xs font-semibold text-ink">Subtitle Paragraph</label>
        <textarea name="description" id="modal-desc" rows="2" class="w-full px-3.5 py-2 rounded-xl border border-stone/60 text-sm focus:ring-2 focus:ring-forest-800"></textarea>
      </div>

      <!-- Buttons CTA -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">WhatsApp Button Text</label>
          <input type="text" name="btn1_text" id="modal-btn1" value="WhatsApp" class="w-full px-3.5 py-2 rounded-xl border border-stone/60 text-sm">
        </div>
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Call Button Text</label>
          <input type="text" name="btn2_text" id="modal-btn2" value="Call Now" class="w-full px-3.5 py-2 rounded-xl border border-stone/60 text-sm">
        </div>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">WhatsApp Link</label>
          <input type="text" name="btn1_link" id="modal-btn1-link" class="w-full px-3.5 py-2 rounded-xl border border-stone/60 text-sm">
        </div>
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Call Link / Tel</label>
          <input type="text" name="btn2_link" id="modal-btn2-link" class="w-full px-3.5 py-2 rounded-xl border border-stone/60 text-sm">
        </div>
      </div>

      <!-- Submit & Cancel -->
      <div class="flex items-center justify-end space-x-3 pt-4 border-t border-stone/30">
        <button type="button" onclick="closeEditSlideModal()" class="px-5 py-2 rounded-full border border-stone/60 text-xs font-semibold hover:bg-stone/20 cursor-pointer">
          Cancel
        </button>
        <button type="submit" class="px-6 py-2 rounded-full bg-forest-900 hover:bg-forest-800 text-warm-white text-xs font-semibold shadow-md cursor-pointer">
          Save Slide
        </button>
      </div>

    </form>
  </div>
</div>


<script>
  function handleSlideImageSelect(input) {
    if (input.files && input.files[0]) {
      const file = input.files[0];
      const previewImg = document.getElementById('modal-image-preview');
      const statusSpan = document.getElementById('modal-image-status');
      
      const objectUrl = URL.createObjectURL(file);
      previewImg.src = objectUrl;
      
      if (statusSpan) {
        statusSpan.innerHTML = `<span class="text-emerald-700 font-semibold flex items-center gap-1"><svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Selected: ${file.name}</span>`;
      }
    }
  }

  function openEditSlideModal(slide) {
    document.getElementById('modal-slide-id').value = slide.id || '';
    document.getElementById('modal-eyebrow').value = slide.eyebrow || '';
    document.getElementById('modal-title').value = slide.title || '';
    document.getElementById('modal-italic').value = slide.subtitle_italic || '';
    document.getElementById('modal-desc').value = slide.description || '';
    
    // Set existing image and live preview
    document.getElementById('modal-existing-image').value = slide.image || '';
    const previewImg = document.getElementById('modal-image-preview');
    if (slide.image) {
      const isHttp = slide.image.startsWith('http://') || slide.image.startsWith('https://');
      previewImg.src = isHttp ? slide.image : '<?= base_url() ?>/' + slide.image.replace(/^\/+/, '');
    }
    document.getElementById('modal-slide-file').value = '';
    document.getElementById('modal-image-status').innerHTML = '<span class="text-forest-800">Current image shown &middot; Click to choose new from computer</span>';

    document.getElementById('modal-btn1').value = slide.btn1_text || 'WhatsApp';
    document.getElementById('modal-btn1-link').value = slide.btn1_link || 'https://wa.me/919425100000';
    document.getElementById('modal-btn2').value = slide.btn2_text || 'Call Now';
    document.getElementById('modal-btn2-link').value = slide.btn2_link || 'tel:+919425100000';
    document.getElementById('edit-modal-heading').innerText = 'Edit Slide #' + slide.order;
    document.getElementById('edit-slide-modal').classList.remove('hidden');
  }

  function openAddSlideModal() {
    document.getElementById('modal-slide-id').value = '';
    document.getElementById('modal-eyebrow').value = 'Kanha National Park · MP';
    document.getElementById('modal-title').value = 'Untamed Wilderness';
    document.getElementById('modal-italic').value = 'Bespoke Wildlife Journeys';
    document.getElementById('modal-desc').value = 'Personalized 4x4 Gypsy safaris led by seasoned forest naturalists.';
    
    // Set placeholder image
    document.getElementById('modal-existing-image').value = 'assets/images/safari-trail.jpg';
    document.getElementById('modal-image-preview').src = '<?= base_url("assets/images/safari-trail.jpg") ?>';
    document.getElementById('modal-slide-file').value = '';
    document.getElementById('modal-image-status').innerHTML = '<span class="text-forest-800">Click box to choose photo from computer</span>';

    document.getElementById('modal-btn1').value = 'WhatsApp';
    document.getElementById('modal-btn1-link').value = 'https://wa.me/919425100000';
    document.getElementById('modal-btn2').value = 'Call Now';
    document.getElementById('modal-btn2-link').value = 'tel:+919425100000';
    document.getElementById('edit-modal-heading').innerText = 'Add New Hero Slide';
    document.getElementById('edit-slide-modal').classList.remove('hidden');
  }

  function closeEditSlideModal() {
    document.getElementById('edit-slide-modal').classList.add('hidden');
  }
</script>

<?= $this->endSection() ?>
