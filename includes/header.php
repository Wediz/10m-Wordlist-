<?php require_once __DIR__ . '/../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($pageTitle ?? SITE_NAME) ?></title>
<meta name="description" content="<?= htmlspecialchars($pageDesc ?? 'Consultant immobilier d\'exception en Charente-Maritime. Visite virtuelle 360°, drone 4K, estimation gratuite.') ?>">
<link rel="canonical" href="<?= SITE_URL . strtok($_SERVER['REQUEST_URI'] ?? '/', '?') ?>">
<meta property="og:title" content="<?= htmlspecialchars($pageTitle ?? SITE_NAME) ?>">
<meta property="og:type" content="website">
<meta property="og:image" content="https://images.unsplash.com/photo-1613977257363-707ba9348227?w=1200">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  theme: {
    extend: {
      colors: {
        gold: { 100:'#FFF8DC', 200:'#FFE97A', 300:'#FFD740', 400:'#F0C040', 500:'#D4AF37', 600:'#B8960C', 700:'#9A7B0A', 800:'#6B5507', 900:'#3D3004' },
        dark: { 800:'#1E202A', 900:'#13141C', 950:'#090A0F' }
      },
      fontFamily: {
        serif: ['"Playfair Display"', 'Georgia', 'serif'],
        sans:  ['Inter', 'system-ui', 'sans-serif'],
      }
    }
  }
}
</script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body { background: #090A0F; color: #E2E4EC; font-family: 'Inter', sans-serif; min-height: 100vh; -webkit-font-smoothing: antialiased; }

/* ── Design system ── */
:root {
  --gold: #D4AF37;
  --gold-light: #FFD740;
  --gold-dark: #9A7B0A;
  --dark: #090A0F;
  --dark-2: #13141C;
  --dark-3: #1E202A;
  --glass-bg: rgba(255,255,255,0.04);
  --glass-border: rgba(255,255,255,0.07);
  --gold-glow: rgba(212,175,55,0.18);
}

/* ── Glass panels ── */
.glass {
  background: var(--glass-bg);
  backdrop-filter: blur(20px) saturate(180%);
  -webkit-backdrop-filter: blur(20px) saturate(180%);
  border: 1px solid var(--glass-border);
}
.glass-gold {
  background: rgba(212,175,55,0.05);
  backdrop-filter: blur(20px) saturate(180%);
  -webkit-backdrop-filter: blur(20px) saturate(180%);
  border: 1px solid rgba(212,175,55,0.18);
}
.glass-dark {
  background: rgba(9,10,15,0.88);
  backdrop-filter: blur(24px) saturate(200%);
  -webkit-backdrop-filter: blur(24px) saturate(200%);
  border: 1px solid rgba(255,255,255,0.06);
}

/* ── Typography ── */
.display-serif { font-family: 'Playfair Display', Georgia, serif; }
.text-gold { color: #D4AF37; }
.text-gradient {
  background: linear-gradient(135deg, #C9A227 0%, #FFD740 45%, #E8C050 70%, #A07820 100%);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent;
  background-clip: text;
}
.text-gradient-subtle {
  background: linear-gradient(135deg, #D4AF37 0%, #F0D060 100%);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* ── Buttons ── */
.btn-gold {
  position: relative; overflow: hidden;
  background: linear-gradient(135deg, #C9A227, #FFD740, #C9A227);
  background-size: 200% auto;
  color: #090A0F; font-weight: 700; font-size: .875rem; letter-spacing: .03em;
  padding: .8rem 1.75rem; border-radius: .75rem;
  display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
  transition: background-position .4s ease, transform .2s ease, box-shadow .2s ease;
  text-decoration: none; cursor: pointer; border: none;
}
.btn-gold:hover {
  background-position: right center;
  transform: translateY(-2px);
  box-shadow: 0 12px 35px rgba(212,175,55,.4), 0 4px 12px rgba(212,175,55,.2);
}
.btn-outline {
  background: transparent; color: #D4AF37; font-weight: 600; font-size: .875rem;
  padding: .8rem 1.75rem; border-radius: .75rem; letter-spacing: .02em;
  border: 1px solid rgba(212,175,55,.35);
  display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
  transition: all .25s ease; text-decoration: none; cursor: pointer;
}
.btn-outline:hover { background: rgba(212,175,55,.08); border-color: rgba(212,175,55,.7); transform: translateY(-1px); }

/* ── Inputs ── */
.input-field {
  background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.09);
  border-radius: .75rem; padding: .8rem 1rem; color: #fff; width: 100%;
  outline: none; transition: all .2s ease; font-size: .875rem; font-family: inherit;
}
.input-field:focus { border-color: rgba(212,175,55,.45); background: rgba(255,255,255,.06); }
.input-field::placeholder { color: #4B5563; }
select.input-field option { background: #13141C; color: #e2e4ec; }

/* ── Cards ── */
.property-card {
  background: rgba(255,255,255,.035);
  border: 1px solid rgba(255,255,255,.07);
  border-radius: 1.25rem; overflow: hidden;
  transition: transform .35s cubic-bezier(.25,.46,.45,.94), box-shadow .35s ease, border-color .35s ease;
  text-decoration: none; display: block; color: inherit;
}
.property-card:hover {
  transform: translateY(-6px);
  border-color: rgba(212,175,55,.28);
  box-shadow: 0 24px 60px rgba(0,0,0,.5), 0 0 30px rgba(212,175,55,.07);
}

/* ── Section label ── */
.section-tag {
  color: #D4AF37; font-size: .7rem; font-weight: 700;
  letter-spacing: .18em; text-transform: uppercase;
}

/* ── DPE badges ── */
.dpe-a { background: #1a9641; color: #fff; }
.dpe-b { background: #52b96e; color: #fff; }
.dpe-c { background: #a8d08d; color: #1a1b22; }
.dpe-d { background: #e8e800; color: #1a1b22; }
.dpe-e { background: #ffaa00; color: #1a1b22; }
.dpe-f { background: #ff5500; color: #fff; }
.dpe-g { background: #cc0000; color: #fff; }

/* ── Shadows ── */
.shadow-gold { box-shadow: 0 0 40px rgba(212,175,55,.14); }
.shadow-gold-lg { box-shadow: 0 0 80px rgba(212,175,55,.18), 0 0 160px rgba(212,175,55,.06); }

/* ── Animations ── */
@keyframes fadeUp { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: translateY(0); } }
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes float  { 0%,100% { transform: translateY(0px); } 50% { transform: translateY(-12px); } }
@keyframes orb    { 0%,100% { transform: scale(1) translate(0,0); } 33% { transform: scale(1.08) translate(20px,-15px); } 66% { transform: scale(.94) translate(-15px,10px); } }
@keyframes shimmer { 0% { background-position: -200% center; } 100% { background-position: 200% center; } }
@keyframes gradientShift { 0%,100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }
@keyframes borderGlow { 0%,100% { border-color: rgba(212,175,55,.15); } 50% { border-color: rgba(212,175,55,.4); } }
@keyframes pulse { 0%,100% { opacity: 1; } 50% { opacity: .4; } }

.fade-up   { animation: fadeUp .7s ease-out forwards; }
.fade-up-2 { animation: fadeUp .7s .18s ease-out both; }
.fade-up-3 { animation: fadeUp .7s .36s ease-out both; }
.fade-up-4 { animation: fadeUp .7s .54s ease-out both; }
.float-anim { animation: float 6s ease-in-out infinite; }

/* ── Scrollbar ── */
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: #090A0F; }
::-webkit-scrollbar-thumb { background: #3D3004; border-radius: 5px; }

/* ── Line clamp ── */
.line-clamp-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
.line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
</style>
</head>
<body>

<!-- ═══════════════════════════════ NAVBAR ═══════════════════════════════ -->
<header x-data="{ scrolled: false, open: false }"
        @scroll.window="scrolled = window.scrollY > 30"
        :class="scrolled ? 'glass-dark shadow-gold border-b border-yellow-900/20' : 'bg-transparent'"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-500">

  <nav class="max-w-7xl mx-auto px-5 h-[72px] flex items-center justify-between gap-6">

    <!-- Logo -->
    <a href="/" class="flex items-center gap-3 group flex-shrink-0">
      <div class="relative w-10 h-10">
        <div class="absolute inset-0 rounded-full bg-gradient-to-br from-yellow-300 to-yellow-600 blur-sm opacity-60 group-hover:opacity-90 transition-opacity"></div>
        <div class="relative w-10 h-10 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center shadow-gold">
          <span class="text-black font-bold text-sm tracking-tight">IV</span>
        </div>
      </div>
      <div>
        <div class="text-white font-semibold text-base leading-tight tracking-tight group-hover:text-yellow-300 transition-colors">Immo Vision 17</div>
        <div class="text-yellow-600 text-[10px] tracking-widest uppercase">Charente-Maritime</div>
      </div>
    </a>

    <!-- Desktop links -->
    <div class="hidden lg:flex items-center gap-0.5">
      <?php
        $current = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
        $navLinks = ['/' => 'Accueil', '/biens' => 'Annonces', '/estimation' => 'Estimation', '/blog' => 'Blog', '/contact' => 'Contact'];
        foreach ($navLinks as $href => $label):
          $active = ($href === '/' ? $current === '/' : str_starts_with($current, $href));
      ?>
      <a href="<?= $href ?>" class="relative px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 <?= $active ? 'text-yellow-400' : 'text-gray-400 hover:text-white' ?>">
        <?= $label ?>
        <?php if ($active): ?>
        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full bg-yellow-400"></span>
        <?php endif; ?>
      </a>
      <?php endforeach; ?>
    </div>

    <!-- CTA desktop -->
    <div class="hidden lg:flex items-center gap-4 flex-shrink-0">
      <a href="tel:<?= AGENT_PHONE ?>" class="text-sm font-medium text-yellow-500 hover:text-yellow-300 transition-colors flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
        <?= AGENT_PHONE ?>
      </a>
      <a href="/estimation" class="btn-gold text-sm px-5 py-2.5">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        Estimation gratuite
      </a>
    </div>

    <!-- Burger -->
    <button @click="open = !open" class="lg:hidden p-2 text-white" aria-label="Menu">
      <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
      <svg x-show="open"  class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
  </nav>

  <!-- Mobile menu -->
  <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
       class="lg:hidden glass-dark border-t border-white/5 px-5 py-6 space-y-1">
    <?php foreach ($navLinks as $href => $label): ?>
    <a href="<?= $href ?>" class="block px-4 py-3 text-gray-300 hover:text-yellow-400 font-medium rounded-xl hover:bg-white/4 transition-all"><?= $label ?></a>
    <?php endforeach; ?>
    <div class="pt-4 border-t border-white/8 mt-2">
      <a href="/estimation" class="btn-gold w-full justify-center">Estimation gratuite</a>
    </div>
  </div>
</header>

<main>
