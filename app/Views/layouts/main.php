<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($metaTitle ?? 'Kanha Kisli Holiday — Discover the Wild') ?></title>
  <meta name="description" content="<?= esc($metaDescription ?? 'Memorable safaris and peaceful stays in the heart of Kanha National Park, Madhya Pradesh.') ?>">
  <link rel="canonical" href="<?= current_url() ?>">

  <!-- Open Graph / Meta -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= current_url() ?>">
  <meta property="og:title" content="<?= esc($metaTitle ?? 'Kanha Kisli Holiday') ?>">
  <meta property="og:description" content="<?= esc($metaDescription ?? 'Wildlife safaris and peaceful stays in Kanha National Park.') ?>">
  <meta property="og:image" content="<?= base_url('assets/images/hero-safari-trail.jpg') ?>">

  <!-- Google Fonts Preconnect & Stylesheet -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo.png') ?>">

  <!-- Production Tailwind Stylesheet -->
  <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body class="bg-warm-white text-body antialiased flex flex-col min-h-screen">
  
  <!-- Accessibility: Skip to Content -->
  <a href="#main-content" 
     class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-forest-900 focus:text-warm-white focus:rounded-md shadow-lg">
    Skip to main content
  </a>

  <!-- Global Header Partial -->
  <?= $this->include('partials/header') ?>

  <!-- Global Mobile Navigation Drawer -->
  <?= $this->include('partials/mobile-menu') ?>

  <!-- Global Flash Messages Notification -->
  <?php if (session()->getFlashdata('success')): ?>
    <div class="fixed top-24 right-5 z-50 max-w-md bg-forest-900 text-ivory border border-forest-700/80 px-5 py-4 rounded-xl shadow-xl flex items-start space-x-3 animate-fade-in">
      <svg class="w-6 h-6 text-sage flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <div class="text-sm">
        <p class="font-medium text-warm-white"><?= session()->getFlashdata('success') ?></p>
      </div>
      <button type="button" onclick="this.parentElement.remove()" class="text-stone hover:text-warm-white ml-auto">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
  <?php endif; ?>

  <!-- Main Content Area -->
  <main id="main-content" class="flex-grow">
    <?= $this->renderSection('content') ?>
  </main>

  <!-- Global Footer Partial -->
  <?= $this->include('partials/footer') ?>

  <!-- Global Mobile Fixed Call & WhatsApp Bottom CTA -->
  <?= $this->include('partials/mobile-cta') ?>

  <!-- Main Client-Side JS -->
  <script src="<?= base_url('assets/js/main.js') ?>" defer></script>
</body>
</html>
