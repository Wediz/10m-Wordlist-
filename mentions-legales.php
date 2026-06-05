<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'Mentions Légales — Immo Vision 17';
$pageDesc  = 'Mentions légales, CGU et politique de confidentialité de Immo Vision 17.';
include 'includes/header.php';
?>

<section class="pt-32 pb-20 min-h-screen" style="background:#0d0e13">
  <div class="max-w-3xl mx-auto px-4">
    <h1 class="text-4xl font-bold text-white mb-8">Mentions <span class="text-gradient">Légales</span></h1>

    <div class="space-y-8 text-gray-400">
      <div class="glass rounded-2xl p-6">
        <h2 class="text-white font-semibold mb-4">1. Éditeur du site</h2>
        <p>Immo Vision 17 — Consultant immobilier indépendant</p>
        <p>Réseau Efficity — Agent mandataire immobilier</p>
        <p>Téléphone : <?= AGENT_PHONE ?></p>
        <p>Email : <?= AGENT_EMAIL ?></p>
        <p>Zone d'activité : Charente-Maritime (17)</p>
      </div>

      <div class="glass rounded-2xl p-6">
        <h2 class="text-white font-semibold mb-4">2. Hébergement</h2>
        <p>LWS — Ligne Web Services</p>
        <p>10 rue Penthievre, 75008 Paris</p>
      </div>

      <div class="glass rounded-2xl p-6">
        <h2 class="text-white font-semibold mb-4">3. Propriété intellectuelle</h2>
        <p>L'ensemble du contenu de ce site est protégé par le droit d'auteur. Toute reproduction est interdite sans autorisation.</p>
      </div>

      <div class="glass rounded-2xl p-6">
        <h2 class="text-white font-semibold mb-4">4. Données personnelles (RGPD)</h2>
        <p>Les données collectées via les formulaires sont utilisées uniquement pour vous recontacter dans le cadre de votre projet immobilier. Elles ne sont jamais revendues à des tiers.</p>
        <p class="mt-2">Conformément au RGPD, vous disposez d'un droit d'accès, de rectification et de suppression. Contactez-nous à <?= AGENT_EMAIL ?>.</p>
      </div>

      <div class="glass rounded-2xl p-6">
        <h2 class="text-white font-semibold mb-4">5. Cookies</h2>
        <p>Ce site utilise uniquement des cookies de session nécessaires au bon fonctionnement. Aucun cookie publicitaire n'est utilisé.</p>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
