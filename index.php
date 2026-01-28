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
require_once __DIR__ . '/config/news.php';

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
    ->set('bannerImage', img('about/team.jpg'))
    ->set('bannerImageAlt', 'Magyarország Felfedezői Szövetség csoportkép')
    ->set('bannerButtonText', 'Tovább')
    ->set('bannerButtonLink', url('pages/about.php'));

// Get latest 3 news items
$allNews = getNewsItems();
$allNews = array_filter($allNews, fn($item) => !($item['hide_in_news_list'] ?? false));
$latestNews = array_slice($allNews, 0, 3);

// Transform to template format
$newsItems = [];
foreach ($latestNews as $news) {
    $categoryInfo = getCategoryInfo($news['category']);
    $newsItems[] = [
        'title' => $news['title'],
        'excerpt' => $news['excerpt'],
        'image' => img($news['image']),
        'link' => url('pages/news/article.php?slug=' . $news['slug']),
        'date' => formatDateHu($news['date']),
        'tag' => strtoupper($categoryInfo['name'])
    ];
}

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
        'number' => '30+',
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
</head>

<body class="<?php echo $tpl->e($tpl->get('pageClass', '')); ?>">

    <!-- Facebook SDK -->
    <?php if (ENABLE_FACEBOOK_SDK): ?>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v5.0&appId=354763484558291&autoLogAppEvents=1"></script>
    <?php endif; ?>

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
                <section id="news" class="news-section">
                    <header class="section-header">
                        <h2 class="section-title">Híreink</h2>
                        <div class="section-underline"></div>
                    </header>
 
                    <div class="news-grid">
                        <?php if (empty($newsItems)): ?>
                            <p class="no-news">Jelenleg nincsenek hírek.</p>
                        <?php else: ?>
                            <?php foreach ($newsItems as $index => $news): ?>
                                <article class="news-card fade-in" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                                    <a href="<?php echo $tpl->e($news['link']); ?>" class="news-image-link">
                                        <div class="news-image-container">
                                            <img src="<?php echo $tpl->e($news['image']); ?>" alt="<?php echo $tpl->e($news['title']); ?>" class="news-image" loading="lazy">
                                            <?php if (!empty($news['tag'])): ?>
                                                <span class="news-tag"><?php echo $tpl->e($news['tag']); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </a>

                                    <div class="news-content">
                                        <h3 class="news-title">
                                            <a href="<?php echo $tpl->e($news['link']); ?>"><?php echo $tpl->e($news['title']); ?></a>
                                        </h3>
                                        <p class="news-excerpt"><?php echo $tpl->e($news['excerpt']); ?></p>
                                        <div class="news-footer">
                                            <span class="news-date"><i class="far fa-calendar-alt"></i> <?php echo $tpl->e($news['date']); ?></span>
                                            <a href="<?php echo $tpl->e($news['link']); ?>" class="news-link">Tovább <i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                      <div style="text-align: center; margin-top: 3rem;">
                        <a href="<?php echo url('pages/news'); ?>" style="color: var(--text-light, #7f888f); text-decoration: none; font-size: 1rem; font-weight: 600; transition: color 0.2s;">
                            További hírek →
                        </a>
                    </div>
                </section>

            </div>
        </main>
        <!-- Sticky Sidebar -->
        <?php $tpl->render('sidebar'); ?>

    </div>
<?php $tpl->render('bottom-logo'); ?>


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
                    Készítette: <a href="https://tjtamas.hu/"target="_blank" rel="noopener noreferrer" >Tóth J. Tamás</a> | 
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