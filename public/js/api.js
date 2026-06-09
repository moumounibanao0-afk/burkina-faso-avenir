// api.js — Connexion au backend
// fetch() = fonction JS pour appeler une API via internet/réseau

fetch('http://localhost:4000/api/regions')
  .then(function(response) {
    // .then() = "quand la réponse arrive, fais ceci"
    return response.json(); // convertit la réponse texte en objet JavaScript
  })
  .then(function(regions) {
    // regions = tableau des 17 régions reçu depuis le serveur
    const grille = document.getElementById('regionsGrid');
    grille.innerHTML = ''; // vide les cartes statiques

    regions.forEach(function(region) {
      // forEach = "pour chaque région, fais ceci"
      const carte = document.createElement('div');
      carte.className = 'region-card bg-white shadow-lg';
      carte.setAttribute('data-region', region.zone);
      carte.setAttribute('data-nom', region.nom.toLowerCase());

      carte.innerHTML = `
        <div class="p-5">
          <div class="flex justify-between items-start mb-2">
            <h3 class="text-xl font-bold text-[#008751]">${region.nom}</h3>
            <span class="text-xs bg-gray-100 text-gray-500 px-2 py-1 rounded">${region.zone}</span>
          </div>
          <p class="text-gray-500 text-sm mb-1">🏙️ <strong>${region.chefLieu}</strong></p>
          <p class="text-gray-500 text-sm mb-3">👥 ${region.peuples.join(', ')}</p>
          <p class="text-gray-600 text-sm mb-4">${region.description}</p>
          <div class="flex flex-wrap gap-1 mb-4">
            ${region.potentiels.map(p => `
              <span class="text-xs bg-green-50 text-[#008751] px-2 py-0.5 rounded-full">${p}</span>
            `).join('')}
          </div>
          <a href="regions/region.html?slug=${region.slug}"
             class="block w-full text-center bg-[#008751] text-white py-2.5 rounded-lg font-semibold text-sm hover:bg-[#006840] transition">
            Découvrir ${region.nom} →
          </a>
        </div>
      `;

      grille.appendChild(carte);
    });

    // Met à jour le compteur affiché
    document.getElementById('resultCount').textContent = regions.length + ' régions affichées';
  })
  .catch(function(erreur) {
    // .catch() = "si ça échoue, affiche l'erreur"
    console.error('Erreur API :', erreur);
  });
