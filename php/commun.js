// ========== BOUTON RETOUR EN HAUT ==========
const btnTop = document.createElement('button');
btnTop.innerHTML = '▲';
btnTop.title = 'Retour en haut';
btnTop.style.cssText = `
  position: fixed; bottom: 30px; right: 30px; z-index: 999;
  background: #008751; color: white; border: none;
  width: 45px; height: 45px; border-radius: 50%;
  font-size: 18px; cursor: pointer;
  box-shadow: 0 4px 12px rgba(0,0,0,0.3);
  display: none; transition: opacity 0.3s;
`;
btnTop.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
document.body.appendChild(btnTop);

window.addEventListener('scroll', () => {
  btnTop.style.display = window.scrollY > 300 ? 'block' : 'none';
});

// ========== MODE SOMBRE ==========
const darkBtn = document.createElement('button');
darkBtn.innerHTML = '🌙';
darkBtn.title = 'Mode sombre';
darkBtn.style.cssText = `
  position: fixed; bottom: 85px; right: 30px; z-index: 999;
  background: #333; color: white; border: none;
  width: 45px; height: 45px; border-radius: 50%;
  font-size: 18px; cursor: pointer;
  box-shadow: 0 4px 12px rgba(0,0,0,0.3);
  transition: all 0.3s;
`;

const darkCSS = document.createElement('style');
darkCSS.id = 'dark-mode-style';
darkCSS.textContent = `
  body.dark { background: #1a1a2e !important; color: #e0e0e0 !important; }
  body.dark .navbar { background: #16213e !important; }
  body.dark .navbar nav a { color: #ccc !important; }
  body.dark .card, body.dark .section, body.dark .info-card,
  body.dark .stat, body.dark .province-card, body.dark .container > div,
  body.dark table, body.dark .contact-section { background: #16213e !important; color: #e0e0e0 !important; }
  body.dark .card-body h3, body.dark .section h2 { color: #4ade80 !important; }
  body.dark .card-body p, body.dark .section p { color: #ccc !important; }
  body.dark footer { background: #0a0a1a !important; }
  body.dark input, body.dark textarea, body.dark select {
    background: #16213e !important; color: #e0e0e0 !important; border-color: #444 !important;
  }
  body.dark th { background: #006a3e !important; }
  body.dark td { border-color: #333 !important; }
  body.dark .tab, body.dark .filtres a { background: #16213e !important; color: #4ade80 !important; }
`;
document.head.appendChild(darkCSS);

// Restaurer mode sombre si activé
if (localStorage.getItem('darkMode') === '1') {
  document.body.classList.add('dark');
  darkBtn.innerHTML = '☀️';
  darkBtn.style.background = '#E8B923';
}

darkBtn.onclick = () => {
  document.body.classList.toggle('dark');
  const isDark = document.body.classList.contains('dark');
  localStorage.setItem('darkMode', isDark ? '1' : '0');
  darkBtn.innerHTML = isDark ? '☀️' : '🌙';
  darkBtn.style.background = isDark ? '#E8B923' : '#333';
};
document.body.appendChild(darkBtn);

// ========== LOADER ANIMÉ ==========
window.addEventListener('load', () => {
  const loader = document.getElementById('page-loader');
  if (loader) loader.style.display = 'none';
});
