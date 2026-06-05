<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'Immo Vision 17 — Consultant Immobilier Charente-Maritime | Prestige & Excellence';
$pageDesc  = 'Expert immobilier d\'exception en Charente-Maritime. Visite virtuelle 360°, drone 4K, photos professionnelles. Saintes · Royan · Rochefort. Estimation gratuite.';

$stmt    = $pdo->query('SELECT * FROM properties WHERE is_featured = 1 ORDER BY created_at DESC LIMIT 3');
$featured = $stmt->fetchAll();

include 'includes/header.php';
?>

<!-- ═══════════════════ HERO ═══════════════════ -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">

  <!-- Fond animé -->
  <div class="absolute inset-0" style="background: radial-gradient(ellipse 80% 60% at 50% -20%, rgba(212,175,55,.12) 0%, transparent 60%), radial-gradient(ellipse 60% 80% at 100% 100%, rgba(212,175,55,.06) 0%, transparent 50%), #090A0F;"></div>

  <!-- Orbes dorées flottantes -->
  <div class="absolute top-1/4 left-1/6 w-96 h-96 rounded-full opacity-[0.06]" style="background: radial-gradient(circle, #FFD740, transparent 70%); animation: orb 12s ease-in-out infinite;"></div>
  <div class="absolute bottom-1/4 right-1/6 w-80 h-80 rounded-full opacity-[0.05]" style="background: radial-gradient(circle, #D4AF37, transparent 70%); animation: orb 16s 4s ease-in-out infinite reverse;"></div>
  <div class="absolute top-1/2 left-1/2 w-[600px] h-[600px] -translate-x-1/2 -translate-y-1/2 rounded-full opacity-[0.03]" style="background: radial-gradient(circle, #C9A227, transparent 70%); animation: orb 20s 8s ease-in-out infinite;"></div>

  <!-- Grille décorative -->
  <div class="absolute inset-0 opacity-[0.025]" style="background-image: linear-gradient(rgba(212,175,55,.5) 1px, transparent 1px), linear-gradient(90deg, rgba(212,175,55,.5) 1px, transparent 1px); background-size: 60px 60px;"></div>

  <!-- Particules -->
  <?php for ($i = 0; $i < 20; $i++): $size = rand(1,3); ?>
  <div class="absolute rounded-full" style="width:<?= $size ?>px;height:<?= $size ?>px;background:rgba(212,175,55,<?= rand(15,40)/100 ?>);left:<?= rand(5,95) ?>%;top:<?= rand(5,95) ?>%;animation:float <?= rand(5,10) ?>s <?= rand(0,5) ?>s ease-in-out infinite;"></div>
  <?php endfor; ?>

  <div class="relative z-10 max-w-6xl mx-auto px-5 text-center py-32">

    <!-- Badge -->
    <div class="fade-up inline-flex items-center gap-2.5 glass-gold rounded-full px-5 py-2.5 mb-10 border-yellow-700/20">
      <span class="w-1.5 h-1.5 rounded-full bg-yellow-400" style="animation: pulse 2s ease-in-out infinite;"></span>
      <span class="text-yellow-300 text-sm font-medium tracking-wide">Consultant immobilier · Charente-Maritime (17)</span>
    </div>

    <!-- Titre principal -->
    <h1 class="display-serif fade-up-2 text-5xl sm:text-6xl md:text-7xl lg:text-[82px] font-bold text-white leading-[1.08] mb-8 tracking-tight">
      Votre bien mérite<br>
      <em class="not-italic text-gradient" style="font-style:italic">une vision d'exception</em>
    </h1>

    <!-- Sous-titre -->
    <p class="fade-up-3 text-lg md:text-xl text-gray-400 mb-12 max-w-2xl mx-auto leading-relaxed font-light">
      Visite virtuelle 360°, drone 4K, photos architecturales.<br class="hidden md:block">
      Vendez plus vite, au meilleur prix, avec la méthode Immo Vision 17.
    </p>

    <!-- CTAs -->
    <div class="fade-up-4 flex flex-col sm:flex-row items-center justify-center gap-4">
      <a href="/estimation" class="btn-gold text-base px-9 py-4 text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 19h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        Estimation gratuite
      </a>
      <a href="/biens" class="btn-outline text-base px-9 py-4 text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        Découvrir nos biens
      </a>
    </div>

    <!-- Badges premium -->
    <div class="mt-16 flex flex-wrap items-center justify-center gap-3" style="animation: fadeUp .7s .8s ease-out both;">
      <?php foreach (['📹 Drone 4K', '🌐 Visite 360°', '📷 Photos Pro', '🏠 Home Staging VR', '📊 +80 portails', '⭐ 98% satisfaction'] as $tag): ?>
      <span class="glass px-4 py-1.5 rounded-full text-xs font-medium text-gray-400 border-white/6"><?= $tag ?></span>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Scroll indicator -->
  <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 float-anim">
    <span class="text-gray-600 text-[10px] tracking-widest uppercase">Découvrir</span>
    <div class="w-5 h-8 rounded-full border border-white/15 flex items-start justify-center pt-1.5">
      <div class="w-1 h-2 rounded-full bg-yellow-500/60" style="animation: float 1.5s ease-in-out infinite;"></div>
    </div>
  </div>
</section>

<!-- ═══════════════════ STATS ═══════════════════ -->
<section class="py-20 relative overflow-hidden" style="background: #13141C;">
  <div class="absolute inset-0 opacity-40" style="background: linear-gradient(90deg, transparent, rgba(212,175,55,.04), transparent);"></div>
  <div class="max-w-6xl mx-auto px-5">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
      <?php foreach ([
        ['250+', 'Biens vendus', 'en Charente-Maritime', '🏆'],
        ['98%',  'Clients satisfaits', 'taux de recommandation', '⭐'],
        ['45j',  'Délai moyen', 'contre 90j en moyenne', '⚡'],
        ['15ans','D\'expérience', 'expert immobilier local', '🎯'],
      ] as [$val, $label, $sub, $icon]): ?>
      <div class="text-center group">
        <div class="text-2xl mb-3"><?= $icon ?></div>
        <div class="display-serif text-4xl md:text-5xl font-bold text-gradient mb-2 group-hover:scale-105 transition-transform"><?= $val ?></div>
        <div class="text-white font-semibold text-sm mb-1"><?= $label ?></div>
        <div class="text-gray-600 text-xs"><?= $sub ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══════════════════ BIENS EN VEDETTE ═══════════════════ -->
<?php if (!empty($featured)): ?>
<section class="py-28" style="background: #090A0F;">
  <div class="max-w-7xl mx-auto px-5">
    <div class="flex items-end justify-between mb-14">
      <div>
        <p class="section-tag mb-3">Sélection premium</p>
        <h2 class="display-serif text-4xl md:text-5xl font-bold text-white">
          Biens <span class="text-gradient">d'exception</span>
        </h2>
      </div>
      <a href="/biens" class="btn-outline hidden md:flex text-sm">Voir tout →</a>
    </div>

    <div class="grid md:grid-cols-3 gap-7">
      <?php foreach ($featured as $i => $p): ?>
      <a href="/bien/<?= htmlspecialchars($p['slug']) ?>" class="property-card group" style="animation: fadeUp .6s <?= $i * .15 ?>s ease-out both;">
        <div class="relative overflow-hidden" style="height: 240px;">
          <img src="<?= htmlspecialchars($p['image_url']) ?>" alt="<?= htmlspecialchars($p['title']) ?>"
               class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-108" style="transition: transform .7s cubic-bezier(.25,.46,.45,.94);" loading="lazy">
          <div class="absolute inset-0" style="background: linear-gradient(180deg, transparent 40%, rgba(9,10,15,.8) 100%);"></div>
          <div class="absolute top-4 left-4 flex gap-2">
            <?php if ($p['is_drone']): ?><span class="glass text-white text-[10px] font-semibold px-2.5 py-1 rounded-full border-yellow-800/30">🎬 Drone 4K</span><?php endif; ?>
            <?php if ($p['virtual_tour_url']): ?><span class="glass text-white text-[10px] font-semibold px-2.5 py-1 rounded-full border-yellow-800/30">🌐 360°</span><?php endif; ?>
          </div>
          <?php if ($p['dpe_score']): ?><span class="absolute top-4 right-4 text-[10px] font-bold px-2 py-1 rounded dpe-<?= strtolower($p['dpe_score']) ?>">DPE <?= $p['dpe_score'] ?></span><?php endif; ?>
          <?php if ($p['status'] === 'under_offer'): ?>
          <div class="absolute inset-0 flex items-center justify-center" style="background: rgba(0,0,0,.45);">
            <span class="bg-yellow-500 text-black text-xs font-black px-4 py-2 rounded-full" style="transform: rotate(-8deg);">Sous compromis</span>
          </div>
          <?php endif; ?>
        </div>

        <div class="p-6">
          <h3 class="text-white font-semibold mb-1.5 group-hover:text-yellow-400 transition-colors line-clamp-1 text-[15px]">
            <?= htmlspecialchars($p['title']) ?>
          </h3>
          <p class="text-gray-500 text-xs mb-4 flex items-center gap-1">
            <svg class="w-3 h-3 text-yellow-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
            <?= htmlspecialchars($p['city']) ?>, <?= htmlspecialchars($p['postal_code']) ?>
          </p>
          <div class="flex items-center gap-5 text-gray-500 text-xs mb-5">
            <span class="flex items-center gap-1.5">📐 <?= formatSurface($p['surface']) ?></span>
            <?php if ($p['bedrooms']): ?><span class="flex items-center gap-1.5">🛏 <?= $p['bedrooms'] ?> ch.</span><?php endif; ?>
            <?php if ($p['bathrooms']): ?><span class="flex items-center gap-1.5">🚿 <?= $p['bathrooms'] ?></span><?php endif; ?>
          </div>
          <div class="flex items-center justify-between pt-4 border-t border-white/5">
            <span class="display-serif text-xl font-bold text-gradient"><?= formatPrice($p['price']) ?></span>
            <span class="text-yellow-500 text-xs font-medium group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">Voir →</span>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
    <div class="text-center mt-10 md:hidden">
      <a href="/biens" class="btn-outline text-sm">Voir toutes nos annonces →</a>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ═══════════════════ SERVICES ═══════════════════ -->
<section class="py-28 relative" style="background: #13141C;">
  <div class="absolute inset-0" style="background: radial-gradient(ellipse 50% 40% at 50% 0%, rgba(212,175,55,.04) 0%, transparent 100%);"></div>
  <div class="max-w-7xl mx-auto px-5 relative z-10">
    <div class="text-center mb-20">
      <p class="section-tag mb-4">Nos services</p>
      <h2 class="display-serif text-4xl md:text-5xl font-bold text-white mb-5">
        Tout inclus, <span class="text-gradient">zéro surprise</span>
      </h2>
      <p class="text-gray-500 max-w-xl mx-auto text-sm leading-relaxed">Chaque mandat bénéficie de l'ensemble de nos services premium sans frais supplémentaires.</p>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <?php foreach ([
        ['📷', 'Photos Professionnelles', 'Reportage HDR par un photographe immobilier certifié.'],
        ['🎬', 'Vidéo Drone 4K',          'Survol aérien pour une mise en valeur spectaculaire.'],
        ['🌐', 'Visite Virtuelle 360°',   'Explorez chaque pièce depuis n\'importe où dans le monde.'],
        ['🏠', 'Home Staging Virtuel',    'Visualisez le potentiel de votre bien avec décoration simulée.'],
        ['📊', 'Diffusion +80 portails',  'Publication maximale sur tous les portails nationaux et locaux.'],
        ['📈', 'Estimation Précise',      'Analyse de marché basée sur les transactions les plus récentes.'],
        ['⚖️', 'Accompagnement Juridique','Du compromis à l\'acte avec votre notaire partenaire.'],
        ['⭐', 'Conseiller Dédié',        'Un seul interlocuteur disponible 7j/7 du début à la fin.'],
      ] as [$icon, $title, $desc]): ?>
      <div class="glass rounded-2xl p-6 border-transparent hover:border-yellow-800/30 transition-all duration-300 hover:-translate-y-1 hover:shadow-gold group" style="animation: borderGlow 3s ease-in-out infinite;">
        <div class="text-3xl mb-4"><?= $icon ?></div>
        <h3 class="text-white font-semibold text-[13px] mb-2 group-hover:text-yellow-400 transition-colors"><?= $title ?></h3>
        <p class="text-gray-600 text-xs leading-relaxed"><?= $desc ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Tarif -->
    <div class="mt-20 max-w-sm mx-auto">
      <div class="glass-gold rounded-3xl p-10 text-center shadow-gold-lg relative overflow-hidden">
        <div class="absolute inset-0 opacity-5" style="background: linear-gradient(135deg, #FFD740, transparent 50%);"></div>
        <div class="display-serif text-6xl font-black text-gradient mb-2 relative">3.5%</div>
        <div class="text-white font-semibold mb-1 relative">Honoraires tout inclus</div>
        <div class="text-gray-500 text-xs relative">TVA incluse · Aucun frais caché</div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════ PROMESSE ═══════════════════ -->
<section class="py-28" style="background: #090A0F;">
  <div class="max-w-6xl mx-auto px-5">
    <div class="grid lg:grid-cols-2 gap-16 items-center">
      <div>
        <p class="section-tag mb-4">Notre promesse</p>
        <h2 class="display-serif text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
          La méthode qui fait<br><span class="text-gradient">la différence</span>
        </h2>
        <p class="text-gray-500 mb-10 text-sm leading-loose">
          Avec Immo Vision 17, votre bien bénéficie d'une exposition maximale et d'une mise en valeur premium dès la signature du mandat. Notre méthode a permis à 250+ propriétaires de vendre au meilleur prix en Charente-Maritime.
        </p>
        <ul class="space-y-4 mb-10">
          <?php foreach ([
            'Visite virtuelle 360° incluse', 'Reportage photos professionnel', 'Vidéo drone 4K',
            'Diffusion sur +80 portails', 'Estimation gratuite et précise', 'Accompagnement juridique complet',
            'Suivi personnalisé jusqu\'à l\'acte', 'Négociation optimisée pour vous',
          ] as $item): ?>
          <li class="flex items-center gap-3 text-sm text-gray-300">
            <div class="w-5 h-5 rounded-full bg-yellow-900/40 flex items-center justify-center flex-shrink-0">
              <svg class="w-3 h-3 text-yellow-400" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            <?= $item ?>
          </li>
          <?php endforeach; ?>
        </ul>
        <a href="/contact" class="btn-gold text-sm">Prendre rendez-vous →</a>
      </div>

      <div class="relative">
        <div class="absolute -inset-4 rounded-3xl opacity-20" style="background: linear-gradient(135deg, rgba(212,175,55,.3), transparent); filter: blur(20px);"></div>
        <div class="glass-gold rounded-3xl p-10 relative">
          <div class="text-center mb-8">
            <div class="display-serif text-5xl font-black text-gradient mb-1">3.5%</div>
            <div class="text-white font-semibold text-sm">Honoraires tout inclus</div>
            <div class="text-gray-600 text-xs mt-0.5">TVA incluse · Aucun frais caché</div>
          </div>
          <ul class="space-y-2.5">
            <?php foreach (['Visite virtuelle 360°','Drone 4K','Photos professionnelles','Home staging virtuel','Diffusion +80 portails','Estimation gratuite','Accompagnement juridique','Conseiller dédié 7j/7'] as $s): ?>
            <li class="flex items-center gap-2.5 text-xs text-gray-400">
              <svg class="w-3.5 h-3.5 text-yellow-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
              <?= $s ?>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════ TÉMOIGNAGES ═══════════════════ -->
<section class="py-28 relative overflow-hidden" style="background: #13141C;">
  <div class="absolute inset-0 opacity-30" style="background: radial-gradient(ellipse 60% 60% at 50% 50%, rgba(212,175,55,.05), transparent);"></div>
  <div class="max-w-4xl mx-auto px-5 relative z-10">
    <div class="text-center mb-16">
      <p class="section-tag mb-4">Témoignages</p>
      <h2 class="display-serif text-4xl md:text-5xl font-bold text-white">Ils nous font <span class="text-gradient">confiance</span></h2>
    </div>

    <div x-data="{
      current: 0,
      items: [
        {name:'Marie & Thomas L.', loc:'Saintes', type:'Vendeurs', text:'Service exceptionnel. La visite virtuelle a permis à nos acheteurs de tomber amoureux du bien avant même de le visiter. Vendu en 3 semaines au prix demandé !'},
        {name:'Claire B.', loc:'Royan', type:'Acheteuse', text:'J\'ai trouvé ma maison de rêve grâce à Immo Vision 17. L\'accompagnement a été irréprochable du premier appel jusqu\'à la remise des clés.'},
        {name:'Jean-Pierre M.', loc:'Rochefort', type:'Vendeur', text:'Plus de 40 demandes de visites en une semaine. Les photos et la vidéo drone ont sublimé mon appartement. Un résultat bien au-delà de mes espérances.'},
        {name:'Sophie & Marc D.', loc:'Saint-Jean-d\'Angély', type:'Vendeurs', text:'Estimation très précise. Vendu 8% au-dessus du prix initial grâce au home staging virtuel et à la diffusion premium. Merci !'}
      ]
    }" x-init="setInterval(() => current = (current + 1) % items.length, 5500)">

      <div class="relative glass-gold rounded-3xl p-10 md:p-14 overflow-hidden shadow-gold">
        <div class="absolute top-6 left-10 text-yellow-800/30 display-serif" style="font-size: 8rem; line-height: 1;">&ldquo;</div>
        <template x-for="(item, i) in items" :key="i">
          <div x-show="current === i"
               x-transition:enter="transition ease-out duration-400"
               x-transition:enter-start="opacity-0 translate-x-6"
               x-transition:enter-end="opacity-100 translate-x-0"
               x-transition:leave="transition ease-in duration-200"
               x-transition:leave-end="opacity-0 -translate-x-6"
               class="relative z-10">
            <div class="flex gap-1 mb-8 justify-center">
              <?php for ($i=0;$i<5;$i++): ?><span class="text-yellow-400 text-lg">★</span><?php endfor; ?>
            </div>
            <blockquote class="display-serif text-xl md:text-2xl text-white/90 italic leading-relaxed text-center mb-10" x-text="'« ' + item.text + ' »'"></blockquote>
            <div class="text-center">
              <div class="text-white font-semibold text-sm" x-text="item.name"></div>
              <div class="text-gray-500 text-xs mt-1"><span x-text="item.loc"></span> · <span class="text-yellow-500" x-text="item.type"></span></div>
            </div>
          </div>
        </template>
      </div>

      <div class="flex justify-center gap-2.5 mt-8">
        <template x-for="(_, i) in items" :key="i">
          <button @click="current = i" :class="current === i ? 'bg-yellow-400 w-7' : 'bg-white/10 w-2.5'" class="h-2.5 rounded-full transition-all duration-300"></button>
        </template>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════ VILLES SEO ═══════════════════ -->
<section class="py-28" style="background: #090A0F;">
  <div class="max-w-7xl mx-auto px-5">
    <div class="text-center mb-16">
      <p class="section-tag mb-4">Nos secteurs</p>
      <h2 class="display-serif text-4xl md:text-5xl font-bold text-white">
        Immobilier en <span class="text-gradient">Charente-Maritime</span>
      </h2>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      <?php foreach ($SEO_CITIES as $city): ?>
      <a href="/immobilier-<?= $city['slug'] ?>" class="glass rounded-2xl p-6 text-center border-transparent hover:border-yellow-800/30 transition-all duration-300 hover:-translate-y-1 group">
        <div class="w-10 h-10 rounded-full bg-yellow-900/30 flex items-center justify-center mx-auto mb-4">
          <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
        </div>
        <h3 class="text-white font-semibold text-sm mb-2 group-hover:text-yellow-400 transition-colors"><?= htmlspecialchars($city['name']) ?></h3>
        <div class="text-gray-600 text-xs mb-1"><?= $city['properties'] ?> biens</div>
        <div class="text-yellow-600 text-xs font-medium"><?= $city['avg_price'] ?> €/m²</div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══════════════════ CTA FINAL ═══════════════════ -->
<section class="py-28 relative overflow-hidden" style="background: #13141C;">
  <div class="absolute inset-0" style="background: radial-gradient(ellipse 70% 70% at 50% 50%, rgba(212,175,55,.07), transparent);"></div>
  <div class="absolute inset-0" style="background: radial-gradient(ellipse 40% 40% at 50% 50%, rgba(212,175,55,.04), transparent);"></div>

  <div class="relative z-10 max-w-4xl mx-auto px-5 text-center">
    <p class="section-tag mb-6">Passons à l'action</p>
    <h2 class="display-serif text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
      Prêt à vendre votre bien<br>
      <span class="text-gradient">au meilleur prix ?</span>
    </h2>
    <p class="text-gray-500 text-lg mb-12 max-w-xl mx-auto font-light">
      Obtenez votre estimation gratuite et découvrez comment notre méthode premium peut transformer votre projet.
    </p>
    <div class="flex flex-col sm:flex-row items-center justify-center gap-5">
      <a href="/estimation" class="btn-gold text-sm px-10 py-4 shadow-gold">
        ✨ Estimation gratuite
      </a>
      <a href="tel:<?= AGENT_PHONE ?>" class="btn-outline text-sm px-10 py-4">
        📞 <?= AGENT_PHONE ?>
      </a>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
