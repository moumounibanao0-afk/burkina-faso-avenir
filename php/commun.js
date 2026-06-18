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

// ========== LOADER ANIMÉ ==========
const loaderDiv = document.createElement('div');
loaderDiv.id = 'page-loader';
loaderDiv.style.cssText = `
  position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;
  background: white; display: flex; flex-direction: column;
  align-items: center; justify-content: center; transition: opacity 0.5s;
`;
loaderDiv.innerHTML = `
  <div style="font-size:48px;margin-bottom:15px">🇧🇫</div>
  <div style="font-size:18px;color:#008751;font-weight:bold;margin-bottom:15px">Burkina Terres d'Avenir</div>
  <div style="width:200px;height:4px;background:#eee;border-radius:2px;overflow:hidden">
    <div id="loader-bar" style="height:100%;background:linear-gradient(90deg,#EF2B2D,#008751);width:0%;transition:width 0.5s;border-radius:2px"></div>
  </div>
`;
document.body.insertBefore(loaderDiv, document.body.firstChild);

let progress = 0;
const barInterval = setInterval(() => {
  progress = Math.min(progress + Math.random() * 15, 90);
  const bar = document.getElementById('loader-bar');
  if (bar) bar.style.width = progress + '%';
}, 100);

window.addEventListener('load', () => {
  clearInterval(barInterval);
  const bar = document.getElementById('loader-bar');
  if (bar) bar.style.width = '100%';
  setTimeout(() => {
    loaderDiv.style.opacity = '0';
    setTimeout(() => loaderDiv.style.display = 'none', 500);
  }, 300);
});

// ========== IMPRESSION PDF ==========
const printBtn = document.createElement('button');
printBtn.innerHTML = '🖨️';
printBtn.title = 'Imprimer / Sauvegarder en PDF';
printBtn.style.cssText = `
  position: fixed; bottom: 140px; right: 30px; z-index: 998;
  background: #1B4F72; color: white; border: none;
  width: 45px; height: 45px; border-radius: 50%;
  font-size: 18px; cursor: pointer;
  box-shadow: 0 4px 12px rgba(0,0,0,0.3);
  transition: all 0.3s;
`;
printBtn.onclick = () => window.print();
document.body.appendChild(printBtn);

// Style impression
const printStyle = document.createElement('style');
printStyle.textContent = `
  @media print {
    .navbar, .flag-stripe, #page-loader,
    button[title], .nav-regions, footer,
    .voir-plus, .search-hero, .contact-section { display: none !important; }
    body { background: white !important; }
    .hero { background: #008751 !important; -webkit-print-color-adjust: exact; }
    .card, .section, .info-card { box-shadow: none !important; border: 1px solid #eee !important; }
    @page { margin: 1cm; }
  }
`;
document.head.appendChild(printStyle);

// ========== LIGHTBOX GALERIE ==========
const lightbox = document.createElement('div');
lightbox.id = 'lightbox';
lightbox.style.cssText = `
  display: none; position: fixed; top: 0; left: 0;
  width: 100%; height: 100%; z-index: 10000;
  background: rgba(0,0,0,0.92); align-items: center;
  justify-content: center; flex-direction: column;
`;
lightbox.innerHTML = `
  <button onclick="document.getElementById('lightbox').style.display='none'"
    style="position:absolute;top:20px;right:25px;background:none;border:none;
    color:white;font-size:36px;cursor:pointer;z-index:10001">✕</button>
  <img id="lightbox-img" src="" style="max-width:90%;max-height:80vh;border-radius:8px;box-shadow:0 0 30px rgba(0,0,0,0.5)">
  <p id="lightbox-caption" style="color:white;margin-top:15px;font-size:14px;text-align:center"></p>
  <div style="display:flex;gap:15px;margin-top:15px">
    <button id="lb-prev" style="background:#008751;color:white;border:none;padding:8px 18px;border-radius:20px;cursor:pointer;font-size:16px">← Précédent</button>
    <button id="lb-next" style="background:#008751;color:white;border:none;padding:8px 18px;border-radius:20px;cursor:pointer;font-size:16px">Suivant →</button>
  </div>
`;
document.body.appendChild(lightbox);

let lbImages = [];
let lbIndex = 0;

function openLightbox(imgs, idx) {
  lbImages = imgs;
  lbIndex = idx;
  showLightboxImg();
  lightbox.style.display = 'flex';
}

function showLightboxImg() {
  const img = lbImages[lbIndex];
  document.getElementById('lightbox-img').src = img.src;
  document.getElementById('lightbox-caption').textContent = img.alt || '';
}

document.getElementById('lb-prev').onclick = () => {
  lbIndex = (lbIndex - 1 + lbImages.length) % lbImages.length;
  showLightboxImg();
};
document.getElementById('lb-next').onclick = () => {
  lbIndex = (lbIndex + 1) % lbImages.length;
  showLightboxImg();
};

lightbox.addEventListener('click', (e) => {
  if (e.target === lightbox) lightbox.style.display = 'none';
});

document.addEventListener('keydown', (e) => {
  if (lightbox.style.display !== 'none') {
    if (e.key === 'Escape') lightbox.style.display = 'none';
    if (e.key === 'ArrowLeft') { lbIndex = (lbIndex-1+lbImages.length)%lbImages.length; showLightboxImg(); }
    if (e.key === 'ArrowRight') { lbIndex = (lbIndex+1)%lbImages.length; showLightboxImg(); }
  }
});

// Rendre toutes les images cliquables avec lightbox
window.addEventListener('load', () => {
  const allImgs = document.querySelectorAll('.card img, .hero img, .s-card img');
  const imgArr = Array.from(allImgs).map(i => ({ src: i.src, alt: i.alt }));
  allImgs.forEach((img, idx) => {
    img.style.cursor = 'zoom-in';
    img.addEventListener('click', () => openLightbox(imgArr, idx));
  });
});

// ========== BOUTON ADMIN FLOTTANT ==========
const adminBtn = document.createElement('a');
adminBtn.href = 'admin.php';
adminBtn.title = 'Espace Administrateur';
adminBtn.innerHTML = '🔐 Admin';
adminBtn.style.cssText = `
  position: fixed; bottom: 200px; right: 30px; z-index: 998;
  background: #1B4F72; color: white; border: none;
  padding: 8px 16px; border-radius: 20px;
  font-size: 13px; font-weight: bold; cursor: pointer;
  box-shadow: 0 4px 12px rgba(0,0,0,0.3);
  text-decoration: none; transition: all 0.3s;
`;
adminBtn.onmouseover = () => adminBtn.style.background = '#154360';
adminBtn.onmouseout = () => adminBtn.style.background = '#1B4F72';
document.body.appendChild(adminBtn);
