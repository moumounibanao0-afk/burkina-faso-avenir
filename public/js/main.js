// ============================================================
//  MAIN.JS — Burkina Terres d'Avenir
//  Projet L3 Informatique 2025-2026
//  Fonctionnalités : menu mobile, filtres, animations,
//  smooth scroll, back-to-top, tabs, barre progression
// ============================================================

document.addEventListener('DOMContentLoaded', () => {

  console.log(
    '%c🇧🇫 Burkina Terres d\'Avenir',
    'color:#008751; font-size:18px; font-weight:bold;'
  );
  console.log(
    '%cProjet L3 Informatique 2025-2026 — Chargé avec succès ✅',
    'color:#E8B923; font-weight:bold;'
  );

  // ==================== 1. MENU MOBILE ====================
  const mobileBtn = document.getElementById('mobileBtn');
  const navbar    = document.querySelector('nav');

  if (mobileBtn && navbar) {
    mobileBtn.addEventListener('click', () => {
      let menu = document.getElementById('mobile-menu');

      if (!menu) {
        menu = document.createElement('div');
        menu.id = 'mobile-menu';
        menu.className = 'md:hidden bg-white shadow-xl py-5 px-6 absolute w-full left-0 top-full border-t-4 z-40';
        menu.style.borderTopColor = '#008751';
        menu.innerHTML = `
          <div class="flex flex-col gap-4 text-base font-semibold">
            <a href="index.html"      class="flex items-center gap-3 py-2 px-3 rounded-xl hover:bg-green-50 hover:text-[#008751] transition">🏠 <span>Accueil</span></a>
            <a href="regions.html"    class="flex items-center gap-3 py-2 px-3 rounded-xl hover:bg-green-50 hover:text-[#008751] transition">🗺️ <span>Les 17 Régions</span></a>
            <a href="potentiels.html" class="flex items-center gap-3 py-2 px-3 rounded-xl hover:bg-green-50 hover:text-[#008751] transition">⛏️ <span>Potentiels Nationaux</span></a>
            <a href="culture.html"    class="flex items-center gap-3 py-2 px-3 rounded-xl hover:bg-green-50 hover:text-[#008751] transition">🎭 <span>Culture & Patrimoine</span></a>
            <a href="apropos.html"    class="flex items-center gap-3 py-2 px-3 rounded-xl hover:bg-green-50 hover:text-[#008751] transition">ℹ️ <span>À Propos</span></a>
          </div>
          <div class="mt-4 pt-4 border-t border-gray-100 text-xs text-gray-400 text-center">
            🇧🇫 Burkina Terres d'Avenir — L3 Informatique 2026
          </div>
        `;
        navbar.appendChild(menu);
        navbar.style.position = 'fixed';
      } else {
        menu.classList.toggle('hidden');
      }

      // Icône burger / X
      const icon = mobileBtn.querySelector('i');
      if (icon) {
        icon.classList.toggle('fa-bars');
        icon.classList.toggle('fa-xmark');
      }
    });

    // Fermer le menu si on clique ailleurs
    document.addEventListener('click', (e) => {
      const menu = document.getElementById('mobile-menu');
      if (menu && !navbar.contains(e.target)) {
        menu.classList.add('hidden');
        const icon = mobileBtn.querySelector('i');
        if (icon) {
          icon.classList.add('fa-bars');
          icon.classList.remove('fa-xmark');
        }
      }
    });
  }

  // ==================== 2. NAVBAR SCROLL ====================
  const navEl = document.getElementById('navbar');
  if (navEl) {
    window.addEventListener('scroll', () => {
      navEl.classList.toggle('nav-scrolled', window.scrollY > 50);
    });
  }

  // ==================== 3. BACK TO TOP ====================
  // Créer le bouton
  const backBtn = document.createElement('button');
  backBtn.id = 'back-to-top';
  backBtn.innerHTML = '<i class="fa-solid fa-arrow-up"></i>';
  backBtn.setAttribute('title', 'Retour en haut de page');
  backBtn.setAttribute('aria-label', 'Retour en haut');
  document.body.appendChild(backBtn);

  window.addEventListener('scroll', () => {
    backBtn.classList.toggle('visible', window.scrollY > 500);
  });

  backBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  // ==================== 4. SMOOTH SCROLL (ancres) ====================
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      if (href === '#') return;
      const target = document.querySelector(href);
      if (target) {
        e.preventDefault();
        const offset = 90; // hauteur navbar
        const top = target.getBoundingClientRect().top + window.scrollY - offset;
        window.scrollTo({ top, behavior: 'smooth' });
      }
    });
  });

  // ==================== 5. ANIMATIONS AU SCROLL ====================
  const animObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        // Déclencher les barres de progression si présentes
        entry.target.querySelectorAll('.prog-fill, .skill-fill').forEach(bar => {
          const w = bar.getAttribute('data-w') || bar.getAttribute('data-width');
          if (w) {
            setTimeout(() => { bar.style.width = w + '%'; }, 200);
          }
        });
      }
    });
  }, {
    threshold: 0.12,
    rootMargin: '0px 0px -40px 0px'
  });

  document.querySelectorAll('.animate, .fade-up, .slide-in').forEach(el => {
    animObserver.observe(el);
  });

  // ==================== 6. BARRES PROGRESSION (globales) ====================
  const progObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.querySelectorAll('.prog-fill, .skill-fill').forEach(bar => {
          const w = bar.getAttribute('data-w') || bar.getAttribute('data-width');
          if (w && bar.style.width === '' || bar.style.width === '0px' || bar.style.width === '0%') {
            setTimeout(() => { bar.style.width = w + '%'; }, 300);
          }
        });
      }
    });
  }, { threshold: 0.3 });

  document.querySelectorAll('section, .tab-content').forEach(el => {
    progObserver.observe(el);
  });

  // Déclencher aussi au chargement pour les éléments visibles
  setTimeout(() => {
    document.querySelectorAll('.prog-fill, .skill-fill').forEach(bar => {
      const rect = bar.getBoundingClientRect();
      if (rect.top < window.innerHeight) {
        const w = bar.getAttribute('data-w') || bar.getAttribute('data-width');
        if (w) bar.style.width = w + '%';
      }
    });
  }, 500);

  // ==================== 7. FILTRE RÉGIONS ====================
  window.filterRegions = function (zone, btn) {
    // Reset tous les boutons filtres
    document.querySelectorAll('.filter-btn').forEach(b => {
      b.classList.remove('active');
      b.style.background   = '';
      b.style.color        = '';
      b.style.borderColor  = '';
    });

    // Activer le bouton cliqué
    if (btn) {
      btn.classList.add('active');
    }

    // Filtrer les cartes
    const cards = document.querySelectorAll('.region-card');
    let count = 0;

    cards.forEach((card, i) => {
      const match = zone === 'all' || card.getAttribute('data-region') === zone;
      if (match) {
        card.style.display = 'block';
        card.style.animationDelay = (i * 0.05) + 's';
        count++;
      } else {
        card.style.display = 'none';
      }
    });

    // Mise à jour compteur
    const counter = document.getElementById('resultCount');
    if (counter) {
      counter.textContent = count + ' région' + (count > 1 ? 's' : '') +
        ' affichée' + (count > 1 ? 's' : '');
    }

    // Message "aucun résultat"
    const noResult = document.getElementById('noResult');
    if (noResult) {
      noResult.classList.toggle('hidden', count > 0);
    }

    // Réinitialiser la recherche
    const searchInput = document.getElementById('searchInput');
    if (searchInput) searchInput.value = '';
  };

  // ==================== 8. RECHERCHE RÉGIONS ====================
  window.searchRegions = function (query) {
    const q = query.toLowerCase().trim();
    const cards = document.querySelectorAll('.region-card');
    let count = 0;

    cards.forEach(card => {
      const nom = (card.getAttribute('data-nom') || '').toLowerCase();
      const titre = (card.querySelector('h3')?.textContent || '').toLowerCase();
      const match = q === '' || nom.includes(q) || titre.includes(q);

      card.style.display = match ? 'block' : 'none';
      if (match) count++;
    });

    // Mise à jour compteur
    const counter = document.getElementById('resultCount');
    if (counter) {
      counter.textContent = count + ' région' + (count > 1 ? 's' : '') +
        ' affichée' + (count > 1 ? 's' : '');
    }

    // Message "aucun résultat"
    const noResult = document.getElementById('noResult');
    if (noResult) {
      noResult.classList.toggle('hidden', count > 0);
    }

    // Désactiver les filtres de zone
    if (q !== '') {
      document.querySelectorAll('.filter-btn').forEach(b => {
        b.classList.remove('active');
      });
    }
  };

  // ==================== 9. SYSTÈME D'ONGLETS (TABS) ====================
  window.showTab = function (name) {
    // Cacher tous les contenus
    document.querySelectorAll('.tab-content').forEach(t => {
      t.classList.remove('active');
    });

    // Désactiver tous les boutons
    document.querySelectorAll('.tab-btn').forEach(b => {
      b.classList.remove('active');
    });

    // Afficher le contenu sélectionné
    const content = document.getElementById('tab-' + name);
    if (content) {
      content.classList.add('active');
      // Animer les barres dans ce tab
      setTimeout(() => {
        content.querySelectorAll('.prog-fill, .skill-fill').forEach(bar => {
          const w = bar.getAttribute('data-w') || bar.getAttribute('data-width');
          if (w) bar.style.width = w + '%';
        });
      }, 100);
    }

    // Activer le bouton correspondant
    if (event && event.target) {
      event.target.classList.add('active');
    }
  };

  // ==================== 10. ACTIVE NAV LINK ====================
  const currentPage = window.location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('nav a[href]').forEach(link => {
    const linkPage = link.getAttribute('href').split('/').pop();
    if (linkPage === currentPage) {
      link.classList.add('text-[#008751]', 'font-bold');
    }
  });

  // ==================== 11. LAZY LOADING IMAGES ====================
  if ('IntersectionObserver' in window) {
    const imgObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const img = entry.target;
          if (img.dataset.src) {
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
          }
          imgObserver.unobserve(img);
        }
      });
    }, { rootMargin: '200px' });

    document.querySelectorAll('img[data-src]').forEach(img => {
      imgObserver.observe(img);
    });
  }

  // ==================== 12. GESTION ERREURS IMAGES ====================
  const fallbackSvg = encodeURIComponent(`
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 480">
      <rect width="640" height="240" fill="#EF2B2D" />
      <rect y="240" width="640" height="240" fill="#009A00" />
      <text x="320" y="270" text-anchor="middle" font-size="32" fill="#ffffff" font-family="Arial, sans-serif">Image indisponible</text>
    </svg>
  `);

  document.querySelectorAll('img').forEach(img => {
    if (!img.hasAttribute('onerror')) {
      img.addEventListener('error', function () {
        this.src = 'data:image/svg+xml;charset=UTF-8,' + fallbackSvg;
        this.alt = 'Image non disponible — Burkina Faso';
      });
    }
  });

  // ==================== 13. TOOLTIP SIMPLE ====================
  document.querySelectorAll('[data-tooltip]').forEach(el => {
    el.style.position = 'relative';
    el.style.cursor = 'pointer';

    el.addEventListener('mouseenter', function () {
      const tip = document.createElement('div');
      tip.className = 'data-tip';
      tip.textContent = this.getAttribute('data-tooltip');
      tip.style.cssText = `
        position:absolute; bottom:110%; left:50%; transform:translateX(-50%);
        background:#1F2937; color:white; padding:6px 12px; border-radius:8px;
        font-size:12px; white-space:nowrap; z-index:100; pointer-events:none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      `;
      this.appendChild(tip);
    });

    el.addEventListener('mouseleave', function () {
      const tip = this.querySelector('.data-tip');
      if (tip) tip.remove();
    });
  });

  // ==================== 14. CONFIRMATION FORMULAIRE ====================
  window.envoyerMessage = function () {
    const nom     = document.getElementById('nom')?.value.trim();
    const email   = document.getElementById('email')?.value.trim();
    const sujet   = document.getElementById('sujet')?.value.trim();
    const message = document.getElementById('message')?.value.trim();
    if (!nom || !email || !message) {
      alert('Veuillez remplir tous les champs obligatoires.');
      return;
    }
    if (!email.includes('@') || !email.includes('.')) {
      alert('Veuillez entrer une adresse email valide.');
      return;
    }
    fetch('/api/contact', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ nom, email, sujet, message })
    })
    .then(function(response) { return response.json(); })
    .then(function(data) {
      if (data.succes) {
        const confirm = document.getElementById('confirmation');
        if (confirm) {
          confirm.classList.remove('hidden');
          confirm.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        ['nom', 'email', 'message'].forEach(id => {
          const el = document.getElementById(id);
          if (el) el.value = '';
        });
      }
    })
    .catch(function(err) { alert('Erreur : ' + err); });
  };

  // ==================== 15. COMPTEUR CHIFFRES ANIMÉ ====================
  function animateNumber(el, target, duration = 1500) {
    const start = 0;
    const step  = target / (duration / 16);
    let current = start;

    const timer = setInterval(() => {
      current += step;
      if (current >= target) {
        el.textContent = target.toLocaleString('fr-FR');
        clearInterval(timer);
      } else {
        el.textContent = Math.floor(current).toLocaleString('fr-FR');
      }
    }, 16);
  }

  // Observer les éléments avec data-count
  const countObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const target = parseInt(entry.target.getAttribute('data-count'));
        if (!isNaN(target)) {
          animateNumber(entry.target, target);
          countObserver.unobserve(entry.target);
        }
      }
    });
  }, { threshold: 0.5 });

  document.querySelectorAll('[data-count]').forEach(el => {
    countObserver.observe(el);
  });

  // ==================== 16. PRINT PAGE ====================
  window.printPage = function () {
    window.print();
  };

  // ==================== FIN CHARGEMENT ====================
  console.log(
    '%c✅ Toutes les fonctionnalités chargées avec succès !',
    'color:#008751; font-size:13px;'
  );

}); // fin DOMContentLoaded