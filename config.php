<?php
// =====================================================
//  IMMO VISION 17 — Configuration
//  Modifier les valeurs ci-dessous
// =====================================================

// Base de données LWS (espace client LWS → Bases de données)
define('DB_HOST', 'localhost');
define('DB_NAME', 'VOTRE_NOM_BASE');       // ex: immov2809623_db
define('DB_USER', 'VOTRE_USER_MYSQL');     // ex: immov2809623
define('DB_PASS', 'VOTRE_MOT_DE_PASSE');

// Site
define('SITE_URL',  'https://votre-domaine.com');  // sans slash final
define('SITE_NAME', 'Immo Vision 17');

// Agent
define('AGENT_PHONE', '06 XX XX XX XX');
define('AGENT_EMAIL', 'contact@votre-domaine.com');
define('AGENT_NAME',  'Immo Vision 17');

// Admin CRM
// Générer votre hash : php -r "echo password_hash('votre_mdp', PASSWORD_DEFAULT);"
define('ADMIN_USER', 'admin');
define('ADMIN_HASH', '$2y$10$REMPLACER_PAR_VOTRE_HASH_ICI');

// Sessions
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(['httponly' => true, 'samesite' => 'Strict']);
    session_start();
}
