<?php
declare(strict_types=1);

/**
 * Team Page - Kibéd (Mátyus István Hagyományőrző Csapat)
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
$tpl->set('pageTitle', 'Mátyus István Hagyományőrző Csapat - Kibéd')
    ->set('metaDescription', 'A kibédi Mátyus István Hagyományőrző Csapat bemutatása. Alapítva 2000-ben.')
    ->set('pageClass', 'team-page team-kibed');

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
                <span class="current">Kibéd</span>
            </nav>

            <!-- Team Header -->
            <header class="team-header">
                <h1 class="team-name">Mátyus István Hagyományőrző Csapat</h1>
                <p class="team-leader"><i class="fas fa-user"></i> Csapatvezető: Mátyus Ilona</p>
                <span class="team-region">🇷🇴 Erdély - Kibéd</span>
            </header>

            <!-- Team Content -->
            <article class="team-content">

                <!-- Info Box -->
                <div class="team-info-box">
                    <ul>
                        <li><i class="fas fa-calendar-alt"></i> <strong>Alakulás éve:</strong> 2000</li>
                        <li><i class="fas fa-users"></i> <strong>Alapító tagok száma:</strong> 12</li>
                        <li><i class="fas fa-user-graduate"></i> <strong>Fogadalmat tett:</strong> 54 gyerek (17 év alatt)</li>
                    </ul>
                </div>

                <h3><i class="fas fa-users"></i> Segítők a vezetésben</h3>

                <ul class="team-list">
                    <li>Kovács Hont Imre (2009-2013)</li>
                    <li>Domo Anna-Bella (2013-2016)</li>
                    <li>Szilveszter Eszter (2013- )</li>
                </ul>

                <p><strong>Avatási ünnepségeink helyszínei:</strong> Kibéd, Hármasfalu, Zágon, Kolozsvár, Gyimes, Nyergestető, Geges.</p>

                <p><strong>Csapatörökségünk:</strong> Református templomunk orgonája, melyet Bodor Péter épített 1847-ben.</p>

                <h3><i class="fas fa-hiking"></i> Felfedezőutak</h3>

                <p>Történelmi és kulturális múltunk értékeinek megismerése céljából a következő helységekből gyűjtöttünk elkobozhatatlan kincseket (örökségeket): <strong>Kibéd, Hármasfalu, Makfalva, Sóvárad, Szováta, Parajd, Korond, Farkaslaka, Székelyszentmihály, Székelyudvarhely, Agyagfalva, Székelykeresztúr, Héjjasfalva, Fehéregyháza, Segesvár, Csíkszereda, Madéfalva, Gyimesi-szoros, Marosvásárhely, Radnót, Kolozsvár, Tordai-hasadék, Nagyenyed, Sepsiszentgyörgy, Kisbacon, Gyergyószárhegy, Gernyeszeg, Marosvécs, Bonchida, Pusztakamarás, Szeben, Vízakna, Gyulafehérvár, Vajdahunyad, Déva, Geges.</strong></p>

                <p>Magyarországon Budapesten, Gyömrőn valamint a sárospataki táborozások alkalmával tettünk még sok felfedező utat. Két csapattagunk Felsőszeli és környéke megismerésében vett részt a többi erdélyi csapat szervezésében a felvidéki csapat meghívására.</p>

                <h3><i class="fas fa-campground"></i> Sárospataki táborozások</h3>

                <img src="<?php echo img('teams/kibed/foldadomany.png'); ?>" alt="Földadomány" class="team-image team-image-left">

                <p>A sárospataki táborozások alkalmával minden évben több csapattag különböző próbákat teljesített. Bizonyítják ezt az emléklapok és kitűzők. A <strong>Sárospatak hagyományőrzője</strong> kitüntetést eddig több mint 10 csapattag érdemelte ki.</p>

                <p><strong>Törzstiszti próbát tettek az évek során:</strong> Madaras Emőke, Kovács Hont Imre, Domo Anna-Bella tanítónő és Szilveszter Eszter, aki az utóbbi években a táborban ifjú vezetőként is tevékenykedik.</p>

                <p>Földadományokat szintén minden évben szórtak le a mindenkori táborozóink Sárospatakon. Ezeket általában felfedező útjainkon gyűjtöttük, így gazdagítva a sárospataki Hármas halmot.</p>

                <div class="clear"></div>

                <h3><i class="fas fa-theater-masks"></i> Játékok és műsorok</h3>

                <p><strong>Történelmi, anyanyelvi és igric játékokat</strong> minden évben szervezünk egy-két alkalommal és az utóbbi években együtt van ilyenkor a négy erdélyi csapat. Ezeket a játékokat rendszerint Sárospatakon is megismételjük, sőt Gegesben is.</p>

                <p><strong>Műsoros előadásokat</strong> is minden évben tartunk március 15., október 6-án, illetve más történelmi évfordulók vagy éppen hagyományos ünnepségek alkalmával. Megemlékező műsorainkból Sárospatakon, Széphalomban az alábbiakat ismételtük meg:</p>

                <ul class="team-list">
                    <li>Nemes ifjak társasága megalakulásának 300. évfordulójára (2007)</li>
                    <li>Kazinczy Ferenc nyelvújító (2008)</li>
                    <li>Trianon (2010)</li>
                    <li>Mikes és a Rákóczi szabadságharc (2011)</li>
                    <li>Szabó Jóska emléke</li>
                </ul>

                <p>2017-ben szövetségünk nevében Kolozsváron ünnepeltük meg a Nemes Ifjak Társasága megalakulásának 300. évfordulóját: 4 „nemes ifjú" és 6 új csapattag tett akkor fogadalmat.</p>

                <h3><i class="fas fa-book"></i> Csapatfoglalkozások</h3>

                <p>Csapatfoglalkozásaink programját próbáljuk minél színesebbre varázsolni néphagyományok megismerésével, történelmi események áttekintésével, <strong>rovásírás</strong> gyakorlásával és sok dalolással. A rovásírás megismerése és elsajátítása céljából sok játékos foglalkozást szerveztünk évente, amiknek köszönhetően minden csapattag ismeri a rovásírást.</p>

                <p>Új dalok tanulása rendszeres tevékenységünk. Eddig <strong>6 kuruc dalt, 10 „negyvennyolcas" dalt</strong> és számos népdalt ismerünk.</p>

                <p>A 2000-es évek elején Kibédet bemutató írásainkból Kossuth Rádióban hangzott el válogatás Indri Gyula „Ifjúsáv" című műsorában. Havonta jelennek meg a csapatvezető írásai a Kibédiek lapjában.</p>

                <p><em>Erdély felfedezőiként</em> Makfalva, Hármasfalu és Sóvárad csapataival 2012 óta általában közös tevékenységekben is részt veszünk.</p>

                <div class="team-quote">
                    <p>Nagyon hálásak vagyunk a Magyarország Felfedezői Szövetség vezetőségének a sok szakmai támogatásért és a sárospataki táborozásokért. Valamint kegyelettel emlékezünk a belgiumi <strong>Horváth Vilmosra</strong> (Vili bácsira), aki éveken át anyagi támogatásával segítette csapatunkat felfedező utak megszervezésében.</p>
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