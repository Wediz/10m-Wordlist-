</main>

<!-- FOOTER -->
<footer class="bg-dark-950 border-t border-yellow-900/30 mt-auto">
  <div class="max-w-7xl mx-auto px-4 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

      <!-- Brand -->
      <div class="space-y-4">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center">
            <span class="text-black font-bold text-sm">IV</span>
          </div>
          <div>
            <div class="text-white font-bold text-lg leading-none">Immo Vision 17</div>
            <div class="text-yellow-500 text-xs">Charente-Maritime</div>
          </div>
        </div>
        <p class="text-gray-400 text-sm leading-relaxed">
          Consultant immobilier indépendant en Charente-Maritime.
          Expert local pour vos projets d'achat, vente et estimation.
        </p>
        <div class="space-y-2">
          <a href="tel:<?= AGENT_PHONE ?>" class="flex items-center gap-2 text-sm text-gray-400 hover:text-yellow-400 transition-colors">
            📞 <?= AGENT_PHONE ?>
          </a>
          <a href="mailto:<?= AGENT_EMAIL ?>" class="flex items-center gap-2 text-sm text-gray-400 hover:text-yellow-400 transition-colors">
            ✉️ <?= AGENT_EMAIL ?>
          </a>
          <div class="text-sm text-gray-400">📍 Charente-Maritime (17)</div>
        </div>
      </div>

      <!-- Services -->
      <div>
        <h3 class="text-white font-semibold mb-4">Nos Services</h3>
        <ul class="space-y-2">
          <?php foreach ([
            ['/estimation','Estimation gratuite'],
            ['/biens','Trouver un bien'],
            ['/contact','Vendre votre bien'],
            ['/blog','Blog immobilier'],
            ['/contact','Nous contacter'],
          ] as [$href,$label]): ?>
          <li><a href="<?= $href ?>" class="text-sm text-gray-400 hover:text-yellow-400 transition-colors"><?= $label ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Villes -->
      <div>
        <h3 class="text-white font-semibold mb-4">Nos secteurs</h3>
        <ul class="space-y-2">
          <?php foreach ($SEO_CITIES as $city): ?>
          <li>
            <a href="/immobilier-<?= $city['slug'] ?>" class="text-sm text-gray-400 hover:text-yellow-400 transition-colors">
              Immobilier <?= $city['name'] ?>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Legal -->
      <div>
        <h3 class="text-white font-semibold mb-4">Informations</h3>
        <ul class="space-y-2 mb-6">
          <li><a href="/mentions-legales" class="text-sm text-gray-400 hover:text-yellow-400 transition-colors">Mentions légales</a></li>
          <li><a href="/mentions-legales" class="text-sm text-gray-400 hover:text-yellow-400 transition-colors">CGU</a></li>
          <li><a href="/admin" class="text-sm text-gray-600 hover:text-gray-400 transition-colors">Espace Pro</a></li>
        </ul>
        <div class="glass rounded-xl p-4 text-center">
          <div class="text-yellow-400 text-xs font-semibold mb-1">Réseau Efficity</div>
          <div class="text-gray-400 text-xs">Agent mandataire immobilier</div>
          <div class="text-gray-500 text-xs mt-1">Carte pro n° XXXXX</div>
        </div>
      </div>
    </div>
  </div>

  <div class="border-t border-white/5 py-6">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-4">
      <p class="text-gray-500 text-sm">&copy; <?= date('Y') ?> Immo Vision 17. Tous droits réservés.</p>
      <p class="text-gray-700 text-xs">Charente-Maritime • Département 17</p>
    </div>
  </div>
</footer>

</body>
</html>
