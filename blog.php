<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$slug = $_GET['slug'] ?? null;

if ($slug) {
    // Article individuel
    $stmt = $pdo->prepare('SELECT * FROM blog_posts WHERE slug = ? LIMIT 1');
    $stmt->execute([$slug]);
    $post = $stmt->fetch();
    if (!$post) { header('Location: /blog'); exit; }

    $pageTitle = htmlspecialchars($post['title']) . ' — Blog | Immo Vision 17';
    $pageDesc  = htmlspecialchars(substr(strip_tags($post['excerpt'] ?? ''), 0, 160));
    include 'includes/header.php';
    ?>
    <section class="pt-32 pb-20 min-h-screen" style="background:#0d0e13">
      <div class="max-w-3xl mx-auto px-4">
        <a href="/blog" class="text-yellow-400 text-sm hover:text-yellow-300 mb-6 inline-block">← Retour au blog</a>
        <?php if ($post['cover_image']): ?>
        <img src="<?= htmlspecialchars($post['cover_image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>"
             class="w-full h-64 object-cover rounded-2xl mb-8">
        <?php endif; ?>
        <div class="flex gap-2 flex-wrap mb-4">
          <?php foreach (explode(',', $post['tags'] ?? '') as $t): if(trim($t)): ?>
          <span class="glass text-yellow-400 text-xs px-3 py-1 rounded-full"><?= htmlspecialchars(trim($t)) ?></span>
          <?php endif; endforeach; ?>
        </div>
        <h1 class="text-3xl font-bold text-white mb-4"><?= htmlspecialchars($post['title']) ?></h1>
        <div class="text-gray-500 text-sm mb-8">
          Par <?= htmlspecialchars($post['author']) ?> • <?= $post['published_at'] ? formatDate($post['published_at']) : '' ?>
        </div>
        <div class="prose text-gray-300 leading-relaxed">
          <?= $post['content'] ?>
        </div>
        <div class="mt-12 pt-8 border-t border-white/10">
          <a href="/contact" class="btn-gold">✉️ Contacter notre équipe</a>
        </div>
      </div>
    </section>
    <?php
    include 'includes/footer.php';
    exit;
}

// Liste des articles
$stmt  = $pdo->query('SELECT * FROM blog_posts WHERE published_at IS NOT NULL ORDER BY published_at DESC');
$posts = $stmt->fetchAll();

$pageTitle = 'Blog Immobilier — Conseils & Actualités | Immo Vision 17';
$pageDesc  = 'Conseils immobiliers, tendances du marché en Charente-Maritime, guides pour acheteurs et vendeurs.';
include 'includes/header.php';
?>

<section class="pt-32 pb-20 min-h-screen" style="background:#0d0e13">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center mb-16">
      <p class="section-tag">Blog</p>
      <h1 class="text-4xl md:text-5xl font-bold text-white mt-3">
        Conseils & <span class="text-gradient">Actualités</span>
      </h1>
      <p class="text-gray-400 mt-4">Tendances du marché, conseils pratiques et actualités immobilières.</p>
    </div>

    <?php if (empty($posts)): ?>
    <div class="text-center py-20">
      <p class="text-gray-400">Aucun article pour le moment.</p>
    </div>
    <?php else: ?>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
      <?php foreach ($posts as $post): ?>
      <a href="/blog/<?= htmlspecialchars($post['slug']) ?>" class="glass rounded-2xl overflow-hidden border border-transparent hover:border-yellow-800/40 transition-all group block">
        <?php if ($post['cover_image']): ?>
        <div class="relative overflow-hidden" style="height:200px">
          <img src="<?= htmlspecialchars($post['cover_image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>"
               class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
        </div>
        <?php endif; ?>
        <div class="p-6">
          <div class="flex gap-2 flex-wrap mb-3">
            <?php foreach (array_slice(explode(',', $post['tags'] ?? ''), 0, 2) as $t): if(trim($t)): ?>
            <span class="text-xs glass px-2 py-1 rounded-full text-yellow-400"><?= htmlspecialchars(trim($t)) ?></span>
            <?php endif; endforeach; ?>
          </div>
          <h2 class="text-white font-semibold mb-2 group-hover:text-yellow-400 transition-colors" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
            <?= htmlspecialchars($post['title']) ?>
          </h2>
          <p class="text-gray-400 text-sm" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
            <?= htmlspecialchars($post['excerpt'] ?? '') ?>
          </p>
          <div class="flex items-center justify-between mt-4">
            <span class="text-gray-500 text-xs"><?= $post['published_at'] ? formatDate($post['published_at']) : '' ?></span>
            <span class="text-yellow-400 text-sm">Lire &#8594;</span>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="border-t border-white/5 pt-12">
      <h2 class="text-xl font-bold text-white mb-6">Immobilier par ville</h2>
      <div class="flex flex-wrap gap-3">
        <?php foreach ($SEO_CITIES as $city): ?>
        <a href="/immobilier-<?= $city['slug'] ?>" class="glass px-4 py-2 rounded-full text-sm text-gray-300 hover:text-yellow-400 transition-colors border border-transparent hover:border-yellow-800/30">
          Immobilier <?= htmlspecialchars($city['name']) ?>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
