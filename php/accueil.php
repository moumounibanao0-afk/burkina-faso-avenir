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
    .navbar .logo { color: #008751; font-size: 20px; font-weight: bold; text-decoration: none; }
    .navbar nav a { margin-left: 20px; color: #333; text-decoration: none; font-size: 14px; font-weight: bold; }
    .navbar nav a:hover { color: #008751; }
    .hero { background: linear-gradient(135deg, #008751, #005c36); color: white; padding: 80px 30px; text-align: center; }
    .hero h1 { font-size: 48px; margin-bottom: 15px; }
    .hero p { font-size: 18px; opacity: 0.9; margin-bottom: 30px; }
    .hero a { background: #E8B923; color: #333; padding: 14px 35px; border-radius: 30px; text-decoration: none; font-weight: bold; font-size: 16px; }
    .hero a:hover { background: #d4a61e; }
    .stats { display: flex; gap: 20px; justify-content: center; padding: 40px 20px; flex-wrap: wrap; }
    .stat { background: white; padding: 25px 35px; border-radius: 12px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
    .stat strong { display: block; font-size: 32px; color: #008751; }
    .stat span { color: #666; font-size: 14px; }
    .section { max-width: 1100px; margin: 0 auto; padding: 40px 20px; }
    .section h2 { color: #008751; font-size: 28px; margin-bottom: 25px; border-left: 5px solid #E8B923; padding-left: 15px; }
    .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; }
    .card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: transform 0.2s; text-decoration: none; color: inherit; display: block; }
    .card:hover { transform: translateY(-4px); box-shadow: 0 6px 16px rgba(0,0,0,0.15); }
    .card img { width: 100%; height: 150px; object-fit: cover; }
    .card-body { padding: 14px; }
    .card-body h3 { color: #008751; margin-bottom: 5px; }
    .card-body p { font-size: 13px; color: #666; }
    .zone-badge { background: #EF2B2D; color: white; padding: 3px 8px; border-radius: 8px; font-size: 11px; font-weight: bold; }
    .voir-plus { text-align: center; margin-top: 30px; }
    .voir-plus a { background: #008751; color: white; padding: 12px 30px; border-radius: 25px; text-decoration: none; font-weight: bold; }
    footer { background: #111827; color: #aaa; text-align: center; padding: 25px; margin-top: 50px; }
    footer strong { color: white; }
  </style>
</head>
<body>
<div class="flag-stripe"></div>
<nav class="navbar">
  <a class="logo" href="accueil.php">🇧🇫 Burkina Terres d'Avenir</a>
  <nav>
    <a href="accueil.php">Accueil</a>
    <a href="regions.php">Les 17 Régions</a>
    <a href="contact.php">Contact</a>
    <a href="messages.php">Messages</a>
    <a href="recherche.php">🔍 Recherche</a>
  </nav>
</nav>

<div class="hero">
  <h1>🇧🇫 Burkina Terres d'Avenir</h1>
  <p>Découvrez les 17 régions du Burkina Faso — leurs peuples, leurs potentiels, leur richesse.</p>
  <a href="regions.php">Découvrir les régions →</a>
</div>

<?php
// Statistiques depuis MySQL (SELECT COUNT - cours PHP+MySQL)
$total     = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM regions"))[0];
$nb_zones  = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(DISTINCT zone) FROM regions"))[0];
$nb_msgs   = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM messages"))[0];
?>

<div class="stats">
  <div class="stat"><strong><?php echo $total; ?></strong><span>Régions</span></div>
  <div class="stat"><strong>45</strong><span>Provinces</span></div>
  <div class="stat"><strong><?php echo $nb_zones; ?></strong><span>Zones géographiques</span></div>
  <div class="stat"><strong><?php echo $nb_msgs; ?></strong><span>Messages reçus</span></div>
</div>

<div class="section">
  <h2>🗺️ Aperçu des régions</h2>
  <div class="grid">
<?php
// SELECT depuis MySQL (cours : requête d'affichage)
$sql = "SELECT * FROM regions ORDER BY RAND() LIMIT 6";
$result = mysqli_query($conn, $sql);

while ($region = mysqli_fetch_assoc($result)):
?>
    <a class="card" href="regions.php?zone=<?php echo urlencode($region['zone']); ?>">
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

<div class="section" style="background:white; border-radius:12px; padding:30px; margin-bottom:20px;">
  <h2>📩 Nous contacter</h2>
  <p style="color:#666; margin-bottom:20px;">Une question sur une région ? Un partenariat ? Écrivez-nous !</p>
  <a href="contact.php" style="background:#E8B923;color:#333;padding:12px 30px;border-radius:25px;text-decoration:none;font-weight:bold;">
    Envoyer un message
  </a>
</div>

<footer>
  <strong>Burkina Terres d'Avenir</strong><br>
  Projet L3 Informatique — Web Dynamique PHP + MySQL — 🇧🇫 La Terre des Hommes Intègres
</footer>

<?php mysqli_close($conn); ?>
</body>
</html>
