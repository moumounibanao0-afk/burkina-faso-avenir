<?php
require 'conn.php';
header('Content-Type: application/json; charset=utf-8');

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if (strlen($q) < 2) {
  echo json_encode(['regions'=>[],'provinces'=>[],'cultures'=>[],'potentiels'=>[]]);
  exit;
}

$q_safe = '%' . mysqli_real_escape_string($conn, $q) . '%';
$data = [];

// Recherche régions
$r = mysqli_query($conn, "SELECT id, nom, chef_lieu, zone, image_url FROM regions
  WHERE nom LIKE '$q_safe' OR chef_lieu LIKE '$q_safe' OR zone LIKE '$q_safe'
  OR description LIKE '$q_safe' OR peuples LIKE '$q_safe' OR potentiels LIKE '$q_safe'
  ORDER BY nom LIMIT 10");
$data['regions'] = [];
while ($row = mysqli_fetch_assoc($r)) $data['regions'][] = $row;

// Recherche provinces — avec id de la région
$r = mysqli_query($conn, "SELECT p.id, p.nom, p.chef_lieu, p.region_nom,
  r.id as region_id
  FROM provinces p
  LEFT JOIN regions r ON r.nom = p.region_nom
  WHERE p.nom LIKE '$q_safe' OR p.chef_lieu LIKE '$q_safe' OR p.region_nom LIKE '$q_safe'
  ORDER BY p.nom LIMIT 10");
$data['provinces'] = [];
while ($row = mysqli_fetch_assoc($r)) $data['provinces'][] = $row;

// Recherche cultures
$r = mysqli_query($conn, "SELECT id, type, nom, description, region, image_url FROM cultures
  WHERE nom LIKE '$q_safe' OR description LIKE '$q_safe' OR region LIKE '$q_safe' OR type LIKE '$q_safe'
  ORDER BY nom LIMIT 10");
$data['cultures'] = [];
while ($row = mysqli_fetch_assoc($r)) $data['cultures'][] = $row;

// Recherche potentiels
$r = mysqli_query($conn, "SELECT id, categorie, titre, description, icone, image_url FROM potentiels
  WHERE titre LIKE '$q_safe' OR description LIKE '$q_safe' OR categorie LIKE '$q_safe'
  ORDER BY titre LIMIT 10");
$data['potentiels'] = [];
while ($row = mysqli_fetch_assoc($r)) $data['potentiels'][] = $row;

mysqli_close($conn);
echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>
