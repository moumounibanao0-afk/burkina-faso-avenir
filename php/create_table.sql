CREATE DATABASE IF NOT EXISTS burkina_db;
USE burkina_db;

CREATE TABLE IF NOT EXISTS regions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  chef_lieu VARCHAR(100) NOT NULL,
  zone VARCHAR(50) NOT NULL,
  description TEXT,
  provinces INT DEFAULT 1,
  peuples VARCHAR(255),
  potentiels VARCHAR(255),
  image_url VARCHAR(500)
);

INSERT INTO regions (nom, chef_lieu, zone, description, provinces, peuples, potentiels, image_url) VALUES
('Goulmou','Fada N\'Gourma','est','Porte d\'entrée de l\'Est. Terre des Gourmantché.',5,'Gourmantché, Peul, Mossi','Élevage, Coton, Mine d\'or','https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?w=600'),
('Kadiogo','Ouagadougou','centre','Capitale nationale. Centre politique et économique.',1,'Mossi, Yarsé, Peul','Commerce, Industrie, Services','https://images.unsplash.com/photo-1524661135-423995f22d0b?w=600'),
('Houet','Bobo-Dioulasso','ouest','Capitale économique. Carrefour commercial.',1,'Bobo, Dioula, Peul','Commerce, Agriculture, Industrie','https://images.unsplash.com/photo-1523805009345-7448845a9e53?w=600'),
('Soum','Djibo','nord','Région du Sahel burkinabè. Élevage extensif.',1,'Peul, Bella, Touareg','Élevage, Commerce transfrontalier','https://images.unsplash.com/photo-1509316785289-025f5b846b35?w=600'),
('Tapoa','Diapaga','est','Région abritant le Parc W. Richesse faunique.',1,'Gourmantché, Peul','Tourisme, Élevage, Faune','https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?w=600'),
('Boucle du Mouhoun','Dédougou','ouest','Grenier agricole du Burkina Faso.',5,'Bwaba, Marka, Peul','Agriculture, Coton, Élevage','https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=600'),
('Cascades','Banfora','sud-ouest','Région la plus verte. Cascades de Karfiguéla.',2,'Tiéfo, Dioula, Peul','Tourisme, Canne à sucre, Agriculture','https://images.unsplash.com/photo-1433086966358-54859d0ed716?w=600'),
('Centre-Est','Tenkodogo','centre','Carrefour entre le Burkina et le Togo.',3,'Mossi, Bissa, Peul','Commerce, Agriculture, Élevage','https://images.unsplash.com/photo-1504701954957-2010ec3bcec1?w=600'),
('Centre-Nord','Kaya','centre','Forte tradition religieuse. Mines d\'or.',3,'Mossi, Peul','Mine d\'or, Agriculture','https://images.unsplash.com/photo-1518459031867-a89b944bffe4?w=600'),
('Centre-Ouest','Koudougou','centre','Troisième ville du Burkina Faso.',4,'Mossi, Gurunsi','Industrie textile, Agriculture','https://images.unsplash.com/photo-1471623432079-b009d30b6729?w=600'),
('Centre-Sud','Manga','centre','Région proche de la frontière ghanéenne.',3,'Mossi, Gurunsi, Peul','Agriculture, Élevage','https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=600'),
('Est','Fada N\'Gourma','est','Parcs nationaux Arly et W. Faune abondante.',4,'Gourmantché, Peul, Bissa','Tourisme, Élevage, Faune','https://images.unsplash.com/photo-1535941339077-2dd1c7963098?w=600'),
('Hauts-Bassins','Bobo-Dioulasso','ouest','Zone la plus industrialisée du Burkina.',3,'Bobo, Dioula, Peul','Industrie, Agriculture','https://images.unsplash.com/photo-1490682143684-14369e18dce8?w=600'),
('Liptako','Dori','nord','Région sahélienne. Mine de manganèse de Tambao.',1,'Peul, Touareg, Bella','Élevage, Mine de manganèse','https://images.unsplash.com/photo-1509316785289-025f5b846b35?w=600'),
('Plateau Central','Ziniaré','centre','Région du Plateau Mossi. Artisanat.',3,'Mossi','Agriculture, Artisanat','https://images.unsplash.com/photo-1504701954957-2010ec3bcec1?w=600'),
('Sahel','Dori','nord','Extrême nord. Désert et semi-aride.',4,'Peul, Touareg, Bella','Élevage, Commerce transfrontalier','https://images.unsplash.com/photo-1509316785289-025f5b846b35?w=600'),
('Sud-Ouest','Gaoua','sud-ouest','Terre des Lobi et Dagara. Mines d\'or.',4,'Lobi, Dagara, Birifor','Mine d\'or, Tourisme','https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=600');

CREATE TABLE IF NOT EXISTS messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  sujet VARCHAR(200),
  message TEXT NOT NULL,
  date_envoi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
