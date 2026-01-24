<?php
declare(strict_types=1);

/**
 * Contact Page - Magyarország Felfedezői Szövetség
 * 
 * Modern contact form and information
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
$tpl->set('pageTitle', 'Kapcsolat')
    ->set('metaDescription', 'Lépjen kapcsolatba a Magyarország Felfedezői Szövetséggel. Írjon nekünk!')
    ->set('pageClass', 'contact-page');

// Form handling
$formSubmitted = false;
$formError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Basic validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $formError = 'Kérjük, töltsd ki az összes kötelező mezőt!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formError = 'Kérjük, adj meg egy érvényes e-mail címet!';
    } else {
        // Send email (configure as needed)
        $to = CONTACT_EMAIL;
        $emailSubject = "Kapcsolat űrlap: " . $subject;
        $emailBody = "Név: $name\n";
        $emailBody .= "E-mail: $email\n";
        $emailBody .= "Telefon: $phone\n";
        $emailBody .= "Tárgy: $subject\n\n";
        $emailBody .= "Üzenet:\n$message";
        $headers = "From: $email\r\nReply-To: $email\r\n";
        
        // Uncomment to actually send email:
        // mail($to, $emailSubject, $emailBody, $headers);
        
        $formSubmitted = true;
    }
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
    <link rel="stylesheet" href="<?php echo asset('css/contact.css'); ?>">
    
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
                <span class="current">Kapcsolat</span>
            </nav>

            <!-- Page Header -->
            <header class="page-header">
                <h1 class="page-title">📬 Kapcsolat</h1>
                <p class="page-description">
                    Kérdésed van? Írj nekünk, és hamarosan válaszolunk!
                </p>
            </header>

            <!-- Contact Content -->
            <div class="contact-wrapper">
                
                <!-- Contact Info Cards -->
                <div class="contact-info">
                    
                    <!-- Elnök -->
                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="contact-card-content">
                            <h3>Elnök</h3>
                            <p class="contact-name">Morvai Richárd</p>
                            <a href="mailto:info@magyarorszagfelfedezoi.hu" class="contact-link">
                                <i class="fas fa-envelope"></i>
                                info@magyarorszagfelfedezoi.hu
                            </a>
                        </div>
                    </div>

                    <!-- Tábor info -->
                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <i class="fas fa-campground"></i>
                        </div>
                        <div class="contact-card-content">
                            <h3>Tábor & Táborhely bérlés</h3>
                            <p class="contact-name">Balázs György</p>
                            <a href="mailto:batibi.54@gmail.com" class="contact-link">
                                <i class="fas fa-envelope"></i>
                                batibi.54@gmail.com
                            </a>
                        </div>
                    </div>

                    <!-- Telefon -->
                    <div class="contact-card">
                        <div class="contact-card-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-card-content">
                            <h3>Telefonszám</h3>
                            <a href="tel:+36303202642" class="contact-phone">
                                +36 30 / 320-26-42
                            </a>
                        </div>
                    </div>

                    <!-- SZJA -->
                    <div class="contact-card highlight">
                        <div class="contact-card-icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <div class="contact-card-content">
                            <h3>Támogass minket!</h3>
                            <p>Adód 1%-ával támogathatod egyesületünket:</p>
                            <p class="tax-number"><?php echo SZJA_TAX_NUMBER; ?></p>
                        </div>
                    </div>

                </div>

                <!-- Contact Form -->
                <div class="contact-form-wrapper">
                    <div class="contact-form-card">
                        <h2><i class="fas fa-paper-plane"></i> Írj nekünk!</h2>
                        
                        <?php if ($formSubmitted): ?>
                            <div class="form-success">
                                <i class="fas fa-check-circle"></i>
                                <h3>Köszönjük az üzeneted!</h3>
                                <p>Hamarosan felvesszük veled a kapcsolatot.</p>
                            </div>
                        <?php else: ?>
                            
                            <?php if ($formError): ?>
                                <div class="form-error">
                                    <i class="fas fa-exclamation-circle"></i>
                                    <?php echo htmlspecialchars($formError); ?>
                                </div>
                            <?php endif; ?>

                            <form method="post" action="" class="contact-form">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="name">
                                            <i class="fas fa-user"></i> Név <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            id="name" 
                                            name="name" 
                                            placeholder="A neved"
                                            required
                                            value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label for="email">
                                            <i class="fas fa-envelope"></i> E-mail <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="email" 
                                            id="email" 
                                            name="email" 
                                            placeholder="pelda@email.hu"
                                            required
                                            value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                                        >
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="phone">
                                            <i class="fas fa-phone"></i> Telefonszám
                                        </label>
                                        <input 
                                            type="tel" 
                                            id="phone" 
                                            name="phone" 
                                            placeholder="+36 30 123 4567"
                                            value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>"
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label for="subject">
                                            <i class="fas fa-tag"></i> Tárgy <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text" 
                                            id="subject" 
                                            name="subject" 
                                            placeholder="Miről szeretnél írni?"
                                            required
                                            value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>"
                                        >
                                    </div>
                                </div>

                                <div class="form-group full-width">
                                    <label for="message">
                                        <i class="fas fa-comment-alt"></i> Üzenet <span class="required">*</span>
                                    </label>
                                    <textarea 
                                        id="message" 
                                        name="message" 
                                        rows="6" 
                                        placeholder="Írd ide az üzeneted..."
                                        required
                                    ><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane"></i> Üzenet küldése
                                    </button>
                                    <button type="reset" class="btn btn-secondary">
                                        <i class="fas fa-eraser"></i> Törlés
                                    </button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>

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

</body>
</html>