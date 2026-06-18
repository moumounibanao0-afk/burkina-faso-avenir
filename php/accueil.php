<?php require 'conn.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Burkina Terres d'Avenir</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; background: #F5F0E8; color: #333; }
    .flag-stripe { height: 6px; background: linear-gradient(90deg, #EF2B2D 50%, #009A00 50%); }
    .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .navbar .logo { color: #008751; font-size: 18px; font-weight: bold; text-decoration: none; white-space: nowrap; }
    .navbar nav { display: flex; flex-wrap: wrap; gap: 5px; justify-content: center; }
    .navbar nav a { color: #333; text-decoration: none; font-size: 13px; font-weight: bold; padding: 5px 8px; border-radius: 5px; white-space: nowrap; }
    .navbar nav a:hover { color: #008751; }
    .navbar nav a.actif { color: #008751; border-bottom: 2px solid #008751; }
    .hero { background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.65)), url("https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=1400") center/cover no-repeat; color: white; padding: 80px 30px; text-align: center; }
    .hero h1 { font-size: 48px; margin-bottom: 15px; }
    .hero p { font-size: 18px; opacity: 0.9; margin-bottom: 30px; }
    .hero-btn { background: #E8B923; color: #333; padding: 14px 35px; border-radius: 30px; text-decoration: none; font-weight: bold; font-size: 16px; }
    .search-hero { max-width: 500px; margin: 25px auto 0; position: relative; }
    .search-hero input { width: 100%; padding: 14px 55px 14px 20px; border: none; border-radius: 30px; font-size: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.2); outline: none; }
    .search-hero button { position: absolute; right: 5px; top: 50%; transform: translateY(-50%); background: #008751; color: white; border: none; border-radius: 25px; padding: 8px 18px; cursor: pointer; font-weight: bold; font-size: 16px; }
    .search-results { max-width: 1100px; margin: 20px auto; padding: 0 20px; }
    .search-results h2 { color: #008751; border-left: 4px solid #E8B923; padding-left: 12px; margin: 20px 0 15px; font-size: 20px; }
    .search-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; margin-bottom: 20px; }
    .s-card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-decoration: none; color: inherit; display: block; transition: transform 0.2s; }
    .s-card:hover { transform: translateY(-3px); }
    .s-card img { width: 100%; height: 120px; object-fit: cover; }
    .s-card-body { padding: 12px; }
    .s-card-body h3 { color: #008751; margin: 5px 0; font-size: 15px; }
    .s-card-body p { color: #666; font-size: 12px; margin: 2px 0; }
    .s-badge { padding: 2px 8px; border-radius: 8px; font-size: 10px; font-weight: bold; }
    .s-badge.region { background: #e8f5e9; color: #008751; }
    .s-badge.province { background: #fff8e1; color: #E8B923; border: 1px solid #E8B923; }
    .highlight { background: #E8B923; color: #333; border-radius: 3px; padding: 0 2px; }
    .stats { display: flex; gap: 20px; justify-content: center; padding: 40px 20px; flex-wrap: wrap; }
    .stat { background: white; padding: 25px 35px; border-radius: 12px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    .stat strong { display: block; font-size: 32px; color: #008751; }
    .stat span { color: #666; font-size: 14px; }
    .section { max-width: 1100px; margin: 0 auto; padding: 40px 20px; }
    .section h2 { color: #008751; font-size: 28px; margin-bottom: 25px; border-left: 5px solid #E8B923; padding-left: 15px; }
    .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
    .card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: transform 0.2s; text-decoration: none; color: inherit; display: block; }
    .card:hover { transform: translateY(-4px); }
    .card img { width: 100%; height: 150px; object-fit: cover; }
    .card-body { padding: 14px; }
    .card-body h3 { color: #008751; margin-bottom: 5px; }
    .card-body p { font-size: 13px; color: #666; }
    .zone-badge { background: #EF2B2D; color: white; padding: 3px 8px; border-radius: 8px; font-size: 11px; font-weight: bold; }
    .voir-plus { text-align: center; margin-top: 30px; }
    .voir-plus a { background: #008751; color: white; padding: 12px 30px; border-radius: 25px; text-decoration: none; font-weight: bold; }
    .contact-section { background: white; border-radius: 12px; padding: 30px; margin: 20px auto; max-width: 1100px; }
    footer { background: #111827; color: #aaa; text-align: center; padding: 25px; margin-top: 50px; }
    footer strong { color: white; }
  </style>
</head>
<body>
<div class="flag-stripe"></div>
<nav class="navbar">
  <a class="logo" href="accueil.php">🇧🇫 Burkina Terres d'Avenir</a>
  <nav>
    <a href="accueil.php" class="actif">Accueil</a>
    <a href="regions.php">Les 17 Régions</a>
    <a href="carte.php">🗺️ Carte</a>
    <a href="potentiels.php">Potentiels</a>
    <a href="culture.php">Culture</a>
    <a href="apropos.php">À Propos</a>
    <a href="contact.php">Contact</a>
    <a href="messages.php">Messages</a>
    <a href="meteo.php">🌤️ Météo</a>
    <a href="actualites.php">📰 Actualités</a>
  </nav>
</nav>

<div class="hero">
  <h1>🇧🇫 Burkina Terres d'Avenir</h1>
  <p>Découvrez les 17 régions du Burkina Faso — leurs peuples, leurs potentiels, leur richesse.</p>
  <a class="hero-btn" href="regions.php">Découvrir les régions →</a>
  <div class="search-hero">
    <input type="text" id="homeSearch"
           placeholder="🔍 Rechercher une région, province..."
           autocomplete="off">
    <button onclick="doSearch()">→</button>
  </div>
</div>

<!-- Résultats de recherche en place -->
<div class="search-results" id="searchResults" style="display:none"></div>

<?php
$total    = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM regions"))[0];
$nb_zones = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(DISTINCT zone) FROM regions"))[0];
$nb_msgs  = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM messages"))[0];
$nb_prov  = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM provinces"))[0];
?>

<div class="stats" id="mainStats">
  <div class="stat"><strong><?php echo $total; ?></strong><span>Régions</span></div>
  <div class="stat"><strong><?php echo $nb_prov; ?></strong><span>Provinces</span></div>
  <div class="stat"><strong><?php echo $nb_zones; ?></strong><span>Zones géographiques</span></div>
  <div class="stat"><strong><?php echo $nb_msgs; ?></strong><span>Messages reçus</span></div>
</div>

<div class="section" id="mainContent">
  <h2>🗺️ Aperçu des régions</h2>
  <div class="grid">
<?php
$result = mysqli_query($conn, "SELECT * FROM regions ORDER BY RAND() LIMIT 6");
while ($region = mysqli_fetch_assoc($result)):
?>
    <a class="card" href="region.php?id=<?php echo $region['id']; ?>">
      <img src="<?php echo htmlspecialchars($region['image_url']); ?>"
           alt="<?php echo htmlspecialchars($region['nom']); ?>"
           onerror="this.src='https://via.placeholder.com/600x150/008751/white?text=<?php echo urlencode($region['nom']); ?>'">
      <div class="card-body">
        <span class="zone-badge"><?php echo strtoupper($region['zone']); ?></span>
        <h3><?php echo htmlspecialchars($region['nom']); ?></h3>
        <p>🏛️ <?php echo htmlspecialchars($region['chef_lieu']); ?></p>
        <p><?php echo htmlspecialchars(substr($region['description'], 0, 80)); ?>...</p>
      </div>
    </a>
<?php endwhile; ?>
  </div>
  <div class="voir-plus">
    <a href="regions.php">Voir les 17 régions →</a>
  </div>
</div>

<div class="contact-section">
  <h2 style="color:#008751;font-size:22px;margin-bottom:10px;">📩 Nous contacter</h2>
  <p style="color:#666;margin-bottom:20px;">Une question sur une région ? Écrivez-nous !</p>
  <a href="contact.php" style="background:#E8B923;color:#333;padding:12px 30px;border-radius:25px;text-decoration:none;font-weight:bold;">Envoyer un message</a>
</div>

<footer>
  <strong>Burkina Terres d'Avenir</strong><br>
  Projet L3 Informatique — Web Dynamique PHP + MySQL — 🇧🇫 La Terre des Hommes Intègres
</footer>

<?php mysqli_close($conn); ?>

<script>
const input = document.getElementById('homeSearch');
const box   = document.getElementById('searchResults');
const stats = document.getElementById('mainStats');
const main  = document.getElementById('mainContent');
let timer   = null;

function highlight(text, q) {
  if (!q) return text;
  try {
    const re = new RegExp('(' + q.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'gi');
    return text.replace(re, '<span class="highlight">$1</span>');
  } catch(e) { return text; }
}

function doSearch() {
  const q = input.value.trim();
  if (q.length < 2) {
    box.style.display = 'none';
    box.innerHTML = '';
    stats.style.display = 'flex';
    main.style.display = 'block';
    return;
  }

  // Masquer le contenu principal, afficher résultats
  stats.style.display = 'none';
  main.style.display = 'none';
  box.style.display = 'block';
  box.innerHTML = '<p style="text-align:center;color:#008751;padding:30px;font-size:18px">🔄 Recherche en cours...</p>';

  fetch('ajax_recherche.php?q=' + encodeURIComponent(q))
    .then(r => r.json())
    .then(data => {
      let html = '';
      let total = 0;

      // Régions
      if (data.regions && data.regions.length > 0) {
        total += data.regions.length;
        html += '<h2>🗺️ Régions (' + data.regions.length + ')</h2><div class="search-grid">';
        data.regions.forEach(r => {
          html += '<a class="s-card" href="region.php?id=' + r.id + '">' +
            '<img src="' + (r.image_url || 'https://via.placeholder.com/600x120/008751/white?text=' + encodeURIComponent(r.nom)) + '"' +
            ' onerror="this.src=\'https://via.placeholder.com/600x120/008751/white?text=' + encodeURIComponent(r.nom) + '\'" alt="">' +
            '<div class="s-card-body">' +
            '<span class="s-badge region">RÉGION</span>' +
            '<h3>' + highlight(r.nom, q) + '</h3>' +
            '<p>🏛️ ' + r.chef_lieu + '</p>' +
            '<p>📍 ' + r.zone + '</p>' +
            '</div></a>';
        });
        html += '</div>';
      }

      // Provinces
      if (data.provinces && data.provinces.length > 0) {
        total += data.provinces.length;
        html += '<h2>🏘️ Provinces (' + data.provinces.length + ')</h2><div class="search-grid">';
        data.provinces.forEach(p => {
          html += '<a class="s-card" href="region.php?id=' + p.region_id + '">' +
            '<div class="s-card-body" style="border-left:4px solid #E8B923;padding:20px">' +
            '<span class="s-badge province">PROVINCE</span>' +
            '<h3>' + highlight(p.nom, q) + '</h3>' +
            '<p>🏙️ ' + p.chef_lieu + '</p>' +
            '<p>📍 Région : ' + p.region_nom + '</p>' +
            '</div></a>';
        });
        html += '</div>';
      }

      // Cultures
      if (data.cultures && data.cultures.length > 0) {
        total += data.cultures.length;
        html += '<h2>🎭 Culture (' + data.cultures.length + ')</h2><div class="search-grid">';
        data.cultures.forEach(c => {
          html += '<a class="s-card" href="culture.php?type=' + c.type + '">' +
            '<img src="' + (c.image_url || 'https://via.placeholder.com/600x120/A0522D/white?text=' + encodeURIComponent(c.nom)) + '"' +
            ' onerror="this.src=\'https://via.placeholder.com/600x120/A0522D/white?text=' + encodeURIComponent(c.nom) + '\'" alt="">' +
            '<div class="s-card-body">' +
            '<span class="s-badge" style="background:#fff3e0;color:#A0522D">' + c.type.toUpperCase() + '</span>' +
            '<h3>' + highlight(c.nom, q) + '</h3>' +
            '<p>📍 ' + c.region + '</p>' +
            '</div></a>';
        });
        html += '</div>';
      }

      // Potentiels
      if (data.potentiels && data.potentiels.length > 0) {
        total += data.potentiels.length;
        html += '<h2>⚡ Potentiels (' + data.potentiels.length + ')</h2><div class="search-grid">';
        data.potentiels.forEach(p => {
          html += '<a class="s-card" href="potentiels.php?categorie=' + p.categorie + '">' +
            '<div class="s-card-body" style="border-left:4px solid #1B4F72;padding:20px">' +
            '<span class="s-badge" style="background:#e3f2fd;color:#1B4F72">' + p.categorie.toUpperCase() + '</span>' +
            '<h3>' + p.icone + ' ' + highlight(p.titre, q) + '</h3>' +
            '<p>' + p.description.substring(0,80) + '...</p>' +
            '</div></a>';
        });
        html += '</div>';
      }

      if (total === 0) {
        html = '<div style="text-align:center;padding:50px;color:#888">' +
               '<div style="font-size:48px;margin-bottom:15px">😕</div>' +
               '<p>Aucun résultat pour "<strong>' + q + '</strong>"</p>' +
               '<p style="font-size:13px;margin-top:10px">Essayez : Goulmou, Poni, Mossi, Or, FESPACO</p>' +
               '</div>';
        html += '<div style="text-align:center;margin-top:20px">' +
                '<button onclick="clearSearch()" style="background:#008751;color:white;border:none;padding:10px 25px;border-radius:20px;cursor:pointer;font-size:14px">✕ Effacer la recherche</button></div>';
      } else {
        html += '<div style="text-align:center;margin:20px 0">' +
                '<p style="color:#888;margin-bottom:10px">🔍 <strong>' + total + '</strong> résultat(s) pour "<strong>' + q + '</strong>"</p>' +
                '<button onclick="clearSearch()" style="background:#008751;color:white;border:none;padding:10px 25px;border-radius:20px;cursor:pointer;font-size:14px">✕ Effacer la recherche</button></div>';
      }

      box.innerHTML = html;
    })
    .catch(() => {
      box.innerHTML = '<p style="color:red;text-align:center;padding:30px">❌ Erreur de connexion</p>';
    });
}

function clearSearch() {
  input.value = '';
  box.style.display = 'none';
  box.innerHTML = '';
  stats.style.display = 'flex';
  main.style.display = 'block';
  input.focus();
}

// Recherche en temps réel
input.addEventListener('input', function() {
  clearTimeout(timer);
  const q = this.value.trim();
  if (q.length === 0) {
    clearSearch();
    return;
  }
  timer = setTimeout(() => doSearch(), 300);
});

input.addEventListener('keypress', function(e) {
  if (e.key === 'Enter') doSearch();
});
</script>
<script src="commun.js"></script>
</body>
</html>
