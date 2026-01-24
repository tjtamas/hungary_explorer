<?php
declare(strict_types=1);

/**
 * Gallery Album View
 * 
 * Modern photo gallery with lightbox
 * Uses GalleryEngine for data
 * 
 * @package MagyarorszagFelfedezoi
 * @version 2.0.0
 */

// Bootstrap
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/TemplateEngine.php';
require_once __DIR__ . '/GalleryEngine.php';

// Get year and album from URL parameters
$year = $_GET['year'] ?? '2024';
$album = $_GET['album'] ?? 'camp';

// Create gallery instance
$gallery = new GalleryEngine($year, $album);

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
$tpl->set('pageTitle', $gallery->getTitle())
    ->set('metaDescription', $gallery->getDescription())
    ->set('pageClass', 'gallery-album-page');

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="<?php echo htmlspecialchars($gallery->getDescription()); ?>">
    
    <title><?php echo htmlspecialchars($gallery->getTitle()); ?> - <?php echo SITE_NAME; ?></title>
    
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
                <span class="current"><?php echo htmlspecialchars($gallery->getYear()); ?></span>
            </nav>

            <!-- Album Header -->
            <header class="album-header">
                <div class="album-info">
                    <h1 class="album-title"><?php echo htmlspecialchars($gallery->getTitle()); ?></h1>
                    <?php if ($gallery->getDescription()): ?>
                        <p class="album-description"><?php echo htmlspecialchars($gallery->getDescription()); ?></p>
                    <?php endif; ?>
                    <div class="album-meta">
                        <span class="album-date">
                            <i class="far fa-calendar-alt"></i>
                            <?php echo htmlspecialchars($gallery->getDate()); ?>
                        </span>
                        <span class="album-count">
                            <i class="far fa-images"></i>
                            <?php echo $gallery->getImageCount(); ?> fotó
                        </span>
                    </div>
                </div>
                <a href="<?php echo url('pages/gallery'); ?>" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Vissza a galériához
                </a>
            </header>

            <!-- Photo Grid -->
            <div class="photo-grid">
                <?php foreach ($gallery->getImages() as $index => $image): ?>
                    <div class="photo-item fade-in" style="animation-delay: <?php echo $index * 0.05; ?>s;" data-index="<?php echo $index; ?>">
                        <div class="photo-wrapper">
                            <img 
                                src="<?php echo $image['thumb']; ?>" 
                                data-full="<?php echo $image['full']; ?>"
                                alt="<?php echo htmlspecialchars($image['alt']); ?>"
                                loading="lazy"
                                class="photo-thumb"
                            >
                            <div class="photo-overlay">
                                <button class="photo-zoom" data-index="<?php echo $index; ?>">
                                    <i class="fas fa-search-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (empty($gallery->getImages())): ?>
                <div class="no-photos">
                    <i class="far fa-images"></i>
                    <p>Ebben az albumban még nincsenek fotók.</p>
                </div>
            <?php endif; ?>

        </main>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="lightbox">
        <button class="lightbox-close" aria-label="Bezárás">
            <i class="fas fa-times"></i>
        </button>
        <button class="lightbox-prev" aria-label="Előző">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="lightbox-next" aria-label="Következő">
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="lightbox-content">
            <img src="" alt="" id="lightbox-image">
            <div class="lightbox-caption" id="lightbox-caption"></div>
            <div class="lightbox-counter" id="lightbox-counter"></div>
        </div>
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
    
    <!-- Gallery Images Data -->
    <script>
        const galleryImages = <?php echo json_encode($gallery->getImages()); ?>;
    </script>
    
    <!-- Gallery Lightbox Script -->
    <script src="<?php echo asset('js/gallery.js'); ?>"></script>

</body>
</html>