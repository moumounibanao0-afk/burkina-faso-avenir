<?php require 'conn.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Les 17 Régions — Burkina Terres d'Avenir</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 0; }
    .navbar { background: #008751; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
    .navbar a { color: white; text-decoration: none; font-weight: bold; font-size: 18px; }
    .navbar nav a { margin-left: 20px; font-size: 14px; }
    .container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }
    h1 { color: #008751; text-align: center; }
    .stats { display: flex; gap: 20px; justify-content: center; margin: 20px 0; flex-wrap: wrap; }
    .stat { background: #008751; color: white; padding: 15px 25px; border-radius: 10px; text-align: center; }
    .stat strong { display: block; font-size: 24px; }
    .filtres { text-align: center; margin: 20px 0; }
    .filtres a { display: inline-block; margin: 5px; padding: 8px 18px; background: white; border: 2px solid #008751; color: #008751; border-radius: 20px; text-decoration: none; font-weight: bold; }
    .filtres a.actif, .filtres a:hover { background: #008751; color: white; }
    .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-top: 20px; }
    .card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    .card img { width: 100%; height: 160px; object-fit: cover; }
    .card-body { padding: 15px; }
    .card-body h3 { color: #008751; margin: 0 0 5px; }
    .card-body p { color: #555; font-size: 13px; margin: 5px 0; }
    .zone-badge { display: inline-block; background: #EF2B2D; color: white; padding: 3px 10px; border-radius: 10px; font-size: 11px; font-weight: bold; }
    .peuples { color: #1B4F72; font-size: 12px; }
    .potentiels { color: #008751; font-size: 12px; }
  </style>
</head>
<body>
<div class="navbar">
  <a href="/">🇧🇫 Burkina Terres d'Avenir</a>
  <nav>
    <a href="/">Accueil</a>
    <a href="regions.php">Les 17 Régions</a>
    <a href="contact.php">Contact</a>
    <a href="messages.php">Messages</a>
  </nav>
</div>

<div class="container">
  <h1>🗺️ Les 17 Régions du Burkina Faso</h1>

<?php
// Filtre par zone via $_GET (cours : variables superglobales)
$zone_filtre = isset($_GET['zone']) ? $_GET['zone'] : 'toutes';

// Requête SELECT selon le cours PHP + MySQL
if ($zone_filtre === 'toutes') {
    $sql = "SELECT * FROM regions ORDER BY nom";
    $result = mysqli_query($conn, $sql);
} else {
    $zone_safe = mysqli_real_escape_string($conn, $zone_filtre);
    $sql = "SELECT * FROM regions WHERE zone = '$zone_safe' ORDER BY nom";
    $result = mysqli_query($conn, $sql);
}

$nb_regions = mysqli_num_rows($result);

// Récupérer toutes les zones distinctes
$sql_zones = "SELECT DISTINCT zone FROM regions ORDER BY zone";
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
<?php
// Affichage avec foreach selon le cours
while ($region = mysqli_fetch_assoc($result)):
?>
    <div class="card">
      <img src="<?php echo htmlspecialchars($region['image_url']); ?>"
           alt="<?php echo htmlspecialchars($region['nom']); ?>"
           onerror="this.src='https://via.placeholder.com/600x160/008751/white?text=<?php echo urlencode($region['nom']); ?>'">
      <div class="card-body">
        <span class="zone-badge"><?php echo strtoupper($region['zone']); ?></span>
        <h3><?php echo htmlspecialchars($region['nom']); ?></h3>
        <p>🏛️ <strong>Chef-lieu :</strong> <?php echo htmlspecialchars($region['chef_lieu']); ?></p>
        <p><?php echo htmlspecialchars($region['description']); ?></p>
        <p class="peuples">👥 <?php echo htmlspecialchars($region['peuples']); ?></p>
        <p class="potentiels">⚡ <?php echo htmlspecialchars($region['potentiels']); ?></p>
      </div>
    </div>
<?php endwhile; ?>
  </div>
</div>

<?php mysqli_close($conn); ?>
</body>
</html>
