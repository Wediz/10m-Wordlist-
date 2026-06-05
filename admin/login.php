<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/functions.php';

if (isAdminLoggedIn()) { redirect('/admin'); }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? '');
    $pass = $_POST['password'] ?? '';
    if ($user === ADMIN_USER && password_verify($pass, ADMIN_HASH)) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user']      = $user;
        redirect('/admin');
    } else {
        $error = 'Identifiants incorrects.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Connexion Admin — Immo Vision 17</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
body{background:#0d0e13;font-family:Inter,sans-serif}
.glass{background:rgba(255,255,255,.04);backdrop-filter:blur(16px);border:1px solid rgba(255,255,255,.08);border-radius:1.5rem}
.input-field{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:.75rem;padding:.75rem 1rem;color:#fff;width:100%;outline:none}
.input-field:focus{border-color:rgba(212,175,55,.5)}
.btn-gold{background:linear-gradient(135deg,#D4AF37,#FFD740,#b8960c);color:#0d0e13;font-weight:700;padding:.875rem;border-radius:.75rem;width:100%;border:none;cursor:pointer;font-size:.9rem}
.text-gradient{background:linear-gradient(135deg,#D4AF37,#FFD740,#b8960c);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
</style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
<div class="w-full max-w-md">
  <div class="text-center mb-8">
    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center mx-auto mb-4">
      <span class="text-black font-bold text-lg">IV</span>
    </div>
    <h1 class="text-2xl font-bold text-white">Espace <span class="text-gradient">Pro</span></h1>
    <p class="text-gray-500 text-sm mt-1">Accès réservé au consultant</p>
  </div>

  <div class="glass p-8">
    <?php if ($error): ?>
    <div class="bg-red-900/30 border border-red-800/50 rounded-xl p-3 mb-6 text-red-400 text-sm text-center">
      ⚠️ <?= htmlspecialchars($error) ?>
    </div>
    <?php endif; ?>

    <form method="POST" class="space-y-5">
      <div>
        <label class="text-gray-400 text-sm block mb-2">Identifiant</label>
        <input type="text" name="username" autocomplete="username" required class="input-field" placeholder="admin">
      </div>
      <div>
        <label class="text-gray-400 text-sm block mb-2">Mot de passe</label>
        <input type="password" name="password" autocomplete="current-password" required class="input-field" placeholder="••••••••">
      </div>
      <button type="submit" class="btn-gold">🔓 Se connecter</button>
    </form>

    <p class="text-gray-600 text-xs text-center mt-6">
      Générer votre hash :<br>
      <code class="text-gray-500">php -r "echo password_hash('mdp', PASSWORD_DEFAULT);"</code>
    </p>
  </div>
</div>
</body>
</html>
