<?php
// Script à appeler en CLI pour rafraîchir le cache RSS
// Usage: php refresh_cache.php

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

$last = strrpos($data, '</item>');
if ($last !== false) {
  $data = substr($data, 0, $last + 7) . '</channel></rss>';
}
$data = preg_replace('/xmlns:[^=]+="[^"]*"/', '', $data);
libxml_use_internal_errors(true);
$rss = simplexml_load_string($data);

$items = [];
foreach ($rss->channel->item as $item) {
  $desc = (string)$item->description;
  $img  = '';
  if (preg_match("/<img[^>]+src=['\"]([^'\"]+)['\"][^>]*>/i", $desc, $m)) {
    $img = $m[1];
  }
  $desc_clean = strip_tags(html_entity_decode($desc, ENT_QUOTES, 'UTF-8'));
  $desc_clean = mb_convert_encoding(substr(preg_replace('/\s+/', ' ', trim($desc_clean)), 0, 200), 'UTF-8', 'UTF-8');
  $titre = mb_convert_encoding(html_entity_decode((string)$item->title, ENT_QUOTES, 'UTF-8'), 'UTF-8', 'UTF-8');
  if (empty($titre)) continue;
  $date_raw = (string)$item->pubDate;
  $date_fmt = '';
  if ($date_raw) {
    try { $date_fmt = (new DateTime($date_raw))->format('d/m/Y H:i'); }
    catch(Exception $e) { $date_fmt = ''; }
  }
  $items[] = [
    'titre'  => $titre,
    'lien'   => (string)$item->link,
    'desc'   => $desc_clean . '...',
    'img'    => $img,
    'date'   => $date_fmt,
    'auteur' => 'LeFaso.net',
  ];
  if (count($items) >= 12) break;
}

$result = json_encode(
  ['items' => $items, 'total' => count($items), 'cached_at' => date('H:i')],
  JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE
);
file_put_contents($cache_file, $result);
echo "Cache mis à jour: " . count($items) . " articles à " . date('H:i') . "\n";
