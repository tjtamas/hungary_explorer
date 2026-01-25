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

// Article content based on slug (can be extended with markdown files later)
$articleContent = getArticleContent($news);

/**
 * Get article content based on news item
 */
function getArticleContent(array $news): string
{
    $slug = $news['slug'];
    
    // Content mapping - later this can come from markdown files or database
    $contents = [
        '2025/tabor2025' => '
            <p>Július 21-én külhoni és anyaországi gyerekek és felnőttek gyülekeztek egy számukra nagyon különleges helyen. Egy csapásra régi barátságok elevenedtek fel és új, talán életre szóló kapcsolatok kezdték meg fejlődésüket… Megérkeztünk Sárospatakra!</p>
            
            <p>Az első hivatalos tábori napon mindenki izgatottan ébredt, már az ébresztő előtt nagy nyüzsgés volt a táborban. A megnyitó ünnepséggel indult a program, ahol hagyományaink szerint elhelyeztük a földadományokat a Hármashalmon. Ezután megalakultak a csapatok, összesen öt: <strong>Vezetőképző, Várfelderítő – Kossuth-tiszt, Tűzpróba, Igric tiszt, Nemesifjak – Rákóczi-tiszt.</strong></p>
            
            <p>Az első csapatfoglalkozás ismerkedéssel és játékkal telt, majd az ebéd utáni délutáni foglalkozáson mindenki lelkesen kezdett a próbáján dolgozni. Délután egy Eszti által szervezett szuper sportversenyen vettek részt a táborozók, ahol megtanultak csapatként, együttműködve dolgozni.</p>
            
            <p>Szerda reggel városi sétára indultunk, ahol meglátogattuk a vízikaput, a Szent Erzsébet Bazilikát, ahol a Szövetség új tagjait avattuk fel, majd a kollégiumot, ahol rövid megemlékezést tartottunk a szabadságharcban harcoló diákok emléktáblája előtt.</p>
            
            <p>A csütörtöki napon kis csapatunkkal útnak indultunk a Magyar Kálváriához. A város nyüzsgése mögött egy barátságos, kanyargós hegyi ösvény vezetett felfelé. Fent, az emlékműnél a vezetők egy része megható előadással készült, amely mély nyomot hagyott bennünk.</p>
            
            <p>A pénteki napon az ébresztőt és a reggelit egy csapatfoglalkozás követte, majd elindultunk a már éves hagyománnyá vált túránkra a <strong>Megyer-hegyi tengerszemhez</strong>. Odafele busszal könnyítettük meg a melegben lévő gyaloglást.</p>
            
            <p>Szombaton reggel szokásainkhoz híven ellátogattunk a <strong>sárospataki Rákóczi-várba</strong>. Az idegenvezetői a vár helyiségeit bemutatva elkalauzolt bennünket a dicső múltba. Ezt követően sor került a nemesifjak avatási ünnepségére a Vörös-torony Lovagtermében.</p>
            
            <p>Borongós reggelre ébredtünk az utolsó napon, mintha az égiek is tudták volna, hogy közeledik a búcsúzás pillanata. A csapatok egymás után felsorakoztak a <strong>Hármashalom</strong> előtt, ahol a fogadalmak elhangzása után mindenki megkapta a heti munkáért járó jelvényét.</p>
        ',
        
        '2025/1848' => '
            <p>Szövetségünk ifi vezetőivel idén is megemlékeztünk a Március idusán történt eseményekről.</p>
            
            <p>Sétánkat a <strong>Kossuth mauzóleumnál</strong> kezdtük, meglátogattuk Karsa Ferenc, Klapka György, Batthyány Lajos, Görgey Artúr, Than Károly sírhelyét, majd megemlékezésünket a Petőfi család sírboltjánál zártuk!</p>
            
            <p>A séta során felidéztük a szabadságharc legfontosabb eseményeit és hőseinek életét. Különösen megható volt a Batthyány-mauzóleumnál tett látogatásunk, ahol az első felelős magyar miniszterelnökre emlékeztünk.</p>
        ',
        
        '2024/tabor2024' => '
            <p>2024. július 28-tól augusztus 4-ig ismét felfedezők lepték el a Magyarország Felfedezői Szövetség táborát Sárospatakon.</p>
            
            <p>Idén is változatos programokkal vártuk a táborozókat: csapatfoglalkozások, gátjátékok, kirándulások és próbák teljesítése töltötte ki a hetet. A hagyományokhoz híven ellátogattunk a Rákóczi-várba és a Tengerszem túra sem maradhatott el.</p>
            
            <p>A tábor záróünnepségén a Hármashalom előtt minden résztvevő megkapta a megérdemelt jelvényeket és elismeréseket.</p>
        ',
        
        '2024/europanap' => '
            <p>A Falvak Kultúrájáért Alapítvány, Aranyosapáti Alkotóház és Aranyos Sziget Gyermek és Ifjúsági tábor szervezésében az elhunyt Magyar Kultúra Lovagjaira emlékeztünk.</p>
            
            <p>Az Európai Kultúra Napja alkalmából tartott rendezvényen szövetségünk tagjai is részt vettek, felidézve azokat, akik életüket a magyar kultúra megőrzésének és ápolásának szentelték.</p>
        ',
        
        '2023/tabor2023' => '
            <p>2023. július 28-tól augusztus 5-ig ismét felfedezők lepték el a Magyarország Felfedezői Szövetség táborát.</p>
            
            <p>A tábor során számos izgalmas program várta a résztvevőket: túrák, játékok, kézműves foglalkozások és természetesen a hagyományos próbák teljesítése.</p>
        ',
        
        '2023/oktober23' => '
            <p>Október 23-án egy kellemes délutáni sétára indultunk a Nemzeti sírkertben, ahol 1956 hőseire emlékeztünk.</p>
            
            <p>A séta során felkerestük a forradalom és szabadságharc áldozatainak sírjait, felidézve a hősök emlékét és a szabadság iránti elkötelezettségüket.</p>
        ',
        
        '2022/tabor2022' => '
            <p>Két hosszú év kihagyás után, idén a Magyarország Felfedezői Szövetség sárospataki tábora újra megtelt élettel július 23 és július 30 között.</p>
            
            <p>Különösen örömteli volt az újratalálkozás, hiszen a járvány miatt hosszú ideje nem gyűlhettünk össze. A régi és új barátságok felelevenítése mellett természetesen a hagyományos programok sem maradtak el.</p>
        ',
        
        '2019/30ymain' => '
            <p>Harminc évvel ezelőtt, 1989 szeptemberében néhány lelkes pedagógus kezdeményezésére megalakult a Magyarország Felfedezői Szövetség.</p>
            
            <p>A jubileumi év alkalmából számos rendezvényen ünnepeltük a szövetség fennállásának 30. évfordulóját. Visszatekintettünk az elmúlt évtizedek legfontosabb eseményeire és eredményeire.</p>
            
            <p>A szövetség három évtized alatt több ezer gyermek és fiatal életét gazdagította, megismertetve őket hazánk történelmével, hagyományaival és természeti értékeivel.</p>
        ',
        
        '2019/news3' => '
            <p>Ezzel a mottóval szerveztünk vetélkedőt november 9-én, szombaton Erdély felfedezői számára Makfalván.</p>
            
            <p>A „Mert a Haza nem eladó" vetélkedőn a résztvevők történelmi tudásukat mérhették össze, miközben játékos formában ismerkedhettek meg nemzeti múltunk fontos eseményeivel.</p>
        ',
        
        '2019/news1' => '
            <p>Hálával és örömmel közöljük, hogy a kibédi Mátyus István Hagyományőrző Csapat az Örökség serleg elismerésében részesült.</p>
            
            <p>A kitüntetés a csapat éveken át tartó fáradhatatlan hagyományőrző munkáját ismeri el. Büszkék vagyunk rájuk!</p>
        ',
        
        '2018/news1' => '
            <p>Eseménydús, tartalmas októbere volt a Szent István utódai hagyományőrző csapatnak.</p>
            
            <p>Az őszi hónapokban számos megemlékezésen és programon vettek részt a csapat tagjai, folytatva a hagyományőrzés fontos munkáját.</p>
        ',
    ];
    
    return $contents[$slug] ?? '<p>' . htmlspecialchars($news['excerpt']) . '</p>';
}

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

                <!-- Featured Image -->
                <img src="<?php echo img($news['image']); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>" class="article-featured-image">

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