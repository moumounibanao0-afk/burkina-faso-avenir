<?php require 'conn.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>À Propos — Burkina Terres d'Avenir</title>
  <style>
    body { font-family: Arial, sans-serif; background: #F5F0E8; margin: 0; }
    .flag-stripe { height: 6px; background: linear-gradient(90deg, #EF2B2D 50%, #009A00 50%); }
    .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .navbar .logo { color: #008751; font-size: 20px; font-weight: bold; text-decoration: none; }
    .navbar nav a { margin-left: 20px; color: #333; text-decoration: none; font-size: 14px; font-weight: bold; }
    .navbar nav a:hover, .navbar nav a.actif { color: #008751; border-bottom: 2px solid #008751; }
    .hero { background: linear-gradient(135deg, #1B4F72, #00A1D6); color: white; padding: 60px 30px; text-align: center; }
    .hero h1 { font-size: 42px; margin-bottom: 10px; }
    .hero p { font-size: 16px; opacity: 0.9; }
    .container { max-width: 900px; margin: 40px auto; padding: 0 20px; }
    .section-title { color: #008751; font-size: 26px; border-left: 5px solid #E8B923; padding-left: 15px; margin: 40px 0 20px; }
    .card { background: white; border-radius: 12px; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); margin-bottom: 20px; }
    .card h3 { color: #008751; margin: 0 0 10px; }
    .card p { color: #555; line-height: 1.7; }
    .team { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; }
    .member { background: white; border-radius: 12px; padding: 25px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-top: 4px solid #008751; }
    .member .avatar { width: 70px; height: 70px; border-radius: 50%; background: #008751; color: white; font-size: 28px; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; }
    .member h3 { color: #333; margin: 0 0 5px; }
    .member p { color: #888; font-size: 13px; }
    .tech-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; }
    .tech { background: white; border-radius: 10px; padding: 20px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    .tech .icon { font-size: 32px; margin-bottom: 10px; }
    .tech h4 { color: #333; margin: 0 0 5px; }
    .tech p { color: #888; font-size: 12px; margin: 0; }
    .stats { display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; margin: 20px 0; }
    .stat { background: white; padding: 20px 30px; border-radius: 12px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    .stat strong { display: block; font-size: 28px; color: #008751; }
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
    <a href="apropos.php" class="actif">À Propos</a>
    <a href="contact.php">Contact</a>
  </nav>
</nav>

<div class="hero">
  <h1>ℹ️ À Propos du Projet</h1>
  <p>Burkina Terres d'Avenir — Projet académique L3 Informatique — UNZ 2025-2026</p>
</div>

<?php
// Statistiques dynamiques depuis MySQL
$nb_regions   = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM regions"))[0];
$nb_potentiels= mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM potentiels"))[0];
$nb_cultures  = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM cultures"))[0];
$nb_messages  = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM messages"))[0];
?>

<div class="container">

  <div class="stats">
    <div class="stat"><strong><?php echo $nb_regions; ?></strong><span>Régions documentées</span></div>
    <div class="stat"><strong><?php echo $nb_potentiels; ?></strong><span>Potentiels recensés</span></div>
    <div class="stat"><strong><?php echo $nb_cultures; ?></strong><span>Éléments culturels</span></div>
    <div class="stat"><strong><?php echo $nb_messages; ?></strong><span>Messages reçus</span></div>
  </div>

  <h2 class="section-title">🎯 Objectif du Projet</h2>
  <div class="card">
    <p>
      <strong>Burkina Terres d'Avenir</strong> est un projet web académique réalisé dans le cadre du cours
      <em>Web Dynamique</em> (UE — 3 crédits) en Licence 3 Informatique à l'Université Norbert Zongo (UNZ),
      année académique 2025-2026.
    </p>
    <p style="margin-top:15px">
      L'objectif est de <strong>valoriser les 17 régions du Burkina Faso</strong> à travers un site web dynamique
      connecté à une base de données MySQL, démontrant la transformation d'un site statique HTML/CSS
      en une application web dynamique PHP+MySQL conforme aux exigences du cours.
    </p>
  </div>

  <h2 class="section-title">👥 Équipe du Projet</h2>
  <div class="team">
    <div class="member">
      <div class="avatar">👨‍💻</div>
      <h3>BANAO Moumouni</h3>
      <p>Développeur principal</p>
      <p style="color:#008751;font-weight:bold">L3 Informatique — UNZ</p>
    </div>
    <div class="member">
      <div class="avatar">👨‍💻</div>
      <h3>YAMWEMBA Oumar</h3>
      <p>Développeur</p>
      <p style="color:#008751;font-weight:bold">L3 Informatique — UNZ</p>
    </div>
  </div>

  <h2 class="section-title">🛠️ Technologies Utilisées</h2>
  <div class="tech-grid">
    <div class="tech"><div class="icon">🐘</div><h4>PHP 8.5</h4><p>Langage serveur</p></div>
    <div class="tech"><div class="icon">🗄️</div><h4>MySQL</h4><p>Base de données</p></div>
    <div class="tech"><div class="icon">🌐</div><h4>HTML/CSS</h4><p>Frontend</p></div>
    <div class="tech"><div class="icon">⚡</div><h4>Node.js</h4><p>API REST (Render)</p></div>
    <div class="tech"><div class="icon">🐙</div><h4>GitHub</h4><p>Versioning</p></div>
    <div class="tech"><div class="icon">☁️</div><h4>Render</h4><p>Déploiement</p></div>
  </div>

  <h2 class="section-title">📚 Transformation Statique → Dynamique</h2>
  <div class="card">
    <table style="width:100%;border-collapse:collapse">
      <tr style="background:#008751;color:white">
        <th style="padding:10px;text-align:left">Site Statique</th>
        <th style="padding:10px;text-align:left">Site Dynamique PHP</th>
      </tr>
      <tr style="border-bottom:1px solid #eee">
        <td style="padding:10px">acceuil.html — données codées en dur</td>
        <td style="padding:10px">accueil.php — SELECT * FROM regions (MySQL)</td>
      </tr>
      <tr style="border-bottom:1px solid #eee;background:#f9f9f9">
        <td style="padding:10px">regions.html — 17 fichiers HTML séparés</td>
        <td style="padding:10px">regions.php — 1 fichier + WHERE zone = $_GET</td>
      </tr>
      <tr style="border-bottom:1px solid #eee">
        <td style="padding:10px">Aucun formulaire fonctionnel</td>
        <td style="padding:10px">contact.php — $_POST + INSERT INTO messages</td>
      </tr>
      <tr style="background:#f9f9f9">
        <td style="padding:10px">Aucune base de données</td>
        <td style="padding:10px">MySQL burkina_db — 4 tables, données réelles</td>
      </tr>
    </table>
  </div>

  <div style="text-align:center;margin:30px 0">
    <a href="contact.php" style="background:#008751;color:white;padding:14px 35px;border-radius:25px;text-decoration:none;font-weight:bold;font-size:16px">
      📩 Nous contacter
    </a>
  </div>

</div>

<footer>🇧🇫 Burkina Terres d'Avenir — Projet L3 Informatique — Université Norbert Zongo 2025-2026</footer>
<?php mysqli_close($conn); ?>
</body>
</html>
