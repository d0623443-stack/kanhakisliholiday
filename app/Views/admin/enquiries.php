<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('admin_content') ?>

<div class="space-y-8 max-w-7xl mx-auto">
  
  <!-- PAGE HEADER & ACTION BAR -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
      <div class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700">
        Booking Requests & Forest Desk
      </div>
      <h2 class="font-serif text-2xl sm:text-3xl font-bold text-ink">
        Guest Enquiries & Safari Leads
      </h2>
      <p class="text-xs sm:text-sm text-body mt-0.5">
        Live customer requests synced directly with MySQL database.
      </p>
    </div>

    <div class="flex items-center space-x-3">
      <a href="<?= base_url('admin/enquiries/export') ?>" 
         class="inline-flex items-center justify-center px-4 py-2 rounded-full border border-stone/60 bg-warm-white text-forest-950 hover:bg-stone/20 text-xs sm:text-sm font-semibold shadow-xs transition-all cursor-pointer">
        <svg class="w-4 h-4 mr-1.5 text-forest-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        <span>Export CSV (<?= $counts['all'] ?? 0 ?>)</span>
      </a>
    </div>
  </div>


  <!-- FILTER & SEARCH BAR -->
  <div class="bg-warm-white p-4 sm:p-5 rounded-2xl border border-stone/40 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
    
    <!-- Service Type Tabs -->
    <div class="flex flex-wrap items-center gap-1.5 sm:gap-2">
      <a href="<?= base_url('admin/enquiries?type=all' . ($searchQuery ? '&q=' . urlencode($searchQuery) : '')) ?>" 
         class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-colors <?= ($typeFilter ?? 'all') === 'all' ? 'bg-forest-900 text-[#D4B87C]' : 'bg-ivory text-body hover:bg-stone/30' ?>">
        All Enquiries (<?= $counts['all'] ?? 0 ?>)
      </a>
      <a href="<?= base_url('admin/enquiries?type=safari' . ($searchQuery ? '&q=' . urlencode($searchQuery) : '')) ?>" 
         class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-colors <?= ($typeFilter ?? '') === 'safari' ? 'bg-forest-900 text-[#D4B87C]' : 'bg-ivory text-body hover:bg-stone/30' ?>">
        Safari Drives (<?= $counts['safari'] ?? 0 ?>)
      </a>
      <a href="<?= base_url('admin/enquiries?type=stay' . ($searchQuery ? '&q=' . urlencode($searchQuery) : '')) ?>" 
         class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-colors <?= ($typeFilter ?? '') === 'stay' ? 'bg-forest-900 text-[#D4B87C]' : 'bg-ivory text-body hover:bg-stone/30' ?>">
        Cottage Stays (<?= $counts['stay'] ?? 0 ?>)
      </a>
      <a href="<?= base_url('admin/enquiries?type=taxi' . ($searchQuery ? '&q=' . urlencode($searchQuery) : '')) ?>" 
         class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-colors <?= ($typeFilter ?? '') === 'taxi' ? 'bg-forest-900 text-[#D4B87C]' : 'bg-ivory text-body hover:bg-stone/30' ?>">
        Taxi Transfers (<?= $counts['taxi'] ?? 0 ?>)
      </a>
      <a href="<?= base_url('admin/enquiries?type=general' . ($searchQuery ? '&q=' . urlencode($searchQuery) : '')) ?>" 
         class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-colors <?= ($typeFilter ?? '') === 'general' ? 'bg-forest-900 text-[#D4B87C]' : 'bg-ivory text-body hover:bg-stone/30' ?>">
        General (<?= $counts['general'] ?? 0 ?>)
      </a>
    </div>

    <!-- Search Box -->
    <form method="GET" action="<?= base_url('admin/enquiries') ?>" class="flex items-center space-x-2">
      <?php if (!empty($typeFilter) && $typeFilter !== 'all'): ?>
        <input type="hidden" name="type" value="<?= esc($typeFilter) ?>">
      <?php endif; ?>
      <div class="relative w-full sm:w-64">
        <input type="text" 
               name="q" 
               value="<?= esc($searchQuery ?? '') ?>" 
               placeholder="Search name, phone, code..." 
               class="w-full pl-8 pr-3 py-1.5 rounded-xl border border-stone/50 bg-white text-xs focus:ring-2 focus:ring-forest-800 outline-none">
        <svg class="w-3.5 h-3.5 text-stone absolute left-2.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
      </div>
      <button type="submit" class="px-3 py-1.5 rounded-xl bg-forest-900 text-warm-white text-xs font-medium hover:bg-forest-800 transition-colors">
        Search
      </button>
      <?php if ($searchQuery): ?>
        <a href="<?= base_url('admin/enquiries' . ($typeFilter !== 'all' ? '?type=' . esc($typeFilter) : '')) ?>" class="text-xs text-rose-600 hover:underline">Clear</a>
      <?php endif; ?>
    </form>

  </div>


  <!-- ENQUIRIES DATA TABLE -->
  <div class="bg-warm-white rounded-2xl border border-stone/40 shadow-xs overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="border-b border-stone/30 bg-sand/35 text-[11px] font-mono uppercase tracking-wider text-forest-900/80">
            <th class="py-3.5 px-4 sm:px-6">Enquiry ID &amp; Guest</th>
            <th class="py-3.5 px-4">Contact</th>
            <th class="py-3.5 px-4">Service</th>
            <th class="py-3.5 px-4">Dates &amp; Details</th>
            <th class="py-3.5 px-4">Status</th>
            <th class="py-3.5 px-4 sm:px-6 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-stone/20 text-xs text-body">
          
          <?php if (empty($enquiries)): ?>
            <tr>
              <td colspan="6" class="py-12 text-center text-muted">
                <div class="max-w-xs mx-auto space-y-2">
                  <svg class="w-10 h-10 mx-auto text-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                  <p class="font-medium text-ink">No inquiries found matching criteria</p>
                  <p class="text-[11px] text-muted">Try resetting search filters or check back when new inquiries arrive.</p>
                </div>
              </td>
            </tr>
          <?php endif; ?>

          <?php foreach ($enquiries as $item): ?>
            <tr class="hover:bg-ivory/40 transition-colors">
              
              <!-- ID & Guest -->
              <td class="py-4 px-4 sm:px-6">
                <span class="text-[10px] font-mono font-bold text-forest-700 block"><?= esc($item['id']) ?></span>
                <span class="font-semibold text-ink text-sm block"><?= esc($item['name']) ?></span>
                <span class="text-[10px] text-muted block"><?= esc($item['created_at']) ?></span>
              </td>

              <!-- Contact -->
              <td class="py-4 px-4">
                <div class="space-y-0.5">
                  <div class="flex items-center space-x-1.5">
                    <a href="tel:<?= esc($item['phone']) ?>" class="font-medium text-ink hover:text-forest-800 text-xs">
                      <?= esc($item['phone']) ?>
                    </a>
                  </div>
                  <span class="text-[11px] text-muted block truncate max-w-[170px]">
                    <?= esc($item['email']) ?>
                  </span>
                </div>
              </td>

              <!-- Service Type -->
              <td class="py-4 px-4">
                <?php if ($item['type'] === 'safari'): ?>
                  <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800">
                    4x4 Safari Drive
                  </span>
                <?php elseif ($item['type'] === 'stay'): ?>
                  <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-semibold bg-amber-100 text-amber-800">
                    Cottage Stay
                  </span>
                <?php elseif ($item['type'] === 'taxi'): ?>
                  <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-semibold bg-blue-100 text-blue-900">
                    🚕 Taxi &amp; Transfer
                  </span>
                <?php else: ?>
                  <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-semibold bg-stone/40 text-ink">
                    General Inquiry
                  </span>
                <?php endif; ?>
              </td>

              <!-- Dates & Preferences -->
              <td class="py-4 px-4">
                <span class="font-medium block text-xs"><?= esc($item['date']) ?></span>
                <span class="text-[11px] text-muted block"><?= esc($item['zone']) ?></span>
                <span class="text-[10px] text-forest-800/80 font-mono block"><?= esc($item['vehicle']) ?> &middot; <?= $item['adults'] ?> pax</span>
              </td>

              <!-- Status Pill -->
              <td class="py-4 px-4">
                <?php if ($item['status'] === 'new'): ?>
                  <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                    New
                  </span>
                <?php elseif ($item['status'] === 'contacted'): ?>
                  <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    Contacted
                  </span>
                <?php elseif ($item['status'] === 'confirmed'): ?>
                  <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Confirmed
                  </span>
                <?php else: ?>
                  <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-stone/50 text-muted">
                    Archived
                  </span>
                <?php endif; ?>
              </td>

              <!-- Action Buttons -->
              <td class="py-4 px-4 sm:px-6 text-right">
                <div class="inline-flex items-center space-x-1.5">
                  
                  <!-- WhatsApp Direct -->
                  <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $item['phone']) ?>?text=Hello%20<?= urlencode($item['name']) ?>,%20this%20is%20Kanha%20Kisli%20Holiday%20wildlife%20desk%20regarding%20your%20enquiry%20<?= urlencode($item['id']) ?>" 
                     target="_blank" 
                     title="Chat on WhatsApp" 
                     class="p-2 rounded-xl bg-[#25D366]/15 text-[#1b803f] hover:bg-[#25D366]/30 transition-colors">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                  </a>

                  <!-- View Details Modal Trigger -->
                  <button type="button" 
                          onclick="viewEnquiryDetails(<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>)" 
                          class="px-3 py-1.5 rounded-xl bg-forest-900 text-warm-white text-xs font-semibold hover:bg-forest-800 transition-colors cursor-pointer">
                    View & Update
                  </button>

                </div>
              </td>

            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>


<!-- VIEW ENQUIRY DETAILS MODAL -->
<div id="enquiry-modal" class="fixed inset-0 z-50 bg-forest-950/70 backdrop-blur-xs flex items-center justify-center p-4 hidden">
  <div class="bg-warm-white rounded-3xl border border-stone/40 max-w-xl w-full p-6 sm:p-8 shadow-2xl space-y-6 max-h-[90vh] overflow-y-auto">
    
    <!-- Header -->
    <div class="flex items-center justify-between border-b border-stone/30 pb-3">
      <div>
        <span class="text-[10px] font-mono font-bold text-forest-700" id="mod-enq-id">ENQ-0000</span>
        <h3 class="font-serif text-2xl font-bold text-ink" id="mod-enq-name">Guest Details</h3>
      </div>
      <button type="button" onclick="closeEnquiryModal()" class="text-stone hover:text-ink text-xl font-bold p-1 cursor-pointer">&times;</button>
    </div>

    <!-- Data Grid -->
    <div class="space-y-4 text-xs">
      
      <!-- Contact Details -->
      <div class="p-4 rounded-2xl bg-ivory/80 border border-stone/30 space-y-2">
        <span class="font-bold uppercase tracking-wider text-[10px] text-muted block">Guest Contact</span>
        <div class="grid grid-cols-2 gap-2 text-ink">
          <div><span class="text-muted block">Phone:</span> <strong id="mod-enq-phone">+91 00000 00000</strong></div>
          <div><span class="text-muted block">Email:</span> <strong id="mod-enq-email">guest@example.com</strong></div>
          <div><span class="text-muted block">Nationality:</span> <strong id="mod-enq-nat">Indian</strong></div>
          <div><span class="text-muted block">Received:</span> <strong id="mod-enq-time">Time</strong></div>
        </div>
      </div>

      <!-- Booking Specs -->
      <div class="p-4 rounded-2xl bg-ivory/80 border border-stone/30 space-y-2">
        <span class="font-bold uppercase tracking-wider text-[10px] text-muted block">Reservation Specifications</span>
        <div class="grid grid-cols-2 gap-2 text-ink">
          <div><span class="text-muted block">Service Type:</span> <strong id="mod-enq-type">Type</strong></div>
          <div><span class="text-muted block">Target Date:</span> <strong id="mod-enq-date">Date</strong></div>
          <div><span class="text-muted block">Shift / Timing:</span> <strong id="mod-enq-shift">Timing</strong></div>
          <div><span class="text-muted block">Zone / Unit:</span> <strong id="mod-enq-zone">Zone</strong></div>
          <div><span class="text-muted block">Guests:</span> <strong id="mod-enq-guests">Guests</strong></div>
          <div><span class="text-muted block">Vehicle / Transport:</span> <strong id="mod-enq-vehicle">Vehicle</strong></div>
        </div>
      </div>

      <!-- Guest Special Notes -->
      <div class="p-4 rounded-2xl bg-ivory/80 border border-stone/30 space-y-1">
        <span class="font-bold uppercase tracking-wider text-[10px] text-muted block">Guest Special Request / Notes</span>
        <p class="text-body leading-relaxed whitespace-pre-line" id="mod-enq-notes">None</p>
      </div>

      <!-- Live Status Update Form -->
      <form method="POST" action="<?= base_url('admin/enquiries/update-status') ?>" class="pt-2 border-t border-stone/30 space-y-4">
        <?= csrf_field() ?>
        <input type="hidden" name="enquiry_id" id="mod-db-id" value="">

        <div class="space-y-1.5">
          <label class="block text-xs font-semibold text-ink">Update Enquiry Status in Database</label>
          <select name="status" id="mod-enq-status-select" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-xs outline-none focus:ring-2 focus:ring-forest-700/30">
            <option value="new">New (Awaiting Action)</option>
            <option value="contacted">Contacted via Phone/WhatsApp</option>
            <option value="confirmed">Confirmed & Permit Booked</option>
            <option value="archived">Archived</option>
          </select>
        </div>

        <div class="flex items-center justify-between pt-2">
          <a id="mod-wa-btn" href="#" target="_blank" class="px-4 py-2 rounded-full bg-[#25D366] hover:bg-[#20bd5a] text-white text-xs font-semibold flex items-center gap-1.5 shadow-sm transition-all">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            <span>WhatsApp Guest</span>
          </a>
          <button type="submit" class="px-5 py-2.5 rounded-full bg-forest-900 hover:bg-forest-800 text-[#D4B87C] text-xs font-semibold shadow-md transition-all cursor-pointer">
            Update Status
          </button>
        </div>
      </form>

    </div>

  </div>
</div>


<script>
  function viewEnquiryDetails(item) {
    document.getElementById('mod-db-id').value = item.db_id;
    document.getElementById('mod-enq-id').innerText = item.id;
    document.getElementById('mod-enq-name').innerText = item.name;
    document.getElementById('mod-enq-phone').innerText = item.phone;
    document.getElementById('mod-enq-email').innerText = item.email;
    document.getElementById('mod-enq-nat').innerText = item.nationality || 'Indian';
    document.getElementById('mod-enq-time').innerText = item.created_at;
    document.getElementById('mod-enq-type').innerText = item.typeName;
    document.getElementById('mod-enq-date').innerText = item.date;
    document.getElementById('mod-enq-shift').innerText = item.timing || 'Standard';
    document.getElementById('mod-enq-zone').innerText = item.zone;
    document.getElementById('mod-enq-guests').innerText = item.adults + ' Adults' + (item.children > 0 ? ', ' + item.children + ' Children' : '');
    document.getElementById('mod-enq-vehicle').innerText = item.vehicle;
    document.getElementById('mod-enq-notes').innerText = item.notes || 'None';
    document.getElementById('mod-enq-status-select').value = item.status;

    const cleanPhone = (item.phone || '').replace(/[^0-9]/g, '');
    document.getElementById('mod-wa-btn').href = 'https://wa.me/' + cleanPhone + '?text=Hi%20' + encodeURIComponent(item.name) + ',%20this%20is%20Kanha%20Kisli%20Holiday%20regarding%20your%20booking%20enquiry%20' + encodeURIComponent(item.id);

    document.getElementById('enquiry-modal').classList.remove('hidden');
  }

  function closeEnquiryModal() {
    document.getElementById('enquiry-modal').classList.add('hidden');
  }
</script>

<?= $this->endSection() ?>
