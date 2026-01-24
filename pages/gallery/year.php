<?php
declare(strict_types=1);

/**
 * Gallery Year View - Albums List
 * 
 * Shows all albums for a specific year
 * 
 * @package MagyarorszagFelfedezoi
 * @version 2.0.0
 */

// Bootstrap
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/TemplateEngine.php';
require_once __DIR__ . '/GalleryEngine.php';

// Get year from URL parameter
$year = $_GET['year'] ?? date('Y');

// Get albums for this year
$albums = GalleryEngine::getAlbumsForYear($year);

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
$tpl->set('pageTitle', $year . ' - Képgaléria')
    ->set('metaDescription', 'Képgaléria ' . $year . ' - Táborok, programok, emlékezetes pillanatok.')
    ->set('pageClass', 'gallery-year-page');

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
                <a href="<?php echo url('pages/gallery'); ?>">Galéria</a>
                <span class="separator">/</span>
                <span class="current"><?php echo htmlspecialchars($year); ?></span>
            </nav>

            <!-- Page Header -->
            <header class="page-header">
                <h1 class="page-title">📸 <?php echo htmlspecialchars($year); ?></h1>
                <p class="page-description">
                    Válassz az alábbi albumok közül!
                </p>
            </header>

            <!-- Albums Grid -->
            <div class="years-grid">
                <?php if (!empty($albums)): ?>
                    <?php foreach ($albums as $index => $album): ?>
                        <a href="<?php echo url('pages/gallery/album.php?year=' . $year . '&album=' . $album['folder']); ?>" class="year-card fade-in" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                            <div class="year-card-image">
                                <?php if ($album['cover']): ?>
                                    <img src="<?php echo $album['cover']; ?>" alt="<?php echo htmlspecialchars($album['name']); ?>" loading="lazy">
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
                                <h2 class="year-title"><?php echo htmlspecialchars($album['name']); ?></h2>
                                <div class="year-meta">
                                    <span class="year-count">
                                        <i class="far fa-images"></i>
                                        <?php echo $album['imageCount']; ?> fotó
                                    </span>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-galleries">
                        <i class="far fa-images"></i>
                        <p>Ebben az évben még nincsenek albumok.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Back button -->
            <div style="text-align: center; margin-top: 2rem;">
                <a href="<?php echo url('pages/gallery'); ?>" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Vissza az évekhez
                </a>
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