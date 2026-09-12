<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('admin_content') ?>

<div class="space-y-8 max-w-7xl mx-auto">
  
  <!-- PAGE HEADER & ACTION BAR -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <div class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700">
        Media & Visual Chronicles
      </div>
      <h2 class="font-serif text-2xl sm:text-3xl font-bold text-ink">
        Photo Gallery Management
      </h2>
      <p class="text-xs sm:text-sm text-body mt-0.5">
        Upload, categorize, and curate high-resolution wildlife, safari, and resort photography in the database.
      </p>
    </div>

    <div class="flex items-center space-x-3">
      <a href="<?= base_url('gallery') ?>" target="_blank" class="hidden sm:inline-flex items-center px-4 py-2.5 rounded-full border border-stone/40 bg-white text-forest-900 font-semibold text-xs sm:text-sm hover:bg-stone/20 transition-all">
        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
        <span>View Live Gallery</span>
      </a>
      <button type="button" 
              onclick="openUploadPhotoModal()" 
              class="inline-flex items-center justify-center px-4 py-2.5 rounded-full bg-forest-900 hover:bg-forest-800 text-warm-white font-semibold text-xs sm:text-sm shadow-md transition-all hover:-translate-y-0.5 cursor-pointer">
        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        <span>Upload New Photo</span>
      </button>
    </div>
  </div>


  <!-- CATEGORY FILTER BAR -->
  <div class="flex flex-wrap items-center gap-2">
    <?php foreach ($categories as $catKey => $catName): ?>
      <a href="<?= base_url('admin/gallery?category=' . $catKey) ?>" 
         class="px-3.5 py-1.5 rounded-full text-xs font-semibold transition-colors <?= ($selectedCategory ?? 'all') === $catKey ? 'bg-forest-900 text-[#D4B87C] shadow-xs' : 'bg-warm-white text-body hover:bg-stone/30 border border-stone/30' ?>">
        <?= esc($catName) ?>
      </a>
    <?php endforeach; ?>
  </div>


  <!-- PHOTO GRID -->
  <?php if (empty($items)): ?>
    <div class="bg-warm-white rounded-3xl border border-stone/40 p-12 text-center">
      <svg class="w-12 h-12 mx-auto text-stone mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
      <h3 class="font-serif text-lg font-bold text-ink mb-1">No Photos Found</h3>
      <p class="text-xs text-muted mb-4">No gallery items match this category filter.</p>
      <button type="button" onclick="openUploadPhotoModal()" class="inline-flex items-center px-4 py-2 rounded-full bg-forest-900 text-warm-white text-xs font-semibold">
        Add First Photo
      </button>
    </div>
  <?php else: ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
      <?php foreach ($items as $item): ?>
        <div class="bg-warm-white rounded-2xl border border-stone/40 overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col justify-between group">
          
          <!-- Image Preview Frame -->
          <div class="relative h-48 bg-forest-950 overflow-hidden">
            <img src="<?= base_url(esc($item['image'])) ?>" 
                 alt="<?= esc($item['title']) ?>" 
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            
            <div class="absolute inset-0 bg-gradient-to-t from-forest-950/70 via-transparent to-transparent pointer-events-none"></div>
            
            <!-- Category & Aspect Badges -->
            <div class="absolute top-2.5 left-2.5 flex items-center gap-1.5">
              <span class="px-2 py-0.5 rounded-md text-[10px] font-mono font-semibold uppercase bg-forest-950/80 backdrop-blur-sm text-[#D4B87C] border border-[#D4B87C]/30">
                <?= esc($item['category']) ?>
              </span>
            </div>

            <span class="absolute top-2.5 right-2.5 px-2 py-0.5 rounded-md text-[10px] font-mono bg-black/60 backdrop-blur-sm text-warm-white border border-warm-white/20">
              <?= esc($item['aspect']) ?>
            </span>

            <span class="absolute bottom-2 right-2 text-[10px] font-mono text-warm-white/80 bg-forest-950/70 px-1.5 py-0.5 rounded">
              <?= $item['views'] ?? 0 ?> views
            </span>
          </div>

          <!-- Info & Details -->
          <div class="p-4 space-y-2 flex-1 flex flex-col justify-between">
            <div class="space-y-0.5">
              <span class="text-[10px] font-mono text-forest-700 uppercase tracking-wider block">
                <?= esc($item['subtitle']) ?>
              </span>
              <h4 class="font-serif text-base font-bold text-ink leading-snug line-clamp-2">
                <?= esc($item['title']) ?>
              </h4>
            </div>

            <!-- Bottom Action Buttons -->
            <div class="pt-3 border-t border-stone/20 flex items-center justify-between">
              <span class="text-[10px] text-muted font-mono">
                <?= !empty($item['created_at']) ? date('M d, Y', strtotime($item['created_at'])) : 'Active' ?>
              </span>

              <div class="flex items-center space-x-1.5">
                <button type="button" 
                        onclick="openEditPhotoModal(<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>)" 
                        title="Edit Photo Info" 
                        class="p-1.5 rounded-lg bg-stone/20 hover:bg-forest-900 hover:text-warm-white text-ink transition-colors cursor-pointer">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                </button>
                <form method="POST" action="<?= base_url('admin/gallery/delete/' . $item['id']) ?>" onsubmit="return confirm('Are you sure you want to delete this photo from the database?');" class="inline">
                  <?= csrf_field() ?>
                  <button type="submit" 
                          title="Delete Photo" 
                          class="p-1.5 rounded-lg bg-rose-50 hover:bg-rose-600 hover:text-white text-rose-700 transition-colors cursor-pointer">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                  </button>
                </form>
              </div>
            </div>
          </div>

        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

</div>


<!-- UPLOAD / EDIT PHOTO MODAL -->
<div id="photo-modal" class="fixed inset-0 z-50 bg-forest-950/70 backdrop-blur-xs flex items-center justify-center p-4 hidden">
  <div class="bg-warm-white rounded-3xl border border-stone/40 max-w-xl w-full p-6 sm:p-8 shadow-2xl space-y-5 max-h-[90vh] overflow-y-auto">
    
    <div class="flex items-center justify-between border-b border-stone/30 pb-3">
      <div>
        <h3 class="font-serif text-xl sm:text-2xl font-bold text-ink" id="photo-modal-heading">Upload New Gallery Photo</h3>
        <p class="text-xs text-muted">Add high-resolution wildlife or forest lodge photograph.</p>
      </div>
      <button type="button" onclick="closePhotoModal()" class="text-stone hover:text-ink text-xl font-bold p-1">&times;</button>
    </div>

    <form method="POST" action="<?= base_url('admin/gallery/save') ?>" class="space-y-4">
      <?= csrf_field() ?>
      <input type="hidden" name="id" id="photo-id" value="">

      <!-- Image Path Field -->
      <div class="space-y-1">
        <label class="block text-xs font-semibold text-ink">Image Asset Path (relative to public/ or full URL)</label>
        <input type="text" name="image" id="photo-image-path" value="assets/images/tiger-portrait.jpg" required class="w-full px-3.5 py-2.5 rounded-xl border border-stone/60 text-xs font-mono bg-white outline-none focus:ring-2 focus:ring-forest-700/30">
        <p class="text-[11px] text-muted">Examples: <code class="bg-stone/20 px-1 py-0.5 rounded">assets/images/deer-meadow.jpg</code> or uploaded media path.</p>
      </div>

      <!-- Title & Subtitle -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Photo Title</label>
          <input type="text" name="title" id="photo-title" value="" required class="w-full px-3.5 py-2.5 rounded-xl border border-stone/60 text-sm bg-white outline-none focus:ring-2 focus:ring-forest-700/30">
        </div>
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Location / Subtitle</label>
          <input type="text" name="subtitle" id="photo-subtitle" value="" required class="w-full px-3.5 py-2.5 rounded-xl border border-stone/60 text-sm bg-white outline-none focus:ring-2 focus:ring-forest-700/30">
        </div>
      </div>

      <!-- Category & Aspect Ratio -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Category</label>
          <select name="category" id="photo-category" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/60 text-sm bg-white outline-none focus:ring-2 focus:ring-forest-700/30">
            <option value="wildlife">Wildlife</option>
            <option value="safari">Safari Trails</option>
            <option value="birdlife">Birdlife</option>
            <option value="stay">Stays & Grounds</option>
            <option value="forest">Forest Canopies</option>
          </select>
        </div>
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Aspect Ratio</label>
          <select name="aspect" id="photo-aspect" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/60 text-sm bg-white outline-none focus:ring-2 focus:ring-forest-700/30">
            <option value="wide">Wide (16:9)</option>
            <option value="tall">Tall (3:4)</option>
            <option value="standard">Standard (4:3)</option>
            <option value="square">Square (1:1)</option>
          </select>
        </div>
      </div>

      <!-- Order & Status -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Sort Order</label>
          <input type="number" name="order_num" id="photo-order" value="1" min="1" max="99" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/60 text-sm bg-white outline-none focus:ring-2 focus:ring-forest-700/30">
        </div>
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Status</label>
          <select name="status" id="photo-status" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/60 text-sm bg-white outline-none focus:ring-2 focus:ring-forest-700/30">
            <option value="active">Active (Visible)</option>
            <option value="inactive">Draft / Hidden</option>
          </select>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="flex items-center justify-end space-x-3 pt-4 border-t border-stone/30">
        <button type="button" onclick="closePhotoModal()" class="px-5 py-2.5 rounded-full border border-stone/60 text-xs font-semibold hover:bg-stone/20 transition-all cursor-pointer">
          Cancel
        </button>
        <button type="submit" class="px-6 py-2.5 rounded-full bg-forest-900 hover:bg-forest-800 text-warm-white text-xs font-semibold shadow-md transition-all cursor-pointer">
          Save Photo to Database
        </button>
      </div>

    </form>

  </div>
</div>


<script>
  function openUploadPhotoModal() {
    document.getElementById('photo-modal-heading').innerText = 'Upload New Gallery Photo';
    document.getElementById('photo-id').value = '';
    document.getElementById('photo-image-path').value = 'assets/images/tiger-portrait.jpg';
    document.getElementById('photo-title').value = '';
    document.getElementById('photo-subtitle').value = '';
    document.getElementById('photo-category').value = 'wildlife';
    document.getElementById('photo-aspect').value = 'wide';
    document.getElementById('photo-order').value = '1';
    document.getElementById('photo-status').value = 'active';
    document.getElementById('photo-modal').classList.remove('hidden');
  }

  function openEditPhotoModal(item) {
    document.getElementById('photo-modal-heading').innerText = 'Edit Photo #' + item.id;
    document.getElementById('photo-id').value = item.id || '';
    document.getElementById('photo-image-path').value = item.image || '';
    document.getElementById('photo-title').value = item.title || '';
    document.getElementById('photo-subtitle').value = item.subtitle || '';
    document.getElementById('photo-category').value = item.category || 'wildlife';
    document.getElementById('photo-aspect').value = item.aspect || 'wide';
    document.getElementById('photo-order').value = item.order_num || '1';
    document.getElementById('photo-status').value = item.status || 'active';
    document.getElementById('photo-modal').classList.remove('hidden');
  }

  function closePhotoModal() {
    document.getElementById('photo-modal').classList.add('hidden');
  }
</script>

<?= $this->endSection() ?>
