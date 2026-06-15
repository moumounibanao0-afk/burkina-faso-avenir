<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Messages — Burkina Terres d'Avenir</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 20px; }
    .navbar { background: #008751; padding: 15px 30px; margin: -20px -20px 30px; }
    .navbar a { color: white; text-decoration: none; font-weight: bold; font-size: 18px; margin-right: 20px; }
    .container { max-width: 1000px; margin: 0 auto; }
    h1 { color: #008751; }
    table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    th { background: #008751; color: white; padding: 12px; text-align: left; }
    td { padding: 10px 12px; border-bottom: 1px solid #eee; }
    tr:last-child td { border-bottom: none; }
    tr:nth-child(even) { background: #f9f9f9; }
    .badge { background: #EF2B2D; color: white; padding: 2px 8px; border-radius: 10px; font-size: 12px; }
    .empty { text-align: center; padding: 40px; color: #888; }
  </style>
</head>
<body>
<div class="navbar">
  <a href="/">🏠 Accueil</a>
  <a href="regions.php">🗺️ Régions</a>
  <a href="contact.php">📩 Contact</a>
  <a href="messages.php">📋 Messages</a>
</div>
<div class="container">
  <h1>📋 Messages reçus via MySQL</h1>
<?php
require 'conn.php';
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
</body>
</html>
