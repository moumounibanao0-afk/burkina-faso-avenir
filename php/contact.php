<?php require 'conn.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Contact — Burkina Terres d'Avenir</title>
  <style>
    body { font-family: Arial, sans-serif; background: #F5F0E8; margin: 0; padding: 0; }
    .flag-stripe { height: 6px; background: linear-gradient(90deg, #EF2B2D 50%, #009A00 50%); }
    .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .navbar .logo { color: #008751; font-size: 20px; font-weight: bold; text-decoration: none; }
    .navbar nav a { margin-left: 20px; color: #333; text-decoration: none; font-size: 14px; font-weight: bold; }
    .navbar nav a:hover, .navbar nav a.actif { color: #008751; border-bottom: 2px solid #008751; }
    .container { max-width: 600px; margin: 40px auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    h1 { color: #008751; border-bottom: 3px solid #008751; padding-bottom: 10px; }
    label { display: block; margin-top: 15px; font-weight: bold; color: #333; }
    input, textarea, select { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; font-size: 14px; }
    button { margin-top: 20px; background: #008751; color: white; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; width: 100%; }
    button:hover { background: #006a3e; }
    .success { background: #e8f5e9; border: 1px solid #008751; color: #008751; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
    .error { background: #ffebee; border: 1px solid #c62828; color: #c62828; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
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
</nav>

<div class="container">
  <h1>📩 Formulaire de Contact</h1>
  <p style="color:#666">Contactez-nous via ce formulaire PHP connecté à MySQL.</p>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nom     = trim($_POST['nom']);
  $email   = trim($_POST['email']);
  $sujet   = trim($_POST['sujet']);
  $message = trim($_POST['message']);

  if (empty($nom) || empty($email) || empty($message)) {
    echo '<div class="error">⚠️ Les champs Nom, Email et Message sont obligatoires.</div>';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '<div class="error">⚠️ Adresse email invalide.</div>';
  } else {
    $stmt = mysqli_prepare($conn,
      'INSERT INTO messages (nom, email, sujet, message) VALUES (?, ?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'ssss', $nom, $email, $sujet, $message);
    if (mysqli_stmt_execute($stmt)) {
      $id = mysqli_insert_id($conn);
      echo '<div class="success">✅ Message envoyé avec succès ! (ID : ' . $id . ')</div>';
    } else {
      echo '<div class="error">❌ Erreur lors de l\'enregistrement.</div>';
    }
    mysqli_stmt_close($stmt);
  }
}
?>

  <form method="POST" action="contact.php">
    <label>Nom complet *</label>
    <input type="text" name="nom" placeholder="Ex: Moumouni BANAO"
           value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>">

    <label>Email *</label>
    <input type="email" name="email" placeholder="votre@email.com"
           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

    <label>Sujet</label>
    <select name="sujet">
      <option value="">-- Choisir un sujet --</option>
      <option value="Question">Question</option>
      <option value="Suggestion">Suggestion</option>
      <option value="Correction d'une information">Correction d'une information</option>
      <option value="Partenariat">Partenariat</option>
    </select>

    <label>Message *</label>
    <textarea name="message" rows="5" placeholder="Votre message..."><?php
      echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';
    ?></textarea>

    <button type="submit">📨 Envoyer le message</button>
  </form>
</div>

<footer>🇧🇫 Burkina Terres d'Avenir — Projet L3 Web Dynamique PHP + MySQL</footer>
<?php mysqli_close($conn); ?>
<script src="commun.js"></script>
</body>
</html>
