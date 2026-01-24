<?php
declare(strict_types=1);

/**
 * Team Page - Sóvárad (A Só útjának felfedezői)
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
$tpl->set('pageTitle', 'A Só útjának felfedezői - Sóvárad')
    ->set('metaDescription', 'A sóváradi A Só útjának felfedezői csapat bemutatása. Alapítva 2012-ben.')
    ->set('pageClass', 'team-page team-sovarad');

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
                <span class="current">Sóvárad</span>
            </nav>

            <!-- Team Header -->
            <header class="team-header">
                <h1 class="team-name">A Só útjának felfedezői</h1>
                <span class="team-region">🇷🇴 Erdély - Sóvárad</span>
            </header>

            <!-- Team Content -->
            <article class="team-content">

                <div class="team-quote">
                    <p>„Amit jól szeretsz, maradandó lészen. Amit jól szeretsz, való örökséged."</p>
                    <cite>Kovács András Ferenc</cite>
                </div>

                <img src="<?php echo img('teams/sovarad/kituzo.png'); ?>" alt="Kitűző" class="team-image team-image-left">

                <p>A sóváradi felfedezők csapata a <strong>2012–2013-as tanévben</strong> alakult az akkori alsó tagozatos gyerekek kis közösségéből. Az érdeklődő tanulók kíváncsian vettek részt a bemutató tevékenységeken, és lelkesedéssel készítették el avatási próbalapjukat.</p>

                <p>Első pillanattól kezdve erős háttért biztosított a születendő csapatnak az akkor már létező hármasfalusi és kibédi hagyományőrző csapatok támogatása. Végül <strong>2013 júniusában</strong> kilenc tag avatásával indult útjára a szövetség sóváradi alegysége.</p>

                <div class="clear"></div>

                <h3><i class="fas fa-handshake"></i> Együttműködés</h3>

                <img src="<?php echo img('teams/sovarad/csapat.png'); ?>" alt="A grundon a Pál utcai fiúkkal" class="team-image team-image-right">

                <p>Az erdélyi csapatok élete a továbbiakban is összefonódott. Falufelfedező, hagyományőrző játékokon, kirándulásokon vettünk részt, kiemelkedő történelmi eseményekre emlékeztünk meg együtt, vetélkedőket is szerveztünk, melyen a csapatok összemérhették felkészültségüket, rátermettségüket, tudásukat.</p>

                <p><strong>A Só útjának felfedezői</strong> évről évre gyarapodtak közös élményekben és létszámban.</p>

                <div class="clear"></div>

                <h3><i class="fas fa-gem"></i> Céljaink</h3>

                <p>Tevékenységeinken azokat a kincseket keressük, amelyek személyes életünket, lelkünket gazdagítják, szorosabban összefűznek egymással és a szülőföldünkkel, példaképeket keresünk a már letűnt idők hétköznapi és nemzeti hősei személyében. <strong>Bár a múltból merítünk ihletet, a jövőre készülünk.</strong></p>

                <p>Kilencedik, szabadon választott törvényünket így fogalmaztuk meg:</p>

                <div class="team-quote">
                    <p>„Elődeink életmódját igyekszem megismerni, felhasználni, megélni, jó példájukat követni a mindennapi életemben."</p>
                </div>

                <p>Ehhez híven fedeztük fel őseink hétköznapi szokásait, munkálatait, ünnepeit, és csodálkoztunk rá a józan paraszti ész diktálta életmódra, melytől mára már annyira eltávolodtunk.</p>

                <h3><i class="fas fa-palette"></i> Kultúra és hagyomány</h3>

                <p>Lényeges szempont a csapat életében a magyar kultúra ma is élő, lüktető vérkeringésébe való bekapcsolódás. Megismerkedtünk az idők folyamán változó székely és magyar himnuszokkal, rácsodálkoztunk a versek, dalok, szobrok, festmények, jelképek közötti összefüggésekre. Elolvastunk regényeket, majd megnéztünk azok színházi feldolgozásait is.</p>

                <img src="<?php echo img('teams/sovarad/kutatas.png'); ?>" alt="Honvéd sírok felkutatása" class="team-image team-image-left">

                <h3><i class="fas fa-search"></i> Szülőföld felfedezése</h3>

                <p>Fontos számunkra a szülőfalu megismerése földrajzilag és történelmileg egyaránt. A szövetség hetedik törvénye szerint mi is építeni, gyarapítani szeretnénk a faluközösséget, ahova tartozunk.</p>

                <p><strong>2015-ben</strong> egyik csapattagunk nagytatája, Józsa András helytörténész vezetésével kutattuk fel a sóváradi temetőben az évszázados sírköveket, és találtuk meg <strong>öt, '48-as honvéd sírját</strong>.</p>

                <div class="clear"></div>

                <h3><i class="fas fa-user-plus"></i> Új tagok</h3>

                <p>Az újabb érdeklődő csapattagok számára szervezett ismerkedő tevékenységekben, játékokban nagy segítséget nyújtanak a már régebbi tagok. Legnagyobb sikernek a kézműves tevékenységek, valamint a szabadtéri programok örvendenek.</p>

                <div class="team-quote">
                    <p>A Só útjának felfedezői szabadidejükben is megélik fogadalmukat: „Kitartóan erősítem a szeretetet, amely családomhoz, barátaimhoz fűz."</p>
                </div>

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