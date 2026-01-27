<?php
declare(strict_types=1);

/**
 * News Article - Egyedi hír oldal
 * 
 * @package MagyarorszagFelfedezoi
 * @version 2.0.0
 */

// Bootstrap
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/news.php';
require_once __DIR__ . '/../../config/TemplateEngine.php';

/**
 * Get article content from markdown file
 */
function getArticleContent(array $news): string
{
    $slug = $news['slug'];
    $mdFile = __DIR__ . '/../../content/news/' . $slug . '.md';
    
    // Ha létezik markdown fájl, olvassuk be
    if (file_exists($mdFile)) {
        $content = file_get_contents($mdFile);
        return parseMarkdown($content);
    }
    
    // Fallback: excerpt megjelenítése
    return '<p>' . htmlspecialchars($news['excerpt']) . '</p>';
}

/**
 * Simple markdown parser
 */
function parseMarkdown(string $text): string
{
    // Headers (elöbb, mielőtt a paragrafusokat kezeljük)
    $text = preg_replace('/^### (.+)$/m', "\n<h4>$1</h4>\n", $text);
    $text = preg_replace('/^## (.+)$/m', "\n<h3>$1</h3>\n", $text);
    $text = preg_replace('/^# (.+)$/m', "\n<h2>$1</h2>\n", $text);
    
    // Bold
    $text = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $text);
    
    // Italic  
    $text = preg_replace('/\*(.+?)\*/', '<em>$1</em>', $text);
    
    // Blockquotes
    $text = preg_replace('/^> (.+)$/m', '<blockquote>$1</blockquote>', $text);
    
 // Images - relatív útvonal támogatás
$text = preg_replace_callback('/!\[([^\]]*)\]\(([^)]+)\)/', function($m) {
    $src = $m[2];
    // Ha ../ -al kezdődik, akkor relatív útvonal a markdown fájlhoz képest
    if (strpos($src, '../') === 0) {
        // Távolítsuk el a ../ részeket és használjuk az img() helpert
        $src = preg_replace('#^\.\./+#', '', $src);
        $src = preg_replace('#^images/#', '', $src); // images/ prefix eltávolítása
        $src = img($src);
    }
    return '<img src="' . $src . '" alt="' . $m[1] . '" class="article-image">';
}, $text);
    
   // Links - Gallery linkek külön class-szal
$text = preg_replace_callback('/\[([^\]]+)\]\(([^)]+)\)/', function($m) {
    $text = $m[1];
    $url = $m[2];
    $class = (strpos($url, 'gallery') !== false) ? ' class="gallery-link"' : '';
    return '<a href="' . $url . '"' . $class . '>' . $text . '</a>';
}, $text);
    
    // Horizontal rule
    $text = preg_replace('/^---$/m', '<hr>', $text);
    
    // Lists
    $text = preg_replace('/^- (.+)$/m', '<li>$1</li>', $text);
    $text = preg_replace('/(<li>.*<\/li>\s*)+/', '<ul>$0</ul>', $text);
    
  // Paragraphs (skip headers, ul, hr, blockquote)
$text = preg_replace('/\n\n+/', '</p><p>', $text);
$text = '<p>' . $text . '</p>';

// Single line breaks -> <br>
$text = preg_replace('/(?<!<\/p>)\n(?!<p>)/', '<br>', $text);
    
  // Clean up - Gallery link ne kerüljön <p>-be
$text = preg_replace('/<p>\s*<\/p>/', '', $text);
$text = preg_replace('/<p>\s*<(h[2-4]|ul|hr|blockquote|img|a[^>]*class="gallery-link")/', '<$1', $text);
$text = preg_replace('/<\/(h[2-4]|ul|hr|blockquote)>\s*<\/p>/', '</$1>', $text);
$text = preg_replace('/<\/p>\s*<img/', '<img', $text);
$text = preg_replace('/<\/p>\s*<a[^>]*class="gallery-link"/', '<a class="gallery-link"', $text);
    
    return $text;
}

// Get slug from URL
$slug = $_GET['slug'] ?? '';

// Get news item
$news = getNewsBySlug($slug);

// 404 if not found
if (!$news) {
    header('HTTP/1.0 404 Not Found');
    echo '<h1>Hír nem található</h1>';
    echo '<p><a href="' . url('pages/news') . '">Vissza a hírekhez</a></p>';
    exit;
}

// Get category info
$categoryInfo = getCategoryInfo($news['category']);

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
$tpl->set('pageTitle', $news['title'])
    ->set('metaDescription', $news['excerpt'])
    ->set('pageClass', 'news-article-page');

// Get all news for navigation
$allNews = getNewsItems();
$currentIndex = null;
foreach ($allNews as $index => $item) {
    if ($item['id'] === $news['id']) {
        $currentIndex = $index;
        break;
    }
}

$prevNews = $currentIndex !== null && isset($allNews[$currentIndex + 1]) ? $allNews[$currentIndex + 1] : null;
$nextNews = $currentIndex !== null && $currentIndex > 0 ? $allNews[$currentIndex - 1] : null;

// Get article content
$articleContent = getArticleContent($news);

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
                <a href="<?php echo url('pages/news'); ?>">Híreink</a>
                <span class="separator">/</span>
                <span class="current"><?php echo htmlspecialchars($news['title']); ?></span>
            </nav>

            <!-- Article -->
            <article class="news-article">
                
                <!-- Article Header -->
                <header class="article-header">
                    <div class="article-meta">
                        <span class="article-category" style="--badge-color: var(--color-<?php echo $categoryInfo['color']; ?>, #666);">
                            <i class="<?php echo $categoryInfo['icon']; ?>"></i>
                            <?php echo $categoryInfo['name']; ?>
                        </span>
                        <span class="article-date">
                            <i class="far fa-calendar-alt"></i>
                            <?php echo formatDateHu($news['date']); ?>
                        </span>
                    </div>
                    <h1 class="article-title"><?php echo htmlspecialchars($news['title']); ?></h1>
                </header>

                <!-- Article Content -->
                <div class="article-content">
                    <?php echo $articleContent; ?>
                </div>

                <!-- Article Navigation -->
                <nav class="article-nav">
                    <?php if ($prevNews): ?>
                        <a href="<?php echo url('pages/news/article.php?slug=' . $prevNews['slug']); ?>" class="prev-article">
                            <i class="fas fa-arrow-left"></i>
                            <span><?php echo htmlspecialchars($prevNews['title']); ?></span>
                        </a>
                    <?php else: ?>
                        <span></span>
                    <?php endif; ?>
                    
                    <?php if ($nextNews): ?>
                        <a href="<?php echo url('pages/news/article.php?slug=' . $nextNews['slug']); ?>" class="next-article">
                            <span><?php echo htmlspecialchars($nextNews['title']); ?></span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    <?php endif; ?>
                </nav>

                <!-- Back to News -->
                <div class="content-section cta-section" style="margin-top: 2rem;">
                    <a href="<?php echo url('pages/news'); ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Vissza a hírekhez
                    </a>
                </div>

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