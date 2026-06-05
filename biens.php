<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'Nos Biens Immobiliers — Charente-Maritime | Immo Vision 17';
$pageDesc  = 'Découvrez toutes nos annonces immobilières en Charente-Maritime : maisons, appartements, terrains, châteaux.';

// Filtres
$type   = $_GET['type']   ?? '';
$city   = $_GET['city']   ?? '';
$maxp   = intval($_GET['maxp'] ?? 0);
$pool   = isset($_GET['pool']);
$sea    = isset($_GET['sea']);

// Construction requête
$where = ['1=1'];
$params = [];
if ($type) { $where[] = 'type = ?'; $params[] = $type; }
if ($city) { $where[] = 'city LIKE ?'; $params[] = "%$city%"; }
if ($maxp) { $where[] = 'price <= ?'; $params[] = $maxp; }
if ($pool) { $where[] = 'has_pool = 1'; }
if ($sea)  { $where[] = 'has_sea_view = 1'; }

$sql  = 'SELECT * FROM properties WHERE ' . implode(' AND ', $where) . ' ORDER BY is_featured DESC, created_at DESC';
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$properties = $stmt->fetchAll();

include 'includes/header.php';
?>

<section class="pt-32 pb-20 min-h-screen" style="background:#0d0e13">
  <div class="max-w-7xl mx-auto px-4">

    <div class="mb-10">
      <p class="section-tag">Catalogue</p>
      <h1 class="text-4xl font-bold text-white mt-2">Nos <span class="text-gradient">biens immobiliers</span></h1>
      <p class="text-gray-400 mt-2"><?= count($properties) ?> bien<?= count($properties) > 1 ? 's' : '' ?> disponible<?= count($properties) > 1 ? 's' : '' ?></p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">

      <!-- Filtres -->
      <aside class="lg:w-64 flex-shrink-0">
        <form method="GET" class="glass rounded-2xl p-6 space-y-5 sticky top-24">
          <div class="flex items-center justify-between">
            <h2 class="text-white font-semibold">Filtres</h2>
            <a href="/biens" class="text-yellow-400 text-xs hover:text-yellow-300">Réinitialiser</a>
          </div>

          <div>
            <label class="text-gray-400 text-xs block mb-2">Type de bien</label>
            <select name="type" class="input-field">
              <option value="">Tous types</option>
              <?php foreach ($PROPERTY_TYPES as $val => $label): ?>
              <option value="<?= $val ?>" <?= $type === $val ? 'selected' : '' ?>><?= $label ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div>
            <label class="text-gray-400 text-xs block mb-2">Ville</label>
            <select name="city" class="input-field">
              <option value="">Toutes villes</option>
              <?php foreach ($SEO_CITIES as $c): ?>
              <option value="<?= $c['name'] ?>" <?= $city === $c['name'] ? 'selected' : '' ?>><?= $c['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div>
            <label class="text-gray-400 text-xs block mb-2">Prix maximum</label>
            <select name="maxp" class="input-field">
              <option value="">Sans limite</option>
              <?php foreach ([200000,300000,500000,750000,1000000] as $v): ?>
              <option value="<?= $v ?>" <?= $maxp === $v ? 'selected' : '' ?>><?= formatPrice($v) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="space-y-3">
            <label class="text-gray-400 text-xs block">Options</label>
            <label class="flex items-center gap-3 cursor-pointer">
              <input type="checkbox" name="pool" <?= $pool ? 'checked' : '' ?> class="w-4 h-4 accent-yellow-400">
              <span class="text-gray-300 text-sm">Piscine</span>
            </label>
            <label class="flex items-center gap-3 cursor-pointer">
              <input type="checkbox" name="sea" <?= $sea ? 'checked' : '' ?> class="w-4 h-4 accent-yellow-400">
              <span class="text-gray-300 text-sm">Vue mer</span>
            </label>
          </div>

          <button type="submit" class="btn-gold w-full">Filtrer</button>
        </form>
      </aside>

      <!-- Grille -->
      <div class="flex-1">
        <?php if (empty($properties)): ?>
        <div class="text-center py-24">
          <div class="text-5xl mb-4">🏠</div>
          <p class="text-gray-400">Aucun bien ne correspond à vos critères.</p>
          <a href="/biens" class="btn-outline mt-6 inline-flex">Voir tous les biens</a>
        </div>
        <?php else: ?>
        <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6">
          <?php foreach ($properties as $p): ?>
          <a href="/bien/<?= htmlspecialchars($p['slug']) ?>" class="property-card group">
            <div class="relative overflow-hidden" style="height:200px">
              <img src="<?= htmlspecialchars($p['image_url'] ?? 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=600') ?>"
                   alt="<?= htmlspecialchars($p['title']) ?>"
                   class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
              <?php if ($p['is_drone']): ?>
              <span class="absolute top-3 left-3 glass text-white text-xs px-2 py-1 rounded-full border border-yellow-800/30">Drone 4K</span>
              <?php endif; ?>
              <?php if ($p['dpe_score']): ?>
              <span class="absolute bottom-3 left-3 text-xs font-bold px-2 py-1 rounded dpe-<?= strtolower($p['dpe_score']) ?>">DPE <?= htmlspecialchars($p['dpe_score']) ?></span>
              <?php endif; ?>
              <?php if ($p['status'] !== 'available'): ?>
              <div class="absolute top-3 right-3">
                <span class="text-xs font-bold px-2 py-1 rounded-full <?= $p['status'] === 'sold' ? 'bg-red-600' : 'bg-yellow-500 text-black' ?>">
                  <?= $p['status'] === 'sold' ? 'Vendu' : 'Sous compromis' ?>
                </span>
              </div>
              <?php endif; ?>
            </div>
            <div class="glass p-4 rounded-b-2xl">
              <h3 class="text-white font-semibold text-sm mb-1 group-hover:text-yellow-400 transition-colors line-clamp-1"><?= htmlspecialchars($p['title']) ?></h3>
              <p class="text-gray-400 text-xs mb-3">📍 <?= htmlspecialchars($p['city']) ?>, <?= htmlspecialchars($p['postal_code']) ?></p>
              <div class="flex items-center gap-3 text-gray-400 text-xs mb-3">
                <span>📐 <?= formatSurface($p['surface']) ?></span>
                <?php if ($p['rooms']): ?><span>🏠 <?= $p['rooms'] ?> p.</span><?php endif; ?>
                <?php if ($p['bedrooms']): ?><span>🛏 <?= $p['bedrooms'] ?> ch.</span><?php endif; ?>
              </div>
              <div class="flex items-center justify-between">
                <span class="text-lg font-bold text-gradient"><?= formatPrice($p['price']) ?></span>
                <span class="text-yellow-400 text-xs">Voir &#8594;</span>
              </div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
