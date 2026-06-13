const Database = require('better-sqlite3');
const db = new Database('burkina.db');

// Créer la table messages si elle n'existe pas
db.exec(`
  CREATE TABLE IF NOT EXISTS messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    email TEXT NOT NULL,
    sujet TEXT,
    message TEXT NOT NULL,
    date TEXT NOT NULL
  )
`);

// Créer la table regions_vues pour compter les visites
db.exec(`
  CREATE TABLE IF NOT EXISTS regions_vues (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    slug TEXT NOT NULL,
    date TEXT NOT NULL
  )
`);

console.log('✅ Base de données SQLite initialisée');
module.exports = db;
