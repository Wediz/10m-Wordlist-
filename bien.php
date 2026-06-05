<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$slug = $_GET['slug'] ?? '';
if (!$slug) { header('Location: /biens'); exit; }

$stmt = $pdo->prepare('SELECT * FROM properties WHERE slug = ? LIMIT 1');
$stmt->execute([$slug]);
$p = $stmt->fetch();
if (!$p) { http_response_code(404); die('<p style="color:white;padding:2rem">Bien introuvable.</p>'); }

$pageTitle = htmlspecialchars($p['title']) . ' — Immo Vision 17';
$pageDesc  = substr(strip_tags($p['description'] ?? ''), 0, 160);

include 'includes/header.php';
?>

<section class="pt-28 pb-20 min-h-screen" style="background:#0d0e13">
  <div class="max-w-7xl mx-auto px-4">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
      <a href="/" class="hover:text-yellow-400 transition-colors">Accueil</a>
      <span>/</span>
      <a href="/biens" class="hover:text-yellow-400 transition-colors">Biens</a>
      <span>/</span>
      <span class="text-gray-300"><?= htmlspecialchars($p['city']) ?></span>
    </nav>

    <!-- Galerie photos -->
    <div x-data="{lightbox: null}" class="mb-10">
      <div class="grid grid-cols-4 grid-rows-2 gap-3 rounded-2xl overflow-hidden" style="height:440px">
        <?php
        $imgs = array_filter([$p['image_url'], $p['image2_url'], $p['image3_url']]);
        foreach (array_values($imgs) as $idx => $img): ?>
        <div class="relative cursor-pointer overflow-hidden group <?= $idx === 0 ? 'col-span-2 row-span-2' : '' ?>"
             @click="lightbox = <?= $idx ?>">
          <img src="<?= htmlspecialchars($img) ?>" alt="Photo <?= $idx+1 ?>"
               class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Lightbox -->
      <div x-show="lightbox !== null" x-transition class="fixed inset-0 z-50 bg-black/95 flex items-center justify-center" @click="lightbox = null">
        <?php foreach (array_values($imgs) as $idx => $img): ?>
        <img x-show="lightbox === <?= $idx ?>" src="<?= htmlspecialchars($img) ?>" alt=""
             class="max-w-5xl max-h-screen object-contain px-20" @click.stop>
        <?php endforeach; ?>
        <button @click="lightbox = null" class="absolute top-4 right-4 text-white text-3xl">&#10005;</button>
      </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
      <!-- Contenu principal -->
      <div class="lg:col-span-2 space-y-8">

        <div>
          <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-6">
            <div>
              <h1 class="text-3xl font-bold text-white mb-2"><?= htmlspecialchars($p['title']) ?></h1>
              <p class="text-gray-400">📍 <?= htmlspecialchars($p['city']) ?> (<?= htmlspecialchars($p['postal_code']) ?>)</p>
            </div>
            <div class="text-right">
              <div class="text-3xl font-bold text-gradient"><?= formatPrice($p['price']) ?></div>
              <?php if ($p['surface']): ?>
              <div class="text-gray-400 text-sm"><?= number_format($p['price']/$p['surface'],0,',',' ') ?> €/m²</div>
              <?php endif; ?>
            </div>
          </div>

          <!-- Caractéristiques -->
          <div class="grid grid-cols-3 sm:grid-cols-6 gap-3">
            <?php foreach ([
              ['Surface', formatSurface($p['surface'])],
              ['Terrain', $p['land_surface'] ? formatSurface($p['land_surface']) : '-'],
              ['Pièces',  $p['rooms'] ?: '-'],
              ['Chambres',$p['bedrooms'] ?: '-'],
              ['SDB',     $p['bathrooms'] ?: '-'],
              ['Construit',$p['year_built'] ?: '-'],
            ] as [$lbl,$val]): ?>
            <div class="glass rounded-xl p-3 text-center">
              <div class="text-white font-semibold text-sm"><?= $val ?></div>
              <div class="text-gray-400 text-xs"><?= $lbl ?></div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Description -->
        <?php if ($p['description']): ?>
        <div class="glass rounded-2xl p-6">
          <h2 class="text-white font-semibold mb-4">Description</h2>
          <p class="text-gray-300 leading-relaxed"><?= nl2br(htmlspecialchars($p['description'])) ?></p>
        </div>
        <?php endif; ?>

        <!-- Prestations -->
        <div class="glass rounded-2xl p-6">
          <h2 class="text-white font-semibold mb-4">Prestations</h2>
          <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
            <?php foreach ([
              ['Piscine',  $p['has_pool']],
              ['Garage',   $p['has_garage']],
              ['Jardin',   $p['has_garden']],
              ['Vue mer',  $p['has_sea_view']],
              ['Terrasse', $p['has_terrace']],
            ] as [$lbl,$val]): ?>
            <div class="flex items-center gap-2 text-sm <?= $val ? 'text-gray-300' : 'text-gray-600' ?>">
              <span class="<?= $val ? 'text-yellow-400' : 'text-gray-700' ?>">&#10003;</span>
              <?= $lbl ?>
            </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- DPE -->
        <?php if ($p['dpe_score']): ?>
        <div class="glass rounded-2xl p-6">
          <h2 class="text-white font-semibold mb-4">Diagnostics énergétiques</h2>
          <div class="flex gap-6">
            <div class="text-center">
              <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-bold dpe-<?= strtolower($p['dpe_score']) ?> mb-1"><?= htmlspecialchars($p['dpe_score']) ?></div>
              <div class="text-gray-400 text-xs">DPE</div>
            </div>
            <?php if ($p['ges_score']): ?>
            <div class="text-center">
              <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl font-bold dpe-<?= strtolower($p['ges_score']) ?> mb-1"><?= htmlspecialchars($p['ges_score']) ?></div>
              <div class="text-gray-400 text-xs">GES</div>
            </div>
            <?php endif; ?>
          </div>
        </div>
        <?php endif; ?>

        <!-- Simulateur crédit -->
        <div x-data="{
          price: <?= $p['price'] ?>,
          apport: <?= round($p['price'] * 0.1) ?>,
          rate: 3.8,
          years: 20,
          get monthly() {
            const principal = this.price - this.apport;
            const r = this.rate / 100 / 12;
            const n = this.years * 12;
            if (r === 0) return (principal / n).toFixed(0);
            return (principal * r * Math.pow(1+r,n) / (Math.pow(1+r,n)-1)).toFixed(0);
          }
        }" class="glass rounded-2xl p-6">
          <h2 class="text-white font-semibold mb-6">Simulateur de prêt</h2>
          <div class="space-y-5 mb-6">
            <div>
              <div class="flex justify-between text-sm mb-2"><span class="text-gray-400">Apport personnel</span><span class="text-yellow-400 font-medium" x-text="new Intl.NumberFormat('fr-FR',{style:'currency',currency:'EUR',maximumFractionDigits:0}).format(apport)"></span></div>
              <input type="range" :min="0" :max="price*0.5" step="5000" x-model="apport" class="w-full accent-yellow-400">
            </div>
            <div>
              <div class="flex justify-between text-sm mb-2"><span class="text-gray-400">Taux d'intérêt</span><span class="text-yellow-400 font-medium" x-text="rate + '%'"></span></div>
              <input type="range" min="1" max="6" step="0.1" x-model="rate" class="w-full accent-yellow-400">
            </div>
            <div>
              <div class="flex justify-between text-sm mb-2"><span class="text-gray-400">Durée</span><span class="text-yellow-400 font-medium" x-text="years + ' ans'"></span></div>
              <input type="range" min="5" max="30" step="1" x-model="years" class="w-full accent-yellow-400">
            </div>
          </div>
          <div class="glass-gold rounded-xl p-4 text-center">
            <div class="text-3xl font-bold text-gradient" x-text="new Intl.NumberFormat('fr-FR',{style:'currency',currency:'EUR',maximumFractionDigits:0}).format(monthly) + '/mois'"></div>
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="space-y-6">
        <div class="glass-gold rounded-2xl p-6 sticky top-24">
          <h3 class="text-white font-semibold mb-4">Votre conseiller</h3>
          <div class="flex items-center gap-3 mb-6">
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center text-black font-bold">IV</div>
            <div>
              <div class="text-white font-medium"><?= AGENT_NAME ?></div>
              <div class="text-yellow-400 text-sm">Conseiller immobilier</div>
            </div>
          </div>
          <div class="space-y-3">
            <a href="tel:<?= AGENT_PHONE ?>" class="btn-gold w-full">📞 Appeler</a>
            <a href="/contact" class="btn-outline w-full">✉️ Envoyer un message</a>
          </div>
          <div class="mt-6 pt-4 border-t border-yellow-900/30 text-sm text-gray-400">
            📅 Planifier une visite
          </div>
          <a href="/contact?sujet=visite&bien=<?= urlencode($p['title']) ?>" class="btn-gold w-full mt-3">Demander une visite</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
