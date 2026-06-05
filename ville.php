<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$slug = $_GET['slug'] ?? '';
$city = null;
foreach ($SEO_CITIES as $c) {
    if ($c['slug'] === $slug) { $city = $c; break; }
}
if (!$city) { header('Location: /'); exit; }

// Biens de cette ville
$stmt = $pdo->prepare('SELECT * FROM properties WHERE city LIKE ? ORDER BY is_featured DESC LIMIT 6');
$stmt->execute(['%' . $city['name'] . '%']);
$properties = $stmt->fetchAll();

$pageTitle = "Immobilier {$city['name']} | Achat Vente Estimation | Immo Vision 17";
$pageDesc  = "Expert immobilier à {$city['name']} (Charente-Maritime). Achat, vente, estimation gratuite. {$city['properties']} biens disponibles. Prix moyen : {$city['avg_price']}€/m².";
include 'includes/header.php';
?>

<section class="pt-32 pb-20 min-h-screen" style="background:#0d0e13">
  <div class="max-w-7xl mx-auto px-4">

    <div class="text-center mb-16">
      <p class="section-tag">📍 Charente-Maritime (17)</p>
      <h1 class="text-4xl md:text-5xl font-bold text-white mt-3">
        Immobilier <span class="text-gradient"><?= htmlspecialchars($city['name']) ?></span>
      </h1>
      <p class="text-gray-400 mt-4 max-w-2xl mx-auto text-lg">
        Votre expert immobilier local pour acheter, vendre ou estimer votre bien à <?= htmlspecialchars($city['name']) ?>.
      </p>
    </div>

    <!-- Stats marché -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
      <?php foreach ([
        ['📈','Prix moyen', $city['avg_price'] . ' €/m²'],
        ['📅','Évolution 1 an', $city['evolution']],
        ['🏠','Biens dispo.', $city['properties'] . ' biens'],
      ] as [$icon,$label,$val]): ?>
      <div class="glass rounded-2xl p-6 text-center">
        <div class="text-3xl mb-2"><?= $icon ?></div>
        <div class="text-2xl font-bold text-white mb-1"><?= htmlspecialchars($val) ?></div>
        <div class="text-gray-400 text-sm"><?= $label ?></div>
      </div>
      <?php endforeach; ?>
      <div class="glass-gold rounded-2xl p-6 text-center">
        <div class="text-3xl mb-2">⭐</div>
        <div class="text-2xl font-bold text-gradient mb-1">3.5%</div>
        <div class="text-gray-400 text-sm">Honoraires tout inclus</div>
      </div>
    </div>

    <!-- CTA -->
    <div class="glass-gold rounded-3xl p-10 text-center mb-16">
      <h2 class="text-3xl font-bold text-white mb-4">Votre bien à <?= htmlspecialchars($city['name']) ?> ?</h2>
      <p class="text-gray-300 mb-8">Estimation gratuite basée sur les transactions récentes à <?= htmlspecialchars($city['name']) ?>.</p>
      <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
        <a href="/estimation" class="btn-gold">&#10024; Estimation gratuite</a>
        <a href="/biens?city=<?= urlencode($city['name']) ?>" class="btn-outline">Voir les biens &#8594;</a>
      </div>
    </div>

    <!-- Biens -->
    <?php if (!empty($properties)): ?>
    <h2 class="text-2xl font-bold text-white mb-6">Biens disponibles à <?= htmlspecialchars($city['name']) ?></h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
      <?php foreach ($properties as $p): ?>
      <a href="/bien/<?= htmlspecialchars($p['slug']) ?>" class="property-card group">
        <div class="relative overflow-hidden" style="height:180px">
          <img src="<?= htmlspecialchars($p['image_url']) ?>" alt="<?= htmlspecialchars($p['title']) ?>"
               class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
        </div>
        <div class="glass p-4">
          <h3 class="text-white font-medium text-sm group-hover:text-yellow-400 transition-colors"><?= htmlspecialchars($p['title']) ?></h3>
          <div class="flex justify-between items-center mt-2">
            <span class="text-gray-400 text-xs"><?= formatSurface($p['surface']) ?></span>
            <span class="font-bold text-gradient"><?= formatPrice($p['price']) ?></span>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Texte SEO -->
    <div class="max-w-4xl mx-auto glass rounded-2xl p-8">
      <h2 class="text-2xl font-bold text-white mb-4">Le marché immobilier à <?= htmlspecialchars($city['name']) ?></h2>
      <div class="space-y-4 text-gray-400 leading-relaxed">
        <p><?= htmlspecialchars($city['name']) ?> est une ville dynamique de Charente-Maritime où le marché immobilier se caractérise par des prix accessibles et une demande soutenue. Le prix moyen au mètre carré y est de <?= $city['avg_price'] ?>€, avec une évolution de <?= $city['evolution'] ?> sur les 12 derniers mois.</p>
        <p>Immo Vision 17, votre consultant immobilier indépendant, vous accompagne dans tous vos projets immobiliers à <?= htmlspecialchars($city['name']) ?> et dans tout le département 17. Visite virtuelle 360°, drone 4K, photos professionnelles et diffusion sur plus de 80 portails.</p>
      </div>
    </div>

    <!-- Autres villes -->
    <div class="mt-12 pt-8 border-t border-white/5">
      <h3 class="text-white font-semibold mb-4">Autres secteurs</h3>
      <div class="flex flex-wrap gap-3">
        <?php foreach ($SEO_CITIES as $c): if ($c['slug'] !== $city['slug']): ?>
        <a href="/immobilier-<?= $c['slug'] ?>" class="glass px-4 py-2 rounded-full text-sm text-gray-300 hover:text-yellow-400 transition-colors">
          <?= htmlspecialchars($c['name']) ?>
        </a>
        <?php endif; endforeach; ?>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
