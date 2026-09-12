<?= $this->extend('admin/layouts/admin') ?>

<?= $this->section('admin_content') ?>

<div class="space-y-8 max-w-5xl mx-auto">
  
  <!-- PAGE HEADER -->
  <div>
    <div class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700">
      System Preferences
    </div>
    <h2 class="font-serif text-2xl sm:text-3xl font-bold text-ink">
      General Settings & Administrator Profile
    </h2>
    <p class="text-xs sm:text-sm text-body mt-0.5">
      Configure resort brand details, booking alert notification channels, and update admin credentials.
    </p>
  </div>


  <!-- SETTINGS FORM -->
  <form method="POST" action="<?= base_url('admin/settings/update') ?>" class="space-y-6">
    <?= csrf_field() ?>
    
    <!-- Card 1: Resort Details -->
    <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-5">
      <div class="border-b border-stone/20 pb-3">
        <h3 class="font-serif text-xl font-bold text-ink">Resort Brand Information</h3>
        <p class="text-xs text-muted">Primary business display identity synced with footer and website metadata.</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Resort Display Name</label>
          <input type="text" name="site_name" value="<?= esc($settings['site_name']) ?>" required class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
        </div>
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Brand Tagline</label>
          <input type="text" name="site_tagline" value="<?= esc($settings['site_tagline']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
        </div>
      </div>

      <div class="space-y-1">
        <label class="block text-xs font-semibold text-ink">Location & Nearest Gate Notice</label>
        <input type="text" name="location_text" value="<?= esc($settings['location_text']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
      </div>
    </div>


    <!-- Card 2: Notification & Booking Channels -->
    <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-5">
      <div class="border-b border-stone/20 pb-3">
        <h3 class="font-serif text-xl font-bold text-ink">Notification & Communication Channels</h3>
        <p class="text-xs text-muted">Where guest inquiries from safari and stay forms are dispatched.</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Lead Notification Email</label>
          <input type="email" name="notification_mail" value="<?= esc($settings['notification_mail']) ?>" required class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
          <span class="text-[11px] text-muted">Receives instant copies of every booking request</span>
        </div>
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">WhatsApp Desk Direct Number</label>
          <input type="text" name="whatsapp_number" value="<?= esc($settings['whatsapp_number']) ?>" required class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm font-mono focus:ring-2 focus:ring-forest-700/30 outline-none">
          <span class="text-[11px] text-muted">Used for 1-click WhatsApp guest chats and website buttons</span>
        </div>
      </div>

      <div class="space-y-1">
        <label class="block text-xs font-semibold text-ink">Helpline Phone Number</label>
        <input type="text" name="helpline_phone" value="<?= esc($settings['helpline_phone'] ?? $settings['whatsapp_number']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm font-mono focus:ring-2 focus:ring-forest-700/30 outline-none">
      </div>
    </div>


    <!-- Card 3: Admin Credentials -->
    <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-5">
      <div class="border-b border-stone/20 pb-3">
        <h3 class="font-serif text-xl font-bold text-ink">Administrator Account</h3>
        <p class="text-xs text-muted">Credentials used to log into this administrative portal.</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Administrator Name</label>
          <input type="text" name="admin_name" value="<?= esc($currentUser['name'] ?? session()->get('admin_name') ?? 'Administrator') ?>" required class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
        </div>
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Login Email Address</label>
          <input type="email" name="admin_email" value="<?= esc($currentUser['email'] ?? $settings['admin_email']) ?>" required class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">New Password (Optional)</label>
          <input type="password" name="new_password" placeholder="Leave blank to keep current password" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
        </div>
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Confirm New Password</label>
          <input type="password" name="confirm_password" placeholder="Confirm new password" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
        </div>
      </div>
    </div>


    <!-- Submit Action -->
    <div class="flex items-center justify-end space-x-3 pt-2">
      <button type="submit" 
              class="px-8 py-3 rounded-full bg-forest-900 hover:bg-forest-800 text-[#D4B87C] font-semibold text-sm shadow-md hover:shadow-lg transition-all hover:-translate-y-0.5 cursor-pointer">
        Save All Settings
      </button>
    </div>

  </form>

</div>

<?= $this->endSection() ?>
