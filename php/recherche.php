<?php require 'conn.php'; require 'tracker.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Recherche — Burkina Terres d'Avenir</title>
  <style>
    body { font-family: Arial, sans-serif; background: #F5F0E8; margin: 0; }
    .flag-stripe { height: 6px; background: linear-gradient(90deg, #EF2B2D 50%, #009A00 50%); }
    .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .navbar .logo { color: #008751; font-size: 20px; font-weight: bold; text-decoration: none; }
    .navbar nav a { margin-left: 20px; color: #333; text-decoration: none; font-size: 14px; font-weight: bold; }
    .navbar nav a:hover, .navbar nav a.actif { color: #008751; border-bottom: 2px solid #008751; }
    .hero { background: linear-gradient(135deg, #1B4F72, #008751); color: white; padding: 50px 30px; text-align: center; }
    .hero h1 { font-size: 36px; margin-bottom: 10px; }
    .search-box { max-width: 600px; margin: 20px auto 0; position: relative; }
    .search-box input { width: 100%; padding: 16px 50px 16px 20px; border: none; border-radius: 30px; font-size: 18px; box-shadow: 0 4px 15px rgba(0,0,0,0.2); outline: none; box-sizing: border-box; }
    .search-box .icon { position: absolute; right: 20px; top: 50%; transform: translateY(-50%); font-size: 20px; color: #008751; }
    .container { max-width: 1000px; margin: 30px auto; padding: 0 20px; }
    .stats-bar { background: white; border-radius: 10px; padding: 15px 20px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); display: flex; gap: 20px; align-items: center; flex-wrap: wrap; }
    .stats-bar span { color: #555; font-size: 14px; }
    .stats-bar strong { color: #008751; }
    .section-title { color: #008751; font-size: 20px; border-left: 4px solid #E8B923; padding-left: 12px; margin: 25px 0 15px; }
    .grid { display: flex; flex-wrap: wrap; gap: 15px; justify-content: center; margin-bottom: 30px; }
    .grid > * { flex: 1 1 280px; max-width: 380px; }
    .card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); text-decoration: none; color: inherit; display: block; transition: transform 0.2s; }
    .card:hover { transform: translateY(-4px); box-shadow: 0 8px 20px rgba(0,135,81,0.15); }
    .card img { width: 100%; height: 130px; object-fit: cover; }
    .card-body { padding: 14px; }
    .card-body h3 { color: #008751; margin: 0 0 5px; font-size: 16px; }
    .card-body p { color: #666; font-size: 12px; margin: 3px 0; }
    .badge { display: inline-block; padding: 2px 8px; border-radius: 8px; font-size: 10px; font-weight: bold; margin-bottom: 6px; }
    .badge.region { background: #e8f5e9; color: #008751; }
    .badge.province { background: #fff8e1; color: #E8B923; border: 1px solid #E8B923; }
    .badge.culture { background: #fff3e0; color: #A0522D; }
    .badge.potentiel { background: #e3f2fd; color: #1B4F72; }
    .highlight { background: #E8B923; color: #333; border-radius: 3px; padding: 0 2px; }
    .empty { text-align: center; padding: 50px; color: #888; }
    .empty .icon { font-size: 48px; margin-bottom: 15px; }
    .loading { text-align: center; padding: 30px; color: #008751; font-size: 18px; }
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

  </nav>

<div class="hero">
  <h1>🔍 Recherche</h1>
  <p>Trouvez une région, une province, un potentiel ou un élément culturel</p>
  <div class="search-box">
    <input type="text" id="searchInput" placeholder="Ex: Goulmou, Poni, FESPACO, Or..."
           value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>"
           autocomplete="off">
    <span class="icon">🔍</span>
  </div>
</div>

<div class="container">
  <div class="stats-bar" id="statsBar" style="display:none">
    <span id="statsText"></span>
  </div>

  <div id="results"></div>
</div>

<footer>🇧🇫 Burkina Terres d'Avenir — Projet L3 Web Dynamique PHP + MySQL</footer>

<script>
const input = document.getElementById('searchInput');
const results = document.getElementById('results');
const statsBar = document.getElementById('statsBar');
const statsText = document.getElementById('statsText');
let timer = null;

function highlight(text, q) {
  if (!q) return text;
  const re = new RegExp('(' + q.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'gi');
  return text.replace(re, '<span class="highlight">$1</span>');
}

function search(q) {
  if (q.length < 2) {
    results.innerHTML = '<div class="empty"><div class="icon">🔍</div><p>Tapez au moins 2 caractères pour rechercher</p></div>';
    statsBar.style.display = 'none';
    return;
  }

  results.innerHTML = '<div class="loading">🔄 Recherche en cours...</div>';

  fetch('ajax_recherche.php?q=' + encodeURIComponent(q))
    .then(r => r.json())
    .then(data => {
      let html = '';
      let total = 0;

      // Régions
      if (data.regions && data.regions.length > 0) {
        total += data.regions.length;
        html += '<h2 class="section-title">🗺️ Régions (' + data.regions.length + ')</h2><div class="grid">';
        data.regions.forEach(r => {
          html += `<a class="card" href="region.php?id=${r.id}">
            <img src="${r.image_url || 'https://via.placeholder.com/600x130/008751/white?text=' + encodeURIComponent(r.nom)}"
                 alt="${r.nom}" onerror="this.src='https://via.placeholder.com/600x130/008751/white?text=${encodeURIComponent(r.nom)}'">
            <div class="card-body">
              <span class="badge region">RÉGION</span>
              <h3>${highlight(r.nom, q)}</h3>
              <p>🏛️ ${r.chef_lieu}</p>
              <p>📍 ${r.zone}</p>
            </div>
          </a>`;
        });
        html += '</div>';
      }

      // Provinces
      if (data.provinces && data.provinces.length > 0) {
        total += data.provinces.length;
        html += '<h2 class="section-title">🏘️ Provinces (' + data.provinces.length + ')</h2><div class="grid">';
        data.provinces.forEach(p => {
          html += `<a class="card" href="region.php?id=${p.region_id}">
            <div class="card-body" style="border-left:4px solid #E8B923;padding:20px">
              <span class="badge province">PROVINCE</span>
              <h3>${highlight(p.nom, q)}</h3>
              <p>🏙️ Chef-lieu : ${p.chef_lieu}</p>
              <p>📍 Région : ${p.region_nom}</p>
            </div>
          </a>`;
        });
        html += '</div>';
      }

      // Cultures
      if (data.cultures && data.cultures.length > 0) {
        total += data.cultures.length;
        html += '<h2 class="section-title">🎭 Culture (' + data.cultures.length + ')</h2><div class="grid">';
        data.cultures.forEach(c => {
          html += `<a class="card" href="culture.php?type=${c.type}">
            <img src="${c.image_url || 'https://via.placeholder.com/600x130/A0522D/white?text=' + encodeURIComponent(c.nom)}"
                 alt="${c.nom}" onerror="this.src='https://via.placeholder.com/600x130/A0522D/white?text=${encodeURIComponent(c.nom)}'">
            <div class="card-body">
              <span class="badge culture">${c.type.toUpperCase()}</span>
              <h3>${highlight(c.nom, q)}</h3>
              <p>${c.description.substring(0,80)}...</p>
            </div>
          </a>`;
        });
        html += '</div>';
      }

      // Potentiels
      if (data.potentiels && data.potentiels.length > 0) {
        total += data.potentiels.length;
        html += '<h2 class="section-title">⚡ Potentiels (' + data.potentiels.length + ')</h2><div class="grid">';
        data.potentiels.forEach(p => {
          html += `<a class="card" href="potentiels.php?categorie=${p.categorie}">
            <img src="${p.image_url || 'https://via.placeholder.com/600x130/1B4F72/white?text=' + encodeURIComponent(p.titre)}"
                 alt="${p.titre}" onerror="this.src='https://via.placeholder.com/600x130/1B4F72/white?text=${encodeURIComponent(p.titre)}'">
            <div class="card-body">
              <span class="badge potentiel">${p.categorie.toUpperCase()}</span>
              <h3>${p.icone} ${highlight(p.titre, q)}</h3>
              <p>${p.description.substring(0,80)}...</p>
            </div>
          </a>`;
        });
        html += '</div>';
      }

      if (total === 0) {
        html = '<div class="empty"><div class="icon">😕</div><p>Aucun résultat pour "<strong>' + q + '</strong>"</p><p style="font-size:13px;color:#aaa">Essayez : Goulmou, Poni, Mossi, Or, FESPACO</p></div>';
        statsBar.style.display = 'none';
      } else {
        statsBar.style.display = 'flex';
        statsText.innerHTML = '🔍 <strong>' + total + '</strong> résultat(s) pour "<strong>' + q + '</strong>"';
      }

      results.innerHTML = html;
    })
    .catch(() => {
      results.innerHTML = '<div class="empty">❌ Erreur de connexion</div>';
    });
}

// Recherche en temps réel
input.addEventListener('input', function() {
  clearTimeout(timer);
  timer = setTimeout(() => search(this.value.trim()), 300);
});

// Recherche initiale si paramètre GET
const initQ = '<?php echo addslashes(htmlspecialchars($_GET['q'] ?? '')); ?>';
if (initQ.length >= 2) {
  search(initQ);
} else {
  results.innerHTML = '<div class="empty"><div class="icon">🔍</div><p>Tapez au moins 2 caractères pour rechercher</p><p style="font-size:13px;color:#aaa">Régions, Provinces, Culture, Potentiels</p></div>';
}

input.focus();
</script>
<script src="commun.js"></script>
</body>
</html>
