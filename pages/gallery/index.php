<?php
declare(strict_types=1);

/**
 * Gallery Index - Years List
 * 
 * Shows all available gallery years
 * 
 * @package MagyarorszagFelfedezoi
 * @version 2.0.0
 */

// Bootstrap
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/TemplateEngine.php';
require_once __DIR__ . '/GalleryEngine.php';

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
$tpl->set('pageTitle', 'Képgaléria')
    ->set('metaDescription', 'Tekintse meg képgalériánkat az elmúlt évekből. Táborok, programok, emlékezetes pillanatok.')
    ->set('pageClass', 'gallery-index-page');

// Get available years (dynamically!)
$years = GalleryEngine::getAvailableYears();

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
    <link rel="stylesheet" href="<?php echo asset('css/gallery.css'); ?>">
    
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
                <span class="current">Galéria</span>
            </nav>

            <!-- Page Header -->
            <header class="page-header">
                <h1 class="page-title">📸 Képgaléria</h1>
                <p class="page-description">
                    Tekintse meg képeinket az elmúlt évekből. Táborok, programok, emlékezetes pillanatok egyesületünk életéből.
                </p>
            </header>

            <!-- Years Grid -->
            <div class="years-grid">
                <?php if (!empty($years)): ?>
                    <?php foreach ($years as $index => $yearData): ?>
                        <a href="<?php echo url('pages/gallery/year.php?year=' . $yearData['year']); ?>" class="year-card fade-in" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                            <div class="year-card-image">
                                <?php if ($yearData['cover']): ?>
                                    <img src="<?php echo $yearData['cover']; ?>" alt="<?php echo $yearData['year']; ?>" loading="lazy">
                                <?php else: ?>
                                    <div class="year-placeholder">
                                        <i class="far fa-images"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="year-overlay">
                                    <span class="year-view">
                                        <i class="fas fa-eye"></i> Megtekintés
                                    </span>
                                </div>
                            </div>
                            <div class="year-card-content">
                                <h2 class="year-title"><?php echo $yearData['year']; ?></h2>
                                <div class="year-meta">
                                    <span class="year-count">
                                        <i class="far fa-folder"></i>
                                        <?php echo $yearData['albumCount']; ?> album
                                    </span>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-galleries">
                        <i class="far fa-images"></i>
                        <p>Jelenleg nincsenek elérhető galériák.</p>
                    </div>
                <?php endif; ?>
            </div>

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