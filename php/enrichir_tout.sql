-- =====================================================
-- Enrichissement complet : 17 régions + 18 peuples + 18 potentiels
-- =====================================================

USE burkina_db;

-- ========================================================
-- PARTIE 1 : LES 17 RÉGIONS (table regions)
-- ========================================================

UPDATE regions SET description = 'Région de l\'ouest du pays, chef-lieu Dédougou. Peuplée majoritairement de Bwa, Marka et Samo, elle est l\'un des greniers céréaliers et cotonniers du Burkina Faso, avec une riche tradition de masques sacrés et de chefferies de terre.' WHERE nom = 'Bankui';

UPDATE regions SET description = 'Région du sud-ouest, chef-lieu Gaoua, terre des Lobi, Dagara et Birifor. Reconnue pour son architecture fortifiée (soukala), ses sociétés sans chefferie centralisée organisées en clans, et une économie fondée sur l\'agriculture et le coton.' WHERE nom = 'Djôrô';

UPDATE regions SET description = 'Région de l\'est, chef-lieu Fada N\'Gourma, berceau du peuple Gourmantché et de son ancien royaume. Elle abrite une partie des grands parcs nationaux du pays (W, Arly), faisant de la faune sauvage et de l\'écotourisme des atouts majeurs aux côtés de l\'agriculture et de l\'élevage.' WHERE nom = 'Goulmou';

UPDATE regions SET description = 'Région de l\'ouest, chef-lieu Bobo-Dioulasso, deuxième ville du pays et capitale culturelle et économique. Peuplée de Bobo et de Dioula, elle concentre industrie agro-alimentaire, commerce et un patrimoine musical et artisanal parmi les plus riches du Burkina Faso.' WHERE nom = 'Guiriko';

UPDATE regions SET description = 'Région du centre, chef-lieu Ouagadougou, capitale politique, administrative et économique du pays. Cœur historique du royaume mossi et siège de la cour royale du Moogho Naaba, elle concentre commerce, services et industrie, avec une agriculture périurbaine maraîchère.' WHERE nom = 'Kadiogo';

UPDATE regions SET description = 'Région du centre-nord, chef-lieu Kaya, peuplée de Mossi et de Peul. Important centre artisanal réputé pour le tissage du coton traditionnel (faso dan fani), elle conjugue agriculture céréalière et élevage dans une zone marquée par la rareté de l\'eau.' WHERE nom = 'Kuilsé';

UPDATE regions SET description = 'Région sahélienne, chef-lieu Dori, peuplée majoritairement de Peul, Touareg et Bella. Société pastorale fondée sur l\'élevage transhumant de bovins et de camelins, dans un environnement aride où le commerce de bétail occupe une place centrale.' WHERE nom = 'Liptako';

UPDATE regions SET description = 'Région du centre-est, chef-lieu Tenkodogo, berceau historique d\'un ancien royaume mossi. Peuplée de Bissa et de Mossi, son économie repose sur l\'agriculture vivrière, l\'orpaillage traditionnel et un artisanat de poterie reconnu.' WHERE nom = 'Nakambé';

UPDATE regions SET description = 'Région du centre-ouest, chef-lieu Koudougou, troisième ville du pays et pôle industriel textile important. Peuplée de Mossi et de Gurunsi, connue pour ses masques rituels et sa forte tradition de mobilisation citoyenne et culturelle.' WHERE nom = 'Nando';

UPDATE regions SET description = 'Région du centre-sud, chef-lieu Manga, peuplée de Mossi et de Kasséna. Terre agricole reconnue pour la culture du sésame et du sorgho, traversée par des collines granitiques et des sites naturels remarquables comme le pic de Nahouri.' WHERE nom = 'Nazinon';

UPDATE regions SET description = 'Région du Plateau-Central, chef-lieu Ziniaré, fortement peuplée de Mossi. Proche de la capitale, elle combine agriculture céréalière, élevage et un artisanat dynamique (bronze, sculpture), profitant de sa proximité avec Ouagadougou pour l\'écoulement de ses produits.' WHERE nom = 'Oubri';

UPDATE regions SET description = 'Région de l\'est, chef-lieu Bogandé, frontalière avec le Niger. Peuplée de Gourmantché et de Peul, elle est marquée par d\'importants mouvements de transhumance saisonnière entre le Sahel et le sud du pays.' WHERE nom = 'Sirba';

UPDATE regions SET description = 'Région du Sahel, chef-lieu Djibo, l\'une des plus arides du Burkina Faso. Peuplée majoritairement de Peul, son économie repose presque entièrement sur l\'élevage transhumant de bovins, ovins et camelins.' WHERE nom = 'Soum';

UPDATE regions SET description = 'Région de l\'ouest, chef-lieu Tougan, peuplée de Samo et de Marka. Célèbre pour l\'aménagement hydroagricole de la vallée du Sourou, elle pratique une riziculture irriguée intensive qui en fait l\'un des greniers à riz du pays.' WHERE nom = 'Sourou';

UPDATE regions SET description = 'Région des Cascades, chef-lieu Banfora, peuplée de Karaboro, Turka et Dioula. Dotée d\'un cadre naturel exceptionnel (cascades de Karfiguéla, lac Tengrela, pics de Sindou), elle est aussi une grande productrice de canne à sucre, de riz et d\'anacarde.' WHERE nom = 'Tannounyan';

UPDATE regions SET description = 'Région de l\'est lointain, chef-lieu Diapaga, peuplée de Gourmantché. Riche en faune sauvage grâce à sa proximité avec les parcs du W et d\'Arly, elle combine agriculture, élevage et un fort potentiel écotouristique encore peu exploité.' WHERE nom = 'Tapoa';

UPDATE regions SET description = 'Région du nord, chef-lieu Ouahigouya, ancienne capitale du royaume du Yatenga, l\'une des plus densément peuplées du pays. Le peuple Mossi y est réputé pour la culture de l\'oignon et les techniques traditionnelles de restauration des sols (zaï) face à un climat sahélien exigeant.' WHERE nom = 'Yaadga';

-- ========================================================
-- PARTIE 2 : LES 18 PEUPLES (table images_peuples)
-- ========================================================

UPDATE images_peuples SET description = 'Le plus grand groupe ethnique du Burkina Faso, organisé historiquement autour des royaumes mossi (Moogho) dirigés par le Moogho Naaba. Société hiérarchisée et agricole, les Mossi sont aussi réputés pour leur artisanat du bronze et leurs cérémonies royales encore vivantes aujourd\'hui.' WHERE nom = 'Mossi';

UPDATE images_peuples SET description = 'Peuple agriculteur du centre-sud et du centre-ouest, regroupant plusieurs sous-groupes (Nuna, Kasséna...). Connu pour ses masques rituels classés au patrimoine culturel, son organisation sociale parfois matrilinéaire et ses fêtes agraires marquant le rythme des saisons.' WHERE nom = 'Gurunsi';

UPDATE images_peuples SET description = 'Peuple traditionnellement éleveur nomade, présent dans tout le pays mais particulièrement au Sahel. Grands connaisseurs des pâturages et des points d\'eau, les Peul pratiquent la transhumance saisonnière et entretiennent un riche patrimoine oral (poésie pastorale, contes).' WHERE nom = 'Peul';

UPDATE images_peuples SET description = 'Peuple de l\'Est, organisé en chefferies traditionnelles autour de l\'ancien royaume de Fada N\'Gourma. Réputé pour son artisanat du cuir, ses traditions équestres et sa proximité culturelle avec la riche faune des parcs nationaux voisins.' WHERE nom = 'Gourmantché';

UPDATE images_peuples SET description = 'Peuple de l\'Ouest, célèbre pour ses masques sacrés et ses danses rituelles liées à la société du Do. Profondément enraciné dans la région de Bobo-Dioulasso, il joue un rôle central dans le patrimoine culturel burkinabè, notamment à travers le FESPACO.' WHERE nom = 'Bobo';

UPDATE images_peuples SET description = 'Peuple commerçant et lettré de tradition mandingue, jouant un rôle historique dans les échanges trans-sahariens et la diffusion de l\'islam au Burkina Faso. Le dioula reste aujourd\'hui une langue véhiculaire majeure dans l\'ouest du pays.' WHERE nom = 'Dioula';

UPDATE images_peuples SET description = 'Petit groupe lié historiquement aux Mossi, descendant de commerçants mandingues islamisés. Traditionnellement spécialisés dans le commerce de longue distance et l\'artisanat, les Yarsé occupent une place particulière dans la société mossi.' WHERE nom = 'Yarsé';

UPDATE images_peuples SET description = 'Peuple nomade du Sahel, éleveurs de dromadaires et caravaniers, gardiens des savoirs ancestraux du désert. Leur organisation sociale en tribus et leur maîtrise des routes caravanières en ont fait historiquement des acteurs clés du commerce transsaharien.' WHERE nom = 'Touareg';

UPDATE images_peuples SET description = 'Communauté du Sahel historiquement liée aux Touareg, aujourd\'hui largement sédentarisée et pratiquant agriculture et élevage. Les Bella partagent de nombreux traits culturels avec les Touareg tout en ayant développé une identité propre.' WHERE nom = 'Bella';

UPDATE images_peuples SET description = 'Peuple du centre-est, reconnu pour ses techniques agricoles traditionnelles et son artisanat de la poterie. Les Bissa entretiennent un lien fort avec la terre, organisée autour de chefferies coutumières et de rites agraires marquant les récoltes.' WHERE nom = 'Bissa';

UPDATE images_peuples SET description = 'Peuple de l\'Ouest, pratiquant une agriculture sur plateaux et organisé autour de la société du Do, comme les Bobo dont ils sont culturellement proches. Reconnus pour leurs fêtes traditionnelles rythmées par les masques et les percussions.' WHERE nom = 'Bwaba';

UPDATE images_peuples SET description = 'Peuple commerçant du Sourou, lié historiquement aux routes commerciales du fleuve Mouhoun et proche des Soninké. Les Marka ont développé un savoir-faire reconnu en agriculture irriguée et en commerce de céréales.' WHERE nom = 'Marka';

UPDATE images_peuples SET description = 'Peuple agriculteur du Nord, reconnu pour sa résilience face aux conditions sahéliennes et ses techniques de conservation des sols. Les Samo pratiquent également un artisanat de la forge et du tissage transmis de génération en génération.' WHERE nom = 'Samo';

UPDATE images_peuples SET description = 'Peuple du Sud-Ouest, pratiquant l\'agriculture vivrière et le commerce transfrontalier avec la Côte d\'Ivoire. Les Tiéfo ont conservé des traditions propres tout en partageant un voisinage culturel avec les Bobo et les Dioula.' WHERE nom = 'Tiéfo';

UPDATE images_peuples SET description = 'Peuple du Sud-Ouest, société sans chefferie centralisée, organisée en clans et en lignages. Réputé pour son art du masque, son architecture fortifiée (soukala) et ses fétiches (bouthybu), le peuple Lobi a longtemps préservé une forte autonomie face aux pouvoirs extérieurs.' WHERE nom = 'Lobi';

UPDATE images_peuples SET description = 'Peuple du Sud-Ouest partageant de nombreuses traditions avec les Lobi, notamment l\'usage du balafon dans les rites funéraires. Les Dagara vivent en habitat dispersé, organisés autour de l\'agriculture et de l\'élevage familial.' WHERE nom = 'Dagara';

UPDATE images_peuples SET description = 'Peuple du Sud-Ouest apparenté aux Lobi et aux Dagara, connu pour son architecture traditionnelle en terre et ses rites initiatiques marquant le passage à l\'âge adulte. L\'agriculture pluviale reste le pilier de son mode de vie.' WHERE nom = 'Birifor';

UPDATE images_peuples SET description = 'Peuple de la Boucle du Mouhoun, étroitement lié aux Bobo, reconnu pour ses masques sacrés (Do) et ses rites agraires traditionnels. Profondément attachés à la terre, les Bwa pratiquent une agriculture vivrière complétée par un artisanat de tissage réputé.' WHERE nom = 'Bwa';

-- ========================================================
-- PARTIE 3 : LES 18 POTENTIELS PAR RÉGION (table images_potentiels)
-- ========================================================

UPDATE images_potentiels SET description = 'Pilier de l\'économie burkinabè, basée sur le mil, le sorgho, le maïs et le coton. Pratiquée majoritairement en saison pluvieuse par de petites exploitations familiales, l\'agriculture reste la principale source de revenus pour la grande majorité de la population rurale.' WHERE nom = 'Agriculture';

UPDATE images_potentiels SET description = 'Activité traditionnelle majeure, particulièrement dans les zones sahéliennes où le Burkina Faso compte un important cheptel bovin, ovin et caprin. L\'élevage transhumant structure la vie économique et sociale de nombreuses communautés peules et touarègues.' WHERE nom = 'Élevage';

UPDATE images_potentiels SET description = 'Filature et tissage du coton local, secteur en plein développement avec des unités de transformation modernes, notamment autour de Koudougou. L\'industrie textile valorise localement une matière première jusqu\'ici surtout exportée brute.' WHERE nom = 'Industrie textile';

UPDATE images_potentiels SET description = 'Le Burkina Faso est l\'un des premiers producteurs de coton en Afrique, surnommé l\'\u00AB or blanc \u00BB. Cultivé principalement dans l\'ouest et le centre-ouest, le coton fait vivre des millions de producteurs et reste un pilier historique des exportations agricoles.' WHERE nom = 'Coton';

UPDATE images_potentiels SET description = 'Barrages hydroélectriques fournissant une part de l\'énergie nationale, notamment à Bagré et Kompienga. Le potentiel hydroélectrique du pays reste encore largement sous-exploité face à une demande énergétique croissante.' WHERE nom = 'Hydroélectricité';

UPDATE images_potentiels SET description = 'Le Burkina Faso est l\'un des plus grands producteurs d\'or en Afrique de l\'Ouest, avec plusieurs mines industrielles actives. L\'or est devenu le premier produit d\'exportation du pays, générant d\'importantes recettes mais posant aussi des défis environnementaux et sociaux.' WHERE nom = 'Mine d\'or';

UPDATE images_potentiels SET description = 'Activité économique dynamique liée aux marchés locaux et au commerce transfrontalier avec les pays voisins (Côte d\'Ivoire, Ghana, Mali, Niger). Le commerce informel occupe une part importante de l\'économie nationale, notamment dans les grands centres urbains.' WHERE nom = 'Commerce';

UPDATE images_potentiels SET description = 'Secteur industriel en croissance, axé sur la transformation locale des matières premières agricoles et minières. L\'industrie agro-alimentaire (huileries, sucreries) et la transformation du coton en sont les fers de lance.' WHERE nom = 'Industrie';

UPDATE images_potentiels SET description = 'Secteur tertiaire en expansion, notamment dans les zones urbaines comme Ouagadougou et Bobo-Dioulasso. Banques, télécommunications, transport et administration y emploient une part croissante de la population active.' WHERE nom = 'Services';

UPDATE images_potentiels SET description = 'Gisement important situé à Tambao, dans le Liptako, l\'un des plus grands d\'Afrique de l\'Ouest avec des réserves estimées à plus de 10 millions de tonnes. Son désenclavement, notamment par voie ferrée, est un enjeu économique majeur pour le pays.' WHERE nom = 'Mine de manganèse';

UPDATE images_potentiels SET description = 'Production artisanale traditionnelle : sculpture sur bois, bronze, tissage, poterie, reconnue internationalement notamment à travers le SIAO (Salon International de l\'Artisanat de Ouagadougou). Cet artisanat perpétue des savoir-faire ancestraux tout en s\'adaptant aux marchés modernes.' WHERE nom = 'Artisanat';

UPDATE images_potentiels SET description = 'Échanges économiques actifs avec les pays voisins (Côte d\'Ivoire, Ghana, Mali, Niger, Togo, Bénin) via les zones frontalières. Ce commerce transfrontalier, souvent informel, joue un rôle vital dans l\'approvisionnement des marchés locaux.' WHERE nom = 'Commerce transfrontalier';

UPDATE images_potentiels SET description = 'Périmètres irrigués permettant une production agricole toute l\'année, notamment de riz, indépendamment des aléas de la saison des pluies. La vallée du Sourou en est l\'un des exemples les plus aboutis du pays.' WHERE nom = 'Agriculture irriguée';

UPDATE images_potentiels SET description = 'Culture vivrière importante dans les zones humides et les périmètres irrigués, contribuant directement à la sécurité alimentaire nationale. La riziculture connaît un développement soutenu, notamment dans le Sourou et les Cascades.' WHERE nom = 'Riz';

UPDATE images_potentiels SET description = 'Activité pratiquée le long des cours d\'eau et des grands barrages (Bagré, Kompienga, Sourou), source de protéines et de revenus locaux pour de nombreuses communautés riveraines.' WHERE nom = 'Pêche';

UPDATE images_potentiels SET description = 'Patrimoine naturel et culturel attractif : parcs nationaux, cascades, sites historiques classés à l\'UNESCO et grands festivals comme le FESPACO ou le SIAO. Le tourisme reste un secteur à fort potentiel, encore largement sous-exploité.' WHERE nom = 'Tourisme';

UPDATE images_potentiels SET description = 'Culture spécifique aux zones irriguées du Sud-Ouest, notamment autour de Banfora, transformée localement en sucre. La filière sucrière constitue l\'un des rares exemples d\'agro-industrie intégrée du pays.' WHERE nom = 'Canne à sucre';

UPDATE images_potentiels SET description = 'Richesse faunique notable, en particulier dans le Parc national du W et la réserve d\'Arly, partagés avec le Niger et le Bénin. Cette biodiversité exceptionnelle constitue un atout majeur pour l\'écotourisme régional.' WHERE nom = 'Faune';

-- ========================================================
-- VÉRIFICATION FINALE
-- ========================================================
SELECT COUNT(*) AS regions_completes FROM regions WHERE description IS NOT NULL AND description != '';
SELECT COUNT(*) AS peuples_complets FROM images_peuples WHERE description IS NOT NULL AND description != '';
SELECT COUNT(*) AS potentiels_complets FROM images_potentiels WHERE description IS NOT NULL AND description != '';
