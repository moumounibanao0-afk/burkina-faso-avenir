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
    .live-badge { display: inline-block; background: #EF2B2D; color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; margin-top: 10px; animation: pulse 2s infinite; }
    @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.6} }
    .container { max-width: 1100px; margin: 30px auto; padding: 0 20px; }
    .toolbar { display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap; align-items: center; }
    .search-bar { display: flex; gap: 10px; flex: 1; min-width: 250px; }
    .search-bar input { flex: 1; padding: 10px 18px; border: 2px solid #e5e7eb; border-radius: 25px; font-size: 14px; outline: none; }
    .search-bar input:focus { border-color: #008751; }
    .tabs { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 20px; }
    .tab { padding: 8px 16px; border: 2px solid #008751; color: #008751; border-radius: 20px; cursor: pointer; font-weight: bold; font-size: 13px; background: white; transition: 0.2s; }
    .tab.actif, .tab:hover { background: #008751; color: white; }
    .sources { display: flex; gap: 8px; margin-bottom: 20px; flex-wrap: wrap; }
    .src-btn { padding: 6px 14px; border: 2px solid #1B4F72; color: #1B4F72; border-radius: 15px; cursor: pointer; font-size: 12px; font-weight: bold; background: white; transition: 0.2s; }
    .src-btn.actif, .src-btn:hover { background: #1B4F72; color: white; }
    .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px; }
    .card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); transition: transform 0.2s; display: flex; flex-direction: column; }
    .card:hover { transform: translateY(-4px); box-shadow: 0 8px 20px rgba(0,135,81,0.15); }
    .card img { width: 100%; height: 180px; object-fit: cover; }
    .card-body { padding: 15px; flex: 1; display: flex; flex-direction: column; }
    .card-body h3 { color: #222; font-size: 14px; margin-bottom: 8px; line-height: 1.5; flex: 1; }
    .card-body p { color: #666; font-size: 12px; line-height: 1.5; margin-bottom: 10px; }
    .card-meta { display: flex; justify-content: space-between; align-items: center; margin-top: auto; }
    .source-tag { background: #e8f5e9; color: #008751; padding: 3px 8px; border-radius: 8px; font-size: 11px; font-weight: bold; }
    .date-tag { color: #aaa; font-size: 11px; }
    .read-more { display: inline-block; margin-top: 8px; color: #008751; font-size: 12px; font-weight: bold; text-decoration: none; }
    .read-more:hover { text-decoration: underline; }
    .loading { text-align: center; padding: 50px; color: #008751; font-size: 18px; }
    .empty { text-align: center; padding: 50px; color: #888; font-size: 16px; }
    .refresh-btn { background: #008751; color: white; border: none; padding: 8px 18px; border-radius: 20px; cursor: pointer; font-size: 13px; font-weight: bold; }
    .refresh-btn:hover { background: #006a3e; }
    .last-update { color: #888; font-size: 12px; margin-left: 10px; }
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
    <a href="accueil.php" style="color:#333;text-decoration:none;font-size:15px;font-weight:bold;padding:8px 12px">🏠 Accueil</a>
    <a href="regions.php" style="color:#333;text-decoration:none;font-size:15px;font-weight:bold;padding:8px 12px">🗺️ Régions</a>
    <a href="carte.php" style="color:#333;text-decoration:none;font-size:15px;font-weight:bold;padding:8px 12px">📍 Carte</a>
    <a href="potentiels.php" style="color:#333;text-decoration:none;font-size:15px;font-weight:bold;padding:8px 12px">⚡ Potentiels</a>
    <a href="culture.php" style="color:#333;text-decoration:none;font-size:15px;font-weight:bold;padding:8px 12px">🎭 Culture</a>
    <a href="meteo.php" style="color:#333;text-decoration:none;font-size:15px;font-weight:bold;padding:8px 12px">🌤️ Météo</a>
    <a href="actualites.php" style="color:#333;text-decoration:none;font-size:15px;font-weight:bold;padding:8px 12px">📰 Actualités</a>
    <a href="apropos.php" style="color:#333;text-decoration:none;font-size:15px;font-weight:bold;padding:8px 12px">ℹ️ À Propos</a>
    <a href="contact.php" style="color:#333;text-decoration:none;font-size:15px;font-weight:bold;padding:8px 12px">📩 Contact</a>
    <a href="messages.php" style="color:#333;text-decoration:none;font-size:15px;font-weight:bold;padding:8px 12px">💬 Messages</a>
    <a href="recherche.php" title="Recherche" style="position:absolute;right:45px;top:50%;transform:translateY(-50%);color:#008751;text-decoration:none;font-size:22px;font-weight:bold">🔍</a>
    <a href="login.php" title="Admin" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);color:#1B4F72;text-decoration:none;font-size:22px;font-weight:bold">⚙️</a>
  </nav>
</nav>

<div class="hero">
  <h1>📰 Actualités du Burkina Faso</h1>
  <p>Suivez l'actualité en temps réel — news, culture, économie, sport</p>
  <span class="live-badge">🔴 LIVE — LeFaso.net</span>
</div>

<div class="container">

  <div class="toolbar">
    <div class="search-bar">
      <input type="text" id="searchActu" placeholder="🔍 Filtrer les actualités...">
    </div>
    <button class="refresh-btn" onclick="loadNews()">🔄 Actualiser</button>
    <span class="last-update" id="lastUpdate"></span>
  </div>

  <div class="sources">
    <div class="src-btn actif" onclick="setSource('lefaso', this)">📰 LeFaso.net</div>
    <div class="src-btn" onclick="setSource('sidwaya', this)">📰 Sidwaya</div>
  </div>

  <div class="tabs">
    <div class="tab actif" onclick="setFilter('', this)">Tout</div>
    <div class="tab" onclick="setFilter('burkina', this)">🇧🇫 Burkina</div>
    <div class="tab" onclick="setFilter('culture', this)">🎭 Culture</div>
    <div class="tab" onclick="setFilter('economie', this)">💰 Économie</div>
    <div class="tab" onclick="setFilter('sport', this)">⚽ Sport</div>
    <div class="tab" onclick="setFilter('securite', this)">🛡️ Sécurité</div>
    <div class="tab" onclick="setFilter('sante', this)">🏥 Santé</div>
  </div>

  <div id="newsGrid">
    <div class="loading">🔄 Chargement des actualités en direct...</div>
  </div>

</div>

<footer>🇧🇫 Burkina Terres d'Avenir — Actualités en temps réel via LeFaso.net</footer>
<?php mysqli_close($conn); ?>

<script>
let allItems = [];
let currentSource = 'lefaso';
let currentFilter = '';
let searchQ = '';

function setSource(src, el) {
  currentSource = src;
  document.querySelectorAll('.src-btn').forEach(b => b.classList.remove('actif'));
  el.classList.add('actif');
  loadNews();
}

function setFilter(f, el) {
  currentFilter = f;
  document.querySelectorAll('.tab').forEach(t => t.classList.remove('actif'));
  el.classList.add('actif');
  renderNews();
}

document.getElementById('searchActu').addEventListener('input', function() {
  searchQ = this.value.trim().toLowerCase();
  clearTimeout(this.timer);
  this.timer = setTimeout(renderNews, 300);
});

function loadNews() {
  const box = document.getElementById('newsGrid');
  box.innerHTML = '<div class="loading">🔄 Chargement depuis LeFaso.net...</div>';

  fetch('ajax_rss.php?source=' + currentSource)
    .then(r => r.json())
    .then(data => {
      if (data.error || !data.items || data.items.length === 0) {
        box.innerHTML = '<div class="empty">😕 Impossible de charger les actualités.<br><a href="https://lefaso.net" target="_blank" style="color:#008751">Voir LeFaso.net directement →</a></div>';
        return;
      }
      allItems = data.items;
      const now = new Date();
      document.getElementById('lastUpdate').textContent = 'Mis à jour à ' + now.toLocaleTimeString('fr-FR');
      renderNews();
    })
    .catch(() => {
      box.innerHTML = '<div class="empty">❌ Erreur de connexion.<br><a href="https://lefaso.net" target="_blank" style="color:#008751">Voir LeFaso.net directement →</a></div>';
    });
}

function renderNews() {
  const box = document.getElementById('newsGrid');
  let items = allItems;

  // Filtre par catégorie
  if (currentFilter) {
    items = items.filter(a =>
      a.categorie === currentFilter ||
      a.titre.toLowerCase().includes(currentFilter) ||
      a.desc.toLowerCase().includes(currentFilter)
    );
  }

  // Filtre par recherche
  if (searchQ) {
    items = items.filter(a =>
      a.titre.toLowerCase().includes(searchQ) ||
      a.desc.toLowerCase().includes(searchQ) ||
      a.auteur.toLowerCase().includes(searchQ)
    );
  }

  if (items.length === 0) {
    box.innerHTML = '<div class="empty">😕 Aucune actualité trouvée.<br><small>Essayez un autre filtre ou terme de recherche.</small></div>';
    return;
  }

  let html = '<div class="grid">';
  items.forEach(a => {
    const imgSrc = a.img || 'https://via.placeholder.com/600x180/008751/white?text=LeFaso.net';
    const today = new Date().toLocaleDateString("fr-FR");
      const articleDate = a.date ? a.date.split(" ")[0].split("/").join("/") : "";
      const isNew = a.date && a.date.includes(new Date().getDate() + "/" + String(new Date().getMonth()+1).padStart(2,"0"));
      html += '<div class="card" style="' + (isNew ? "border:2px solid #EF2B2D;" : "") + '">' +
      '<a href="' + a.lien + '" target="_blank">' +
      '<img src="' + imgSrc + '" alt="' + a.titre.replace(/"/g, '') + '"' +
      ' onerror="this.src=\'https://via.placeholder.com/600x180/008751/white?text=LeFaso.net\'">' +
      '</a>' +
      '<div class="card-body">' +
      '<h3>' + (isNew ? '<span style="background:#EF2B2D;color:white;padding:2px 6px;border-radius:5px;font-size:10px;margin-right:5px">🆕 NOUVEAU</span>' : '') + a.titre + '</h3>' +
      '<p>' + a.desc + '</p>' +
      '<div class="card-meta">' +
      '<span class="source-tag">✍️ ' + a.auteur + '</span>' +
      '<span class="date-tag">📅 ' + a.date + '</span>' +
      '</div>' +
      '<a href="' + a.lien + '" target="_blank" class="read-more">Lire l\'article complet →</a>' +
      '</div></div>';
  });
  html += '</div>';
  box.innerHTML = html;
}

// Charger au démarrage
loadNews();

// Auto-refresh toutes les 5 minutes
setInterval(loadNews, 5 * 60 * 1000);
</script>
<script src="commun.js"></script>
</body>
</html>
