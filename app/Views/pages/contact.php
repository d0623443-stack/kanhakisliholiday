<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- INNER HERO (Breadcrumb Banner) -->
<section class="relative bg-forest-950 text-warm-white flex flex-col justify-start items-center pt-32 sm:pt-40 md:pt-52 lg:pt-56 pb-16 md:pb-24 overflow-hidden">
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
              <h3 class="font-semibold text-ink text-sm sm:text-base">Phone &amp; Mobile Contact</h3>
              <p class="text-body text-sm mt-0.5 space-x-1">
                <?php $primaryPhone = $content['phone_primary'] ?? $settings['helpline_phone'] ?? get_site_setting('helpline_phone'); ?>
                <a href="tel:<?= preg_replace('/\s+/', '', $primaryPhone) ?>" class="hover:text-forest-700 transition-colors font-medium"><?= esc($primaryPhone) ?></a>
                <?php 
                  $secondaryPhone = $content['phone_owner'] ?? $settings['owner_phone'] ?? get_site_setting('owner_phone') ?: ($content['phone_secondary'] ?? '');
                  if (!empty($secondaryPhone)): 
                ?>
                  <span class="text-stone-400">/</span>
                  <a href="tel:<?= preg_replace('/\s+/', '', $secondaryPhone) ?>" class="hover:text-forest-700 transition-colors font-medium"><?= esc($secondaryPhone) ?></a>
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

        <!-- Quick Direct Actions (Call Now & WhatsApp Chat) -->
        <div class="flex flex-wrap gap-3 pt-2">
          <a href="tel:<?= preg_replace('/\s+/', '', $primaryPhone) ?>" 
             class="inline-flex items-center px-6 py-3 rounded-full bg-forest-900 hover:bg-forest-800 text-warm-white text-sm font-semibold transition-all duration-200 shadow-sm group">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            <span>Call Our Desk</span>
          </a>

          <?php $contactWa = $content['whatsapp'] ?? $settings['whatsapp_number'] ?? get_site_setting('whatsapp_number'); ?>
          <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $contactWa) ?>" 
             target="_blank" 
             rel="noopener noreferrer" 
             class="inline-flex items-center px-6 py-3 rounded-full bg-[#25D366] hover:bg-[#1EBE5B] text-white text-sm font-semibold transition-all duration-200 shadow-sm group">
            <svg class="w-4 h-4 mr-2 fill-current" viewBox="0 0 24 24">
              <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>
            <span>WhatsApp Us</span>
          </a>
        </div>

      </div>

      <!-- Right Column: Interactive Google Maps Iframe -->
      <div class="lg:col-span-7 bg-ivory/60 border border-stone/50 rounded-3xl p-6 sm:p-8 shadow-sm flex flex-col justify-between space-y-6">
        
        <div>
          <div class="flex items-center justify-between flex-wrap gap-2 mb-2">
            <span class="text-xs font-semibold tracking-widest-plus uppercase text-forest-700">
              Interactive Location Map
            </span>
            <span class="inline-flex items-center text-xs font-medium text-emerald-800 bg-emerald-100/80 px-3 py-1 rounded-full">
              <span class="w-2 h-2 rounded-full bg-emerald-500 mr-1.5 animate-pulse"></span>
              Live Location
            </span>
          </div>

          <h3 class="font-serif text-2xl sm:text-3xl font-bold text-ink mb-2">
            Find Us at Kanha Tiger Reserve
          </h3>
          <p class="text-body text-sm leading-relaxed">
            Conveniently situated near the Khatia and Kisli entrance gates. Use the interactive map below to explore our exact location and scenic approach routes.
          </p>
        </div>

        <?php 
          $rawEmbed = $content['google_maps_embed'] ?? $settings['google_maps_embed'] ?? get_site_setting('google_maps_embed');
          $mapUrl   = parse_map_embed_url($rawEmbed);
        ?>

        <!-- Google Maps Embed Container -->
        <div class="relative w-full h-[380px] sm:h-[450px] md:h-[490px] rounded-2xl overflow-hidden shadow-inner border border-stone/40 bg-stone/20">
          <?php if (!empty($mapUrl)): ?>
            <iframe 
              src="<?= esc($mapUrl) ?>" 
              width="100%" 
              height="100%" 
              style="border:0;" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade"
              title="Google Maps Location of Kanha Kisli Holiday Resort"
              class="w-full h-full">
            </iframe>
          <?php else: ?>
            <div class="w-full h-full flex flex-col items-center justify-center p-8 text-center text-stone-500 space-y-2">
              <svg class="w-8 h-8 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <p class="text-sm font-medium">Google Maps link is being configured in the admin panel.</p>
            </div>
          <?php endif; ?>
        </div>

        <!-- Directions & Navigation Footer Info -->
        <div class="pt-3 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-t border-stone/30 text-xs text-body">
          <div class="flex items-center space-x-2 text-stone-600">
            <svg class="w-4 h-4 text-forest-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Nearest Safari Gate: <strong>Khatia / Kisli Gate (approx. 5 mins drive)</strong></span>
          </div>

          <a href="https://www.google.com/maps/search/?api=1&query=Kanha+Tiger+Reserve+Khatia+Gate" 
             target="_blank" 
             rel="noopener noreferrer" 
             class="inline-flex items-center font-semibold text-forest-800 hover:text-forest-950 transition-colors group">
            <span>Open in Google Maps App</span>
            <svg class="w-3.5 h-3.5 ml-1.5 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>
          </a>
        </div>

      </div>

    </div>

  </div>
</section>

<?= $this->endSection() ?>
