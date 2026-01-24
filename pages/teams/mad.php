<?php
declare(strict_types=1);

/**
 * Team Page - Mád (Koroknay Dániel Hagyományőrző Csapat)
 * 
 * @package MagyarorszagFelfedezoi
 * @version 2.0.0
 */

// Bootstrap
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/TemplateEngine.php';

// Create template engine
$tpl = new TemplateEngine('templates/');

// Set global variables
$tpl->setGlobal('siteName', SITE_NAME)
    ->setGlobal('siteTagline', SITE_TAGLINE)
    ->setGlobal('currentYear', date('Y'))
    ->setGlobal('baseUrl', BASE_URL)
    ->setGlobal('assetsUrl', ASSETS_URL)
    ->setGlobal('imagesUrl', IMAGES_URL);

// Set page variables
$tpl->set('pageTitle', 'Koroknay Dániel Hagyományőrző Csapat - Mád')
    ->set('metaDescription', 'A mádi Koroknay Dániel Hagyományőrző Csapat bemutatása. Alapítva 1998-ban.')
    ->set('pageClass', 'team-page team-mad');

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="<?php echo $tpl->e($tpl->get('metaDescription')); ?>">
    
    <title><?php echo $tpl->e($tpl->get('pageTitle')); ?> - <?php echo SITE_NAME; ?></title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo img('logo/stags_logo.png'); ?>">
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo asset('css/variables.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/modern.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/components.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/pages.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/teams.css'); ?>">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Roboto+Slab:wght@400;700;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="<?php echo $tpl->e($tpl->get('pageClass', '')); ?>">

    <!-- Header -->
    <?php $tpl->render('header'); ?>

    <!-- Main Content -->
    <div id="wrapper" class="single-column-layout">
        <main id="main" class="main-content">
            
            <!-- Breadcrumb -->
            <nav class="breadcrumb">
                <a href="<?php echo url(''); ?>"><i class="fas fa-home"></i> Kezdőlap</a>
                <span class="separator">/</span>
                <span>Csapataink</span>
                <span class="separator">/</span>
                <span class="current">Mád</span>
            </nav>

            <!-- Team Header -->
            <header class="team-header">
                <h1 class="team-name">Koroknay Dániel Hagyományőrző Csapat</h1>
                <p class="team-leader"><i class="fas fa-user"></i> Csapatvezető: Gáspárné Késmárki Emília</p>
                <span class="team-region">🇭🇺 Magyarország - Mád</span>
            </header>

            <!-- Team Content -->
            <article class="team-content">

                <p>Csapatunk <strong>1998-ban</strong> alakult meg 24 lelkes gyermekkel. Nevünk azon 14 éves fiúhoz kötődik, aki Mádon állt be a seregbe. Először az 5. majd a 11. gyalogütegben szolgált és később elnyerte a főágyúsi rangot. Vagyis ő adott parancsot az ágyú tüzelési állapotba helyezésére és ő maga irányozta be a csövet a célpontra.</p>

                <img src="<?php echo img('teams/mad/csapat.png'); ?>" alt="Mádi csapat" class="team-image team-image-left">

                <p>Ezt a csapatunk tagjai is értik és igazi példaképként kezelik a hős fiút. Valamint Mád is méltó emléket állított Koroknay Daninak, ugyanis az iskolában állandó kiállítás, emléktábla őrzi nevét. 2000-ben a Millennium évében az iskola felvette a fiú nevét.</p>

                <p>Csapatunk éves programjába beletartozik a <strong>március 15-ei fáklyás felvonulás</strong>. Mivel ez a megalakulásunk dátuma, elmaradhatatlan Koroknay Dániel emléktáblájának megkoszorúzása. Ez a tábla az iskola falán található és minden évben nagy tömegek tekintik meg ezt a rövid szertartást.</p>

                <div class="clear"></div>

                <img src="<?php echo img('teams/mad/templom.png'); ?>" alt="Templom" class="team-image team-image-right">

                <p>Az <strong>október 6-ai ünnepség</strong> is kiemelkedő ránk nézve. Községünk temetőjében fekszik Pándy Soma Sámuel és Cornides Lajos is, akiknek minden évben megszervezzük a megemlékezést, általában egy kis műsorral. Számunkra nagy elismerés, hogy Mád vezetői, intézményvezetők és a támogatóink is részt vesznek rajta.</p>

                <p>Iskolánk minden évben megrendezi a <strong>Koroknay napokat</strong>. Ilyenkor történelmi hadijátékokat tartunk. Ez jó lehetőség a toborzásra is. Valamint új programunk keretében a kisebb diákok egy körutazást tehetnek Zemplén megyében. Ellátogatnak Sárospatakra, Széphalomra és Boldogkőváraljára is.</p>

                <p>Újdonsült tagjainkat igyekszünk gyorsan bevonni a munkába. A felavatásuk után, amely a Mádi Református Templom udvarában zajlik, rögtön a falu hagyományaival és nevezetességeivel ismertetjük meg őket.</p>

                <div class="clear"></div>

                <p>Később kitárjuk ezt a kört Magyarországra is. Így a nyári Sárospataki táborra már felkészülten érkeznek. De nem csak a munka van előtérben. A délutáni csapattalálkozókon gyakran szervezünk kézműves foglalkozást és vetélkedőket is. Nagy népszerűségnek örvendenek a falu kis utcáiban megszervezett hadijátékok. Ezek által számos téma megismertethető a gyerekekkel játékos formában. Közben mozognak és bejárják lakóhelyüket is.</p>

                <h3><i class="fas fa-trophy"></i> Örökség Serleg</h3>

                <p>Legjelentősebb elismerésünk az <strong>Örökség Serleg</strong> átvétele 2014. január 19-én, a XVIII. Magyar Kultúra Napja Gála keretén belül megrendezésre kerülő eseményen.</p>

                <p>Tizenhárom országból érkeztek vendégek Budapestre a XVIII. Magyar Kultúra Napja Gálára, ahol 21 személy részesült a Kultúra Lovagja elismerésben. Az elismerésre civil szervezetek és önkormányzatok állítottak jelölteket a magyar és az egyetemes kulturális örökség ápolása, közkinccsé tétele, alkotó fejlesztése, a kultúrák nemzetközi együttműködésének elősegítése, valamint kulturális tevékenység támogatása érdekében huzamos időn át kifejtet önzetlen tevékenységért.</p>

                <p>A kitüntetett csapattagok oklevelet, ezüst kitűzőt és érmet kaptak, nevüket bejegyzik a Magyar Kultúra Lovagjai Aranykönyvébe.</p>

                <img src="<?php echo img('teams/mad/kituntetes.png'); ?>" alt="Kitüntetés" class="team-image team-image-full">

                <p>Továbbra is igyekszünk ápolni Mád és Magyarország hagyományait, gyermekeink is aktívan és szorgalmasan teljesítenek minden évben, hiszen a jutalmuk egy hét Sárospatakon, a szövetség táborában.</p>

                <!-- CTA Section -->
                <section class="content-section cta-section">
                    <div class="cta-box">
                        <h3>Csatlakozz a csapathoz!</h3>
                        <p>Érdeklődsz a hagyományőrzés iránt? Vedd fel velünk a kapcsolatot!</p>
                        <a href="<?php echo url('pages/contact.php'); ?>" class="btn btn-primary btn-lg">
                            <i class="fas fa-envelope"></i> Kapcsolatfelvétel
                        </a>
                    </div>
                </section>

            </article>

        </main>
    </div>

    <!-- Footer -->
    <footer id="footer" class="site-footer">
        <div class="footer-container">
            <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. Minden jog fenntartva.</p>
            <p>Készítette: <a href="mailto:tothjanostamas@gmail.com">Tóth J. Tamás</a></p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="<?php echo asset('js/app.js'); ?>"></script>

</body>
</html>