<?php require 'conn.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Page introuvable — Burkina Terres d'Avenir</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; background: #F5F0E8; min-height: 100vh; display: flex; flex-direction: column; }
    .flag-stripe { height: 6px; background: linear-gradient(90deg, #EF2B2D 50%, #009A00 50%); }
    .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .navbar .logo { color: #008751; font-size: 18px; font-weight: bold; text-decoration: none; }
    .content { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 60px 20px; text-align: center; }
    .code { font-size: 120px; font-weight: bold; color: #008751; line-height: 1; }
    .flag { font-size: 60px; margin: 20px 0; }
    h1 { color: #333; font-size: 28px; margin-bottom: 15px; }
    p { color: #666; font-size: 16px; margin-bottom: 30px; max-width: 400px; }
    .btns { display: flex; gap: 15px; flex-wrap: wrap; justify-content: center; }
    .btn { padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: bold; font-size: 14px; }
    .btn-green { background: #008751; color: white; }
    .btn-outline { background: white; color: #008751; border: 2px solid #008751; }
    .suggestions { margin-top: 40px; background: white; border-radius: 12px; padding: 25px; max-width: 500px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    .suggestions h3 { color: #008751; margin-bottom: 15px; }
    .suggestions a { display: block; padding: 8px 0; color: #333; text-decoration: none; border-bottom: 1px solid #eee; font-size: 14px; }
    .suggestions a:hover { color: #008751; }
    .suggestions a:last-child { border-bottom: none; }
    footer { background: #111827; color: #aaa; text-align: center; padding: 20px; }
  
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
<nav style="display:flex;justify-content:center;align-items:center;gap:5px;flex-wrap:wrap;position:relative">
    <a href="accueil.php" style="color:#333;text-decoration:none;font-size:17px;font-weight:bold;padding:8px 14px">🏠 Accueil</a>
    <a href="regions.php" style="color:#333;text-decoration:none;font-size:17px;font-weight:bold;padding:8px 14px">🗺️ Régions</a>
    <a href="carte.php" style="color:#333;text-decoration:none;font-size:17px;font-weight:bold;padding:8px 14px">📍 Carte</a>
    <a href="potentiels.php" style="color:#333;text-decoration:none;font-size:17px;font-weight:bold;padding:8px 14px">⚡ Potentiels</a>
    <a href="culture.php" style="color:#333;text-decoration:none;font-size:17px;font-weight:bold;padding:8px 14px">🎭 Culture</a>
    <a href="meteo.php" style="color:#333;text-decoration:none;font-size:17px;font-weight:bold;padding:8px 14px">🌤️ Météo</a>
    <a href="actualites.php" style="color:#333;text-decoration:none;font-size:17px;font-weight:bold;padding:8px 14px">📰 Actualités</a>
    <a href="apropos.php" style="color:#333;text-decoration:none;font-size:17px;font-weight:bold;padding:8px 14px">ℹ️ À Propos</a>
    <a href="contact.php" style="color:#333;text-decoration:none;font-size:17px;font-weight:bold;padding:8px 14px">📩 Contact</a>
    <a href="messages.php" style="color:#333;text-decoration:none;font-size:17px;font-weight:bold;padding:8px 14px">💬 Messages</a>
    <a href="recherche.php" title="Recherche" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);color:#1B4F72;text-decoration:none;font-size:24px;font-weight:bold">⚙️</a>
    <a href="recherche.php" title="Recherche" style="position:absolute;right:45px;top:50%;transform:translateY(-50%);color:#008751;text-decoration:none;font-size:24px;font-weight:bold">🔍</a>
  </nav>
</nav>

<div class="content">
  <div class="code">404</div>
  <div class="flag">🇧🇫</div>
  <h1>Page introuvable !</h1>
  <p>La page que vous cherchez n'existe pas ou a été déplacée.</p>
  <div class="btns">
    <a href="accueil.php" class="btn btn-green">🏠 Retour à l'accueil</a>
    <a href="regions.php" class="btn btn-outline">🗺️ Voir les régions</a>
  </div>

  <div class="suggestions">
    <h3>📍 Pages disponibles</h3>
    <a href="regions.php">🗺️ Les 17 Régions du Burkina</a>
    <a href="potentiels.php">⚡ Potentiels économiques</a>
    <a href="culture.php">🎭 Culture & Patrimoine</a>
    <a href="carte.php">🗺️ Carte Interactive</a>
    <a href="meteo.php">🌤️ Météo en temps réel</a>
    <a href="actualites.php">📰 Actualités LeFaso.net</a>
    <a href="contact.php">📩 Nous contacter</a>
  </div>
</div>

<footer>🇧🇫 Burkina Terres d'Avenir — Projet L3 Web Dynamique PHP + MySQL</footer>
<script src="commun.js"></script>
</body>
</html>
