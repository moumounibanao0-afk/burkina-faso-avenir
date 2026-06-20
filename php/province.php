<?php
require 'conn.php';
require 'tracker.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) { header('Location: regions.php'); exit; }

$sql = "SELECT * FROM provinces WHERE id = $id";
$result = mysqli_query($conn, $sql);
$province = mysqli_fetch_assoc($result);
if (!$province) { header('Location: regions.php'); exit; }

$region_nom_safe = mysqli_real_escape_string($conn, $province['region_nom']);
$region = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM regions WHERE nom = '$region_nom_safe'"));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($province['nom']); ?> — Burkina Terres d'Avenir</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; background: #F5F0E8; }
    .flag-stripe { height: 6px; background: linear-gradient(90deg, #EF2B2D 50%, #009A00 50%); }
    .navbar { background: white; padding: 12px 30px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .navbar .logo { color: #008751; font-size: 22px; font-weight: bold; text-decoration: none; }
    .hero { position: relative; height: 280px; overflow: hidden; }
    .hero img { width: 100%; height: 100%; object-fit: cover; }
    .hero-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.75)); display: flex; align-items: flex-end; padding: 30px; }
    .hero-overlay h1 { color: white; font-size: 44px; margin: 0; }
    .container { max-width: 800px; margin: 30px auto; padding: 0 20px; }
    .breadcrumb { background: white; border-radius: 8px; padding: 12px 20px; margin-bottom: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.06); font-size: 26px; }
    .breadcrumb a { color: #008751; text-decoration: none; }
    .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 15px; margin-bottom: 25px; }
    .info-card { background: white; border-radius: 12px; padding: 18px 10px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    .info-card .label { color: #888; font-size: 22px; text-transform: uppercase; margin-bottom: 5px; }
    .info-card .value { color: #008751; font-size: 20px; font-weight: bold; }
    .section { background: white; border-radius: 12px; padding: 25px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    .section h2 { color: #008751; border-left: 4px solid #E8B923; padding-left: 12px; margin-bottom: 15px; font-size: 36px; }
    .section p { color: #444; line-height: 1.7; font-size: 32px; }
    .btn-retour { display: inline-block; background: #008751; color: white; padding: 10px 25px; border-radius: 25px; text-decoration: none; font-weight: bold; margin-top: 10px; font-size: 18px; }
    footer { background: #111827; color: #aaa; text-align: center; padding: 20px; margin-top: 40px; }
  </style>
</head>
<body>
<div class="flag-stripe"></div>
<nav class="navbar">
  <a class="logo" href="accueil.php">🇧🇫 Burkina Terres d'Avenir</a>
</nav>

<div class="hero">
  <img src="<?php echo htmlspecialchars($province['image_url'] ?: 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=1200'); ?>"
       alt="<?php echo htmlspecialchars($province['nom']); ?>"
       onerror="this.onerror=null;this.src='https://via.placeholder.com/1200x280/008751/white?text=<?php echo urlencode($province['nom']); ?>'">
  <div class="hero-overlay">
    <h1>🏛️ <?php echo htmlspecialchars($province['nom']); ?></h1>
  </div>
</div>

<div class="container">
  <div class="breadcrumb">
    <a href="accueil.php">🏠 Accueil</a> ›
    <a href="regions.php">🗺️ Régions</a> ›
    <a href="region.php?id=<?php echo $region['id']; ?>"><?php echo htmlspecialchars($region['nom']); ?></a> ›
    <span style="color:#333;font-weight:bold"><?php echo htmlspecialchars($province['nom']); ?></span>
  </div>

  <div class="info-grid">
    <div class="info-card">
      <div class="label">Chef-lieu</div>
      <div class="value"><?php echo htmlspecialchars($province['chef_lieu'] ?: '—'); ?></div>
    </div>
    <div class="info-card">
      <div class="label">Population</div>
      <div class="value"><?php echo htmlspecialchars($province['population'] ?: '—'); ?></div>
    </div>
    <div class="info-card">
      <div class="label">Superficie</div>
      <div class="value"><?php echo htmlspecialchars($province['superficie'] ?: '—'); ?></div>
    </div>
    <div class="info-card">
      <div class="label">Région</div>
      <div class="value"><?php echo htmlspecialchars($region['nom']); ?></div>
    </div>
  </div>

  <div class="section">
    <h2>📋 Description</h2>
    <p><?php echo nl2br(htmlspecialchars($province['description'] ?: 'Aucune description disponible pour le moment.')); ?></p>
  </div>

  <a href="region.php?id=<?php echo $region['id']; ?>" class="btn-retour">← Retour à <?php echo htmlspecialchars($region['nom']); ?></a>
</div>

<footer>🇧🇫 Burkina Terres d'Avenir — Projet L3 Web Dynamique PHP + MySQL</footer>
<?php mysqli_close($conn); ?>
<script src="commun.js"></script>
</body>
</html>
