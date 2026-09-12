<?php
$callPhone = get_site_setting('helpline_phone', '+91 6267801254');
$waNumber  = get_site_setting('whatsapp_number', '+91 94251 00000');
$waClean   = preg_replace('/[^0-9]/', '', $waNumber);
$telClean  = preg_replace('/\s+/', '', $callPhone);
?>
<!-- Fixed Mobile Bottom CTA Bar (Call & WhatsApp) for Higher Conversion -->
<aside id="mobile-sticky-cta" 
       class="fixed bottom-0 left-0 right-0 z-40 md:hidden pointer-events-none transition-transform duration-300 ease-out"
       aria-label="Quick Mobile Contact Actions">
  
  <div class="pointer-events-auto mx-auto w-full px-3 pb-[calc(env(safe-area-inset-bottom,0px)+0.65rem)] pt-2 bg-gradient-to-t from-forest-950/95 via-forest-950/85 to-transparent backdrop-blur-sm">
    <div class="grid grid-cols-2 gap-2.5 max-w-md mx-auto">
      
      <!-- 1. Direct Call CTA Button -->
      <a href="tel:<?= esc($telClean) ?>" 
         id="mobile-cta-call"
         class="flex items-center justify-center gap-2 px-3.5 py-3 rounded-2xl bg-forest-900/95 hover:bg-forest-800 text-warm-white border border-[#D4B87C]/40 shadow-[0_8px_20px_rgba(0,0,0,0.35)] active:scale-[0.98] transition-all group"
         title="Call Kanha Kisli Contact">
        <span class="w-8 h-8 rounded-xl bg-[#D4B87C]/20 border border-[#D4B87C]/40 flex items-center justify-center text-[#D4B87C] shrink-0 group-hover:scale-105 transition-transform">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
          </svg>
        </span>
        <div class="flex flex-col text-left leading-tight min-w-0">
          <span class="text-[10px] text-[#D4B87C] font-semibold uppercase tracking-wider">Instant Call</span>
          <span class="text-xs sm:text-sm font-bold text-warm-white truncate">Call Now</span>
        </div>
      </a>

      <!-- 2. Direct WhatsApp CTA Button -->
      <a href="https://wa.me/<?= esc($waClean) ?>?text=Hello%20Kanha%20Kisli%20Holiday,%20I%20am%20interested%20in%20safari%20booking%20and%20resort%20stay" 
         target="_blank" 
         rel="noopener noreferrer" 
         id="mobile-cta-whatsapp"
         class="flex items-center justify-center gap-2 px-3.5 py-3 rounded-2xl bg-[#25D366] hover:bg-[#20bd5a] text-white shadow-[0_8px_20px_rgba(37,211,102,0.35)] active:scale-[0.98] transition-all group"
         title="Chat on WhatsApp">
        <span class="w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center text-white shrink-0 group-hover:scale-105 transition-transform">
          <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
          </svg>
        </span>
        <div class="flex flex-col text-left leading-tight min-w-0">
          <span class="text-[10px] text-emerald-100 font-semibold uppercase tracking-wider flex items-center gap-1">
            <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
            Online
          </span>
          <span class="text-xs sm:text-sm font-bold text-white truncate">WhatsApp</span>
        </div>
      </a>

    </div>
  </div>
</aside>
