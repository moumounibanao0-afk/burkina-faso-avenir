const express = require('express');
const cors    = require('cors');
const https   = require('https');
const regions = require('./data/regions');
const db      = require('./database');

const app  = express();
const PORT = process.env.PORT || 4000;

// ==================== MIDDLEWARE ====================
app.use(cors());
app.use(express.json());
app.use(express.static('public'));

// ==================== ROUTES REGIONS ====================

// GET toutes les régions (avec filtre optionnel par zone)
app.get('/api/regions', (req, res) => {
  const { zone } = req.query;
  if (zone) {
    return res.json(regions.filter(r => r.zone === zone));
  }
  res.json(regions);
});

// GET une région par son slug
app.get('/api/regions/:slug', (req, res) => {
  const region = regions.find(r => r.slug === req.params.slug);
  if (!region) {
    return res.status(404).json({ message: 'Région non trouvée' });
  }
  res.json(region);
});

// GET les zones disponibles
app.get('/api/zones', (req, res) => {
  const zones = [...new Set(regions.map(r => r.zone))];
  res.json(zones);
});

// ==================== ROUTES CONTACT (SQLite) ====================

// POST — sauvegarder un message en base de données
app.post('/api/contact/db', (req, res) => {
  const { nom, email, sujet, message } = req.body;
  if (!nom || !email || !message) {
    return res.status(400).json({ erreur: 'Champs obligatoires manquants' });
  }
  const date   = new Date().toLocaleString('fr-FR');
  const stmt   = db.prepare('INSERT INTO messages (nom, email, sujet, message, date) VALUES (?, ?, ?, ?, ?)');
  const result = stmt.run(nom, email, sujet || '', message, date);
  console.log('📩 Message sauvegardé en DB, id :', result.lastInsertRowid);
  res.json({ succes: true, id: result.lastInsertRowid, messageRecu: 'Message bien reçu !' });
});

// GET — lire tous les messages depuis la base de données
app.get('/api/messages/db', (req, res) => {
  const msgs = db.prepare('SELECT * FROM messages ORDER BY id DESC').all();
  res.json(msgs);
});

// ==================== ROUTES STATISTIQUES ====================

// POST — enregistrer une visite de région
app.post('/api/regions/:slug/vue', (req, res) => {
  const { slug } = req.params;
  const date = new Date().toLocaleString('fr-FR');
  db.prepare('INSERT INTO regions_vues (slug, date) VALUES (?, ?)').run(slug, date);
  res.json({ succes: true });
});

// GET — statistiques de visites par région
app.get('/api/stats', (req, res) => {
  const stats = db.prepare(
    'SELECT slug, COUNT(*) as vues FROM regions_vues GROUP BY slug ORDER BY vues DESC'
  ).all();
  res.json(stats);
});

// ==================== ROUTE ACCUEIL ====================
app.get('/', (req, res) => {
  res.redirect('/acceuil.html');
});

// ==================== DÉMARRAGE ====================
app.listen(PORT, () => {
  console.log(`✅ Serveur démarré sur http://localhost:${PORT}`);
  console.log(`📡 API disponible sur http://localhost:${PORT}/api/regions`);
});

// ==================== KEEP-ALIVE ====================
// Empêche Render (plan gratuit) de mettre le service en veille
setInterval(() => {
  https.get('https://burkina-faso-avenir.onrender.com/api/zones', (res) => {
    console.log(`🔄 Keep-alive ping — statut : ${res.statusCode}`);
  }).on('error', (err) => {
    console.log(`⚠️ Keep-alive erreur : ${err.message}`);
  });
}, 14 * 60 * 1000); // toutes les 14 minutes
