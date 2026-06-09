// ============================================================
// IMAGES.JS — Illustrations SVG pour chaque région
// Fonctionne 100% en local — aucune connexion requise
// ============================================================

const RegionImages = {

  // Chaque région a une illustration SVG unique
  // avec les couleurs et symboles du Burkina Faso

  kadiogo: `
    <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="skyKad" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" style="stop-color:#1a6b3c"/>
          <stop offset="100%" style="stop-color:#2d8a52"/>
        </linearGradient>
      </defs>
      <!-- Ciel -->
      <rect width="400" height="220" fill="url(#skyKad)"/>
      <!-- Sol -->
      <rect y="160" width="400" height="60" fill="#8B4513"/>
      <!-- Bâtiments Ouagadougou -->
      <rect x="20" y="100" width="40" height="60" fill="#E8B923"/>
      <rect x="70" y="80" width="50" height="80" fill="#c99a00"/>
      <rect x="130" y="90" width="35" height="70" fill="#E8B923"/>
      <rect x="175" y="70" width="60" height="90" fill="#008751" opacity="0.8"/>
      <rect x="245" y="95" width="40" height="65" fill="#c99a00"/>
      <rect x="295" y="85" width="55" height="75" fill="#E8B923"/>
      <rect x="355" y="105" width="35" height="55" fill="#c99a00"/>
      <!-- Fenêtres -->
      <rect x="80" y="90" width="10" height="8" fill="#fff" opacity="0.6"/>
      <rect x="95" y="90" width="10" height="8" fill="#fff" opacity="0.6"/>
      <rect x="80" y="105" width="10" height="8" fill="#fff" opacity="0.6"/>
      <rect x="95" y="105" width="10" height="8" fill="#fff" opacity="0.6"/>
      <rect x="185" y="82" width="12" height="10" fill="#fff" opacity="0.5"/>
      <rect x="205" y="82" width="12" height="10" fill="#fff" opacity="0.5"/>
      <!-- Soleil -->
      <circle cx="340" cy="40" r="25" fill="#E8B923" opacity="0.9"/>
      <!-- Texte -->
      <text x="200" y="210" text-anchor="middle" fill="white" font-size="13" font-family="serif" font-weight="bold">OUAGADOUGOU — Capitale Nationale</text>
    </svg>
  `,

  ouibri: `
    <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="skyOub" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" style="stop-color:#1a5c3a"/>
          <stop offset="100%" style="stop-color:#2d8a52"/>
        </linearGradient>
      </defs>
      <rect width="400" height="220" fill="url(#skyOub)"/>
      <rect y="155" width="400" height="65" fill="#8B6914"/>
      <!-- Palais royal en banco -->
      <rect x="130" y="90" width="140" height="65" fill="#c8a050"/>
      <rect x="110" y="100" width="180" height="55" fill="#d4aa60"/>
      <!-- Tours du palais -->
      <rect x="110" y="70" width="30" height="30" fill="#c8a050"/>
      <rect x="260" y="70" width="30" height="30" fill="#c8a050"/>
      <polygon points="110,70 125,50 140,70" fill="#A0522D"/>
      <polygon points="260,70 275,50 290,70" fill="#A0522D"/>
      <!-- Porte royale -->
      <ellipse cx="200" cy="155" rx="20" ry="28" fill="#8B4513"/>
      <!-- Arbres -->
      <circle cx="60" cy="130" r="30" fill="#1a7a30"/>
      <rect x="55" y="150" width="10" height="20" fill="#8B4513"/>
      <circle cx="340" cy="125" r="35" fill="#1a7a30"/>
      <rect x="335" y="150" width="10" height="20" fill="#8B4513"/>
      <!-- Soleil -->
      <circle cx="50" cy="40" r="20" fill="#E8B923" opacity="0.9"/>
      <text x="200" y="210" text-anchor="middle" fill="white" font-size="13" font-family="serif" font-weight="bold">ZINIARÉ — Plateau Central — Royaume Mossi</text>
    </svg>
  `,

  guiriko: `
    <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="skyGui" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" style="stop-color:#2d4a8a"/>
          <stop offset="100%" style="stop-color:#1a3a6b"/>
        </linearGradient>
      </defs>
      <rect width="400" height="220" fill="#E8B923"/>
      <rect y="140" width="400" height="80" fill="#8B6914"/>
      <!-- Grande Mosquée de Bobo style soudanais -->
      <!-- Corps principal -->
      <rect x="100" y="60" width="200" height="80" fill="#c8a050"/>
      <!-- Murs latéraux -->
      <rect x="80" y="80" width="240" height="60" fill="#d4aa60"/>
      <!-- Tours/minarets -->
      <rect x="90" y="30" width="30" height="50" fill="#c8a050"/>
      <rect x="280" y="30" width="30" height="50" fill="#c8a050"/>
      <rect x="185" y="20" width="30" height="40" fill="#c8a050"/>
      <!-- Pointes des minarets -->
      <polygon points="90,30 105,10 120,30" fill="#A0522D"/>
      <polygon points="280,30 295,10 310,30" fill="#A0522D"/>
      <polygon points="185,20 200,0 215,20" fill="#A0522D"/>
      <!-- Épines décoratives (style soudanais) -->
      <line x1="95" y1="40" x2="85" y2="35" stroke="#8B4513" stroke-width="2"/>
      <line x1="105" y1="40" x2="95" y2="35" stroke="#8B4513" stroke-width="2"/>
      <line x1="115" y1="40" x2="105" y2="35" stroke="#8B4513" stroke-width="2"/>
      <line x1="285" y1="40" x2="275" y2="35" stroke="#8B4513" stroke-width="2"/>
      <line x1="295" y1="40" x2="285" y2="35" stroke="#8B4513" stroke-width="2"/>
      <line x1="305" y1="40" x2="295" y2="35" stroke="#8B4513" stroke-width="2"/>
      <!-- Entrée mosquée -->
      <ellipse cx="200" cy="140" rx="25" ry="35" fill="#8B4513"/>
      <!-- Soleil couchant -->
      <circle cx="350" cy="50" r="30" fill="#EF2B2D" opacity="0.8"/>
      <text x="200" y="210" text-anchor="middle" fill="white" font-size="13" font-family="serif" font-weight="bold">BOBO-DIOULASSO — Grande Mosquée Soudanaise</text>
    </svg>
  `,

  bankui: `
    <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="skyBan" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" style="stop-color:#1a5c1a"/>
          <stop offset="100%" style="stop-color:#3d8a3d"/>
        </linearGradient>
      </defs>
      <rect width="400" height="220" fill="url(#skyBan)"/>
      <rect y="150" width="400" height="70" fill="#5a3a10"/>
      <!-- Forêt dense Mouhoun -->
      <circle cx="30" cy="140" r="40" fill="#0d5c0d"/>
      <circle cx="70" cy="130" r="45" fill="#1a7a1a"/>
      <circle cx="110" cy="145" r="38" fill="#0d5c0d"/>
      <circle cx="150" cy="135" r="42" fill="#1a7a1a"/>
      <circle cx="190" cy="148" r="35" fill="#0d5c0d"/>
      <circle cx="230" cy="130" r="45" fill="#1a7a1a"/>
      <circle cx="270" cy="142" r="38" fill="#0d5c0d"/>
      <circle cx="310" cy="133" r="43" fill="#1a7a1a"/>
      <circle cx="350" cy="145" r="40" fill="#0d5c0d"/>
      <circle cx="390" cy="135" r="38" fill="#1a7a1a"/>
      <!-- Masque Bwa stylisé -->
      <rect x="175" y="40" width="50" height="80" fill="#c8a050" rx="5"/>
      <!-- Motifs géométriques du masque -->
      <circle cx="200" cy="65" r="8" fill="#8B4513"/>
      <rect x="180" y="80" width="40" height="5" fill="#8B4513"/>
      <polygon points="185,90 200,50 215,90" fill="#EF2B2D" opacity="0.7"/>
      <!-- Rivière Mouhoun -->
      <path d="M 0 175 Q 100 165 200 175 Q 300 185 400 175" stroke="#4a90d9" stroke-width="6" fill="none" opacity="0.8"/>
      <text x="200" y="210" text-anchor="middle" fill="white" font-size="13" font-family="serif" font-weight="bold">DÉDOUGOU — Masques Bwa — Boucle du Mouhoun</text>
    </svg>
  `,

  nando: `
    <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
      <rect width="400" height="220" fill="#8B4513"/>
      <rect y="160" width="400" height="60" fill="#5a3a10"/>
      <!-- Tissu Faso Dan Fani — motifs géométriques -->
      <!-- Bandes horizontales colorées -->
      <rect y="0" width="400" height="30" fill="#EF2B2D"/>
      <rect y="30" width="400" height="30" fill="#008751"/>
      <rect y="60" width="400" height="30" fill="#E8B923"/>
      <rect y="90" width="400" height="30" fill="#EF2B2D"/>
      <rect y="120" width="400" height="30" fill="#008751"/>
      <rect y="150" width="400" height="10" fill="#E8B923"/>
      <!-- Motifs géométriques sur le tissu -->
      <rect x="0" y="0" width="20" height="160" fill="#1F2937" opacity="0.3"/>
      <rect x="40" y="0" width="20" height="160" fill="#1F2937" opacity="0.3"/>
      <rect x="80" y="0" width="20" height="160" fill="#1F2937" opacity="0.3"/>
      <rect x="120" y="0" width="20" height="160" fill="#1F2937" opacity="0.3"/>
      <rect x="160" y="0" width="20" height="160" fill="#1F2937" opacity="0.3"/>
      <rect x="200" y="0" width="20" height="160" fill="#1F2937" opacity="0.3"/>
      <rect x="240" y="0" width="20" height="160" fill="#1F2937" opacity="0.3"/>
      <rect x="280" y="0" width="20" height="160" fill="#1F2937" opacity="0.3"/>
      <rect x="320" y="0" width="20" height="160" fill="#1F2937" opacity="0.3"/>
      <rect x="360" y="0" width="20" height="160" fill="#1F2937" opacity="0.3"/>
      <!-- Losanges décoratifs -->
      <polygon points="50,40 70,20 90,40 70,60" fill="#fff" opacity="0.4"/>
      <polygon points="170,80 190,60 210,80 190,100" fill="#fff" opacity="0.4"/>
      <polygon points="290,30 310,10 330,30 310,50" fill="#fff" opacity="0.4"/>
      <!-- Métier à tisser stylisé -->
      <rect x="150" y="165" width="100" height="45" fill="#8B4513" rx="3"/>
      <rect x="145" y="160" width="110" height="8" fill="#5a3a10"/>
      <!-- Fils -->
      <line x1="155" y1="168" x2="155" y2="205" stroke="#E8B923" stroke-width="2"/>
      <line x1="170" y1="168" x2="170" y2="205" stroke="#EF2B2D" stroke-width="2"/>
      <line x1="185" y1="168" x2="185" y2="205" stroke="#008751" stroke-width="2"/>
      <line x1="200" y1="168" x2="200" y2="205" stroke="#E8B923" stroke-width="2"/>
      <line x1="215" y1="168" x2="215" y2="205" stroke="#EF2B2D" stroke-width="2"/>
      <line x1="230" y1="168" x2="230" y2="205" stroke="#008751" stroke-width="2"/>
      <line x1="245" y1="168" x2="245" y2="205" stroke="#E8B923" stroke-width="2"/>
      <text x="200" y="218" text-anchor="middle" fill="white" font-size="11" font-family="serif" font-weight="bold">KOUDOUGOU — Faso Dan Fani — Tissu National</text>
    </svg>
  `,

  sourou: `
    <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="skySou" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" style="stop-color:#4a90d9"/>
          <stop offset="100%" style="stop-color:#2d6baa"/>
        </linearGradient>
      </defs>
      <!-- Ciel -->
      <rect width="400" height="220" fill="url(#skySou)"/>
      <!-- Eau du Sourou -->
      <rect y="140" width="400" height="80" fill="#1a6b9e"/>
      <!-- Reflets sur l'eau -->
      <path d="M 0 160 Q 50 155 100 160 Q 150 165 200 160 Q 250 155 300 160 Q 350 165 400 160" stroke="#4ab3e8" stroke-width="2" fill="none" opacity="0.6"/>
      <path d="M 0 175 Q 60 170 120 175 Q 180 180 240 175 Q 300 170 360 175 Q 380 178 400 175" stroke="#4ab3e8" stroke-width="2" fill="none" opacity="0.4"/>
      <!-- Rizières vertes -->
      <rect x="0" y="120" width="400" height="25" fill="#1a8a1a" opacity="0.8"/>
      <!-- Lignes de rizières -->
      <line x1="0" y1="125" x2="400" y2="125" stroke="#0d6b0d" stroke-width="1"/>
      <line x1="0" y1="130" x2="400" y2="130" stroke="#0d6b0d" stroke-width="1"/>
      <line x1="0" y1="135" x2="400" y2="135" stroke="#0d6b0d" stroke-width="1"/>
      <!-- Plants de riz -->
      <line x1="20" y1="130" x2="20" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="40" y1="130" x2="40" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="60" y1="130" x2="60" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="80" y1="130" x2="80" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="100" y1="130" x2="100" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="120" y1="130" x2="120" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="140" y1="130" x2="140" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="160" y1="130" x2="160" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="180" y1="130" x2="180" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="200" y1="130" x2="200" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="220" y1="130" x2="220" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="240" y1="130" x2="240" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="260" y1="130" x2="260" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="280" y1="130" x2="280" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="300" y1="130" x2="300" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="320" y1="130" x2="320" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="340" y1="130" x2="340" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="360" y1="130" x2="360" y2="115" stroke="#2da82d" stroke-width="2"/>
      <line x1="380" y1="130" x2="380" y2="115" stroke="#2da82d" stroke-width="2"/>
      <!-- Pirogue sur l'eau -->
      <ellipse cx="200" cy="160" rx="50" ry="10" fill="#8B4513"/>
      <rect x="155" y="150" width="90" height="12" fill="#A0522D" rx="3"/>
      <!-- Pêcheur -->
      <circle cx="200" cy="142" r="6" fill="#3d1a00"/>
      <line x1="200" y1="148" x2="200" y2="158" stroke="#3d1a00" stroke-width="2"/>
      <!-- Nuages -->
      <ellipse cx="80" cy="30" rx="40" ry="20" fill="white" opacity="0.7"/>
      <ellipse cx="110" cy="25" rx="35" ry="18" fill="white" opacity="0.7"/>
      <ellipse cx="300" cy="40" rx="45" ry="22" fill="white" opacity="0.7"/>
      <text x="200" y="210" text-anchor="middle" fill="white" font-size="13" font-family="serif" font-weight="bold">TOUGAN — Vallée du Sourou — Grenier à Riz</text>
    </svg>
  `,

  goulmou: `
    <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="skyGou" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" style="stop-color:#8B6914"/>
          <stop offset="100%" style="stop-color:#c99a00"/>
        </linearGradient>
      </defs>
      <rect width="400" height="220" fill="url(#skyGou)"/>
      <rect y="155" width="400" height="65" fill="#8B4513"/>
      <!-- Savane de l'Est -->
      <!-- Baobabs -->
      <rect x="40" y="80" width="20" height="80" fill="#5a3a10"/>
      <circle cx="50" cy="70" r="35" fill="#1a7a1a"/>
      <rect x="130" y="95" width="15" height="65" fill="#5a3a10"/>
      <circle cx="137" cy="85" r="28" fill="#1a7a1a"/>
      <!-- Troupeau de bovins -->
      <ellipse cx="200" cy="160" rx="25" ry="12" fill="#5a3a00"/>
      <circle cx="185" cy="150" r="8" fill="#5a3a00"/>
      <line x1="180" y1="158" x2="175" y2="175" stroke="#5a3a00" stroke-width="3"/>
      <line x1="185" y1="158" x2="182" y2="175" stroke="#5a3a00" stroke-width="3"/>
      <ellipse cx="260" cy="162" rx="22" ry="10" fill="#7a5000"/>
      <circle cx="247" cy="153" r="7" fill="#7a5000"/>
      <line x1="242" y1="160" x2="238" y2="175" stroke="#7a5000" stroke-width="3"/>
      <line x1="248" y1="160" x2="245" y2="175" stroke="#7a5000" stroke-width="3"/>
      <!-- Éléphant stylisé -->
      <ellipse cx="330" cy="155" rx="35" ry="22" fill="#5a5a5a"/>
      <circle cx="300" cy="143" r="18" fill="#5a5a5a"/>
      <path d="M 300 155 Q 285 170 280 185" stroke="#5a5a5a" stroke-width="8" fill="none"/>
      <line x1="310" y1="175" x2="308" y2="195" stroke="#5a5a5a" stroke-width="5"/>
      <line x1="325" y1="177" x2="323" y2="197" stroke="#5a5a5a" stroke-width="5"/>
      <line x1="340" y1="175" x2="338" y2="195" stroke="#5a5a5a" stroke-width="5"/>
      <line x1="355" y1="173" x2="353" y2="193" stroke="#5a5a5a" stroke-width="5"/>
      <!-- Soleil -->
      <circle cx="350" cy="35" r="28" fill="#EF2B2D" opacity="0.8"/>
      <text x="200" y="212" text-anchor="middle" fill="white" font-size="12" font-family="serif" font-weight="bold">FADA N'GOURMA — Savane de l'Est — Élevage</text>
    </svg>
  `,

  sirba: `
    <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="skySir" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" style="stop-color:#c8a050"/>
          <stop offset="100%" style="stop-color:#8B6914"/>
        </linearGradient>
      </defs>
      <rect width="400" height="220" fill="url(#skySir)"/>
      <rect y="150" width="400" height="70" fill="#8B4513"/>
      <!-- Champs de sésame -->
      <!-- Tiges de sésame -->
      <line x1="20" y1="150" x2="20" y2="80" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="40" y1="150" x2="40" y2="75" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="60" y1="150" x2="60" y2="85" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="80" y1="150" x2="80" y2="78" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="100" y1="150" x2="100" y2="82" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="120" y1="150" x2="120" y2="76" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="140" y1="150" x2="140" y2="84" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="160" y1="150" x2="160" y2="79" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="180" y1="150" x2="180" y2="83" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="200" y1="150" x2="200" y2="77" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="220" y1="150" x2="220" y2="81" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="240" y1="150" x2="240" y2="75" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="260" y1="150" x2="260" y2="87" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="280" y1="150" x2="280" y2="79" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="300" y1="150" x2="300" y2="83" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="320" y1="150" x2="320" y2="76" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="340" y1="150" x2="340" y2="84" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="360" y1="150" x2="360" y2="80" stroke="#5a8a2a" stroke-width="3"/>
      <line x1="380" y1="150" x2="380" y2="78" stroke="#5a8a2a" stroke-width="3"/>
      <!-- Fleurs de sésame -->
      <ellipse cx="20" cy="78" rx="6" ry="10" fill="#e8c8f0"/>
      <ellipse cx="40" cy="73" rx="6" ry="10" fill="#e8c8f0"/>
      <ellipse cx="60" cy="83" rx="6" ry="10" fill="#e8c8f0"/>
      <ellipse cx="80" cy="76" rx="6" ry="10" fill="#e8c8f0"/>
      <ellipse cx="100" cy="80" rx="6" ry="10" fill="#e8c8f0"/>
      <ellipse cx="120" cy="74" rx="6" ry="10" fill="#e8c8f0"/>
      <ellipse cx="140" cy="82" rx="6" ry="10" fill="#e8c8f0"/>
      <ellipse cx="160" cy="77" rx="6" ry="10" fill="#e8c8f0"/>
      <ellipse cx="180" cy="81" rx="6" ry="10" fill="#e8c8f0"/>
      <ellipse cx="200" cy="75" rx="6" ry="10" fill="#e8c8f0"/>
      <!-- Soleil -->
      <circle cx="200" cy="30" r="22" fill="#E8B923" opacity="0.9"/>
      <!-- Nuages -->
      <ellipse cx="60" cy="25" rx="35" ry="16" fill="white" opacity="0.6"/>
      <ellipse cx="330" cy="30" rx="40" ry="18" fill="white" opacity="0.6"/>
      <text x="200" y="210" text-anchor="middle" fill="white" font-size="13" font-family="serif" font-weight="bold">BOGANDÉ — Sésame — 1er Producteur National</text>
    </svg>
  `,

  nakambe: `
    <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="skyNak" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" style="stop-color:#1a4a8a"/>
          <stop offset="100%" style="stop-color:#2d6baa"/>
        </linearGradient>
      </defs>
      <rect width="400" height="220" fill="url(#skyNak)"/>
      <!-- Lac de Bagré -->
      <rect y="120" width="400" height="100" fill="#1a6b9e"/>
      <!-- Reflets eau -->
      <path d="M 0 140 Q 80 132 160 140 Q 240 148 320 140 Q 360 136 400 140" stroke="#4ab3e8" stroke-width="3" fill="none" opacity="0.7"/>
      <path d="M 0 165 Q 100 157 200 165 Q 300 173 400 165" stroke="#4ab3e8" stroke-width="2" fill="none" opacity="0.4"/>
      <!-- Barrage de Bagré stylisé -->
      <rect x="0" y="110" width="400" height="20" fill="#888"/>
      <rect x="0" y="108" width="400" height="6" fill="#aaa"/>
      <!-- Vannes du barrage -->
      <rect x="80" y="110" width="20" height="20" fill="#666"/>
      <rect x="160" y="110" width="20" height="20" fill="#666"/>
      <rect x="240" y="110" width="20" height="20" fill="#666"/>
      <rect x="320" y="110" width="20" height="20" fill="#666"/>
      <!-- Terre en amont -->
      <rect y="0" width="400" height="112" fill="#8B6914"/>
      <!-- Végétation -->
      <circle cx="50" cy="80" r="30" fill="#1a7a1a"/>
      <circle cx="120" cy="70" r="35" fill="#0d6b0d"/>
      <circle cx="300" cy="75" r="32" fill="#1a7a1a"/>
      <circle cx="370" cy="85" r="28" fill="#0d6b0d"/>
      <!-- Pylônes électriques -->
      <line x1="200" y1="108" x2="200" y2="30" stroke="#888" stroke-width="3"/>
      <line x1="190" y1="60" x2="210" y2="60" stroke="#888" stroke-width="2"/>
      <line x1="185" y1="80" x2="215" y2="80" stroke="#888" stroke-width="2"/>
      <!-- Lignes électriques -->
      <path d="M 200 60 Q 250 65 300 60" stroke="#888" stroke-width="1" fill="none"/>
      <!-- Hippos dans l'eau -->
      <ellipse cx="150" cy="155" rx="20" ry="8" fill="#5a5a5a"/>
      <ellipse cx="280" cy="160" rx="18" ry="7" fill="#5a5a5a"/>
      <text x="200" y="210" text-anchor="middle" fill="white" font-size="13" font-family="serif" font-weight="bold">TENKODOGO — Barrage de Bagré — Royaume Mossi</text>
    </svg>
  `,

  tapoa: `
    <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="skyTap" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" style="stop-color:#2d5a1a"/>
          <stop offset="100%" style="stop-color:#1a3d0d"/>
        </linearGradient>
      </defs>
      <rect width="400" height="220" fill="url(#skyTap)"/>
      <rect y="155" width="400" height="65" fill="#5a3a10"/>
      <!-- Parc d'Arly — savane dense -->
      <!-- Arbres -->
      <circle cx="30" cy="130" r="35" fill="#0d5c0d"/>
      <rect x="24" y="155" width="12" height="20" fill="#5a3a10"/>
      <circle cx="100" cy="120" r="40" fill="#1a7a1a"/>
      <rect x="94" y="150" width="12" height="25" fill="#5a3a10"/>
      <circle cx="180" cy="128" r="35" fill="#0d5c0d"/>
      <rect x="174" y="155" width="12" height="20" fill="#5a3a10"/>
      <circle cx="350" cy="125" r="38" fill="#1a7a1a"/>
      <rect x="344" y="152" width="12" height="23" fill="#5a3a10"/>
      <!-- Éléphant principal -->
      <ellipse cx="280" cy="155" rx="50" ry="28" fill="#5a5a5a"/>
      <circle cx="242" cy="138" r="25" fill="#5a5a5a"/>
      <!-- Trompe -->
      <path d="M 242 158 Q 220 175 218 195" stroke="#5a5a5a" stroke-width="10" fill="none" stroke-linecap="round"/>
      <!-- Défenses -->
      <path d="M 230 148 Q 215 140 208 148" stroke="ivory" stroke-width="5" fill="none"/>
      <!-- Pattes -->
      <rect x="250" y="180" width="14" height="25" fill="#5a5a5a" rx="3"/>
      <rect x="268" y="181" width="14" height="24" fill="#5a5a5a" rx="3"/>
      <rect x="295" y="180" width="14" height="25" fill="#5a5a5a" rx="3"/>
      <rect x="313" y="181" width="14" height="24" fill="#5a5a5a" rx="3"/>
      <!-- Queue -->
      <path d="M 330 160 Q 345 155 342 168" stroke="#5a5a5a" stroke-width="4" fill="none"/>
      <!-- Oreilles -->
      <ellipse cx="230" cy="148" rx="18" ry="25" fill="#6a6a6a"/>
      <!-- Lion au repos -->
      <ellipse cx="100" cy="162" rx="28" ry="12" fill="#c8a050"/>
      <circle cx="76" cy="155" r="14" fill="#c8a050"/>
      <!-- Crinière -->
      <circle cx="76" cy="155" r="18" fill="#8B4513" opacity="0.7"/>
      <circle cx="76" cy="155" r="12" fill="#c8a050"/>
      <!-- Soleil levant -->
      <circle cx="360" cy="35" r="25" fill="#E8B923" opacity="0.9"/>
      <text x="200" y="212" text-anchor="middle" fill="white" font-size="12" font-family="serif" font-weight="bold">DIAPAGA — Parc National d'Arly — UNESCO</text>
    </svg>
  `,

  kuilse: `
    <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="skyKui" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" style="stop-color:#c8a050"/>
          <stop offset="100%" style="stop-color:#8B6914"/>
        </linearGradient>
      </defs>
      <rect width="400" height="220" fill="url(#skyKui)"/>
      <rect y="155" width="400" height="65" fill="#8B4513"/>
      <!-- Mine d'or de Bissa stylisée -->
      <!-- Excavation minière -->
      <ellipse cx="200" cy="165" rx="120" ry="40" fill="#5a3a10"/>
      <ellipse cx="200" cy="160" rx="110" ry="35" fill="#3d2510"/>
      <!-- Couches de sol -->
      <path d="M 90 165 Q 200 145 310 165" stroke="#8B6914" stroke-width="3" fill="none"/>
      <path d="M 100 175 Q 200 158 300 175" stroke="#E8B923" stroke-width="4" fill="none" opacity="0.8"/>
      <!-- Pépites d'or symboliques -->
      <circle cx="180" cy="162" r="5" fill="#E8B923"/>
      <circle cx="200" cy="158" r="6" fill="#E8B923"/>
      <circle cx="220" cy="163" r="4" fill="#E8B923"/>
      <circle cx="195" cy="170" r="5" fill="#E8B923"/>
      <circle cx="215" cy="168" r="4" fill="#E8B923"/>
      <!-- Équipements miniers -->
      <rect x="50" y="100" width="15" height="55" fill="#888"/>
      <rect x="40" y="95" width="35" height="10" fill="#666"/>
      <!-- Grue minière -->
      <line x1="58" y1="95" x2="130" y2="65" stroke="#888" stroke-width="4"/>
      <line x1="130" y1="65" x2="130" y2="95" stroke="#888" stroke-width="2"/>
      <!-- Bennes -->
      <rect x="320" y="90" width="40" height="30" fill="#888" rx="3"/>
      <rect x="315" y="85" width="50" height="10" fill="#666"/>
      <!-- Camion minier -->
      <rect x="290" y="140" width="80" height="35" fill="#888" rx="3"/>
      <circle cx="305" cy="178" r="10" fill="#333"/>
      <circle cx="355" cy="178" r="10" fill="#333"/>
      <!-- Baobab -->
      <rect x="150" y="80" width="18" height="75" fill="#5a3a10"/>
      <circle cx="159" cy="70" r="32" fill="#1a7a1a"/>
      <!-- Soleil -->
      <circle cx="50" cy="35" r="22" fill="#E8B923" opacity="0.9"/>
      <text x="200" y="210" text-anchor="middle" fill="white" font-size="12" font-family="serif" font-weight="bold">KAYA — Mine d'Or de Bissa — Centre-Nord</text>
    </svg>
  `,

  liptako: `
    <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="skyLip" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" style="stop-color:#E8B923"/>
          <stop offset="50%" style="stop-color:#c8a050"/>
          <stop offset="100%" style="stop-color:#8B6914"/>
        </linearGradient>
      </defs>
      <rect width="400" height="220" fill="url(#skyLip)"/>
      <!-- Dunes de sable -->
      <ellipse cx="80" cy="180" rx="120" ry="50" fill="#c8a050"/>
      <ellipse cx="250" cy="185" rx="150" ry="55" fill="#d4aa60"/>
      <ellipse cx="380" cy="175" rx="100" ry="45" fill="#c8a050"/>
      <!-- Chameau -->
      <ellipse cx="200" cy="140" rx="45" ry="22" fill="#8B6914"/>
      <rect x="158" y="140" width="14" height="35" fill="#8B6914" rx="3"/>
      <rect x="230" y="140" width="14" height="35" fill="#8B6914" rx="3"/>
      <!-- Cou et tête -->
      <rect x="170" y="108" width="12" height="38" fill="#8B6914" rx="4"/>
      <ellipse cx="176" cy="103" rx="14" ry="12" fill="#8B6914"/>
      <!-- Bosses -->
      <ellipse cx="195" cy="120" rx="18" ry="24" fill="#8B6914"/>
      <ellipse cx="218" cy="122" rx="14" ry="20" fill="#7a5a10"/>
      <!-- Oreilles chameau -->
      <ellipse cx="168" cy="92" rx="5" ry="8" fill="#8B6914"/>
      <ellipse cx="184" cy="90" rx="5" ry="8" fill="#8B6914"/>
      <!-- Cavalier Touareg -->
      <ellipse cx="200" cy="112" rx="12" ry="15" fill="#1a1a3a"/>
      <circle cx="200" cy="97" r="8" fill="#3d1a00"/>
      <!-- Turban bleu -->
      <ellipse cx="200" cy="94" rx="10" ry="6" fill="#1a3a8a"/>
      <!-- Soleil brûlant -->
      <circle cx="320" cy="40" r="30" fill="#EF2B2D" opacity="0.9"/>
      <!-- Rayons -->
      <line x1="320" y1="5" x2="320" y2="15" stroke="#EF2B2D" stroke-width="3"/>
      <line x1="355" y1="15" x2="348" y2="22" stroke="#EF2B2D" stroke-width="3"/>
      <line x1="365" y1="40" x2="355" y2="40" stroke="#EF2B2D" stroke-width="3"/>
      <!-- Acacias du Sahel -->
      <rect x="50" y="110" width="8" height="50" fill="#5a3a10"/>
      <circle cx="54" cy="100" r="20" fill="#1a7a1a" opacity="0.8"/>
      <rect x="350" y="105" width="8" height="55" fill="#5a3a10"/>
      <circle cx="354" cy="95" r="22" fill="#1a7a1a" opacity="0.8"/>
      <text x="200" y="212" text-anchor="middle" fill="white" font-size="12" font-family="serif" font-weight="bold">DORI — Sahel Burkinabè — Peul &amp; Touareg</text>
    </svg>
  `,

  soum: `
    <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="skySom" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" style="stop-color:#8B4513"/>
          <stop offset="100%" style="stop-color:#c8a050"/>
        </linearGradient>
      </defs>
      <rect width="400" height="220" fill="url(#skySom)"/>
      <!-- Sol du Sahel -->
      <rect y="160" width="400" height="60" fill="#8B6914"/>
      <!-- Marché de Djibo stylisé -->
      <!-- Tentes de marché -->
      <polygon points="60,140 110,100 160,140" fill="#EF2B2D"/>
      <polygon points="160,140 210,100 260,140" fill="#E8B923"/>
      <polygon points="260,140 310,100 360,140" fill="#008751"/>
      <!-- Personnes au marché -->
      <!-- Femme Peul avec calebasse -->
      <circle cx="100" cy="155" r="8" fill="#3d1a00"/>
      <rect x="96" y="163" width="8" height="20" fill="#1a3a8a"/>
      <ellipse cx="100" cy="148" rx="12" ry="6" fill="#8B4513"/>
      <!-- Homme Touareg -->
      <circle cx="200" cy="152" r="8" fill="#3d1a00"/>
      <rect x="196" y="160" width="8" height="22" fill="#1a1a3a"/>
      <ellipse cx="200" cy="144" rx="10" ry="5" fill="#1a1a3a"/>
      <!-- Marchandises -->
      <ellipse cx="150" cy="162" rx="15" ry="8" fill="#c8a050"/>
      <ellipse cx="250" cy="160" rx="12" ry="6" fill="#888"/>
      <!-- Âne chargé -->
      <ellipse cx="330" cy="162" rx="25" ry="12" fill="#8B6914"/>
      <circle cx="308" cy="153" r="10" fill="#8B6914"/>
      <line x1="315" y1="173" x2="312" y2="190" stroke="#8B6914" stroke-width="4"/>
      <line x1="325" y1="174" x2="322" y2="191" stroke="#8B6914" stroke-width="4"/>
      <!-- Gisement Tambao symbolisé -->
      <rect x="10" y="100" width="40" height="60" fill="#888" opacity="0.7"/>
      <text x="30" y="135" text-anchor="middle" fill="#E8B923" font-size="9" font-weight="bold">TAMBAO</text>
      <text x="30" y="148" text-anchor="middle" fill="white" font-size="8">Mn</text>
      <!-- Soleil -->
      <circle cx="360" cy="35" r="25" fill="#E8B923" opacity="0.9"/>
      <text x="200" y="210" text-anchor="middle" fill="white" font-size="12" font-family="serif" font-weight="bold">DJIBO — Manganèse Tambao — Commerce Sahélien</text>
    </svg>
  `,

  yaadga: `
    <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="skyYaa" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" style="stop-color:#1a5c3a"/>
          <stop offset="100%" style="stop-color:#2d8a52"/>
        </linearGradient>
      </defs>
      <rect width="400" height="220" fill="url(#skyYaa)"/>
      <rect y="155" width="400" height="65" fill="#5a3a10"/>
      <!-- Palais royal Yatenga -->
      <rect x="100" y="80" width="200" height="75" fill="#c8a050"/>
      <rect x="80" y="95" width="240" height="60" fill="#d4aa60"/>
      <!-- Tours royales -->
      <rect x="80" y="55" width="35" height="42" fill="#c8a050"/>
      <rect x="285" y="55" width="35" height="42" fill="#c8a050"/>
      <rect x="182" y="45" width="36" height="35" fill="#c8a050"/>
      <!-- Créneaux des tours -->
      <rect x="80" y="50" width="8" height="10" fill="#c8a050"/>
      <rect x="93" y="50" width="8" height="10" fill="#c8a050"/>
      <rect x="106" y="50" width="8" height="10" fill="#c8a050"/>
      <rect x="285" y="50" width="8" height="10" fill="#c8a050"/>
      <rect x="298" y="50" width="8" height="10" fill="#c8a050"/>
      <rect x="311" y="50" width="8" height="10" fill="#c8a050"/>
      <!-- Drapeau Yatenga -->
      <rect x="200" y="20" width="3" height="30" fill="#5a3a10"/>
      <rect x="203" y="20" width="25" height="18" fill="#EF2B2D"/>
      <!-- Porte royale -->
      <ellipse cx="200" cy="155" rx="22" ry="30" fill="#8B4513"/>
      <!-- Garde royale à cheval -->
      <!-- Cheval gauche -->
      <ellipse cx="60" cy="155" rx="30" ry="15" fill="#8B4513"/>
      <rect x="42" y="148" width="10" height="25" fill="#8B4513"/>
      <circle cx="42" cy="143" r="10" fill="#8B4513"/>
      <!-- Cavalier -->
      <circle cx="65" cy="138" r="7" fill="#3d1a00"/>
      <rect x="61" y="145" width="8" height="12" fill="#EF2B2D"/>
      <!-- Lance -->
      <line x1="75" y1="120" x2="65" y2="155" stroke="#5a3a10" stroke-width="3"/>
      <!-- Cheval droit -->
      <ellipse cx="340" cy="155" rx="30" ry="15" fill="#8B4513"/>
      <rect x="348" y="148" width="10" height="25" fill="#8B4513"/>
      <circle cx="358" cy="143" r="10" fill="#8B4513"/>
      <circle cx="335" cy="138" r="7" fill="#3d1a00"/>
      <rect x="331" y="145" width="8" height="12" fill="#EF2B2D"/>
      <line x1="325" y1="120" x2="335" y2="155" stroke="#5a3a10" stroke-width="3"/>
      <!-- Zaï — petites fosses au sol -->
      <circle cx="160" cy="178" r="5" fill="#5a3a10" opacity="0.8"/>
      <circle cx="180" cy="183" r="5" fill="#5a3a10" opacity="0.8"/>
      <circle cx="200" cy="178" r="5" fill="#5a3a10" opacity="0.8"/>
      <circle cx="220" cy="183" r="5" fill="#5a3a10" opacity="0.8"/>
      <circle cx="240" cy="178" r="5" fill="#5a3a10" opacity="0.8"/>
      <text x="200" y="212" text-anchor="middle" fill="white" font-size="12" font-family="serif" font-weight="bold">OUAHIGOUYA — Royaume Yatenga — Technique Zaï</text>
    </svg>
  `,

  tannounyan: `
    <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="skyTan" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" style="stop-color:#1a7a3a"/>
          <stop offset="100%" style="stop-color:#0d5c2a"/>
        </linearGradient>
        <linearGradient id="waterTan" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" style="stop-color:#4ab3e8"/>
          <stop offset="100%" style="stop-color:#1a6b9e"/>
        </linearGradient>
      </defs>
      <rect width="400" height="220" fill="url(#skyTan)"/>
      <!-- Cascades de Banfora -->
      <!-- Rochers -->
      <ellipse cx="100" cy="80" rx="60" ry="40" fill="#888"/>
      <ellipse cx="200" cy="70" rx="70" ry="45" fill="#777"/>
      <ellipse cx="310" cy="85" rx="60" ry="38" fill="#888"/>
      <!-- Chutes d'eau -->
      <rect x="60" y="80" width="12" height="80" fill="url(#waterTan)" opacity="0.9"/>
      <rect x="90" y="75" width="10" height="85" fill="url(#waterTan)" opacity="0.8"/>
      <rect x="165" y="68" width="14" height="92" fill="url(#waterTan)" opacity="0.9"/>
      <rect x="195" y="65" width="12" height="95" fill="url(#waterTan)" opacity="0.8"/>
      <rect x="275" y="82" width="12" height="78" fill="url(#waterTan)" opacity="0.9"/>
      <rect x="305" y="78" width="10" height="82" fill="url(#waterTan)" opacity="0.8"/>
      <!-- Écume des chutes -->
      <ellipse cx="66" cy="165" rx="20" ry="8" fill="white" opacity="0.7"/>
      <ellipse cx="95" cy="163" rx="18" ry="7" fill="white" opacity="0.7"/>
      <ellipse cx="172" cy="163" rx="22" ry="8" fill="white" opacity="0.7"/>
      <ellipse cx="200" cy="162" rx="20" ry="7" fill="white" opacity="0.7"/>
      <ellipse cx="281" cy="162" rx="20" ry="8" fill="white" opacity="0.7"/>
      <!-- Bassin en bas -->
      <rect y="165" width="400" height="55" fill="url(#waterTan)"/>
      <!-- Végétation tropicale -->
      <circle cx="20" cy="100" r="25" fill="#0d5c0d"/>
      <circle cx="380" cy="95" r="28" fill="#0d5c0d"/>
      <circle cx="50" cy="135" r="20" fill="#1a7a1a"/>
      <circle cx="360" cy="130" r="22" fill="#1a7a1a"/>
      <!-- Hippo dans le bassin -->
      <ellipse cx="300" cy="188" rx="28" ry="12" fill="#5a5a5a"/>
      <ellipse cx="275" cy="180" rx="12" ry="9" fill="#5a5a5a"/>
      <!-- Yeux hippo -->
      <circle cx="270" cy="176" r="3" fill="white"/>
      <circle cx="281" cy="175" r="3" fill="white"/>
      <text x="200" y="213" text-anchor="middle" fill="white" font-size="12" font-family="serif" font-weight="bold">BANFORA — Chutes de Karfiguéla — Hippopotames</text>
    </svg>
  `,

  djoro: `
    <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="skyDjo" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" style="stop-color:#5c3a1a"/>
          <stop offset="100%" style="stop-color:#8B4513"/>
        </linearGradient>
      </defs>
      <rect width="400" height="220" fill="url(#skyDjo)"/>
      <!-- Soukala Lobi — village fortifié -->
      <!-- Plusieurs soukala -->
      <!-- Soukala 1 -->
      <rect x="30" y="80" width="80" height="80" fill="#c8a050" rx="5"/>
      <rect x="25" y="75" width="90" height="15" fill="#d4aa60" rx="3"/>
      <!-- Toit plat avec parapet -->
      <rect x="20" y="70" width="100" height="10" fill="#8B6914" rx="2"/>
      <!-- Entrée par le toit (escalier) -->
      <rect x="58" y="60" width="24" height="12" fill="#5a3a10"/>
      <!-- Ouverture toit -->
      <rect x="63" y="65" width="14" height="8" fill="#1a0a00"/>
      <!-- Motifs décoratifs sur les murs -->
      <line x1="30" y1="100" x2="110" y2="100" stroke="#8B4513" stroke-width="2"/>
      <line x1="30" y1="120" x2="110" y2="120" stroke="#8B4513" stroke-width="2"/>
      <circle cx="70" cy="110" r="8" fill="#E8B923" opacity="0.6"/>
      <!-- Soukala 2 -->
      <rect x="160" y="85" width="90" height="75" fill="#d4aa60" rx="5"/>
      <rect x="155" y="80" width="100" height="12" fill="#c8a050" rx="3"/>
      <rect x="150" y="73" width="110" height="10" fill="#8B6914" rx="2"/>
      <rect x="188" y="63" width="24" height="13" fill="#5a3a10"/>
      <rect x="193" y="68" width="14" height="9" fill="#1a0a00"/>
      <circle cx="205" cy="118" r="9" fill="#EF2B2D" opacity="0.5"/>
      <!-- Soukala 3 -->
      <rect x="295" y="78" width="85" height="82" fill="#c8a050" rx="5"/>
      <rect x="290" y="73" width="95" height="12" fill="#d4aa60" rx="3"/>
      <rect x="285" y="66" width="105" height="10" fill="#8B6914" rx="2"/>
      <rect x="320" y="56" width="24" height="13" fill="#5a3a10"/>
      <rect x="325" y="61" width="14" height="9" fill="#1a0a00"/>
      <!-- Ruines de Loropéni stylisées en arrière-plan -->
      <rect x="0" y="160" width="400" height="60" fill="#5a3a10"/>
      <rect x="0" y="157" width="400" height="8" fill="#8B6914"/>
      <!-- Vieux murs en pierre -->
      <rect x="5" y="140" width="8" height="25" fill="#888"/>
      <rect x="18" y="135" width="8" height="30" fill="#888"/>
      <rect x="370" y="138" width="8" height="27" fill="#888"/>
      <rect x="385" y="133" width="8" height="32" fill="#888"/>
      <!-- Végétation -->
      <circle cx="130" cy="60" r="25" fill="#1a7a1a" opacity="0.7"/>
      <circle cx="260" cy="55" r="22" fill="#0d6b0d" opacity="0.7"/>
      <!-- Soleil -->
      <circle cx="50" cy="30" r="20" fill="#E8B923" opacity="0.8"/>
      <text x="200" y="212" text-anchor="middle" fill="white" font-size="12" font-family="serif" font-weight="bold">GAOUA — Soukala Lobi — Ruines UNESCO Loropéni</text>
    </svg>
  `,

  nazinon: `
    <svg viewBox="0 0 400 220" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="skyNaz" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" style="stop-color:#1a6b3c"/>
          <stop offset="100%" style="stop-color:#2d8a52"/>
        </linearGradient>
      </defs>
      <rect width="400" height="220" fill="url(#skyNaz)"/>
      <!-- Ranch de Nazinga -->
      <rect y="155" width="400" height="65" fill="#5a3a10"/>
      <!-- Végétation savane -->
      <circle cx="30" cy="130" r="30" fill="#1a7a1a"/>
      <rect x="24" y="150" width="12" height="20" fill="#5a3a10"/>
      <circle cx="95" cy="120" r="35" fill="#0d6b0d"/>
      <rect x="89" y="148" width="12" height="22" fill="#5a3a10"/>
      <circle cx="330" cy="125" r="33" fill="#1a7a1a"/>
      <rect x="324" y="150" width="12" height="20" fill="#5a3a10"/>
      <circle cx="380" cy="130" r="28" fill="#0d6b0d"/>
      <!-- Éléphants de Nazinga -->
      <!-- Grand éléphant -->
      <ellipse cx="210" cy="155" rx="55" ry="30" fill="#5a5a5a"/>
      <circle cx="163" cy="138" r="28" fill="#5a5a5a"/>
      <!-- Trompe -->
      <path d="M 163 162 Q 140 180 137 200" stroke="#5a5a5a" stroke-width="12" fill="none" stroke-linecap="round"/>
      <!-- Défenses ivoire -->
      <path d="M 148 150 Q 130 143 125 152" stroke="ivory" stroke-width="6" fill="none"/>
      <!-- Pattes -->
      <rect x="170" y="183" width="16" height="28" fill="#5a5a5a" rx="4"/>
      <rect x="190" y="184" width="16" height="27" fill="#5a5a5a" rx="4"/>
      <rect x="220" y="183" width="16" height="28" fill="#5a5a5a" rx="4"/>
      <rect x="240" y="184" width="16" height="27" fill="#5a5a5a" rx="4"/>
      <!-- Oreilles -->
      <ellipse cx="148" cy="145" rx="22" ry="30" fill="#6a6a6a"/>
      <!-- Petit éléphanteau -->
      <ellipse cx="310" cy="162" rx="30" ry="16" fill="#6a6a6a"/>
      <circle cx="284" cy="151" r="16" fill="#6a6a6a"/>
      <path d="M 284 163 Q 270 175 268 188" stroke="#6a6a6a" stroke-width="7" fill="none"/>
      <rect x="292" y="177" width="10" height="18" fill="#6a6a6a"/>
      <rect x="307" y="177" width="10" height="18" fill="#6a6a6a"/>
      <!-- Mangues sur l'arbre -->
      <circle cx="95" cy="100" r="8" fill="#E8B923"/>
      <circle cx="110" cy="108" r="7" fill="#c8a050"/>
      <circle cx="80" cy="108" r="7" fill="#E8B923"/>
      <!-- Village peint Kasséna stylisé -->
      <rect x="5" y="160" width="50" height="40" fill="#d4aa60" rx="2"/>
      <!-- Motifs géométriques Kasséna -->
      <polygon points="5,180 30,160 55,180" fill="#EF2B2D" opacity="0.6"/>
      <polygon points="5,200 30,180 55,200" fill="#008751" opacity="0.6"/>
      <rect x="15" y="170" width="8" height="8" fill="#E8B923"/>
      <rect x="35" y="170" width="8" height="8" fill="#E8B923"/>
      <!-- Soleil -->
      <circle cx="350" cy="35" r="25" fill="#E8B923" opacity="0.9"/>
      <text x="200" y="212" text-anchor="middle" fill="white" font-size="12" font-family="serif" font-weight="bold">MANGA — Ranch Nazinga — Éléphants — Tiébélé</text>
    </svg>
  `
};

function normalizeText(text) {
  return text
    .normalize('NFD')
    .replace(/[̀-ͯ]/g, '')
    .toLowerCase();
}

function guessRegionKey(nomRaw) {
  const nom = normalizeText(nomRaw || '');
  if (nom.includes('kadiogo') || nom.includes('ouagadougou')) return 'kadiogo';
  if (nom.includes('ouibri') || nom.includes('ziniare') || nom.includes('ziniaré')) return 'ouibri';
  if (nom.includes('guiriko') || nom.includes('bobo')) return 'guiriko';
  if (nom.includes('bankui') || nom.includes('dedougou') || nom.includes('dédougou')) return 'bankui';
  if (nom.includes('nando') || nom.includes('koudougou')) return 'nando';
  if (nom.includes('sourou') || nom.includes('tougan')) return 'sourou';
  if (nom.includes('goulmou') || nom.includes('fada')) return 'goulmou';
  if (nom.includes('sirba') || nom.includes('bogande') || nom.includes('bogandé')) return 'sirba';
  if (nom.includes('nakambe') || nom.includes('nakambe') || nom.includes('tenkodogo')) return 'nakambe';
  if (nom.includes('tapoa') || nom.includes('diapaga')) return 'tapoa';
  if (nom.includes('kuilse') || nom.includes('kuilse') || nom.includes('kaya')) return 'kuilse';
  if (nom.includes('liptako') || nom.includes('dori')) return 'liptako';
  if (nom.includes('soum') || nom.includes('djibo')) return 'soum';
  if (nom.includes('yaadga') || nom.includes('ouahigouya')) return 'yaadga';
  if (nom.includes('tannounyan') || nom.includes('banfora')) return 'tannounyan';
  if (nom.includes('djoro') || nom.includes('djoro') || nom.includes('djorô') || nom.includes('gaoua')) return 'djoro';
  if (nom.includes('nazinon') || nom.includes('manga')) return 'nazinon';
  return null;
}

function applyRegionImages() {
  const cards = document.querySelectorAll('.region-card');
  cards.forEach(card => {
    const nom = card.getAttribute('data-nom') || '';
    const imgContainer = card.querySelector('.relative.overflow-hidden');
    if (!imgContainer) return;

    const key = guessRegionKey(nom);
    if (!key || !RegionImages[key]) return;

    const img = imgContainer.querySelector('img');
    if (img) {
      const svgDiv = document.createElement('div');
      svgDiv.className = 'w-full h-52 overflow-hidden';
      svgDiv.innerHTML = RegionImages[key];
      const svg = svgDiv.querySelector('svg');
      if (svg) svg.style.cssText = 'width:100%;height:100%;object-fit:cover;';
      img.replaceWith(svgDiv);
    }
  });
}

// Lancer automatiquement
document.addEventListener('DOMContentLoaded', applyRegionImages);