<?php
declare(strict_types=1);

/**
 * Video Gallery Page - Magyarország Felfedezői Szövetség
 * 
 * YouTube video collection
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
$tpl->set('pageTitle', 'Videógaléria')
    ->set('metaDescription', 'Magyarország Felfedezői Szövetség videói - Tábori emlékek, TV szereplések')
    ->set('pageClass', 'video-gallery-page');

// Tábori videók
$campVideos = [
    [
        'title' => 'Sárospatak 2019 - Táncház',
        'year' => '2019',
        'youtube_id' => 'foK2gagoqYw'
    ],
    [
        'title' => 'Sárospatak 2019 II.',
        'year' => '2019',
        'youtube_id' => 'qfwTl9NuQYY'
    ],
    [
        'title' => 'Sárospatak 2019 I.',
        'year' => '2019',
        'youtube_id' => 'OUSyuWyojDg'
    ],
    [
        'title' => 'Tábori Emlékek 2018',
        'year' => '2018',
        'youtube_id' => 'ScGGkW2_t2M'
    ],
    [
        'title' => 'Tábori Emlékek 2017',
        'year' => '2017',
        'youtube_id' => 'XC82q-o41og'
    ],
    [
        'title' => 'Tábori Emlékek 2016',
        'year' => '2016',
        'youtube_id' => 'uPYRu8Fx1Ik'
    ],
    [
        'title' => 'Tábori Emlékek 2015',
        'year' => '2015',
        'youtube_id' => '3S1wuyywBjA'
    ],
    [
        'title' => 'Tábori Emlékek 2015-ig',
        'year' => '2015',
        'youtube_id' => 'L1uH0A394HE'
    ],
    [
        'title' => 'Tábori Emlékek 2010',
        'year' => '2010',
        'youtube_id' => 'T_bh7aUVnpk'
    ],
];

// TV szereplések
$tvVideos = [
    [
        'title' => 'Újra Sárospatakon tartották a Magyarország Felfedezői Tábort',
        'year' => '2019',
        'youtube_id' => 'EH-h_7-Ahd4'
    ],
    [
        'title' => '25 éve alakult meg Magyarország Felfedezői Szövetsége',
        'year' => '2014',
        'youtube_id' => 'OQwwncZU9IU'
    ],
    [
        'title' => 'Magyarország Felfedezői Szövetség tábora Sárospatakon',
        'year' => '2013',
        'youtube_id' => 'vA_AoEzSvUw'
    ],
    [
        'title' => 'Magyarország Felfedezői Szövetségének nyári tábora Sárospatakon',
        'year' => '2013',
        'youtube_id' => '8s2pHYNleJo'
    ],
    [
        'title' => 'Magyar Felfedezők Szövetségének gyermektábora Sárospatakon',
        'year' => '2012',
        'youtube_id' => '81nWtncQmpo'
    ],
    [
        'title' => 'Hagyományőrző, vezetőképző tábor Sárospatakon',
        'year' => '2010',
        'youtube_id' => 'e26_34bJjwI'
    ],
    [
        'title' => 'Véget ért az Országos Felfedezői Tábor Sárospatakon',
        'year' => '2010',
        'youtube_id' => 'vhHh32Qj2j0'
    ],
    [
        'title' => 'Az 1848/49-es szabadságharc gyermekhőseire emlékeztek',
        'year' => '2009',
        'youtube_id' => 'VprBRWbZ_-M'
    ],
    [
        'title' => 'Magyarország Felfedezői Szövetség Rákóczi tábora Sárospatakon',
        'year' => '2009',
        'youtube_id' => 'TDsUHTuo9nY'
    ],
    [
        'title' => 'Díjak átadásával zárult a Rákóczi Tábor',
        'year' => '2009',
        'youtube_id' => 'BjDTwuqTSkU'
    ],
    [
        'title' => 'Táborunk a Zemplén TV-ben',
        'year' => '2018',
        'youtube_id' => 'IXZJYS1tdaM'
    ],
    [
        'title' => 'Táborunk a Zemplén TV-ben',
        'year' => '2017',
        'youtube_id' => 'g2GBZkHgU0s'
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
    <link rel="stylesheet" href="<?php echo asset('css/videos.css'); ?>">
    
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
                <span class="current">Videógaléria</span>
            </nav>

            <!-- Page Header -->
            <header class="page-header">
                <h1 class="page-title">🎬 Videógaléria</h1>
                <p class="page-description">
                    Tekintse meg tábori videóinkat és TV szerepléseinket az elmúlt évekből!
                </p>
            </header>

            <!-- Tábori videók szekció -->
            <section class="video-section">
                <header class="section-header">
                    <h2 class="section-title"><i class="fas fa-campground"></i> Tábori videók</h2>
                    <div class="section-underline"></div>
                </header>

                <div class="video-grid">
                    <?php foreach ($campVideos as $index => $video): ?>
                        <div class="video-card fade-in" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                            <div class="video-wrapper">
                                <iframe 
                                    src="https://www.youtube-nocookie.com/embed/<?php echo $video['youtube_id']; ?>" 
                                    title="<?php echo htmlspecialchars($video['title']); ?>"
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen
                                    loading="lazy"
                                ></iframe>
                            </div>
                            <div class="video-info">
                                <h3 class="video-title"><?php echo htmlspecialchars($video['title']); ?></h3>
                                <span class="video-year">
                                    <i class="far fa-calendar-alt"></i> <?php echo $video['year']; ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- TV szereplések szekció -->
            <section class="video-section">
                <header class="section-header">
                    <h2 class="section-title"><i class="fas fa-tv"></i> Szövetségünk a televízióban</h2>
                    <div class="section-underline"></div>
                </header>

                <div class="video-grid">
                    <?php foreach ($tvVideos as $index => $video): ?>
                        <div class="video-card fade-in" style="animation-delay: <?php echo $index * 0.05; ?>s;">
                            <div class="video-wrapper">
                                <iframe 
                                    src="https://www.youtube-nocookie.com/embed/<?php echo $video['youtube_id']; ?>" 
                                    title="<?php echo htmlspecialchars($video['title']); ?>"
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen
                                    loading="lazy"
                                ></iframe>
                            </div>
                            <div class="video-info">
                                <h3 class="video-title"><?php echo htmlspecialchars($video['title']); ?></h3>
                                <span class="video-year">
                                    <i class="far fa-calendar-alt"></i> <?php echo $video['year']; ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

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