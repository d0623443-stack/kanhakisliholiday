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

      <div class="space-y-1">
        <div class="flex items-center justify-between">
          <label class="block text-xs font-semibold text-ink">Google Maps Embed Link (Iframe / URL)</label>
          <?php if (!empty($settings['google_maps_embed'])): ?>
            <a href="<?= esc(parse_map_embed_url($settings['google_maps_embed'])) ?>" target="_blank" rel="noopener noreferrer" class="text-[11px] text-forest-700 hover:underline inline-flex items-center">
              <span>Preview Map</span>
              <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
          <?php endif; ?>
        </div>
        <textarea name="google_maps_embed" rows="3" placeholder="Paste Google Maps embed URL (https://www.google.com/maps/embed?pb=...) or entire iframe tag" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-xs font-mono focus:ring-2 focus:ring-forest-700/30 outline-none leading-relaxed"><?= esc($settings['google_maps_embed'] ?? '') ?></textarea>
        <span class="text-[11px] text-muted">Paste your Google Maps embed URL or the full &lt;iframe&gt; code copied from Google Maps Share &gt; Embed a map. Dynamically rendered on the Contact page.</span>
      </div>
    </div>


    <!-- Card 2: Notification & Booking Channels -->
    <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-5">
      <div class="border-b border-stone/20 pb-3 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
        <div>
          <h3 class="font-serif text-xl font-bold text-ink">Notification &amp; Communication Channels</h3>
          <p class="text-xs text-muted">Where guest inquiries from safari, stay, and contact forms are dispatched.</p>
        </div>
        <div class="flex items-center gap-2">
          <span class="px-2.5 py-1 rounded-full text-[11px] font-mono <?= (($settings['auto_email_lead'] ?? '1') === '1') ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' ?>">
            <?= (($settings['auto_email_lead'] ?? '1') === '1') ? '● Enquiry Email Active' : '○ Enquiry Email Disabled' ?>
          </span>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <!-- Enquiry Email Sending Option -->
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Enquiry Email Sending (<code>auto_email_lead</code>)</label>
          <select name="auto_email_lead" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none font-medium">
            <option value="1" <?= (($settings['auto_email_lead'] ?? '1') === '1') ? 'selected' : '' ?>>1 — Enabled (Send instant notification email for every enquiry)</option>
            <option value="0" <?= (($settings['auto_email_lead'] ?? '1') !== '1') ? 'selected' : '' ?>>0 — Disabled (Save leads to database only, pause email alerts)</option>
          </select>
          <span class="text-[11px] text-muted">Toggles automated email dispatch for Safari, Stay &amp; Contact forms</span>
        </div>

        <!-- Lead Notification Email -->
        <div class="space-y-1">
          <div class="flex items-center justify-between">
            <label class="block text-xs font-semibold text-ink">Lead Notification Recipient Email</label>
            <button type="submit" formaction="<?= base_url('admin/settings/test-email') ?>" class="text-[11px] text-forest-700 hover:text-forest-900 font-semibold underline decoration-dotted hover:decoration-solid inline-flex items-center gap-1 cursor-pointer">
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
              <span>Send Test Email</span>
            </button>
          </div>
          <input type="email" name="notification_mail" value="<?= esc($settings['notification_mail']) ?>" required class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
          <span class="text-[11px] text-muted">Inbox address that receives instant copies of every guest enquiry</span>
        </div>

        <!-- WhatsApp Desk Direct Number -->
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">WhatsApp Desk Direct Number</label>
          <input type="text" name="whatsapp_number" value="<?= esc($settings['whatsapp_number']) ?>" required class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm font-mono focus:ring-2 focus:ring-forest-700/30 outline-none">
          <span class="text-[11px] text-muted">Used for 1-click WhatsApp guest chats and website buttons</span>
        </div>

        <!-- Primary Mobile Number -->
        <div class="space-y-1">
          <label class="block text-xs font-semibold text-ink">Primary Mobile Number</label>
          <input type="text" name="helpline_phone" value="<?= esc($settings['helpline_phone'] ?? $settings['whatsapp_number']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm font-mono focus:ring-2 focus:ring-forest-700/30 outline-none">
          <span class="text-[11px] text-muted">First mobile number displayed across header, footer &amp; contact</span>
        </div>

        <!-- Secondary Mobile Number -->
        <div class="space-y-1 sm:col-span-2">
          <label class="block text-xs font-semibold text-ink">Secondary Mobile Number</label>
          <input type="text" name="owner_phone" value="<?= esc($settings['owner_phone'] ?? '+91 75667 89123') ?>" placeholder="e.g. +91 98260 12345" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm font-mono focus:ring-2 focus:ring-forest-700/30 outline-none">
          <span class="text-[11px] text-muted">Second mobile number displayed alongside primary number</span>
        </div>
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


    <!-- Card 4: Admin Portal Access & Visibility -->
    <div class="bg-warm-white rounded-3xl border border-stone/40 p-6 sm:p-8 shadow-xs space-y-5">
      <div class="border-b border-stone/20 pb-3 flex items-center justify-between">
        <div>
          <h3 class="font-serif text-xl font-bold text-ink">Admin Portal Access &amp; Visibility</h3>
          <p class="text-xs text-muted">Controls whether the admin link in footer and the <code>/admin</code> routes are active or return a 404 Page Not Found error.</p>
        </div>
        <span class="px-2.5 py-1 rounded-full text-[11px] font-mono <?= (($settings['admin_enabled'] ?? '1') === '1') ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' ?>">
          <?= (($settings['admin_enabled'] ?? '1') === '1') ? '● Active' : '○ Disabled (404)' ?>
        </span>
      </div>

      <div class="space-y-3">
        <div class="max-w-md space-y-1">
          <label class="block text-xs font-semibold text-ink">Admin Access State (<code>admin_enabled</code>)</label>
          <select name="admin_enabled" class="w-full px-3.5 py-2.5 rounded-xl border border-stone/50 bg-white text-sm focus:ring-2 focus:ring-forest-700/30 outline-none">
            <option value="1" <?= (($settings['admin_enabled'] ?? '1') === '1') ? 'selected' : '' ?>>1 — Enabled (Admin link visible, /admin routes work)</option>
            <option value="0" <?= (($settings['admin_enabled'] ?? '1') !== '1') ? 'selected' : '' ?>>0 — Disabled (Admin link hidden, /admin returns 404 Not Found)</option>
          </select>
        </div>
        <div class="p-3.5 rounded-2xl bg-forest-900/5 border border-forest-900/10 text-xs text-body space-y-1">
          <div class="font-semibold text-forest-900 flex items-center gap-1.5">
            <svg class="w-4 h-4 text-forest-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Direct Database Control</span>
          </div>
          <p class="text-[12px] text-muted">
            You can change this directly in MySQL (e.g. phpMyAdmin):<br>
            <code class="font-mono bg-white px-2 py-0.5 rounded border border-stone/30 text-ink">UPDATE settings SET value_content = '1' WHERE key_name = 'admin_enabled';</code> to enable.<br>
            <code class="font-mono bg-white px-2 py-0.5 rounded border border-stone/30 text-ink">UPDATE settings SET value_content = '0' WHERE key_name = 'admin_enabled';</code> to disable &amp; show 404.
          </p>
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
