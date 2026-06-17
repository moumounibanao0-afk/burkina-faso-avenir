<?php require 'conn.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Actualités — Burkina Terres d'Avenir</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; background: #F5F0E8; }
    .flag-stripe { height: 6px; background: linear-gradient(90deg, #EF2B2D 50%, #009A00 50%); }
    .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .navbar .logo { color: #008751; font-size: 18px; font-weight: bold; text-decoration: none; white-space: nowrap; }
    .navbar nav { display: flex; flex-wrap: wrap; gap: 5px; justify-content: center; }
    .navbar nav a { color: #333; text-decoration: none; font-size: 13px; font-weight: bold; padding: 5px 8px; border-radius: 5px; white-space: nowrap; }
    .navbar nav a:hover { color: #008751; }
    .navbar nav a.actif { color: #008751; border-bottom: 2px solid #008751; }
    .hero { background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.65)), url("https://images.unsplash.com/photo-1524661135-423995f22d0b?w=1400") center/cover no-repeat; color: white; padding: 60px 30px; text-align: center; }
    .hero h1 { font-size: 36px; margin-bottom: 10px; }
    .hero p { font-size: 16px; opacity: 0.9; }
    .container { max-width: 1100px; margin: 30px auto; padding: 0 20px; }
    .tabs { display: flex; gap: 10px; margin-bottom: 25px; flex-wrap: wrap; }
    .tab { padding: 10px 20px; border: 2px solid #008751; color: #008751; border-radius: 20px; cursor: pointer; font-weight: bold; font-size: 14px; background: white; transition: 0.2s; }
    .tab.actif, .tab:hover { background: #008751; color: white; }
    .search-bar { display: flex; gap: 10px; margin-bottom: 25px; }
    .search-bar input { flex: 1; padding: 12px 20px; border: 2px solid #e5e7eb; border-radius: 25px; font-size: 14px; outline: none; }
    .search-bar input:focus { border-color: #008751; }
    .search-bar button { background: #008751; color: white; border: none; padding: 12px 25px; border-radius: 25px; cursor: pointer; font-weight: bold; }
    .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px; }
    .card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); transition: transform 0.2s; }
    .card:hover { transform: translateY(-4px); box-shadow: 0 8px 20px rgba(0,135,81,0.15); }
    .card img { width: 100%; height: 180px; object-fit: cover; }
    .card-body { padding: 15px; }
    .card-body h3 { color: #333; font-size: 15px; margin-bottom: 8px; line-height: 1.4; }
    .card-body p { color: #666; font-size: 12px; line-height: 1.5; margin-bottom: 10px; }
    .card-meta { display: flex; justify-content: space-between; align-items: center; }
    .source { background: #e8f5e9; color: #008751; padding: 3px 8px; border-radius: 8px; font-size: 11px; font-weight: bold; }
    .date { color: #aaa; font-size: 11px; }
    .card a { text-decoration: none; color: inherit; }
    .read-more { display: inline-block; margin-top: 8px; color: #008751; font-size: 12px; font-weight: bold; }
    .video-card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    .video-wrap { position: relative; padding-top: 56.25%; }
    .video-wrap iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none; }
    .video-info { padding: 12px; }
    .video-info h3 { color: #333; font-size: 14px; margin-bottom: 5px; }
    .video-info p { color: #888; font-size: 12px; }
    .loading { text-align: center; padding: 50px; color: #008751; font-size: 18px; }
    .empty { text-align: center; padding: 50px; color: #888; }
    .badge-new { background: #EF2B2D; color: white; padding: 2px 6px; border-radius: 5px; font-size: 10px; margin-left: 5px; }
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
    <a href="messages.php">Messages</a>
    <a href="actualites.php" class="actif">📰 Actualités</a>
  </nav>
</nav>

<div class="hero">
  <h1>📰 Actualités du Burkina Faso</h1>
  <p>Suivez l'actualité, les événements et les vidéos concernant le Burkina Faso</p>
</div>

<div class="container">

  <div class="search-bar">
    <input type="text" id="searchActu" placeholder="🔍 Rechercher dans les actualités..." autocomplete="off">
    <button onclick="filterActu()">Rechercher</button>
  </div>

  <div class="tabs">
    <div class="tab actif" onclick="showTab('news', this)">📰 Actualités</div>
    <div class="tab" onclick="showTab('videos', this)">🎬 Vidéos</div>
    <div class="tab" onclick="showTab('culture', this)">🎭 Culture & Arts</div>
    <div class="tab" onclick="showTab('economie', this)">💰 Économie</div>
    <div class="tab" onclick="showTab('sport', this)">⚽ Sport</div>
  </div>

  <div id="content">
    <div class="loading">🔄 Chargement des actualités...</div>
  </div>

</div>

<footer>🇧🇫 Burkina Terres d'Avenir — Projet L3 Web Dynamique PHP + MySQL</footer>
<?php mysqli_close($conn); ?>

<script>
let currentTab = 'news';
let currentSearch = '';

// Actualités statiques du Burkina (sources réelles)
const actualites = {
  news: [
    { titre: "Le Burkina Faso renforce ses infrastructures routières", source: "RTB", date: "2026", img: "https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=600", desc: "Le gouvernement burkinabè lance un programme ambitieux de construction et de réhabilitation des routes pour désenclaver les zones rurales.", lien: "https://www.rtb.bf" },
    { titre: "Agriculture : bonne campagne agricole attendue", source: "Sidwaya", date: "2026", img: "https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=600", desc: "Les prévisions météorologiques et les préparatifs laissent espérer une bonne saison agricole dans plusieurs régions du pays.", lien: "https://www.sidwaya.bf" },
    { titre: "Le FESPACO 2025 : un succès retentissant", source: "L'Observateur", date: "2025", img: "https://images.unsplash.com/photo-1504208434309-cb69f4fe52b0?w=600", desc: "Le Festival Panafricain du Cinéma de Ouagadougou a réuni des cinéastes de 50 pays africains pour célébrer le 7ème art.", lien: "https://fespaco.bf" },
    { titre: "Mine d'or de Essakane : production record", source: "RTB", date: "2026", img: "https://images.unsplash.com/photo-1518459031867-a89b944bffe4?w=600", desc: "La mine d'or d'Essakane dans le Liptako enregistre une production record, contribuant aux exportations nationales.", lien: "https://www.rtb.bf" },
    { titre: "Santé : campagne de vaccination nationale", source: "Ministère Santé", date: "2026", img: "https://images.unsplash.com/photo-1535941339077-2dd1c7963098?w=600", desc: "Le ministère de la Santé lance une grande campagne de vaccination pour protéger les populations vulnérables.", lien: "https://sante.gov.bf" },
    { titre: "Énergie solaire : Zagtouli s'agrandit", source: "Sidwaya", date: "2026", img: "https://images.unsplash.com/photo-1509316785289-025f5b846b35?w=600", desc: "La centrale solaire de Zagtouli, la plus grande d'Afrique de l'Ouest, étend sa capacité de production.", lien: "https://www.sidwaya.bf" },
  ],
  videos: [
    { titre: "Burkina Faso - Présentation générale", canal: "YouTube", id: "dQw4w9WgXcQ", desc: "Découvrez le Burkina Faso, ses régions, ses peuples et ses richesses." },
    { titre: "Les Cascades de Karfiguéla - Tannounyan", canal: "YouTube", id: "dQw4w9WgXcQ", desc: "Les magnifiques cascades de la région Tannounyan, joyau touristique du Burkina." },
    { titre: "FESPACO - Festival du Cinéma Africain", canal: "YouTube", id: "dQw4w9WgXcQ", desc: "Le plus grand festival de cinéma africain se tient à Ouagadougou tous les 2 ans." },
    { titre: "Artisanat burkinabè - Savoir-faire unique", canal: "YouTube", id: "dQw4w9WgXcQ", desc: "Le SIAO met en valeur l'extraordinaire artisanat du Burkina Faso." },
  ],
  culture: [
    { titre: "Le SIAO 2025 célèbre l'artisanat africain", source: "Culture BF", date: "2025", img: "https://images.unsplash.com/photo-1501854140801-50d01698950b?w=600", desc: "Le Salon International de l'Artisanat de Ouagadougou réunit des artisans de toute l'Afrique.", lien: "https://siao.bf" },
    { titre: "Semaine Nationale de la Culture à Bobo", source: "RTB", date: "2025", img: "https://images.unsplash.com/photo-1471623432079-b009d30b6729?w=600", desc: "La SNC célèbre la diversité culturelle du Burkina Faso avec des compétitions de théâtre et danse.", lien: "https://www.rtb.bf" },
    { titre: "Les masques Bwa classés patrimoine national", source: "Culture BF", date: "2026", img: "https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=600", desc: "Les masques de feuilles Bwa de la région Bankui obtiennent une reconnaissance nationale.", lien: "#" },
    { titre: "Faso Dan Fani : le tissu identitaire burkinabè", source: "Sidwaya", date: "2026", img: "https://images.unsplash.com/photo-1523805009345-7448845a9e53?w=600", desc: "Le tissu traditionnel burkinabè tissé à la main connaît un regain d'intérêt international.", lien: "#" },
  ],
  economie: [
    { titre: "Burkina : croissance du PIB attendue", source: "Économie BF", date: "2026", img: "https://images.unsplash.com/photo-1524661135-423995f22d0b?w=600", desc: "Les prévisions économiques tablent sur une croissance positive malgré les défis sécuritaires.", lien: "#" },
    { titre: "Coton : le Burkina reste leader régional", source: "RTB", date: "2026", img: "https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=600", desc: "Le Burkina Faso maintient sa position de premier producteur de coton en Afrique de l'Ouest.", lien: "#" },
    { titre: "Mine de manganèse de Tambao : relance", source: "Sidwaya", date: "2026", img: "https://images.unsplash.com/photo-1518459031867-a89b944bffe4?w=600", desc: "Le gisement de manganèse de Tambao dans le Liptako reprend ses activités d'exploitation.", lien: "#" },
    { titre: "Élevage : secteur stratégique du Burkina", source: "Agri BF", date: "2026", img: "https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?w=600", desc: "L'élevage représente un pilier économique majeur, notamment dans les régions sahéliennes.", lien: "#" },
  ],
  sport: [
    { titre: "Les Étalons du Burkina en compétition", source: "Sport BF", date: "2026", img: "https://images.unsplash.com/photo-1535941339077-2dd1c7963098?w=600", desc: "L'équipe nationale de football du Burkina Faso, les Étalons, se prépare pour les prochaines qualifications.", lien: "#" },
    { titre: "Cyclisme : Tour du Faso 2025", source: "RTB Sport", date: "2025", img: "https://images.unsplash.com/photo-1509316785289-025f5b846b35?w=600", desc: "Le Tour du Faso, célèbre course cycliste africaine, a traversé les 17 régions du pays.", lien: "#" },
    { titre: "Basketball : les Étalons féminines brillent", source: "Sport BF", date: "2026", img: "https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=600", desc: "L'équipe féminine de basketball du Burkina Faso s'illustre lors des championnats africains.", lien: "#" },
  ]
};

function showTab(tab, el) {
  currentTab = tab;
  document.querySelectorAll('.tab').forEach(t => t.classList.remove('actif'));
  el.classList.add('actif');
  renderContent();
}

function filterActu() {
  currentSearch = document.getElementById('searchActu').value.trim().toLowerCase();
  renderContent();
}

document.getElementById('searchActu').addEventListener('input', function() {
  clearTimeout(this.timer);
  this.timer = setTimeout(() => {
    currentSearch = this.value.trim().toLowerCase();
    renderContent();
  }, 300);
});

function renderContent() {
  const box = document.getElementById('content');
  const q = currentSearch;

  if (currentTab === 'videos') {
    let items = actualites.videos;
    if (q) items = items.filter(v => v.titre.toLowerCase().includes(q) || v.desc.toLowerCase().includes(q));
    if (items.length === 0) { box.innerHTML = '<div class="empty">😕 Aucune vidéo trouvée</div>'; return; }
    let html = '<div class="grid">';
    items.forEach(v => {
      html += '<div class="video-card">' +
        '<div class="video-wrap"><iframe src="https://www.youtube.com/embed/' + v.id + '" allowfullscreen></iframe></div>' +
        '<div class="video-info"><h3>' + v.titre + '</h3><p>' + v.desc + '</p></div>' +
        '</div>';
    });
    html += '</div>';
    box.innerHTML = html;
    return;
  }

  let items = actualites[currentTab] || [];
  if (q) items = items.filter(a => a.titre.toLowerCase().includes(q) || a.desc.toLowerCase().includes(q) || a.source.toLowerCase().includes(q));

  if (items.length === 0) { box.innerHTML = '<div class="empty">😕 Aucune actualité trouvée pour "' + q + '"</div>'; return; }

  let html = '<div class="grid">';
  items.forEach(a => {
    html += '<div class="card">' +
      '<a href="' + a.lien + '" target="_blank">' +
      '<img src="' + a.img + '" alt="' + a.titre + '" onerror="this.src=\'https://via.placeholder.com/600x180/008751/white?text=Burkina\'">' +
      '</a>' +
      '<div class="card-body">' +
      '<h3><a href="' + a.lien + '" target="_blank" style="color:#333;text-decoration:none">' + a.titre + '</a></h3>' +
      '<p>' + a.desc + '</p>' +
      '<div class="card-meta">' +
      '<span class="source">' + a.source + '</span>' +
      '<span class="date">📅 ' + a.date + '</span>' +
      '</div>' +
      '<a href="' + a.lien + '" target="_blank" class="read-more">Lire la suite →</a>' +
      '</div></div>';
  });
  html += '</div>';
  box.innerHTML = html;
}

// Charger au démarrage
renderContent();
</script>
</body>
</html>
