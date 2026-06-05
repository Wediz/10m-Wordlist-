<?php

function formatPrice(float $price): string {
    return number_format($price, 0, ',', '\u{202F}') . '\u{202F}€';
}

function formatSurface(float $s): string {
    return number_format($s, 0, ',', '\u{202F}') . '\u{a0}m²';
}

function formatDate(string $date): string {
    $months = ['janvier','février','mars','avril','mai','juin',
               'juillet','août','septembre','octobre','novembre','décembre'];
    $t = strtotime($date);
    return intval(date('j', $t)) . ' ' . $months[intval(date('n', $t))-1] . ' ' . date('Y', $t);
}

function getDPEClass(string $dpe): string {
    return 'dpe-' . strtolower($dpe);
}

function isAdminLoggedIn(): bool {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function requireAdmin(): void {
    if (!isAdminLoggedIn()) {
        header('Location: /admin/login');
        exit;
    }
}

function sanitize(string $str): string {
    return htmlspecialchars(strip_tags(trim($str)), ENT_QUOTES, 'UTF-8');
}

function jsonResponse(array $data, int $code = 200): void {
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

function redirect(string $url): void {
    header('Location: ' . $url);
    exit;
}

$SEO_CITIES = [
    ['slug'=>'saintes',           'name'=>'Saintes',              'avg_price'=>'2 200', 'evolution'=>'+3.2%', 'properties'=>24],
    ['slug'=>'rochefort',         'name'=>'Rochefort',            'avg_price'=>'1 950', 'evolution'=>'+2.8%', 'properties'=>18],
    ['slug'=>'royan',             'name'=>'Royan',                'avg_price'=>'3 800', 'evolution'=>'+5.1%', 'properties'=>31],
    ['slug'=>'saint-jean-angely', 'name'=>"Saint-Jean-d'Angély",  'avg_price'=>'1 750', 'evolution'=>'+2.1%', 'properties'=>12],
    ['slug'=>'cognac',            'name'=>'Cognac',               'avg_price'=>'2 100', 'evolution'=>'+3.5%', 'properties'=>15],
    ['slug'=>'jonzac',            'name'=>'Jonzac',               'avg_price'=>'1 550', 'evolution'=>'+1.8%', 'properties'=>8],
    ['slug'=>'pons',              'name'=>'Pons',                 'avg_price'=>'1 650', 'evolution'=>'+2.3%', 'properties'=>9],
    ['slug'=>'saint-porchaire',   'name'=>'Saint-Porchaire',      'avg_price'=>'2 050', 'evolution'=>'+2.9%', 'properties'=>6],
];

$PROPERTY_TYPES = [
    'maison'         => 'Maison',
    'appartement'    => 'Appartement',
    'terrain'        => 'Terrain',
    'commerce'       => 'Local commercial',
    'chateau'        => 'Château / Propriété',
    'investissement' => 'Investissement locatif',
];

$CRM_STAGES = [
    'prospect'    => ['label'=>'Prospect',          'color'=>'#6B7280'],
    'contact'     => ['label'=>'Premier contact',   'color'=>'#3B82F6'],
    'visite'      => ['label'=>'Visite planifiée',  'color'=>'#F59E0B'],
    'negociation' => ['label'=>'Négociation',       'color'=>'#8B5CF6'],
    'compromis'   => ['label'=>'Compromis signé',   'color'=>'#EC4899'],
    'financement' => ['label'=>'Financement',       'color'=>'#14B8A6'],
    'acte'        => ['label'=>'Acte authentique',  'color'=>'#D4AF37'],
];
