<?php require 'conn.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Les 17 Régions — Burkina Terres d'Avenir</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 0; }
    .flag-stripe { height: 6px; background: linear-gradient(90deg, #EF2B2D 50%, #009A00 50%); }
    .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .navbar .logo { color: #008751; font-size: 20px; font-weight: bold; text-decoration: none; }
    .navbar nav a { margin-left: 20px; color: #333; text-decoration: none; font-size: 14px; font-weight: bold; }
    .navbar nav a:hover { color: #008751; }
    .container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }
    h1 { color: #008751; text-align: center; }
    .stats { display: flex; gap: 20px; justify-content: center; margin: 20px 0; flex-wrap: wrap; }
    .stat { background: #008751; color: white; padding: 15px 25px; border-radius: 10px; text-align: center; }
    .stat strong { display: block; font-size: 24px; }
    .filtres { text-align: center; margin: 20px 0; }
    .filtres a { display: inline-block; margin: 5px; padding: 8px 18px; background: white; border: 2px solid #008751; color: #008751; border-radius: 20px; text-decoration: none; font-weight: bold; }
    .filtres a.actif, .filtres a:hover { background: #008751; color: white; }
    .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-top: 20px; }
    .card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-decoration: none; color: inherit; display: block; transition: transform 0.2s; }
    .card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,135,81,0.2); }
    .card img { width: 100%; height: 160px; object-fit: cover; }
    .card-body { padding: 15px; }
    .card-body h3 { color: #008751; margin: 0 0 5px; }
    .card-body p { color: #555; font-size: 13px; margin: 5px 0; }
    .zone-badge { display: inline-block; background: #EF2B2D; color: white; padding: 3px 10px; border-radius: 10px; font-size: 11px; font-weight: bold; }
    .peuples { color: #1B4F72; font-size: 12px; }
    .potentiels { color: #008751; font-size: 12px; }
    .voir-plus { display: inline-block; margin-top: 10px; color: #008751; font-size: 12px; font-weight: bold; }
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

<div class="container">
  <h1>🗺️ Les 17 Régions du Burkina Faso</h1>

<?php
$zone_filtre = isset($_GET["zone"]) ? $_GET["zone"] : "toutes";
$page = isset($_GET["page"]) ? max(1, intval($_GET["page"])) : 1;
$par_page = 17;
$offset = ($page - 1) * $par_page;

if ($zone_filtre === "toutes") {
  $total = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM regions"))[0];
  $sql = "SELECT * FROM regions ORDER BY nom LIMIT $par_page OFFSET $offset";
} else {
  $zone_safe = mysqli_real_escape_string($conn, $zone_filtre);
  $total = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM regions WHERE zone='$zone_safe'"))[0];
  $sql = "SELECT * FROM regions WHERE zone='$zone_safe' ORDER BY nom LIMIT $par_page OFFSET $offset";
}
$result = mysqli_query($conn, $sql);
$nb_regions = mysqli_num_rows($result);
$nb_pages = ceil($total / $par_page);
$sql_zones = "SELECT DISTINCT zone FROM regions ORDER BY zone";
$result_zones = mysqli_query($conn, $sql_zones);
$result_zones = mysqli_query($conn, $sql_zones);
?>

  <div class="stats">
    <div class="stat"><strong>17</strong> Régions</div>
    <div class="stat"><strong>45</strong> Provinces</div>
    <div class="stat"><strong>351</strong> Départements</div>
    <div class="stat"><strong><?php echo $nb_regions; ?></strong> Affichées</div>
  </div>

  <div class="filtres">
    <a href="regions.php" class="<?php echo $zone_filtre==='toutes' ? 'actif' : ''; ?>">Toutes</a>
    <?php while ($z = mysqli_fetch_assoc($result_zones)): ?>
    <a href="regions.php?zone=<?php echo htmlspecialchars($z['zone']); ?>"
       class="<?php echo $zone_filtre===$z['zone'] ? 'actif' : ''; ?>">
      <?php echo strtoupper($z['zone']); ?>
    </a>
    <?php endwhile; ?>
  </div>

  <div class="grid">
<?php while ($region = mysqli_fetch_assoc($result)): ?>
    <a class="card" href="region.php?id=<?php echo $region['id']; ?>">
      <img src="<?php echo htmlspecialchars($region['image_url']); ?>"
           alt="<?php echo htmlspecialchars($region['nom']); ?>"
           onerror="this.src='https://via.placeholder.com/600x160/008751/white?text=<?php echo urlencode($region['nom']); ?>'">
      <div class="card-body">
        <span class="zone-badge"><?php echo strtoupper($region['zone']); ?></span>
        <h3><?php echo htmlspecialchars($region['nom']); ?></h3>
        <p>🏛️ <strong><?php echo htmlspecialchars($region['chef_lieu']); ?></strong></p>
        <p><?php echo htmlspecialchars(substr($region['description'], 0, 80)); ?>...</p>
        <p class="peuples">👥 <?php echo htmlspecialchars($region['peuples']); ?></p>
        <p class="potentiels">⚡ <?php echo htmlspecialchars($region['potentiels']); ?></p>
        <span class="voir-plus">Voir le détail →</span>
      </div>
    </a>
<?php endwhile; ?>
  </div>
</div>

<footer>🇧🇫 Burkina Terres d'Avenir — Projet L3 Web Dynamique PHP + MySQL</footer>
<?php mysqli_close($conn); ?>
<script src="commun.js"></script>
</body>
</html>
