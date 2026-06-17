<?php require 'conn.php'; ?>
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
  </style>
</head>
<body>
<div class="flag-stripe"></div>
<nav class="navbar">
  <a class="logo" href="accueil.php">🇧🇫 Burkina Terres d'Avenir</a>
  <nav>
    <a href="accueil.php">Accueil</a>
    <a href="regions.php">Les 17 Régions</a>
    <a href="potentiels.php">Potentiels</a>
    <a href="culture.php">Culture</a>
    <a href="apropos.php">À Propos</a>
    <a href="contact.php">Contact</a>
    <a href="messages.php" class="actif">Messages</a>
  </nav>
</nav>

<div class="container">
  <h1>📋 Messages reçus via MySQL</h1>
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
</body>
</html>
