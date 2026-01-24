<?php
declare(strict_types=1);

/**
 * Museum Page - Magyarország Felfedezői Szövetség
 * 
 * Múzeumunk oldal
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
$tpl->set('pageTitle', 'Múzeumunk')
    ->set('metaDescription', 'A magyar történelem gyermekhőseinek emléket állító múzeum Sárospatakon.')
    ->set('pageClass', 'museum-page');

// Múzeum képek
$museumImages = [
    [
        'src' => 'museum/kiallitas.png',
        'alt' => 'Kiállítás'
    ],
    [
        'src' => 'museum/rajz.png',
        'alt' => 'Rajzok'
    ],
    [
        'src' => 'museum/zaszlo.png',
        'alt' => 'Zászló'
    ],
    [
        'src' => 'museum/ruha.png',
        'alt' => 'Egyenruha'
    ],
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
    <link rel="stylesheet" href="<?php echo asset('css/museum.css'); ?>">
    
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
                <span class="current">Múzeumunk</span>
            </nav>

            <!-- Page Header -->
            <header class="page-header">
                <h1 class="page-title">🏛️ Múzeumunk</h1>
                <p class="page-description">
                    A magyar történelem gyermekhőseinek emléket állító múzeum Sárospatakon
                </p>
            </header>

            <!-- Content -->
            <article class="page-content">
                
                <!-- Intro Section -->
                <section class="content-section">
                    <div class="content-block">
                        <p class="lead">
                            A Magyarország Felfedezői Szövetség vezetőképző központja <strong>Sárospatak</strong>, Bodroghalász nevű városrészében található.
                        </p>
                        <p>
                            Miért esett a választás éppen Sárospatakra? Mert nincs Magyarországon még egy olyan hely, ahol annyi természeti és történelmi érték együtt lenne, mint ezen a tájon.
                        </p>
                        <p>
                            A szövetség a Sárospatakon álló két hajdani parasztházat <strong>1993-ban</strong> vásárolta. A házakat a szervezet tagjai jobbára a maguk erejéből újították fel, s gondozzák önzetlen segítséggel ma is.
                        </p>
                    </div>
                </section>

                <!-- Museum Description -->
                <section class="content-section highlight-section">
                    <h2><i class="fas fa-landmark"></i> Magyarország egyetlen gyermekhős múzeuma</h2>
                    <div class="content-block">
                        <p>
                            Az egyik ház szálláshelyül szolgál. A közvetlenül a <strong>Bodrog-folyó</strong> partjánál fekvő másik ház azonban ma Magyarország egyetlen, a magyar történelem gyermekhőseinek és a gyermekhősök emlékét őrző munkáknak emléket állító múzeumnak ad helyet.
                        </p>
                        <p>
                            A három szobás kicsi múzeumunkban bőven talál írásokat, emléktárgyakat, képeket az ide látogató. Nyaranta pedig a táborok alkalmával a gyerekek bújnak be egy-egy órára, hogy például a választott próbájuk egyik feladataként kiválasszanak maguknak egy gyermekhőst, akit valamely tulajdonsága miatt követendő példának tartanak.
                        </p>
                        <p>
                            A gyermekhősök múzeumának parkosított kertjében kopjafákkal övezve áll a <strong>Hármashalom</strong>.
                        </p>
                    </div>
                </section>

                <!-- Gallery Section -->
                <section class="content-section">
                    <h2><i class="fas fa-images"></i> Képek a múzeum kiállításaiból</h2>
                    
                    <!-- Museum Gallery -->
                    <div class="museum-gallery">
                        <!-- Main Image -->
                        <div class="gallery-main">
                            <img id="mainImage" src="<?php echo img($museumImages[0]['src']); ?>" alt="<?php echo $museumImages[0]['alt']; ?>">
                        </div>
                        
                        <!-- Thumbnails -->
                        <div class="gallery-thumbs">
                            <?php foreach ($museumImages as $index => $image): ?>
                                <div class="gallery-thumb <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                                    <img src="<?php echo img($image['src']); ?>" alt="<?php echo $image['alt']; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>

                <!-- CTA Section -->
                <section class="content-section cta-section">
                    <div class="cta-box">
                        <h3>Látogass el hozzánk!</h3>
                        <p>Múzeumunkat a nyári táborok idején, vagy előzetes egyeztetés alapján lehet megtekinteni.</p>
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
    
    <!-- Museum Gallery Script -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const mainImage = document.getElementById('mainImage');
        const thumbs = document.querySelectorAll('.gallery-thumb');
        
        const images = <?php echo json_encode(array_map(function($img) {
            return ['src' => img($img['src']), 'alt' => $img['alt']];
        }, $museumImages)); ?>;
        
        thumbs.forEach((thumb, index) => {
            thumb.addEventListener('click', () => {
                // Update main image
                mainImage.src = images[index].src;
                mainImage.alt = images[index].alt;
                
                // Update active class
                thumbs.forEach(t => t.classList.remove('active'));
                thumb.classList.add('active');
            });
        });
    });
    </script>

</body>
</html>