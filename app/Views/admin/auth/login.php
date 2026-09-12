<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($metaTitle ?? 'Admin Login — Kanha Kisli Holiday') ?></title>
  <meta name="robots" content="noindex, nofollow">

  <!-- Google Fonts Preconnect & Stylesheet -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo.png') ?>">

  <!-- Tailwind Stylesheet -->
  <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
</head>
<body class="h-full font-sans antialiased text-body bg-forest-950 flex items-center justify-center p-4 relative overflow-hidden select-none">

  <!-- Scenic Forest Background with Atmospheric Gradient Overlay -->
  <div class="absolute inset-0 z-0">
    <img src="<?= base_url('assets/images/tiger-kanha-reserve.jpg') ?>" 
         alt="Kanha Forest Sanctuary" 
         class="w-full h-full object-cover object-center filter brightness-50 scale-105 transform animate-pulse duration-10000" />
    <div class="absolute inset-0 bg-gradient-to-t from-forest-950 via-forest-950/85 to-forest-950/90"></div>
  </div>

  <!-- Subtle Botanical Watermark in corner -->
  <div class="absolute -bottom-10 -right-10 w-96 pointer-events-none opacity-10 text-moss mix-blend-multiply">
    <img src="<?= base_url('assets/images/kanha-meadow-wildlife-etching.png') ?>" alt="" class="w-full h-auto" />
  </div>

  <!-- Login Card Container -->
  <div class="relative z-10 w-full max-w-md">
    
    <!-- Top Return to Site Link -->
    <div class="mb-6 text-center">
      <a href="<?= base_url('/') ?>" 
         class="inline-flex items-center space-x-1.5 text-xs text-sage hover:text-warm-white transition-colors">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        <span>Back to Kanha Kisli Website</span>
      </a>
    </div>

    <!-- Main Card -->
    <div class="bg-warm-white/95 backdrop-blur-md rounded-3xl p-7 sm:p-9 border border-stone/50 shadow-2xl space-y-6">
      
      <!-- Brand Header -->
      <div class="text-center space-y-2">
        <div class="w-16 h-16 rounded-full bg-forest-900 border-2 border-[#D4B87C] p-2 mx-auto flex items-center justify-center shadow-lg">
          <img src="<?= base_url('assets/images/logo.png') ?>" alt="Kanha Kisli Logo" class="w-full h-full object-contain">
        </div>
        <div class="pt-1">
          <span class="text-[11px] font-mono font-semibold uppercase tracking-widest-plus text-forest-700">
            Resort Administration
          </span>
          <h1 class="font-serif text-2xl sm:text-3xl font-bold text-ink leading-tight">
            Sign In to Dashboard
          </h1>
        </div>
        <p class="text-xs text-body">
          Manage safari permits, cottage bookings, gallery and site content.
        </p>
      </div>

      <!-- Error / Success Alerts -->
      <?php if (!empty($error)): ?>
        <div class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs flex items-center space-x-2">
          <svg class="w-4 h-4 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <span><?= esc($error) ?></span>
        </div>
      <?php endif; ?>

      <?php if (!empty($success)): ?>
        <div class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center space-x-2">
          <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <span><?= esc($success) ?></span>
        </div>
      <?php endif; ?>

      <!-- Login Form -->
      <form action="<?= base_url('admin/login') ?>" method="POST" class="space-y-4" id="admin-login-form">
        <?= csrf_field() ?>

        <!-- Email Field -->
        <div class="space-y-1.5">
          <label for="email" class="block text-xs font-semibold text-ink">
            Admin Email / Username
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
            </div>
            <input type="text" 
                   name="email" 
                   id="email" 
                   value="<?= old('email', 'admin@kanhakisli.com') ?>" 
                   required 
                   class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-stone/60 bg-white text-ink text-sm placeholder-stone focus:outline-none focus:ring-2 focus:ring-forest-800 focus:border-transparent transition-all" 
                   placeholder="admin@kanhakisli.com">
          </div>
        </div>

        <!-- Password Field -->
        <div class="space-y-1.5">
          <div class="flex items-center justify-between">
            <label for="password" class="block text-xs font-semibold text-ink">
              Password
            </label>
            <span class="text-[11px] text-muted">Demo: admin123</span>
          </div>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <input type="password" 
                   name="password" 
                   id="password" 
                   value="admin123" 
                   required 
                   class="w-full pl-10 pr-10 py-2.5 rounded-xl border border-stone/60 bg-white text-ink text-sm placeholder-stone focus:outline-none focus:ring-2 focus:ring-forest-800 focus:border-transparent transition-all" 
                   placeholder="••••••••">
            <button type="button" 
                    onclick="togglePasswordVisibility()" 
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-stone hover:text-ink cursor-pointer">
              <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            </button>
          </div>
        </div>

        <!-- Remember Me Checkbox -->
        <div class="flex items-center justify-between text-xs pt-1">
          <label class="flex items-center space-x-2 cursor-pointer">
            <input type="checkbox" name="remember" checked class="rounded border-stone text-forest-800 focus:ring-forest-800">
            <span class="text-body">Keep me logged in</span>
          </label>
          <span class="text-forest-800 font-semibold cursor-pointer hover:underline" onclick="fillDemoCredentials()">
            Auto-fill Demo
          </span>
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full py-3 rounded-full bg-forest-900 hover:bg-forest-800 text-warm-white font-semibold text-sm transition-all duration-200 shadow-md hover:shadow-lg hover:-translate-y-0.5 flex items-center justify-center space-x-2 cursor-pointer group">
          <span>Sign In to Portal</span>
          <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>

      </form>

      <!-- Quick Demo Access Helper Badge -->
      <div class="pt-2 border-t border-stone/30 text-center">
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-forest-900/10 text-forest-800 text-[11px] font-mono">
          <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
          <span>Demo Credentials: admin@kanhakisli.com / admin123</span>
        </div>
      </div>

    </div>

    <!-- Security Footer Note -->
    <div class="mt-6 text-center text-stone text-xs">
      &copy; <?= date('Y') ?> Kanha Kisli Holiday &middot; Authorized Wildlife Desk Access Only
    </div>

  </div>

  <script>
    function togglePasswordVisibility() {
      const pwd = document.getElementById('password');
      if (pwd.type === 'password') {
        pwd.type = 'text';
      } else {
        pwd.type = 'password';
      }
    }

    function fillDemoCredentials() {
      document.getElementById('email').value = 'admin@kanhakisli.com';
      document.getElementById('password').value = 'admin123';
    }
  </script>

</body>
</html>
