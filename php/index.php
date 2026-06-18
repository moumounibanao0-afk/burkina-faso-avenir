<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Burkina Terres d'Avenir</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; background: #F5F0E8; min-height: 100vh; display: flex; flex-direction: column; }
    .flag-stripe { height: 6px; background: linear-gradient(90deg, #EF2B2D 50%, #009A00 50%); }
    .hero { background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.7)), url("https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=1400") center/cover no-repeat; color: white; flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 40px 20px; }
    .logo { font-size: 64px; margin-bottom: 15px; }
    h1 { font-size: 42px; margin-bottom: 10px; font-weight: bold; }
    .subtitle { font-size: 18px; opacity: 0.85; margin-bottom: 50px; }
    .cards { display: flex; gap: 30px; flex-wrap: wrap; justify-content: center; max-width: 700px; }
    .card { background: rgba(255,255,255,0.12); backdrop-filter: blur(10px); border: 2px solid rgba(255,255,255,0.3); border-radius: 20px; padding: 40px 35px; width: 280px; cursor: pointer; transition: all 0.3s; text-decoration: none; color: white; }
    .card:hover { background: rgba(255,255,255,0.25); transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.3); border-color: white; }
    .card .icone { font-size: 52px; margin-bottom: 15px; }
    .card h2 { font-size: 22px; margin-bottom: 10px; }
    .card p { font-size: 13px; opacity: 0.8; line-height: 1.6; margin-bottom: 20px; }
    .card .btn { display: inline-block; padding: 10px 25px; border-radius: 25px; font-weight: bold; font-size: 14px; }
    .card.site .btn { background: #008751; color: white; }
    .card.admin .btn { background: #1B4F72; color: white; }
    .card:hover .btn { opacity: 0.9; }
    footer { background: #111827; color: #aaa; text-align: center; padding: 15px; font-size: 13px; }
  </style>
</head>
<body>
<div class="flag-stripe"></div>

<div class="hero">
  <div class="logo">🇧🇫</div>
  <h1>Burkina Terres d'Avenir</h1>
  <p class="subtitle">Projet L3 Informatique — Web Dynamique PHP + MySQL<br>Université Norbert Zongo — 2025-2026</p>

  <div class="cards">
    <a href="accueil.php" class="card site">
      <div class="icone">🌐</div>
      <h2>Site Public</h2>
      <p>Découvrez les 17 régions du Burkina Faso, leurs cultures, potentiels, carte interactive et actualités en direct.</p>
      <span class="btn">Accéder au site →</span>
    </a>

    <a href="login.php" class="card admin">
      <div class="icone">⚙️</div>
      <h2>Espace Admin</h2>
      <p>Gérez les régions, consultez les statistiques, les messages reçus et les graphiques du tableau de bord.</p>
      <span class="btn">Se connecter →</span>
    </a>
  </div>
</div>

<footer>
  🇧🇫 Burkina Terres d'Avenir — BANAO Moumouni & YAMWEMBA Oumar — Dr ZONGO — UNZ 2025-2026
</footer>
</body>
</html>
