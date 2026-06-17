<?php
$url = 'https://lefaso.net/spip.php?page=backend';
$tmpfile = '/tmp/rss_raw.xml';
$cache_file = '/tmp/burkina_rss_cache.json';

echo "Téléchargement RSS LeFaso.net...\n";
$fp = fopen($tmpfile, 'w');
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, function($ch, $dltotal, $dlnow, $ultotal, $ulnow) {
  return ($dlnow > 130000) ? 1 : 0;
});
curl_setopt($ch, CURLOPT_NOPROGRESS, false);
curl_exec($ch);
fclose($fp);
curl_close($ch);

$data = file_get_contents($tmpfile);
echo "Téléchargé: " . strlen($data) . " bytes\n";

// Extraire les dates dc:date avant de supprimer les namespaces
preg_match_all('|<dc:date>([^<]+)</dc:date>|', $data, $dc_dates);
preg_match_all('|<dc:creator>([^<]+)</dc:creator>|', $data, $dc_creators);

$last = strrpos($data, '</item>');
if ($last !== false) {
  $data = substr($data, 0, $last + 7) . '</channel></rss>';
}
$data = preg_replace('/xmlns:[^=]+="[^"]*"/', '', $data);
libxml_use_internal_errors(true);
$rss = simplexml_load_string($data);

$items = [];
$idx = 0;
foreach ($rss->channel->item as $item) {
  $desc = (string)$item->description;
  $img  = '';
  if (preg_match("/<img[^>]+src=['\"]([^'\"]+)['\"][^>]*>/i", $desc, $m)) {
    $img = $m[1];
  }
  $desc_clean = strip_tags(html_entity_decode($desc, ENT_QUOTES, 'UTF-8'));
  $desc_clean = mb_convert_encoding(substr(preg_replace('/\s+/', ' ', trim($desc_clean)), 0, 200), 'UTF-8', 'UTF-8');

  $titre = mb_convert_encoding(html_entity_decode((string)$item->title, ENT_QUOTES, 'UTF-8'), 'UTF-8', 'UTF-8');
  if (empty($titre)) { $idx++; continue; }

  // Date depuis dc:date ou pubDate
  $date_fmt = '';
  if (!empty($dc_dates[1][$idx])) {
    try { $date_fmt = (new DateTime($dc_dates[1][$idx]))->format('d/m/Y H:i'); }
    catch(Exception $e) { $date_fmt = ''; }
  }

  // Auteur depuis dc:creator
  $auteur = !empty($dc_creators[1][$idx]) ? $dc_creators[1][$idx] : 'LeFaso.net';

  // Catégorie pour les filtres
  $titre_lower = mb_strtolower($titre, 'UTF-8');
  $desc_lower  = mb_strtolower($desc_clean, 'UTF-8');
  $categorie = 'general';
  if (str_contains($titre_lower, 'burkina') || str_contains($titre_lower, 'ouagadougou') || str_contains($titre_lower, 'faso')) {
    $categorie = 'burkina';
  } elseif (str_contains($titre_lower, 'culture') || str_contains($titre_lower, 'art') || str_contains($titre_lower, 'festival') || str_contains($titre_lower, 'musique')) {
    $categorie = 'culture';
  } elseif (str_contains($titre_lower, 'économi') || str_contains($titre_lower, 'economi') || str_contains($titre_lower, 'mine') || str_contains($titre_lower, 'agriculture') || str_contains($titre_lower, 'fcfa')) {
    $categorie = 'economie';
  } elseif (str_contains($titre_lower, 'sport') || str_contains($titre_lower, 'foot') || str_contains($titre_lower, 'coupe') || str_contains($titre_lower, 'match') || str_contains($titre_lower, 'cyclisme')) {
    $categorie = 'sport';
  } elseif (str_contains($titre_lower, 'sécuri') || str_contains($titre_lower, 'securit') || str_contains($titre_lower, 'attaque') || str_contains($titre_lower, 'armée') || str_contains($titre_lower, 'armé')) {
    $categorie = 'securite';
  } elseif (str_contains($titre_lower, 'santé') || str_contains($titre_lower, 'sante') || str_contains($titre_lower, 'médical') || str_contains($titre_lower, 'hôpital') || str_contains($titre_lower, 'maladie')) {
    $categorie = 'sante';
  }

  $items[] = [
    'titre'     => $titre,
    'lien'      => (string)$item->link,
    'desc'      => $desc_clean . '...',
    'img'       => $img,
    'date'      => $date_fmt,
    'auteur'    => $auteur,
    'categorie' => $categorie,
  ];

  $idx++;
  if (count($items) >= 12) break;
}

$result = json_encode(
  ['items' => $items, 'total' => count($items), 'cached_at' => date('H:i')],
  JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE
);

file_put_contents($cache_file, $result);
echo "Cache mis à jour: " . count($items) . " articles à " . date('H:i') . "\n";

// Afficher résumé
foreach ($items as $a) {
  echo "  [{$a['categorie']}] {$a['date']} — {$a['titre']}\n";
}
