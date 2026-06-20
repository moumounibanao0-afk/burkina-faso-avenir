<?php
/**
 * tracker.php — enregistre une visite de page pour le suivi admin.
 * À inclure juste après conn.php sur chaque page publique.
 * Nécessite que $conn (connexion mysqli) soit déjà défini.
 */
if (isset($conn)) {
  $page_actuelle = basename($_SERVER['PHP_SELF']);
  $ip_visiteur = $_SERVER['REMOTE_ADDR'] ?? 'inconnu';
  $page_safe = mysqli_real_escape_string($conn, $page_actuelle);
  $ip_safe = mysqli_real_escape_string($conn, $ip_visiteur);
  mysqli_query($conn, "INSERT INTO visites_site (page, ip) VALUES ('$page_safe', '$ip_safe')");
}
