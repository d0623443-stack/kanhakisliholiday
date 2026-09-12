<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('admin_content') ?>

<div class="space-y-8 max-w-7xl mx-auto">
  
  <!-- WELCOME BANNER -->
  <div class="relative bg-gradient-to-r from-forest-950 via-forest-900 to-forest-950 rounded-3xl p-6 sm:p-8 text-warm-white overflow-hidden shadow-xl border border-forest-800/60">
    <!-- Botanical Watermark Accent -->
    <div class="absolute -right-6 -bottom-8 w-64 pointer-events-none opacity-15 text-moss mix-blend-multiply">
      <img src="<?= base_url('assets/images/kanha-meadow-wildlife-etching.png') ?>" alt="" class="w-full h-auto">
    </div>

    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
      <div class="space-y-2 max-w-2xl">
        <div class="inline-flex items-center space-x-2 text-xs font-semibold tracking-widest-plus uppercase text-[#D4B87C]">
          <span>Resort Operations &middot; Kanha Core Desk</span>
        </div>
        <h2 class="font-serif text-2xl sm:text-3xl md:text-4xl font-bold text-warm-white leading-tight">
          Welcome back, <?= esc($adminName ?? 'Rajesh Sharma') ?>
        </h2>
        <p class="text-stone text-xs sm:text-sm font-normal leading-relaxed">
          Here is what's happening at Kanha Kisli Holiday today. You have <strong class="text-warm-white"><?= $stats['newEnquiries'] ?? 4 ?> new inquiries</strong> awaiting permit verification and guest confirmation.
        </p>
      </div>

      <!-- Quick Date & Shift Badge -->
      <div class="flex items-center space-x-3 bg-forest-900/80 p-3 rounded-2xl border border-warm-white/10 backdrop-blur-sm self-start md:self-auto">
        <div class="w-10 h-10 rounded-xl bg-[#D4B87C] text-forest-950 flex items-center justify-center font-bold text-base">
          <?= date('d') ?>
        </div>
        <div class="text-xs">
          <span class="block font-semibold text-warm-white"><?= date('F Y') ?></span>
          <span class="text-sage"><?= date('l') ?> &middot; Core Shift Active</span>
        </div>
      </div>
    </div>
  </div>


  <!-- 4 STAT METRICS CARDS -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
    
    <!-- Stat 1: Total Enquiries -->
    <div class="bg-warm-white p-5 sm:p-6 rounded-2xl border border-stone/40 shadow-xs space-y-3 hover:border-forest-700/40 transition-colors">
      <div class="flex items-center justify-between">
        <span class="text-xs font-semibold tracking-wider uppercase text-muted">Total Enquiries</span>
        <div class="w-9 h-9 rounded-xl bg-forest-900/10 text-forest-800 flex items-center justify-center">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
      </div>
      <div>
        <span class="font-serif text-3xl sm:text-4xl font-bold text-ink"><?= $stats['totalEnquiries'] ?? 18 ?></span>
        <span class="inline-flex items-center ml-2 text-xs font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md">
          +4 New
        </span>
      </div>
      <p class="text-xs text-body">Received across Safari & Stay forms</p>
    </div>

    <!-- Stat 2: Safari Bookings -->
    <div class="bg-warm-white p-5 sm:p-6 rounded-2xl border border-stone/40 shadow-xs space-y-3 hover:border-forest-700/40 transition-colors">
      <div class="flex items-center justify-between">
        <span class="text-xs font-semibold tracking-wider uppercase text-muted">Safari Drives</span>
        <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-800 flex items-center justify-center">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
        </div>
      </div>
      <div>
        <span class="font-serif text-3xl sm:text-4xl font-bold text-ink"><?= $stats['safariBookings'] ?? 8 ?></span>
        <span class="inline-flex items-center ml-2 text-xs font-semibold text-forest-800 bg-forest-900/10 px-2 py-0.5 rounded-md">
          4 Core Zones
        </span>
      </div>
      <p class="text-xs text-body">Gypsy permits requested this month</p>
    </div>

    <!-- Stat 3: Cottage Stays -->
    <div class="bg-warm-white p-5 sm:p-6 rounded-2xl border border-stone/40 shadow-xs space-y-3 hover:border-forest-700/40 transition-colors">
      <div class="flex items-center justify-between">
        <span class="text-xs font-semibold tracking-wider uppercase text-muted">Cottage Stays</span>
        <div class="w-9 h-9 rounded-xl bg-[#D4B87C]/20 text-forest-900 flex items-center justify-center">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
        </div>
      </div>
      <div>
        <span class="font-serif text-3xl sm:text-4xl font-bold text-ink"><?= $stats['stayBookings'] ?? 6 ?></span>
        <span class="inline-flex items-center ml-2 text-xs font-semibold text-amber-800 bg-amber-50 px-2 py-0.5 rounded-md">
          85% Occupancy
        </span>
      </div>
      <p class="text-xs text-body">Forest cottages & Machan villas</p>
    </div>

    <!-- Stat 4: Gallery & Media Assets -->
    <div class="bg-warm-white p-5 sm:p-6 rounded-2xl border border-stone/40 shadow-xs space-y-3 hover:border-forest-700/40 transition-colors">
      <div class="flex items-center justify-between">
        <span class="text-xs font-semibold tracking-wider uppercase text-muted">Live Media Assets</span>
        <div class="w-9 h-9 rounded-xl bg-forest-900/10 text-forest-800 flex items-center justify-center">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
      </div>
      <div>
        <span class="font-serif text-3xl sm:text-4xl font-bold text-ink"><?= ($stats['galleryPhotos'] ?? 8) + ($stats['sliderSlides'] ?? 2) ?></span>
        <span class="inline-flex items-center ml-2 text-xs font-semibold text-forest-800 bg-forest-900/10 px-2 py-0.5 rounded-md">
          <?= $stats['sliderSlides'] ?? 2 ?> Slides &middot; <?= $stats['galleryPhotos'] ?? 8 ?> Photos
        </span>
      </div>
      <p class="text-xs text-body">Curated wildlife photography</p>
    </div>

  </div>


  <!-- QUICK ACTION SHORTCUTS -->
  <div class="space-y-3">
    <div class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700">
      Quick Administrative Actions
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
      
      <!-- Action 1: Slider -->
      <a href="<?= base_url('admin/slider') ?>" 
         class="p-4 rounded-2xl bg-warm-white border border-stone/40 hover:border-[#D4B87C] shadow-xs hover:shadow-md transition-all flex items-center space-x-3 group">
        <div class="w-10 h-10 rounded-xl bg-forest-900 text-[#D4B87C] flex items-center justify-center group-hover:scale-110 transition-transform">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <div>
          <span class="block text-sm font-bold text-ink group-hover:text-forest-800">Update Slider</span>
          <span class="block text-[11px] text-muted">Hero images & text</span>
        </div>
      </a>

      <!-- Action 2: Site Content -->
      <a href="<?= base_url('admin/content') ?>" 
         class="p-4 rounded-2xl bg-warm-white border border-stone/40 hover:border-[#D4B87C] shadow-xs hover:shadow-md transition-all flex items-center space-x-3 group">
        <div class="w-10 h-10 rounded-xl bg-forest-900 text-[#D4B87C] flex items-center justify-center group-hover:scale-110 transition-transform">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        </div>
        <div>
          <span class="block text-sm font-bold text-ink group-hover:text-forest-800">Site Content</span>
          <span class="block text-[11px] text-muted">Edit text & features</span>
        </div>
      </a>

      <!-- Action 3: Add Gallery Image -->
      <a href="<?= base_url('admin/gallery') ?>" 
         class="p-4 rounded-2xl bg-warm-white border border-stone/40 hover:border-[#D4B87C] shadow-xs hover:shadow-md transition-all flex items-center space-x-3 group">
        <div class="w-10 h-10 rounded-xl bg-forest-900 text-[#D4B87C] flex items-center justify-center group-hover:scale-110 transition-transform">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4"/></svg>
        </div>
        <div>
          <span class="block text-sm font-bold text-ink group-hover:text-forest-800">Add Photo</span>
          <span class="block text-[11px] text-muted">Upload gallery item</span>
        </div>
      </a>

      <!-- Action 4: View Enquiries -->
      <a href="<?= base_url('admin/enquiries') ?>" 
         class="p-4 rounded-2xl bg-warm-white border border-stone/40 hover:border-[#D4B87C] shadow-xs hover:shadow-md transition-all flex items-center space-x-3 group">
        <div class="w-10 h-10 rounded-xl bg-forest-900 text-[#D4B87C] flex items-center justify-center group-hover:scale-110 transition-transform">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
        </div>
        <div>
          <span class="block text-sm font-bold text-ink group-hover:text-forest-800">All Leads</span>
          <span class="block text-[11px] text-muted">Review 18 inquiries</span>
        </div>
      </a>

    </div>
  </div>


  <!-- RECENT ENQUIRIES TABLE -->
  <div class="bg-warm-white rounded-3xl border border-stone/40 shadow-xs overflow-hidden">
    
    <!-- Table Header Bar -->
    <div class="p-5 sm:p-6 border-b border-stone/30 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
      <div>
        <h3 class="font-serif text-xl sm:text-2xl font-bold text-ink">Recent Guest Enquiries</h3>
        <p class="text-xs text-muted mt-0.5">Latest booking inquiries from Kanha Kisli website forms</p>
      </div>

      <div class="flex items-center space-x-3">
        <a href="<?= base_url('admin/enquiries') ?>" 
           class="inline-flex items-center space-x-1.5 text-xs font-semibold text-forest-800 hover:text-forest-600">
          <span>View All Enquiries</span>
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>

    <!-- Table Responsive Container -->
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs sm:text-sm">
        <thead class="bg-ivory/60 text-[11px] font-mono uppercase tracking-wider text-muted border-b border-stone/30">
          <tr>
            <th class="py-3 px-4 sm:px-6">Guest Name</th>
            <th class="py-3 px-4">Contact</th>
            <th class="py-3 px-4">Booking Type</th>
            <th class="py-3 px-4">Target Date / Zone</th>
            <th class="py-3 px-4">Status</th>
            <th class="py-3 px-4 sm:px-6 text-right">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-stone/20 text-ink">
          <?php foreach ($recentEnquiries as $enq): ?>
            <tr class="hover:bg-ivory/40 transition-colors">
              
              <!-- Name & Time -->
              <td class="py-3.5 px-4 sm:px-6">
                <span class="font-semibold text-ink block"><?= esc($enq['name']) ?></span>
                <span class="text-[11px] text-muted block"><?= esc($enq['time']) ?></span>
              </td>

              <!-- Contact -->
              <td class="py-3.5 px-4">
                <a href="tel:<?= esc($enq['phone']) ?>" class="block font-medium hover:text-forest-800 text-xs"><?= esc($enq['phone']) ?></a>
                <span class="text-[11px] text-muted block truncate max-w-[150px]"><?= esc($enq['email']) ?></span>
              </td>

              <!-- Booking Type Badge -->
              <td class="py-3.5 px-4">
                <?php if ($enq['type'] === 'safari'): ?>
                  <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800">
                    Safari Drive
                  </span>
                <?php elseif ($enq['type'] === 'stay'): ?>
                  <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-semibold bg-amber-100 text-amber-800">
                    Cottage Stay
                  </span>
                <?php elseif ($enq['type'] === 'combo'): ?>
                  <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-semibold bg-teal-100 text-teal-800">
                    Safari + Stay
                  </span>
                <?php else: ?>
                  <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-semibold bg-stone/40 text-ink">
                    General Inquiry
                  </span>
                <?php endif; ?>
              </td>

              <!-- Date & Zone -->
              <td class="py-3.5 px-4">
                <span class="font-medium block text-xs"><?= esc($enq['date']) ?></span>
                <span class="text-[11px] text-muted block"><?= esc($enq['zone']) ?> &middot; <?= esc($enq['guests']) ?></span>
              </td>

              <!-- Status Pill -->
              <td class="py-3.5 px-4">
                <?php if ($enq['status'] === 'new'): ?>
                  <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                    New
                  </span>
                <?php elseif ($enq['status'] === 'contacted'): ?>
                  <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    Contacted
                  </span>
                <?php elseif ($enq['status'] === 'confirmed'): ?>
                  <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Confirmed
                  </span>
                <?php endif; ?>
              </td>

              <!-- Actions -->
              <td class="py-3.5 px-4 sm:px-6 text-right">
                <div class="inline-flex items-center space-x-1.5">
                  <!-- Quick WhatsApp -->
                  <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $enq['phone']) ?>?text=Hi%20<?= urlencode($enq['name']) ?>,%20regarding%20your%20Kanha%20booking%20enquiry..." 
                     target="_blank" 
                     title="Open WhatsApp" 
                     class="p-1.5 rounded-lg bg-[#25D366]/10 text-[#1b803f] hover:bg-[#25D366]/20 transition-colors">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                  </a>
                  <!-- View Details -->
                  <a href="<?= base_url('admin/enquiries?q=' . urlencode($enq['id'])) ?>" 
                     class="px-2.5 py-1 rounded-lg bg-forest-900/10 hover:bg-forest-900 hover:text-warm-white text-forest-900 transition-colors text-xs font-semibold">
                    View
                  </a>
                </div>
              </td>

            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>

</div>

<?= $this->endSection() ?>
