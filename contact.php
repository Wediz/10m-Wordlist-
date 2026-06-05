<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';

$success = false;
$errors  = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName  = trim($_POST['lastName']  ?? '');
    $email     = trim($_POST['email']     ?? '');
    $phone     = trim($_POST['phone']     ?? '');
    $subject   = trim($_POST['subject']   ?? '');
    $message   = trim($_POST['message']   ?? '');

    if (strlen($firstName) < 2) $errors[] = 'Prénom requis (min 2 caractères)';
    if (strlen($lastName)  < 2) $errors[] = 'Nom requis (min 2 caractères)';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email invalide';
    if (empty($subject))  $errors[] = 'Sujet requis';
    if (strlen($message) < 10) $errors[] = 'Message trop court (min 10 caractères)';

    if (empty($errors)) {
        $stmt = $pdo->prepare('INSERT INTO contact_messages (first_name,last_name,email,phone,subject,message) VALUES (?,?,?,?,?,?)');
        $stmt->execute([$firstName,$lastName,$email,$phone,$subject,$message]);
        $success = true;
    }
}

$pageTitle = 'Contact — Immo Vision 17';
$pageDesc  = 'Contactez votre consultant immobilier en Charente-Maritime. Réponse sous 24h.';
include 'includes/header.php';
?>

<section class="pt-32 pb-20 min-h-screen" style="background:#0d0e13">
  <div class="max-w-6xl mx-auto px-4">
    <div class="text-center mb-16">
      <p class="section-tag">Contact</p>
      <h1 class="text-4xl md:text-5xl font-bold text-white mt-3">
        Parlons de <span class="text-gradient">votre projet</span>
      </h1>
      <p class="text-gray-400 mt-4">Réponse sous 24h. Disponible 7j/7.</p>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">

      <!-- Infos -->
      <div class="space-y-4">
        <?php foreach ([
          ['📞','Téléphone',AGENT_PHONE,'tel:'.AGENT_PHONE,'Disponible 7j/7'],
          ['✉️','Email',AGENT_EMAIL,'mailto:'.AGENT_EMAIL,'Réponse sous 24h'],
          ['📍','Zone d\'activité','Charente-Maritime (17)','#','Département 17'],
        ] as [$icon,$label,$val,$href,$sub]): ?>
        <a href="<?= $href ?>" class="glass rounded-2xl p-6 flex items-start gap-4 border border-transparent hover:border-yellow-800/40 transition-all group block">
          <div class="text-3xl"><?= $icon ?></div>
          <div>
            <div class="text-gray-400 text-xs"><?= $label ?></div>
            <div class="text-white font-semibold text-sm group-hover:text-yellow-400 transition-colors"><?= $val ?></div>
            <div class="text-gray-500 text-xs"><?= $sub ?></div>
          </div>
        </a>
        <?php endforeach; ?>

        <div class="glass-gold rounded-2xl p-6">
          <div class="text-yellow-400 font-semibold mb-2">&#10024; Estimation gratuite</div>
          <p class="text-gray-400 text-sm mb-4">Obtenez une estimation précise de votre bien en moins de 48h.</p>
          <a href="/estimation" class="btn-gold w-full">Demander une estimation</a>
        </div>
      </div>

      <!-- Formulaire -->
      <div class="lg:col-span-2">
        <?php if ($success): ?>
        <div class="glass-gold rounded-2xl p-12 text-center">
          <div class="text-6xl mb-4">✅</div>
          <h3 class="text-2xl font-bold text-white mb-2">Message envoyé !</h3>
          <p class="text-gray-400">Nous vous répondrons dans les plus brefs délais.</p>
          <a href="/" class="btn-gold mt-6 inline-flex">Retour à l'accueil</a>
        </div>
        <?php else: ?>

        <?php if (!empty($errors)): ?>
        <div class="glass rounded-xl p-4 mb-6 border border-red-800/50">
          <ul class="text-red-400 text-sm space-y-1">
            <?php foreach ($errors as $e): ?><li>⚠️ <?= htmlspecialchars($e) ?></li><?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>

        <form method="POST" class="glass rounded-2xl p-8 space-y-6">
          <div class="grid sm:grid-cols-2 gap-6">
            <div>
              <label class="text-gray-400 text-sm block mb-2">Prénom *</label>
              <input type="text" name="firstName" value="<?= htmlspecialchars($_POST['firstName'] ?? '') ?>" required class="input-field" placeholder="Jean">
            </div>
            <div>
              <label class="text-gray-400 text-sm block mb-2">Nom *</label>
              <input type="text" name="lastName" value="<?= htmlspecialchars($_POST['lastName'] ?? '') ?>" required class="input-field" placeholder="Dupont">
            </div>
          </div>
          <div class="grid sm:grid-cols-2 gap-6">
            <div>
              <label class="text-gray-400 text-sm block mb-2">Email *</label>
              <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required class="input-field" placeholder="jean@exemple.fr">
            </div>
            <div>
              <label class="text-gray-400 text-sm block mb-2">Téléphone</label>
              <input type="tel" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" class="input-field" placeholder="06 12 34 56 78">
            </div>
          </div>
          <div>
            <label class="text-gray-400 text-sm block mb-2">Sujet *</label>
            <select name="subject" required class="input-field">
              <option value="">Choisissez un sujet</option>
              <?php foreach (['achat'=>"Projet d'achat",'vente'=>'Projet de vente','estimation'=>'Estimation gratuite','visite'=>'Demande de visite','investissement'=>'Investissement locatif','autre'=>'Autre'] as $v=>$l): ?>
              <option value="<?= $v ?>" <?= ($_POST['subject'] ?? '') === $v || ($_GET['sujet'] ?? '') === $v ? 'selected' : '' ?>><?= $l ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <label class="text-gray-400 text-sm block mb-2">Message *</label>
            <textarea name="message" rows="5" required class="input-field resize-none" placeholder="Décrivez votre projet..."><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
          </div>
          <button type="submit" class="btn-gold w-full">✉️ Envoyer le message</button>
        </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
