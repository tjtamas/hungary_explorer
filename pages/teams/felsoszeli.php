<?php
declare(strict_types=1);

/**
 * Team Page - Felsőszeli (Bercsényi Miklós Hagyományőrző Csapat)
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
$tpl->set('pageTitle', 'Bercsényi Miklós Hagyományőrző Csapat - Felsőszeli')
    ->set('metaDescription', 'A felsőszeli Bercsényi Miklós Hagyományőrző Csapat bemutatása. Alapítva 2003-ban.')
    ->set('pageClass', 'team-page team-felsoszeli');

// Galéria képek
$galleryImages = [
    ['src' => 'teams/felsoszeli/gimes.png', 'alt' => 'Gímes'],
    ['src' => 'teams/felsoszeli/megemlekezes.png', 'alt' => 'Megemlékezés'],
    ['src' => 'teams/felsoszeli/oroksegserleg.png', 'alt' => 'Örökség Serleg'],
];

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
                <span class="current">Felsőszeli</span>
            </nav>

            <!-- Team Header -->
            <header class="team-header">
                <h1 class="team-name">Bercsényi Miklós Hagyományőrző Csapat</h1>
                <p class="team-leader"><i class="fas fa-user"></i> Alapító és csapatvezető: Mészáros Magdolna</p>
                <span class="team-region">🇸🇰 Felvidék - Felsőszeli</span>
            </header>

            <!-- Team Content -->
            <article class="team-content">

                <img src="<?php echo img('teams/felsoszeli/jelveny.png'); ?>" alt="Felsőszeli jelvény" class="team-image team-image-right">

                <p>A Bercsényi Miklós Hagyományőrző Csapat egy a Felvidéken működő szerveződés, mely iskolai és szabadidős keretek között foglalkoztatja javarészt a Felsőszeli Széchenyi István Alapiskolába járó, illetve már elballagott és a hagyományőrzés iránt érdeklődő diákokat.</p>

                <p>A csapat <strong>2003-ban</strong> alakult az alapiskolával szoros együttműködésben és azóta is komoly munkát folytat. A névfelvételre 2005-ben került sor és azért esett a választás <strong>Bercsényi Miklósra</strong>, mivel a környéken csatázott, így kapcsolódik Felsőszelihez, valamint hűsége Rákóczihoz, kitartása és odaadása örök érvényű erkölcsi mutatók.</p>

                <div class="clear"></div>

                <h3><i class="fas fa-tasks"></i> Tevékenységeink</h3>

                <p>Évről-évre a csapat célkitűzései közé tartozik a fiatalok szabadidejének aktív kihasználása, ez az iskolai tanítás után egy szakkör keretein belül folyik. A szakkörre járó diákoknak lehetőségük van a <strong>rovásírás</strong> elsajátítására, a <strong>Forgószél és Garabonciás</strong> levelezőversenyben való részvételre, illetve a <strong>Kincskeresők Konferenciájára</strong> való felkészülésre.</p>

                <p>A hagyományápolásra is komoly hangsúlyt fektetnek, a csapat tagjai akár segítőként, akár fellépőként rendszeresen részt vesznek a májusfaállításon, a szüreti ünnepségen, a szilvás-mákos fesztiválon, a jubilánsok és idősek köszöntésén, valamint immár 12 éve segítenek a <strong>Csillagoknak teremtője</strong> megnevezésű népdalverseny megszervezésében.</p>

                <img src="<?php echo img('teams/felsoszeli/megemlekezes.png'); ?>" alt="Megemlékezés" class="team-image team-image-left">

                <p>A csapat tagjai neves évfordulók alkalmával, mint <strong>március 15., március 27., október 23.</strong> megemlékezéseket tartanak, valamint részt vesznek a falu által rendezett koszorúzásokon. Azonban nem csak folyamatos munkáról szól a csapat élete. Rendszeresen vesznek részt felfedezőutakon, kerékpártúrákon, ha tehetik ellátogatnak Büttner Emil sírjához, melynek gondozását céljukként tűzték ki.</p>

                <div class="clear"></div>

                <img src="<?php echo img('teams/felsoszeli/kerekpartura.png'); ?>" alt="Kerékpártúra" class="team-image team-image-right">

                <p>A folyamatos építő tevékenység mellett elmondhatják magukról, hogy a tagok száma minden évben nő. Új tagokat minden tanévben ünnepség keretein belül avatnak. A csatlakozni kívánó diákoknak fogadalmat kell tenniük, hogy igyekeznek megismerni és ápolni a hagyományokat, a magyar történelmet valamint egyéni fogadalmat is tesznek, mindenki a saját lehetősége szerint.</p>

                <div class="clear"></div>

                <h3><i class="fas fa-handshake"></i> Együttműködések</h3>

                <p>A csapat Magyarország Felfedezői Szövetséggel való együttműködése 2003-ban kezdődött, amikor 6 diák jutalomként egy táborozást nyert a szövetség Vezetőképző táborába, melyre Sárospatakon került sor. Azóta a felvidéki diákok minden évben ellátogatnak a táborba, ahová nem csak az élmények, hanem az évek alatt kialakított barátságok is visszacsalogatják a csapat tagjait.</p>

                <p>Az erdélyi csapatokkal kialakított remek kapcsolat eredményeként 2016 nyarán 6 diák és 2 tanár juthatott el a Kis-Küküllő melletti Geges településben megszervezett felfedezőtáborba, ahol ismerős arcokkal tölthettek el 6 kellemes napot. A tábor sikerességén felbuzdulva és a meghívás viszonzásaként 2017 nyarán július 5-10. között Felvidéken, <strong>Gímesen</strong> került megrendezésre az I. Felvidéki Felfedezőtábor, ahová az erdélyi barátok is meghívást kaptak.</p>

                <h3><i class="fas fa-trophy"></i> Örökség Serleg</h3>

                <p>2017. január 22-én a magyar kultúra napján az évek óta tartó fáradhatatlan hagyományőrző tevékenységért a Falvak Kultúrájáért Alapítvány <strong>Örökség Serleget</strong> adományozott a csapatnak, mely méltó jutalomnak bizonyult a csapat tagjainak és vezetőjének egyaránt.</p>

                <!-- Gallery -->
                <h3><i class="fas fa-images"></i> Galéria</h3>
                
                <div class="team-gallery">
                    <?php foreach ($galleryImages as $image): ?>
                        <div class="team-gallery-item">
                            <img src="<?php echo img($image['src']); ?>" alt="<?php echo $image['alt']; ?>" loading="lazy">
                        </div>
                    <?php endforeach; ?>
                </div>

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