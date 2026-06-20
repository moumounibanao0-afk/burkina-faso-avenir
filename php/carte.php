<?php require 'conn.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Carte Interactive — Burkina Terres d'Avenir</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; background: #F5F0E8; }
    .flag-stripe { height: 6px; background: linear-gradient(90deg, #EF2B2D 50%, #009A00 50%); }
    .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .navbar .logo { color: #008751; font-size: 18px; font-weight: bold; text-decoration: none; white-space: nowrap; }
    .navbar nav { display: flex; flex-wrap: wrap; gap: 5px; justify-content: center; }
    .navbar nav a { color: #333; text-decoration: none; font-size: 13px; font-weight: bold; padding: 5px 8px; border-radius: 5px; white-space: nowrap; }
    .navbar nav a:hover, .navbar nav a.actif { color: #008751; border-bottom: 2px solid #008751; }
    .hero { background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.65)), url("https://images.unsplash.com/photo-1524661135-423995f22d0b?w=1400") center/cover no-repeat; color: white; padding: 40px 30px; text-align: center; }
    .hero h1 { font-size: 32px; margin-bottom: 8px; }
    .hero p { font-size: 15px; opacity: 0.9; }
    #map { width: 100%; height: 550px; }
    .map-container { max-width: 1100px; margin: 30px auto; padding: 0 20px; }
    .map-box { border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.15); }
    .info-panel { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; margin-top: 25px; }
    .info-card { background: white; border-radius: 12px; padding: 20px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-top: 4px solid #008751; }
    .info-card strong { display: block; font-size: 28px; color: #008751; }
    .info-card span { color: #666; font-size: 13px; }
    .legende { background: white; border-radius: 12px; padding: 20px; margin-top: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    .legende h3 { color: #008751; margin-bottom: 15px; }
    .legende-items { display: flex; gap: 20px; flex-wrap: wrap; }
    .legende-item { display: flex; align-items: center; gap: 8px; font-size: 13px; }
    .legende-dot { width: 16px; height: 16px; border-radius: 50%; }
    footer { background: #111827; color: #aaa; text-align: center; padding: 20px; margin-top: 30px; }
  
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

  </nav>

<div class="hero">
  <h1>🗺️ Carte Interactive du Burkina Faso</h1>
  <p>Cliquez sur un marqueur pour découvrir la région</p>
</div>

<?php
$nb_regions = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM regions"))[0];
$nb_provinces = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM provinces"))[0];

// Coordonnées des 17 régions
$coords = [
  'Bankui'     => [-11.8659, 2.0825,  '#008751'],
  'Djôrô'      => [-12.3645, 2.2026,  '#E8B923'],
  'Goulmou'    => [-10.8833, 0.3667,  '#EF2B2D'],
  'Guiriko'    => [-11.1778, 4.2969,  '#00A1D6'],
  'Kadiogo'    => [-12.3647, 1.5336,  '#008751'],
  'Kuilsé'     => [-13.0667, 1.1667,  '#A0522D'],
  'Liptako'    => [-14.0500, 0.0500,  '#E8B923'],
  'Nakambé'    => [-11.8833, 0.5500,  '#EF2B2D'],
  'Nando'      => [-12.5000, 1.2000,  '#00A1D6'],
  'Nazinon'    => [-11.7000, 1.7000,  '#008751'],
  'Oubri'      => [-12.3667, 3.8667,  '#A0522D'],
  'Sirba'      => [-14.0333, 1.5167,  '#E8B923'],
  'Soum'       => [-14.1000, 1.4667,  '#EF2B2D'],
  'Sourou'     => [-13.0667, 2.9167,  '#00A1D6'],
  'Tannounyan' => [-10.6333, 4.7667,  '#008751'],
  'Tapoa'      => [-12.0833, 1.7833,  '#A0522D'],
  'Yaadga'     => [-10.9000, 3.0500,  '#E8B923'],
];

$regions = mysqli_query($conn, "SELECT * FROM regions ORDER BY nom");
$regions_data = [];
while ($r = mysqli_fetch_assoc($regions)) {
  $coord = $coords[$r['nom']] ?? [-12.3647, 1.5336, '#008751'];
  $r['lat'] = $coord[0];
  $r['lng'] = $coord[1];
  $r['color'] = $coord[2];
  $regions_data[] = $r;
}
mysqli_close($conn);
?>

<div class="map-container">
  <div class="map-box">
    <div id="map"></div>
  </div>

  <div class="info-panel">
    <div class="info-card"><strong><?php echo $nb_regions; ?></strong><span>Régions</span></div>
    <div class="info-card"><strong><?php echo $nb_provinces; ?></strong><span>Provinces</span></div>
    <div class="info-card"><strong>274 200</strong><span>km² superficie</span></div>
    <div class="info-card"><strong>22M+</strong><span>Habitants</span></div>
    <div class="info-card"><strong>60+</strong><span>Groupes ethniques</span></div>
  </div>

  <div class="legende">
    <h3>🗺️ Zones géographiques</h3>
    <div class="legende-items">
      <div class="legende-item"><div class="legende-dot" style="background:#008751"></div>Centre / Sud</div>
      <div class="legende-item"><div class="legende-dot" style="background:#E8B923"></div>Nord / Sahel</div>
      <div class="legende-item"><div class="legende-dot" style="background:#EF2B2D"></div>Est</div>
      <div class="legende-item"><div class="legende-dot" style="background:#00A1D6"></div>Ouest</div>
      <div class="legende-item"><div class="legende-dot" style="background:#A0522D"></div>Sud-Ouest</div>
    </div>
  </div>
</div>

<footer>🇧🇫 Burkina Terres d'Avenir — Carte Interactive avec Leaflet.js</footer>
<script src="commun.js"></script>
<script>
// Initialiser la carte centrée sur le Burkina
const map = L.map('map').setView([12.3647, -1.5336], 6);

// Fond de carte OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '© OpenStreetMap contributors',
  maxZoom: 12
}).addTo(map);

// Données des régions
const regions = <?php echo json_encode($regions_data, JSON_UNESCAPED_UNICODE); ?>;

// Ajouter marqueurs pour chaque région
regions.forEach(r => {
  const marker = L.circleMarker([r.lat, r.lng], {
    radius: 14,
    fillColor: r.color,
    color: 'white',
    weight: 3,
    opacity: 1,
    fillOpacity: 0.9
  }).addTo(map);

  // Popup avec info région
  marker.bindPopup(`
    <div style="min-width:200px;font-family:Arial,sans-serif">
      <h3 style="color:#008751;margin:0 0 8px;font-size:16px">🗺️ ${r.nom}</h3>
      <p style="margin:3px 0;font-size:13px">🏛️ <strong>Chef-lieu :</strong> ${r.chef_lieu}</p>
      <p style="margin:3px 0;font-size:13px">📍 <strong>Zone :</strong> ${r.zone}</p>
      <p style="margin:3px 0;font-size:13px">🏘️ <strong>Provinces :</strong> ${r.provinces}</p>
      <p style="margin:8px 0 5px;font-size:12px;color:#666">${r.description ? r.description.substring(0,100) + '...' : ''}</p>
      <a href="region.php?id=${r.id}"
         style="display:block;text-align:center;background:#008751;color:white;
         padding:8px;border-radius:5px;text-decoration:none;font-weight:bold;
         margin-top:8px;font-size:13px">Voir la région →</a>
    </div>
  `, { maxWidth: 250 });

  // Label nom de la région
  marker.bindTooltip(r.nom, {
    permanent: true,
    direction: 'top',
    offset: [0, -15],
    className: 'region-label'
  });
});

// Style des labels
const labelStyle = document.createElement('style');
labelStyle.textContent = `
  .region-label {
    background: white; border: 2px solid #008751; border-radius: 8px;
    padding: 2px 6px; font-size: 11px; font-weight: bold; color: #008751;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
  }
  .region-label::before { display: none; }
`;
document.head.appendChild(labelStyle);
</script>
</body>
</html>
