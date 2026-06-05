<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$success = false;
$errors  = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'first_name'     => trim($_POST['firstName']    ?? ''),
        'last_name'      => trim($_POST['lastName']     ?? ''),
        'email'          => trim($_POST['email']        ?? ''),
        'phone'          => trim($_POST['phone']        ?? ''),
        'property_type'  => trim($_POST['propertyType'] ?? ''),
        'address'        => trim($_POST['address']      ?? ''),
        'city'           => trim($_POST['city']         ?? ''),
        'postal_code'    => trim($_POST['postalCode']   ?? ''),
        'surface'        => floatval($_POST['surface']  ?? 0),
        'rooms'          => intval($_POST['rooms']      ?? 0),
        'condition_state'=> trim($_POST['condition']    ?? ''),
        'has_pool'       => isset($_POST['hasPool'])   ? 1 : 0,
        'has_garage'     => isset($_POST['hasGarage']) ? 1 : 0,
        'has_garden'     => isset($_POST['hasGarden']) ? 1 : 0,
    ];

    if (strlen($data['first_name']) < 2) $errors[] = 'Prénom requis';
    if (strlen($data['last_name'])  < 2) $errors[] = 'Nom requis';
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Email invalide';
    if (strlen($data['phone']) < 10) $errors[] = 'Téléphone requis (min 10 chiffres)';
    if (empty($data['property_type'])) $errors[] = 'Type de bien requis';
    if ($data['surface'] < 10) $errors[] = 'Surface invalide';

    if (empty($errors)) {
        $cols = implode(',', array_keys($data));
        $phs  = implode(',', array_fill(0, count($data), '?'));
        $stmt = $pdo->prepare("INSERT INTO estimation_leads ($cols) VALUES ($phs)");
        $stmt->execute(array_values($data));
        $success = true;
    }
}

$pageTitle = 'Estimation Gratuite — Immo Vision 17';
$pageDesc  = 'Obtenez une estimation gratuite et précise de votre bien immobilier en Charente-Maritime sous 48h.';
include 'includes/header.php';
?>

<section class="pt-32 pb-20 min-h-screen" style="background:#0d0e13">
  <div class="max-w-4xl mx-auto px-4">
    <div class="text-center mb-16">
      <p class="section-tag">Estimation gratuite</p>
      <h1 class="text-4xl md:text-5xl font-bold text-white mt-3">
        Combien vaut <span class="text-gradient">votre bien ?</span>
      </h1>
      <p class="text-gray-400 mt-4 max-w-xl mx-auto">Analyse complète basée sur les transactions récentes. Résultat sous 48h.</p>
    </div>

    <!-- Garanties -->
    <div class="grid grid-cols-3 gap-4 mb-12">
      <?php foreach ([['&#10003;','Gratuit et sans engagement'],['&#9200;','Estimation sous 48h'],['🔒','Données confidentielles']] as [$icon,$text]): ?>
      <div class="glass rounded-xl p-4 text-center">
        <div class="text-yellow-400 text-xl mb-1"><?= $icon ?></div>
        <div class="text-gray-300 text-xs"><?= $text ?></div>
      </div>
      <?php endforeach; ?>
    </div>

    <?php if ($success): ?>
    <div class="glass-gold rounded-3xl p-12 text-center">
      <div class="text-7xl mb-6">✅</div>
      <h3 class="text-3xl font-bold text-white mb-3">Demande envoyée !</h3>
      <p class="text-gray-300 text-lg">Votre estimation sera prête sous <strong class="text-yellow-400">48h</strong>.</p>
      <p class="text-gray-400 mt-2">Nous vous contacterons par téléphone.</p>
      <a href="/" class="btn-gold mt-8 inline-flex">Retour à l'accueil</a>
    </div>
    <?php else: ?>

    <?php if (!empty($errors)): ?>
    <div class="glass rounded-xl p-4 mb-6 border border-red-800/50">
      <ul class="text-red-400 text-sm space-y-1">
        <?php foreach ($errors as $e): ?><li>⚠️ <?= htmlspecialchars($e) ?></li><?php endforeach; ?>
      </ul>
    </div>
    <?php endif; ?>

    <div x-data="{step: 1}" class="glass rounded-3xl p-8">
      <!-- Progress -->
      <div class="mb-8">
        <div class="flex items-center justify-between mb-3">
          <?php foreach ([1=>'Votre bien',2=>'Caractéristiques',3=>'Prestations',4=>'Vos coordonnées'] as $n=>$lbl): ?>
          <div class="flex items-center gap-2" :class="step >= <?= $n ?> ? 'text-yellow-400' : 'text-gray-600'">
            <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold"
                 :class="step > <?= $n ?> ? 'bg-yellow-400 text-black' : step == <?= $n ?> ? 'border-2 border-yellow-400' : 'border-2 border-white/10'">
              <span x-show="step > <?= $n ?>">✓</span>
              <span x-show="step <= <?= $n ?>"><?= $n ?></span>
            </div>
            <span class="hidden sm:block text-xs"><?= $lbl ?></span>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="h-1 bg-white/10 rounded-full overflow-hidden">
          <div class="h-full bg-gradient-to-r from-yellow-600 to-yellow-400 rounded-full transition-all duration-500" :style="'width:' + (step/4*100) + '%'"></div>
        </div>
      </div>

      <form method="POST">
        <!-- Étape 1 -->
        <div x-show="step === 1" class="space-y-5">
          <div>
            <label class="text-gray-400 text-sm block mb-2">Type de bien *</label>
            <select name="propertyType" required class="input-field">
              <option value="">Sélectionnez</option>
              <?php foreach ($PROPERTY_TYPES as $v=>$l): ?>
              <option value="<?= $v ?>"><?= $l ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <label class="text-gray-400 text-sm block mb-2">Ville *</label>
            <select name="city" required class="input-field">
              <option value="">Sélectionnez</option>
              <?php foreach ($SEO_CITIES as $c): ?>
              <option value="<?= htmlspecialchars($c['name']) ?>"><?= htmlspecialchars($c['name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <label class="text-gray-400 text-sm block mb-2">Adresse *</label>
            <input type="text" name="address" required class="input-field" placeholder="12 rue de la Paix">
          </div>
          <div>
            <label class="text-gray-400 text-sm block mb-2">Code postal *</label>
            <input type="text" name="postalCode" required maxlength="5" class="input-field" placeholder="17000">
          </div>
          <div class="flex justify-end">
            <button type="button" @click="step = 2" class="btn-gold">Continuer &#8594;</button>
          </div>
        </div>

        <!-- Étape 2 -->
        <div x-show="step === 2" class="space-y-5">
          <div>
            <label class="text-gray-400 text-sm block mb-2">Surface (m²) *</label>
            <input type="number" name="surface" required min="1" class="input-field" placeholder="120">
          </div>
          <div>
            <label class="text-gray-400 text-sm block mb-2">Nombre de pièces *</label>
            <input type="number" name="rooms" required min="1" class="input-field" placeholder="5">
          </div>
          <div>
            <label class="text-gray-400 text-sm block mb-2">État général *</label>
            <select name="condition" required class="input-field">
              <option value="">Sélectionnez</option>
              <option value="neuf">Neuf / Très bon état</option>
              <option value="bon">Bon état</option>
              <option value="moyen">À rénover partiellement</option>
              <option value="travaux">À rénover entièrement</option>
            </select>
          </div>
          <div class="flex justify-between">
            <button type="button" @click="step = 1" class="btn-outline">&#8592; Retour</button>
            <button type="button" @click="step = 3" class="btn-gold">Continuer &#8594;</button>
          </div>
        </div>

        <!-- Étape 3 -->
        <div x-show="step === 3" class="space-y-4">
          <p class="text-gray-400 mb-4">Sélectionnez les prestations de votre bien :</p>
          <?php foreach (['hasPool'=>'Piscine','hasGarage'=>'Garage / Box','hasGarden'=>'Jardin'] as $name=>$label): ?>
          <label class="flex items-center gap-3 cursor-pointer glass rounded-xl p-4">
            <input type="checkbox" name="<?= $name ?>" class="w-5 h-5 accent-yellow-400">
            <span class="text-gray-300"><?= $label ?></span>
          </label>
          <?php endforeach; ?>
          <div class="flex justify-between pt-2">
            <button type="button" @click="step = 2" class="btn-outline">&#8592; Retour</button>
            <button type="button" @click="step = 4" class="btn-gold">Continuer &#8594;</button>
          </div>
        </div>

        <!-- Étape 4 -->
        <div x-show="step === 4" class="space-y-5">
          <div class="grid sm:grid-cols-2 gap-4">
            <div>
              <label class="text-gray-400 text-sm block mb-2">Prénom *</label>
              <input type="text" name="firstName" required class="input-field" placeholder="Jean">
            </div>
            <div>
              <label class="text-gray-400 text-sm block mb-2">Nom *</label>
              <input type="text" name="lastName" required class="input-field" placeholder="Dupont">
            </div>
          </div>
          <div>
            <label class="text-gray-400 text-sm block mb-2">Email *</label>
            <input type="email" name="email" required class="input-field" placeholder="jean@exemple.fr">
          </div>
          <div>
            <label class="text-gray-400 text-sm block mb-2">Téléphone *</label>
            <input type="tel" name="phone" required class="input-field" placeholder="06 12 34 56 78">
          </div>
          <div class="flex justify-between">
            <button type="button" @click="step = 3" class="btn-outline">&#8592; Retour</button>
            <button type="submit" class="btn-gold">✨ Obtenir mon estimation</button>
          </div>
        </div>
      </form>
    </div>
    <?php endif; ?>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
