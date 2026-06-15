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
  // Statistiques
  $zones_list = ['centre', 'est', 'ouest', 'nord', 'sud-ouest'];
  $regions_data = [
    ['nom'=>'Goulmou','chefLieu'=>'Fada N\'Gourma','zone'=>'est','description'=>'Porte d\'entrée de l\'Est. Terre des Gourmantché.','provinces'=>5,'peuples'=>['Gourmantché','Peul','Mossi'],'potentiels'=>['Élevage','Coton','Mine d\'or'],'image'=>'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=600'],
    ['nom'=>'Kadiogo','chefLieu'=>'Ouagadougou','zone'=>'centre','description'=>'Capitale nationale. Centre politique et économique.','provinces'=>1,'peuples'=>['Mossi','Yarsé','Peul'],'potentiels'=>['Commerce','Industrie','Services'],'image'=>'https://images.unsplash.com/photo-1578469550956-0e16b69c6a3d?w=600'],
    ['nom'=>'Houet','chefLieu'=>'Bobo-Dioulasso','zone'=>'ouest','description'=>'Capitale économique. Carrefour commercial.','provinces'=>1,'peuples'=>['Bobo','Dioula','Peul'],'potentiels'=>['Commerce','Agriculture','Industrie'],'image'=>'https://images.unsplash.com/photo-1523805009345-7448845a9e53?w=600'],
    ['nom'=>'Soum','chefLieu'=>'Djibo','zone'=>'nord','description'=>'Région du Sahel burkinabè. Élevage extensif.','provinces'=>1,'peuples'=>['Peul','Bella','Touareg'],'potentiels'=>['Élevage','Commerce transfrontalier'],'image'=>'https://images.unsplash.com/photo-1509316785289-025f5b846b35?w=600'],
    ['nom'=>'Tapoa','chefLieu'=>'Diapaga','zone'=>'est','description'=>'Région abritant le Parc W. Richesse faunique.','provinces'=>1,'peuples'=>['Gourmantché','Peul'],'potentiels'=>['Tourisme','Élevage','Faune'],'image'=>'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?w=600'],
    ['nom'=>'Boucle du Mouhoun','chefLieu'=>'Dédougou','zone'=>'ouest','description'=>'Grenier agricole du Burkina Faso.','provinces'=>5,'peuples'=>['Bwaba','Marka','Peul'],'potentiels'=>['Agriculture','Coton','Élevage'],'image'=>'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=600'],
    ['nom'=>'Cascades','chefLieu'=>'Banfora','zone'=>'sud-ouest','description'=>'Région la plus verte. Cascades de Karfiguéla.','provinces'=>2,'peuples'=>['Tiéfo','Dioula','Peul'],'potentiels'=>['Tourisme','Canne à sucre','Agriculture'],'image'=>'https://images.unsplash.com/photo-1433086966358-54859d0ed716?w=600'],
    ['nom'=>'Centre-Est','chefLieu'=>'Tenkodogo','zone'=>'centre','description'=>'Carrefour entre le Burkina et le Togo.','provinces'=>3,'peuples'=>['Mossi','Bissa','Peul'],'potentiels'=>['Commerce','Agriculture','Élevage'],'image'=>'https://images.unsplash.com/photo-1504701954957-2010ec3bcec1?w=600'],
    ['nom'=>'Centre-Nord','chefLieu'=>'Kaya','zone'=>'centre','description'=>'Forte tradition religieuse. Mines d\'or.','provinces'=>3,'peuples'=>['Mossi','Peul'],'potentiels'=>['Mine d\'or','Agriculture'],'image'=>'https://images.unsplash.com/photo-1518459031867-a89b944bffe4?w=600'],
    ['nom'=>'Centre-Ouest','chefLieu'=>'Koudougou','zone'=>'centre','description'=>'Troisième ville du Burkina Faso.','provinces'=>4,'peuples'=>['Mossi','Gurunsi'],'potentiels'=>['Industrie textile','Agriculture'],'image'=>'https://images.unsplash.com/photo-1471623432079-b009d30b6729?w=600'],
    ['nom'=>'Centre-Sud','chefLieu'=>'Manga','zone'=>'centre','description'=>'Région proche de la frontière ghanéenne.','provinces'=>3,'peuples'=>['Mossi','Gurunsi','Peul'],'potentiels'=>['Agriculture','Élevage'],'image'=>'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=600'],
    ['nom'=>'Est','chefLieu'=>'Fada N\'Gourma','zone'=>'est','description'=>'Parcs nationaux Arly et W. Faune abondante.','provinces'=>4,'peuples'=>['Gourmantché','Peul','Bissa'],'potentiels'=>['Tourisme','Élevage','Faune'],'image'=>'https://images.unsplash.com/photo-1535941339077-2dd1c7963098?w=600'],
    ['nom'=>'Hauts-Bassins','chefLieu'=>'Bobo-Dioulasso','zone'=>'ouest','description'=>'Zone la plus industrialisée du Burkina.','provinces'=>3,'peuples'=>['Bobo','Dioula','Peul'],'potentiels'=>['Industrie','Agriculture'],'image'=>'https://images.unsplash.com/photo-1490682143684-14369e18dce8?w=600'],
    ['nom'=>'Liptako','chefLieu'=>'Dori','zone'=>'nord','description'=>'Région sahélienne. Mine d\'or de Tambao.','provinces'=>1,'peuples'=>['Peul','Touareg','Bella'],'potentiels'=>['Élevage','Mine de manganèse'],'image'=>'https://images.unsplash.com/photo-1509316785289-025f5b846b35?w=600'],
    ['nom'=>'Plateau Central','chefLieu'=>'Ziniaré','zone'=>'centre','description'=>'Région du Plateau Mossi. Artisanat.','provinces'=>3,'peuples'=>['Mossi'],'potentiels'=>['Agriculture','Artisanat'],'image'=>'https://images.unsplash.com/photo-1504701954957-2010ec3bcec1?w=600'],
    ['nom'=>'Sahel','chefLieu'=>'Dori','zone'=>'nord','description'=>'Extrême nord. Désert et semi-aride.','provinces'=>4,'peuples'=>['Peul','Touareg','Bella'],'potentiels'=>['Élevage','Commerce transfrontalier'],'image'=>'https://images.unsplash.com/photo-1509316785289-025f5b846b35?w=600'],
    ['nom'=>'Sud-Ouest','chefLieu'=>'Gaoua','zone'=>'sud-ouest','description'=>'Terre des Lobi et Dagara. Mines d\'or.','provinces'=>4,'peuples'=>['Lobi','Dagara','Birifor'],'potentiels'=>['Mine d\'or','Tourisme'],'image'=>'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=600'],
  ];

  // Filtre par zone
  $zone_filtre = isset($_GET['zone']) ? $_GET['zone'] : 'toutes';
  $regions_filtrees = $zone_filtre === 'toutes' ? $regions_data : array_filter($regions_data, fn($r) => $r['zone'] === $zone_filtre);
  ?>

  <div class="stats">
    <div class="stat"><strong>17</strong> Régions</div>
    <div class="stat"><strong>45</strong> Provinces</div>
    <div class="stat"><strong>351</strong> Départements</div>
    <div class="stat"><strong>8 000+</strong> Villages</div>
    <div class="stat"><strong><?php echo count($regions_filtrees); ?></strong> Affichées</div>
  </div>

  <div class="filtres">
    <a href="regions.php" class="<?php echo $zone_filtre==='toutes'?'actif':''; ?>">Toutes</a>
    <?php foreach($zones_list as $z): ?>
    <a href="regions.php?zone=<?php echo $z; ?>" class="<?php echo $zone_filtre===$z?'actif':''; ?>">
      <?php echo strtoupper($z); ?>
    </a>
    <?php endforeach; ?>
  </div>

  <div class="grid">
    <?php foreach($regions_filtrees as $r): ?>
    <div class="card">
      <img src="<?php echo $r['image']; ?>" alt="<?php echo $r['nom']; ?>" 
           onerror="this.src='https://via.placeholder.com/600x160/008751/white?text=<?php echo urlencode($r['nom']); ?>'">
      <div class="card-body">
        <span class="zone-badge"><?php echo strtoupper($r['zone']); ?></span>
        <h3><?php echo htmlspecialchars($r['nom']); ?></h3>
        <p>🏛️ <strong>Chef-lieu :</strong> <?php echo htmlspecialchars($r['chefLieu']); ?></p>
        <p><?php echo htmlspecialchars($r['description']); ?></p>
        <p class="peuples">👥 <?php echo implode(', ', $r['peuples']); ?></p>
        <p class="potentiels">⚡ <?php echo implode(', ', $r['potentiels']); ?></p>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
</body>
</html>
