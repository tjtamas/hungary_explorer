<?php
declare(strict_types=1);

/**
 * Badges Page - Magyarország Felfedezői Szövetség
 * 
 * Jelvényeink oldal
 * 
 * @package MagyarorszagFelfedezoi
 * @version 2.0.0
 */

// Bootstrap
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/TemplateEngine.php';

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
$tpl->set('pageTitle', 'Jelvényeink')
    ->set('metaDescription', 'Magyarország Felfedezői Szövetség jelvényei, kitüntetései és elismerései.')
    ->set('pageClass', 'badges-page');

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
                <span class="current">Jelvényeink</span>
            </nav>

            <!-- Page Header -->
            <header class="page-header">
                <h1 class="page-title">🎖️ Jelvényeink</h1>
                <p class="page-description">
                    Próbák, fokozatok és kitüntetések a Szövetségben
                </p>
            </header>

            <!-- Content -->
            <article class="page-content">
                
                <!-- Alap jelvények Section -->
                <section class="content-section">
                    <h2><i class="fas fa-award"></i> Alap jelvények</h2>
                    <div class="content-block with-image">
                        <div class="content-text">
                            <p>
                                A felvételi próbát követő avatás után mindenki kedvére választhat például a régmúlt erősségeit kutató <strong>„várfelderítők"</strong>, a természet szépségeit kereső <strong>„vándordiákok"</strong>, a néphagyományok nyomába eredő <strong>„igricek"</strong>, a <strong>„diáktűzoltók"</strong>, <strong>„veszélyelhárítók"</strong>, a <strong>„Kossuth regimentje"</strong>, a <strong>„Rákóczi hagyományőrzője"</strong> és sok más izgalmas próba, felfedezőút, pályázat és játék közül.
                            </p>
                            <p>
                                A legtöbb próbának van tiszti fokozata is, ami már kicsit a mások segítésére, az adott terület másokkal való megismertetésére is irányítja a próbázót.
                            </p>
                        </div>
                        <div class="content-image">
                            <img src="<?php echo img('badges/alap.png'); ?>" alt="Alap jelvények" class="rounded-image shadow">
                        </div>
                    </div>
                </section>

                <!-- Tiszti jelvények Section -->
                <section class="content-section">
                    <h2><i class="fas fa-star"></i> Tiszti fokozatok</h2>
                    <div class="content-block with-image reverse">
                        <div class="content-text">
                            <p>
                                A szövetség vezetői fokozatait szintén tiszti próbák, fokozatok jelentik. A vezetőket azért hívjuk <strong>„tiszteknek"</strong>, mert a sorsdöntő történelmi pillanatokban a tisztek voltak azok, akiket a hozzájuk tartozók bizalommal követtek, akik példamutatásukkal, emberségükkel, hazaszeretetükkel méltó példaképei, felelős vezetői voltak a rájuk bízott embereknek, sokszor gyerekeknek is.
                            </p>
                            <p>
                                Így szerezhető a szövetség vezetői próbájaként korhatártól is függően <strong>őrsvezetői</strong>, <strong>őrstiszti</strong>, <strong>zászlóaljtiszti</strong>, <strong>törzstiszti</strong> és <strong>vezetőképző tiszti</strong> rang, fokozat is.
                            </p>
                        </div>
                        <div class="content-image">
                            <img src="<?php echo img('badges/tiszt.png'); ?>" alt="Tiszti jelvények" class="rounded-image shadow">
                        </div>
                    </div>
                </section>

                <!-- Kitüntetések Section -->
                <section class="content-section highlight-section">
                    <h2><i class="fas fa-medal"></i> Kitüntetések</h2>
                    <div class="content-block">
                        <p>
                            A próbák mellett kitüntetések, elismerések várják szövetségünk tagjait. Valljuk, hogy <strong>az elismerés felemel</strong>. Mindenekelőtt azt, aki vállalja a munkát. De büszke lehet rá a környezete – kis közössége, barátai, szülei, iskolája – is. A kitüntetések értékerősítő elismerések. Számos kitüntetésünk alapítói, gondozói történelmi családok mai leszármazottai, vagy más, munkánkat becsülő országos szervezetek.
                        </p>
                        <p>
                            Így minden évben tavasszal <strong>Görgei Tibor</strong> adja át a „Hazáért" kitüntetéseket a Budai Várban, a Kossuth Szövetség elnöke vagy tiszteletbeli elnöke pedig a Kossuth tiszti jelvényeket. A <strong>Pilaszanovich</strong> és a <strong>Than család</strong> tagjai is sokszor velünk ünnepelnek és adják át az arra legérdemesebbeknek a „Nemzeti Hagyományőrző" kitüntetést vagy a hagyományőrző munkáért járó más elismeréseket – például az <strong>„Ezüstszarvas"</strong> vagy az <strong>„Aranyszarvas"</strong> kitüntetéseket.
                        </p>
                    </div>
                    
                    <!-- Kitüntetések kép -->
                    <img src="<?php echo img('badges/kituntetesek.png'); ?>" alt="Kitüntetések" class="full-width-image">
                </section>

                <!-- Sárospatak Section -->
                <section class="content-section">
                    <h2><i class="fas fa-city"></i> Sárospatak hagyományőrzője</h2>
                    <div class="content-block with-image">
                        <div class="content-text">
                            <p>
                                Városok, önkormányzatok is szívesen részt vesznek munkánkban, néhány közülük kitüntetést is alapított a szövetség tagjai részére.
                            </p>
                            <p>
                                <strong>Sárospatak Város Önkormányzata</strong> például minden évben üdvözli és figyelemmel kíséri a nyári táborok munkáját, s a város vezetése minden évben átadja a <strong>„Sárospatak hagyományőrzője"</strong> elismerő jelvényt, emléklapot a kitüntetésre javasolt felfedezőknek.
                            </p>
                        </div>
                        <div class="content-image">
                            <img src="<?php echo img('badges/sarospatak.png'); ?>" alt="Sárospatak hagyományőrzője jelvény" class="rounded-image shadow">
                        </div>
                    </div>
                </section>

                <!-- CTA Section -->
                <section class="content-section cta-section">
                    <div class="cta-box">
                        <h3>Szerezd meg te is!</h3>
                        <p>Csatlakozz hozzánk és kezdd el a próbázást! Számtalan izgalmas feladat és elismerés vár rád!</p>
                        <a href="<?php echo url('pages/contact.php'); ?>" class="btn btn-primary btn-lg">
                            <i class="fas fa-envelope"></i> Jelentkezz most
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