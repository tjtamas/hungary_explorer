<!-- Header with Top Navigation -->
<header id="header" class="site-header">
    <div class="header-top" style="background-image: url('<?php echo img("logo/header_background3.png"); ?>');">
        <div class="header-container">
            <!-- Logo -->
            <a href="<?php echo url(''); ?>" class="logo-link">
                <div class="logo">
                    <span class="logo-text">
                        <strong class="logo-title">Magyarország Felfedezői Szövetség</strong>
                        <span class="logo-subtitle">Alapítva 1989</span>
                    </span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="main-nav desktop-nav">
                <ul class="nav-menu">
                    <li><a href="<?php echo url(''); ?>">Kezdőlap</a></li>
                    <li class="has-submenu">
                        <a href="#">Bemutatkozás <i class="fas fa-chevron-down"></i></a>
                        <ul class="submenu">
                            <li><a href="<?php echo url('pages/about.php'); ?>">Rólunk</a></li>
                            <li><a href="<?php echo url('pages/badges.php'); ?>">Jelvényeink</a></li>
                            <li><a href="<?php echo url('pages/museum.php'); ?>">Múzeumunk</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu mega-menu">
                        <a href="#">Csapataink <i class="fas fa-chevron-down"></i></a>
                        <div class="mega-dropdown">
                            <div class="mega-column">
                                <h4>Erdély</h4>
                                <ul>
                                    <li><a href="<?php echo url('pages/teams/harmasfalu.php'); ?>">Hármasfalu</a></li>
                                    <li><a href="<?php echo url('pages/teams/kibed.php'); ?>">Kibéd</a></li>
                                    <li><a href="<?php echo url('pages/teams/sovarad.php'); ?>">Sóvárad</a></li>
                                </ul>
                            </div>
                            <div class="mega-column">
                                <h4>Felvidék</h4>
                                <ul>
                                    <li><a href="<?php echo url('pages/teams/felsoszeli.php'); ?>">Felsőszeli</a></li>
                                </ul>
                            </div>
                            <div class="mega-column">
                                <h4>Magyarország</h4>
                                <ul>
                                    <li><a href="<?php echo url('pages/teams/mad.php'); ?>">Mád</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="has-submenu">
                        <a href="#">Multimédia <i class="fas fa-chevron-down"></i></a>
                        <ul class="submenu">
                            <li><a href="<?php echo url('pages/gallery'); ?>">Képgaléria</a></li>
                            <li><a href="<?php echo url('pages/videos.php'); ?>">Videógaléria</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo url('pages/contact.php'); ?>">Kapcsolat</a></li>
                </ul>
            </nav>

            <!-- Mobile Hamburger -->
            <button id="hamburger" class="hamburger" aria-label="Menü">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <nav class="main-nav mobile-nav" id="mobileNav">
        <ul class="mobile-menu">
            <li><a href="<?php echo url(''); ?>">Kezdőlap</a></li>
            <li>
                <span class="mobile-opener">Bemutatkozás <i class="fas fa-chevron-down"></i></span>
                <ul class="mobile-submenu">
                    <li><a href="<?php echo url('pages/about.php'); ?>">Rólunk</a></li>
                    <li><a href="<?php echo url('pages/badges.php'); ?>">Jelvényeink</a></li>
                    <li><a href="<?php echo url('pages/museum.php'); ?>">Múzeumunk</a></li>
                </ul>
            </li>
            <li>
                <span class="mobile-opener">Csapataink <i class="fas fa-chevron-down"></i></span>
                <ul class="mobile-submenu">
                    <li class="mobile-submenu-group">
                        <strong>Erdély</strong>
                        <ul>
                            <li><a href="<?php echo url('pages/teams/harmasfalu.php'); ?>">Hármasfalu</a></li>
                            <li><a href="<?php echo url('pages/teams/kibed.php'); ?>">Kibéd</a></li>
                            <li><a href="<?php echo url('pages/teams/sovarad.php'); ?>">Sóvárad</a></li>
                        </ul>
                    </li>
                    <li class="mobile-submenu-group">
                        <strong>Felvidék</strong>
                        <ul>
                            <li><a href="<?php echo url('pages/teams/felsoszeli.php'); ?>">Felsőszeli</a></li>
                        </ul>
                    </li>
                    <li class="mobile-submenu-group">
                        <strong>Magyarország</strong>
                        <ul>
                            <li><a href="<?php echo url('pages/teams/mad.php'); ?>">Mád</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <span class="mobile-opener">Multimédia <i class="fas fa-chevron-down"></i></span>
                <ul class="mobile-submenu">
                    <li><a href="<?php echo url('pages/gallery'); ?>">Képgaléria</a></li>
                    <li><a href="<?php echo url('pages/videos.php'); ?>">Videógaléria</a></li>
                </ul>
            </li>
            <li><a href="<?php echo url('pages/contact.php'); ?>">Kapcsolat</a></li>
        </ul>
    </nav>
</header>