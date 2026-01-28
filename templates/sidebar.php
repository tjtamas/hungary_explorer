<!-- Sticky Sidebar -->
<aside id="sidebar" class="sidebar-widget">
    <div class="sidebar-sticky">
        
        <!-- Registration Widget - FEATURED -->
        <?php 
        // Ensure news.php is loaded
        if (!function_exists('getActiveRegistration')) {
            require_once __DIR__ . '/../config/news.php';
        }
        $activeRegistration = getActiveRegistration();
        if ($activeRegistration): 
        ?>
        <div class="widget registration-widget pulse-widget">
            <div class="widget-header registration-header">
                <h3>🔥 Jelentkezés</h3>
                <div class="widget-icon pulse-icon">🎒</div>
            </div>
            <div class="widget-content">
                <h4 class="registration-title"><?php echo htmlspecialchars($activeRegistration['title']); ?></h4>
                <p class="registration-text">
                    <?php echo htmlspecialchars($activeRegistration['excerpt']); ?>
                </p>
                <div class="registration-details">
                    <div class="registration-date">
                        <i class="fas fa-calendar-alt"></i>
                        <strong>Tábor:</strong> 
                        <?php echo date('Y. m. d.', strtotime($activeRegistration['camp_date_start'])); ?> - 
                        <?php echo date('m. d.', strtotime($activeRegistration['camp_date_end'])); ?>
                    </div>
                    <div class="registration-deadline">
                        <i class="fas fa-clock"></i>
                        <strong>Határidő:</strong> 
                        <?php echo date('Y. m. d.', strtotime($activeRegistration['registration_deadline'])); ?>
                    </div>
                </div>
                  <a href="<?php echo url('pages/news/registration.php'); ?>" 
                      class="btn-registration-fancy">
                    <span class="btn-icon">🔥</span>
                     <span class="btn-text">Jelentkezz Most!</span>
                    <span class="btn-arrow">→</span>
                    </a>
            </div>
        </div>
        <?php endif; ?>

        <!-- SZJA Section -->
        <div class="widget szja-widget">
            <div class="widget-header">
                <h3>SZJA 1%</h3>
                <div class="widget-icon">💰</div>
            </div>
            <div class="widget-content">
                <p class="szja-text">
                    Kérjük, ajánlja fel adója <strong>1%-át</strong> az anyaországi és határon túli magyar gyerekek táborozásának támogatására!
                </p>
                <div class="szja-tax-box">
                    <span class="tax-label">Adószám:</span>
                    <span class="tax-number"><?php echo SZJA_TAX_NUMBER; ?></span>
                </div>
            </div>
        </div>

        <!-- Facebook Widget -->
        <?php if (ENABLE_FACEBOOK_SDK): ?>
        <div class="widget facebook-widget">
            <div class="widget-header">
                <h3>Kövess minket!</h3>
                <div class="widget-icon">📱</div>
            </div>
            <div class="widget-content">
                <div class="fb-page" 
                     data-href="<?php echo FACEBOOK_PAGE; ?>" 
                     data-tabs="timeline" 
                     data-width="280" 
                     data-height="300" 
                     data-small-header="false" 
                     data-adapt-container-width="true" 
                     data-hide-cover="false" 
                     data-show-facepile="true">
                    <blockquote cite="<?php echo FACEBOOK_PAGE; ?>" class="fb-xfbml-parse-ignore">
                        <a href="<?php echo FACEBOOK_PAGE; ?>">Magyarország Felfedezői Szövetség</a>
                    </blockquote>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Doklist Badge -->
        <div class="widget doklist-widget">
            <div class="widget-content text-center">
                <a href="https://www.doklist.com/#dok44700" target="_blank" rel="noopener">
                    <img src="https://www.doklist.com/badge/44700.svg" 
                         alt="Doklist.com által hitelesített szervezet"
                         class="doklist-img">
                </a>
                <a href="https://www.doklist.com/hu/d44700/" 
                   target="_blank" 
                   rel="noopener"
                   class="doklist-link">
                    Hitelesített szervezet
                </a>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="widget quick-links-widget">
            <div class="widget-header">
                <h3>Gyors linkek</h3>
            </div>
            <div class="widget-content">
                <ul class="quick-links">
                    <li><a href="<?php echo url('pages/about.php'); ?>"><i class="fas fa-info-circle"></i> Rólunk</a></li>
                    <li><a href="<?php echo url('pages/gallery'); ?>"><i class="fas fa-images"></i> Galéria</a></li>
                    <li><a href="<?php echo url('pages/contact.php'); ?>"><i class="fas fa-envelope"></i> Kapcsolat</a></li>
                    <li><a href="<?php echo url('gdpr/adatkezeles.pdf'); ?>"><i class="fas fa-shield-alt"></i> Adatvédelem</a></li>
                </ul>
            </div>
        </div>

    </div>
</aside>