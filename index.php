<?php
declare(strict_types=1);

/**
 * Index Page - Magyarország Felfedezői Szövetség
 * 
 * Modern SOLID PHP implementation
 * Two-column layout: Content (left) + Sticky Sidebar (right)
 * 
 * @package MagyarorszagFelfedezoi
 * @version 2.0.0
 */

// Bootstrap the application
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/TemplateEngine.php';

// Create template engine instance
$tpl = new TemplateEngine('templates/');

// Set global variables (available in all templates)
$tpl->setGlobal('siteName', SITE_NAME)
    ->setGlobal('siteTagline', SITE_TAGLINE)
    ->setGlobal('currentYear', date('Y'))
    ->setGlobal('baseUrl', BASE_URL)
    ->setGlobal('assetsUrl', ASSETS_URL)
    ->setGlobal('imagesUrl', IMAGES_URL);

// Set page-specific variables
$tpl->set('pageTitle', 'Kezdőlap')
    ->set('metaDescription', SITE_DESCRIPTION)
    ->set('pageClass', 'home-page');

// Banner section data
$tpl->set('bannerTitle', 'A Szövetségről')
    ->set('bannerQuote', SITE_TAGLINE)
    ->set('bannerText', 'Szövetségünk 1989. szeptemberében alakult. Gyermekek, fiatalok, felnőttek szervezete vagyunk. Szövetséget kötöttünk a szülőföld, a haza felfedezésére, nemzeti értékeink, hagyományaink megőrzésére, az igaz emberi értékek követésére, a gyermek ember igaz értékek menti jellemformálására, a közösségi élet ajándékosztó erejének építésére.')
    ->set('bannerImage', img('DSC_2546.jpg'))
    ->set('bannerImageAlt', 'Magyarország Felfedezői Szövetség csoportkép')
    ->set('bannerButtonText', 'Tovább')
    ->set('bannerButtonLink', url('pages/about.php'));

// News data (később ezt adatbázisból vagy JSON-ből töltjük)
$newsItems = [
    [
        'title' => 'Jelentkezés Pásztortűz 2026',
        'excerpt' => 'Várjuk jelentkezésedet idei nyári táborunkba, ahol ismét felejthetetlen élmények várnak!',
        'image' => img('galeria/2026/tabor/tabor2026.jfif'),
        'link' => url('news/2026/jelentkezes'),
        'date' => '2026. Január',
        'tag' => 'ÚJ'
    ],
    [
        'title' => 'Pásztortűz 2025',
        'excerpt' => '2025. július 21-től július 28-ig ismét felfedezők lepték el a Magyarország Felfedezői Szövetség táborát.',
        'image' => img('galeria/2025/tabor/tab006.jpg'),
        'link' => url('news/2025/tabor2025'),
        'date' => '2025. Július',
        'tag' => 'TÁBOR'
    ],
    [
        'title' => 'Márciusi programjaink',
        'excerpt' => 'Szövetségünk márciusi programjairól az összefoglalást itt olvashatod.',
        'image' => img('galeria/2025/main/1848_main.jpg'),
        'link' => url('news/2025/2025_mar'),
        'date' => '2025. Március',
        'tag' => 'PROGRAM'
    ]
];

$tpl->set('newsItems', $newsItems);

// Statistics data
$stats = [
    [
        'icon' => '📅',
        'number' => '35+',
        'label' => 'Év Tapasztalat'
    ],
    [
        'icon' => '🎒',
        'number' => '5',
        'label' => 'Aktív Csapat'
    ],
    [
        'icon' => '👥',
        'number' => '1000+',
        'label' => 'Felfedező'
    ],
    [
        'icon' => '🏕️',
        'number' => '35',
        'label' => 'Tábor'
    ]
];

$tpl->set('stats', $stats);

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="<?php echo $tpl->e($tpl->get('metaDescription')); ?>">
    <meta name="keywords" content="magyarország, felfedezők, szövetség, cserkész, tábor, ifjúság">
    <meta name="author" content="Tóth J. Tamás">
    
    <title><?php echo $tpl->e($tpl->get('pageTitle')); ?> - <?php echo $tpl->e(SITE_NAME); ?></title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo img('logo/stags_logo.png'); ?>">
    
    <!-- CSS - Modern approach -->
    <link rel="stylesheet" href="<?php echo asset('css/variables.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/modern.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/components.css'); ?>">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Roboto+Slab:wght@400;700;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Facebook SDK -->
    <?php if (ENABLE_FACEBOOK_SDK): ?>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v5.0&appId=354763484558291&autoLogAppEvents=1"></script>
    <?php endif; ?>
</head>

<body class="<?php echo $tpl->e($tpl->get('pageClass', '')); ?>">

    <!-- Header with Top Navigation -->
    <?php $tpl->render('header'); ?>

    <!-- Main Wrapper - Two Column Layout -->
    <div id="wrapper" class="two-column-layout">

        <!-- Main Content Area -->
        <main id="main" class="main-content">
            <div class="content-inner">

                <!-- Banner Section -->
                <?php $tpl->render('banner'); ?>

                <!-- Statistics Section -->
                <section id="stats" class="stats-section">
                    <div class="stats-container">
                        <?php foreach ($stats as $index => $stat): ?>
                        <div class="stat-card fade-in" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                            <div class="stat-icon"><?php echo $stat['icon']; ?></div>
                            <div class="stat-number"><?php echo $tpl->e($stat['number']); ?></div>
                            <div class="stat-label"><?php echo $tpl->e($stat['label']); ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <!-- News Section -->

                <?php $tpl->render('news'); ?>

            </div>
        </main>

        <!-- Sticky Sidebar -->
        <?php $tpl->render('sidebar'); ?>

    </div>

    <!-- Footer -->
    <footer id="footer" class="site-footer">
        <div class="footer-container">
            <div class="footer-grid">
                
                <!-- About Column -->
                <div class="footer-column">
                    <h4>Magyarország Felfedezői Szövetség</h4>
                    <p><?php echo SITE_DESCRIPTION; ?></p>
                    <p class="footer-tagline"><?php echo SITE_TAGLINE; ?></p>
                </div>

                <!-- Quick Links Column -->
                <div class="footer-column">
                    <h4>Gyors linkek</h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo url('pages/about.php'); ?>">Rólunk</a></li>
                        <li><a href="<?php echo url('pages/badges.php'); ?>">Jelvényeink</a></li>
                        <li><a href="<?php echo url('pages/gallery'); ?>">Képgaléria</a></li>
                        <li><a href="<?php echo url('pages/contact.php'); ?>">Kapcsolat</a></li>
                    </ul>
                </div>

                <!-- Contact Column -->
                <div class="footer-column">
                    <h4>Elérhetőség</h4>
                    <ul class="footer-contact">
                        <li><i class="fas fa-envelope"></i> <?php echo CONTACT_EMAIL; ?></li>
                        <li><i class="fab fa-facebook"></i> <a href="<?php echo FACEBOOK_PAGE; ?>" target="_blank">Facebook</a></li>
                        <li><i class="fas fa-hand-holding-heart"></i> Adószám: <?php echo SZJA_TAX_NUMBER; ?></li>
                    </ul>
                </div>

            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. Minden jog fenntartva.</p>
                <p>
                    Készítette: <a href="mailto:tothjanostamas@gmail.com">Tóth J. Tamás</a> | 
                    <a href="<?php echo url('gdpr/adatkezeles.pdf'); ?>">Adatkezelési tájékoztató</a>
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts - Modern approach (NO jQuery!) -->
    <script src="<?php echo asset('js/app.js'); ?>"></script>
    
    <!-- Google Analytics -->
    <?php if (ENABLE_ANALYTICS): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-155182194-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-155182194-1');
    </script>
    <?php endif; ?>

</body>
</html>