<?php require 'conn.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Potentiels — Burkina Terres d'Avenir</title>
  <style>
    body { font-family: Arial, sans-serif; background: #F5F0E8; margin: 0; }
    .flag-stripe { height: 6px; background: linear-gradient(90deg, #EF2B2D 50%, #009A00 50%); }
    .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .navbar .logo { color: #008751; font-size: 20px; font-weight: bold; text-decoration: none; }
    .navbar nav a { margin-left: 20px; color: #333; text-decoration: none; font-size: 14px; font-weight: bold; }
    .navbar nav a:hover, .navbar nav a.actif { color: #008751; border-bottom: 2px solid #008751; }
    .hero { background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.65)), url("https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=1400") center/cover no-repeat; color: white; padding: 60px 30px; text-align: center; }
    .hero h1 { font-size: 42px; margin-bottom: 10px; }
    .hero p { font-size: 16px; opacity: 0.9; }
    .container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }
    .section-title { color: #008751; font-size: 26px; border-left: 5px solid #E8B923; padding-left: 15px; margin: 40px 0 20px; }
    .filtres { text-align: center; margin: 20px 0; }
    .filtres a { display: inline-block; margin: 5px; padding: 8px 20px; background: white; border: 2px solid #008751; color: #008751; border-radius: 20px; text-decoration: none; font-weight: bold; }
    .filtres a.actif, .filtres a:hover { background: #008751; color: white; }
    .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
    .card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); transition: transform 0.2s; }
    .card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,135,81,0.15); }
    .card img { width: 100%; height: 160px; object-fit: cover; }
    .card-body { padding: 20px; border-left: 5px solid #008751; }
    .card-body.or { border-left-color: #E8B923; }
    .card-body.terre { border-left-color: #A0522D; }
    .card-body.bleu { border-left-color: #00A1D6; }
    .card-body.rouge { border-left-color: #EF2B2D; }
    .card .icone { font-size: 30px; margin-bottom: 8px; }
    .card h3 { color: #333; margin: 0 0 10px; font-size: 18px; }
    .card p { color: #666; font-size: 13px; line-height: 1.6; margin: 0; }
    .badge { display: inline-block; background: #f0f0f0; color: #555; padding: 3px 10px; border-radius: 10px; font-size: 11px; margin-bottom: 10px; text-transform: uppercase; }
    .stats { display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; margin: 30px 0; }
    .stat { background: white; padding: 20px 30px; border-radius: 12px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    .stat strong { display: block; font-size: 28px; color: #008751; }
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
    <a href="recherche.php" title="Recherche" style="position:absolute;right:15px;top:50%;transform:translateY(-50%);color:#008751;text-decoration:none;font-size:22px;font-weight:bold">🔍</a>
  </nav>
</nav>

<div class="hero">
  <h1>⚡ Potentiels du Burkina Faso</h1>
  <p>Agriculture, Mines, Énergie, Tourisme — des richesses immenses encore à valoriser</p>
</div>

<?php
$cat_filtre = isset($_GET['categorie']) ? $_GET['categorie'] : 'toutes';
$nb_total = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM potentiels"))[0];
$nb_cats  = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(DISTINCT categorie) FROM potentiels"))[0];
?>

<div class="container">
  <div class="stats">
    <div class="stat"><strong><?php echo $nb_total; ?></strong><span>Potentiels identifiés</span></div>
    <div class="stat"><strong><?php echo $nb_cats; ?></strong><span>Secteurs clés</span></div>
    <div class="stat"><strong>3ème</strong><span>Producteur d'or en Afrique</span></div>
    <div class="stat"><strong>700K+</strong><span>Tonnes de coton/an</span></div>
  </div>

  <div class="filtres">
    <a href="potentiels.php" class="<?php echo $cat_filtre==='toutes'?'actif':''; ?>">Tous</a>
    <?php
    $cats = mysqli_query($conn, "SELECT DISTINCT categorie FROM potentiels ORDER BY categorie");
    while ($c = mysqli_fetch_assoc($cats)):
    ?>
    <a href="potentiels.php?categorie=<?php echo $c['categorie']; ?>"
       class="<?php echo $cat_filtre===$c['categorie']?'actif':''; ?>">
      <?php echo ucfirst($c['categorie']); ?>
    </a>
    <?php endwhile; ?>
  </div>

  <?php
  if ($cat_filtre === 'toutes') {
    $sql = "SELECT * FROM potentiels ORDER BY categorie, titre";
  } else {
    $cat_safe = mysqli_real_escape_string($conn, $cat_filtre);
    $sql = "SELECT * FROM potentiels WHERE categorie = '$cat_safe' ORDER BY titre";
  }
  $result = mysqli_query($conn, $sql);
  $nb = mysqli_num_rows($result);
  ?>

  <h2 class="section-title">
    <?php echo $cat_filtre==='toutes' ? 'Tous les potentiels' : ucfirst($cat_filtre); ?>
    <small style="font-size:14px;color:#888;font-weight:normal"> — <?php echo $nb; ?> résultat(s)</small>
  </h2>

  <div class="grid">
    <?php while ($p = mysqli_fetch_assoc($result)): ?>
    <div class="card">
      <img src="<?php echo htmlspecialchars($p['image_url'] ?? 'https://via.placeholder.com/600x160/008751/white?text=' . urlencode($p['titre'])); ?>"
           alt="<?php echo htmlspecialchars($p['titre']); ?>"
           onerror="this.src='https://via.placeholder.com/600x160/008751/white?text=<?php echo urlencode($p['titre']); ?>'">
      <div class="card-body <?php echo htmlspecialchars($p['couleur']); ?>">
        <div class="icone"><?php echo $p['icone']; ?></div>
        <span class="badge"><?php echo htmlspecialchars($p['categorie']); ?></span>
        <h3><?php echo htmlspecialchars($p['titre']); ?></h3>
        <p><?php echo htmlspecialchars($p['description']); ?></p>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>

<footer>🇧🇫 Burkina Terres d'Avenir — Projet L3 Web Dynamique PHP + MySQL</footer>
<?php mysqli_close($conn); ?>
<script src="commun.js"></script>
</body>
</html>
