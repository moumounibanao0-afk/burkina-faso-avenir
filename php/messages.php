<?php
require 'conn.php';
if (isset($_GET["export"]) && $_GET["export"] === "csv") {
  header("Content-Type: text/csv; charset=utf-8");
  header("Content-Disposition: attachment; filename=messages_burkina.csv");
  $out = fopen("php://output", "w");
  fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));
  fputcsv($out, ["ID","Nom","Email","Sujet","Message","Date"]);
  $r = mysqli_query($conn, "SELECT * FROM messages ORDER BY date_envoi DESC");
  while ($row = mysqli_fetch_assoc($r)) {
    fputcsv($out, [$row["id"],$row["nom"],$row["email"],$row["sujet"],$row["message"],$row["date_envoi"]]);
  }
  fclose($out);
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Messages — Burkina Terres d'Avenir</title>
  <style>
    body { font-family: Arial, sans-serif; background: #F5F0E8; margin: 0; }
    .flag-stripe { height: 6px; background: linear-gradient(90deg, #EF2B2D 50%, #009A00 50%); }
    .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .navbar .logo { color: #008751; font-size: 20px; font-weight: bold; text-decoration: none; }
    .navbar nav a { margin-left: 20px; color: #333; text-decoration: none; font-size: 14px; font-weight: bold; }
    .navbar nav a:hover, .navbar nav a.actif { color: #008751; border-bottom: 2px solid #008751; }
    .container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
    h1 { color: #008751; }
    table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    th { background: #008751; color: white; padding: 12px; text-align: left; }
    td { padding: 10px 12px; border-bottom: 1px solid #eee; font-size: 13px; }
    tr:last-child td { border-bottom: none; }
    tr:nth-child(even) { background: #f9f9f9; }
    .badge { background: #EF2B2D; color: white; padding: 2px 8px; border-radius: 10px; font-size: 12px; }
    .empty { text-align: center; padding: 40px; color: #888; background: white; border-radius: 10px; }
    footer { background: #111827; color: #aaa; text-align: center; padding: 20px; margin-top: 50px; }
  
    .dropdown { position: relative; display: inline-block; margin-left: 10px; }
    .dropbtn { color: white; border: none; padding: 8px 16px; border-radius: 20px; cursor: pointer; font-size: 13px; font-weight: bold; }
    .dropbtn.site { background: #008751; }
    .dropbtn.admin { background: #1B4F72; }
    .dropbtn:hover { opacity: 0.85; }
    .dropdown-content { display: none; position: absolute; right: 0; background: white; min-width: 180px; box-shadow: 0 4px 15px rgba(0,0,0,0.15); border-radius: 8px; z-index: 9999; overflow: hidden; margin-top: 5px; }
    .dropdown-content a { display: block; padding: 10px 15px; color: #333; text-decoration: none; font-size: 13px; border-bottom: 1px solid #f0f0f0; }
    .dropdown-content a:hover { background: #e8f5e9; color: #008751; }
    .dropdown:hover .dropdown-content { display: block; }
  
    .dropdown { position: relative; display: inline-block; margin-left: 10px; }
    .dropbtn { color: white; border: none; padding: 8px 16px; border-radius: 20px; cursor: pointer; font-size: 13px; font-weight: bold; }
    .dropbtn.site { background: #008751; }
    .dropbtn.admin { background: #1B4F72; }
    .dropbtn:hover { opacity: 0.85; }
    .dropdown-content { display: none; position: absolute; right: 0; background: white; min-width: 180px; box-shadow: 0 4px 15px rgba(0,0,0,0.15); border-radius: 8px; z-index: 9999; overflow: hidden; margin-top: 5px; }
    .dropdown-content a { display: block; padding: 10px 15px; color: #333; text-decoration: none; font-size: 13px; border-bottom: 1px solid #f0f0f0; }
    .dropdown-content a:hover { background: #e8f5e9; color: #008751; }
    .dropdown:hover .dropdown-content { display: block; }
  </style>
</head>
<body>
<div class="flag-stripe"></div>
<nav class="navbar">
  <a class="logo" href="accueil.php">🇧🇫 Burkina Terres d'Avenir</a>
  <nav style="display:flex;justify-content:center;align-items:center;gap:10px;flex-wrap:wrap">
    <div class="dropdown">
      <button class="dropbtn site">🌐 Site ▾</button>
      <div class="dropdown-content">
        <a href="accueil.php">🏠 Accueil</a>
        <a href="regions.php">🗺️ Les 17 Régions</a>
        <a href="carte.php">📍 Carte Interactive</a>
        <a href="potentiels.php">⚡ Potentiels</a>
        <a href="culture.php">🎭 Culture</a>
        <a href="meteo.php">🌤️ Météo</a>
        <a href="actualites.php">📰 Actualités</a>
        <a href="recherche.php">🔍 Recherche</a>
        <a href="apropos.php">ℹ️ À Propos</a>
        <a href="contact.php">📩 Contact</a>
      </div>
    </div>
    <a href="index.php" style="background:#EF2B2D;color:white;padding:8px 16px;border-radius:20px;text-decoration:none;font-size:13px;font-weight:bold">🏠 Accueil</a>
  </nav>
</nav>

<div class="container">
  <h1>📋 Messages reçus via MySQL</h1>
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:15px">
    <a href="messages.php?export=csv" style="background:#008751;color:white;padding:10px 20px;border-radius:20px;text-decoration:none;font-weight:bold;font-size:13px">📥 Exporter en CSV</a>
  </div>
<?php
$result = mysqli_query($conn, 'SELECT * FROM messages ORDER BY date_envoi DESC');
$nb = mysqli_num_rows($result);
echo '<p>Total : <strong>' . $nb . ' message(s)</strong></p>';

if ($nb > 0) {
  echo '<table>';
  echo '<tr><th>ID</th><th>Nom</th><th>Email</th><th>Sujet</th><th>Message</th><th>Date</th></tr>';
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td><span class="badge">' . $row['id'] . '</span></td>';
    echo '<td>' . htmlspecialchars($row['nom']) . '</td>';
    echo '<td>' . htmlspecialchars($row['email']) . '</td>';
    echo '<td>' . htmlspecialchars($row['sujet']) . '</td>';
    echo '<td>' . htmlspecialchars($row['message']) . '</td>';
    echo '<td>' . $row['date_envoi'] . '</td>';
    echo '</tr>';
  }
  echo '</table>';
} else {
  echo '<div class="empty">Aucun message pour le moment.<br>
        <a href="contact.php">Envoyer un message</a></div>';
}
mysqli_close($conn);
?>
</div>

<footer>🇧🇫 Burkina Terres d'Avenir — Projet L3 Web Dynamique PHP + MySQL</footer>
<script src="commun.js"></script>
</body>
</html>
