<?php
declare(strict_types=1);

/**
 * News Index - Hírek lista oldal
 * 
 * @package MagyarorszagFelfedezoi
 * @version 2.0.0
 */

// Bootstrap
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/news.php';
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
$tpl->set('pageTitle', 'Híreink')
    ->set('metaDescription', 'Magyarország Felfedezői Szövetség hírei, eseményei, beszámolói.')
    ->set('pageClass', 'news-index-page');

// Get filter parameters
$filterYear = isset($_GET['year']) ? (int)$_GET['year'] : null;
$filterCategory = $_GET['category'] ?? null;

// Get news items
$newsItems = getNewsItems();

// Apply filters
if ($filterYear) {
    $newsItems = array_filter($newsItems, fn($item) => $item['year'] === $filterYear);
}
if ($filterCategory) {
    $newsItems = array_filter($newsItems, fn($item) => $item['category'] === $filterCategory);
}

// Get available years and categories for filters
$availableYears = getNewsYears();
$activeRegistration = getActiveRegistration();

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
    <link rel="stylesheet" href="<?php echo asset('css/news-page.css'); ?>">
    
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
                <span class="current">Híreink</span>
            </nav>

            <!-- Page Header -->
            <header class="page-header">
                <h1 class="page-title">📰 Híreink</h1>
                <p class="page-description">
                    Kövesse nyomon eseményeinket, táborainkat és programjainkat!
                </p>
            </header>

            <?php if ($activeRegistration): ?>
            <!-- Active Registration Banner -->
            <div class="registration-banner">
                <div class="registration-banner-content">
                    <div class="registration-banner-icon">
                        <i class="fas fa-campground"></i>
                    </div>
                    <div class="registration-banner-text">
                        <h3><?php echo htmlspecialchars($activeRegistration['title']); ?></h3>
                        <p>
                            <i class="fas fa-calendar-alt"></i> 
                            <?php echo formatDateHu($activeRegistration['camp_date_start']); ?> - 
                            <?php echo formatDateHu($activeRegistration['camp_date_end']); ?>
                        </p>
                        <p class="deadline">
                            <i class="fas fa-clock"></i> 
                            Jelentkezési határidő: <strong><?php echo formatDateHu($activeRegistration['registration_deadline']); ?></strong>
                        </p>
                    </div>
                    <a href="<?php echo url('pages/news/registration.php'); ?>" class="btn btn-primary btn-lg">
                        <i class="fas fa-user-plus"></i> Jelentkezem!
                    </a>
                </div>
            </div>
            <?php endif; ?>

            <!-- Filters -->
            <div class="news-filters">
                <div class="filter-group">
                    <label><i class="fas fa-calendar"></i> Év:</label>
                    <select id="yearFilter" onchange="applyFilters()">
                        <option value="">Összes év</option>
                        <?php foreach ($availableYears as $year): ?>
                            <option value="<?php echo $year; ?>" <?php echo $filterYear === $year ? 'selected' : ''; ?>>
                                <?php echo $year; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label><i class="fas fa-tag"></i> Kategória:</label>
                    <select id="categoryFilter" onchange="applyFilters()">
                        <option value="">Összes kategória</option>
                        <?php foreach (NEWS_CATEGORIES as $key => $cat): ?>
                            <option value="<?php echo $key; ?>" <?php echo $filterCategory === $key ? 'selected' : ''; ?>>
                                <?php echo $cat['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php if ($filterYear || $filterCategory): ?>
                    <a href="<?php echo url('pages/news'); ?>" class="filter-reset">
                        <i class="fas fa-times"></i> Szűrők törlése
                    </a>
                <?php endif; ?>
            </div>

            <!-- News Grid -->
            <div class="news-grid-page">
                <?php if (empty($newsItems)): ?>
                    <div class="no-news">
                        <i class="fas fa-newspaper"></i>
                        <p>Nincs találat a megadott szűrőkkel.</p>
                        <a href="<?php echo url('pages/news'); ?>" class="btn btn-secondary">Összes hír</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($newsItems as $index => $news): 
                        if ($news['hide_in_news_list'] ?? false) continue;
                        $categoryInfo = getCategoryInfo($news['category']);
                    ?>
                        <article class="news-card-large fade-in" style="animation-delay: <?php echo $index * 0.05; ?>s;">
                            <a href="<?php echo url('pages/news/article.php?slug=' . $news['slug']); ?>" class="news-card-image">
                                <img src="<?php echo img($news['image']); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>" loading="lazy">
                                <span class="news-category-badge" style="--badge-color: var(--color-<?php echo $categoryInfo['color']; ?>, #666);">
                                    <i class="<?php echo $categoryInfo['icon']; ?>"></i>
                                    <?php echo $categoryInfo['name']; ?>
                                </span>
                                <?php if ($news['featured'] ?? false): ?>
                                    <span class="news-featured-badge">
                                        <i class="fas fa-star"></i> Kiemelt
                                    </span>
                                <?php endif; ?>
                            </a>
                            <div class="news-card-content">
                                <div class="news-card-meta">
                                    <span class="news-date">
                                        <i class="far fa-calendar-alt"></i>
                                        <?php echo formatDateHu($news['date']); ?>
                                    </span>
                                    <span class="news-year"><?php echo $news['year']; ?></span>
                                </div>
                                <h2 class="news-card-title">
                                    <a href="<?php echo url('pages/news/article.php?slug=' . $news['slug']); ?>">
                                        <?php echo htmlspecialchars($news['title']); ?>
                                    </a>
                                </h2>
                                <p class="news-card-excerpt">
                                    <?php echo htmlspecialchars($news['excerpt']); ?>
                                </p>
                                <a href="<?php echo url('pages/news/article.php?slug=' . $news['slug']); ?>" class="news-read-more">
                                    Tovább olvasom <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
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
    <script>
        function applyFilters() {
            const year = document.getElementById('yearFilter').value;
            const category = document.getElementById('categoryFilter').value;
            
            let url = '<?php echo url('pages/news'); ?>';
            const params = [];
            
            if (year) params.push('year=' + year);
            if (category) params.push('category=' + category);
            
            if (params.length > 0) {
                url += '?' + params.join('&');
            }
            
            window.location.href = url;
        }
    </script>

</body>
</html>