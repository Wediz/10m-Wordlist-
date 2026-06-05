<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'Immo Vision 17 — Consultant Immobilier Charente-Maritime';
$pageDesc  = 'Consultant immobilier indépendant en Charente-Maritime. Visite virtuelle 360°, drone 4K, estimation gratuite. Saintes, Royan, Rochefort.';

// Biens en vedette
$stmt = $pdo->query('SELECT * FROM properties WHERE is_featured = 1 ORDER BY created_at DESC LIMIT 3');
$featured = $stmt->fetchAll();

include 'includes/header.php';
?>

<!-- ===== HERO ===== -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
  <div class="absolute inset-0" style="background:radial-gradient(ellipse at 50% 40%,rgba(212,175,55,.1) 0%,transparent 65%),linear-gradient(180deg,#0d0e13 0%,#1a1b22 100%)"></div>

  <!-- Particules décoratives -->
  <?php for ($i = 0; $i < 15; $i++): ?>
  <div class="absolute w-1 h-1 rounded-full" style="background:rgba(212,175,55,.25);left:<?= rand(5,95) ?>%;top:<?= rand(10,90) ?>%;animation:float <?= rand(4,8) ?>s <?= $i*.3 ?>s ease-in-out infinite"></div>
  <?php endfor; ?>

  <div class="relative z-10 max-w-6xl mx-auto px-4 text-center">

    <div class="fade-up inline-flex items-center gap-2 glass-gold rounded-full px-5 py-2.5 mb-8">
      <span class="w-2 h-2 bg-yellow-400 rounded-full" style="animation:float 2s ease-in-out infinite"></span>
      <span class="text-yellow-300 text-sm font-medium">Consultant immobilier • Charente-Maritime (17)</span>
    </div>

    <h1 class="fade-up-2 text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
      Votre bien mérite<br>
      <span class="text-gradient">une vision d\'exception</span>
    </h1>

    <p class="fade-up-3 text-xl text-gray-300 mb-12 max-w-2xl mx-auto">
      Visite virtuelle 360°, drone 4K, photos professionnelles.
      Vendez plus vite et au meilleur prix.
    </p>

    <div class="fade-up-4 flex flex-col sm:flex-row items-center justify-center gap-4">
      <a href="/estimation" class="btn-gold text-base px-8 py-4">&#10024; Estimation gratuite</a>
      <a href="/biens" class="btn-outline text-base px-8 py-4">&#127968; Voir nos biens</a>
    </div>

    <!-- Tags -->
    <div class="mt-16 flex flex-wrap items-center justify-center gap-3">
      <?php foreach (['Drone 4K','Visite 360°','Photos Pro','+80 portails','Home Staging VR'] as $tag): ?>
      <span class="glass px-4 py-2 rounded-full text-sm text-gray-300 border border-white/10"><?= $tag ?></span>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-yellow-400/50 text-2xl float-anim">▼</div>
</section>

<!-- ===== STATS ===== -->
<section class="py-20 border-y border-yellow-900/20" style="background:#1a1b22">
  <div class="max-w-6xl mx-auto px-4">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
      <?php foreach ([
        ['250+','Biens vendus','en Charente-Maritime'],
        ['98%','Clients satisfaits','taux de satisfaction'],
        ['45j','Délai moyen','contre 90j en moyenne'],
        ['15ans','D\'expérience','dans l\'immobilier local'],
      ] as [$val,$label,$sub]): ?>
      <div>
        <div class="text-4xl md:text-5xl font-bold text-gradient mb-2"><?= $val ?></div>
        <div class="text-white font-semibold mb-1"><?= $label ?></div>
        <div class="text-gray-500 text-sm"><?= $sub ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===== BIENS EN VEDETTE ===== -->
<?php if (!empty($featured)): ?>
<section class="py-24" style="background:#0d0e13">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex items-end justify-between mb-12">
      <div>
        <p class="section-tag">Sélection premium</p>
        <h2 class="text-4xl font-bold text-white mt-3">
          Biens <span class="text-gradient">d\'exception</span>
        </h2>
      </div>
      <a href="/biens" class="btn-outline hidden md:flex">Voir tout &#8594;</a>
    </div>

    <div class="grid md:grid-cols-3 gap-8">
      <?php foreach ($featured as $p): ?>
      <a href="/bien/<?= htmlspecialchars($p['slug']) ?>" class="property-card group">
        <div class="relative overflow-hidden" style="height:220px">
          <img src="<?= htmlspecialchars($p['image_url']) ?>" alt="<?= htmlspecialchars($p['title']) ?>"
               class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
               loading="lazy">
          <?php if ($p['is_drone']): ?>
          <span class="absolute top-3 left-3 glass text-white text-xs px-2 py-1 rounded-full border border-yellow-800/40">Drone 4K</span>
          <?php endif; ?>
          <?php if ($p['dpe_score']): ?>
          <span class="absolute bottom-3 right-3 text-xs font-bold px-2 py-1 rounded dpe-<?= strtolower($p['dpe_score']) ?>">DPE <?= htmlspecialchars($p['dpe_score']) ?></span>
          <?php endif; ?>
          <?php if ($p['status'] === 'under_offer'): ?>
          <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
            <span class="bg-yellow-500 text-black font-bold px-4 py-2 rounded-full text-sm rotate-[-8deg]">Sous compromis</span>
          </div>
          <?php endif; ?>
        </div>
        <div class="glass p-5 rounded-b-2xl">
          <h3 class="text-white font-semibold mb-1 group-hover:text-yellow-400 transition-colors line-clamp-1">
            <?= htmlspecialchars($p['title']) ?>
          </h3>
          <p class="text-gray-400 text-sm mb-3">📍 <?= htmlspecialchars($p['city']) ?></p>
          <div class="flex items-center gap-4 text-gray-400 text-sm mb-4">
            <span>📐 <?= formatSurface($p['surface']) ?></span>
            <?php if ($p['bedrooms']): ?><span>🛏 <?= $p['bedrooms'] ?> ch.</span><?php endif; ?>
            <?php if ($p['bathrooms']): ?><span>🚿 <?= $p['bathrooms'] ?> sdb.</span><?php endif; ?>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-xl font-bold text-gradient"><?= formatPrice($p['price']) ?></span>
            <span class="text-yellow-400 text-sm">Voir &#8594;</span>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ===== SERVICES ===== -->
<section id="services" class="py-24" style="background:#1a1b22">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center mb-16">
      <p class="section-tag">Nos services</p>
      <h2 class="text-4xl font-bold text-white mt-3">
        Tout inclus, <span class="text-gradient">zéro surprise</span>
      </h2>
      <p class="text-gray-400 mt-4 max-w-xl mx-auto">Chaque mandat bénéficie de l\'ensemble de nos services premium sans frais supplémentaires.</p>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php foreach ([
        ['&#128247;','Photos Professionnelles','Reportage HDR par un photographe certifié immobilier.','text-blue-400'],
        ['&#128065;','Vidéo Drone 4K','Survol aérien pour une mise en valeur spectaculaire.','text-purple-400'],
        ['&#127758;','Visite Virtuelle 360°','Explorez chaque pièce depuis chez vous.','text-yellow-400'],
        ['&#127968;','Home Staging Virtuel','Visualisez le potentiel avec décoration simulée.','text-green-400'],
        ['&#128200;','Diffusion sur +80 portails','Publication nationale et locale maximale.','text-red-400'],
        ['&#128202;','Estimation Précise','Analyse de marché basée sur les transactions.','text-orange-400'],
        ['&#9878;','Accompagnement Juridique','Du compromis à l\'acte avec notaire partenaire.','text-teal-400'],
        ['&#11088;','Conseiller Dédié','Un seul interlocuteur du début jusqu\'au bout.','text-pink-400'],
      ] as [$icon,$title,$desc,$color]): ?>
      <div class="glass rounded-2xl p-6 border border-transparent hover:border-yellow-800/40 transition-all group">
        <div class="text-3xl mb-4"><?= $icon ?></div>
        <h3 class="text-white font-semibold mb-2 text-sm"><?= $title ?></h3>
        <p class="text-gray-400 text-xs"><?= $desc ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Prix -->
    <div class="mt-16 max-w-md mx-auto">
      <div class="glass-gold rounded-3xl p-8 text-center">
        <div class="text-5xl font-bold text-gradient mb-2">3.5%</div>
        <div class="text-white font-semibold mb-1">Honoraires tout inclus</div>
        <div class="text-gray-400 text-sm">TVA incluse • Aucun frais caché</div>
      </div>
    </div>
  </div>
</section>

<!-- ===== TÉMOIGNAGES ===== -->
<section class="py-24" style="background:#0d0e13">
  <div class="max-w-4xl mx-auto px-4">
    <div class="text-center mb-12">
      <p class="section-tag">Témoignages</p>
      <h2 class="text-4xl font-bold text-white mt-3">Ils nous font <span class="text-gradient">confiance</span></h2>
    </div>

    <div x-data="{current: 0, items: [
      {name:'Marie & Thomas L.',loc:'Saintes',type:'Vendeur',text:'Service exceptionnel ! La visite virtuelle a permis à nos acheteurs de tomber amoureux du bien avant même de le visiter. Vendu en 3 semaines au prix demandé.'},
      {name:'Claire B.',loc:'Royan',type:'Acheteur',text:'J\'ai trouvé ma maison de rêve grâce à Immo Vision 17. L\'accompagnement a été irréprochable du début à la fin. Je recommande sans hésiter.'},
      {name:'Jean-Pierre M.',loc:'Rochefort',type:'Vendeur',text:'Les photos et la vidéo drone ont sublimé mon appartement. Plus de 40 demandes en une semaine ! Professionnalisme exemplaire.'},
      {name:'Sophie & Marc D.',loc:'Saint-Jean-d\'Angély',type:'Vendeur',text:'Estimation très précise, vendu 8% au-dessus du prix initial. Le home staging virtuel a vraiment fait la différence.'}
    ]}" x-init="setInterval(() => current = (current+1) % items.length, 5000)">

      <div class="glass-gold rounded-3xl p-10 text-center relative overflow-hidden">
        <template x-for="(item, i) in items" :key="i">
          <div x-show="current === i" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
            <div class="flex justify-center gap-1 mb-6">
              <?php for($i=0;$i<5;$i++): ?><span class="text-yellow-400 text-xl">&#9733;</span><?php endfor; ?>
            </div>
            <blockquote class="text-gray-200 text-lg leading-relaxed mb-8 italic" x-text="'« ' + item.text + ' »'"></blockquote>
            <div class="text-white font-semibold" x-text="item.name"></div>
            <div class="text-gray-400 text-sm mt-1"><span x-text="item.loc"></span> &bull; <span class="text-yellow-400" x-text="item.type"></span></div>
          </div>
        </template>
      </div>

      <!-- Dots -->
      <div class="flex justify-center gap-2 mt-6">
        <template x-for="(item, i) in items" :key="i">
          <button @click="current = i" :class="current === i ? 'bg-yellow-400 w-6' : 'bg-white/20 w-2'" class="h-2 rounded-full transition-all"></button>
        </template>
      </div>
    </div>
  </div>
</section>

<!-- ===== VILLES SEO ===== -->
<section class="py-24" style="background:#1a1b22">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center mb-12">
      <p class="section-tag">Nos secteurs</p>
      <h2 class="text-4xl font-bold text-white mt-3">Immobilier en <span class="text-gradient">Charente-Maritime</span></h2>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-4">
      <?php foreach (array_slice($SEO_CITIES, 0, 8) as $city): ?>
      <a href="/immobilier-<?= $city['slug'] ?>" class="glass rounded-xl p-5 text-center border border-transparent hover:border-yellow-800/40 transition-all group">
        <div class="text-2xl mb-2">📍</div>
        <h3 class="text-white font-semibold text-sm group-hover:text-yellow-400 transition-colors"><?= htmlspecialchars($city['name']) ?></h3>
        <div class="text-gray-400 text-xs mt-1"><?= $city['properties'] ?> biens</div>
        <div class="text-yellow-400 text-xs mt-1"><?= $city['avg_price'] ?> €/m²</div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===== CTA FINAL ===== -->
<section class="py-24 relative overflow-hidden" style="background:#0d0e13">
  <div class="absolute inset-0" style="background:radial-gradient(ellipse at center,rgba(212,175,55,.08) 0%,transparent 70%)"></div>
  <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
      Prêt à vendre votre bien<br>
      <span class="text-gradient">au meilleur prix ?</span>
    </h2>
    <p class="text-gray-400 text-xl mb-10">
      Obtenez une estimation gratuite et découvrez notre méthode premium.
    </p>
    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
      <a href="/estimation" class="btn-gold text-base px-10 py-4">&#10024; Estimation gratuite</a>
      <a href="tel:<?= AGENT_PHONE ?>" class="btn-outline text-base px-10 py-4">📞 Appeler maintenant</a>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
