<?php
header('Content-Type: application/json; charset=utf-8');

$feeds = [
  'lefaso'  => 'https://lefaso.net/spip.php?page=backend',
  'sidwaya' => 'https://www.sidwaya.bf/feed/',
];

$source = isset($_GET['source']) ? $_GET['source'] : 'lefaso';
$url = $feeds[$source] ?? $feeds['lefaso'];

$ctx = stream_context_create(['http' => ['timeout' => 8]]);
$xml = @file_get_contents($url, false, $ctx);

if (!$xml) {
  echo json_encode(['error' => 'Flux indisponible', 'items' => []]);
  exit;
}

$rss = @simplexml_load_string($xml);
if (!$rss) {
  echo json_encode(['error' => 'Erreur RSS', 'items' => []]);
  exit;
}

$items = [];
foreach ($rss->channel->item as $item) {
  // Extraire image depuis content:encoded ou description
  $content = (string)$item->children('content', true)->encoded;
  $desc    = (string)$item->description;
  $img     = '';

  // Chercher image dans content
  if (preg_match("/<img[^>]+src=['\"]([^'\"]+)['\"][^>]*>/i", $content, $m)) {
    $img = $m[1];
  }
  // Sinon dans description
  if (!$img && preg_match("/<img[^>]+src=['\"]([^'\"]+)['\"][^>]*>/i", $desc, $m)) {
    $img = $m[1];
  }

  // Nettoyer description
  $desc_clean = strip_tags(html_entity_decode($desc, ENT_QUOTES, 'UTF-8'));
  $desc_clean = preg_replace('/\s+/', ' ', trim($desc_clean));
  $desc_clean = substr($desc_clean, 0, 200);

  $date_raw = (string)$item->children('dc', true)->date ?: (string)$item->pubDate;
  $date_fmt = '';
  if ($date_raw) {
    try {
      $d = new DateTime($date_raw);
      $date_fmt = $d->format('d/m/Y H:i');
    } catch(Exception $e) {
      $date_fmt = $date_raw;
    }
  }

  $items[] = [
    'titre'  => html_entity_decode((string)$item->title, ENT_QUOTES, 'UTF-8'),
    'lien'   => (string)$item->link,
    'desc'   => $desc_clean . '...',
    'img'    => $img,
    'date'   => $date_fmt,
    'auteur' => (string)$item->children('dc', true)->creator ?: 'LeFaso.net',
  ];

  if (count($items) >= 12) break;
}

echo json_encode(['items' => $items], JSON_UNESCAPED_UNICODE);
?>
