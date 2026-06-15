<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Contact — Burkina Terres d'Avenir</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 20px; }
    .container { max-width: 600px; margin: 40px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    h1 { color: #008751; border-bottom: 3px solid #008751; padding-bottom: 10px; }
    label { display: block; margin-top: 15px; font-weight: bold; color: #333; }
    input, textarea, select { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; font-size: 14px; }
    button { margin-top: 20px; background: #008751; color: white; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; width: 100%; }
    button:hover { background: #006a3e; }
    .success { background: #e8f5e9; border: 1px solid #008751; color: #008751; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
    .error { background: #ffebee; border: 1px solid #c62828; color: #c62828; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
    .navbar { background: #008751; padding: 15px 30px; margin: -20px -20px 30px; }
    .navbar a { color: white; text-decoration: none; font-weight: bold; font-size: 18px; }
  </style>
</head>
<body>
<div class="navbar">
  <a href="/">🇧🇫 Burkina Terres d'Avenir</a>
</div>
<div class="container">
  <h1>📩 Formulaire de Contact</h1>
  <p style="color:#666">Contactez-nous via ce formulaire PHP connecté à MySQL.</p>

<?php
require 'conn.php';

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

  <hr style="margin-top:30px">
  <h2 style="color:#1B4F72">📋 Messages reçus</h2>
<?php
$result = mysqli_query($conn, 'SELECT * FROM messages ORDER BY date_envoi DESC');
$nb = mysqli_num_rows($result);
echo '<p><strong>' . $nb . ' message(s) reçu(s)</strong></p>';

if ($nb > 0) {
  echo '<table border="1" cellpadding="8" cellspacing="0" style="width:100%;border-collapse:collapse">';
  echo '<tr style="background:#008751;color:white">
    <th>ID</th><th>Nom</th><th>Email</th><th>Sujet</th><th>Message</th><th>Date</th>
  </tr>';
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr style="background:' . ($row['id'] % 2 === 0 ? '#f9f9f9' : 'white') . '">';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . htmlspecialchars($row['nom']) . '</td>';
    echo '<td>' . htmlspecialchars($row['email']) . '</td>';
    echo '<td>' . htmlspecialchars($row['sujet']) . '</td>';
    echo '<td>' . htmlspecialchars($row['message']) . '</td>';
    echo '<td>' . $row['date_envoi'] . '</td>';
    echo '</tr>';
  }
  echo '</table>';
} else {
  echo '<p style="color:#888">Aucun message pour le moment.</p>';
}

mysqli_close($conn);
?>
</div>
</body>
</html>
