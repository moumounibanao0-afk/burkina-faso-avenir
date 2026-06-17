<?php
require 'conn.php';

// Récupérer l'id via $_GET
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
  header('Location: regions.php');
  exit;
}

$sql = "SELECT * FROM regions WHERE id = $id";
$result = mysqli_query($conn, $sql);
$region = mysqli_fetch_assoc($result);

if (!$region) {
  header('Location: regions.php');
  exit;
}

// Région précédente et suivante
$prev = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, nom FROM regions WHERE id < $id ORDER BY id DESC LIMIT 1"));
$next = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, nom FROM regions WHERE id > $id ORDER BY id ASC LIMIT 1"));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($region['nom']); ?> — Burkina Terres d'Avenir</title>
  <style>
    body { font-family: Arial, sans-serif; background: #F5F0E8; margin: 0; }
    .flag-stripe { height: 6px; background: linear-gradient(90deg, #EF2B2D 50%, #009A00 50%); }
    .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .navbar .logo { color: #008751; font-size: 20px; font-weight: bold; text-decoration: none; }
    .navbar nav a { margin-left: 20px; color: #333; text-decoration: none; font-size: 14px; font-weight: bold; }
    .navbar nav a:hover { color: #008751; }
    .hero { position: relative; height: 350px; overflow: hidden; }
    .hero img { width: 100%; height: 100%; object-fit: cover; }
    .hero-overlay { position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.75)); display: flex; align-items: flex-end; padding: 40px; }
    .hero-overlay h1 { color: white; font-size: 48px; margin: 0; }
    .hero-overlay .zone { background: #EF2B2D; color: white; padding: 5px 15px; border-radius: 20px; font-size: 13px; font-weight: bold; margin-left: 15px; }
    .container { max-width: 900px; margin: 40px auto; padding: 0 20px; }
    .info-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; margin-bottom: 30px; }
    .info-card { background: white; border-radius: 12px; padding: 20px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    .info-card .label { color: #888; font-size: 12px; text-transform: uppercase; margin-bottom: 5px; }
    .info-card .value { color: #008751; font-size: 22px; font-weight: bold; }
    .section { background: white; border-radius: 12px; padding: 25px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    .section h2 { color: #008751; border-left: 4px solid #E8B923; padding-left: 12px; margin: 0 0 15px; }
    .section p { color: #555; line-height: 1.7; margin: 0; }
    .tags { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; }
    .tag { background: #f0f0f0; color: #333; padding: 6px 14px; border-radius: 20px; font-size: 13px; }
    .tag.vert { background: #e8f5e9; color: #008751; }
    .tag.rouge { background: #ffebee; color: #EF2B2D; }
    .nav-regions { display: flex; justify-content: space-between; margin: 30px 0; }
    .nav-btn { background: #008751; color: white; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: bold; }
    .nav-btn.retour { background: white; color: #008751; border: 2px solid #008751; }
    .nav-btn:hover { opacity: 0.85; }
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
    <a href="contact.php">Contact</a>
  </nav>
</nav>

<div class="hero">
  <img src="<?php echo htmlspecialchars($region['image_url']); ?>"
       alt="<?php echo htmlspecialchars($region['nom']); ?>"
       onerror="this.src='https://via.placeholder.com/900x350/008751/white?text=<?php echo urlencode($region['nom']); ?>'">
  <div class="hero-overlay">
    <h1><?php echo htmlspecialchars($region['nom']); ?></h1>
    <span class="zone"><?php echo strtoupper($region['zone']); ?></span>
  </div>
</div>

<div class="container">

  <div class="info-grid">
    <div class="info-card">
      <div class="label">Chef-lieu</div>
      <div class="value" style="font-size:16px"><?php echo htmlspecialchars($region['chef_lieu']); ?></div>
    </div>
    <div class="info-card">
      <div class="label">Provinces</div>
      <div class="value"><?php echo $region['provinces']; ?></div>
    </div>
    <div class="info-card">
      <div class="label">Zone</div>
      <div class="value" style="font-size:14px"><?php echo htmlspecialchars($region['zone']); ?></div>
    </div>
  </div>

  <div class="section">
    <h2>📋 Description</h2>
    <p><?php echo htmlspecialchars($region['description']); ?></p>
  </div>

  <div class="section">
    <h2>👥 Peuples</h2>
    <div class="tags">
      <?php foreach(explode(',', $region['peuples']) as $p): ?>
      <span class="tag rouge"><?php echo htmlspecialchars(trim($p)); ?></span>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="section">
    <h2>⚡ Potentiels économiques</h2>
    <div class="tags">
      <?php foreach(explode(',', $region['potentiels']) as $p): ?>
      <span class="tag vert"><?php echo htmlspecialchars(trim($p)); ?></span>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="nav-regions">
    <?php if ($prev): ?>
    <a href="region.php?id=<?php echo $prev['id']; ?>" class="nav-btn">← <?php echo htmlspecialchars($prev['nom']); ?></a>
    <?php else: ?>
    <span></span>
    <?php endif; ?>

    <a href="regions.php" class="nav-btn retour">🗺️ Toutes les régions</a>

    <?php if ($next): ?>
    <a href="region.php?id=<?php echo $next['id']; ?>" class="nav-btn"><?php echo htmlspecialchars($next['nom']); ?> →</a>
    <?php else: ?>
    <span></span>
    <?php endif; ?>
  </div>

</div>

<footer>🇧🇫 Burkina Terres d'Avenir — Projet L3 Web Dynamique PHP + MySQL</footer>
<?php mysqli_close($conn); ?>
</body>
</html>
