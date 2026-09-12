<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- INNER HERO (Breadcrumb Banner) -->
<section class="relative bg-forest-950 text-warm-white min-h-[430px] sm:min-h-[470px] md:min-h-[520px] lg:min-h-[550px] flex items-center justify-center pt-40 sm:pt-44 md:pt-52 pb-16 md:pb-24 overflow-hidden">
  <div class="absolute inset-0 z-0">
    <img src="<?= base_url('assets/images/safari-trail.jpg') ?>" 
         alt="Kanha trail" 
         class="w-full h-full object-cover object-center opacity-60" />
    <!-- Top-to-bottom dark shadow covering menu section for effortless legibility -->
    <div class="absolute inset-0 bg-gradient-to-b from-forest-950/95 via-forest-950/50 to-forest-950/90"></div>
  </div>

  <div class="relative z-10 max-w-site mx-auto px-5 sm:px-8 md:px-12 text-center max-w-3xl">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="Breadcrumb" class="inline-flex items-center space-x-2 text-xs font-semibold uppercase tracking-widest px-4 py-1.5 rounded-full bg-forest-950/70 border border-warm-white/15 text-sage mb-4 shadow-sm backdrop-blur-sm">
      <a href="<?= base_url('/') ?>" class="hover:text-warm-white transition-colors">Home</a>
      <span class="text-stone/60">/</span>
      <span class="text-warm-white font-bold">Contact</span>
    </nav>

    <div class="text-xs font-semibold tracking-widest-plus uppercase text-sage mb-3">
      Reach Out
    </div>
    <h1 class="font-serif text-4xl sm:text-6xl md:text-7xl font-bold text-warm-white leading-tight">
      Plan your Kanha visit.
    </h1>
    <p class="mt-6 text-stone text-base sm:text-lg md:text-xl font-normal leading-relaxed">
      Let us know your travel preferences, safari requirements, or stay questions. We are here to help you plan an unhurried wilderness retreat.
    </p>
  </div>
</section>


<!-- CONTACT FORM & DETAILS SECTION -->
<section class="py-20 md:py-28 bg-warm-white" aria-label="Contact and Booking Assistance">
  <div class="max-w-site mx-auto px-5 sm:px-8 md:px-12">
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
      
      <!-- Left Column: Direct Info -->
      <div class="lg:col-span-5 space-y-8">
        
        <div class="space-y-4">
          <div class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700">
            Contact Information
          </div>
          <h2 class="font-serif text-3xl sm:text-4xl font-bold text-ink">
            We are here to assist your forest journey.
          </h2>
          <p class="text-body text-base leading-relaxed">
            Whether you need safari permit guidance, accommodation advice, or transfer assistance from Jabalpur, Nagpur, or Gondia, reach out to our team.
          </p>
        </div>

        <!-- Contact Cards -->
        <div class="space-y-4">
          
          <!-- Location -->
          <div class="p-6 rounded-2xl bg-ivory/80 border border-stone/50 flex items-start space-x-4">
            <div class="w-10 h-10 rounded-full bg-warm-white border border-stone/40 flex items-center justify-center text-forest-800 flex-shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-ink text-sm sm:text-base">Location & Gate</h3>
              <p class="text-body text-sm mt-0.5"><?= esc($content['address'] ?? $settings['location_text'] ?? 'Kanha Kisli Holiday, Near Khatia / Kisli Gate, Mandla District, Madhya Pradesh, India') ?></p>
            </div>
          </div>

          <!-- Phone & WhatsApp -->
          <div class="p-6 rounded-2xl bg-ivory/80 border border-stone/50 flex items-start space-x-4">
            <div class="w-10 h-10 rounded-full bg-warm-white border border-stone/40 flex items-center justify-center text-forest-800 flex-shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-ink text-sm sm:text-base">Phone & WhatsApp</h3>
              <p class="text-body text-sm mt-0.5">
                <a href="tel:<?= esc($content['phone_primary'] ?? $settings['helpline_phone'] ?? '+919425100000') ?>" class="hover:text-forest-700 transition-colors"><?= esc($content['phone_primary'] ?? $settings['helpline_phone'] ?? '+91 94251 00000') ?></a>
                <?php if (!empty($content['phone_secondary'])): ?>
                  / <a href="tel:<?= esc($content['phone_secondary']) ?>" class="hover:text-forest-700 transition-colors"><?= esc($content['phone_secondary']) ?></a>
                <?php endif; ?>
              </p>
              <span class="text-xs text-muted"><?= esc($content['hours'] ?? 'Daily: 08:00 AM – 08:00 PM IST') ?></span>
            </div>
          </div>

          <!-- Email -->
          <div class="p-6 rounded-2xl bg-ivory/80 border border-stone/50 flex items-start space-x-4">
            <div class="w-10 h-10 rounded-full bg-warm-white border border-stone/40 flex items-center justify-center text-forest-800 flex-shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-ink text-sm sm:text-base">Email Enquiry</h3>
              <p class="text-body text-sm mt-0.5"><a href="mailto:<?= esc($content['email'] ?? $settings['admin_email'] ?? 'stay@kanhakisliholiday.com') ?>" class="hover:text-forest-700 transition-colors"><?= esc($content['email'] ?? $settings['admin_email'] ?? 'stay@kanhakisliholiday.com') ?></a></p>
            </div>
          </div>

        </div>

      </div>

      <!-- Right Column: Enquiry Form with Server Validation -->
      <div class="lg:col-span-7 bg-ivory/60 border border-stone/50 rounded-3xl p-8 sm:p-12 shadow-sm">
        
        <h3 class="font-serif text-2xl sm:text-3xl font-bold text-ink mb-2">Send an Enquiry</h3>
        <p class="text-body text-sm mb-8">Fill in your details below and we will get back to you with custom safari and stay information.</p>

        <!-- Display Validation Errors if any -->
        <?php if (session()->getFlashdata('errors')): ?>
          <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm space-y-1">
            <p class="font-semibold">Please check the following:</p>
            <ul class="list-disc list-inside space-y-0.5">
              <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <!-- Form -->
        <form action="<?= base_url('contact/enquiry') ?>" method="POST" class="space-y-6">
          <?= csrf_field() ?>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            
            <!-- Full Name -->
            <div class="space-y-2">
              <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-forest-900">
                Full Name <span class="text-red-600">*</span>
              </label>
              <input type="text" 
                     id="name" 
                     name="name" 
                     value="<?= old('name') ?>" 
                     required 
                     class="w-full px-4 py-3 rounded-xl bg-warm-white border border-stone/50 text-ink focus:border-forest-700 focus:ring-2 focus:ring-forest-700/20 outline-none transition-colors text-sm"
                     placeholder="e.g. John Doe">
            </div>

            <!-- Phone / WhatsApp -->
            <div class="space-y-2">
              <label for="phone" class="block text-xs font-semibold uppercase tracking-wider text-forest-900">
                Phone / WhatsApp <span class="text-red-600">*</span>
              </label>
              <input type="tel" 
                     id="phone" 
                     name="phone" 
                     value="<?= old('phone') ?>" 
                     required 
                     class="w-full px-4 py-3 rounded-xl bg-warm-white border border-stone/50 text-ink focus:border-forest-700 focus:ring-2 focus:ring-forest-700/20 outline-none transition-colors text-sm"
                     placeholder="+91 98765 43210">
            </div>

          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            
            <!-- Email Address -->
            <div class="space-y-2">
              <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-forest-900">
                Email Address <span class="text-red-600">*</span>
              </label>
              <input type="email" 
                     id="email" 
                     name="email" 
                     value="<?= old('email') ?>" 
                     required 
                     class="w-full px-4 py-3 rounded-xl bg-warm-white border border-stone/50 text-ink focus:border-forest-700 focus:ring-2 focus:ring-forest-700/20 outline-none transition-colors text-sm"
                     placeholder="you@example.com">
            </div>

            <!-- Interested In -->
            <div class="space-y-2">
              <label for="interest" class="block text-xs font-semibold uppercase tracking-wider text-forest-900">
                Interested In <span class="text-red-600">*</span>
              </label>
              <select id="interest" 
                      name="interest" 
                      required 
                      class="w-full px-4 py-3 rounded-xl bg-warm-white border border-stone/50 text-ink focus:border-forest-700 focus:ring-2 focus:ring-forest-700/20 outline-none transition-colors text-sm">
                <option value="safari" <?= old('interest') === 'safari' ? 'selected' : '' ?>>Kanha Safari Assistance</option>
                <option value="stay" <?= old('interest') === 'stay' ? 'selected' : '' ?>>Forest Accommodation</option>
                <option value="combo" <?= old('interest') === 'combo' ? 'selected' : '' ?>>Safari & Stay Combo</option>
                <option value="general" <?= old('interest') === 'general' ? 'selected' : '' ?>>General Inquiry</option>
              </select>
            </div>

          </div>

          <!-- Travel Dates -->
          <div class="space-y-2">
            <label for="travel_date" class="block text-xs font-semibold uppercase tracking-wider text-forest-900">
              Preferred Travel Dates or Season
            </label>
            <input type="text" 
                   id="travel_date" 
                   name="travel_date" 
                   value="<?= old('travel_date') ?>" 
                   class="w-full px-4 py-3 rounded-xl bg-warm-white border border-stone/50 text-ink focus:border-forest-700 focus:ring-2 focus:ring-forest-700/20 outline-none transition-colors text-sm"
                   placeholder="e.g. Mid November, 2 Adults, 2 Safaris">
          </div>

          <!-- Message -->
          <div class="space-y-2">
            <label for="message" class="block text-xs font-semibold uppercase tracking-wider text-forest-900">
              Message or Specific Requests
            </label>
            <textarea id="message" 
                      name="message" 
                      rows="4" 
                      class="w-full px-4 py-3 rounded-xl bg-warm-white border border-stone/50 text-ink focus:border-forest-700 focus:ring-2 focus:ring-forest-700/20 outline-none transition-colors text-sm"
                      placeholder="Tell us about your trip plans, number of guests, or preferred zones..."><?= old('message') ?></textarea>
          </div>

          <!-- Submit Button -->
          <div class="pt-2">
            <button type="submit" 
                    class="w-full sm:w-auto inline-flex items-center justify-center px-9 py-4 rounded-full bg-forest-900 hover:bg-forest-800 text-warm-white font-medium text-base transition-all duration-200 shadow-md group">
              <span>Send Safari Enquiry</span>
              <svg class="w-4 h-4 ml-2.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
              </svg>
            </button>
          </div>

        </form>

      </div>

    </div>

  </div>
</section>

<?= $this->endSection() ?>
