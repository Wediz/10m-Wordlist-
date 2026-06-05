<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
requireAdmin();

// Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'move_deal') {
        $stmt = $pdo->prepare('UPDATE crm_deals SET stage = ? WHERE id = ?');
        $stmt->execute([$_POST['stage'], intval($_POST['id'])]);
    }
    if ($_POST['action'] === 'add_deal') {
        $stmt = $pdo->prepare('INSERT INTO crm_deals (title,client_name,client_email,client_phone,value,stage,priority) VALUES (?,?,?,?,?,?,?)');
        $stmt->execute([$_POST['title'],$_POST['client_name'],$_POST['client_email'],$_POST['client_phone'],floatval($_POST['value']),$_POST['stage'],$_POST['priority']]);
    }
    if ($_POST['action'] === 'update_status_contact') {
        $stmt = $pdo->prepare('UPDATE contact_messages SET status = ? WHERE id = ?');
        $stmt->execute([$_POST['status'], intval($_POST['id'])]);
    }
    header('Location: /admin');
    exit;
}

// Données
$deals     = $pdo->query('SELECT * FROM crm_deals ORDER BY updated_at DESC')->fetchAll();
$contacts  = $pdo->query('SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 20')->fetchAll();
$leads     = $pdo->query('SELECT * FROM estimation_leads ORDER BY created_at DESC LIMIT 20')->fetchAll();
$unread    = $pdo->query('SELECT COUNT(*) FROM contact_messages WHERE status = "unread"')->fetchColumn();
$totalDeals= array_sum(array_column($deals,'value'));

$pageTitle = 'CRM Dashboard — Immo Vision 17';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $pageTitle ?></title>
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
body{background:#0d0e13;font-family:Inter,sans-serif;color:#e5e7eb}
.glass{background:rgba(255,255,255,.04);backdrop-filter:blur(16px);border:1px solid rgba(255,255,255,.08);border-radius:1rem}
.glass-gold{background:rgba(212,175,55,.06);border:1px solid rgba(212,175,55,.2);border-radius:1rem}
.text-gradient{background:linear-gradient(135deg,#D4AF37,#FFD740,#b8960c);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.btn-gold{background:linear-gradient(135deg,#D4AF37,#FFD740,#b8960c);color:#0d0e13;font-weight:700;padding:.5rem 1rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.8rem;display:inline-flex;align-items:center;gap:.25rem}
.btn-sm{padding:.375rem .75rem;font-size:.75rem;border-radius:.5rem;border:none;cursor:pointer;font-weight:600}
.input-sm{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:.5rem;padding:.375rem .75rem;color:#fff;font-size:.8rem;outline:none}
select.input-sm option{background:#1a1b22}
</style>
</head>
<body class="min-h-screen">

<!-- Header admin -->
<header style="background:rgba(13,14,19,.95);backdrop-filter:blur(20px)" class="border-b border-yellow-900/30 sticky top-0 z-50">
  <div class="max-w-full px-6 h-16 flex items-center justify-between">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center text-black font-bold text-xs">IV</div>
      <span class="text-white font-bold">Immo Vision 17</span>
      <span class="text-gray-600 text-sm">— CRM</span>
    </div>
    <div class="flex items-center gap-4">
      <?php if ($unread): ?><span class="bg-red-600 text-white text-xs px-2 py-1 rounded-full"><?= $unread ?> non lu<?= $unread > 1 ? 's' : '' ?></span><?php endif; ?>
      <a href="/" class="text-gray-400 text-sm hover:text-white">&#127968; Site</a>
      <a href="/admin/logout.php" class="text-gray-500 text-sm hover:text-red-400">🚪 Déconnexion</a>
    </div>
  </div>
</header>

<div class="p-6">

  <!-- Stats -->
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <?php foreach ([
      ['🏠','Affaires actives', count($deals),''],
      ['💬','Messages non lus', $unread, 'bg-red-900/20'],
      ['📧','Leads estimation', count($leads),''],
      ['💰','CA en cours', formatPrice($totalDeals),'bg-yellow-900/20'],
    ] as [$icon,$lbl,$val,$bg]): ?>
    <div class="glass p-5 <?= $bg ?>">
      <div class="text-2xl mb-2"><?= $icon ?></div>
      <div class="text-2xl font-bold text-white"><?= is_numeric($val) ? $val : $val ?></div>
      <div class="text-gray-400 text-sm"><?= $lbl ?></div>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Pipeline Kanban -->
  <div x-data="{addModal: false}" class="mb-10">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl font-bold text-white">&#127757; Pipeline</h2>
      <button @click="addModal = true" class="btn-gold">+ Nouvelle affaire</button>
    </div>

    <!-- Kanban -->
    <div class="overflow-x-auto">
      <div class="flex gap-4 pb-4" style="min-width:max-content">
        <?php foreach ($CRM_STAGES as $stageId => $stage):
          $stageDeals = array_filter($deals, fn($d) => $d['stage'] === $stageId);
          $stageTotal = array_sum(array_column(iterator_to_array($stageDeals), 'value'));
        ?>
        <div class="w-64 flex-shrink-0">
          <div class="flex items-center justify-between mb-3">
            <div class="flex items-center gap-2">
              <div class="w-2 h-2 rounded-full" style="background:<?= $stage['color'] ?>"></div>
              <span class="text-white text-sm font-medium"><?= htmlspecialchars($stage['label']) ?></span>
              <span class="text-gray-600 text-xs">(<?= count(iterator_to_array($stageDeals)) ?>)</span>
            </div>
            <span class="text-yellow-400 text-xs"><?= $stageTotal ? formatPrice($stageTotal) : '' ?></span>
          </div>
          <div class="space-y-3 min-h-32">
            <?php foreach ($stageDeals as $deal): ?>
            <div class="glass p-4 rounded-xl">
              <div class="flex justify-between items-start mb-2">
                <h4 class="text-white text-sm font-medium"><?= htmlspecialchars($deal['title']) ?></h4>
                <span class="w-2 h-2 rounded-full mt-1 flex-shrink-0 <?= $deal['priority'] === 'high' ? 'bg-red-500' : ($deal['priority'] === 'medium' ? 'bg-yellow-500' : 'bg-gray-500') ?>"></span>
              </div>
              <p class="text-gray-400 text-xs mb-1"><?= htmlspecialchars($deal['client_name']) ?></p>
              <p class="text-yellow-400 text-sm font-bold mb-2"><?= formatPrice($deal['value']) ?></p>
              <?php if ($deal['next_action']): ?>
              <p class="text-gray-500 text-xs border-t border-white/5 pt-2">→ <?= htmlspecialchars($deal['next_action']) ?></p>
              <?php endif; ?>
              <!-- Déplacer l'affaire -->
              <form method="POST" class="mt-3">
                <input type="hidden" name="action" value="move_deal">
                <input type="hidden" name="id" value="<?= $deal['id'] ?>">
                <select name="stage" onchange="this.form.submit()" class="input-sm w-full">
                  <?php foreach ($CRM_STAGES as $sid => $sl): ?>
                  <option value="<?= $sid ?>" <?= $sid === $deal['stage'] ? 'selected' : '' ?>><?= htmlspecialchars($sl['label']) ?></option>
                  <?php endforeach; ?>
                </select>
              </form>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Modal nouvelle affaire -->
    <div x-show="addModal" x-transition class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4" @click.self="addModal = false">
      <div class="glass rounded-2xl p-8 w-full max-w-lg" @click.stop>
        <h3 class="text-white font-bold mb-6">Nouvelle affaire</h3>
        <form method="POST" class="space-y-4">
          <input type="hidden" name="action" value="add_deal">
          <input type="text" name="title" required class="input-sm w-full" placeholder="Titre (ex: Villa Royan)">
          <div class="grid grid-cols-2 gap-3">
            <input type="text" name="client_name" required class="input-sm w-full" placeholder="Nom client">
            <input type="text" name="client_phone" class="input-sm w-full" placeholder="Téléphone">
          </div>
          <input type="email" name="client_email" class="input-sm w-full" placeholder="Email">
          <div class="grid grid-cols-2 gap-3">
            <input type="number" name="value" required class="input-sm w-full" placeholder="Valeur (€)">
            <select name="priority" class="input-sm w-full">
              <option value="low">Priorité basse</option>
              <option value="medium" selected>Priorité moyenne</option>
              <option value="high">Priorité haute</option>
            </select>
          </div>
          <select name="stage" class="input-sm w-full">
            <?php foreach ($CRM_STAGES as $sid => $sl): ?>
            <option value="<?= $sid ?>"><?= htmlspecialchars($sl['label']) ?></option>
            <?php endforeach; ?>
          </select>
          <div class="flex gap-3 justify-end">
            <button type="button" @click="addModal = false" class="btn-sm" style="background:rgba(255,255,255,.05);color:#9ca3af">Annuler</button>
            <button type="submit" class="btn-gold">+ Ajouter</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Messages & Leads -->
  <div class="grid lg:grid-cols-2 gap-8">

    <!-- Messages contact -->
    <div>
      <h2 class="text-xl font-bold text-white mb-4">📬 Messages contact</h2>
      <div class="space-y-3">
        <?php foreach (array_slice($contacts, 0, 8) as $msg): ?>
        <div class="glass p-4 rounded-xl <?= $msg['status'] === 'unread' ? 'border border-yellow-900/40' : '' ?>">
          <div class="flex items-start justify-between">
            <div>
              <span class="text-white font-medium text-sm"><?= htmlspecialchars($msg['first_name'] . ' ' . $msg['last_name']) ?></span>
              <?php if ($msg['status'] === 'unread'): ?>
              <span class="ml-2 w-2 h-2 bg-yellow-400 rounded-full inline-block"></span>
              <?php endif; ?>
              <p class="text-gray-400 text-xs"><?= htmlspecialchars($msg['email']) ?> • <?= htmlspecialchars($msg['subject']) ?></p>
              <p class="text-gray-300 text-sm mt-2 line-clamp-2"><?= htmlspecialchars($msg['message']) ?></p>
            </div>
          </div>
          <div class="flex items-center justify-between mt-3">
            <span class="text-gray-600 text-xs"><?= formatDate($msg['created_at']) ?></span>
            <div class="flex gap-2">
              <a href="mailto:<?= htmlspecialchars($msg['email']) ?>" class="btn-sm" style="background:rgba(212,175,55,.15);color:#D4AF37">Répondre</a>
              <?php if ($msg['status'] === 'unread'): ?>
              <form method="POST" style="display:inline">
                <input type="hidden" name="action" value="update_status_contact">
                <input type="hidden" name="id" value="<?= $msg['id'] ?>">
                <input type="hidden" name="status" value="read">
                <button class="btn-sm" style="background:rgba(255,255,255,.05);color:#6b7280">✓ Lu</button>
              </form>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
        <?php if (empty($contacts)): ?><p class="text-gray-500 text-sm">Aucun message.</p><?php endif; ?>
      </div>
    </div>

    <!-- Leads estimation -->
    <div>
      <h2 class="text-xl font-bold text-white mb-4">🏠 Demandes d'estimation</h2>
      <div class="space-y-3">
        <?php foreach (array_slice($leads, 0, 8) as $lead): ?>
        <div class="glass p-4 rounded-xl">
          <div class="flex justify-between items-start">
            <div>
              <span class="text-white font-medium text-sm"><?= htmlspecialchars($lead['first_name'] . ' ' . $lead['last_name']) ?></span>
              <p class="text-gray-400 text-xs"><?= htmlspecialchars($lead['email']) ?> • <?= htmlspecialchars($lead['phone']) ?></p>
              <p class="text-gray-300 text-sm mt-1">
                <?= htmlspecialchars($lead['property_type']) ?> — <?= htmlspecialchars($lead['city']) ?> — <?= $lead['surface'] ?>m²
              </p>
            </div>
            <span class="text-xs px-2 py-1 rounded-full <?= $lead['status'] === 'pending' ? 'bg-yellow-900/30 text-yellow-400' : 'bg-green-900/30 text-green-400' ?>">
              <?= $lead['status'] === 'pending' ? 'En attente' : 'Contacté' ?>
            </span>
          </div>
          <div class="flex justify-between items-center mt-3">
            <span class="text-gray-600 text-xs"><?= formatDate($lead['created_at']) ?></span>
            <a href="tel:<?= htmlspecialchars($lead['phone']) ?>" class="btn-sm" style="background:rgba(212,175,55,.15);color:#D4AF37">📞 Appeler</a>
          </div>
        </div>
        <?php endforeach; ?>
        <?php if (empty($leads)): ?><p class="text-gray-500 text-sm">Aucune demande.</p><?php endif; ?>
      </div>
    </div>
  </div>
</div>

</body>
</html>
