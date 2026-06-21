<?php
require_once 'Auth.class.php';
session_start();
if (!Auth::estConnecte()) {
  header('Location: login.php');
  exit;
}
require 'conn.php';

/**
 * Gère l'upload d'une photo depuis l'ordinateur de l'utilisateur.
 * Retourne le chemin local du fichier sauvegardé, ou null si aucun
 * fichier valide n'a été envoyé (l'appelant doit alors garder l'URL existante).
 */
function gererUpload($champ_fichier) {
  if (!isset($_FILES[$champ_fichier]) || $_FILES[$champ_fichier]['error'] !== UPLOAD_ERR_OK || $_FILES[$champ_fichier]['size'] <= 0) {
    return null;
  }
  $extensions_autorisees = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
  $ext = strtolower(pathinfo($_FILES[$champ_fichier]['name'], PATHINFO_EXTENSION));
  if (!in_array($ext, $extensions_autorisees)) {
    return null;
  }
  if ($_FILES[$champ_fichier]['size'] > 5 * 1024 * 1024) { // 5 Mo max
    return null;
  }
  if (!is_dir('uploads')) {
    mkdir('uploads', 0755, true);
  }
  $nom_fichier = uniqid('img_') . '.' . $ext;
  $chemin_destination = 'uploads/' . $nom_fichier;
  if (move_uploaded_file($_FILES[$champ_fichier]['tmp_name'], $chemin_destination)) {
    return $chemin_destination;
  }
  return null;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Admin — Burkina Terres d'Avenir</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; background: #F5F0E8; }
    .flag-stripe { height: 6px; background: linear-gradient(90deg, #EF2B2D 50%, #009A00 50%); }
    .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .navbar .logo { color: #008751; font-size: 18px; font-weight: bold; text-decoration: none; }
    .navbar nav a { margin-left: 15px; color: #333; text-decoration: none; font-size: 13px; font-weight: bold; }
    .navbar nav a:hover { color: #008751; }
    .hero { background: linear-gradient(135deg, #1B4F72, #008751); color: white; padding: 40px 30px; text-align: center; }
    .hero h1 { font-size: 32px; margin-bottom: 8px; }
    .container { max-width: 1100px; margin: 30px auto; padding: 0 20px; }
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; margin-bottom: 30px; }
    .stat-card { background: white; border-radius: 12px; padding: 20px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-top: 4px solid #008751; }
    .stat-card strong { display: block; font-size: 36px; color: #008751; }
    .stat-card span { color: #666; font-size: 13px; }
    .section { background: white; border-radius: 12px; padding: 25px; margin-bottom: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    .section h2 { color: #008751; border-left: 4px solid #E8B923; padding-left: 12px; margin-bottom: 20px; font-size: 20px; }
    .charts-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-bottom: 25px; }
    .chart-box { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    .chart-box h3 { color: #008751; margin-bottom: 15px; font-size: 16px; }
    table { width: 100%; border-collapse: collapse; }
    th { background: #008751; color: white; padding: 10px 12px; text-align: left; font-size: 13px; }
    td { padding: 10px 12px; border-bottom: 1px solid #eee; font-size: 13px; }
    tr:nth-child(even) { background: #f9f9f9; }
    .badge { background: #e8f5e9; color: #008751; padding: 2px 8px; border-radius: 8px; font-size: 11px; font-weight: bold; }
    .badge.rouge { background: #ffebee; color: #EF2B2D; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
    .form-group { display: flex; flex-direction: column; gap: 5px; }
    .form-group label { font-size: 13px; font-weight: bold; color: #555; }
    .form-group input, .form-group select, .form-group textarea { padding: 10px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 13px; outline: none; }
    .form-group input:focus, .form-group textarea:focus { border-color: #008751; }
    .form-group.full { grid-column: 1 / -1; }
    .btn { padding: 10px 25px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 14px; }
    .btn-green { background: #008751; color: white; }
    .btn-green:hover { background: #006a3e; }
    .btn-red { background: #EF2B2D; color: white; font-size: 12px; padding: 5px 10px; }
    .success { background: #e8f5e9; color: #008751; padding: 12px; border-radius: 8px; margin-bottom: 15px; }
    .vues-bar { background: #e8f5e9; border-radius: 4px; height: 8px; margin-top: 4px; }
    .vues-fill { background: #008751; height: 8px; border-radius: 4px; }
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
  </style>
</head>
<body>
<div class="flag-stripe"></div>
<nav class="navbar">
  <a class="logo" href="accueil.php">🇧🇫 Burkina Terres d'Avenir</a>
  <nav style="display:flex;justify-content:center;align-items:center;gap:10px;flex-wrap:wrap">
    <div class="dropdown">
      <button class="dropbtn admin">⚙️ Admin ▾</button>
      <div class="dropdown-content">
        <a href="admin.php">⚙️ Tableau de bord</a>
        <a href="messages.php">💬 Messages</a>
        <a href="logout.php">🚪 Déconnexion</a>
      </div>
    </div>
    <a href="accueil.php" style="background:#008751;color:white;padding:8px 16px;border-radius:20px;text-decoration:none;font-size:13px;font-weight:bold">← Retour au site</a>
  </nav>
</nav>

<div class="hero">
  <h1>⚙️ Tableau de bord Admin</h1>
  <p>Gestion du site Burkina Terres d'Avenir</p>
</div>

<?php
// Traitement formulaire ajout région
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
  if ($_POST['action'] === 'ajouter') {
    $nom       = mysqli_real_escape_string($conn, trim($_POST['nom']));
    $chef_lieu = mysqli_real_escape_string($conn, trim($_POST['chef_lieu']));
    $zone      = mysqli_real_escape_string($conn, trim($_POST['zone']));
    $desc      = mysqli_real_escape_string($conn, trim($_POST['description']));
    $peuples   = mysqli_real_escape_string($conn, trim($_POST['peuples']));
    $potentiels= mysqli_real_escape_string($conn, trim($_POST['potentiels']));
    $image_url = mysqli_real_escape_string($conn, trim($_POST['image_url']));
    $fichier_uploade = gererUpload('photo_region');
    if ($fichier_uploade) { $image_url = $fichier_uploade; }
    $provinces = intval($_POST['provinces']);

    $sql = "INSERT INTO regions (nom, chef_lieu, zone, description, peuples, potentiels, image_url, provinces)
            VALUES ('$nom','$chef_lieu','$zone','$desc','$peuples','$potentiels','$image_url',$provinces)";
    if (mysqli_query($conn, $sql)) {
      $msg = "✅ Région '$nom' ajoutée avec succès !";
    } else {
      $msg = "❌ Erreur : " . mysqli_error($conn);
    }
  }
  if ($_POST['action'] === 'supprimer') {
    $id = intval($_POST['region_id']);
    if ($id > 0) {
      $r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nom FROM regions WHERE id=$id"));
      if ($r) {
        $nom_region_safe = mysqli_real_escape_string($conn, $r['nom']);
        $nb_prov_liees = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM provinces WHERE region_nom = '$nom_region_safe'"))[0];
        if ($nb_prov_liees > 0) {
          $msg = "❌ Impossible de supprimer '{$r['nom']}' : cette région a encore $nb_prov_liees province(s) rattachée(s). Supprime-les d'abord (directement en base de données), puis réessaie.";
        } else {
          mysqli_query($conn, "DELETE FROM regions WHERE id=$id");
          $msg = "✅ Région '{$r['nom']}' supprimée.";
        }
      }
    }
  }
  if ($_POST['action'] === 'supprimer_message') {
    $id_msg = intval($_POST['id_message']);
    if ($id_msg > 0) {
      mysqli_query($conn, "DELETE FROM messages WHERE id=$id_msg");
      $msg = "✅ Message supprimé.";
    }
  }
    if ($_POST['action'] === 'maj_photo_region') {
    $id_region = intval($_POST['id_region']);
    $url_r = trim($_POST['url_region']);
    $fichier_uploade = gererUpload('photo_region_simple');
    if ($fichier_uploade) { $url_r = $fichier_uploade; }
    $url_r = mysqli_real_escape_string($conn, $url_r);
    if ($id_region > 0) {
      mysqli_query($conn, "UPDATE regions SET image_url='$url_r' WHERE id=$id_region");
      $msg = "✅ Photo de la région mise à jour !";
    }
  }
  if ($_POST['action'] === 'maj_photo_hero') {
    $page_hero = mysqli_real_escape_string($conn, trim($_POST['page_hero']));
    $url_h = trim($_POST['url_hero']);
    $fichier_uploade = gererUpload('photo_hero');
    if ($fichier_uploade) { $url_h = $fichier_uploade; }
    $url_h = mysqli_real_escape_string($conn, $url_h);
    mysqli_query($conn, "UPDATE images_hero SET image_url='$url_h' WHERE page='$page_hero'");
    $msg = "✅ Image de fond mise à jour !";
  }
  if ($_POST['action'] === 'maj_photo_peuple') {
    $nom_p = mysqli_real_escape_string($conn, trim($_POST['nom_peuple']));
    $url_p = trim($_POST['url_peuple']);
    $fichier_uploade = gererUpload('photo_peuple');
    if ($fichier_uploade) { $url_p = $fichier_uploade; }
    $url_p = mysqli_real_escape_string($conn, $url_p);
    mysqli_query($conn, "UPDATE images_peuples SET image_url='$url_p' WHERE nom='$nom_p'");
    $msg = "✅ Photo du peuple '$nom_p' mise à jour !";
  }
  if ($_POST['action'] === 'maj_photo_potentiel') {
    $nom_p = mysqli_real_escape_string($conn, trim($_POST['nom_potentiel']));
    $url_p = trim($_POST['url_potentiel']);
    $fichier_uploade = gererUpload('photo_potentiel');
    if ($fichier_uploade) { $url_p = $fichier_uploade; }
    $url_p = mysqli_real_escape_string($conn, $url_p);
    mysqli_query($conn, "UPDATE images_potentiels SET image_url='$url_p' WHERE nom='$nom_p'");
    $msg = "✅ Photo du potentiel '$nom_p' mise à jour !";
  }
  if ($_POST['action'] === 'maj_photo_province') {
    $id_province = intval($_POST['id_province']);
    $url_p = trim($_POST['url_province']);
    $fichier_uploade = gererUpload('photo_province');
    if ($fichier_uploade) { $url_p = $fichier_uploade; }
    $url_p = mysqli_real_escape_string($conn, $url_p);
    if ($id_province > 0) {
      mysqli_query($conn, "UPDATE provinces SET image_url='$url_p' WHERE id=$id_province");
      $msg = "✅ Photo de la province mise à jour !";
    }
  }
  if ($_POST['action'] === 'maj_photo_potentiel_page') {
    $id_pot = intval($_POST['id_potentiel_page']);
    $url_p = trim($_POST['url_potentiel_page']);
    $fichier_uploade = gererUpload('photo_potentiel_page');
    if ($fichier_uploade) { $url_p = $fichier_uploade; }
    $url_p = mysqli_real_escape_string($conn, $url_p);
    if ($id_pot > 0) {
      mysqli_query($conn, "UPDATE potentiels SET image_url='$url_p' WHERE id=$id_pot");
      $msg = "✅ Photo du potentiel (page Potentiels) mise à jour !";
    }
  }
  if ($_POST['action'] === 'maj_photo_culture') {
    $id_culture = intval($_POST['id_culture']);
    $url_p = trim($_POST['url_culture']);
    $fichier_uploade = gererUpload('photo_culture');
    if ($fichier_uploade) { $url_p = $fichier_uploade; }
    $url_p = mysqli_real_escape_string($conn, $url_p);
    if ($id_culture > 0) {
      mysqli_query($conn, "UPDATE cultures SET image_url='$url_p' WHERE id=$id_culture");
      $msg = "✅ Photo de l'élément culturel mise à jour !";
    }
  }
  if ($_POST['action'] === 'modifier') {
    $id        = intval($_POST['region_id']);
    $nom       = mysqli_real_escape_string($conn, trim($_POST['nom']));
    $chef_lieu = mysqli_real_escape_string($conn, trim($_POST['chef_lieu']));
    $zone      = mysqli_real_escape_string($conn, trim($_POST['zone']));
    $desc      = mysqli_real_escape_string($conn, trim($_POST['description']));
    $peuples   = mysqli_real_escape_string($conn, trim($_POST['peuples']));
    $pot       = mysqli_real_escape_string($conn, trim($_POST['potentiels']));
    $img       = mysqli_real_escape_string($conn, trim($_POST['image_url']));
    $fichier_uploade = gererUpload('photo_region_modif');
    if ($fichier_uploade) { $img = $fichier_uploade; }
    if ($id > 0) {
      mysqli_query($conn, "UPDATE regions SET nom='$nom',chef_lieu='$chef_lieu',zone='$zone',description='$desc',peuples='$peuples',potentiels='$pot',image_url='$img' WHERE id=$id");
      $msg = "✅ Région '$nom' modifiée !";
    }
  }
}

// Stats
$nb_regions   = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM regions"))[0];
$nb_provinces = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM provinces"))[0];
$nb_cultures  = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM cultures"))[0];
$nb_potentiels= mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM potentiels"))[0];
$nb_messages  = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM messages"))[0];
$nb_vues_total= mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM regions_vues"))[0];
$nb_visites_site = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM visites_site"))[0];
?>

<div class="container">

  <!-- Stats globales -->
  <div class="stats-grid">
    <div class="stat-card"><strong><?php echo $nb_regions; ?></strong><span>Régions</span></div>
    <div class="stat-card"><strong><?php echo $nb_provinces; ?></strong><span>Provinces</span></div>
    <div class="stat-card"><strong><?php echo $nb_cultures; ?></strong><span>Éléments culturels</span></div>
    <div class="stat-card"><strong><?php echo $nb_potentiels; ?></strong><span>Potentiels</span></div>
    <div class="stat-card"><strong><?php echo $nb_messages; ?></strong><span>Messages reçus</span></div>
    <div class="stat-card"><strong><?php echo $nb_vues_total; ?></strong><span>Vues totales</span></div>
    <div class="stat-card"><strong><?php echo $nb_visites_site; ?></strong><span>Visites du site</span></div>
  </div>

  <!-- Graphiques -->
  <div class="charts-grid">
    <div class="chart-box">
      <h3>📊 Régions par zone géographique</h3>
      <canvas id="chartZones" height="200"></canvas>
    </div>
    <div class="chart-box">
      <h3>👁️ Régions les plus visitées</h3>
      <canvas id="chartVues" height="200"></canvas>
    </div>
  </div>

  <!-- Régions les plus visitées (table) -->
  <div class="section">
    <h2>👁️ Statistiques de visites par région</h2>
    <table>
      <tr><th>Région</th><th>Vues</th><th>Popularité</th></tr>
      <?php
      $max_vues = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM regions_vues GROUP BY slug ORDER BY COUNT(*) DESC LIMIT 1"))[0] ?? 1;
      $vues_res = mysqli_query($conn, "SELECT slug, COUNT(*) as nb FROM regions_vues GROUP BY slug ORDER BY nb DESC LIMIT 10");
      if (mysqli_num_rows($vues_res) > 0):
        while ($v = mysqli_fetch_assoc($vues_res)):
          $pct = round(($v['nb'] / $max_vues) * 100);
      ?>
      <tr>
        <td><?php echo htmlspecialchars(ucfirst($v['slug'])); ?></td>
        <td><span class="badge"><?php echo $v['nb']; ?> vues</span></td>
        <td style="width:200px">
          <div class="vues-bar"><div class="vues-fill" style="width:<?php echo $pct; ?>%"></div></div>
        </td>
      </tr>
      <?php endwhile; else: ?>
      <tr><td colspan="3" style="text-align:center;color:#888">Aucune visite enregistrée encore</td></tr>
      <?php endif; ?>
    </table>
  </div>

  <!-- Visites récentes sur tout le site -->
  <div class="section">
    <h2>🌐 Dernières visites sur le site (<?php echo $nb_visites_site; ?> au total)</h2>
    <table>
      <tr><th>Page</th><th>Adresse IP</th><th>Date et heure</th></tr>
      <?php
      $visites_res = mysqli_query($conn, "SELECT page, ip, date_visite FROM visites_site ORDER BY date_visite DESC LIMIT 20");
      if (mysqli_num_rows($visites_res) > 0):
        while ($vi = mysqli_fetch_assoc($visites_res)):
      ?>
      <tr>
        <td><?php echo htmlspecialchars($vi['page']); ?></td>
        <td><?php echo htmlspecialchars($vi['ip']); ?></td>
        <td><?php echo date('d/m/Y H:i:s', strtotime($vi['date_visite'])); ?></td>
      </tr>
      <?php endwhile; else: ?>
      <tr><td colspan="3" style="text-align:center;color:#999">Aucune visite enregistrée pour le moment</td></tr>
      <?php endif; ?>
    </table>
  </div>

  <!-- Messages reçus -->
  <div class="section">
    <h2>📋 Derniers messages reçus</h2>
    <table>
      <tr><th>ID</th><th>Nom</th><th>Email</th><th>Sujet</th><th>Message</th><th>Date</th><th>Actions</th></tr>
      <?php
      $msgs = mysqli_query($conn, "SELECT * FROM messages ORDER BY date_envoi DESC LIMIT 10");
      while ($m = mysqli_fetch_assoc($msgs)):
      ?>
      <tr>
        <td><span class="badge"><?php echo $m['id']; ?></span></td>
        <td><?php echo htmlspecialchars($m['nom']); ?></td>
        <td><?php echo htmlspecialchars($m['email']); ?></td>
        <td><?php echo htmlspecialchars($m['sujet']); ?></td>
        <td style="max-width:220px;font-size:12px;color:#555"><?php echo nl2br(htmlspecialchars(mb_strimwidth($m['message'], 0, 100, '…'))); ?></td>
        <td><?php echo $m['date_envoi']; ?></td>
        <td style="white-space:nowrap">
          <a href="mailto:<?php echo htmlspecialchars($m['email']); ?>?subject=<?php echo urlencode('Re: ' . $m['sujet']); ?>"
             style="text-decoration:none;background:#1B4F72;color:white;padding:5px 10px;border-radius:5px;font-size:12px;font-weight:bold;margin-right:5px;display:inline-block">✉️ Répondre</a>
          <form method="POST" action="admin.php" style="display:inline" onsubmit="return confirm('Supprimer ce message de <?php echo htmlspecialchars(addslashes($m['nom'])); ?> ?');">
            <input type="hidden" name="action" value="supprimer_message">
            <input type="hidden" name="id_message" value="<?php echo $m['id']; ?>">
            <button type="submit" style="background:#EF2B2D;color:white;border:none;padding:5px 10px;border-radius:5px;cursor:pointer;font-size:12px;font-weight:bold">🗑️</button>
          </form>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
  </div>

  <!-- Ajouter une région -->
  <div class="section">
    <h2>➕ Ajouter une nouvelle région</h2>
    <?php if ($msg): ?><div class="success"><?php echo $msg; ?></div><?php endif; ?>
    <form method="POST" action="admin.php" enctype="multipart/form-data">
      <input type="hidden" name="action" value="ajouter">
      <div class="form-grid">
        <div class="form-group">
          <label>Nom de la région *</label>
          <input type="text" name="nom" placeholder="Ex: Nouvelle Région" required>
        </div>
        <div class="form-group">
          <label>Chef-lieu *</label>
          <input type="text" name="chef_lieu" placeholder="Ex: Ouagadougou" required>
        </div>
        <div class="form-group">
          <label>Zone géographique *</label>
          <select name="zone" required>
            <option value="">-- Choisir --</option>
            <option value="nord">Nord</option>
            <option value="nord-ouest">Nord-Ouest</option>
            <option value="sud-ouest">Sud-Ouest</option>
            <option value="est">Est</option>
            <option value="ouest">Ouest</option>
            <option value="centre">Centre</option>
            <option value="centre-nord">Centre-Nord</option>
            <option value="centre-est">Centre-Est</option>
            <option value="centre-ouest">Centre-Ouest</option>
            <option value="centre-sud">Centre-Sud</option>
            <option value="plateau-central">Plateau-Central</option>
            <option value="boucle-mouhoun">Boucle du Mouhoun</option>
            <option value="cascades">Cascades</option>
            <option value="sahel">Sahel</option>
          </select>
        </div>
        <div class="form-group">
          <label>Nombre de provinces</label>
          <input type="number" name="provinces" value="3" min="1" max="10">
        </div>
        <div class="form-group">
          <label>Peuples (séparés par virgule)</label>
          <input type="text" name="peuples" placeholder="Ex: Mossi, Peul">
        </div>
        <div class="form-group">
          <label>Potentiels (séparés par virgule)</label>
          <input type="text" name="potentiels" placeholder="Ex: Agriculture, Mines">
        </div>
        <div class="form-group full">
          <label>URL de l'image (ou choisis un fichier ci-dessous)</label>
          <input type="text" name="image_url" placeholder="https://images.unsplash.com/...">
        </div>
        <div class="form-group full">
          <label>📁 Ou choisir une photo depuis l'ordinateur</label>
          <input type="file" name="photo_region" accept="image/png,image/jpeg,image/webp,image/gif">
        </div>
        <div class="form-group full">
          <label>Description *</label>
          <textarea name="description" rows="4" placeholder="Description de la région..." required></textarea>
        </div>
      </div>
      <br>
      <button type="submit" class="btn btn-green">➕ Ajouter la région</button>
    </form>
  </div>

  <!-- Liste des régions avec suppression -->
  <div class="section">
    <h2>🗺️ Toutes les régions (<?php echo $nb_regions; ?>)</h2>
    <table>
      <tr><th>ID</th><th>Nom</th><th>Chef-lieu</th><th>Zone</th><th>Provinces</th><th>Action</th></tr>
      <?php
      $regs = mysqli_query($conn, "SELECT r.*, (SELECT COUNT(*) FROM provinces p WHERE p.region_nom = r.nom) AS nb_provinces_reel FROM regions r ORDER BY r.nom");
      while ($r = mysqli_fetch_assoc($regs)):
      ?>
      <tr>
        <td><?php echo $r['id']; ?></td>
        <td><a href="region.php?id=<?php echo $r['id']; ?>" style="color:#008751;font-weight:bold"><?php echo htmlspecialchars($r['nom']); ?></a></td>
        <td><?php echo htmlspecialchars($r['chef_lieu']); ?></td>
        <td><span class="badge"><?php echo $r['zone']; ?></span></td>
        <td><?php echo $r['nb_provinces_reel']; ?></td>
        <td>
          <form method="POST" action="admin.php" style="display:inline"
                onsubmit="return confirmSuppr('Supprimer <?php echo htmlspecialchars($r['nom']); ?> ?')">
            <input type="hidden" name="action" value="supprimer">
            <input type="hidden" name="region_id" value="<?php echo $r['id']; ?>">
            <button type="submit" class="btn btn-red">🗑️ Suppr.</button>
          </form>
          <button onclick="ouvrirModif(<?php echo $r['id']; ?>,'<?php echo addslashes($r['nom']); ?>','<?php echo addslashes($r['chef_lieu']); ?>','<?php echo addslashes($r['zone']); ?>','<?php echo addslashes($r['description']); ?>','<?php echo addslashes($r['peuples']); ?>','<?php echo addslashes($r['potentiels']); ?>','<?php echo addslashes($r['image_url']); ?>')" style="background:#1B4F72;color:white;border:none;padding:5px 10px;border-radius:5px;cursor:pointer;font-size:12px;font-weight:bold">✏️ Modifier</button>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
  </div>

</div>


<!-- GESTION PHOTOS PEUPLES ET POTENTIELS -->
<div class="container">
<?php
// Pré-calcul : pour chaque peuple/potentiel, quelles régions le mentionnent
// (comparaison exacte après découpage par virgule, pour éviter les faux
// positifs comme "Bwa" qui serait contenu dans "Bwaba")
$regions_par_peuple = [];
$regions_par_potentiel = [];
$res_regions_liens = mysqli_query($conn, "SELECT nom, peuples, potentiels FROM regions");
while ($rg = mysqli_fetch_assoc($res_regions_liens)) {
  foreach (array_map('trim', explode(',', $rg['peuples'])) as $p) {
    if ($p !== '') $regions_par_peuple[$p][] = $rg['nom'];
  }
  foreach (array_map('trim', explode(',', $rg['potentiels'])) as $p) {
    if ($p !== '') $regions_par_potentiel[$p][] = $rg['nom'];
  }
}
?>
<div class="section">
  <h2>🖼️ Images de fond (Hero) des pages</h2>
  <?php
  $liste_hero = mysqli_query($conn, "SELECT page, image_url FROM images_hero WHERE page != 'carte' ORDER BY page");
  while ($he = mysqli_fetch_assoc($liste_hero)):
  ?>
  <form method="POST" action="admin.php" enctype="multipart/form-data" class="photo-form" style="display:flex;gap:10px;align-items:center;margin-bottom:10px;padding:10px;background:#f9f9f9;border-radius:8px;flex-wrap:wrap">
    <input type="hidden" name="action" value="maj_photo_hero">
    <input type="hidden" name="page_hero" value="<?php echo htmlspecialchars($he['page']); ?>">
    <img src="<?php echo htmlspecialchars($he['image_url']); ?>" style="width:80px;height:50px;border-radius:8px;object-fit:cover"
         onerror="this.onerror=null;this.src='https://via.placeholder.com/80x50/333/white?text=?'">
    <strong style="width:140px;text-transform:capitalize"><?php echo htmlspecialchars($he['page']); ?></strong>
    <input type="text" name="url_hero" value="<?php echo htmlspecialchars($he['image_url']); ?>"
           style="flex:1;min-width:150px;padding:8px;border:2px solid #e5e7eb;border-radius:6px;font-size:12px">
    <input type="file" name="photo_hero" accept="image/png,image/jpeg,image/webp,image/gif" style="font-size:11px;max-width:160px" onchange="apercuPhoto(this)">
    <button type="submit" class="btn btn-green" style="padding:8px 18px">💾</button>
  </form>
  <?php endwhile; ?>
</div>

<div class="section">
  <h2>📸 Photos des Régions</h2>
  <?php
  $liste_regions_photos = mysqli_query($conn, "SELECT id, nom, image_url FROM regions ORDER BY nom");
  while ($rp = mysqli_fetch_assoc($liste_regions_photos)):
  ?>
  <form method="POST" action="admin.php" enctype="multipart/form-data" class="photo-form" style="display:flex;gap:10px;align-items:center;margin-bottom:10px;padding:10px;background:#f9f9f9;border-radius:8px;flex-wrap:wrap">
    <input type="hidden" name="action" value="maj_photo_region">
    <input type="hidden" name="id_region" value="<?php echo $rp['id']; ?>">
    <img src="<?php echo htmlspecialchars($rp['image_url']); ?>" style="width:50px;height:50px;border-radius:8px;object-fit:cover"
         onerror="this.onerror=null;this.src='https://via.placeholder.com/50/008751/white?text=?'">
    <strong style="width:140px"><?php echo htmlspecialchars($rp['nom']); ?></strong>
    <input type="text" name="url_region" value="<?php echo htmlspecialchars($rp['image_url']); ?>"
           style="flex:1;min-width:150px;padding:8px;border:2px solid #e5e7eb;border-radius:6px;font-size:12px">
    <input type="file" name="photo_region_simple" accept="image/png,image/jpeg,image/webp,image/gif" style="font-size:11px;max-width:160px" onchange="apercuPhoto(this)">
    <button type="submit" class="btn btn-green" style="padding:8px 18px">💾</button>
  </form>
  <?php endwhile; ?>
</div>

<div class="section">
  <h2>👥 Photos des Peuples</h2>
  <?php
  $liste_peuples = mysqli_query($conn, "SELECT * FROM images_peuples ORDER BY nom");
  while ($pe = mysqli_fetch_assoc($liste_peuples)):
    $regions_liees = $regions_par_peuple[$pe['nom']] ?? [];
    $regions_txt = $regions_liees ? implode(', ', $regions_liees) : 'aucune région';
  ?>
  <form method="POST" action="admin.php" enctype="multipart/form-data" class="photo-form" style="display:flex;gap:10px;align-items:center;margin-bottom:10px;padding:10px;background:#f9f9f9;border-radius:8px;flex-wrap:wrap">
    <input type="hidden" name="action" value="maj_photo_peuple">
    <input type="hidden" name="nom_peuple" value="<?php echo htmlspecialchars($pe['nom']); ?>">
    <img src="<?php echo htmlspecialchars($pe['image_url']); ?>" style="width:50px;height:50px;border-radius:8px;object-fit:cover"
         onerror="this.onerror=null;this.src='https://via.placeholder.com/50/EF2B2D/white?text=?'">
    <strong style="width:220px"><?php echo htmlspecialchars($pe['nom']); ?> <span style="color:#999;font-weight:normal;font-size:11px">(<?php echo htmlspecialchars($regions_txt); ?>)</span></strong>
    <input type="text" name="url_peuple" value="<?php echo htmlspecialchars($pe['image_url']); ?>"
           style="flex:1;min-width:150px;padding:8px;border:2px solid #e5e7eb;border-radius:6px;font-size:12px">
    <input type="file" name="photo_peuple" accept="image/png,image/jpeg,image/webp,image/gif" style="font-size:11px;max-width:160px" onchange="apercuPhoto(this)">
    <button type="submit" class="btn btn-green" style="padding:8px 18px">💾</button>
  </form>
  <?php endwhile; ?>
</div>

<div class="section">
  <h2>⚡ Photos des Potentiels économiques</h2>
  <?php
  $liste_potentiels = mysqli_query($conn, "SELECT * FROM images_potentiels ORDER BY nom");
  while ($po = mysqli_fetch_assoc($liste_potentiels)):
    $regions_liees_p = $regions_par_potentiel[$po['nom']] ?? [];
    $regions_txt_p = $regions_liees_p ? implode(', ', $regions_liees_p) : 'aucune région';
  ?>
  <form method="POST" action="admin.php" enctype="multipart/form-data" class="photo-form" style="display:flex;gap:10px;align-items:center;margin-bottom:10px;padding:10px;background:#f9f9f9;border-radius:8px;flex-wrap:wrap">
    <input type="hidden" name="action" value="maj_photo_potentiel">
    <input type="hidden" name="nom_potentiel" value="<?php echo htmlspecialchars($po['nom']); ?>">
    <img src="<?php echo htmlspecialchars($po['image_url']); ?>" style="width:50px;height:50px;border-radius:8px;object-fit:cover"
         onerror="this.onerror=null;this.src='https://via.placeholder.com/50/008751/white?text=?'">
    <strong style="width:250px"><?php echo htmlspecialchars($po['nom']); ?> <span style="color:#999;font-weight:normal;font-size:11px">(<?php echo htmlspecialchars($regions_txt_p); ?>)</span></strong>
    <input type="text" name="url_potentiel" value="<?php echo htmlspecialchars($po['image_url']); ?>"
           style="flex:1;min-width:150px;padding:8px;border:2px solid #e5e7eb;border-radius:6px;font-size:12px">
    <input type="file" name="photo_potentiel" accept="image/png,image/jpeg,image/webp,image/gif" style="font-size:11px;max-width:160px" onchange="apercuPhoto(this)">
    <button type="submit" class="btn btn-green" style="padding:8px 18px">💾</button>
  </form>
  <?php endwhile; ?>
</div>

<div class="section">
  <h2>🏘️ Photos des Provinces</h2>
  <?php
  $liste_provinces = mysqli_query($conn, "SELECT id, nom, region_nom, image_url FROM provinces ORDER BY region_nom, nom");
  while ($pr = mysqli_fetch_assoc($liste_provinces)):
  ?>
  <form method="POST" action="admin.php" enctype="multipart/form-data" class="photo-form" style="display:flex;gap:10px;align-items:center;margin-bottom:10px;padding:10px;background:#f9f9f9;border-radius:8px;flex-wrap:wrap">
    <input type="hidden" name="action" value="maj_photo_province">
    <input type="hidden" name="id_province" value="<?php echo $pr['id']; ?>">
    <img src="<?php echo htmlspecialchars($pr['image_url']); ?>" style="width:50px;height:50px;border-radius:8px;object-fit:cover"
         onerror="this.onerror=null;this.src='https://via.placeholder.com/50/E8B923/white?text=?'">
    <strong style="width:140px"><?php echo htmlspecialchars($pr['nom']); ?> <span style="color:#999;font-weight:normal">(<?php echo htmlspecialchars($pr['region_nom']); ?>)</span></strong>
    <input type="text" name="url_province" value="<?php echo htmlspecialchars($pr['image_url']); ?>"
           style="flex:1;min-width:150px;padding:8px;border:2px solid #e5e7eb;border-radius:6px;font-size:12px">
    <input type="file" name="photo_province" accept="image/png,image/jpeg,image/webp,image/gif" style="font-size:11px;max-width:160px" onchange="apercuPhoto(this)">
    <button type="submit" class="btn btn-green" style="padding:8px 18px">💾</button>
  </form>
  <?php endwhile; ?>
</div>

<div class="section">
  <h2>⚡ Photos des Potentiels (page Potentiels économiques)</h2>
  <?php
  $liste_potentiels_page = mysqli_query($conn, "SELECT id, titre, categorie, image_url FROM potentiels ORDER BY categorie, titre");
  while ($pp = mysqli_fetch_assoc($liste_potentiels_page)):
  ?>
  <form method="POST" action="admin.php" enctype="multipart/form-data" class="photo-form" style="display:flex;gap:10px;align-items:center;margin-bottom:10px;padding:10px;background:#f9f9f9;border-radius:8px;flex-wrap:wrap">
    <input type="hidden" name="action" value="maj_photo_potentiel_page">
    <input type="hidden" name="id_potentiel_page" value="<?php echo $pp['id']; ?>">
    <img src="<?php echo htmlspecialchars($pp['image_url']); ?>" style="width:50px;height:50px;border-radius:8px;object-fit:cover"
         onerror="this.onerror=null;this.src='https://via.placeholder.com/50/1B4F72/white?text=?'">
    <strong style="width:140px"><?php echo htmlspecialchars($pp['titre']); ?> <span style="color:#999;font-weight:normal">(<?php echo htmlspecialchars($pp['categorie']); ?>)</span></strong>
    <input type="text" name="url_potentiel_page" value="<?php echo htmlspecialchars($pp['image_url']); ?>"
           style="flex:1;min-width:150px;padding:8px;border:2px solid #e5e7eb;border-radius:6px;font-size:12px">
    <input type="file" name="photo_potentiel_page" accept="image/png,image/jpeg,image/webp,image/gif" style="font-size:11px;max-width:160px" onchange="apercuPhoto(this)">
    <button type="submit" class="btn btn-green" style="padding:8px 18px">💾</button>
  </form>
  <?php endwhile; ?>
</div>

<div class="section">
  <h2>🎭 Photos des éléments culturels (page Culture)</h2>
  <?php
  $liste_cultures = mysqli_query($conn, "SELECT id, nom, type, region, image_url FROM cultures ORDER BY type, nom");
  while ($cu = mysqli_fetch_assoc($liste_cultures)):
  ?>
  <form method="POST" action="admin.php" enctype="multipart/form-data" class="photo-form" style="display:flex;gap:10px;align-items:center;margin-bottom:10px;padding:10px;background:#f9f9f9;border-radius:8px;flex-wrap:wrap">
    <input type="hidden" name="action" value="maj_photo_culture">
    <input type="hidden" name="id_culture" value="<?php echo $cu['id']; ?>">
    <img src="<?php echo htmlspecialchars($cu['image_url']); ?>" style="width:50px;height:50px;border-radius:8px;object-fit:cover"
         onerror="this.onerror=null;this.src='https://via.placeholder.com/50/A0522D/white?text=?'">
    <strong style="width:220px"><?php echo htmlspecialchars($cu['nom']); ?> <span style="color:#999;font-weight:normal">(<?php echo htmlspecialchars($cu['type']); ?>)</span></strong>
    <input type="text" name="url_culture" value="<?php echo htmlspecialchars($cu['image_url']); ?>"
           style="flex:1;min-width:150px;padding:8px;border:2px solid #e5e7eb;border-radius:6px;font-size:12px">
    <input type="file" name="photo_culture" accept="image/png,image/jpeg,image/webp,image/gif" style="font-size:11px;max-width:160px" onchange="apercuPhoto(this)">
    <button type="submit" class="btn btn-green" style="padding:8px 18px">💾</button>
  </form>
  <?php endwhile; ?>
</div>
</div>
<footer>🇧🇫 Burkina Terres d'Avenir — Admin Panel</footer>
<?php
// Données pour graphiques
$zones_data = [];
$zones_res = mysqli_query($conn, "SELECT zone, COUNT(*) as nb FROM regions GROUP BY zone ORDER BY nb DESC");
while ($z = mysqli_fetch_assoc($zones_res)) $zones_data[] = $z;

$vues_data = [];
$vues_res2 = mysqli_query($conn, "SELECT slug, COUNT(*) as nb FROM regions_vues GROUP BY slug ORDER BY nb DESC LIMIT 8");
while ($v = mysqli_fetch_assoc($vues_res2)) $vues_data[] = $v;
mysqli_close($conn);
?>
<script src="commun.js"></script>
<script>
// Aperçu instantané : affiche la photo choisie immédiatement, avant l'enregistrement
function apercuPhoto(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      const img = input.closest('form').querySelector('img');
      if (img) img.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
}

// Envoi en arrière-plan des formulaires photo : la page ne recharge jamais,
// rien ne bouge, on reste exactement là où on était.
document.querySelectorAll('.photo-form').forEach(form => {
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = this.querySelector('button[type="submit"]');
    const texteOriginal = btn.textContent;
    btn.disabled = true;
    btn.textContent = '⏳';
    const donnees = new FormData(this);
    fetch('admin.php', { method: 'POST', body: donnees })
      .then(reponse => {
        if (!reponse.ok) throw new Error('Erreur serveur');
        btn.textContent = '✅';
        setTimeout(() => { btn.textContent = texteOriginal; btn.disabled = false; }, 1500);
      })
      .catch(() => {
        btn.textContent = '❌';
        setTimeout(() => { btn.textContent = texteOriginal; btn.disabled = false; }, 2000);
      });
  });
});

// Graphique zones
const zonesLabels = <?php echo json_encode(array_column($zones_data, 'zone')); ?>;
const zonesData   = <?php echo json_encode(array_column($zones_data, 'nb')); ?>;

new Chart(document.getElementById('chartZones'), {
  type: 'doughnut',
  data: {
    labels: zonesLabels,
    datasets: [{ data: zonesData,
      backgroundColor: ['#008751','#E8B923','#EF2B2D','#00A1D6','#A0522D','#4ade80'],
      borderWidth: 2
    }]
  },
  options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
});

// Graphique vues
const vuesLabels = <?php echo json_encode(array_column($vues_data, 'slug')); ?>;
const vuesNb     = <?php echo json_encode(array_column($vues_data, 'nb')); ?>;

new Chart(document.getElementById('chartVues'), {
  type: 'bar',
  data: {
    labels: vuesLabels,
    datasets: [{ label: 'Vues', data: vuesNb,
      backgroundColor: '#008751', borderRadius: 6
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { display: false } },
    scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
  }
});
</script>

<div id="modal-modif" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.6);z-index:9998;align-items:center;justify-content:center">
  <div style="background:white;border-radius:16px;padding:30px;max-width:600px;width:90%;box-shadow:0 20px 60px rgba(0,0,0,0.3)">
    <h3 style="color:#008751;margin-bottom:20px">✏️ Modifier la région</h3>
    <form method="POST" action="admin.php" enctype="multipart/form-data">
      <input type="hidden" name="action" value="modifier">
      <input type="hidden" name="region_id" id="modif_id">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
        <div><label style="font-size:12px;font-weight:bold">Nom</label><input type="text" name="nom" id="modif_nom" style="width:100%;padding:8px;border:2px solid #e5e7eb;border-radius:6px;font-size:13px;box-sizing:border-box"></div>
        <div><label style="font-size:12px;font-weight:bold">Chef-lieu</label><input type="text" name="chef_lieu" id="modif_chef" style="width:100%;padding:8px;border:2px solid #e5e7eb;border-radius:6px;font-size:13px;box-sizing:border-box"></div>
        <div><label style="font-size:12px;font-weight:bold">Zone</label><select name="zone" id="modif_zone" style="width:100%;padding:8px;border:2px solid #e5e7eb;border-radius:6px;font-size:13px;box-sizing:border-box"><option value="nord">Nord</option><option value="nord-ouest">Nord-Ouest</option><option value="sud-ouest">Sud-Ouest</option><option value="est">Est</option><option value="ouest">Ouest</option><option value="centre">Centre</option><option value="centre-nord">Centre-Nord</option><option value="centre-est">Centre-Est</option><option value="centre-ouest">Centre-Ouest</option><option value="centre-sud">Centre-Sud</option><option value="plateau-central">Plateau-Central</option><option value="boucle-mouhoun">Boucle du Mouhoun</option><option value="cascades">Cascades</option><option value="sahel">Sahel</option></select></div>
        <div><label style="font-size:12px;font-weight:bold">Peuples</label><input type="text" name="peuples" id="modif_peuples" style="width:100%;padding:8px;border:2px solid #e5e7eb;border-radius:6px;font-size:13px;box-sizing:border-box"></div>
        <div style="grid-column:1/-1"><label style="font-size:12px;font-weight:bold">🖼️ URL Image</label><input type="text" name="image_url" id="modif_image" style="width:100%;padding:8px;border:2px solid #e5e7eb;border-radius:6px;font-size:13px;box-sizing:border-box"></div>
        <div style="grid-column:1/-1"><label style="font-size:12px;font-weight:bold">📁 Ou choisir une photo depuis l'ordinateur</label><input type="file" name="photo_region_modif" accept="image/png,image/jpeg,image/webp,image/gif" style="width:100%"></div>
        <div style="grid-column:1/-1"><label style="font-size:12px;font-weight:bold">Potentiels</label><input type="text" name="potentiels" id="modif_potentiels" style="width:100%;padding:8px;border:2px solid #e5e7eb;border-radius:6px;font-size:13px;box-sizing:border-box"></div>
        <div style="grid-column:1/-1"><label style="font-size:12px;font-weight:bold">Description</label><textarea name="description" id="modif_desc" rows="3" style="width:100%;padding:8px;border:2px solid #e5e7eb;border-radius:6px;font-size:13px;box-sizing:border-box"></textarea></div>
      </div>
      <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:20px">
        <button type="button" onclick="document.getElementById('modal-modif').style.display='none'" style="background:#ccc;color:#333;border:none;padding:10px 20px;border-radius:8px;cursor:pointer;font-weight:bold">Annuler</button>
        <button type="submit" style="background:#008751;color:white;border:none;padding:10px 25px;border-radius:8px;cursor:pointer;font-weight:bold">💾 Enregistrer</button>
      </div>
    </form>
  </div>
</div>
<script>
function ouvrirModif(id,nom,chef,zone,desc,peuples,pot,img) {
  document.getElementById("modif_id").value=id;
  document.getElementById("modif_nom").value=nom;
  document.getElementById("modif_chef").value=chef;
  document.getElementById("modif_zone").value=zone;
  document.getElementById("modif_desc").value=desc;
  document.getElementById("modif_peuples").value=peuples;
  document.getElementById("modif_potentiels").value=pot;
  document.getElementById("modif_image").value=img;
  document.getElementById("modal-modif").style.display="flex";
}
</script>
</body>
</html>

<div id="modal-confirm" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.6);z-index:9999;align-items:center;justify-content:center">
  <div style="background:white;border-radius:16px;padding:35px;max-width:400px;width:90%;text-align:center;box-shadow:0 20px 60px rgba(0,0,0,0.3)">
    <div style="font-size:48px;margin-bottom:15px">🗑️</div>
    <h3 style="color:#EF2B2D;margin-bottom:10px">Confirmer la suppression</h3>
    <p id="modal-msg" style="color:#666;margin-bottom:25px;font-size:14px"></p>
    <div style="display:flex;gap:10px;justify-content:center">
      <button onclick="document.getElementById('modal-confirm').style.display='none'"
        style="background:#ccc;color:#333;border:none;padding:10px 25px;border-radius:20px;cursor:pointer;font-weight:bold">Annuler</button>
      <button id="modal-ok"
        style="background:#EF2B2D;color:white;border:none;padding:10px 25px;border-radius:20px;cursor:pointer;font-weight:bold">Supprimer</button>
    </div>
  </div>
</div>
<script>
function confirmSuppr(e) {
  e.preventDefault();
  const form = e.target || e.srcElement;
  const modal = document.getElementById('modal-confirm');
  document.getElementById('modal-msg').textContent = 'Voulez-vous vraiment supprimer cette région ? Cette action est irréversible.';
  modal.style.display = 'flex';
  document.getElementById('modal-ok').onclick = () => { modal.style.display='none'; form.submit(); };
  return false;
}
</script>
