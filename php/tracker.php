<?php
/**
 * tracker.php — enregistre une visite de page pour le suivi admin.
 * À inclure juste après conn.php sur chaque page publique.
 * Nécessite que $conn (connexion mysqli) soit déjà défini.
 *
 * IMPORTANT : entouré d'un try/catch pour ne JAMAIS faire planter une page,
 * même si la table n'existe pas encore ou si la requête échoue.
 */
try {
  if (isset($conn) && $conn) {
    $page_actuelle = basename($_SERVER['PHP_SELF']);
    $ip_visiteur = $_SERVER['REMOTE_ADDR'] ?? 'inconnu';
    $page_safe = mysqli_real_escape_string($conn, $page_actuelle);
    $ip_safe = mysqli_real_escape_string($conn, $ip_visiteur);
    @mysqli_query($conn, "INSERT INTO visites_site (page, ip) VALUES ('$page_safe', '$ip_safe')");
  }
} catch (\Throwable $e) {
  // On ignore silencieusement toute erreur : le suivi des visites ne doit
  // jamais empêcher l'affichage normal de la page.
}
