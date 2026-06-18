<?php require 'conn.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Météo — Burkina Terres d'Avenir</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; background: #F5F0E8; }
    .flag-stripe { height: 6px; background: linear-gradient(90deg, #EF2B2D 50%, #009A00 50%); }
    .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .navbar .logo { color: #008751; font-size: 18px; font-weight: bold; text-decoration: none; white-space: nowrap; }
    .navbar nav { display: flex; flex-wrap: wrap; gap: 5px; justify-content: center; }
    .navbar nav a { color: #333; text-decoration: none; font-size: 13px; font-weight: bold; padding: 5px 8px; border-radius: 5px; white-space: nowrap; }
    .navbar nav a:hover, .navbar nav a.actif { color: #008751; border-bottom: 2px solid #008751; }
    .hero { background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.65)), url("https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=1400") center/cover no-repeat; color: white; padding: 60px 30px; text-align: center; }
    .hero h1 { font-size: 36px; margin-bottom: 10px; }
    .hero p { font-size: 16px; opacity: 0.9; }
    .container { max-width: 1100px; margin: 30px auto; padding: 0 20px; }
    .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
    .meteo-card { background: white; border-radius: 16px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); text-align: center; transition: transform 0.2s; border-top: 5px solid #008751; }
    .meteo-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,135,81,0.15); }
    .meteo-card h3 { color: #008751; font-size: 18px; margin-bottom: 5px; }
    .meteo-card .chef-lieu { color: #888; font-size: 12px; margin-bottom: 15px; }
    .meteo-card .temp { font-size: 48px; font-weight: bold; color: #EF2B2D; margin: 10px 0; }
    .meteo-card .condition { font-size: 14px; color: #555; margin-bottom: 10px; }
    .meteo-card .icone { font-size: 36px; margin-bottom: 5px; }
    .meteo-details { display: flex; justify-content: space-around; margin-top: 15px; padding-top: 15px; border-top: 1px solid #eee; }
    .meteo-detail { text-align: center; }
    .meteo-detail span { display: block; font-size: 11px; color: #888; }
    .meteo-detail strong { font-size: 14px; color: #333; }
    .loading { text-align: center; padding: 50px; color: #008751; font-size: 18px; }
    .section-title { color: #008751; font-size: 24px; border-left: 5px solid #E8B923; padding-left: 15px; margin: 30px 0 20px; }
    .update-info { text-align: center; color: #888; font-size: 13px; margin-bottom: 20px; }
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

  </nav>
</nav>

<div class="hero">
  <h1>🌤️ Météo du Burkina Faso</h1>
  <p>Conditions météorologiques en temps réel dans les 17 régions</p>
</div>

<?php
// Villes principales par région avec coordonnées
$villes = [
  ['region'=>'Kadiogo',    'ville'=>'Ouagadougou', 'lat'=>12.3647, 'lon'=>-1.5336],
  ['region'=>'Guiriko',    'ville'=>'Bobo-Dioulasso','lat'=>11.1771,'lon'=>-4.2979],
  ['region'=>'Goulmou',    'ville'=>'Fada N\'Gourma','lat'=>12.0600,'lon'=>0.3500],
  ['region'=>'Kuilsé',     'ville'=>'Kaya',         'lat'=>13.0667, 'lon'=>-1.0833],
  ['region'=>'Sirba',      'ville'=>'Dori',          'lat'=>14.0333, 'lon'=>0.0333],
  ['region'=>'Oubri',      'ville'=>'Dédougou',      'lat'=>12.4667, 'lon'=>-3.4667],
  ['region'=>'Yaadga',     'ville'=>'Gaoua',         'lat'=>10.3333, 'lon'=>-3.1833],
  ['region'=>'Nakambé',    'ville'=>'Tenkodogo',     'lat'=>11.7833, 'lon'=>0.3667],
  ['region'=>'Tannounyan', 'ville'=>'Banfora',       'lat'=>10.6333, 'lon'=>-4.7667],
  ['region'=>'Soum',       'ville'=>'Djibo',         'lat'=>14.1000, 'lon'=>-1.6333],
  ['region'=>'Liptako',    'ville'=>'Gorom-Gorom',   'lat'=>14.4333, 'lon'=>-0.2333],
  ['region'=>'Nando',      'ville'=>'Ziniaré',       'lat'=>12.5833, 'lon'=>-1.2833],
];
mysqli_close($conn);
?>

<div class="container">
  <p class="update-info" id="updateTime">🔄 Chargement des données météo...</p>
  <h2 class="section-title">🌡️ Températures en temps réel</h2>
  <div class="grid" id="meteoGrid">
    <?php foreach($villes as $v): ?>
    <div class="meteo-card" id="meteo-<?php echo str_replace("'","",$v['ville']); ?>">
      <h3><?php echo htmlspecialchars($v['region']); ?></h3>
      <p class="chef-lieu">📍 <?php echo htmlspecialchars($v['ville']); ?></p>
      <div class="icone">⌛</div>
      <div class="temp">--°</div>
      <div class="condition">Chargement...</div>
      <div class="meteo-details">
        <div class="meteo-detail"><span>💧 Humidité</span><strong>--%</strong></div>
        <div class="meteo-detail"><span>💨 Vent</span><strong>-- km/h</strong></div>
        <div class="meteo-detail"><span>🌡️ Ressenti</span><strong>--°</strong></div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<footer>🇧🇫 Burkina Terres d'Avenir — Météo via Open-Meteo (gratuit)</footer>
<script src="commun.js"></script>
<script>
const villes = <?php echo json_encode($villes, JSON_UNESCAPED_UNICODE); ?>;

function getMeteoIcone(code) {
  if (code === 0) return '☀️';
  if (code <= 2) return '⛅';
  if (code <= 3) return '☁️';
  if (code <= 48) return '🌫️';
  if (code <= 57) return '🌦️';
  if (code <= 67) return '🌧️';
  if (code <= 77) return '❄️';
  if (code <= 82) return '🌧️';
  if (code <= 86) return '🌨️';
  if (code <= 99) return '⛈️';
  return '🌤️';
}

function getCondition(code) {
  if (code === 0) return 'Ciel dégagé';
  if (code <= 2) return 'Partiellement nuageux';
  if (code <= 3) return 'Nuageux';
  if (code <= 48) return 'Brouillard';
  if (code <= 57) return 'Bruine';
  if (code <= 67) return 'Pluie';
  if (code <= 77) return 'Neige';
  if (code <= 82) return 'Averses';
  if (code <= 99) return 'Orage';
  return 'Variable';
}

function getBorderColor(temp) {
  if (temp >= 38) return '#EF2B2D';
  if (temp >= 32) return '#E8B923';
  if (temp >= 25) return '#008751';
  return '#00A1D6';
}

async function loadMeteo(ville) {
  try {
    const url = `https://api.open-meteo.com/v1/forecast?latitude=${ville.lat}&longitude=${ville.lon}&current=temperature_2m,relative_humidity_2m,apparent_temperature,weather_code,wind_speed_10m&timezone=Africa/Ouagadougou`;
    const res = await fetch(url);
    const data = await res.json();
    const cur = data.current;

    const cardId = 'meteo-' + ville.ville.replace(/'/g, '');
    const card = document.getElementById(cardId);
    if (!card) return;

    const temp = Math.round(cur.temperature_2m);
    const ressenti = Math.round(cur.apparent_temperature);
    const humidite = cur.relative_humidity_2m;
    const vent = Math.round(cur.wind_speed_10m);
    const code = cur.weather_code;

    card.style.borderTopColor = getBorderColor(temp);
    card.querySelector('.icone').textContent = getMeteoIcone(code);
    card.querySelector('.temp').textContent = temp + '°C';
    card.querySelector('.condition').textContent = getCondition(code);

    const details = card.querySelectorAll('.meteo-detail strong');
    details[0].textContent = humidite + '%';
    details[1].textContent = vent + ' km/h';
    details[2].textContent = ressenti + '°C';

  } catch(e) {
    console.log('Erreur météo:', ville.ville);
  }
}

async function loadAllMeteo() {
  // Charger en parallèle par groupes de 3
  for (let i = 0; i < villes.length; i += 3) {
    const group = villes.slice(i, i + 3);
    await Promise.all(group.map(v => loadMeteo(v)));
    await new Promise(r => setTimeout(r, 500));
  }
  const now = new Date();
  document.getElementById('updateTime').textContent =
    '✅ Données mises à jour le ' + now.toLocaleDateString('fr-FR') +
    ' à ' + now.toLocaleTimeString('fr-FR');
}

loadAllMeteo();
setInterval(loadAllMeteo, 10 * 60 * 1000); // refresh toutes les 10 min
</script>
</body>
</html>
