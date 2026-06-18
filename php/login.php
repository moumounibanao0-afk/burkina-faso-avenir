<?php
session_start();

// Si déjà connecté → rediriger vers admin
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
  header('Location: admin.php');
  exit;
}

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $login = trim($_POST['login'] ?? '');
  $mdp   = trim($_POST['mdp'] ?? '');

  // Identifiants admin
  if ($login === 'admin' && $mdp === '1234') {
    session_regenerate_id(true);
    $_SESSION['admin'] = true;
    $_SESSION['login'] = $login;
    $_SESSION['heure'] = date('H:i');
    header('Location: admin.php');
    exit;
  } else {
    $erreur = 'Login ou mot de passe incorrect.';
  }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion Admin — Burkina Terres d'Avenir</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; background: #F5F0E8; min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; }
    .flag-stripe { height: 6px; background: linear-gradient(90deg, #EF2B2D 50%, #009A00 50%); width: 100%; position: fixed; top: 0; }
    .card { background: white; border-radius: 16px; padding: 40px; max-width: 400px; width: 90%; box-shadow: 0 8px 30px rgba(0,0,0,0.12); text-align: center; }
    .logo { font-size: 48px; margin-bottom: 10px; }
    h1 { color: #008751; font-size: 22px; margin-bottom: 5px; }
    p { color: #888; font-size: 13px; margin-bottom: 25px; }
    label { display: block; text-align: left; font-size: 13px; font-weight: bold; color: #555; margin-bottom: 5px; }
    input { width: 100%; padding: 12px 15px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 14px; margin-bottom: 15px; outline: none; }
    input:focus { border-color: #008751; }
    button { width: 100%; background: #008751; color: white; border: none; padding: 13px; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; }
    button:hover { background: #006a3e; }
    .erreur { background: #ffebee; color: #EF2B2D; padding: 12px; border-radius: 8px; margin-bottom: 15px; font-size: 13px; border: 1px solid #EF2B2D; }
    .retour { display: block; margin-top: 15px; color: #008751; text-decoration: none; font-size: 13px; }
  </style>
</head>
<body>
<div class="flag-stripe"></div>
<div class="card">
  <div class="logo">🇧🇫</div>
  <h1>Espace Administrateur</h1>
  <p>Burkina Terres d'Avenir — Accès réservé</p>

  <?php if ($erreur): ?>
  <div class="erreur">❌ <?php echo htmlspecialchars($erreur); ?></div>
  <?php endif; ?>

  <form method="POST" action="login.php">
    <label>Login</label>
    <input type="text" name="login" placeholder="admin" required autocomplete="off">
    <label>Mot de passe</label>
    <input type="password" name="mdp" placeholder="••••••" required>
    <button type="submit">🔐 Se connecter</button>
  </form>
  <a href="accueil.php" class="retour">← Retour au site</a>
</div>
</body>
</html>
