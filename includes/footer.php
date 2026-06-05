</main>

<!-- ═══════════════════ FOOTER ═══════════════════ -->
<footer style="background: #090A0F;" class="border-t border-white/5">
  <div class="max-w-7xl mx-auto px-5 py-20">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

      <!-- Brand -->
      <div class="lg:col-span-1">
        <div class="flex items-center gap-3 mb-5">
          <div class="relative w-10 h-10">
            <div class="absolute inset-0 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 blur-sm opacity-50"></div>
            <div class="relative w-10 h-10 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center">
              <span class="text-black font-bold text-sm">IV</span>
            </div>
          </div>
          <div>
            <div class="text-white font-semibold leading-tight">Immo Vision 17</div>
            <div class="text-yellow-600 text-[10px] tracking-widest uppercase">Charente-Maritime</div>
          </div>
        </div>
        <p class="text-gray-600 text-sm leading-relaxed mb-6">Consultant immobilier indépendant en Charente-Maritime. Expert local pour vos projets d'achat, vente et estimation immobilière.</p>
        <div class="space-y-2.5">
          <a href="tel:<?= AGENT_PHONE ?>" class="flex items-center gap-2.5 text-sm text-gray-500 hover:text-yellow-400 transition-colors">
            <svg class="w-3.5 h-3.5 text-yellow-700" fill="currentColor" viewBox="0 0 24 24"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1-9.4 0-17-7.6-17-17 0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.3 0 .7-.2 1L6.6 10.8z"/></svg>
            <?= AGENT_PHONE ?>
          </a>
          <a href="mailto:<?= AGENT_EMAIL ?>" class="flex items-center gap-2.5 text-sm text-gray-500 hover:text-yellow-400 transition-colors">
            <svg class="w-3.5 h-3.5 text-yellow-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <?= AGENT_EMAIL ?>
          </a>
          <div class="flex items-center gap-2.5 text-sm text-gray-500">
            <svg class="w-3.5 h-3.5 text-yellow-700" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/></svg>
            Charente-Maritime (17)
          </div>
        </div>
      </div>

      <!-- Services -->
      <div>
        <h3 class="text-white text-sm font-semibold mb-5 tracking-wide">Nos Services</h3>
        <ul class="space-y-2.5">
          <?php foreach (['/estimation' => 'Estimation gratuite', '/biens' => 'Annonces immobilières', '/contact' => 'Vendre votre bien', '/biens' => 'Visite virtuelle 360°', '/blog' => 'Blog immobilier', '/contact' => 'Nous contacter'] as $href => $label): ?>
          <li><a href="<?= $href ?>" class="text-sm text-gray-600 hover:text-yellow-400 transition-colors"><?= $label ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Villes -->
      <div>
        <h3 class="text-white text-sm font-semibold mb-5 tracking-wide">Nos Secteurs</h3>
        <ul class="space-y-2.5">
          <?php foreach ($SEO_CITIES as $city): ?>
          <li>
            <a href="/immobilier-<?= $city['slug'] ?>" class="text-sm text-gray-600 hover:text-yellow-400 transition-colors">
              Immobilier <?= htmlspecialchars($city['name']) ?>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Legal -->
      <div>
        <h3 class="text-white text-sm font-semibold mb-5 tracking-wide">Informations</h3>
        <ul class="space-y-2.5 mb-8">
          <li><a href="/mentions-legales" class="text-sm text-gray-600 hover:text-yellow-400 transition-colors">Mentions légales</a></li>
          <li><a href="/mentions-legales" class="text-sm text-gray-600 hover:text-yellow-400 transition-colors">CGU</a></li>
          <li><a href="/mentions-legales" class="text-sm text-gray-600 hover:text-yellow-400 transition-colors">Confidentialité</a></li>
          <li><a href="/admin" class="text-sm text-gray-700 hover:text-gray-500 transition-colors">Espace Pro</a></li>
        </ul>
        <div class="glass rounded-2xl p-5 text-center">
          <div class="text-yellow-500 text-xs font-semibold mb-1 tracking-wide">RÉSEAU EFFICITY</div>
          <div class="text-gray-500 text-xs mb-0.5">Agent mandataire immobilier</div>
          <div class="text-gray-700 text-[10px]">Carte professionnelle n° XXXXX</div>
        </div>
      </div>
    </div>
  </div>

  <div class="border-t border-white/4 py-6">
    <div class="max-w-7xl mx-auto px-5 flex flex-col md:flex-row items-center justify-between gap-3">
      <p class="text-gray-700 text-xs">&copy; <?= date('Y') ?> Immo Vision 17. Tous droits réservés.</p>
      <p class="text-gray-800 text-[10px] tracking-wide">CHARENTE-MARITIME · DÉPARTEMENT 17</p>
    </div>
  </div>
</footer>

</body>
</html>
