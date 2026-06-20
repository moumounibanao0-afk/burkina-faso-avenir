-- =====================================================
-- Enrichissement des descriptions des 47 provinces
-- Ajout : peuple(s), mode de vie, agriculture/économie
-- =====================================================

USE burkina_db;

-- ---------- BANKUI (Boucle du Mouhoun) ----------
UPDATE provinces SET description = 'Province de l\'ouest, chef-lieu Dédougou. Peuplée majoritairement de Bwa et de Marka (Dafing), reconnue pour ses masques sacrés et ses greniers traditionnels. L\'agriculture y repose sur le coton, le sorgho et le maïs, complétée par un élevage bovin important.' WHERE nom = 'Balé';
UPDATE provinces SET description = 'Province frontalière avec le Mali, chef-lieu Solenzo. Terre des Bwa et des Samo, dont la vie sociale s\'organise autour de chefferies de terre et de rites agraires. L\'agriculture vivrière (mil, sorgho) cohabite avec une production cotonnière croissante.' WHERE nom = 'Banwa';
UPDATE provinces SET description = 'Province de la Boucle du Mouhoun, chef-lieu Dédougou. Peuple Bwa dominant, société organisée autour du Do (société de masques) et de l\'agriculture sur brûlis traditionnelle. Le coton et les céréales constituent les principales cultures, avec un artisanat textile reconnu.' WHERE nom = 'Mouhoun';

-- ---------- SOUROU ----------
UPDATE provinces SET description = 'Province de la Boucle du Mouhoun, chef-lieu Nouna. Peuplée de Samo et de Marka, dont l\'organisation sociale repose sur des chefferies coutumières fortes. L\'agriculture associe céréales traditionnelles et cultures de rente comme le coton et l\'arachide.' WHERE nom = 'Kossin';
UPDATE provinces SET description = 'Province de l\'ouest, chef-lieu Toma. Peuple Samo majoritaire, connu pour ses fêtes traditionnelles et son artisanat (forge, tissage). L\'économie repose sur l\'agriculture pluviale (sorgho, mil) et un élevage extensif de bovins et petits ruminants.' WHERE nom = 'Nayala';
UPDATE provinces SET description = 'Province du Sourou, chef-lieu Tougan, célèbre pour la vallée du Sourou et son aménagement hydroagricole. Les Samo y pratiquent une riziculture irriguée intensive, faisant de la province l\'un des greniers à riz du pays, aux côtés de l\'élevage et de la pêche.' WHERE nom = 'Sourou';

-- ---------- TANNOUNYAN (Cascades) ----------
UPDATE provinces SET description = 'Province du sud-ouest, chef-lieu Banfora, abritant les célèbres cascades de Karfiguéla et le lac Tengrela. Peuplée de Karaboro, Turka et Dioula, terre de la canne à sucre, du riz irrigué et de l\'anacarde, dans un cadre naturel parmi les plus verdoyants du pays.' WHERE nom = 'Comoé';
UPDATE provinces SET description = 'Province frontalière avec la Côte d\'Ivoire et le Mali, chef-lieu Sindou, connue pour ses pics rocheux spectaculaires. Peuplée de Turka et de Dioula, son économie repose sur l\'agriculture (céréales, anacarde) et un tourisme naturel en développement.' WHERE nom = 'Léraba';

-- ---------- KADIOGO ----------
UPDATE provinces SET description = 'Province du centre, chef-lieu Ouagadougou, capitale politique et économique du pays. Cœur de la culture mossi avec la cour royale du Moogho Naaba, elle concentre commerce, administration, industrie et services, avec une agriculture périurbaine maraîchère pour approvisionner la ville.' WHERE nom = 'Kadiogo';

-- ---------- NAKAMBÉ (Centre-Est) ----------
UPDATE provinces SET description = 'Province du centre-est, chef-lieu Tenkodogo, berceau historique du royaume mossi du Tenkodogo. Peuple Bissa et Mossi, terre d\'agriculture vivrière (sorgho, mil) et de petite orpaillage traditionnel, avec un artisanat de poterie reconnu.' WHERE nom = 'Boulgou';
UPDATE provinces SET description = 'Province de l\'est, chef-lieu Ouargaye. Peuplée de Bissa et de Yana, société rurale organisée autour de l\'agriculture céréalière et du maraîchage de saison sèche, complétée par un élevage familial de petits ruminants.' WHERE nom = 'Koulpélogo';
UPDATE provinces SET description = 'Province du centre-est, chef-lieu Koupéla, carrefour routier important reliant Ouagadougou à l\'est du pays. Peuple Mossi majoritaire, économie tournée vers le commerce, le transport et une agriculture céréalière de subsistance.' WHERE nom = 'Kouritenga';

-- ---------- KUILSÉ (Centre-Nord) ----------
UPDATE provinces SET description = 'Province sahélienne, chef-lieu Kongoussi, au bord du lac Bam, plus grand lac naturel du pays. Peuplée de Mossi et de Peul, elle combine maraîchage irrigué autour du lac et élevage transhumant, dans une zone marquée par la rareté de l\'eau.' WHERE nom = 'Bam';
UPDATE provinces SET description = 'Province sahélienne, chef-lieu Boulsa. Peuple Mossi et Peul cohabitant entre agriculture pluviale et pastoralisme, dans une économie fragilisée par la faible pluviométrie. L\'artisanat du cuir et le commerce de bétail y occupent une place importante.' WHERE nom = 'Namentenga';
UPDATE provinces SET description = 'Province du centre-nord, chef-lieu Kaya, important centre artisanal et commercial régional. Peuple Mossi majoritaire, réputé pour le tissage du coton (faso dan fani) et une agriculture associant céréales et élevage bovin.' WHERE nom = 'Sandbondtenga';

-- ---------- NANDO (Centre-Ouest) ----------
UPDATE provinces SET description = 'Province du centre-ouest, chef-lieu Koudougou, troisième ville du pays et pôle industriel textile. Peuplée de Mossi, elle allie agriculture cotonnière, industrie de transformation et forte tradition de mobilisation citoyenne et culturelle.' WHERE nom = 'Boulkiemdé';
UPDATE provinces SET description = 'Province de l\'ouest, chef-lieu Réo. Peuple Gurunsi (Nuna) majoritaire, connu pour ses masques rituels classés au patrimoine culturel national. L\'économie repose sur une agriculture vivrière diversifiée (sorgho, arachide, sésame).' WHERE nom = 'Sanguié';
UPDATE provinces SET description = 'Province frontalière avec le Ghana, chef-lieu Léo. Peuplée de Gurunsi et de Dagara, société rurale organisée autour de l\'agriculture pluviale et d\'un élevage important, avec un commerce transfrontalier actif.' WHERE nom = 'Sissili';
UPDATE provinces SET description = 'Petite province rurale, chef-lieu Sapouy. Peuple Gurunsi et Mossi, économie centrée sur l\'agriculture céréalière et le maraîchage, dans une zone de transition entre le centre et l\'ouest du pays.' WHERE nom = 'Ziro';

-- ---------- NAZINON (Centre-Sud) ----------
UPDATE provinces SET description = 'Province du centre-sud, chef-lieu Kombissiri, connue pour la culture du sésame et du sorgho et traversée par des collines granitiques typiques du Burkina. Peuple Mossi majoritaire, fortement agricole, avec un artisanat de la pierre et de la poterie.' WHERE nom = 'Bazèga';
UPDATE provinces SET description = 'Province réputée pour ses sites naturels remarquables (Pic de Nahouri, Cascades de Tanougou), chef-lieu Pô. Peuplée de Kasséna et de Mossi, elle conjugue agriculture vivrière, élevage et un tourisme naturel et culturel en développement.' WHERE nom = 'Nahouri';
UPDATE provinces SET description = 'Province agricole majeure du centre-sud, chef-lieu Manga. Peuple Mossi dominant, économie tournée vers les cultures céréalières et le maraîchage, avec une proximité immédiate de la capitale facilitant les échanges commerciaux.' WHERE nom = 'Zoundwéogo';

-- ---------- GOULMOU (Est) ----------
UPDATE provinces SET description = 'La plus vaste province de l\'est, chef-lieu Fada N\'Gourma, ancienne capitale du royaume gourmantché. Peuple Gourmantché majoritaire, organisé en chefferies traditionnelles, vivant d\'agriculture céréalière, d\'élevage et de la richesse faunique des parcs voisins.' WHERE nom = 'Gourma';
UPDATE provinces SET description = 'Province frontalière avec le Togo et le Bénin, chef-lieu Pama, abritant une partie du parc national d\'Arly. Peuplée de Gourmantché, son économie associe agriculture, élevage transhumant et écotourisme lié à la faune sauvage.' WHERE nom = 'Kompienga';

-- ---------- SIRBA (Est) ----------
UPDATE provinces SET description = 'Province frontalière avec le Niger, chef-lieu Bogandé. Peuple Gourmantché et Peul, zone d\'élevage et d\'agriculture céréalière, marquée par d\'importants mouvements de transhumance saisonnière entre le Sahel et le sud.' WHERE nom = 'Gnagna';
UPDATE provinces SET description = 'Province de l\'est, chef-lieu Gayéri, zone agro-pastorale peu peuplée proche de la frontière avec le Niger. Peuple Gourmantché majoritaire, vivant principalement d\'agriculture de subsistance et d\'élevage extensif.' WHERE nom = 'Komondjari';

-- ---------- TAPOA (Est) ----------
UPDATE provinces SET description = 'Province de l\'est lointain, chef-lieu Diapaga, riche en faune sauvage grâce à sa proximité avec les parcs du W et d\'Arly. Peuple Gourmantché majoritaire, dont l\'économie repose sur l\'agriculture, l\'élevage et un potentiel écotouristique important.' WHERE nom = 'Tapoa';
UPDATE provinces SET description = 'Nouvelle province de l\'est créée en 2025, chef-lieu Kantchari, zone frontalière avec le Niger. Peuplée principalement de Gourmantché, son économie repose sur l\'agriculture céréalière et l\'élevage, dans une région de transit commercial vers le Niger.' WHERE nom = 'Dyamongou';

-- ---------- GUIRIKO (Hauts-Bassins) ----------
UPDATE provinces SET description = 'Province économique majeure, chef-lieu Bobo-Dioulasso, deuxième ville du pays et capitale culturelle. Peuplée de Bobo et de Dioula, elle est le cœur industriel et agro-alimentaire du Burkina (coton, mangue, sucre), avec un riche patrimoine musical et artisanal.' WHERE nom = 'Houet';
UPDATE provinces SET description = 'Province frontalière avec le Mali, chef-lieu Orodara, surnommée la « cité des mangues ». Peuplée de Sénoufo et de Dioula, son économie repose sur l\'arboriculture fruitière (mangue, agrumes) et le commerce transfrontalier.' WHERE nom = 'Kénédougou';
UPDATE provinces SET description = 'Province agricole de l\'ouest, chef-lieu Houndé, productrice majeure de coton et d\'or. Peuplée de Bobo et de Dioula, elle combine agriculture intensive, orpaillage industriel et élevage, dans l\'une des régions les plus dynamiques économiquement du pays.' WHERE nom = 'Tuy';

-- ---------- YAADGA (Nord) ----------
UPDATE provinces SET description = 'Province du nord, chef-lieu Titao. Peuplée de Mossi et de Peul, marquée par une forte pression démographique sur des sols fragilisés par l\'érosion. L\'agriculture (mil, niébé) et l\'élevage y cohabitent avec des actions de restauration des terres (zaï, cordons pierreux).' WHERE nom = 'Loroum';
UPDATE provinces SET description = 'Province du nord, chef-lieu Yako, terre agricole reconnue pour la culture du mil et de l\'arachide. Peuple Mossi majoritaire, société rurale dense pratiquant aussi le maraîchage de saison sèche autour des retenues d\'eau.' WHERE nom = 'Passoré';
UPDATE provinces SET description = 'Province du nord, chef-lieu Ouahigouya, l\'une des plus peuplées du pays et ancienne capitale du royaume du Yatenga. Peuple Mossi, réputée pour la culture de l\'oignon et des techniques traditionnelles de récupération des sols (zaï), face à un climat sahélien exigeant.' WHERE nom = 'Yatenga';
UPDATE provinces SET description = 'Petite province du nord, chef-lieu Gourcy. Peuple Mossi, agriculture vivrière et élevage en zone semi-aride, avec une tradition d\'organisation communautaire forte autour de la gestion de l\'eau et des terres.' WHERE nom = 'Zondoma';

-- ---------- OUBRI (Plateau-Central) ----------
UPDATE provinces SET description = 'Province du Plateau-Central, chef-lieu Zorgho, zone agricole proche de la capitale. Peuple Mossi majoritaire, économie tournée vers les cultures céréalières et le maraîchage, profitant de la proximité de Ouagadougou pour l\'écoulement des produits.' WHERE nom = 'Ganzourgou';
UPDATE provinces SET description = 'Petite province du centre, chef-lieu Boussé. Peuple Mossi, agriculture vivrière traditionnelle (sorgho, mil) et élevage familial, dans une zone rurale densément peuplée proche de la capitale.' WHERE nom = 'Kourwéogo';
UPDATE provinces SET description = 'Province du Plateau-Central, chef-lieu Ziniaré, ville natale de plusieurs figures historiques mossi. Peuple Mossi majoritaire, combinant agriculture céréalière, élevage et un artisanat dynamique (bronze, sculpture), à proximité immédiate de Ouagadougou.' WHERE nom = 'Bassitenga';

-- ---------- LIPTAKO (Sahel) ----------
UPDATE provinces SET description = 'Province sahélienne aride, chef-lieu Gorom-Gorom, célèbre pour son grand marché hebdomadaire transfrontalier. Peuple Peul, Touareg et Bella, vivant essentiellement d\'élevage transhumant (bovins, camelins) dans un environnement désertique exigeant.' WHERE nom = 'Oudalan';
UPDATE provinces SET description = 'Province sahélienne, chef-lieu Dori, capitale régionale du Sahel burkinabè. Peuple Peul majoritaire, société pastorale organisée autour de la transhumance et du commerce de bétail, avec une agriculture pluviale limitée par l\'aridité.' WHERE nom = 'Séno';
UPDATE provinces SET description = 'Province frontalière avec le Niger, chef-lieu Sebba. Peuple Peul et Gourmantché, économie pastorale dominante (élevage extensif), complétée par une agriculture de décrue le long des cours d\'eau saisonniers.' WHERE nom = 'Yagha';

-- ---------- SOUM ----------
UPDATE provinces SET description = 'Province du Sahel, chef-lieu Djibo, l\'une des plus arides du pays. Peuple Peul majoritaire, société pastorale fondée sur l\'élevage transhumant de bovins, ovins et camelins, avec une agriculture de subsistance limitée à la courte saison des pluies.' WHERE nom = 'Djelgodji';
UPDATE provinces SET description = 'Nouvelle province du Sahel créée en 2025, chef-lieu Arbinda. Peuplée majoritairement de Peul, son économie repose sur l\'élevage transhumant, dans une zone sahélienne marquée par la rareté des ressources en eau.' WHERE nom = 'Karo-Peli';

-- ---------- DJÔRÔ (Sud-Ouest) ----------
UPDATE provinces SET description = 'Province du sud-ouest, chef-lieu Diébougou. Peuple Dagara et Birifor, société sans chefferie centralisée organisée en clans, connue pour son architecture traditionnelle en terre. L\'agriculture (céréales, coton) et l\'élevage constituent les piliers économiques.' WHERE nom = 'Bougouriba';
UPDATE provinces SET description = 'Province du sud-ouest, chef-lieu Dano. Peuple Dagara majoritaire, partageant de nombreuses traditions avec les Lobi, notamment l\'usage du balafon dans les rites funéraires. Économie fondée sur l\'agriculture vivrière et l\'élevage.' WHERE nom = 'Ioba';
UPDATE provinces SET description = 'Province frontalière avec le Ghana, chef-lieu Batié. Peuple Lobi et Birifor, réputés pour leur architecture fortifiée (soukala) et leur tradition de chasse. L\'agriculture pluviale et le commerce transfrontalier animent l\'économie locale.' WHERE nom = 'Noumbiel';
UPDATE provinces SET description = 'Province du sud-ouest, chef-lieu Gaoua, capitale culturelle du peuple Lobi. Société sans chefferie centralisée, organisée en clans, célèbre pour son art du masque et ses fétiches (bouthybu). L\'agriculture, le coton et un artisanat reconnu structurent l\'économie locale.' WHERE nom = 'Poni';

-- Vérification finale
SELECT nom, region_nom, LEFT(description, 60) AS apercu FROM provinces ORDER BY region_nom, nom;
SELECT COUNT(*) AS total_provinces_mises_a_jour FROM provinces;
