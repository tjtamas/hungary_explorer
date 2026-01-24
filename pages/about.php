<?php
declare(strict_types=1);

/**
 * About Page - Magyarország Felfedezői Szövetség
 * 
 * Rólunk / A Szövetségről oldal
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
$tpl->set('pageTitle', 'A Szövetségről')
    ->set('metaDescription', 'Ismerje meg a Magyarország Felfedezői Szövetséget - 1989 óta a magyar hagyományok és értékek őrzője.')
    ->set('pageClass', 'about-page');

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
                <span class="current">A Szövetségről</span>
            </nav>

            <!-- Page Header -->
            <header class="page-header">
                <h1 class="page-title">🦌 A Szövetségről</h1>
                <p class="page-description">
                    „Őseim országot szereztek, én Szülőföldemet teszem hazámmá"
                </p>
            </header>

            <!-- Content -->
            <article class="page-content">
                
                <!-- Intro Section -->
                <section class="content-section">
                    <div class="content-block with-image">
                        <div class="content-text">
                            <p class="lead">
                                Szövetségünk <strong>1989. szeptemberében</strong> alakult. Gyermekek, fiatalok, felnőttek szervezete vagyunk. Szövetséget kötöttünk a szülőföld, a haza felfedezésére, nemzeti értékeink, hagyományaink megőrzésére, az igaz emberi értékek követésére, a gyermek ember igaz értékek menti jellemformálására, a közösségi élet ajándékosztó erejének építésére.
                            </p>
                        </div>
                        <div class="content-image">
                            <img src="<?php echo img('logo/logo3.png'); ?>" alt="Az egyesület logója" class="rounded-image">
                        </div>
                    </div>
                </section>

                <!-- Jelvény Section -->
                <section class="content-section">
                    <div class="content-block">
                        <p>
                            A szervezet programja, eszmeisége – törvényeink, fogadalmaink, próbáink, stb. – a magyar hagyománykincsre, történelmi, természeti örökségeinkre épül. Szövetségünk jelvénye is a magyar hagyománykincset idézi: <strong>két – korondi motívumból vett – csodaszarvas találkozik a Hármas halom tetején</strong>. Egyik a mostani határainkon belüli, a másik a mai határainkon túli magyar gyermekeket jelképezi.
                        </p>
                        <p>
                            Találkozásuk a Hármas halom tetején pedig azt jelenti: <em>testvérek vagyunk</em>. Szövetségünk zászlaján a farkasfogak az 1848-49-es szabadságharc emlékét őrzik. A zászló egyik oldalán a szövetség hímzett jelvénye látható, másik oldalán pedig a szabadságharc harmadosztályú érdemjele, az ezüst babérkoszorú.
                        </p>
                    </div>
                </section>

                <!-- Gyermekhősök Section -->
                <section class="content-section">
                    <div class="content-block with-image reverse">
                        <div class="content-text">
                            <p>
                                A szövetség és a csapatok programjával, próbákkal, rendezvényekkel, táborokkal, pályázatokkal, felfedezőutakkal a gyermekek és a szülőföldjük, hazájuk között olyan aranyszálak szövődnek, amely kötődéssel a gyermek nem csak megtanulja, hogy mennyi értéket rejt szülőföldje, hazája, hanem meg is érzi milyen csodálatosan szép érzést ad szeretni az otthonát.
                            </p>
                            <p>
                                Így érti és érzi át a szövetség Rákóczi kort idéző köszöntését is: <strong>„Pro Patria!"</strong> és a felelet rá: <strong>„Hűséggel!"</strong>
                            </p>
                            <p>
                                A szövetség felkarolta hazánk történelmének, például a Rákóczi- és az 1848-49-es szabadságharc gyermekhőseit. Megemlékezésekkel, játékokkal, felfedezőutakkal, pályázatokkal ápoljuk emléküket.
                            </p>
                        </div>
                        <div class="content-image">
                            <img src="<?php echo img('about/gyerekhosok.png'); ?>" alt="A szabadságharc gyermekhősei könyv" class="rounded-image shadow">
                        </div>
                    </div>
                </section>

                <!-- Egyenruha Section -->
                <section class="content-section highlight-section">
                    <h2><i class="fas fa-tshirt"></i> Egyenruhánk</h2>
                    <div class="content-block with-image">
                        <div class="content-text">
                            <p>
                                Aki felvételi próbát tett és „felfedező" lesz, viselheti már egyenruhánkat. Egyenruhánk a <strong>galambszürke (szürkészöld) ing</strong>, a világoskék (égszínkék) nyakkendő és a <strong>Bocskai sapka</strong>.
                            </p>
                            <p>
                                Fonott nyakkendőnk két szárát a szövetség jelvényével, vagy a csapatjelvénnyel fogjuk össze. A nyakkendő fonatának három szála közül az egyik a szövetség vezetői számára adományozott elismeréséként lehet fehér színű.
                            </p>
                            <p>
                                Az egyenruha fontos, mert kifejezi összetartozásunkat. Azonban nem kívánjuk meg senkitől, hogy ez olyan kiadást jelentsen, ami gátja annak, hogy a szövetséghez tartozzon.
                            </p>
                        </div>
                        <div class="content-image">
                            <img src="<?php echo img('about/ing.png'); ?>" alt="Egyenruha" class="rounded-image shadow">
                        </div>
                    </div>
                </section>

                <!-- Tábor Section -->
                <section class="content-section">
                    <h2><i class="fas fa-campground"></i> Sárospataki táborunk</h2>
                    <div class="content-block with-image reverse">
                        <div class="content-text">
                            <p>
                                Legfontosabb országos rendezvényünk a sárospataki központunkban minden évben megrendezett vezetőképző – tisztképző – táborunk. Sárospatakon „életre keltettük" a Magyar Köztársaság címerének Hármas halmát.
                            </p>
                            <p>
                                A találkozókra <strong>mindenki hoz magával szülőföldjéről egy maroknyi földet</strong>, amit a tábor nyitó ünnepségén valamelyik dombocskára szór és közben elmondja, hogy az a kis föld honnan származik, s ahonnan származik, az a hely miért fontos számára.
                            </p>
                        </div>
                        <div class="content-image">
                            <img src="<?php echo img('about/szoras.png'); ?>" alt="Földadományozás" class="rounded-image shadow">
                        </div>
                    </div>
                </section>

                <!-- Szívhang Section -->
                <section class="content-section">
                    <div class="content-block with-image">
                        <div class="content-text">
                            <p>
                                Vezetőképző táboraink hagyományos zarándok útjai vezetnek a Zemplén csodás vidékein álló romantikus romvárakhoz, Sátoraljaújhelyre, Széphalomba a Magyar Nyelv Múzeumába és a határon túli Borsiba.
                            </p>
                            <p>
                                Borsi „a magyar Betlehem" tartja a mondás, hiszen ennek a községnek a kastélyában született II. Rákóczi Ferenc. A táborokban hazánk sok tájáról és a határokon túli magyar vidékekről érkezők között örökre szóló barátságok kötődnek.
                            </p>
                            <p>
                                A táborok adta élményeket, az esti pásztortüzek mellett dalolt népdalokat és egymásnak elmondott <strong>„szívhangokat"</strong> minden pataki táborozó örök emlékként őrzi.
                            </p>
                        </div>
                        <div class="content-image">
                            <img src="<?php echo img('about/szivhang.png'); ?>" alt="Szívhang" class="rounded-image shadow">
                        </div>
                    </div>
                </section>

                <!-- CTA Section -->
                <section class="content-section cta-section">
                    <div class="cta-box">
                        <h3>Csatlakozz hozzánk!</h3>
                        <p>Szövetségünk tagja bárki lehet, aki céljainkat, törvényeinket, eszmeiségünket elfogadja, magáénak vallja.</p>
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