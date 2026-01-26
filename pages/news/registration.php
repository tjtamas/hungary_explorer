<?php
declare(strict_types=1);

/**
 * Registration Page - Magyarország Felfedezői Szövetség
 * 
 * Pásztortűz 2026 Tábor Jelentkezés
 * 
 * @package MagyarorszagFelfedezoi
 * @version 2.0.0
 */

// Bootstrap the application
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/TemplateEngine.php';
require_once __DIR__ . '/../../config/news.php';

// Create template engine instance
$tpl = new TemplateEngine('templates/');

// Set global variables
$tpl->setGlobal('siteName', SITE_NAME)
    ->setGlobal('siteTagline', SITE_TAGLINE)
    ->setGlobal('currentYear', date('Y'))
    ->setGlobal('baseUrl', BASE_URL)
    ->setGlobal('assetsUrl', ASSETS_URL)
    ->setGlobal('imagesUrl', IMAGES_URL);

// Set page-specific variables
$tpl->set('pageTitle', 'Jelentkezés - Pásztortűz 2026')
    ->set('metaDescription', 'Jelentkezz a Pásztortűz 2026 nyári táborba!')
    ->set('pageClass', 'registration-page');

// Get active registration info
$activeRegistration = getActiveRegistration();

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="<?php echo $tpl->e($tpl->get('metaDescription')); ?>">
    
    <title><?php echo $tpl->e($tpl->get('pageTitle')); ?> - <?php echo $tpl->e(SITE_NAME); ?></title>
    
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo img('logo/stags_logo.png'); ?>">
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo asset('css/variables.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/modern.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/components.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/registration.css'); ?>">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Roboto+Slab:wght@400;700;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body class="<?php echo $tpl->e($tpl->get('pageClass')); ?>">

    <!-- Header -->
    <?php $tpl->render('header'); ?>

    <!-- Main Content -->
    <div id="wrapper" class="single-column-layout">
        <main id="main" class="main-content">
            <div class="content-inner">

                <!-- Back Button -->
                <div class="page-navigation">
                    <a href="<?php echo url('index.php'); ?>" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Vissza a főoldalra
                    </a>
                </div>

                <!-- Page Header -->
                <header class="page-header">
                    <h1 class="page-title">🎒 Jelentkezés</h1>
                    <h2 class="page-subtitle">Pásztortűz 2026 Nyári Tábor</h2>
                    <div class="section-underline"></div>
                </header>

                <?php if ($activeRegistration): ?>
                
                <!-- Registration Info Box -->
                <section class="registration-info-box">
                    <div class="info-grid">
                        <div class="info-item">
                            <i class="fas fa-calendar-alt"></i>
                            <div class="info-content">
                                <strong>Tábor időpontja</strong>
                                <span><?php echo date('Y. m. d.', strtotime($activeRegistration['camp_date_start'])); ?> - <?php echo date('m. d.', strtotime($activeRegistration['camp_date_end'])); ?></span>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-clock"></i>
                            <div class="info-content">
                                <strong>Jelentkezési határidő</strong>
                                <span><?php echo date('Y. m. d.', strtotime($activeRegistration['registration_deadline'])); ?></span>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-tag"></i>
                            <div class="info-content">
                                <strong>Részvételi díj</strong>
                                <span><?php echo number_format($activeRegistration['camp_price'], 0, ',', ' '); ?> Ft</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="info-content">
                                <strong>Helyszín</strong>
                                <span>Sárospatak</span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Registration Form -->
                <section class="registration-form-section">
                    <form id="registrationForm" class="registration-form" novalidate>
                        
                        <div class="form-section">
                            <h3 class="form-section-title">
                                <i class="fas fa-user"></i> Személyes adatok
                            </h3>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="firstname" class="form-label required">Teljes név</label>
                                    <input type="text" 
                                           id="firstname" 
                                           name="firstname" 
                                           class="form-input" 
                                           placeholder="Például: Kiss Anna"
                                           required>
                                    <span class="form-error">Kérjük, add meg a neved!</span>
                                </div>

                                <div class="form-group">
                                    <label for="birthdate" class="form-label required">Születési dátum</label>
                                    <input type="date" 
                                           id="birthdate" 
                                           name="birthdate" 
                                           class="form-input"
                                           required>
                                    <span class="form-error">Kérjük, add meg a születési dátumod!</span>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="idnumber" class="form-label">TAJ szám</label>
                                    <input type="text" 
                                           id="idnumber" 
                                           name="idnumber" 
                                           class="form-input" 
                                           placeholder="123456789"
                                           pattern="[0-9]{9}"
                                           maxlength="9">
                                    <span class="form-help">9 számjegy, kötőjel nélkül</span>
                                </div>

                                <div class="form-group">
                                    <label for="phonenumber" class="form-label">Telefonszám</label>
                                    <input type="tel" 
                                           id="phonenumber" 
                                           name="phonenumber" 
                                           class="form-input" 
                                           placeholder="+36 20 123 4567">
                                    <span class="form-help">Csak ha van saját telefonod</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h3 class="form-section-title">
                                <i class="fas fa-home"></i> Lakcím és kapcsolat
                            </h3>
                            
                            <div class="form-group">
                                <label for="lakcim" class="form-label required">Lakcím</label>
                                <input type="text" 
                                       id="lakcim" 
                                       name="lakcim" 
                                       class="form-input" 
                                       placeholder="Irányítószám, Város, Utca, Házszám"
                                       required>
                                <span class="form-error">Kérjük, add meg a lakcímed!</span>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="parentsnumber" class="form-label required">Szülő/Gondviselő telefonszáma</label>
                                    <input type="tel" 
                                           id="parentsnumber" 
                                           name="parentsnumber" 
                                           class="form-input" 
                                           placeholder="+36 30 123 4567"
                                           required>
                                    <span class="form-error">Kérjük, add meg a szülő telefonszámát!</span>
                                </div>

                                <div class="form-group">
                                    <label for="parentsemail" class="form-label">Szülő email címe</label>
                                    <input type="email" 
                                           id="parentsemail" 
                                           name="parentsemail" 
                                           class="form-input" 
                                           placeholder="pelda@email.hu">
                                    <span class="form-help">Kapcsolattartáshoz ajánlott</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h3 class="form-section-title">
                                <i class="fas fa-check-circle"></i> Hozzájárulások
                            </h3>
                            
                            <div class="form-checkbox-group">
                                <input type="checkbox" 
                                       id="agreement" 
                                       name="agreement" 
                                       class="form-checkbox"
                                       required>
                                <label for="agreement" class="form-checkbox-label">
                                    <strong>Hozzájárulok</strong>, hogy a tábor ideje alatt rólam kép és videóanyag készülhessen, 
                                    amit a szövetség nyilvánosan felhasználhat promóciós és dokumentációs céllal.
                                </label>
                            </div>

                            <div class="form-checkbox-group">
                                <input type="checkbox" 
                                       id="privacy" 
                                       name="privacy" 
                                       class="form-checkbox"
                                       required>
                                <label for="privacy" class="form-checkbox-label">
                                    Elolvastam és elfogadom az 
                                    <a href="<?php echo url('gdpr/adatkezeles.pdf'); ?>" target="_blank">adatkezelési tájékoztatót</a>.
                                </label>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-paper-plane"></i>
                                Jelentkezés elküldése
                            </button>
                            <button type="reset" class="btn-reset">
                                <i class="fas fa-redo"></i>
                                Űrlap ürítése
                            </button>
                        </div>

                    </form>
                </section>

                <?php else: ?>
                
                <!-- No Active Registration -->
                <section class="no-registration-box">
                    <i class="fas fa-info-circle"></i>
                    <h3>Jelenleg nincs nyitott jelentkezés</h3>
                    <p>Kérjük, nézz vissza később vagy kövesd híreinket a Facebook oldalunkon!</p>
                    <a href="<?php echo url('index.php'); ?>" class="btn-primary">Vissza a főoldalra</a>
                </section>

                <?php endif; ?>

            </div>
        </main>
    </div>



    <!-- Scripts -->
    <script src="<?php echo asset('js/app.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('registrationForm');
        
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validation
                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    return;
                }
                
                // Show loading
                Swal.fire({
                    title: 'Küldés folyamatban...',
                    text: 'Kérlek, várj egy pillanatot!',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Collect form data
                const formData = new FormData(form);
                
                // TODO: AJAX call to process.php
                // fetch('process.php', { ... })
                
                // Temporary success message (remove when backend is ready)
                setTimeout(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sikeres jelentkezés!',
                        text: 'Köszönjük a jelentkezésedet! Hamarosan keresünk.',
                        confirmButtonText: 'Rendben'
                    }).then(() => {
                        form.reset();
                        form.classList.remove('was-validated');
                    });
                }, 1500);
            });
        }
    });
    </script>

</body>
</html>