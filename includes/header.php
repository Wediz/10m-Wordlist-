<?php require_once __DIR__ . '/../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($pageTitle ?? SITE_NAME) ?></title>
<meta name="description" content="<?= htmlspecialchars($pageDesc ?? 'Consultant immobilier indépendant en Charente-Maritime. Visite virtuelle 360°, drone 4K, estimation gratuite.') ?>">
<link rel="canonical" href="<?= SITE_URL . ($_SERVER['REQUEST_URI'] ?? '/') ?>">
<meta property="og:title" content="<?= htmlspecialchars($pageTitle ?? SITE_NAME) ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?= SITE_URL . ($_SERVER['REQUEST_URI'] ?? '/') ?>">

<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        gold: { 300:'#ffe680', 400:'#FFD740', 500:'#D4AF37', 600:'#b8960c', 700:'#9a7b0a', 800:'#3d3004', 900:'#2a2103' },
        dark: { 800:'#2e303a', 900:'#1a1b22', 950:'#0d0e13' }
      }
    }
  }
}
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
*{box-sizing:border-box}
body{background:#0d0e13;color:#e5e7eb;font-family:'Inter',sans-serif;min-height:100vh}

.glass{background:rgba(255,255,255,.04);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);border:1px solid rgba(255,255,255,.08)}
.glass-gold{background:rgba(212,175,55,.06);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);border:1px solid rgba(212,175,55,.2)}
.glass-dark{background:rgba(13,14,19,.8);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,.06)}

.text-gradient{background:linear-gradient(135deg,#D4AF37 0%,#FFD740 50%,#b8960c 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}

.btn-gold{background:linear-gradient(135deg,#D4AF37,#FFD740,#b8960c);color:#0d0e13;font-weight:700;padding:.75rem 1.5rem;border-radius:.75rem;display:inline-flex;align-items:center;justify-content:center;gap:.5rem;transition:all .2s;text-decoration:none;cursor:pointer;border:none;font-size:.875rem;letter-spacing:.01em}
.btn-gold:hover{transform:translateY(-2px);box-shadow:0 10px 30px rgba(212,175,55,.35)}

.btn-outline{background:transparent;color:#D4AF37;font-weight:600;padding:.75rem 1.5rem;border-radius:.75rem;border:1px solid rgba(212,175,55,.4);display:inline-flex;align-items:center;justify-content:center;gap:.5rem;transition:all .2s;text-decoration:none;cursor:pointer;font-size:.875rem}
.btn-outline:hover{background:rgba(212,175,55,.08);border-color:#D4AF37}

.input-field{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:.75rem;padding:.75rem 1rem;color:#fff;width:100%;outline:none;transition:border-color .2s;font-size:.875rem}
.input-field:focus{border-color:rgba(212,175,55,.5);background:rgba(255,255,255,.07)}
.input-field::placeholder{color:#4b5563}
select.input-field option{background:#1a1b22}

.property-card{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:1rem;overflow:hidden;transition:all .3s;text-decoration:none;display:block;color:inherit}
.property-card:hover{transform:translateY(-4px);border-color:rgba(212,175,55,.3);box-shadow:0 20px 40px rgba(0,0,0,.4)}

.shadow-gold{box-shadow:0 0 30px rgba(212,175,55,.15)}
.shadow-gold-lg{box-shadow:0 0 60px rgba(212,175,55,.2)}

.section-tag{color:#D4AF37;font-size:.75rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase}

/* DPE */
.dpe-a{background:#1a9641;color:#fff}
.dpe-b{background:#52b96e;color:#fff}
.dpe-c{background:#a8d08d;color:#1a1b22}
.dpe-d{background:#e8e800;color:#1a1b22}
.dpe-e{background:#ffaa00;color:#1a1b22}
.dpe-f{background:#ff5500;color:#fff}
.dpe-g{background:#cc0000;color:#fff}

/* Animations */
@keyframes fadeUp{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}
.fade-up{animation:fadeUp .7s ease-out forwards}
.fade-up-2{animation:fadeUp .7s .15s ease-out both}
.fade-up-3{animation:fadeUp .7s .3s ease-out both}
.fade-up-4{animation:fadeUp .7s .45s ease-out both}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
.float-anim{animation:float 5s ease-in-out infinite}

/* Scrollbar */
::-webkit-scrollbar{width:6px}
::-webkit-scrollbar-track{background:#0d0e13}
::-webkit-scrollbar-thumb{background:#3d3004;border-radius:3px}
</style>
</head>
<body>

<!-- NAVBAR -->
<header x-data="{scrolled: false, open: false}" @scroll.window="scrolled = window.scrollY > 20"
  :class="scrolled ? 'glass-dark border-b border-yellow-900/30 shadow-gold' : 'bg-transparent'"
  class="fixed top-0 left-0 right-0 z-50 transition-all duration-500">
  <nav class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">

    <!-- Logo -->
    <a href="/" class="flex items-center gap-3 group">
      <div class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center shadow-gold">
        <span class="text-black font-bold text-sm">IV</span>
      </div>
      <div>
        <div class="text-white font-bold text-lg leading-none group-hover:text-yellow-400 transition-colors">Immo Vision 17</div>
        <div class="text-yellow-500 text-xs">Charente-Maritime</div>
      </div>
    </a>

    <!-- Desktop -->
    <div class="hidden lg:flex items-center gap-1">
      <?php
      $nav = [
        '/'                => 'Accueil',
        '/biens'           => 'Nos Biens',
        '/estimation'      => 'Estimation',
        '/blog'            => 'Blog',
        '/contact'         => 'Contact',
      ];
      $current = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
      foreach ($nav as $href => $label):
        $active = ($current === $href || ($href !== '/' && strpos($current, $href) === 0));
      ?>
      <a href="<?= $href ?>" class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 <?= $active ? 'text-yellow-400' : 'text-gray-300 hover:text-white hover:bg-white/5' ?>">
        <?= $label ?>
      </a>
      <?php endforeach; ?>
    </div>

    <!-- CTA desktop -->
    <div class="hidden lg:flex items-center gap-4">
      <a href="tel:<?= AGENT_PHONE ?>" class="text-yellow-400 text-sm font-medium hover:text-yellow-300 transition-colors">
        📞 <?= AGENT_PHONE ?>
      </a>
      <a href="/estimation" class="btn-gold text-sm px-5 py-2">Estimation gratuite</a>
    </div>

    <!-- Burger -->
    <button @click="open = !open" class="lg:hidden text-white p-2" aria-label="Menu">
      <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
      <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
  </nav>

  <!-- Mobile menu -->
  <div x-show="open" x-transition class="lg:hidden glass-dark border-t border-white/10 px-4 py-6 space-y-2">
    <?php foreach ($nav as $href => $label): ?>
    <a href="<?= $href ?>" class="block px-4 py-3 text-gray-300 hover:text-yellow-400 font-medium rounded-lg hover:bg-white/5 transition-colors"><?= $label ?></a>
    <?php endforeach; ?>
    <div class="pt-4 border-t border-white/10">
      <a href="/estimation" class="btn-gold w-full">Estimation gratuite</a>
    </div>
  </div>
</header>

<main>
