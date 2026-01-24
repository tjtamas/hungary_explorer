<?php
declare(strict_types=1);

/**
 * Team Page - Hármasfalu (Szent István utódai hagyományőrző csapat)
 * 
 * @package MagyarorszagFelfedezoi
 * @version 2.0.0
 */

// Bootstrap
require_once __DIR__ . '/../../config/config.php';
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
$tpl->set('pageTitle', 'Szent István utódai hagyományőrző csapat - Hármasfalu')
    ->set('metaDescription', 'A hármasfalusi Szent István utódai hagyományőrző csapat bemutatása. Alapítva 2010-ben.')
    ->set('pageClass', 'team-page team-harmasfalu');

// Galéria képek
$galleryImages = [
    ['src' => 'teams/harmasfalu/mar15.png', 'alt' => 'Március 15.'],
    ['src' => 'teams/harmasfalu/nepitanc.png', 'alt' => 'Néptánc'],
    ['src' => 'teams/harmasfalu/csapat.png', 'alt' => 'Csapat'],
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
    <link rel="stylesheet" href="<?php echo asset('css/teams.css'); ?>">
    
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
                <span>Csapataink</span>
                <span class="separator">/</span>
                <span class="current">Hármasfalu</span>
            </nav>

            <!-- Team Header -->
            <header class="team-header">
                <h1 class="team-name">Szent István utódai hagyományőrző csapat</h1>
                <p class="team-leader"><i class="fas fa-user"></i> Csapatvezető: Bereczki Erzsébet</p>
                <span class="team-region">🇷🇴 Erdély - Hármasfalu</span>
            </header>

            <!-- Team Content -->
            <article class="team-content">

                <h4 class="year-heading">2010-2011</h4>

                <p>A „Szent István utódai" hagyományőrző csapat <strong>2010. szeptember 25-én</strong> kezdte el tevékenységét 25 gyerekkel. Első csapattevékenységünk alkalmával bebarangoltuk szülőfalunk, Hármasfalu mindhárom faluját: <strong>Atosfalvát, Szentistvánt és Csókfalvát</strong>. Megcsodáltuk 6 szép templomát, szobrait.</p>

                <p>A nagy király egész családja megtalálható e három kis faluban: Szentistvánon Szent István király szobra, Csókfalván Szent Imre hercegé, Atosfalván pedig Gizella királyné. Sok gyerek már ekkor kiválasztotta szülőföld örökségét.</p>

                <p>Tevékenységeink során, miközben a szövetség törvényeivel, jelképeivel és Rákóczi korával ismerkedtünk, felelevenítettünk, eljátszottunk néhány helyi néphagyományt, népszokást: a szüreti bált és a fonót. A lányok meg tanultak fonni. Előkerültek a padlásokról a nagymamák orsói, guzsalyai és megtapasztalhattuk, milyen fáradságos munka volt a fonás.</p>

                <p>Avatási ünnepségünkre <strong>2011. március 15-én</strong> került sor iskolánkban, a „Szent István" Általános Iskolában. Ekkor 21 gyerek tette le a fogadalmat. Jelen volt a kibédi „Mátyus István" hagyományőrző csapat is, ők is avattak 3 új tagot.</p>

                <img src="<?php echo img('teams/harmasfalu/mar15.png'); ?>" alt="Március 15." class="team-image team-image-left">

                <p>2011 tavaszán történelmi játékon vettünk részt Kibéden. A játék után Mátyus Ilonka néni kalauzolt végig minket a falun, megmutatva Kibéd szépségeit, értékeit: a református templomot, benne a Bodor Péter-orgonát, Seprődi János szülőházát, Madaras Gábor, Seprődi János és Mátyus István szobrát.</p>

                <p>2011. július 25.–augusztus 1. között a csapat 3 tagja részt vett a vezetőképző táboron, Sárospatakon. Rengeteg szép élménnyel tértünk haza.</p>

                <div class="clear"></div>

                <h4 class="year-heading">2011-2012</h4>

                <p>Október 6-án csapatunk az aradi vértanúkra emlékezett műsorával a Szent István Általános Iskola közösségében. Novemberi, decemberi csapattevékenységeinken gyöngyfűzéssel, valamint a rovásírás rejtelmeivel foglalkoztunk. 2012. januárjában tartottunk is egy rovásírás-vetélkedőt.</p>

                <p>Februárban 3 gyerek kezdte el készítgetni a próbafeladatokat, hogy március 15-én letegye a szövetségi fogadalmat. <strong>Március 15-én</strong> ünnepi műsorunkkal és kiállításunkkal a szabadságharc gyermekhőseire emlékeztünk. E napon tette le a szövetségi fogadalmat 3 gyerek.</p>

                <p>Április 4-én takarítási akciót szervezett a csapat. A Csókfalván található Szent Imre herceg szobra körüli parkot takarítottuk ki, tettük széppé. <strong>A Szent Imre parkot csapatunk szülőföld örökségének választotta.</strong></p>

                <img src="<?php echo img('teams/harmasfalu/nepitanc.png'); ?>" alt="Néptánc" class="team-image team-image-right">

                <p>Május 5-én néptánc fellépésünk volt a Székely Majálison Makfalván. A rendezvény ünnepélyes felvonulással kezdődött: fúvószenekarral, huszárokkal és népviseletbe öltözött gyerekekkel, fiatalokkal.</p>

                <p>Június 9-én történelmi játékot szerveztünk Szabó Jóska emlékére. Vendégeink voltak a kibédi "Mátyus István hagyományőrző csapat" tagjai.</p>

                <p>Július 30–augusztus 5. között Sárospatakon vezetőképző táboron vett részt a csapat 6 tagja. A táborban megismételtük a Szabó Jóskáról szóló játékunkat a gáton.</p>

                <div class="clear"></div>

                <h4 class="year-heading">2012-2013</h4>

                <p>Október 7-én az aradi vértanúkra emlékeztünk a szentistváni református templomban. A műsor után az időseket köszöntöttük fel és ajándékoztuk meg. Október 27-én igricjátékot játszottunk Csókfalván, melyen részt vettek a sóváradi gyerekek.</p>

                <p>Június 1-jén közös felfedezőútra indultunk Kibéd és Sóvárad csapataival: Nyergestető, Kézdivásárhely, Zabola, Zágon, Sepsiszentgyörgy, Kisbacon. A Nyergestetőn szövetségi fogadalmat tett 2 hármasfalusi és 10 sóváradi gyerek.</p>

                <h4 class="year-heading">2014-2015</h4>

                <p>2015. február 5-7 között meglátogatott bennünket a gyömrői csapat néhány tagja. Ez alkalomból több közös programot szerveztünk: műsorok, játékok, falufelfedezések, szánkózás, közös alvás.</p>

                <p>Március 15-én a szentistváni református templomban ünnepeltünk:</p>

                <div class="team-quote">
                    <p>„Hej, tulipán, tulipán,<br>
                    Ez a hely az én hazám.<br>
                    Ide jöttem világra,<br>
                    Remélem, nem hiába."</p>
                </div>

                <p>Április 14-én makfalvi, hármasfalusi, kibédi és sóváradi gyerekekkel közös felfedezőútra indultunk. Közel 60 gyerek és 7 pedagógus gyűjtötte ezen a napon a szellemi örökséget a Mezőségen. Állomásaink: <strong>Kolozsvár, Válaszút, Bonchida, Pusztakamarás</strong>.</p>

                <p>Augusztus 11-13. között <strong>Gegesben</strong> szerveztünk hagyományőrző-felfedező tábort a sárospataki tábor mintájára.</p>

                <h4 class="year-heading">2016-2017</h4>

                <p>Április 23-án közös felfedezőutunk alkalmával „Királyok, fejedelmek nyomába" eredtünk: Nagyenyed, Gyulafehérvár, Vajdahunyad és Déva. Vajdahunyad várában avatási ünnepséget tartottunk: 6 hármasfalusi és egy makfalvi gyerek tette le a szövetségi fogadalmat.</p>

                <p>Júliusban <strong>Felvidékre</strong> látogattunk el, ahol Gímesen táboroztunk a szeli csapattal együtt. Bebarangoltuk Nyitrát, Kistapolcsányt, a gimesi várat, Gimeskosztolányt.</p>

                <h4 class="year-heading">2017-2018</h4>

                <p>Július 7-11 között ismét Gegesben táboroztunk. Velünk voltak a felvidéki felfedezők is. Együtt fedeztük fel Farkaslaka, Szejke, Csíksomlyó, Gyimesbükk természeti szépségeit, történelmi értékeit.</p>

                <p>Július 31–augusztus 7 között Sárospatakon a vezetőképző táborban töltöttünk felejthetetlen napokat. A Szövetség alapító elnöke, <strong>Rakó József</strong> (mindenki Jóska bácsija) emlékére kopjafát állítottunk a tábor udvarán, a Hármashalom mellett.</p>

                <h4 class="year-heading">2022-2023</h4>

                <p>2023. január 31-én Kolozsvárra utaztunk. A Magyar Operában a <strong>Sándor Mátyás</strong> musicalt néztük meg.</p>

                <p>Július 29–augusztus 5 között újabb élményeket gyűjtöttünk Sárospatakon: játszottunk, táncoltunk, daloltunk, kézműveskedtünk, gyalogtúráztunk.</p>

                <p>Augusztus 14-15-én kétnapos kirándulásra hívtuk Erdély felfedezőit: <strong>Torockó és Nagyenyed</strong> természeti szépségeit, történelmi kincseit indultunk el felfedezni. Felmásztunk a Székelykő 1128 m magas sziklagerincére!</p>

                <h4 class="year-heading">2023-2024</h4>

                <p>Októbert ismét az aradi vértanúkra való emlékezéssel kezdtük. November 2-án <strong>Petőfi Sándorra</strong> emlékeztünk egy vetélkedő keretén belül Makfalván. Szovátáról, Kibédről, Makfalváról, Hármasfaluból és Cséjéből gyűltek össze játékos kedvű felfedezők.</p>

                <!-- Csapat kép -->
                <img src="<?php echo img('teams/harmasfalu/csapat.png'); ?>" alt="Csapat" class="team-image team-image-full">

                <!-- CTA Section -->
                <section class="content-section cta-section">
                    <div class="cta-box">
                        <h3>Csatlakozz a csapathoz!</h3>
                        <p>Érdeklődsz a hagyományőrzés iránt? Vedd fel velünk a kapcsolatot!</p>
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

</body>
</html>