const express = require('express');
const cors = require('cors');
const regions = require('./data/regions');

const app = express();
const PORT = 4000;

// Middleware
app.use(cors());
app.use(express.json());
app.use(express.static('public'));

// ==================== ROUTES ====================

// GET toutes les régions
app.get('/api/regions', (req, res) => {
  const { zone } = req.query;
  
  if (zone) {
    const filtered = regions.filter(r => r.zone === zone);
    return res.json(filtered);
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

// Route de test
app.get('/', (req, res) => {
  res.redirect('/acceuil.html');
	});

    version: '1.0',
    routes: [
      'GET /api/regions',
      'GET /api/regions?zone=est',
      'GET /api/regions/:slug',
      'GET /api/zones'
    ]
  });
});

// ==================== DÉMARRAGE ====================
// Stocker les messages en mémoire
const messages = [];

// POST recevoir un message du formulaire
// POST = envoyer des données au serveur (contrairement à GET qui demande des données)
app.post('/api/contact', (req, res) => {
  const { nom, email, sujet, message } = req.body;

  // Vérification que les champs obligatoires sont remplis
  if (!nom || !email || !message) {
    return res.status(400).json({ erreur: 'Champs obligatoires manquants' });
  }

  // Créer le message avec la date
  const nouveauMessage = {
    id: messages.length + 1,
    nom,
    email,
    sujet,
    message,
    date: new Date().toLocaleString('fr-FR')
  };

  // Sauvegarder le message
  messages.push(nouveauMessage);

  console.log('📩 Nouveau message reçu :', nouveauMessage);

  res.json({ succes: true, messageRecu: 'Message bien reçu !' });
});

// GET voir tous les messages reçus
app.get('/api/messages', (req, res) => {
  res.json(messages);
});
app.listen(PORT, () => {
  console.log(`✅ Serveur démarré sur http://localhost:${PORT}`);
  console.log(`📡 API disponible sur http://localhost:${PORT}/api/regions`);
});

